<?php
use yii\helpers\Url;
$this->title = '交易系统管理后台';
?>
<!--[if lte IE 7]>
<div id="errorie"><div>您还在使用老掉牙的IE，正常使用系统前请升级您的浏览器到 IE8以上版本 <a target="_blank" href="http://windows.microsoft.com/zh-cn/internet-explorer/ie-8-worldwide-languages">点击升级</a>&nbsp;&nbsp;强烈建议您更改换浏览器：<a href="http://down.tech.sina.com.cn/content/40975.html" target="_blank">谷歌 Chrome</a></div></div>
<![endif]-->
<script type="text/javascript">
function logout(json) {
	if(json.statusCode == 200){
		$(this).alertmsg('ok', '两秒后自动返回登录页', {displayMode:'slide', title:'注销成功'});
		setTimeout("location.href = '<?= Url::toRoute('site/login') ?>';",2000);
	}else{
		$(this).alertmsg('error', '请联系系统管理员', {displayMode:'slide', title:'注销失败'});
	}
}
</script>
<div id="bjui-window">
    <header id="bjui-header">
        <div class="bjui-navbar-header">
            <button type="button" class="bjui-navbar-toggle btn-default" data-toggle="collapse" data-target="#bjui-navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="bjui-navbar-logo" href="/">
                <img src="images/logo.png">
            </a>
        </div>
        <nav id="bjui-navbar-collapse">
            <ul class="bjui-navbar-right">
                <li class="datetime">
                    <div>
                        <span id="bjui-date"></span>
                        <span id="bjui-clock"></span>
                    </div>
                </li>
                <li>
                    <a href="javascript:void(0);">
                        消息
                        <span class="badge">4</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        我的账户
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="changepwd.html" data-toggle="dialog" data-id="changepwd_page" data-mask="true" data-width="400" data-height="260">
                                &nbsp;
                                <span class="glyphicon glyphicon-lock"></span>
                                修改密码&nbsp;
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                &nbsp;
                                <span class="glyphicon glyphicon-user"></span>
                                我的资料
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo Url::toRoute('site/logout') ?>" data-toggle="doajax" data-callback="logout" data-data="_csrf=<?= Yii::$app->request->csrfToken ?>" class="red">
                                &nbsp;
                                <span class="glyphicon glyphicon-off"></span>
                                注销登陆
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle theme blue" data-toggle="dropdown" title="切换皮肤">
                        <i class="fa fa-tree"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu" id="bjui-themes">
                        <li>
                            <a href="javascript:void(0);" class="theme_default" data-toggle="theme" data-theme="default">
                                &nbsp;
                                <i class="fa fa-tree"></i>
                                黑白分明&nbsp;&nbsp;
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="theme_orange" data-toggle="theme" data-theme="orange">
                                &nbsp;
                                <i class="fa fa-tree"></i>
                                橘子红了
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="theme_purple" data-toggle="theme" data-theme="purple">
                                &nbsp;
                                <i class="fa fa-tree"></i>
                                紫罗兰
                            </a>
                        </li>
                        <li class="active">
                            <a href="javascript:void(0);" class="theme_blue" data-toggle="theme" data-theme="blue">
                                &nbsp;
                                <i class="fa fa-tree"></i>
                                天空蓝
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="theme_green" data-toggle="theme" data-theme="green">
                                &nbsp;
                                <i class="fa fa-tree"></i>
                                绿草如茵
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="bjui-hnav">
            <button type="button" class="btn-default bjui-hnav-more-left" title="导航菜单左移">
                <i class="fa fa-angle-double-left"></i>
            </button>
            <div id="bjui-hnav-navbar-box">
                <ul id="bjui-hnav-navbar">
                    <?
                    foreach ($models as $key => $model) {
                        if ($model->menu_type == 'ztree') {
                            ?>
                    <li <?= $key?'':' class="active"' ?>>
                        <a href="javascript:void(0);" data-toggle="slidebar">
                            <i class="fa fa-<?= $model->faicon?>"></i> <?= $model->name?></a>
                        <div class="items hide" data-noinit="true">
                         <?
                            if ($model->groups) {
                                foreach ($model->groups as $item) {
                                    $isAccess = $authManager->checkAccess($user->getId(), $item->name);
                                    if(!$isAccess){
                                        $isGropAccess =false;
                                        foreach ($item->menus as $menu) {
                                            $isAccess = $authManager->checkAccess($user->getId(), $menu->name);
                                            if($isAccess){
                                                $isGropAccess=true;
                                            }
                                        }
                                        if(!$isGropAccess){
                                            continue;
                                        }
                                    }
                                    ?>
                            <ul id="bjui-doc-tree-base<?= $item->id ?>" class="ztree ztree_main" data-toggle="ztree" data-on-click="MainMenuClick" data-expand-all="true" data-faicon="<?= $item->faicon ?>" data-tit="<?= $item->name ?>">
                                <? foreach ($item->menus as $menu) {
                                    $isAccess = $authManager->checkAccess($user->getId(), $menu->name);
                                    if(!$isAccess){
                                       continue;
                                    }
                                    ?>
                                <li data-id="<?= $menu->id ?>" data-pid="<?= $menu->pid ?>" data-url="<?= Url::toRoute($menu->url) ?>" data-tabid="<?= $menu->tabid ?>" data-target="<?= $menu->target ?>" data-faicon="<?= $menu->faicon ?>" data-faicon-close="<?= $menu->faicon_close ?>"><?= $menu->name ?></li>
                                 <? } ?>
                            </ul>
                            <?
                                }
                            } else {
                                ?>
                             <ul id="bjui-doc-tree-base<?= $model->id ?>" class="ztree ztree_main" data-toggle="ztree" data-on-click="MainMenuClick" data-expand-all="true" data-faicon="<?= $model->faicon ?>" data-tit="<?= $model->name ?>">
                                 <? foreach ($model->menus as $menu) { ?>
                                 <li data-id="<?= $menu->id ?>" data-pid="<?= $menu->pid ?>" data-url="<?= Url::toRoute($menu->url) ?>" data-tabid="<?= $menu->tabid ?>" data-target="<?= $menu->target ?>" data-faicon="<?= $menu->faicon ?>" data-faicon-close="<?= $menu->faicon_close ?>"><?= $menu->name ?></li>
                                  <? } ?>
                             </ul>
                             <? } ?>
                        </div>
                    </li>
                    <?} else {?>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-<?= $model->faicon?>"></i>
                            <?= $model->name?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                        <?php
                            foreach ($model->groups as $item) {
                                if ($item->target == 'navtab') {
                                    echo '<li><a href="' . Url::toRoute($item->url) . '" data-toggle="navtab" data-id="group-' . $item->id . '" data-title="' . $item->name . '">' . $item->name . '</a></li>';
                                } elseif ($item->target == 'dialog') {
                                    echo '<li><a href="' . Url::toRoute($item->url) . '" data-toggle="dialog" data-width="' . $item->width . '" data-height="' . $item->height . '" data-id="group-' . $item->id . '" data-mask="' . $item->mask . '">' . $item->name . '</a></li>';
                                } else {
                                    echo '<li><a href="' . $item->url . '" target="_blank">' . $item->name . '</a></li>';
                                }
                            }
                            ?>
                            <li class="divider"></li>
                        </ul>
                    </li>
                    <?
                        }
                    }
                    ?>
                    

                </ul>
            </div>
            <button type="button" class="btn-default bjui-hnav-more-right" title="导航菜单右移">
                <i class="fa fa-angle-double-right"></i>
            </button>
        </div>
    </header>
    <div id="bjui-container">
        <div id="bjui-leftside">
            <div id="bjui-sidebar-s">
                <div class="collapse"></div>
            </div>
            <div id="bjui-sidebar">
                <div class="toggleCollapse">
                    <h2>
                        <i class="fa fa-bars"></i>
                        导航栏
                        <i class="fa fa-bars"></i>
                    </h2>
                    <a href="javascript:void(0);" class="lock">
                        <i class="fa fa-lock"></i>
                    </a>
                </div>
                <div class="panel-group panel-main" data-toggle="accordion" id="bjui-accordionmenu" data-heightbox="#bjui-sidebar" data-offsety="26"></div>
            </div>
        </div>
        <div id="bjui-navtab" class="tabsPage">
            <div class="tabsPageHeader">
                <div class="tabsPageHeaderContent">
                    <ul class="navtab-tab nav nav-tabs">
                        <li data-url="<?php echo Url::toRoute('site/layout') ?>">
                            <a href="javascript:void(0);">
                                <span>
                                    <i class="fa fa-home"></i>
                                    #maintab#
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tabsLeft">
                    <i class="fa fa-angle-double-left"></i>
                </div>
                <div class="tabsRight">
                    <i class="fa fa-angle-double-right"></i>
                </div>
                <div class="tabsMore">
                    <i class="fa fa-angle-double-down"></i>
                </div>
            </div>
            <ul class="tabsMoreList">
                <li>
                    <a href="javascript:void(0);">#maintab#</a>
                </li>
            </ul>
            <div class="navtab-panel tabsPageContent">
                <div class="navtabPage unitBox">
                    <div class="bjui-pageContent" style="background: #FFF;">Loading...</div>
                </div>
            </div>
        </div>
    </div>
    <footer id="bjui-footer">
        Copyright &copy; 2015 - 2016
        <a href="http://www.yiichina.com/" target="_blank">yii2开发团队</a>
    </footer>
</div>