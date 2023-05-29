<?php
// require_once(ROOT . '/DB.php');
require_once('DB.php');
class MemberModel {
    private $db;

    function __construct() {
        $this->db = new DB();
    }

    function register($data) {
        $username = $this->db->escape($data['username']);
        $password = $this->db->escape(password_hash($data['password'], PASSWORD_DEFAULT));
        $code = $this->db->escape($data['code']);
        $status = $this->db->escape($data['status']);
        $role = $this->db->escape($data['role']);

        $sql = "INSERT INTO `member` (username, password, code, status, role) 
                VALUES ('$username', '$password', '$code', '$status', '$role')";

        $result = $this->db->query($sql);

        if($result === true) {
            return 'Registration successful';
        } else {
            return 'Registration failed: ' . $this->db->link->error;
        }
    }

    function login($username, $password) {
        $username = $this->db->escape($username);
        $result = $this->db->query("SELECT * FROM `member` WHERE username='$username'");
        
        if($result->num_rows > 0) {
            $user = $result->row;

            if(password_verify($password, $user['password'])) {
                if($user['status'] == 'approved') {
                    $_SESSION['user'] = $user;
                    return 'Login successful';
                } else {
                    return 'Account not approved yet';
                }
            } else {
                return 'Wrong password';
            }
        } else {
            return 'User does not exist';
        }
    }
}