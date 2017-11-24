<?php

namespace Reactive\Server;

use Exception;

class Server
{
    protected static $instance;

    protected $host = '127.0.0.1';
    protected $port;

    protected $loop;
    protected $socket;
    protected $http;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    protected function __construct()
    {
        $this->port = env('PORT', 8080);
        
        // Creating EventLoop
        $this->loop = \React\EventLoop\Factory::create();
        
        // Creating Socket Server
        $this->socket = new \React\Socket\Server($this->port, $this->loop);

        // Building Http Server
        $this->http = new \React\Http\Server(new ServerHandler());
        
        // Handling Error
        $this->http->on('error', function (Exception $e) {
            echo 'Error: ' . $e->getMessage() . PHP_EOL;
            if ($e->getPrevious() !== null) {
                $previousException = $e->getPrevious();
                echo $previousException->getMessage() . PHP_EOL;
            }
        });
    }

    private function __clone()
    {
    }

    public function run()
    {
        $this->http->listen($this->socket);
        
        echo "Server running at http://$this->host:$this->port\n";
        
        $this->loop->run();
    }
}
