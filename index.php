<?php
    include('config.php');

    $query = "SELECT * FROM products";
    $result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PureVeda - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/css/custom.css">
</head>
<body>

<!-- Navbar -->
<?php
    include('components/header.php');
?>

<!-- Product Cards -->
<div class="container my-4"> 
    <div class="row g-4"> <!-- Added gap between grid items -->
        <?php while ($product = $result->fetch_assoc()) { ?>
            <div class="col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                <div class="card h-100"> <!-- Ensures equal height -->
                    <img src="<?= $product['image']; ?>" class="card-img-top" alt="Product Image">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $product['name']; ?></h5>
                        <p class="card-text flex-grow-1"><?= substr($product['description'], 0, 100); ?>...</p>
                        <h6>$<?= number_format($product['price'], 2); ?></h6>
                        <a href="product.php?product_id=<?= $product['product_id']; ?>" class="btn btn-primary mt-auto">View Product</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php @include('components/footer.php') ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="public/js/script.js"></script>
</body>
</html>
