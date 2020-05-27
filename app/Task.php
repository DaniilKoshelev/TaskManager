<?php

namespace App;

use App\Kernel\Model;

class Task extends Model
{
    public static function all() {
        return [
            [
                'User' => 'User1',
                'Email' => 'User1@gmail.com',
                'Tags' => ['Tag1', 'Tag2']
            ],
            [
                'User' => 'User2',
                'Email' => 'User2@gmail.com',
                'Tags' => ['Tag1']
            ]
        ];
    }
}