-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2026 at 06:24 PM
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
(2, 'Ahmad', 'Raza', 'superadmin', 'superadmin@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$12$j4sFka/25CD1jiWM4GnTdO9tY4xV5uIePFfi48Scvd0L71.70Zvru', 1, '2026-04-17 05:16:47', '2026-04-17 05:16:47');

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
(1, 'Size', 'size', '1', '2026-04-17 09:39:06', '2026-04-17 09:39:06'),
(2, 'Sleeves', 'sleeves', '1', '2026-04-17 11:08:24', '2026-04-17 11:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `name`, `slug`, `status`, `attribute_id`, `created_at`, `updated_at`) VALUES
(1, 'S', 's', '1', 1, '2026-04-17 09:39:39', '2026-04-17 09:42:04'),
(2, 'M', 'm', '1', 1, '2026-04-17 09:39:51', '2026-04-17 09:41:54'),
(3, 'L', 'l', '1', 1, '2026-04-17 09:40:01', '2026-04-17 09:42:18'),
(4, 'XL', 'xl', '1', 1, '2026-04-17 09:41:15', '2026-04-17 09:41:43'),
(5, 'Full', 'full', '1', 2, '2026-04-17 11:14:20', '2026-04-17 11:14:20'),
(6, 'Short', 'short', '1', 2, '2026-04-17 11:14:32', '2026-04-17 11:14:32');

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
(1, 'Levis', 'levis', 'images/brands/1776429992_69e22ba886397.png', 'levis', NULL, '1', '2026-04-17 07:46:32', '2026-04-17 07:46:32'),
(2, 'Zara', 'zara', 'images/brands/1776430026_69e22bca74cb2.jpg', 'Gents Uppers', NULL, '1', '2026-04-17 07:46:53', '2026-04-17 07:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:5:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"d\";s:10:\"group_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:56:{i:0;a:5:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"view_admins\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"admins\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:5:{s:1:\"a\";i:2;s:1:\"b\";s:13:\"create_admins\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"admins\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:5:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"edit_admins\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"admins\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:5:{s:1:\"a\";i:4;s:1:\"b\";s:13:\"delete_admins\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"admins\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:5:{s:1:\"a\";i:5;s:1:\"b\";s:10:\"view_roles\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:5:\"roles\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:5:{s:1:\"a\";i:6;s:1:\"b\";s:12:\"create_roles\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:5:\"roles\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:5:{s:1:\"a\";i:7;s:1:\"b\";s:10:\"edit_roles\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:5:\"roles\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:5:{s:1:\"a\";i:8;s:1:\"b\";s:12:\"delete_roles\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:5:\"roles\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:5:{s:1:\"a\";i:9;s:1:\"b\";s:16:\"view_permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:11:\"permissions\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:5:{s:1:\"a\";i:10;s:1:\"b\";s:18:\"create_permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:11:\"permissions\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:5:{s:1:\"a\";i:11;s:1:\"b\";s:16:\"edit_permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:11:\"permissions\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:5:{s:1:\"a\";i:12;s:1:\"b\";s:18:\"delete_permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:11:\"permissions\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:5:{s:1:\"a\";i:13;s:1:\"b\";s:22:\"view_roles_permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:17:\"roles_permissions\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:5:{s:1:\"a\";i:14;s:1:\"b\";s:24:\"create_roles_permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:17:\"roles_permissions\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:5:{s:1:\"a\";i:15;s:1:\"b\";s:22:\"edit_roles_permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:17:\"roles_permissions\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:5:{s:1:\"a\";i:16;s:1:\"b\";s:24:\"delete_roles_permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:17:\"roles_permissions\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:5:{s:1:\"a\";i:17;s:1:\"b\";s:15:\"view_categories\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:10:\"categories\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:17;a:5:{s:1:\"a\";i:18;s:1:\"b\";s:17:\"create_categories\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:10:\"categories\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:5:{s:1:\"a\";i:19;s:1:\"b\";s:15:\"edit_categories\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:10:\"categories\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:5:{s:1:\"a\";i:20;s:1:\"b\";s:17:\"delete_categories\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:10:\"categories\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:20;a:5:{s:1:\"a\";i:21;s:1:\"b\";s:11:\"view_brands\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"brands\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:21;a:5:{s:1:\"a\";i:22;s:1:\"b\";s:13:\"create_brands\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"brands\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:5:{s:1:\"a\";i:23;s:1:\"b\";s:11:\"edit_brands\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"brands\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:23;a:5:{s:1:\"a\";i:24;s:1:\"b\";s:13:\"delete_brands\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"brands\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:24;a:5:{s:1:\"a\";i:25;s:1:\"b\";s:13:\"view_products\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"products\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:25;a:5:{s:1:\"a\";i:26;s:1:\"b\";s:15:\"create_products\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"products\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:26;a:5:{s:1:\"a\";i:27;s:1:\"b\";s:13:\"edit_products\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"products\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:27;a:5:{s:1:\"a\";i:28;s:1:\"b\";s:15:\"delete_products\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"products\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:28;a:5:{s:1:\"a\";i:29;s:1:\"b\";s:11:\"view_colors\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"colors\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:29;a:5:{s:1:\"a\";i:30;s:1:\"b\";s:13:\"create_colors\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"colors\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:5:{s:1:\"a\";i:31;s:1:\"b\";s:11:\"edit_colors\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"colors\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:31;a:5:{s:1:\"a\";i:32;s:1:\"b\";s:13:\"delete_colors\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"colors\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:32;a:5:{s:1:\"a\";i:33;s:1:\"b\";s:13:\"view_varients\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"varients\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:33;a:5:{s:1:\"a\";i:34;s:1:\"b\";s:15:\"create_varients\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"varients\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:34;a:5:{s:1:\"a\";i:35;s:1:\"b\";s:13:\"edit_varients\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"varients\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:35;a:5:{s:1:\"a\";i:36;s:1:\"b\";s:15:\"delete_varients\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"varients\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:36;a:5:{s:1:\"a\";i:37;s:1:\"b\";s:11:\"view_orders\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"orders\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:37;a:5:{s:1:\"a\";i:38;s:1:\"b\";s:13:\"create_orders\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"orders\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:38;a:5:{s:1:\"a\";i:39;s:1:\"b\";s:11:\"edit_orders\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"orders\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:39;a:5:{s:1:\"a\";i:40;s:1:\"b\";s:13:\"delete_orders\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"orders\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:40;a:5:{s:1:\"a\";i:41;s:1:\"b\";s:14:\"view_customers\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:9:\"customers\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:41;a:5:{s:1:\"a\";i:42;s:1:\"b\";s:16:\"create_customers\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:9:\"customers\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:42;a:5:{s:1:\"a\";i:43;s:1:\"b\";s:14:\"edit_customers\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:9:\"customers\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:43;a:5:{s:1:\"a\";i:44;s:1:\"b\";s:16:\"delete_customers\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:9:\"customers\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:44;a:5:{s:1:\"a\";i:45;s:1:\"b\";s:12:\"view_reports\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:7:\"reports\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:45;a:5:{s:1:\"a\";i:46;s:1:\"b\";s:14:\"create_reports\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:7:\"reports\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:46;a:5:{s:1:\"a\";i:47;s:1:\"b\";s:12:\"edit_reports\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:7:\"reports\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:47;a:5:{s:1:\"a\";i:48;s:1:\"b\";s:14:\"delete_reports\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:7:\"reports\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:48;a:5:{s:1:\"a\";i:49;s:1:\"b\";s:12:\"view_coupons\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:7:\"coupons\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:49;a:5:{s:1:\"a\";i:50;s:1:\"b\";s:14:\"create_coupons\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:7:\"coupons\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:50;a:5:{s:1:\"a\";i:51;s:1:\"b\";s:12:\"edit_coupons\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:7:\"coupons\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:51;a:5:{s:1:\"a\";i:52;s:1:\"b\";s:14:\"delete_coupons\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:7:\"coupons\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:52;a:5:{s:1:\"a\";i:53;s:1:\"b\";s:13:\"view_settings\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"settings\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:53;a:5:{s:1:\"a\";i:54;s:1:\"b\";s:15:\"create_settings\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"settings\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:54;a:5:{s:1:\"a\";i:55;s:1:\"b\";s:13:\"edit_settings\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"settings\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:55;a:5:{s:1:\"a\";i:56;s:1:\"b\";s:15:\"delete_settings\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"settings\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:10:\"superadmin\";s:1:\"c\";s:5:\"admin\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:5:\"admin\";}}}', 1776506117);

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_value_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `line_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `description`, `parent_id`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gents Shirts', 'gents-shirts', 'images/categories/skHAjKjkM6kd8Rhs6OqZPCrAtdeuA0nzuUmSagyP.png', 'Gents shirts', NULL, 1, 1, '2026-04-17 07:36:30', '2026-04-17 07:36:30'),
(2, 'Sleeves Shirts', 'sleeves-shirts', 'images/categories/AOW0ctdqKQ9lq68j3fMGRaDIXW1ZfQjhXNlkgFOB.png', 'Full Sleeves Shirts', 1, 0, 1, '2026-04-17 07:39:23', '2026-04-17 11:21:31'),
(3, 'T Shirts', 't-shirts', 'images/categories/Mb9UPJeknx3muiwh0je1Ya2jsTuCXvzICuIllKT8.png', 'Short Sleeves Shirts', 1, 0, 1, '2026-04-17 07:40:16', '2026-04-17 11:21:43'),
(4, 'Gents Uppers', 'gents-uppers', 'images/categories/aM9udYTeJ6iDZ5rYZXcgLNNyiC4m7iIeA08VPhfU.png', 'Gents Jackets', NULL, 1, 1, '2026-04-17 07:41:43', '2026-04-17 10:26:51'),
(5, 'Cap Hoodies', 'cap-hoodies', 'images/categories/wNEhirfE2RYyU99mnfAUOzgfLEzwMJDtprBWuKGj.png', 'Cap Hoodies', 4, 0, 1, '2026-04-17 07:42:19', '2026-04-17 11:22:30'),
(6, 'Gents Jackets', 'gents-jackets', 'images/categories/TFqgqCdcpyRYncBhkheh0z49Q5FmLvjW6ZhueoX9.png', 'Jents Jackets', 4, 1, 1, '2026-04-17 07:43:16', '2026-04-17 10:03:52'),
(7, 'Gents Pajamas', 'gents-pajamas', 'images/categories/nRcyDSXdgUC8ZxqgWaVm1wIJSlMHw0dn2u909Xtq.png', 'Gents pajamasw', NULL, 1, 1, '2026-04-17 09:45:44', '2026-04-17 10:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `color_code` varchar(255) DEFAULT NULL,
  `swatch_image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `slug`, `color_code`, `swatch_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Red', 'red', '#ff0000', NULL, 1, '2026-04-17 09:35:44', '2026-04-17 09:35:44'),
(2, 'Blue', 'blue', '#1100ff', NULL, 1, '2026-04-17 09:35:59', '2026-04-17 09:35:59'),
(3, 'Black', 'black', '#000000', NULL, 1, '2026-04-17 09:36:08', '2026-04-17 09:36:08'),
(4, 'White', 'white', '#ffffff', NULL, 1, '2026-04-17 09:36:20', '2026-04-17 09:36:20'),
(5, 'Orange', 'orange', '#ff8d0a', NULL, 1, '2026-04-17 09:38:21', '2026-04-17 09:38:21'),
(6, 'Yellow', 'yellow', '#ffea00', NULL, 1, '2026-04-17 09:38:40', '2026-04-17 09:38:40'),
(7, 'Grey', 'grey', '#afa7a7', NULL, 1, '2026-04-17 10:18:38', '2026-04-17 10:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `discount_type` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `starting_from` datetime DEFAULT NULL,
  `ending_at` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, NULL, NULL, NULL, 1, 'App\\Models\\Category', '2026-04-17 07:36:31', '2026-04-17 07:36:31'),
(2, NULL, NULL, NULL, 2, 'App\\Models\\Category', '2026-04-17 07:39:23', '2026-04-17 07:39:23'),
(3, NULL, NULL, NULL, 3, 'App\\Models\\Category', '2026-04-17 07:40:16', '2026-04-17 07:40:16'),
(4, NULL, NULL, NULL, 4, 'App\\Models\\Category', '2026-04-17 07:41:43', '2026-04-17 07:41:43'),
(5, NULL, NULL, NULL, 5, 'App\\Models\\Category', '2026-04-17 07:42:19', '2026-04-17 07:42:19'),
(6, NULL, NULL, NULL, 6, 'App\\Models\\Category', '2026-04-17 07:43:16', '2026-04-17 07:43:16'),
(7, NULL, NULL, NULL, 1, 'App\\Models\\Product', '2026-04-17 09:44:04', '2026-04-17 09:44:04'),
(8, NULL, NULL, NULL, 7, 'App\\Models\\Category', '2026-04-17 09:45:44', '2026-04-17 09:45:44'),
(9, NULL, NULL, NULL, 2, 'App\\Models\\Product', '2026-04-17 10:16:51', '2026-04-17 10:16:51'),
(10, NULL, NULL, NULL, 3, 'App\\Models\\Product', '2026-04-17 10:43:33', '2026-04-17 10:43:33'),
(11, NULL, NULL, NULL, 4, 'App\\Models\\Product', '2026-04-17 11:11:26', '2026-04-17 11:11:26');

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
(11, '2024_11_04_022003_create_colors_table', 1),
(12, '2024_11_05_045824_create_pro_attribute_values_table', 1),
(13, '2024_11_15_053537_create_relational_categories_table', 1),
(14, '2024_11_22_105602_add_brand_column_into_products_table', 1),
(15, '2024_11_29_155158_create_personal_access_tokens_table', 1),
(16, '2025_11_01_152056_add_attribute_id_to_products_table', 1),
(17, '2025_11_14_042939_add_product_type_to_products_table', 1),
(18, '2025_12_05_155112_create_product_images_table', 1),
(19, '2025_12_14_060852_create_carts_table', 1),
(20, '2025_12_14_061022_create_cart_items_table', 1),
(21, '2025_12_26_130822_create_coupons_table', 1),
(22, '2026_01_02_142929_create_orders_table', 1),
(23, '2026_01_02_143144_create_order_items_table', 1),
(24, '2026_01_25_045631_create_permission_tables', 1),
(25, '2026_03_23_051343_add_comment_and_order_type_to_orders_table', 1),
(26, '2026_03_28_162309_create_reviews_table', 1),
(27, '2026_04_09_132045_create_user_contacts_table', 2),
(28, '2026_04_12_154144_create_notifications_table', 3),
(29, '2026_04_13_160729_create_newsletters_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `name`, `created_at`, `updated_at`) VALUES
(1, 'engr.ahmadraza348@gmail.comsds', NULL, '2026-04-17 01:46:45', '2026-04-17 01:46:45'),
(2, 'engr.ahsdsdmadraza348@gmail.com', NULL, '2026-04-17 01:49:09', '2026-04-17 01:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `order_type` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `billing_first_name` varchar(255) NOT NULL,
  `billing_last_name` varchar(255) NOT NULL,
  `billing_email` varchar(255) NOT NULL,
  `billing_company` varchar(255) DEFAULT NULL,
  `billing_country` varchar(255) NOT NULL,
  `billing_address_1` varchar(255) NOT NULL,
  `billing_address_2` varchar(255) DEFAULT NULL,
  `billing_city` varchar(255) NOT NULL,
  `billing_state` varchar(255) DEFAULT NULL,
  `billing_postcode` varchar(255) NOT NULL,
  `billing_phone` varchar(255) DEFAULT NULL,
  `different_shipping` tinyint(1) NOT NULL DEFAULT 0,
  `shipping_first_name` varchar(255) DEFAULT NULL,
  `shipping_last_name` varchar(255) DEFAULT NULL,
  `shipping_email` varchar(255) DEFAULT NULL,
  `shipping_company` varchar(255) DEFAULT NULL,
  `shipping_country` varchar(255) DEFAULT NULL,
  `shipping_address_1` varchar(255) DEFAULT NULL,
  `shipping_address_2` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_state` varchar(255) DEFAULT NULL,
  `shipping_postcode` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL,
  `order_note` text DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `order_status` varchar(255) NOT NULL DEFAULT 'pending',
  `order_comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `line_total` decimal(10,2) NOT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `color_name` varchar(255) DEFAULT NULL,
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_name` varchar(255) DEFAULT NULL,
  `attribute_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'view_admins', 'admin', 'admins', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(2, 'create_admins', 'admin', 'admins', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(3, 'edit_admins', 'admin', 'admins', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(4, 'delete_admins', 'admin', 'admins', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(5, 'view_roles', 'admin', 'roles', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(6, 'create_roles', 'admin', 'roles', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(7, 'edit_roles', 'admin', 'roles', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(8, 'delete_roles', 'admin', 'roles', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(9, 'view_permissions', 'admin', 'permissions', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(10, 'create_permissions', 'admin', 'permissions', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(11, 'edit_permissions', 'admin', 'permissions', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(12, 'delete_permissions', 'admin', 'permissions', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(13, 'view_roles_permissions', 'admin', 'roles_permissions', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(14, 'create_roles_permissions', 'admin', 'roles_permissions', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(15, 'edit_roles_permissions', 'admin', 'roles_permissions', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(16, 'delete_roles_permissions', 'admin', 'roles_permissions', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(17, 'view_categories', 'admin', 'categories', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(18, 'create_categories', 'admin', 'categories', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(19, 'edit_categories', 'admin', 'categories', '2026-04-17 04:53:29', '2026-04-17 04:53:29'),
(20, 'delete_categories', 'admin', 'categories', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(21, 'view_brands', 'admin', 'brands', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(22, 'create_brands', 'admin', 'brands', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(23, 'edit_brands', 'admin', 'brands', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(24, 'delete_brands', 'admin', 'brands', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(25, 'view_products', 'admin', 'products', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(26, 'create_products', 'admin', 'products', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(27, 'edit_products', 'admin', 'products', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(28, 'delete_products', 'admin', 'products', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(29, 'view_colors', 'admin', 'colors', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(30, 'create_colors', 'admin', 'colors', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(31, 'edit_colors', 'admin', 'colors', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(32, 'delete_colors', 'admin', 'colors', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(33, 'view_varients', 'admin', 'varients', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(34, 'create_varients', 'admin', 'varients', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(35, 'edit_varients', 'admin', 'varients', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(36, 'delete_varients', 'admin', 'varients', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(37, 'view_orders', 'admin', 'orders', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(38, 'create_orders', 'admin', 'orders', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(39, 'edit_orders', 'admin', 'orders', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(40, 'delete_orders', 'admin', 'orders', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(41, 'view_customers', 'admin', 'customers', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(42, 'create_customers', 'admin', 'customers', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(43, 'edit_customers', 'admin', 'customers', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(44, 'delete_customers', 'admin', 'customers', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(45, 'view_reports', 'admin', 'reports', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(46, 'create_reports', 'admin', 'reports', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(47, 'edit_reports', 'admin', 'reports', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(48, 'delete_reports', 'admin', 'reports', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(49, 'view_coupons', 'admin', 'coupons', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(50, 'create_coupons', 'admin', 'coupons', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(51, 'edit_coupons', 'admin', 'coupons', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(52, 'delete_coupons', 'admin', 'coupons', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(53, 'view_settings', 'admin', 'settings', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(54, 'create_settings', 'admin', 'settings', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(55, 'edit_settings', 'admin', 'settings', '2026-04-17 04:53:30', '2026-04-17 04:53:30'),
(56, 'delete_settings', 'admin', 'settings', '2026-04-17 04:53:30', '2026-04-17 04:53:30');

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
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `product_variation_type` varchar(255) NOT NULL DEFAULT 'simple',
  `sku` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `product_type` enum('simple','color','color_variant') NOT NULL DEFAULT 'simple',
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
  `video` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `attribute_id`, `name`, `slug`, `product_variation_type`, `sku`, `status`, `product_type`, `sale_price`, `previous_price`, `purchase_price`, `barcode`, `stock`, `tags`, `label`, `is_featured`, `short_description`, `long_description`, `video`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 'Blue color Gents Pajama', 'blue-color-gents-pajama', 'simple', '12', 1, 'simple', 500, 549, 450, '2323', 50, 'blue color, gents pajama, pajama', 'new', 1, 'Short', '<p><b>Lonng</b></p>', NULL, '2026-04-17 09:44:03', '2026-04-17 10:11:24', NULL),
(2, 2, NULL, 'Gents Branded Cap Hoodies', 'gents-branded-cap-hoodies', 'color_varient', '6455', 1, 'simple', 1000, 1500, 800, 'ddsasd', 100, 'cap Hoodies, branded hoodies, gents hoodies', 'hot', 1, 'Gents branded oodies', '<p><b>Gents branded oodies</b></p>', NULL, '2026-04-17 10:16:51', '2026-04-17 10:16:51', NULL),
(3, 1, 1, 'Mens Winter Jacket', 'mens-winter-jacket', 'color_attribute_varient', '565', 1, 'simple', 2000, 2500, 1500, '345554', 20, 'cap jacket, branded jacket, gents jacket, summer jacket', 'sale', 1, 'short', '<p>long</p><p><br></p>', NULL, '2026-04-17 10:43:33', '2026-04-17 10:44:23', NULL),
(4, 1, 2, 'Fancy Shirt for Men', 'fancy-shirt-for-men', 'color_attribute_varient', '656', 1, 'simple', 1400, 1500, 1200, 'hfhrgs', 30, 'gents short, sleeveless shirt, full sleeves shirt,', 'hot', 1, 'short', '<p>lonfg</p>', NULL, '2026-04-17 11:11:26', '2026-04-17 11:11:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_back` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `color_id`, `image`, `is_featured`, `is_back`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'product-images/KwmOtM50N6TeLQItiE7fQr1zFhSFEwOZJliM4syp.png', 1, 1, 1, '2026-04-17 09:46:40', '2026-04-17 10:10:27'),
(4, 2, 4, 'product-images/0gERy9vLxVO954jQmK6ISqt75BhApvPiDXyzCUKg.png', 0, 0, 1, '2026-04-17 10:17:23', '2026-04-17 10:19:17'),
(6, 2, 2, 'product-images/57mOAlOEISa6fhUzyQAuSo5lKQx3QFlMje05Q9x4.png', 1, 0, 3, '2026-04-17 10:17:23', '2026-04-17 10:19:17'),
(8, 2, 7, 'product-images/UfGPEOZus7CemZlm1hgwgwxuex8bbRelEicbahl4.png', 0, 1, 5, '2026-04-17 10:17:23', '2026-04-17 10:19:17'),
(9, 2, 3, 'product-images/p5nEliBGqfJAGJy4Ar6TkZpDHMZWU1tSOwx3NTvM.png', 0, 0, 6, '2026-04-17 10:17:23', '2026-04-17 10:19:17'),
(10, 3, 3, 'product-images/12qPwQkgLJhDevl0WpFOMiVuRGxENiOsqfE81hBj.png', 1, 0, 1, '2026-04-17 10:44:49', '2026-04-17 10:46:08'),
(11, 3, 2, 'product-images/UrLDzu6llGPNmgU732F3B52vde4B5xmE7CJE8zFi.png', 0, 1, 2, '2026-04-17 10:44:49', '2026-04-17 10:46:08'),
(12, 3, 6, 'product-images/P9gOVHsNbyn1lc2Oc0znrE2k0SQbLWzfhFZEYDDf.png', 0, 0, 3, '2026-04-17 10:44:49', '2026-04-17 10:46:08'),
(13, 3, 7, 'product-images/CnJ2OCy6uEE9ZvQf5zAjUmKQNqyEdYbShE9pAO1n.png', 0, 0, 4, '2026-04-17 10:44:49', '2026-04-17 10:46:08'),
(34, 4, 4, 'product-images/4vDGFp2myrrWhemrMBIByl72IqoMnhe2cyzHLmr5.png', 1, 0, 1, '2026-04-17 11:11:59', '2026-04-17 11:13:39'),
(35, 4, 2, 'product-images/yshnC8Mq1Ch4QncVLglJuK6UXgj059Rdedsu4n02.png', 0, 1, 2, '2026-04-17 11:11:59', '2026-04-17 11:13:39'),
(36, 4, 7, 'product-images/jyXoUxgcWaPZChzqby6QbQV7vxjb6PJJafKq4JEo.png', 0, 0, 3, '2026-04-17 11:11:59', '2026-04-17 11:13:39'),
(37, 4, 4, 'product-images/ZIJO7yvVvpBzocayTO03D6wvsI4RyQoXRa4l6Py9.png', 0, 0, 4, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(38, 4, 2, 'product-images/WiqDSU5Q0RXFdHFzeNJDkIdkmLW3WEFREeFAoygv.png', 0, 0, 5, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(39, 4, 2, 'product-images/ymh96tTjIG1fCmjF5qRvwGUJ3FGVyOiL1bXGGP9O.png', 0, 0, 6, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(40, 4, 2, 'product-images/nC746sKFsfpC51FovJxdu60YJEmcWe3mrKrFxqxF.png', 0, 0, 7, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(41, 4, 2, 'product-images/SyAByWxSA453WJDtUvIrgDM3H5QnMuo4awXZ7n5y.png', 0, 0, 8, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(42, 4, 2, 'product-images/h4U09ciNsDHImiOKjNGTCLyPC14beT4b8Cy9jtlj.png', 0, 0, 9, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(43, 4, 1, 'product-images/kXoiPn9SRImzdRVjX3VwmngFUDQZTSWWP66cKDKg.png', 0, 0, 10, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(44, 4, 1, 'product-images/4Asgk5sw0yAZipnP1V2G7zB6CC8hqenbEuE3BOqy.png', 0, 0, 11, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(45, 4, 5, 'product-images/e0A3bsX7RlfoseDwdwnErPYYk3QDrFEfX4bMhtdo.png', 0, 0, 12, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(46, 4, 1, 'product-images/uA5Kqjdzige348DCB4fQoUKNqzJ6YcoTwQ9qluXL.png', 0, 0, 13, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(47, 4, 6, 'product-images/rQtxAWhzlKnuKOXIKK7jIVEFxmu9rBrihohUJ0U2.png', 0, 0, 14, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(48, 4, 5, 'product-images/8RK4J0CMyaAkxw9aH3i0XgpGeYM6mnBZYzCB7KHs.png', 0, 0, 15, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(49, 4, 7, 'product-images/qQS3CXjVrPcD4eurtp6p7ofnTmLRkNgcbkT4Zrzg.png', 0, 0, 16, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(50, 4, 3, 'product-images/VYSGXkM0TgqNJ5aXv0fTZmidyRBIDITbXn3isQRw.png', 0, 0, 17, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(51, 4, 2, 'product-images/9Iozwwdmgu1Okeef2xrIblLHgRrgXWOP4l9ojBWT.png', 0, 0, 18, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(52, 4, 2, 'product-images/NUhC4J1tucLG4IzoPlnHCe3TJpxxVvKeyPU2BhfT.png', 0, 0, 19, '2026-04-17 11:12:23', '2026-04-17 11:13:39'),
(53, 4, 3, 'product-images/I1Fy1TJDC6NXhmQl9rnb8HRdobzzvsrXHS7oTW3g.png', 0, 0, 20, '2026-04-17 11:12:23', '2026-04-17 11:13:39');

-- --------------------------------------------------------

--
-- Table structure for table `pro_attribute_values`
--

CREATE TABLE `pro_attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_value_id` bigint(20) UNSIGNED DEFAULT NULL,
  `itemcode` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pro_attribute_values`
--

INSERT INTO `pro_attribute_values` (`id`, `product_id`, `color_id`, `attribute_id`, `attribute_value_id`, `itemcode`, `stock`, `price`, `created_at`, `updated_at`) VALUES
(1, 2, 4, NULL, NULL, 2323, 25, 1000.00, '2026-04-17 10:19:54', '2026-04-17 10:19:54'),
(2, 2, 2, NULL, NULL, 4334, 25, 1000.00, '2026-04-17 10:20:15', '2026-04-17 10:20:15'),
(3, 2, 7, NULL, NULL, 323, 25, 1050.00, '2026-04-17 10:20:31', '2026-04-17 10:20:31'),
(4, 2, 3, NULL, NULL, 2323, 25, 950.00, '2026-04-17 10:20:49', '2026-04-17 10:20:49'),
(5, 3, 3, 1, 1, 454, 5, 2000.00, '2026-04-17 10:46:58', '2026-04-17 10:46:58'),
(6, 3, 2, 1, 2, 324, 5, 1995.00, '2026-04-17 10:47:30', '2026-04-17 10:48:07'),
(7, 3, 2, 1, 1, 34432, 5, 2050.00, '2026-04-17 10:48:00', '2026-04-17 10:48:00'),
(8, 3, 6, 1, 4, 3455345, 3, 2100.00, '2026-04-17 10:48:34', '2026-04-17 10:48:34'),
(9, 3, 7, 1, 2, 32234, 0, 2000.00, '2026-04-17 10:49:28', '2026-04-17 10:49:28'),
(10, 4, 1, 2, 6, 345, 2, 1400.00, '2026-04-17 11:15:00', '2026-04-17 11:18:10'),
(11, 4, 2, 2, 5, 3334, 3, 1500.00, '2026-04-17 11:15:18', '2026-04-17 11:18:28'),
(12, 4, 3, 2, 6, 4535, 3, 2300.00, '2026-04-17 11:15:34', '2026-04-17 11:18:42'),
(13, 4, 4, 2, 5, 33243, 4, 1500.00, '2026-04-17 11:15:54', '2026-04-17 11:15:54'),
(15, 4, 5, 2, 6, 1500, 3, 2300.00, '2026-04-17 11:16:30', '2026-04-17 11:16:30'),
(16, 4, 6, 2, 6, 2323, 2, 2400.00, '2026-04-17 11:16:48', '2026-04-17 11:16:48'),
(17, 4, 7, 2, 5, 23432, 5, 1500.00, '2026-04-17 11:17:03', '2026-04-17 11:17:03');

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
(1, NULL, NULL, 1, 1, 1, 'App\\Models\\Brand', '2026-04-17 07:46:32', '2026-04-17 07:46:32'),
(2, NULL, NULL, 1, 2, 1, 'App\\Models\\Brand', '2026-04-17 07:46:32', '2026-04-17 07:46:32'),
(3, NULL, NULL, 1, 3, 1, 'App\\Models\\Brand', '2026-04-17 07:46:32', '2026-04-17 07:46:32'),
(10, NULL, NULL, 2, 4, 2, 'App\\Models\\Brand', '2026-04-17 07:47:30', '2026-04-17 07:47:30'),
(11, NULL, NULL, 2, 5, 2, 'App\\Models\\Brand', '2026-04-17 07:47:30', '2026-04-17 07:47:30'),
(12, NULL, NULL, 2, 6, 2, 'App\\Models\\Brand', '2026-04-17 07:47:30', '2026-04-17 07:47:30'),
(13, NULL, 1, NULL, 1, 1, 'App\\Models\\Attribute', '2026-04-17 09:39:06', '2026-04-17 09:39:06'),
(14, NULL, 1, NULL, 4, 1, 'App\\Models\\Attribute', '2026-04-17 09:39:06', '2026-04-17 09:39:06'),
(15, NULL, 1, NULL, 2, 1, 'App\\Models\\Attribute', '2026-04-17 09:39:06', '2026-04-17 09:39:06'),
(16, NULL, 1, NULL, 3, 1, 'App\\Models\\Attribute', '2026-04-17 09:39:06', '2026-04-17 09:39:06'),
(17, NULL, 1, NULL, 5, 1, 'App\\Models\\Attribute', '2026-04-17 09:39:06', '2026-04-17 09:39:06'),
(18, NULL, 1, NULL, 6, 1, 'App\\Models\\Attribute', '2026-04-17 09:39:06', '2026-04-17 09:39:06'),
(22, 1, NULL, NULL, 7, 1, 'App\\Models\\Product', '2026-04-17 10:11:24', '2026-04-17 10:11:24'),
(23, 2, NULL, NULL, 4, 2, 'App\\Models\\Product', '2026-04-17 10:16:51', '2026-04-17 10:16:51'),
(24, 2, NULL, NULL, 5, 2, 'App\\Models\\Product', '2026-04-17 10:16:51', '2026-04-17 10:16:51'),
(27, 3, NULL, NULL, 4, 3, 'App\\Models\\Product', '2026-04-17 10:44:23', '2026-04-17 10:44:23'),
(28, 3, NULL, NULL, 6, 3, 'App\\Models\\Product', '2026-04-17 10:44:23', '2026-04-17 10:44:23'),
(29, NULL, 2, NULL, 1, 2, 'App\\Models\\Attribute', '2026-04-17 11:08:24', '2026-04-17 11:08:24'),
(30, 4, NULL, NULL, 1, 4, 'App\\Models\\Product', '2026-04-17 11:11:26', '2026-04-17 11:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'admin', '2026-04-17 04:48:05', '2026-04-17 04:48:27'),
(2, 'admin', 'admin', '2026-04-17 04:48:14', '2026-04-17 04:48:14'),
(3, 'Manager', 'admin', '2026-04-17 04:48:33', '2026-04-17 04:48:33');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(55, 1),
(55, 2),
(56, 1),
(56, 2);

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
('mJiQuVtGCo55NRL53DxpqusyTNGOmX1878ULZ9da', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaU1oM2NrbnNhQUtyVEpXY3R6c1prcDlvMWJIWUgzRW85WVAxM0JwdyI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1MzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Nob3AvZ2VudHMtdXBwZXJzL2dlbnRzLWphY2tldHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1776443003);

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

-- --------------------------------------------------------

--
-- Table structure for table `user_contacts`
--

CREATE TABLE `user_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_contacts`
--

INSERT INTO `user_contacts` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad Raza', 'engr.ahmadraza348@gmail.com', '434343434343', 'subject user', 'this is the message', '2026-04-10 02:47:24', '2026-04-10 02:47:24'),
(2, 'Muhammad Ahmad Raza', 'engr.ahmadraza348@gmail.com', '434343434343', 'subject user', 'user messgae', '2026-04-10 10:20:52', '2026-04-10 10:20:52'),
(3, 'Ahmad Raza', 'engr.ahmadraza348@gmail.com', '434343434343', 'subject user', 'adsds', '2026-04-10 10:30:07', '2026-04-10 10:30:07'),
(4, 'Ahmad Raza', 'engr.ahmadraza348@gmail.com', '434343434343', 'subject user', 'adsds', '2026-04-10 10:30:35', '2026-04-10 10:30:35'),
(5, 'Ahmad Raza', 'engr.ahmadraza348@gmail.com', '434343434343', 'subject user', 'adsds', '2026-04-10 10:31:43', '2026-04-10 10:31:43'),
(6, 'Ahmad Raza', 'engr.ahmadraza348@gmail.com', '434343434343', 'subject user', 'message', '2026-04-11 11:02:34', '2026-04-11 11:02:34'),
(7, 'Ahmad Raza', 'engr.ahmadraza348@gmail.com', '434343434343', 'subject user', 'message', '2026-04-11 11:02:58', '2026-04-11 11:02:58'),
(8, 'Ahmad Raza', 'engr.ahmadraza348@gmail.com', '434343434343', 'subject user', 'd', '2026-04-11 11:24:18', '2026-04-11 11:24:18'),
(9, 'Ahmad Raza', 'engr.ahmadraza348@gmail.com', '434343434343', 'subject user', 'd', '2026-04-11 11:26:46', '2026-04-11 11:26:46'),
(10, 'Ahmad Raza', 'engr.ahmadraza348@gmail.com', '434343434343', 'subject user', 'd', '2026-04-11 11:28:14', '2026-04-11 11:28:14'),
(11, 'Ahmad Raza', 'engr.ahmadraza348@gmail.com', '434343434343', 'sdd', 'Subject message', '2026-04-11 11:36:32', '2026-04-11 11:36:32'),
(12, 'Ahmad Raza', 'engr.ahmadraza348@gmail.com', '434343434343', 'subject usersdsd', 'sdsdsd', '2026-04-17 01:47:39', '2026-04-17 01:47:39');

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_session_id_index` (`session_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`),
  ADD KEY `cart_items_color_id_foreign` (`color_id`),
  ADD KEY `cart_items_attribute_value_id_foreign` (`attribute_value_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `colors_slug_unique` (`slug`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletters_email_unique` (`email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_color_id_foreign` (`color_id`),
  ADD KEY `order_items_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`),
  ADD KEY `product_images_color_id_foreign` (`color_id`);

--
-- Indexes for table `pro_attribute_values`
--
ALTER TABLE `pro_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_attribute_values_product_id_foreign` (`product_id`),
  ADD KEY `pro_attribute_values_color_id_foreign` (`color_id`),
  ADD KEY `pro_attribute_values_attribute_id_foreign` (`attribute_id`),
  ADD KEY `pro_attribute_values_attribute_value_id_foreign` (`attribute_value_id`);

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
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- Indexes for table `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `meta_tags`
--
ALTER TABLE `meta_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `pro_attribute_values`
--
ALTER TABLE `pro_attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `relational_categories`
--
ALTER TABLE `relational_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_contacts`
--
ALTER TABLE `user_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attribute_values` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_items_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pro_attribute_values`
--
ALTER TABLE `pro_attribute_values`
  ADD CONSTRAINT `pro_attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pro_attribute_values_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pro_attribute_values_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pro_attribute_values_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `relational_categories`
--
ALTER TABLE `relational_categories`
  ADD CONSTRAINT `relational_categories_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `relational_categories_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `relational_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `relational_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
