<?php

namespace leruge;

use leruge\command\Business;
use leruge\command\Gateway;
use leruge\command\Register;
use leruge\command\SocketStart;
use think\Service;

class AuthService extends Service
{
    public function boot()
    {
        $this->commands([
            'business' => Business::class,
            'gateway' => Gateway::class,
            'register' => Register::class,
            'socket_start' => SocketStart::class
        ]);
    }
}