<?php
use yii\helpers\Url;
?>
<div class="bjui-pageContent">
    <form action="<?= Url::toRoute([$model?'update':'create','name'=>$model?$model->name:'']) ?>" id="user_form" data-toggle="validate" data-alertmsg="false">
        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <table class="table table-condensed table-hover" width="100%">
            <tbody>
                <tr>
                    <td><label for="name" class="control-label x120">规则名称：</label> <input type="text" name="name" id="name" value="<?= $model?$model->name:''; ?>" data-rule="required" size="20"></td>
                </tr>
                <tr>
                    <td><label for="class" class="control-label x120">规则类名：</label> <input type="text" name="class" id="class" value="<?= $model?$model::className():''; ?>" data-rule="required" size="35"></td>
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
