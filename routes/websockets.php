<?php

use App\Websockets\SterlingTraderHandler;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

WebSocketsRouter::webSocket('/sterling/{appKey}/{trader_id}', SterlingTraderHandler::class);
