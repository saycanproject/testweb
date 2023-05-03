<?php
session_start();
require_once 'DB.php';

// Redirect to index.php if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$db = new DB();

// Fetch member information
$member = $db->fetchOne("SELECT * FROM `member` WHERE `id` = {$_SESSION['user_id']}");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Information - Business Investment Platform</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Member Information</h1>

    <a href="funding.php">Your Investments</a> | <a href="logout.php">Log Out</a>

    <h2>Username: <?= htmlspecialchars($member['username']) ?></h2>

    <h2>Business Actions</h2>
    <ul>
        <li><a href="bizmake.php">Create a new business</a></li>
        <li><a href="bizjoin.php">Invest to a business</a></li>
    </ul>
</body>
</html>