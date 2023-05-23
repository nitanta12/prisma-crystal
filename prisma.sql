-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2019 at 08:03 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prisma`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(10) UNSIGNED NOT NULL,
  `campaign_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `campaign_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `campaign_name`, `client_id`, `user_id`, `campaign_description`, `created_at`, `updated_at`) VALUES
(6, 'Test Campaign', 3, 2, 'asdasd', '2019-11-05 00:34:01', '2019-11-08 03:02:59'),
(7, 'Xyz Campaign', 3, 2, 'sadasd', '2019-11-08 02:59:24', '2019-11-08 02:59:24'),
(8, 'Abc Campaign', 4, 2, 'asdsad', '2019-11-08 02:59:37', '2019-11-08 02:59:37'),
(9, 'New Year Scheme', 10, 5, 'New year', '2019-11-16 23:59:32', '2019-11-16 23:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` int(11) NOT NULL,
  `charge_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `charge_name`, `created_at`, `updated_at`) VALUES
(1, 'Agency coordination charge', '2019-11-17 18:15:00', '2019-11-17 18:15:00'),
(2, 'Extra Charge', '2019-11-17 18:15:00', '2019-11-17 18:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `charge_estimate`
--

CREATE TABLE `charge_estimate` (
  `id` int(11) NOT NULL,
  `charge_id` int(11) NOT NULL,
  `je_id` int(11) NOT NULL,
  `table_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `charge_percentage` float DEFAULT NULL,
  `charge_amount` double DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `charge_estimate`
--

