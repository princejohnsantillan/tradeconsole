<?php

namespace App\SterlingTrader\Controllers;

use App\SterlingTrader\Contracts\AdapterProvider;
use App\SterlingTrader\Contracts\ConnectionManager;
use App\SterlingTrader\Exceptions\IncorrectSignature;
use App\SterlingTrader\Exceptions\InvalidAdapterKey;
use BeyondCode\LaravelWebSockets\QueryParameters;
use Exception;
use Psr\Http\Message\RequestInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServerInterface;

abstract class Controller implements HttpServerInterface
{
    protected $adapterProvider;

    protected $connectionManager;

    protected $connection;

    protected $request;

    protected $parameters;

    protected $body;

    public function __construct(AdapterProvider $adapterProvider, ConnectionManager $connectionManager)
    {
        $this->adapterProvider = $adapterProvider;
        $this->connectionManager = $connectionManager;
    }

    public function onOpen(ConnectionInterface $connection, RequestInterface $request = null)
    {
        $this->connection = $connection;

        $this->request = $request;

        $this->parameters = QueryParameters::create($request);

        $this->body = json_decode((string) $request->getBody());

        $response = $this->verifySignature($request)->handle();

        $connection->send(response()->json($response));

        $connection->close();
    }

    public function onClose(ConnectionInterface $connection)
    {
    }

    public function onError(ConnectionInterface $connection, Exception $exception)
    {
        if (config('app.env') == 'production') {
            $connection->send(response()->json([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ]));
        } else {
            $connection->send(response()->json([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'trace' => $exception->getTrace(),
            ]));
        }

        $connection->close();
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
    }

    private function verifySignature(RequestInterface $request)
    {
        $adapter = $this->adapterProvider
            ->findByKey($this->getParameter('adapterKey'));

        if ($adapter === null) {
            throw new  InvalidAdapterKey;
        }

        if ($this->getField('signature') !== $adapter->signRequest($request)) {
            throw new  IncorrectSignature;
        }

        return $this;
    }

    protected function getParameter($name)
    {
        return $this->parameters->get($name);
    }

    protected function getBody($name)
    {
        if (property_exists($this->body, $name)) {
            return $this->body->{$name};
        }

        return '';
    }

    protected function getField($name)
    {
        return $this->getParameter($name) ?: $this->getBody($name);
    }

    abstract public function handle();
}
