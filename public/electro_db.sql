-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 09:22 AM
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
-- Database: `electro_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Lenovo', '2024-03-10 04:59:01', NULL),
(2, 'Asus', '2024-03-10 04:59:01', NULL),
(3, 'Acer', '2024-03-10 04:59:01', NULL),
(4, 'Dell', '2024-03-10 04:59:01', NULL),
(5, 'Samsung', '2024-03-10 04:59:01', NULL),
(6, 'Xiaomi', '2024-03-10 04:59:01', NULL),
(7, 'Canon', '2024-03-10 04:59:01', NULL),
(8, 'Razer', '2024-03-10 04:59:01', NULL),
(9, 'JBL', '2024-03-10 04:59:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Laptops', '2024-03-10 04:59:01', NULL),
(2, 'Smartphones', '2024-03-10 04:59:01', NULL),
(3, 'Cameras', '2024-03-10 04:59:01', NULL),
(4, 'Accessories', '2024-03-10 04:59:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Screen Size', '2024-03-10 04:59:01', NULL),
(2, 'CPU', '2024-03-10 04:59:01', NULL),
(3, 'GPU', '2024-03-10 04:59:01', NULL),
(4, 'Camera Quality', '2024-03-10 04:59:01', NULL),
(5, 'Sound Range', '2024-03-10 04:59:01', NULL),
(6, 'Cable Length', '2024-03-10 04:59:01', NULL),
(7, 'RAM', '2024-03-10 04:59:01', NULL),
(8, 'Storage', '2024-03-10 04:59:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_03_04_130147_create_roles_table', 1),
(3, '2024_03_04_130324_create_users_table', 1),
(4, '2024_03_04_131144_create_user_address_table', 1),
(5, '2024_03_04_131540_create_user_cards_table', 1),
(6, '2024_03_04_132835_create_order_sessions_table', 1),
(7, '2024_03_04_133424_create_categories_table', 1),
(8, '2024_03_04_133515_create_brands_table', 1),
(9, '2024_03_04_133546_create_products_table', 1),
(10, '2024_03_04_133953_create_prices_table', 1),
(11, '2024_03_04_134140_create_details_table', 1),
(12, '2024_03_04_134238_create_product_details_table', 1),
(13, '2024_03_04_134851_create_order_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `price_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `product_id`, `order_id`, `price_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 7, 1, '2024-03-10 04:59:01', NULL),
(2, 5, 1, 9, 1, '2024-03-10 04:59:01', NULL),
(3, 4, 2, 7, 1, '2024-03-10 04:59:01', NULL),
(4, 5, 2, 9, 1, '2024-03-10 04:59:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_sessions`
--

