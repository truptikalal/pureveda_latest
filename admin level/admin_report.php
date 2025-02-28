<?php
session_start();
include('config.php');

echo "<h2>Admin Order Report</h2>";

// Pending Orders
$result = $conn->query("SELECT * FROM orders WHERE payment_status = 'Pending'");
echo "<h3>Pending Orders</h3>";
while ($row = $result->fetch_assoc()) {
    echo "Order ID: " . $row['order_id'] . " | Amount: " . $row['total_price'] . " | Payment: " . $row['payment_method'] . "<br>";
}

// Completed Orders
$result = $conn->query("SELECT * FROM orders WHERE payment_status = 'paid'");
echo "<h3>Completed Orders</h3>";
while ($row = $result->fetch_assoc()) {
    echo "Order ID: " . $row['order_id'] . " | Amount: " . $row['total_price'] . " | Payment: " . $row['payment_method'] . "<br>";
}

// Orders Purchased This Week
$result = $conn->query("SELECT * FROM orders WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
echo "<h3>This Week's Orders</h3>";
while ($row = $result->fetch_assoc()) {
    echo "Order ID: " . $row['order_id'] . " | Amount: " . $row['total_price'] . " | Payment: " . $row['payment_method'] . "<br>";
}
?>
