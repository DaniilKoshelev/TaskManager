<?php

namespace App\Kernel;

class View
{
    public static function create($content, $layout, $data = null) {
        return require_once '../resources/views/' . $layout;
    }
}