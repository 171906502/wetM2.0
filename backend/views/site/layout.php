<?php use yii\helpers\Url; ?>
<div class="bjui-pageHeader" style="background: #FFF;">
    <div style="padding: 0 15px;">
        <h4 style="margin-bottom: 20px;">
            微信企业号管理平台 <small>轻松开发，专注您的业务！</small>
        </h4>
        <div style="float: left; width: 157px;">
            <div class="alert alert-info" role="alert" style="margin: 0 0 5px; padding: 10px;">
                <img src="images/ewm.png" width="135">
            </div>
        </div>
        <div style="margin-left: 170px; margin-top: 22px; padding-left: 6px;">
            <a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=eadb9e215426e734cf900ca9eda694b641d01dc2035577280e888e8df9d97be2">
                <img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="Yii2开发团队" title="Yii2开发团队">
            </a>
            <span style="padding-left: 10px;">官方网站：</span>
            <a href="http://www.hnqyw.com/" target="_blank">http://www.hnqyw.com/</a>
        </div>
        <div class="row" style="margin-left: 170px; margin-top: 10px;">
            <div class="col-md-6" style="padding: 5px;">
                <div class="alert alert-success" role="alert" style="margin: 0 0 5px; padding: 5px 15px;">
                    <strong>Yii2 - BJUI 团队欢迎你!</strong> <br> <span class="label label-default">开发：</span>
                    <a href="javascript:void(0);" target="_blank">@张成波 （河南郑州）</a>
                    <br> <span class="label label-default">测试 & 推广：</span>
                    <a href="javascript:void(0);">@张成波 （河南郑州）</a>
                    <br> <span class="label label-default">测试 & 试用：</span>
                    <a href="javascript:void(0);">@张成波 （河南郑州）</a>
                </div>
            </div>
            <div class="col-md-6" style="padding: 5px;">
                <div class="alert alert-info" role="alert" style="margin: 0 0 5px; padding: 5px 15px;">
                    <h5>
                        前台地址：
                        <a href="http://www.yj.mangxiaoquan.com" target="_blank">http://www.yj.mangxiaoquan.com</a>
                    </h5>
                    <h5>
                        API 地址：
                        <a href="http://api.yj.mangxiaoquan.com" target="_blank">http://api.yj.mangxiaoquan.com</a>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bjui-pageContent">
    <div style="margin-top: 5px; overflow: hidden;">
        <div class="row" style="padding: 0 2px;">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-list"></i> GIT@OSC 最新提交
                        </h3>
                    </div>
                    <div class="panel-body">
                        <iframe width="100%" height="600" class="share_self" frameborder="0" scrolling="auto" src="<?php echo Url::toRoute('site/git') ?>"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-bar-chart-o fa-fw"></i> 当前版本：
                            <code>V1.0</code>
                            最近更新日志(2015-07-08)：
                        </h3>
                    </div>
                    <div class="panel-body bjui-doc" style="padding: 0;">
                        <ul>
                            <li>[修复]datagrid在local模式下提供空数据时显示不正常的bug</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>