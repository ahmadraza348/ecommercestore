-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 04:24 PM
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
-- Database: `ecommercestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `username`, `email`, `phone`, `gender`, `image`, `email_verified_at`, `remember_token`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad', 'Raza', 'superadmin', 'engr.ahmadraza348@gmail.com', '+923499153486', NULL, NULL, NULL, NULL, '$2y$12$6PimNc8uLQNUDUgELUiPsOeB/F7wNsjpFOHPIlOWrHuFRaOVTawHO', 1, '2024-11-22 22:45:23', '2024-11-22 22:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Color', 'color', '1', '2024-12-13 22:46:04', '2024-12-13 22:46:04'),
(5, 'Size', 'size', '1', '2024-12-13 22:46:23', '2024-12-13 22:46:23'),
(6, 'Fabric', 'fabric', '1', '2024-12-13 22:47:38', '2024-12-13 22:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `colorcode` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `name`, `slug`, `colorcode`, `status`, `attribute_id`, `created_at`, `updated_at`) VALUES
(1, 'Red', 'red', '#ff0000', '1', 4, '2024-12-13 22:53:51', '2024-12-13 22:53:51'),
(2, 'Black', 'black', '#000000', '1', 4, '2024-12-13 22:54:06', '2024-12-13 22:54:06'),
(3, 'Blue', 'blue', '#1100ff', '1', 4, '2024-12-13 22:54:24', '2024-12-13 22:54:24'),
(4, 'White', 'white', '#ffffff', '1', 4, '2024-12-13 22:54:40', '2024-12-13 22:54:40'),
(5, 'Small', 'small', '#ff0000', '1', 5, '2024-12-13 23:09:42', '2024-12-13 23:09:42'),
(6, 'Medium', 'medium', '#000000', '1', 5, '2024-12-13 23:12:58', '2024-12-13 23:12:58'),
(7, 'Large', 'large', '#000000', '1', 5, '2024-12-13 23:14:54', '2024-12-13 23:14:54'),
(8, 'X Large', 'x-large', '#000000', '1', 5, '2024-12-13 23:15:12', '2024-12-13 23:15:12'),
(9, 'Silk', 'silk', '#000000', '1', 6, '2024-12-13 23:15:41', '2024-12-13 23:16:59'),
(10, 'Cotton', 'cotton', '#000000', '1', 6, '2024-12-13 23:16:27', '2024-12-13 23:16:27'),
(11, 'Velvet', 'velvet', '#000000', '1', 6, '2024-12-13 23:16:39', '2024-12-13 23:16:39'),
(12, 'Grey', 'grey', '#c3bbbb', '1', 4, '2024-12-14 12:19:31', '2024-12-14 12:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `image`, `description`, `website`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Zara', 'zara', 'images/brands/1734161498_675d345ae7ae9.png', 'Zara Brand', NULL, '1', '2024-11-23 23:38:12', '2024-12-14 15:31:38'),
(2, 'Mango', 'mango', 'images/brands/1734161440_675d3420e273a.png', 'Mango', NULL, '1', '2024-11-23 23:38:54', '2024-12-14 15:30:40'),
(3, 'Levi\'s', 'levis', 'images/brands/1734161401_675d33f95b75a.png', 'Levis', NULL, '1', '2024-11-23 23:39:41', '2024-12-14 15:30:01'),
(4, 'Caters', 'caters', 'images/brands/1734161359_675d33cf23760.png', 'Caters', NULL, '1', '2024-11-23 23:40:22', '2024-12-14 15:29:19'),
(5, 'Ralph Lauren', 'ralph-lauren', 'images/brands/1734161468_675d343cc716d.png', 'Ralph Lauren', NULL, '1', '2024-11-23 23:42:17', '2024-12-14 15:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_featured` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `description`, `parent_id`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(21, 'Men\'s Fashion', 'mens-fashion', 'images/categories/1734095721_675c33695e11f.jpg', 'Men\'s Fashion', NULL, '1', '1', '2024-12-13 20:53:18', '2024-12-13 21:15:21'),
(22, 'Women Fashion', 'women-fashion', 'images/categories/1734097748_675c3b544d044.jfif', NULL, NULL, '1', '1', '2024-12-13 21:49:08', '2024-12-13 21:49:08'),
(23, 'Western', 'western', 'images/categories/1734097950_675c3c1e753f0.webp', NULL, 21, '0', '1', '2024-12-13 21:49:42', '2024-12-13 21:52:30'),
(24, 'Casual Shirts', 'casual-shirts', 'images/categories/1734098010_675c3c5ad5c49.webp', NULL, 23, '0', '1', '2024-12-13 21:53:30', '2024-12-13 21:53:30'),
(25, 'Jackets', 'jackets', 'images/categories/1734098053_675c3c8559279.webp', NULL, 23, '0', '1', '2024-12-13 21:54:13', '2024-12-13 21:54:13'),
(26, 'Hoodies & Sweatshirts', 'hoodies-sweatshirts', 'images/categories/1734098109_675c3cbd01bcf.webp', NULL, 23, '0', '1', '2024-12-13 21:55:09', '2024-12-13 21:55:09'),
(27, 'Full Sleeves', 'full-sleeves', 'images/categories/1734098310_675c3d86eefd2.webp', NULL, 24, '0', '1', '2024-12-13 21:58:30', '2024-12-13 21:58:30'),
(28, 'Short Sleeves', 'short-sleeves', 'images/categories/1734098338_675c3da23c2ca.webp', NULL, 24, '0', '1', '2024-12-13 21:58:58', '2024-12-13 21:58:58'),
(29, 'Tees & Tops', 'tees-tops', 'images/categories/1734099228_675c411ccc90b.webp', NULL, 22, '0', '1', '2024-12-13 22:13:48', '2024-12-13 22:37:50'),
(30, 'TankTop', 'tanktop', 'images/categories/1734100229_675c4505cb139.webp', NULL, 29, '0', '1', '2024-12-13 22:30:29', '2024-12-13 22:30:29'),
(31, 'Crop top', 'crop-top', 'images/categories/1734100293_675c4545cfe2e.webp', NULL, 29, '0', '1', '2024-12-13 22:31:33', '2024-12-13 22:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meta_tags`
--

CREATE TABLE `meta_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `metaable_id` bigint(20) UNSIGNED NOT NULL,
  `metaable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meta_tags`
--

INSERT INTO `meta_tags` (`id`, `meta_title`, `meta_keywords`, `meta_description`, `metaable_id`, `metaable_type`, `created_at`, `updated_at`) VALUES
(1, 'Men\'s Fashion', 'Men\'s Fashion', 'Men\'s Fashion', 1, 'App\\Models\\Category', '2024-11-22 22:47:51', '2024-11-22 22:47:51'),
(2, 'Women\'s Fashion', 'Women\'s Fashion', 'Women\'s Fashion', 2, 'App\\Models\\Category', '2024-11-22 22:49:15', '2024-11-22 22:49:15'),
(3, 'Kids Fashion', 'Kids Fashion', 'Kids Fashion', 3, 'App\\Models\\Category', '2024-11-22 22:51:22', '2024-11-22 22:51:22'),
(5, 'Trousers', 'Trousers', 'Trousers', 5, 'App\\Models\\Category', '2024-11-22 22:56:48', '2024-11-23 22:37:09'),
(6, 'Jackets', 'Jackets', 'Jackets', 6, 'App\\Models\\Category', '2024-11-22 22:57:47', '2024-11-23 22:39:27'),
(7, 'Casual Shirts', 'Casual Shirts', 'Casual Shirts', 7, 'App\\Models\\Category', '2024-11-23 22:43:16', '2024-11-23 22:43:16'),
(8, 'Formal Shirts', 'Formal Shirts', 'Formal Shirts', 8, 'App\\Models\\Category', '2024-11-23 22:44:38', '2024-11-23 22:44:38'),
(9, 'Dresses', 'Dresses', 'Dresses', 9, 'App\\Models\\Category', '2024-11-23 22:47:17', '2024-11-23 22:47:17'),
(10, 'Tops', 'Tops', 'Tops', 10, 'App\\Models\\Category', '2024-11-23 22:48:43', '2024-11-23 22:48:43'),
(11, 'Party Dresses', 'Party Dresses', 'Party Dresses', 11, 'App\\Models\\Category', '2024-11-23 22:57:58', '2024-11-23 22:57:58'),
(12, 'Casual Dress', 'Casual Dress', 'Casual Dress', 12, 'App\\Models\\Category', '2024-11-23 22:58:50', '2024-11-23 22:58:50'),
(13, 'Boys’ ClothingBoys’ Clothing', 'Boys’ Clothing', 'Boys’ Clothing', 13, 'App\\Models\\Category', '2024-11-23 23:04:09', '2024-11-23 23:04:09'),
(14, 'Girls’ Clothing', 'Girls’ Clothing', 'Girls’ Clothing', 14, 'App\\Models\\Category', '2024-11-23 23:05:39', '2024-11-23 23:05:39'),
(15, 'Accessories', 'Accessories', 'Accessories', 15, 'App\\Models\\Category', '2024-11-23 23:06:57', '2024-11-23 23:06:57'),
(16, 'Full Sleeve', 'Full Sleeve', 'Full Sleeve', 16, 'App\\Models\\Category', '2024-11-23 23:28:56', '2024-11-23 23:28:56'),
(17, 'Half Sleeve', 'Half Sleeve', 'Half Sleeve', 17, 'App\\Models\\Category', '2024-11-23 23:29:53', '2024-11-23 23:29:53'),
(18, 'T Shirts', 'T Shirts', 'T Shirts', 18, 'App\\Models\\Category', '2024-11-26 23:26:53', '2024-11-26 23:26:53'),
(22, NULL, NULL, NULL, 19, 'App\\Models\\Category', '2024-12-06 23:45:19', '2024-12-06 23:45:19'),
(23, NULL, NULL, NULL, 20, 'App\\Models\\Category', '2024-12-08 23:23:27', '2024-12-08 23:23:27'),
(25, NULL, NULL, NULL, 21, 'App\\Models\\Category', '2024-12-13 20:53:19', '2024-12-13 20:53:19'),
(26, NULL, NULL, NULL, 22, 'App\\Models\\Category', '2024-12-13 21:49:08', '2024-12-13 21:49:08'),
(27, NULL, NULL, NULL, 23, 'App\\Models\\Category', '2024-12-13 21:49:42', '2024-12-13 21:49:42'),
(28, NULL, NULL, NULL, 24, 'App\\Models\\Category', '2024-12-13 21:53:30', '2024-12-13 21:53:30'),
(29, NULL, NULL, NULL, 25, 'App\\Models\\Category', '2024-12-13 21:54:13', '2024-12-13 21:54:13'),
(30, NULL, NULL, NULL, 26, 'App\\Models\\Category', '2024-12-13 21:55:09', '2024-12-13 21:55:09'),
(31, NULL, NULL, NULL, 27, 'App\\Models\\Category', '2024-12-13 21:58:31', '2024-12-13 21:58:31'),
(32, NULL, NULL, NULL, 28, 'App\\Models\\Category', '2024-12-13 21:58:58', '2024-12-13 21:58:58'),
(33, NULL, NULL, NULL, 29, 'App\\Models\\Category', '2024-12-13 22:13:48', '2024-12-13 22:13:48'),
(34, NULL, NULL, NULL, 30, 'App\\Models\\Category', '2024-12-13 22:30:29', '2024-12-13 22:30:29'),
(35, NULL, NULL, NULL, 31, 'App\\Models\\Category', '2024-12-13 22:31:33', '2024-12-13 22:31:33'),
(36, 'meta title', 'meta keywords', 'meta description', 5, 'App\\Models\\Product', '2024-12-13 23:41:29', '2024-12-13 23:41:29'),
(37, 'meta title', 'meta keywords', 'desc', 6, 'App\\Models\\Product', '2024-12-14 00:03:25', '2024-12-14 00:03:25'),
(38, NULL, NULL, NULL, 7, 'App\\Models\\Product', '2024-12-14 12:18:45', '2024-12-14 12:18:45');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_25_052836_create_admins_table', 1),
(5, '2024_10_16_054048_create_categories_table', 1),
(6, '2024_10_18_140121_create_meta_tags_table', 1),
(7, '2024_10_25_052741_create_brands_table', 1),
(8, '2024_10_25_060938_create_attributes_table', 1),
(9, '2024_10_25_081410_create_attribute_values_table', 1),
(10, '2024_11_02_042850_create_products_table', 1),
(11, '2024_11_04_044522_create_pro_images_table', 1),
(12, '2024_11_05_045824_create_pro_attribute_values_table', 1),
(14, '2024_11_22_105602_add_brand_column_into_products_table', 1),
(15, '2024_11_29_155158_create_personal_access_tokens_table', 2),
(16, '2024_11_15_053537_create_relational_categories_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `sale_price` int(11) NOT NULL,
  `previous_price` int(11) DEFAULT NULL,
  `purchase_price` int(11) DEFAULT NULL,
  `barcode` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `short_description` mediumtext DEFAULT NULL,
  `long_description` longtext DEFAULT NULL,
  `featured_image` varchar(255) NOT NULL,
  `back_image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `name`, `slug`, `sku`, `status`, `sale_price`, `previous_price`, `purchase_price`, `barcode`, `stock`, `tags`, `label`, `is_featured`, `short_description`, `long_description`, `featured_image`, `back_image`, `video`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 1, 'Full Sleeves T Shirt For Boys', 'full-sleeves-t-shirt-for-boys', '001', 'active', 1200, 1500, 1000, 'bar001', 12, 'men shirt, full sleeve Shirt, boys shirt', 'new', 1, 'short', '<p><b>long</b></p>', 'images/products/1734104488_675c55a8defa4.jfif', 'images/products/1734104488_675c55a8e18d9.jpg', NULL, '2024-12-13 23:41:28', '2024-12-13 23:41:28', NULL),
