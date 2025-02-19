<?php
include('config.php');

$category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;

// Fetch products based on category filter
$query = "SELECT * FROM products";
if ($category_id > 0) {
    $query .= " WHERE category_id = " . $category_id;
}

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        echo '<div class="col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                <div class="card h-100">
                    <img src="'.$product['image'].'" class="card-img-top" alt="Product Image">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">'.$product['name'].'</h5>
                        <p class="card-text flex-grow-1">'.substr($product['description'], 0, 100).'...</p>
                        <h6>$'.number_format($product['price'], 2).'</h6>
                        <a href="product.php?product_id='.$product['product_id'].'" class="btn btn-primary mt-auto">View Product</a>
                    </div>
                </div>
            </div>';
    }
} else {
    echo "<p class='text-center'>No products found in this category.</p>";
}
?>
