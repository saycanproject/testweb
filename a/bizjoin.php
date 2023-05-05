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

// Join a business
if (isset($_POST['join_business'])) {
    $business_id = intval($_POST['business_id']);

    // Check if the user has already joined the business
    $already_joined = $db->fetchOne("SELECT * FROM `funding` WHERE `member_id` = {$_SESSION['user_id']} AND `business_id` = {$business_id}");

    if ($already_joined) {
        $error_message = 'You have already joined this business.';
    } else {
        // Add a new investment record
        $db->insert('funding', [
            'member_id' => $_SESSION['user_id'],
            'business_id' => $business_id
        ]);

        $success_message = 'You have successfully joined the business!';
    }
}

// Fetch businesses
$businesses = $db->fetchAll("SELECT * FROM `business`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Join Business - Business Investment Platform</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Join Business</h1>

    <a href="members.php">Back to Member Information</a>

    <?php if (!empty($error_message)): ?>
        <div class="error"><?= $error_message ?></div>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <div class="success"><?= $success_message ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <label for="business_id">Select a business to join:</label>
        <select name="business_id" id="business_id" required>
            <option value="">-- Select a business --</option>
            <?php foreach ($businesses as $business): ?>
                <option value="<?= $business['id'] ?>"><?= htmlspecialchars($business['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" name="join_business" value="Join Business">
    </form>
</body>
</html>
