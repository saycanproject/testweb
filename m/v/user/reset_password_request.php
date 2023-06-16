<?php load_partial('header'); ?>

<h2>Reset Password</h2>
<form method="post" action="index.php?controller=User&action=resetPasswordRequest">
    <input type="text" name="username" placeholder="Username">
    <input type="submit" value="Reset Password">
</form>

<?php load_partial('footer'); ?>
