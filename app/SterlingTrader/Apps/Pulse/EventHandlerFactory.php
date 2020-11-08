<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\SterlingTrader\Exceptions\EventHandlerDoesNotExist;
use App\SterlingTrader\Exceptions\InvalidEventHandlerInstance;

class EventHandlerFactory
{
    public static function create($event): EventHandler
    {
        $eventClass = '\App\SterlingTrader\Apps\Pulse\On'.$event;

        if (class_exists($eventClass)) {
            $handler = new $eventClass;

            if ($handler instanceof EventHandler) {
                return $handler;
            }

            throw new InvalidEventHandlerInstance($eventClass);
        }

        throw new EventHandlerDoesNotExist($eventClass);
    }
}
