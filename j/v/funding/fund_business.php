<?php load_partial('header'); ?>

<h2>Fund a Business</h2>
<form method="post" action="index.php?controller=Funding&action=fundBusiness">
    <input type="hidden" name="business_id" value="<?php echo $business['id']; ?>">
    <input type="number" step="0.01" name="amount" placeholder="Amount">
    <input type="submit" value="Fund">
</form>
<?php load_partial('footer'); ?>