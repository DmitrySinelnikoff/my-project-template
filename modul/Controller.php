<?php

namespace modul;

use modul\View;

abstract class Controller
{
    public $view;

    public function __construct()
    {
        $this->rule();
        $this->view = new View();
    }

    public function rule() {}
}
