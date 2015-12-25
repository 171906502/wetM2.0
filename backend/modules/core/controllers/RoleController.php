<?php
namespace backend\modules\core\controllers;

use Yii;
use backend\controllers\BjuiController;
use yii\db\Query;

class RoleController extends BjuiController
{

    public function actionIndex()
    {
        $query = new Query();
        $query->select('*')
            ->from('auth_item')
            ->leftJoin('auth_item_child', 'auth_item.name=auth_item_child.child')
            ->where([
            'auth_item.type' => 1
        ]);
        $models = $query->all();
        return $this->render('index', [
            'models' => $models
        ]);
    }

    
    // 查看
    public function actionView($name)
    {
        if ($name) {
            $model = $this->auth->getRole($name);
        } else {
            $model = (object) [
                'type' => 1,
                'name' => '',
                'description' => '',
                'ruleName' => '',
                'data' => ''
            ];
        }
        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $name = Yii::$app->request->post('name');
        if ($this->auth->getRole($name)) {
            return $this->error('该角色已经存在');
        }
        if ($this->auth->getPermission($name)) {
            return $this->error('与该角色同名的许可已经存在');
        }
        $role = $this->auth->createRole($name);
        $role->description = Yii::$app->request->post('description');
        $ruleName = Yii::$app->request->post('ruleName');
        if ($ruleName) {
            if ($this->auth->getRule($ruleName)) {
                $role->ruleName = $ruleName;
            } else {
                return $this->error('该规则不存在');
            }
        } else {
            $role->ruleName = NULL;
        }
        try {
            if ($this->auth->add($role)) {
                $parent = Yii::$app->request->post('parent');
                if ($parent) {
                    $parentRole = $this->auth->getRole( $parent );
                    if ($parentRole) {
                        $this->auth->addChild($parentRole, $role);
                    } else {
                        return $this->error('父角色不存在');
                    }
                }
            }
            
            $this->data['closeCurrent'] = true;
            return $this->ok('增加成功');
        } catch (\Exception $e) {
            return $this->error('增加失败');
        }
    }

    public function actionUpdate($name)
    {
        $role = $this->auth->getRole($name);
        $role->name = Yii::$app->request->post('name');
        $role->description = Yii::$app->request->post('description');
        $ruleName = Yii::$app->request->post('ruleName');
        if ($ruleName) {
            if ($this->auth->getRule($ruleName)) {
                $role->ruleName = $ruleName;
            } else {
                return $this->error('该规则不存在');
            }
        } else {
            $role->ruleName = NULL;
        }
        
        try {
            $this->auth->update($name, $role);
            $this->data['closeCurrent'] = true;
            return $this->ok('编辑成功');
        } catch (\Exception $e) {
            return $this->error('编辑失败');
        }
    }
    
    // 删除
    public function actionDelete($name)
    {
        $role = $this->auth->getRole($name);
        try {
            $this->auth->remove($role);
            return $this->ok('删除成功');
        } catch (\Exception $e) {
            return $this->error('删除失败');
        }
    }
}