<?php
session_start();
include('config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in. Please log in to view your cart.");
}

$user_id = $_SESSION['user_id'];

// Validation: Ensure user_id is an integer
if (!is_numeric($user_id)) {
    die("Error: Invalid user ID.");
}

// Fetch cart items
$query = "SELECT  cart_id AS cart_id, p.name, p.image, p.price, c.quantity 
          FROM cart c 
          INNER JOIN products p ON c.product_id = p.product_id 
          WHERE c.user_id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

// Bind the parameter
$stmt->bind_param("i", $user_id);

// Execute the query
if (!$stmt->execute()) {
    die("Error executing query: " . $stmt->error);
}

$result = $stmt->get_result();

// HTML starts here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PureVeda - Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="public/css/custom.css">
</head>
<body>
<?php include('components/header.php'); ?>

<div class="container my-5">
    <h1 class="text-center mb-4">Your Cart</h1>
    <?php if ($result->num_rows > 0): ?>
        <div class="card shadow p-4">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price (₹)</th>
                            <th>Quantity</th>
                            <th>Total (₹)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $grand_total = 0;
                    while ($row = $result->fetch_assoc()): 
                        $product_image = htmlspecialchars($row['image']);
                        $product_name = htmlspecialchars($row['name']);
                        $price = is_numeric($row['price']) ? $row['price'] : 0;
                        $quantity = is_numeric($row['quantity']) ? $row['quantity'] : 0;
                        $total = $price * $quantity;
                        $grand_total += $total;
                    ?>
                        <tr>
                            <td style="width:100px;"><img src="<?= $product_image ?>" class="img-thumbnail small-image" alt="Product Image"></td>
                            <td><?= $product_name; ?></td>
                            <td><?= number_format($price, 2); ?></td>
                            <td>
                                <!-- Update Quantity Form -->
                                <form action="update_cart.php" method="POST" class="d-flex align-items-center">
                                    <input type="hidden" name="cart_id" value="<?= $row['cart_id']; ?>">
                                    <input type="number" name="quantity" class="form-control me-2" value="<?= $quantity; ?>" min="1" required style="width: 80px;">
                                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                                </form>
                            </td>
                            <td><?= number_format($total, 2); ?></td>
                            <td>
                                <!-- Remove Item Form -->
                                <form action="delete_from_cart.php" method="POST">
                                    <input type="hidden" name="cart_id" value="<?= $row['cart_id']; ?>">
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <tr class="table-secondary">
                        <td colspan="4" class="text-end"><strong>Grand Total</strong></td>
                        <td colspan="2" class="text-start"><strong>₹<?= number_format($grand_total, 2); ?></strong></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-end">
                <a href="checkout.php" class="btn btn-primary btn-lg">Proceed to Checkout</a>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            <h4>Your cart is empty!</h4>
            <p>Browse our <a href="index.php" class="text-decoration-none">products</a> to add items to your cart.</p>
        </div>
    <?php endif; ?>
</div>

<?php include('components/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
