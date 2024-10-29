<?php

class Router {
    private $routes = [];

    public function addRoute($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action,
        ];
    }

    public function resolve() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = trim($_SERVER['REQUEST_URI'], '/');
    
        foreach ($this->routes as $route) {
            if ($requestMethod === $route['method']) {
                $pattern = preg_replace('/\{[^\/]+\}/', '([^\/]+)', $route['path']);
                if (preg_match('#^' . $pattern . '$#', $requestUri, $matches)) {
                    array_shift($matches); // Eliminar el primer elemento que es la coincidencia completa
                    $controller = new $route['controller']();
                    return call_user_func_array([$controller, $route['action']], $matches);
                }
            }
        }
    
        http_response_code(404);
        echo json_encode(['message' => 'Ruta no encontrada']);
    }    
}