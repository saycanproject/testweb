<?php
class BusinessController {
    private $business;
    private $user;

    public function __construct() {
        $this->business = new Business();
        $this->user = new User();
    }

    public function createBusiness() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $member_id = $_SESSION['id'];
            $user = $this->user->find($_SESSION['username']);
            $status = $user['status'];
            $roles = explode(',', $user['role']);

            if($status == 'approved' && in_array('c', $roles) || in_array('r', $roles)){
                $bizname = $_POST['bizname'];
                $description = $_POST['description'];
                $grand_total_target = $_POST['grand_total_target'];
                $approved_candidate_ids = $_POST['approved_candidate_ids'];

                $result = $this->business->create($member_id, $bizname, $description, $grand_total_target, $approved_candidate_ids);
                
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
        $member_id = $_SESSION['id'];
        $businesses = $this->business->getBusinessesByMember($member_id);
        $otherBusinesses = $this->business->getOtherBusinesses($member_id);
        if ($businesses || $otherBusinesses) {
            load_view('business/show_businesses', ['businesses' => $businesses, 'otherBusinesses' => $otherBusinesses]);
        } else {
            echo "No businesses found.";
        }
    }

    public function selectBusiness() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['business_id'])) {
            $_SESSION['selected_business_id'] = $_POST['business_id'];
            header("Location: index.php?controller=Record&action=createRecord"); // Redirect to the page where the user can create a record
            exit();
        } else {
            echo "Invalid request.";
        }
    }
    
}