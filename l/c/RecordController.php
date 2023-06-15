<?php
class RecordController {
    private $record;
    private $business;
    private $user;

    public function __construct() {
        $this->record = new Record();
        $this->business = new Business();
        $this->user = new User();
    }

    public function createRecord() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $business_id = $_POST['business_id'];
            $user_id = $_SESSION['id'];
            $category = $_POST['category'];
            $amount = $_POST['amount'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            
            $business_owner_id = $this->business->getOwner($business_id);
            
            if($business_owner_id == $user_id){
                $result = $this->record->create($user_id, $business_id, $category, $amount, $description, $date);
            } else {
                $share_percentage = $this->record->getShare($business_id, $user_id);
                
                if ($share_percentage >= 10 && $this->user->isApprovedCandidate($user_id, $business_id)) {
                    $result = $this->record->create($user_id, $business_id, $category, $amount, $description, $date);
                } else {
                    $result = false;
                }
            }

            if ($result) {
                echo "Record created successfully.";
            } else {
                echo "You do not have permission to create a record for this business.";
            }
        } else {
            $business_id = filter_input(INPUT_GET, 'business_id', FILTER_SANITIZE_NUMBER_INT);
            load_view('record/create_record', ['business_id' => $business_id]);
        }
    }

    public function showRecords() {
        $user_id = $_SESSION['id'];
        $records = $this->record->getRecordsByUser($user_id);

        if (!empty($records)) {
            load_view('record/show_records', ['records' => $records]);
        } else {
            echo "No records found.";
        }
    }
}
