-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2020 at 11:19 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_role` tinyint(4) DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `admin_role`, `photo`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super@gmail.com', 'superadmin', 1, 'public/images/admins/1556265063.png', '$2y$10$cW9KVqhUuLOearR9Uhr9yeiUBnxRPJvY3KsjttKr77tKMNZab7Ncm', 1, 'qZfodBwo4SAQh0tQEkKAfdBFKhiDAn3fmABlbPWcuUx4XMfntlgWh1shQY3x', '2019-03-25 01:00:00', '2019-04-26 01:51:05'),
(2, 'Admin', 'admin@gmail.com', 'admin', 2, NULL, '$2y$10$3eUb3dspSaecGyAWo0jOp.r2N83ZUQRYaJMh/058e3apUV5XSmlQq', 1, 'sZE0KVFsqcRuovw6Eu0YQ5VywZRgduSp3CXwxauqRtiDsrVYRl7z8dZWYhxK', '2019-03-25 01:00:00', '2019-04-26 02:15:22'),
(3, 'aaaaaa', 'afzalsabbir.bd@gmail.com', 'aaaaaa', 3, NULL, '$2y$10$P1rFOIiR1hB4IdUDBw/KKenlpz9LK80jAw/IWulwNUXF6hnc90lzu', 1, NULL, '2019-04-25 13:46:07', '2019-04-25 13:46:07'),
(4, 'bbbbbb', 'afzalbd1@gmail.comk', 'bbbbbb', 3, NULL, '$2y$10$wpvJp1iVMxNM6Tkzn9IRwe6CftljT2xXkj13euFuV.mJorisuC17y', 1, NULL, '2019-04-25 13:47:19', '2019-04-25 13:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `admin_access_infos`
--

CREATE TABLE `admin_access_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `admin_access_infos`
--

