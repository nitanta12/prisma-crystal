-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 23, 2019 at 05:54 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

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

DROP TABLE IF EXISTS `campaigns`;
CREATE TABLE IF NOT EXISTS `campaigns` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `campaign_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `campaign_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campaigns_client_id_foreign` (`client_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

DROP TABLE IF EXISTS `charges`;
CREATE TABLE IF NOT EXISTS `charges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charge_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `charge_name`, `created_at`, `updated_at`) VALUES
(1, 'Agency coordination charge', '2019-11-17 18:15:00', '2019-11-17 18:15:00'),
(2, 'Extra Charge', '2019-11-17 18:15:00', '2019-11-17 18:15:00'),
(3, 'Agency Discount', '2019-12-01 18:15:00', '2019-12-01 18:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `charge_estimate`
--

DROP TABLE IF EXISTS `charge_estimate`;
CREATE TABLE IF NOT EXISTS `charge_estimate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charge_id` int(11) NOT NULL,
  `je_id` int(11) NOT NULL,
  `table_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `charge_percentage` float DEFAULT NULL,
  `charge_amount` double DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_brand` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `representative` text COLLATE utf8mb4_unicode_ci,
  `client_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_users`
--

DROP TABLE IF EXISTS `client_users`;
CREATE TABLE IF NOT EXISTS `client_users` (
  `cu_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`cu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `creative_ads`
--

DROP TABLE IF EXISTS `creative_ads`;
CREATE TABLE IF NOT EXISTS `creative_ads` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `campaign_id` int(10) UNSIGNED NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `creative_briefs`
--

DROP TABLE IF EXISTS `creative_briefs`;
CREATE TABLE IF NOT EXISTS `creative_briefs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) NOT NULL,
  `creative_user_id` int(11) NOT NULL,
  `creative_brief_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creative_brief_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creative_brief_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE IF NOT EXISTS `discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `discount_name`, `created_at`, `updated_at`) VALUES
