<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%wxbiz_agent}}".
 *
 * @property integer $id
 * @property integer $corp_id
 * @property integer $role_id
 * @property string $name
 * @property integer $agentid
 * @property string $token
 * @property string $encodingAesKey
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Corp $corp
 * @property Role $role
 * @property Menu[] $menus
 */
class WxbizAgent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wxbiz_agent}}';
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
            [['corp_id', 'role_id', 'name', 'agentid', 'token', 'encodingAesKey'], 'required'],
            [['corp_id', 'role_id', 'agentid', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 16],
            [['token'], 'string', 'max' => 32],
            [['encodingAesKey'], 'string', 'max' => 43]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '应用编号'),
            'corp_id' => Yii::t('app', '企业编号'),
            'role_id' => Yii::t('app', '管理组编号'),
            'name' => Yii::t('app', '应用名称'),
            'agentid' => Yii::t('app', '应用ID'),
            'token' => Yii::t('app', '令牌'),
            'encodingAesKey' => Yii::t('app', 'AES密钥'),
            'status' => Yii::t('app', '应用状态'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorp()
    {
        return $this->hasOne(WxbizCorp::className(), ['id' => 'corp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(WxbizRole::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(WxbizMenu::className(), ['agent_id' => 'id']);
    }
}