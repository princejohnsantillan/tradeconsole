<?php

namespace App\SterlingTrader\Apps;

use App\Models\SterlingTrader\SterlingTraderMessage;
use App\SterlingTrader\AdapterRequest;
use App\SterlingTrader\AdapterResponse;
use Ratchet\ConnectionInterface;

class Pulse
{
    private $connection;

    private $message;

    private $event;

    public function __construct(ConnectionInterface $connection, SterlingTraderMessage $message)
    {
        $this->connection = $connection;
        $this->message = $message;
        $this->event = $message->getEvent();
    }

    public static function given(ConnectionInterface $connection, SterlingTraderMessage $message)
    {
        return new static($connection, $message);
    }

    public function process()
    {
        //TODO: Check pulse settings and respond accordingly.

        //NOTE: for each setting check conditions and mutate to configuration.

        switch ($this->event) {
            case AdapterRequest::ORDERUPDATE:
                $this->onOrderUpdate();
                break;

            case AdapterRequest::TRADEUPDATE:
                $this->onTradeUpdate();
                $this->connection->send(AdapterResponse::getPositionList());
                break;

            case AdapterRequest::POSITIONUPDATE:
                $this->onPositionUpdate();
                break;

            default:

        }
    }

    private function onOrderUpdate()
    {
        // $this->connection->send(AdapterResponse::submitOrderStruct());
    }

    private function onTradeUpdate()
    {
        // $this->connection->send(AdapterResponse::submitOrderStruct());
    }

    private function onPositionUpdate()
    {
        // $this->connection->send(AdapterResponse::submitOrderStruct());
    }
}
