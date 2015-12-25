<?php use yii\helpers\Url; ?>
<script type="text/javascript">
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
    if(treeNode.level<=2){
        editStr =  editStr + "<span title='编辑数据库表' id='groupMenu_add_" +treeNode.id+ "' class='tree_add' > </span>"
    }
	editStr =  editStr + "<span title='修改' id='groupMenu_edit_" +treeNode.id+ "' class='button edit' > </span>"
	aObj.append(editStr + "</i>");
    $("#groupMenu_add_"+treeNode.id).bind("click", function(){
        $(this).dialog({id:'core-queryfield-tbview',width:800,height:600, url:'<?= Url::toRoute(['tbview']) ?>&tId='+treeNode.tId+'&menuId='+treeNode.id,title:'编辑数据库表'});
    });
	$("#groupMenu_edit_"+treeNode.id).bind("click", function(){
		 $(this).dialog({id:'core-queryfield-view',width:1200,height:600, url:'<?= Url::toRoute(['view']) ?>&tId='+treeNode.tId+'&menuId='+treeNode.id, title:'当前--'+treeNode.name});
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
</div>
<div class="bjui-pageContent">
    <ul id="core-queryfield-ztree" class="ztree" data-toggle="ztree" data-options="{
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