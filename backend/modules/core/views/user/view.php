<?php
use yii\helpers\Url;
?>
<div class="bjui-pageContent">
    <form action="<?= Url::toRoute([$model->id?'update':'create','id'=>$model->id]) ?>" id="user_form" data-toggle="validate" data-alertmsg="false">
        <input type="hidden" name="id" value="<?= $model->id; ?>">
        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <table class="table table-condensed table-hover" width="100%">
            <tbody>
                <tr>
                    <td>
                        <label for="username" class="control-label x120">用户名：</label>
                        <input type="text" name="username" id="username" value="<?= $model->username; ?>" data-rule="required" size="15">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password_reset" class="control-label x120">密码：</label>
                        <input type="checkbox" name="password_reset" id="password_reset" data-toggle="icheck" <?= $model->id?'':' checked' ?> data-label="设置为初始密码123456">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="email" class="control-label x120">电子邮箱：</label>
                        <input type="text" name="email" id="email" value="<?= $model->email; ?>" data-rule="required;email" size="20">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="status" class="control-label x120">用户状态：</label>
                        <select name="status" id="status" data-toggle="selectpicker" data-rule="required">
                            <option value="10">正常</option>
                            <option value="0">删除</option>
                        </select>
                    </td>
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
