<?php use yii\helpers\Url; ?>
<script type="text/javascript">
function myCallback(json) {
	$(this).bjuiajax('ajaxDone', json);
    if(json.statusCode == 200){
    	$(this).dialog('closeCurrent');
		// 增加修改 Ztree 节点
    	var treeId = "core-menu-groupmenu-ztree";
		var zTree = $.fn.zTree.getZTreeObj(treeId);
		// 因为节点的 name 值是变化的,所以通过 tId 判断是否修改节点
		var treeNode = zTree.getNodeByTId($('#tId').val());
		if(treeNode){
			// 修改节点
			removeHoverDom(treeId, treeNode);
			treeNode.id = json.id;
			treeNode.name = $('#name').val();
			zTree.updateNode(treeNode);
		}else{
			// 增加节点
			var parentNode = zTree.getNodeByParam("id", $('#pid').val(), null);
			var newNode = {id:json.id, name:$('#name').val()};
			if(parentNode){
			    zTree.addNodes(parentNode, newNode);
			}else{
			    zTree.addNodes(null, newNode);
			}
		}
    }
}
function ZtreeClick(event, treeId, treeNode) {
    if (treeNode.isParent) {
        var zTree = $.fn.zTree.getZTreeObj(treeId)
        zTree.expandNode(treeNode)
        return
    }
    event.preventDefault()
}
function addHoverDom(treeId, treeNode) {
	var aObj = $("#" + treeNode.tId + "_a");
	if ($("#groupMenu_add_"+treeNode.id).length>0) return;
	if ($("#groupMenu_edit_"+treeNode.id).length>0) return;
	if ($("#groupMenu_del_"+treeNode.id).length>0) return;
	var editStr = "<i>";
	if(treeNode.level<=1){
		 editStr =  editStr + "<span title='添加' id='groupMenu_add_" +treeNode.id+ "' class='tree_add' > </span>"
	}
	editStr =  editStr + "<span title='修改' id='groupMenu_edit_" +treeNode.id+ "' class='button edit' > </span>"
	if(!treeNode.isParent){
		editStr =  editStr + "<span title='删除' id='groupMenu_del_" +treeNode.id+ "' class='tree_del' > </span>";
	}
	aObj.append(editStr + "</i>");
	$("#groupMenu_add_"+treeNode.id).bind("click", function(){
		 $(this).dialog({id:'core-menu-view', url:'<?= Url::toRoute(['view']) ?>&tId='+treeNode.tId+'&group_id=<?= Yii::$app->request->get('group_id') ?>&pid='+treeNode.id+'&id=', title:'增加节点'});
	});
	$("#groupMenu_edit_"+treeNode.id).bind("click", function(){
		 $(this).dialog({id:'core-menu-view', url:'<?= Url::toRoute(['view']) ?>&tId='+treeNode.tId+'&id='+treeNode.id, title:'修改节点'});
	});
	$("#groupMenu_del_"+treeNode.id).bind("click", function(){
        $(this).alertmsg('confirm', '确定要删除 '+treeNode.name+' 节点吗？', {okCall:function(){
            $(this).bjuiajax('doAjax', {type:'post', url:'<?= Url::toRoute(['delete']) ?>&id='+treeNode.id, data:{_csrf:'<?= Yii::$app->request->csrfToken ?>'}, callback:function(json){
            	$(this).bjuiajax('ajaxDone', json);
            	if(json.statusCode == 200){
         		   // 删除 Ztree 节点
            		var zTree = $.fn.zTree.getZTreeObj(treeId);
            		zTree.removeNode(treeNode);
            	}
            }});
        }});
	});
};
function removeHoverDom(treeId, treeNode) {
	$("#groupMenu_add_"+treeNode.id).parent().remove();
	$("#groupMenu_add_"+treeNode.id).unbind().remove();
	$("#groupMenu_edit_"+treeNode.id).unbind().remove();
	$("#groupMenu_del_" +treeNode.id).unbind().remove();
};
</script>
<div class="bjui-pageHeader">
    <a href="<?= Url::toRoute(['view', 'group_id'=>Yii::$app->request->get('group_id'), 'pid'=>Yii::$app->request->get('id'), 'id'=>'']) ?>" class="btn btn-green" data-toggle="dialog" data-id="core-menu-view" data-title="增加主节点" data-reload-warn="本页已有打开的内容，确定将刷新本页内容，是否继续？">增加主节点</a>
</div>
<div class="bjui-pageContent">
    <ul id="core-menu-groupmenu-ztree" class="ztree" data-toggle="ztree" data-options="{
            expandAll: false,
            onClick: 'ZtreeClick',
            addHoverDom: 'addHoverDom',
            removeHoverDom: 'removeHoverDom'
        }">
        <?php
        foreach ($models as $model) {
            echo '<li data-id="' . $model->id . '" data-pid="' . $model->pid . '" data-faicon="' . $model->faicon . '" data-open="' . $model->open . '">' . $model->name . '</li>';
        }
        ?>
    </ul>
</div>