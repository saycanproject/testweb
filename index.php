<?php
session_start();
require_once 'DB.php';

$db = new DB();
$error_message = '';
$success_message = '';

// Register
if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error_message = 'Username and password are required.';
    } else {
        $existingUser = $db->fetchOne("SELECT * FROM `member` WHERE `username` = '{$db->real_escape_string($username)}'");

        if ($existingUser) {
            $error_message = 'Username already exists.';
        } else {
            $db->insert('member', [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $success_message = 'Registration successful! Please log in.';
        }
    }
}

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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to the Business Investment Platform</h1>

    <?php if (!empty($error_message)): ?>
        <div class="error"><?= $error_message ?></div>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <div class="success"><?= $success_message ?></div>
    <?php endif; ?>

    <h2>Register</h2>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" name="register" value="Register">
    </form>

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
            <li><a href="bizmake.php">Businesses</a></li>
            <li><a href="members.php">Members</a></li>
            <li><a href="records.php">Records</a></li>
        </ul>
    </nav>
</body>
</html>
