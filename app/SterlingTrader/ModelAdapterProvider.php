<?php

namespace App\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderAdapter;
use App\SterlingTrader\Contracts\AdapterProvider;

class ModelAdapterProvider implements AdapterProvider
{
    public function findByKey(string $key): ?Adapter
    {
        return $this->findByField('key', $key);
    }

    public function findBySecret(string $key): ?Adapter
    {
        return $this->findByField('secret', $key);
    }

    private function findByField(string $field, string $value): ?Adapter
    {
        $adapter = SterlingTraderAdapter::where($field, $value)->first(['key', 'secret', 'capacity']);

        if ($adapter === null) {
            return null;
        }

        return Adapter::create($adapter->key, $adapter->secret, $adapter->capacity);
    }
}
