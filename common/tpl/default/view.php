<?php

echo "<?php\n";
?>
use common\models\QueryField;

$searchUrl =<?php echo $searchUrl?>;
$menuId =<?php echo $menuId?>;
$theadArray = QueryField::find()->where(['menuId'=>$menuId])->asArray()->all();
include dirname(dirname(__FILE__))."/TplSearch.php";