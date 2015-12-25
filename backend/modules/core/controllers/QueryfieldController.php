<?php
namespace backend\modules\core\controllers;

use backend\modules\core\models\QueryFieldForm;
use backend\modules\core\models\QueryTableForm;
use common\models\QueryTable;
use Yii;
use backend\controllers\BjuiController;
use common\models\Group;
use common\models\Menu;
use common\models\QueryField;
use yii\helpers\Json;
use Exception;

define('IS_QUERY_FALSE',2);
define('DATA_TYPE_INT',1);
define('IS_MAIN_TRUE',1);
define('IS_MAIN_FALSE',2);
define('IS_MAKETBNAME_TRUE',1);


class QueryfieldController extends BjuiController
{

    public function actionIndex()
    {
        $models = Group::find()->all();
        return $this->render('index', [
            'models' => $models
        ]);
    }


    public function actionGroupMenu($group_id)
    {
        $models = Menu::find()->where(['group_id'=>$group_id])->all();
        return $this->render('group-menu', [
            'models' => $models
        ]);
    }

    public function actionView($menuId)
    {
        $query = new \yii\db\Query();
        $query->select(['id','tabName','reName'])->from('query_table');
        $query->where(['menuId'=>$menuId]);
        $tabs=$query->all();
        $items=[];
        foreach ($tabs as $key=>$value){
            $reName =('(noReName)');
            if($value['reName']){
                $reName = '('.$value['reName'].')';
             }
            $items[$value['id']]=$value['tabName'].$reName;
        }
        return $this->render('view', [
            'menuId' => $menuId,
            'items'  =>$items
        ]);
    }
    public function actionTbview($menuId)
    {
        return $this->render('tbview', [
            'menuId' => $menuId,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = Menu::findOne($id);
        $model->attributes = Yii::$app->request->post();
        if ($model->save()) {
            $this->data['id'] = $id;
            return $this->ok('更新成功');
        } else {
            return $this->error(array_values($model->getFirstErrors()));
        }
    }

    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
            return $this->ok('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }

    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            return new Menu();
        }
    }

    public function actionNodeDrop($id)
    {
        $model = Menu::findOne($id);
        $model->attributes = Yii::$app->request->get();
        if (Yii::$app->request->get('movetype') == 'inner') {}
        if ($model->save()) {
            return $this->ok('转移成功');
        } else {
            return $this->error('转移失败');
        }
    }


    public function actionLoadfield($menuId)
    {
        $fields = QueryField::find()->where(['menuId'=>$menuId])->asArray()->all();
        return Json::encode($fields);

    }

    public function actionLoadtable($menuId)
    {
        $fields = QueryTable::find()->where(['menuId'=>$menuId])->asArray()->all();
        return Json::encode($fields);

    }




    public function actionCreate($menuId)
    {
        $model = new QueryFieldForm();
        $jsonData = Yii::$app->request->post()['json'];
        $attributes = json_decode($jsonData,true);
        $transaction=Yii::$app->db->beginTransaction();
        try{
            foreach($attributes as $object){
                //TODO 下拉的默认值bug，要找到修复方法
                //数据类型默认int
                if($object['dataType']==""){
                    $object['dataType']=DATA_TYPE_INT;
                }
                //查询调节默认为否
                if($object['isQuery']==""){
                    $object['isQuery']=IS_QUERY_FALSE;
                }
                //生成表名默认为是
                if($object['makeTbName']==""){
                    $object['makeTbName']=IS_MAKETBNAME_TRUE;
                }
                $object['menuId']=$menuId;
                $model->isNewRecord = true;
                if(isset($object['addFlag'])){
                    $model->scenario = 'create';
                    $model->setAttributes($object);

                    if (!$model->save()) {
                        throw new Exception();
                    }
                }else{
                    if(QueryFieldForm::updateAll($object,['gridNumber' =>$object['gridNumber'],'menuId' =>$object['menuId']])==false){
                        throw new Exception("更新失败");
                    }
                }
            }
            $transaction->commit();
            $data = [
                'statusCode' => 200,
                'closeCurrent' => true,
                'message' => '保存成功'
            ];
        }catch (Exception $e) {
            $transaction->rollBack();
            YII::error($e->getMessage());
            $data = [
                'statusCode' => 300,
                'message' =>'保存失败'
            ];
        }


        return Json::encode($data);
    }


    public function actionTabcreate($menuId)
    {

        $model = new QueryTableForm();
        $jsonData = Yii::$app->request->post()['json'];
        $attributes = json_decode($jsonData,true);
        //TODO 检查表，字段名的正确性
        $transaction=Yii::$app->db->beginTransaction();
        try{
            foreach($attributes as $object){
                //TODO 下拉的默认值bug，要找到修复方法
                //默认副表
                if($object['isMain']==""){
                    $object['isMain']=IS_MAIN_FALSE;
                }

                $object['menuId']=$menuId;
                if(isset($object['addFlag'])){
                    $model->scenario = 'create';
                    $model->setAttributes($object);

                    $model->isNewRecord = true;
                    if (!$model->save()) {
                        throw new Exception();
                    }
                }else{
                    $model->scenario = 'create';
                    $model->setAttributes($object);
                    if(QueryTableForm::updateAll($model->attributes,['id' =>$object['id']])==false){
                        throw new Exception("更新失败");
                    }
                }
            }
            $transaction->commit();
            $data = [
                'statusCode' => 200,
                'closeCurrent' => true,
                'message' => '保存成功'
            ];
        }catch (Exception $e) {
            $transaction->rollBack();
            YII::error($e->getMessage());
            $data = [
                'statusCode' => 300,
                'message' =>'保存失败'
            ];
        }


        return Json::encode($data);
    }

    public function actionDeletefield($menuId)
    {
        $jsonData = Yii::$app->request->post()['json'];
        $attributes = json_decode($jsonData,true);
        $fields = QueryField::find()->where(['menuId'=>$menuId,'gridNumber'=>$attributes[0]['gridNumber']])->one();
        if ($fields->delete()) {
            return $this->ok('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
    public function actionTabdelete($menuId)
    {
        $jsonData = Yii::$app->request->post()['json'];
        $attributes = json_decode($jsonData,true);
        $tab = QueryTable::find()->where(['id'=>$attributes[0]['id']])->one();
        if ($tab->delete()) {
            return $this->ok('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}