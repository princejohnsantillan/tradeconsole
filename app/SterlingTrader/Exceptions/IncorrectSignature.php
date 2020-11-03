<?php

namespace App\SterlingTrader\Exceptions;

class IncorrectSignature extends WebSocketException
{
    public function __construct()
    {
        $this->code = 4004;

        $this->message = 'Unauthorized: Incorrect Signature';
    }
}
