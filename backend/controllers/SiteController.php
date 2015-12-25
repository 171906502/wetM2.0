<?php
namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\helpers\Json;
use Exception;
use common\models\Group;
use common\models\Logdata;

class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'ajax-login', 'logout', 'timeout', 'error','insertlog'],
                        'allow' => true
                    ],
                    [
                        'actions' => ['index', 'about', 'layout', 'git'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'insertlog'=> ['post'],
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    public function init()
    {
        $this->enableCsrfValidation = false;
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'bjui';
        $query = Group::find();
        $models = $query->where(['pid'=>0])->with('groups')->all();
        $assignmentModels=[];
        $user = YII::$app->user;
        $authManager = Yii::$app->getAuthManager();
        foreach ($models as $key => $model) {
            $isAccess = $authManager->checkAccess($user->getId(), $model->name);
            if ($isAccess){
                array_push($assignmentModels,$model);
            }else{
                $groups = $model->groups;
                $isAccessGroups = false;
                foreach ($groups as $k=>$group){
                    $isAccess = $authManager->checkAccess($user->getId(), $group->name);
                    if($isAccess){
                        $isAccessGroups=true;
                    }else{
                         unset($groups[$k]);
                    }
                }
                if($isAccessGroups){
                    //$model->setGroups($groups);
                    array_push($assignmentModels,$model);
                }

            }
        }
        return $this->render('index', [
            //开发阶段，不校验权限
            //'models' => $assignmentModels,
            'models' => $models,
            'user'   =>$user,
            'authManager'=>$authManager
        ]);
    }

    public function actionInsertlog()
    {
        $model = new Logdata();
        $model->scenario = 'create';
        $datas = Yii::$app->request->post();
        $logFile = $datas['logFile'];
        $logDatas = $datas['data'];
        $remoteIp=$_SERVER['REMOTE_ADDR'];
        $objects = json_decode($logDatas,true);
        try{
            foreach($objects as $object){
                $model->isNewRecord = true;
                $model->setAttributes(['data'=>$object,'logFile'=>$logFile,'remoteIp'=>$remoteIp]);
                if (!$model->save()) {
                    throw new Exception("保存失败");
                    }else{
                    $model->id=0;
                }
            }
            $res = [
                'statusCode' => 200,
                'message' => '保存成功'
            ];
        }catch (Exception $e) {
            Yii::error("出错了啦：".$e->getMessage());
            $res = [
                'statusCode' => 300,
                'message' =>$e->getMessage()
            ];
        }
        return Json::encode($objects);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionLogin()
    {
        $this->layout = false;
        if (! \Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/');
        } else {
            return $this->render('login', [
                'model' => $model
            ]);
        }
    }

    public function actionAjaxLogin()
    {
        $this->layout = false;
        $model = new LoginForm();
        $data = [];
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $data['statusCode'] = 200;
            $data['message'] = '登陆成功';
            $data['closeCurrent'] = true;
            return Json::encode($data);
        } else {
            $data['statusCode'] = 300;
            $data['message'] = '登陆失败';
            return Json::encode($data);
        }
    }

    public function actionTimeout()
    {
        return $this->render('timeout');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        $data = [
            'statusCode' => 200,
            'closeCurrent' => true,
            'message' => '注销成功'
        ];
        return Json::encode($data);
    }

    public function actionLayout()
    {
        return $this->render('layout');
    }
    
    public function actionGit()
    {
        return $this->render('git');
    }
}
