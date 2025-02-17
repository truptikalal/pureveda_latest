<?php
session_start();
include('config.php'); // Database connection

// Check if product_id is present in the URL
if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); // Ensure it's an integer

    // Fetch product details from the database
    $query = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing query: " . $conn->error);
    }
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "<p class='text-danger text-center'>Product not found.</p>";
        exit;
    }
} else {
    echo "<p class='text-danger text-center'>Invalid product ID provided.</p>";
    exit;
}

// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PureVeda - Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <a href="product.php?product_id=<?php echo $product['product_id']; ?>">View Details</a>
    <link rel="stylesheet" href="public/css/custom.css">
</head>
<body>

<?php include('components/header.php'); ?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" class="img-fluid rounded" alt="Product Image">
        </div>
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <p class="text-muted"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            <h4 class="text-success">Price: ₹<?php echo number_format($product['price'], 2); ?></h4>
            <button class="btn btn-primary" id="add-to-cart" data-product-id="<?php echo $product['product_id']; ?>">
                <i class="fas fa-cart-plus"></i> Add to Cart
            </button>
        </div>
    </div>
</div>

<?php include('components/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#add-to-cart').click(function () {
            let productId = $(this).data('product-id');

            $.ajax({
                url: 'add_to_cart.php',
                type: 'POST',
                data: { product_id: productId },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Product added to cart!');
                    } else if (response.status === 'exists') {
                        alert('Quantity updated in cart!');
                    } else if (response.status === 'redirect') {
                        window.location.href = 'login.php';
                    } else {
                        alert('An error occurred. Please try again.');
                    }
                },
                error: function () {
                    alert('Failed to add product to cart. Please check your connection.');
                }
            });
        });
    });
</script>
</body>
</html>
