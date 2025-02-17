<?php
// Include the database connection file
include('config.php');

session_start();
$captcha_text = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 6);
$_SESSION['captcha'] = $captcha_text;

// Initialize variables to hold the user input
$name = $email = $password = $confirm_password = $phone = $address = '';
$errors = [];

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $name = $_POST['Name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $captcha = $_POST['captcha'];

    // Validate the inputs
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }
    if (empty($password)) {
        $errors[] = 'Password is required.';
    } elseif ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }
    if (empty($phone)) {
        $errors[] = 'Phone number is required.';
    }
    if (empty($address)) {
        $errors[] = 'Address is required.';
    }

    // If no errors, proceed to insert the user into the database
    if (count($errors) == 0) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user into the database
        $query = "INSERT INTO users (name, email, password, phone,  address, role) 
                  VALUES (?, ?, ?, ?, ?, 'user')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $name, $email, $hashed_password, $phone, $address);

        if ($stmt->execute()) {
            echo "Registration successful!";
            header('Location: login.php'); // Redirect to the login page after successful registration
        } else {
            $errors[] = 'Error: ' . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PureVeda - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://localhost/pureveda/public/css/custom.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('public/images/bgimg12.jpg'); /* Add a background image */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h3 {
           text-align: center;
            font-size: 2rem;
            color: #466d4a;
            /* Dark green */
            margin-bottom: 20px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #466d4a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #3b5a3e;
        }

        .form-group {
            margin-bottom: 5px;
        }

        .link {
            text-align: center;
            margin-top: 10px;
        }

        .link a {
            text-decoration: none;
            color: #3b5a3e;
        }

        .link a:hover {
            color: #2d4431;
            text-decoration: underline;
        }
    </style>
</head>

<body>



    <!-- Registration Form -->
    <div class="register-container">
    <h3>Create an Account</h3>
            <?php
            if (count($errors) > 0) {
                echo '<div class="alert alert-danger">';
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo '</div>';
            }
            ?>
        <form action="#" method="POST">
            <div class="form-group">
                <input type="text" name="Name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <input type="text" name="address" placeholder="Address" required>
            </div>

             <!-- CAPTCHA Section -->
            <label for="captcha">Enter CAPTCHA:</label>
            <div style="font-weight:bold; font-size:18px;"><?php echo $_SESSION['captcha']; ?></div>
            <input type="text" name="captcha" required>
        <!-- End CAPTCHA Section -->
           
            <button type="submit">Register</button>
            
        </form>
        <div class="link">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>



        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>