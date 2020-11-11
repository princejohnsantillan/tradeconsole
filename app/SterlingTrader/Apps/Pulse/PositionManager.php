<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\SterlingTrader\Struct\PositionUpdateStruct;

class PositionManager
{
    private $positions = [];

    public function register(PositionUpdateStruct $position)
    {
        $this->positions[$position->bstrAcct][$position->bstrSym] = [
            'Account' => $position->bstrAcct,
            'Symbol' => $position->bstrSym,
            'Real' => $position->fReal,
            'Position' => $position->Position,
        ];
    }

    public function getAccountPositions(string $account)
    {
        return collect($this->positions)
            ->flatten(1)
            ->where('Account', $account)
            ->values()
            ->toArray();
    }

    public function getAllPositions()
    {
        return collect($this->positions)
            ->flatten(1)
            ->values()
            ->toArray();
    }

    public function reset()
    {
        $this->positions = [];
    }
}
