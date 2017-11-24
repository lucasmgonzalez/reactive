<?php

namespace Reactive;

use Exception;
use Reactive\Routing\Router;

class Application extends Container
{
    protected static $instance;
    protected $router;

    public static function boot()
    {
        $app = new static;

        self::setInstance($app);

        $app->singleton('router', new Router(), true);
    }
}
