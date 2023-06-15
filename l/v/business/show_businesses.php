<?php load_partial('header'); ?>

<h2>My Businesses</h2>
<?php if ($businesses): ?>
    <ul>
    <?php foreach ($businesses as $business): ?>
        <li>
            <h3><?php echo $business['bizname']; ?></h3>
            <p><?php echo $business['description']; ?></p>
            <!-- Keep the existing link to fund the business -->
            <a href="index.php?controller=Funding&action=fundBusiness&business_id=<?php echo $business['id']; ?>">Fund This Business</a>
            <!-- Add a new link to create a record for the business -->
            <a href="index.php?controller=Record&action=createRecord&business_id=<?php echo $business['id']; ?>">Create Record</a>
        </li>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No businesses found.</p>
<?php endif; ?>

<h2>Other Businesses</h2>
<?php if ($otherBusinesses): ?>
    <ul>
    <?php foreach ($otherBusinesses as $business): ?>
        <li>
            <h3><?php echo $business['bizname']; ?></h3>
            <p><?php echo $business['description']; ?></p>
            <!-- Keep the existing link to fund the business -->
            <a href="index.php?controller=Funding&action=fundBusiness&business_id=<?php echo $business['id']; ?>">Fund This Business</a>
            <!-- Add a new link to create a record for the business -->
            <a href="index.php?controller=Record&action=createRecord&business_id=<?php echo $business['id']; ?>">Create Record</a>
        </li>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No other businesses found.</p>
<?php endif; ?>

<?php load_partial('footer'); ?>