<div class="navbar">
   <div class="logo">
      <a href="index.php"><img src="public/images/logo3.png"  alt="Pureveda Logo"></a>
   </div>

   <!-- Search Bar Section -->
   <div class="search-bar">
      <i class="fas fa-search" onclick="toggleSearch()"></i>
      <input type="text" class="search-input" placeholder="Search...">
   </div>

   <!-- Categories Section -->
   <nav class="categories">
      <!-- Categories Section -->
   <a href="index.php">Home</a>
   <a href="#" class="category-btn" data-category="1">Hair</a>
   <a href="#" class="category-btn" data-category="2">Skincare</a>
   <a href="#" class="category-btn" data-category="3">Body</a>
   <a href="#" class="category-btn" data-category="4">Candles</a>
 </nav>

   <!-- Navigation items -->
   <section class="items">
      <ul class="navbar-nav">
         <?php
         // Start session
         if (session_status() == PHP_SESSION_NONE) {
            session_start();
         }

         // Check if the user is logged in
         if (isset($_SESSION['user_id'])) {
            // Check if the user is an admin
            if ($_SESSION['role'] == 'admin') {
               echo '<li>
                           <a class="categories" href="admin_panel.php">Admin Panel</a>
                        </li>';
            }
            echo '<li class="categories" class="cartlogout">
                        <a class="cartlogout" href="cart.php">
                           <i class="fa fa-shopping-cart"></i>
                        </a>
                     </li>';

            // Show Logout link
            echo '<li  class="cartlogout">
                        <a class=" logout-button" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                     </li>';
         } else {
            // If not logged in, show Login and Sign Up links
            echo '<li class="categories" >
                        <a href="login.php">Login</a>
                     </li>
                     <li class="categories" >
                        <a  href="register.php">Sign Up</a>
                     </li>';
         }
         ?>
      </ul>
   </section>
</div>