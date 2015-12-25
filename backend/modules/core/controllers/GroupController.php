<?php
namespace backend\modules\core\controllers;

use Yii;
use backend\controllers\BjuiController;
use common\models\Group;

class GroupController extends BjuiController
{

    public function actionIndex()
    {
        $models = Group::find()->all();
        return $this->render('index', [
            'models' => $models
        ]);
    }

    public function actionView($id)
    {
        if ($id) {
            $model = $this->findModel($id);
        } else {
            $model = new Group();
        }
        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $model = new Group();
        $model->attributes = Yii::$app->request->post();
        if ($model->save()) {
            $this->data['id'] = yii::$app->db->getLastInsertID();
            return $this->ok('增加成功');
        }
    }

    public function actionUpdate($id)
    {
        $model = Group::findOne($id);
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
        if (($model = Group::findOne($id)) !== null) {
            return $model;
        } else {
            return $this->error('该记录不存在');
        }
    }

    public function actionNodeDrop($id)
    {
        $model = Group::findOne($id);
        $model->attributes = Yii::$app->request->get();
        if (Yii::$app->request->get('movetype') == 'inner') {}
        if ($model->save()) {
            return $this->ok('转移成功');
        } else {
            return $this->error('转移失败');
        }
    }
}
