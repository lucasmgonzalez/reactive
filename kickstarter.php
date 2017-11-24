<?php

// Loading vendor
require 'vendor/autoload.php';

// Loading DotEnv
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

if (!function_exists('env')) {
    function env($name, $default)
    {
        return getenv($name) ?: $default;
    }
}

// Booting application
$app = Reactive\Application::boot();

if (!function_exists('app')) {
    function app($name = null)
    {
        if (null === $name) {
            return \Reactive\Application::getInstance();
        } else {
            return \Reactive\Application::getInstance()->make($name);
        }
    }
}
