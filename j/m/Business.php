<?php
class Business {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function create($member_id, $bizname, $description) {  
        $member_id = $this->db->escape($member_id);
        $bizname = $this->db->escape($bizname);
        $description = $this->db->escape($description);

        $sql = "INSERT INTO `business` (`member_id`, `bizname`, `description`) VALUES ('$member_id', '$bizname', '$description')"; 

        if ($this->db->query($sql) === TRUE) {
            $business_id = $this->db->getLastId(); // Get the last inserted ID
            $this->createRelation($member_id, $business_id); // Call the function to create relation
            return TRUE;
        } else {
            return $this->db->link->error;
        }
    }

    public function createRelation($member_id, $business_id) {
        $member_id = $this->db->escape($member_id);
        $business_id = $this->db->escape($business_id);

        $sql = "INSERT INTO `relation` (`member_id`, `business_id`) VALUES ('$member_id', '$business_id')";

        if ($this->db->query($sql) === TRUE) {
            return TRUE;
        } else {
            return $this->db->link->error;
        }
    }

    public function getBusinessesByMember($member_id) {
        $member_id = $this->db->escape($member_id);
        $result = $this->db->query("SELECT * FROM `business` WHERE `member_id` = '$member_id'");

        if ($result->num_rows > 0) {
            return $result->rows;
        }

        return false;
    }

    public function getBusinessById($id) {
        $id = $this->db->escape($id);
        $result = $this->db->query("SELECT * FROM `business` WHERE `id` = '$id'");
        
        if ($result && $result->num_rows > 0) {
            return $result->row; // Return the first row of the result set
        }

        return false;
    }

    public function getOtherBusinesses($member_id) {
        $member_id = $this->db->escape($member_id);
        $result = $this->db->query("SELECT * FROM `business` WHERE `member_id` != '$member_id'");

        if ($result->num_rows > 0) {
            return $result->rows;
        }

        return false;
    }
}
