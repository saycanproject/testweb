<?php
session_start();
require_once 'DB.php';

$db = new DB();
$error_message = '';
$success_message = '';

// Login
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error_message = 'Username and password are required.';
    } else {
        $user = $db->fetchOne("SELECT * FROM `member` WHERE `username` = '{$db->real_escape_string($username)}'");

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: funding.php');
            exit;
        } else {
            $error_message = 'Invalid username or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Business Investment Platform</title>
</head>
<body>
    <h1>Welcome to the Business Investment Platform</h1>

    <?php if (!empty($error_message)): ?>
        <div class="error"><?= $error_message ?></div>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <div class="success"><?= $success_message ?></div>
    <?php endif; ?>

    <h2>Login</h2>
    <form action="" method="post">
        <label for="login_username">Username:</label>
        <input type="text" name="username" id="login_username" required>
        <br>
        <label for="login_password">Password:</label>
        <input type="password" name="password" id="login_password" required>
        <br>
        <input type="submit" name="login" value="Login">
    </form>

    <nav>
        <ul>
            <li><a href="admin.php">Administration</a></li>
            <li><a href="referral.php">Register</a></li>
            <li><a href="business.php">Businesses</a></li>
            <li><a href="funding.php">Fundings</a></li>
            <li><a href="records.php">Records</a></li>
        </ul>
    </nav>
</body>
</html>
