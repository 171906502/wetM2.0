<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases' => [
        '@mdm/admin' => dirname(dirname(__DIR__)) . '/yii2-admin-master',
    ],
    'language' => 'zh-CN', // 启用国际化支持
//    'sourceLanguage' => 'zh-CN', // 源代码采用中文
    'timeZone' => 'Asia/Shanghai', // 设置时区
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', 
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
    ],
];
