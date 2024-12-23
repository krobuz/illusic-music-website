<?php
class Router {
    private $routes = [];
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addRoute($method, $path, $handler) {
        $this->routes[] = compact('method', 'path', 'handler');
    }

    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        error_log("Request URI: $path");
        error_log("Request Method: $method");

        if ($path === '/music_website' || $path === '/music_website/') {
            include 'views/unlogin.php';
            return;
        }

        foreach ($this->routes as $route) {
            $routePath = rtrim($route['path'], '/');
            if ($route['method'] === $method && $routePath === $path) {
                $handler = $route['handler'];
                if (is_callable($handler)) {
                    return $handler();
                }
                return $this->handleControllerAction($handler);
            }
        }

        include 'views/404.php';
    }

    private function handleControllerAction($handler) {
        try {
            list($controller, $action) = explode('@', $handler);
            if (!class_exists($controller)) {
                throw new Exception("Controller $controller not found.");
            }
            $controllerInstance = new $controller($this->db);
            if (!method_exists($controllerInstance, $action)) {
                throw new Exception("Action $action not found in controller $controller.");
            }
            return $controllerInstance->$action();
        } catch (Exception $e) {
            error_log($e->getMessage());
            include 'views/404.php';
        }
    }
}
