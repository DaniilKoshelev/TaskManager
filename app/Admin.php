<?php

namespace App;

use App\Kernel\Model;

class Admin extends Model
{
    protected static $modelName = 'Admin';

    public static function attemptLogin($username, $password) {
        $hash = md5($password);
        $sql = 'SELECT * FROM ' . self::$modelName . " WHERE username = \"$username\" AND password = \"$hash\"";
        $admins = static::query($sql);
        return !empty($admins);
    }
}