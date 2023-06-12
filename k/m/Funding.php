<?php
class Funding {

    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function createFunding($userId, $businessId, $amount) {
        $userId = $this->db->escape($userId);
        $businessId = $this->db->escape($businessId);
        $amount = $this->db->escape($amount);
        $status = 'pending'; // Default status is 'pending'
        $date = date('Y-m-d'); // Current date

        $query = "INSERT INTO `funding` (`member_id`, `business_id`, `amount`, `status`, `date`) 
                  VALUES ('$userId', '$businessId', '$amount', '$status', '$date')";

        $this->db->query($query);
    }

    public function getFundsByMember($member_id) {
        $member_id = $this->db->escape($member_id);
        $result = $this->db->query("SELECT * FROM `funding` WHERE `member_id` = '$member_id'");

        if ($result->num_rows > 0) {
            return $result->rows;
        }

        return false;
    }
}