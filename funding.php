<?php
session_start();
require_once 'DB.php';

// Redirect to index.php if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$db = new DB();

// Fetch investments for the logged-in member and related business information
$investments = $db->fetchAll("SELECT i.member_id, i.business_id, b.name as business_name FROM `funding` i INNER JOIN `business` b ON i.business_id = b.id WHERE i.member_id = {$_SESSION['user_id']} ORDER BY b.name");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Investments - Business Investment Platform</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php">Home</a>
    <table>
        <thead>
            <tr>
                <th>Business</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($investments as $investment): ?>
                <tr>
                    <td><?= htmlspecialchars($investment['business_name']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>