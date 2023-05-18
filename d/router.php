<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'c/BaseController.php';
require_once 'c/LoginController.php';
require_once 'c/RegisterController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'base';

if ($action == 'login') {
    $controller = new LoginController();
} elseif ($action == 'register') {
    $controller = new RegisterController();
} else {
    $controller = new BaseController();
}

$controller->handleRequest();