INSERT INTO `charge_estimate` (`id`, `charge_id`, `je_id`, `table_name`, `charge_percentage`, `charge_amount`, `sort_order`, `created_at`, `updated_at`) VALUES
(3, 1, 15, 'others', 5, NULL, 0, '2019-11-19 01:43:10', '2019-11-19 01:43:10'),
(5, 2, 15, 'others', 10, NULL, 0, '2019-11-19 01:47:16', '2019-11-19 01:47:16'),
(10, 1, 21, 'others', 5, NULL, 0, '2019-11-20 03:25:27', '2019-11-20 03:25:40'),
(9, 2, 21, 'others', 10, NULL, 1, '2019-11-20 03:12:35', '2019-11-20 03:25:40'),
(11, 1, 9, 'others', 5, NULL, NULL, '2019-11-21 00:38:08', '2019-11-21 00:38:08'),
(13, 1, 16, 'others', 4, NULL, NULL, '2019-11-25 00:32:48', '2019-11-25 00:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_brand` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_name`, `client_phone`, `client_address`, `client_brand`, `client_description`, `client_email`, `created_at`, `updated_at`) VALUES
(4, 'Spark Tech', '9841756176', 'baneswor, kathmandu', 'Bajaj', 'Best software company in nepal', 'sparktech@gmail.com', '2019-11-01 01:09:09', '2019-11-08 02:31:02'),
(3, 'Argakhachi Cement', '9841756176', 'kalanki', 'Argakkhachi Cement', 'Nepal\'s best selling cement.', 'info@argakhachi.com.np', '2019-10-23 00:32:13', '2019-10-23 00:32:13'),
(6, 'Hansraj Hulaschand co. pvt. ltd.', '4455555', 'naxal', 'Bajaj', 'Hulash Chand bajaj', 'marketing@hhbajaj.com', '2019-11-02 23:58:37', '2019-11-02 23:58:37'),
(10, 'Bajaj Re', '9841756176', 'baneswor, kathmandu', 'Bajaj', 'This is bajaj client', 'bajaj@bajaj.com', '2019-11-16 23:56:23', '2019-11-16 23:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `client_users`
--

CREATE TABLE `client_users` (
  `cu_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `client_users`
--

INSERT INTO `client_users` (`cu_id`, `client_id`, `user_id`) VALUES
(23, 4, 4),
(22, 4, 3),
(21, 4, 2),
(18, 3, 2),
(19, 3, 3),
(20, 3, 4),
(24, 10, 5),
(25, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `creative_ads`
--

CREATE TABLE `creative_ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` int(10) UNSIGNED NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `creative_ads`
--

INSERT INTO `creative_ads` (`id`, `campaign_id`, `file`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 6, '191247080947kakashi.jpg', 'test', '2019-12-16 02:24:47', '2019-12-16 02:24:47'),
(3, 6, '19120808290810422444_1126218820725336_1947789452156591981_n.jpg', 'test2', '2019-12-16 02:44:08', '2019-12-16 02:44:08'),
(4, 6, '19122608292610422444_1126218820725336_1947789452156591981_n.jpg', 'test3', '2019-12-16 02:44:26', '2019-12-16 02:44:26'),
(6, 6, '191251122051Doc1.docx', 'document', '2019-12-16 06:35:51', '2019-12-16 06:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `creative_briefs`
--

CREATE TABLE `creative_briefs` (
  `id` int(10) UNSIGNED NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `creative_user_id` int(11) NOT NULL,
  `creative_brief_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creative_brief_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creative_brief_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `creative_briefs`
--

INSERT INTO `creative_briefs` (`id`, `campaign_id`, `creative_user_id`, `creative_brief_name`, `creative_brief_file`, `creative_brief_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 8, 'test', '191211015548event_ticket_20191209142748.pdf', 'this is just a test', '2019-12-11 08:10:48', '2019-12-11 08:10:48', NULL),
(2, 8, 9, 'test2', '191211034408swsc.JPG', 'test2', '2019-12-11 09:59:08', '2019-12-11 09:59:08', NULL),
(3, 7, 9, 'creative3', '191216115410kakashi.jpg', 'test again', '2019-12-16 06:09:10', '2019-12-16 06:16:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `discount_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `discount_name`, `created_at`, `updated_at`) VALUES
(1, 'Corporate Discount', '2019-11-16 18:15:00', '2019-11-16 18:15:00'),
(2, 'Normal Discount', '2019-11-16 18:15:00', '2019-11-16 18:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_dates`
--

CREATE TABLE `job_dates` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_dates`
--

INSERT INTO `job_dates` (`id`, `job_id`, `date_from`, `date_to`, `created_at`, `updated_at`) VALUES
(6, 7, '2019-11-13 00:00:00', '2019-11-13 00:00:00', '2019-11-13 03:27:35', '2019-11-13 03:27:35'),
(5, 7, '2019-11-13 00:00:00', '2019-11-13 00:00:00', '2019-11-13 03:27:35', '2019-11-13 03:27:35'),
(4, 7, '2019-11-13 00:00:00', '2019-11-13 00:00:00', '2019-11-13 03:27:35', '2019-11-13 03:27:35'),
(7, 7, '2019-11-13 00:00:00', '2019-11-13 00:00:00', '2019-11-13 03:27:35', '2019-11-13 03:27:35'),
(8, 8, '2019-11-13 00:00:00', '2019-11-13 00:00:00', '2019-11-13 03:31:07', '2019-11-13 03:31:07'),
(9, 8, '2019-11-13 00:00:00', '2019-11-13 00:00:00', '2019-11-13 03:31:07', '2019-11-13 03:31:07'),
(10, 7, '2019-12-10 00:00:00', '2019-12-10 00:00:00', '2019-11-13 04:40:35', '2019-11-13 04:40:35'),
(12, 9, '2019-11-15 00:00:00', '2019-11-15 00:00:00', '2019-11-14 23:57:45', '2019-11-14 23:57:45'),
(14, 10, '2019-11-17 00:00:00', '2019-11-17 00:00:00', '2019-11-17 00:16:53', '2019-11-17 00:16:53'),
(15, 10, '2019-11-18 00:00:00', '2019-11-18 00:00:00', '2019-11-17 00:16:53', '2019-11-17 00:16:53'),
(16, 10, '2019-11-18 00:00:00', '2019-11-24 00:00:00', '2019-11-17 00:16:53', '2019-11-17 00:16:53'),
(17, 10, '2019-12-04 00:00:00', '2019-12-04 00:00:00', '2019-11-17 00:16:53', '2019-11-17 00:16:53'),
(18, 11, '2019-11-29 00:00:00', '2019-11-29 00:00:00', '2019-11-17 00:18:06', '2019-11-17 00:18:06'),
(19, 11, '2019-12-27 00:00:00', '2019-12-27 00:00:00', '2019-11-17 00:18:06', '2019-11-17 00:18:06'),
(20, 9, '2019-11-13 00:00:00', '2019-11-13 00:00:00', '2019-11-25 00:23:30', '2019-11-25 00:23:30'),
(21, 9, '2019-11-14 00:00:00', '2019-11-14 00:00:00', '2019-11-25 00:23:31', '2019-11-25 00:23:31'),
(22, 9, '2019-11-21 00:00:00', '2019-11-21 00:00:00', '2019-11-25 00:23:31', '2019-11-25 00:23:31'),
(23, 8, '2019-11-28 00:00:00', '2019-11-28 00:00:00', '2019-11-25 00:23:47', '2019-11-25 00:23:47'),
(24, 8, '2019-11-30 00:00:00', '2019-11-30 00:00:00', '2019-11-25 00:23:47', '2019-11-25 00:23:47'),
(25, 16, '2019-11-26 00:00:00', '2019-11-26 00:00:00', '2019-11-25 00:29:19', '2019-11-25 00:29:19'),
(26, 16, '2019-11-19 00:00:00', '2019-11-19 00:00:00', '2019-11-25 00:29:19', '2019-11-25 00:29:19'),
(27, 16, '2019-11-21 00:00:00', '2019-11-21 00:00:00', '2019-11-25 00:29:19', '2019-11-25 00:29:19'),
(28, 16, '2019-11-28 00:00:00', '2019-11-28 00:00:00', '2019-11-25 00:29:19', '2019-11-25 00:29:19'),
(29, 9, '2019-12-26 00:00:00', '2019-12-26 00:00:00', '2019-11-26 00:39:47', '2019-11-26 00:39:47'),
(30, 7, '2019-11-22 00:00:00', '2019-11-22 00:00:00', '2019-11-26 00:40:05', '2019-11-26 00:40:05'),
(31, 7, '2019-11-23 00:00:00', '2019-11-23 00:00:00', '2019-11-26 00:40:05', '2019-11-26 00:40:05'),
(32, 7, '2019-11-25 00:00:00', '2019-11-25 00:00:00', '2019-11-26 00:40:05', '2019-11-26 00:40:05'),
(33, 7, '2019-11-24 00:00:00', '2019-11-24 00:00:00', '2019-11-26 00:40:05', '2019-11-26 00:40:05'),
(34, 17, '2019-11-19 00:00:00', '2019-11-19 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(35, 17, '2019-12-12 00:00:00', '2019-12-12 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(36, 17, '2020-01-24 00:00:00', '2020-01-24 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(37, 17, '2019-12-17 00:00:00', '2019-12-17 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(38, 17, '2019-12-26 00:00:00', '2019-12-26 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(39, 17, '2019-12-24 00:00:00', '2019-12-24 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(40, 17, '2019-12-16 00:00:00', '2019-12-16 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(41, 17, '2019-12-10 00:00:00', '2019-12-10 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(42, 17, '2019-12-19 00:00:00', '2019-12-19 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(43, 17, '2019-12-27 00:00:00', '2019-12-27 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(44, 17, '2019-12-31 00:00:00', '2019-12-31 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(45, 17, '2019-12-30 00:00:00', '2019-12-30 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(46, 17, '2019-12-22 00:00:00', '2019-12-22 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(47, 17, '2019-12-23 00:00:00', '2019-12-23 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(48, 17, '2020-01-02 00:00:00', '2020-01-02 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(49, 17, '2020-01-15 00:00:00', '2020-01-15 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(50, 17, '2020-01-22 00:00:00', '2020-01-22 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(51, 17, '2020-01-23 00:00:00', '2020-01-23 00:00:00', '2019-11-26 00:42:03', '2019-11-26 00:42:03'),
(52, 18, '2019-11-13 00:00:00', '2019-11-13 00:00:00', '2019-11-26 00:58:30', '2019-11-26 00:58:30'),
(53, 18, '2019-11-20 00:00:00', '2019-11-20 00:00:00', '2019-11-26 00:58:30', '2019-11-26 00:58:30'),
(54, 18, '2019-11-21 00:00:00', '2019-11-21 00:00:00', '2019-11-26 00:58:30', '2019-11-26 00:58:30'),
(55, 18, '2019-11-22 00:00:00', '2019-11-22 00:00:00', '2019-11-26 00:58:30', '2019-11-26 00:58:30'),
(56, 18, '2019-11-23 00:00:00', '2019-11-23 00:00:00', '2019-11-26 00:58:30', '2019-11-26 00:58:30'),
(57, 18, '2019-11-28 00:00:00', '2019-11-28 00:00:00', '2019-11-26 00:58:30', '2019-11-26 00:58:30'),
(58, 18, '2019-11-27 00:00:00', '2019-11-27 00:00:00', '2019-11-26 00:58:30', '2019-11-26 00:58:30'),
(59, 18, '2019-11-26 00:00:00', '2019-11-26 00:00:00', '2019-11-26 00:58:30', '2019-11-26 00:58:30'),
(60, 19, '2019-11-18 00:00:00', '2019-11-18 00:00:00', '2019-11-26 01:01:36', '2019-11-26 01:01:36'),
(61, 19, '2019-11-20 00:00:00', '2019-11-20 00:00:00', '2019-11-26 01:01:36', '2019-11-26 01:01:36'),
(62, 19, '2019-11-21 00:00:00', '2019-11-21 00:00:00', '2019-11-26 01:01:36', '2019-11-26 01:01:36'),
(63, 20, '2019-11-12 00:00:00', '2019-11-12 00:00:00', '2019-11-26 01:02:46', '2019-11-26 01:02:46'),
(64, 20, '2019-11-19 00:00:00', '2019-11-19 00:00:00', '2019-11-26 01:02:46', '2019-11-26 01:02:46'),
(65, 20, '2019-11-25 00:00:00', '2019-11-25 00:00:00', '2019-11-26 01:02:46', '2019-11-26 01:02:46'),
(66, 20, '2019-11-28 00:00:00', '2019-11-28 00:00:00', '2019-11-26 01:02:46', '2019-11-26 01:02:46'),
(67, 20, '2019-11-22 00:00:00', '2019-11-22 00:00:00', '2019-11-26 01:02:46', '2019-11-26 01:02:46'),
(68, 20, '2019-11-14 00:00:00', '2019-11-14 00:00:00', '2019-11-26 01:02:46', '2019-11-26 01:02:46'),
(69, 20, '2019-11-21 00:00:00', '2019-11-21 00:00:00', '2019-11-26 01:02:46', '2019-11-26 01:02:46'),
(70, 20, '2019-11-23 00:00:00', '2019-11-23 00:00:00', '2019-11-26 01:02:46', '2019-11-26 01:02:46'),
(71, 20, '2019-11-30 00:00:00', '2019-11-30 00:00:00', '2019-11-26 01:02:46', '2019-11-26 01:02:46'),
(72, 20, '2019-11-29 00:00:00', '2019-11-29 00:00:00', '2019-11-26 01:02:46', '2019-11-26 01:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `job_discount`
--

CREATE TABLE `job_discount` (
  `id` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `table_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `discount_percentage` float DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_discount`
--

INSERT INTO `job_discount` (`id`, `discount_id`, `job_id`, `table_name`, `discount_percentage`, `discount_amount`, `sort_order`, `created_at`, `updated_at`) VALUES
(10, 1, 19, 'others', NULL, 500, 0, '2019-11-18 00:16:12', '2019-11-18 00:16:12'),
(11, 1, 20, 'others', 5, NULL, 0, '2019-11-19 03:34:00', '2019-11-19 03:34:00'),
(9, 2, 5, 'others', NULL, 70000, 0, '2019-11-17 23:59:02', '2019-11-17 23:59:02'),
(12, 2, 20, 'others', NULL, 500, 0, '2019-11-19 03:34:00', '2019-11-19 03:34:00'),
(27, 1, 21, 'others', 10, NULL, NULL, '2019-11-20 03:23:04', '2019-11-20 03:23:04'),
(20, 1, 22, 'others', 7.2, NULL, NULL, '2019-11-20 00:56:39', '2019-11-20 00:56:39'),
(22, 2, 22, 'others', NULL, 500, NULL, '2019-11-20 01:00:32', '2019-11-20 01:00:32'),
(25, 1, 23, 'others', 10, NULL, NULL, '2019-11-20 02:30:21', '2019-11-20 02:30:21'),
(26, 2, 23, 'others', 10, NULL, NULL, '2019-11-20 02:30:21', '2019-11-20 02:30:21'),
(32, 1, 9, 'others', 5, NULL, NULL, '2019-11-25 00:38:37', '2019-11-25 00:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `job_estimate`
--

CREATE TABLE `job_estimate` (
  `id` int(11) NOT NULL,
  `je_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `campaign_id` int(11) NOT NULL,
  `table_type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_estimate`
--

INSERT INTO `job_estimate` (`id`, `je_name`, `campaign_id`, `table_type`, `created_at`, `updated_at`) VALUES
(15, '6-others-1', 6, 'others', '2019-11-11 23:39:05', '2019-11-11 23:39:05'),
(9, '6-online_portal-9', 6, 'online_portal', '2019-11-05 04:10:25', '2019-11-05 04:10:25'),
(16, '6-print_media-1', 6, 'print_media', '2019-11-12 23:59:56', '2019-11-12 23:59:56'),
(17, '9-online_portal-1', 9, 'online_portal', '2019-11-17 00:00:48', '2019-11-17 00:00:48'),
(18, '9-online_portal-2', 9, 'online_portal', '2019-11-17 00:00:57', '2019-11-17 00:00:57'),
(19, '9-print_media-1', 9, 'print_media', '2019-11-17 00:02:26', '2019-11-17 00:02:26'),
(20, '9-others-1', 9, 'others', '2019-11-17 00:02:38', '2019-11-17 00:02:38'),
(21, '6-others-2', 6, 'others', '2019-11-19 04:01:53', '2019-11-19 04:01:53'),
(23, '6-tvc-3', 6, 'others', '2019-11-21 00:28:34', '2019-11-21 00:28:34'),
(24, '6-print_media-2', 6, 'print_media', '2019-11-26 00:41:26', '2019-11-26 00:41:26'),
(25, '6-national_daily-1', 6, 'national_daily', '2019-11-26 00:53:29', '2019-11-26 00:53:29'),
(26, '6-national_daily-2', 6, 'national_daily', '2019-11-27 07:09:23', '2019-11-27 07:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `job_estimate_bills`
--

CREATE TABLE `job_estimate_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `je_id` int(10) UNSIGNED NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bill_number` int(11) NOT NULL,
  `total_amount` double(8,2) NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('processing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_estimate_bills`
--

INSERT INTO `job_estimate_bills` (`id`, `je_id`, `file`, `created_at`, `updated_at`, `bill_number`, `total_amount`, `remarks`, `status`) VALUES
(7, 26, '191215045459kaka.jpg', '2019-12-15 08:31:29', '2019-12-15 11:09:59', 14, 3000.00, 'testing', 'processing'),
(8, 25, '191215035809swsc.JPG', '2019-12-15 10:13:09', '2019-12-15 11:10:47', 13, 1000.00, 'test2', 'processing');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_04_15_191331679173_create_1555355612601_permissions_table', 1),
(3, '2019_04_15_191331731390_create_1555355612581_roles_table', 1),
(4, '2019_04_15_191331779537_create_1555355612782_users_table', 1),
(5, '2019_04_15_191332603432_create_1555355612603_permission_role_pivot_table', 1),
(6, '2019_04_15_191332791021_create_1555355612790_role_user_pivot_table', 1),
(7, '2019_04_15_191441675085_create_1555355681975_products_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(20, '2019_10_22_102937_create_campaigns_table', 5),
(19, '2019_10_20_092635_create_templates_table', 4),
(18, '2019_10_20_062531_create_clients_table', 3),
(17, '2019_10_18_101057_create_advertisement_categories_table', 2),
(21, '2019_11_04_085425_create_vendors_table', 6),
(27, '2019_11_27_115913_create_creative_briefs_table', 10),
(23, '2019_11_27_165636_create_request_bills_table', 8),
(25, '2019_12_10_103559_create_traffic_table', 9),
(28, '2019_12_11_151435_create_vendor_bills_table', 11),
(29, '2019_12_13_153655_rename_request_bill', 12),
(33, '2019_12_13_154443_addcolumn_job_estimate_bills', 14),
(32, '2019_12_13_162226_drop_job_estimate_bills_status', 13),
(34, '2019_12_15_122701_create_creative_ads_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `national_daily`
--

CREATE TABLE `national_daily` (
  `id` int(11) NOT NULL,
  `publication` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `size` double DEFAULT NULL,
  `break` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color_type` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate_per_cc` double DEFAULT NULL,
  `inc` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `je_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `national_daily`
--

INSERT INTO `national_daily` (`id`, `publication`, `size`, `break`, `position`, `color_type`, `rate_per_cc`, `inc`, `amount`, `vendor_id`, `je_id`, `created_at`, `updated_at`) VALUES
(9, 'Kantipur Dainik', 400, '4*25', 'Front Page', 'color', 100, 4, 160000, 1, 16, '2019-11-14 23:57:45', '2019-11-25 00:31:03'),
(7, 'Kantipur Dainik', 2, '4*25', 'Front Page', 'color', 1, 5, 10, 1, 16, '2019-11-13 03:27:35', '2019-11-13 04:58:21'),
(16, 'Kantipur Dainik', 400, '4*25', 'Front Page', 'color', 4, 4, 6400, 1, 16, '2019-11-25 00:29:19', '2019-11-25 00:29:19'),
(10, 'Kantipur Dainik', 100, '4*25', 'Front Page', 'color', 2000, 4, 800000, 1, 19, '2019-11-17 00:16:53', '2019-11-17 00:16:53'),
(11, 'Kantipur Dainik', 400, '8*50', 'Third Page', 'color', 4000, 2, 3200000, 1, 19, '2019-11-17 00:18:06', '2019-11-17 00:18:06'),
(17, 'Kantipur Dainik', 344, '4*25', 'Front Page', 'color', 400, 18, 2476800, 1, 24, '2019-11-26 00:42:03', '2019-11-26 00:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `online_portal`
--

CREATE TABLE `online_portal` (
  `id` int(11) NOT NULL,
  `portal_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost_per_month` double DEFAULT NULL,
  `duration` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `je_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `online_portal`
--

INSERT INTO `online_portal` (`id`, `portal_name`, `category`, `cost_per_month`, `duration`, `total_amount`, `vendor_id`, `je_id`, `created_at`, `updated_at`) VALUES
(4, 'Online Khabar', 'Banner Ad', 30033, 2, 60066, 2, 9, '2019-11-07 03:10:09', '2019-11-07 04:08:19'),
(6, 'Rato Pati', 'Banner Ad', 500, 2, 1000, 3, 9, '2019-11-07 05:00:16', '2019-11-07 05:00:16'),
(8, 'Online Khabar', 'Banner Ad', 20000, 2, 40000, 2, 17, '2019-11-17 00:04:37', '2019-11-17 00:05:49'),
(9, 'Online Khabar', 'Road Block', 50000, 2, 100000, 2, 17, '2019-11-17 00:05:39', '2019-11-17 00:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `id` int(11) NOT NULL,
  `description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` double NOT NULL,
  `rate` double NOT NULL,
  `total_amount` double NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `je_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`id`, `description`, `quantity`, `rate`, `total_amount`, `vendor_id`, `je_id`, `created_at`, `updated_at`) VALUES
(9, 'Lights', 4, 2500, 10000, 0, 20, '2019-11-17 00:12:22', '2019-11-17 00:12:22'),
(10, 'Camera', 2, 5000, 10000, 0, 20, '2019-11-17 00:12:38', '2019-11-17 00:12:38'),
(11, 'Models', 4, 10000, 40000, 0, 20, '2019-11-17 00:12:53', '2019-11-17 00:12:53'),
(21, 'Camera', 2, 25000, 50000, 0, 21, '2019-11-19 04:03:48', '2019-11-20 02:27:49'),
(23, 'Models', 1, 100000, 100000, 0, 21, '2019-11-20 02:30:21', '2019-11-20 02:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(2, 'permission_create', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(3, 'permission_edit', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(4, 'permission_show', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(5, 'permission_delete', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(6, 'permission_access', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(7, 'role_create', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(8, 'role_edit', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(9, 'role_show', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(10, 'role_delete', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(11, 'role_access', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(12, 'user_create', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(13, 'user_edit', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(14, 'user_show', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(15, 'user_delete', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(16, 'user_access', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(17, 'product_create', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(18, 'product_edit', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(19, 'product_show', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(20, 'product_delete', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL),
(21, 'product_access', '2019-04-15 13:29:42', '2019-04-15 13:29:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '2019-04-15 13:28:32', '2019-04-15 13:28:32', NULL),
(2, 'Employee', '2019-04-15 13:28:32', '2019-11-01 00:55:25', NULL),
(3, 'CS', '2019-10-18 00:59:28', '2019-11-04 04:12:30', NULL),
(4, 'Accounts', '2019-11-01 00:54:54', '2019-11-01 00:54:54', NULL),
(5, 'Story', '2019-11-01 00:55:16', '2019-11-01 00:55:16', NULL),
(6, 'Executive', '2019-11-01 01:13:55', '2019-11-01 01:13:55', NULL),
(7, 'Traffic', '2019-12-10 05:13:21', '2019-12-10 05:13:21', NULL),
(8, 'Creative', '2019-12-11 06:58:55', '2019-12-11 06:58:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 4),
(7, 7),
(8, 8),
(9, 8),
(10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `traffic`
--

CREATE TABLE `traffic` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_estimate_number` int(11) NOT NULL,
  `bill_number` int(11) NOT NULL,
  `vendor` int(11) NOT NULL,
  `bill_amount` double NOT NULL,
  `status` enum('processing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `traffic`
--

INSERT INTO `traffic` (`id`, `job_estimate_number`, `bill_number`, `vendor`, `bill_amount`, `status`, `user_id`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 10, 11, 2, 10000, 'processing', 7, 'just a test', '2019-12-11 06:39:10', '2019-12-11 06:39:10'),
(2, 10, 11, 2, 10000, 'processing', 7, 'just a test', '2019-12-11 06:39:27', '2019-12-11 06:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `photo`, `ip_address`, `user_agent`, `login_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$imU.Hdz7VauIT3LIMCMbsOXvaaTQg6luVqkhfkBcsUd.SJW2XSRKO', 'VwdrI8sQr9Gav1Yy2reDAtRguxjWYkPzk8fnuXqOjdXEdlwHyQrdqOQiCgMI', '2019-04-15 13:28:32', '2019-04-15 13:28:32', NULL, NULL, NULL, NULL, NULL),
(2, 'sagun siwakotu', 'sagunstark@gmail.com', NULL, '$2y$10$qZALfvruhVCw5cZTnoMU9eKBMkeQEzM4HveFjbvkFYBaz0ZMWRZHO', 'slZ6LmFv0egnsnOQtI5Gz1pAnebf7E8Z9mzilUkoiP1D8sYAxz20aWaxuafp', '2019-11-01 00:58:24', '2019-11-01 00:58:24', NULL, NULL, NULL, NULL, NULL),
(3, 'Sushant Chapgain', 'sushant@spark.com.np', NULL, '$2y$10$W/3lrwI.cMDRVqYZgQV6YeBjGlSQG0NOuOZdTXwr/Gc/ky4T15xGy', NULL, '2019-11-04 04:13:02', '2019-11-04 04:13:02', NULL, NULL, NULL, NULL, NULL),
(4, 'Nabin Neupane', 'nabin@spark.com.np', NULL, '$2y$10$9iHsm6iAz4VLGTOOTkCyouJULpQzVIkpuiBskcIROkyDQI7VsVdaa', NULL, '2019-11-04 04:13:32', '2019-11-04 04:13:32', NULL, NULL, NULL, NULL, NULL),
(5, 'Bishal', 'bishal@prisma.com.np', NULL, '$2y$10$3avUr1pRavVTH3BIXtqDGO/zaTNjcAX5H1BSkrCEP3c9p7vl3b60y', NULL, '2019-11-16 23:55:32', '2019-11-16 23:58:14', NULL, NULL, NULL, NULL, NULL),
(6, 'account', 'account@account.com', NULL, '$2y$10$1RdJ776AtqGS0N3WE9hVZ.uZLrWV25jwk48RqClgb2jEi7d6jWmta', NULL, '2019-11-28 06:13:31', '2019-12-10 05:10:12', '2019-12-10 05:10:12', NULL, NULL, NULL, NULL),
(7, 'traffic', 'traffic@gmail.com', NULL, '$2y$10$eS.h16RetNX3ufVyUzsu9O3qLxEBf0gHGn0p6on0.IdUKDSGHWxEe', NULL, '2019-12-10 05:14:08', '2019-12-10 05:14:08', NULL, NULL, NULL, NULL, NULL),
(8, 'john', 'john@gmail.com', NULL, '$2y$10$A/sBWypG..K0b2dElrXnM.9U8bxW.cMD7xes/bUWaUU1qY70H2an.', NULL, '2019-12-11 06:59:34', '2019-12-11 06:59:34', NULL, NULL, NULL, NULL, NULL),
(9, 'nick', 'nick@gmail.com', NULL, '$2y$10$iSy/taWmOclpiAf71NxtB.v0Dg8NE0pdATmOA2wEZvlQwGw3w3VN6', NULL, '2019-12-11 07:50:52', '2019-12-11 07:50:52', NULL, NULL, NULL, NULL, NULL),
(10, 'Mantra', 'mantra@executive.com', NULL, '$2y$10$t/OBQijNWpLi/nSg9EknV.hPNpgrB2KCHug4EchV7SAYP4jCQ5Gb.', NULL, '2019-12-16 06:39:18', '2019-12-16 06:39:18', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_type` enum('national_daily','tv','magazine','local_newspaper','radio','social_media','production','retainership','online_portal','others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendor_name`, `vendor_type`, `vendor_phone`, `vendor_address`, `vendor_description`, `created_at`, `updated_at`) VALUES
(1, 'Kantipur Dainik', 'national_daily', '9841756176', 'kathamandu', 'adasdsad', '2019-11-04 03:27:53', '2019-11-06 00:34:35'),
(2, 'Online Khabar', 'online_portal', '9841756176', 'baneswor, kathmandu', 'asd', '2019-11-06 00:34:58', '2019-11-06 00:34:58'),
(3, 'Rato Pati', 'online_portal', '9841756176', 'baneswor, kathmandu', 'asd', '2019-11-06 00:35:19', '2019-11-06 00:35:19'),
(4, 'Seto pati', 'online_portal', '9841756176', 'baneswor, kathmandu', 'asd', '2019-11-06 00:35:40', '2019-11-06 00:35:40'),
(5, 'Bikash News', 'others', '9841756176', 'arkabi,nepal, arkabi,nepal', 'awdawd', '2019-11-11 23:37:59', '2019-11-11 23:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_bills`
--

CREATE TABLE `vendor_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_estimate_number` int(11) NOT NULL,
  `bill_number` int(11) NOT NULL,
  `vendor` int(11) NOT NULL,
  `bill_amount` double NOT NULL,
  `status` enum('processing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_bills`
--

INSERT INTO `vendor_bills` (`id`, `job_estimate_number`, `bill_number`, `vendor`, `bill_amount`, `status`, `user_id`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 11, 111, 2, 20000, 'processing', 7, 'test', '2019-12-11 10:07:42', '2019-12-16 06:01:04'),
(3, 12, 18, 5, 200000, 'processing', 7, 'testing', '2019-12-13 06:25:59', '2019-12-13 06:25:59'),
(4, 3, 56, 1, 1200, 'processing', 7, 'test3', '2019-12-13 06:26:20', '2019-12-13 06:26:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaigns_client_id_foreign` (`client_id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charge_estimate`
--
ALTER TABLE `charge_estimate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_users`
--
ALTER TABLE `client_users`
  ADD PRIMARY KEY (`cu_id`);

--
-- Indexes for table `creative_ads`
--
ALTER TABLE `creative_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creative_briefs`
--
ALTER TABLE `creative_briefs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_dates`
--
ALTER TABLE `job_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_discount`
--
ALTER TABLE `job_discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_estimate`
--
ALTER TABLE `job_estimate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_estimate_bills`
--
ALTER TABLE `job_estimate_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `national_daily`
--
ALTER TABLE `national_daily`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_portal`
--
ALTER TABLE `online_portal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `permission_role_role_id_foreign` (`role_id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `traffic`
--
ALTER TABLE `traffic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_bills`
--
ALTER TABLE `vendor_bills`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `charge_estimate`
--
ALTER TABLE `charge_estimate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `client_users`
--
ALTER TABLE `client_users`
  MODIFY `cu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `creative_ads`
--
ALTER TABLE `creative_ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `creative_briefs`
--
ALTER TABLE `creative_briefs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_dates`
--
ALTER TABLE `job_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `job_discount`
--
ALTER TABLE `job_discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `job_estimate`
--
ALTER TABLE `job_estimate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `job_estimate_bills`
--
ALTER TABLE `job_estimate_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `national_daily`
--
ALTER TABLE `national_daily`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `online_portal`
--
ALTER TABLE `online_portal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `traffic`
--
ALTER TABLE `traffic`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vendor_bills`
--
ALTER TABLE `vendor_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
