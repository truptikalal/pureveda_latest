<?php
session_start();
include('config.php'); // Database connection

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    die("Unauthorized access!");
}

// Get order ID and new status from form
if (isset($_POST['order_id']) && isset($_POST['new_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];

    // Update the order status in the database
    $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $order_id);
    if ($stmt->execute()) {
        echo "Order status updated successfully!";
    
        // Fetch user email
        $user_query = $conn->prepare("SELECT users.email FROM users JOIN orders ON users.user_id = orders.user_id WHERE orders.id = ?");
        $user_query->bind_param("i", $order_id);
        $user_query->execute();
        $user_result = $user_query->get_result();
        $user_data = $user_result->fetch_assoc();
        $user_email = $user_data['email'];
    
        // Send email if order is delivered
        if ($new_status == 'delivered') {
            $subject = "Your Order Has Been Delivered!";
            $message = "Dear customer, your order #$order_id has been successfully delivered. Thank you for shopping with us!";
            $headers = "From: support@yourwebsite.com";
    
            mail($user_email, $subject, $message, $headers);
        }
    }
    else {
        echo "Error updating order: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "Invalid request!";
}
?>
