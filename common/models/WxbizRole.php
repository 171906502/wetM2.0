<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%wxbiz_role}}".
 *
 * @property integer $id
 * @property integer $corp_id
 * @property string $rolename
 * @property string $secret
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Agent[] $agents
 * @property Corp $corp
 */
class WxbizRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wxbiz_role}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['corp_id', 'rolename', 'secret'], 'required'],
            [['corp_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['rolename'], 'string', 'max' => 16],
            [['secret'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '管理组编号'),
            'corp_id' => Yii::t('app', '企业编号'),
            'rolename' => Yii::t('app', '管理组名'),
            'secret' => Yii::t('app', '管理组凭证密钥'),
            'status' => Yii::t('app', '用户状态'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgents()
    {
        return $this->hasMany(WxbizAgent::className(), ['role_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorp()
    {
        return $this->hasOne(WxbizCorp::className(), ['id' => 'corp_id']);
    }
}