CREATE TABLE `order_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `card_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_sessions`
--

INSERT INTO `order_sessions` (`id`, `user_id`, `total`, `card_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1060.00, 1, '2024-03-10 04:59:01', NULL),
(2, 2, 1060.00, 1, '2024-03-10 04:59:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `product_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 999.00, '2024-03-10 04:59:01', NULL),
(2, 1, 980.00, '2024-03-10 04:59:10', '2024-03-10 08:13:34'),
(3, 2, 129.99, '2024-03-10 04:59:01', NULL),
(4, 2, 109.99, '2024-03-10 04:59:21', '2024-03-10 08:13:51'),
(5, 3, 879.99, '2024-03-10 04:59:01', NULL),
(6, 4, 999.00, '2024-03-10 04:59:01', NULL),
(7, 4, 980.00, '2024-03-10 04:59:21', '2024-03-10 08:13:59'),
(8, 5, 89.98, '2024-03-10 04:59:01', NULL),
(9, 5, 80.00, '2024-03-10 04:59:21', '2024-03-10 08:14:10'),
(10, 6, 1299.00, '2024-03-10 04:59:01', NULL),
(11, 7, 999.00, '2024-03-10 04:59:01', NULL),
(12, 7, 980.00, '2024-03-10 04:59:21', '2024-03-10 08:14:15'),
(13, 8, 978.00, '2024-03-10 04:59:01', NULL),
(14, 8, 899.00, '2024-03-10 04:59:21', '2024-03-10 08:14:19'),
(15, 9, 769.99, '2024-03-10 04:59:01', NULL),
(16, 9, 750.00, '2024-03-10 04:59:21', '2024-03-10 08:14:21'),
(17, 10, 999.00, '2024-03-10 04:59:01', NULL),
(18, 10, 980.00, '2024-03-10 04:59:21', '2024-03-10 08:14:25'),
(19, 11, 978.00, '2024-03-10 04:59:01', NULL),
(20, 11, 899.00, '2024-03-10 04:59:21', '2024-03-10 08:14:29'),
(21, 12, 759.00, '2024-03-10 04:59:01', NULL),
(22, 12, 709.99, '2024-03-10 04:59:21', '2024-03-10 08:14:33'),
(23, 13, 769.99, '2024-03-10 04:59:01', NULL),
(24, 13, 750.00, '2024-03-10 04:59:21', '2024-03-10 08:14:37'),
(25, 14, 129.98, '2024-03-10 04:59:21', '2024-03-10 08:14:45'),
(26, 14, 90.00, '2024-03-10 04:59:01', NULL),
(27, 15, 769.99, '2024-03-10 04:59:01', NULL),
(28, 15, 747.99, '2024-03-10 04:59:01', NULL),
(29, 18, 17.99, '2024-03-10 04:58:59', '2024-03-10 04:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `category_id`, `brand_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Latitude 512', 'product01.png', 1, 4, 'Laptop Dell Latitude 512 built for greatness', '2024-03-10 04:59:01', NULL),
(2, 'Bass General', 'product02.png', 4, 9, 'Bass General, straight from the battlefield', '2024-03-10 04:59:01', NULL),
(3, 'Ideapad 115', 'product03.png', 1, 1, 'Lenovo built for greatness', '2024-03-10 04:59:01', NULL),
(4, 'Galaxy Tab 7', 'product04.png', 2, 5, 'Samsung, explore your own galaxy', '2024-03-10 04:59:01', NULL),
(5, 'Soundmaster 5', 'product05.png', 4, 8, 'Soundmaster 5, master your sound', '2024-03-10 04:59:01', NULL),
(6, 'Gaming Prodigy', 'product06.png', 1, 2, 'Prepare to not go out for the next two years', '2024-03-10 04:59:01', NULL),
(7, 'Mi 7', 'product07.png', 2, 6, 'Xiaomi. Best price to performance ratio', '2024-03-10 04:59:01', NULL),
(8, 'Aspire 4', 'product08.png', 1, 3, 'Acer Aspire, find new inspiration', '2024-03-10 04:59:01', NULL),
(9, 'Reality 2', 'product09.png', 3, 7, 'Professional Camera that speaks for itself', '2024-03-10 04:59:01', NULL),
(10, 'Galaxy S8 Ultra', 'product07.png', 2, 6, 'Samsung. Explore your galaxy', '2024-03-10 04:59:01', NULL),
(11, 'Aspire 7', 'product08.png', 1, 3, 'Acer Aspire, find new inspiration', '2024-03-10 04:59:01', NULL),
(12, 'Zenphone', 'product10.png', 2, 2, 'Asus. Reflect your soul', '2024-03-10 04:59:01', NULL),
(13, 'Sunshine 34', 'product09.png', 3, 7, 'Professional Camera that speaks for itself', '2024-03-10 04:59:01', NULL),
(14, 'Soundmaster 7', 'product11.png', 4, 8, 'Soundmaster 7, master your sound', '2024-03-10 04:59:01', NULL),
(15, 'Unreal 4', 'product12.png', 3, 7, 'Professional Camera', '2024-03-10 04:59:01', NULL),
(18, 'Test Unos', '65ed4c235c3edoutput-onlinepngtools (1).png', 2, 2, 'Test Unos', '2024-03-10 04:58:59', '2024-03-10 04:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `detail_id` bigint(20) UNSIGNED NOT NULL,
  `detail_value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `detail_id`, `detail_value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '17 inches', '2024-03-10 04:59:01', NULL),
(2, 1, 2, 'Intel i7 15600K', '2024-03-10 04:59:01', NULL),
(3, 1, 3, 'Nvidia GTX 1650', '2024-03-10 04:59:01', NULL),
(4, 1, 7, '16GB', '2024-03-10 04:59:01', NULL),
(5, 1, 8, '1TB', '2024-03-10 04:59:01', NULL),
(6, 2, 5, '20db-20000db', '2024-03-10 04:59:01', NULL),
(7, 2, 6, '2m', '2024-03-10 04:59:01', NULL),
(8, 3, 1, '18 inches', '2024-03-10 04:59:01', NULL),
(9, 3, 2, 'Intel i5 13600K', '2024-03-10 04:59:01', NULL),
(10, 3, 3, 'Nvidia GTX 1060', '2024-03-10 04:59:01', NULL),
(11, 3, 7, '12GB', '2024-03-10 04:59:01', NULL),
(12, 3, 8, '850GB', '2024-03-10 04:59:01', NULL),
(13, 4, 1, '10 inches', '2024-03-10 04:59:01', NULL),
(14, 4, 4, '40MP', '2024-03-10 04:59:01', NULL),
(15, 4, 7, '8GB', '2024-03-10 04:59:01', NULL),
(16, 4, 8, '64GB', '2024-03-10 04:59:01', NULL),
(17, 5, 5, '20db-20000db', '2024-03-10 04:59:01', NULL),
(18, 5, 6, '2m', '2024-03-10 04:59:01', NULL),
(19, 6, 1, '18 inches', '2024-03-10 04:59:01', NULL),
(20, 6, 2, 'AMD Ryzen 4700X', '2024-03-10 04:59:01', NULL),
(21, 6, 3, 'Nvidia GTX 4060', '2024-03-10 04:59:01', NULL),
(22, 6, 7, '24GB', '2024-03-10 04:59:01', NULL),
(23, 6, 8, '2TB', '2024-03-10 04:59:01', NULL),
(24, 7, 1, '7 inches', '2024-03-10 04:59:01', NULL),
(25, 7, 4, '64MP', '2024-03-10 04:59:01', NULL),
(26, 7, 7, '6GB', '2024-03-10 04:59:01', NULL),
(27, 7, 8, '128GB', '2024-03-10 04:59:01', NULL),
(28, 8, 1, '18 inches', '2024-03-10 04:59:01', NULL),
(29, 8, 2, 'Intel i5 13600K', '2024-03-10 04:59:01', NULL),
(30, 8, 3, 'Nvidia GTX 1060', '2024-03-10 04:59:01', NULL),
(31, 8, 7, '12GB', '2024-03-10 04:59:01', NULL),
(32, 8, 8, '850GB', '2024-03-10 04:59:01', NULL),
(33, 9, 4, '150MP', '2024-03-10 04:59:01', NULL),
(34, 9, 8, '50GB', '2024-03-10 04:59:01', NULL),
(35, 10, 1, '7 inches', '2024-03-10 04:59:01', NULL),
(36, 10, 4, '64MP', '2024-03-10 04:59:01', NULL),
(37, 10, 7, '6GB', '2024-03-10 04:59:01', NULL),
(38, 10, 8, '128GB', '2024-03-10 04:59:01', NULL),
(39, 11, 1, '18 inches', '2024-03-10 04:59:01', NULL),
(40, 11, 2, 'Intel i5 13600K', '2024-03-10 04:59:01', NULL),
(41, 11, 3, 'Nvidia GTX 1060', '2024-03-10 04:59:01', NULL),
(42, 11, 7, '12GB', '2024-03-10 04:59:01', NULL),
(43, 11, 8, '850GB', '2024-03-10 04:59:01', NULL),
(44, 12, 1, '8 inches', '2024-03-10 04:59:01', NULL),
(45, 12, 4, '64MP', '2024-03-10 04:59:01', NULL),
(46, 12, 7, '6GB', '2024-03-10 04:59:01', NULL),
(47, 12, 8, '128GB', '2024-03-10 04:59:01', NULL),
(48, 13, 4, '150MP', '2024-03-10 04:59:01', NULL),
(49, 13, 8, '50GB', '2024-03-10 04:59:01', NULL),
(50, 14, 5, '20db-20000db', '2024-03-10 04:59:01', NULL),
(51, 14, 6, '2m', '2024-03-10 04:59:01', NULL),
(52, 15, 4, '150MP', '2024-03-10 04:59:01', NULL),
(53, 15, 8, '50GB', '2024-03-10 04:59:01', NULL),
(54, 18, 1, '8 inches', '2024-03-10 04:58:59', '2024-03-10 04:58:59'),
(55, 18, 4, '40MP', '2024-03-10 04:58:59', '2024-03-10 04:58:59'),
(56, 18, 8, '120GB', '2024-03-10 04:58:59', '2024-03-10 04:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2024-03-10 04:59:00', NULL),
(2, 'user', '2024-03-10 04:59:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `phone`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'laravelmejl321@gmail.com', '$2y$12$O5eX/dl9MkRvHtqSkFo2BOzkYpZiNqjUzFNN6Lmza4nOpE5gPRkIm', 'Admin', 'Electro', '0631234567', 1, '2024-03-10 04:59:00', NULL),
(2, 'user@test.com', '$2y$12$S0RPED3Udwj33dFVflFIhObMNEuIWivXZmhSrGYVeEVw6ri7IzfSS', 'Test', 'User', '0631234567', 2, '2024-03-10 04:59:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_line` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `address_line`, `city`, `postal_code`, `country`, `created_at`, `updated_at`) VALUES
(1, 2, '873 Stoltenberg Islands\nWest Dorthyview, TN 81415', 'Mossieside', '3238764', 'Ethiopia', '2024-03-10 04:59:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_cards`
--

CREATE TABLE `user_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `card_number` bigint(20) UNSIGNED NOT NULL,
  `expiry_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_cards`
--

INSERT INTO `user_cards` (`id`, `user_id`, `card_number`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, 2, 4916406852338, '2026-01-01', '2024-03-10 04:59:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_price_id_foreign` (`price_id`);

--
-- Indexes for table `order_sessions`
--
ALTER TABLE `order_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_sessions_user_id_foreign` (`user_id`),
  ADD KEY `order_sessions_card_id_foreign` (`card_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prices_product_id_foreign` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_details_product_id_foreign` (`product_id`),
  ADD KEY `product_details_detail_id_foreign` (`detail_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_address_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_cards`
--
ALTER TABLE `user_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_cards_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_sessions`
--
ALTER TABLE `order_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_cards`
--
ALTER TABLE `user_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order_sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_price_id_foreign` FOREIGN KEY (`price_id`) REFERENCES `prices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_sessions`
--
ALTER TABLE `order_sessions`
  ADD CONSTRAINT `order_sessions_card_id_foreign` FOREIGN KEY (`card_id`) REFERENCES `user_cards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_detail_id_foreign` FOREIGN KEY (`detail_id`) REFERENCES `details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_cards`
--
ALTER TABLE `user_cards`
  ADD CONSTRAINT `user_cards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
