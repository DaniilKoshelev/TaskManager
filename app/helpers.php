<?php

function authorized() {
    return isset($_SESSION['isAdmin']);
}

function deauthorize() {
    unset($_SESSION);
    session_destroy();
}

function authorize() {
    session_destroy();
    session_start();
    $_SESSION['isAdmin'] = true;
}

function env($option) {
    return $_ENV[$option];
}

function error($error) {
    $errors = require ('../config/error.php');
    return $errors[$error];
}

function config($option) {
    $app = require ('../config/app.php');
    $database = require ('../config/database.php');

    $config = $app + $database;

    return $config[$option];
}

function getController($routes) {
    $controllerPosition = count($routes) - 2;
    return $routes[$controllerPosition] ?? config('DEFAULT_CONTROLLER');
}

function getControllerAction($routes) {
    $controllerActionPosition = count($routes) - 1;
    return $routes[$controllerActionPosition] ?? constant('DEFAULT_CONTROLLER_ACTION');
}

function getControllerClass($controllerName) {
    return "App\Controllers\\$controllerName" . 'Controller';
}

function getControllerFile($controllerName) {
    return  __DIR__ . "/Controllers/$controllerName" . 'Controller.php';
}

function sendNotFoundError() {
    $host = 'http://' . $_SERVER['HTTP_HOST'].'/';
    header('HTTP/1.1 404 Not Found');
    header("Status: 404 Not Found");
    header('Location:' . $host . '404');
}
