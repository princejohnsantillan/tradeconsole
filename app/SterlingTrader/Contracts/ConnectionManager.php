<?php

namespace App\SterlingTrader\Contracts;

use Ratchet\ConnectionInterface;

interface ConnectionManager
{
    public function saveConnection(ConnectionInterface $connection, string $adapterKey, string $trader);

    public function removeConnection(string $adapterKey, string $trader);

    public function getConnections(string $adapterKey): array;

    public function getConnection(string $adapterKey, string $trader): ConnectionInterface;

    public function connectionCount(string $adapterKey);

    public function totalConnections();
}
