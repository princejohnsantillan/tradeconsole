<?php

namespace App\SterlingTrader\Apps\Pulse;

use App\SterlingTrader\Apps\Pulse\Exceptions\EventHandlerDoesNotExist;
use App\SterlingTrader\Apps\Pulse\Exceptions\InvalidEventHandlerInstance;

class EventHandlerFactory
{
    public static function create($event): EventHandler
    {
        $eventClass = '\App\SterlingTrader\Apps\Pulse\On'.$event;

        throw_unless(class_exists($eventClass), new EventHandlerDoesNotExist($eventClass));

        $handler = new $eventClass;

        throw_unless($handler instanceof EventHandler, new InvalidEventHandlerInstance($eventClass));

        return $handler;
    }
}
