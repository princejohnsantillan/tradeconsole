<?php

use App\SterlingTrader\Controllers\FetchConnectionsController;
use App\SterlingTrader\Controllers\FetchPositionsController;
use App\SterlingTrader\Controllers\SendDataController;
use App\SterlingTrader\WebSocketsHandler;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

$route_prefix = '/sterling-trader/{adapterKey}';

WebSocketsRouter::webSocket($route_prefix.'/{traderId}/{adapterVersion}', WebSocketsHandler::class);

WebSocketsRouter::post($route_prefix.'/send-data/{traderId}', SendDataController::class);

WebSocketsRouter::get($route_prefix.'/fetch-connections', FetchConnectionsController::class);

WebSocketsRouter::get($route_prefix.'/fetch-positions', FetchPositionsController::class);
