<?php

namespace App\Kernel;

class View
{
    public function create($content, $layout, $data = null) {
        /*
        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }
        */

        require_once '../resources/views/' . $layout;
    }
}