<?php

namespace App\SterlingTrader\Apps;

use App\Models\SterlingTrader\SterlingTraderMessage;
use App\SterlingTrader\Apps\Pulse\EventHandlerFactory;
use Ratchet\ConnectionInterface;

class Pulse
{
    /** @var \Ratchet\ConnectionInterface */
    private $connection;

    /** @var \App\Models\User */
    private $user;

    private $event;

    private $data;

    public function __construct(ConnectionInterface $connection, SterlingTraderMessage $message)
    {
        $this->connection = $connection;
        $this->user = $message->adapter->user;
        $this->event = $message->getFromMessage('event');
        $this->data = $message->getFromMessage('data');
    }

    public static function given(ConnectionInterface $connection, SterlingTraderMessage $message)
    {
        return new static($connection, $message);
    }

    public function process()
    {
        $handler = EventHandlerFactory::create($this->event);

        foreach ($this->user->activePulseInstructions as $instruction) {
            if (! $handler->shouldHandle($instruction)) {
                continue;
            }

            $handler
                ->on($this->connection)
                ->following($instruction)
                ->execute($this->data);
        }
    }
}
