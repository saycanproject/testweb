<?php
class Router {
    public static function route($url) {
        $controller = (!empty($url[0])) ? array_shift($url) . 'Controller' : 'MemberController';
        $method = (!empty($url[0])) ? array_shift($url) : 'index';
        $queryParams = $url;

        require_once(ROOT . '/c/' . $controller . '.php');

        if(class_exists($controller)) {
            $dispatch = new $controller();
            call_user_func_array(array($dispatch, $method), $queryParams);
        } else {
            throw new Exception('This controller does not exist');
        }
    }
}
