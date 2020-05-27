<?php

namespace App\Controllers;

use App\Kernel\Controller;
use App\Kernel\View;
use App\Task;

class HomeController extends Controller
{
    public function index() {
        View::create('home.php', 'layout.php');
    }
}