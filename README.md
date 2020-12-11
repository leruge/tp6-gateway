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
    1. `php think socket_start`，'start', 'stop', 'reload', 'restart', 'status', 'connections'，跟gatewayworker命令一样