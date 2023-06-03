<?php
class Business {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function create($member_id, $bizname, $description) {  // Removed the extra_info parameter
        $member_id = $this->db->escape($member_id);
        $bizname = $this->db->escape($bizname);
        $description = $this->db->escape($description);

        $sql = "INSERT INTO `business` (`member_id`, `bizname`, `description`) VALUES ('$member_id', '$bizname', '$description')";  // Removed the extra_info field from the SQL query

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
}
