<?php
session_start();
include('config.php'); // Database connection

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'redirect']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = intval($_POST['product_id']);

    // Check if product already exists in the cart
    $query = "SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update quantity if product exists
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + 1;

        $update_query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("iii", $new_quantity, $user_id, $product_id);
        $update_stmt->execute();

        echo json_encode(['status' => 'exists']);
    } else {
        // Insert new product into the cart
        $quantity = 1;
        $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("iii", $user_id, $product_id, $quantity);
        $insert_stmt->execute();

        echo json_encode(['status' => 'success']);
    }
} else {
    echo json_encode(['status' => 'error']);
}
?>
