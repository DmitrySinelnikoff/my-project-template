<?php

namespace modul;

use PDO;
use PDOException;

class DB 
{
    private $connectionData;
    private $connection;

    public function __construct()
    {
        $this->connectionData = ENV::getConnection();
        $this->connection = new PDO("mysql:host={$this->connectionData['HOST']};dbname={$this->connectionData['DBNAME']}", $this->connectionData['USER'], $this->connectionData['PASSWORD']);
    }
    
    public function query(string $sql): array
    {
        $this->validateSqlQuery($sql);
        $sth = $this->connection->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTableFields(string $tableName): array
    {
        return $this->connection->query("DESCRIBE {$tableName}")->fetchAll(PDO::FETCH_COLUMN);
    }

    public function validateSqlQuery(string $sql): void
    {
        if(empty($sql)) {
            throw new PDOException('No sql query');
        } else return;
    }
}
