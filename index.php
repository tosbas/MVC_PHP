<?php

session_start();

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require_once(ROOT . 'config.php');
require_once ROOT . 'autoload.php';
require_once ROOT . 'helpers.php';
Autoloader::register();

$request = trim($_SERVER['REQUEST_URI'], '/');
$request = parse_url($request, PHP_URL_PATH);
$params  = array_values(array_filter(explode('/', $request)));

if (!empty($params)) {

    $controllerName = 'Controllers\\' . ucfirst($params[0]) . 'Controller';
    $action = $params[1] ?? 'index';

    if (class_exists($controllerName)) {

        $controller = new $controllerName();

        if (method_exists($controller, $action)) {
            call_user_func_array([$controller, $action], []);
        } else {
            echo "L'action $action n'existe pas.";
        }
    } else {
        echo "Le contrôleur $controllerName est introuvable.";
    }
} else {

    $controllerClass = isLogged()
        ? Controllers\MainController::class
        : Controllers\LoginController::class;

    $controller = new $controllerClass();
    $controller->index();

    var_dump($_SESSION);
}
