<?php
namespace backend\modules\core\controllers;

use Yii;
use backend\controllers\BjuiController;

class RuleController extends BjuiController
{

    public function actionIndex()
    {
        $models = $this->auth->getRules();
        return $this->render('index', [
            'models' => $models
        ]);
    }
    
    // 查看
    public function actionView($name)
    {
        $model = $this->auth->getRule($name);
        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $name = Yii::$app->request->post('name');
        if ($this->auth->getRule($name)) {
            return $this->error('该规则已经存在');
        }
        $rule = $this->auth->createRule($name);
        $rule->description = Yii::$app->request->post('description');
        try {
            $this->auth->add($rule);
            $this->data['tabid'] = 'core-Rule-index';
            $this->data['closeCurrent'] = true;
            return $this->ok('增加成功');
        } catch (\Exception $e) {
            return $this->error('增加失败');
        }
    }

    public function actionUpdate($name)
    {
        $rule = $this->auth->getRule($name);
        $rule->name = Yii::$app->request->post('name');
        $rule->description = Yii::$app->request->post('description');
        try {
            $this->auth->update($name, $rule);
            $this->data['tabid'] = 'core-Rule-index';
            $this->data['closeCurrent'] = true;
            return $this->ok('编辑成功');
        } catch (\Exception $e) {
            return $this->error('编辑失败');
        }
    }
    
    // 删除
    public function actionDelete($name)
    {
        $rule = $this->auth->getRule($name);
        try {
            $this->auth->remove($rule);
            $this->data['tabid'] = 'core-Rule-index';
            return $this->ok('删除成功');
        } catch (\Exception $e) {
            return $this->error('删除失败');
        }
    }
    // 删除
    public function actionBatchDelete($delids)
    {
        try {
            $delids = explode(',', $delids);
            foreach ($delids as $name) {
                $rule = $this->auth->getRule($name);
                $this->auth->remove($rule);
            }
            $this->data['tabid'] = 'core-Rule-index';
            return $this->ok('批量删除成功');
        } catch (\Exception $e) {
            return $this->error('批量删除失败');
        }
    }
}