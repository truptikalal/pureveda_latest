<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PureVeda - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://localhost/pureveda/public/css/custom.css">
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            /* background: linear-gradient(135deg, #e9f5ec, #ffffff); Soft green background */
            /* background-color: #045943; */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('public/images/bgimg12.jpg') no-repeat center center/cover;
        }

        /* Login Page Layout */
        .login-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 90%;
        }

        .login-container {
            display: flex;
            width: 80%;
            max-width: 1200px;
            height: 70%;
            border-radius: 10px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: #ffffff;
        }

        /* Animated Login Box */
        .login-box {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
            background: #ffffff;
            animation: slideIn 1s ease-out;
        }

        .login-box h2 {
            font-size: 2rem;
            color: #466d4a;
            /* Dark green */
            margin-bottom: 20px;
            font-weight: bold;
        }

        .login-box .btn-primary {
            background-color: #466d4a;
            /* Dark green */
            background-image: ;
            border: none;
            transition: background 0.3s;
        }

        .login-box .btn-primary:hover {
            background-color: #3b5a3e;
            /* Slightly darker green */
        }

        /* Logo Section */
        .logo-box {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f6e7e8;
            /* Soft green */
            border-left: 2px solid #e0ece5;
            /* Subtle border */
        }

        .logo-box .logo-img {
            /* max-width: 80%; */
            height: auto;
            animation: fadeIn 1.5s ease-in-out;
        }
         .login-box a{
            padding: 0px;
            margin: 0px;
         }
        /* Animations */
        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Input Fields Styling */
        .login-box .form-control {
            border: 1px solid #466d4a;
            /* Border in green */
            border-radius: 5px;
            transition: border 0.3s ease;
        }

        .login-box .form-control:focus {
            border: 2px solid #3b5a3e;
            /* Darker green on focus */
            outline: none;
            box-shadow: none;
        }

        /* Sign-up Text and Link */
        .signup-text {
            text-align: center;
            font-size: 0.9rem;
            color: #466d4a;
            /* Dark green */
            margin-top: 15px;
        }

        .signup-link {
            color: #3b5a3e;
            /* Slightly darker green */
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .signup-link:hover {
            color: #2d4431;
            /* Even darker green on hover */
            text-decoration: underline;
        }
    </style>
</head>

<body>



    <!-- Login Form -->
    <div class="login-page">
        <div class="login-container">
            <!-- Animated Login Box -->
            <div class="login-box">
                <h2>Welcome to PureVeda</h2>
                <form action="login_backend.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>

                <!-- Sign-up Link -->
                <p class="signup-text mt-3">
                    Have not signed up? <a href="register.php" class="signup-link">Create an account</a>
                </p>
            </div>

            <!-- Logo Section -->
            <div class="logo-box">
               <a href="index.php"><img src="public/images/logo3.png" alt="PureVeda Logo" class="logo-img"></a>
            </div>
        </div>
       
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>