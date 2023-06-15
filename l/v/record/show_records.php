<?php load_partial('header'); ?>

<?php
// Get passed records from controller
$records = $data['records'];
?>
<table>
    <tr>
        <th>ID</th>
        <th>Business ID</th>
        <th>Category</th>
        <th>Amount</th>
        <th>Description</th>
        <th>Date</th>
    </tr>
    <?php foreach ($records as $record): ?>
    <tr>
        <td><?= $record['id'] ?></td>
        <td><?= $record['business_id'] ?></td>
        <td><?= $record['category'] ?></td>
        <td><?= $record['amount'] ?></td>
        <td><?= $record['description'] ?></td>
        <td><?= $record['date'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php load_partial('footer'); ?>