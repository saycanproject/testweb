<?php
session_start();
require_once 'DB.php';

// Redirect to index.php if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$db = new DB();
$error_message = '';
$success_message = '';

// Create a new business
if (isset($_POST['create_business'])) {
    $bizname = trim($_POST['bizname']);
    $description = trim($_POST['description']);

    if (empty($bizname) || empty($description)) {
        $error_message = 'All fields are required.';
    } else {
        $business_id = $db->insert('business', [
            'member_id' => $_SESSION['user_id'],
            'bizname' => $bizname,
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Insert the new record into the x_business_approval table with the business_id and status set to 'pending'
        $db->insert('x_business_approval', [
            'business_id' => $business_id,
            'status' => 'pending'
        ]);

        $success_message = 'Business submitted for approval!';
    }
}

// Get a list of approved businesses
$approved_businesses = $db->query("SELECT b.* FROM business b JOIN x_business_approval xba ON b.id = xba.business_id WHERE xba.status = 'approved'")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Businesses - Business Investment Platform</title>
</head>
<body>
    <a href="index.php">Home</a>
    <h1>Businesses</h1>
    <?php if (!empty($error_message)): ?>
        <div class="error"><?= $error_message ?></div>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <div class="success"><?= $success_message ?></div>
    <?php endif; ?>

    <h2>Create a new business</h2>
    <form action="" method="post">
        <label for="bizname">Business Name:</label>
        <input type="text" name="bizname" id="bizname" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea>
        <br>
        <input type="submit" name="create_business" value="Create Business">
    </form>
</body>
</html>
