<?php
namespace backend\modules\core\controllers;

use Yii;
use backend\controllers\BjuiController;
use yii\db\Query;

class AssignController extends BjuiController
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

    public function actionPermissions($name)
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
            ])
            ->andWhere(['not like', 'name', '/']);
        $models = $query->all();
        $targetHasModels = $this->auth->getPermissionsByRole($name);
        $targetHasModels = array_keys($targetHasModels);

        //取用户所有权限的集合
        $hasModel=[];
        foreach ($roles as $rkey=>$subRole){
            $subPermission = $this->auth->getPermissionsByRole($subRole);
            $hasModel = array_merge($hasModel,$subPermission);

        }
        $hasModels = array_keys($hasModel);
        $hasModelsTree=[];
        foreach ($models as $key => $model) {
            if(in_array($model['name'], $hasModels)){
                array_push($hasModelsTree,$model);
            }else{
                $subModels=$this->getSubModels($model,$models);
                foreach($subModels as $subKey=>$subModel){
                    if(in_array($subModel['name'], $hasModels)){
                        array_push($hasModelsTree,$model);
                    }
                }
            }

        }
        return $this->render('permissions', [
            'models' => $hasModelsTree,
            'hasModels' => $targetHasModels
        ]);
    }

    public function getSubModels($model,$models){
        $subModels=[];
        if(!isset($model['child'])){
            return $subModels;
        }
        foreach ($models as $key => $subModel) {
            if($model['name']==$subModel['name']){
                continue;
            }
            if($subModel['parent']==$model['name']){
                array_push($subModels,$subModel);
            }
        }
        foreach($subModels as $keySub=> $ssubMode){
            $ssubModeS= $this->getSubModels($ssubMode,$subModels);
            $subModels =array_merge($subModels,$ssubModeS);
        }
        return $subModels;
    }
    public function actionSave($name)
    {
        $parent = $this->auth->getRole($name);
        $action = Yii::$app->request->post('action');
        $level = Yii::$app->request->post('level');
        $ids = Yii::$app->request->post('ids');
        $ids = explode(',', $ids);
        
        if ($level == 0) {
            $child = $this->auth->getPermission($ids[$level]);
            if ($action == 'add') {
                $this->auth->addChild($parent, $child);
            } else {
                $this->auth->removeChild($parent, $child);
            }
            // 下级节点
            foreach ($this->auth->getChildren($ids[$level]) as $key => $value) {
                $child = $this->auth->getPermission($value->name);
                $this->auth->removeChild($parent, $child);
                foreach ($this->auth->getChildren($value->name) as $k => $v) {
                    $child = $this->auth->getPermission($v->name);
                    $this->auth->removeChild($parent, $child);
                }
            }
        } elseif ($level == 1) {
            // 根节点
            $child = $this->auth->getPermission($ids[0]);
            if ($this->auth->hasChild($parent, $child)) {
                foreach ($this->auth->getChildren($ids[0]) as $key => $value) {
                    $child0 = $this->auth->getPermission($value->name);
                    $this->auth->addChild($parent, $child0);
                }
                $this->auth->removeChild($parent, $child);
            }
            // 父节点
            $child = $this->auth->getPermission($ids[$level]);
            if ($action == 'add') {
                $this->auth->addChild($parent, $child);
            } else {
                $this->auth->removeChild($parent, $child);
            }
            // 叶子节点
            foreach ($this->auth->getChildren($ids[$level]) as $key => $value) {
                $child = $this->auth->getPermission($value->name);
                $this->auth->removeChild($parent, $child);
            }
        } elseif ($level == 2) {
            // 根节点
            $child = $this->auth->getPermission($ids[0]);
            if ($this->auth->hasChild($parent, $child)) {
                foreach ($this->auth->getChildren($ids[0]) as $key => $value) {
                    $child0 = $this->auth->getPermission($value->name);
                    $this->auth->addChild($parent, $child0);
                }
                $this->auth->removeChild($parent, $child);
            }
            // 父节点
            $child = $this->auth->getPermission($ids[1]);
            if ($this->auth->hasChild($parent, $child)) {
                foreach ($this->auth->getChildren($ids[1]) as $key => $value) {
                    $child0 = $this->auth->getPermission($value->name);
                    $this->auth->addChild($parent, $child0);
                }
                $this->auth->removeChild($parent, $child);
            }
            // 叶子节点
            $child = $this->auth->getPermission($ids[$level]);
            if ($action == 'add') {
                $this->auth->addChild($parent, $child);
            } else {
                $this->auth->removeChild($parent, $child);
            }
        }
        
        return $this->ok('保存成功');
    }
}