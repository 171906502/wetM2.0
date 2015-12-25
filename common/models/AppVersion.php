<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%app_version}}".
 *
 * @property integer $id
 * @property integer $app_id
 * @property string $app_name
 * @property string $client_version
 * @property string $client_useragent
 * @property string $client_useragent_name
 * @property string $download_url
 * @property integer $update_id
 * @property string $update_log
 * @property integer $update_install
 *
 * @property App $app
 */
class AppVersion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%app_version}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_id', 'app_name', 'client_version', 'client_useragent', 'download_url'], 'required'],
            [['app_id', 'update_id', 'update_install'], 'integer'],
            [['app_name', 'client_version'], 'string', 'max' => 20],
            [['client_useragent', 'update_log'], 'string', 'max' => 500],
            [['client_useragent_name', 'download_url'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'app_id' => Yii::t('app', '各产品APP_ID'),
            'app_name' => Yii::t('app', '各产品APP_名称'),
            'client_version' => Yii::t('app', '客户端版本号'),
            'client_useragent' => Yii::t('app', '各渠道版本 ，以逗号分隔，可升级多渠道，全渠道用all，主要是区分多渠道的不同升级，比如腾讯某个渠道，并不让你升级到最新版本，则就可以不加上腾讯渠道'),
            'client_useragent_name' => Yii::t('app', '渠道名称'),
            'download_url' => Yii::t('app', '升级下载网址'),
            'update_id' => Yii::t('app', '关键是这个字段，记录本次版本应该升级到最新版本号，如本次为2，最新为3，则最新版本号的ID记录为15，则填15， 最新的记录则为0. 每一次APP升级请求API都会讲低版本的记录自动更新为3'),
            'update_log' => Yii::t('app', '升级日志'),
            'update_install' => Yii::t('app', '是否强制安装'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApp()
    {
        return $this->hasOne(App::className(), ['id' => 'app_id']);
    }
}
