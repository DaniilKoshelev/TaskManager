<?php

use App\Kernel\Route;
use App\Kernel\Model;

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

$dbConfig = require_once '../config/database.php';
$appConfig = require_once '../config/app.php';

$dbo = new PDO(
    'mysql:host=' . $dbConfig['DB_HOST'] . ';dbname=' . $dbConfig['DB_DATABASE'],
    $dbConfig['DB_USERNAME'],
    $dbConfig['DB_PASSWORD']
);

Model::$dbo = $dbo;

session_start();

Route::start();