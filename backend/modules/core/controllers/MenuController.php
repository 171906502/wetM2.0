<?php
namespace backend\modules\core\controllers;

use Yii;
use backend\controllers\BjuiController;
use common\models\Group;
use common\models\Menu;
use common\tpl\TplHelp;

class MenuController extends BjuiController
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

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    public function actionCreate()
    {
        $model = new Menu();
        $model->attributes = Yii::$app->request->post();


        if ($model->save()) {
            //TODO 是否必须成功创建模板文件，暂时只执行创建逻辑，不判断结果
            $tplHelp = new TplHelp();
            $tplHelp->create($model->url,$model->id);

            $this->data['id'] = yii::$app->db->getLastInsertID();
            return $this->ok('增加成功');
        } else {
            return $this->error(array_values($model->getFirstErrors()));
        }
    }

    public function actionUpdate($id)
    {
        $model = Menu::findOne($id);
        $model->attributes = Yii::$app->request->post();

        //TODO 是否必须成功创建模板文件，暂时只执行创建逻辑，不判断结果
        $tplHelp = new TplHelp();
        $tplHelp->create($model->url,$model->id);

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
}
