<?php

namespace App\Controllers;

use App\Kernel\Controller;
use App\Task;
use App\Kernel\View;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $tasks = Task::all();
        $this->view->create('home.php', 'layout.php', $tasks);
    }
}