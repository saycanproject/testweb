<?php
session_start();
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<head>
    <title>Register</title>
    <script>
    window.onload = function() {
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            var secretNumber = 61; // Secret number
            if (document.getElementById('secret').value != secretNumber) {
                // Secret number is incorrect
                event.preventDefault();
                alert('Incorrect secret number');
            }
        });
    };
    </script>
</head>
<body>
    <h2>Register</h2>
    <form id="registerForm" action="?controller=User&action=register" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required pattern="[a-zA-Z0-9]+"><br>
        <small>Username can only contain letters and numbers.</small><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required minlength="1"><br>
        <small>Password must be at least 1 characters long.</small><br>
        <label for="secret">Secret Number:</label><br>
        <input type="text" id="secret" name="secret" required><br>
        <small>Enter the secret number given to you.</small><br>
        <input type="submit" value="Submit">
    </form>
</body>