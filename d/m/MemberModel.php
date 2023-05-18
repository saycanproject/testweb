<?php
require_once 'DB.php';

class MemberModel {

    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    // Register a new user
    public function register($username, $password, $referral_code) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $username = $this->db->escape($username);
        $referral_code = $this->db->escape($referral_code);

        $sql = "INSERT INTO member (username, password, referral_code, status) 
                VALUES ('$username', '$hashedPassword', '$referral_code', 'pending')";

        $this->db->query($sql);
        return $this->db->getLastId();
    }

    // Fetch a user by username and password
    public function getUser($username, $password) {
        $username = $this->db->escape($username);

        $sql = "SELECT * FROM member WHERE username = '$username'";
        $result = $this->db->query($sql);
        
        // If a user was found and the password is correct, return the user data
        if ($result->num_rows > 0 && password_verify($password, $result->row['password'])) {
            return $result->row;
        }
        
        // No valid user was found
        return false;
    }

    // Fetch a user by username
    public function getUserByUsername($username) {
        $username = $this->db->escape($username);

        $sql = "SELECT * FROM member WHERE username = '$username'";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return $result->row;
        }

        return false;
    }
}
?>