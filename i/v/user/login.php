<?php load_partial('header'); ?>

<h2>Login</h2>
<form method="post" action="index.php?controller=User&action=login">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Login">
</form>

<?php load_partial('footer'); ?>