<?php

namespace App\Controllers;

use App\Admin;
use App\Kernel\Controller;

class AuthController extends Controller
{
    const WRONG_CREDITS_ERROR = "Wrong credits";
    const SESSION_ALREADY_ACTIVE_ERROR = "Session already acitve";

    public function login() {
        $error = self::SESSION_ALREADY_ACTIVE_ERROR;

        if (!authorized()) {
            if (Admin::attemptlogin($this->requestJSON->username, $this->requestJSON->password)) {
                $this->sendJsonResponse(['authorized' => true]);
                authorize();
                return;
            }
            $error = self::WRONG_CREDITS_ERROR;
        }
        $this->sendJsonResponse(['authorized' => false, 'error' => $error]);
    }

    public function logout() {
        if (authorized()) deauthorize();
    }

    public function isAdmin() {
        $this->sendJsonResponse(['isAdmin' => authorized()]);
    }
}