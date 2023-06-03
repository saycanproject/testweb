<?php load_partial('header'); ?>

<h2>My Businesses</h2>
<?php if ($businesses): ?>
    <ul>
    <?php foreach ($businesses as $business): ?>
        <li>
            <h3><?php echo $business['bizname']; ?></h3>
            <p><?php echo $business['description']; ?></p>
        </li>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No businesses found.</p>
<?php endif; ?>

<?php load_partial('footer'); ?>