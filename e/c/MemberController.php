<?php
require_once(ROOT . '/loader.php');

class MemberController {
    private $loader;

    function __construct() {
        $this->loader = new Loader();
    }

    function index() {
        $this->loader->view('login_view.php');
    }

    function register() {
        $memberModel = $this->loader->model('MemberModel');
        $data = array(
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'code' => rand(1000,9999),
            'status' => 'pending',
            'role' => 'member'
        );

        $result = $memberModel->register($data);
        $this->loader->view('register_view.php', array('result' => $result));
    }

    function login() {
        $memberModel = $this->loader->model('MemberModel');
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = $memberModel->login($username, $password);
        $this->loader->view('login_view.php', array('result' => $result));
    }
}