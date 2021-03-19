<?php

namespace App\SterlingTrader\Exceptions;

use Exception;

class SterlingTraderException extends Exception
{
    public function __construct(string $message)
    {
        $this->message = $message;
    }
}
