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
use common\data\WetSort;

class OrderController extends BjuiController
{


    public function getMasterTable($tables){
        $masterTable = '';
        foreach($tables as $table){
            if($table['isMain']=='1'){
                $masterTable =  $table;
            }
        }
        if($masterTable==''){
            throw new NotSupportedException();
        }else{
            return $masterTable;
        }

    }
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $menuId =31;
        $theadArray = QueryField::find()->where(['menuId'=>$menuId])->asArray()->with('queryTable')->all();
        $tables = QueryTable::find()->where(['menuId'=>$menuId])->asArray()->all();
        $masterTable =$this->getMasterTable($tables);

        $query= (new Query());
        $query->from($masterTable['dbName'].'.'.$masterTable['tabName']);
        $query->select($masterTable['tabName'].'.'.'id');
        foreach($tables as $table){
            if ($table['isMain']!='1'){
                $query->leftJoin($table['dbName'].'.'.$table['tabName'],$table['condition']);
            }
        }
        //排序字段
        $attributes=[];

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
            if($thead['isQuery']=='1'&&$thead['reName']&&$request->get($thead['reName'])){
                $query->andWhere(['like', $thead['reName'], $request->get($thead['reName'])]);
            }elseif($thead['isQuery']=='1'&&$request->get($thead['fieldName'])){
                $query->andWhere(['like', $thead['fieldName'], $request->get($thead['fieldName'])]);
            }

        }
        $sort = new WetSort([
            'attributes' => $attributes,
        ]);
        $pages = new Pagination([
            'pageParam' => 'pageCurrent',
            'pageSizeParam' => 'pageSize',
            'defaultPageSize' => 20
        ]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pages,
            'sort' =>$sort

        ]);
        $models = $provider->getModels();
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages
        ]);

    }



    public function actionLimit()
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