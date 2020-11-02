<?php

use App\SterlingTrader\Controllers\FetchConnectionsController;
use App\SterlingTrader\Controllers\SendMessageController;
use App\SterlingTrader\WebSocketsHandler;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

$route_prefix = '/sterling-trader/{adapterKey}';

WebSocketsRouter::webSocket($route_prefix.'/{traderId}/{adapterVersion}', WebSocketsHandler::class);

WebSocketsRouter::post($route_prefix.'/send-message/{trader}', SendMessageController::class);

WebSocketsRouter::get($route_prefix.'/fetch-connections', FetchConnectionsController::class);
