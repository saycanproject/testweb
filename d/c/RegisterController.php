<?php
require_once 'm/MemberModel.php';

class RegisterController {
    private $model;

    public function __construct() {
        $this->model = new MemberModel();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $referral_code = $_POST['referral_code'];

            $result = $this->model->register($username, $password, $referral_code);

            if ($result) {
                echo "Registration successful! Please wait for approval.";
            } else {
                echo "Registration failed!";
            }
        } else {
            require 'v/register.php';
        }
    }
}