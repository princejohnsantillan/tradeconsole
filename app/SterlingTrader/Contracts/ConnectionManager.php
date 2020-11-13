<?php

namespace App\SterlingTrader\Contracts;

use Ratchet\ConnectionInterface;

interface ConnectionManager
{
    public function saveConnection(ConnectionInterface $connection, string $adapterKey, string $traderId): self;

    public function removeConnection(string $adapterKey, string $traderId): self;

    public function addAccounts(string $adapterKey, string $traderId, array $accountIds);

    public function getAllConnections(): array;

    public function getAdapterConnections(string $adapterKey): array;

    public function getConnection(string $adapterKey, string $accountId): ?ConnectionInterface;

    public function totalConnectionsCount(): int;

    public function adapterConnectionsCount(string $adapterKey): int;
}
