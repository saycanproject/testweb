<?php load_partial('header'); ?>

<h2>Register</h2>
<form method="post" action="index.php?controller=User&action=register">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Register">
</form>

<?php load_partial('footer'); ?>