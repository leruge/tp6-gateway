<?php
declare (strict_types = 1);

namespace leruge\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use Workerman\Worker;

class Register extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('register')
            ->setDescription('gateway 注册启动');
    }

    protected function execute(Input $input, Output $output)
    {
        // 指令输出
        $output->writeln('register启动');
        $registerAddress = empty(config('gateway.register_address')) ? '127.0.0.1:1236' :
            config('gateway.register_address');
        new \GatewayWorker\Register('text://' . $registerAddress);
        Worker::runAll();
    }
}
