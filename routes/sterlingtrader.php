<?php

use App\SterlingTrader\WebSocketsHandler;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

/**
 * Sample address: tradeconsole.app:6002/sterling-trader/{app_key}.
 **/
WebSocketsRouter::webSocket('/sterling-trader/{appKey}/{traderId}/{adapteVersion}', WebSocketsHandler::class);
