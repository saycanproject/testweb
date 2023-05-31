<body>
    <h2>User Profile</h2>
    <p>Role: <?php echo $_SESSION['role']; ?></p>
    <form action="?controller=User&action=updateStatus" method="post">
        <label for="status">Status:</label><br>
        <input type="text" id="status" name="status" value="<?php echo $_SESSION['status']; ?>"><br>
        <?php
            $roles = explode(',', $_SESSION['role']); // This converts the set into an array

            // Only allow root or admin users to update status
            if (in_array('root', $roles) || in_array('admin', $roles)) {
                echo '<input type="submit" value="Update Status">';
            }
        ?>
    </form> 
</body>
