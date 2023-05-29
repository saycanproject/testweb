<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
</head>
<body>
    <h2>Register</h2>

    <?php if(isset($result)) { ?>
        <p><?php echo $result; ?></p>
    <?php } ?>

    <form method="post" action="index.php?url=Member/register">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>