<?php

namespace backend\modules\query;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\query\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    static function getDir(){

        return dirname(__FILE__);
    }
}
