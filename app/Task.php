<?php

namespace App;

use App\Kernel\Model;

class Task extends Model
{
    protected static $modelName = 'Task';

    /**
     * @param $number
     * @param string $sort
     * @return array
     * @throws \Exception
     */
    public static function getPage($number, $sort = 'ID ASC') {
        $maxPageCount = config('MAX_PAGE_COUNT');

        $select = ['order' => "$sort"];
        $sql = 'SELECT * FROM ' . self::$modelName . static::getSelect($select);

        $tasks = static::query($sql);

        foreach($tasks as &$task) {
            $task['tags'] = array_values(Task::getTags($task['id']));
        }

        $tasksCount = count($tasks);
        $pagesCount = ceil($tasksCount / $maxPageCount);

        if ($number <= $pagesCount) {
            return array_slice($tasks, $number * $maxPageCount, $maxPageCount);
        }
        return [];
    }

    public static function getTags($id) {
        $sql = "select Tag.Description Description, Tag.ID ID from Task
                inner join TaskTag on TaskID = Task.ID
                inner join Tag on TagID = Tag.ID WHERE Task.ID = $id";

        $rows = static::query($sql);

        $tags = [];
        foreach($rows as $row) {
            $tags[$row['ID']] = $row['Description'];
        }
        return $tags;
    }

    public static function setTag($id, $tagId) {
        $sql = "insert into TaskTag(TaskID, TagID) value ($id, $tagId)";
        static::query($sql);
    }

    public static function tagExists($id, $tagId) {
        return isset(Task::getTags($id)[$tagId]);
    }
}