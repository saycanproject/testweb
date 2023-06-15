<?php
class Record {
    private $db;
    private $business;

    public function __construct() {
        $this->db = new DB();
        $this->business = new Business();
    }

    public function create($user_id, $business_id, $category, $amount, $description, $date) {
        $user_id = $this->db->escape($user_id);
        $business_id = $this->db->escape($business_id);
        $category = $this->db->escape($category);
        $amount = $this->db->escape($amount);
        $description = $this->db->escape($description);
        $date = $this->db->escape($date);

        // Check if the user has enough shares
        $share = $this->getShare($business_id, $user_id);

        // Get the business data
        $business = $this->business->getBusinessById($business_id);
        $extra_info = json_decode($business['extra_info'], true);
        $approved_candidates = explode(',', $extra_info['approved_candidate_ids']);

        // Check if the user is the business owner or an approved candidate
        if ($business['member_id'] == $user_id || (in_array($user_id, $approved_candidates) && $share >= 10)) {

            // The user has permission to create a record
            $query = $this->db->query("INSERT INTO records (member_id, business_id, category, amount, description, date) VALUES ('{$user_id}', '{$business_id}', '{$category}', '{$amount}', '{$description}', '{$date}')");
            return $query === TRUE;
        } else {
            // The user does not have permission to create a record
            return FALSE;
        }
    }

    public function getRecordsByUser($user_id) {
        $sql = "SELECT * FROM records WHERE member_id = $user_id";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return $result->rows;
        } else {
            return array();
        }
    }

    public function getShare($business_id, $member_id) {
        $business_id = $this->db->escape($business_id);
        $member_id = $this->db->escape($member_id);

        // Get total funding provided by this member for this business
        $result = $this->db->query("SELECT SUM(`amount`) as total_funding FROM `funding` WHERE `business_id` = '$business_id' AND `member_id` = '$member_id'");
        $user_total_funding = $result->row['total_funding'];

        // Get grand total target of the business
        $business = $this->business->getBusinessById($business_id);
        $extra_info = json_decode($business['extra_info'], true);
        $grand_total_target = $extra_info['grand_total_target'];

        // Calculate share
        $share = $user_total_funding / $grand_total_target * 100;

        return $share;
    }
}