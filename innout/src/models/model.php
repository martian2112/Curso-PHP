<?php

class Model {
    protected static $tablename = '';
    protected static $columns = [];
    protected $values =[];

    function __construct($arr) {
        $this->loadfromarray($arr);
    }

    public function loadfromarray($arr) {
        if($arr) {
            foreach($arr as $key => $value){
                $this->$key = $value;
            }
        }
    }

    public function __get($key) {
        return $this->values[$key];
    }

    public function __set($key, $value){
        $this->values[$key] = $value;
    }

    public static function getone($filters = [], $columns = '*'){
        $class = get_called_class();
        $result = static::getselect($filters, $columns);
        return $result ? new $class($result->fetch_assoc()) : null;
    }

    public static function get($filters = [], $columns = '*'){
        $objects = [];
        $result = static::getselect($filters, $columns);
        if($result){
            $class = get_called_class();
            while($row = $result->fetch_assoc()){
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public static function getselect($filters = [], $columns = '*') {
        $sql = "SELECT {$columns} FROM "  . static::$tablename . static::getfilters($filters);
        $result = Database::getResultFromQuery($sql);
        if($result->num_rows === 0){
            return null;
        }else{
            return $result;
        }
    }

    public function insert(){
        $sql = "INSERT INTO " . static::$tablename . " ("
            . implode(",", static::$columns) . ") VALUES (";
            foreach(static::$columns as $col) {
                $sql .= static::getformatedvalue($this->$col) . ",";
            }
            $sql[strlen($sql) - 1] = ')';
            $id = Database::executeSQL($sql);
            $this->id = $id;
    }

    public function update() {
        $sql = "UPDATE " . static::$tablename . " SET ";
        foreach(static::$columns as $col){
            $sql .= " ${col} = " .static::getformatedvalue($this->$col) . ",";
        }
        $sql[strlen($sql) - 1] = ' ';
        $sql .= "WHERE id = {$this->id}";
        Database::executeSQL($sql);
    }

    private static function getfilters($filters) {
        $sql = '';
        if(count($filters) > 0){
            $sql .= " WHERE 1 = 1";
            foreach($filters as $columns => $value){
                $sql .= " AND ${columns} = " . static::getformatedvalue($value);
            }
        }
        return $sql;
    }

    private static function getformatedvalue($value){
        if(is_null($value)){
            return "null";
        }elseif (gettype($value) == 'string'){
            return "'{$value}'";
        } else{
            return $value;
        }

    }
}