<?php

namespace App\Kernel;

class Route
{
    public static function start() {
        $uri = $_SERVER['REQUEST_URI'];
        $routes = explode('/', $uri);

        $controllerName = getController($routes);
        $controllerAction = getControllerAction($routes);
        $controllerClass = getControllerClass($controllerName);

        if (!file_exists(getControllerFile($controllerName)))
            throw new \HttpRequestException('Not found');

        $controllerInstance = new $controllerClass;

        if (!method_exists($controllerClass, $controllerAction))
            throw new HttpRequestException('Not found');

        return $controllerInstance->$controllerAction();
    }
}