<?php

namespace App\Controllers;

use App\Kernel\Controller;
use App\Task;

class TaskController extends Controller
{
    public function get() {
        $request = $this->getRequestDataFromJson();
        return $this->sendJsonResponse(Task::getPage($request['page'], $request['sort']));
    }

    public function create() {
        $modelAttributes = $this->getRequestDataFromJson();
        $modelAttributes['Status'] = 0;
        Task::create($modelAttributes);
    }

    public function update() {
        if (authorized()) {
            $json = $this->getRequestDataFromJson();
            Task::update($json['id'], $json['attributeName'], $json['attributeValue']);
        }
    }

    public function setTag() {
        if (!authorized()) return;

        $request = $this->getRequestDataFromJson();

        if (!Task::tagExists($request['id'], $request['tagId'])) Task::setTag($request['id'], $request['tagId']);
    }
}