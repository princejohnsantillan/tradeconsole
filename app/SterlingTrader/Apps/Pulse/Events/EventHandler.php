<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\SterlingTrader\Contracts\ConnectionManager;
use Illuminate\Support\Collection;
use Ratchet\ConnectionInterface;

abstract class EventHandler
{
    /** @var \Ratchet\ConnectionInterface */
    protected $connection;

    /** @var \Illuminate\Support\Collection */
    protected $instructions;

    /** @var mixed */
    protected $data;

    /** @var \App\SterlingTrader\Contracts\ConnectionManager */
    protected $connectionManager;

    public function __construct()
    {
        $this->connectionManager = app(ConnectionManager::class) ;
    }

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
        $this->data = $data;

        foreach ($this->instructions as $instruction) {
            if ($this->canHandle($instruction)) {
                $this->execute($instruction);
            }
        }
    }

    abstract protected function canHandle(array $instruction): bool;

    abstract protected function execute(array $instruction);
}
