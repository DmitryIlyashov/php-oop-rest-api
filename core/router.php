<?php

class Router {

    public static function start() {
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($routes[2])) {
            $router = substr(strtolower($routes[2]), 0, -1);
        }

        $routeFilePath = 'routes/'.$router.'.php';

        if (file_exists($routeFilePath)) {
            include_once $routeFilePath;
        } else {
            echo '404';
        }

        $router = ucfirst($router);

        $controller = new $router;
        
        if ($method === 'GET') {
            if (isset($routes[3])) {
                $action = 'get'.$router;
            } else {
                $action = 'get'.$router.'s';
            }
        } else if ($method === 'POST') {
            $action = 'add'.$router;
        }

        $controller->$action();
    }

}