(1, 'Corporate Discount', '2019-11-16 18:15:00', '2019-11-16 18:15:00'),
(3, 'Special', '2019-12-01 18:15:00', '2019-12-01 18:15:00'),
(2, 'Frequency', '2019-12-01 18:15:00', '2019-12-01 18:15:00'),
(4, 'Simultaneous', '2019-12-01 18:15:00', '2019-12-01 18:15:00'),
(5, 'Cash', '2019-12-01 18:15:00', '2019-12-01 18:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_dates`
--

DROP TABLE IF EXISTS `job_dates`;
CREATE TABLE IF NOT EXISTS `job_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `spots` double DEFAULT NULL,
  `table_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_discount`
--

DROP TABLE IF EXISTS `job_discount`;
CREATE TABLE IF NOT EXISTS `job_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `table_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `discount_percentage` float DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_estimate`
--

DROP TABLE IF EXISTS `job_estimate`;
CREATE TABLE IF NOT EXISTS `job_estimate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `je_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `campaign_id` int(11) NOT NULL,
  `table_type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_estimate_bills`
--

DROP TABLE IF EXISTS `job_estimate_bills`;
CREATE TABLE IF NOT EXISTS `job_estimate_bills` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `je_id` int(10) UNSIGNED NOT NULL,
  `remarks` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_number` double DEFAULT NULL,
  `status` enum('pending','processing','completed','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `local_newspaper`
--

DROP TABLE IF EXISTS `local_newspaper`;
CREATE TABLE IF NOT EXISTS `local_newspaper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publication` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `size` double NOT NULL,
  `break` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `color_type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `rate_per_cc` double NOT NULL,
  `inc` double NOT NULL,
  `amount` double NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `je_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `magazine`
--

DROP TABLE IF EXISTS `magazine`;
CREATE TABLE IF NOT EXISTS `magazine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publication` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` double DEFAULT NULL,
  `break` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color_type` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate_per_cc` double DEFAULT NULL,
  `inc` double NOT NULL,
  `amount` double NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `je_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(22, '2019_11_27_115913_create_creative_briefs_table', 7),
(23, '2019_11_27_165636_create_request_bills_table', 8),
(24, '2019_12_05_053822_create_programs_table', 9),
(25, '2019_12_10_103559_create_traffic_table', 10),
(26, '2019_12_11_151435_create_vendor_bills_table', 10),
(27, '2019_12_13_153655_rename_request_bill', 10),
(28, '2019_12_13_154443_addcolumn_job_estimate_bills', 11),
(29, '2019_12_13_162226_drop_job_estimate_bills_status', 11),
(30, '2019_12_15_122701_create_creative_ads_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_theatre` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auditorium` double DEFAULT NULL,
  `total_show` double DEFAULT NULL,
  `seat_capacity` double DEFAULT NULL,
  `weekend_occ` double DEFAULT NULL,
  `weekday_occ` double DEFAULT NULL,
  `duration` double DEFAULT NULL,
  `position` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate_per_month` double DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `je_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `national_daily`
--

DROP TABLE IF EXISTS `national_daily`;
CREATE TABLE IF NOT EXISTS `national_daily` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_portal`
--

DROP TABLE IF EXISTS `online_portal`;
CREATE TABLE IF NOT EXISTS `online_portal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `portal_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost_per_month` double DEFAULT NULL,
  `duration` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `je_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

DROP TABLE IF EXISTS `others`;
CREATE TABLE IF NOT EXISTS `others` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` double NOT NULL,
  `rate` double NOT NULL,
  `total_amount` double NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `je_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  KEY `permission_role_role_id_foreign` (`role_id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`)
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
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
CREATE TABLE IF NOT EXISTS `programs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `program_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `programs_vendor_id_foreign` (`vendor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_rates`
--

DROP TABLE IF EXISTS `program_rates`;
CREATE TABLE IF NOT EXISTS `program_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `position` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate_per_day` double NOT NULL,
  `rate_per_minute` double NOT NULL,
  `rate_per_spot` double NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radio`
--

DROP TABLE IF EXISTS `radio`;
CREATE TABLE IF NOT EXISTS `radio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `station` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `program` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate_type` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_sponsorship` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `rate_per_minute` double DEFAULT NULL,
  `rate_per_day` double DEFAULT NULL,
  `rate_per_spot` double DEFAULT NULL,
  `total_unit` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `je_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `rate_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '2019-04-15 13:28:32', '2019-04-15 13:28:32', NULL),
(2, 'Employee', '2019-04-15 13:28:32', '2019-11-29 00:03:52', '2019-11-29 00:03:52'),
(3, 'CS', '2019-10-18 00:59:28', '2019-11-04 04:12:30', NULL),
(4, 'Accounts', '2019-11-01 00:54:54', '2019-11-01 00:54:54', NULL),
(5, 'Story', '2019-11-01 00:55:16', '2019-11-29 00:03:48', '2019-11-29 00:03:48'),
(6, 'Executive', '2019-11-01 01:13:55', '2019-11-01 01:13:55', NULL),
(7, 'Creative', '2019-12-17 00:51:13', '2019-12-17 00:51:13', NULL),
(8, 'Traffic', '2019-12-17 00:51:26', '2019-12-17 00:51:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  KEY `role_user_user_id_foreign` (`user_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
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
(7, 3),
(8, 4),
(9, 7),
(10, 8),
(11, 6);

-- --------------------------------------------------------

--
-- Table structure for table `traffic`
--

DROP TABLE IF EXISTS `traffic`;
CREATE TABLE IF NOT EXISTS `traffic` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_estimate_number` int(11) NOT NULL,
  `bill_number` int(11) NOT NULL,
  `vendor` int(11) NOT NULL,
  `bill_amount` double NOT NULL,
  `status` enum('processing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tv`
--

DROP TABLE IF EXISTS `tv`;
CREATE TABLE IF NOT EXISTS `tv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `television` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `program` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate_type` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_sponsorship` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `rate_per_minute` double DEFAULT NULL,
  `rate_per_day` double DEFAULT NULL,
  `rate_per_spot` double DEFAULT NULL,
  `total_unit` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `je_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `rate_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `login_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `photo`, `ip_address`, `user_agent`, `login_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$imU.Hdz7VauIT3LIMCMbsOXvaaTQg6luVqkhfkBcsUd.SJW2XSRKO', 'D4zvuxVbEIq2fKbJh8pkm1eAt154JyjalJmuqmLqM91AJpupKvsngrdZh74O', '2019-04-15 13:28:32', '2019-04-15 13:28:32', NULL, NULL, NULL, NULL, NULL),
(2, 'sagun siwakotu', 'sagunstark@gmail.com', NULL, '$2y$10$qZALfvruhVCw5cZTnoMU9eKBMkeQEzM4HveFjbvkFYBaz0ZMWRZHO', '9Yj3k6VF1jXVpd9kDOKv4POwIqqkeXaravulVIzLqmUHQRcEWIBgC8p5nJty', '2019-11-01 00:58:24', '2019-12-23 00:08:41', '2019-12-23 00:08:41', NULL, NULL, NULL, NULL),
(3, 'Sushant Chapgain', 'sushant@spark.com.np', NULL, '$2y$10$W/3lrwI.cMDRVqYZgQV6YeBjGlSQG0NOuOZdTXwr/Gc/ky4T15xGy', NULL, '2019-11-04 04:13:02', '2019-12-23 00:08:41', '2019-12-23 00:08:41', NULL, NULL, NULL, NULL),
(4, 'Nabin Neupane', 'nabin@spark.com.np', NULL, '$2y$10$9iHsm6iAz4VLGTOOTkCyouJULpQzVIkpuiBskcIROkyDQI7VsVdaa', NULL, '2019-11-04 04:13:32', '2019-12-23 00:08:41', '2019-12-23 00:08:41', NULL, NULL, NULL, NULL),
(5, 'Bishal', 'bishal@prisma.com.np', NULL, '$2y$10$3avUr1pRavVTH3BIXtqDGO/zaTNjcAX5H1BSkrCEP3c9p7vl3b60y', NULL, '2019-11-16 23:55:32', '2019-12-23 00:08:41', '2019-12-23 00:08:41', NULL, NULL, NULL, NULL),
(6, 'sushant', 'accounts@prisma.com.np', NULL, '$2y$10$hq9L0ilEYx1pq1NAXEV9mOLufvUl1KqWlPc7rD55EF61NJMJzLdqm', NULL, '2019-11-30 23:39:26', '2019-12-23 00:08:41', '2019-12-23 00:08:41', NULL, NULL, NULL, NULL),
(7, 'anjan aryal', 'anjan@prismaad.com', NULL, '$2y$10$Sb8F0zj6RJByUmu2q8e6h.0OwwkduGqsx9AIXecsjYGSXZ97tf5mi', NULL, '2019-12-01 00:06:36', '2019-12-23 00:08:41', '2019-12-23 00:08:41', NULL, NULL, NULL, NULL),
(8, 'mahendra khadka', 'mahendra@prismaad.com', NULL, '$2y$10$OKkuXcmAnLs0zWK3NpeW5eoR.HKeRmNvzJbFp7x0sktcOHxvvWFHu', NULL, '2019-12-01 00:07:21', '2019-12-23 00:08:41', '2019-12-23 00:08:41', NULL, NULL, NULL, NULL),
(9, 'Creative', 'creative@prisma.com', NULL, '$2y$10$q433fbbCFiW5emGYVx1Av.elT.p350Cw9XvvdaEF87PWqaMVqjmbm', NULL, '2019-12-17 00:52:49', '2019-12-23 00:08:41', '2019-12-23 00:08:41', NULL, NULL, NULL, NULL),
(10, 'Traffic', 'traffic@prisma.com', NULL, '$2y$10$OqvuJp4.7z8XPMJh6hQVPuzI.bMzPMDMwk/BxxE4pnXSK.K7SEwau', 'pF0Ua9exV8lKUjDBicTUWDpqUK9HHoLsHvJlYalKuviUOpqx7zKf0lM3fIj9', '2019-12-17 00:53:07', '2019-12-23 00:08:41', '2019-12-23 00:08:41', NULL, NULL, NULL, NULL),
(11, 'executive', 'executive@gmail.com', NULL, '$2y$10$z12jPoABffAY2cq.rPP6OOahOQViqHOoNoAJEbFtznzr8m0gnwxZi', 'Ngs4sypz9dipoQBNlT59GBDFBo5lE5luIxyeM4OqqaRTdfPpfgxDdzegzOws', '2019-12-17 01:24:23', '2019-12-23 00:08:41', '2019-12-23 00:08:41', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_type` enum('national_daily','tv','magazine','local_newspaper','radio','social_media','production','retainership','online_portal','movie','others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_media` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_bills`
--

DROP TABLE IF EXISTS `vendor_bills`;
CREATE TABLE IF NOT EXISTS `vendor_bills` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_estimate_number` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_number` int(11) DEFAULT NULL,
  `vendor` int(11) DEFAULT NULL,
  `bill_amount` double DEFAULT NULL,
  `status` enum('pending','processing','completed','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
