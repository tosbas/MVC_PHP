<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class)
    {
        $classPath = str_replace("\\", "/", $class) . '.php';
        $file = ROOT . $classPath;

        if (file_exists($file)) {
            require_once $file;
        }
    }
}
