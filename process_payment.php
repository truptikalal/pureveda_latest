<?php
session_start();
include('config.php');
require('vendor/autoload.php');

use Razorpay\Api\Api;

$keyId = 'rzp_test_Zth6TBEqyhnUN9';
$keySecret = 'F2jJKQBuTNqPqkAd9sGiAzYU';
$api = new Api($keyId, $keySecret);

if (!isset($_POST['razorpay_payment_id']) || !isset($_POST['razorpay_order_id']) || !isset($_POST['razorpay_signature'])) {
    die('Payment data missing!');
}

$payment_id = $_POST['razorpay_payment_id'];
$order_id = $_POST['razorpay_order_id'];
$signature = $_POST['razorpay_signature'];

try {
    $attributes = [
        'razorpay_order_id' => $order_id,
        'razorpay_payment_id' => $payment_id,
        'razorpay_signature' => $signature
    ];

    $api->utility->verifyPaymentSignature($attributes);

    // Update order status
    $stmt = $conn->prepare("UPDATE orders SET order_status = 'paid', razorpay_payment_id = ? WHERE razorpay_order_id = ?");
    $stmt->bind_param("ss", $payment_id, $order_id);
    $stmt->execute();
    $stmt->close();

    // Clear the cart after successful payment
    $uid = $_SESSION['user_id'];
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $stmt->close();

    // Set success message
    $_SESSION['message'] = "Your order has been placed successfully!";

    // Redirect to home page
    header("Location: index.php");
    exit();
} catch (Exception $e) {
    die('Payment verification failed: ' . $e->getMessage());
}
?>
