<?php
declare (strict_types = 1);

namespace leruge\command;

use GatewayWorker\BusinessWorker;
use GatewayWorker\Gateway;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use Workerman\Worker;

class Socket extends Command
{
    protected function configure()
    {
        $this->setName('socket')
            ->addArgument('action', Argument::OPTIONAL, "start|stop|restart|reload|status|connections", 'start')
            ->setDescription('GatewayWorker Server for ThinkPHP');
    }

    protected function execute(Input $input, Output $output)
    {
        $action = $input->getArgument('action');

        // 如果不是win则提示
        if (DIRECTORY_SEPARATOR === '\\') {
            $output->writeln('不支持win');
            exit(1);
        }
        if (!in_array($action, ['start', 'stop', 'reload', 'restart', 'status', 'connections'])) {
            $output->writeln('无效的命令');
            exit(1);
        }
        global $argv;
        array_shift($argv);
        array_shift($argv);
        array_unshift($argv, ...['think', $action]);

        // 命令提示
        if ($action == 'start') {
            $output->writeln('gateway启动');
        }

        // 启动
        $this->start();
    }

    // 启动
    private function start()
    {
        $registerAddress = empty(config('gateway.register_address')) ? '127.0.0.1:1236' :
            config('gateway.register_address');
        // register注册
        $this->register($registerAddress);

        // business启动
        $this->businessWorker($registerAddress);

        // gateway启动
        $this->gateway($registerAddress);

        Worker::runAll();;
    }

    // register注册
    private function register($registerAddress)
    {
        $register = new \GatewayWorker\Register('text://' . $registerAddress);
        $register->name = config('gateway.register_name') ?: 'register';
    }

    // business启动
    private function businessWorker($registerAddress)
    {
        $worker = new BusinessWorker();
        $worker->registerAddress = $registerAddress;
        $worker->name = !empty(config('gateway.business_name')) ? config('gateway.business_name')
            : 'business';
        $worker->count = 1;
        $worker->eventHandler = config('gateway.event_handler');
    }

    // gateway启动
    private function gateway($registerAddress)
    {
        $gatewayAddress = !empty(config('gateway.gateway_address')) ?
            config('gateway.gateway_address') : 'websocket://0.0.0.0:8282';
        $content = [];
        if (config('gateway.ssl.is_use')) {
            $content = [
                'ssl' => config('gateway.ssl')
            ];
        }
        $gateway = new Gateway($gatewayAddress, $content);
        if (config('gateway.ssl.is_use')) {
            $gateway->transport = 'ssl';
        }
        $gateway->name = !empty(config('gateway.gateway_name')) ?
            config('gateway.gateway_name') : 'gateway';
        $gateway->count = !empty(config('gateway.gateway_count')) ?
            config('gateway.gateway_count') : 4;
        $gateway->lanIp = !empty(config('gateway.gateway_lan_ip')) ?
            config('gateway.gateway_lan_ip') : '127.0.0.1';
        $gateway->startPort = !empty(config('gateway.gateway_start_port')) ?
            config('gateway.gateway_start_port') : 2000;
        $gateway->pingInterval = !empty(config('gateway.gateway_ping_interval')) ?
            config('gateway.gateway_ping_interval') : 55;
        $gateway->pingNotResponseLimit = 0;
        $gateway->pingData = '{"type":"ping"}';
        $gateway->registerAddress = $registerAddress;
        Worker::$daemonize = !empty(config('gateway.daemonize')) ?
            config('gateway.daemonize') : false;
    }
}
