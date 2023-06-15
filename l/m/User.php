<?php
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

    public function getAllUsers() {
        $result = $this->db->query("SELECT * FROM `member`");

        if ($result->num_rows > 0) {
            return $result->rows;
        }

        return false;
    }

    public function updateUser($username, $status, $role) {
        $username = $this->db->escape($username);
        $status = $this->db->escape($status);
        $role = $this->db->escape($role);

        $sql = "UPDATE `member` SET `status` = '$status', `role` = '$role' WHERE `username` = '$username'";

        if ($this->db->query($sql) === TRUE) {
            return TRUE;
        } else {
            return $this->db->link->error;
        }
    }

    public function updatePassword($username, $password) {
        $username = $this->db->escape($username);
        $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        $sql = "UPDATE `member` SET `password` = '$password' WHERE `username` = '$username'";

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

    public function isApprovedCandidate($user_id, $business_id) {
        $sql = "SELECT option_value
                FROM settings
                WHERE option_name = 'approved_candidates'
                AND applies_to = $business_id";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->row;
            $approved_candidates = json_decode($row['option_value'], true);

            return in_array($user_id, $approved_candidates);
        } else {
            return false;
        }
    }
}
