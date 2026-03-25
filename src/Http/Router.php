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
        foreach ($this->routes[$method] ?? [] as $route => $handler) {
            $pattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $route);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches);
                return $handler(...$matches);
            }
        }

        throw new \RuntimeException('Route not found');
    }
}