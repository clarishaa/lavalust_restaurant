-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2023 at 03:41 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lavala`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `audit_id` int NOT NULL,
  `item_id` int NOT NULL,
  `oldQuantity` int NOT NULL,
  `quantity` int NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `item_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(42, 75, 9, 5, '2023-12-03 08:58:56', '2023-12-10 09:48:04'),
(44, 75, 10, 26, '2023-12-03 22:03:52', '2023-12-10 04:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `type` enum('bar','restaurant') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `type`) VALUES
(4, 'Cocktails', 'Refreshing and delicious cocktails', 'bar'),
(5, 'Craft Beer', 'Wide selection of craft beers', 'bar'),
(6, 'Appetizers', 'Tasty starters to whet your appetite', 'restaurant'),
(7, 'Main Courses', 'Delicious and hearty main dishes', 'restaurant'),
(8, 'Desserts', 'Sweet treats to satisfy your cravings', 'restaurant');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `discount_id` int NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `invoice_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_id` int DEFAULT NULL,
  `invoice_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `category_id` int DEFAULT NULL,
  `img_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`, `description`, `price`, `category_id`, `img_path`, `created_at`, `quantity`) VALUES
(9, 'Margarita', 'Classic tequila-based cocktail with lime and triple sec', 8.99, 4, 'uploads/margarita.jpg', '2023-12-02 19:07:00', 19),
(10, 'IPA Beer', 'India Pale Ale with a hoppy flavor profile', 5.49, 5, 'uploads/ipa_beer.jpg', '2023-12-02 19:08:00', 20),
(11, 'Spinach', 'Creamy dip with spinach and artichoke hearts', 6.99, 4, 'uploads/spinach_dip.jpg', '2023-12-02 19:09:00', 20),
(12, 'Grilled Salmon', 'Salmon fillet grilled to perfection', 15.99, 7, 'uploads/grilled_salmon.jpg', '2023-12-02 19:10:00', 20),
(13, 'Chocolate Lava Cake', 'Warm chocolate cake with a gooey, molten center', 7.99, 8, 'uploads/lava_cake.jpg', '2023-12-02 19:11:00', 25);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `order_type` enum('dinein','takeout','delivery') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `order_details` text,
  `order_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','confirmed','completed') DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL,
  `discount_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_type`, `delivery_address`, `order_details`, `order_time`, `status`, `total_amount`, `discount_id`) VALUES
(452, 82, 'dinein', '', '', '2023-12-10 09:26:30', 'pending', 17.91, NULL),
(453, 82, 'dinein', '', '', '2023-12-10 09:29:28', 'pending', 10.07, NULL),
(454, 75, 'dinein', '', '', '2023-12-10 09:48:12', 'completed', 27.45, NULL),
(455, 75, 'dinein', '', '', '2023-12-10 10:12:08', 'completed', 44.95, NULL),
(456, 75, 'dinein', '', '', '2023-12-11 00:42:44', 'completed', 187.69, NULL),
(457, 75, 'dinein', '', '', '2023-12-11 00:44:34', 'completed', 142.74, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `orders_item_id` int NOT NULL,
  `item_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `user_id` int DEFAULT NULL,
  `order_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`orders_item_id`, `item_id`, `quantity`, `total_price`, `user_id`, `order_id`) VALUES
(591, 12, 2, 31.98, 82, 452),
(592, 9, 1, 8.99, 82, 453),
(593, 9, 5, 44.95, 75, 454),
(594, 9, 5, 44.95, 75, 455),
(595, 9, 5, 44.95, 75, 456),
(596, 10, 26, 142.74, 75, 456),
(597, 10, 26, 142.74, 75, 457);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `receipt_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `receipt_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_id` int DEFAULT NULL,
  `receipt_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`receipt_id`, `user_id`, `receipt_date`, `invoice_id`, `receipt_number`) VALUES
