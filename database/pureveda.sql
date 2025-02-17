-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 06:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pureveda`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`) VALUES
(2, 1, 7, 1),
(5, 2, 8, 1),
(21, 4, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_status` enum('pending','completed','shipped') DEFAULT 'pending',
  `razorpay_order_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_id` int(11) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'Pending',
  `payment_method` varchar(50) NOT NULL DEFAULT 'COD,online',
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `order_status`, `razorpay_order_id`, `created_at`, `product_id`, `payment_status`, `payment_method`, `email`) VALUES
(1, 2, 250.00, 'pending', NULL, '2025-02-15 18:38:52', 0, 'Pending', 'COD', ''),
(2, 2, 500.00, 'pending', NULL, '2025-02-15 18:38:57', 0, 'Pending', 'COD', ''),
(3, 2, 500.00, 'pending', NULL, '2025-02-15 18:40:26', 0, 'Pending', 'COD', ''),
(4, 2, 500.00, 'pending', NULL, '2025-02-15 18:40:34', 0, 'Pending', 'COD', ''),
(5, 4, 600.00, 'pending', 'order_Pw5wLzmUGPIA9Y', '2025-02-15 19:03:32', 0, 'Pending', 'COD', ''),
(6, 4, 600.00, 'pending', 'order_Pw5wUXW3iNhaOI', '2025-02-15 19:03:40', 0, 'Pending', 'COD', ''),
(7, 4, 600.00, 'pending', 'order_Pw5xN9snPK6fw6', '2025-02-15 19:04:30', 0, 'Pending', 'COD', ''),
(8, 4, 600.00, 'pending', 'order_Pw60Kr83HjTvFk', '2025-02-15 19:07:18', 0, 'Pending', 'COD', ''),
(9, 4, 600.00, 'pending', 'order_Pw63aR9ZiItkbY', '2025-02-15 19:10:23', 0, 'Pending', 'COD', ''),
(10, 4, 600.00, 'pending', 'order_Pw65LveEHDxtRW', '2025-02-15 19:12:03', 0, 'Pending', 'COD', ''),
(11, 4, 600.00, 'pending', 'order_Pw68bxdHNE4AaQ', '2025-02-15 19:15:08', 0, 'Pending', 'COD', ''),
(12, 4, 600.00, 'pending', 'order_Pw68l5SF2dcg2T', '2025-02-15 19:15:17', 0, 'Pending', 'COD', ''),
(13, 4, 600.00, 'pending', 'order_Pw69p5jWtQLhc2', '2025-02-15 19:16:17', 0, 'Pending', 'COD', ''),
(14, 4, 600.00, 'pending', 'order_Pw69thVQu2TT0F', '2025-02-15 19:16:21', 0, 'Pending', 'COD', ''),
(15, 4, 600.00, 'pending', 'order_Pw6BWYFECL8MWQ', '2025-02-15 19:17:54', 0, 'Pending', 'COD', ''),
(16, 4, 600.00, 'pending', 'order_Pw6BbhuhWVAssd', '2025-02-15 19:17:58', 0, 'Pending', 'COD', ''),
(17, 4, 600.00, 'pending', 'order_Pw6FAbI1VX18Yn', '2025-02-15 19:21:21', 0, 'Pending', 'COD', ''),
(18, 4, 200.00, 'pending', 'order_Pw6GpNC7l4xkoT', '2025-02-15 19:22:55', 0, 'Pending', 'COD', ''),
(19, 4, 200.00, 'pending', 'order_Pw6IitKFEWMqxz', '2025-02-15 19:24:43', 0, 'Pending', 'COD', ''),
(20, 4, 250.00, 'pending', 'order_Pw6Lo6ESHU8Yh5', '2025-02-15 19:27:38', 0, 'Pending', 'COD', ''),
(21, 4, 250.00, 'pending', 'order_Pw6M5WX8QOPjoS', '2025-02-15 19:27:54', 0, 'Pending', 'COD', ''),
(22, 4, 250.00, 'pending', NULL, '2025-02-15 19:42:58', 7, 'Pending', 'COD', ''),
(23, 4, 300.00, 'pending', 'order_Pw6cM3AQx1Zpix', '2025-02-15 19:43:18', 0, 'Pending', 'COD', ''),
(24, 4, 300.00, 'pending', NULL, '2025-02-15 19:43:20', 8, 'Pending', 'COD', ''),
(25, 4, 250.00, 'pending', 'order_Pw6cl27dNnM9D6', '2025-02-15 19:43:40', 0, 'Pending', 'COD', ''),
(26, 4, 250.00, 'pending', 'order_Pw6dr6dcEKyGWX', '2025-02-15 19:44:43', 0, 'Pending', 'COD', ''),
(27, 4, 250.00, 'pending', NULL, '2025-02-15 19:44:45', 7, 'Pending', 'COD', ''),
(28, 4, 200.00, 'pending', 'order_Pw6fzcUvIOgc89', '2025-02-15 19:46:44', 0, 'Pending', 'COD', ''),
(29, 4, 200.00, 'pending', NULL, '2025-02-15 19:46:49', 5, 'Pending', 'COD', ''),
(30, 4, 180.00, 'pending', 'order_Pw6iV9OHYaDMh6', '2025-02-15 19:49:07', 0, 'Pending', 'COD', ''),
(31, 4, 180.00, 'pending', 'order_Pw6leHruGIS5z8', '2025-02-15 19:52:05', 0, 'Pending', 'COD', ''),
(32, 4, 380.00, 'pending', 'order_Pw6owLE5sLDiBF', '2025-02-15 19:55:12', 0, 'Pending', 'COD', ''),
(33, 4, 380.00, 'pending', NULL, '2025-02-15 19:55:14', 12, 'Pending', 'COD', ''),
(34, 4, 380.00, 'pending', NULL, '2025-02-15 19:55:14', 6, 'Pending', 'COD', ''),
(35, 4, 250.00, 'pending', 'order_Pw74YwmEVtnovE', '2025-02-15 20:10:00', 0, 'Pending', 'COD', ''),
(36, 4, 800.00, 'pending', 'order_Pw77LKKWuNVjgP', '2025-02-15 20:12:38', 0, 'Pending', 'COD', ''),
(37, 4, 800.00, 'pending', NULL, '2025-02-15 20:12:40', 7, 'Pending', 'COD', ''),
(38, 4, 800.00, 'pending', NULL, '2025-02-15 20:12:40', 8, 'Pending', 'COD', ''),
(39, 4, 550.00, 'pending', 'order_Pw78mXXsMndrkw', '2025-02-15 20:13:59', 0, 'Pending', 'COD', ''),
(40, 4, 550.00, 'pending', 'order_Pw7CrVh3rIq5PQ', '2025-02-15 20:17:51', 0, 'Pending', 'COD', ''),
(41, 4, 550.00, 'pending', 'order_Pw7FhTwRZmRS9D', '2025-02-15 20:20:32', 0, 'Pending', 'COD', ''),
(42, 4, 550.00, 'pending', NULL, '2025-02-15 20:20:41', 7, 'Pending', 'COD', ''),
(43, 4, 550.00, 'pending', NULL, '2025-02-15 20:20:41', 8, 'Pending', 'COD', ''),
(44, 4, 300.00, 'pending', 'order_Pw7GIJ8sWElNpa', '2025-02-15 20:21:06', 0, 'Pending', 'COD', ''),
(45, 4, 850.00, 'pending', 'order_Pw7HEjfMnC4xYd', '2025-02-15 20:22:00', 0, 'Pending', 'COD', ''),
(46, 4, 850.00, 'pending', NULL, '2025-02-15 20:22:01', 8, 'Pending', 'COD', ''),
(47, 4, 850.00, 'pending', NULL, '2025-02-15 20:22:02', 7, 'Pending', 'COD', ''),
(48, 4, 300.00, 'pending', 'order_Pw7HVy2wuSqCfb', '2025-02-15 20:22:15', 0, 'Pending', 'COD', ''),
(49, 4, 600.00, 'pending', 'order_PwLPgj5fvwhwv9', '2025-02-16 10:11:42', 0, 'Pending', 'COD', ''),
(50, 4, 600.00, 'pending', 'order_PwLTgYl2jRN4sq', '2025-02-16 10:15:29', 0, 'Pending', 'COD,online', ''),
(51, 4, 600.00, 'pending', 'order_PwLWuMJODG1fiW', '2025-02-16 10:18:32', 0, 'Pending', 'COD,online', 'proxyyfoxy12@gmal.com');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `image`, `stock`, `category_id`) VALUES
(5, 'Hair Growth Shampoo', 'Reduce hair fall, Grows new Hair Bullds Healthy & Strong Roots', 100.00, 'public/images/pic6.jpg', 13, 2),
(6, 'Aloe vera SHAMPOO', 'Boosts hair growth, longar and darker Hair growth, shine and luster,Soft & silky hair ,Prevents hair loss', 200.00, 'public/images/pic1.jpg', 20, 2),
(7, 'KESAR HALDI Face Wash', 'skin whitening , anti aging , reduce pigmentation & dark spots', 250.00, 'public/images/pic2.jpg', 15, 1),
(8, 'Gold FaceWash', 'PREMIUM QUALITY\r\nBrightness Cleans', 300.00, 'uploads/pic4..jpg', 15, 1),
(9, '9 FRUIT Formating FaceWash', 'King of Brightening,Nourishes & Hydration, Lighten Dark Spots & Pimples', 200.00, 'public/images/pic5..jpg', 12, 1),
(10, 'Amla Shampoo', 'Smooth and Silky, Strengthens hair Naturally', 120.00, 'uploads/pic7.jpg', 40, 2),
(11, 'Milk Soap ', 'Ayur Organic Hand Made Soap', 100.00, 'uploads/pic11.jpg', 20, 4),
(12, 'Onion Methi Hai Oil', 'Reduce hair Fall & Dandruff, Help to Increase Hair Growth', 180.00, 'uploads/pic10.jpg', 30, 2),
(13, 'Charcoal Face Wash', 'Anti-pollution & Anti-Acne,Reduce Blackheads & Dark spots', 210.00, 'uploads/pic9.jpg', 20, 1),
(14, 'Dandruff Hair oil', 'Builds Healthy & Strong Roots, Reduce Hair Fall, Enhanced hair Groth', 150.00, 'uploads/pic8.jpg', 30, 2),
(15, 'ALL Purpose Shampoo', 'Makes Your Hair Shine & Silky, Brightness Hair Naturally ', 150.00, 'uploads/pic14.jpg', 80, 2),
(16, 'dandruff shampoo', 'Scalp cleaner, remove itching, Builds strong Roots', 300.00, 'uploads/pic13.jpg', 23, 2),
(17, 'Onion Methi shampoo', 'educe Hair Fall, Reduce Dandruff, help to increases Hair Growth', 230.00, 'uploads/pic12.jpg', 60, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `phone`, `address`, `role`) VALUES
(1, 'proxyy ', 'proxyyfoxy@gmal.com', '$2y$10$oBYPl/Be/mxgIh.IF85uM.WY7GhkFl1euu49d0enKgzmbnwb4.NJm', '1256790524789', 'gfhkjlk', 'user'),
(2, 'truptikalal', 'truptikalal32@gmail.com', '$2y$10$/Di570qlVjVBFioLU1Xxo.YmeqPCWKLYZyYFJ7oPJSctAX93WVDIa', '01234567890', 'kadana', 'user'),
(4, 'pranjalkalal', 'proxyyfoxy12@gmal.com', '$2y$10$r9q44K6pQYuTQrAQn91m.uUWVQJ4lcktyjKkzFMbJqlzIk1thVuy.', '09979909428', 'kadana', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
