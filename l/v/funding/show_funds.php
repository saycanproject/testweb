<?php load_partial('header'); ?>

<h2>My Fundings</h2>

<?php if ($fundings): ?>
    <table>
        <thead>
            <tr>
                <th>Business ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fundings as $funding): ?>
                <tr>
                    <td><?php echo $funding['business_id']; ?></td>
                    <td><?php echo $funding['amount']; ?></td>
                    <td><?php echo $funding['status']; ?></td>
                    <td><?php echo $funding['date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No fundings found.</p>
<?php endif; ?>

<?php load_partial('footer'); ?>
