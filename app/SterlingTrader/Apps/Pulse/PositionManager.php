<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\SterlingTrader\Struct\PositionUpdateStruct;

class PositionManager
{
    private $positions = [];

    public function register(PositionUpdateStruct $position)
    {
        $this->positions[] = [
            'Account' => $position->bstrAcct,
            'Symbol' => $position->bstrSym,
            'Real' => $position->fReal,
            'Position' => $position->Position,
        ];
    }

    public function getAccountPositions(string $account)
    {
        return collect($this->positions)->where('Account', $account)->toArray();
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
