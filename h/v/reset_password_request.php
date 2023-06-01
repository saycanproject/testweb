<body>
    <h2>Reset Password</h2>
    <form action="?controller=User&action=resetPasswordRequest" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <input type="submit" value="Reset Password">
    </form>
</body>