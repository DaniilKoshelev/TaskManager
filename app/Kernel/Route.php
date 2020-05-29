<?php

namespace App\Kernel;

class Route
{
    //TODO: FIX CONSTANTS!
    public static function start() {
        $url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

        $routes = explode('/', $url);

        $controllerName = $routes[3] ?? 'Home';
        $action = $routes[4] ??'index';

        $controllerClass = "App\Controllers\\$controllerName" . 'Controller';
        $controller = new $controllerClass;

        if (method_exists($controllerClass, $action)) return $controller->$action();

        return Route::ErrorPage404();
    }

    protected static function ErrorPage404() {
        $host = 'http://' . $_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}