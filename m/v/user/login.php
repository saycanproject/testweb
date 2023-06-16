<?php load_partial('header'); ?>

<h2>Login</h2>
<form method="post" action="index.php?controller=User&action=login">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Login">
</form>

<?php
if (isset($_SESSION['error'])) {
    echo "<p>Error: " . $_SESSION['error'] . "</p>";
    if ($_SESSION['error'] == "No user found with this username.") {
        echo '<p><a href="index.php?controller=User&action=register">Register</a></p>';
    }
    if ($_SESSION['error'] == "Incorrect password.") {
        echo '<p><a href="index.php?controller=User&action=resetPasswordRequest">Reset Password</a></p>';
    }
    unset($_SESSION['error']);
}
?>

<?php load_partial('footer'); ?>