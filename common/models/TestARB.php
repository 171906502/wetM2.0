<?php
namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * Created by PhpStorm.
 * User: cntway
 * Date: 2015/10/30
 * Time: 17:31
 */
class TestARB extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'testARB';
    }
    public function getTestARA()
    {
        return $this->hasOne(TestARA::className(), ['id' => 'aid']);
    }
}