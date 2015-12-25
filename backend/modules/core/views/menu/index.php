<?php use yii\helpers\Url; ?>
<script type="text/javascript">
function do_open_layout(event, treeId, treeNode) {
	if(treeNode.menutype != 'dropdown'){
        $(event.target).bjuiajax('doLoad', {url:'<?= Url::toRoute('group-menu')?>&group_id='+treeNode.id, target:'#core-menu-groupmenu'})
        event.preventDefault()
	}
}
</script>
<div class="bjui-pageContent">
    <div style="float: left; width: 180px; height: 99.9%; overflow: auto;">
        <ul id="core-menu-index-ztree" class="ztree" data-toggle="ztree" data-options="{
            expandAll: true,
            onClick: 'do_open_layout',
            maxAddLevel: 1
        }">
        <?php
        foreach ($models as $model) {
            echo '<li data-id="' . $model->id . '" data-menutype="' . $model->menu_type . '" data-pid="' . $model->pid . '" data-faicon="' . $model->faicon . '" data-faicon-close="' . $model->faicon_close . '" data-open="' . $model->open . '">' . $model->name . '</li>';
        }
        ?>
        </ul>
    </div>
    <div style="margin-left: 190px; height: 99.9%; overflow: auto;">
        <!-- 选项卡 -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#core-menu-groupmenu" role="tab" data-toggle="tab">导航栏</a></li>
            <li><a href="#core-menu-help" role="tab" data-toggle="tab">帮助</a></li>
        </ul>
        <!-- 选项卡窗格 -->
        <div class="tab-content">
            <div id="core-menu-groupmenu" class="tab-pane fade active in"></div>
            <div id="core-menu-help" class="tab-pane fade">
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