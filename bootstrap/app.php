<?php

use App\Kernel\Route;

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

$config = require_once '../config/app.php';

Route::start();