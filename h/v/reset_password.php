<body>
    <h2>Reset Password</h2>
    <form action="?controller=User&action=resetPassword" method="post">
        <input type="hidden" id="username" name="username" value="<?php echo $_GET['username']; ?>">
        <input type="hidden" id="code" name="code" value="<?php echo $_GET['code']; ?>">
        <label for="password">New Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
