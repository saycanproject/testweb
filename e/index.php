<?php
define('ROOT', __DIR__);
require_once(ROOT . '/router.php');
$url = isset($_GET['url']) ? explode('/', trim($_GET['url'], '/')) : [];
Router::route($url);
