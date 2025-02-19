<?php
include('config.php');
include('components/header.php');
//session_start();

if (!isset($_SESSION['user_id'])) {
    die("User not logged in!");
}

$uid = $_SESSION['user_id'];
$total = $_SESSION['total'];

$p_status = "Pending";
$p_mode = "COD"; // Default payment mode for COD
$order_status = "pending";

// Get cart items for the user
$select_cart = "SELECT * FROM cart WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $select_cart);
mysqli_stmt_bind_param($stmt, "i", $uid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if cart is empty
if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Your cart is empty! Please add products.');</script>";
    echo "<script>window.location.href='cart.php';</script>";
    exit;
}

// Process each cart item as an order
while ($row_cart = mysqli_fetch_assoc($result)) {
    $pro_id = $row_cart['product_id'];
    $pro_qty = $row_cart['quantity'];

    // Insert order into database
    $order_query = "INSERT INTO orders (user_id, product_id, total_price, order_status, payment_status, payment_method, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW())";

    $stmt_order = mysqli_prepare($conn, $order_query);
    mysqli_stmt_bind_param($stmt_order, "iidsss", $uid, $pro_id, $total, $order_status, $p_status, $p_mode);
    
    if (mysqli_stmt_execute($stmt_order)) {
        // Delete cart items after placing the order
        $delete_cart = "DELETE FROM cart WHERE user_id = ?";
        $stmt_delete = mysqli_prepare($conn, $delete_cart);
        mysqli_stmt_bind_param($stmt_delete, "i", $uid);
        mysqli_stmt_execute($stmt_delete);
    } else {
        echo "<script>alert('Order placement failed! Please try again.');</script>";
        echo "<script>window.location.href='cart.php';</script>";
        exit;
    }
}

// Show success message and redirect to home page
echo "<script>alert('Your order has been placed successfully!');</script>";
echo "<script>window.location.href='index.php';</script>";
exit;

//insert the correct payment method
$payment_method = isset($_POST['razorpay_payment_id']) ? 'Online' : 'COD';

$query = "INSERT INTO orders (order_id, user_id, product_id, amount, status, payment_method, razorpay_payment_id) 
          VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iiidsss", $order_id, $user_id, $product_id, $amount, $status, $payment_method, $razorpay_payment_id);
$stmt->execute();

// show the payment method
$query = "SELECT * FROM orders WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

while ($order = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $order['order_id'] . "</td>";
    echo "<td>" . $order['product_id'] . "</td>";
    echo "<td>" . $order['amount'] . "</td>";
    echo "<td>" . $order['status'] . "</td>";
    echo "<td>" . $order['payment_method'] . "</td>"; // Show Payment Method
    echo "</tr>";
}

?>
