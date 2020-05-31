<?php

namespace App\Kernel;

use PDO;
use PDOException;

abstract class Model
{
    public static $dbo;
    protected static $modelName;

    protected static function query($sql) {
        $cat = static::$dbo->query($sql);
        $table = [];
        if ($cat) {
            while ($row = $cat->fetch(PDO::FETCH_ASSOC))
                $table[] = $row;
        }
        return $table;
    }

    public static function create($model) {
        $properties = implode(',', array_keys($model));
        $values = implode(',', array_map(function ($val) {return "\"$val\"";}, array_values($model)));
        $sql = 'INSERT INTO ' . static::$modelName . " ($properties) VALUES ($values)";
        Model::$dbo->query($sql);
    }

    public static function update($id, $attributeName, $attributeValue) {
        $sql = 'UPDATE ' . static::$modelName . " SET $attributeName = \"$attributeValue\" WHERE ID = $id";
        Model::$dbo->query($sql);
    }
}