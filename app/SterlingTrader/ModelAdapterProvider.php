<?php

namespace App\SterlingTrader;

use App\Models\SterlingTrader\SterlingTraderAdapter;
use App\SterlingTrader\Contracts\AdapterProvider;

class ModelAdapterProvider implements AdapterProvider
{
    public function findById(int $key): ?Adapter
    {
        return $this->findByField('id', $key);
    }

    public function findByKey(string $key): ?Adapter
    {
        return $this->findByField('key', $key);
    }

    public function findBySecret(string $key): ?Adapter
    {
        return $this->findByField('secret', $key);
    }

    /**
     * @param  string $field
     * @param  int|string $value
     * @return \App\SterlingTrader\Adapter|null
     */
    private function findByField(string $field, $value): ?Adapter
    {
        $adapter = SterlingTraderAdapter::active()
            ->where($field, $value)
            ->first(['id', 'key', 'secret', 'capacity']);

        if ($adapter === null) {
            return null;
        }

        return Adapter::create($adapter->id, $adapter->key, $adapter->secret, $adapter->capacity);
    }
}
