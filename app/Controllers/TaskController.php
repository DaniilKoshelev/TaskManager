<?php

namespace App\Controllers;

use App\Kernel\Controller;
use App\Task;

class TaskController extends Controller
{
    const OUT_OF_RANGE_ERROR = 'Page is out of range';

    public function get() {
        try {
            $this->sendJsonResponse(Task::getPage($this->requestJSON->page, $this->requestJSON->sort));
        } catch (\Exception $e) {
            $this->sendJsonResponse(['error' => self::OUT_OF_RANGE_ERROR]);
        }
    }

    public function create() {
        Task::create([
            'User' => $this->requestJSON->user,
            'Email' => $this->requestJSON->email,
            'Description' => $this->requestJSON->description,
            'Status' => 0
        ]);
    }

    public function update() {
        if (authorized()) {
            Task::update($this->requestJSON->id, $this->requestJSON->attributeName, $this->requestJSON->attributeValue);
        }
    }

    public function setTag() {
        if (authorized()) {
            $id = $this->requestJSON->id;
            $tagId =$this->requestJSON->tagId;
            if (!isset(Task::getTags($id)[$tagId])) {
                Task::setTag($id, $tagId);
            }
        }
    }
}