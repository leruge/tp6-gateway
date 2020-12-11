<?php
/**
 * @title gateway配置文件
 */

return [
    'register_address' => '127.0.0.1:1236', // 注册地址
    'business_name' => 'business', // business名称
    'event_handler' => \leruge\Events::class, // 聊天回调
    'gateway_address' => 'websocket://0.0.0.0:8282', // socket地址
    'gateway_name' => 'gateway',
    'gateway_count' => 4,
    'gateway_lan_ip' => '127.0.0.1',
    'gateway_start_port' => 2000,
    'gateway_ping_interval' => 55,
    'daemonize' => false,
];
