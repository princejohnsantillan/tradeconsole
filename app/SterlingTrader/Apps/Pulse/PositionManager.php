<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\SterlingTrader\Struct\PositionUpdateStruct;

class PositionManager
{
    private $positions = [];

    public function register(PositionUpdateStruct $position)
    {
        $this->positions[$position->bstrAcct][$position->bstrSym] = $position;
    }

    public function getAccountPositions(string $account)
    {
        if (array_key_exists($account, $this->positions)) {
            return $this->positions[$account];
        }

        return [];
    }

    public function getAllPositions()
    {
        return $this->positions;
    }

    public function reset()
    {
        $this->positions = [];
    }
}
