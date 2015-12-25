<?php
/**
 * Created by PhpStorm.
 * User: cntway
 * Date: 2015/11/5
 * Time: 17:10
 */
?>
<label>用户名：</label>
<input type="text" value="<?= Yii::$app->request->get('username') ?>" name="username" class="form-control" size="8">
<label>电子邮件：</label>
<input type="text" value="<?= Yii::$app->request->get('email') ?>" name="email" data-rule="email" size="15" />
<label>手机:</label>
<input type="text" value="<?= Yii::$app->request->get('mobile') ?>" name="mobile" data-rule="mobile" size="10">
&nbsp;
<input type="checkbox" id="j_table_chk" value="true" data-toggle="icheck" data-label="我的客户">
&nbsp;