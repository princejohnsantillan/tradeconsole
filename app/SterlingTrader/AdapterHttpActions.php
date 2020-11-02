<?php

namespace App\SterlingTrader;

class AdapterHttpActions
{
    private $adapter;

    private $url;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->url = sprintf('%s:%s/sterling-trader/%s',
            config('app.url'),
            config('websockets.port'),
            $adapter->key
        );
    }

    public function sendMessage(string $trader, string $message)
    {
        return $this->adapter->httpPost($this->url."/send-message/$trader",
            ['message' => $message]
        );
    }

    public function fetchConnections()
    {
        return $this->adapter->httpGet($this->url.'/fetch-connections');
    }
}
