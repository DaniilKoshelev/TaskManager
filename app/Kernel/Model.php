<?php

namespace App\Kernel;

use ArrayAccess;
use PDO;
use PDOException;

abstract class Model
{
    public static $dbo;
    protected static $modelName;

    //TODO: Refactor repeating code ()
    protected static function getSelect($select = null) {
        if (!is_array($select)) return false;

        $allQuery = array_keys($select);
        array_walk($allQuery, function(&$val) { $val = strtoupper($val); });

        $querySql = '';

        if (in_array('WHERE', $allQuery))
            foreach($select as $key => $val)
                if (strtoupper($key) === 'WHERE')
                    $querySql .= ' WHERE ' . $val;

        if (in_array('GROUP', $allQuery))
            foreach($select as $key => $val)
                if(strtoupper($key) === 'GROUP')
                    $querySql .= ' GROUP BY ' . $val;

        if (in_array('ORDER', $allQuery))
            foreach($select as $key => $val)
                if(strtoupper($key) === 'ORDER')
                    $querySql .= ' ORDER BY ' . $val;

        if (in_array('LIMIT', $allQuery))
            foreach($select as $key => $val)
                if(strtoupper($key) === 'LIMIT')
                    $querySql .= ' LIMIT ' . $val;

        return $querySql;

    }

    protected static function query($sql) {
        try {
            $cat = static::$dbo->query($sql);
            $table = [];
            if ($cat) {
                while ($row = $cat->fetch(PDO::FETCH_ASSOC))
                    $table[] = $row;
            }
            return $table;
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function create($model) {
        $properties = implode(',', array_keys($model));
        $values = implode(',', array_map(function ($val) {return "\"$val\"";}, array_values($model)));
        $sql = 'INSERT INTO ' . static::$modelName . " ($properties) VALUES ($values)";
        Model::$dbo->query($sql);
    }

    public static function update($id, $attributeName, $attributeValue) {
        $select = self::getSelect(['where' => "ID = $id"]);
        $sql = 'UPDATE ' . static::$modelName . ' SET ' . $attributeName . " = \"$attributeValue\" "  . $select;
        static::$dbo->query($sql);
    }
}