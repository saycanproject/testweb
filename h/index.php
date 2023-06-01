<?php
//loader
spl_autoload_register(function($class_name){
    if(file_exists('m/' . $class_name . '.php')) {
        require_once 'm/' . $class_name . '.php';
    } else if(file_exists('c/' . $class_name . '.php')) {
        require_once 'c/' . $class_name . '.php';
    }
});

//router
$controllerName = $_REQUEST['controller'] ?? 'User';
$actionName = $_REQUEST['action'] ?? 'index';

$controllerClass = ucfirst($controllerName) . "Controller";

if (!class_exists($controllerClass)) {
    die("Controller does not exist");
}

$controller = new $controllerClass;

if (!method_exists($controller, $actionName)) {
    die("Action does not exist");
}

$controller->$actionName();
