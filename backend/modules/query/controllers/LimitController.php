<?php

namespace backend\modules\query\controllers;

use Yii;
use backend\controllers\BjuiController;
use yii\data\Pagination;
use common\models\QueryField;
use common\models\QueryTable;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\base\NotSupportedException;

class LimitController extends BjuiController
{
    public function getMasterTable($tables)
    {
        $masterTable = '';
        foreach ($tables as $table) {
            if ($table['isMain'] == '1') {
                $masterTable = $table;
            }
        }
        if ($masterTable == '') {
            return false;
        } else {
            return $masterTable;
        }

    }

    public function actionIndex()
    {
        $menuId =32;
        $theadArray = QueryField::find()->where(['menuId' => $menuId])->asArray()->with('queryTable')->all();
        $tables = QueryTable::find()->where(['menuId' => $menuId])->asArray()->all();
        $masterTable = $this->getMasterTable($tables);
        if(!$masterTable){
            $NullPages = new Pagination([
                'pageParam' => 'pageCurrent',
                'pageSizeParam' => 'pageSize',
                'totalCount' => 0,
                'defaultPageSize' => 20
            ]);
            return $this->render('index', [
                'models' => [],
                'pages' => $NullPages,
                'theadArray'=>[]
            ]);

        }
        $query = (new Query());
        $query->from($masterTable['tabName']);
        $query->select($masterTable['tabName'] . '.' . 'id');
        foreach ($tables as $table) {
            if ($table['isMain'] != '1') {
                $query->leftJoin($table['tabName'], $table['condition']);
            }
        }
        foreach ($theadArray as $thead) {
            if ($thead['queryTable']['reName']) {
                $addSelect = $thead['queryTable']['reName'];
            } else {
                $addSelect = $thead['queryTable']['tabName'];
            }
            $addSelect = $addSelect . '.' . $thead['fieldName'];
            if ($thead['makeTbName'] != 1) {
                $addSelect = $thead['fieldName'];
            }
            if ($thead['reName']) {
                $addSelect = $addSelect . ' ' . 'as' . ' ' . $thead['reName'];
            }
            $query->addSelect($addSelect);

        }
        $pages = new Pagination([
            'pageParam' => 'pageCurrent',
            'pageSizeParam' => 'pageSize',
            'totalCount' => $query->count(),
            'defaultPageSize' => 20
        ]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pages
        ]);
        $models = $provider->getModels();
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'theadArray'=>$theadArray
        ]);
    }


//class end
}
