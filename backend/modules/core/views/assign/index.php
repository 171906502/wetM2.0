<?php use yii\helpers\Url; ?>
<script type="text/javascript">
function do_open_layout(event, treeId, treeNode) {
    $(event.target).bjuiajax('doLoad', {url:'<?= Url::toRoute('permissions')?>&name='+treeNode.id, target:'#core-assign-permissions'})
    event.preventDefault()
}
</script>
<div class="bjui-pageContent">
    <div style="float: left; width: 250px;">
        <ul id="core-assign-index-ztree" class="ztree" data-toggle="ztree" data-options="{
            expandAll: true,
            onClick: 'do_open_layout',
            maxAddLevel: 5
        }">
        <?php
        foreach ($models as $key => $model) {
            echo '<li data-id="' . $model['name'] . '" data-pid="' . $model['parent'] . '">' . $model['description'] . '</li>';
        }
        ?>
        </ul>
    </div>
    <div style="margin-left: 260px; height: 99.9%; overflow: auto;">
        <!-- 选项卡 -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#core-assign-permissions" role="tab" data-toggle="tab">许可授权</a></li>
            <li><a href="#assign-help" role="tab" data-toggle="tab">帮助</a></li>
        </ul>
        <!-- 选项卡窗格 -->
        <div class="tab-content">
            <div id="core-assign-permissions" class="tab-pane fade active in"></div>
            <div id="assign-help" class="tab-pane fade">
                <h5>1 使用前提</h5>
                <ol>
                    <li>1.1 在角色管理中添加好角色</li>
                    <li>1.2 在许可管理中添加好许可</li>
                    <li>1.3 将规则应用到对应的许可上</li>
                </ol>
                <h5>2 使用说明</h5>
                <ol>
                    <li>2.1 授权时请从末端子节点开始授权</li>
                    <li>2.2 父节点会自动继承子节点的权限</li>
                </ol>
                <h5>3 使用技巧</h5>
                <ol>
                    <li>3.1 勾选许可的父节点可以同时获取子节点的所有权限</li>
                    <li>3.2 增加角色拥有的权限可以点击权限对应的勾选框</li>
                    <li>3.2 取消角色拥有的权限可以再次点击勾选框</li>
                </ol>
            </div>
        </div>
    </div>
</div>