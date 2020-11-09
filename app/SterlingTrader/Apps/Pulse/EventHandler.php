<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\Models\SterlingTrader\PulseUserInstruction;
use Ratchet\ConnectionInterface;

abstract class EventHandler
{
    /** @var \Ratchet\ConnectionInterface */
    protected $connection;

    /** @var \App\Models\SterlingTrader\PulseUserInstruction */
    protected $instruction;

    public function on(ConnectionInterface $connection): self
    {
        $this->connection = $connection;

        return $this;
    }

    public function following(PulseUserInstruction $instruction): self
    {
        $this->instruction = $instruction;

        return $this;
    }

    abstract public function shouldHandle(): bool;

    abstract public function execute($data);
}
