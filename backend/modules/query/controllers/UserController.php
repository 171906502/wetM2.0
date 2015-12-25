<?php
namespace backend\modules\query\controllers;

use Yii;
use backend\controllers\BjuiController;
use backend\modules\core\models\UserForm;
use common\tpl\TplHelp;

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

//        $tplHelp = new TplHelp();
//        $content =  $tplHelp->create("dd");
        $UserForm = new UserForm();
        $UserForm->scenario = 'search';
        $query = $UserForm->search(Yii::$app->request->queryParams);

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


//class end
}
