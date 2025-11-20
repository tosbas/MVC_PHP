<?php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require_once(ROOT . 'config.php');
require_once(ROOT . 'App/Model.php');
require_once(ROOT . 'App/Controller.php');

$request = trim($_SERVER['REQUEST_URI'], '/'); 
$request = parse_url($request, PHP_URL_PATH);
$params  = array_values(array_filter(explode('/', $request)));

// --- ROUTAGE ---
if (!empty($params)) {
    $controllerName = ucfirst($params[0]);
    $action = isset($params[1]) ? $params[1] : 'index';

    $controllerPath = ROOT . 'controllers/' . $controllerName . '.php';

    if (file_exists($controllerPath)) {
        require_once $controllerPath;

        if (class_exists($controllerName)) {
            $controller = new $controllerName();

            if (method_exists($controller, $action)) {
                call_user_func_array([$controller,$action], $params);
            } else {
                http_response_code(404);
                echo "⚠️ L'action <strong>$action</strong> n'existe pas dans le contrôleur <strong>$controllerName</strong>.";
            }
        } else {
            http_response_code(404);
            echo "⚠️ La classe contrôleur <strong>$controllerName</strong> est introuvable.";
        }
    } else {
        http_response_code(404);
        echo "⚠️ Le fichier du contrôleur <strong>$controllerPath</strong> est introuvable.";
    }
} else {
    // Si aucune route n’est précisée → page d’accueil
    require_once(ROOT . 'controllers/MainController.php');

    $controller = new Main();
    $controller->main();
}
