<?php

namespace modul;

class View
{
    public $title = 'Page';

    public function view(string $page, string $layout, array $data=[])
    {
        extract($data);
        include './layouts/' . $layout;
    }
}
