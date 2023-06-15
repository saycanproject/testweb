<?php load_partial('header'); ?>

<form action="index.php?controller=Record&action=createRecord" method="post">
    <input type="hidden" name="business_id" value="<?= $business_id ?>">
    <label for="category">Category:</label>
    <select name="category" id="category">
        <option value="income">Income</option>
        <option value="expense">Expense</option>
    </select>
    <label for="amount">Amount:</label>
    <input type="number" name="amount" id="amount" step="0.01">
    <label for="description">Description:</label>
    <textarea name="description" id="description"></textarea>
    <label for="date">Date:</label>
    <input type="date" name="date" id="date">
    <input type="submit" value="Create Record">
</form>

<?php load_partial('footer'); ?>