(6, 2, 'Short Sleeves Men Shirt', 'short-sleeves-men-shirt', '002', 'active', 1500, 1700, 1200, 'bar002', 15, 'men shirt, boy shirt, short sleeve', 'hot', 1, 'short', '<p><b>long</b></p>', 'images/products/1734105805_675c5acd23a3e.jpg', 'images/products/1734105805_675c5acd26023.webp', NULL, '2024-12-14 00:03:25', '2024-12-14 00:03:25', NULL),
(7, 4, 'Women\'s Tank Top', 'womens-tank-top', '003', 'active', 1690, 1800, 1500, 'bar003', 20, 'tanktop, ladies wear', 'sale', 1, 'short', '<p>long</p>', 'images/products/1734149923_675d0723f2988.webp', 'images/products/1734149924_675d0724a9182.webp', NULL, '2024-12-14 12:18:44', '2024-12-14 12:18:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pro_attribute_values`
--

CREATE TABLE `pro_attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_value_id` bigint(20) UNSIGNED NOT NULL,
  `itemcode` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pro_attribute_values`
--

INSERT INTO `pro_attribute_values` (`id`, `product_id`, `attribute_id`, `attribute_value_id`, `itemcode`, `stock`, `price`, `created_at`, `updated_at`) VALUES
(23, 5, 4, 1, 1, 2, 1200.00, '2024-12-13 23:41:28', '2024-12-13 23:41:28'),
(24, 5, 5, 5, 1, 2, 1200.00, '2024-12-13 23:41:29', '2024-12-13 23:41:29'),
(25, 6, 4, 2, 2, 5, 1500.00, '2024-12-14 00:03:25', '2024-12-14 00:03:25'),
(26, 6, 5, 6, 2, 5, 1500.00, '2024-12-14 00:03:25', '2024-12-14 00:03:25'),
(27, 6, 4, 3, 3, 5, 1700.00, '2024-12-14 00:03:25', '2024-12-14 00:03:25'),
(28, 6, 5, 8, 3, 5, 1700.00, '2024-12-14 00:03:25', '2024-12-14 00:03:25'),
(83, 7, 5, 7, 1, 2, 1750.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(84, 7, 5, 5, 1, 2, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(85, 7, 6, 9, 1, 6, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(86, 7, 5, 6, 1, 2, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(87, 7, 4, 3, 1, 6, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(88, 7, 4, 4, 2, 6, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(89, 7, 5, 5, 2, 2, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(90, 7, 5, 6, 2, 2, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(91, 7, 6, 10, 2, 6, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(92, 7, 5, 8, 2, 2, 1800.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(93, 7, 4, 2, 3, 4, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(94, 7, 5, 5, 3, 2, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(95, 7, 5, 6, 3, 2, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(96, 7, 6, 11, 3, 4, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(97, 7, 5, 7, 4, 2, 1750.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(98, 7, 6, 10, 4, 4, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(99, 7, 4, 12, 4, 4, 1690.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(100, 7, 5, 8, 4, 2, 1800.00, '2024-12-14 13:59:53', '2024-12-14 13:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `pro_images`
--

CREATE TABLE `pro_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pro_images`
--

INSERT INTO `pro_images` (`id`, `product_id`, `image`, `color_id`, `created_at`, `updated_at`) VALUES
(19, 5, 'images/products/gallery/1734104488_675c55a8e4527.jfif', 4, '2024-12-13 23:41:28', '2024-12-13 23:41:28'),
(20, 5, 'images/products/gallery/1734104488_675c55a8e87a3.jfif', 1, '2024-12-13 23:41:28', '2024-12-13 23:41:28'),
(21, 5, 'images/products/gallery/1734104488_675c55a8e9b06.jfif', 3, '2024-12-13 23:41:28', '2024-12-13 23:41:28'),
(22, 5, 'images/products/gallery/1734104488_675c55a8ebf3d.jpg', 2, '2024-12-13 23:41:28', '2024-12-13 23:41:28'),
(23, 6, 'images/products/gallery/1734105805_675c5acd2948c.jfif', 4, '2024-12-14 00:03:25', '2024-12-14 00:03:25'),
(24, 6, 'images/products/gallery/1734105805_675c5acd2b5bb.jfif', 1, '2024-12-14 00:03:25', '2024-12-14 00:03:25'),
(25, 6, 'images/products/gallery/1734105805_675c5acd2cbcb.jpg', 2, '2024-12-14 00:03:25', '2024-12-14 00:03:25'),
(26, 7, 'images/products/gallery/1734149924_675d0724abf02.webp', 12, '2024-12-14 12:18:44', '2024-12-14 12:20:29'),
(27, 7, 'images/products/gallery/1734149924_675d0724b62e2.webp', 12, '2024-12-14 12:18:44', '2024-12-14 12:20:29'),
(28, 7, 'images/products/gallery/1734149924_675d0724b7a80.webp', 3, '2024-12-14 12:18:44', '2024-12-14 12:18:44'),
(29, 7, 'images/products/gallery/1734149924_675d0724bf7e2.webp', 3, '2024-12-14 12:18:44', '2024-12-14 12:18:44'),
(30, 7, 'images/products/gallery/1734149924_675d0724c0b2c.webp', 2, '2024-12-14 12:18:44', '2024-12-14 12:18:44'),
(31, 7, 'images/products/gallery/1734149924_675d0724c4ecb.webp', 2, '2024-12-14 12:18:44', '2024-12-14 12:18:44'),
(32, 7, 'images/products/gallery/1734149924_675d0724c9235.webp', 4, '2024-12-14 12:18:44', '2024-12-14 12:18:44'),
(33, 7, 'images/products/gallery/1734149924_675d0724cbd27.webp', 4, '2024-12-14 12:18:44', '2024-12-14 12:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `relational_categories`
--

CREATE TABLE `relational_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `metaable_id` bigint(20) UNSIGNED NOT NULL,
  `metaable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `relational_categories`
--

INSERT INTO `relational_categories` (`id`, `product_id`, `attribute_id`, `brand_id`, `category_id`, `metaable_id`, `metaable_type`, `created_at`, `updated_at`) VALUES
(12, NULL, 4, NULL, 21, 4, 'App\\Models\\Attribute', '2024-12-13 22:46:04', '2024-12-13 22:46:04'),
(13, NULL, 4, NULL, 22, 4, 'App\\Models\\Attribute', '2024-12-13 22:46:04', '2024-12-13 22:46:04'),
(14, NULL, 4, NULL, 23, 4, 'App\\Models\\Attribute', '2024-12-13 22:46:04', '2024-12-13 22:46:04'),
(15, NULL, 4, NULL, 29, 4, 'App\\Models\\Attribute', '2024-12-13 22:46:04', '2024-12-13 22:46:04'),
(16, NULL, 4, NULL, 24, 4, 'App\\Models\\Attribute', '2024-12-13 22:46:04', '2024-12-13 22:46:04'),
(17, NULL, 4, NULL, 25, 4, 'App\\Models\\Attribute', '2024-12-13 22:46:04', '2024-12-13 22:46:04'),
(18, NULL, 4, NULL, 26, 4, 'App\\Models\\Attribute', '2024-12-13 22:46:04', '2024-12-13 22:46:04'),
(19, NULL, 4, NULL, 30, 4, 'App\\Models\\Attribute', '2024-12-13 22:46:04', '2024-12-13 22:46:04'),
(20, NULL, 4, NULL, 31, 4, 'App\\Models\\Attribute', '2024-12-13 22:46:04', '2024-12-13 22:46:04'),
(21, NULL, 4, NULL, 27, 4, 'App\\Models\\Attribute', '2024-12-13 22:46:04', '2024-12-13 22:46:04'),
(22, NULL, 4, NULL, 28, 4, 'App\\Models\\Attribute', '2024-12-13 22:46:04', '2024-12-13 22:46:04'),
(23, NULL, 5, NULL, 21, 5, 'App\\Models\\Attribute', '2024-12-13 22:46:23', '2024-12-13 22:46:23'),
(24, NULL, 5, NULL, 22, 5, 'App\\Models\\Attribute', '2024-12-13 22:46:23', '2024-12-13 22:46:23'),
(25, NULL, 5, NULL, 23, 5, 'App\\Models\\Attribute', '2024-12-13 22:46:23', '2024-12-13 22:46:23'),
(26, NULL, 5, NULL, 29, 5, 'App\\Models\\Attribute', '2024-12-13 22:46:23', '2024-12-13 22:46:23'),
(27, NULL, 5, NULL, 24, 5, 'App\\Models\\Attribute', '2024-12-13 22:46:23', '2024-12-13 22:46:23'),
(28, NULL, 5, NULL, 25, 5, 'App\\Models\\Attribute', '2024-12-13 22:46:23', '2024-12-13 22:46:23'),
(29, NULL, 5, NULL, 26, 5, 'App\\Models\\Attribute', '2024-12-13 22:46:23', '2024-12-13 22:46:23'),
(30, NULL, 5, NULL, 27, 5, 'App\\Models\\Attribute', '2024-12-13 22:46:23', '2024-12-13 22:46:23'),
(31, NULL, 5, NULL, 28, 5, 'App\\Models\\Attribute', '2024-12-13 22:46:23', '2024-12-13 22:46:23'),
(32, NULL, 6, NULL, 21, 6, 'App\\Models\\Attribute', '2024-12-13 22:47:38', '2024-12-13 22:47:38'),
(33, NULL, 6, NULL, 22, 6, 'App\\Models\\Attribute', '2024-12-13 22:47:38', '2024-12-13 22:47:38'),
(34, NULL, 6, NULL, 23, 6, 'App\\Models\\Attribute', '2024-12-13 22:47:38', '2024-12-13 22:47:38'),
(35, NULL, 6, NULL, 29, 6, 'App\\Models\\Attribute', '2024-12-13 22:47:38', '2024-12-13 22:47:38'),
(36, NULL, 6, NULL, 24, 6, 'App\\Models\\Attribute', '2024-12-13 22:47:38', '2024-12-13 22:47:38'),
(37, NULL, 6, NULL, 25, 6, 'App\\Models\\Attribute', '2024-12-13 22:47:38', '2024-12-13 22:47:38'),
(38, NULL, 6, NULL, 26, 6, 'App\\Models\\Attribute', '2024-12-13 22:47:38', '2024-12-13 22:47:38'),
(39, NULL, 6, NULL, 30, 6, 'App\\Models\\Attribute', '2024-12-13 22:47:38', '2024-12-13 22:47:38'),
(40, NULL, 6, NULL, 31, 6, 'App\\Models\\Attribute', '2024-12-13 22:47:38', '2024-12-13 22:47:38'),
(41, NULL, 6, NULL, 27, 6, 'App\\Models\\Attribute', '2024-12-13 22:47:38', '2024-12-13 22:47:38'),
(42, NULL, 6, NULL, 28, 6, 'App\\Models\\Attribute', '2024-12-13 22:47:38', '2024-12-13 22:47:38'),
(43, 5, NULL, NULL, 21, 5, 'App\\Models\\Product', '2024-12-13 23:41:28', '2024-12-13 23:41:28'),
(44, 5, NULL, NULL, 23, 5, 'App\\Models\\Product', '2024-12-13 23:41:28', '2024-12-13 23:41:28'),
(45, 5, NULL, NULL, 24, 5, 'App\\Models\\Product', '2024-12-13 23:41:28', '2024-12-13 23:41:28'),
(46, 5, NULL, NULL, 27, 5, 'App\\Models\\Product', '2024-12-13 23:41:28', '2024-12-13 23:41:28'),
(47, 6, NULL, NULL, 21, 6, 'App\\Models\\Product', '2024-12-14 00:03:25', '2024-12-14 00:03:25'),
(48, 6, NULL, NULL, 23, 6, 'App\\Models\\Product', '2024-12-14 00:03:25', '2024-12-14 00:03:25'),
(49, 6, NULL, NULL, 24, 6, 'App\\Models\\Product', '2024-12-14 00:03:25', '2024-12-14 00:03:25'),
(50, 6, NULL, NULL, 28, 6, 'App\\Models\\Product', '2024-12-14 00:03:25', '2024-12-14 00:03:25'),
(82, 7, NULL, NULL, 22, 7, 'App\\Models\\Product', '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(83, 7, NULL, NULL, 29, 7, 'App\\Models\\Product', '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(84, 7, NULL, NULL, 30, 7, 'App\\Models\\Product', '2024-12-14 13:59:53', '2024-12-14 13:59:53'),
(90, NULL, NULL, 4, 21, 4, 'App\\Models\\Brand', '2024-12-14 15:29:19', '2024-12-14 15:29:19'),
(91, NULL, NULL, 4, 23, 4, 'App\\Models\\Brand', '2024-12-14 15:29:19', '2024-12-14 15:29:19'),
(92, NULL, NULL, 4, 24, 4, 'App\\Models\\Brand', '2024-12-14 15:29:19', '2024-12-14 15:29:19'),
(93, NULL, NULL, 4, 27, 4, 'App\\Models\\Brand', '2024-12-14 15:29:19', '2024-12-14 15:29:19'),
(94, NULL, NULL, 4, 28, 4, 'App\\Models\\Brand', '2024-12-14 15:29:19', '2024-12-14 15:29:19'),
(95, NULL, NULL, 3, 21, 3, 'App\\Models\\Brand', '2024-12-14 15:30:01', '2024-12-14 15:30:01'),
(96, NULL, NULL, 3, 23, 3, 'App\\Models\\Brand', '2024-12-14 15:30:01', '2024-12-14 15:30:01'),
(97, NULL, NULL, 3, 25, 3, 'App\\Models\\Brand', '2024-12-14 15:30:01', '2024-12-14 15:30:01'),
(98, NULL, NULL, 2, 21, 2, 'App\\Models\\Brand', '2024-12-14 15:30:40', '2024-12-14 15:30:40'),
(99, NULL, NULL, 2, 23, 2, 'App\\Models\\Brand', '2024-12-14 15:30:40', '2024-12-14 15:30:40'),
(100, NULL, NULL, 2, 26, 2, 'App\\Models\\Brand', '2024-12-14 15:30:40', '2024-12-14 15:30:40'),
(101, NULL, NULL, 5, 22, 5, 'App\\Models\\Brand', '2024-12-14 15:31:08', '2024-12-14 15:31:08'),
(102, NULL, NULL, 5, 29, 5, 'App\\Models\\Brand', '2024-12-14 15:31:08', '2024-12-14 15:31:08'),
(103, NULL, NULL, 5, 30, 5, 'App\\Models\\Brand', '2024-12-14 15:31:08', '2024-12-14 15:31:08'),
(104, NULL, NULL, 1, 21, 1, 'App\\Models\\Brand', '2024-12-14 15:31:38', '2024-12-14 15:31:38'),
(105, NULL, NULL, 1, 23, 1, 'App\\Models\\Brand', '2024-12-14 15:31:39', '2024-12-14 15:31:39'),
(106, NULL, NULL, 1, 24, 1, 'App\\Models\\Brand', '2024-12-14 15:31:39', '2024-12-14 15:31:39'),
(107, NULL, NULL, 1, 27, 1, 'App\\Models\\Brand', '2024-12-14 15:31:39', '2024-12-14 15:31:39'),
(108, NULL, NULL, 1, 28, 1, 'App\\Models\\Brand', '2024-12-14 15:31:39', '2024-12-14 15:31:39'),
(109, NULL, NULL, 1, 25, 1, 'App\\Models\\Brand', '2024-12-14 15:31:39', '2024-12-14 15:31:39'),
(110, NULL, NULL, 1, 26, 1, 'App\\Models\\Brand', '2024-12-14 15:31:39', '2024-12-14 15:31:39'),
(111, NULL, NULL, 1, 22, 1, 'App\\Models\\Brand', '2024-12-14 15:31:39', '2024-12-14 15:31:39'),
(112, NULL, NULL, 1, 29, 1, 'App\\Models\\Brand', '2024-12-14 15:31:39', '2024-12-14 15:31:39'),
(113, NULL, NULL, 1, 30, 1, 'App\\Models\\Brand', '2024-12-14 15:31:39', '2024-12-14 15:31:39'),
(114, NULL, NULL, 1, 31, 1, 'App\\Models\\Brand', '2024-12-14 15:31:39', '2024-12-14 15:31:39');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('NGebcFPTwwV0egVda6QuhjQiPknEgRQmmw9Ol7HS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMXJUa3F5M29VaEcxb2F0eHBBVWdycUFSUmo2R0w1QnlaRXBFMmJXTyI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Nob3AvY2F0ZXJzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1734189597);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta_tags`
--
ALTER TABLE `meta_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Indexes for table `pro_attribute_values`
--
ALTER TABLE `pro_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_attribute_values_product_id_foreign` (`product_id`),
  ADD KEY `pro_attribute_values_attribute_id_foreign` (`attribute_id`),
  ADD KEY `pro_attribute_values_attribute_value_id_foreign` (`attribute_value_id`);

--
-- Indexes for table `pro_images`
--
ALTER TABLE `pro_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_images_product_id_foreign` (`product_id`),
  ADD KEY `pro_images_color_id_foreign` (`color_id`);

--
-- Indexes for table `relational_categories`
--
ALTER TABLE `relational_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relational_categories_product_id_foreign` (`product_id`),
  ADD KEY `relational_categories_attribute_id_foreign` (`attribute_id`),
  ADD KEY `relational_categories_brand_id_foreign` (`brand_id`),
  ADD KEY `relational_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meta_tags`
--
ALTER TABLE `meta_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pro_attribute_values`
--
ALTER TABLE `pro_attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `pro_images`
--
ALTER TABLE `pro_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `relational_categories`
--
ALTER TABLE `relational_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pro_attribute_values`
--
ALTER TABLE `pro_attribute_values`
  ADD CONSTRAINT `pro_attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pro_attribute_values_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pro_attribute_values_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pro_images`
--
ALTER TABLE `pro_images`
  ADD CONSTRAINT `pro_images_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `attribute_values` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pro_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `relational_categories`
--
ALTER TABLE `relational_categories`
  ADD CONSTRAINT `relational_categories_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `relational_categories_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `relational_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `relational_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
