<?php
use yii\helpers\Url;
?>
<div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="<?= Url::toRoute('datagrid') ?>" method="get">
        <input type="hidden" name="pageSize" value="1">
        <input type="hidden" name="pageCurrent" value="1">
        <input type="hidden" name="orderField" value="created_at">
        <input type="hidden" name="orderDirection" value="desc">
        <div class="bjui-searchBar">
            <?php include 'TplSearchbar.php'?>
            <button type="button" class="showMoreSearch" data-toggle="moresearch" data-name="custom2">
                <i class="fa fa-angle-double-down"></i>
            </button>
            <button type="submit" class="btn-default" data-icon="search">查询</button>
            &nbsp;
            <a class="btn btn-orange" href="javascript:;" onclick="$(this).navtab('reloadForm', true);" data-icon="undo">清空查询</a>
            &nbsp;
            <a href="<?= Url::toRoute(['view','id'=>0]) ?>" class="btn btn-green" data-toggle="dialog" data-id="core-user-view" data-title="增加用户" data-reload-warn="本页已有打开的内容，确定将刷新本页内容，是否继续？">增加用户</a>
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
        <div class="bjui-moreSearch">
            <label>用户ID：</label>
            <input type="text" value="<?= Yii::$app->request->get('id') ?>" name="id" data-rule="number" class="form-control" size="10">
            <label>&nbsp;状态:</label>
            <select name="status" data-toggle="selectpicker">
                <option value="">全部</option>
                <option value="10">正常</option>
                <option value="0">删除</option>
            </select>
        </div>
    </form>
</div>
<div class="bjui-pageContent tableContent">
    <table data-toggle="tablefixed" data-width="100%" data-nowrap="true">
        <thead>
        <?php include "TplThead.php"?>
        </thead>
        <tbody>
        <?php include "TplTBody.php"?>
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
