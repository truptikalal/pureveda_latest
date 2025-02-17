<?php
session_start();
include('config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in.");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart_id = $_POST['cart_id'] ?? null;
    $quantity = $_POST['quantity'] ?? null;

    // Input Validation
    if (!is_numeric($cart_id) || !is_numeric($quantity) || $quantity <= 0) {
        die("Error: Invalid input data.");
    }

    // Update cart item (use the correct column name, e.g., `cart_id`)
    $query = "UPDATE cart SET quantity = ? WHERE cart_id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Error preparing query: " . $conn->error);
    }

    $stmt->bind_param("iii", $quantity, $cart_id, $user_id);

    if ($stmt->execute()) {
        header("Location: cart.php");
        exit;
    } else {
        die("Error updating cart: " . $stmt->error);
    }
} else {
    die("Error: Invalid request method.");
}
