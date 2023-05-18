<?php
require_once 'm/MemberModel.php';

class LoginController {
    private $model;

    public function __construct() {
        $this->model = new MemberModel();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model->getUser($username, $password);
            
            if ($user) {
                $_SESSION['user'] = $user;
                echo "Login successful! Hello " . htmlspecialchars($username);
            } else {
                echo "Login failed!";
            }
        } else {
            require 'v/login.php';
        }
    }
}