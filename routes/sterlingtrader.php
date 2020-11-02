<?php

use App\SterlingTrader\Controllers\FetchConnectionsController;
use App\SterlingTrader\Controllers\SendMessageController;
use App\SterlingTrader\WebSocketsHandler;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

WebSocketsRouter::webSocket('/sterling-trader/{adapterKey}/{traderId}/{adapterVersion}', WebSocketsHandler::class);

WebSocketsRouter::get('/sterling-trader/{adapterKey}/send-message/{traderId}', SendMessageController::class);

WebSocketsRouter::get('/sterling-trader/{adapterKey}/fetch-connections', FetchConnectionsController::class);
