<?php load_partial('header'); ?>

<h2>Create Business</h2>
<form method="post" action="index.php?controller=Business&action=createBusiness">
    <input type="text" name="bizname" placeholder="Business Name">
    <textarea name="description" placeholder="Description"></textarea>
    <input type="number" name="grand_total_target" placeholder="Grand Total Target">
    <input type="text" name="approved_candidate_ids" placeholder="Approved Candidate IDs">
    <input type="submit" value="Create">
</form>

<?php load_partial('footer'); ?>