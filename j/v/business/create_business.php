<?php load_partial('header'); ?>

<h2>Create Business</h2>
<form method="post" action="index.php?controller=Business&action=createBusiness">
    <input type="text" name="bizname" placeholder="Business Name">
    <textarea name="description" placeholder="Description"></textarea>
    <input type="submit" value="Create">
</form>

<?php load_partial('footer'); ?>