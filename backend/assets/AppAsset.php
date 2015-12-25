<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@bower';
//    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
         // bootstrap - css
        '../../css/site.css',

        'bjui/themes/css/bootstrap.css',
        // core - css
        'bjui/themes/css/style.css',
        'bjui/themes/css/doc.css',
        'bjui/themes/blue/core.css',
        // plug - css
        'bjui/plugins/kindeditor_4.1.10/themes/default/default.css',
        'bjui/plugins/colorpicker/css/bootstrap-colorpicker.min.css',
        'bjui/plugins/niceValidator/jquery.validator.css',
        'bjui/plugins/bootstrapSelect/bootstrap-select.css',
        'bjui/plugins/syntaxhighlighter-2.1.382/styles/shCore.css',
        'bjui/plugins/syntaxhighlighter-2.1.382/styles/shThemeEclipse.css',
        // other
        'bjui/themes/css/FA/css/font-awesome.min.css',
        'bjui/plugins/uploadify/css/uploadify.css'
    ];
    public $js = [
        // jquery
        'bjui/js/jquery-1.7.2.min.js',
        'bjui/js/jquery.cookie.js',
        // BJUI.all 分模块压缩版
        // 以下是B-JUI的分模块未压缩版，建议开发调试阶段使用下面的版本
         'bjui/js/bjui-core.js',
         'bjui/js/bjui-regional.zh-CN.js',
         'bjui/js/bjui-frag.js',
         'bjui/js/bjui-extends.js',
         'bjui/js/bjui-basedrag.js',
         'bjui/js/bjui-slidebar.js',
         'bjui/js/bjui-contextmenu.js',
         'bjui/js/bjui-navtab.js',
         'bjui/js/bjui-dialog.js',
         'bjui/js/bjui-taskbar.js',
         'bjui/js/bjui-ajax.js',
         'bjui/js/bjui-alertmsg.js',
         'bjui/js/bjui-pagination.js',
         'bjui/js/bjui-util.date.js',
         'bjui/js/bjui-datepicker.js',
         'bjui/js/bjui-ajaxtab.js',
         'bjui/js/bjui-datagrid.js',
         'bjui/js/bjui-tablefixed.js',
         'bjui/js/bjui-tabledit.js',
         'bjui/js/bjui-spinner.js',
         'bjui/js/bjui-lookup.js',
         'bjui/js/bjui-tags.js',
         'bjui/js/bjui-upload.js',
         'bjui/js/bjui-theme.js',
         'bjui/js/bjui-initui.js',
         'bjui/js/bjui-plugins.js',
        // plugins
        // swfupload for uploadify && kindeditor
        'bjui/plugins/swfupload/swfupload.js',
        // kindeditor
        'bjui/plugins/kindeditor_4.1.10/kindeditor-all.min.js',
        'bjui/plugins/kindeditor_4.1.10/lang/zh_CN.js',
        // colorpicker
        'bjui/plugins/colorpicker/js/bootstrap-colorpicker.min.js',
        // ztree
        'bjui/plugins/ztree/jquery.ztree.all-3.5.js',
        // nice validate
        'bjui/plugins/niceValidator/jquery.validator.js',
        'bjui/plugins/niceValidator/jquery.validator.themes.js',

        // bootstrap plugins
        'bjui/plugins/bootstrap.min.js',
        'bjui/plugins/bootstrapSelect/bootstrap-select.min.js',
        'bjui/plugins/bootstrapSelect/defaults-zh_CN.min.js',
        // icheck
        'bjui/plugins/icheck/icheck.min.js',
        // dragsort
        'bjui/plugins/dragsort/jquery.dragsort-0.5.1.min.js',
        // HighCharts
        // 'plugins/highcharts/highcharts.js',
        // 'plugins/highcharts/highcharts-3d.js',
        // 'plugins/highcharts/themes/gray.js',
        // ECharts
        // 'plugins/echarts/echarts.js',
        // other plugins
        'bjui/plugins/other/jquery.autosize.js',
        'bjui/plugins/uploadify/scripts/jquery.uploadify.min.js',
        'bjui/plugins/download/jquery.fileDownload.js',
        'bjui/plugins/syntaxhighlighter-2.1.382/scripts/brush.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
