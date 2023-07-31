<?php

namespace Core;

class Router
{
    public array $routes = [];

    public function add($uri, $handler, $method): static
    {
        $this->routes[] = [
            'uri' => $uri,
            'handler' => $handler,
            'method' => $method
        ];

        return $this;
    }
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                list($controllerPath, $action) = $this->getPathControllerAndAction($route['handler']);

                if (class_exists($controllerPath)) {
                    $controllerInstance = new $controllerPath();
                    if (method_exists($controllerInstance, $action)) {
                        return $controllerInstance->$action();
                    }
                }
            }

        }
        response('Route not found', 404);
    }

//    public function route($uri, $method)
//    {
//        foreach ($this->routes as $route) {
//            $pattern = str_replace('/', '\/', $route['uri']);
//            $pattern = preg_replace('/{(\w+)}/', '(?<$1>[^\/]+)', $pattern);
//            $pattern = "/^{$pattern}$/";
//
//            if (preg_match($pattern, $uri, $matches) && $route['method'] === strtoupper($method)) {
//                $handlerInfo = $this->getPathControllerAndAction($route['handler']);
//                $controllerPath = $handlerInfo['controller'];
//                $action = $handlerInfo['action'];
//
//                if (class_exists($controllerPath)) {
//                    $controllerInstance = new $controllerPath();
//                    $params = [];
//                    foreach ($matches as $key => $value) {
//                        if (!is_numeric($key)) {
//                            $params[$key] = $value;
//                        }
//                    }
//
//                    if (method_exists($controllerInstance, $action)) {
//                        return $controllerInstance->$action($params['id']);
//                    }
//                }
//            }
//        }
//
//        response('Route not found', 404);
//    }


//    public function getPathControllerAndAction($handler): array
//    {
//        $controllerAndAction = explode('@', $handler);
//        $controllerFolder = $this->getFolderController($controllerAndAction[0]);
//        $controllerPath = 'Controllers\\' . $controllerFolder . "\\$controllerAndAction[0]";
//        $action = $controllerAndAction[1];
//
//        return [
//            'controller' => $controllerPath,
//            'action' => $action,
//        ];
//    }


    public function getFolderController($controllerName): string
    {
        $controller = '';
        $controllerSuffix = 'Controller';

        if (str_ends_with($controllerName, $controllerSuffix)) {
            $controller = substr($controllerName, 0, -strlen($controllerSuffix));
        }

        return $controller;
    }

    public function get($uri, $handler): static
    {
        return $this->add($uri, $handler, 'GET');
    }

    public function post($uri, $controller): static
    {
        return $this->add($uri, $controller, 'POST');
    }

    public function patch($uri, $controller): static
    {
        return $this->add($uri, $controller, 'PATCH');
    }

    public function getPathControllerAndAction($handler): array
    {
        $controllerAndAction = explode('@', $handler);
        $controllerFolder = $this->getFolderController($controllerAndAction[0]);
        $controllerPath = 'Controllers\\' . $controllerFolder . "\\$controllerAndAction[0]";
        $action = $controllerAndAction[1];
        return array($controllerPath, $action);
    }

}