<?php
class BusinessController {
    private $business;
    private $user;

    public function __construct() {
        $this->business = new Business();
        $this->user = new User();
    }

    public function createBusiness() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $member_id = $_SESSION['id'];
            $user = $this->user->find($_SESSION['username']);
            $status = $user['status'];
            $roles = explode(',', $user['role']);

            if($status == 'approved' && in_array('c', $roles) || in_array('r', $roles)){
                $bizname = $_POST['bizname'];
                $description = $_POST['description'];
                // Removed the extra_info line
                $result = $this->business->create($member_id, $bizname, $description);
                if ($result === TRUE) {
                    echo "Business created successfully. You can <a href='index.php?controller=Business&action=showBusinesses'>see your businesses here</a>.";
                } else {
                    echo "Error: " . $result;
                }
            } else {
                echo "You do not have permissions to create a business.";
            }
        } else {
            load_view('business/create_business');
        }
    }

    public function showBusinesses() {
        session_start();
        $member_id = $_SESSION['id'];
        $businesses = $this->business->getBusinessesByMember($member_id);
        if ($businesses) {
            load_view('business/show_businesses', ['businesses' => $businesses]);
        } else {
            echo "No businesses found.";
        }
    }
}