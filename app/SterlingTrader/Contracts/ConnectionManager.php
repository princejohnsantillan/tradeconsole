<?php

namespace App\SterlingTrader\Contracts;

use Ratchet\ConnectionInterface;

interface ConnectionManager
{
    public function saveConnection(ConnectionInterface $connection, string $adapterKey, string $trader): self;

    public function removeConnection(string $adapterKey, string $trader): self;

    public function getAllConnections(): array;

    public function getAdapterConnections(string $adapterKey): array;

    public function getConnection(string $adapterKey, string $trader): ?ConnectionInterface;

    public function totalConnectionsCount(): int;
    
    public function adapterConnectionsCount(string $adapterKey): int;    
}
