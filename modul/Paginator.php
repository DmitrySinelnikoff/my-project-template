<?php

namespace modul;

class Paginator
{
    public $model;
    public $pageCount;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
    public function paginate(int $step): static
    {
        $this->setPageCount($step);
        $page = 1;
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $offset = ($page - 1) * $step;
        $this->model->sql .= " LIMIT {$step} OFFSET {$offset}";
        return $this;
    }

    public function setPageCount(int $step): void
    {
        $count = count($this->model->get());
        $this->pageCount = ceil($count / $step);
    }

    public function view(): void
    {
        include './views/elements/paginator.php';
    }
}
