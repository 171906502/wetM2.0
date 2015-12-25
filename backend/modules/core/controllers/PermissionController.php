<?php
namespace backend\modules\core\controllers;

use Yii;
use backend\controllers\BjuiController;
use yii\db\Query;

class PermissionController extends BjuiController
{

    public function actionIndex()
    {
        $role = $this->auth->getRoles();
        $roles = array_keys($role);
        $query = new Query();
        $query->select('*')
            ->from('auth_item')
            ->leftJoin('auth_item_child', [
            'and',
            'auth_item.name=auth_item_child.child',
            'auth_item_child.parent not in (\'' . implode("','", $roles) . '\')'
        ])
            ->where([
            'auth_item.type' => 2,
        ])->andWhere(['not like', 'name', '/']);
        $models = $query->all();
        return $this->render('index', [
            'models' => $models
        ]);
    }
    
    // 查看
    public function actionView($name)
    {
        if ($name) {
            $model = $this->auth->getPermission($name);
        } else {
            $model = (object) [
                'type' => 2,
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
            return $this->error('与该许可同名的角色已经存在');
        }
        if ($this->auth->getPermission($name)) {
            return $this->error('该许可已经存在');
        }
        $permission = $this->auth->createPermission($name);
        $permission->description = Yii::$app->request->post('description');
        $ruleName = Yii::$app->request->post('ruleName');
        if ($ruleName) {
            if ($this->auth->getRule($ruleName)) {
                $permission->ruleName = $ruleName;
            } else {
                return $this->error('该规则不存在');
            }
        } else {
            $permission->ruleName = NULL;
        }
        try {
            if ($this->auth->add($permission)) {
                $parent = Yii::$app->request->post('parent');
                if ($parent) {
                    $parentPermission = $this->auth->getPermission($parent);
                    if ($parentPermission) {
                        $this->auth->addChild($parentPermission, $permission);
                    } else {
                        return $this->error('父许可不存在');
                    }
                }
            }
            
            $this->data['closeCurrent'] = true;
            return $this->ok('增加成功');
        } catch (\Exception $e) {
            return $this->error($e->errorInfo[2]);
        }
    }

    public function actionUpdate($name)
    {
        $permission = $this->auth->getPermission($name);
        $permission->name = Yii::$app->request->post('name');
        $permission->description = Yii::$app->request->post('description');
        $ruleName = Yii::$app->request->post('ruleName');
        if ($ruleName) {
            if ($this->auth->getRule($ruleName)) {
                $permission->ruleName = $ruleName;
            } else {
                return $this->error('该规则不存在');
            }
        } else {
            $permission->ruleName = NULL;
        }
        
        try {
            $this->auth->update($name, $permission);
            $this->data['closeCurrent'] = true;
            return $this->ok('编辑成功');
        } catch (\Exception $e) {
            return $this->error('编辑失败');
        }
    }
    
    // 删除
    public function actionDelete($name)
    {
        if ($this->auth->getChildren($name)) {
            return $this->error('请先删除子节点');
        }
        $permission = $this->auth->getPermission($name);
        try {
            $this->auth->remove($permission);
            return $this->ok('删除成功');
        } catch (\Exception $e) {
            return $this->error('删除失败');
        }
    }
}