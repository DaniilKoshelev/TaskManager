<?php

namespace App\Controllers;

use App\Kernel\Controller;
use App\Kernel\View;

class HomeController extends Controller
{
    public function index() {
        return View::create('home.php', 'layout.php');
    }
}