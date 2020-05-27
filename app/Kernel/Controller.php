<?php

namespace App\Kernel;

abstract class Controller
{
    protected $requestJSON;

    public function __construct() {
        $this->requestJSON = json_decode(file_get_contents('php://input'));
    }

    public function sendJsonResponse($obj) {
        echo json_encode($obj);
    }
}