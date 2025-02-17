<?php
session_start();
include('components/header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Successful</title>
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center text-success">Payment Successful!</h2>
        <p class="text-center">Your order has been placed successfully.</p>
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">Go to Home</a>
        </div>
    </div>

</body>

</html>
