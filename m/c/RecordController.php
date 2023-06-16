<?php
class RecordController {
    private $record;
    private $business;
    private $user;
    private $settings;

    public function __construct() {
        $this->record = new Record();
        $this->business = new Business();
        $this->user = new User();
        $this->settings = new Settings();
    }

    public function createRecord() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_SESSION['id'];
            $business_id = $_POST['business_id'];
            $category = $_POST['category'];
            $amount = $_POST['amount'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            if($this->user->isApprovedCandidate($user_id, $business_id)) {
                $json_options = $this->settings->getJsonOptions($business_id);
                if ($json_options !== false) {
                    $grand_total_target = $json_options['grand_total_target'];
                    $approved_candidate_ids = explode(',', $json_options['approved_candidate_ids']);
                    if ($grand_total_target >= 10 && in_array($user_id, $approved_candidate_ids)) {
                        $result = $this->record->create($user_id, $business_id, $category, $amount, $description, $date);
                        if ($result === TRUE) {
                            echo "Record created successfully. You can <a href='index.php?controller=Record&action=showRecords'>see your records here</a>.";
                        } else {
                            echo "Error: " . $result;
                        }
                    } else {
                        echo "You do not meet the requirements to create a record.";
                    }
                } else {
                    echo "Settings not found.";
                }
            } else {
                echo "You are not an approved candidate for this business.";
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