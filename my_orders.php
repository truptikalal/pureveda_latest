<?php 
    include('config.php');
    include('components/header.php');
    
    //session_start();
    
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please login first.'); window.location.href='login.php';</script>";
        exit;
    }

    $uid = $_SESSION['user_id'];

    // Fetch orders with product names using JOIN
    $query = "SELECT orders.*, products.name AS product_name 
              FROM orders 
              JOIN products ON orders.product_id = products.product_id
              WHERE orders.user_id = ?";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
?>

<center>
    <h1>Your Orders</h1>
    <table style="width: 80%; border-collapse: collapse; margin: 20px auto; font-family: Arial, sans-serif;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Product Name</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Total Amount</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Order Status</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Payment Status</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Ordered At</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;"><?php echo htmlspecialchars($row['product_name']); ?></td>
                    <td style="padding: 10px; border: 1px solid #ddd;"><?php echo number_format($row['total_price'], 2); ?></td>
                    <td style="padding: 10px; border: 1px solid #ddd;"><?php echo htmlspecialchars($row['order_status']); ?></td>
                    <td style="padding: 10px; border: 1px solid #ddd;"><?php echo htmlspecialchars($row['payment_status']); ?></td>
                    <td style="padding: 10px; border: 1px solid #ddd;"><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</center>

<?php 
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
