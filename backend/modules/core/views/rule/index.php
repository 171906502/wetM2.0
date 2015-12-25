<?php use yii\helpers\Url; ?>
<div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="<?= Url::toRoute('index') ?>" method="get">
        <input type="hidden" name="pageSize" value="10">
        <input type="hidden" name="pageCurrent" value="1">
        <input type="hidden" name="orderField" value="created_at">
        <input type="hidden" name="orderDirection" value="desc">
        <div class="bjui-searchBar">
            <label>规则名称：</label>
            <input type="text" value="<?= Yii::$app->request->get('name') ?>" name="name" class="form-control" size="8">
            <button type="submit" class="btn-default" data-icon="search"><?php echo Yii::t('app','query')?></button>
            <a class="btn btn-orange" href="javascript:;" onclick="$(this).navtab('reloadForm', true);" data-icon="undo">清空查询</a>
            <a href="<?= Url::toRoute(['view','name'=>'']) ?>" class="btn btn-green" data-toggle="dialog" data-id="core-user-view" data-title="增加规则" data-reload-warn="本页已有打开的内容，确定将刷新本页内容，是否继续？">增加规则</a>
            <div class="pull-right">
                <div class="btn-group">
                    <button type="button" class="btn-default dropdown-toggle" data-toggle="dropdown" data-icon="copy">
                        复选框-批量操作<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu right" role="menu">
                        <li class="divider"></li>
                        <li>
                            <a href="<?= Url::toRoute('batch-delete'); ?>" data-toggle="doajaxchecked" data-confirm-msg="确定要删除选中项吗？" data-idname="delids" data-group="ids" data-data="_csrf=<?= Yii::$app->request->csrfToken ?>">删除选中</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="bjui-pageContent tableContent">
    <table data-toggle="tablefixed" data-width="100%" data-nowrap="true">
        <thead>
            <tr>
                <th align="center">规则名称</th>
                <th align="center">规则路径</th>
                <th align="center" data-order-direction="desc" data-order-field="created_at">创建时间</th>
                <th align="center">更新时间</th>
                <th align="center" width="26"><input type="checkbox" class="checkboxCtrl" data-group="ids" data-toggle="icheck"></th>
                <th align="center" width="100">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($models as $key=>$model) {?>
            <tr data-id="<?= $model->name ?>">
                <td><?= $model->name ?></td>
                <td><?= $model::className() ?></td>
                <td><?= date('Y-m-d H:i:s',$model->createdAt) ?></td>
                <td><?= date('Y-m-d H:i:s',$model->updatedAt) ?></td>
                <td align="center">
                    <input type="checkbox" name="ids" data-toggle="icheck" value="<?= $model->name ?>">
                </td>
                <td>
                    <a href="<?= Url::toRoute(['view', 'name' => $model->name]) ?>" class="btn btn-green" data-toggle="dialog" data-id="core-user-view" data-title="编辑规则-<?= $model->name ?>" data-reload-warn="本页已有打开的内容，确定将刷新本页内容，是否继续？">编辑</a>
                    <a href="<?= Url::toRoute(['delete', 'name' => $model->name]) ?>" class="btn btn-red" data-toggle="doajax" data-data="_csrf=<?= Yii::$app->request->csrfToken ?>" data-confirm-msg="确定要删除该规则吗？">删</a>
                </td>
            </tr>
            <?php }?>
    </tbody>
    </table>
</div>
<div class="bjui-pageFooter">
    <div class="pages">
        <span>每页&nbsp;</span>
        <div class="selectPagesize">
            <select data-toggle="selectpicker" data-toggle-change="changepagesize">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <span>&nbsp;条，共 <?= count($models) ?> 条</span>
    </div>
    <div class="pagination-box" data-toggle="pagination" data-total="<?= count($models) ?>" data-page-size="10" data-page-current="1"></div>
</div>
