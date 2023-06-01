<body>
    <h2>User List</h2>
    <?php
    foreach ($users as $user) {
        echo '<form action="index.php?controller=User&action=updateUser" method="post">';
        echo '<input type="hidden" name="username" value="' . $user['username'] . '">';
        echo '<p>Username: ' . $user['username'] . '</p>';
        echo '<label for="status">Status:</label>';
        echo '<input type="text" name="status" value="' . $user['status'] . '">';
        echo '<label for="role">Role:</label>';
        echo '<input type="text" name="role" value="' . $user['role'] . '">';
        echo '<input type="submit" value="Update User">';
        echo '</form>';
    }
    ?>
</body>

