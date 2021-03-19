<?php

namespace App\SterlingTrader\Apps\Pulse\Exceptions;

use Exception;

abstract class PulseException extends Exception
{
    public function getPayload(): array
    {
        return [
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
        ];
    }
}
