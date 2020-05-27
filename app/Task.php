<?php

namespace App;

use App\Kernel\Model;

class Task extends Model
{
    public $user;
    public $email;
    public $description;
    public $status;
    public $tags;

    protected static $modelName = 'Task';

    public function __construct($attrs) {
        if (key_exists('ID', $attrs)) {
            $this->id = $attrs['ID'];
            $this->tags = $this->getTags();
        }
        if (key_exists('User', $attrs)) $this->user = $attrs['User'];
        if (key_exists('Email', $attrs)) $this->email = $attrs['Email'];
        if (key_exists('Description', $attrs)) $this->description = $attrs['Description'];
        if (key_exists('Status', $attrs)) $this->status = $attrs['Status'];
    }

    /**
     * @param $number
     * @return array
     * @throws \Exception
     */
    public static function getPage($number) {
        global $appConfig;
        $maxPageCount = $appConfig['MAX_PAGE_COUNT'];
        if ($number < 0) {
            throw new \Exception("Page number cannot be negative");
        }
        $tasks = static::all();
        $tasksCount = count($tasks);
        $pagesCount = ceil($tasksCount / $maxPageCount);

        if ($number <= $pagesCount) {
            return array_slice($tasks, $number * $maxPageCount, $maxPageCount);
        }

        return [];
    }

    public function getTags() {
        $sql = "select Tag.Description Description from Task
                inner join TaskTag on TaskID = Task.ID
                inner join Tag on TagID = Tag.ID WHERE Task.ID = $this->id";
        $rows = static::query($sql);
        $tags = [];
        foreach($rows as $row) {
            $tags[] = $row['Description'];
        }
        return $tags;
    }

    protected function fields() {
        return ['user', 'email', 'description', 'status'];
    }
}