<?php
declare (strict_types = 1);

namespace leruge\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use Workerman\Worker;

class Gateway extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('gateway')
            ->setDescription('gateway启动');
    }

    protected function execute(Input $input, Output $output)
    {
        $registerAddress = empty(config('gateway.register_address')) ? '127.0.0.1:1236' :
            config('gateway.register_address');
        // 指令输出
        $output->writeln('gateway启动');
        $gatewayAddress = !empty(config('gateway.gateway_address')) ?
            config('gateway.gateway_address') : 'websocket://0.0.0.0:8282';
        $gateway = new \GatewayWorker\Gateway($gatewayAddress);
        $gateway->name = !empty(config('gateway.gateway_name')) ?
            config('gateway.gateway_name') : 'gateway';
        $gateway->count = 1;
        $gateway->lanIp = !empty(config('gateway.gateway_lan_ip')) ?
            config('gateway.gateway_lan_ip') : '127.0.0.1';
        $gateway->startPort = !empty(config('gateway.gateway_start_port')) ?
            config('gateway.gateway_start_port') : 2000;
        $gateway->registerAddress = $registerAddress;
        $gateway->pingInterval = !empty(config('gateway.gateway_ping_interval')) ?
            config('gateway.gateway_ping_interval') : 55;
        $gateway->pingNotResponseLimit = 0;
        $gateway->pingData = '{"type":"ping"}';
        Worker::runAll();
    }
}
