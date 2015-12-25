<?php

namespace backend\modules\query\controllers;

use Yii;
use backend\controllers\BjuiController;
use yii\data\Pagination;
use yii\helpers\Json;

class SsssController extends BjuiController
{

    public function actionIndex()
    {

        $pages = new Pagination([
            'pageParam' => 'pageCurrent',
            'pageSizeParam' => 'pageSize',
            'totalCount' =>0,
            'defaultPageSize' => 10
        ]);

        $models=[];
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages
        ]);
    }


//class end
}
