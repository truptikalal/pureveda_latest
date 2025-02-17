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

    // Input Validation
    if (!is_numeric($cart_id)) {
        die("Error: Invalid input data.");
    }

    // Delete cart item (use the correct column name, e.g., `cart_id`)
    $query = "DELETE FROM cart WHERE cart_id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Error preparing query: " . $conn->error);
    }

    $stmt->bind_param("ii", $cart_id, $user_id);

    if ($stmt->execute()) {
        header("Location: cart.php");
        exit;
    } else {
        die("Error deleting from cart: " . $stmt->error);
    }
} else {
    die("Error: Invalid request method.");
}
