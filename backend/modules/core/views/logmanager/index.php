<?php use yii\helpers\Url; ?>
<div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="<?= Url::toRoute('index') ?>" method="get">
        <input type="hidden" name="pageSize" value="10">
        <input type="hidden" name="pageCurrent" value="1">
        <input type="hidden" name="orderField" value="created_at">
        <input type="hidden" name="orderDirection" value="desc">
        <div class="bjui-searchBar">
        </div>
    </form>
</div>
<div class="bjui-pageContent tableContent">
    <table data-toggle="tablefixed" data-width="100%">
        <thead>
        <tr>
            <th align="center" data-order-field="id" width="50">id</th>
            <th align="center">日志内容</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $model) {?>
            <tr data-id="<?= $model['id'] ?>">
                <td ><?= $model['id'] ?></td>
                <td ><?= $model['data'] ?></td>
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
        <span>&nbsp;条，共 <?= $pages->totalCount ?> 条</span>
    </div>
    <div class="pagination-box" data-toggle="pagination" data-total="<?= $pages->totalCount ?>" data-page-size="<?= $pages->pageSize ?>" data-page-current="1"></div>
</div>
