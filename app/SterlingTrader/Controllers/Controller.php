<?php

namespace App\SterlingTrader\Controllers;

use App\SterlingTrader\Contracts\AdapterProvider;
use App\SterlingTrader\Contracts\ConnectionManager;
use BeyondCode\LaravelWebSockets\QueryParameters;
use Exception;
use Psr\Http\Message\RequestInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class Controller implements HttpServerInterface
{
    protected $adapterProvider;

    protected $connectionManager;

    protected $request;

    protected $parameters;

    public function __construct(AdapterProvider $adapterProvider, ConnectionManager $connectionManager)
    {
        $this->adapterProvider = $adapterProvider;
        $this->connectionManager = $connectionManager;
    }

    public function onOpen(ConnectionInterface $connection, RequestInterface $request = null)
    {
        $this->request = $request;

        $this->parameters = QueryParameters::create($request);

        $response = $this->verifySignature($request)->handle();

        $connection->send(response()->json($response));

        $connection->close();
    }

    public function onClose(ConnectionInterface $connection)
    {
    }

    public function onError(ConnectionInterface $connection, Exception $e)
    {
        if (config('app.env') == 'production') {
            $connection->send(response()->json([
                'message' => $e->getMessage(),
            ]));
        } else {
            $connection->send(response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
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
            ->findByKey($this->parameters->get('adapterKey'));

        if ($adapter === null) {
            throw new  HttpException(401, 'Invalid adapter key.');
        }

        $requestSignature = $this->parameters->get('signature');

        $authSignature = $adapter->createSignature($request);

        if ($requestSignature !== $authSignature) {
            throw new  HttpException(401, 'Unauthorized.');
        }

        return $this;
    }

    protected function getParameter($name)
    {
        return $this->parameters->get($name);
    }

    abstract public function handle();
}
