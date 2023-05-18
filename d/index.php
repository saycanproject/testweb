
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'router.php';  // make sure router.php is in the same directory

if (isset($_SESSION['user'])) {
    echo 'Welcome ' . $_SESSION['user']['username'];
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <a href="index.php?action=login">Login</a>
    <a href="index.php?action=register">Register</a>
</body>
</html>
