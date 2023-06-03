<?php include BASE_PATH . '/v/partials/header.php'; ?>

<h2>Reset Password</h2>
<form method="post" action="index.php?controller=User&action=resetPassword">
    <input type="hidden" name="username" value="<?php echo $_GET['username']; ?>">
    <input type="hidden" name="code" value="<?php echo $_GET['code']; ?>">
    <input type="password" name="password" placeholder="New Password">
    <input type="submit" value="Reset Password">
</form>

<?php load_partial('footer'); ?>