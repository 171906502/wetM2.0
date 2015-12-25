<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'status' => [
        '0' => '删除',
        '1' => '禁用',
        '2' => '锁定',
        '10' => '正常'
    ],
    'wxbizStatus' => [
        '1' => '正常',
        '2' => '锁定'
    ],
    'wxbizMenuType' => [
        'click' => '菜单KEY',
        'views' => '跳转到网页',
        'scancode_push' => '扫码推事件',
        'scancode_waitmsg' => '扫码推事件(弹框)',
        'pic_sysphoto' => '系统拍照',
        'pic_photo_or_album' => '拍照或相册',
        'pic_weixin' => '微信发图器',
        'location_select' => '地理位置选择器'
    ]
];
