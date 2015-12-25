<?php
namespace backend\modules\core\controllers;

use Yii;
use backend\controllers\BjuiController;
use backend\modules\core\models\UserForm;
use common\models\TestARA;
use common\models\TestARB;

use yii\data\Pagination;
use yii\helpers\Json;

class UserController extends BjuiController
{
    // hasMany和hasOne的用法请参考文档
    public function actionTest($id)
    {
        $UserForm = UserForm::findOne([
            'id' => $id
        ]);
        // $UserTokens = $UserForm->getUserTokens()->all();
        $UserTokens = $UserForm->userTokens;
        var_dump($UserTokens);
    }
    // 列表
    public function actionIndex()
    {

        $UserForm = new UserForm();
        $UserForm->scenario = 'search';
        $query = $UserForm->search(Yii::$app->request->queryParams);
        
        $pages = new Pagination([
            'pageParam' => 'pageCurrent',
            'pageSizeParam' => 'pageSize',
            'totalCount' => $query->count(),
            'defaultPageSize' => 10
        ]);
        
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages
        ]);
    }
    
    // 查看
    public function actionView($id)
    {
        $model = new UserForm();
        // $model->scenario = 'default';
        $user = $model->findOne($id);
        return $this->render('view', [
            'model' => $user ? $user : $model
        ]);
    }

    public function actionCreate()
    {
        $model = new UserForm();
        $model->scenario = 'create';
        $model->attributes = Yii::$app->request->post();
        if ($model->save()) {
            $data = [
                'statusCode' => 200,
                'tabid' => 'core-user',
                'closeCurrent' => true,
                'message' => '保存成功'
            ];
        } else {
            $message = array_values($model->firstErrors);
            $data = [
                'statusCode' => 300,
                'message' => implode('<br>', $message)
            ];
        }
        return Json::encode($data);
    }
    
    // 添加 addFlag=true 编辑addFlag=null
    public function actionUpdate($id)
    {
        $model = UserForm::findOne($id);
        $model->scenario = 'update';
        $model->attributes = Yii::$app->request->post();
        if ($model->save()) {
            $data = [
                'statusCode' => 200,
                'tabid' => 'core-user',
                'closeCurrent' => true,
                'message' => '保存成功'
            ];
        } else {
            $message = array_values($model->firstErrors);
            $data = [
                'statusCode' => 300,
                'message' => implode('<br>', $message)
            ];
        }
        return Json::encode($data);
    }
    
    // 删除
    public function actionDelete($id)
    {
        $model = UserForm::deleteAll([
            'id' => $id
        ]);
        $data = [
            'statusCode' => 200,
            'message' => '删除成功',
            'user' => $model
        ];
        return Json::encode($data);
    }
    // 删除
    public function actionBatchDelete($delids)
    {
        $delids = explode(',', $delids);
        $model = UserForm::deleteAll([
            'id' => $delids
        ]);
        $data = [
            'statusCode' => 200,
            'message' => '删除成功',
            'user' => $model
        ];
        return Json::encode($data);
    }





    public function actionEdit()
    {
        $postdata =  Yii::$app->request->post();
        $data = [
            'statusCode' => 200,
            'tabid' => 'table, table-fixed',
            'closeCurrent' => true,
            'message' => '保存成功'
        ];
        return Json::encode($data);

    }

}
