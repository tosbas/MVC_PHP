<?php

namespace App;

abstract class Controller
{

    public string $title;

    public function render(string $view, string $title, array $data)
    {
        $this->title = $title;

        ob_start();

        require_once(ROOT . '/views/' . $view . '.php');

        $content = ob_get_clean();

        require_once(ROOT . '/views/default.php');
    }
}
