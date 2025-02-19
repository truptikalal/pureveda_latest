<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    die("Please log in to view your orders.");
}

$uid = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM orders WHERE user_id = $uid");

echo "<h2>My Orders</h2>";
echo "<table border='1'>
<tr><th>Order ID</th><th>Total Price</th><th>Status</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>₹{$row['total_price']}</td>
        <td><strong>{$row['order_status']}</strong></td>
    </tr>";
}

echo "</table>";
?>
