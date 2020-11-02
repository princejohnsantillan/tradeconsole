<?php

namespace App\SterlingTrader\Contracts;

use App\SterlingTrader\Adapter;

interface AdapterProvider
{
    public function findById(int $key): ?Adapter;
    
    public function findByKey(string $key): ?Adapter;

    public function findBySecret(string $secret): ?Adapter;
}
