<?php
session_start(); // start the session
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <h2>Profile</h2>

    <form action="?controller=User&action=updateProfile" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $_SESSION['user']['username']; ?>" disabled><br>

        <label for="status">Status:</label><br>
        <input type="text" id="status" name="status" value="<?php echo $_SESSION['user']['status']; ?>"><br>

        <label for="role">Role:</label><br>
        <input type="text" id="role" name="role" value="<?php echo $_SESSION['user']['role']; ?>"><br>

        <input type="submit" value="Update">
    </form> 
</body>
</html>
