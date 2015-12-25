<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;

class BjuiController extends Controller
{

    public $auth;
    public $data;

    public function init()
    {
        $this->auth = Yii::$app->authManager;
        $this->data = [];
    }

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            die($this->timeout($message = ''));
        }
        return true;
    }

    public function ok($message)
    {
        $this->data['statusCode'] = 200;
        $this->data['message'] = $message;
        return Json::encode($this->data);
    }

    public function error($message)
    {
        $this->data['statusCode'] = 300;
        $this->data['message'] = $message;
        return Json::encode($this->data);
    }

    public function timeout($message)
    {
        $this->data['statusCode'] = 301;
        $this->data['message'] = $message;
        return Json::encode($this->data);
    }
}
