<?php
/**
 * @title gateway配置文件
 */

return [
    'business_name' => 'business', // business名称
    'gateway_name' => 'gateway',
    'register_name' => 'register',

    'register_address' => '127.0.0.1:1236', // 注册地址
    'event_handler' => \leruge\Events::class, // 聊天回调
    'gateway_address' => 'websocket://0.0.0.0:8282', // socket地址
    'gateway_count' => 1,
    'gateway_lan_ip' => '127.0.0.1',
    'gateway_start_port' => 2000,
    'gateway_ping_interval' => 55,
    'daemonize' => true,

    // ssl证书配置
    'ssl' => [
        'is_use' => false, // 是否使用ssl
        'local_cert' => '', // 证书路径
        'local_pk' => '', // 私钥路径
        'verify_peer' => false,
        'allow_self_signed' => false, // 是否自签证书
    ],
];
