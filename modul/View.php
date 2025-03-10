<?php

namespace modul;

class View
{
    public $title = 'Page';

    public function view(string $page, string $layout, array $data=[]): void
    {
        extract($data);
        include './views/layouts/' . $layout;
    }
}
