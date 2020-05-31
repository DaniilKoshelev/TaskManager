<?php

namespace App\Controllers;

use App\Admin;
use App\Kernel\Controller;

class LoginController extends Controller
{
    public function login() {
        $request = $this->getRequestDataFromJson();
        if (authorized()) {
            return $this->sendJsonResponse(['authorized' => false, 'error' => error('SESSION_ALREADY_ACTIVE')]);
        }
        if (Admin::attemptlogin($request['username'], $request['password'])) {
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