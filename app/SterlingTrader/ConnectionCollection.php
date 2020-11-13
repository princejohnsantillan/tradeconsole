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

    public function saveConnection(ConnectionInterface $connection, string $adapterKey, string $traderId): self
    {
        $this->connections->push([
            'key' => $adapterKey,
            'trader' => $traderId,
            'connection' => $connection,
            'accounts' => [$traderId],
        ]);

        return $this;
    }

    public function removeConnection(string $adapterKey, string $traderId): self
    {
        $this->connections = $this->connections
            ->reject(function ($connection) use ($adapterKey, $traderId) {
                return $connection['key'] === $adapterKey && $connection['trader'] === $traderId;
            });

        return $this;
    }

    public function addAccounts(string $adapterKey, string $traderId, array $accountIds)
    {
        $connection = $this->connections
            ->where('key', $adapterKey)
            ->where('trader', $traderId)
            ->first();

        if ($connection === null) {
            return;
        }

        $connection['accounts'] = array_values(array_unique(array_merge($connection['accounts'], $accountIds)));
    }

    public function getAllConnections(): array
    {
        return $this->connections->toArray();
    }

    public function getAdapterConnections(string $adapterKey): array
    {
        return $this->connections
            ->where('key', $adapterKey)
            ->toArray();
    }

    public function getConnection(string $adapterKey, string $accountId): ?ConnectionInterface
    {
        $connection = $this->connections->filter(function($connection) use($adapterKey, $accountId){
            return $adapterKey === $connection['key'] && in_array($accountId, $connection['accounts']);
        })->first();

        if ($connection === null) {
            return null;
        }

        return $connection['connection'];
    }

    public function totalConnectionsCount(): int
    {
        return $this->connections->count();
    }

    public function adapterConnectionsCount(string $adapterKey): int
    {
        return $this->connections->where('key', $adapterKey)->count();
    }
}
