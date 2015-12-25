<?php

namespace backend\modules\query\controllers;

use Yii;
use backend\controllers\BjuiController;
use yii\data\Pagination;
use yii\helpers\Json;
use common\models\QueryField;
use common\models\QueryTable;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\base\NotSupportedException;

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
        $rows = (new \yii\db\Query())
            ->select(['cpgroupid', 'cpgroupname','id','name'])
            ->from('demo.pre_common_admincp_group')
            ->leftJoin('yii2advanced.menu','menu.id=pre_common_admincp_group.cpgroupid')
            ->limit(10)
            ->all();



        $models=[];

        $menuId =31;
        $theadArray = QueryField::find()->where(['menuId'=>$menuId])->asArray()->with('queryTable')->all();
        $tables = QueryTable::find()->where(['menuId'=>$menuId])->asArray()->all();
        $masterTable =$this->getMasterTable($tables);

        $query= (new Query());
        $query->from($masterTable['tabName']);
        $query->select($masterTable['tabName'].'.'.'id');
        foreach($tables as $table){
            if ($table['isMain']!='1'){
                $query->leftJoin($table['tabName'],$table['condition']);
            }
        }
        foreach ($theadArray as $thead){
            if ($thead['queryTable']['reName']){
                $addSelect = $thead['queryTable']['reName'];
            }else{
                $addSelect = $thead['queryTable']['tabName'];
            }
            $addSelect = $addSelect.'.'.$thead['fieldName'];
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