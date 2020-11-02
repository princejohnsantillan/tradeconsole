<?php

namespace App\SterlingTrader\Exceptions;

class OutdatedAdapter extends WebSocketException
{
    public function __construct()
    {
        $this->message = sprintf('Outdated Adapter: The latest version(%s) is required',
            config('sterlingtrader.adapter_version')
        );

        $this->code = 4001;
    }
}
