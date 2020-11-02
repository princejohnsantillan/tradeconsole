<?php

namespace App\SterlingTrader;

use App\SterlingTrader\Contracts\ConnectionManager;
use Illuminate\Support\Collection;
use Ratchet\ConnectionInterface;

class ConnectionCollection implements ConnectionManager
{
    private $connections = [];

    public function __construct()
    {
        $this->connections = new Collection;
    }

    public function saveConnection(ConnectionInterface $connection, string $adapterKey, string $trader)
    {
        $this->connections->push([
            'key' => $adapterKey,
            'trader' => $trader,
            'connection' => $connection,
        ]);

        return $this;
    }

    public function removeConnection(string $adapterKey, string $trader)
    {
        $this->connections = $this->connections
            ->reject(function ($connection) use ($adapterKey, $trader) {
                return $connection['key'] === $adapterKey && $connection['trader'] == $trader;
            });

        return $this;
    }

    public function getConnections(string $adapterKey): array
    {
        return $this->connections
            ->where('key', $adapterKey)
            ->toArray();
    }

    public function getConnection(string $adapterKey, string $trader): ConnectionInterface
    {
        return $this->connections
            ->where('key', $adapterKey)
            ->where('trader', $trader)
            ->first()['connection'];
    }

    public function connectionCount(string $adapterKey)
    {
        return $this->connections->where('key', $adapterKey)->count();
    }

    public function totalConnections()
    {
        return $this->connections->count();
    }
}
