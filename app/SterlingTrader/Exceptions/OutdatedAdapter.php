<?php

namespace App\SterlingTrader\Exceptions;

class OutdatedAdapter extends WebSocketException
{
    public function __construct()
    {
        $this->code = 4001;

        $this->message = sprintf('Outdated Adapter: The latest version(%s) is required.',
            config('sterlingtrader.adapter_version')
        );
    }
}
