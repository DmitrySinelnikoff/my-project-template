<?php

namespace modul;

use PDO;
use PDOException;

abstract class DataBase
{
    public $tableName;
    public $sql;
    public $connection;
    public $count;

    public function __construct()
    {
        $this->connection = ENV::getConnection();
    }
    
    public function get()
    {
        try {
            $conn = new PDO("mysql:host={$this->connection['HOST']};dbname={$this->connection['DBNAME']}", $this->connection['USER'], $this->connection['PASSWORD']);
            $this->validateSqlQuery();
            $sth = $conn->prepare($this->sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function all()
    {
        $this->sql = "SELECT * FROM $this->tableName";
        return $this;
    }

    public function where($field, $symbol, $value)
    {
        $this->sql .= " WHERE $field $symbol '$value'";
        return $this;
    }

    public function limit($limit = 1)
    {
        $this->sql .= " limit $limit";
        return $this;
    }

    public function validateSqlQuery()
    {
        if(empty($this->sql)) {
            throw new PDOException('No sql query');
        } else return;
    }

    public function create($array)
    {
        $conn = new PDO("mysql:host={$this->connection['HOST']};dbname={$this->connection['DBNAME']}", $this->connection['USER'], $this->connection['PASSWORD']);
        $table_fields = $conn->query("DESCRIBE {$this->tableName}")->fetchAll(PDO::FETCH_COLUMN);
        unset($table_fields[0]);
        $this->sql = "INSERT INTO {$this->tableName} (";

        foreach($table_fields as $key => $item) {
            $this->sql .= "`$item`";

            if($key != array_key_last($table_fields))
                $this->sql .= ', ';
        }
        $this->sql .= ") VALUES (";
        foreach($array as $key => $item) {
            $this->sql .= "'$item'";

            if($key != array_key_last($array))
                $this->sql .= ', ';
        }
        $this->sql .= ")";
        return $this;
    }

    public function delete()
    {
        $this->sql .= "DELETE FROM {$this->tableName}";
        return $this;
    }
}
