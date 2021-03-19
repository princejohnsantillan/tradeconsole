<?php

namespace App\SterlingTrader\Apps\Pulse\Events;

use App\Models\SterlingTrader\SterlingSymbol;
use App\SterlingTrader\AdapterResponse;
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
        $this->connectionManager = app(ConnectionManager::class);
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
        $this->symbolRegistration($data);

        $this->data = $data;

        foreach ($this->instructions as $instruction) {
            if ($this->canHandle($instruction)) {
                $this->execute($instruction);
            }
        }
    }

    private function symbolRegistration($data)
    {
        if (is_array($data) && array_key_exists('bstrAccount', $data) && array_key_exists('bstrSymbol', $data)) {
            $symbol = SterlingSymbol::firstOrCreate(['symbol' => $data['bstrSymbol']]);

            if (! $symbol->wasRecentlyCreated) {
                return;
            }

            $adapter_connections = $this->connectionManager->getAdapterConnections($this->connection->adapter->key);

            foreach ($adapter_connections as $connection) {
                if (in_array($data['bstrAccount'], $connection['accounts'])) {
                    continue;
                }

                $connection['connection']->send(AdapterResponse::switchLinkGroupSymbol(1, $symbol->symbol));
            }
        }
    }

    abstract protected function canHandle(array $instruction): bool;

    abstract protected function execute(array $instruction);
}
