<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_token}}".
 *
 * @property integer $token_id
 * @property string $client_type
 * @property integer $user_id
 * @property string $username
 * @property string $access_token
 * @property string $access_expire
 * @property integer $login_time
 * @property string $login_ip
 *
 * @property User $user
 */
class UserToken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_token}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_type', 'user_id', 'username', 'access_token', 'access_expire'], 'required'],
            [['user_id', 'access_expire', 'login_time'], 'integer'],
            [['client_type'], 'string', 'max' => 10],
            [['username', 'access_token', 'login_ip'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'token_id' => Yii::t('app', '令牌编号'),
            'client_type' => Yii::t('app', '客户端类型 android wap'),
            'user_id' => Yii::t('app', '用户编号'),
            'username' => Yii::t('app', '用户名'),
            'access_token' => Yii::t('app', '登录令牌'),
            'access_expire' => Yii::t('app', '登录时间'),
            'login_time' => Yii::t('app', '最后登陆时间'),
            'login_ip' => Yii::t('app', '最后登陆ip'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
