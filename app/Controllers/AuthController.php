<?php

namespace App\Controllers;

use App\Admin;
use App\Kernel\Controller;

class AuthController extends Controller
{
    public function login() {
        if (authorized()) {
            return $this->sendJsonResponse(['authorized' => false, 'error' => error('SESSION_ALREADY_ACTIVE')]);
        }
        if (Admin::attemptlogin($this->requestJSON->username, $this->requestJSON->password)) {
            authorize();
            return $this->sendJsonResponse(['authorized' => true]);
        }
        return $this->sendJsonResponse(['authorized' => false, 'error' => error('WRONG_CREDITS')]);
    }

    public function logout() {
        if (authorized()) deauthorize();
    }

    public function isAdmin() {
        return $this->sendJsonResponse(['isAdmin' => authorized()]);
    }
}