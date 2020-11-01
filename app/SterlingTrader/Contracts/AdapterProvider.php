<?php

namespace App\SterlingTrader\Contracts;

use App\SterlingTrader\Adapter;

interface AdapterProvider
{
    public function findByKey(string $key) : ?Adapter;

    public function findBySecret(string $secret) : ?Adapter;
}
