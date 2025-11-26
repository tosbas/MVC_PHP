<?php

namespace App;

use \AllowDynamicProperties;

#[AllowDynamicProperties]
abstract class Controller
{
    public string $title;

    /**
     * Affiche une vue en injectant des données et en utilisant le template par défaut.
     *
     * @param string $view 
     * @param string $title
     * @param array  $data
     *
     * @return void
     */
    public function render(string $view, string $title, array $data = [])
    {
        extract($data);

        $this->title = $title;

        $fullClass = get_class($this);
        $classParts = explode('\\', $fullClass);
        $className = end($classParts);

        $viewFolder = strtolower(str_replace('Controller', '', $className));

        ob_start();

        require_once ROOT . 'views/' . $viewFolder . '/' . $view . '.php';

        $content = ob_get_clean();

        require_once ROOT . 'views/default.php';
    }


    /**
     * Chargement d'un model
     * @param string $model
     * @return void
     */
    public function loadModel(string $model)
    {
        require_once(ROOT . 'models/' . $model . '.php');

        $this->$model = new $model();
    }
}
