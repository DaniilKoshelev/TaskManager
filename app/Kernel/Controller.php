<?php

namespace App\Kernel;

abstract class Controller
{
    protected function sendJsonResponse($obj) {
        return json_encode($obj);
    }

    protected function getRequestDataFromJson() {
        return json_decode(file_get_contents('php://input'), true);
    }
}