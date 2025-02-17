<?php
session_start();
include('config.php');
include('components/header.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in!");
}

$uid = $_SESSION['user_id'];
$total = 0; // Initialize total amount

// Fetch cart items with product details
$cart_query = "SELECT c.quantity, p.product_id, p.name, p.image, p.price 
               FROM cart c 
               JOIN products p ON c.product_id = p.product_id 
               WHERE c.user_id = ?";
$stmt = mysqli_prepare($conn, $cart_query);
mysqli_stmt_bind_param($stmt, "i", $uid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/custom.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Checkout</h2>

    <?php if (mysqli_num_rows($result) > 0) { ?>
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="text-center">Order Summary</h4>
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Price (₹)</th>
                            <th>Total (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($cart_row = mysqli_fetch_assoc($result)) { 
                            $subtotal = $cart_row['quantity'] * $cart_row['price']; 
                            $total += $subtotal;
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($cart_row['name']); ?></td>
                            <td><img src="<?= htmlspecialchars($cart_row['image']); ?>" width="50" height="50"></td>
                            <td><?= $cart_row['quantity']; ?></td>
                            <td><?= number_format($cart_row['price'], 2); ?></td>
                            <td><?= number_format($subtotal, 2); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <h5 class="text-end"><strong>Grand Total: ₹<?= number_format($total, 2); ?></strong></h5>
            </div>
        </div>

        <!-- Store Total in Session -->
        <?php $_SESSION['total'] = $total; ?>

        <div class="text-center mt-4">
            <a href="payment_options.php" class="btn btn-success">Proceed to Payment</a>
        </div>
    <?php } else { ?>
        <div class="alert alert-warning text-center">Your cart is empty.</div>
    <?php } ?>
</div>

<?php include('components/footer.php'); ?>
</body>
</html>

