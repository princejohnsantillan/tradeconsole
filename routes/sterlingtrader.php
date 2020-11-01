<?php

use App\SterlingTrader\Controllers\FetchConnectionsController;
use App\SterlingTrader\Controllers\SendMessageController;
use App\SterlingTrader\WebSocketsHandler;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

/*
 * Sample address: tradeconsole.app:6002/sterling-trader/{app_key}.
 **/
WebSocketsRouter::webSocket('/sterling-trader/{adapterKey}/{traderId}/{adapterVersion}', WebSocketsHandler::class);

WebSocketsRouter::post('/sterling-trader/{adapterKey}/send-message/{traderId}', SendMessageController::class);

WebSocketsRouter::get('/sterling-trader/{adapterKey}/fetch-connections', FetchConnectionsController::class);
