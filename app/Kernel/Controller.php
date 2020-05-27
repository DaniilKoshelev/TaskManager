<?php

namespace App\Kernel;

class Controller
{
    public $view;

    function __construct() {
        $this->view = new View();
    }

    function index() {

    }
}