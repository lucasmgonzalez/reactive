<?php

namespace Reactive;

use Closure;

class Container
{
    protected static $instance;

    protected $bindings = [];
    protected $instances = [];

    public function bind($abstract, $concrete = null, $shared = false)
    {
        if (null === $concrete) {
            $concrete = $abstract;
        }

        $this->bindings[$abstract] = [
            'concrete' => $concrete,
            'shared' => $shared,
        ];
    }

    public function singleton($abstract, $concrete = null)
    {
        $this->bind($abstract, $concrete, true);
    }

    public function instance($abstract, $concrete)
    {
        $this->instances[$abstract] = $concrete;
    }

    public function isBound($abstract)
    {
        return isset($this->bindings[$abstract]);
    }

    public function isShared($abstract)
    {
        return (isset($this->bindings[$abstract]['shared']) && $this->bindings[$abstract]['shared'] === true);
    }

    public function make($abstract)
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        if ($this->bindings[$abstract]) {
            $concrete = is_string($this->bindings[$abstract]['concrete']) ? new $this->bindings[$abstract]['concrete']() : $this->bindings[$abstract]['concrete'];

            if ($this->isShared($abstract)) {
                $this->instance($abstract, $concrete);
            }
        }

        return $concrete;
    }

    protected function __construct()
    {
    }

    public static function getInstance()
    {
        return self::$instance;
    }

    public static function setInstance($instance)
    {
        self::$instance = $instance;
    }
}
