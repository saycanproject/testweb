<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>

    <?php if(isset($result)) { ?>
        <p><?php echo $result; ?></p>
    <?php } ?>

    <form method="post" action="index.php?url=Member/login">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>