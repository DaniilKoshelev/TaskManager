<?php
//hardcode in this file!
namespace App\Kernel;

use App\Controllers\HomeController;

class Route
{
    static function start() {
        // Default
        //TODO: Get rid of Controller word

        $controller = 'HomeController';
        $action = 'index';

//        $routes = explode('/', $_SERVER['REQUEST_URI']);
//
//        // получаем имя контроллера
//        if (!empty($routes[1])) {
//            $controller = $routes[1];
//        }
//
//        // получаем имя экшена
//        if (!empty($routes[2])) {
//            $action = $routes[2];
//        }
//
//        // добавляем префиксы
//
//        // подцепляем файл с классом модели (файла модели может и не быть)
//
//
        // подцепляем файл с классом контроллера
        $controllerFile = $controller . '.php';
        $controllerPath = "../Controllers/" . $controllerFile;
        $controllerClass = "App/Controllers/HomeController";

        if(file_exists($controllerPath)) {
            require $controllerPath;
        }
//        else {
//            //TODO: Excpetion
//            Route::ErrorPage404();
//        }

        echo 1;
        $controller = new HomeController();

        if(method_exists($controller, $action)) {
            $controller->$action();
        } else {
            //TODO: Excpetion
            Route::ErrorPage404();
        }


    }

    public static function ErrorPage404() {
        $host = 'http://' . $_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}