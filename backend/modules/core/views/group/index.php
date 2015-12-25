<?php use yii\helpers\Url; ?>
<script type="text/javascript">
function myCallback(json) {
	$(this).bjuiajax('ajaxDone', json);
    if(json.statusCode == 200){
    	$(this).dialog('closeCurrent');
		// 增加修改 Ztree 节点
    	var treeId = "core-group-index-ztree";
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
	if ($("#diyBtn_add_"+treeNode.id).length>0) return;
	if ($("#diyBtn_edit_"+treeNode.id).length>0) return;
	if ($("#diyBtn_del_"+treeNode.id).length>0) return;
	var editStr = "<i>";
	if(treeNode.level<=1){
		 editStr =  editStr + "<span title='添加' id='diyBtn_add_" +treeNode.id+ "' class='tree_add' > </span>"
	}
	editStr =  editStr + "<span title='修改' id='diyBtn_edit_" +treeNode.id+ "' class='button edit' > </span>"
	if(!treeNode.isParent){
		editStr =  editStr + "<span title='删除' id='diyBtn_del_" +treeNode.id+ "' class='tree_del' > </span>";
	}
	aObj.append(editStr + "</i>");
	$("#diyBtn_add_"+treeNode.id).bind("click", function(){
		 $(this).dialog({id:'core-group-view', url:'<?= Url::toRoute(['view']) ?>&tId='+treeNode.tId+'&pid='+treeNode.id+'&id=', title:'增加节点'});
	});
	$("#diyBtn_edit_"+treeNode.id).bind("click", function(){
		 $(this).dialog({id:'core-group-view', url:'<?= Url::toRoute(['view']) ?>&tId='+treeNode.tId+'&id='+treeNode.id, title:'修改节点'});
	});
	$("#diyBtn_del_"+treeNode.id).bind("click", function(){
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
	$("#diyBtn_add_"+treeNode.id).parent().remove();
	$("#diyBtn_add_"+treeNode.id).unbind().remove();
	$("#diyBtn_edit_"+treeNode.id).unbind().remove();
	$("#diyBtn_del_" +treeNode.id).unbind().remove();
};
</script>
<div class="bjui-pageHeader">
    <a href="<?= Url::toRoute(['view','pid'=>Yii::$app->request->get('id'), 'id'=>'']) ?>" class="btn btn-green" data-toggle="dialog" data-id="core-group-view" data-title="增加主节点" data-reload-warn="本页已有打开的内容，确定将刷新本页内容，是否继续？">增加主节点</a>
</div>
<div class="bjui-pageContent">
    <div style="float: left; width: 250px; height: 99.9%; overflow: auto;">
        <ul id="core-group-index-ztree" class="ztree" data-toggle="ztree" data-options="{
            expandAll: false,
            onClick: 'ZtreeClick',
            addHoverDom: 'addHoverDom',
            removeHoverDom: 'removeHoverDom'
        }">
        <?php
        foreach ($models as $model) {
            echo '<li data-id="' . $model->id . '" data-pid="' . $model->pid . '" data-faicon="' . $model->faicon . '" data-faicon-close="" data-open="' . $model->open . '">' . $model->name . '</li>';
        }
        ?>
        </ul>
    </div>
    <div style="margin-left: 260px; height: 99.9%; overflow: auto;">
        <!-- 选项卡 -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#group-help" role="tab" data-toggle="tab">帮助</a></li>
        </ul>
        <!-- 选项卡窗格 -->
        <div class="tab-content">
            <div id="group-help" class="tab-pane fade active in">
                <h5>1 增加主节点</h5>
                <ol>
                    <li>点击左上角的
                        <button class="btn-green">增加主节点</button> 按钮
                    </li>
                </ol>
                <h5>2 增加子节点</h5>
                <ol>
                    <li>鼠标移动到需要增加子节点的节点上,点击右侧出现的 <i class="fa fa-plus"></i> 按钮
                    </li>
                    <li>三级节点不允许再增加子节点</li>
                </ol>
                <h5>3 编辑节点</h5>
                <ol>
                    <li>鼠标移动到需要编辑的子节点上,点击右侧出现的 <i class="fa fa-pencil"></i> 按钮
                    </li>
                </ol>
                <h5>3 删除节点</h5>
                <ol>
                    <li>鼠标移动到需要删除的节点上,点击右侧出现的 <i class="fa fa-trash"></i> 按钮
                    </li>
                    <li>删除父节点必须先删除其下的所有子节点</li>
                </ol>
            </div>
        </div>
    </div>
</div>