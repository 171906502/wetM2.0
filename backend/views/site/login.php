<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\assets\AppAsset;
AppAsset::register($this);
$baseUrl = $this->assetBundles[AppAsset::className()]->baseUrl . '/';

?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<title>系统登录</title>
<?php $this->head()?>
<style type="text/css">
* {
	font-family: "Verdana", "Tahoma", "Lucida Grande", "Microsoft YaHei",
		"Hiragino Sans GB", sans-serif;
}

body {
	background: url(images/loginbg_01.jpg) no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}

a:link {
	color: #285e8e;
}

.main_box {
	position: absolute;
	top: 50%;
	left: 50%;
	margin-top: -260px;
	margin-left: -300px;
	padding: 30px;
	width: 600px;
	height: 460px;
	background: #FAFAFA;
	background: rgba(255, 255, 255, 0.5);
	border: 1px #DDD solid;
	border-radius: 5px;
	-webkit-box-shadow: 1px 5px 8px #888888;
	-moz-box-shadow: 1px 5px 8px #888888;
	box-shadow: 1px 5px 8px #888888;
}

.main_box .setting {
	position: absolute;
	top: 5px;
	right: 10px;
	width: 10px;
	height: 10px;
}

.main_box .setting a {
	color: #FF6600;
}

.main_box .setting a:hover {
	color: #555;
}

.login_logo {
	margin-bottom: 20px;
	height: 45px;
	text-align: center;
}

.login_logo img {
	height: 45px;
}

.login_msg {
	text-align: center;
	font-size: 16px;
}

.login_form {
	padding-top: 20px;
	font-size: 16px;
}

.login_box .form-control {
	display: inline-block;
	*display: inline;
	zoom: 1;
	width: auto;
	font-size: 18px;
}

.login_box .form-control.x319 {
	width: 319px;
}

.login_box .form-control.x164 {
	width: 164px;
}

.login_box .form-group {
	margin-bottom: 20px;
}

.login_box .form-group label.t {
	width: 120px;
	text-align: right;
	cursor: pointer;
}
.login_box .checkbox {
    margin-left: 120px;
}
.login_box .m {
	cursor: pointer;
}

.login_box .form-group.space {
	padding-top: 15px;
	border-top: 1px #FFF dotted;
}

.login_box .form-group p {
	margin-left: 120px;	
}
.login_box .form-group img {
	margin-top: 1px;
	height: 32px;
	vertical-align: top;
}


.bottom {
	text-align: center;
	font-size: 12px;
}
</style>
</head>
<body>
<?php $this->beginBody()?>
<!--[if lte IE 7]>
<style type="text/css">
#errorie {position: fixed; top: 0; z-index: 100000; height: 30px; background: #FCF8E3;}
#errorie div {width: 900px; margin: 0 auto; line-height: 30px; color: orange; font-size: 14px; text-align: center;}
#errorie div a {color: #459f79;font-size: 14px;}
#errorie div a:hover {text-decoration: underline;}
</style>
<div id="errorie"><div>您还在使用老掉牙的IE，请升级您的浏览器到 IE8以上版本 <a target="_blank" href="http://windows.microsoft.com/zh-cn/internet-explorer/ie-8-worldwide-languages">点击升级</a>&nbsp;&nbsp;强烈建议您更改换浏览器：<a href="http://down.tech.sina.com.cn/content/40975.html" target="_blank">谷歌 Chrome</a></div></div>
<![endif]-->
	<div class="main_box">
		<div class="setting">
			<a href="javascript:;" onclick="choose_bg();" title="更换背景"><span
				class="glyphicon glyphicon-th-large"></span></a>
		</div>
		<div class="login_box">
			<div class="login_logo">
				<img src="images/logo.png">
			</div>
			<div class="login_form">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username')->textInput(['class'=>'form-control x319 in input-nm'])->label('用户名',['class'=>'t'])?>
                <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control x319 in input-nm'])->label('密　码',['class'=>'t'])?>
                <?= $form->field($model, 'rememberMe')->checkbox()->label('记住我的登陆状态',['class'=>'t m'])?>
				<div class="form-group space">
					<label class="t"></label>
                    <?= Html::submitButton('&nbsp;登&nbsp;录&nbsp;', ['class' => 'btn btn-primary btn-lg'])?>
                    <?= Html::resetButton('&nbsp;重&nbsp;置&nbsp;', ['class' => 'btn btn-default btn-lg'])?>
                </div>
            <?php ActiveForm::end(); ?>
            </div>
		</div>
		<div class="bottom">
			Copyright &copy; 2015 - 2016 <a href="http://www.yiichina.com">Yii2开发团队</a>
		</div>
	</div>
<?php $this->endBody()?>
<script type="text/javascript">
$(function() {
    choose_bg();
});
function choose_bg() {
	var bg = Math.floor(Math.random() * 9 + 1);
	$('body').css('background-image', 'url(images/loginbg_0'+ bg +'.jpg)');
}
</script>
</body>
</html>
<?php $this->endPage()?>
