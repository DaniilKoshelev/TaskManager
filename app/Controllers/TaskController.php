<?php

namespace App\Controllers;

use App\Kernel\Controller;
use App\Task;

class TaskController extends Controller
{
    public function get() {
        return $this->sendJsonResponse(Task::getPage($this->requestJSON->page, $this->requestJSON->sort));
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
        if (!authorized()) return;

        $id = $this->requestJSON->id;
        $tagId =$this->requestJSON->tagId;

        if (!Task::tagExists($id, $tagId)) Task::setTag($id, $tagId);
    }
}