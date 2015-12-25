<?php
use yii\helpers\Url;
?>
<div class="bjui-pageContent">
    <form action="<?= Url::toRoute([$model->name?'update':'create','name'=>$model->name]) ?>" id="core-permission-view-form" data-toggle="validate" data-alertmsg="false" data-callback="myCallback">
        <input type="hidden" id="parent" name="parent" value="<?= Yii::$app->request->get('parent')?>">
        <input type="hidden" name="type" value="<?= $model->type; ?>">
        <input type="hidden" id="tId" value="<?= $model->name?Yii::$app->request->get('tId'):'' ?>">
        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <table class="table table-condensed table-hover" width="100%">
            <tbody>
                <tr>
                    <td><label for="name" class="control-label x120">许可名称：</label> <input type="text" name="name" id="name" value="<?= $model->name; ?>" data-rule="required" size="15"></td>
                </tr>
                <tr>
                    <td><label for="description" class="control-label x120">许可描述：</label> <input type="text" name="description" id="description" value="<?= $model->description; ?>" data-rule="" size="15"></td>
                </tr>
                <tr>
                    <td><label for="ruleName" class="control-label x120">规则名称：</label> <input type="text" name="ruleName" id="ruleName" value="<?= $model->ruleName; ?>" data-rule="" size="20"></td>
                </tr>
                <tr>
                    <td><label for="data" class="control-label x120">规则内容：</label> <input type="text" name="data" id="data" value="<?= $model->data; ?>" data-rule="" size="20"></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li>
            <button type="button" class="btn-close" data-icon="close">取消</button>
        </li>
        <li>
            <button type="submit" class="btn-default" data-icon="save">保存</button>
        </li>
    </ul>
</div>
