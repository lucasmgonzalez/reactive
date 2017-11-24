<?php

namespace Reactive\Server;

use Reactive\Router;
use Psr\Http\Message\ServerRequestInterface;

class ServerHandler
{
    public function __invoke(ServerRequestInterface $request)
    {
        $response = app('router')->resolve($request);
        // Route request
        
        // Middlewares?

        // return Response

        return $response;
    }
}
