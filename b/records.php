<?php
session_start();
require_once 'DB.php';

$db = new DB();

$member_id = $_SESSION['id'];

$businesses = $db->fetchAll("SELECT i.member_id, i.business_id, b.bizname as business_name FROM `relation` i INNER JOIN `business` b ON i.business_id = b.id WHERE i.member_id = {$_SESSION['user_id']} ORDER BY b.bizname");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $business_id = $_POST['business_id'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];

    $data = array(
        'member_id' => $_SESSION['user_id'],
        'business_id' => $business_id,
        'date' => $date,
        'category' => $category,
        'amount' => $amount
    );

    try {
        if ($action == 'add') {
            $db->insert('records', $data);
            header("Location: records.php");
            exit;
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Records</title>
</head>
<body>
    <a href="index.php">Home</a>
    <h1>Add Record</h1>
    <form action="records.php" method="post">
        <input type="hidden" name="action" value="add">
        <label for="business_id">Business:</label>
        <select name="business_id" id="business_id" required>
            <?php foreach ($businesses as $business): ?>
                <option value="<?php echo htmlspecialchars($business['business_id']); ?>"><?php echo htmlspecialchars($business['business_name']); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required>
        <br>
        <label for="category">Category:</label>
        <select name="category" id="category" required>
            <option value="income">Income</option>
            <option value="expense">Expense</option>
        </select>
        <br>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" step="0.01" min="0" required>
        <br>
        <input type="submit" value="Add Record">
    </form>
</body>
</html>