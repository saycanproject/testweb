<?php
class FundingController {

    public function fundBusiness() {
        // Create user instance to check user's role
        $userModel = new User();

        // Retrieve user id and role from the session
        $userId = $_SESSION['id'] ?? null;
        $username = $_SESSION['username'] ?? null;
        
        if (!$userId || !$username) {
            die('User is not logged in');
        }

        // Get user's roles
        $user = $userModel->find($username);
        $roles = explode(',', $user['role']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the user has the 'f' role
            if (!in_array('f', $roles)) {
                die('You do not have permissions to fund a business.');
            }

            // Retrieve business id and amount from POST request
            $businessId = $_POST['business_id'] ?? null;
            $amount = $_POST['amount'] ?? null;
            
            // Ensure business id and amount are provided
            if (!$businessId || !$amount) {
                die('Business ID and Amount are required');
            }
            
            // Create funding instance
            $funding = new Funding();
            $funding->createFunding($userId, $businessId, $amount);
            
            // Redirect user or show success message here...
            echo "Funding created successfully!";
        } else {
            // Retrieve business id from GET request
            $businessId = $_GET['business_id'] ?? null;

            if (!$businessId) {
                die('Business ID is required');
            }

            // Retrieve business details
            $businessModel = new Business();
            $business = $businessModel->getBusinessById($businessId);

            // If the business doesn't exist, show an error
            if (!$business) {
                die('Business does not exist');
            }

            // Load fund_business view
            load_view('funding/fund_business', ['business' => $business]);
        }
    }
    
    public function showFundsByUser() {
        $userModel = new User();
        $userId = $_SESSION['id'] ?? null;
        $username = $_SESSION['username'] ?? null;

        if (!$userId || !$username) {
            die('User is not logged in');
        }

        // Get user's roles
        $user = $userModel->find($username);
        $roles = explode(',', $user['role']);

        // Check if the user has the 'f' role
        if (!in_array('f', $roles)) {
            die('You do not have permissions to view funds.');
        }

        $fundingModel = new Funding();
        $fundings = $fundingModel->getFundsByMember($userId);

        // Ensure fundings are retrieved
        if (!$fundings) {
            die('No funds found');
        }

        load_view('funding/show_funds', ['fundings' => $fundings]);
    }
}