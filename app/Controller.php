<?php

namespace App;

use \AllowDynamicProperties;

#[AllowDynamicProperties]
abstract class Controller
{
    public string $title;

    public function render(string $view, string $title, array $data)
    {
        $this->title = $title;

        ob_start();
        
        require_once(ROOT . 'views/' . str_replace('Controller', '',strtolower(get_class($this))) . '/' . $view . '.php');
        
        $content = ob_get_clean();

        require_once(ROOT . '/views/default.php');
    }


    public function loadModel(string $model)
    {
        require_once(ROOT . 'models/' . $model . '.php');

        $this->$model = new $model();
    }
}
