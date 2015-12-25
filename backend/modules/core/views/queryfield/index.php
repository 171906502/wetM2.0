<?php use yii\helpers\Url; ?>
<script type="text/javascript">
    function do_open_layout(event, treeId, treeNode) {
        if(treeNode.menutype != 'dropdown'){
            $(event.target).bjuiajax('doLoad', {url:'<?= Url::toRoute('group-menu')?>&group_id='+treeNode.id, target:'#core-queryfield-groupmenu'})
            event.preventDefault()
        }
    }
</script>
<div class="bjui-pageContent">
    <div style="float: left; width: 180px; height: 99.9%; overflow: auto;">
        <ul id="core-queryfield-index-ztree" class="ztree" data-toggle="ztree" data-options="{
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
            <li class="active"><a href="#core-queryfield-groupmenu" role="tab" data-toggle="tab">菜单栏</a></li>
        </ul>
        <!-- 选项卡窗格 -->
        <div class="tab-content">
            <div id="core-queryfield-groupmenu" class="tab-pane fade active in"></div>
        </div>
    </div>
</div>