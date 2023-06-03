<?php load_partial('header'); ?>

<h2>User List</h2>
<table>
    <tr>
        <th>Username</th>
        <th>Status</th>
        <th>Role</th>
    </tr>
    <?php foreach ($users as $user) : ?>
        <tr>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['status']; ?></td>
            <td><?php echo $user['role']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php load_partial('footer'); ?>
