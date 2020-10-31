<?php

use App\SterlingTrader\SendMessageToSterlingTrader;
use App\SterlingTrader\WebSocketsHandler;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

/*
 * Sample address: tradeconsole.app:6002/sterling-trader/{app_key}.
 **/
WebSocketsRouter::webSocket('/sterling-trader/{appKey}/{traderId}/{adapteVersion}', WebSocketsHandler::class);

WebSocketsRouter::post('/sterling-trader/{appKey}/send-message', SendMessageToSterlingTrader::class);
/*
 * Send message using Guzzle
 * example: Http::post('https://tradeconsole.dev:6001/sterling-trader/{appKey}/send-message', ['message' => $message])
 *
 */
