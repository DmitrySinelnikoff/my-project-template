<?php

namespace modul;

use modul\DB;

abstract class Model
{
    public $tableName;
    public $sql;
    public $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function get(): array
    {
        return $this->db->query($this->sql);
    }

    public function all(): static
    {
        $this->sql = "SELECT * FROM $this->tableName";
        return $this;
    }

    public function where(string $field, string $symbol, string $value): static
    {
        $this->sql .= " WHERE $field $symbol '$value'";
        return $this;
    }

    public function limit(int $limit = 1): static
    {
        $this->sql .= " limit $limit";
        return $this;
    }

    public function create(array $array): static
    {
        $table_fields = $this->db->getTableFields($this->tableName);
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

    public function delete(): static
    {
        $this->sql .= "DELETE FROM {$this->tableName}";
        return $this;
    }
}
