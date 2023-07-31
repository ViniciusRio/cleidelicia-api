<?php

namespace Core;

class Router
{
    public array $routes = [];

    public function add($uri, $controller, $method): static
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];

        return $this;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return require base_path('controllers/' . $route['controller']);
            }
        }
        response('Route not found', 404);
    }

    public function get($uri, $controller): static
    {
        return $this->add($uri, $controller, 'GET');
    }

    public function post($uri, $controller) : static
    {
        return $this->add($uri, $controller, 'POST');
    }
    public function patch($uri, $controller) : static
    {
        return $this->add($uri, $controller, 'PATCH');
    }

}