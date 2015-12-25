<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%app}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property AppVersion[] $appVersions
 */
class App extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%app}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '各产品APP_名称'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppVersions()
    {
        return $this->hasMany(AppVersion::className(), ['app_id' => 'id']);
    }
}
