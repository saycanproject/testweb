<?php load_partial('header'); ?>
<h2>User List</h2>
<table>
    <tr>
        <th>Username</th>
        <th>Status</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    <?php foreach ($users as $user) : ?>
        <tr>
            <form action="index.php?controller=User&action=updateUser" method="post">
                <td>
                    <input type="hidden" name="username" value="<?php echo $user['username']; ?>">
                    <?php echo $user['username']; ?>
                </td>
                <td>
                    <input type="text" name="status" value="<?php echo $user['status']; ?>">
                </td>
                <td>
                    <input type="text" name="role" value="<?php echo $user['role']; ?>">
                </td>
                <td>
                    <input type="submit" value="Update User">
                </td>
            </form>
        </tr>
    <?php endforeach; ?>
</table>
<?php load_partial('footer'); ?>
