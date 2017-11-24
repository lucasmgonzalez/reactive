<?php

namespace Reactive\Routing;

use Exception;
use React\Http\Response;
use Psr\Http\Message\ServerRequestInterface;

class Router
{
    public function __construct()
    {
    }

    public function resolve(ServerRequestInterface $request)
    {
        $path = $request->getUri()->getPath();

        switch ($path) {
            case '/':
                return new Response(
                    200,
                    array('Content-Type' => 'text/plain'),
                    'AI G-ZUS'
                );

            default:
                throw new Exception('Sumiu');
        }
    }
}
