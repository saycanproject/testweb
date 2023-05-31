<?php
require_once 'DB.php';

class User {

    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function find($username) {
        $username = $this->db->escape($username);
        $result = $this->db->query("SELECT * FROM `member` WHERE `username` = '$username'");
        if ($result->num_rows > 0) {
            return $result->row;
        }
        return false;
    }

    public function updateStatus($status) {
        $username = $this->db->escape($_SESSION['username']);
        $status = $this->db->escape($status);

        $sql = "UPDATE `member` SET `status` = '$status' WHERE `username` = '$username'";

        if ($this->db->query($sql) === TRUE) {
            return TRUE;
        } else {
            return $this->db->link->error;
        }
    }

    public function create($username, $password) {
        $username = $this->db->escape($username);
        $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $code = rand(100000, 999999); // Generate a random code for password recovery
        $status = 'pending'; // New users are 'pending' until approved
        $role = 'member'; // New users are 'members' by default

        $sql = "INSERT INTO `member` (`username`, `password`, `code`, `status`, `role`) VALUES ('$username', '$password', '$code', '$status', '$role')";

        if ($this->db->query($sql) === TRUE) {
            return TRUE;
        } else {
            return $this->db->link->error;
        }
    }
    
}
