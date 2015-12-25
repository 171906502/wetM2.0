<?php
namespace backend\modules\core\controllers;

use Yii;
use backend\controllers\BjuiController;
use common\models\Logdata;

use yii\data\Pagination;
use yii\helpers\Json;

class LogmanagerController extends BjuiController
{

    // 列表
    public function actionIndex()
    {

        $Logdata = new Logdata();
        $Logdata->scenario = 'search';
        $query = $Logdata->search(Yii::$app->request->queryParams);

        $pages = new Pagination([
            'pageParam' => 'pageCurrent',
            'pageSizeParam' => 'pageSize',
            'totalCount' => $query->count(),
            'defaultPageSize' => 10
        ]);

        $models = $query->asArray()->offset($pages->offset)
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
        $model = new Logdata();
        // $model->scenario = 'default';
        $user = $model->findOne($id);
        return $this->render('view', [
            'model' => $user ? $user : $model
        ]);
    }

    public function actionAdd()
    {
        $model = new Logdata();
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




    // jsDataGrid
    public function actionDatagrid()
    {
        $a = Yii::$app;
        $b=$a->params;
        Yii::$app->params['status'];
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

        return $this->render('datagrid', [
            'models' => $models,
            'pages' => $pages
        ]);
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
