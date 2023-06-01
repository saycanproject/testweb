<body>
    <h1>Login</h1>
    <form action="index.php?controller=User&action=login" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Submit">
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
</body>