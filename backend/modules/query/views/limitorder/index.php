<?php
use common\models\QueryField;

$searchUrl ="index";
$menuId =120;
$theadArray = QueryField::find()->where(['menuId'=>$menuId])->asArray()->all();
include dirname(dirname(__FILE__))."/TplSearch.php";