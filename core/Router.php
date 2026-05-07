<?php

namespace Core;

class Router
{

    private $routes = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch($uri)
    {

        $method = $_SERVER['REQUEST_METHOD'];

        // limpiar URL (?id=1 etc)
        $uri = parse_url($uri, PHP_URL_PATH);

        // 🔥 quitar carpeta base del proyecto
        $base = '/facturacion-pro/public';

        if (strpos($uri, $base) === 0) {
            $uri = substr($uri, strlen($base));
        }

        if ($uri === '') {
            $uri = '/';
        }

        if (isset($this->routes[$method][$uri])) {

            $action = $this->routes[$method][$uri];

            [$controller, $method] = explode('@', $action);

            $controller = "App\\Controllers\\$controller";

            $controllerInstance = new $controller();

            return $controllerInstance->$method();
        }

        http_response_code(404);
        echo "404 - Ruta no encontrada";
    }
}
