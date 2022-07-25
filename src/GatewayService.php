<?php

namespace leruge;

use leruge\command\Business;
use leruge\command\Gateway;
use leruge\command\Register;
use leruge\command\Socket;
use think\Service;

class GatewayService extends Service
{
    public function boot()
    {
        $this->commands([
            'business' => Business::class,
            'gateway' => Gateway::class,
            'register' => Register::class,
            'socket' => Socket::class
        ]);
    }
}