INSERT INTO `admin_access_infos` (`id`, `admin_id`, `ip`, `country`, `device`, `browser`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '::1', 'US', 'PC', 'Chrome', 1, '2019-04-13 21:23:58', '2019-04-13 21:23:58'),
(2, 1, '::1', 'US', 'PC', 'Chrome', 1, '2019-04-13 21:32:58', '2019-04-13 21:32:58'),
(3, 1, '::1', 'US', 'PC', 'Chrome', 1, '2019-04-13 09:54:11', '2019-04-13 09:54:11'),
(4, 1, '::1', 'US', 'PC', 'Chrome', 1, '2019-04-13 09:54:28', '2019-04-13 09:54:28'),
(5, 1, '::1', 'US', 'PC', 'Chrome', 1, '2019-04-13 11:15:57', '2019-04-13 11:15:57'),
(6, 1, '::1', 'US', 'PC', 'Chrome', 1, '2019-04-14 07:02:21', '2019-04-14 07:02:21'),
(7, 1, '::1', NULL, 'PC', 'Chrome', 1, '2019-04-15 12:30:22', '2019-04-15 12:30:22'),
(8, 1, '::1', NULL, 'PC', 'Chrome', 1, '2019-04-16 12:40:57', '2019-04-16 12:40:57'),
(9, 1, '::1', NULL, 'PC', 'Chrome', 1, '2019-04-18 12:56:28', '2019-04-18 12:56:28'),
(10, 1, '::1', NULL, 'PC', 'Chrome', 1, '2019-04-19 09:40:46', '2019-04-19 09:40:46'),
(11, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2019-04-19 09:52:12', '2019-04-19 09:52:12'),
(12, 1, '::1', NULL, 'PC', 'Chrome', 1, '2019-04-19 09:52:53', '2019-04-19 09:52:53'),
(13, 1, '::1', NULL, 'PC', 'Chrome', 1, '2019-04-19 10:10:57', '2019-04-19 10:10:57'),
(14, 1, '::1', NULL, 'PC', 'Chrome', 1, '2019-04-21 13:35:26', '2019-04-21 13:35:26'),
(15, 1, '::1', NULL, 'PC', 'Chrome', 1, '2019-04-23 11:19:55', '2019-04-23 11:19:55'),
(16, 2, '::1', NULL, 'PC', 'Chrome', 1, '2019-04-23 12:18:56', '2019-04-23 12:18:56'),
(17, 1, '::1', NULL, 'PC', 'Chrome', 1, '2019-04-23 12:19:59', '2019-04-23 12:19:59'),
(18, 1, '::1', NULL, 'PC', 'Firefox', 1, '2019-04-25 09:33:47', '2019-04-25 09:33:47'),
(19, 1, '::1', NULL, 'PC', 'Firefox', 1, '2019-04-25 11:28:26', '2019-04-25 11:28:26'),
(20, 1, '::1', NULL, 'PC', 'Firefox', 1, '2019-04-25 22:14:32', '2019-04-25 22:14:32'),
(21, 1, '::1', NULL, 'PC', 'Chrome', 1, '2019-04-30 05:41:04', '2019-04-30 05:41:04'),
(22, 1, '::1', NULL, 'PC', 'Chrome', 1, '2019-06-14 21:44:09', '2019-06-14 21:44:09'),
(23, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-02-24 04:08:16', '2020-02-24 04:08:16'),
(24, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-02-24 07:52:02', '2020-02-24 07:52:02'),
(25, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-02-24 07:53:45', '2020-02-24 07:53:45'),
(26, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-02-24 08:17:11', '2020-02-24 08:17:11'),
(27, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-02-24 08:25:02', '2020-02-24 08:25:02'),
(28, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-02-24 08:53:38', '2020-02-24 08:53:38'),
(29, 3, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-02-24 08:53:53', '2020-02-24 08:53:53'),
(30, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-02-24 08:54:03', '2020-02-24 08:54:03'),
(31, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-02-24 08:56:07', '2020-02-24 08:56:07'),
(32, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-25 04:43:04', '2020-02-25 04:43:04'),
(33, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-25 05:18:42', '2020-02-25 05:18:42'),
(34, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-25 05:19:07', '2020-02-25 05:19:07'),
(35, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-26 05:58:41', '2020-02-26 05:58:41'),
(36, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-26 06:01:02', '2020-02-26 06:01:02'),
(37, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-26 06:08:30', '2020-02-26 06:08:30'),
(38, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-26 06:08:38', '2020-02-26 06:08:38'),
(39, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-26 08:32:02', '2020-02-26 08:32:02'),
(40, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-26 11:18:12', '2020-02-26 11:18:12'),
(41, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-26 11:19:18', '2020-02-26 11:19:18'),
(42, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-26 11:26:35', '2020-02-26 11:26:35'),
(43, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-26 11:30:24', '2020-02-26 11:30:24'),
(44, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 03:29:19', '2020-02-27 03:29:19'),
(45, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 03:45:51', '2020-02-27 03:45:51'),
(46, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 05:25:30', '2020-02-27 05:25:30'),
(47, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 05:53:27', '2020-02-27 05:53:27'),
(48, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 08:20:45', '2020-02-27 08:20:45'),
(49, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 09:42:35', '2020-02-27 09:42:35'),
(50, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 09:44:02', '2020-02-27 09:44:02'),
(51, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 10:08:01', '2020-02-27 10:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_bn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `menu_position` int(10) UNSIGNED DEFAULT NULL COMMENT '0 - Left | 1 - Left In | 2 - Right Top',
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_color` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#ffffff',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu`, `menu_bn`, `parent_id`, `menu_position`, `icon`, `icon_color`, `url`, `route`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'ড্যাশবোর্ড', NULL, 0, 'fa fa-dashboard', '#00ff00', '/admin', 'admin.home', 1, 1, '2019-03-24 23:02:05', '2020-02-27 07:58:49'),
(2, 'Menu Permission', 'মেনু পারমিশন', NULL, 0, 'fa fa-diamond', '#ffffff', '/admin/role', 'admin.role.index', 900, 1, '2019-03-24 22:44:32', '2019-06-14 23:06:38'),
(3, 'Action', 'একশন', 2, 0, 'fa fa-home', '#ffffff', '/admin/role', 'admin.role.index', 1, 1, '2019-04-23 05:27:09', '2019-04-23 05:27:09'),
(4, 'Assign', 'অনুমতি প্রদান', 3, 1, 'fa fa-pencil', '#ffffff', '/admin/role/assign', 'admin.role.assign', 1, 1, '2019-03-24 22:48:50', '2019-04-23 05:27:39'),
(5, 'Site Settings', 'সাইট সেটিংস', NULL, 0, 'fa fa-sliders', '#ff8000', '/admin/setting', 'admin.setting.index', 500, 1, '2019-04-10 16:30:44', '2020-02-27 08:01:24'),
(6, 'Change Password', 'পাসওয়ার্ড পরিবর্তন', NULL, 2, 'fa fa-cog', '#ffffff', '/admin/change-password', 'admin.password.form', 2, 1, '2019-03-24 22:42:35', '2019-04-23 06:20:29'),
(7, 'Log Activity', 'লগ এক্টিভিটি', NULL, 0, 'fa fa-history', '#4f4fff', '/admin/log', 'admin.log.index', 950, 1, '2019-03-24 22:46:37', '2020-02-27 08:13:38'),
(23, 'All Admin', 'সকল এডমিন', NULL, 2, 'fa fa-users', '#ffffff', '/admin/all-admin', 'admin.all_admin.index', 1, 1, '2019-04-10 20:37:34', '2019-04-23 05:43:40'),
(24, 'Add Admin', 'এডমিন যোগ করুন', 23, 0, 'fa fa-plus', '#ffffff', '/admin/all-admin/add', 'admin.all_admin.add', 2, 1, '2019-04-10 20:39:51', '2019-04-10 20:39:51'),
(25, 'Action', 'একশন', 23, 0, 'fa fa-home', '#ffffff', '/admin/all-admin', 'admin.all_admin.index', 1, 1, '2019-04-23 06:27:34', '2019-04-23 06:27:34'),
(26, 'Edit', 'এডিট', 25, 1, 'fa fa-pencil', '#ffffff', NULL, 'admin.all_admin.edit', 1, 1, '2019-04-10 20:40:57', '2019-04-23 06:28:07'),
(27, 'Delete', 'ডিলিট', 25, 1, 'fa fa-trash', '#ffffff', NULL, 'admin.all_admin.delete', 2, 1, '2019-04-10 20:42:59', '2019-04-23 06:28:13'),
(28, 'Backup', 'ব্যাকআপ', NULL, 0, 'fa fa-database', '#408080', '/admin/backup', 'admin.backup.index', 1000, 1, '2019-04-18 21:49:55', '2020-02-27 08:13:53'),
(29, 'Action', 'কার্যক্রম', 28, 0, 'fa fa-home', '#ffffff', '/admin/backup', 'admin.backup.index', 1, 1, '2019-04-18 21:51:23', '2019-04-18 21:54:34'),
(30, 'Download', 'ডাউনলোড', 29, 1, 'fa fa-download', '#ffffff', NULL, 'admin.backup.index', 1, 1, '2019-04-18 21:52:24', '2019-04-18 21:52:24'),
(31, 'Delete', 'ডিলিট', 29, 1, 'fa fa-trash', '#ffffff', NULL, 'admin.backup.index', 2, 1, '2019-04-18 21:52:58', '2019-04-18 21:52:58'),
(32, 'SMS', 'এসএমএস', NULL, 0, 'fa fa-envelope', '#ffff80', NULL, NULL, 499, 1, NULL, '2020-02-27 08:00:51'),
(33, 'Send', 'প্রেরন', 32, 0, 'fa fa-commenting', '#8dc7c7', 'admin/sms/send', 'admin.sms.send', 1, 1, NULL, '2020-02-27 07:59:54'),
(34, 'Custom', 'কাস্টম', 32, 0, 'fa fa-comment-o', '#ffffff', 'admin/sms/custom', 'admin.sms.custom', 2, 1, NULL, '2019-06-14 23:01:06'),
(35, 'Report', 'প্রতিবেদন', 32, 0, 'fa fa-indent', '#ffff00', 'admin/sms/report', 'admin.sms.report', 3, 1, NULL, '2020-02-27 08:00:36'),
(36, 'Restore', 'রিস্টোর', 29, 1, 'fa fa-upload', '#ffffff', '/admin/backup/restore', 'admin.backup.restore', 2, 1, '2019-07-02 16:28:12', '2019-07-02 16:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_03_26_200821_create_admins_table', 1),
(2, '2019_03_04_084037_create_menus_table', 1),
(3, '2019_03_05_074453_create_roles_table', 1),
(4, '2019_03_06_090310_create_admin_access_infos_table', 1),
(5, '2019_03_25_140240_create_password_resets_table', 1),
(6, '2019_03_25_140240_create_users_table', 1),
(7, '2019_03_25_140140_create_units_table', 2),
(8, '2019_03_25_140157_create_categories_table', 2),
(9, '2019_03_25_140207_create_sub_categories_table', 2),
(10, '2019_03_25_140231_create_brands_table', 2),
(11, '2019_04_10_152516_create_settings_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_menu` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` int(10) DEFAULT NULL,
  `role` tinyint(3) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `menu`, `sub_menu`, `in_body`, `admin_id`, `role`, `status`, `created_at`, `updated_at`) VALUES
(9, '[\"1\",\"6\",\"28\",\"2\",\"5\",\"32\",\"7\",\"23\"]', '[\"33\",\"3\",\"25\",\"35\",\"34\",\"24\",\"29\"]', '[\"30\",\"4\",\"26\",\"36\",\"31\",\"27\"]', 1, 1, 1, '2019-04-25 22:41:31', '2020-02-27 08:33:26'),
(10, '[\"1\"]', 'null', 'null', 4, 3, 1, '2019-04-26 00:33:57', '2020-02-24 08:54:30'),
(12, '[\"23\",\"1\",\"6\",\"5\",\"2\",\"28\",\"7\"]', '[\"29\",\"3\",\"25\",\"24\"]', '[\"30\",\"26\",\"31\",\"4\",\"21\",\"17\",\"11\",\"12\",\"16\",\"22\",\"27\"]', 2, 2, 1, '2019-04-26 01:33:19', '2019-06-14 23:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_bn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `favicon`, `title_en`, `title_bn`, `email`, `mobile`, `facebook`, `twitter`, `youtube`, `linkedin`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'public/images/settings/logo-1556222447.png', 'public/images/settings/favicon-1556222459.png', 'laravel 6.0', 'লারাভেল ৬.০', 'superadmin@Restaurent-Bill.com', '01234567890', 'facebook', 'twitter', 'youtube', 'linkedin', 'City: Mymensingh\r\nCountry: Bangladesh\r\nState: Mymensingh Division\r\nZipcode: 2200', 1, '2019-04-10 06:00:00.000000', '2020-02-25 04:58:21.000000');

-- --------------------------------------------------------

--
-- Table structure for table `sms_records`
--

CREATE TABLE `sms_records` (
  `id` int(11) NOT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `sms` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `sending_date` date DEFAULT NULL,
  `sms_count` tinyint(3) DEFAULT 1,
  `send_by` int(11) DEFAULT NULL,
  `is_send` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `sms_records`
--

INSERT INTO `sms_records` (`id`, `mobile`, `sms`, `sending_date`, `sms_count`, `send_by`, `is_send`) VALUES
(1, '01624390079', 'Hi Khairul vai', '2019-04-30', NULL, 1, 1),
(2, '01515255819', 'sgfhgfhg', '2019-04-30', 1, 1, 1),
(3, '01624390079', 'sgfhgfhg', '2019-04-30', 1, 1, 1),
(4, '01969481541', 'sgfhgfhg', '2019-04-30', 1, 1, 1),
(5, '01515255819', 'hey khairul vai, how are you hey khairul vai, how are you hey khairul vai, how are you hey khairul vai, how are you hey khairul vai, how are you hey khairul vai, how are you', '2019-04-30', 2, 1, 1),
(6, '01624390079', 'hey khairul vai, how are you hey khairul vai, how are you hey khairul vai, how are you hey khairul vai, how are you hey khairul vai, how are you hey khairul vai, how are you', '2019-04-30', 2, 1, 1),
(7, '01515255819', 'ssds', '2019-04-30', 1, 1, 1),
(8, '01624390079', 'ssds', '2019-04-30', 1, 1, 1),
(9, '01969481541', 'ssds', '2019-04-30', 1, 1, 1),
(10, '01515255819', 'd', '2019-04-30', 1, 1, 1),
(11, '01515255819', 'd', '2019-04-30', 1, 1, 1),
(12, '01624390079', 'd', '2019-04-30', 1, 1, 1),
(13, '01713576627', 'hey', '2019-04-30', 1, 1, 1),
(14, '01969481541', 'hey', '2019-04-30', 1, 1, 1),
(15, '01515255819', 'h', '2019-04-30', 1, 1, 1),
(16, '01969481541', 'h', '2019-04-30', 1, 1, 1),
(17, '01515255819', 'd', '2019-04-30', 1, 1, 1),
(18, '01515255819', 'd', '2019-04-30', 1, 1, 1),
(19, '01515255819', 's', '2019-04-30', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role` tinyint(4) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_id` int(10) UNSIGNED DEFAULT NULL,
  `upazilla_id` int(10) UNSIGNED DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `username`, `image`, `user_role`, `password`, `country`, `district_id`, `upazilla_id`, `address`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Demo', 'demo@gmail.com', '01515255819', 'demo', NULL, 1, '$2y$10$tQVwD5VequDrZsgg5NUaHexmp3fGf.XI7zylpDEqSxf9WJITYiRWO', NULL, NULL, NULL, '', '1', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `admins_email_unique` (`email`) USING BTREE,
  ADD UNIQUE KEY `admins_username_unique` (`username`) USING BTREE;

--
-- Indexes for table `admin_access_infos`
--
ALTER TABLE `admin_access_infos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `admin_access_infos_admin_id_foreign` (`admin_id`) USING BTREE;

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_records`
--
ALTER TABLE `sms_records`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`) USING BTREE,
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`) USING BTREE,
  ADD UNIQUE KEY `users_username_unique` (`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_access_infos`
--
ALTER TABLE `admin_access_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_records`
--
ALTER TABLE `sms_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
