<?php
use yii\helpers\Html;
// 引入 AppAsset 资源包
use backend\assets\AppAsset;
use yii\helpers\Url;
// 在本视图注册此资源包
AppAsset::register($this);
// 获取发布后资源包对应的临时目录
$baseUrl = $this->assetBundles[AppAsset::className()]->baseUrl . '/';
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);?>
<?= Html::csrfMetaTags()?>
<title><?= Html::encode($this->title) ?></title>
<?php $this->registerMetaTag(['name' => 'keywords', 'content' => '后台管理系统']);?>
<?php $this->registerMetaTag(['name' => 'description', 'content' => '后台管理系统']);?>
<?php $this->head()?>
<?php $this->registerCssFile($baseUrl .'themes/css/ie7.css', ['condition' => 'lte IE7'])?>
<?php $this->registerJsFile($baseUrl .'html5shiv.min.js', ['condition' => 'lte IE9'])?>
<?php $this->registerJsFile($baseUrl .'other/respond.min.js', ['condition' => 'lte IE9'])?>
<?php $this->registerJsFile($baseUrl .'other/jquery.iframe-transport.js', ['condition' => 'lte IE9'])?>
</head>

<body>
<?php $this->beginBody()?>
<?= $content?>
<?php $this->endBody()?>

<script src='http://cdn.bootcss.com/socket.io/1.3.7/socket.io.js'></script>
<script>
    // 连接服务端
    var socket = io('http://127.0.0.1:5000'+'/test');
    // uid可以是自己网站的用户id，以便针对uid推送以及统计在线人数
    uid = 123;
    // socket连接后以uid登录
    socket.on('connect', function(){
        socket.emit('my event', uid);
    });
    // 后端推送来消息时
    socket.on('new_msg', function(msg){
        console.log("收到消息："+msg);
        $(this).alertmsg('info', msg, {displayMode:'slide', displayPosition:'bottomright', title:'通知/公告'})
    });
    // 后端推送来在线数据时
    socket.on('update_online_count', function(online_stat){
        console.log(online_stat);
    });
</script>

<!--init -->
<script type="text/javascript">
$(function() {
    BJUI.init({
        JSPATH       : '<?= $baseUrl ?>',         //[可选]框架路径
        PLUGINPATH   : '<?= $baseUrl ?>plugins/', //[可选]插件路径
        loginInfo    : {url:'<?= Url::toRoute('site/timeout') ?>', title:'登录', width:400, height:200}, // 会话超时后弹出登录对话框
        statusCode   : {ok:200, error:300, timeout:301}, //[可选]
        ajaxTimeout  : 30000, //[可选]全局Ajax请求超时时间(毫秒)
        pageInfo     : {total:'total', pageCurrent:'pageCurrent', pageSize:'pageSize', orderField:'orderField', orderDirection:'orderDirection'}, //[可选]分页参数
        alertMsg     : {displayPosition:'topcenter', displayMode:'slide', alertTimeout:3000}, //[可选]信息提示的显示位置，显隐方式，及[info/correct]方式时自动关闭延时(毫秒)
        keys         : {statusCode:'statusCode', message:'message'}, //[可选]
        ui           : {
                         windowWidth      : 0,    //框架可视宽度，0=100%宽，> 600为则居中显示
                         showSlidebar     : true, //[可选]左侧导航栏锁定/隐藏
                         clientPaging     : true, //[可选]是否在客户端响应分页及排序参数
                         overwriteHomeTab : false //[可选]当打开一个未定义id的navtab时，是否可以覆盖主navtab(我的主页)
                       },
        debug        : false,    // [可选]调试模式 [true|false，默认false]
        theme        : 'sky' // 若有Cookie['bjui_theme'],优先选择Cookie['bjui_theme']。皮肤[五种皮肤:default, orange, purple, blue, red, green]
    })
    
    // main - menu
    $('#bjui-accordionmenu')
        .collapse()
        .on('hidden.bs.collapse', function(e) {
            $(this).find('> .panel > .panel-heading').each(function() {
                var $heading = $(this), $a = $heading.find('> h4 > a')
                
                if ($a.hasClass('collapsed')) $heading.removeClass('active')
            })
        })
        .on('shown.bs.collapse', function (e) {
            $(this).find('> .panel > .panel-heading').each(function() {
                var $heading = $(this), $a = $heading.find('> h4 > a')
                
                if (!$a.hasClass('collapsed')) $heading.addClass('active')
            })
        })
    
    $(document).on('click', 'ul.menu-items > li > a', function(e) {
        var $a = $(this), $li = $a.parent(), options = $a.data('options').toObj()
        var onClose = function() {
            $li.removeClass('active')
        }
        var onSwitch = function() {
            $('#bjui-accordionmenu').find('ul.menu-items > li').removeClass('switch')
            $li.addClass('switch')
        }
        
        $li.addClass('active')
        if (options) {
            options.url      = $a.attr('href')
            options.onClose  = onClose
            options.onSwitch = onSwitch
            if (!options.title) options.title = $a.text()
            
            if (!options.target)
                $a.navtab(options)
            else
                $a.dialog(options)
        }
        
        e.preventDefault()
    })
    
    //时钟
    var today = new Date(), time = today.getTime()
    $('#bjui-date').html(today.formatDate('yyyy/MM/dd'))
    setInterval(function() {
        today = new Date(today.setSeconds(today.getSeconds() + 1))
        $('#bjui-clock').html(today.formatDate('HH:mm:ss'))
    }, 1000)
})

//菜单-事件
function MainMenuClick(event, treeId, treeNode) {
    event.preventDefault()
    
    if (treeNode.isParent) {
        var zTree = $.fn.zTree.getZTreeObj(treeId)
        
        zTree.expandNode(treeNode, !treeNode.open, false, true, true)
        return
    }
    
    if (treeNode.target && treeNode.target == 'dialog')
        $(event.target).dialog({id:treeNode.tabid, url:treeNode.url, title:treeNode.name})
    else
        $(event.target).navtab({id:treeNode.tabid, url:treeNode.url, title:treeNode.name, fresh:treeNode.fresh, external:treeNode.external})
}
</script>
<!-- for doc begin -->
<script type="text/javascript">
$(function(){
    SyntaxHighlighter.config.clipboardSwf = '<?= $baseUrl ?>plugins/syntaxhighlighter-2.1.382/scripts/clipboard.swf'
    $(document).on(BJUI.eventType.initUI, function(e) {
        SyntaxHighlighter.highlight();
    })
})
</script>
<!-- for doc end -->
</body>
</html>
<?php $this->endPage()?>
