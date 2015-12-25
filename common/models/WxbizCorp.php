<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%wxbiz_corp}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $corpId
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Agent[] $wgents
 * @property Role[] $roles
 */
class WxbizCorp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wxbiz_corp}}';
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
            [['name', 'corpId'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 16],
            [['corpId'], 'string', 'max' => 18]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '企业编号'),
            'name' => Yii::t('app', '企业名称'),
            'corpId' => Yii::t('app', '企业标识'),
            'status' => Yii::t('app', '企业号状态'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgents()
    {
        return $this->hasMany(WxbizAgent::className(), ['corp_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(WxbizRole::className(), ['corp_id' => 'id']);
    }
}
