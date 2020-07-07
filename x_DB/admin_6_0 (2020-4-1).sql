-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2020 at 12:11 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_6_0`
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
  `language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'en',
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `trash` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `admin_role`, `language`, `photo`, `password`, `remember_token`, `status`, `trash`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'super@gmail.com', 'superadmin', 1, 'en', 'public/images/admins/1585631767.jpg', '$2y$10$DdMkrhLc88SI/YkKtyqaP.tsvDkAoDX0wR7Tz6StNihEE5UTS9Jgy', 'SOoyalE8dAxgod2HnyWo0oGvnOWKRXZo7U1hyBppMchdb1XMhpjiIhoTAgxa', 1, 0, '2019-03-25 01:00:00', '2020-04-01 07:45:09', NULL),
(2, 'Admin', 'admin@gmail.com', 'admin', 2, 'en', 'public/images/admins/1585632020.png', '$2y$10$zxGPra1cDNS14Ctvx4OO4.etmnxE/F.oNzwSfbkkegXTOXpeYtK4O', 'o3ZwKUDfqMU4dbl4aCRLu7IhRXIEQcR3bWGJBQPYDg3Lvc3wMznp4ydcxEBi', 1, 0, '2019-03-25 01:00:00', '2020-03-31 05:20:20', NULL),
(3, 'aaaaaa', 'afzalsabbir.bd@gmail.com', 'aaaaaa', 3, 'en', NULL, '$2y$10$P1rFOIiR1hB4IdUDBw/KKenlpz9LK80jAw/IWulwNUXF6hnc90lzu', NULL, 1, 0, '2019-04-25 13:46:07', '2019-04-25 13:46:07', NULL),
(4, 'bbbbbb', 'afzalbd1@gmail.comk', 'bbbbbb', 3, 'en', NULL, '$2y$10$wpvJp1iVMxNM6Tkzn9IRwe6CftljT2xXkj13euFuV.mJorisuC17y', NULL, 1, 0, '2019-04-25 13:47:19', '2019-04-25 13:47:19', NULL),
(5, 'cccccc', 'c@c.c', 'cccccc', 3, 'en', 'public/images/admins/1585076311.jpg', '$2y$10$nvk3FRKAwe.TEz3xbE3kTODbLLOfBoIicK9frDdjW.zwNuC1gwPty', NULL, 1, 0, '2020-03-24 18:58:32', '2020-03-24 18:58:32', NULL);

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
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
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
(51, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 10:08:01', '2020-02-27 10:08:01'),
(52, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 11:46:55', '2020-02-27 11:46:55'),
(53, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 11:52:23', '2020-02-27 11:52:23'),
(54, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 11:53:01', '2020-02-27 11:53:01'),
(55, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 12:02:14', '2020-02-27 12:02:14'),
(56, 3, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 12:24:32', '2020-02-27 12:24:32'),
(57, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 12:24:54', '2020-02-27 12:24:54'),
(58, 4, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 12:25:42', '2020-02-27 12:25:42'),
(59, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-02-27 12:27:50', '2020-02-27 12:27:50'),
(60, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-01 09:40:27', '2020-03-01 09:40:27'),
(61, 2, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-01 10:22:44', '2020-03-01 10:22:44'),
(62, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-01 10:23:01', '2020-03-01 10:23:01'),
(63, 2, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-01 10:27:26', '2020-03-01 10:27:26'),
(64, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-01 10:27:49', '2020-03-01 10:27:49'),
(65, 3, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-01 10:50:52', '2020-03-01 10:50:52'),
(66, 2, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-01 10:51:08', '2020-03-01 10:51:08'),
(67, 4, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-01 10:51:38', '2020-03-01 10:51:38'),
(68, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-03-04 04:54:54', '2020-03-04 04:54:54'),
(69, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-03-04 05:59:51', '2020-03-04 05:59:51'),
(70, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-04 10:41:44', '2020-03-04 10:41:44'),
(71, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-05 02:08:14', '2020-03-05 02:08:14'),
(72, 2, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-05 02:08:39', '2020-03-05 02:08:39'),
(73, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-05 02:11:02', '2020-03-05 02:11:02'),
(74, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-05 07:46:22', '2020-03-05 07:46:22'),
(75, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 05:40:41', '2020-03-07 05:40:41'),
(76, 4, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 05:41:58', '2020-03-07 05:41:58'),
(77, 2, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 05:54:21', '2020-03-07 05:54:21'),
(78, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 05:54:32', '2020-03-07 05:54:32'),
(79, 2, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 05:55:22', '2020-03-07 05:55:22'),
(80, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 05:55:32', '2020-03-07 05:55:32'),
(81, 2, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 05:55:47', '2020-03-07 05:55:47'),
(82, 4, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 05:56:04', '2020-03-07 05:56:04'),
(83, 2, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 05:56:17', '2020-03-07 05:56:17'),
(84, 4, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 06:00:11', '2020-03-07 06:00:11'),
(85, 3, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 06:00:21', '2020-03-07 06:00:21'),
(86, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 06:00:34', '2020-03-07 06:00:34'),
(87, 3, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 06:00:59', '2020-03-07 06:00:59'),
(88, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-07 06:14:21', '2020-03-07 06:14:21'),
(89, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-10 03:29:24', '2020-03-10 03:29:24'),
(90, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-23 15:43:47', '2020-03-23 15:43:47'),
(91, 2, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-23 16:47:06', '2020-03-23 16:47:06'),
(92, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-23 16:54:39', '2020-03-23 16:54:39'),
(93, 2, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-23 16:55:48', '2020-03-23 16:55:48'),
(94, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-23 17:50:45', '2020-03-23 17:50:45'),
(95, 2, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-23 17:59:38', '2020-03-23 17:59:38'),
(96, 3, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-23 18:59:11', '2020-03-23 18:59:11'),
(97, 3, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-23 19:00:46', '2020-03-23 19:00:46'),
(98, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-23 19:01:13', '2020-03-23 19:01:13'),
(99, 2, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-23 19:01:47', '2020-03-23 19:01:47'),
(100, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-23 19:10:46', '2020-03-23 19:10:46'),
(101, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-24 18:36:11', '2020-03-24 18:36:11'),
(102, 5, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-24 19:14:48', '2020-03-24 19:14:48'),
(103, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-24 19:18:33', '2020-03-24 19:18:33'),
(104, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-25 04:34:05', '2020-03-25 04:34:05'),
(105, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-26 04:00:16', '2020-03-26 04:00:16'),
(106, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-26 11:48:37', '2020-03-26 11:48:37'),
(107, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-27 03:08:28', '2020-03-27 03:08:28'),
(108, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-27 18:41:27', '2020-03-27 18:41:27'),
(109, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-28 03:55:59', '2020-03-28 03:55:59'),
(110, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-03-28 11:04:38', '2020-03-28 11:04:38'),
(111, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-28 12:50:35', '2020-03-28 12:50:35'),
(112, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-29 03:16:11', '2020-03-29 03:16:11'),
(113, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-29 09:52:30', '2020-03-29 09:52:30'),
(114, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-29 13:04:42', '2020-03-29 13:04:42'),
(115, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-30 03:25:45', '2020-03-30 03:25:45'),
(116, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-30 14:28:43', '2020-03-30 14:28:43'),
(117, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 02:04:21', '2020-03-31 02:04:21'),
(118, 3, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 05:21:00', '2020-03-31 05:21:00'),
(119, 3, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 05:50:11', '2020-03-31 05:50:11'),
(120, 3, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 05:52:43', '2020-03-31 05:52:43'),
(121, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 06:16:02', '2020-03-31 06:16:02'),
(122, 3, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 06:28:12', '2020-03-31 06:28:12'),
(123, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 06:44:23', '2020-03-31 06:44:23'),
(124, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 06:49:23', '2020-03-31 06:49:23'),
(125, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 07:03:08', '2020-03-31 07:03:08'),
(126, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 07:15:31', '2020-03-31 07:15:31'),
(127, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 07:16:09', '2020-03-31 07:16:09'),
(128, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 07:16:28', '2020-03-31 07:16:28'),
(129, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 07:17:52', '2020-03-31 07:17:52'),
(130, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 07:23:45', '2020-03-31 07:23:45'),
(131, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 07:24:17', '2020-03-31 07:24:17'),
(132, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 08:06:38', '2020-03-31 08:06:38'),
(133, 1, '::1', NULL, 'PC', 'Firefox', 1, '2020-03-31 10:42:34', '2020-03-31 10:42:34'),
(134, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-04-01 01:53:26', '2020-04-01 01:53:26'),
(135, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-04-01 06:32:24', '2020-04-01 06:32:24'),
(136, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-04-01 06:53:19', '2020-04-01 06:53:19'),
(137, 1, '127.0.0.1', NULL, 'PC', 'Firefox', 1, '2020-04-01 07:06:25', '2020-04-01 07:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_bn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `menu_position` int(10) UNSIGNED DEFAULT NULL COMMENT '0 - Sidebar | 1 - In Body | 2 - Right Top | 3 - Right Top In | 4 - Left Top | 5 - Left Top In',
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_color` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#ffffff',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter` text COLLATE utf8mb4_unicode_ci,
  `order` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `trash` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu`, `menu_bn`, `parent_id`, `menu_position`, `icon`, `icon_color`, `url`, `route`, `parameter`, `order`, `status`, `trash`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dashboard', 'ড্যাশবোর্ড', NULL, 0, 'fa fa-dashboard', '#00ff00', '/admin', 'admin.home', NULL, 1, 1, 0, '2019-03-24 23:02:05', '2020-02-27 07:58:49', '2020-03-25 21:44:11'),
(2, 'Menu Permission', 'মেনু পারমিশন', NULL, 0, 'fa fa-diamond', '#ffffff', NULL, NULL, NULL, 900, 1, 0, '2019-03-24 22:44:32', '2019-06-14 23:06:38', '2020-03-25 21:44:11'),
(5, 'Site Settings', 'সাইট সেটিংস', NULL, 0, 'fa fa-sliders', '#ff8000', '/admin/setting', 'admin.setting.index', NULL, 500, 1, 0, '2019-04-10 16:30:44', '2020-02-27 08:01:24', '2020-03-25 21:44:11'),
(6, 'Change Password', 'পাসওয়ার্ড পরিবর্তন', 70, 3, 'fa fa-cog', '#ffffff', '/admin/change-password', 'admin.password.form', NULL, 0, 1, 0, '2019-03-24 22:42:35', '2019-04-23 06:20:29', '2020-03-25 21:44:11'),
(7, 'Log Activity', 'লগ এক্টিভিটি', NULL, 0, 'fa fa-history', '#4f4fff', '/admin/log', 'admin.log.index', NULL, 950, 1, 0, '2019-03-24 22:46:37', '2020-02-27 08:13:38', '2020-03-25 21:44:11'),
(23, 'All Admin', 'সকল এডমিন', 70, 3, 'fa fa-users', '#ffffff', '/admin/all-admin', 'admin.all_admin.index', NULL, 3, 1, 0, '2019-04-10 20:37:34', '2020-03-24 22:07:28', '2020-03-25 21:44:11'),
(24, 'Add Admin', 'এডমিন যোগ করুন', 70, 3, 'fa fa-plus', '#ffffff', '/admin/all-admin/add', 'admin.all_admin.add', NULL, 2, 1, 0, '2019-04-10 20:39:51', '2019-04-10 20:39:51', '2020-03-25 21:44:11'),
(25, 'Action', 'একশন', 23, 0, 'fa fa-home', '#ffffff', '/admin/all-admin', 'admin.all_admin.index', NULL, 1, 1, 0, '2019-04-23 06:27:34', '2019-04-23 06:27:34', '2020-03-25 21:44:11'),
(26, 'Edit', 'এডিট', 25, 1, 'fa fa-pencil', '#ffffff', NULL, 'admin.all_admin.edit', NULL, 1, 1, 0, '2019-04-10 20:40:57', '2019-04-23 06:28:07', '2020-03-25 21:44:11'),
(27, 'Delete', 'ডিলিট', 25, 1, 'fa fa-trash', '#ffffff', NULL, 'admin.all_admin.delete', NULL, 2, 1, 0, '2019-04-10 20:42:59', '2019-04-23 06:28:13', '2020-03-25 21:44:11'),
(28, 'Backup', 'ব্যাকআপ', NULL, 0, 'fa fa-database', '#408080', '/admin/backup', 'admin.backup.index', NULL, 1000, 1, 0, '2019-04-18 21:49:55', '2020-02-27 08:13:53', '2020-03-25 21:44:11'),
(29, 'Action', 'কার্যক্রম', 28, 0, 'fa fa-home', '#ffffff', '/admin/backup', 'admin.backup.index', NULL, 1, 1, 0, '2019-04-18 21:51:23', '2019-04-18 21:54:34', '2020-03-25 21:44:11'),
(30, 'Download', 'ডাউনলোড', 29, 1, 'fa fa-download', '#ffffff', NULL, 'admin.backup.index', NULL, 1, 1, 0, '2019-04-18 21:52:24', '2019-04-18 21:52:24', '2020-03-25 21:44:11'),
(31, 'Delete', 'ডিলিট', 29, 1, 'fa fa-trash', '#ffffff', NULL, 'admin.backup.index', NULL, 2, 1, 0, '2019-04-18 21:52:58', '2019-04-18 21:52:58', '2020-03-25 21:44:11'),
(32, 'SMS', 'এসএমএস', NULL, 0, 'fa fa-envelope', '#ffff80', NULL, NULL, NULL, 499, 1, 0, NULL, '2020-02-27 08:00:51', '2020-03-25 21:44:11'),
(33, 'Send', 'প্রেরন', 32, 0, 'fa fa-commenting', '#479292', '/admin/sms/send', 'admin.sms.send', NULL, 1, 1, 0, NULL, '2020-02-27 12:26:58', '2020-03-25 21:44:11'),
(34, 'Custom', 'কাস্টম', 32, 0, 'fa fa-comment-o', '#ffffff', '/admin/sms/custom', 'admin.sms.custom', NULL, 2, 1, 0, NULL, '2019-06-14 23:01:06', '2020-03-25 21:44:11'),
(35, 'Report', 'প্রতিবেদন', 32, 0, 'fa fa-indent', '#ffff00', '/admin/sms/report', 'admin.sms.report', NULL, 3, 1, 0, NULL, '2020-02-27 08:00:36', '2020-03-25 21:44:11'),
(36, 'Restore', 'রিস্টোর', 29, 1, 'fa fa-upload', '#ffffff', '/admin/backup/restore', 'admin.backup.restore', NULL, 2, 1, 0, '2019-07-02 16:28:12', '2019-07-02 16:28:12', '2020-03-25 21:44:11'),
(61, 'Super Admin', 'সুপার এ্যাডমিন', 2, 0, 'fa fa-user-secret', '#02b502', '/admin/role/assign/super-admin', 'admin.role.assign.super_admin', NULL, 1, 1, 0, '2020-03-01 10:05:56', '2020-03-01 10:10:34', '2020-03-25 21:44:11'),
(62, 'Admin', 'এ্যাডমিন', 2, 0, 'fa fa-user-circle', '#02aaaa', '/admin/role/assign/admin', 'admin.role.assign.admin', NULL, 2, 1, 0, '2020-03-01 10:11:02', '2020-03-01 10:11:02', '2020-03-25 21:44:11'),
(63, 'User', 'ইউজার', 2, 0, 'fa fa-user', '#d0ac00', '/admin/role/assign/user', 'admin.role.assign.user', NULL, 3, 1, 0, '2020-03-01 10:11:57', '2020-03-01 10:11:57', '2020-03-25 21:44:11'),
(64, 'Langunage', 'ভাষা', NULL, 2, 'fa fa-globe', '#00ffff', '/language/{local}', 'language', '[\"bn\"]', 3, 1, 0, '2020-03-24 20:01:41', '2020-03-31 07:27:29', '2020-03-25 21:44:11'),
(65, 'Message', 'বার্তা', NULL, 2, 'fa fa-envelope', '#d2f000', '/admin/message', 'admin.message.index', NULL, 2, 1, 0, '2020-03-24 20:21:13', '2020-03-24 20:21:13', '2020-03-25 21:44:11'),
(66, 'Action', 'অ্যাকশন', 65, 0, 'fa fa-edit', '#d2f000', '/admin/message', 'admin.message.index', NULL, 2, 1, 0, '2020-03-24 20:21:13', '2020-03-24 20:21:13', '2020-03-25 21:44:11'),
(67, 'View', 'দেখা', 66, 1, 'fa fa-eye', '#000000', NULL, 'admin.message.view', NULL, 1, 1, 0, '2020-03-24 20:21:13', '2020-03-24 20:25:38', '2020-03-25 21:44:11'),
(68, 'Send', 'এডিট', 66, 1, 'fa fa-pencil', '#000000', NULL, 'admin.message.send', NULL, 2, 1, 0, '2020-03-24 20:21:13', '2020-03-24 20:24:59', '2020-03-25 21:44:11'),
(69, 'Delete', 'ডিলিট', 66, 1, 'fa fa-trash', '#000000', NULL, 'admin.message.delete', NULL, 3, 1, 0, '2020-03-24 20:21:13', '2020-03-24 20:25:22', '2020-03-25 21:44:11'),
(70, 'Profile', 'প্রোফাইল', NULL, 2, 'fa fa-user-circle', '#ffffff', '', '', NULL, 1, 1, 0, '2020-03-24 22:06:18', '2020-03-24 22:06:18', '2020-03-25 21:44:11'),
(73, 'Visit Home', 'ভিজিট হোম', NULL, 4, 'fa fa-home', '#ffffff', '/', 'home', NULL, 1, 1, 0, '2020-03-25 14:08:25', '2020-03-25 14:08:25', '2020-03-25 21:44:11'),
(74, 'New Backup', 'নতুন ব্যাকআপ', 28, 1, 'fa fa-cart-plus', '#ffffff', '/admin/backup/new', 'admin.backup.new', NULL, 1, 1, 0, '2020-03-26 13:47:12', '2020-03-26 13:47:12', '2020-03-26 13:47:12');

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
(11, '2019_04_10_152516_create_settings_table', 2),
(12, '2018_08_08_100000_create_telescope_entries_table', 3),
(13, '2020_03_31_224429_create_websockets_statistics_entries_table', 4),
(14, '2014_10_12_000000_create_users_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `files` text COLLATE utf8mb4_unicode_ci,
  `admin_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_tag_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[""]',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: Active',
  `trash` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: Deleted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `files`, `admin_id`, `description`, `module_tag_id`, `status`, `trash`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Pagination - Select & Search', NULL, 1, '<!-- \r\nPaste it top of the page\r\n -->\r\n\r\n@php\r\n  // Pagination Serial\r\n  if (request()->filled(\'page\')){\r\n    $PreviousPageLastSN = $items*(request()->page-1); //PreviousPageLastSerialNumber\r\n    $PageNumber = request()->page;\r\n  }\r\n  else{\r\n    $PreviousPageLastSN = 0; //PreviousPageLastSerialNumber\r\n    $PageNumber = 1;\r\n  }\r\n\r\n  //Last Page Items Change Restriction\r\n  if ($PageNumber*$items > $total + $items){\r\n    header(\'Location: \' . $_SERVER[\'HTTP_REFERER\']);\r\n    die();\r\n  }\r\n@endphp\r\n\r\n<div class=\"row custom_pagination\" id=\"pagination_container\" style=\"display: none;\">\r\n  @if ($total>0)\r\n  <div class=\"col-sm-12 col-md-6 pull-right\">\r\n    <label class=\"py-2 m-0\" style=\"float: left;\">{{ \'Showing \'.($PreviousPageLastSN+1).\' to \'}} {{ ($PreviousPageLastSN+$items) >= $total ? $total : $PreviousPageLastSN+$items }}{{\' of \'.$total.\' entries\' }}</label>\r\n  </div>\r\n  @else\r\n  <div class=\"col-sm-12 col-md-12 pull-right\" >\r\n    <h3 class=\"alert alert-warning text-center\" style=\"float: left; color: red; width: 100%;\">{{ __(\'backend/default.no_data\') }}</h3>\r\n  </div>\r\n  @endif\r\n\r\n  <div class=\"col-sm-12 col-md-6 pull-left\">\r\n    @if(isset($where))\r\n      <label style=\"float: right\">{{ $table->appends(\\Request::query())->render() }}</label>\r\n    @else\r\n       <label style=\"float: right\">{{ $table->appends([\'items\' => $items])->links() }}</label>\r\n    @endif\r\n    \r\n  </div>\r\n</div>\r\n\r\n\r\n{{--\r\n  --\r\n  -- Call by >>>\r\n  -- @include(\'frontend.partials.pagination\', [\'table\' => $rows])\r\n  -- `$rows` will be received as `$table`\r\n  --\r\n--}}', '[1,2,14]', 1, 0, '2020-03-27 10:23:00', '2020-03-27 18:53:35', NULL),
(4, 'Pagination - Page Numbering', NULL, 1, '<!--\r\npaste where you need the paging\r\n-->\r\n\r\n<div class=\"custom_pagination col-sm-12 mb-2\" style=\"display: none;\">\r\n  <div class=\"row\">    \r\n    @if(isset($where) && $total > 0)\r\n\r\n      <div class=\"alert alert-success\" style=\"height: 38px; padding: 8px; margin-bottom: 8px;\">\r\n        <span class=\"text-success\">Total <strong>{{ $total }}</strong> entities found</span>\r\n      </div>\r\n\r\n    @elseif(!isset($where))\r\n\r\n      <div class=\"col-md-6 col-sm-12 px-0\">\r\n        <label style=\"display: inline-block;\">Show \r\n        <select class=\"form-control form-control-sm\" style=\"display: inline-block; width: 75px; cursor: pointer;\" select  onchange=\"location = this.value;\">\r\n          <option value=\"{{ route($route) }}?items=20&page=1\" {{ $items == 20 ? \'selected\' : \'\' }}>20</option>\r\n          <option value=\"{{ route($route) }}?items=50&page=1\" {{ $items == 50 ? \'selected\' : \'\' }}>50</option>\r\n          <option value=\"{{ route($route) }}?items=100&page=1\" {{ $items == 100 ? \'selected\' : \'\' }}>100</option>\r\n          <option value=\"{{ route($route) }}?items=250&page=1\" {{ $items == 250 ? \'selected\' : \'\' }}>250</option>\r\n        </select> entries</label>\r\n      </div>\r\n      <div class=\"col-sm-12 col-md-6 px-0 text-right\">\r\n        <label style=\"display: inline-block;\" class=\"w-100\">Search:\r\n          <input id=\"my-table-search\" style=\"display: inline-block; width: 150px;\" type=\"search\" class=\"form-control form-control-sm\" placeholder=\"\" aria-controls=\"datatable\">\r\n        </label>\r\n      </div>\r\n\r\n    @endif\r\n  </div>\r\n</div>', '[1,2,14]', 1, 0, '2020-03-27 10:24:32', '2020-03-27 18:53:21', NULL),
(5, 'Html Form - EMMET', NULL, 1, '<!--\r\n-1- Install `EMMET`.\r\n-2- `Copy` & `Paste` Code in `emmet` installed editor.\r\n-3- Code should be single line. So, put your cursor end of the line & press `TAB`.\r\n[note: `@csrf` included]\r\n-->\r\n\r\n.row>(form[method=\"post\" id=\"\" encrypt=\"multipart/form-data\" class=\"col-sm-12\"]{@csrf}>((.form-row.my-2>lable.col-md-3.text-right.py-2[for]>strong{SomeText}^input.col-md-6.form-control[type=\"text\" name id])*3)+(.form-row.my-2>lable.col-md-3.text-right.py-2[for]>strong{SomeText}^textarea[class=\"col-md-6 form-control\" name id])+(.form-row.my-2>lable.col-md-3.text-right.py-2[for]>strong{SomeText}^input.col-md-6.form-control[type=\"file\" name id])+(.form-row.my-2>((lable.col-md-3.text-right.py-2[for]>strong{SomeText})+select.form-control.col-md-6[name id]>option[value=\"$\"]{Option-$}*3))+(.form-row.my-2>lable.col-md-3.text-right.py-2[for]>strong{SomeText}^(.col-md-6.px-0.text-right>button.btn.btn-success[type=\"submit\"]{Save})))', '[7,8,9,10]', 1, 0, '2020-03-27 13:36:16', '2020-03-27 13:43:26', NULL),
(6, 'Auth pages not getting css in laravel', NULL, 1, 'Step 1:\r\n   > Download nodejs\r\n   > Install nodejs in your pc\r\n\r\nStep 2:\r\n    then open your project root and command\r\n    $ composer require laravel/ui\r\n    $ php artisan ui vue --auth\r\n    $ npm install\r\n    $ npm run dev\r\n\r\n[note: <laravel:6.x>composer require laravel/ui \"^1.0\" --dev]', '[1,11,12,13,14]', 1, 0, '2020-03-27 18:50:22', '2020-03-27 19:48:31', NULL),
(7, 'How to change default Laravel Auth login view?', NULL, 1, 'Add the following method in LoginController.php\r\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\r\n\r\n    public function showLoginForm()\r\n    {\r\n        return view(\'auth.login\');\r\n    }', '[14,1,11,12,15,16,17]', 1, 0, '2020-03-27 19:11:41', '2020-03-27 19:11:41', NULL),
(8, 'Laravel Deployment', NULL, 1, '[Link: https://laravel.com/docs/6.x/deployment]\r\n\r\n$ composer install --optimize-autoloader --no-dev\r\n$ php artisan config:cache\r\n$ php artisan route:cache [//Unable to prepare route [api/user] for serialization. Uses Closure.//]\r\n\r\n[Note: ``anonymous function`` is not allowed in \"routes/*.php\" while \"route:catch\"]', '[1,18,19]', 1, 0, '2020-03-28 16:05:33', '2020-03-28 16:05:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `module_tags`
--

CREATE TABLE `module_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: Active',
  `trash` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: Deleted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_tags`
--

INSERT INTO `module_tags` (`id`, `tag`, `status`, `trash`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'laravel', 1, 0, '2020-03-27 07:30:45', '2020-03-27 07:30:45', '2020-03-26 18:00:00'),
(2, 'pagination', 1, 0, '2020-03-27 07:30:45', '2020-03-27 07:30:45', '2020-03-26 18:00:00'),
(4, 'a', 1, 0, '2020-03-27 09:03:37', '2020-03-27 09:03:37', NULL),
(5, 'b', 1, 0, '2020-03-27 09:03:37', '2020-03-27 09:03:37', NULL),
(6, 'test2', 1, 0, '2020-03-27 11:42:52', '2020-03-27 11:42:52', NULL),
(7, 'emmet', 1, 0, '2020-03-27 13:36:16', '2020-03-27 13:36:16', NULL),
(8, 'form', 1, 0, '2020-03-27 13:36:16', '2020-03-27 13:36:16', NULL),
(9, 'html', 1, 0, '2020-03-27 13:36:16', '2020-03-27 13:36:16', NULL),
(10, 'bootstrap', 1, 0, '2020-03-27 13:43:26', '2020-03-27 13:43:26', NULL),
(11, 'auth', 1, 0, '2020-03-27 18:43:50', '2020-03-27 18:43:50', NULL),
(12, 'css', 1, 0, '2020-03-27 18:43:50', '2020-03-27 18:43:50', NULL),
(13, 'auth-install', 1, 0, '2020-03-27 18:50:22', '2020-03-27 18:50:22', NULL),
(14, 'php', 1, 0, '2020-03-27 18:53:06', '2020-03-27 18:53:06', NULL),
(15, 'auth-style', 1, 0, '2020-03-27 19:11:40', '2020-03-27 19:11:40', NULL),
(16, 'login', 1, 0, '2020-03-27 19:11:40', '2020-03-27 19:11:40', NULL),
(17, '', 1, 0, '2020-03-27 19:11:40', '2020-03-27 19:11:40', NULL),
(18, 'deploy', 1, 0, '2020-03-28 16:05:33', '2020-03-28 16:05:33', NULL),
(19, 'production', 1, 0, '2020-03-28 16:05:33', '2020-03-28 16:05:33', NULL);

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
  `menu` text COLLATE utf8mb4_unicode_ci,
  `sub_menu` text COLLATE utf8mb4_unicode_ci,
  `in_body` text COLLATE utf8mb4_unicode_ci,
  `inner_in_body` text COLLATE utf8mb4_unicode_ci,
  `admin_id` int(10) DEFAULT NULL,
  `role` tinyint(3) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `trash` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `menu`, `sub_menu`, `in_body`, `inner_in_body`, `admin_id`, `role`, `status`, `trash`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '[\"73\",\"70\",\"1\",\"65\",\"64\",\"32\",\"2\",\"5\",\"28\",\"7\"]', '[\"6\",\"61\",\"62\",\"29\",\"23\",\"33\",\"74\",\"35\",\"24\",\"66\",\"34\",\"63\"]', '[\"25\",\"67\",\"30\",\"36\",\"69\",\"68\",\"31\"]', '[\"26\",\"27\"]', 1, 1, 1, 0, '2019-04-25 22:41:31', '2020-03-31 16:07:14', NULL),
(2, '[\"1\",\"2\"]', '[\"63\"]', 'null', NULL, 2, 2, 1, 0, '2019-04-26 01:33:19', '2020-03-23 18:15:18', NULL),
(20, '[\"1\"]', 'null', 'null', 'null', 3, 3, 1, 0, '2020-03-23 18:57:40', '2020-03-31 06:27:50', NULL),
(21, NULL, NULL, NULL, NULL, 4, 3, 1, 0, '2020-03-24 18:57:29', '2020-03-24 18:57:29', NULL),
(22, '[\"73\",\"64\",\"1\",\"65\",\"32\",\"5\",\"2\",\"28\",\"70\",\"7\"]', '[\"29\",\"23\",\"61\",\"33\",\"66\",\"63\",\"62\",\"34\",\"35\"]', '[\"30\",\"67\",\"25\",\"36\",\"31\",\"68\",\"6\",\"24\",\"69\"]', '[\"26\",\"27\"]', 5, 3, 1, 0, '2020-03-24 18:58:42', '2020-03-25 14:32:12', NULL),
(23, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, NULL);

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
  `color_scheme_id` tinyint(3) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `custom_scroll` tinyint(1) NOT NULL DEFAULT '1',
  `show_user_data` tinyint(1) DEFAULT '1',
  `show_background_image` tinyint(1) DEFAULT '0',
  `show_dev_menu` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `favicon`, `title_en`, `title_bn`, `color_scheme_id`, `email`, `mobile`, `facebook`, `twitter`, `youtube`, `linkedin`, `address`, `status`, `created_at`, `updated_at`, `custom_scroll`, `show_user_data`, `show_background_image`, `show_dev_menu`) VALUES
(1, 'public/images/settings/logo-1556222447.png', 'public/images/settings/favicon-1556222459.png', 'laravel 6.0', 'লারাভেল ৬.০', 1, 'superadmin@Restaurent-Bill.com', '01234567890', 'facebook', 'twitter', 'youtube', 'linkedin', 'City: Mymensingh\r\nCountry: Bangladesh\r\nState: Mymensingh Division\r\nZipcode: 2200', 1, '2019-04-10 06:00:00.000000', '2020-04-01 07:45:53.000000', 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_records`
--

CREATE TABLE `sms_records` (
  `id` int(11) NOT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `sms` longtext COLLATE utf8_unicode_ci,
  `sending_date` date DEFAULT NULL,
  `sms_count` tinyint(3) DEFAULT '1',
  `send_by` int(11) DEFAULT NULL,
  `is_send` tinyint(1) DEFAULT '1'
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
-- Table structure for table `telescope_entries`
--

CREATE TABLE `telescope_entries` (
  `sequence` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `telescope_entries`
--

INSERT INTO `telescope_entries` (`sequence`, `uuid`, `batch_id`, `family_hash`, `should_display_on_index`, `type`, `content`, `created_at`) VALUES
(1, '9038c9a1-f157-4e6d-8bfd-8985bbf6cad7', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `admins` where `id` = 1 limit 1\",\"time\":\"10.23\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Http\\\\Middleware\\\\AdminAuthenticate.php\",\"line\":19,\"hash\":\"7f9f4d7e04190956dac445c21d68a2d2\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:14'),
(2, '9038c9a3-7b09-4031-991d-186d68d11385', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'view', '{\"name\":\"backend.pages.backup.index\",\"path\":\"\\\\resources\\\\views\\/backend\\/pages\\/backup\\/index.blade.php\",\"data\":[\"dircontents\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:15'),
(3, '9038c9a4-09b3-4d24-bcd8-dbd6f7ebb9c4', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `url` = \'admin\\/backup\' or `url` = \'\\/admin\\/backup\' order by `id` desc limit 1\",\"time\":\"2.58\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\81ff68298cdab3b643b30798995904e20a2c1953.php\",\"line\":17,\"hash\":\"4993ef070b7ee85d83e5f7f0df0626a0\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:15'),
(4, '9038c9a4-0ba3-475e-bb5d-5bb15b42f423', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `roles` where `role` = 1 limit 1\",\"time\":\"0.82\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\81ff68298cdab3b643b30798995904e20a2c1953.php\",\"line\":23,\"hash\":\"0264762935bec6b56f22c1ca45fe1cbd\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:15'),
(5, '9038c9a4-2887-4d69-9d66-c197c4a9bac7', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `route` = \'admin.backup.index\' limit 1\",\"time\":\"0.92\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Helpers\\\\ModuleHelper.php\",\"line\":91,\"hash\":\"85aa3b68ad6b3ebb48a19963d2be6e8b\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:15'),
(6, '9038c9a4-29d5-4c86-a401-09e54d1efea6', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `status` = \'1\' order by `order` desc\",\"time\":\"1.49\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Helpers\\\\ModuleHelper.php\",\"line\":18,\"hash\":\"742e3892b6fca7874df28f5f367535b9\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:15'),
(7, '9038c9a4-dc20-4229-a450-6f33269b9a9a', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 29 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.88\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\81ff68298cdab3b643b30798995904e20a2c1953.php\",\"line\":98,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:15'),
(8, '9038c9a4-fb4e-4740-825b-3d4cb1efd643', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'view', '{\"name\":\"backend.layouts.master\",\"path\":\"\\\\resources\\\\views\\/backend\\/layouts\\/master.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(9, '9038c9a5-0669-4bda-bbaa-0499684cae1b', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `settings` limit 1\",\"time\":\"0.88\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\6005f45ec09702358e51c6c85bc0936f299bcdb2.php\",\"line\":13,\"hash\":\"fa0ff947d644db0afa39e9f3fd6a5cf9\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(10, '9038c9a5-0dea-40e9-8586-a1fc3e82ada7', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'view', '{\"name\":\"backend.partials.styles\",\"path\":\"\\\\resources\\\\views\\/backend\\/partials\\/styles.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(11, '9038c9a5-8e02-4e3c-8d3c-32717fcb77e7', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'view', '{\"name\":\"backend.partials.permission\",\"path\":\"\\\\resources\\\\views\\/backend\\/partials\\/permission.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(12, '9038c9a5-9882-4aa6-937a-6989130cfc5f', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `route` = \'admin.backup.index\' and `status` = 1 and `parent_id` is null and `menu_position` = 0\",\"time\":\"0.92\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\665d9ca9a198f6ce890cdc5dda6824f83686d625.php\",\"line\":13,\"hash\":\"2dee274302c07a81d257a6c8a5bcf687\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(13, '9038c9a5-99a8-4ef4-ad87-fd8874e51a1d', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `route` = \'admin.backup.index\' and `status` = 1 and `parent_id` is not null and `menu_position` = 0\",\"time\":\"1.24\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\665d9ca9a198f6ce890cdc5dda6824f83686d625.php\",\"line\":14,\"hash\":\"1440ad61d100d87a3c453ca0537e1ee3\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(14, '9038c9a5-9a9a-4568-8a60-9a8c4be06f6c', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `route` = \'admin.backup.index\' and `status` = 1 and `parent_id` is not null and `menu_position` = 1\",\"time\":\"0.83\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\665d9ca9a198f6ce890cdc5dda6824f83686d625.php\",\"line\":15,\"hash\":\"1440ad61d100d87a3c453ca0537e1ee3\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(15, '9038c9a5-9b91-46a2-b7cd-9f0f5b1ac55d', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `route` = \'admin.backup.index\' and `status` = 1 and `parent_id` is not null and `menu_position` = 2\",\"time\":\"0.72\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\665d9ca9a198f6ce890cdc5dda6824f83686d625.php\",\"line\":16,\"hash\":\"1440ad61d100d87a3c453ca0537e1ee3\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(16, '9038c9a5-a11c-41b1-bdcb-357af5d541e7', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'view', '{\"name\":\"backend.partials.nav\",\"path\":\"\\\\resources\\\\views\\/backend\\/partials\\/nav.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(17, '9038c9a5-d80b-492a-b466-1845f7c1f142', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `status` = \'1\' order by `order` desc\",\"time\":\"1.45\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Helpers\\\\ModuleHelper.php\",\"line\":18,\"hash\":\"742e3892b6fca7874df28f5f367535b9\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(18, '9038c9a5-dc5c-48d7-8017-e13d2d1f980c', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `status` = \'1\' order by `order` desc\",\"time\":\"1.57\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Helpers\\\\ModuleHelper.php\",\"line\":18,\"hash\":\"742e3892b6fca7874df28f5f367535b9\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(19, '9038c9a5-e058-47b0-b8bf-93ecee521e0e', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `roles` where `role` = 1 limit 1\",\"time\":\"1.29\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\cc7dcc3ff0a53fd56977f2786610acedc1c8b00e.php\",\"line\":13,\"hash\":\"0264762935bec6b56f22c1ca45fe1cbd\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(20, '9038c9a5-e60e-4fc4-9472-3e472e84c296', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'view', '{\"name\":\"backend.partials.sidebar\",\"path\":\"\\\\resources\\\\views\\/backend\\/partials\\/sidebar.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(21, '9038c9a6-74c2-4ef5-81db-45c76f395cfa', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'view', '{\"name\":\"backend.pages.root.Importants.developer\",\"path\":\"\\\\resources\\\\views\\/backend\\/pages\\/root\\/Importants\\/developer.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:16'),
(22, '9038c9a7-1cce-4012-bd3e-083c5979bfff', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `roles` where `role` = 1 and `admin_id` = 1 limit 1\",\"time\":\"2.02\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":22,\"hash\":\"e3d79f78cd332c1957021b2e6f1bf5f9\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(23, '9038c9a7-1e2c-497c-8756-ee6cbc9612ee', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select `id`, `order` from `menus` where `status` = 1 and `parent_id` is null and `menu_position` = 0\",\"time\":\"1.32\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":24,\"hash\":\"ce0eddbcd8c3b5827a644d17a547f9ac\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(24, '9038c9a7-216d-4395-b7b4-4837c2eb103e', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`id` = 1 limit 1\",\"time\":\"5.69\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Models\\\\Menu.php\",\"line\":24,\"hash\":\"632b227cccf3260ea4126b15f9ef8516\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(25, '9038c9a7-2282-4eb3-8356-83687c2306e6', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 1 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.95\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":62,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(26, '9038c9a7-2376-462e-b7fe-5159f4a978bc', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`id` = 32 limit 1\",\"time\":\"0.82\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Models\\\\Menu.php\",\"line\":24,\"hash\":\"632b227cccf3260ea4126b15f9ef8516\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(27, '9038c9a7-246a-4886-8a5f-2c383f328282', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 32 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.91\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":62,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(28, '9038c9a7-2589-43c0-8534-71a9dbcc42c3', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 33 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"1.03\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":94,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(29, '9038c9a7-2785-4275-858a-f047b4e380cb', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 34 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"1.86\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":94,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(30, '9038c9a7-2877-4bee-9596-dc3029ab3e90', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 35 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.88\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":94,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(31, '9038c9a7-2997-49a3-8ffc-60bb4d4efd53', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`id` = 5 limit 1\",\"time\":\"0.72\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Models\\\\Menu.php\",\"line\":24,\"hash\":\"632b227cccf3260ea4126b15f9ef8516\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(32, '9038c9a7-2a72-4098-a161-40617500b642', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 5 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.74\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":62,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(33, '9038c9a7-2b65-48d3-ba43-5180825d23b7', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`id` = 2 limit 1\",\"time\":\"0.76\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Models\\\\Menu.php\",\"line\":24,\"hash\":\"632b227cccf3260ea4126b15f9ef8516\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(34, '9038c9a7-2c8c-40a4-aafe-8f88ed216647', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 2 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"1.23\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":62,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(35, '9038c9a7-2e1a-4c7d-b611-8044920b38ac', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 61 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.94\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":94,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(36, '9038c9a7-2f02-4b73-b99d-fd8e66a789bb', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 62 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.76\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":94,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(37, '9038c9a7-2fc7-4556-a0b5-a76ac87ed401', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 63 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.65\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":94,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(38, '9038c9a7-30bc-485d-a8c7-6f4f22359d92', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`id` = 7 limit 1\",\"time\":\"0.63\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Models\\\\Menu.php\",\"line\":24,\"hash\":\"632b227cccf3260ea4126b15f9ef8516\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(39, '9038c9a7-31a1-40fd-8b85-3ca25c95dd8e', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 7 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.80\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":62,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(40, '9038c9a7-32a5-40e5-b0a4-99b4a2ff9a7b', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`id` = 28 limit 1\",\"time\":\"1.21\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Models\\\\Menu.php\",\"line\":24,\"hash\":\"632b227cccf3260ea4126b15f9ef8516\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(41, '9038c9a7-33bc-4d95-b5b7-739309772d18', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 28 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"1.42\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":62,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(42, '9038c9a7-34dc-4af7-b860-38a844ef0bc4', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 29 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"1.38\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":80,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(43, '9038c9a7-35d0-44be-82b5-afd02e27704d', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 74 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.90\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":80,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(44, '9038c9a7-3661-4475-8308-373e20cf6bb8', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'view', '{\"name\":\"backend.partials.message\",\"path\":\"\\\\resources\\\\views\\/backend\\/partials\\/message.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(45, '9038c9a7-a329-4172-811a-7c85f0c92f55', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'view', '{\"name\":\"backend.partials.scripts\",\"path\":\"\\\\resources\\\\views\\/backend\\/partials\\/scripts.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(46, '9038c9a8-02c7-4763-bcbc-d374df9e9650', '9038c9a8-03c1-4484-b6db-a32f78fc9f61', NULL, 1, 'request', '{\"uri\":\"\\/admin\\/backup\",\"method\":\"GET\",\"controller_action\":\"App\\\\Http\\\\Controllers\\\\Backend\\\\BackupController@index\",\"middleware\":[\"web\",\"admin\"],\"headers\":{\"host\":\"localhost\",\"user-agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko\\/20100101 Firefox\\/74.0\",\"accept\":\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,*\\/*;q=0.8\",\"accept-language\":\"en-US,en;q=0.5\",\"accept-encoding\":\"gzip, deflate\",\"dnt\":\"1\",\"connection\":\"keep-alive\",\"cookie\":\"XSRF-TOKEN=eyJpdiI6ImQ5MTRPRXp4RkhzellmNER2UnZYd0E9PSIsInZhbHVlIjoiOExjY3NiNDBueU5Udjh1S2g0XC9VTDd0YW8razJEVmJPXC95MnNLWmpWMzNtMVk1dExqUlBBWktvV2xoem1BRVBVIiwibWFjIjoiYzEzMDdmNjc3ODE3NjE5MTgyOTM5OGM4YmJkYTg2OTY2ODM4YmVhZmQ0ZDdmMTU3NTBkNGViMWZlZWIzOTM1NyJ9; admin_60_session=eyJpdiI6Ikc2Z0NvMXo1QzR2VnB3dmtnU0d1alE9PSIsInZhbHVlIjoiWWlQc013WkdJdWJvK0tZblwvNlhydXNpeitnalwvSUFGczZQeVU1RkwwWXd4ZzlwTGlNYWlmUGtwQjI4TW9OZ0hUIiwibWFjIjoiNTk2Y2RhYTVkYmQxNmFkMWU4MDY5MjE1MTA3OWUzMjU1MTc2NjM3YzE0OTZhMTM0MWVlNmJiM2E3OTkzZTMzOSJ9\",\"upgrade-insecure-requests\":\"1\"},\"payload\":[],\"session\":{\"_token\":\"wcpT6icfi4OTGR35AqLXAKfTE0pYNCke3e2pkq5W\",\"_flash\":{\"old\":[],\"new\":[]},\"_previous\":{\"url\":\"http:\\/\\/localhost\\/admin_6-0\\/admin\\/backup\"},\"url\":[],\"locale\":\"en\",\"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\":1,\"login_admin_59ba36addc2b2f9401580f014c7f58ea4e30989d\":1},\"response_status\":200,\"response\":{\"view\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\resources\\\\views\\/backend\\/pages\\/backup\\/index.blade.php\",\"data\":{\"dircontents\":[\"mysql-admin_6_0.sql\",\"2020-04-01-16-00-29.zip\",\"2020-03-31-16-37-12.zip\",\"2020-03-28-21-25-36.zip\",\"2020-03-27-17-51-11.zip\",\"2020-03-26-19-54-08.zip\",\"2020-03-26-04-23-56.zip\",\"2020-03-07-11-54-41.zip\",\"2020-03-04-13-59-44.zip\",\"2020-03-04-12-14-40.zip\",\"2020-03-04-11-59-59.zip\",\"2020-03-01-15-59-24.zip\",\"2020-02-27-18-29-07.zip\",\"2020-02-27-12-17-26.zip\",\"..\",\".\"]}},\"duration\":29833,\"memory\":14,\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:17'),
(47, '9038c9b9-82f1-44ea-afed-72d031ba9bfc', '9038c9b9-e7d7-47b7-b800-bd54960d2e64', NULL, 1, 'view', '{\"name\":\"errors::404\",\"path\":\"\\\\resources\\\\views\\/errors\\/404.blade.php\",\"data\":[\"exception\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:29'),
(48, '9038c9b9-c9ae-468b-bb3b-47df6134c1df', '9038c9b9-e7d7-47b7-b800-bd54960d2e64', NULL, 1, 'view', '{\"name\":\"errors.minimal\",\"path\":\"\\\\resources\\\\views\\/errors\\/minimal.blade.php\",\"data\":[\"exception\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:29'),
(49, '9038c9b9-e6f8-430c-b0e2-c6d62b7e0437', '9038c9b9-e7d7-47b7-b800-bd54960d2e64', NULL, 1, 'request', '{\"uri\":\"\\/css\\/Inconsolata.css\",\"method\":\"GET\",\"controller_action\":null,\"middleware\":[],\"headers\":{\"host\":\"localhost\",\"user-agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko\\/20100101 Firefox\\/74.0\",\"accept\":\"text\\/css,*\\/*;q=0.1\",\"accept-language\":\"en-US,en;q=0.5\",\"accept-encoding\":\"gzip, deflate\",\"dnt\":\"1\",\"connection\":\"keep-alive\",\"referer\":\"http:\\/\\/localhost\\/admin_6-0\\/admin\\/backup\",\"cookie\":\"XSRF-TOKEN=eyJpdiI6IkJWdzQ5VDVZRFQyS1hcL1dHMG1QY0tBPT0iLCJ2YWx1ZSI6IldQNzlRNDlSSTBTbFwveWxwUm1oekZ3WlVoUzdVTGJmY2Exb2VmRVdpMmpCVGRteVJ4Q0ljclZENkJDRlQxU0s2IiwibWFjIjoiZjZhM2QyYTMzZjc5MjVlNTRmMzJmMmQ1OTRhNjA3NTU5M2VlMTRiZDA4ZjQ0MDIyNGNmNzg1MjQxODk4MTgxNiJ9; admin_60_session=eyJpdiI6Ikc2TDkyVXI2UlRqSGFmRDNtWHNyakE9PSIsInZhbHVlIjoiWis5SitTNTRHSlZYZm1EbDZyd1c4XC9MczRXcllETU9pQlNiOWJyNk0wUGhUXC80VEc2UzZTQjlxUVh1NmdxTGpmIiwibWFjIjoiNGEzZTY2YzY0Mzk4NmU4MTMwMWUyZjQ3MTNhNmE2ZmNhNWFiZDU5Y2RkZDkwNjkxZWNiZTY3MTdkYjVmYTk4NyJ9\"},\"payload\":[],\"session\":[],\"response_status\":404,\"response\":\"HTML Response\",\"duration\":2826,\"memory\":18,\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:29'),
(50, '9038c9ce-4615-49ae-883f-6e0c8a6e9b47', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `admins` where `id` = 1 limit 1\",\"time\":\"0.94\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Http\\\\Middleware\\\\AdminAuthenticate.php\",\"line\":19,\"hash\":\"7f9f4d7e04190956dac445c21d68a2d2\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(51, '9038c9ce-6360-413a-9ca4-ec3dc61a2f2b', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'view', '{\"name\":\"backend.pages.backup.index\",\"path\":\"\\\\resources\\\\views\\/backend\\/pages\\/backup\\/index.blade.php\",\"data\":[\"dircontents\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(52, '9038c9ce-686d-45bd-ad03-58adf4f4f3fd', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `url` = \'admin\\/backup\' or `url` = \'\\/admin\\/backup\' order by `id` desc limit 1\",\"time\":\"0.88\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\81ff68298cdab3b643b30798995904e20a2c1953.php\",\"line\":17,\"hash\":\"4993ef070b7ee85d83e5f7f0df0626a0\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(53, '9038c9ce-698e-4d7b-aa07-fd80d95b20af', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `roles` where `role` = 1 limit 1\",\"time\":\"0.77\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\81ff68298cdab3b643b30798995904e20a2c1953.php\",\"line\":23,\"hash\":\"0264762935bec6b56f22c1ca45fe1cbd\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(54, '9038c9ce-6ac0-40a4-85c1-ee46071c880f', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `route` = \'admin.backup.index\' limit 1\",\"time\":\"0.79\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Helpers\\\\ModuleHelper.php\",\"line\":91,\"hash\":\"85aa3b68ad6b3ebb48a19963d2be6e8b\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(55, '9038c9ce-6c65-4e1c-8231-aba58d357ec6', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `status` = \'1\' order by `order` desc\",\"time\":\"1.43\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Helpers\\\\ModuleHelper.php\",\"line\":18,\"hash\":\"742e3892b6fca7874df28f5f367535b9\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(56, '9038c9ce-7b98-4e59-a9e5-d5cda9a7419e', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 29 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"1.06\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\81ff68298cdab3b643b30798995904e20a2c1953.php\",\"line\":98,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(57, '9038c9ce-80c2-4e72-a303-3b1dcc2c9cb7', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'view', '{\"name\":\"backend.layouts.master\",\"path\":\"\\\\resources\\\\views\\/backend\\/layouts\\/master.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(58, '9038c9ce-8205-41b6-bf63-93aeecbc7ed7', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `settings` limit 1\",\"time\":\"0.75\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\6005f45ec09702358e51c6c85bc0936f299bcdb2.php\",\"line\":13,\"hash\":\"fa0ff947d644db0afa39e9f3fd6a5cf9\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(59, '9038c9ce-82c0-482e-b91d-e65d45fa0432', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'view', '{\"name\":\"backend.partials.styles\",\"path\":\"\\\\resources\\\\views\\/backend\\/partials\\/styles.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(60, '9038c9ce-8380-4411-94d4-075c072b2d12', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'view', '{\"name\":\"backend.partials.permission\",\"path\":\"\\\\resources\\\\views\\/backend\\/partials\\/permission.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(61, '9038c9ce-84a5-4172-bf56-417240f95d40', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `route` = \'admin.backup.index\' and `status` = 1 and `parent_id` is null and `menu_position` = 0\",\"time\":\"0.92\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\665d9ca9a198f6ce890cdc5dda6824f83686d625.php\",\"line\":13,\"hash\":\"2dee274302c07a81d257a6c8a5bcf687\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(62, '9038c9ce-85c4-423d-a4a7-0e511ec6b621', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `route` = \'admin.backup.index\' and `status` = 1 and `parent_id` is not null and `menu_position` = 0\",\"time\":\"0.84\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\665d9ca9a198f6ce890cdc5dda6824f83686d625.php\",\"line\":14,\"hash\":\"1440ad61d100d87a3c453ca0537e1ee3\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(63, '9038c9ce-86af-434c-bbd2-cea6eb722f40', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `route` = \'admin.backup.index\' and `status` = 1 and `parent_id` is not null and `menu_position` = 1\",\"time\":\"0.89\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\665d9ca9a198f6ce890cdc5dda6824f83686d625.php\",\"line\":15,\"hash\":\"1440ad61d100d87a3c453ca0537e1ee3\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(64, '9038c9ce-87b2-4e89-b243-b330f247e34a', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `route` = \'admin.backup.index\' and `status` = 1 and `parent_id` is not null and `menu_position` = 2\",\"time\":\"0.96\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\665d9ca9a198f6ce890cdc5dda6824f83686d625.php\",\"line\":16,\"hash\":\"1440ad61d100d87a3c453ca0537e1ee3\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(65, '9038c9ce-883c-483e-9f81-2ca89ee2ab96', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'view', '{\"name\":\"backend.partials.nav\",\"path\":\"\\\\resources\\\\views\\/backend\\/partials\\/nav.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(66, '9038c9ce-89a0-4a97-9e22-8e07fc42ed98', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `status` = \'1\' order by `order` desc\",\"time\":\"1.33\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Helpers\\\\ModuleHelper.php\",\"line\":18,\"hash\":\"742e3892b6fca7874df28f5f367535b9\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(67, '9038c9ce-8d68-4f2a-b99f-3f096ba64d4a', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `status` = \'1\' order by `order` desc\",\"time\":\"1.33\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Helpers\\\\ModuleHelper.php\",\"line\":18,\"hash\":\"742e3892b6fca7874df28f5f367535b9\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(68, '9038c9ce-90ca-463d-8378-f9c17d6990f5', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `roles` where `role` = 1 limit 1\",\"time\":\"0.78\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\cc7dcc3ff0a53fd56977f2786610acedc1c8b00e.php\",\"line\":13,\"hash\":\"0264762935bec6b56f22c1ca45fe1cbd\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(69, '9038c9ce-91b6-4720-8891-d8f61f8902cc', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'view', '{\"name\":\"backend.partials.sidebar\",\"path\":\"\\\\resources\\\\views\\/backend\\/partials\\/sidebar.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(70, '9038c9ce-92ed-4c82-8c3c-1641fe8e47cd', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'view', '{\"name\":\"backend.pages.root.Importants.developer\",\"path\":\"\\\\resources\\\\views\\/backend\\/pages\\/root\\/Importants\\/developer.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(71, '9038c9ce-94ea-4e1b-9d63-acb5efc67d92', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `roles` where `role` = 1 and `admin_id` = 1 limit 1\",\"time\":\"1.81\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":22,\"hash\":\"e3d79f78cd332c1957021b2e6f1bf5f9\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(72, '9038c9ce-95b2-439a-a5ae-64c05d8e441d', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select `id`, `order` from `menus` where `status` = 1 and `parent_id` is null and `menu_position` = 0\",\"time\":\"0.78\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":24,\"hash\":\"ce0eddbcd8c3b5827a644d17a547f9ac\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(73, '9038c9ce-96c5-4b49-94e7-3ba736cc55c7', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`id` = 1 limit 1\",\"time\":\"1.10\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Models\\\\Menu.php\",\"line\":24,\"hash\":\"632b227cccf3260ea4126b15f9ef8516\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(74, '9038c9ce-9792-4f46-b427-e6512d932615', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 1 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.77\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":62,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(75, '9038c9ce-985e-4c33-bf14-76e3722c7f4e', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`id` = 32 limit 1\",\"time\":\"0.72\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Models\\\\Menu.php\",\"line\":24,\"hash\":\"632b227cccf3260ea4126b15f9ef8516\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(76, '9038c9ce-998c-4cd7-9ee2-2f28e88ed86d', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 32 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"1.17\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":62,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(77, '9038c9ce-9a62-48a8-b21d-1dbdccbfb333', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 33 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.70\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":94,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(78, '9038c9ce-9b2d-4539-91b0-ca74f5c4070c', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 34 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.69\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":94,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(79, '9038c9ce-9bec-4642-bbf8-c17966050360', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 35 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.63\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":94,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(80, '9038c9ce-9cf6-47a9-9e9b-f352f24dccd2', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`id` = 5 limit 1\",\"time\":\"0.68\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Models\\\\Menu.php\",\"line\":24,\"hash\":\"632b227cccf3260ea4126b15f9ef8516\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(81, '9038c9ce-9db3-44c2-8333-89f8dfd9b2b8', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 5 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.63\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":62,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(82, '9038c9ce-9e83-4acb-890c-961e20926a96', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`id` = 2 limit 1\",\"time\":\"0.64\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Models\\\\Menu.php\",\"line\":24,\"hash\":\"632b227cccf3260ea4126b15f9ef8516\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(83, '9038c9ce-9f84-4267-ad00-185c2f00614d', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 2 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"1.31\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":62,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(84, '9038c9ce-a05f-4ee2-97ef-bcd72810d7a3', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 61 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.73\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":94,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(85, '9038c9ce-a11f-462b-b936-070dbe0caa5b', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 62 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.65\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":94,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(86, '9038c9ce-a1df-42f5-9d3d-fe360e7ee2d9', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 63 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.63\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":94,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(87, '9038c9ce-a32a-4418-9e74-607f21702fcd', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`id` = 7 limit 1\",\"time\":\"0.66\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Models\\\\Menu.php\",\"line\":24,\"hash\":\"632b227cccf3260ea4126b15f9ef8516\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(88, '9038c9ce-a3f4-444b-b434-4362bbdcec81', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 7 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.73\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":62,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(89, '9038c9ce-a4c0-44ae-989f-6bb941162ea3', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`id` = 28 limit 1\",\"time\":\"0.66\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\app\\\\Models\\\\Menu.php\",\"line\":24,\"hash\":\"632b227cccf3260ea4126b15f9ef8516\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(90, '9038c9ce-a580-491d-9af3-68a6dc92a5ba', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 28 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.70\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":62,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(91, '9038c9ce-a6c2-4513-b3a0-27b42865e217', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 29 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"1.08\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":80,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(92, '9038c9ce-a7d1-4b27-a2df-c44e44289f4d', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'query', '{\"connection\":\"mysql\",\"bindings\":[],\"sql\":\"select * from `menus` where `menus`.`parent_id` = 74 and `menus`.`parent_id` is not null order by `order` asc\",\"time\":\"0.82\",\"slow\":false,\"file\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\storage\\\\framework\\\\views\\\\79de18b982d934605e22c577529d49bfb80747a6.php\",\"line\":80,\"hash\":\"8edef423943dfe1adebea89f11e5e692\",\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43');
INSERT INTO `telescope_entries` (`sequence`, `uuid`, `batch_id`, `family_hash`, `should_display_on_index`, `type`, `content`, `created_at`) VALUES
(93, '9038c9ce-a873-483a-ac34-b9820d8e8960', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'view', '{\"name\":\"backend.partials.message\",\"path\":\"\\\\resources\\\\views\\/backend\\/partials\\/message.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(94, '9038c9ce-a9ee-4a4f-8ecf-dd154f6046cd', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'view', '{\"name\":\"backend.partials.scripts\",\"path\":\"\\\\resources\\\\views\\/backend\\/partials\\/scripts.blade.php\",\"data\":[\"dircontents\",\"permissions\",\"myRole\",\"thisRoute\",\"sub_menu_by_route\",\"thisSubMenus\",\"mySubMenus\",\"__currentLoopData\",\"thisSubMenu\",\"loop\",\"i\",\"file\",\"this_file_size\",\"extension\",\"fileName\",\"permission\",\"key\",\"site_setting\",\"role_name\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(95, '9038c9ce-acb5-4e4a-b439-fc96a9f87441', '9038c9ce-ad70-4f32-8650-0912f2b1d32c', NULL, 1, 'request', '{\"uri\":\"\\/admin\\/backup\",\"method\":\"GET\",\"controller_action\":\"App\\\\Http\\\\Controllers\\\\Backend\\\\BackupController@index\",\"middleware\":[\"web\",\"admin\"],\"headers\":{\"host\":\"localhost\",\"user-agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko\\/20100101 Firefox\\/74.0\",\"accept\":\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,*\\/*;q=0.8\",\"accept-language\":\"en-US,en;q=0.5\",\"accept-encoding\":\"gzip, deflate\",\"dnt\":\"1\",\"connection\":\"keep-alive\",\"cookie\":\"XSRF-TOKEN=eyJpdiI6IkJWdzQ5VDVZRFQyS1hcL1dHMG1QY0tBPT0iLCJ2YWx1ZSI6IldQNzlRNDlSSTBTbFwveWxwUm1oekZ3WlVoUzdVTGJmY2Exb2VmRVdpMmpCVGRteVJ4Q0ljclZENkJDRlQxU0s2IiwibWFjIjoiZjZhM2QyYTMzZjc5MjVlNTRmMzJmMmQ1OTRhNjA3NTU5M2VlMTRiZDA4ZjQ0MDIyNGNmNzg1MjQxODk4MTgxNiJ9; admin_60_session=eyJpdiI6Ikc2TDkyVXI2UlRqSGFmRDNtWHNyakE9PSIsInZhbHVlIjoiWis5SitTNTRHSlZYZm1EbDZyd1c4XC9MczRXcllETU9pQlNiOWJyNk0wUGhUXC80VEc2UzZTQjlxUVh1NmdxTGpmIiwibWFjIjoiNGEzZTY2YzY0Mzk4NmU4MTMwMWUyZjQ3MTNhNmE2ZmNhNWFiZDU5Y2RkZDkwNjkxZWNiZTY3MTdkYjVmYTk4NyJ9\",\"upgrade-insecure-requests\":\"1\"},\"payload\":[],\"session\":{\"_token\":\"wcpT6icfi4OTGR35AqLXAKfTE0pYNCke3e2pkq5W\",\"_flash\":{\"old\":[],\"new\":[]},\"_previous\":{\"url\":\"http:\\/\\/localhost\\/admin_6-0\\/admin\\/backup\"},\"url\":[],\"locale\":\"en\",\"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\":1,\"login_admin_59ba36addc2b2f9401580f014c7f58ea4e30989d\":1},\"response_status\":200,\"response\":{\"view\":\"C:\\\\xampp\\\\htdocs\\\\admin_6-0\\\\resources\\\\views\\/backend\\/pages\\/backup\\/index.blade.php\",\"data\":{\"dircontents\":[\"mysql-admin_6_0.sql\",\"2020-04-01-16-00-29.zip\",\"2020-03-31-16-37-12.zip\",\"2020-03-28-21-25-36.zip\",\"2020-03-27-17-51-11.zip\",\"2020-03-26-19-54-08.zip\",\"2020-03-26-04-23-56.zip\",\"2020-03-07-11-54-41.zip\",\"2020-03-04-13-59-44.zip\",\"2020-03-04-12-14-40.zip\",\"2020-03-04-11-59-59.zip\",\"2020-03-01-15-59-24.zip\",\"2020-02-27-18-29-07.zip\",\"2020-02-27-12-17-26.zip\",\"..\",\".\"]}},\"duration\":1457,\"memory\":10,\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:43'),
(96, '9038c9d6-ad2e-4373-97c1-0cbcc71bfbc1', '9038c9d6-b268-4b22-8d84-3582bc8d83eb', NULL, 1, 'view', '{\"name\":\"errors::404\",\"path\":\"\\\\resources\\\\views\\/errors\\/404.blade.php\",\"data\":[\"exception\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:48'),
(97, '9038c9d6-b074-4ccd-8e58-1ca46dd06f1e', '9038c9d6-b268-4b22-8d84-3582bc8d83eb', NULL, 1, 'view', '{\"name\":\"errors.minimal\",\"path\":\"\\\\resources\\\\views\\/errors\\/minimal.blade.php\",\"data\":[\"exception\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:48'),
(98, '9038c9d6-b218-45d4-bb4e-5eeeba0b09f3', '9038c9d6-b268-4b22-8d84-3582bc8d83eb', NULL, 1, 'request', '{\"uri\":\"\\/css\\/Inconsolata.css\",\"method\":\"GET\",\"controller_action\":null,\"middleware\":[],\"headers\":{\"host\":\"localhost\",\"user-agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko\\/20100101 Firefox\\/74.0\",\"accept\":\"text\\/css,*\\/*;q=0.1\",\"accept-language\":\"en-US,en;q=0.5\",\"accept-encoding\":\"gzip, deflate\",\"dnt\":\"1\",\"connection\":\"keep-alive\",\"referer\":\"http:\\/\\/localhost\\/admin_6-0\\/admin\\/backup\",\"cookie\":\"XSRF-TOKEN=eyJpdiI6InFIRk5pYTZIRVVFRHdqS3hkdTcxbHc9PSIsInZhbHVlIjoiNHRtQ2VxejBDbVZEU2lrODFIVU16TlBaUE1kM3dkNTRDaFF4cTl4Z0xDc2FJQUpTZlI3blY5UExnRXZrYTVlbSIsIm1hYyI6IjA1NWFiOTQ2M2YzYjE2NjlhOTVkNWI0NDQxMWI4YWQzNDE5OWE3NWJjZGQyYmMzZWZjZjVjMjA1MGYxMTY3NjEifQ%3D%3D; admin_60_session=eyJpdiI6IkV3SE5IVlpoT3RnMEJBZDdhbzhYeVE9PSIsInZhbHVlIjoiMTA1cUVxalVUVHdIS1lIXC9lN09pQVkzTWMwOUptRDNkUU5UNjR0dUZxUkxLdVl2ZjhPNU9mV09LSWFvNUh2XC95IiwibWFjIjoiYzBkNDM2NDFlNmQwMTVkZjQ5MmMzZWI0NmQ3ZGY4MDIyZDY2MGU1ZTk3YjQ2MjFhODMzYzdmNzExYmVlZWU5MCJ9\"},\"payload\":[],\"session\":[],\"response_status\":404,\"response\":\"HTML Response\",\"duration\":418,\"memory\":4,\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:48'),
(99, '9038c9db-506c-47fc-a5c0-1dc2163f9777', '9038c9db-7945-4769-b889-debd383d1ead', NULL, 1, 'view', '{\"name\":\"errors::404\",\"path\":\"\\\\resources\\\\views\\/errors\\/404.blade.php\",\"data\":[\"exception\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:51'),
(100, '9038c9db-715a-4f7c-861a-1959b0e8fe23', '9038c9db-7945-4769-b889-debd383d1ead', NULL, 1, 'view', '{\"name\":\"errors.minimal\",\"path\":\"\\\\resources\\\\views\\/errors\\/minimal.blade.php\",\"data\":[\"exception\"],\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:51'),
(101, '9038c9db-78ef-406e-9e15-90f5a82106b0', '9038c9db-7945-4769-b889-debd383d1ead', NULL, 1, 'request', '{\"uri\":\"\\/css\\/Inconsolata.css\",\"method\":\"GET\",\"controller_action\":null,\"middleware\":[],\"headers\":{\"host\":\"localhost\",\"user-agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko\\/20100101 Firefox\\/74.0\",\"accept\":\"text\\/css,*\\/*;q=0.1\",\"accept-language\":\"en-US,en;q=0.5\",\"accept-encoding\":\"gzip, deflate\",\"dnt\":\"1\",\"connection\":\"keep-alive\",\"referer\":\"http:\\/\\/localhost\\/admin_6-0\\/admin\\/backup\",\"cookie\":\"XSRF-TOKEN=eyJpdiI6InFIRk5pYTZIRVVFRHdqS3hkdTcxbHc9PSIsInZhbHVlIjoiNHRtQ2VxejBDbVZEU2lrODFIVU16TlBaUE1kM3dkNTRDaFF4cTl4Z0xDc2FJQUpTZlI3blY5UExnRXZrYTVlbSIsIm1hYyI6IjA1NWFiOTQ2M2YzYjE2NjlhOTVkNWI0NDQxMWI4YWQzNDE5OWE3NWJjZGQyYmMzZWZjZjVjMjA1MGYxMTY3NjEifQ%3D%3D; admin_60_session=eyJpdiI6IkV3SE5IVlpoT3RnMEJBZDdhbzhYeVE9PSIsInZhbHVlIjoiMTA1cUVxalVUVHdIS1lIXC9lN09pQVkzTWMwOUptRDNkUU5UNjR0dUZxUkxLdVl2ZjhPNU9mV09LSWFvNUh2XC95IiwibWFjIjoiYzBkNDM2NDFlNmQwMTVkZjQ5MmMzZWI0NmQ3ZGY4MDIyZDY2MGU1ZTk3YjQ2MjFhODMzYzdmNzExYmVlZWU5MCJ9\"},\"payload\":[],\"session\":[],\"response_status\":404,\"response\":\"HTML Response\",\"duration\":1104,\"memory\":8,\"hostname\":\"DESKTOP-0NIMLPQ\"}', '2020-04-01 16:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries_tags`
--

CREATE TABLE `telescope_entries_tags` (
  `entry_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telescope_monitoring`
--

CREATE TABLE `telescope_monitoring` (
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `theme_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: Active',
  `trash` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: Deleted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'AFZALUR RAHMAN SABBIR', 'afzalbd1@gmail.com', NULL, '$2y$10$G28QXobT/KTYRPbaIeDvjegM0jdGuJDVQ0StqUqu7o8QdvRbF5oay', NULL, '2020-04-01 05:34:43', '2020-04-01 05:34:43');

-- --------------------------------------------------------

--
-- Table structure for table `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
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
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_tags`
--
ALTER TABLE `module_tags`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `telescope_entries`
--
ALTER TABLE `telescope_entries`
  ADD PRIMARY KEY (`sequence`),
  ADD UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  ADD KEY `telescope_entries_batch_id_index` (`batch_id`),
  ADD KEY `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`),
  ADD KEY `telescope_entries_family_hash_index` (`family_hash`);

--
-- Indexes for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD KEY `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  ADD KEY `telescope_entries_tags_tag_index` (`tag`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_access_infos`
--
ALTER TABLE `admin_access_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `module_tags`
--
ALTER TABLE `module_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
-- AUTO_INCREMENT for table `telescope_entries`
--
ALTER TABLE `telescope_entries`
  MODIFY `sequence` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
