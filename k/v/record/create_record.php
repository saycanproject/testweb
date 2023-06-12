<?php load_partial('header'); ?>

<h2>Create Record</h2>

<form action="index.php?controller=Record&action=createRecord" method="post">
    <label for="business_id">Business ID:</label><br>
    <input type="text" id="business_id" name="business_id"><br>

    <label for="category">Category:</label><br>
    <select id="category" name="category">
        <option value="income">Income</option>
        <option value="expense">Expense</option>
    </select><br>

    <label for="amount">Amount:</label><br>
    <input type="text" id="amount" name="amount"><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description"></textarea><br>

    <input type="submit" value="Create Record">
</form>

<?php load_partial('footer'); ?>
