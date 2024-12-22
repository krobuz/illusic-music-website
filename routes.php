<?php
class Router {
    private $routes = [];
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function addRoute($method, $path, $handler) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }
    
    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Debugging statements
        error_log("Request URI: " . $path);
        error_log("Request Method: " . $method);
        
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
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
        list($controller, $action) = explode('@', $handler);
        $controller = new $controller($this->db);
        return $controller->$action();
    }
}