<?php

namespace App\Kernel;

use ArrayAccess;
use PDOException;

abstract class Model implements ArrayAccess
{
    public static $dbo;
    protected static $modelName;
    protected $id;

    abstract protected function fields();

    protected static function getSelect($select = null) {
        if(is_array($select)){
            $allQuery = array_keys($select);
            array_walk($allQuery, function(&$val){
                $val = strtoupper($val);
            });

            $querySql = "";
            if(in_array("WHERE", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "WHERE"){
                        $querySql .= " WHERE " . $val;
                    }
                }
            }

            if(in_array("GROUP", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "GROUP"){
                        $querySql .= " GROUP BY " . $val;
                    }
                }
            }

            if(in_array("ORDER", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "ORDER"){
                        $querySql .= " ORDER BY " . $val;
                    }
                }
            }

            if(in_array("LIMIT", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "LIMIT"){
                        $querySql .= " LIMIT " . $val;
                    }
                }
            }

            return $querySql;
        }
        return false;
    }

    public static function query($sql) {
        try {
            $cat = static::$dbo->query($sql);
            return $cat->fetchAll();
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function all() {
        $modelName = static::$modelName;
        $modelClass = "App\\$modelName";

        $rows = static::query("SELECT * FROM " . $modelName);
        $models = [];
        foreach($rows as $row) {
            $models[] = new $modelClass($row);
        }
        return $models;
    }

    public function save() {
        $fields = implode(',', $this->fields());
        $arr = [];

        foreach ($this->fields() as $field) {
            $arr[] = ($this->$field === "") ? "NULL" : "\"$this[$field]\"";
        }
        $values = implode(',', $arr);

        $sql = 'INSERT INTO ' . static::$modelName . " ($fields) VALUES ($values)";
        static::$dbo->query($sql);
    }

    public function offsetExists($offset) {
        return property_exists(self::class, $offset);
    }

    public function offsetGet($offset) {
        return $this->$offset;
    }

    public function offsetSet($offset, $value) {
        $this->$offset = $value;
    }

    public function offsetUnset($offset) {
        unset($this->$offset);
    }
}