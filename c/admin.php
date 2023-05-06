<?php
session_start();
require_once 'DB.php';

$db = new DB();

// Redirect to index.php if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Fetch the user role
$user_role_data = $db->fetchOne("SELECT role FROM x_member_roles WHERE member_id = {$_SESSION['user_id']}");

if ($user_role_data) {
    $user_role = $user_role_data['role'];
} else {
    $user_role = 'visitor'; // Default role if not found in x_member_roles table
}

// Check if the user has admin permissions
if ($user_role != 'admin') {
    header('Location: index.php');
    exit;
}

// Approve or reject pending businesses
if (isset($_POST['approve']) || isset($_POST['reject'])) {
    $business_id = $_POST['business_id'];
    $status = isset($_POST['approve']) ? 'approved' : 'rejected';

    $sql = "UPDATE x_business_approval SET status = '$status' WHERE business_id = $business_id";
    $db->query($sql);

    // Notify the business creator about the decision
    // ...
}

// Fetch pending businesses
$result = $db->query("SELECT b.id, b.bizname, b.description, m.username FROM business b
                      JOIN x_business_approval ba ON b.id = ba.business_id
                      JOIN member m ON b.member_id = m.id
                      WHERE ba.status = 'pending'");
$pending_businesses = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Permissions - Business Investment Platform</title>
</head>
<body>
    <a href="index.php">Home</a>
    <h1>Admin Permissions</h1>

    <h2>Pending Businesses</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Business Name</th>
            <th>Description</th>
            <th>Creator</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($pending_businesses as $business): ?>
            <tr>
                <td><?= $business['id'] ?></td>
                <td><?= $business['bizname'] ?></td>
                <td><?= $business['description'] ?></td>
                <td><?= $business['username'] ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="business_id" value="<?= $business['id'] ?>">
                        <input type="submit" name="approve" value="Approve">
                        <input type="submit" name="reject" value="Reject">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>