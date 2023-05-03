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
    $name = trim($_POST['name']);
    $investment = trim($_POST['investment']);
    $description = trim($_POST['description']);

    if (empty($name) || empty($investment) || empty($description)) {
        $error_message = 'All fields are required.';
    } else {
        $db->insert('business', [
            'name' => $name,
            'investment' => $investment,
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $success_message = 'Business created successfully!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Businesses - Business Investment Platform</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Businesses</h1>

    <a href="funding.php">Your Investments</a>

    <?php if (!empty($error_message)): ?>
        <div class="error"><?= $error_message ?></div>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <div class="success"><?= $success_message ?></div>
    <?php endif; ?>

    <h2>Create a new business</h2>
    <form action="" method="post">
        <label for="name">Business Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="investment">Investment Amount:</label>
        <input type="number" name="investment" id="investment" step="0.01" min="0" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea>
        <br>
        <input type="submit" name="create_business" value="Create Business">
    </form>
</body>
</html>
