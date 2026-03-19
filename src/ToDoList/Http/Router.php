<?php

namespace App\Http;

class Router
{
    private array $routes = [];

    public function add(string $method, string $path, callable $handler):void
    {
        $this->routes[$method][$path] = $handler;
    }

    public function dispatch(string $method, string $path)
    {
        if(!isset($this->routes[$method][$path])){
            throw new \RuntimeException('Route not found');
        }

        return $this->routes[$method][$path]();
    }
}