<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => [
        'log',
    ],
    'modules' => [
        'core' => [
            'class' => 'backend\modules\core\Module'
        ],
        'wxbiz' => [
            'class' => 'backend\modules\wxbiz\Module'
        ],
        'query' => [
            'class' => 'backend\modules\query\Module'
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'mainLayout' => '@app/views/layouts/admin.php',
            'layout' => 'left-menu',
        ],
    ],
    'components' => [

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        // 禁用默认 JqueryAsset
        'assetManager' => [
            'bundles' => [

            ]
        ],
         // 启用 rbac
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // db config配置中的数据库ID
            'db' => 'db',
            'itemTable' => '{{%auth_item}}',
            'itemChildTable' => '{{%auth_item_child}}',
            'assignmentTable' => '{{%auth_assignment}}',
            'ruleTable' => '{{%auth_rule}}',
            'defaultRoles' => ['admin', 'author'],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        'error',
                        'warning'
                    ]
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
            'maxSourceLines' => 20,
        ]
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
            'core/*',
            'debug/*',

        ]
    ],
    'params' => $params
];
