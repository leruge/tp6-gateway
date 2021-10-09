# gateway扩展包

## 安装
`composer require leruge/tp6-gateway`

## 使用方式
1. 安装完成以后会在config下生成gateway.php配置文件，没有的话自行复制
1. win下需要启动3条命令
    1. `php think register`
    1. `php think business`
    1. `php think gateway`
1. linux下启动一条即可
    1. `php think socket`，'start', 'stop', 'reload', 'restart', 'status', 'connections'，跟gatewayworker命令一样

## 版本更新内容
> 1.0.8
1. 依赖的扩展包增加了`workerman/gatewayclient`
1. linux下启动文件`SocketStart.php`修改为`Socket.php`

> 1.0.7
1. 自定义register进程名称
1. linux下启动命令修改为socket
