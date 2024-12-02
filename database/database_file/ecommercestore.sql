-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 06:42 AM
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
(1, 'Color', 'color', '1', '2024-11-23 23:52:44', '2024-11-23 23:52:44'),
(2, 'Size', 'size', '1', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(3, 'Material', 'material', '1', '2024-11-24 22:45:41', '2024-11-24 22:45:41');

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
(1, 'Black', 'black', '#ff0000', '1', 1, '2024-11-25 00:21:22', '2024-11-25 00:21:22'),
(2, 'Small', 'small', '#ff0000', '1', 2, '2024-11-25 00:21:48', '2024-11-25 00:21:48');

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
(1, 'Zara', 'zara', 'images/brands/1732376291_6741f6e34872f.png', 'Zara Brand', NULL, '1', '2024-11-23 23:38:12', '2024-11-23 23:38:12'),
(2, 'Mango', 'mango', 'images/brands/1732376334_6741f70e1cd74.png', 'Mango', NULL, '1', '2024-11-23 23:38:54', '2024-11-23 23:38:54'),
(3, 'Levi\'s', 'levis', 'images/brands/1732376381_6741f73d6d50a.png', 'Levis', NULL, '1', '2024-11-23 23:39:41', '2024-11-23 23:39:41'),
(4, 'Caters', 'caters', 'images/brands/1732376422_6741f76649926.png', 'Caters', NULL, '1', '2024-11-23 23:40:22', '2024-11-23 23:40:22'),
(5, 'Ralph Lauren', 'ralph-lauren', 'images/brands/1732376537_6741f7d983921.png', 'Ralph Lauren', NULL, '1', '2024-11-23 23:42:17', '2024-11-23 23:42:17');

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
(1, 'Men\'s Fashion', 'mens-fashion', '1732286871.jpg', 'Men\'s Fashion', NULL, '1', '1', '2024-11-22 22:47:51', '2024-11-22 22:47:51'),
(2, 'Women\'s Fashion', 'womens-fashion', '1732286955.jpg', 'Women\'s Fashion', NULL, '1', '1', '2024-11-22 22:49:15', '2024-11-22 22:49:15'),
(3, 'Kids Fashion', 'kids-fashion', '1732287082.jpg', 'Kids Fashion', NULL, '1', '1', '2024-11-22 22:51:22', '2024-11-22 22:51:22'),
(4, 'Shirts', 'shirts', '1732372548.jpg', 'Shirts', 1, '0', '1', '2024-11-22 22:55:16', '2024-11-23 22:35:48'),
(5, 'Trousers', 'trousers', '1732372629.jpg', 'Trousers', 1, '0', '1', '2024-11-22 22:56:48', '2024-11-23 22:37:09'),
(6, 'Jackets', 'jackets', '1732372767.jpg', 'Jackets', 1, '0', '1', '2024-11-22 22:57:47', '2024-11-23 22:39:27'),
(7, 'Casual Shirts', 'casual-shirts', '1732372996.jpg', 'Casual Shirts', 4, '0', '1', '2024-11-23 22:43:16', '2024-11-23 22:43:16'),
(8, 'Formal Shirts', 'formal-shirts', '1732373078.jpg', 'Formal Shirts', 4, '0', '1', '2024-11-23 22:44:38', '2024-11-23 22:44:38'),
(9, 'Dresses', 'dresses', '1732373237.jpg', 'Dresses', 2, '0', '1', '2024-11-23 22:47:17', '2024-11-23 22:47:17'),
(10, 'Tops', 'tops', '1732373323.jpg', 'Tops', 2, '0', '1', '2024-11-23 22:48:43', '2024-11-23 22:48:43'),
(11, 'Party Dresses', 'party-dresses', '1732373878.jpg', 'Party Dresses', 9, '0', '1', '2024-11-23 22:57:58', '2024-11-23 22:57:58'),
(12, 'Casual Dress', 'casual-dress', '1732373930.jpg', 'Casual Dress', 9, '0', '1', '2024-11-23 22:58:50', '2024-11-23 22:58:50'),
(13, 'Boys’ Clothing', 'boys-clothing', '1732374249.jpg', 'Boys’ Clothing', 3, '0', '1', '2024-11-23 23:04:09', '2024-11-23 23:04:09'),
(14, 'Girls’ Clothing', 'girls-clothing', '1732374339.jpg', 'Girls’ Clothing', 3, '0', '1', '2024-11-23 23:05:39', '2024-11-23 23:05:39'),
(15, 'Kids Accessories', 'kids-accessories', '1732374417.jpg', 'Accessories', 3, '0', '1', '2024-11-23 23:06:57', '2024-11-23 23:06:57'),
(16, 'Full Sleeve', 'full-sleeve', '1732375736.jpg', 'Full Sleeve', 8, '0', '1', '2024-11-23 23:28:56', '2024-11-23 23:28:56'),
(17, 'Half Sleeve', 'half-sleeve', '1732375793.jpg', 'Half Sleeve', 8, '0', '1', '2024-11-23 23:29:53', '2024-11-23 23:29:53'),
(18, 'T Shirts', 't-shirts', '1732681613.webp', 'T Shirts', 7, '0', '1', '2024-11-26 23:26:53', '2024-11-26 23:26:53');

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
(4, 'Shirts', 'Shirts', 'Shirts', 4, 'App\\Models\\Category', '2024-11-22 22:55:16', '2024-11-23 22:35:48'),
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
(19, 'Meta Title', 'keyrods', 'meta description', 1, 'App\\Models\\Product', '2024-11-26 23:55:03', '2024-11-26 23:56:41');

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
(13, '2024_11_15_053537_create_relational_categories_table', 1),
(14, '2024_11_22_105602_add_brand_column_into_products_table', 1);

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
(1, 3, 'Elegant T Shirt For Boys', 'elegant-t-shirt-for-boys', '001', 'active', 1200, 1500, 1000, 'bc001', 12, 't shirt, boys t shirt, casual shirt, men shirt', 'new', 1, 'short description', '<p><b>Long description</b></p>', 'images/products/1732683303_6746a62751011.jpg', 'images/products/1732683303_6746a62754e18.jpg', NULL, '2024-11-26 23:55:03', '2024-11-26 23:55:03', NULL);

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
(3, 1, 1, 1, 1, 6, 1200.00, '2024-11-26 23:56:41', '2024-11-26 23:56:41'),
(4, 1, 2, 2, 1, 6, 1200.00, '2024-11-26 23:56:41', '2024-11-26 23:56:41');

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
(1, 1, 'images/products/gallery/1732683303_6746a6275a227.jpg', NULL, '2024-11-26 23:55:03', '2024-11-26 23:55:03'),
(2, 1, 'images/products/gallery/1732683303_6746a6275bcf9.jpg', NULL, '2024-11-26 23:55:03', '2024-11-26 23:55:03'),
(3, 1, 'images/products/gallery/1732683303_6746a6275cfa2.jpg', NULL, '2024-11-26 23:55:03', '2024-11-26 23:55:03'),
(4, 1, 'images/products/gallery/1732683303_6746a6276274c.jpg', NULL, '2024-11-26 23:55:03', '2024-11-26 23:55:03');

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
(1, NULL, NULL, 1, 2, 1, 'App\\Models\\Brand', '2024-11-23 23:38:12', '2024-11-23 23:38:12'),
(2, NULL, NULL, 1, 9, 1, 'App\\Models\\Brand', '2024-11-23 23:38:12', '2024-11-23 23:38:12'),
(3, NULL, NULL, 1, 10, 1, 'App\\Models\\Brand', '2024-11-23 23:38:12', '2024-11-23 23:38:12'),
(4, NULL, NULL, 1, 12, 1, 'App\\Models\\Brand', '2024-11-23 23:38:12', '2024-11-23 23:38:12'),
(13, NULL, NULL, 4, 3, 4, 'App\\Models\\Brand', '2024-11-23 23:40:22', '2024-11-23 23:40:22'),
(14, NULL, NULL, 4, 13, 4, 'App\\Models\\Brand', '2024-11-23 23:40:22', '2024-11-23 23:40:22'),
(15, NULL, NULL, 4, 14, 4, 'App\\Models\\Brand', '2024-11-23 23:40:22', '2024-11-23 23:40:22'),
(16, NULL, NULL, 4, 15, 4, 'App\\Models\\Brand', '2024-11-23 23:40:22', '2024-11-23 23:40:22'),
(46, NULL, NULL, 5, 4, 5, 'App\\Models\\Brand', '2024-11-24 00:19:49', '2024-11-24 00:19:49'),
(47, NULL, NULL, 5, 7, 5, 'App\\Models\\Brand', '2024-11-24 00:19:49', '2024-11-24 00:19:49'),
(48, NULL, NULL, 5, 8, 5, 'App\\Models\\Brand', '2024-11-24 00:19:49', '2024-11-24 00:19:49'),
(49, NULL, NULL, 5, 16, 5, 'App\\Models\\Brand', '2024-11-24 00:19:49', '2024-11-24 00:19:49'),
(50, NULL, NULL, 3, 1, 3, 'App\\Models\\Brand', '2024-11-24 22:23:58', '2024-11-24 22:23:58'),
(51, NULL, NULL, 3, 4, 3, 'App\\Models\\Brand', '2024-11-24 22:23:58', '2024-11-24 22:23:58'),
(52, NULL, NULL, 3, 7, 3, 'App\\Models\\Brand', '2024-11-24 22:23:58', '2024-11-24 22:23:58'),
(53, NULL, NULL, 3, 8, 3, 'App\\Models\\Brand', '2024-11-24 22:23:58', '2024-11-24 22:23:58'),
(54, NULL, NULL, 3, 16, 3, 'App\\Models\\Brand', '2024-11-24 22:23:58', '2024-11-24 22:23:58'),
(55, NULL, NULL, 3, 17, 3, 'App\\Models\\Brand', '2024-11-24 22:23:58', '2024-11-24 22:23:58'),
(56, NULL, NULL, 3, 5, 3, 'App\\Models\\Brand', '2024-11-24 22:23:58', '2024-11-24 22:23:58'),
(57, NULL, NULL, 3, 6, 3, 'App\\Models\\Brand', '2024-11-24 22:23:58', '2024-11-24 22:23:58'),
(58, NULL, NULL, 2, 2, 2, 'App\\Models\\Brand', '2024-11-24 22:24:32', '2024-11-24 22:24:32'),
(59, NULL, NULL, 2, 9, 2, 'App\\Models\\Brand', '2024-11-24 22:24:32', '2024-11-24 22:24:32'),
(60, NULL, NULL, 2, 12, 2, 'App\\Models\\Brand', '2024-11-24 22:24:32', '2024-11-24 22:24:32'),
(61, NULL, NULL, 2, 10, 2, 'App\\Models\\Brand', '2024-11-24 22:24:32', '2024-11-24 22:24:32'),
(62, NULL, 1, NULL, 1, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(63, NULL, 1, NULL, 4, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(64, NULL, 1, NULL, 7, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(65, NULL, 1, NULL, 8, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(66, NULL, 1, NULL, 16, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(67, NULL, 1, NULL, 17, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(68, NULL, 1, NULL, 5, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(69, NULL, 1, NULL, 6, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(70, NULL, 1, NULL, 2, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(71, NULL, 1, NULL, 9, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(72, NULL, 1, NULL, 11, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(73, NULL, 1, NULL, 12, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(74, NULL, 1, NULL, 10, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(75, NULL, 1, NULL, 3, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(76, NULL, 1, NULL, 13, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(77, NULL, 1, NULL, 14, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(78, NULL, 1, NULL, 15, 1, 'App\\Models\\Attribute', '2024-11-24 22:26:07', '2024-11-24 22:26:07'),
(79, NULL, 2, NULL, 3, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(80, NULL, 2, NULL, 1, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(81, NULL, 2, NULL, 2, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(82, NULL, 2, NULL, 13, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(83, NULL, 2, NULL, 14, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(84, NULL, 2, NULL, 15, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(85, NULL, 2, NULL, 4, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(86, NULL, 2, NULL, 5, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(87, NULL, 2, NULL, 6, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(88, NULL, 2, NULL, 9, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(89, NULL, 2, NULL, 10, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(90, NULL, 2, NULL, 7, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(91, NULL, 2, NULL, 8, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(92, NULL, 2, NULL, 11, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(93, NULL, 2, NULL, 12, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(94, NULL, 2, NULL, 16, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(95, NULL, 2, NULL, 17, 2, 'App\\Models\\Attribute', '2024-11-24 22:26:41', '2024-11-24 22:26:41'),
(96, NULL, 3, NULL, 6, 3, 'App\\Models\\Attribute', '2024-11-24 22:45:41', '2024-11-24 22:45:41'),
(101, 1, NULL, NULL, 1, 1, 'App\\Models\\Product', '2024-11-26 23:56:41', '2024-11-26 23:56:41'),
(102, 1, NULL, NULL, 4, 1, 'App\\Models\\Product', '2024-11-26 23:56:41', '2024-11-26 23:56:41'),
(103, 1, NULL, NULL, 7, 1, 'App\\Models\\Product', '2024-11-26 23:56:41', '2024-11-26 23:56:41'),
(104, 1, NULL, NULL, 18, 1, 'App\\Models\\Product', '2024-11-26 23:56:41', '2024-11-26 23:56:41');

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
('OIXUfrQlSKP5R9jTR0iPtrV6hcU50xarOa2Ob2Xb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic0VrU3VYcEg5ZFJVYVBDZWdydXkwNm81Uk5MaW1KN0N4OExqeXV2TiI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jYXRlZ29yeSI7fX0=', 1732684247);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pro_attribute_values`
--
ALTER TABLE `pro_attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pro_images`
--
ALTER TABLE `pro_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `relational_categories`
--
ALTER TABLE `relational_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

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
  ADD CONSTRAINT `relational_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `relational_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
