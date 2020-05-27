<?php

namespace App\Controllers;

use App\Admin;
use App\Kernel\Controller;

class AuthController extends Controller
{
    const AUTHENTICATED_MESSAGE = 'Authenticated';
    const WRONG_CREDITS_ERROR = "Wrong credits";

    public function login() {
        if (Admin::attemptlogin($this->requestJSON->username, $this->requestJSON->password)) {
            $this->sendJsonResponse(['message' => self::AUTHENTICATED_MESSAGE]);
            session_start();
        } else {
            $this->sendJsonResponse(['error' => self::WRONG_CREDITS_ERROR]);
        }
    }

    public function logout() {
        session_abort();
    }
}