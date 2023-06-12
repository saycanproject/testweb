<?php
class RecordController {
    private $recordModel;

    public function __construct() {
        $this->recordModel = new Record();
    }

    public function createRecord() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $business_id = $_POST['business_id'];
            $member_id = $_SESSION['id'];
            $category = $_POST['category'];
            $amount = $_POST['amount'];
            $description = $_POST['description'];
            $date = date('Y-m-d');

            if($this->recordModel->createRecord($business_id, $member_id, $category, $amount, $description, $date)) {
                echo "Record created successfully.";
            } else {
                echo "Error: Unable to create record.";
            }
        } else {
            load_view('record/create_record');
        }
    }
}