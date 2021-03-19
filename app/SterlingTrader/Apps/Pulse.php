<?php

namespace App\SterlingTrader\Apps;

use App\Models\SterlingTrader\SterlingTraderMessage;
use App\SterlingTrader\Apps\Pulse\Events\EventHandlerFactory;
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
        EventHandlerFactory::create($this->event)
            ->on($this->connection)
            ->following($this->user->pulseInstructionsFor($this->event))
            ->handle($this->data);
    }
}
