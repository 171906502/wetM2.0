<?php
use yii\helpers\Url;
?>
<div class="bjui-pageContent">
    <form action="<?= Url::toRoute('site/ajax-login') ?>" data-toggle="validate" method="post">
        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <div class="form-group">
            <label for="j_pwschange_oldpassword" class="control-label x85">用户名：</label>
            <input type="text" data-rule="required" name="LoginForm[username]" value="" placeholder="用户名" size="20">
        </div>
        <div class="form-group">
            <label for="j_pwschange_oldpassword" class="control-label x85">密码：</label>
            <input type="password" data-rule="required" name="LoginForm[password]" value="" placeholder="密码" size="20">
        </div>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close">取消</button></li>
        <li><button type="submit" class="btn-default">提交</button></li>
    </ul>
</div>