(1, 82, '2023-12-10 06:57:06', NULL, 'LMCC20231210065117'),
(2, 82, '2023-12-10 06:58:12', NULL, 'LMCC20231210065808'),
(3, 82, '2023-12-10 07:00:04', NULL, 'LMCC20231210070000'),
(4, 82, '2023-12-10 07:00:51', NULL, 'LMCC20231210070047'),
(5, 82, '2023-12-10 07:16:40', NULL, 'LMCC20231210071634'),
(6, 82, '2023-12-10 07:18:29', NULL, 'LMCC20231210071825'),
(7, 82, '2023-12-10 07:19:19', NULL, 'LMCC20231210071915'),
(8, 82, '2023-12-10 07:19:44', NULL, 'LMCC20231210071940'),
(9, 82, '2023-12-10 07:22:19', NULL, 'LMCC20231210072214'),
(10, 82, '2023-12-10 07:27:12', NULL, 'LMCC20231210072707'),
(11, 82, '2023-12-10 07:37:51', NULL, 'LMCC20231210073746'),
(12, 82, '2023-12-10 07:39:04', NULL, 'LMCC20231210073858'),
(13, 82, '2023-12-10 07:39:40', NULL, 'LMCC20231210073937'),
(14, 82, '2023-12-10 09:05:48', NULL, 'LMCC20231210090528'),
(15, 82, '2023-12-10 09:06:41', NULL, 'LMCC20231210090528'),
(16, 82, '2023-12-10 09:07:43', NULL, 'LMCC20231210090528'),
(17, 82, '2023-12-10 09:09:06', NULL, 'LMCC20231210090528'),
(18, 82, '2023-12-10 09:10:54', NULL, 'LMCC20231210090528'),
(19, 82, '2023-12-10 09:11:16', NULL, 'LMCC20231210090528'),
(20, 82, '2023-12-10 09:12:39', NULL, 'LMCC20231210090528'),
(21, 82, '2023-12-10 09:12:59', NULL, 'LMCC20231210090528'),
(22, 82, '2023-12-10 09:14:16', NULL, 'LMCC20231210090528'),
(23, 82, '2023-12-10 09:14:58', NULL, 'LMCC20231210090528'),
(24, 82, '2023-12-10 09:15:33', NULL, 'LMCC20231210090528'),
(25, 82, '2023-12-10 09:16:54', NULL, 'LMCC20231210090528'),
(26, 82, '2023-12-10 09:17:57', NULL, 'LMCC20231210090528'),
(27, 82, '2023-12-10 09:18:26', NULL, 'LMCC20231210091821'),
(28, 82, '2023-12-10 09:19:34', NULL, 'LMCC20231210091821'),
(29, 82, '2023-12-10 09:22:05', NULL, 'LMCC20231210091821'),
(30, 82, '2023-12-10 09:22:28', NULL, 'LMCC20231210091821'),
(31, 82, '2023-12-10 09:22:35', NULL, 'LMCC20231210092231'),
(32, 82, '2023-12-10 09:23:41', NULL, 'LMCC20231210092231'),
(33, 82, '2023-12-10 09:26:30', NULL, 'LMCC20231210092624'),
(34, 82, '2023-12-10 09:29:28', NULL, 'LMCC20231210092925'),
(35, 75, '2023-12-10 10:03:12', NULL, 'LMCC1702201692'),
(36, 75, '2023-12-10 10:47:14', NULL, 'LMCC1702203128'),
(37, 75, '2023-12-11 00:43:44', NULL, 'LMCC1702255364'),
(38, 75, '2023-12-11 00:45:07', NULL, 'LMCC1702255474');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_id` int NOT NULL,
  `table_number` int DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_id`, `table_number`, `is_available`, `capacity`, `description`, `price`, `quantity`) VALUES
(1, 101, 1, 8, 'Window seat', 50.00, 5),
(2, 102, 1, 6, 'Booth in corner', 75.00, 4),
(3, 103, 0, 2, 'High-top near bar', 30.00, 3),
(4, 104, 1, 8, 'Large group table', 100.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `table_book`
--

CREATE TABLE `table_book` (
  `booking_id` int NOT NULL,
  `user_id` int NOT NULL,
  `booktime` time NOT NULL,
  `bookdate` date NOT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `table_id` int DEFAULT NULL,
  `book_status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `table_book`
--

INSERT INTO `table_book` (`booking_id`, `user_id`, `booktime`, `bookdate`, `message`, `created_at`, `updated_at`, `table_id`, `book_status`) VALUES
(650, 75, '22:55:00', '2023-12-22', 'ghj', '2023-12-11 14:51:20', '2023-12-11 14:51:20', 4, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `tax_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `percentage` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `testimonial_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`testimonial_id`, `user_id`, `content`, `created_at`) VALUES
(1, 75, 'kjbknb', '2023-11-29 13:47:50'),
(2, 75, 'kjnohn', '2023-11-29 13:48:25'),
(3, 75, 'qwertyuiop[', '2023-11-30 01:26:39'),
(4, 75, 'hbbni', '2023-11-30 01:27:45'),
(5, 75, 'rgsthrtj', '2023-11-30 01:52:47'),
(6, 75, 'jgcjykyu', '2023-11-30 01:53:06'),
(7, 75, 'kjnn', '2023-11-30 01:53:33'),
(8, 75, 'asdfx,jhgfrewc', '2023-11-30 07:52:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_type` enum('customer','staff','admin') NOT NULL,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'inactive',
  `position` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `token`, `email`, `first_name`, `last_name`, `mobile`, `user_type`, `status`, `position`) VALUES
(75, '$2y$10$YqrQR2rULNaX7ScfAzsEneHOY8YJleKFIbfAVhpnSOTwoTVIEDSb.', 'uiGbdvRwWlEPp2nfLtmc7A8saZ43T0CNjDkQHzK6e5qxByoJrh', 'jrishh902@gmail.com', 'Clarish', 'Jabonillo', '09637832223', 'customer', 'active', ''),
(82, '$2y$10$S1Uc0MKDWltTXWNgqh3YIORXrt1ob6QquB6ODC8/4x7t6URiYqZwu', 'ccf6d38965d98a7878ccf79afe01f543', 'jrishh292@gmail.com', 'Clarishaa', 'Jabonillo', '09637832223', 'admin', 'inactive', 'Manager'),
(90, '$2y$10$LKOQx5EKV9f.UnJ2kzOGXuI4rydkxLQtCB4FGg8zS/unpRmiqK.m6', 'd267f40a869921b60fbab3ebbdcd2e2d', 'jrishh2902@gmail.com', 'Clarish', 'Jabonillo', NULL, 'admin', 'active', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`audit_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `discount_id` (`discount_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`orders_item_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`receipt_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `table_book`
--
ALTER TABLE `table_book`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `table_id` (`table_id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`testimonial_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `audit_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=458;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `orders_item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=598;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `receipt_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `table_book`
--
ALTER TABLE `table_book`
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=651;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `tax_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `testimonial_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `audit_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`discount_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`),
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `order_items_ibfk_4` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `receipts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `receipts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `receipts_ibfk_3` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`invoice_id`);

--
-- Constraints for table `table_book`
--
ALTER TABLE `table_book`
  ADD CONSTRAINT `table_book_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `table_book_ibfk_2` FOREIGN KEY (`table_id`) REFERENCES `tables` (`table_id`);

--
-- Constraints for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
