<?php

namespace App\SterlingTrader;

use App\SterlingTrader\Contracts\ConnectionManager;
use Illuminate\Support\Facades\Http;

class Adapter
{
    /**
     * @var \App\SterlingTrader\Contracts\ConnectionManager
     */
    private $connectionManager;

    public $id;

    public $key;

    public $secret;

    public $capacity;

    public function __construct(string $key, string $secret, int $capacity)
    {
        $this->connectionManager = app(ConnectionManager::class);

        $this->id = $key;

        $this->key = $key;

        $this->secret = $secret;

        $this->capacity = $capacity;
    }

    public static function create(string $key, string $secret, int $capacity)
    {
        return new static($key, $secret, $capacity);
    }

    /**
     * @param  string|\Psr\Http\Message\RequestInterface $request
     * @return string
     */
    public function createSignature($request)
    {
        if ($request instanceof \Psr\Http\Message\RequestInterface) {
            $path = (string) $request->getUri()->getPath();
        } else {
            $path = parse_url($request)['path'];
        }

        return hash_hmac('sha256', $path, $this->secret);
    }

    public function httpSend(string $trader, string $message)
    {
        $url = sprintf('%s:%s/sterling-trader/%s/send-message/%s',
            config('app.url'),
            config('websockets.port'),
            $this->key,
            $trader
        );

        return (string) Http::post($url, [
            'signature' => $this->createSignature($url),
            'message' => $message,
        ])->getBody();
    }

    public function send(string $trader, string $message)
    {
        $connection = $this->connectionManager->getConnection($this->key, $trader);

        if ($connection === null) {
            return false;
        }

        $connection->send($message);

        return true;
    }
}
