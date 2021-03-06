<?php

use App\Kernel\Route;
use App\Kernel\Model;

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

$dbo = new PDO(
    'mysql:host=' . config('DB_HOST') . ';dbname=' . config('DB_DATABASE'),
    config('DB_USERNAME'),
    config('DB_PASSWORD')
);

Model::$dbo = $dbo;

session_start();

try {
    echo Route::start();
} catch (HttpRequestException $e) {
    sendNotFoundError();
} catch (Exception $e) {
    echo error('WRONG_REQUEST');
}