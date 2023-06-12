<?php
class Record {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function createRecord($business_id, $member_id, $category, $amount, $description, $date) {
        $sql = "INSERT INTO `records` (`business_id`, `member_id`, `category`, `amount`, `description`, `date`) 
                VALUES ('$business_id', '$member_id', '$category', '$amount', '$description', '$date')";

        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}