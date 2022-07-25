<?php
declare (strict_types = 1);

namespace leruge\command;

use GatewayWorker\BusinessWorker;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use Workerman\Worker;

class Business extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('business')
            ->setDescription('business启动');
    }

    protected function execute(Input $input, Output $output)
    {
        $registerAddress = empty(config('gateway.register_address')) ? '127.0.0.1:1236' :
            config('gateway.register_address');
        // 指令输出
        $output->writeln('business启动');
        $worker = new BusinessWorker();
        $worker->registerAddress = $registerAddress;
        $worker->name = !empty(config('gateway.business_name')) ? config('gateway.business_name')
            : 'business';
        $worker->count = 1;
        $worker->eventHandler = config('gateway.event_handler');
        Worker::runAll();
    }
}
