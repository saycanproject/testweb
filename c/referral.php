<?php
session_start();
require_once 'DB.php';

$db = new DB();
$error_message = '';
$success_message = '';

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $refcode = trim($_POST['refcode']);

    if (empty($username) || empty($password) || empty($refcode)) {
        $error_message = 'Username, password, and referral code are required.';
    } else {
        $referral_setting = $db->fetchOne("SELECT * FROM `settings` WHERE `option_name` = 'refcode' AND `option_value` = '{$db->real_escape_string($refcode)}' AND `table_name` = 'member'");


        if ($referral_setting) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $data = [
                'username' => $username,
                'password' => $hash,
            ];
            $user_id = $db->insert('member', $data);
            $success_message = 'Registration successful. You can now <a href="index.php">login</a>.';
        } else {
            $error_message = 'Invalid referral code.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Referral Registration</title>
</head>
<body>
    <h1>Register with Referral Code</h1>

    <?php if (!empty($error_message)): ?>
        <div class="error"><?= $error_message ?></div>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <div class="success"><?= $success_message ?></div>
    <?php endif; ?>

    <h2>Register</h2>
    <form action="" method="post">
        <label for="register_username">Username:</label>
        <input type="text" name="username" id="register_username" required>
        <br>
        <label for="register_password">Password:</label>
        <input type="password" name="password" id="register_password" required>
        <br>
        <label for="refcode">Referral Code:</label>
        <input type="text" name="refcode" id="refcode" required>
        <br>
        <input type="submit" name="register" value="Register">
    </form>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="admin.php">Administration</a></li>
            <li><a href="business.php">Businesses</a></li>
            <li><a href="funding.php">Fundings</a></li>
            <li><a href="records.php">Records</a></li>
        </ul>
    </nav>
</body>
</html>