<?php

namespace App;

use App\Kernel\Model;

class Admin extends Model
{
    public $username;
    public $password;

    protected static $modelName = 'Admin';

    public static function attemptLogin($username, $password) {
        $hash = md5($password);
        $select = ['where' => "username = \"$username\" and password = \"$hash\""];
        $sql = "SELECT * FROM " . self::$modelName . static::getSelect($select);
        return (count(static::query($sql)) > 0);
    }

    protected function fields() {
        return ['id', 'username', 'password'];
    }
}