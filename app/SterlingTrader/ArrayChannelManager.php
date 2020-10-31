<?php

namespace App\SterlingTrader;

use Ratchet\ConnectionInterface;

class ArrayChannelManager implements ChannelManager
{
    public $connections = [];

    public function saveConnection(ConnectionInterface $conn)
    {
        $this->connections[] = $conn;

        return $this;
    }

    public function removeConnection(ConnectionInterface $conn){
        
    }

    public function getConnections()
    {
        return $this->connections;
    }

    public function connectionCount()
    {
        return count($this->connections);
    }
}
