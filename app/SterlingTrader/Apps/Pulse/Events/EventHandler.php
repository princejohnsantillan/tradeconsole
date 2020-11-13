<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use Illuminate\Database\Eloquent\Collection;
use Ratchet\ConnectionInterface;

abstract class EventHandler
{
    /** @var \Ratchet\ConnectionInterface */
    protected $connection;

    /** @var Illuminate\Database\Eloquent\Collection */
    protected $instructions;

    public function on(ConnectionInterface $connection): self
    {
        $this->connection = $connection;

        return $this;
    }

    public function following(Collection $instructions): self
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function handle($data)
    {
        if ($this->shouldHandle()) {
            $this->execute($data);
        }
    }

    abstract public function shouldHandle(): bool;

    abstract public function execute($data);
}
