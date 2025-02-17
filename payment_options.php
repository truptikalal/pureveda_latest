<?php
session_start();
include('config.php');
require('vendor/autoload.php'); // Include the Razorpay SDK

$keyId = 'rzp_test_Zth6TBEqyhnUN9';
$keySecret = 'F2jJKQBuTNqPqkAd9sGiAzYU';
$razorpay = new Razorpay\Api\Api($keyId, $keySecret);

// Check session variables
if (!isset($_SESSION['user_id']) || !isset($_SESSION['total'])) {
    die('User or total amount not set. Please login again.');
}

$uid = $_SESSION['user_id'];
$total_amount = $_SESSION['total'];
$paise = $total_amount * 100;

// Fetch user email from database
$query = "SELECT email FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_email = $user['email'];

try {
    // Create Razorpay Order
    $orderData = [
        'receipt' => 'order_rcptid_' . time(),
        'amount' => $paise,
        'currency' => 'INR',
        'payment_capture' => 1
    ];
    $order = $razorpay->order->create($orderData);
    $orderId = $order['id'];

    // Insert order into database
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, order_status, razorpay_order_id) VALUES (?, ?, 'pending', ?)");
    $stmt->bind_param("ids", $uid, $total_amount, $orderId);
    $stmt->execute();
    $db_order_id = $stmt->insert_id;
    $stmt->close();
} catch (Exception $e) {
    die('Error creating Razorpay order: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Options</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/custom.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .payment-btn {
            display: block;
            width: 100%;
            padding: 12px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            margin-top: 15px;
            cursor: pointer;
            transition: 0.3s;
        }
        .cod-btn {
            background-color: #28a745;
            color: white;
        }
        .cod-btn:hover {
            background-color: #218838;
        }
        .razorpay-btn {
            background-color: #007bff;
            color: white;
        }
        .razorpay-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <h2>Payment Options</h2>
        <p><strong>Total Payable Amount: ₹<?php echo number_format($total_amount, 2); ?></strong></p>

        <button class="payment-btn cod-btn">
            <a href="order.php?c_id=<?php echo $uid; ?>" style="text-decoration: none; color: white;">Cash On Delivery</a>
            
        </button>
        
        <button class="payment-btn razorpay-btn" id="payButton">Pay with Razorpay</button>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('payButton').onclick = function () {
            var options = {
                "key": "<?php echo $keyId; ?>",
                "amount": "<?php echo $paise; ?>",
                "currency": "INR",
                "name": "Pureveda",
                "description": "Order Payment Transaction",
                "order_id": "<?php echo $orderId; ?>",
                "callback_url": "process_payment.php?order_id=<?php echo $db_order_id; ?>",
                "prefill": {
                    "name": "John Doe",
                    "email": "john@example.com",
                    "contact": "9712034754"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        };
    </script>
</body>

</html>

