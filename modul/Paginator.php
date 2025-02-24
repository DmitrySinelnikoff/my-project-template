<?php

namespace modul;

class Paginator
{
    public $dataBase;
    public $pageCount;
    public function __construct(DataBase $dataBase)
    {
        $this->dataBase = $dataBase;
    }
    
    public function paginate(int $step)
    {
        $this->setPageCount($step);
        $page = 1;
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $offset = ($page - 1) * $step;
        $this->dataBase->sql .= " LIMIT {$step} OFFSET {$offset}";
        return $this;
    }

    public function setPageCount(int $step) {
        $countObject = clone $this->dataBase;
        $countObject->sql = "SELECT count(id) as 'count' FROM {$countObject->tableName}";
        $count = $countObject->get();
        $this->pageCount = ceil($count[0]['count'] / $step);
    }

    public function view()
    {
        include './views/elements/paginator.php';
    }
}
