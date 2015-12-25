<?php
use yii\helpers\Url;
?>
<script type="text/javascript">
//选择事件
function S_NodeCheck(e, treeId, treeNode) {
	var ids = '';
	if(treeNode.level==0){
		//根节点
		ids = treeNode.id;
	}else if(treeNode.level==1){
		//父节点
		ids = treeNode.pid + ',' +treeNode.id
	}else if(treeNode.level==2){
		//子节点
		var treeRootNode = treeNode.getParentNode().getParentNode();
		ids = treeRootNode.id + ',' + treeNode.pid + ',' + treeNode.id
	}
    $(this).bjuiajax('doAjax', {
    	type:'post',
    	url:'<?= Url::toRoute(['save']) ?>&name=<?= Yii::$app->request->get('name') ?>',
    	data:{
    		_csrf:'<?= Yii::$app->request->csrfToken ?>',
    		ids: ids,
    		level: treeNode.level,
    		action: treeNode.checked?'add':'remove'
    	},
    	callback:function(json){
        	$(this).bjuiajax('ajaxDone', json);
        	if(json.statusCode == 200){
        	}
        }
    });
}
</script>
<div class="bjui-pageContent tableContent">
    <ul id="core-views-assign-permissions-tree" class="ztree" data-toggle="ztree" data-expand-all="true" data-check-enable="true" data-on-check="S_NodeCheck">
    <?php
    foreach ($models as $key => $model) {

        echo '<li data-id="' . $model['name'] . '" data-pid="' . $model['parent'] . '" data-checked="' . in_array($model['name'], $hasModels) . '">' . $model['description'] . '</li>';
    }
    ?>
    </ul>
</div>
