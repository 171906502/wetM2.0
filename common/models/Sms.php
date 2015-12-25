<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%sms}}".
 *
 * @property integer $id
 * @property integer $tplid
 * @property string $mobile
 * @property string $content
 * @property integer $expire
 */
class Sms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sms}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tplid', 'mobile'], 'required'],
            [['tplid', 'expire'], 'integer'],
            [['mobile'], 'string', 'max' => 11],
            [['content'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '自动编号'),
            'tplid' => Yii::t('app', '短信模版编号'),
            'mobile' => Yii::t('app', '手机号码'),
            'content' => Yii::t('app', '短信内容'),
            'expire' => Yii::t('app', '过期时间'),
        ];
    }
}
