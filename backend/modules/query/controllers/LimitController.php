<?php

namespace backend\modules\query\controllers;

use Yii;
use backend\controllers\BjuiController;
use yii\data\Pagination;
use common\models\QueryField;
use common\models\QueryTable;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use common\data\WetSort;

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
        $request = Yii::$app->request;
        $menuId =31;
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
        //排序字段
        $attributes=[];
        //查询条件
        $where=[];
        foreach ($theadArray as $thead){
            if ($thead['queryTable']['reName']){
                $addSelect = $thead['queryTable']['reName'];
            }else{
                $addSelect = $thead['queryTable']['tabName'];
            }
            $addSelect = $addSelect.'.'.$thead['fieldName'];
            if($thead['makeTbName']!=1){
                $addSelect=$thead['fieldName'];
            }
            if($thead['reName']){
                //组装排序字段
                array_push($attributes,$thead['reName']);
                //查询字段
                $addSelect = $addSelect.' '.'as'.' '.$thead['reName'];
            }else{
                array_push($attributes,$thead['fieldName']);
            }
            $query->addSelect($addSelect);

            //组装查询条件
            if($thead['isQuery']=='1'&&$thead['reName']){
                $where[$thead['reName']]=$request->get($thead['reName']);
            }elseif($thead['isQuery']=='1'){
                $where[$thead['fieldName']]=$request->get($thead['fieldName']);
            }

        }
        $query->where($where);
        $pages = new Pagination([
            'pageParam' => 'pageCurrent',
            'pageSizeParam' => 'pageSize',
            'defaultPageSize' => 20
        ]);
        $sort = new WetSort([
            'attributes' => $attributes,
        ]);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pages,
            'sort' =>$sort

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
