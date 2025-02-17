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

    // Redirect to success page
    header("Location: payment_success.php");
    exit();
} catch (Exception $e) {
    die('Payment verification failed: ' . $e->getMessage());
}
?>
