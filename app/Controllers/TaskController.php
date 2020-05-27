<?php

namespace App\Controllers;

use App\Kernel\Controller;
use App\Task;

class TaskController extends Controller
{
    const OUT_OF_RANGE_ERROR = 'Page is out of range';

    public function get() {
        try {
            $this->sendJsonResponse(Task::getPage($this->requestJSON->page));
        } catch (\Exception $e) {
            $this->sendJsonResponse(['error' => self::OUT_OF_RANGE_ERROR]);
        }
    }

    public function create() {
        $task = new Task([
            'User' => $this->requestJSON->user,
            'Email' => $this->requestJSON->email,
            'Description' => $this->requestJSON->description,
            'Status' => 0
        ]);
        $task->save();
    }
}