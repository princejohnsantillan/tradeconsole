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

    public function __construct(int $id, string $key, string $secret, int $capacity)
    {
        $this->connectionManager = app(ConnectionManager::class);

        $this->id = $id;

        $this->key = $key;

        $this->secret = $secret;

        $this->capacity = $capacity;
    }

    public static function create(int $id, string $key, string $secret, int $capacity)
    {
        return new static($id, $key, $secret, $capacity);
    }

    /**
     * @param  string|\Psr\Http\Message\RequestInterface $request
     * @return string
     */
    public function signRequest($request)
    {
        //NOTE: Revisit if we need to improve security.
        if ($request instanceof \Psr\Http\Message\RequestInterface) {
            $path = (string) $request->getUri()->getPath();
        } else {
            $path = parse_url($request)['path'];
        }

        return hash_hmac('sha256', $path, $this->secret);
    }

    public function httpGet(string $url, array $query = [])
    {
        return (string) Http::get($url,
            array_merge($query, [
                'signature' => $this->signRequest($url),
            ])
        )->getBody();
    }

    public function httpPost(string $url, array $data = [])
    {
        return (string) Http::post($url,
            array_merge($data, [
                'signature' => $this->signRequest($url),
            ])
        )->getBody();
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
