<?php

namespace App\SterlingTrader;

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

    public function getPositionsByAccount(string $account)
    {
        return collect($this->positions)
            ->flatten(1)
            ->where('Account', $account)
            ->values()
            ->toArray();
    }

    public function getPositionsBySymbol(string $symbol)
    {
        return collect($this->positions)
            ->flatten(1)
            ->where('Symbol', $symbol)
            ->values()
            ->toArray();
    }

    public function getPosition(string $account, string $symbol)
    {
        return collect($this->positions)
            ->flatten(1)
            ->where('Account', $account)
            ->where('Symbol', $symbol)
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
