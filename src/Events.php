<?php
declare (strict_types = 1);

namespace leruge;

class Events
{
    public static function onConnect($client_id)
    {
        $resData = [
            'type' => 11,
            'client_id' => $client_id
        ];
        \GatewayWorker\Lib\Gateway::sendToClient($client_id, json_encode($resData));
    }

    public static function onMessage($client_id, $data)
    {}

    public static function onClose($client_id)
    {}
}
