<?php

namespace App\SterlingTrader\Exceptions;

class IncorrectSignature extends WebSocketException
{
    public function __construct()
    {
        $this->message = 'Unauthorized: Incorrect signature.';

        $this->code = 4004;
    }
}
