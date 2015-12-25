<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wxbiz_menu}}".
 *
 * @property integer $id
 * @property integer $pid
 * @property integer $agent_id
 * @property string $type
 * @property string $name
 * @property string $key
 * @property string $url
 *
 * @property WxbizAgent $agent
 */
class WxbizMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wxbiz_menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'agent_id'], 'integer'],
            [['type', 'name'], 'required'],
            [['type', 'name'], 'string', 'max' => 40],
            [['key'], 'string', 'max' => 128],
            [['url'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '文档ID'),
            'pid' => Yii::t('app', '上级分类ID'),
            'agent_id' => Yii::t('app', '应用编号'),
            'type' => Yii::t('app', '标题'),
            'name' => Yii::t('app', '标题'),
            'key' => Yii::t('app', '链接地址'),
            'url' => Yii::t('app', 'Url'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgent()
    {
        return $this->hasOne(WxbizAgent::className(), ['id' => 'agent_id']);
    }
}
