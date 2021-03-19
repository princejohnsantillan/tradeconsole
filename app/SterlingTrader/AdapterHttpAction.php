<?php

namespace App\SterlingTrader;

class AdapterHttpAction
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

    public function sendData(string $trader, string $data)
    {
        $response = $this->adapter->httpPost(
            $this->url."/send-data/$trader",
            ['data' => $data]
        );

        return $response->ok();
    }

    public function fetchConnections()
    {
        $response = $this->adapter->httpGet($this->url.'/fetch-connections')->json();

        return collect($response)
            ->pluck('key', 'trader')
            ->toArray();
    }

    public function fetchPositions()
    {
        return $this->adapter->httpGet($this->url.'/fetch-positions')->json();
    }
}
