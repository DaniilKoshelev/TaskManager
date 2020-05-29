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