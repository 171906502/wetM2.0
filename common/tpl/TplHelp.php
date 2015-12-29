<?php

namespace common\tpl;

use Yii;
use backend\modules\query\Module;
/**
 * Created by PhpStorm.
 * User: cntway
 * Date: 2015/11/5
 * Time: 16:58
 */

class TplHelp extends \yii\gii\Generator {


    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Controller Generator';
    }

    /**
     * @inheritdoc
     */
    public function generate(){
        $dir=Module::getDir();

        return $this->render('controller.php');

    }
    public function create($url,$menuId){
        if (strstr($url,"query")===false){
            return true;
        }
        list($modules, $controller, $action) = explode('/', $url."/");
        $baseDir=Module::getDir();
        if($modules!=="query"){
            return true;
        }
        if(!$action){
            $action="index";
        }
        $controllerDir = $baseDir.'/controllers/';
        $controllerFile = $controllerDir.ucwords($controller)."Controller.php";

        //判断controllor是否已经存在
        if(file_exists($controllerFile)){
            //已经存在controllor，追加一个action
            $fileContents = file_get_contents($controllerFile);
            if(strstr($fileContents,'action'.ucwords($action))===false){
                $oldContent =  substr($fileContents,0,strripos($fileContents,"//class end"));
                $newAction = $this->render('action.php',['actionName'=>'action'.ucwords($action),'menuId'=>$menuId]);
                $newController = $oldContent."\r\n".$newAction;
                $openFile = fopen($controllerFile,"w");
                fwrite($openFile,$newController);
            }else{
                return false;
            }

        }else{
            //新的controllor
            $actionName='action'.ucwords($action);
            $newController = $this->render('controller.php',['controllerName'=>ucwords($controller),'actionName'=>$actionName,'menuId'=>$menuId]);
            $openFileController = fopen($controllerFile,"w");
            fwrite($openFileController,$newController);

        }

        //试图文件创建
        $viewsDir = $baseDir.'/views/'.$controller."/";

        $viewFile = $viewsDir.$action.".php";

        //判断创建试图文件夹
        if(!file_exists($viewsDir)){
            mkdir($viewsDir);
        }
        $newView = $this->render('view.php',['searchUrl'=>'"'.$action.'"']);
        $openFileView = fopen($viewFile,"w");
        fwrite($openFileView,$newView);


        return true;
    }
}

