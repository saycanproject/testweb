<?php load_partial('header'); ?>

<h2>Profile</h2>
<p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
<?php
    $roles = explode(',', $_SESSION['role']);

    if (in_array('r', $roles) || in_array('a', $roles)) {
        echo '<a href="index.php?controller=User&action=userList">View and Edit Users</a>';
    }
?>
<a href="index.php?controller=Business&action=createBusiness">Create a Business</a>
<a href="index.php?controller=Business&action=showBusinesses">View Businesses</a>

<?php load_partial('footer'); ?>