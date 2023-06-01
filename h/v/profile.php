<body>
    <h2>User Profile</h2>
    <p>Role: <?php echo $_SESSION['role']; ?></p>
    <?php
        $roles = explode(',', $_SESSION['role']);

        if (in_array('root', $roles) || in_array('admin', $roles)) {
            echo '<a href="index.php?controller=User&action=userList">View and Edit Users</a>';
        }
    ?>
</body>