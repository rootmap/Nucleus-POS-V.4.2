-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2018 at 12:43 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_simple_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `lsp_activities`
--

CREATE TABLE `lsp_activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lsp_cashier_punches`
--

CREATE TABLE `lsp_cashier_punches` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` int(11) NOT NULL,
  `in_date` date NOT NULL,
  `in_time` time NOT NULL,
  `out_date` date NOT NULL,
  `out_time` time NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_cashier_punches`
--

INSERT INTO `lsp_cashier_punches` (`id`, `user_id`, `name`, `user_type`, `in_date`, `in_time`, `out_date`, `out_time`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Md Fahad Bhuyian', 0, '2018-04-13', '20:03:45', '2018-04-13', '22:59:44', 1, 0, 0, '2018-04-13 14:03:45', '2018-04-13 16:59:44', NULL),
(2, 1, 'Md Fahad Bhuyian', 0, '2018-04-14', '10:18:14', '2018-04-14', '18:19:03', 1, 0, 0, '2018-04-14 04:18:15', '2018-04-14 12:19:03', NULL),
(3, 1, 'Md Fahad Bhuyian', 0, '2018-04-16', '19:16:34', '2018-04-16', '21:38:34', 1, 0, 0, '2018-04-16 13:16:34', '2018-04-16 15:38:34', NULL),
(4, 1, 'Md Fahad Bhuyian', 0, '2018-04-17', '16:03:51', '0000-00-00', '00:00:00', 1, 0, 0, '2018-04-17 10:03:51', '2018-04-17 10:03:51', NULL),
(5, 1, 'Md Fahad Bhuyian', 0, '2018-04-29', '15:56:19', '2018-04-29', '20:16:20', 1, 0, 0, '2018-04-29 09:56:19', '2018-04-29 14:16:20', NULL),
(6, 1, 'Md Fahad Bhuyian', 0, '2018-04-30', '08:05:28', '2018-04-30', '22:39:51', 1, 0, 0, '2018-04-30 02:05:28', '2018-04-30 16:39:51', NULL),
(7, 1, 'Md Fahad Bhuyian', 0, '2018-05-01', '14:38:05', '2018-05-01', '22:33:32', 1, 0, 0, '2018-05-01 08:38:05', '2018-05-01 16:33:33', NULL),
(8, 1, 'Md Fahad Bhuyian', 0, '2018-05-02', '18:10:34', '2018-05-02', '19:23:39', 1, 0, 0, '2018-05-02 12:10:34', '2018-05-02 13:23:39', NULL),
(9, 1, 'Md Fahad Bhuyian', 0, '2018-05-03', '18:03:24', '2018-05-03', '19:40:24', 1, 0, 0, '2018-05-03 12:03:24', '2018-05-03 13:40:24', NULL),
(10, 1, 'Md Fahad Bhuyian', 0, '2018-05-04', '07:53:26', '2018-05-04', '18:36:16', 1, 0, 0, '2018-05-04 01:53:27', '2018-05-04 12:36:16', NULL),
(11, 1, 'Md Fahad Bhuyian', 0, '2018-05-05', '08:45:56', '2018-05-05', '17:18:45', 1, 0, 0, '2018-05-05 02:45:56', '2018-05-05 11:18:46', NULL),
(12, 1, 'Md Fahad Bhuyian', 0, '2018-05-10', '18:58:21', '0000-00-00', '00:00:00', 1, 0, 0, '2018-05-10 12:58:22', '2018-05-10 12:58:22', NULL),
(13, 1, 'Md Fahad Bhuyian', 0, '2018-05-11', '12:26:48', '0000-00-00', '00:00:00', 1, 0, 0, '2018-05-11 06:26:49', '2018-05-11 06:26:49', NULL),
(14, 1, 'Md Fahad Bhuyian', 0, '2018-05-15', '21:05:11', '0000-00-00', '00:00:00', 1, 0, 0, '2018-05-15 15:05:12', '2018-05-15 15:05:12', NULL),
(15, 1, 'Md Fahad Bhuyian', 0, '2018-05-16', '16:43:31', '0000-00-00', '00:00:00', 1, 0, 0, '2018-05-16 10:43:32', '2018-05-16 10:43:32', NULL),
(16, 1, 'Md Fahad Bhuyian', 0, '2018-05-18', '13:25:18', '2018-05-18', '16:52:49', 1, 0, 0, '2018-05-18 07:25:18', '2018-05-18 10:52:49', NULL),
(17, 1, 'Md Fahad Bhuyian', 0, '2018-05-19', '18:59:57', '2018-05-19', '19:31:22', 1, 0, 0, '2018-05-19 12:59:57', '2018-05-19 13:31:22', NULL),
(18, 1, 'Md Fahad Bhuyian', 0, '2018-05-20', '20:19:21', '0000-00-00', '00:00:00', 1, 0, 0, '2018-05-20 14:19:21', '2018-05-20 14:19:21', NULL),
(19, 1, 'Md Fahad Bhuyian', 0, '2018-05-21', '17:44:16', '2018-05-21', '20:34:45', 1, 0, 0, '2018-05-21 11:44:16', '2018-05-21 14:34:45', NULL),
(20, 1, 'Md Fahad Bhuyian', 0, '2018-05-23', '15:45:32', '2018-05-23', '19:01:47', 1, 0, 0, '2018-05-23 09:45:32', '2018-05-23 13:01:47', NULL),
(21, 1, 'Md Fahad Bhuyian', 0, '2018-05-24', '15:59:48', '0000-00-00', '00:00:00', 1, 0, 0, '2018-05-24 09:59:48', '2018-05-24 09:59:48', NULL),
(22, 1, 'Md Fahad Bhuyian', 0, '2018-05-25', '20:16:41', '2018-05-25', '22:56:18', 1, 0, 0, '2018-05-25 14:16:42', '2018-05-25 16:56:18', NULL),
(23, 4, 'Fahad', 0, '2018-05-25', '20:55:22', '0000-00-00', '00:00:00', 0, 0, 0, '2018-05-25 14:55:22', '2018-05-25 14:55:22', NULL),
(24, 1, 'Md Fahad Bhuyian', 0, '2018-05-26', '09:35:31', '2018-05-26', '15:41:46', 1, 0, 0, '2018-05-26 03:35:31', '2018-05-26 09:41:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_color_plates`
--

CREATE TABLE `lsp_color_plates` (
  `id` int(10) UNSIGNED NOT NULL,
  `color_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_color_plates`
--

INSERT INTO `lsp_color_plates` (`id`, `color_name`, `color_value`, `created_at`, `updated_at`) VALUES
(1, 'Primary Lighten 1', 'bg-primary bg-lighten-1', '2018-03-28 14:33:44', '2018-03-28 14:33:44'),
(2, 'Primary Lighten 2', 'bg-primary bg-lighten-2', '2018-03-28 14:33:44', '2018-03-28 14:33:44'),
(3, 'Primary Lighten 3', 'bg-primary bg-lighten-3', '2018-03-28 14:33:44', '2018-03-28 14:33:44'),
(4, 'Primary Lighten 4', 'bg-primary bg-lighten-4', '2018-03-28 14:33:44', '2018-03-28 14:33:44'),
(5, 'Primary Darken 1', 'bg-primary bg-darken-1', '2018-03-28 14:36:01', '2018-03-28 14:36:01'),
(6, 'Primary Darken 2', 'bg-primary bg-darken-2', '2018-03-28 14:36:01', '2018-03-28 14:36:01'),
(7, 'Primary Darken 3', 'bg-primary bg-darken-3', '2018-03-28 14:36:01', '2018-03-28 14:36:01'),
(8, 'Primary Darken 4', 'bg-primary bg-darken-4', '2018-03-28 14:36:01', '2018-03-28 14:36:01'),
(9, 'Primary Accent 1', 'bg-primary bg-accent-1', '2018-03-28 14:36:41', '2018-03-28 14:36:41'),
(10, 'Primary Accent 2', 'bg-primary bg-accent-2', '2018-03-28 14:36:41', '2018-03-28 14:36:41'),
(11, 'Primary Accent 3', 'bg-primary bg-accent-3', '2018-03-28 14:36:41', '2018-03-28 14:36:41'),
(12, 'Primary Accent 4', 'bg-primary bg-accent-4', '2018-03-28 14:36:41', '2018-03-28 14:36:41'),
(13, 'Purple Lighten 1', 'bg-purple bg-lighten-1', '2018-03-28 14:38:20', '2018-03-28 14:38:20'),
(14, 'Purple Lighten 2', 'bg-purple bg-lighten-2', '2018-03-28 14:38:20', '2018-03-28 14:38:20'),
(15, 'Purple Lighten 3', 'bg-purple bg-lighten-3', '2018-03-28 14:38:21', '2018-03-28 14:38:21'),
(16, 'Purple Lighten 4', 'bg-purple bg-lighten-4', '2018-03-28 14:38:21', '2018-03-28 14:38:21'),
(17, 'Purple Darken 1', 'bg-purple bg-darken-1', '2018-03-28 14:38:54', '2018-03-28 14:38:54'),
(18, 'Purple Darken 2', 'bg-purple bg-darken-2', '2018-03-28 14:38:55', '2018-03-28 14:38:55'),
(19, 'Purple Darken 3', 'bg-purple bg-darken-3', '2018-03-28 14:38:55', '2018-03-28 14:38:55'),
(20, 'Purple Darken 4', 'bg-purple bg-darken-4', '2018-03-28 14:38:55', '2018-03-28 14:38:55'),
(21, 'Purple Accent 1', 'bg-purple bg-accent-1', '2018-03-28 14:39:30', '2018-03-28 14:39:30'),
(22, 'Purple Accent 2', 'bg-purple bg-accent-2', '2018-03-28 14:39:30', '2018-03-28 14:39:30'),
(23, 'Purple Accent 3', 'bg-purple bg-accent-3', '2018-03-28 14:39:30', '2018-03-28 14:39:30'),
(24, 'Purple Accent 4', 'bg-purple bg-accent-4', '2018-03-28 14:39:30', '2018-03-28 14:39:30'),
(25, 'Deep Purple Lighten 1', 'bg-deep-purple bg-lighten-1', '2018-03-28 14:40:58', '2018-03-28 14:40:58'),
(26, 'Deep Purple Lighten 2', 'bg-deep-purple bg-lighten-2', '2018-03-28 14:40:58', '2018-03-28 14:40:58'),
(27, 'Deep Purple Lighten 3', 'bg-deep-purple bg-lighten-3', '2018-03-28 14:40:58', '2018-03-28 14:40:58'),
(28, 'Deep Purple Lighten 4', 'bg-deep-purple bg-lighten-4', '2018-03-28 14:40:58', '2018-03-28 14:40:58'),
(29, 'Deep Purple Darken 1', 'bg-deep-purple bg-darken-1', '2018-03-28 14:41:53', '2018-03-28 14:41:53'),
(30, 'Deep Purple Darken 2', 'bg-deep-purple bg-darken-2', '2018-03-28 14:41:53', '2018-03-28 14:41:53'),
(31, 'Deep Purple Darken 3', 'bg-deep-purple bg-darken-3', '2018-03-28 14:41:54', '2018-03-28 14:41:54'),
(32, 'Deep Purple Darken 4', 'bg-deep-purple bg-darken-4', '2018-03-28 14:41:54', '2018-03-28 14:41:54'),
(33, 'Deep Purple Accent 1', 'bg-deep-purple bg-accent-1', '2018-03-28 14:42:28', '2018-03-28 14:42:28'),
(34, 'Deep Purple Accent 2', 'bg-deep-purple bg-accent-2', '2018-03-28 14:42:28', '2018-03-28 14:42:28'),
(35, 'Deep Purple Accent 3', 'bg-deep-purple bg-accent-3', '2018-03-28 14:42:28', '2018-03-28 14:42:28'),
(36, 'Deep Purple Accent 4', 'bg-deep-purple bg-accent-4', '2018-03-28 14:42:29', '2018-03-28 14:42:29'),
(37, 'Red Lighten 1', 'bg-red bg-lighten-1', '2018-03-28 14:43:10', '2018-03-28 14:43:10'),
(38, 'Red Lighten 2', 'bg-red bg-lighten-2', '2018-03-28 14:43:10', '2018-03-28 14:43:10'),
(39, 'Red Lighten 3', 'bg-red bg-lighten-3', '2018-03-28 14:43:10', '2018-03-28 14:43:10'),
(40, 'Red Lighten 4', 'bg-red bg-lighten-4', '2018-03-28 14:43:10', '2018-03-28 14:43:10'),
(41, 'Red Darken 1', 'bg-red bg-darken-1', '2018-03-28 14:43:36', '2018-03-28 14:43:36'),
(42, 'Red Darken 2', 'bg-red bg-darken-2', '2018-03-28 14:43:36', '2018-03-28 14:43:36'),
(43, 'Red Darken 3', 'bg-red bg-darken-3', '2018-03-28 14:43:36', '2018-03-28 14:43:36'),
(44, 'Red Darken 4', 'bg-red bg-darken-4', '2018-03-28 14:43:36', '2018-03-28 14:43:36'),
(45, 'Red Accent 1', 'bg-red bg-accent-1', '2018-03-28 14:44:07', '2018-03-28 14:44:07'),
(46, 'Red Accent 2', 'bg-red bg-accent-2', '2018-03-28 14:44:07', '2018-03-28 14:44:07'),
(47, 'Red Accent 3', 'bg-red bg-accent-3', '2018-03-28 14:44:07', '2018-03-28 14:44:07'),
(48, 'Red Accent 4', 'bg-red bg-accent-4', '2018-03-28 14:44:07', '2018-03-28 14:44:07'),
(49, 'Pink Lighten 1', 'bg-pink bg-lighten-1', '2018-03-28 14:45:09', '2018-03-28 14:45:09'),
(50, 'Pink Lighten 2', 'bg-pink bg-lighten-2', '2018-03-28 14:45:09', '2018-03-28 14:45:09'),
(51, 'Pink Lighten 3', 'bg-pink bg-lighten-3', '2018-03-28 14:45:09', '2018-03-28 14:45:09'),
(52, 'Pink Lighten 4', 'bg-pink bg-lighten-4', '2018-03-28 14:45:09', '2018-03-28 14:45:09'),
(53, 'Pink Darken 1', 'bg-pink bg-darken-1', '2018-03-28 14:45:32', '2018-03-28 14:45:32'),
(54, 'Pink Darken 2', 'bg-pink bg-darken-2', '2018-03-28 14:45:32', '2018-03-28 14:45:32'),
(55, 'Pink Darken 3', 'bg-pink bg-darken-3', '2018-03-28 14:45:32', '2018-03-28 14:45:32'),
(56, 'Pink Darken 4', 'bg-pink bg-darken-4', '2018-03-28 14:45:32', '2018-03-28 14:45:32'),
(57, 'Pink Accent 1', 'bg-pink bg-accent-1', '2018-03-28 14:46:05', '2018-03-28 14:46:05'),
(58, 'Pink Accent 2', 'bg-pink bg-accent-2', '2018-03-28 14:46:05', '2018-03-28 14:46:05'),
(59, 'Pink Accent 3', 'bg-pink bg-accent-3', '2018-03-28 14:46:05', '2018-03-28 14:46:05'),
(60, 'Pink Accent 4', 'bg-pink bg-accent-4', '2018-03-28 14:46:05', '2018-03-28 14:46:05'),
(61, 'Orange Lighten 1', 'bg-orange bg-lighten-1', '2018-03-28 14:47:19', '2018-03-28 14:47:19'),
(62, 'Orange Lighten 2', 'bg-orange bg-lighten-2', '2018-03-28 14:47:19', '2018-03-28 14:47:19'),
(63, 'Orange Lighten 3', 'bg-orange bg-lighten-3', '2018-03-28 14:47:19', '2018-03-28 14:47:19'),
(64, 'Orange Lighten 4', 'bg-orange bg-lighten-4', '2018-03-28 14:47:19', '2018-03-28 14:47:19'),
(65, 'Orange Darken 1', 'bg-orange bg-darken-1', '2018-03-28 14:47:50', '2018-03-28 14:47:50'),
(66, 'Orange Darken 2', 'bg-orange bg-darken-2', '2018-03-28 14:47:50', '2018-03-28 14:47:50'),
(67, 'Orange Darken 3', 'bg-orange bg-darken-3', '2018-03-28 14:47:50', '2018-03-28 14:47:50'),
(68, 'Orange Darken 4', 'bg-orange bg-darken-4', '2018-03-28 14:47:50', '2018-03-28 14:47:50'),
(69, 'Orange Accent 1', 'bg-orange bg-accent-1', '2018-03-28 14:48:21', '2018-03-28 14:48:21'),
(70, 'Orange Accent 2', 'bg-orange bg-accent-2', '2018-03-28 14:48:21', '2018-03-28 14:48:21'),
(71, 'Orange Accent 3', 'bg-orange bg-accent-3', '2018-03-28 14:48:21', '2018-03-28 14:48:21'),
(72, 'Orange Accent 4', 'bg-orange bg-accent-4', '2018-03-28 14:48:21', '2018-03-28 14:48:21'),
(73, 'Deep Orange Lighten 1', 'bg-deep-orange bg-lighten-1', '2018-03-28 14:48:45', '2018-03-28 14:48:45'),
(74, 'Deep Orange Lighten 2', 'bg-deep-orange bg-lighten-2', '2018-03-28 14:48:46', '2018-03-28 14:48:46'),
(75, 'Deep Orange Lighten 3', 'bg-deep-orange bg-lighten-3', '2018-03-28 14:48:46', '2018-03-28 14:48:46'),
(76, 'Deep Orange Lighten 4', 'bg-deep-orange bg-lighten-4', '2018-03-28 14:48:46', '2018-03-28 14:48:46'),
(77, 'Deep Orange Darken 1', 'bg-deep-orange bg-darken-1', '2018-03-28 14:49:43', '2018-03-28 14:49:43'),
(78, 'Deep Orange Darken 2', 'bg-deep-orange bg-darken-2', '2018-03-28 14:49:43', '2018-03-28 14:49:43'),
(79, 'Deep Orange Darken 3', 'bg-deep-orange bg-darken-3', '2018-03-28 14:49:43', '2018-03-28 14:49:43'),
(80, 'Deep Orange Darken 4', 'bg-deep-orange bg-darken-4', '2018-03-28 14:49:43', '2018-03-28 14:49:43'),
(81, 'Deep Orange Accent 1', 'bg-deep-orange bg-accent-1', '2018-03-28 14:51:07', '2018-03-28 14:51:07'),
(82, 'Deep Orange Accent 2', 'bg-deep-orange bg-accent-2', '2018-03-28 14:51:07', '2018-03-28 14:51:07'),
(83, 'Deep Orange Accent 3', 'bg-deep-orange bg-accent-3', '2018-03-28 14:51:07', '2018-03-28 14:51:07'),
(84, 'Deep Orange Accent 4', 'bg-deep-orange bg-accent-4', '2018-03-28 14:51:07', '2018-03-28 14:51:07'),
(85, 'Danger Lighten 1', 'bg-danger bg-lighten-1', '2018-03-28 14:52:37', '2018-03-28 14:52:37'),
(86, 'Danger Lighten 2', 'bg-danger bg-lighten-2', '2018-03-28 14:52:37', '2018-03-28 14:52:37'),
(87, 'Danger Lighten 3', 'bg-danger bg-lighten-3', '2018-03-28 14:52:37', '2018-03-28 14:52:37'),
(88, 'Danger Lighten 4', 'bg-danger bg-lighten-4', '2018-03-28 14:52:37', '2018-03-28 14:52:37'),
(89, 'Danger Darken 1', 'bg-danger bg-darken-1', '2018-03-28 14:53:30', '2018-03-28 14:53:30'),
(90, 'Danger Darken 2', 'bg-danger bg-darken-2', '2018-03-28 14:53:30', '2018-03-28 14:53:30'),
(91, 'Danger Darken 3', 'bg-danger bg-darken-3', '2018-03-28 14:53:30', '2018-03-28 14:53:30'),
(92, 'Danger Darken 4', 'bg-danger bg-darken-4', '2018-03-28 14:53:30', '2018-03-28 14:53:30'),
(93, 'Danger Accent 1', 'bg-danger bg-accent-1', '2018-03-28 14:54:30', '2018-03-28 14:54:30'),
(94, 'Danger Accent 2', 'bg-danger bg-accent-2', '2018-03-28 14:54:30', '2018-03-28 14:54:30'),
(95, 'Danger Accent 3', 'bg-danger bg-accent-3', '2018-03-28 14:54:30', '2018-03-28 14:54:30'),
(96, 'Danger Accent 4', 'bg-danger bg-accent-4', '2018-03-28 14:54:30', '2018-03-28 14:54:30'),
(97, 'Default Lighten 1', 'bg-info bg-lighten-1', '2018-04-10 15:32:04', '2018-04-10 15:32:04'),
(98, 'Default Lighten 2', 'bg-info bg-lighten-2', '2018-04-10 15:32:04', '2018-04-10 15:32:04'),
(99, 'Default Lighten 3', 'bg-info bg-lighten-3', '2018-04-10 15:32:04', '2018-04-10 15:32:04'),
(100, 'Default Lighten 4', 'bg-info bg-lighten-4', '2018-04-10 15:32:04', '2018-04-10 15:32:04'),
(101, 'Default Darken 1', 'bg-info bg-darken-1', '2018-04-10 15:32:54', '2018-04-10 15:32:54'),
(102, 'Default Darken 2', 'bg-info bg-darken-2', '2018-04-10 15:32:54', '2018-04-10 15:32:54'),
(103, 'Default Darken 3', 'bg-info bg-darken-3', '2018-04-10 15:32:54', '2018-04-10 15:32:54'),
(104, 'Default Darken 4', 'bg-info bg-darken-4', '2018-04-10 15:32:54', '2018-04-10 15:32:54'),
(105, 'Default Accent 1', 'bg-info bg-accent-1', '2018-04-10 15:33:41', '2018-04-10 15:33:41'),
(106, 'Default Accent 2', 'bg-info bg-accent-2', '2018-04-10 15:33:41', '2018-04-10 15:33:41'),
(107, 'Default Accent 3', 'bg-info bg-accent-3', '2018-04-10 15:33:41', '2018-04-10 15:33:41'),
(108, 'Default Accent 4', 'bg-info bg-accent-4', '2018-04-10 15:33:41', '2018-04-10 15:33:41');

-- --------------------------------------------------------

--
-- Table structure for table `lsp_counter_displays`
--

CREATE TABLE `lsp_counter_displays` (
  `id` int(10) UNSIGNED NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `user_id` int(10) DEFAULT '0',
  `counter_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Offline, 1 =online',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_counter_displays`
--

INSERT INTO `lsp_counter_displays` (`id`, `session_id`, `user_id`, `counter_status`, `created_at`, `updated_at`) VALUES
(1, 'pajWSw6WCqOcf28MXGP31w2fUuEVdJoXpGY1PVe5', 1, 1, '2018-04-06 19:46:51', '2018-05-26 13:09:52');

-- --------------------------------------------------------

--
-- Table structure for table `lsp_counter_display_authorized_p_cs`
--

CREATE TABLE `lsp_counter_display_authorized_p_cs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_pc_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_pc_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_counter_display_authorized_p_cs`
--

INSERT INTO `lsp_counter_display_authorized_p_cs` (`id`, `user_id`, `user_pc_ip`, `user_pc_name`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '192.168.0.5', '1', 13, 1, 1, '2018-04-07 10:25:03', '2018-04-07 10:27:59', NULL),
(2, 1, '192.168.0.136', '2', 13, 1, NULL, '2018-04-07 11:26:18', '2018-04-07 11:26:18', NULL),
(3, 1, '192.168.0.3', '1', 13, 1, 1, '2018-04-10 13:08:17', '2018-04-10 13:08:34', NULL),
(4, 1, '::1', '1', 13, 1, NULL, '2018-04-12 18:27:10', '2018-04-12 18:27:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_customers`
--

CREATE TABLE `lsp_customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_invoice_no` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_customers`
--

INSERT INTO `lsp_customers` (`id`, `name`, `address`, `phone`, `email`, `last_invoice_no`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Rakib', '', '', '', 0, 0, 0, 0, '2018-02-14 13:33:32', '2018-02-14 13:33:32', NULL),
(2, 'Brand Custom-S', 'Brand Custom-S', 'Brand Custom-S', 'Brand Custom-S', 0, 0, 0, 0, '2018-02-14 13:39:26', '2018-02-14 13:39:26', NULL),
(3, 'Brand Custom-S', 'asdas', '01860748020', 'f.bhuyian@gmail.com', 0, 0, 0, 0, '2018-02-14 13:42:17', '2018-02-14 13:42:17', NULL),
(4, 'Fahad Bhuyian', 'asdas', '01860748020', 'mdmahamodurzaman@gmail.com', 0, 13, 1, 1, '2018-02-14 14:05:02', '2018-02-14 15:57:29', '2018-02-14 15:57:29'),
(5, 'Brand Custom-S', 'asdas', '01860748020', 'fakhrul@gmail.com', 1523310292, 13, 1, 1, '2018-02-14 14:32:57', '2018-04-09 16:35:44', NULL),
(6, 'Wireless Geeks', '15011 E. 8 Mile Rd', '5863334005', 'na@na', 1523303303, 13, 1, 0, '2018-02-15 14:26:49', '2018-04-09 15:44:51', NULL),
(7, 'Wireless Geeks', '15011 E. 8 Mile Rd', '5863334405', 'quote@geekbuyback.com', 1523387430, 13, 1, 0, '2018-02-15 14:27:38', '2018-04-10 14:37:25', NULL),
(8, 'iGeek Eastpointe', '15011 E. 8 Mile Rd', '111111111', 'sales@igeekrepaircenter.com', 1523220876, 13, 1, 0, '2018-02-15 14:29:49', '2018-04-08 15:04:56', NULL),
(9, 'Rami Sprint', '29920 Southfield Rd.', '2485359679', 'pcs727@mypcsexperts.com', 1521756122, 13, 1, 0, '2018-02-15 14:31:22', '2018-03-22 16:23:29', NULL),
(10, 'iGeek Southfield', '28935 Southfield Rd.', '5867468101', 'none@none.com', 1520279304, 13, 1, 0, '2018-02-15 14:32:16', '2018-03-05 13:48:24', NULL),
(11, 'iGeek Toledo', '123 Street', '11111', 'Na@Na.com', 0, 13, 1, 0, '2018-02-15 14:34:17', '2018-02-15 14:34:17', NULL),
(12, 'Marlon B. JR', '16810 Steel St. Detroit, Mi 48235', '2485250011', 'itechheroesllc@gmail.com', 0, 13, 1, 0, '2018-02-15 14:35:36', '2018-02-15 14:35:36', NULL),
(13, 'Eddie Abro', '7 Van Dyke', '2485613838', 'metropcs@gmail.com', 1520278896, 13, 1, 0, '2018-02-15 15:23:43', '2018-03-05 13:41:37', NULL),
(14, 'Marcella Zoma', '123 Street', '11111111', 'Na@Na', 0, 13, 1, 0, '2018-02-15 15:29:16', '2018-02-15 15:29:16', NULL),
(15, 'Mazba', '123 Street', '111111111', 'Na@na', 1520278925, 13, 1, 0, '2018-02-15 15:30:04', '2018-03-05 13:42:05', NULL),
(16, 'Platinum Wireless', '13 and hoover', '1111', 'na@na', 0, 13, 1, 0, '2018-02-15 15:31:02', '2018-02-15 15:31:02', NULL),
(17, 'Platinum Wireless', 'na', '111111', 'Na@Na', 0, 13, 1, 0, '2018-02-15 15:32:03', '2018-02-15 15:32:03', NULL),
(18, 'Laith Metro PCS', '8000 w outer dr', '5867473930', 'Laith@na.com', 1520263716, 13, 1, 0, '2018-02-15 15:33:00', '2018-03-05 09:28:36', NULL),
(19, 'Brian Phone Resque', 'Na', '11111', 'na@na', 0, 13, 1, 0, '2018-02-15 15:34:11', '2018-02-15 15:34:11', NULL),
(20, 'Mazba', 'Na', '23454345345', 'na@na', 0, 13, 1, 0, '2018-02-15 15:35:25', '2018-02-15 15:35:25', NULL),
(21, 'Geek BuyBack', '1820 E 11 Mile Rd', '2488407003', 'quote@geekbuyback.com', 0, 13, 1, 0, '2018-02-15 15:36:45', '2018-02-15 15:36:45', NULL),
(22, 'Geek BuyBack', 'Na', '1111111', 'na@na', 0, 13, 1, 0, '2018-02-15 15:37:50', '2018-02-15 15:37:50', NULL),
(23, 'Laith Metro-PCS', '8000 w outer dr', '2484167746', 'metropcs@gmail.com', 0, 13, 1, 0, '2018-02-15 15:38:50', '2018-02-15 15:38:50', NULL),
(24, 'Fahad Bhuyian', 'asdas', '01860748020', 'f.bhuyian@gmail.com', 0, 13, 1, 0, '2018-03-03 13:09:34', '2018-03-03 13:09:52', '2018-03-03 13:09:52'),
(25, 'simpleretailpos', 'asdas', '01860748020', 'mdmahamodurzaman@gmail.com', 0, 13, 1, 0, '2018-03-04 15:20:39', '2018-03-04 15:20:39', NULL),
(26, 'simpleretailpo1s', 'asdas', '01860748020', 'fahad@gmail.com', 0, 13, 1, 0, '2018-03-05 14:42:35', '2018-03-05 14:42:35', NULL),
(27, 'CHEF’S SPECIAL DISHES', 'dfsdfdsf', '01677136045', 'f.bhuyian@gmail.com', 1526078652, 1, 1, 0, '2018-04-13 16:41:52', '2018-05-11 16:46:41', NULL),
(28, 'MD MAHAMUDUR Zaman Bhuyan', '3A, 20/2, Shorno Kunzo, LTD 1, Mohammadpur', '01860748020', 'f.bhuyian@gmail.com', 1527361984, 1, 1, 0, '2018-04-30 18:36:58', '2018-05-26 15:07:35', NULL),
(29, 'MD MAHAMUDUR Zaman Bhuyan', '3A, 20/2, Shorno Kunzo, LTD 1, Mohammadpur', '01860748020', 'f.bhuyian@gmail.com', 1526041609, 1, 1, 0, '2018-04-30 18:40:29', '2018-05-11 06:27:32', NULL),
(30, 'MD MAHAMUDUR Zaman Bhuyan', '3A, 20/2, Shorno Kunzo, LTD 1, Mohammadpur', '01860748020', 'f.bhuyian@gmail.com', 0, 1, 1, 0, '2018-04-30 18:41:16', '2018-04-30 18:41:16', NULL),
(31, 'MD MAHAMUDUR Zaman Bhuyan', '3A, 20/2, Shorno Kunzo, LTD 1, Mohammadpur', '01860748020', 'f.bhuyian@gmail.com', 0, 1, 1, 0, '2018-04-30 18:42:55', '2018-04-30 18:42:55', NULL),
(32, 'MD MAHAMUDUR Zaman Bhuyan', '3A, 20/2, Shorno Kunzo, LTD 1, Mohammadpur', '01860748020', 'f.bhuyian@gmail.com', 0, 1, 1, 0, '2018-04-30 18:43:27', '2018-04-30 18:43:27', NULL),
(33, 'MD MAHAMUDUR Zaman Bhuyan', '3A, 20/2, Shorno Kunzo, LTD 1, Mohammadpur', '01860748020', 'f.bhuyian@gmail.com', 1527361793, 1, 1, 0, '2018-04-30 19:07:34', '2018-05-26 13:11:22', NULL),
(34, 'MD MAHAMUDUR Zaman Bhuyan', '3A, 20/2, Shorno Kunzo, LTD 1, Mohammadpur', '01860748020', 'f.bhuyian@gmail.com', 0, 1, 1, 0, '2018-04-30 19:08:51', '2018-04-30 19:08:51', NULL),
(35, 'MD MAHAMUDUR Zaman Bhuyan', '3A, 20/2, Shorno Kunzo, LTD 1, Mohammadpur', '01860748020', 'f.bhuyian@gmail.com', 0, 1, 1, 0, '2018-04-30 19:10:17', '2018-04-30 19:10:17', NULL),
(36, 'MD MAHAMUDUR Zaman Bhuyan', '3A, 20/2, Shorno Kunzo, LTD 1, Mohammadpur', '01860748020', 'f.bhuyian@gmail.com', 0, 1, 1, 0, '2018-04-30 19:11:33', '2018-04-30 19:11:33', NULL),
(41, 'Demo Name 1', 'Demo Address', '555-555-555', 'info@company.com', 0, 1, 1, 0, '2018-05-01 17:05:29', '2018-05-01 17:05:29', NULL),
(42, 'Demo Name 2', 'Demo Address', '555-555-555', 'info@company.com', 0, 1, 1, 0, '2018-05-01 17:05:29', '2018-05-01 17:05:29', NULL),
(43, 'Demo Name 3', 'Demo Address', '555-555-555', 'info@company.com', 0, 1, 1, 0, '2018-05-01 17:05:29', '2018-05-01 17:05:29', NULL),
(44, 'Demo Name 4', 'Demo Address', '555-555-555', 'info@company.com', 0, 1, 1, 0, '2018-05-01 17:05:29', '2018-05-01 17:05:29', NULL),
(45, 'Demo Name 1', 'Demo Address', '555-555-555', 'info@company.com', 0, 1, 1, 0, '2018-05-01 17:06:19', '2018-05-01 17:06:19', NULL),
(46, 'Demo Name 2', 'Demo Address', '555-555-555', 'info@company.com', 0, 1, 1, 0, '2018-05-01 17:06:19', '2018-05-01 17:06:19', NULL),
(47, 'Demo Name 3', 'Demo Address', '555-555-555', 'info@company.com', 0, 1, 1, 0, '2018-05-01 17:06:19', '2018-05-01 17:06:19', NULL),
(48, 'Demo Name 4', 'Demo Address', '555-555-555', 'info@company.com', 0, 1, 1, 0, '2018-05-01 17:06:19', '2018-05-01 17:06:19', NULL),
(49, 'Test Customer 1', '1', '01860748020', 'f.bhuyian@gmail.com', 0, 1, 1, 0, '2018-05-01 17:21:40', '2018-05-01 17:21:40', NULL),
(50, 'Test Customer 1000', '1', '01860748020', 'f.bhuyian@gmail.com', 0, 1, 1, 0, '2018-05-01 17:28:23', '2018-05-01 17:28:23', NULL),
(51, 'Test Customer 2000', '1', '01860748020', 'f.bhuyian@gmail.com', 0, 1, 1, 0, '2018-05-01 17:32:13', '2018-05-01 17:32:13', NULL),
(52, 'Test Customer 2003', '1', '01860748020', 'f.bhuyian@gmail.com', 0, 1, 1, 0, '2018-05-01 17:35:20', '2018-05-01 17:35:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_customer_invoice_emails`
--

CREATE TABLE `lsp_customer_invoice_emails` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `invoice_send` tinyint(1) NOT NULL DEFAULT '0',
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_customer_invoice_emails`
--

INSERT INTO `lsp_customer_invoice_emails` (`id`, `name`, `email`, `invoice_id`, `invoice_send`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'MURGH MASALLA', 'mdmahamodurzaman@gmail.com', 1523303303, 0, 13, 1, 0, '2018-04-09 15:29:04', '2018-04-09 15:29:04'),
(2, 'MURGH MASALLA', 'f.bhuyian@gmail.com', 1523303303, 0, 13, 1, 0, '2018-04-09 15:44:26', '2018-04-09 15:44:26'),
(3, 'MURGH MASALLA', 'f.bhuyian@gmail.com', 1523310292, 0, 13, 1, 0, '2018-04-09 15:59:26', '2018-04-09 15:59:26');

-- --------------------------------------------------------

--
-- Table structure for table `lsp_event_calenders`
--

CREATE TABLE `lsp_event_calenders` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_start_date` date DEFAULT NULL,
  `event_start_time` time DEFAULT NULL,
  `event_end_date` date DEFAULT NULL,
  `event_end_time` time DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_event_calenders`
--

INSERT INTO `lsp_event_calenders` (`id`, `event_name`, `event_url`, `event_start_date`, `event_start_time`, `event_end_date`, `event_end_time`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Test 1', NULL, '2018-05-19', '02:00:00', '2018-05-19', '04:00:00', 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Test 2', NULL, '2018-05-11', '02:00:00', '2018-05-11', '04:00:00', 1, NULL, NULL, NULL, NULL, NULL),
(3, 'Test 3', NULL, '2018-05-13', '02:00:00', '2018-05-13', '04:00:00', 1, NULL, NULL, NULL, NULL, NULL),
(4, 'Test 4', NULL, '2018-05-27', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'Test 5', NULL, '2018-05-27', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_invoices`
--

CREATE TABLE `lsp_invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tender_id` int(11) NOT NULL,
  `tax_rate` float(10,2) NOT NULL DEFAULT '0.00',
  `total_tax` float(10,2) NOT NULL DEFAULT '0.00',
  `total_amount` float(10,2) NOT NULL,
  `discount_type` int(1) NOT NULL DEFAULT '0',
  `sales_discount` float(10,2) NOT NULL,
  `discount_total` float(10,2) NOT NULL,
  `total_cost` float(10,2) NOT NULL,
  `total_profit` float(10,2) NOT NULL,
  `sales_return` int(2) NOT NULL DEFAULT '0',
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_invoices`
--

INSERT INTO `lsp_invoices` (`id`, `invoice_id`, `customer_id`, `tender_id`, `tax_rate`, `total_tax`, `total_amount`, `discount_type`, `sales_discount`, `discount_total`, `total_cost`, `total_profit`, `sales_return`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1520032834, 9, 6, 0.00, 0.00, 68.00, 0, 0.00, 0.00, 46.50, 21.50, 0, 13, 1, 1, '2018-03-02 17:20:34', '2018-03-03 12:44:31', '2018-03-03 12:44:31'),
(2, 1520033838, 5, 5, 0.00, 0.00, 9.76, 0, 0.00, 0.00, 8.00, 1.76, 0, 13, 1, 0, '2018-03-02 17:37:18', '2018-03-03 12:44:33', '2018-03-03 12:44:33'),
(3, 1520097022, 6, 6, 0.00, 0.00, 200.00, 0, 0.00, 0.00, 100.00, 100.00, 0, 13, 1, 1, '2018-03-03 11:10:22', '2018-03-03 11:12:31', '2018-03-03 11:12:31'),
(4, 1520100588, 7, 6, 0.00, 0.00, 200.00, 0, 0.00, 0.00, 100.00, 100.00, 0, 13, 1, 0, '2018-03-03 12:09:48', '2018-03-03 12:44:35', '2018-03-03 12:44:35'),
(5, 1520100695, 7, 6, 0.00, 0.00, 200.00, 0, 0.00, 0.00, 100.00, 100.00, 0, 13, 1, 0, '2018-03-03 12:11:35', '2018-03-03 12:44:38', '2018-03-03 12:44:38'),
(6, 1520100742, 7, 6, 0.00, 0.00, 200.00, 0, 0.00, 0.00, 100.00, 100.00, 0, 13, 1, 0, '2018-03-03 12:12:22', '2018-03-03 12:44:40', '2018-03-03 12:44:40'),
(7, 1520100765, 7, 6, 0.00, 0.00, 200.00, 0, 0.00, 0.00, 100.00, 100.00, 0, 13, 1, 0, '2018-03-03 12:12:45', '2018-03-03 12:43:09', '2018-03-03 12:43:09'),
(8, 1520100935, 10, 6, 0.00, 0.00, 300.00, 0, 0.00, 0.00, 150.00, 150.00, 0, 13, 1, 0, '2018-03-03 12:15:35', '2018-03-03 12:42:15', '2018-03-03 12:42:15'),
(9, 1520106771, 6, 4, 0.00, 0.00, 38.00, 0, 0.00, 0.00, 33.00, 5.00, 0, 13, 1, 1, '2018-03-03 13:52:51', '2018-03-03 14:55:56', NULL),
(10, 1520110590, 7, 5, 0.00, 0.00, 15.00, 0, 0.00, 0.00, 11.25, 3.75, 0, 13, 1, 0, '2018-03-03 14:56:30', '2018-03-03 14:56:30', NULL),
(11, 1520110610, 5, 6, 0.00, 0.00, 15.00, 0, 0.00, 0.00, 11.25, 3.75, 0, 13, 1, 0, '2018-03-03 14:56:50', '2018-03-03 14:56:50', NULL),
(12, 1520111396, 6, 6, 0.00, 0.00, 1.22, 0, 0.00, 0.00, 1.00, 0.22, 0, 13, 1, 0, '2018-03-03 15:09:57', '2018-03-03 15:09:57', NULL),
(13, 1520193239, 13, 6, 0.00, 0.00, 19.00, 0, 0.00, 0.00, 12.00, 7.00, 0, 13, 1, 0, '2018-03-04 13:53:59', '2018-03-04 13:53:59', NULL),
(14, 1520195841, 8, 6, 0.00, 0.00, 15.00, 0, 0.00, 0.00, 11.25, 3.75, 0, 13, 1, 0, '2018-03-04 14:37:21', '2018-03-04 14:37:21', NULL),
(15, 1520195926, 8, 6, 0.00, 0.00, 15.00, 0, 0.00, 0.00, 11.25, 3.75, 0, 13, 1, 0, '2018-03-04 14:38:46', '2018-03-04 14:38:46', NULL),
(16, 1520196081, 8, 6, 0.00, 0.00, 15.00, 0, 0.00, 0.00, 11.25, 3.75, 0, 13, 1, 0, '2018-03-04 14:41:21', '2018-03-04 14:41:21', NULL),
(17, 1520196254, 8, 6, 0.00, 0.00, 15.00, 0, 0.00, 0.00, 11.25, 3.75, 0, 13, 1, 0, '2018-03-04 14:44:14', '2018-03-04 14:44:14', NULL),
(18, 1520196360, 8, 6, 0.00, 0.00, 15.00, 0, 0.00, 0.00, 11.25, 3.75, 0, 13, 1, 0, '2018-03-04 14:46:00', '2018-03-04 14:46:00', NULL),
(19, 1520196477, 8, 6, 0.00, 0.00, 15.00, 0, 0.00, 0.00, 11.25, 3.75, 0, 13, 1, 0, '2018-03-04 14:47:57', '2018-03-04 14:47:57', NULL),
(20, 1520196670, 8, 6, 0.00, 0.00, 15.00, 0, 0.00, 0.00, 11.25, 3.75, 0, 13, 1, 0, '2018-03-04 14:51:10', '2018-03-04 14:51:10', NULL),
(21, 1520196981, 8, 6, 0.00, 0.00, 15.00, 0, 0.00, 0.00, 11.25, 3.75, 0, 13, 1, 0, '2018-03-04 14:56:22', '2018-03-04 14:56:22', NULL),
(22, 1520197040, 8, 6, 0.00, 0.00, 1.22, 0, 0.00, 0.00, 1.00, 0.22, 0, 13, 1, 0, '2018-03-04 14:57:20', '2018-03-04 14:57:20', NULL),
(23, 1520197136, 10, 6, 0.00, 0.00, 100.00, 0, 0.00, 0.00, 50.00, 50.00, 0, 13, 1, 0, '2018-03-04 14:58:57', '2018-03-04 14:58:57', NULL),
(24, 1520197790, 10, 6, 0.00, 0.00, 19.00, 0, 0.00, 0.00, 12.00, 7.00, 0, 13, 1, 0, '2018-03-04 15:09:50', '2018-03-04 15:09:50', NULL),
(25, 1520263465, 13, 6, 0.00, 0.00, 15.00, 0, 0.00, 0.00, 11.25, 3.75, 0, 13, 1, 0, '2018-03-05 09:24:26', '2018-03-05 09:24:26', NULL),
(26, 1520263716, 18, 6, 0.00, 0.00, 1.22, 0, 0.00, 0.00, 1.00, 0.22, 0, 13, 1, 0, '2018-03-05 09:28:36', '2018-03-05 09:28:36', NULL),
(27, 1520277669, 13, 6, 0.00, 0.00, 1.22, 0, 0.00, 0.00, 1.00, 0.22, 0, 13, 1, 0, '2018-03-05 13:21:10', '2018-03-05 13:21:10', NULL),
(28, 1520277721, 13, 6, 0.00, 0.00, 1.22, 0, 0.00, 0.00, 1.00, 0.22, 0, 13, 1, 0, '2018-03-05 13:22:01', '2018-03-05 13:22:01', NULL),
(29, 1520278896, 13, 6, 0.00, 0.00, 1.22, 0, 0.00, 0.00, 1.00, 0.22, 0, 13, 1, 0, '2018-03-05 13:41:36', '2018-03-05 13:41:36', NULL),
(30, 1520278925, 15, 6, 0.00, 0.00, 200.00, 0, 0.00, 0.00, 100.00, 100.00, 0, 13, 1, 1, '2018-03-05 13:42:05', '2018-03-05 13:44:05', '2018-03-05 13:44:05'),
(31, 1520279304, 10, 6, 0.00, 0.00, 45.00, 0, 0.00, 0.00, 33.75, 11.25, 0, 13, 1, 0, '2018-03-05 13:48:24', '2018-03-05 13:48:24', NULL),
(32, 1521483238, 7, 6, 0.00, 0.00, 158.00, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 12:13:59', '2018-03-19 12:13:59', NULL),
(33, 1521483651, 7, 6, 0.00, 0.00, 158.00, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 12:20:53', '2018-03-19 12:20:53', NULL),
(34, 1521483704, 7, 6, 0.00, 0.00, 158.00, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 12:21:45', '2018-03-19 12:21:45', NULL),
(35, 1521483752, 7, 6, 0.00, 0.00, 158.00, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 12:22:34', '2018-03-19 12:22:34', NULL),
(36, 1521483800, 7, 6, 0.00, 0.00, 158.00, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 12:23:21', '2018-03-19 12:23:21', NULL),
(37, 1521484527, 7, 6, 0.00, 4.08, 162.08, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 12:35:28', '2018-03-19 12:35:28', NULL),
(38, 1521485131, 7, 6, 0.00, 4.08, 162.74, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 12:45:32', '2018-03-19 12:45:32', NULL),
(39, 1521485168, 7, 6, 0.00, 4.74, 162.74, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 12:46:09', '2018-03-19 12:46:09', NULL),
(40, 1521485361, 7, 6, 0.00, 4.74, 162.74, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 12:49:23', '2018-03-19 12:49:23', NULL),
(41, 1521487602, 7, 6, 0.00, 4.74, 162.74, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 13:26:43', '2018-03-19 13:26:43', NULL),
(42, 1521487925, 7, 6, 0.00, 4.74, 162.74, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 13:32:07', '2018-03-19 13:32:07', NULL),
(43, 1521488142, 7, 6, 0.00, 4.74, 162.74, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 13:35:43', '2018-03-19 13:35:43', NULL),
(44, 1521488164, 7, 6, 0.00, 4.74, 162.74, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 13:36:05', '2018-03-19 13:36:05', NULL),
(45, 1521488285, 7, 6, 0.00, 4.74, 162.74, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 13:38:06', '2018-03-19 13:38:06', NULL),
(46, 1521488357, 7, 6, 0.00, 4.74, 162.74, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 13:39:18', '2018-03-19 13:39:18', NULL),
(47, 1521488527, 7, 6, 0.00, 4.74, 162.74, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 13:42:08', '2018-03-19 13:42:08', NULL),
(48, 1521488551, 7, 6, 0.00, 4.74, 162.74, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 13:42:32', '2018-03-19 13:42:32', NULL),
(49, 1521489171, 7, 6, 0.00, 4.74, 162.74, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 13:52:53', '2018-03-19 13:52:53', NULL),
(50, 1521489281, 7, 6, 0.00, 4.74, 162.74, 0, 0.00, 0.00, 138.00, 20.00, 0, 13, 1, 0, '2018-03-19 13:54:42', '2018-03-19 13:54:42', NULL),
(51, 1521490160, 7, 6, 0.00, 6.07, 208.51, 0, 0.00, 0.00, 102.00, 100.44, 0, 13, 1, 0, '2018-03-19 15:13:24', '2018-03-19 15:13:24', NULL),
(52, 1521490160, 7, 6, 0.00, 6.07, 208.51, 0, 0.00, 0.00, 102.00, 100.44, 0, 13, 1, 0, '2018-03-19 15:13:33', '2018-03-19 15:13:33', NULL),
(53, 1521490160, 7, 6, 0.00, 6.07, 208.51, 0, 0.00, 0.00, 102.00, 100.44, 0, 13, 1, 0, '2018-03-19 15:14:03', '2018-03-19 15:14:03', NULL),
(54, 1521494043, 5, 6, 0.00, 1.68, 57.68, 0, 0.00, 0.00, 56.00, 0.00, 0, 13, 1, 0, '2018-03-19 15:14:54', '2018-03-19 15:14:54', NULL),
(55, 1521494094, 7, 6, 0.00, 43.41, 1490.51, 0, 0.00, 0.00, 1144.50, 302.60, 0, 13, 1, 0, '2018-03-19 15:17:35', '2018-03-19 15:17:35', NULL),
(56, 1521566125, 8, 6, 0.00, 3.21, 110.21, 0, 0.00, 0.00, 107.00, 0.00, 0, 13, 1, 0, '2018-03-20 11:15:29', '2018-03-20 11:15:29', NULL),
(57, 1521566130, 8, 6, 3.00, 11.37, 390.37, 0, 0.00, 0.00, 349.00, 30.00, 0, 13, 1, 0, '2018-03-20 11:27:09', '2018-03-20 11:27:09', NULL),
(58, 1521752981, 6, 6, 3.00, 5.22, 179.07, 2, 5.00, 9.15, 183.00, 0.00, 0, 13, 1, 0, '2018-03-22 16:02:01', '2018-03-22 16:02:01', NULL),
(59, 1521756122, 9, 6, 3.00, 2.88, 94.08, 2, 5.00, 4.80, 81.00, 15.00, 0, 13, 1, 1, '2018-03-22 16:23:29', '2018-03-23 12:19:26', NULL),
(60, 1521757410, 5, 6, 3.00, 4.22, 144.82, 2, 5.00, 7.40, 148.00, 0.00, 0, 13, 1, 0, '2018-03-22 16:25:42', '2018-03-22 16:25:42', NULL),
(61, 1521759827, 6, 6, 0.00, 0.00, 38.00, 0, 0.00, 0.00, 24.00, 14.00, 0, 13, 1, 0, '2018-03-22 17:03:47', '2018-03-22 17:03:47', NULL),
(62, 1521846193, 5, 6, 3.00, 4.44, 145.04, 2, 5.00, 7.40, 148.00, 0.00, 0, 13, 1, 0, '2018-03-23 17:03:13', '2018-03-23 17:03:13', NULL),
(63, 1523220777, 6, 6, 3.00, 3.51, 114.66, 2, 5.00, 5.85, 117.00, 0.00, 0, 13, 1, 0, '2018-04-08 14:54:21', '2018-04-08 14:54:21', NULL),
(64, 1523220876, 8, 6, 3.00, 1.02, 33.32, 2, 5.00, 1.70, 34.00, 0.00, 0, 13, 1, 0, '2018-04-08 15:04:56', '2018-04-08 15:04:56', NULL),
(65, 1523221497, 7, 6, 3.00, 3.21, 104.86, 2, 5.00, 5.35, 107.00, 0.00, 0, 13, 1, 0, '2018-04-08 16:04:09', '2018-04-08 16:04:09', NULL),
(66, 1523225050, 5, 6, 3.00, 1.53, 49.98, 2, 5.00, 2.55, 31.00, 20.00, 0, 13, 1, 0, '2018-04-08 16:13:07', '2018-04-08 16:13:07', NULL),
(67, 1523294846, 7, 6, 3.00, 3.51, 114.66, 2, 5.00, 5.85, 117.00, 0.00, 0, 13, 1, 0, '2018-04-09 13:48:22', '2018-04-09 13:48:22', NULL),
(68, 1523303303, 6, 6, 3.00, 1.68, 54.88, 2, 5.00, 2.80, 56.00, 0.00, 0, 13, 1, 0, '2018-04-09 15:44:51', '2018-04-09 15:44:51', NULL),
(69, 1523310292, 5, 6, 3.00, 0.66, 21.56, 2, 5.00, 1.10, 26.00, -4.00, 0, 13, 1, 0, '2018-04-09 16:35:44', '2018-04-09 16:35:44', NULL),
(70, 1523387430, 7, 6, 3.00, 1.68, 54.88, 2, 5.00, 2.80, 56.00, 0.00, 0, 13, 1, 0, '2018-04-10 14:37:25', '2018-04-10 14:37:25', NULL),
(71, 1525017380, 27, 7, 3.00, 0.30, 9.80, 2, 5.00, 0.50, 20.00, -10.00, 1, 1, 1, 0, '2018-04-29 09:58:04', '2018-05-16 13:23:31', NULL),
(72, 1525373162, 28, 7, 3.00, 51.00, 1666.00, 2, 5.00, 85.00, 1300.00, 400.00, 1, 1, 1, 0, '2018-05-03 12:46:53', '2018-05-16 13:28:02', NULL),
(73, 1525978703, 28, 7, 3.00, 1.80, 58.80, 2, 5.00, 3.00, 30.00, 30.00, 0, 1, 1, 0, '2018-05-10 20:08:21', '2018-05-10 20:08:21', NULL),
(74, 1526041609, 29, 7, 3.00, 1.20, 39.20, 2, 5.00, 2.00, 20.00, 20.00, 0, 1, 1, 0, '2018-05-11 06:27:32', '2018-05-11 06:27:32', NULL),
(75, 1526042681, 27, 7, 3.00, 1.50, 49.00, 2, 5.00, 2.50, 40.00, 10.00, 0, 1, 1, 0, '2018-05-11 16:39:56', '2018-05-11 16:39:56', NULL),
(76, 1526078547, 28, 7, 3.00, 0.60, 19.60, 2, 5.00, 1.00, 10.00, 10.00, 0, 1, 1, 0, '2018-05-11 16:43:21', '2018-05-11 16:43:21', NULL),
(77, 1526078602, 28, 7, 3.00, 31.65, 1033.90, 2, 5.00, 52.75, 843.00, 212.00, 0, 1, 1, 0, '2018-05-11 16:43:50', '2018-05-11 16:43:50', NULL),
(78, 1526078652, 27, 7, 3.00, 1.50, 49.00, 2, 5.00, 2.50, 22.00, 28.00, 0, 1, 1, 0, '2018-05-11 16:46:41', '2018-05-11 16:46:41', NULL),
(79, 1526078809, 28, 7, 3.00, 31.50, 1029.00, 2, 5.00, 52.50, 822.00, 228.00, 0, 1, 1, 0, '2018-05-11 16:47:19', '2018-05-11 16:47:19', NULL),
(80, 1526078840, 28, 7, 3.00, 1.50, 49.00, 2, 5.00, 2.50, 40.00, 10.00, 0, 1, 1, 0, '2018-05-11 16:47:38', '2018-05-11 16:47:38', NULL),
(81, 1526078859, 28, 7, 3.00, 1.50, 49.00, 2, 5.00, 2.50, 40.00, 10.00, 0, 1, 1, 0, '2018-05-11 17:08:20', '2018-05-11 17:08:20', NULL),
(82, 1527361793, 33, 7, 3.00, 51.00, 1666.00, 2, 5.00, 85.00, 1300.00, 400.00, 0, 1, 1, 0, '2018-05-26 13:11:22', '2018-05-26 13:11:22', NULL),
(83, 1527361892, 28, 7, 3.00, 0.60, 19.60, 2, 5.00, 1.00, 10.00, 10.00, 0, 1, 1, 0, '2018-05-26 13:13:03', '2018-05-26 13:13:03', NULL),
(84, 1527361984, 28, 7, 3.00, 51.45, 1680.70, 2, 5.00, 85.75, 1305.00, 410.00, 0, 1, 1, 0, '2018-05-26 15:07:35', '2018-05-26 15:07:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_invoice_email_teamplates`
--

CREATE TABLE `lsp_invoice_email_teamplates` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_time` int(1) NOT NULL DEFAULT '1',
  `bcc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_invoice_email_teamplates`
--

INSERT INTO `lsp_invoice_email_teamplates` (`id`, `company_name`, `city`, `address`, `phone`, `terms_title`, `terms_text`, `email_time`, `bcc`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Simple Retail POS', 'Hotline - 555- 0000', 'Email : f.bhuyian@gmail.com', 'www.simpleretailpos.com', 'Terms & Condition', 'Preinstalled scripts make life much easier by allowing you to install any popular application/software without any web hosting knowledge. Whether you want to start a website, blog, forum or o', 1, 'fahadvampare@gmail.com', 1, 1, 1, '2018-05-24 13:22:01', '2018-05-26 13:12:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_invoice_layout_ones`
--

CREATE TABLE `lsp_invoice_layout_ones` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'WIRELESS GEEKS WHOLESALE',
  `company_thank_you_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Thank You for your Business',
  `company_services` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Wireless Geeks - LCD Refurbishing | Apple Parts | Samsung Parts | LCD Buyback | Wholesale Repairs',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1525475961.png',
  `mm_one` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'We Buy Broken LCD’s | We Refurbish Your LCD’s | We Sell Parts!',
  `mm_two` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '7 Years of Experience!',
  `mm_three` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Visit our Local Warehouse today at:',
  `mm_four` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1820 E. 11 Mile Rd. Madison Heights MI 48071',
  `fotter_company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Wireless Geeks Inc.',
  `logo_fotter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1525475961f.png',
  `c_one` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tel (586)333-4005',
  `c_two` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1820 E. 11 Mile Rd. Madison Heights MI 48071',
  `c_three` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Visit our Sites Below!',
  `c_four` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://nucleuspos.com',
  `c_five` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://wirelessgeekswholesale.com',
  `c_six` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://geekunlocks.com',
  `terms` text COLLATE utf8mb4_unicode_ci,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_invoice_layout_ones`
--

INSERT INTO `lsp_invoice_layout_ones` (`id`, `company_name`, `company_thank_you_message`, `company_services`, `logo`, `mm_one`, `mm_two`, `mm_three`, `mm_four`, `fotter_company_name`, `logo_fotter`, `c_one`, `c_two`, `c_three`, `c_four`, `c_five`, `c_six`, `terms`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'WIRELESS GEEKS WHOLESALE', 'Thank You for your Business', 'Wireless Geeks - LCD Refurbishing | Apple Parts | Samsung Parts | LCD Buyback | Wholesale Repairs', '1525557666.png', 'We Buy Broken LCD’s | We Refurbish Your LCD’s | We Sell Parts!', '7 Years of Experience!', 'Visit our Local Warehouse today at:', '1820 E. 11 Mile Rd. Madison Heights MI 48071', 'WIRELESS GEEKS INC', NULL, 'Tel (586)333-4005', '1820 E. 11 Mile Rd. Madison Heights MI 48071', 'Visit our Sites Below!', 'http://nucleuspos.com', 'http://wirelessgeekswholesale.com', 'http://geekunlocks.com', 'DEMO REPAIR, is always proud to repair your device under a limited 90-day part(s) and labor warranty. We are only responsible for parts that the customer requests to be repaired. Warranty does NOT cover issues that do not pertain to the repair applied to the device. Any part(s) that the customer supplies we are always proud to fix or replace WITHOUT warranty on the part since the part does not come out of our inventory. We are NOT responsible for the loss of data as our job is to only fix your device as you request without interfering with your device data. Part(s) are only returned and replaced under the limited 90-day warranty if the part is defective. Unfortunately, if we replace an LCD and you break it, whether it is physical or water damage, our 90-day limited warranty does NOT cover the part, therefore we would have to repair the part which renews your 90-day limited warranty.', 1, 0, 0, '2018-05-04 17:22:54', '2018-05-11 12:54:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_invoice_layout_twos`
--

CREATE TABLE `lsp_invoice_layout_twos` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'WIRELESS GEEKS WHOLESALE',
  `company_thank_you_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Thank You For Being With us.',
  `c_one` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tel (586)333-4005',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '4025 Oak Avenue,',
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Melbourne,',
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Florida 32940,',
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USA',
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'logo.png',
  `mm_one` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'We Buy Broken LCD’s | We Refurbish Your LCD’s | We Sell Parts!',
  `mm_two` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '7 Years of Experience!',
  `mm_three` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Visit our Local Warehouse today at:',
  `mm_four` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1820 E. 11 Mile Rd. Madison Heights MI 48071',
  `terms` text COLLATE utf8mb4_unicode_ci,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_invoice_layout_twos`
--

INSERT INTO `lsp_invoice_layout_twos` (`id`, `company_name`, `company_thank_you_message`, `c_one`, `address`, `city`, `state`, `country`, `logo`, `mm_one`, `mm_two`, `mm_three`, `mm_four`, `terms`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'WIRELESS GEEKS WHOLESALE', 'Thank You For Being With us.', 'Tel (586)333-4005', '4025 Oak Avenue,', 'Melbourne,', 'Florida 32940,', 'USA', 'logo.png', 'We Buy Broken LCD’s | We Refurbish Your LCD’s | We Sell Parts!', '7 Years of Experience!', 'Visit our Local Warehouse today at:', '1820 E. 11 Mile Rd. Madison Heights MI 48071', 'DEMO REPAIR, is always proud to repair your device under a limited 90-day part(s) and labor warranty. We are only responsible for parts that the customer requests to be repaired. Warranty does NOT cover issues that do not pertain to the repair applied to the device. Any part(s) that the customer supplies we are always proud to fix or replace WITHOUT warranty on the part since the part does not come out of our inventory. We are NOT responsible for the loss of data as our job is to only fix your device as you request without interfering with your device data. Part(s) are only returned and replaced under the limited 90-day warranty if the part is defective. Unfortunately, if we replace an LCD and you break it, whether it is physical or water damage, our 90-day limited warranty does NOT cover the part, therefore we would have to repair the part which renews your 90-day limited warranty.', 1, 0, 0, '2018-05-05 15:22:36', '2018-05-11 13:47:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_invoice_payments`
--

CREATE TABLE `lsp_invoice_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` text COLLATE utf8mb4_unicode_ci,
  `tender_id` int(11) NOT NULL,
  `tender_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` double(8,2) NOT NULL,
  `paid_amount` double(8,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_invoice_payments`
--

INSERT INTO `lsp_invoice_payments` (`id`, `invoice_id`, `customer_id`, `customer_name`, `tender_id`, `tender_name`, `total_amount`, `paid_amount`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1521566131, 8, NULL, 6, NULL, 110.21, 110.21, 13, 1, 0, '2018-03-20 11:15:29', '2018-03-20 11:15:29', NULL),
(2, 1521566130, 8, NULL, 6, NULL, 390.37, 390.37, 13, 1, 0, '2018-03-20 11:27:09', '2018-03-20 11:27:09', NULL),
(3, 1521752981, 6, NULL, 6, NULL, 179.07, 179.34, 13, 1, 0, '2018-03-22 16:02:01', '2018-03-22 16:02:01', NULL),
(4, 1521756122, 9, NULL, 6, NULL, 93.94, 94.08, 13, 1, 0, '2018-03-22 16:23:29', '2018-03-22 16:23:29', NULL),
(5, 1521757410, 5, NULL, 6, NULL, 144.82, 145.04, 13, 1, 0, '2018-03-22 16:25:42', '2018-03-22 16:25:42', NULL),
(6, 1521846193, 5, 'Brand Custom-S', 6, 'Cash', 145.04, 145.04, 13, 1, 0, '2018-03-23 17:03:13', '2018-03-23 17:03:13', NULL),
(7, 1523220777, 6, 'Wireless Geeks', 6, 'Cash', 114.66, 114.66, 13, 1, 0, '2018-04-08 14:54:21', '2018-04-08 14:54:21', NULL),
(8, 1523220876, 8, 'iGeek Eastpointe', 6, 'Cash', 33.32, 33.32, 13, 1, 0, '2018-04-08 15:04:56', '2018-04-08 15:04:56', NULL),
(9, 1523221497, 7, 'Wireless Geeks', 6, 'Cash', 104.86, 104.86, 13, 1, 0, '2018-04-08 16:04:09', '2018-04-08 16:04:09', NULL),
(10, 1523225050, 5, 'Brand Custom-S', 6, 'Cash', 49.98, 49.98, 13, 1, 0, '2018-04-08 16:13:07', '2018-04-08 16:13:07', NULL),
(11, 1523294846, 7, 'Wireless Geeks', 6, 'Cash', 114.66, 114.66, 13, 1, 0, '2018-04-09 13:48:23', '2018-04-09 13:48:23', NULL),
(12, 1523303303, 6, 'Wireless Geeks', 6, 'Cash', 54.88, 54.88, 13, 1, 0, '2018-04-09 15:44:51', '2018-04-09 15:44:51', NULL),
(13, 1523310292, 5, 'Brand Custom-S', 6, 'Cash', 21.56, 21.56, 13, 1, 0, '2018-04-09 16:35:44', '2018-04-09 16:35:44', NULL),
(14, 1523387430, 7, 'Wireless Geeks', 6, 'Cash', 54.88, 54.88, 13, 1, 0, '2018-04-10 14:37:25', '2018-04-10 14:37:25', NULL),
(15, 1525017380, 27, 'CHEF’S SPECIAL DISHES', 7, 'Bhuna', 9.80, 9.80, 1, 1, 0, '2018-04-29 09:58:04', '2018-04-29 09:58:04', NULL),
(16, 1525373162, 28, 'MD MAHAMUDUR Zaman Bhuyan', 7, 'Bhuna', 1666.00, 1666.00, 1, 1, 0, '2018-05-03 12:46:53', '2018-05-03 12:46:53', NULL),
(17, 1525978703, 28, 'MD MAHAMUDUR Zaman Bhuyan', 7, 'Bhuna', 58.80, 58.80, 1, 1, 0, '2018-05-10 20:08:21', '2018-05-10 20:08:21', NULL),
(18, 1526041609, 29, 'MD MAHAMUDUR Zaman Bhuyan', 7, 'Bhuna', 39.20, 39.20, 1, 1, 0, '2018-05-11 06:27:33', '2018-05-11 06:27:33', NULL),
(19, 1526042681, 27, 'CHEF’S SPECIAL DISHES', 7, 'Bhuna', 49.00, 49.00, 1, 1, 0, '2018-05-11 16:39:56', '2018-05-11 16:39:56', NULL),
(20, 1526078547, 28, 'MD MAHAMUDUR Zaman Bhuyan', 7, 'Bhuna', 19.60, 19.60, 1, 1, 0, '2018-05-11 16:43:22', '2018-05-11 16:43:22', NULL),
(21, 1526078602, 28, 'MD MAHAMUDUR Zaman Bhuyan', 7, 'Bhuna', 1033.90, 1033.90, 1, 1, 0, '2018-05-11 16:43:50', '2018-05-11 16:43:50', NULL),
(22, 1526078652, 27, 'CHEF’S SPECIAL DISHES', 7, 'Bhuna', 49.00, 49.00, 1, 1, 0, '2018-05-11 16:46:41', '2018-05-11 16:46:41', NULL),
(23, 1526078809, 28, 'MD MAHAMUDUR Zaman Bhuyan', 7, 'Bhuna', 1029.00, 1029.00, 1, 1, 0, '2018-05-11 16:47:19', '2018-05-11 16:47:19', NULL),
(24, 1526078840, 28, 'MD MAHAMUDUR Zaman Bhuyan', 7, 'Bhuna', 49.00, 49.00, 1, 1, 0, '2018-05-11 16:47:38', '2018-05-11 16:47:38', NULL),
(25, 1526078859, 28, 'MD MAHAMUDUR Zaman Bhuyan', 7, 'Bhuna', 49.00, 49.00, 1, 1, 0, '2018-05-11 17:08:20', '2018-05-11 17:08:20', NULL),
(26, 1527361793, 33, 'MD MAHAMUDUR Zaman Bhuyan', 7, 'Bhuna', 1666.00, 1666.00, 1, 1, 0, '2018-05-26 13:11:22', '2018-05-26 13:11:22', NULL),
(27, 1527361892, 28, 'MD MAHAMUDUR Zaman Bhuyan', 7, 'Bhuna', 19.60, 19.60, 1, 1, 0, '2018-05-26 13:13:03', '2018-05-26 13:13:03', NULL),
(28, 1527361984, 28, 'MD MAHAMUDUR Zaman Bhuyan', 7, 'Bhuna', 1680.70, 1680.70, 1, 1, 0, '2018-05-26 15:07:35', '2018-05-26 15:07:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_invoice_products`
--

CREATE TABLE `lsp_invoice_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `tax_percent` double(8,2) NOT NULL,
  `tax_amount` double(8,2) NOT NULL,
  `discount_percent` double(8,2) NOT NULL,
  `discount_amount` double(8,2) NOT NULL,
  `cupon_amount` double(8,2) NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `total_cost` double(8,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_invoice_products`
--

INSERT INTO `lsp_invoice_products` (`id`, `invoice_id`, `product_id`, `quantity`, `price`, `cost`, `tax_percent`, `tax_amount`, `discount_percent`, `discount_amount`, `cupon_amount`, `total_price`, `total_cost`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1518802273, 22, 4, 14.00, 9.00, 0.00, 0.00, 0.00, 0.00, 0.00, 56.00, 36.00, 13, 1, 0, '2018-02-16 11:31:13', '2018-02-16 12:51:18', '2018-02-16 12:51:18'),
(2, 1518802273, 28, 4, 47.00, 42.00, 0.00, 0.00, 0.00, 0.00, 0.00, 188.00, 168.00, 13, 1, 0, '2018-02-16 11:31:13', '2018-02-16 12:51:18', '2018-02-16 12:51:18'),
(3, 1518802273, 25, 4, 45.00, 40.00, 0.00, 0.00, 0.00, 0.00, 0.00, 180.00, 160.00, 13, 1, 0, '2018-02-16 11:31:13', '2018-02-16 12:51:18', '2018-02-16 12:51:18'),
(4, 1518806346, 8, 1, 14.00, 9.00, 0.00, 0.00, 0.00, 0.00, 0.00, 14.00, 9.00, 13, 1, 0, '2018-02-16 12:39:06', '2018-02-16 12:51:37', '2018-02-16 12:51:37'),
(5, 1518806346, 15, 1, 22.00, 22.00, 0.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-02-16 12:39:06', '2018-02-16 12:51:37', '2018-02-16 12:51:37'),
(6, 1518806346, 27, 1, 47.00, 42.00, 0.00, 0.00, 0.00, 0.00, 0.00, 47.00, 42.00, 13, 1, 0, '2018-02-16 12:39:06', '2018-02-16 12:51:37', '2018-02-16 12:51:37'),
(7, 1518806346, 27, 1, 47.00, 42.00, 0.00, 0.00, 0.00, 0.00, 0.00, 47.00, 42.00, 13, 1, 0, '2018-02-16 12:39:06', '2018-02-16 12:51:37', '2018-02-16 12:51:37'),
(8, 1518807226, 7, 1, 12.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 12.00, 10.00, 13, 1, 0, '2018-02-16 12:53:46', '2018-02-16 16:11:44', '2018-02-16 16:11:44'),
(9, 1518807226, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-02-16 12:53:47', '2018-02-16 16:11:44', '2018-02-16 16:11:44'),
(10, 1518807226, 12, 1, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 12.00, 13, 1, 0, '2018-02-16 12:53:47', '2018-02-16 16:11:44', '2018-02-16 16:11:44'),
(11, 1518807226, 7, 1, 12.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 12.00, 10.00, 13, 1, 0, '2018-02-16 16:11:44', '2018-02-16 16:13:54', '2018-02-16 16:13:54'),
(12, 1518807226, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-02-16 16:11:44', '2018-02-16 16:13:54', '2018-02-16 16:13:54'),
(13, 1518807226, 12, 1, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 12.00, 13, 1, 0, '2018-02-16 16:11:44', '2018-02-16 16:13:54', '2018-02-16 16:13:54'),
(14, 1518807226, 7, 1, 12.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 12.00, 10.00, 13, 1, 0, '2018-02-16 16:13:54', '2018-03-01 13:59:58', '2018-03-01 13:59:58'),
(15, 1518807226, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-02-16 16:13:54', '2018-03-01 13:59:58', '2018-03-01 13:59:58'),
(16, 1518807226, 12, 1, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 12.00, 13, 1, 0, '2018-02-16 16:13:54', '2018-03-01 13:59:58', '2018-03-01 13:59:58'),
(17, 1518819408, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-02-16 16:16:48', '2018-02-16 16:16:48', NULL),
(18, 1518807226, 7, 2, 12.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 24.00, 20.00, 13, 1, 1, '2018-03-01 13:59:58', '2018-03-01 13:59:58', NULL),
(19, 1518807226, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 1, '2018-03-01 13:59:58', '2018-03-01 13:59:58', NULL),
(20, 1518807226, 12, 1, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 12.00, 13, 1, 1, '2018-03-01 13:59:59', '2018-03-01 13:59:59', NULL),
(21, 1519989038, 4, 4, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 76.00, 48.00, 13, 1, 0, '2018-03-02 05:10:38', '2018-03-02 05:10:38', NULL),
(22, 1519989038, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-03-02 05:10:38', '2018-03-02 05:10:38', NULL),
(23, 1519989038, 14, 7, 22.00, 22.00, 0.00, 0.00, 0.00, 0.00, 0.00, 154.00, 154.00, 13, 1, 0, '2018-03-02 05:10:38', '2018-03-02 05:10:38', NULL),
(24, 1519989038, 24, 9, 165.00, 155.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1485.00, 1395.00, 13, 1, 0, '2018-03-02 05:10:38', '2018-03-02 05:10:38', NULL),
(25, 1520032834, 4, 1, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 12.00, 13, 1, 0, '2018-03-02 17:20:34', '2018-03-02 17:35:21', '2018-03-02 17:35:21'),
(26, 1520032834, 6, 2, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 30.00, 22.50, 13, 1, 0, '2018-03-02 17:20:34', '2018-03-02 17:35:21', '2018-03-02 17:35:21'),
(27, 1520032834, 4, 1, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 12.00, 13, 1, 1, '2018-03-02 17:35:21', '2018-03-02 17:35:41', '2018-03-02 17:35:41'),
(28, 1520032834, 6, 2, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 30.00, 22.50, 13, 1, 1, '2018-03-02 17:35:21', '2018-03-02 17:35:41', '2018-03-02 17:35:41'),
(29, 1520032834, 4, 2, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 38.00, 24.00, 13, 1, 1, '2018-03-02 17:35:41', '2018-03-03 12:44:31', '2018-03-03 12:44:31'),
(30, 1520032834, 6, 2, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 30.00, 22.50, 13, 1, 1, '2018-03-02 17:35:42', '2018-03-03 12:44:31', '2018-03-03 12:44:31'),
(31, 1520033838, 1, 8, 1.22, 1.00, 0.00, 0.00, 0.00, 0.00, 0.00, 9.76, 8.00, 13, 1, 0, '2018-03-02 17:37:18', '2018-03-03 12:44:33', '2018-03-03 12:44:33'),
(32, 1520097022, 3, 2, 100.00, 50.00, 0.00, 0.00, 0.00, 0.00, 0.00, 200.00, 100.00, 13, 1, 0, '2018-03-03 11:10:22', '2018-03-03 11:12:20', '2018-03-03 11:12:20'),
(33, 1520097022, 3, 2, 100.00, 50.00, 0.00, 0.00, 0.00, 0.00, 0.00, 200.00, 100.00, 13, 1, 1, '2018-03-03 11:12:20', '2018-03-03 11:12:31', '2018-03-03 11:12:31'),
(34, 1520100588, 3, 2, 100.00, 50.00, 0.00, 0.00, 0.00, 0.00, 0.00, 200.00, 100.00, 13, 1, 0, '2018-03-03 12:09:48', '2018-03-03 12:44:35', '2018-03-03 12:44:35'),
(35, 1520100695, 3, 2, 100.00, 50.00, 0.00, 0.00, 0.00, 0.00, 0.00, 200.00, 100.00, 13, 1, 0, '2018-03-03 12:11:35', '2018-03-03 12:44:38', '2018-03-03 12:44:38'),
(36, 1520100742, 3, 2, 100.00, 50.00, 0.00, 0.00, 0.00, 0.00, 0.00, 200.00, 100.00, 13, 1, 0, '2018-03-03 12:12:22', '2018-03-03 12:44:40', '2018-03-03 12:44:40'),
(37, 1520100765, 3, 2, 100.00, 50.00, 0.00, 0.00, 0.00, 0.00, 0.00, 200.00, 100.00, 13, 1, 0, '2018-03-03 12:12:45', '2018-03-03 12:43:09', '2018-03-03 12:43:09'),
(38, 1520100935, 3, 3, 100.00, 50.00, 0.00, 0.00, 0.00, 0.00, 0.00, 300.00, 150.00, 13, 1, 0, '2018-03-03 12:15:35', '2018-03-03 12:42:15', '2018-03-03 12:42:15'),
(39, 1520106771, 5, 1, 38.00, 33.00, 0.00, 0.00, 0.00, 0.00, 0.00, 38.00, 33.00, 13, 1, 0, '2018-03-03 13:52:51', '2018-03-03 14:55:56', '2018-03-03 14:55:56'),
(40, 1520106771, 5, 1, 38.00, 33.00, 0.00, 0.00, 0.00, 0.00, 0.00, 38.00, 33.00, 13, 1, 1, '2018-03-03 14:55:56', '2018-03-03 14:55:56', NULL),
(41, 1520110590, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-03-03 14:56:30', '2018-03-03 14:56:30', NULL),
(42, 1520110610, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-03-03 14:56:50', '2018-03-03 14:56:50', NULL),
(43, 1520111396, 1, 1, 1.22, 1.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1.22, 1.00, 13, 1, 0, '2018-03-03 15:09:56', '2018-03-03 15:09:56', NULL),
(44, 1520193239, 4, 1, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 12.00, 13, 1, 0, '2018-03-04 13:53:59', '2018-03-04 13:53:59', NULL),
(45, 1520195841, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-03-04 14:37:21', '2018-03-04 14:37:21', NULL),
(46, 1520195926, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-03-04 14:38:46', '2018-03-04 14:38:46', NULL),
(47, 1520196081, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-03-04 14:41:21', '2018-03-04 14:41:21', NULL),
(48, 1520196254, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-03-04 14:44:14', '2018-03-04 14:44:14', NULL),
(49, 1520196360, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-03-04 14:46:00', '2018-03-04 14:46:00', NULL),
(50, 1520196477, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-03-04 14:47:57', '2018-03-04 14:47:57', NULL),
(51, 1520196670, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-03-04 14:51:10', '2018-03-04 14:51:10', NULL),
(52, 1520196981, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-03-04 14:56:21', '2018-03-04 14:56:21', NULL),
(53, 1520197040, 1, 1, 1.22, 1.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1.22, 1.00, 13, 1, 0, '2018-03-04 14:57:20', '2018-03-04 14:57:20', NULL),
(54, 1520197136, 3, 1, 100.00, 50.00, 0.00, 0.00, 0.00, 0.00, 0.00, 100.00, 50.00, 13, 1, 0, '2018-03-04 14:58:56', '2018-03-04 14:58:56', NULL),
(55, 1520197790, 4, 1, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 12.00, 13, 1, 0, '2018-03-04 15:09:50', '2018-03-04 15:09:50', NULL),
(56, 1520263465, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-03-05 09:24:25', '2018-03-05 09:24:25', NULL),
(57, 1520263716, 1, 1, 1.22, 1.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1.22, 1.00, 13, 1, 0, '2018-03-05 09:28:36', '2018-03-05 09:28:36', NULL),
(58, 1520277669, 1, 1, 1.22, 1.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1.22, 1.00, 13, 1, 0, '2018-03-05 13:21:09', '2018-03-05 13:21:09', NULL),
(59, 1520277721, 1, 1, 1.22, 1.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1.22, 1.00, 13, 1, 0, '2018-03-05 13:22:01', '2018-03-05 13:22:01', NULL),
(60, 1520278896, 1, 1, 1.22, 1.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1.22, 1.00, 13, 1, 0, '2018-03-05 13:41:36', '2018-03-05 13:41:36', NULL),
(61, 1520278925, 3, 2, 100.00, 50.00, 0.00, 0.00, 0.00, 0.00, 0.00, 200.00, 100.00, 13, 1, 0, '2018-03-05 13:42:05', '2018-03-05 13:42:45', '2018-03-05 13:42:45'),
(62, 1520278925, 3, 2, 100.00, 50.00, 0.00, 0.00, 0.00, 0.00, 0.00, 200.00, 100.00, 13, 1, 1, '2018-03-05 13:42:45', '2018-03-05 13:44:05', '2018-03-05 13:44:05'),
(63, 1520279304, 6, 3, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 45.00, 33.75, 13, 1, 0, '2018-03-05 13:48:24', '2018-03-05 13:48:24', NULL),
(64, 1521482939, 44, 1, 22.00, 22.00, 0.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:08:59', '2018-03-19 12:08:59', NULL),
(65, 1521482939, 43, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:08:59', '2018-03-19 12:08:59', NULL),
(66, 1521482939, 42, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:09:00', '2018-03-19 12:09:00', NULL),
(67, 1521482939, 41, 1, 4.00, 4.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:09:00', '2018-03-19 12:09:00', NULL),
(68, 1521482939, 40, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:09:00', '2018-03-19 12:09:00', NULL),
(69, 1521482939, 39, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:09:00', '2018-03-19 12:09:00', NULL),
(70, 1521482939, 38, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:09:00', '2018-03-19 12:09:00', NULL),
(71, 1521482939, 37, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:09:00', '2018-03-19 12:09:00', NULL),
(72, 1521482939, 36, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:09:00', '2018-03-19 12:09:00', NULL),
(73, 1521482939, 35, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:09:00', '2018-03-19 12:09:00', NULL),
(74, 1521482939, 34, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:09:01', '2018-03-19 12:09:01', NULL),
(75, 1521482939, 33, 1, 20.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:09:01', '2018-03-19 12:09:01', NULL),
(76, 1521483238, 44, 1, 22.00, 22.00, 0.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:13:58', '2018-03-19 12:13:58', NULL),
(77, 1521483238, 43, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:13:58', '2018-03-19 12:13:58', NULL),
(78, 1521483238, 42, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:13:58', '2018-03-19 12:13:58', NULL),
(79, 1521483238, 41, 1, 4.00, 4.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:13:58', '2018-03-19 12:13:58', NULL),
(80, 1521483238, 40, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:13:58', '2018-03-19 12:13:58', NULL),
(81, 1521483238, 39, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:13:58', '2018-03-19 12:13:58', NULL),
(82, 1521483238, 38, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:13:58', '2018-03-19 12:13:58', NULL),
(83, 1521483238, 37, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:13:59', '2018-03-19 12:13:59', NULL),
(84, 1521483238, 36, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:13:59', '2018-03-19 12:13:59', NULL),
(85, 1521483238, 35, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:13:59', '2018-03-19 12:13:59', NULL),
(86, 1521483238, 34, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:13:59', '2018-03-19 12:13:59', NULL),
(87, 1521483238, 33, 1, 20.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:13:59', '2018-03-19 12:13:59', NULL),
(88, 1521483437, 44, 1, 22.00, 22.00, 0.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:17:17', '2018-03-19 12:17:17', NULL),
(89, 1521483437, 43, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:17:17', '2018-03-19 12:17:17', NULL),
(90, 1521483437, 42, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:17:18', '2018-03-19 12:17:18', NULL),
(91, 1521483437, 41, 1, 4.00, 4.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:17:18', '2018-03-19 12:17:18', NULL),
(92, 1521483437, 40, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:17:18', '2018-03-19 12:17:18', NULL),
(93, 1521483437, 39, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:17:18', '2018-03-19 12:17:18', NULL),
(94, 1521483437, 38, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:17:18', '2018-03-19 12:17:18', NULL),
(95, 1521483437, 37, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:17:18', '2018-03-19 12:17:18', NULL),
(96, 1521483437, 36, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:17:19', '2018-03-19 12:17:19', NULL),
(97, 1521483437, 35, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:17:19', '2018-03-19 12:17:19', NULL),
(98, 1521483437, 34, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:17:19', '2018-03-19 12:17:19', NULL),
(99, 1521483437, 33, 1, 20.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:17:19', '2018-03-19 12:17:19', NULL),
(100, 1521483532, 44, 1, 22.00, 22.00, 0.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:18:52', '2018-03-19 12:18:52', NULL),
(101, 1521483532, 43, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:18:52', '2018-03-19 12:18:52', NULL),
(102, 1521483532, 42, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:18:52', '2018-03-19 12:18:52', NULL),
(103, 1521483532, 41, 1, 4.00, 4.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:18:52', '2018-03-19 12:18:52', NULL),
(104, 1521483532, 40, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:18:52', '2018-03-19 12:18:52', NULL),
(105, 1521483532, 39, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:18:53', '2018-03-19 12:18:53', NULL),
(106, 1521483532, 38, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:18:53', '2018-03-19 12:18:53', NULL),
(107, 1521483532, 37, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:18:53', '2018-03-19 12:18:53', NULL),
(108, 1521483532, 36, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:18:53', '2018-03-19 12:18:53', NULL),
(109, 1521483532, 35, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:18:53', '2018-03-19 12:18:53', NULL),
(110, 1521483532, 34, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:18:53', '2018-03-19 12:18:53', NULL),
(111, 1521483532, 33, 1, 20.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:18:53', '2018-03-19 12:18:53', NULL),
(112, 1521483547, 44, 1, 22.00, 22.00, 0.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:19:07', '2018-03-19 12:19:07', NULL),
(113, 1521483547, 43, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:19:07', '2018-03-19 12:19:07', NULL),
(114, 1521483547, 42, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:19:07', '2018-03-19 12:19:07', NULL),
(115, 1521483547, 41, 1, 4.00, 4.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:19:07', '2018-03-19 12:19:07', NULL),
(116, 1521483547, 40, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:19:08', '2018-03-19 12:19:08', NULL),
(117, 1521483547, 39, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:19:08', '2018-03-19 12:19:08', NULL),
(118, 1521483547, 38, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:19:08', '2018-03-19 12:19:08', NULL),
(119, 1521483547, 37, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:19:08', '2018-03-19 12:19:08', NULL),
(120, 1521483547, 36, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:19:08', '2018-03-19 12:19:08', NULL),
(121, 1521483547, 35, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:19:08', '2018-03-19 12:19:08', NULL),
(122, 1521483547, 34, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:19:09', '2018-03-19 12:19:09', NULL),
(123, 1521483547, 33, 1, 20.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:19:09', '2018-03-19 12:19:09', NULL),
(124, 1521483651, 44, 1, 22.00, 22.00, 0.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:20:51', '2018-03-19 12:20:51', NULL),
(125, 1521483651, 43, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:20:51', '2018-03-19 12:20:51', NULL),
(126, 1521483651, 42, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:20:51', '2018-03-19 12:20:51', NULL),
(127, 1521483651, 41, 1, 4.00, 4.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:20:51', '2018-03-19 12:20:51', NULL),
(128, 1521483651, 40, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:20:51', '2018-03-19 12:20:51', NULL),
(129, 1521483651, 39, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:20:51', '2018-03-19 12:20:51', NULL),
(130, 1521483651, 38, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:20:51', '2018-03-19 12:20:51', NULL),
(131, 1521483651, 37, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:20:52', '2018-03-19 12:20:52', NULL),
(132, 1521483651, 36, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:20:52', '2018-03-19 12:20:52', NULL),
(133, 1521483651, 35, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:20:52', '2018-03-19 12:20:52', NULL),
(134, 1521483651, 34, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:20:52', '2018-03-19 12:20:52', NULL),
(135, 1521483651, 33, 1, 20.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:20:52', '2018-03-19 12:20:52', NULL),
(136, 1521483704, 44, 1, 22.00, 22.00, 0.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:21:44', '2018-03-19 12:21:44', NULL),
(137, 1521483704, 43, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:21:44', '2018-03-19 12:21:44', NULL),
(138, 1521483704, 42, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:21:44', '2018-03-19 12:21:44', NULL),
(139, 1521483704, 41, 1, 4.00, 4.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:21:44', '2018-03-19 12:21:44', NULL),
(140, 1521483704, 40, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:21:44', '2018-03-19 12:21:44', NULL),
(141, 1521483704, 39, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:21:44', '2018-03-19 12:21:44', NULL),
(142, 1521483704, 38, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:21:44', '2018-03-19 12:21:44', NULL),
(143, 1521483704, 37, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:21:45', '2018-03-19 12:21:45', NULL),
(144, 1521483704, 36, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:21:45', '2018-03-19 12:21:45', NULL),
(145, 1521483704, 35, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:21:45', '2018-03-19 12:21:45', NULL),
(146, 1521483704, 34, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:21:45', '2018-03-19 12:21:45', NULL),
(147, 1521483704, 33, 1, 20.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:21:45', '2018-03-19 12:21:45', NULL),
(148, 1521483752, 44, 1, 22.00, 22.00, 0.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:22:32', '2018-03-19 12:22:32', NULL),
(149, 1521483752, 43, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:22:32', '2018-03-19 12:22:32', NULL),
(150, 1521483752, 42, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:22:32', '2018-03-19 12:22:32', NULL),
(151, 1521483752, 41, 1, 4.00, 4.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:22:32', '2018-03-19 12:22:32', NULL),
(152, 1521483752, 40, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:22:33', '2018-03-19 12:22:33', NULL),
(153, 1521483752, 39, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:22:33', '2018-03-19 12:22:33', NULL),
(154, 1521483752, 38, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:22:33', '2018-03-19 12:22:33', NULL),
(155, 1521483752, 37, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:22:33', '2018-03-19 12:22:33', NULL),
(156, 1521483752, 36, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:22:33', '2018-03-19 12:22:33', NULL),
(157, 1521483752, 35, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:22:33', '2018-03-19 12:22:33', NULL),
(158, 1521483752, 34, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:22:33', '2018-03-19 12:22:33', NULL),
(159, 1521483752, 33, 1, 20.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:22:34', '2018-03-19 12:22:34', NULL),
(160, 1521483800, 44, 1, 22.00, 22.00, 0.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:23:20', '2018-03-19 12:23:20', NULL),
(161, 1521483800, 43, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:23:20', '2018-03-19 12:23:20', NULL),
(162, 1521483800, 42, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:23:20', '2018-03-19 12:23:20', NULL),
(163, 1521483800, 41, 1, 4.00, 4.00, 0.00, 0.00, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:23:20', '2018-03-19 12:23:20', NULL),
(164, 1521483800, 40, 1, 20.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:23:20', '2018-03-19 12:23:20', NULL),
(165, 1521483800, 39, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:23:20', '2018-03-19 12:23:20', NULL),
(166, 1521483800, 38, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:23:21', '2018-03-19 12:23:21', NULL),
(167, 1521483800, 37, 1, 10.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:23:21', '2018-03-19 12:23:21', NULL),
(168, 1521483800, 36, 1, 11.00, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:23:21', '2018-03-19 12:23:21', NULL),
(169, 1521483800, 35, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:23:21', '2018-03-19 12:23:21', NULL),
(170, 1521483800, 34, 1, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:23:21', '2018-03-19 12:23:21', NULL),
(171, 1521483800, 33, 1, 20.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:23:21', '2018-03-19 12:23:21', NULL),
(172, 1521484527, 44, 1, 22.00, 22.00, 3.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:35:27', '2018-03-19 12:35:27', NULL),
(173, 1521484527, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:35:27', '2018-03-19 12:35:27', NULL),
(174, 1521484527, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:35:27', '2018-03-19 12:35:27', NULL),
(175, 1521484527, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:35:27', '2018-03-19 12:35:27', NULL),
(176, 1521484527, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:35:27', '2018-03-19 12:35:27', NULL),
(177, 1521484527, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:35:27', '2018-03-19 12:35:27', NULL),
(178, 1521484527, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:35:27', '2018-03-19 12:35:27', NULL),
(179, 1521484527, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:35:28', '2018-03-19 12:35:28', NULL),
(180, 1521484527, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:35:28', '2018-03-19 12:35:28', NULL),
(181, 1521484527, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:35:28', '2018-03-19 12:35:28', NULL),
(182, 1521484527, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:35:28', '2018-03-19 12:35:28', NULL),
(183, 1521484527, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:35:28', '2018-03-19 12:35:28', NULL),
(184, 1521485088, 44, 1, 22.00, 22.00, 3.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:44:48', '2018-03-19 12:44:48', NULL),
(185, 1521485088, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:44:49', '2018-03-19 12:44:49', NULL),
(186, 1521485088, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:44:49', '2018-03-19 12:44:49', NULL),
(187, 1521485088, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:44:49', '2018-03-19 12:44:49', NULL),
(188, 1521485088, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:44:49', '2018-03-19 12:44:49', NULL),
(189, 1521485088, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:44:49', '2018-03-19 12:44:49', NULL),
(190, 1521485088, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:44:49', '2018-03-19 12:44:49', NULL),
(191, 1521485088, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:44:49', '2018-03-19 12:44:49', NULL),
(192, 1521485088, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:44:50', '2018-03-19 12:44:50', NULL),
(193, 1521485088, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:44:50', '2018-03-19 12:44:50', NULL),
(194, 1521485088, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:44:50', '2018-03-19 12:44:50', NULL),
(195, 1521485088, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:44:50', '2018-03-19 12:44:50', NULL),
(196, 1521485131, 44, 1, 22.00, 22.00, 3.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:45:31', '2018-03-19 12:45:31', NULL),
(197, 1521485131, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:45:31', '2018-03-19 12:45:31', NULL),
(198, 1521485131, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:45:31', '2018-03-19 12:45:31', NULL),
(199, 1521485131, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:45:31', '2018-03-19 12:45:31', NULL),
(200, 1521485131, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:45:31', '2018-03-19 12:45:31', NULL),
(201, 1521485131, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:45:31', '2018-03-19 12:45:31', NULL),
(202, 1521485131, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:45:31', '2018-03-19 12:45:31', NULL),
(203, 1521485131, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:45:31', '2018-03-19 12:45:31', NULL),
(204, 1521485131, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:45:31', '2018-03-19 12:45:31', NULL),
(205, 1521485131, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:45:31', '2018-03-19 12:45:31', NULL),
(206, 1521485131, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:45:32', '2018-03-19 12:45:32', NULL),
(207, 1521485131, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:45:32', '2018-03-19 12:45:32', NULL),
(208, 1521485168, 44, 1, 22.00, 22.00, 3.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:46:08', '2018-03-19 12:46:08', NULL),
(209, 1521485168, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:46:08', '2018-03-19 12:46:08', NULL),
(210, 1521485168, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:46:08', '2018-03-19 12:46:08', NULL),
(211, 1521485168, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:46:08', '2018-03-19 12:46:08', NULL),
(212, 1521485168, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:46:08', '2018-03-19 12:46:08', NULL),
(213, 1521485168, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:46:08', '2018-03-19 12:46:08', NULL),
(214, 1521485168, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:46:09', '2018-03-19 12:46:09', NULL),
(215, 1521485168, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:46:09', '2018-03-19 12:46:09', NULL),
(216, 1521485168, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:46:09', '2018-03-19 12:46:09', NULL),
(217, 1521485168, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:46:09', '2018-03-19 12:46:09', NULL),
(218, 1521485168, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:46:09', '2018-03-19 12:46:09', NULL),
(219, 1521485168, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:46:09', '2018-03-19 12:46:09', NULL),
(220, 1521485361, 44, 1, 22.00, 22.00, 3.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 12:49:21', '2018-03-19 12:49:21', NULL),
(221, 1521485361, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:49:22', '2018-03-19 12:49:22', NULL),
(222, 1521485361, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:49:22', '2018-03-19 12:49:22', NULL),
(223, 1521485361, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 12:49:22', '2018-03-19 12:49:22', NULL),
(224, 1521485361, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 12:49:22', '2018-03-19 12:49:22', NULL),
(225, 1521485361, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:49:22', '2018-03-19 12:49:22', NULL),
(226, 1521485361, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:49:22', '2018-03-19 12:49:22', NULL),
(227, 1521485361, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 12:49:22', '2018-03-19 12:49:22', NULL),
(228, 1521485361, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 12:49:22', '2018-03-19 12:49:22', NULL),
(229, 1521485361, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:49:23', '2018-03-19 12:49:23', NULL),
(230, 1521485361, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 12:49:23', '2018-03-19 12:49:23', NULL),
(231, 1521485361, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 12:49:23', '2018-03-19 12:49:23', NULL),
(232, 1521487602, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 13:26:42', '2018-03-19 13:26:42', NULL),
(233, 1521487602, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:26:42', '2018-03-19 13:26:42', NULL),
(234, 1521487602, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:26:42', '2018-03-19 13:26:42', NULL),
(235, 1521487602, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 13:26:42', '2018-03-19 13:26:42', NULL),
(236, 1521487602, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:26:42', '2018-03-19 13:26:42', NULL),
(237, 1521487602, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:26:42', '2018-03-19 13:26:42', NULL),
(238, 1521487602, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:26:43', '2018-03-19 13:26:43', NULL),
(239, 1521487602, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:26:43', '2018-03-19 13:26:43', NULL),
(240, 1521487602, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:26:43', '2018-03-19 13:26:43', NULL),
(241, 1521487602, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:26:43', '2018-03-19 13:26:43', NULL),
(242, 1521487602, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:26:43', '2018-03-19 13:26:43', NULL),
(243, 1521487602, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 13:26:43', '2018-03-19 13:26:43', NULL),
(244, 1521487925, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 13:32:05', '2018-03-19 13:32:05', NULL),
(245, 1521487925, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:32:05', '2018-03-19 13:32:05', NULL),
(246, 1521487925, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:32:06', '2018-03-19 13:32:06', NULL),
(247, 1521487925, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 13:32:06', '2018-03-19 13:32:06', NULL),
(248, 1521487925, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:32:06', '2018-03-19 13:32:06', NULL),
(249, 1521487925, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:32:06', '2018-03-19 13:32:06', NULL),
(250, 1521487925, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:32:06', '2018-03-19 13:32:06', NULL),
(251, 1521487925, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:32:06', '2018-03-19 13:32:06', NULL),
(252, 1521487925, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:32:06', '2018-03-19 13:32:06', NULL),
(253, 1521487925, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:32:06', '2018-03-19 13:32:06', NULL),
(254, 1521487925, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:32:07', '2018-03-19 13:32:07', NULL),
(255, 1521487925, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 13:32:07', '2018-03-19 13:32:07', NULL),
(256, 1521488142, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 13:35:42', '2018-03-19 13:35:42', NULL),
(257, 1521488142, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:35:42', '2018-03-19 13:35:42', NULL),
(258, 1521488142, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:35:42', '2018-03-19 13:35:42', NULL),
(259, 1521488142, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 13:35:42', '2018-03-19 13:35:42', NULL),
(260, 1521488142, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:35:42', '2018-03-19 13:35:42', NULL),
(261, 1521488142, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:35:43', '2018-03-19 13:35:43', NULL),
(262, 1521488142, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:35:43', '2018-03-19 13:35:43', NULL),
(263, 1521488142, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:35:43', '2018-03-19 13:35:43', NULL),
(264, 1521488142, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:35:43', '2018-03-19 13:35:43', NULL),
(265, 1521488142, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:35:43', '2018-03-19 13:35:43', NULL),
(266, 1521488142, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:35:43', '2018-03-19 13:35:43', NULL),
(267, 1521488142, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 13:35:43', '2018-03-19 13:35:43', NULL),
(268, 1521488164, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 13:36:04', '2018-03-19 13:36:04', NULL),
(269, 1521488164, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:36:04', '2018-03-19 13:36:04', NULL),
(270, 1521488164, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:36:04', '2018-03-19 13:36:04', NULL),
(271, 1521488164, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 13:36:04', '2018-03-19 13:36:04', NULL),
(272, 1521488164, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:36:04', '2018-03-19 13:36:04', NULL),
(273, 1521488164, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:36:05', '2018-03-19 13:36:05', NULL),
(274, 1521488164, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:36:05', '2018-03-19 13:36:05', NULL),
(275, 1521488164, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:36:05', '2018-03-19 13:36:05', NULL),
(276, 1521488164, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:36:05', '2018-03-19 13:36:05', NULL),
(277, 1521488164, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:36:05', '2018-03-19 13:36:05', NULL),
(278, 1521488164, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:36:05', '2018-03-19 13:36:05', NULL),
(279, 1521488164, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 13:36:05', '2018-03-19 13:36:05', NULL),
(280, 1521488285, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 13:38:05', '2018-03-19 13:38:05', NULL),
(281, 1521488285, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:38:05', '2018-03-19 13:38:05', NULL),
(282, 1521488285, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:38:05', '2018-03-19 13:38:05', NULL),
(283, 1521488285, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 13:38:05', '2018-03-19 13:38:05', NULL),
(284, 1521488285, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:38:05', '2018-03-19 13:38:05', NULL),
(285, 1521488285, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:38:05', '2018-03-19 13:38:05', NULL),
(286, 1521488285, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:38:06', '2018-03-19 13:38:06', NULL),
(287, 1521488285, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:38:06', '2018-03-19 13:38:06', NULL),
(288, 1521488285, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:38:06', '2018-03-19 13:38:06', NULL),
(289, 1521488285, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:38:06', '2018-03-19 13:38:06', NULL),
(290, 1521488285, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:38:06', '2018-03-19 13:38:06', NULL),
(291, 1521488285, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 13:38:06', '2018-03-19 13:38:06', NULL),
(292, 1521488357, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 13:39:17', '2018-03-19 13:39:17', NULL),
(293, 1521488357, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:39:17', '2018-03-19 13:39:17', NULL),
(294, 1521488357, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:39:17', '2018-03-19 13:39:17', NULL),
(295, 1521488357, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 13:39:17', '2018-03-19 13:39:17', NULL),
(296, 1521488357, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:39:17', '2018-03-19 13:39:17', NULL),
(297, 1521488357, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:39:17', '2018-03-19 13:39:17', NULL),
(298, 1521488357, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:39:17', '2018-03-19 13:39:17', NULL),
(299, 1521488357, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:39:18', '2018-03-19 13:39:18', NULL),
(300, 1521488357, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:39:18', '2018-03-19 13:39:18', NULL),
(301, 1521488357, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:39:18', '2018-03-19 13:39:18', NULL),
(302, 1521488357, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:39:18', '2018-03-19 13:39:18', NULL),
(303, 1521488357, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 13:39:18', '2018-03-19 13:39:18', NULL),
(304, 1521488527, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 13:42:07', '2018-03-19 13:42:07', NULL),
(305, 1521488527, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:42:07', '2018-03-19 13:42:07', NULL),
(306, 1521488527, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:42:07', '2018-03-19 13:42:07', NULL),
(307, 1521488527, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 13:42:07', '2018-03-19 13:42:07', NULL),
(308, 1521488527, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:42:07', '2018-03-19 13:42:07', NULL),
(309, 1521488527, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:42:08', '2018-03-19 13:42:08', NULL),
(310, 1521488527, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:42:08', '2018-03-19 13:42:08', NULL),
(311, 1521488527, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:42:08', '2018-03-19 13:42:08', NULL),
(312, 1521488527, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:42:08', '2018-03-19 13:42:08', NULL),
(313, 1521488527, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:42:08', '2018-03-19 13:42:08', NULL),
(314, 1521488527, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:42:08', '2018-03-19 13:42:08', NULL),
(315, 1521488527, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 13:42:08', '2018-03-19 13:42:08', NULL),
(316, 1521488551, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 13:42:31', '2018-03-19 13:42:31', NULL),
(317, 1521488551, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:42:31', '2018-03-19 13:42:31', NULL),
(318, 1521488551, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:42:31', '2018-03-19 13:42:31', NULL),
(319, 1521488551, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 13:42:31', '2018-03-19 13:42:31', NULL),
(320, 1521488551, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:42:31', '2018-03-19 13:42:31', NULL),
(321, 1521488551, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:42:31', '2018-03-19 13:42:31', NULL),
(322, 1521488551, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:42:32', '2018-03-19 13:42:32', NULL),
(323, 1521488551, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:42:32', '2018-03-19 13:42:32', NULL),
(324, 1521488551, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:42:32', '2018-03-19 13:42:32', NULL),
(325, 1521488551, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:42:32', '2018-03-19 13:42:32', NULL),
(326, 1521488551, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:42:32', '2018-03-19 13:42:32', NULL),
(327, 1521488551, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 13:42:32', '2018-03-19 13:42:32', NULL),
(328, 1521489171, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 13:52:51', '2018-03-19 13:52:51', NULL),
(329, 1521489171, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:52:51', '2018-03-19 13:52:51', NULL),
(330, 1521489171, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:52:51', '2018-03-19 13:52:51', NULL),
(331, 1521489171, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 13:52:52', '2018-03-19 13:52:52', NULL),
(332, 1521489171, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:52:52', '2018-03-19 13:52:52', NULL),
(333, 1521489171, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:52:52', '2018-03-19 13:52:52', NULL),
(334, 1521489171, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:52:52', '2018-03-19 13:52:52', NULL),
(335, 1521489171, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:52:52', '2018-03-19 13:52:52', NULL),
(336, 1521489171, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:52:53', '2018-03-19 13:52:53', NULL),
(337, 1521489171, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:52:53', '2018-03-19 13:52:53', NULL),
(338, 1521489171, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:52:53', '2018-03-19 13:52:53', NULL),
(339, 1521489171, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 13:52:53', '2018-03-19 13:52:53', NULL),
(340, 1521489281, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 13:54:41', '2018-03-19 13:54:41', NULL),
(341, 1521489281, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:54:41', '2018-03-19 13:54:41', NULL),
(342, 1521489281, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:54:41', '2018-03-19 13:54:41', NULL),
(343, 1521489281, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 13:54:41', '2018-03-19 13:54:41', NULL);
INSERT INTO `lsp_invoice_products` (`id`, `invoice_id`, `product_id`, `quantity`, `price`, `cost`, `tax_percent`, `tax_amount`, `discount_percent`, `discount_amount`, `cupon_amount`, `total_price`, `total_cost`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(344, 1521489281, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 13:54:41', '2018-03-19 13:54:41', NULL),
(345, 1521489281, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:54:41', '2018-03-19 13:54:41', NULL),
(346, 1521489281, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:54:41', '2018-03-19 13:54:41', NULL),
(347, 1521489281, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 13:54:41', '2018-03-19 13:54:41', NULL),
(348, 1521489281, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-19 13:54:42', '2018-03-19 13:54:42', NULL),
(349, 1521489281, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:54:42', '2018-03-19 13:54:42', NULL),
(350, 1521489281, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 13:54:42', '2018-03-19 13:54:42', NULL),
(351, 1521489281, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-03-19 13:54:42', '2018-03-19 13:54:42', NULL),
(352, 1521490160, 1, 2, 1.22, 1.00, 3.00, 0.07, 0.00, 0.00, 0.00, 2.44, 2.00, 13, 1, 0, '2018-03-19 15:13:24', '2018-03-19 15:13:24', NULL),
(353, 1521490160, 3, 2, 100.00, 50.00, 3.00, 6.00, 0.00, 0.00, 0.00, 200.00, 100.00, 13, 1, 0, '2018-03-19 15:13:24', '2018-03-19 15:13:24', NULL),
(354, 1521490160, 1, 2, 1.22, 1.00, 3.00, 0.07, 0.00, 0.00, 0.00, 2.44, 2.00, 13, 1, 0, '2018-03-19 15:13:33', '2018-03-19 15:13:33', NULL),
(355, 1521490160, 3, 2, 100.00, 50.00, 3.00, 6.00, 0.00, 0.00, 0.00, 200.00, 100.00, 13, 1, 0, '2018-03-19 15:13:33', '2018-03-19 15:13:33', NULL),
(356, 1521490160, 1, 2, 1.22, 1.00, 3.00, 0.07, 0.00, 0.00, 0.00, 2.44, 2.00, 13, 1, 0, '2018-03-19 15:14:02', '2018-03-19 15:14:02', NULL),
(357, 1521490160, 3, 2, 100.00, 50.00, 3.00, 6.00, 0.00, 0.00, 0.00, 200.00, 100.00, 13, 1, 0, '2018-03-19 15:14:03', '2018-03-19 15:14:03', NULL),
(358, 1521494043, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-19 15:14:53', '2018-03-19 15:14:53', NULL),
(359, 1521494043, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 15:14:54', '2018-03-19 15:14:54', NULL),
(360, 1521494043, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-19 15:14:54', '2018-03-19 15:14:54', NULL),
(361, 1521494043, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-19 15:14:54', '2018-03-19 15:14:54', NULL),
(362, 1521494094, 44, 3, 22.00, 22.00, 3.00, 1.98, 0.00, 0.00, 0.00, 66.00, 66.00, 13, 1, 0, '2018-03-19 15:17:32', '2018-03-19 15:17:32', NULL),
(363, 1521494094, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-03-19 15:17:33', '2018-03-19 15:17:33', NULL),
(364, 1521494094, 39, 8, 11.00, 11.00, 3.00, 2.64, 0.00, 0.00, 0.00, 88.00, 88.00, 13, 1, 0, '2018-03-19 15:17:33', '2018-03-19 15:17:33', NULL),
(365, 1521494094, 37, 2, 10.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-19 15:17:33', '2018-03-19 15:17:33', NULL),
(366, 1521494094, 30, 6, 2.00, 1.00, 3.00, 0.36, 0.00, 0.00, 0.00, 12.00, 6.00, 13, 1, 0, '2018-03-19 15:17:33', '2018-03-19 15:17:33', NULL),
(367, 1521494094, 32, 4, 10.00, 5.00, 3.00, 1.20, 0.00, 0.00, 0.00, 40.00, 20.00, 13, 1, 0, '2018-03-19 15:17:33', '2018-03-19 15:17:33', NULL),
(368, 1521494094, 41, 3, 4.00, 4.00, 3.00, 0.36, 0.00, 0.00, 0.00, 12.00, 12.00, 13, 1, 0, '2018-03-19 15:17:33', '2018-03-19 15:17:33', NULL),
(369, 1521494094, 27, 2, 47.00, 42.00, 3.00, 2.82, 0.00, 0.00, 0.00, 94.00, 84.00, 13, 1, 0, '2018-03-19 15:17:33', '2018-03-19 15:17:33', NULL),
(370, 1521494094, 22, 4, 14.00, 9.00, 3.00, 1.68, 0.00, 0.00, 0.00, 56.00, 36.00, 13, 1, 0, '2018-03-19 15:17:34', '2018-03-19 15:17:34', NULL),
(371, 1521494094, 18, 2, 26.00, 21.00, 3.00, 1.56, 0.00, 0.00, 0.00, 52.00, 42.00, 13, 1, 0, '2018-03-19 15:17:34', '2018-03-19 15:17:34', NULL),
(372, 1521494094, 14, 2, 22.00, 22.00, 3.00, 1.32, 0.00, 0.00, 0.00, 44.00, 44.00, 13, 1, 0, '2018-03-19 15:17:34', '2018-03-19 15:17:34', NULL),
(373, 1521494094, 25, 2, 45.00, 40.00, 3.00, 2.70, 0.00, 0.00, 0.00, 90.00, 80.00, 13, 1, 0, '2018-03-19 15:17:34', '2018-03-19 15:17:34', NULL),
(374, 1521494094, 4, 5, 19.00, 12.00, 3.00, 2.85, 0.00, 0.00, 0.00, 95.00, 60.00, 13, 1, 0, '2018-03-19 15:17:34', '2018-03-19 15:17:34', NULL),
(375, 1521494094, 1, 5, 1.22, 1.00, 3.00, 0.18, 0.00, 0.00, 0.00, 6.10, 5.00, 13, 1, 0, '2018-03-19 15:17:34', '2018-03-19 15:17:34', NULL),
(376, 1521494094, 7, 4, 12.00, 10.00, 3.00, 1.44, 0.00, 0.00, 0.00, 48.00, 40.00, 13, 1, 0, '2018-03-19 15:17:34', '2018-03-19 15:17:34', NULL),
(377, 1521494094, 11, 4, 32.00, 27.00, 3.00, 3.84, 0.00, 0.00, 0.00, 128.00, 108.00, 13, 1, 0, '2018-03-19 15:17:34', '2018-03-19 15:17:34', NULL),
(378, 1521494094, 10, 4, 32.00, 27.00, 3.00, 3.84, 0.00, 0.00, 0.00, 128.00, 108.00, 13, 1, 0, '2018-03-19 15:17:35', '2018-03-19 15:17:35', NULL),
(379, 1521494094, 9, 4, 38.00, 33.00, 3.00, 4.56, 0.00, 0.00, 0.00, 152.00, 132.00, 13, 1, 0, '2018-03-19 15:17:35', '2018-03-19 15:17:35', NULL),
(380, 1521494094, 3, 2, 100.00, 50.00, 3.00, 6.00, 0.00, 0.00, 0.00, 200.00, 100.00, 13, 1, 0, '2018-03-19 15:17:35', '2018-03-19 15:17:35', NULL),
(381, 1521494094, 6, 2, 15.00, 11.25, 3.00, 0.90, 0.00, 0.00, 0.00, 30.00, 22.50, 13, 1, 0, '2018-03-19 15:17:35', '2018-03-19 15:17:35', NULL),
(382, 1521494094, 5, 2, 38.00, 33.00, 3.00, 2.28, 0.00, 0.00, 0.00, 76.00, 66.00, 13, 1, 0, '2018-03-19 15:17:35', '2018-03-19 15:17:35', NULL),
(383, 1521566125, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-03-20 11:15:28', '2018-03-20 11:15:28', NULL),
(384, 1521566125, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-20 11:15:29', '2018-03-20 11:15:29', NULL),
(385, 1521566125, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-20 11:15:29', '2018-03-20 11:15:29', NULL),
(386, 1521566125, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-20 11:15:29', '2018-03-20 11:15:29', NULL),
(387, 1521566125, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-20 11:15:29', '2018-03-20 11:15:29', NULL),
(388, 1521566125, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-20 11:15:29', '2018-03-20 11:15:29', NULL),
(389, 1521566125, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-20 11:15:29', '2018-03-20 11:15:29', NULL),
(390, 1521566125, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-20 11:15:29', '2018-03-20 11:15:29', NULL),
(391, 1521566130, 28, 1, 47.00, 42.00, 3.00, 1.41, 0.00, 0.00, 0.00, 47.00, 42.00, 13, 1, 0, '2018-03-20 11:27:08', '2018-03-20 11:27:08', NULL),
(392, 1521566130, 27, 1, 47.00, 42.00, 3.00, 1.41, 0.00, 0.00, 0.00, 47.00, 42.00, 13, 1, 0, '2018-03-20 11:27:08', '2018-03-20 11:27:08', NULL),
(393, 1521566130, 26, 1, 45.00, 40.00, 3.00, 1.35, 0.00, 0.00, 0.00, 45.00, 40.00, 13, 1, 0, '2018-03-20 11:27:08', '2018-03-20 11:27:08', NULL),
(394, 1521566130, 25, 1, 45.00, 40.00, 3.00, 1.35, 0.00, 0.00, 0.00, 45.00, 40.00, 13, 1, 0, '2018-03-20 11:27:08', '2018-03-20 11:27:08', NULL),
(395, 1521566130, 24, 1, 165.00, 155.00, 3.00, 4.95, 0.00, 0.00, 0.00, 165.00, 155.00, 13, 1, 0, '2018-03-20 11:27:08', '2018-03-20 11:27:08', NULL),
(396, 1521566130, 23, 1, 30.00, 30.00, 3.00, 0.90, 0.00, 0.00, 0.00, 30.00, 30.00, 13, 1, 0, '2018-03-20 11:27:08', '2018-03-20 11:27:08', NULL),
(397, 1521752981, 44, 4, 22.00, 22.00, 3.00, 2.64, 0.00, 0.00, 0.00, 88.00, 88.00, 13, 1, 0, '2018-03-22 15:58:43', '2018-03-22 15:58:43', NULL),
(398, 1521752981, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-22 15:58:43', '2018-03-22 15:58:43', NULL),
(399, 1521752981, 42, 2, 10.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-22 15:58:44', '2018-03-22 15:58:44', NULL),
(400, 1521752981, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-22 15:58:44', '2018-03-22 15:58:44', NULL),
(401, 1521752981, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-22 15:58:44', '2018-03-22 15:58:44', NULL),
(402, 1521752981, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-22 15:58:44', '2018-03-22 15:58:44', NULL),
(403, 1521752981, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-22 15:58:44', '2018-03-22 15:58:44', NULL),
(404, 1521752981, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-22 15:58:45', '2018-03-22 15:58:45', NULL),
(405, 1521752981, 44, 4, 22.00, 22.00, 3.00, 2.64, 0.00, 0.00, 0.00, 88.00, 88.00, 13, 1, 0, '2018-03-22 15:59:11', '2018-03-22 15:59:11', NULL),
(406, 1521752981, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-22 15:59:11', '2018-03-22 15:59:11', NULL),
(407, 1521752981, 42, 2, 10.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-22 15:59:11', '2018-03-22 15:59:11', NULL),
(408, 1521752981, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-22 15:59:11', '2018-03-22 15:59:11', NULL),
(409, 1521752981, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-22 15:59:12', '2018-03-22 15:59:12', NULL),
(410, 1521752981, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-22 15:59:12', '2018-03-22 15:59:12', NULL),
(411, 1521752981, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-22 15:59:12', '2018-03-22 15:59:12', NULL),
(412, 1521752981, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-22 15:59:12', '2018-03-22 15:59:12', NULL),
(413, 1521752981, 44, 4, 22.00, 22.00, 3.00, 2.64, 0.00, 0.00, 0.00, 88.00, 88.00, 13, 1, 0, '2018-03-22 16:01:59', '2018-03-22 16:01:59', NULL),
(414, 1521752981, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-22 16:01:59', '2018-03-22 16:01:59', NULL),
(415, 1521752981, 42, 2, 10.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-22 16:02:00', '2018-03-22 16:02:00', NULL),
(416, 1521752981, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-03-22 16:02:00', '2018-03-22 16:02:00', NULL),
(417, 1521752981, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-03-22 16:02:00', '2018-03-22 16:02:00', NULL),
(418, 1521752981, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-03-22 16:02:00', '2018-03-22 16:02:00', NULL),
(419, 1521752981, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-22 16:02:01', '2018-03-22 16:02:01', NULL),
(420, 1521752981, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-03-22 16:02:01', '2018-03-22 16:02:01', NULL),
(421, 1521756122, 44, 3, 22.00, 22.00, 3.00, 1.98, 0.00, 0.00, 0.00, 66.00, 66.00, 13, 1, 0, '2018-03-22 16:23:29', '2018-03-23 12:19:25', '2018-03-23 12:19:25'),
(422, 1521756122, 35, 3, 10.00, 5.00, 3.00, 0.90, 0.00, 0.00, 0.00, 30.00, 15.00, 13, 1, 0, '2018-03-22 16:23:29', '2018-03-23 12:19:25', '2018-03-23 12:19:25'),
(423, 1521757410, 44, 4, 22.00, 22.00, 3.00, 2.64, 0.00, 0.00, 0.00, 88.00, 88.00, 13, 1, 0, '2018-03-22 16:25:42', '2018-03-22 16:25:42', NULL),
(424, 1521757410, 43, 3, 20.00, 20.00, 3.00, 1.80, 0.00, 0.00, 0.00, 60.00, 60.00, 13, 1, 0, '2018-03-22 16:25:42', '2018-03-22 16:25:42', NULL),
(425, 1521759827, 4, 1, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 12.00, 13, 1, 0, '2018-03-22 17:03:47', '2018-03-22 17:03:47', NULL),
(426, 1521759827, 4, 1, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 12.00, 13, 1, 0, '2018-03-22 17:03:47', '2018-03-22 17:03:47', NULL),
(427, 1521756122, 44, 3, 22.00, 22.00, 0.00, 0.00, 0.00, 0.00, 0.00, 66.00, 66.00, 13, 1, 1, '2018-03-23 12:19:25', '2018-03-23 12:19:25', NULL),
(428, 1521756122, 35, 3, 10.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 30.00, 15.00, 13, 1, 1, '2018-03-23 12:19:26', '2018-03-23 12:19:26', NULL),
(429, 1521846193, 44, 4, 22.00, 22.00, 3.00, 2.64, 0.00, 0.00, 0.00, 88.00, 88.00, 13, 1, 0, '2018-03-23 17:03:13', '2018-03-23 17:03:13', NULL),
(430, 1521846193, 40, 3, 20.00, 20.00, 3.00, 1.80, 0.00, 0.00, 0.00, 60.00, 60.00, 13, 1, 0, '2018-03-23 17:03:13', '2018-03-23 17:03:13', NULL),
(431, 1523220777, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-04-08 14:54:20', '2018-04-08 14:54:20', NULL),
(432, 1523220777, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-04-08 14:54:20', '2018-04-08 14:54:20', NULL),
(433, 1523220777, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-04-08 14:54:20', '2018-04-08 14:54:20', NULL),
(434, 1523220777, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-04-08 14:54:21', '2018-04-08 14:54:21', NULL),
(435, 1523220777, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-04-08 14:54:21', '2018-04-08 14:54:21', NULL),
(436, 1523220777, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-04-08 14:54:21', '2018-04-08 14:54:21', NULL),
(437, 1523220777, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-04-08 14:54:21', '2018-04-08 14:54:21', NULL),
(438, 1523220777, 37, 2, 10.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-04-08 14:54:21', '2018-04-08 14:54:21', NULL),
(439, 1523220876, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-04-08 15:04:56', '2018-04-08 15:04:56', NULL),
(440, 1523220876, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-04-08 15:04:56', '2018-04-08 15:04:56', NULL),
(441, 1523220876, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-04-08 15:04:56', '2018-04-08 15:04:56', NULL),
(442, 1523221497, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-04-08 16:04:08', '2018-04-08 16:04:08', NULL),
(443, 1523221497, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-04-08 16:04:08', '2018-04-08 16:04:08', NULL),
(444, 1523221497, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-04-08 16:04:09', '2018-04-08 16:04:09', NULL),
(445, 1523221497, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-04-08 16:04:09', '2018-04-08 16:04:09', NULL),
(446, 1523221497, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-04-08 16:04:09', '2018-04-08 16:04:09', NULL),
(447, 1523221497, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-04-08 16:04:09', '2018-04-08 16:04:09', NULL),
(448, 1523221497, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-04-08 16:04:09', '2018-04-08 16:04:09', NULL),
(449, 1523221497, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-04-08 16:04:09', '2018-04-08 16:04:09', NULL),
(450, 1523225050, 36, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-04-08 16:13:07', '2018-04-08 16:13:07', NULL),
(451, 1523225050, 35, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-04-08 16:13:07', '2018-04-08 16:13:07', NULL),
(452, 1523225050, 34, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-04-08 16:13:07', '2018-04-08 16:13:07', NULL),
(453, 1523225050, 33, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 13, 1, 0, '2018-04-08 16:13:07', '2018-04-08 16:13:07', NULL),
(454, 1523294846, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-04-09 13:48:21', '2018-04-09 13:48:21', NULL),
(455, 1523294846, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-04-09 13:48:22', '2018-04-09 13:48:22', NULL),
(456, 1523294846, 42, 2, 10.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-04-09 13:48:22', '2018-04-09 13:48:22', NULL),
(457, 1523294846, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-04-09 13:48:22', '2018-04-09 13:48:22', NULL),
(458, 1523294846, 37, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-04-09 13:48:22', '2018-04-09 13:48:22', NULL),
(459, 1523294846, 38, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-04-09 13:48:22', '2018-04-09 13:48:22', NULL),
(460, 1523294846, 39, 1, 11.00, 11.00, 3.00, 0.33, 0.00, 0.00, 0.00, 11.00, 11.00, 13, 1, 0, '2018-04-09 13:48:22', '2018-04-09 13:48:22', NULL),
(461, 1523294846, 40, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-04-09 13:48:22', '2018-04-09 13:48:22', NULL),
(462, 1523303303, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-04-09 15:44:51', '2018-04-09 15:44:51', NULL),
(463, 1523303303, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-04-09 15:44:51', '2018-04-09 15:44:51', NULL),
(464, 1523303303, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-04-09 15:44:51', '2018-04-09 15:44:51', NULL),
(465, 1523303303, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-04-09 15:44:51', '2018-04-09 15:44:51', NULL),
(466, 1523310292, 32, 1, 10.00, 5.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 5.00, 13, 1, 0, '2018-04-09 16:35:43', '2018-04-09 16:35:43', NULL),
(467, 1523310292, 31, 1, 10.00, 20.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 20.00, 13, 1, 0, '2018-04-09 16:35:44', '2018-04-09 16:35:44', NULL),
(468, 1523310292, 30, 1, 2.00, 1.00, 3.00, 0.06, 0.00, 0.00, 0.00, 2.00, 1.00, 13, 1, 0, '2018-04-09 16:35:44', '2018-04-09 16:35:44', NULL),
(469, 1523387430, 44, 1, 22.00, 22.00, 3.00, 0.66, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-04-10 14:37:24', '2018-04-10 14:37:24', NULL),
(470, 1523387430, 43, 1, 20.00, 20.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 20.00, 13, 1, 0, '2018-04-10 14:37:24', '2018-04-10 14:37:24', NULL),
(471, 1523387430, 42, 1, 10.00, 10.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 10.00, 13, 1, 0, '2018-04-10 14:37:25', '2018-04-10 14:37:25', NULL),
(472, 1523387430, 41, 1, 4.00, 4.00, 3.00, 0.12, 0.00, 0.00, 0.00, 4.00, 4.00, 13, 1, 0, '2018-04-10 14:37:25', '2018-04-10 14:37:25', NULL),
(473, 1525017380, 45, 1, 10.00, 20.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 20.00, 1, 1, 0, '2018-04-29 09:58:04', '2018-04-29 09:58:04', NULL),
(474, 1525373162, 58, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-03 12:46:52', '2018-05-03 12:46:52', NULL),
(475, 1525373162, 57, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-03 12:46:52', '2018-05-03 12:46:52', NULL),
(476, 1525373162, 56, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-03 12:46:52', '2018-05-03 12:46:52', NULL),
(477, 1525373162, 55, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-03 12:46:52', '2018-05-03 12:46:52', NULL),
(478, 1525373162, 54, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-03 12:46:53', '2018-05-03 12:46:53', NULL),
(479, 1525373162, 53, 1, 1000.00, 800.00, 3.00, 30.00, 0.00, 0.00, 0.00, 1000.00, 800.00, 1, 1, 0, '2018-05-03 12:46:53', '2018-05-03 12:46:53', NULL),
(480, 1525373162, 52, 1, 500.00, 400.00, 3.00, 15.00, 0.00, 0.00, 0.00, 500.00, 400.00, 1, 1, 0, '2018-05-03 12:46:53', '2018-05-03 12:46:53', NULL),
(481, 1525373162, 51, 1, 100.00, 50.00, 3.00, 3.00, 0.00, 0.00, 0.00, 100.00, 50.00, 1, 1, 0, '2018-05-03 12:46:53', '2018-05-03 12:46:53', NULL),
(482, 1525978703, 58, 2, 20.00, 10.00, 3.00, 1.20, 0.00, 0.00, 0.00, 40.00, 20.00, 1, 1, 0, '2018-05-10 20:08:20', '2018-05-10 20:08:20', NULL),
(483, 1525978703, 57, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-10 20:08:21', '2018-05-10 20:08:21', NULL),
(484, 1526041609, 58, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 06:27:32', '2018-05-11 06:27:32', NULL),
(485, 1526041609, 54, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 06:27:32', '2018-05-11 06:27:32', NULL),
(486, 1526042681, 58, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 16:39:55', '2018-05-11 16:39:55', NULL),
(487, 1526042681, 54, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 16:39:55', '2018-05-11 16:39:55', NULL),
(488, 1526042681, 45, 1, 10.00, 20.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 20.00, 1, 1, 0, '2018-05-11 16:39:56', '2018-05-11 16:39:56', NULL),
(489, 1526078547, 58, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 16:43:21', '2018-05-11 16:43:21', NULL),
(490, 1526078602, 54, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 16:43:49', '2018-05-11 16:43:49', NULL),
(491, 1526078602, 45, 1, 10.00, 20.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 20.00, 1, 1, 0, '2018-05-11 16:43:49', '2018-05-11 16:43:49', NULL),
(492, 1526078602, 50, 1, 5.00, 3.00, 3.00, 0.15, 0.00, 0.00, 0.00, 5.00, 3.00, 1, 1, 0, '2018-05-11 16:43:49', '2018-05-11 16:43:49', NULL),
(493, 1526078602, 53, 1, 1000.00, 800.00, 3.00, 30.00, 0.00, 0.00, 0.00, 1000.00, 800.00, 1, 1, 0, '2018-05-11 16:43:49', '2018-05-11 16:43:49', NULL),
(494, 1526078602, 58, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 16:43:49', '2018-05-11 16:43:49', NULL),
(495, 1526078652, 58, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 16:46:40', '2018-05-11 16:46:40', NULL),
(496, 1526078652, 54, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 16:46:41', '2018-05-11 16:46:41', NULL),
(497, 1526078652, 49, 1, 10.00, 2.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 2.00, 1, 1, 0, '2018-05-11 16:46:41', '2018-05-11 16:46:41', NULL),
(498, 1526078809, 58, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 16:47:18', '2018-05-11 16:47:18', NULL),
(499, 1526078809, 54, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 16:47:18', '2018-05-11 16:47:18', NULL),
(500, 1526078809, 53, 1, 1000.00, 800.00, 3.00, 30.00, 0.00, 0.00, 0.00, 1000.00, 800.00, 1, 1, 0, '2018-05-11 16:47:19', '2018-05-11 16:47:19', NULL),
(501, 1526078809, 49, 1, 10.00, 2.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 2.00, 1, 1, 0, '2018-05-11 16:47:19', '2018-05-11 16:47:19', NULL),
(502, 1526078840, 58, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 16:47:38', '2018-05-11 16:47:38', NULL),
(503, 1526078840, 54, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 16:47:38', '2018-05-11 16:47:38', NULL),
(504, 1526078840, 45, 1, 10.00, 20.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 20.00, 1, 1, 0, '2018-05-11 16:47:38', '2018-05-11 16:47:38', NULL),
(505, 1526078859, 58, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 17:08:19', '2018-05-11 17:08:19', NULL),
(506, 1526078859, 54, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-11 17:08:20', '2018-05-11 17:08:20', NULL),
(507, 1526078859, 45, 1, 10.00, 20.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 20.00, 1, 1, 0, '2018-05-11 17:08:20', '2018-05-11 17:08:20', NULL),
(508, 1527361793, 58, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-26 13:11:21', '2018-05-26 13:11:21', NULL),
(509, 1527361793, 57, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-26 13:11:21', '2018-05-26 13:11:21', NULL),
(510, 1527361793, 56, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-26 13:11:21', '2018-05-26 13:11:21', NULL),
(511, 1527361793, 55, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-26 13:11:21', '2018-05-26 13:11:21', NULL),
(512, 1527361793, 54, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-26 13:11:21', '2018-05-26 13:11:21', NULL),
(513, 1527361793, 53, 1, 1000.00, 800.00, 3.00, 30.00, 0.00, 0.00, 0.00, 1000.00, 800.00, 1, 1, 0, '2018-05-26 13:11:21', '2018-05-26 13:11:21', NULL),
(514, 1527361793, 52, 1, 500.00, 400.00, 3.00, 15.00, 0.00, 0.00, 0.00, 500.00, 400.00, 1, 1, 0, '2018-05-26 13:11:22', '2018-05-26 13:11:22', NULL),
(515, 1527361793, 51, 1, 100.00, 50.00, 3.00, 3.00, 0.00, 0.00, 0.00, 100.00, 50.00, 1, 1, 0, '2018-05-26 13:11:22', '2018-05-26 13:11:22', NULL),
(516, 1527361892, 58, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-26 13:13:03', '2018-05-26 13:13:03', NULL),
(517, 1527361984, 58, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-26 15:07:33', '2018-05-26 15:07:33', NULL),
(518, 1527361984, 57, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-26 15:07:33', '2018-05-26 15:07:33', NULL),
(519, 1527361984, 56, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-26 15:07:34', '2018-05-26 15:07:34', NULL),
(520, 1527361984, 55, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-26 15:07:34', '2018-05-26 15:07:34', NULL),
(521, 1527361984, 54, 1, 20.00, 10.00, 3.00, 0.60, 0.00, 0.00, 0.00, 20.00, 10.00, 1, 1, 0, '2018-05-26 15:07:34', '2018-05-26 15:07:34', NULL),
(522, 1527361984, 53, 1, 1000.00, 800.00, 3.00, 30.00, 0.00, 0.00, 0.00, 1000.00, 800.00, 1, 1, 0, '2018-05-26 15:07:34', '2018-05-26 15:07:34', NULL),
(523, 1527361984, 52, 1, 500.00, 400.00, 3.00, 15.00, 0.00, 0.00, 0.00, 500.00, 400.00, 1, 1, 0, '2018-05-26 15:07:34', '2018-05-26 15:07:34', NULL),
(524, 1527361984, 51, 1, 100.00, 50.00, 3.00, 3.00, 0.00, 0.00, 0.00, 100.00, 50.00, 1, 1, 0, '2018-05-26 15:07:34', '2018-05-26 15:07:34', NULL),
(525, 1527361984, 50, 1, 5.00, 3.00, 3.00, 0.15, 0.00, 0.00, 0.00, 5.00, 3.00, 1, 1, 0, '2018-05-26 15:07:34', '2018-05-26 15:07:34', NULL),
(526, 1527361984, 49, 1, 10.00, 2.00, 3.00, 0.30, 0.00, 0.00, 0.00, 10.00, 2.00, 1, 1, 0, '2018-05-26 15:07:34', '2018-05-26 15:07:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_invoice_profits`
--

CREATE TABLE `lsp_invoice_profits` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `invoice_datetime` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_total_amount` double(8,2) NOT NULL,
  `invoice_cost_total_amount` double(8,2) NOT NULL,
  `profit` double(8,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lsp_login_activities`
--

CREATE TABLE `lsp_login_activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_login_activities`
--

INSERT INTO `lsp_login_activities` (`id`, `user_id`, `store_id`, `name`, `activity_type`, `user_agent`, `activity`, `ip_address`, `created_at`, `updated_at`) VALUES
(12, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Logout Successfully', '::1', '2018-04-13 15:43:45', '2018-04-13 15:43:45'),
(13, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Login Successfully', '::1', '2018-04-13 15:43:49', '2018-04-13 15:43:49'),
(14, 1, 1, 'Md Fahad Bhuyian', 'customer', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Customer account created.', '::1', '2018-04-13 16:41:52', '2018-04-13 16:41:52'),
(15, 1, 1, 'Md Fahad Bhuyian', 'tender', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Tender Type created', '::1', '2018-04-13 16:53:43', '2018-04-13 16:53:43'),
(16, 1, 0, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Logout Successfully', '::1', '2018-04-13 16:59:40', '2018-04-13 16:59:40'),
(17, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Login Successfully', '::1', '2018-04-13 16:59:44', '2018-04-13 16:59:44'),
(18, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Login Successfully', '::1', '2018-04-14 04:18:14', '2018-04-14 04:18:14'),
(19, 1, 0, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Logout Successfully', '::1', '2018-04-14 12:18:53', '2018-04-14 12:18:53'),
(20, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Login Successfully', '::1', '2018-04-14 12:19:03', '2018-04-14 12:19:03'),
(21, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Product created', '::1', '2018-04-14 12:31:30', '2018-04-14 12:31:30'),
(22, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Counter display status updated.', '::1', '2018-04-14 12:33:00', '2018-04-14 12:33:00'),
(23, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Login Successfully', '::1', '2018-04-16 13:16:34', '2018-04-16 13:16:34'),
(24, 1, 0, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Logout Successfully', '::1', '2018-04-16 13:44:47', '2018-04-16 13:44:47'),
(25, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Login Successfully', '::1', '2018-04-16 13:44:52', '2018-04-16 13:44:52'),
(26, 1, 0, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Logout Successfully', '::1', '2018-04-16 15:38:34', '2018-04-16 15:38:34'),
(27, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Login Successfully', '::1', '2018-04-17 10:03:51', '2018-04-17 10:03:51'),
(28, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-04-29 09:56:19', '2018-04-29 09:56:19'),
(29, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Invoice Created, Invoice ID : 1525017380', '::1', '2018-04-29 09:58:04', '2018-04-29 09:58:04'),
(30, 1, 0, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Logout Successfully', '::1', '2018-04-29 10:40:04', '2018-04-29 10:40:04'),
(31, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-04-29 10:40:08', '2018-04-29 10:40:08'),
(32, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Counter display status updated.', '::1', '2018-04-29 10:40:17', '2018-04-29 10:40:17'),
(33, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Counter display status updated.', '::1', '2018-04-29 10:40:18', '2018-04-29 10:40:18'),
(34, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Login Successfully', '192.168.0.8', '2018-04-29 14:16:20', '2018-04-29 14:16:20'),
(35, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-04-30 02:05:28', '2018-04-30 02:05:28'),
(36, 1, 1, 'Md Fahad Bhuyian', 'Report', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Report Settings Created', '::1', '2018-04-30 09:05:44', '2018-04-30 09:05:44'),
(37, 1, 1, 'Md Fahad Bhuyian', 'Report', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Report Settings Created', '::1', '2018-04-30 09:07:09', '2018-04-30 09:07:09'),
(38, 1, 1, 'Md Fahad Bhuyian', 'Report', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Report Settings Created', '::1', '2018-04-30 09:09:48', '2018-04-30 09:09:48'),
(39, 1, 1, 'Md Fahad Bhuyian', 'Report', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Report Settings Created', '::1', '2018-04-30 09:11:28', '2018-04-30 09:11:28'),
(40, 1, 1, 'Md Fahad Bhuyian', 'Report', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Report Settings Created', '::1', '2018-04-30 09:12:15', '2018-04-30 09:12:15'),
(41, 1, 1, 'Md Fahad Bhuyian', 'Report', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Report Settings Updated', '::1', '2018-04-30 09:35:07', '2018-04-30 09:35:07'),
(42, 1, 1, 'Md Fahad Bhuyian', 'Report', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Report Settings Updated', '::1', '2018-04-30 09:43:52', '2018-04-30 09:43:52'),
(43, 1, 1, 'Md Fahad Bhuyian', 'Report', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Report Settings Updated', '::1', '2018-04-30 09:44:41', '2018-04-30 09:44:41'),
(44, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-04-30 12:53:57', '2018-04-30 12:53:57'),
(45, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Login Successfully', '192.168.0.5', '2018-04-30 13:49:25', '2018-04-30 13:49:25'),
(46, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-04-30 14:54:52', '2018-04-30 14:54:52'),
(47, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-04-30 15:20:33', '2018-04-30 15:20:33'),
(48, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-04-30 15:29:05', '2018-04-30 15:29:05'),
(49, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-04-30 15:32:13', '2018-04-30 15:32:13'),
(50, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '192.168.0.7', '2018-04-30 15:34:58', '2018-04-30 15:34:58'),
(51, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-04-30 15:53:03', '2018-04-30 15:53:03'),
(52, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-04-30 16:11:30', '2018-04-30 16:11:30'),
(53, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-04-30 16:13:50', '2018-04-30 16:13:50'),
(54, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-04-30 16:19:16', '2018-04-30 16:19:16'),
(55, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-04-30 16:39:51', '2018-04-30 16:39:51'),
(56, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-05-01 08:38:05', '2018-05-01 08:38:05'),
(57, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '192.168.0.8', '2018-05-01 12:22:32', '2018-05-01 12:22:32'),
(58, 1, 0, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Logout Successfully', '192.168.0.8', '2018-05-01 12:25:36', '2018-05-01 12:25:36'),
(59, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '192.168.0.8', '2018-05-01 12:27:05', '2018-05-01 12:27:05'),
(60, 1, 0, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Logout Successfully', '192.168.0.8', '2018-05-01 12:27:58', '2018-05-01 12:27:58'),
(61, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-05-01 12:28:24', '2018-05-01 12:28:24'),
(62, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '192.168.0.8', '2018-05-01 12:28:41', '2018-05-01 12:28:41'),
(63, 1, 0, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Logout Successfully', '::1', '2018-05-01 12:29:14', '2018-05-01 12:29:14'),
(64, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-05-01 12:29:19', '2018-05-01 12:29:19'),
(65, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '192.168.0.8', '2018-05-01 12:29:44', '2018-05-01 12:29:44'),
(66, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-05-01 12:45:09', '2018-05-01 12:45:09'),
(67, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-05-01 14:02:58', '2018-05-01 14:02:58'),
(68, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Product created', '192.168.0.8', '2018-05-01 15:23:06', '2018-05-01 15:23:06'),
(69, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Product created', '192.168.0.8', '2018-05-01 15:23:24', '2018-05-01 15:23:24'),
(70, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Product created', '192.168.0.8', '2018-05-01 15:23:38', '2018-05-01 15:23:38'),
(71, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Product created', '192.168.0.8', '2018-05-01 15:25:35', '2018-05-01 15:25:35'),
(72, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Product created', '192.168.0.8', '2018-05-01 15:25:58', '2018-05-01 15:25:58'),
(73, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Product created', '192.168.0.8', '2018-05-01 15:26:22', '2018-05-01 15:26:22'),
(74, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Product created', '192.168.0.8', '2018-05-01 15:26:38', '2018-05-01 15:26:38'),
(75, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Product created', '192.168.0.8', '2018-05-01 15:26:54', '2018-05-01 15:26:54'),
(76, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-05-01 16:33:32', '2018-05-01 16:33:32'),
(77, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-05-02 12:10:34', '2018-05-02 12:10:34'),
(78, 1, 0, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Logout Successfully', '::1', '2018-05-02 13:23:34', '2018-05-02 13:23:34'),
(79, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'Login Successfully', '::1', '2018-05-02 13:23:39', '2018-05-02 13:23:39'),
(80, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-03 12:03:24', '2018-05-03 12:03:24'),
(81, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-03 12:46:01', '2018-05-03 12:46:01'),
(82, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Invoice Created, Invoice ID : 1525373162', '::1', '2018-05-03 12:46:53', '2018-05-03 12:46:53'),
(83, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-03 13:40:24', '2018-05-03 13:40:24'),
(84, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-04 01:53:26', '2018-05-04 01:53:26'),
(85, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-04 08:23:39', '2018-05-04 08:23:39'),
(86, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Counter display status updated.', '::1', '2018-05-04 08:34:44', '2018-05-04 08:34:44'),
(87, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Counter display status updated.', '::1', '2018-05-04 08:34:46', '2018-05-04 08:34:46'),
(88, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Counter display status updated.', '::1', '2018-05-04 08:34:47', '2018-05-04 08:34:47'),
(89, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Counter display status updated.', '::1', '2018-05-04 08:34:57', '2018-05-04 08:34:57'),
(90, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Counter display status updated.', '::1', '2018-05-04 08:35:09', '2018-05-04 08:35:09'),
(91, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Counter display status updated.', '::1', '2018-05-04 08:35:14', '2018-05-04 08:35:14'),
(92, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Counter display status updated.', '::1', '2018-05-04 08:35:15', '2018-05-04 08:35:15'),
(93, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-04 11:55:18', '2018-05-04 11:55:18'),
(94, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-04 12:36:16', '2018-05-04 12:36:16'),
(95, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-05 02:45:56', '2018-05-05 02:45:56'),
(96, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-05 11:18:45', '2018-05-05 11:18:45'),
(97, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'POS settings updated.', '::1', '2018-05-05 14:58:14', '2018-05-05 14:58:14'),
(98, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'POS settings updated.', '::1', '2018-05-05 15:04:23', '2018-05-05 15:04:23'),
(99, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'POS settings updated.', '::1', '2018-05-05 15:07:54', '2018-05-05 15:07:54'),
(100, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'POS settings updated.', '::1', '2018-05-05 15:58:38', '2018-05-05 15:58:38'),
(101, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-10 12:58:21', '2018-05-10 12:58:21'),
(102, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Invoice Created, Invoice ID : 1525978703', '::1', '2018-05-10 20:08:21', '2018-05-10 20:08:21'),
(103, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-11 06:26:48', '2018-05-11 06:26:48'),
(104, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Invoice Created, Invoice ID : 1526041609', '::1', '2018-05-11 06:27:33', '2018-05-11 06:27:33'),
(105, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Invoice Created, Invoice ID : 1526042681', '::1', '2018-05-11 16:39:56', '2018-05-11 16:39:56'),
(106, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Invoice Created, Invoice ID : 1526078547', '::1', '2018-05-11 16:43:22', '2018-05-11 16:43:22'),
(107, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Invoice Created, Invoice ID : 1526078602', '::1', '2018-05-11 16:43:50', '2018-05-11 16:43:50'),
(108, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Invoice Created, Invoice ID : 1526078652', '::1', '2018-05-11 16:46:41', '2018-05-11 16:46:41'),
(109, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Invoice Created, Invoice ID : 1526078809', '::1', '2018-05-11 16:47:19', '2018-05-11 16:47:19'),
(110, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Invoice Created, Invoice ID : 1526078840', '::1', '2018-05-11 16:47:38', '2018-05-11 16:47:38'),
(111, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Counter display status updated.', '::1', '2018-05-11 16:51:34', '2018-05-11 16:51:34'),
(112, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Counter display status updated.', '::1', '2018-05-11 16:51:35', '2018-05-11 16:51:35'),
(113, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Invoice Created, Invoice ID : 1526078859', '::1', '2018-05-11 17:08:20', '2018-05-11 17:08:20'),
(114, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-15 15:05:11', '2018-05-15 15:05:11'),
(115, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-16 10:43:32', '2018-05-16 10:43:32'),
(116, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-18 07:25:18', '2018-05-18 07:25:18'),
(117, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36', 'Login Successfully', '::1', '2018-05-18 10:52:49', '2018-05-18 10:52:49'),
(118, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Login Successfully', '::1', '2018-05-19 12:59:57', '2018-05-19 12:59:57'),
(119, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Login Successfully', '::1', '2018-05-19 13:31:22', '2018-05-19 13:31:22'),
(120, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Login Successfully', '::1', '2018-05-20 14:19:21', '2018-05-20 14:19:21'),
(121, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Login Successfully', '::1', '2018-05-21 11:44:16', '2018-05-21 11:44:16'),
(122, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Product stockin created', '::1', '2018-05-21 11:46:15', '2018-05-21 11:46:15'),
(123, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Product stockin created', '::1', '2018-05-21 13:13:40', '2018-05-21 13:13:40'),
(124, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Product stockin updated', '::1', '2018-05-21 14:12:06', '2018-05-21 14:12:06'),
(125, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Product stockin updated', '::1', '2018-05-21 14:12:16', '2018-05-21 14:12:16'),
(126, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Product stockin updated', '::1', '2018-05-21 14:13:36', '2018-05-21 14:13:36'),
(127, 1, 1, 'Md Fahad Bhuyian', 'product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Product stockin updated', '::1', '2018-05-21 14:16:20', '2018-05-21 14:16:20'),
(128, 1, 0, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Logout Successfully', '::1', '2018-05-21 14:34:45', '2018-05-21 14:34:45'),
(129, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Login Successfully', '::1', '2018-05-23 09:45:32', '2018-05-23 09:45:32'),
(130, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Login Successfully', '::1', '2018-05-23 12:42:38', '2018-05-23 12:42:38'),
(131, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Login Successfully', '::1', '2018-05-23 13:01:47', '2018-05-23 13:01:47'),
(132, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Login Successfully', '::1', '2018-05-24 09:59:48', '2018-05-24 09:59:48'),
(133, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Login Successfully', '::1', '2018-05-25 14:16:41', '2018-05-25 14:16:41'),
(134, 4, 0, 'Fahad', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Login Successfully', '127.0.0.1', '2018-05-25 14:55:22', '2018-05-25 14:55:22'),
(135, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Login Successfully', '::1', '2018-05-25 16:56:18', '2018-05-25 16:56:18'),
(136, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Login Successfully', '::1', '2018-05-26 03:35:31', '2018-05-26 03:35:31'),
(137, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Counter display status updated.', '::1', '2018-05-26 04:16:23', '2018-05-26 04:16:23'),
(138, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Counter display status updated.', '::1', '2018-05-26 04:16:23', '2018-05-26 04:16:23'),
(139, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Counter display status updated.', '::1', '2018-05-26 04:16:24', '2018-05-26 04:16:24'),
(140, 1, 1, 'Md Fahad Bhuyian', 'counter-display', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Counter display status updated.', '::1', '2018-05-26 04:16:25', '2018-05-26 04:16:25'),
(141, 1, 1, 'Md Fahad Bhuyian', 'auth', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Login Successfully', '::1', '2018-05-26 09:41:46', '2018-05-26 09:41:46'),
(142, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Invoice Created, Invoice ID : 1527361793', '::1', '2018-05-26 13:11:22', '2018-05-26 13:11:22'),
(143, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Invoice Created, Invoice ID : 1527361892', '::1', '2018-05-26 13:13:03', '2018-05-26 13:13:03'),
(144, 1, 1, 'Md Fahad Bhuyian', 'sales', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'Invoice Created, Invoice ID : 1527361984', '::1', '2018-05-26 15:07:35', '2018-05-26 15:07:35');

-- --------------------------------------------------------

--
-- Table structure for table `lsp_migrations`
--

CREATE TABLE `lsp_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_migrations`
--

INSERT INTO `lsp_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2018_02_14_165142_create_customers_table', 2),
(15, '2018_02_14_165308_create_products_table', 2),
(16, '2018_02_14_165452_create_product_stockins_table', 2),
(17, '2018_02_14_165515_create_invoices_table', 2),
(18, '2018_02_14_165549_create_invoice_products_table', 2),
(19, '2018_02_14_165610_create_invoice_payments_table', 2),
(20, '2018_02_14_165638_create_product_variances_table', 2),
(21, '2018_02_14_165731_create_product_profits_table', 2),
(22, '2018_02_14_165826_create_product_variance_datas_table', 2),
(23, '2018_02_14_165848_create_tenders_table', 2),
(24, '2018_02_14_172725_create_activities_table', 2),
(25, '2018_02_14_184104_create_invoice_profits_table', 2),
(26, '2018_02_17_182452_create_product_stockin_invoices_table', 3),
(27, '2018_02_25_204411_create_warranties_table', 4),
(28, '2018_02_28_182342_create_warranty_products_table', 4),
(29, '2018_03_02_234443_create_retail_pos_summaries_table', 5),
(30, '2018_03_04_201055_create_retail_pos_summary_date_wises_table', 6),
(31, '2018_03_16_170216_create_pos_settings_table', 7),
(32, '2018_03_26_190331_create_site_settings_table', 8),
(33, '2018_03_28_175615_create_color_plates_table', 9),
(34, '2018_04_05_185149_create_counter_displays_table', 10),
(35, '2018_04_06_171645_create_sessions_table', 10),
(36, '2018_04_07_154508_create_counter_display_authorized_p_cs_table', 11),
(37, '2018_04_09_204533_create_customer_invoice_emails_table', 12),
(38, '2018_04_13_180514_create_login_activities_table', 13),
(39, '2018_04_13_193050_create_cashier_punches_table', 14),
(40, '2018_04_30_122335_create_report_settings_table', 15),
(41, '2018_05_04_202916_create_invoice_layout_ones_table', 16),
(42, '2018_05_05_172535_create_invoice_layout_twos_table', 17),
(43, '2018_05_10_234805_create_printer_print_sizes_table', 18),
(44, '2018_05_16_184041_create_sales_returns_table', 19),
(45, '2018_05_18_135417_create_event_calenders_table', 20),
(46, '2018_05_19_195935_create_vendors_table', 21),
(47, '2018_05_23_161709_create_invoice_email_teamplates_table', 22),
(48, '2018_05_26_110539_create_send_test_mails_table', 23),
(49, '2018_05_26_182109_create_send_sales_emails_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_password_resets`
--

CREATE TABLE `lsp_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lsp_pos_settings`
--

CREATE TABLE `lsp_pos_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_layout` int(1) NOT NULL DEFAULT '1',
  `pos_item` int(11) NOT NULL DEFAULT '16',
  `sales_tax` decimal(5,2) NOT NULL,
  `sales_discount` decimal(5,2) NOT NULL,
  `discount_type` int(1) NOT NULL DEFAULT '1',
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_pos_settings`
--

INSERT INTO `lsp_pos_settings` (`id`, `invoice_layout`, `pos_item`, `sales_tax`, `sales_discount`, `discount_type`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 16, '3.00', '5.00', 2, 1, 1, 1, '2018-03-16 14:19:45', '2018-05-05 15:04:23', NULL),
(2, 1, 16, '3.00', '5.00', 2, 1, 1, 1, '2018-05-05 14:42:37', '2018-05-05 15:58:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_printer_print_sizes`
--

CREATE TABLE `lsp_printer_print_sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `pos_width` int(11) NOT NULL DEFAULT '595',
  `pos_height` int(11) NOT NULL DEFAULT '842',
  `thermal_width` int(11) NOT NULL DEFAULT '70',
  `thermal_height` int(11) NOT NULL DEFAULT '130',
  `barcode_width` int(11) NOT NULL DEFAULT '58',
  `barcode_height` int(11) NOT NULL DEFAULT '240',
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_printer_print_sizes`
--

INSERT INTO `lsp_printer_print_sizes` (`id`, `pos_width`, `pos_height`, `thermal_width`, `thermal_height`, `barcode_width`, `barcode_height`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 595, 842, 70, 130, 58, 160, 1, 1, 1, '2018-05-10 18:37:40', '2018-05-10 18:45:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_products`
--

CREATE TABLE `lsp_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `sold_times` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_products`
--

INSERT INTO `lsp_products` (`id`, `name`, `detail`, `quantity`, `price`, `cost`, `sold_times`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Brand Custom-S', '', -12, 1.22, 1.00, 10, 13, 1, 1, '2018-02-14 16:38:59', '2018-03-19 15:17:34', NULL),
(2, 'Amit 2.5 GB', '', 2, 2.45, 1.25, 0, 13, 1, 0, '2018-02-14 16:41:07', '2018-02-14 16:43:19', '2018-02-14 16:43:19'),
(3, 'Glassware', '', 8, 100.00, 50.00, 5, 13, 1, 0, '2018-02-14 16:41:50', '2018-03-19 15:17:35', NULL),
(4, 'iPhone 5 LCD White - Premium', '', 32, 19.00, 12.00, 5, 13, 1, 0, '2018-02-15 13:26:40', '2018-03-22 17:03:47', NULL),
(5, 'iPhone 6S Plus LCD Black - Premium', '', 217, 38.00, 33.00, 1, 13, 1, 0, '2018-02-15 13:28:39', '2018-03-19 15:17:35', NULL),
(6, 'Small Parts', '', -7, 15.00, 11.25, 13, 13, 1, 0, '2018-02-15 13:30:13', '2018-03-19 15:17:35', NULL),
(7, 'Battery', '', -4, 12.00, 10.00, 1, 13, 1, 0, '2018-02-15 13:40:44', '2018-03-19 15:17:34', NULL),
(8, 'iPad 2 Digi', '', 11, 14.00, 9.00, 0, 13, 1, 0, '2018-02-15 13:41:38', '2018-03-02 15:20:58', '2018-03-02 15:20:58'),
(9, 'iPhone 6S Plus LCD White - Premium', '', 308, 38.00, 33.00, 1, 13, 1, 0, '2018-02-15 13:42:48', '2018-03-19 15:17:35', NULL),
(10, 'iPhone 6S LCD White - Premium', '', 410, 32.00, 27.00, 1, 13, 1, 0, '2018-02-15 13:44:11', '2018-03-19 15:17:35', NULL),
(11, 'iPhone 6S LCD Black - Premium', '', 336, 32.00, 27.00, 1, 13, 1, 0, '2018-02-15 13:48:46', '2018-03-19 15:17:34', NULL),
(12, 'Phone 5 LCD Black - Premium', '', 29, 19.00, 12.00, 0, 13, 1, 0, '2018-02-15 13:50:07', '2018-02-15 13:50:07', NULL),
(13, 'iPhone 5C LCD Black - Premium', '', 101, 19.00, 12.00, 0, 13, 1, 0, '2018-02-15 13:52:01', '2018-02-15 13:52:01', NULL),
(14, 'iPhone 5SE LCD White - Premium', '', 169, 22.00, 22.00, 1, 13, 1, 0, '2018-02-15 13:53:48', '2018-03-19 15:17:34', NULL),
(15, 'iPhone 5SE LCD Black - Premium', '', 164, 22.00, 22.00, 0, 13, 1, 0, '2018-02-15 13:55:26', '2018-02-15 13:55:26', NULL),
(16, 'iPhone 6 LCD White - Premium', '', 510, 23.00, 18.00, 0, 13, 1, 0, '2018-02-15 13:56:59', '2018-02-15 13:56:59', NULL),
(17, 'iPhone 6 LCD Black - Premium', '', 478, 23.00, 18.00, 0, 13, 1, 0, '2018-02-15 13:58:07', '2018-02-15 13:58:07', NULL),
(18, 'iPhone 6 Plus LCD Black - Premium', '', 204, 26.00, 21.00, 1, 13, 1, 0, '2018-02-15 13:59:25', '2018-03-19 15:17:34', NULL),
(19, 'iPhone 6 Plus LCD White - Premium', '', 223, 26.00, 21.00, 0, 13, 1, 0, '2018-02-15 14:01:25', '2018-02-15 14:01:25', NULL),
(20, 'iPad Air Digi', '', 8, 19.00, 14.00, 0, 13, 1, 0, '2018-02-15 14:02:40', '2018-02-15 14:02:40', NULL),
(21, 'iPad Mini 1 Digi', '', 5, 26.00, 21.00, 0, 13, 1, 0, '2018-02-15 14:03:54', '2018-02-15 14:03:54', NULL),
(22, 'iPad 3 Digi', '', 0, 14.00, 9.00, 1, 13, 1, 0, '2018-02-15 14:04:56', '2018-03-19 15:17:34', NULL),
(23, 'Overnight Shipping - Under Minimum Order', '', 4, 30.00, 30.00, 1, 13, 1, 0, '2018-02-15 14:05:59', '2018-03-20 11:27:08', NULL),
(24, 'Note 4 LCD', '', -1, 165.00, 155.00, 1, 13, 1, 0, '2018-02-15 14:07:02', '2018-03-20 11:27:08', NULL),
(25, 'iPhone 8 LCD Black - Premium', '', -2, 45.00, 40.00, 2, 13, 1, 0, '2018-02-15 14:08:01', '2018-03-20 11:27:08', NULL),
(26, 'iPhone 8 LCD White - Premium', '', 0, 45.00, 40.00, 1, 13, 1, 0, '2018-02-15 14:09:29', '2018-03-20 11:27:08', NULL),
(27, 'iPhone 8 Plus LCD Black - Premium', '', -2, 47.00, 42.00, 2, 13, 1, 0, '2018-02-15 14:23:00', '2018-03-20 11:27:08', NULL),
(28, 'iPhone 8 Plus LCD White - Premium', '', 0, 47.00, 42.00, 1, 13, 1, 0, '2018-02-15 14:24:16', '2018-03-20 11:27:08', NULL),
(29, 'Other', '', 1, 88.00, 95.00, 0, 13, 1, 0, '2018-02-15 14:25:08', '2018-02-15 14:25:08', NULL),
(30, 'Brand Custom-SS', '', -2, 2.00, 1.00, 2, 13, 1, 0, '2018-03-03 13:20:31', '2018-04-09 16:35:44', NULL),
(31, 'Brand Custom-SSS', '', 6, 10.00, 20.00, 1, 13, 1, 0, '2018-03-03 13:22:08', '2018-04-09 16:35:44', NULL),
(32, 'Glassware-Custom', '', 0, 10.00, 5.00, 2, 13, 1, 0, '2018-03-03 13:23:47', '2018-04-09 16:35:44', NULL),
(33, 'simpleretailpos', '', -18, 20.00, 10.00, 25, 13, 1, 0, '2018-03-03 13:24:18', '2018-04-08 16:13:07', NULL),
(34, 'Tableware w', '', -24, 10.00, 5.00, 26, 13, 1, 0, '2018-03-05 14:28:46', '2018-04-08 16:13:07', NULL),
(35, 'Glassware l', '', -8, 10.00, 5.00, 20, 13, 1, 0, '2018-03-05 14:29:36', '2018-04-08 16:13:07', NULL),
(36, 'aaaaa', '', -24, 11.00, 11.00, 25, 13, 1, 0, '2018-03-17 14:52:35', '2018-04-08 16:13:07', NULL),
(37, 'Test Ajax 1', '', -33, 10.00, 10.00, 32, 13, 1, 0, '2018-03-17 14:54:06', '2018-04-09 13:48:22', NULL),
(38, 'Test Ajax 1', '', -30, 10.00, 10.00, 31, 13, 1, 0, '2018-03-17 14:56:02', '2018-04-09 13:48:22', NULL),
(39, 'Test Ajax 2', '', -38, 11.00, 11.00, 32, 13, 1, 0, '2018-03-17 14:58:49', '2018-04-09 13:48:22', NULL),
(40, 'Test Ajax 3', '', -33, 20.00, 20.00, 32, 13, 1, 0, '2018-03-17 15:02:51', '2018-04-09 13:48:22', NULL),
(41, 'Test Ajax 4', '', -37, 4.00, 4.00, 36, 13, 1, 0, '2018-03-17 15:08:52', '2018-04-10 14:37:25', NULL),
(42, 'Test Ajax 1', '', -38, 10.00, 10.00, 35, 13, 1, 0, '2018-03-18 11:30:06', '2018-04-10 14:37:25', NULL),
(43, 'asdsad', '', -37, 20.00, 20.00, 36, 13, 1, 0, '2018-03-18 11:43:53', '2018-04-10 14:37:24', NULL),
(44, 'Test Ajax 5', 'General Sales : sdsdsadsad sa dsa dsad', -38, 22.00, 22.00, 32, 13, 1, 0, '2018-03-18 11:46:20', '2018-04-10 14:37:24', NULL),
(45, 'CHEF’S SPECIAL DISHES', '', -4, 10.00, 20.00, 5, 1, 1, 0, '2018-04-14 12:31:30', '2018-05-11 17:08:20', NULL),
(46, 'Small merchant', '', 3, 50.00, 20.00, 0, 1, 1, 0, '2018-05-01 15:23:06', '2018-05-21 14:16:20', NULL),
(47, 'About BRAC Bank', '', 12, 55.00, 22.00, 0, 1, 1, 0, '2018-05-01 15:23:24', '2018-05-21 14:16:20', NULL),
(48, 'Divergent', '', 15, 22.00, 11.00, 0, 1, 1, 0, '2018-05-01 15:23:38', '2018-05-01 15:23:38', NULL),
(49, 'MAHAMUDUR', '', 19, 10.00, 2.00, 3, 1, 1, 0, '2018-05-01 15:25:35', '2018-05-26 15:07:34', NULL),
(50, 'color pen', '', 15, 5.00, 3.00, 2, 1, 1, 0, '2018-05-01 15:25:58', '2018-05-26 15:07:34', NULL),
(51, 'pen', '', 36, 100.00, 50.00, 3, 1, 1, 0, '2018-05-01 15:26:21', '2018-05-26 15:07:34', NULL),
(52, 'laptop', '', 12, 500.00, 400.00, 3, 1, 1, 0, '2018-05-01 15:26:37', '2018-05-26 15:07:34', NULL),
(53, 'DESKTOP-PHFRTLE', '', 21, 1000.00, 800.00, 5, 1, 1, 0, '2018-05-01 15:26:54', '2018-05-26 15:07:34', NULL),
(54, 'Product Special One with Light', '', -9, 20.00, 10.00, 10, 1, 1, 0, '2018-05-01 17:16:14', '2018-05-26 15:07:34', NULL),
(55, 'Demo 2', '', -2, 20.00, 10.00, 3, 1, 1, 0, '2018-05-01 17:16:14', '2018-05-26 15:07:34', NULL),
(56, 'Demo 3', '', -2, 20.00, 10.00, 3, 1, 1, 0, '2018-05-01 17:16:14', '2018-05-26 15:07:34', NULL),
(57, 'Demo 4', '', -3, 20.00, 10.00, 4, 1, 1, 0, '2018-05-01 17:16:14', '2018-05-26 15:07:34', NULL),
(58, 'Demo product one with 5 gb', '', -13, 20.00, 10.00, 13, 1, 1, 0, '2018-05-01 17:16:14', '2018-05-26 15:07:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_product_profits`
--

CREATE TABLE `lsp_product_profits` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `invoice_datetime` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_total_quantity` int(11) NOT NULL,
  `product_total_amount` double(8,2) NOT NULL,
  `product_cost_total_amount` double(8,2) NOT NULL,
  `profit` double(8,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lsp_product_stockins`
--

CREATE TABLE `lsp_product_stockins` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_tracking_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_product_stockins`
--

INSERT INTO `lsp_product_stockins` (`id`, `order_tracking_id`, `product_id`, `quantity`, `price`, `cost`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1520091605', 3, 1, 100.00, 50.00, 13, 1, 0, '2018-03-03 09:40:05', '2018-03-03 09:40:17', '2018-03-03 09:40:17'),
(2, '1520091723', 3, 2, 100.00, 50.00, 13, 1, 0, '2018-03-03 09:42:03', '2018-03-03 11:09:39', '2018-03-03 11:09:39'),
(3, '1520091723', 3, 2, 100.00, 50.00, 13, 1, 1, '2018-03-03 11:09:39', '2018-03-03 11:09:55', '2018-03-03 11:09:55'),
(4, '1520103655', 3, 5, 100.00, 50.00, 13, 1, 0, '2018-03-03 13:00:55', '2018-03-03 13:02:06', '2018-03-03 13:02:06'),
(5, '1520103655', 3, 5, 100.00, 50.00, 13, 1, 0, '2018-03-03 13:00:55', '2018-03-03 13:02:06', '2018-03-03 13:02:06'),
(6, '1520103679', 3, 5, 100.00, 50.00, 13, 1, 0, '2018-03-03 13:01:19', '2018-03-03 13:01:56', '2018-03-03 13:01:56'),
(7, '1520103679', 3, 5, 100.00, 50.00, 13, 1, 0, '2018-03-03 13:01:19', '2018-03-03 13:01:56', '2018-03-03 13:01:56'),
(8, '1520103781', 3, 5, 100.00, 50.00, 13, 1, 0, '2018-03-03 13:03:01', '2018-03-03 13:03:31', '2018-03-03 13:03:31'),
(9, '1520103781', 3, 5, 100.00, 50.00, 13, 1, 0, '2018-03-03 13:03:01', '2018-03-03 13:03:31', '2018-03-03 13:03:31'),
(10, '1520103781', 3, 5, 100.00, 50.00, 13, 1, 1, '2018-03-03 13:03:31', '2018-03-03 13:31:34', '2018-03-03 13:31:34'),
(11, '1520103781', 3, 3, 100.00, 50.00, 13, 1, 1, '2018-03-03 13:03:32', '2018-03-03 13:31:34', '2018-03-03 13:31:34'),
(12, '0', 32, 5, 10.00, 5.00, 13, 1, 0, '2018-03-03 13:23:47', '2018-03-03 13:23:47', NULL),
(13, '0', 33, 7, 20.00, 10.00, 13, 1, 0, '2018-03-03 13:24:18', '2018-03-03 13:24:18', NULL),
(14, '1520103781', 3, 5, 100.00, 50.00, 13, 1, 1, '2018-03-03 13:31:34', '2018-03-03 13:34:09', '2018-03-03 13:34:09'),
(15, '1520103781', 3, 3, 100.00, 50.00, 13, 1, 1, '2018-03-03 13:31:34', '2018-03-03 13:34:09', '2018-03-03 13:34:09'),
(16, '1520103781', 3, 5, 100.00, 50.00, 13, 1, 1, '2018-03-03 13:34:09', '2018-03-03 13:34:09', NULL),
(17, '1520103781', 3, 3, 100.00, 50.00, 13, 1, 1, '2018-03-03 13:34:09', '2018-03-03 13:34:09', NULL),
(18, '1520105672', 3, 1, 100.00, 50.00, 13, 1, 0, '2018-03-03 13:34:32', '2018-03-03 13:34:32', NULL),
(19, '0', 34, 2, 10.00, 5.00, 13, 1, 0, '2018-03-05 14:28:47', '2018-03-05 14:28:47', NULL),
(20, '0', 35, 2, 10.00, 5.00, 13, 1, 0, '2018-03-05 14:29:37', '2018-03-05 14:29:37', NULL),
(21, '1520282214', 4, 4, 19.00, 12.00, 13, 1, 0, '2018-03-05 14:36:54', '2018-03-05 14:36:54', NULL),
(22, '0', 36, 1, 11.00, 11.00, 13, 1, 0, '2018-03-17 14:52:35', '2018-03-17 14:52:35', NULL),
(23, '0', 37, 1, 10.00, 10.00, 13, 1, 0, '2018-03-17 14:54:06', '2018-03-17 14:54:06', NULL),
(24, '0', 38, 1, 10.00, 10.00, 13, 1, 0, '2018-03-17 14:56:02', '2018-03-17 14:56:02', NULL),
(25, '0', 45, 1, 10.00, 20.00, 1, 1, 0, '2018-04-14 12:31:30', '2018-04-14 12:31:30', NULL),
(26, '0', 46, 3, 50.00, 20.00, 1, 1, 0, '2018-05-01 15:23:06', '2018-05-01 15:23:06', NULL),
(27, '0', 47, 11, 55.00, 22.00, 1, 1, 0, '2018-05-01 15:23:24', '2018-05-01 15:23:24', NULL),
(28, '0', 48, 15, 22.00, 11.00, 1, 1, 0, '2018-05-01 15:23:38', '2018-05-01 15:23:38', NULL),
(29, '0', 49, 22, 10.00, 2.00, 1, 1, 0, '2018-05-01 15:25:35', '2018-05-01 15:25:35', NULL),
(30, '0', 50, 17, 5.00, 3.00, 1, 1, 0, '2018-05-01 15:25:58', '2018-05-01 15:25:58', NULL),
(31, '0', 51, 39, 100.00, 50.00, 1, 1, 0, '2018-05-01 15:26:21', '2018-05-01 15:26:21', NULL),
(32, '0', 52, 15, 500.00, 400.00, 1, 1, 0, '2018-05-01 15:26:37', '2018-05-01 15:26:37', NULL),
(33, '0', 53, 26, 1000.00, 800.00, 1, 1, 0, '2018-05-01 15:26:54', '2018-05-01 15:26:54', NULL),
(34, '1526924775', 47, 1, 55.00, 22.00, 1, 1, 0, '2018-05-21 11:46:15', '2018-05-21 14:16:20', '2018-05-21 14:16:20'),
(35, '1526924775', 46, 1, 50.00, 20.00, 1, 1, 0, '2018-05-21 11:46:15', '2018-05-21 14:16:20', '2018-05-21 14:16:20'),
(36, '1526930019', 46, 1, 50.00, 20.00, 1, 1, 0, '2018-05-21 13:13:40', '2018-05-21 14:13:36', '2018-05-21 14:13:36'),
(37, '1526930019', 46, 1, 50.00, 20.00, 1, 1, 1, '2018-05-21 14:13:36', '2018-05-21 14:13:36', NULL),
(38, '1526924775', 47, 1, 55.00, 22.00, 1, 1, 1, '2018-05-21 14:16:20', '2018-05-21 14:16:20', NULL),
(39, '1526924775', 46, 1, 50.00, 20.00, 1, 1, 1, '2018-05-21 14:16:20', '2018-05-21 14:16:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_product_stockin_invoices`
--

CREATE TABLE `lsp_product_stockin_invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_tracking_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `vendor_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_product_stockin_invoices`
--

INSERT INTO `lsp_product_stockin_invoices` (`id`, `order_tracking_id`, `vendor_id`, `order_date`, `order_no`, `total_quantity`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1520091605', 0, '2018-03-03', '1', 1, 13, 1, 0, '2018-03-03 09:40:05', '2018-03-03 09:40:18', '2018-03-03 09:40:18'),
(2, '1520091723', 0, '2018-03-03', '1', 2, 13, 1, 1, '2018-03-03 09:42:03', '2018-03-03 11:09:55', '2018-03-03 11:09:55'),
(3, '1520103655', 0, '2018-03-04', '1', 10, 13, 1, 0, '2018-03-03 13:00:55', '2018-03-03 13:02:06', '2018-03-03 13:02:06'),
(4, '1520103679', 0, '2018-03-04', '1', 10, 13, 1, 0, '2018-03-03 13:01:19', '2018-03-03 13:01:56', '2018-03-03 13:01:56'),
(5, '1520103781', 0, '2018-03-04', '1', 8, 13, 1, 1, '2018-03-03 13:03:01', '2018-03-03 13:03:32', NULL),
(6, '1520105672', 0, '2018-03-04', '18', 1, 13, 1, 0, '2018-03-03 13:34:32', '2018-03-03 13:34:32', NULL),
(7, '1520282214', 0, '2018-03-06', '21', 4, 13, 1, 0, '2018-03-05 14:36:54', '2018-03-05 14:36:54', NULL),
(8, '1526924775', 6, '2018-05-21', '34', 2, 1, 1, 1, '2018-05-21 11:46:15', '2018-05-21 14:16:21', NULL),
(9, '1526930019', 1, '2018-05-22', '36', 1, 1, 1, 1, '2018-05-21 13:13:40', '2018-05-21 14:13:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_product_variances`
--

CREATE TABLE `lsp_product_variances` (
  `id` int(10) UNSIGNED NOT NULL,
  `variance_id` int(11) NOT NULL,
  `total_variance_quantity` int(11) NOT NULL DEFAULT '0',
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_product_variances`
--

INSERT INTO `lsp_product_variances` (`id`, `variance_id`, `total_variance_quantity`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1519073836, 5, 13, 1, 0, '2018-02-19 14:57:16', '2018-02-19 14:57:16', NULL),
(2, 1519584479, 12, 13, 1, 0, '2018-02-25 12:47:59', '2018-02-25 12:47:59', NULL),
(3, 1519584535, 14, 13, 1, 0, '2018-02-25 12:48:55', '2018-02-25 12:51:07', '2018-02-25 12:51:07'),
(4, 1519584479, 12, 13, 1, 0, '2018-02-25 14:08:15', '2018-02-25 14:10:57', '2018-02-25 14:10:57'),
(5, 1519584479, 17, 13, 1, 1, '2018-02-25 14:08:26', '2018-02-25 14:10:48', '2018-02-25 14:10:48'),
(6, 1519589526, 9, 13, 1, 1, '2018-02-25 14:12:06', '2018-02-25 14:12:37', NULL),
(7, 1519589647, 18, 13, 1, 1, '2018-02-25 14:14:07', '2018-02-25 14:16:34', NULL),
(8, 1519943495, 60, 13, 1, 0, '2018-03-01 16:31:35', '2018-03-01 16:31:35', NULL),
(9, 1519943578, 30, 13, 1, 0, '2018-03-01 16:32:58', '2018-03-01 16:32:58', NULL),
(10, 1519974898, 40, 13, 1, 0, '2018-03-02 01:14:59', '2018-03-02 01:14:59', NULL),
(11, 1519974978, 70, 13, 1, 0, '2018-03-02 01:16:18', '2018-03-02 01:16:18', NULL),
(12, 1520108795, 5, 13, 1, 0, '2018-03-03 14:26:35', '2018-03-03 14:26:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_product_variance_datas`
--

CREATE TABLE `lsp_product_variance_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `variance_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_in_system` int(11) NOT NULL,
  `quantity_in_hand` int(11) NOT NULL,
  `variance_quanity` int(11) NOT NULL DEFAULT '0',
  `cost` double(8,2) NOT NULL,
  `variance_cost` double(8,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_product_variance_datas`
--

INSERT INTO `lsp_product_variance_datas` (`id`, `variance_id`, `product_id`, `quantity_in_system`, `quantity_in_hand`, `variance_quanity`, `cost`, `variance_cost`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1519073836, 3, 10, 2, 8, 50.00, 100.00, 13, 1, 0, '2018-02-19 14:57:16', '2018-02-25 14:11:32', '2018-02-25 14:11:32'),
(2, 1519073836, 6, 9, 2, 7, 11.25, 22.50, 13, 1, 0, '2018-02-19 14:57:16', '2018-02-25 14:11:32', '2018-02-25 14:11:32'),
(3, 1519073836, 8, 11, 1, 10, 9.00, 9.00, 13, 1, 0, '2018-02-19 14:57:16', '2018-02-25 14:11:32', '2018-02-25 14:11:32'),
(4, 1519584479, 5, 220, 5, 215, 33.00, 165.00, 13, 1, 0, '2018-02-25 12:47:59', '2018-02-25 14:08:15', '2018-02-25 14:08:15'),
(5, 1519584479, 8, 11, 2, 9, 9.00, 18.00, 13, 1, 0, '2018-02-25 12:47:59', '2018-02-25 14:08:15', '2018-02-25 14:08:15'),
(6, 1519584479, 12, 29, 5, 24, 12.00, 60.00, 13, 1, 0, '2018-02-25 12:47:59', '2018-02-25 14:08:15', '2018-02-25 14:08:15'),
(7, 1519584535, 6, 9, 2, 7, 11.25, 22.50, 13, 1, 0, '2018-02-25 12:48:55', '2018-02-25 12:51:07', '2018-02-25 12:51:07'),
(8, 1519584535, 9, 312, 6, 306, 33.00, 198.00, 13, 1, 0, '2018-02-25 12:48:55', '2018-02-25 12:51:07', '2018-02-25 12:51:07'),
(9, 1519584535, 15, 164, 6, 158, 22.00, 132.00, 13, 1, 0, '2018-02-25 12:48:55', '2018-02-25 12:51:07', '2018-02-25 12:51:07'),
(10, 1519584479, 4, 37, 5, 32, 12.00, 60.00, 13, 1, 0, '2018-02-25 14:08:15', '2018-02-25 14:08:25', '2018-02-25 14:08:25'),
(11, 1519584479, 5, 220, 2, 218, 33.00, 66.00, 13, 1, 0, '2018-02-25 14:08:15', '2018-02-25 14:08:25', '2018-02-25 14:08:25'),
(12, 1519584479, 6, 9, 5, 4, 11.25, 56.25, 13, 1, 0, '2018-02-25 14:08:15', '2018-02-25 14:08:25', '2018-02-25 14:08:25'),
(13, 1519584479, 10, 414, 5, 409, 27.00, 135.00, 13, 1, 0, '2018-02-25 14:08:26', '2018-02-25 14:10:37', '2018-02-25 14:10:37'),
(14, 1519584479, 11, 340, 6, 334, 27.00, 162.00, 13, 1, 0, '2018-02-25 14:08:26', '2018-02-25 14:10:37', '2018-02-25 14:10:37'),
(15, 1519584479, 12, 29, 5, 24, 12.00, 60.00, 13, 1, 0, '2018-02-25 14:08:26', '2018-02-25 14:10:37', '2018-02-25 14:10:37'),
(16, 1519584479, 13, 101, 5, 96, 12.00, 60.00, 13, 1, 0, '2018-02-25 14:10:38', '2018-02-25 14:10:48', '2018-02-25 14:10:48'),
(17, 1519584479, 14, 171, 7, 164, 22.00, 154.00, 13, 1, 0, '2018-02-25 14:10:38', '2018-02-25 14:10:48', '2018-02-25 14:10:48'),
(18, 1519584479, 15, 164, 5, 159, 22.00, 110.00, 13, 1, 0, '2018-02-25 14:10:38', '2018-02-25 14:10:48', '2018-02-25 14:10:48'),
(19, 1519073836, 1, 5, 2, 3, 1.00, 2.00, 13, 1, 0, '2018-02-25 14:11:32', '2018-02-25 14:11:32', NULL),
(20, 1519589526, 7, 141, 1, 140, 10.00, 10.00, 13, 1, 0, '2018-02-25 14:12:06', '2018-02-25 14:12:25', '2018-02-25 14:12:25'),
(21, 1519589526, 14, 171, 4, 167, 22.00, 88.00, 13, 1, 0, '2018-02-25 14:12:06', '2018-02-25 14:12:25', '2018-02-25 14:12:25'),
(22, 1519589526, 22, 4, 2, 2, 9.00, 18.00, 13, 1, 0, '2018-02-25 14:12:06', '2018-02-25 14:12:25', '2018-02-25 14:12:25'),
(23, 1519589526, 29, 1, 1, 0, 95.00, 95.00, 13, 1, 0, '2018-02-25 14:12:06', '2018-02-25 14:12:25', '2018-02-25 14:12:25'),
(24, 1519589526, 20, 8, 1, 7, 14.00, 14.00, 13, 1, 0, '2018-02-25 14:12:26', '2018-02-25 14:12:37', '2018-02-25 14:12:37'),
(25, 1519589526, 21, 5, 4, 1, 21.00, 84.00, 13, 1, 0, '2018-02-25 14:12:26', '2018-02-25 14:12:37', '2018-02-25 14:12:37'),
(26, 1519589526, 22, 4, 2, 2, 9.00, 18.00, 13, 1, 0, '2018-02-25 14:12:26', '2018-02-25 14:12:37', '2018-02-25 14:12:37'),
(27, 1519589526, 23, 5, 1, 4, 30.00, 30.00, 13, 1, 0, '2018-02-25 14:12:26', '2018-02-25 14:12:37', '2018-02-25 14:12:37'),
(28, 1519589526, 24, 0, 1, -1, 155.00, 155.00, 13, 1, 0, '2018-02-25 14:12:37', '2018-02-25 14:12:37', NULL),
(29, 1519589526, 25, 1, 4, -3, 40.00, 160.00, 13, 1, 0, '2018-02-25 14:12:37', '2018-02-25 14:12:37', NULL),
(30, 1519589526, 26, 1, 2, -1, 40.00, 80.00, 13, 1, 0, '2018-02-25 14:12:37', '2018-02-25 14:12:37', NULL),
(31, 1519589526, 27, 1, 2, -1, 42.00, 84.00, 13, 1, 0, '2018-02-25 14:12:37', '2018-02-25 14:12:37', NULL),
(32, 1519589647, 6, 9, 5, 4, 11.25, 56.25, 13, 1, 0, '2018-02-25 14:14:07', '2018-02-25 14:16:34', '2018-02-25 14:16:34'),
(33, 1519589647, 20, 8, 9, -1, 14.00, 126.00, 13, 1, 0, '2018-02-25 14:14:07', '2018-02-25 14:16:34', '2018-02-25 14:16:34'),
(34, 1519589647, 29, 1, 2, -1, 95.00, 190.00, 13, 1, 0, '2018-02-25 14:14:07', '2018-02-25 14:16:34', '2018-02-25 14:16:34'),
(35, 1519589647, 6, 9, 5, 4, 11.25, 56.25, 13, 1, 0, '2018-02-25 14:16:34', '2018-02-25 14:19:16', '2018-02-25 14:19:16'),
(36, 1519589647, 20, 8, 9, -1, 14.00, 126.00, 13, 1, 0, '2018-02-25 14:16:34', '2018-02-25 14:19:16', '2018-02-25 14:19:16'),
(37, 1519589647, 29, 1, 4, -3, 95.00, 380.00, 13, 1, 0, '2018-02-25 14:16:34', '2018-02-25 14:19:16', '2018-02-25 14:19:16'),
(38, 1519589647, 6, 9, 5, 4, 11.25, 56.25, 13, 1, 0, '2018-02-25 14:19:16', '2018-02-25 14:19:16', NULL),
(39, 1519589647, 20, 8, 9, -1, 14.00, 126.00, 13, 1, 0, '2018-02-25 14:19:16', '2018-02-25 14:19:16', NULL),
(40, 1519589647, 29, 1, 4, -3, 95.00, 380.00, 13, 1, 0, '2018-02-25 14:19:16', '2018-02-25 14:19:16', NULL),
(41, 1519943495, 1, 5, 20, -15, 1.00, 20.00, 13, 1, 0, '2018-03-01 16:31:35', '2018-03-01 16:31:35', NULL),
(42, 1519943495, 3, 10, 20, -10, 50.00, 1000.00, 13, 1, 0, '2018-03-01 16:31:35', '2018-03-01 16:31:35', NULL),
(43, 1519943495, 4, 37, 20, 17, 12.00, 240.00, 13, 1, 0, '2018-03-01 16:31:35', '2018-03-01 16:31:35', NULL),
(44, 1519943578, 1, 5, 10, -5, 1.00, 10.00, 13, 1, 0, '2018-03-01 16:32:58', '2018-03-01 16:32:58', NULL),
(45, 1519943578, 3, 10, 10, 0, 50.00, 500.00, 13, 1, 0, '2018-03-01 16:32:58', '2018-03-01 16:32:58', NULL),
(46, 1519943578, 4, 37, 10, 27, 12.00, 120.00, 13, 1, 0, '2018-03-01 16:32:58', '2018-03-01 16:32:58', NULL),
(47, 1519974898, 1, 5, 10, -5, 1.00, -5.00, 13, 1, 0, '2018-03-02 01:14:58', '2018-03-02 01:14:58', NULL),
(48, 1519974898, 3, 10, 10, 0, 50.00, 0.00, 13, 1, 0, '2018-03-02 01:14:58', '2018-03-02 01:14:58', NULL),
(49, 1519974898, 4, 37, 10, 27, 12.00, 324.00, 13, 1, 0, '2018-03-02 01:14:58', '2018-03-02 01:14:58', NULL),
(50, 1519974898, 5, 220, 10, 210, 33.00, 6930.00, 13, 1, 0, '2018-03-02 01:14:59', '2018-03-02 01:14:59', NULL),
(51, 1519974978, 1, 5, 10, -5, 1.00, -5.00, 13, 1, 0, '2018-03-02 01:16:18', '2018-03-02 01:16:18', NULL),
(52, 1519974978, 3, 10, 20, -10, 50.00, -500.00, 13, 1, 0, '2018-03-02 01:16:18', '2018-03-02 01:16:18', NULL),
(53, 1519974978, 4, 37, 20, 17, 12.00, 204.00, 13, 1, 0, '2018-03-02 01:16:18', '2018-03-02 01:16:18', NULL),
(54, 1519974978, 5, 220, 20, 200, 33.00, 6600.00, 13, 1, 0, '2018-03-02 01:16:18', '2018-03-02 01:16:18', NULL),
(55, 1520108795, 1, 5, 5, 0, 1.00, 0.00, 13, 1, 0, '2018-03-03 14:26:35', '2018-03-03 14:26:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_report_settings`
--

CREATE TABLE `lsp_report_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `disclaimer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_id` int(11) NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_report_settings`
--

INSERT INTO `lsp_report_settings` (`id`, `company_name`, `phone`, `email`, `address`, `disclaimer`, `signature`, `tax_id`, `logo`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'iDoctor', '4254184891', 'info@idoctorls.com', '960 South 24th Street West Suite B Billings, MT 59102', 'Thank you for choosing iDoctor, we are glad to help you with all your tech needs!', 'Thank you', 22, '1525103081.jpg', 1, 1, 1, '2018-04-30 09:12:14', '2018-04-30 09:44:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_retail_pos_summaries`
--

CREATE TABLE `lsp_retail_pos_summaries` (
  `id` int(10) UNSIGNED NOT NULL,
  `sales_invoice_quantity` int(11) NOT NULL,
  `sales_quantity` int(11) NOT NULL,
  `sales_amount` double(8,2) NOT NULL,
  `sales_cost` double(10,2) NOT NULL,
  `sales_profit` double(8,2) NOT NULL,
  `product_item_quantity` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `stockin_invoice_quantity` int(11) NOT NULL,
  `stockin_product_quantity` int(11) NOT NULL,
  `customer_quantity` int(11) NOT NULL,
  `variance_quantity` int(11) NOT NULL,
  `warranty_invoice_quantity` int(11) NOT NULL,
  `warranty_product_quantity` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_retail_pos_summaries`
--

INSERT INTO `lsp_retail_pos_summaries` (`id`, `sales_invoice_quantity`, `sales_quantity`, `sales_amount`, `sales_cost`, `sales_profit`, `product_item_quantity`, `product_quantity`, `stockin_invoice_quantity`, `stockin_product_quantity`, `customer_quantity`, `variance_quantity`, `warranty_invoice_quantity`, `warranty_product_quantity`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 71, 438, 14071.59, 11176.50, 2869.74, 13, -261, 3, 167, 3, 5, 2, 2, 0, 0, 0, NULL, '2018-05-26 15:07:35');

-- --------------------------------------------------------

--
-- Table structure for table `lsp_retail_pos_summary_date_wises`
--

CREATE TABLE `lsp_retail_pos_summary_date_wises` (
  `id` int(10) UNSIGNED NOT NULL,
  `sales_invoice_quantity` int(11) NOT NULL,
  `sales_quantity` int(11) NOT NULL,
  `sales_amount` double(8,2) NOT NULL,
  `sales_cost` double(8,2) NOT NULL,
  `sales_profit` double(8,2) NOT NULL,
  `product_item_quantity` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `stockin_invoice_quantity` int(11) NOT NULL,
  `stockin_product_quantity` int(11) NOT NULL,
  `customer_quantity` int(11) NOT NULL,
  `variance_quantity` int(11) NOT NULL,
  `warranty_invoice_quantity` int(11) NOT NULL,
  `warranty_product_quantity` int(11) NOT NULL,
  `report_date` date NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_retail_pos_summary_date_wises`
--

INSERT INTO `lsp_retail_pos_summary_date_wises` (`id`, `sales_invoice_quantity`, `sales_quantity`, `sales_amount`, `sales_cost`, `sales_profit`, `product_item_quantity`, `product_quantity`, `stockin_invoice_quantity`, `stockin_product_quantity`, `customer_quantity`, `variance_quantity`, `warranty_invoice_quantity`, `warranty_product_quantity`, `report_date`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(7, 1, 3, 45.00, 33.75, 11.25, 1, 6, 1, 6, 1, 0, 1, 1, '2018-03-05', 0, 0, 0, NULL, '2018-03-05 14:49:14'),
(8, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-06', 0, 0, 0, NULL, NULL),
(9, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-08', 0, 0, 0, NULL, NULL),
(10, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-09', 0, 0, 0, NULL, NULL),
(11, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-10', 0, 0, 0, NULL, NULL),
(12, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-11', 0, 0, 0, NULL, NULL),
(13, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-13', 0, 0, 0, NULL, NULL),
(14, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-16', 0, 0, 0, NULL, NULL),
(15, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-18', 0, 0, 0, NULL, NULL),
(16, 20, 267, 4609.42, 3576.50, 903.92, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-19', 0, 0, 0, NULL, '2018-03-19 15:17:35'),
(17, 2, 14, 500.58, 456.00, 30.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-20', 0, 0, 0, NULL, '2018-03-20 11:27:09'),
(18, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-21', 0, 0, 0, NULL, NULL),
(19, 4, 27, 455.83, 436.00, 29.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-22', 0, 0, 0, NULL, '2018-03-22 17:03:48'),
(20, 2, 13, 239.12, 229.00, 15.00, 0, 6, 0, 0, 0, 0, 0, 0, '2018-03-23', 0, 0, 0, NULL, '2018-03-23 17:03:14'),
(21, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-24', 0, 0, 0, NULL, NULL),
(22, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-26', 0, 0, 0, NULL, NULL),
(23, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-27', 0, 0, 0, NULL, NULL),
(24, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-03-30', 0, 0, 0, NULL, NULL),
(25, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-04-05', 0, 0, 0, NULL, NULL),
(26, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-04-06', 0, 0, 0, NULL, NULL),
(27, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-04-07', 0, 0, 0, NULL, NULL),
(28, 4, 24, 302.82, 289.00, 20.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-04-08', 0, 0, 0, NULL, '2018-04-08 16:13:08'),
(29, 3, 16, 191.10, 199.00, -4.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-04-09', 0, 0, 0, NULL, '2018-04-09 16:35:44'),
(30, 1, 4, 54.88, 56.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-04-10', 0, 0, 0, NULL, '2018-04-10 14:37:25'),
(31, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-04-12', 0, 0, 0, NULL, NULL),
(32, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 1, 0, 0, 0, '2018-04-13', 0, 0, 0, NULL, '2018-04-13 16:41:52'),
(33, 0, 0, 0.00, 0.00, 0.00, 1, 1, 0, 1, 0, 0, 0, 0, '2018-04-14', 0, 0, 0, NULL, '2018-04-14 12:31:31'),
(34, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-04-16', 0, 0, 0, NULL, NULL),
(35, 1, 1, 9.80, 20.00, -10.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-04-29', 0, 0, 0, NULL, NULL),
(36, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-04-30', 0, 0, 0, NULL, NULL),
(37, 0, 0, 0.00, 0.00, 0.00, 8, 148, 0, 148, 0, 0, 0, 0, '2018-05-01', 0, 0, 0, NULL, '2018-05-01 15:26:54'),
(38, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-02', 0, 0, 0, NULL, NULL),
(39, 1, 8, 1666.00, 1300.00, 400.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-03', 0, 0, 0, NULL, NULL),
(40, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-10', 0, 0, 0, NULL, NULL),
(41, 9, 27, 2376.50, 1867.00, 558.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-11', 0, 0, 0, NULL, '2018-05-11 17:08:21'),
(42, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-19', 0, 0, 0, NULL, NULL),
(43, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-20', 0, 0, 0, NULL, NULL),
(44, 0, 0, 0.00, 0.00, 0.00, 0, 3, 2, 3, 0, 0, 0, 0, '2018-05-21', 0, 0, 0, NULL, '2018-05-21 14:16:21'),
(45, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-23', 0, 0, 0, NULL, NULL),
(46, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-24', 0, 0, 0, NULL, NULL),
(47, 0, 0, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-25', 0, 0, 0, NULL, NULL),
(48, 3, 19, 3366.30, 2615.00, 820.00, 0, 0, 0, 0, 0, 0, 0, 0, '2018-05-26', 0, 0, 0, NULL, '2018-05-26 15:07:35');

-- --------------------------------------------------------

--
-- Table structure for table `lsp_sales_returns`
--

CREATE TABLE `lsp_sales_returns` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL DEFAULT '0',
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Mention',
  `invoice_total` double(8,2) NOT NULL DEFAULT '0.00',
  `sales_return_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `sales_return_note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `store_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_sales_returns`
--

INSERT INTO `lsp_sales_returns` (`id`, `invoice_id`, `customer_id`, `customer_name`, `invoice_total`, `sales_return_amount`, `sales_return_note`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1525017380, 27, 'CHEF’S SPECIAL DISHES', 9.80, 9.80, 'Demo', 1, 1, NULL, '2018-05-16 13:25:13', '2018-05-16 13:25:13', NULL),
(2, 1525373162, 28, 'MD MAHAMUDUR Zaman Bhuyan', 1666.00, 1666.00, 'Test', 1, 1, NULL, '2018-05-16 13:28:02', '2018-05-16 13:28:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_send_sales_emails`
--

CREATE TABLE `lsp_send_sales_emails` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL DEFAULT '0',
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bcc_email_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_send_status` enum('Not Send','Send','Failed To Send') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Send',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_process_type` int(1) DEFAULT '1',
  `store_id` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_send_sales_emails`
--

INSERT INTO `lsp_send_sales_emails` (`id`, `invoice_id`, `email_address`, `bcc_email_address`, `email_send_status`, `note`, `email_process_type`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1527361793, 'f.bhuyian@gmail.com', 'moniradiu@gmail.com', 'Send', '', 1, 1, 1, 0, '2018-05-26 13:11:22', '2018-05-26 14:13:54', NULL),
(2, 1527361892, 'f.bhuyian@gmail.com', 'fahadvampare@gmail.com', 'Send', '', 1, 1, 1, 0, '2018-05-26 13:13:03', '2018-05-26 14:49:43', NULL),
(3, 1527361984, 'f.bhuyian@gmail.com', 'fahadvampare@gmail.com', 'Not Send', '', 1, 1, 1, 0, '2018-05-26 15:07:35', '2018-05-26 15:07:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_send_test_mails`
--

CREATE TABLE `lsp_send_test_mails` (
  `id` int(10) UNSIGNED NOT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_send_status` enum('Not Send','Send','Failed To Send') COLLATE utf8mb4_unicode_ci DEFAULT 'Not Send',
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_send_test_mails`
--

INSERT INTO `lsp_send_test_mails` (`id`, `email_address`, `email_send_status`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'f.bhuyian@gmail.com', 'Send', 1, 1, 0, '2018-05-26 13:00:37', '2018-05-26 13:00:42', NULL),
(2, 'f.bhuyian@gmail.com', 'Send', 1, 1, 0, '2018-05-26 13:04:01', '2018-05-26 13:04:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_sessions`
--

CREATE TABLE `lsp_sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_sessions`
--

INSERT INTO `lsp_sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pajWSw6WCqOcf28MXGP31w2fUuEVdJoXpGY1PVe5', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoidWtiS3lRMHhMbm9GOWl0NHdsWWR5dEk5NlF2Z3BVM3loRDBtYVQzUCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ1OiJodHRwOi8vbG9jYWxob3N0L2xhcmF2ZWwvc2ltcGxlcG9zL3B1YmxpYy9wb3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NjoiZmlsdGVyIjtzOjc6ImlkLWRlc2MiO3M6MzoiUG9zIjtPOjc6IkFwcFxQb3MiOjEyOntzOjU6Iml0ZW1zIjtOO3M6ODoidG90YWxRdHkiO2k6MDtzOjk6Imludm9pY2VJRCI7aToxNTI3MzY4OTEzO3M6MTA6InRvdGFsUHJpY2UiO2k6MDtzOjc6IlRheFJhdGUiO3M6NDoiMy4wMCI7czo4OiJ0b3RhbFRheCI7aTowO3M6NDoicGFpZCI7aTowO3M6MTM6ImRpc2NvdW50X3R5cGUiO2k6MjtzOjE0OiJzYWxlc19kaXNjb3VudCI7czo0OiI1LjAwIjtzOjEzOiJkaXNjb3VudFRvdGFsIjtpOjA7czoxNToicGF5bWVudE1ldGhvZElEIjtzOjE6IjciO3M6MTA6ImN1c3RvbWVySUQiO2k6MDt9czoxNjoicGFnaW5hdGlvbl9saW1pdCI7aToxNjt9', 1527368913);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_site_settings`
--

CREATE TABLE `lsp_site_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `nav_class_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bg-purple bg-darken-1',
  `outline_border_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'border-primary border-lighten-1',
  `store_id` bigint(20) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_site_settings`
--

INSERT INTO `lsp_site_settings` (`id`, `nav_class_name`, `outline_border_name`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'bg-info bg-accent-2', 'border-info border-accent-2', 13, 1, 1, '2018-03-26 15:17:52', '2018-04-10 15:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `lsp_tenders`
--

CREATE TABLE `lsp_tenders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_tenders`
--

INSERT INTO `lsp_tenders` (`id`, `name`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'pos System', 13, 2, 2, '2018-02-15 04:56:59', '2018-02-15 05:00:32', '2018-02-15 05:00:32'),
(2, 'Amit 2.5 GB', 13, 2, 0, '2018-02-15 05:00:44', '2018-02-15 07:04:37', '2018-02-15 07:04:37'),
(3, 'Tableware', 13, 2, 0, '2018-02-15 05:00:48', '2018-02-15 05:00:48', NULL),
(4, 'simpleretailpos', 13, 2, 0, '2018-02-15 05:00:52', '2018-02-15 05:00:52', NULL),
(5, 'Brand Custom-S', 13, 2, 0, '2018-02-15 07:04:33', '2018-02-15 07:04:33', NULL),
(6, 'Cash', 13, 1, 0, '2018-02-15 11:38:28', '2018-02-15 11:38:28', NULL),
(7, 'Bhuna', 1, 1, 0, '2018-04-13 16:53:43', '2018-04-13 16:53:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_users`
--

CREATE TABLE `lsp_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` int(2) NOT NULL DEFAULT '0',
  `store_id` bigint(11) NOT NULL DEFAULT '0',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_users`
--

INSERT INTO `lsp_users` (`id`, `name`, `user_type`, `store_id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Md Fahad Bhuyian', 0, 1, 'f.bhuyian@gmail.com', '$2y$10$Dn9ZjChxZZMPi4EkH4UgYew2kqTmAWgqx.t1NiKFc8YUVgU0Y/gA.', 'VGx2ZCFYBlhiBxzUbHgUnx6vL8KtnEW39fYZsIdemQmIkk5S6Je5alhFlWfk', '2018-02-11 13:38:38', '2018-02-11 13:38:38', NULL),
(2, 'Fakhrul', 0, 1, 'fakhrul@gmail.com', '$2y$10$2Gey31b93nXMUZ6HmP8gEuHH1y0fQCMctuGdobID7ZVhQ1bq10/4e', 'oNGc3SIM9wnTBa4SiNDlGzi3IJJ9XaDIPVbT8uE4mxdi5e7MTtc9VF87BrWR', '2018-02-12 04:51:03', '2018-02-12 04:51:03', NULL),
(3, 'Fakhrul Islam Talukder', 0, 1, 'fkhrl@gmail.com', '$2y$10$Pkn9oKLAeQSulsEmiVKk3Og/VJNid1u69wNeLucbgrJK.BNx7gvgC', NULL, '2018-02-13 15:15:28', '2018-02-13 15:15:28', NULL),
(4, 'Fahad', 0, 0, 'f.fahad.server@gmail.com', '$2y$10$COAQk3FGUgGtK/DUiF3ZHuSKheh5Y.i9c8ZWwnLB22MX79oZ/BQfu', NULL, '2018-05-25 14:55:21', '2018-05-25 14:55:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_vendors`
--

CREATE TABLE `lsp_vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_vendors`
--

INSERT INTO `lsp_vendors` (`id`, `name`, `email`, `phone`, `address`, `city`, `state`, `zip`, `website`, `notes`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'mongol', 'mongol@gmail.com', '123654789', 'Dilli', 'mombay', 'indian', 'asd 123456', 'http://localhost/laravel/simplepos/public/vendor/edit/1', 'yes success', 1, 0, 0, '2018-05-19 15:12:40', '2018-05-20 14:59:16', NULL),
(2, 'gdg', 'f.bhuyian@gmaoil.com', '01860748020', 'hgjhhhj', 'dhaka', 'ghghjh', '1209', 'www.dd.com', 'hhhh', 1, 0, 0, '2018-05-20 14:20:02', '2018-05-20 15:07:53', '2018-05-20 15:07:53'),
(3, 'deri', 'asd@gmail.com', '1234', 'aswedf', 'asder', 'aaderf', '1234', 'http://localhost/laravel/simplepos/public/vendor/create', 'asder', 1, 0, 0, '2018-05-20 14:21:59', '2018-05-20 15:07:03', '2018-05-20 15:07:03'),
(4, 'aaaaaaaaaa', 'aaaaaaaaaaaa', 'aaaa222222222222222', 'aaaaaaaaaa', 'ssssssssssss', 'dddddddddddddd', 'wwwwww', 'eeee', 'sssss', 1, 0, 0, '2018-05-20 15:09:27', '2018-05-20 15:10:10', '2018-05-20 15:10:10'),
(5, 'bolod', 'bolod@gmail.com', '12344', 'aders', 'dhaka', 'bangladesh', '65230', 'http://localhost/laravel/simplepos/public/vendor/create', 'yes no yehooooo', 1, 0, 0, '2018-05-20 15:40:57', '2018-05-20 15:41:27', '2018-05-20 15:41:27'),
(6, 'Jone', 'Jone@gmail.com', '1234566', 'deratgy', 'new kuret', 'uytrfg', '12364', 'ghjj', 'sdfg', 1, 0, 0, '2018-05-21 12:46:56', '2018-05-21 12:46:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_warranties`
--

CREATE TABLE `lsp_warranties` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `warranty_date` date NOT NULL,
  `warranty_batch_quantity` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_warranties`
--

INSERT INTO `lsp_warranties` (`id`, `invoice_id`, `warranty_date`, `warranty_batch_quantity`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1520106771, '2018-03-03', 1, 13, 1, 0, '2018-03-03 13:53:13', '2018-03-03 13:53:35', '2018-03-03 13:53:35'),
(2, 1520106771, '2018-03-03', 1, 13, 1, 0, '2018-03-03 14:06:00', '2018-03-03 14:06:00', NULL),
(3, 1520106771, '2018-03-05', 1, 13, 1, 0, '2018-03-05 14:49:14', '2018-03-05 14:49:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_warranty_products`
--

CREATE TABLE `lsp_warranty_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `warranty_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `warranty_date` date NOT NULL,
  `old_product_id` int(11) NOT NULL,
  `new_product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_warranty_products`
--

INSERT INTO `lsp_warranty_products` (`id`, `warranty_id`, `invoice_id`, `warranty_date`, `old_product_id`, `new_product_id`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1520106771, '2018-03-03', 5, 3, 13, 1, 0, '2018-03-03 13:53:13', '2018-03-03 13:53:35', '2018-03-03 13:53:35'),
(2, 2, 1520106771, '2018-03-03', 5, 3, 13, 1, 0, '2018-03-03 14:06:00', '2018-03-03 14:06:00', NULL),
(3, 3, 1520106771, '2018-03-05', 5, 3, 13, 1, 0, '2018-03-05 14:49:14', '2018-03-05 14:49:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lsp_activities`
--
ALTER TABLE `lsp_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_cashier_punches`
--
ALTER TABLE `lsp_cashier_punches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_color_plates`
--
ALTER TABLE `lsp_color_plates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_counter_displays`
--
ALTER TABLE `lsp_counter_displays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_counter_display_authorized_p_cs`
--
ALTER TABLE `lsp_counter_display_authorized_p_cs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_customers`
--
ALTER TABLE `lsp_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_customer_invoice_emails`
--
ALTER TABLE `lsp_customer_invoice_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_event_calenders`
--
ALTER TABLE `lsp_event_calenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_invoices`
--
ALTER TABLE `lsp_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_id_index` (`id`),
  ADD KEY `invoices_invoice_id_index` (`invoice_id`);

--
-- Indexes for table `lsp_invoice_email_teamplates`
--
ALTER TABLE `lsp_invoice_email_teamplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_invoice_layout_ones`
--
ALTER TABLE `lsp_invoice_layout_ones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_invoice_layout_twos`
--
ALTER TABLE `lsp_invoice_layout_twos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_invoice_payments`
--
ALTER TABLE `lsp_invoice_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_invoice_products`
--
ALTER TABLE `lsp_invoice_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_invoice_profits`
--
ALTER TABLE `lsp_invoice_profits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_profits_invoice_id_index` (`invoice_id`),
  ADD KEY `invoice_profits_id_index` (`id`),
  ADD KEY `invoice_profits_invoice_datetime_index` (`invoice_datetime`),
  ADD KEY `invoice_profits_customer_id_index` (`customer_id`);

--
-- Indexes for table `lsp_login_activities`
--
ALTER TABLE `lsp_login_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_activities_user_id_index` (`user_id`);

--
-- Indexes for table `lsp_migrations`
--
ALTER TABLE `lsp_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_password_resets`
--
ALTER TABLE `lsp_password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `lsp_pos_settings`
--
ALTER TABLE `lsp_pos_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_printer_print_sizes`
--
ALTER TABLE `lsp_printer_print_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_products`
--
ALTER TABLE `lsp_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id_index` (`id`),
  ADD KEY `products_name_index` (`name`);

--
-- Indexes for table `lsp_product_profits`
--
ALTER TABLE `lsp_product_profits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_product_stockins`
--
ALTER TABLE `lsp_product_stockins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_product_stockin_invoices`
--
ALTER TABLE `lsp_product_stockin_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_product_variances`
--
ALTER TABLE `lsp_product_variances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variances_variance_id_index` (`variance_id`),
  ADD KEY `product_variances_id_index` (`id`);

--
-- Indexes for table `lsp_product_variance_datas`
--
ALTER TABLE `lsp_product_variance_datas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variance_datas_variance_id_index` (`variance_id`),
  ADD KEY `product_variance_datas_id_index` (`id`),
  ADD KEY `product_variance_datas_product_id_index` (`product_id`);

--
-- Indexes for table `lsp_report_settings`
--
ALTER TABLE `lsp_report_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_retail_pos_summaries`
--
ALTER TABLE `lsp_retail_pos_summaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_retail_pos_summary_date_wises`
--
ALTER TABLE `lsp_retail_pos_summary_date_wises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_sales_returns`
--
ALTER TABLE `lsp_sales_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_send_sales_emails`
--
ALTER TABLE `lsp_send_sales_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_send_test_mails`
--
ALTER TABLE `lsp_send_test_mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_sessions`
--
ALTER TABLE `lsp_sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `lsp_site_settings`
--
ALTER TABLE `lsp_site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_tenders`
--
ALTER TABLE `lsp_tenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_users`
--
ALTER TABLE `lsp_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `lsp_vendors`
--
ALTER TABLE `lsp_vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_warranties`
--
ALTER TABLE `lsp_warranties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_warranty_products`
--
ALTER TABLE `lsp_warranty_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lsp_activities`
--
ALTER TABLE `lsp_activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lsp_cashier_punches`
--
ALTER TABLE `lsp_cashier_punches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `lsp_color_plates`
--
ALTER TABLE `lsp_color_plates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `lsp_counter_displays`
--
ALTER TABLE `lsp_counter_displays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lsp_counter_display_authorized_p_cs`
--
ALTER TABLE `lsp_counter_display_authorized_p_cs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lsp_customers`
--
ALTER TABLE `lsp_customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `lsp_customer_invoice_emails`
--
ALTER TABLE `lsp_customer_invoice_emails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lsp_event_calenders`
--
ALTER TABLE `lsp_event_calenders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lsp_invoices`
--
ALTER TABLE `lsp_invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `lsp_invoice_email_teamplates`
--
ALTER TABLE `lsp_invoice_email_teamplates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lsp_invoice_layout_ones`
--
ALTER TABLE `lsp_invoice_layout_ones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lsp_invoice_layout_twos`
--
ALTER TABLE `lsp_invoice_layout_twos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lsp_invoice_payments`
--
ALTER TABLE `lsp_invoice_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `lsp_invoice_products`
--
ALTER TABLE `lsp_invoice_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=527;

--
-- AUTO_INCREMENT for table `lsp_invoice_profits`
--
ALTER TABLE `lsp_invoice_profits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lsp_login_activities`
--
ALTER TABLE `lsp_login_activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `lsp_migrations`
--
ALTER TABLE `lsp_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `lsp_pos_settings`
--
ALTER TABLE `lsp_pos_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lsp_printer_print_sizes`
--
ALTER TABLE `lsp_printer_print_sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lsp_products`
--
ALTER TABLE `lsp_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `lsp_product_profits`
--
ALTER TABLE `lsp_product_profits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lsp_product_stockins`
--
ALTER TABLE `lsp_product_stockins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `lsp_product_stockin_invoices`
--
ALTER TABLE `lsp_product_stockin_invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lsp_product_variances`
--
ALTER TABLE `lsp_product_variances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lsp_product_variance_datas`
--
ALTER TABLE `lsp_product_variance_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `lsp_report_settings`
--
ALTER TABLE `lsp_report_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lsp_retail_pos_summaries`
--
ALTER TABLE `lsp_retail_pos_summaries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lsp_retail_pos_summary_date_wises`
--
ALTER TABLE `lsp_retail_pos_summary_date_wises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `lsp_sales_returns`
--
ALTER TABLE `lsp_sales_returns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lsp_send_sales_emails`
--
ALTER TABLE `lsp_send_sales_emails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lsp_send_test_mails`
--
ALTER TABLE `lsp_send_test_mails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lsp_site_settings`
--
ALTER TABLE `lsp_site_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lsp_tenders`
--
ALTER TABLE `lsp_tenders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lsp_users`
--
ALTER TABLE `lsp_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lsp_vendors`
--
ALTER TABLE `lsp_vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lsp_warranties`
--
ALTER TABLE `lsp_warranties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lsp_warranty_products`
--
ALTER TABLE `lsp_warranty_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lsp_login_activities`
--
ALTER TABLE `lsp_login_activities`
  ADD CONSTRAINT `login_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `lsp_users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
