-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 15, 2020 at 02:44 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trovevhj_covidtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$NWpsKEh4W1xGkIKtAC6.zu2DEShXGetqwejYY/Qxvqhjvuq1S4gTW', '', '2018-07-17 14:36:08', '2018-07-17 22:40:33'),
(3, 'Owner', 'owner@owner.com', '$2y$10$NWpsKEh4W1xGkIKtAC6.zu2DEShXGetqwejYY/Qxvqhjvuq1S4gTW', NULL, '2018-07-17 22:29:09', '2018-07-17 22:38:13'),
(5, 'Editor', 'editor@editor.com', '$2y$10$NWpsKEh4W1xGkIKtAC6.zu2DEShXGetqwejYY/Qxvqhjvuq1S4gTW', NULL, '2018-07-17 22:36:26', '2018-07-17 22:40:18'),
(6, 'veera', 'veera@gmail.com', '$2y$10$NWpsKEh4W1xGkIKtAC6.zu2DEShXGetqwejYY/Qxvqhjvuq1S4gTW', NULL, '2018-07-25 15:29:01', '2018-07-28 03:15:08');

-- --------------------------------------------------------

--
-- Table structure for table `administrator_modules`
--

CREATE TABLE `administrator_modules` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `module_config_name` varchar(255) NOT NULL,
  `sort` tinyint(1) DEFAULT NULL,
  `category` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator_modules`
--

INSERT INTO `administrator_modules` (`id`, `name`, `module_config_name`, `sort`, `category`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Common', 'common', NULL, 0, 1, '2020-04-03 02:43:59', '2020-04-03 02:43:59'),
(12, 'Members', 'members', NULL, 0, 1, '2020-08-07 10:53:35', '2020-08-07 10:53:35'),
(13, 'Test Centers', 'testcenters', NULL, 0, 1, '2020-08-07 12:38:36', '2020-08-07 12:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `administrator_module_sections`
--

CREATE TABLE `administrator_module_sections` (
  `id` int(10) NOT NULL,
  `module` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `collection_name` varchar(255) NOT NULL,
  `sort` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator_module_sections`
--

INSERT INTO `administrator_module_sections` (`id`, `module`, `name`, `collection_name`, `sort`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Adminstrators', '', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'Roles', '', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'Permissions', '', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 'Modules', '', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 'Sections', '', 5, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 3, 'Category', '', NULL, 1, '2020-04-03 02:59:10', '2020-04-03 02:59:10'),
(9, 3, 'Customfields', '', NULL, 1, '2020-04-03 03:18:01', '2020-04-03 03:18:01'),
(10, 3, 'Sectioncustomfield', '', NULL, 1, '2020-04-05 12:51:40', '2020-04-05 12:51:40'),
(54, 12, 'Patients', 'patients', NULL, 1, '2020-08-07 12:32:41', '2020-08-07 12:32:41'),
(55, 13, 'Centers', 'centers', NULL, 1, '2020-08-07 12:41:31', '2020-08-07 12:41:31'),
(56, 13, 'Centers', 'centers', NULL, 1, '2020-08-07 12:41:43', '2020-08-07 12:41:43'),
(57, 13, 'Centers', 'centers', NULL, 1, '2020-08-07 12:43:20', '2020-08-07 12:43:20'),
(58, 13, 'Centers', 'centers', NULL, 1, '2020-08-07 12:44:18', '2020-08-07 12:44:18');

-- --------------------------------------------------------

--
-- Table structure for table `administrator_password_resets`
--

CREATE TABLE `administrator_password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `centers`
--

CREATE TABLE `centers` (
  `ID` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doctor_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street_address_1` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_address_2` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `process_type` tinyint(1) NOT NULL,
  `slots_per_hour` int(10) NOT NULL,
  `patients_per_slot` int(10) NOT NULL,
  `active` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `centers`
--

INSERT INTO `centers` (`ID`, `name`, `doctor_name`, `email_address`, `password`, `street_address_1`, `street_address_2`, `city`, `state`, `zip_code`, `process_type`, `slots_per_hour`, `patients_per_slot`, `active`, `created_at`, `updated_at`) VALUES
(4, 'Sultan Abu Bakar Complex/Kompleks Sultan Abu Bakar', 'KSAB', 'ksab@ksab.com', '$2y$10$00Rwt1IJHefdomrBw7WDtefwsvwZeeklY7AbibHPfkzsIl7b4HOBi', NULL, NULL, NULL, NULL, NULL, 2, 2, 50, '1', '2020-08-09 04:57:47', '2020-08-10 16:22:18'),
(5, 'Sultan Iskandar Building/Bangunan Sultan Iskandar', 'BSI', 'bsi@bsi.com', '$2y$10$4DQQgYcjwa4osvHw9Q7fSet/yJ.00k3stA9AlpLiIpUMkBjI/RpqW', NULL, NULL, NULL, NULL, NULL, 2, 2, 50, '1', '2020-08-09 04:59:04', '2020-08-10 19:39:19'),
(6, 'Klinik Union Medic, Kota Puteri', 'Dr. Theng Zheng Yuan', '6073820028', '$2y$10$9yP36u2xfug7vWcdWOi9EOJAInzCU.6OBh6BpsjKGxjXkUmGKHwy6', 'No. 2 (Tingkat Bawah)', 'Jalan Kota 1/4, Taman Cahaya Kota Puteri', 'Masai', 'Johor', '81750', 1, 15, 1, '1', '2020-08-13 08:55:52', '2020-08-13 08:55:52'),
(7, 'Klinik Kenko', 'Dr. Lim Musen, Dr. Calvin Low Yu Chuan, Dr. Lim Shinie', '60173181839', '$2y$10$1x.qrSEklbO0ZZ24TBtY2OiHhChIGJPQw9LbsVQCNqKbGY8dtIFH6', 'No. 9, Ground Floor, Jalan Indah 15/2', 'Taman Bukit Indah', 'Johor Bahru', 'Johor', '81200', 1, 15, 1, '1', '2020-08-13 08:57:51', '2020-08-13 08:57:51'),
(8, 'Klinik Yap & Partners', 'Dr. Teoh Hui Yee', '6075955828', '$2y$10$c5Y8qIfKhlMQH5e6XDN.ZuYYGAnHFdrExsNpfNY0jI1DMraCe581G', 'Ground Floor), 7523 & 7524', 'Jalan Enggang 19, Bandar Putra', 'Kulai', 'Johor', '81000', 1, 15, 1, '1', '2020-08-13 08:59:07', '2020-08-13 08:59:07'),
(9, 'Klinik Angkasa', 'Dr. Azzad Bin Hamzah', '6075900082', '$2y$10$hTjp8qDnOtKNI49uajf5IuNFIdE6ZP2eqogJMgR5aZl6.uXN7e6MC', 'Tingkat Bawah, No 147, Jalan Scientex Jaya 7', 'Taman Scientex', 'Senai', 'Johor', '81400', 1, 15, 1, '1', '2020-08-13 09:01:02', '2020-08-13 09:01:02'),
(10, 'Klinik Mediviron', 'Dr. Logeswary A/P Thangrajah', '6073365477', '$2y$10$soJZA/pVtotzv5NsOll5eOubaxxZL.a59EQ8u78HzDbOcDQ8ujXV.', 'No. 7 (Ground Floor), Jalan Badik 1', 'Taman Sri Tebrau', 'Johor Bahru', 'Johor', '80050', 1, 15, 1, '1', '2020-08-13 09:02:13', '2020-08-13 09:02:13'),
(11, 'Klinik Central 24 Jam', 'Dr. Teoh Kin Kiat', '60177582468', '$2y$10$val16jRP7WmlEX/p6YIDX.Md9uJyrnK5BRmbL/h/MWR/Bcec4luhq', '92 Ground Floor', 'Jalan Adda 7', 'Taman Adda', 'Johor Bahru', '81100', 1, 15, 1, '1', '2020-08-13 09:03:28', '2020-08-13 09:03:28'),
(12, 'MJ Healthcare Clinic', 'Dr. Ng Soh Hoon', '6075950703', '$2y$10$FYGrf6PEIagLNEAA.cwn5edkjFbVx1GFYSWeGmhUV6S0GrMsT9mEC', 'P-01-14 (Tingkat Bawah), Teluk Akua Biru', 'Jalan Forest City 3, Pulau Satu', 'Gelang Patah', '81550', 'Johor', 1, 15, 1, '1', '2020-08-13 09:04:35', '2020-08-13 09:04:35'),
(13, 'Klinik Keluarga I-Sihat, Pasir Gudang', 'Dr Nanda Sundaram, Dr Mok Chi Chien', '6072550571', '$2y$10$h0dTQwasEJYECPvWel4D4.KV9VaN1uh6lMQK3ALeFG1IkMhHARQ9C', 'No. 12, Jalan Serangkai 18', 'Taman Bukit Dahlia', 'Pasir Gudang', 'Johor', '81700', 1, 15, 1, '1', '2020-08-13 09:06:02', '2020-08-13 09:06:02'),
(14, 'Klinik Keluarga I-Sihat, Bandar Dato Onn', 'Dr Lavan Sundaram', '6073571859', '$2y$10$4MylkbLrO7p.KUIx1IG8OOaDGpBUZPsMakd4YMwPBhxvVXehDqUVK', 'No. 4&6, Jalan Perjiranan 4/1', 'Bandar Dato Onn', 'Johor Bahru', 'Johor', '81100', 1, 15, 1, '1', '2020-08-13 09:07:10', '2020-08-13 09:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `centers_hours_of_operation`
--

CREATE TABLE `centers_hours_of_operation` (
  `ID` int(11) NOT NULL,
  `center` int(11) NOT NULL,
  `day` int(10) NOT NULL,
  `open` varchar(255) DEFAULT NULL,
  `close` varchar(255) DEFAULT NULL,
  `all_day_close` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `centers_hours_of_operation`
--

INSERT INTO `centers_hours_of_operation` (`ID`, `center`, `day`, `open`, `close`, `all_day_close`, `active`, `updated_at`, `created_at`) VALUES
(43, 8, 1, NULL, NULL, 1, 1, '2020-08-07 22:13:23', '2020-08-07 22:13:23'),
(44, 8, 2, '9:00 AM', '6:00 PM', 0, 1, '2020-08-07 22:13:23', '2020-08-07 22:13:23'),
(45, 8, 3, '8:00 AM', '5:00 PM', 0, 1, '2020-08-07 22:13:23', '2020-08-07 22:13:23'),
(46, 8, 4, '8:00 AM', '5:00 PM', 0, 1, '2020-08-07 22:13:23', '2020-08-07 22:13:23'),
(47, 8, 5, '8:00 AM', '5:00 PM', 0, 1, '2020-08-07 22:13:23', '2020-08-07 22:13:23'),
(48, 8, 6, '9:00 AM', '6:00 PM', 0, 1, '2020-08-07 22:13:23', '2020-08-07 22:13:23'),
(49, 8, 7, NULL, NULL, 1, 1, '2020-08-07 22:13:23', '2020-08-07 22:13:23'),
(78, 6, 1, NULL, NULL, 1, 1, '2020-08-08 04:06:48', '2020-08-08 04:06:48'),
(79, 6, 2, '9:00 AM', '6:00 PM', 0, 1, '2020-08-08 04:06:48', '2020-08-08 04:06:48'),
(80, 6, 3, '8:00 AM', '5:00 PM', 0, 1, '2020-08-08 04:06:48', '2020-08-08 04:06:48'),
(81, 6, 4, '8:00 AM', '5:00 PM', 0, 1, '2020-08-08 04:06:48', '2020-08-08 04:06:48'),
(82, 6, 5, NULL, NULL, 1, 1, '2020-08-08 04:06:48', '2020-08-08 04:06:48'),
(83, 6, 6, '9:00 AM', '6:00 PM', 0, 1, '2020-08-08 04:06:48', '2020-08-08 04:06:48'),
(84, 6, 7, NULL, NULL, 1, 1, '2020-08-08 04:06:48', '2020-08-08 04:06:48'),
(85, 7, 1, NULL, NULL, 1, 1, '2020-08-08 04:50:46', '2020-08-08 04:50:46'),
(86, 7, 2, '9:00 AM', '6:00 PM', 0, 1, '2020-08-08 04:50:46', '2020-08-08 04:50:46'),
(87, 7, 3, '3:00 PM', '5:00 PM', 0, 1, '2020-08-08 04:50:46', '2020-08-08 04:50:46'),
(88, 7, 4, '8:00 AM', '5:00 PM', 0, 1, '2020-08-08 04:50:46', '2020-08-08 04:50:46'),
(89, 7, 5, '8:00 AM', '5:00 PM', 0, 1, '2020-08-08 04:50:46', '2020-08-08 04:50:46'),
(90, 7, 6, NULL, NULL, 1, 1, '2020-08-08 04:50:46', '2020-08-08 04:50:46'),
(91, 7, 7, NULL, NULL, 1, 1, '2020-08-08 04:50:46', '2020-08-08 04:50:46'),
(176, 4, 1, '7:00 AM', '7:00 PM', 0, 1, '2020-08-10 16:22:19', '2020-08-10 16:22:19'),
(177, 4, 2, '7:00 AM', '7:00 PM', 0, 1, '2020-08-10 16:22:19', '2020-08-10 16:22:19'),
(178, 4, 3, '7:00 AM', '7:00 PM', 0, 1, '2020-08-10 16:22:19', '2020-08-10 16:22:19'),
(179, 4, 4, '7:00 AM', '7:00 PM', 0, 1, '2020-08-10 16:22:19', '2020-08-10 16:22:19'),
(180, 4, 5, '7:00 AM', '7:00 PM', 0, 1, '2020-08-10 16:22:19', '2020-08-10 16:22:19'),
(181, 4, 6, '7:00 AM', '7:00 PM', 0, 1, '2020-08-10 16:22:19', '2020-08-10 16:22:19'),
(182, 4, 7, '7:00 AM', '7:00 PM', 0, 1, '2020-08-10 16:22:19', '2020-08-10 16:22:19'),
(225, 1, 1, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:03', '2020-08-11 03:08:03'),
(226, 1, 2, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:03', '2020-08-11 03:08:03'),
(227, 1, 3, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:03', '2020-08-11 03:08:03'),
(228, 1, 4, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:03', '2020-08-11 03:08:03'),
(229, 1, 5, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:03', '2020-08-11 03:08:03'),
(230, 1, 6, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:03', '2020-08-11 03:08:03'),
(231, 1, 7, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:03', '2020-08-11 03:08:03'),
(232, 2, 1, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:10', '2020-08-11 03:08:10'),
(233, 2, 2, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:10', '2020-08-11 03:08:10'),
(234, 2, 3, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:10', '2020-08-11 03:08:10'),
(235, 2, 4, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:10', '2020-08-11 03:08:10'),
(236, 2, 5, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:10', '2020-08-11 03:08:10'),
(237, 2, 6, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:10', '2020-08-11 03:08:10'),
(238, 2, 7, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:10', '2020-08-11 03:08:10'),
(239, 3, 1, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:20', '2020-08-11 03:08:20'),
(240, 3, 2, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:20', '2020-08-11 03:08:20'),
(241, 3, 3, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:20', '2020-08-11 03:08:20'),
(242, 3, 4, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:20', '2020-08-11 03:08:20'),
(243, 3, 5, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:20', '2020-08-11 03:08:20'),
(244, 3, 6, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:20', '2020-08-11 03:08:20'),
(245, 3, 7, '8:00 AM', '6:00 PM', 0, 1, '2020-08-11 03:08:20', '2020-08-11 03:08:20'),
(246, 6, 1, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:55:52', '2020-08-13 08:55:52'),
(247, 6, 2, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:55:52', '2020-08-13 08:55:52'),
(248, 6, 3, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:55:52', '2020-08-13 08:55:52'),
(249, 6, 4, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:55:52', '2020-08-13 08:55:52'),
(250, 6, 5, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:55:52', '2020-08-13 08:55:52'),
(251, 6, 6, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:55:52', '2020-08-13 08:55:52'),
(252, 6, 7, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:55:52', '2020-08-13 08:55:52'),
(253, 7, 1, '12:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:57:51', '2020-08-13 08:57:51'),
(254, 7, 2, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:57:51', '2020-08-13 08:57:51'),
(255, 7, 3, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:57:51', '2020-08-13 08:57:51'),
(256, 7, 4, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:57:51', '2020-08-13 08:57:51'),
(257, 7, 5, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:57:51', '2020-08-13 08:57:51'),
(258, 7, 6, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:57:51', '2020-08-13 08:57:51'),
(259, 7, 7, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:57:51', '2020-08-13 08:57:51'),
(260, 8, 1, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:59:07', '2020-08-13 08:59:07'),
(261, 8, 2, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:59:07', '2020-08-13 08:59:07'),
(262, 8, 3, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:59:07', '2020-08-13 08:59:07'),
(263, 8, 4, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:59:07', '2020-08-13 08:59:07'),
(264, 8, 5, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:59:07', '2020-08-13 08:59:07'),
(265, 8, 6, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:59:07', '2020-08-13 08:59:07'),
(266, 8, 7, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 08:59:07', '2020-08-13 08:59:07'),
(267, 9, 1, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:01:02', '2020-08-13 09:01:02'),
(268, 9, 2, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:01:02', '2020-08-13 09:01:02'),
(269, 9, 3, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:01:02', '2020-08-13 09:01:02'),
(270, 9, 4, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:01:02', '2020-08-13 09:01:02'),
(271, 9, 5, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:01:02', '2020-08-13 09:01:02'),
(272, 9, 6, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:01:02', '2020-08-13 09:01:02'),
(273, 9, 7, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:01:02', '2020-08-13 09:01:02'),
(274, 10, 1, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:02:13', '2020-08-13 09:02:13'),
(275, 10, 2, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:02:13', '2020-08-13 09:02:13'),
(276, 10, 3, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:02:13', '2020-08-13 09:02:13'),
(277, 10, 4, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:02:13', '2020-08-13 09:02:13'),
(278, 10, 5, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:02:13', '2020-08-13 09:02:13'),
(279, 10, 6, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:02:13', '2020-08-13 09:02:13'),
(280, 10, 7, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:02:13', '2020-08-13 09:02:13'),
(281, 11, 1, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:03:28', '2020-08-13 09:03:28'),
(282, 11, 2, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:03:28', '2020-08-13 09:03:28'),
(283, 11, 3, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:03:28', '2020-08-13 09:03:28'),
(284, 11, 4, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:03:28', '2020-08-13 09:03:28'),
(285, 11, 5, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:03:28', '2020-08-13 09:03:28'),
(286, 11, 6, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:03:28', '2020-08-13 09:03:28'),
(287, 11, 7, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:03:28', '2020-08-13 09:03:28'),
(288, 12, 1, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:04:35', '2020-08-13 09:04:35'),
(289, 12, 2, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:04:35', '2020-08-13 09:04:35'),
(290, 12, 3, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:04:35', '2020-08-13 09:04:35'),
(291, 12, 4, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:04:35', '2020-08-13 09:04:35'),
(292, 12, 5, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:04:35', '2020-08-13 09:04:35'),
(293, 12, 6, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:04:35', '2020-08-13 09:04:35'),
(294, 12, 7, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:04:35', '2020-08-13 09:04:35'),
(295, 13, 1, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:06:02', '2020-08-13 09:06:02'),
(296, 13, 2, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:06:02', '2020-08-13 09:06:02'),
(297, 13, 3, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:06:02', '2020-08-13 09:06:02'),
(298, 13, 4, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:06:02', '2020-08-13 09:06:02'),
(299, 13, 5, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:06:02', '2020-08-13 09:06:02'),
(300, 13, 6, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:06:02', '2020-08-13 09:06:02'),
(301, 13, 7, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:06:02', '2020-08-13 09:06:02'),
(302, 14, 1, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:07:10', '2020-08-13 09:07:10'),
(303, 14, 2, '12:08 AM', '6:00 PM', 0, 1, '2020-08-13 09:07:10', '2020-08-13 09:07:10'),
(304, 14, 3, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:07:10', '2020-08-13 09:07:10'),
(305, 14, 4, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:07:10', '2020-08-13 09:07:10'),
(306, 14, 5, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:07:10', '2020-08-13 09:07:10'),
(307, 14, 6, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:07:10', '2020-08-13 09:07:10'),
(308, 14, 7, '8:00 AM', '6:00 PM', 0, 1, '2020-08-13 09:07:10', '2020-08-13 09:07:10'),
(309, 5, 1, '7:00 AM', '7:00 PM', 0, 1, '2020-08-13 15:51:12', '2020-08-13 15:51:12'),
(310, 5, 2, '7:00 AM', '7:00 PM', 0, 1, '2020-08-13 15:51:12', '2020-08-13 15:51:12'),
(311, 5, 3, '7:00 AM', '7:00 PM', 0, 1, '2020-08-13 15:51:12', '2020-08-13 15:51:12'),
(312, 5, 4, '7:00 AM', '7:00 PM', 0, 1, '2020-08-13 15:51:12', '2020-08-13 15:51:12'),
(313, 5, 5, '7:00 AM', '7:00 PM', 0, 1, '2020-08-13 15:51:12', '2020-08-13 15:51:12'),
(314, 5, 6, '7:00 AM', '7:00 PM', 0, 1, '2020-08-13 15:51:12', '2020-08-13 15:51:12'),
(315, 5, 7, '7:00 AM', '7:00 PM', 0, 1, '2020-08-13 15:51:12', '2020-08-13 15:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `core_category`
--

CREATE TABLE `core_category` (
  `ID` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `gallery_url` varchar(255) DEFAULT NULL,
  `meta_title` text,
  `meta_description` text,
  `meta_keywords` text,
  `order` tinyint(3) DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `display` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_category`
--

INSERT INTO `core_category` (`ID`, `name`, `caption`, `description`, `image`, `video_url`, `gallery_url`, `meta_title`, `meta_description`, `meta_keywords`, `order`, `active`, `display`, `created_at`, `updated_at`) VALUES
(1, 'Traditional Food', 'Traditional Food', 'Traditional Food', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2020-05-26 12:54:40', '2020-05-26 13:09:19'),
(2, 'Village Food', 'Village Food', 'Village Food', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2020-05-26 13:09:35', '2020-05-26 13:09:35'),
(3, 'South Indian Food', 'South Indian Food', 'South Indian Food', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2020-05-26 13:09:49', '2020-05-26 13:09:49'),
(4, 'North Indian Food', 'North Indian Food', 'North Indian Food', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2020-05-26 13:10:01', '2020-05-26 13:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `core_category_custom_fields`
--

CREATE TABLE `core_category_custom_fields` (
  `ID` int(10) NOT NULL,
  `module` int(10) NOT NULL,
  `category` int(10) NOT NULL,
  `custom_field` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `core_category_mapping`
--

CREATE TABLE `core_category_mapping` (
  `ID` smallint(5) UNSIGNED NOT NULL,
  `category` smallint(5) UNSIGNED NOT NULL,
  `parent` smallint(5) UNSIGNED NOT NULL,
  `module` smallint(5) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_category_mapping`
--

INSERT INTO `core_category_mapping` (`ID`, `category`, `parent`, `module`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 11, '2020-05-26 12:54:40', '2020-05-26 12:54:40'),
(2, 2, 0, 11, '2020-05-26 13:09:35', '2020-05-26 13:09:35'),
(3, 3, 0, 11, '2020-05-26 13:09:49', '2020-05-26 13:09:49'),
(4, 4, 0, 11, '2020-05-26 13:10:01', '2020-05-26 13:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `core_country`
--

CREATE TABLE `core_country` (
  `ID` smallint(5) UNSIGNED NOT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_country`
--

INSERT INTO `core_country` (`ID`, `code`, `name`, `active`) VALUES
(1, 'AF', 'Afganistan', 1),
(2, 'AX', 'Aland Islands', 1),
(3, 'AL', 'Albania', 1),
(4, 'DZ', 'Algeria', 1),
(5, 'AS', 'American Samoa', 1),
(6, 'AD', 'Andorra', 1),
(7, 'AO', 'Angola', 1),
(8, 'AI', 'Anguilla', 1),
(9, 'AQ', 'Antarctica', 1),
(10, 'AG', 'Antigua And Barbuda', 1),
(11, 'AR', 'Argentina', 1),
(12, 'AM', 'Armenia', 1),
(13, 'AW', 'Aruba', 1),
(14, 'AU', 'Australia', 1),
(15, 'AT', 'Austria', 1),
(16, 'AZ', 'Azerbaijan', 1),
(17, 'BS', 'Bahamas', 1),
(18, 'BH', 'Bahrain', 1),
(19, 'BD', 'Bangladesh', 1),
(20, 'BB', 'Barbados', 1),
(21, 'BY', 'Belarus', 1),
(22, 'BE', 'Belgium', 1),
(23, 'BZ', 'Belize', 1),
(24, 'BJ', 'Benin', 1),
(25, 'BM', 'Bermuda', 1),
(26, 'BT', 'Bhutan', 1),
(27, 'BO', 'Bolivia', 1),
(28, 'BA', 'Bosnia And Herzegovina', 1),
(29, 'BW', 'Botswana', 1),
(30, 'BV', 'Bouvet Island', 1),
(31, 'BR', 'Brazil', 1),
(32, 'IO', 'British Indian Ocean Territory', 1),
(33, 'BN', 'Brunei Darussalam', 1),
(34, 'BG', 'Bulgaria', 1),
(35, 'BF', 'Burkina Faso', 1),
(36, 'BI', 'Burundi', 1),
(37, 'KH', 'Cambodia', 1),
(38, 'CM', 'Cameroon', 1),
(39, 'CA', 'Canada', 1),
(40, 'CV', 'Cape Verde', 1),
(41, 'KY', 'Cayman Islands', 1),
(42, 'CF', 'Central African Republic', 1),
(43, 'TD', 'Chad', 1),
(44, 'CL', 'Chile', 1),
(45, 'CN', 'China', 1),
(46, 'CX', 'Chritmas Island', 1),
(47, 'CC', 'Cocos (Keeling) Islands', 1),
(48, 'CO', 'Colombia', 1),
(49, 'KM', 'Comoros', 1),
(50, 'CG', 'Congo', 1),
(51, 'CD', 'Congo, The Democratic Republic Of the', 1),
(52, 'CK', 'Cook Islands', 1),
(53, 'CR', 'Costa Rica', 1),
(54, 'CI', 'Cote Divoire', 1),
(55, 'HR', 'Croatia', 1),
(56, 'CU', 'Cuba', 1),
(57, 'CY', 'Cyprus', 1),
(58, 'CZ', 'Czech Republic', 1),
(59, 'DK', 'Denmark', 1),
(60, 'DJ', 'Djibouti', 1),
(61, 'DM', 'Dominica', 1),
(62, 'DO', 'Dominician Republic', 1),
(63, 'EC', 'Ecuador', 1),
(64, 'EG', 'Egypt', 1),
(65, 'SV', 'El Salvador', 1),
(66, 'GQ', 'Equatorial Guinea', 1),
(67, 'ER', 'Eritrea', 1),
(68, 'EE', 'Estonia', 1),
(69, 'ET', 'Ethiopia', 1),
(70, 'FK', 'Falkland Islands (malvinas)', 1),
(71, 'FO', 'Faroe Islands', 1),
(72, 'FJ', 'Fiji', 1),
(73, 'FI', 'Finland', 1),
(74, 'FR', 'France', 1),
(75, 'GF', 'French Guiana', 1),
(76, 'PF', 'French Ploynesia', 1),
(77, 'TF', 'French Southern Territories', 1),
(78, 'GA', 'Gabon', 1),
(79, 'GM', 'Gambia', 1),
(80, 'GE', 'Georgia', 1),
(81, 'DE', 'Germany', 1),
(82, 'GH', 'Ghana', 1),
(83, 'GI', 'Gibraltar', 1),
(84, 'GR', 'Greece', 1),
(85, 'GL', 'Greenland', 1),
(86, 'GD', 'Grenada', 1),
(87, 'GP', 'Guadeloupe', 1),
(88, 'GU', 'Guam', 1),
(89, 'GT', 'Guatemala', 1),
(90, 'GG', 'Guernsey', 1),
(91, 'GN', 'Guinea', 1),
(92, 'GW', 'Guinea-bissau', 1),
(93, 'GY', 'Guyana', 1),
(94, 'HT', 'Haiti', 1),
(95, 'HM', 'Heard Island And Mcdonald Islands', 1),
(96, 'HN', 'Honduras', 1),
(97, 'HK', 'Hong Kong', 1),
(98, 'HU', 'Hungary', 1),
(99, 'IS', 'Iceland', 1),
(100, 'IN', 'India', 1),
(101, 'ID', 'Indonesia', 1),
(102, 'IR', 'Iran, Islamic Republic Of', 1),
(103, 'IQ', 'Iraq', 1),
(104, 'IE', 'Ireland', 1),
(105, 'IM', 'Isle Of Man', 1),
(106, 'IL', 'Israel', 1),
(107, 'IT', 'Italy', 1),
(108, 'JM', 'Jamaica', 1),
(109, 'JP', 'Japan', 1),
(110, 'JE', 'Jersey', 1),
(111, 'JO', 'Jordan', 1),
(112, 'KZ', 'Kazakhstan', 1),
(113, 'KE', 'Kenya', 1),
(114, 'KI', 'Kiribati', 1),
(115, 'KP', 'Korea, Democratic Peoples Republic Of', 1),
(116, 'KR', 'Korea, Republic', 1),
(117, 'KW', 'Kuwait', 1),
(118, 'KG', 'Kyrgyzstan', 1),
(119, 'LA', 'Lao Peoples Democratic Republic', 1),
(120, 'LV', 'Latvia', 1),
(121, 'LB', 'Lebanon', 1),
(122, 'LS', 'Lesotho', 1),
(123, 'LR', 'Liberia', 1),
(124, 'LY', 'Libyan Arab Jamahiriya', 1),
(125, 'LI', 'Liechtenstein', 1),
(126, 'LT', 'Lithuania', 1),
(127, 'LU', 'Luxembourg', 1),
(128, 'MO', 'Macao', 1),
(129, 'MK', 'Macedonia, The Former Yugoslav REpublic Of', 1),
(130, 'MG', 'Madagascar', 1),
(131, 'MW', 'Malawi', 1),
(132, 'MY', 'Malaysia', 1),
(133, 'MV', 'Maldives', 1),
(134, 'ML', 'Mali', 1),
(135, 'MT', 'Malta', 1),
(136, 'MH', 'Marshall Islands', 1),
(137, 'MQ', 'Martinique', 1),
(138, 'MR', 'Mauritania', 1),
(139, 'MU', 'Mauritius', 1),
(140, 'YT', 'Mayotte', 1),
(141, 'MX', 'Mexico', 1),
(142, 'FM', 'Micronesia, Federated States Of', 1),
(143, 'MD', 'Moldova', 1),
(144, 'MC', 'Monaco', 1),
(145, 'MN', 'Mongolia', 1),
(146, 'ME', 'Montenegro, The Former Yugoslav REpublic Of', 1),
(147, 'MS', 'Montserrat', 1),
(148, 'MA', 'Morocco', 1),
(149, 'MZ', 'Mozambique', 1),
(150, 'MM', 'Myanmar', 1),
(151, 'NA', 'Namibia', 1),
(152, 'NR', 'Nauru', 1),
(153, 'NP', 'Nepal', 1),
(154, 'NL', 'Netherlands', 1),
(155, 'AN', 'Netherlands Antilles', 1),
(156, 'NC', 'New Caledonia', 1),
(157, 'NZ', 'New Zealand', 1),
(158, 'NI', 'Nicaragua', 1),
(159, 'NE', 'Niger', 1),
(160, 'NG', 'Nigeria', 1),
(161, 'NU', 'Niue', 1),
(162, 'NF', 'Norfolk Island', 1),
(163, 'MP', 'Northern Mariana Isalnds', 1),
(164, 'NO', 'Norway', 1),
(165, 'OM', 'Oman', 1),
(166, 'PK', 'Pakistan', 1),
(167, 'PW', 'Palau', 1),
(168, 'PS', 'Palestinian Territory, Occupied', 1),
(169, 'PA', 'Panama', 1),
(170, 'PG', 'Papua New Guinea', 1),
(171, 'PY', 'Paraguay', 1),
(172, 'PE', 'Peru', 1),
(173, 'PH', 'Philippines', 1),
(174, 'PN', 'Pitcairn', 1),
(175, 'PL', 'Poland', 1),
(176, 'PT', 'Portugal', 1),
(177, 'PR', 'Puerto Rico', 1),
(178, 'QA', 'Qatar', 1),
(179, 'RE', 'REuinon', 1),
(180, 'RO', 'Romania', 1),
(181, 'RU', 'Russian Federation', 1),
(182, 'RW', 'Rwanda', 1),
(183, 'BL', 'Saint BarthElemy', 1),
(184, 'SH', 'Saint Helena', 1),
(185, 'KN', 'Saint Kitts And Nevis', 1),
(186, 'LC', 'Saint Lucia', 1),
(187, 'MF', 'Saint Martin', 1),
(188, 'PM', 'Saint Pierre And Miquelon', 1),
(189, 'VC', 'Saint Vincent And The Grenadines', 1),
(190, 'WS', 'Samoa', 1),
(191, 'SM', 'San Marino', 1),
(192, 'ST', 'Sao Tome And Principe', 1),
(193, 'SA', 'Saudi Arabia', 1),
(194, 'SN', 'Senegal', 1),
(195, 'RS', 'Serbia', 1),
(196, 'SC', 'Seychellas', 1),
(197, 'SL', 'Sierra Leone', 1),
(198, 'SG', 'Singapore', 1),
(199, 'SK', 'Slovakia', 1),
(200, 'SI', 'Slovenia', 1),
(201, 'SB', 'Solomon Islands', 1),
(202, 'SO', 'Somalia', 1),
(203, 'ZA', 'South Africa', 1),
(204, 'GS', 'South Georgia And The South Sandwich Islands', 1),
(205, 'ES', 'Spain', 1),
(206, 'LK', 'Sri Lanka', 1),
(207, 'SD', 'Sudan', 1),
(208, 'SR', 'Suriname', 1),
(209, 'SJ', 'Svalbard And Jan Mayen', 1),
(210, 'SZ', 'Swaziland', 1),
(211, 'SE', 'Swedan', 1),
(212, 'CH', 'Switzerland', 1),
(213, 'SY', 'Syrian Arab Republic', 1),
(214, 'TW', 'Taiwan, Province Of China', 1),
(215, 'TJ', 'Tajikistan', 1),
(216, 'TZ', 'Tanzania, United Republic Of', 1),
(217, 'TH', 'Thailand', 1),
(218, 'TL', 'Timor-leste', 1),
(219, 'TG', 'Togo', 1),
(220, 'TK', 'Tokelau', 1),
(221, 'TO', 'Tonga', 1),
(222, 'TT', 'Trinidad And Tobago', 1),
(223, 'TN', 'Tunisia', 1),
(224, 'TR', 'Turkey', 1),
(225, 'TM', 'Turkmenistan', 1),
(226, 'TC', 'Turks And Caicos Islands', 1),
(227, 'TV', 'Tuvalu', 1),
(228, 'UG', 'Uganda', 1),
(229, 'UA', 'Ukraine', 1),
(230, 'AE', 'United Arab Emirates', 1),
(231, 'GB', 'United Kingdom', 1),
(232, 'US', 'United States', 1),
(233, 'UM', 'United States Minor Outlying Islands', 1),
(234, 'UY', 'Uruguay', 1),
(235, 'UZ', 'Uzbekistan', 1),
(236, 'VU', 'Vanuatu', 1),
(237, 'VA', 'Vatican City State', 1),
(238, 'VE', 'Venezuela', 1),
(239, 'VN', 'Viet Nam', 1),
(240, 'VG', 'Virgin ISlands, British', 1),
(241, 'VI', 'Virgin Islands, U.s.', 1),
(242, 'WF', 'Wallis And Futuna', 1),
(243, 'EH', 'Western Sahara', 1),
(244, 'YE', 'Yemen', 1),
(245, 'ZM', 'Zambia', 1),
(246, 'ZW', 'Zimbabwe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `core_custom_fields`
--

CREATE TABLE `core_custom_fields` (
  `ID` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_custom_fields`
--

INSERT INTO `core_custom_fields` (`ID`, `type`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 2, 'Description', 1, '2020-04-03 17:34:38', '2020-04-06 04:31:25'),
(2, 6, 'sex', 1, '2020-04-03 17:40:55', '2020-04-03 17:40:55'),
(3, 1, 'Name', 1, '2020-04-03 17:41:16', '2020-04-03 17:41:16'),
(4, 4, 'Courses', 1, '2020-04-06 04:32:33', '2020-04-06 04:32:33'),
(5, 5, 'Weather', 1, '2020-04-06 04:34:02', '2020-04-06 04:34:02'),
(6, 6, 'Months', 1, '2020-04-06 04:35:08', '2020-04-06 04:35:08'),
(7, 7, 'Hobbies', 1, '2020-04-06 12:45:37', '2020-04-06 12:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `core_custom_field_type`
--

CREATE TABLE `core_custom_field_type` (
  `ID` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_custom_field_type`
--

INSERT INTO `core_custom_field_type` (`ID`, `name`, `type`) VALUES
(1, 'Text Box', 'text'),
(2, 'Text Area', 'textarea'),
(3, 'File Upload ', 'file'),
(4, 'Drop Down', 'dropdown'),
(5, 'Check Box', 'checkbox'),
(6, 'Radio Button', 'radio'),
(7, 'Multi-Select Drop Down', 'multi_select_dropdown');

-- --------------------------------------------------------

--
-- Table structure for table `core_custom_field_values`
--

CREATE TABLE `core_custom_field_values` (
  `ID` int(10) UNSIGNED NOT NULL,
  `field` smallint(5) UNSIGNED NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_custom_field_values`
--

INSERT INTO `core_custom_field_values` (`ID`, `field`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'test', '2020-04-03 12:04:38', '2020-04-03 12:04:38'),
(2, 1, ' test 2', '2020-04-03 12:04:38', '2020-04-03 12:04:38'),
(3, 1, 'test 4', '2020-04-03 12:04:38', '2020-04-03 12:04:38'),
(4, 2, 'male', '2020-04-03 12:10:55', '2020-04-03 12:10:55'),
(5, 2, ' female', '2020-04-03 12:10:55', '2020-04-03 12:10:55'),
(6, 4, 'PHP', '2020-04-05 23:02:33', '2020-04-05 23:02:33'),
(7, 4, 'Javascript', '2020-04-05 23:02:33', '2020-04-05 23:02:33'),
(8, 4, 'MySql', '2020-04-05 23:02:33', '2020-04-05 23:02:33'),
(9, 4, 'NodeJS', '2020-04-05 23:02:33', '2020-04-05 23:02:33'),
(10, 4, 'Python', '2020-04-05 23:02:33', '2020-04-05 23:02:33'),
(11, 5, 'Summer', '2020-04-05 23:04:02', '2020-04-05 23:04:02'),
(12, 5, 'Winter', '2020-04-05 23:04:02', '2020-04-05 23:04:02'),
(13, 5, 'Spring', '2020-04-05 23:04:02', '2020-04-05 23:04:02'),
(14, 5, 'Atumn', '2020-04-05 23:04:02', '2020-04-05 23:04:02'),
(15, 6, 'January', '2020-04-05 23:05:08', '2020-04-05 23:05:08'),
(16, 6, 'February', '2020-04-05 23:05:08', '2020-04-05 23:05:08'),
(17, 6, 'March', '2020-04-05 23:05:08', '2020-04-05 23:05:08'),
(18, 6, 'April', '2020-04-05 23:05:08', '2020-04-05 23:05:08'),
(19, 6, 'May', '2020-04-05 23:05:08', '2020-04-05 23:05:08'),
(20, 7, 'Cricket', '2020-04-06 07:15:37', '2020-04-06 07:15:37'),
(21, 7, 'Foot Ball', '2020-04-06 07:15:37', '2020-04-06 07:15:37'),
(22, 7, 'Hockey', '2020-04-06 07:15:37', '2020-04-06 07:15:37'),
(23, 7, 'Pubg', '2020-04-06 07:15:37', '2020-04-06 07:15:37'),
(24, 7, 'Rugby', '2020-04-06 07:15:37', '2020-04-06 07:15:37'),
(25, 7, 'Basket Ball', '2020-04-06 07:15:37', '2020-04-06 07:15:37'),
(26, 7, 'Volley Ball', '2020-04-06 07:15:37', '2020-04-06 07:15:37'),
(27, 7, 'Carrom', '2020-04-06 07:15:37', '2020-04-06 07:15:37'),
(28, 7, 'Tennis', '2020-04-06 07:15:37', '2020-04-06 07:15:37'),
(29, 7, 'Thayam', '2020-04-06 07:15:37', '2020-04-06 07:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `core_days`
--

CREATE TABLE `core_days` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `core_days`
--

INSERT INTO `core_days` (`ID`, `name`, `active`) VALUES
(1, 'Sunday', 1),
(2, 'Monday', 1),
(3, 'Tuesday', 1),
(4, 'Wednesday', 1),
(5, 'Thursday', 1),
(6, 'Friday', 1),
(7, 'Saturday', 1);

-- --------------------------------------------------------

--
-- Table structure for table `core_file_type`
--

CREATE TABLE `core_file_type` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `mime` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_file_type`
--

INSERT INTO `core_file_type` (`ID`, `name`, `icon`, `mime`, `active`) VALUES
(1, 'Word', 'msword/word_icon', 'application/msword', 1),
(2, 'PDF', 'pdf/pdf_icon', 'application/pdf', 1),
(3, 'Excel', 'excel/excel_icon', 'application/vnd.ms-excel', 1);

-- --------------------------------------------------------

--
-- Table structure for table `core_image_sizes`
--

CREATE TABLE `core_image_sizes` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `width` int(10) NOT NULL,
  `height` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `collection_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_image_sizes`
--

INSERT INTO `core_image_sizes` (`ID`, `name`, `width`, `height`, `section`, `collection_name`, `created_at`, `updated_at`) VALUES
(1, 'small', 50, 50, 30, 'recipe', '2020-05-26 12:48:16', '2020-05-26 12:48:16'),
(2, 'thumb', 100, 100, 30, 'recipe', '2020-05-26 12:48:16', '2020-05-26 12:48:16'),
(3, 'medium', 250, 250, 30, 'recipe', '2020-05-26 12:48:16', '2020-05-26 12:48:16'),
(4, 'standard', 500, 500, 30, 'recipe', '2020-05-26 12:48:16', '2020-05-26 12:48:16'),
(5, 'large', 750, 750, 30, 'recipe', '2020-05-26 12:48:16', '2020-05-26 12:48:16'),
(6, 'actual', 1000, 1000, 30, 'recipe', '2020-05-26 12:48:17', '2020-05-26 12:48:17'),
(7, 'small', 50, 50, 54, 'patients', '2020-08-07 07:02:43', '2020-08-07 07:02:43'),
(8, 'thumb', 100, 100, 54, 'patients', '2020-08-07 07:02:43', '2020-08-07 07:02:43'),
(9, 'medium', 250, 250, 54, 'patients', '2020-08-07 07:02:43', '2020-08-07 07:02:43'),
(10, 'standard', 500, 500, 54, 'patients', '2020-08-07 07:02:43', '2020-08-07 07:02:43'),
(11, 'large', 750, 750, 54, 'patients', '2020-08-07 07:02:43', '2020-08-07 07:02:43'),
(12, 'actual', 1000, 1000, 54, 'patients', '2020-08-07 07:02:43', '2020-08-07 07:02:43'),
(13, 'small', 50, 50, 58, 'centers', '2020-08-07 07:14:20', '2020-08-07 07:14:20'),
(14, 'thumb', 100, 100, 58, 'centers', '2020-08-07 07:14:20', '2020-08-07 07:14:20'),
(15, 'medium', 250, 250, 58, 'centers', '2020-08-07 07:14:20', '2020-08-07 07:14:20'),
(16, 'standard', 500, 500, 58, 'centers', '2020-08-07 07:14:20', '2020-08-07 07:14:20'),
(17, 'large', 750, 750, 58, 'centers', '2020-08-07 07:14:20', '2020-08-07 07:14:20'),
(18, 'actual', 1000, 1000, 58, 'centers', '2020-08-07 07:14:20', '2020-08-07 07:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `core_position`
--

CREATE TABLE `core_position` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_position`
--

INSERT INTO `core_position` (`ID`, `name`, `active`, `created_at`, `modified_at`) VALUES
(1, 'Top', 1, '2020-04-08 09:43:55', '0000-00-00 00:00:00'),
(2, 'Bottom', 1, '2020-04-08 09:43:55', '0000-00-00 00:00:00'),
(3, 'Left', 1, '2020-04-08 09:44:06', '0000-00-00 00:00:00'),
(4, 'Right', 1, '2020-04-08 09:44:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `core_section_category`
--

CREATE TABLE `core_section_category` (
  `ID` int(10) NOT NULL,
  `section_rs` int(10) UNSIGNED NOT NULL,
  `section` smallint(5) UNSIGNED NOT NULL,
  `category` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_section_category`
--

INSERT INTO `core_section_category` (`ID`, `section_rs`, `section`, `category`) VALUES
(7, 33, 7, 21),
(8, 34, 7, 21),
(9, 35, 7, 21),
(28, 19, 7, 3),
(30, 21, 7, 3),
(31, 22, 7, 4),
(32, 23, 7, 4),
(33, 1, 33, 27),
(34, 1, 37, 28),
(35, 4, 54, 29),
(36, 6, 54, 29),
(37, 7, 54, 29),
(38, 1, 16, 30),
(39, 1, 17, 31),
(40, 1, 22, 34),
(41, 1, 30, 1),
(42, 2, 30, 1),
(43, 3, 30, 1),
(44, 4, 30, 1),
(45, 5, 30, 1),
(46, 6, 30, 1),
(47, 7, 30, 1),
(48, 8, 30, 1),
(49, 9, 30, 1),
(50, 10, 30, 1),
(51, 11, 30, 1),
(52, 12, 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `core_section_custom_field_data`
--

CREATE TABLE `core_section_custom_field_data` (
  `ID` int(10) NOT NULL,
  `section_rs` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `custom_field` int(10) NOT NULL,
  `input_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_section_custom_field_data`
--

INSERT INTO `core_section_custom_field_data` (`ID`, `section_rs`, `section`, `custom_field`, `input_data`) VALUES
(4, 1, 33, 1, 'test'),
(5, 1, 33, 3, 'test '),
(6, 1, 33, 4, '3'),
(23, 512, 7, 4, '3'),
(24, 512, 7, 5, '11'),
(25, 512, 7, 6, '19'),
(26, 512, 7, 7, '0'),
(27, 19, 7, 4, '9'),
(28, 19, 7, 5, '11,13'),
(29, 19, 7, 6, '16'),
(30, 19, 7, 7, '20,21,23'),
(31, 1, 22, 1, 'This is test Description'),
(32, 1, 22, 2, '4'),
(33, 1, 22, 3, 'Veerabharathi'),
(34, 1, 22, 4, '10'),
(35, 1, 22, 5, '12'),
(36, 1, 22, 6, '19'),
(37, 1, 22, 7, '20,23,27');

-- --------------------------------------------------------

--
-- Table structure for table `core_section_files`
--

CREATE TABLE `core_section_files` (
  `ID` int(10) NOT NULL,
  `section_rs` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `keywords` text,
  `file` varchar(255) NOT NULL,
  `type` tinyint(3) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_section_files`
--

INSERT INTO `core_section_files` (`ID`, `section_rs`, `section`, `title`, `description`, `keywords`, `file`, `type`, `active`, `updated_at`, `created_at`) VALUES
(3, 3, 7, 'rstest', 'testset', NULL, '1586977749.pdf', 2, 1, '2020-04-15 13:39:09', '2020-04-14 15:08:07'),
(4, 3, 7, 'test', 'est', NULL, '1586977709.pdf', 2, 1, '2020-04-15 13:38:29', '2020-04-15 13:38:29'),
(5, 3, 7, 'test', 'est', NULL, 'ACFrOgCFFhascjXKAZnS9LT3Mjl_8_LyYCpiLHDn4cCdmHCwm0svby4Qlv0u84iiF22KYEK9LYfebu3kEUEP3AqYjQrTzcfFY5c7o35nJSVBdDX0ZNp5TP7AWxz3WI2kSTkPnbsZr5O56yrdzoDv.pdf', 2, 1, '2020-04-15 13:51:16', '2020-04-15 13:51:16'),
(6, 4, 7, 'tes', 'tetst', NULL, 'ACFrOgCFFhascjXKAZnS9LT3Mjl_8_LyYCpiLHDn4cCdmHCwm0svby4Qlv0u84iiF22KYEK9LYfebu3kEUEP3AqYjQrTzcfFY5c7o35nJSVBdDX0ZNp5TP7AWxz3WI2kSTkPnbsZr5O56yrdzoDv.pdf', 1, 1, '2020-04-15 13:58:58', '2020-04-15 13:58:58'),
(7, 5, 7, 'ttttttttest', 'ttttttttest', NULL, 'ACFrOgCFFhascjXKAZnS9LT3Mjl_8_LyYCpiLHDn4cCdmHCwm0svby4Qlv0u84iiF22KYEK9LYfebu3kEUEP3AqYjQrTzcfFY5c7o35nJSVBdDX0ZNp5TP7AWxz3WI2kSTkPnbsZr5O56yrdzoDv.pdf', 1, 1, '2020-04-15 14:00:26', '2020-04-15 14:00:26'),
(8, 6, 7, 'ttttttttest', 'ttttttttest', NULL, 'ACFrOgCFFhascjXKAZnS9LT3Mjl_8_LyYCpiLHDn4cCdmHCwm0svby4Qlv0u84iiF22KYEK9LYfebu3kEUEP3AqYjQrTzcfFY5c7o35nJSVBdDX0ZNp5TP7AWxz3WI2kSTkPnbsZr5O56yrdzoDv.pdf', 1, 1, '2020-04-15 14:07:31', '2020-04-15 14:07:31'),
(9, 7, 7, 'ttttttttest', 'ttttttttest', NULL, 'ACFrOgCFFhascjXKAZnS9LT3Mjl_8_LyYCpiLHDn4cCdmHCwm0svby4Qlv0u84iiF22KYEK9LYfebu3kEUEP3AqYjQrTzcfFY5c7o35nJSVBdDX0ZNp5TP7AWxz3WI2kSTkPnbsZr5O56yrdzoDv.pdf', 1, 1, '2020-04-15 14:07:52', '2020-04-15 14:07:52'),
(10, 19, 7, 'test', 'test', NULL, 'ad_a1e611a1b6.pdf', 2, 1, '2020-04-19 12:51:48', '2020-04-19 12:51:48'),
(11, 19, 7, 'test', 'test', NULL, 'ad_5bcfc7fcdf.pdf', 2, 1, '2020-04-19 12:51:56', '2020-04-19 12:51:56'),
(12, 19, 7, 'test 2342343', 'tetst', NULL, 'adverstisements_07fe66835d.docx', 1, 1, '2020-04-22 18:18:22', '2020-04-19 13:14:20'),
(13, 19, 7, 'test 2342343', 'tetst', NULL, 'ad_8c4bf427d3.docx', 1, 1, '2020-04-19 13:14:29', '2020-04-19 13:14:29'),
(15, 19, 7, 'test 12323232', 'test', NULL, 'ad_c37f5bdc85.docx', 1, 1, '2020-04-19 13:18:57', '2020-04-19 13:18:57'),
(16, 19, 7, 'test asdf asd asd 23434343', 'test', NULL, 'ad_ccca32a6b9.docx', 1, 1, '2020-04-19 13:43:11', '2020-04-19 13:19:18'),
(17, 19, 7, 'test', 'test', NULL, 'ad_cf6ec77280.pdf', 2, 1, '2020-04-19 13:19:36', '2020-04-19 13:19:36'),
(23, 21, 7, 'test', 'test', NULL, 'ad_6e6b8f583e.pdf', 2, 1, '2020-04-19 16:27:31', '2020-04-19 16:27:31'),
(24, 21, 7, 'test', 'est', NULL, 'ad_58a73cdf8b.xlsx', 3, 1, '2020-04-19 16:28:00', '2020-04-19 16:28:00'),
(25, 21, 7, 'test', 'ttest', NULL, 'ad_df04401902.docx', 1, 1, '2020-04-19 16:28:31', '2020-04-19 16:28:31'),
(26, 22, 7, 'tes', 'test', NULL, 'ad_3610fc9ffb.pdf', 2, 1, '2020-04-19 16:52:59', '2020-04-19 16:50:53'),
(27, 24, 7, 'test', NULL, NULL, 'ad_afe620b57b.pdf', 2, 1, '2020-04-19 16:54:17', '2020-04-19 16:54:17'),
(28, 23, 7, 'test', 'test', NULL, 'adverstisements_68701ed861.pdf', 2, 1, '2020-04-20 13:30:43', '2020-04-20 13:30:43'),
(29, 1, 33, 'tes', 'test', NULL, 'test_2a71ad197c.pdf', 2, 1, '2020-04-21 12:06:54', '2020-04-21 12:06:54'),
(30, 4, 54, 'test', 'etst', NULL, 'test_71a2640d54.docx', 1, 1, '2020-04-30 18:17:34', '2020-04-30 18:17:34'),
(31, 6, 54, 'tes', 'test', NULL, 'test_5a54b0aca2.docx', 1, 1, '2020-05-01 03:01:42', '2020-05-01 03:01:42'),
(32, 1, 16, 'test', 'test', NULL, 'test_d0270f004b.docx', 1, 1, '2020-05-01 16:59:30', '2020-05-01 16:59:30'),
(33, 1, 17, 'test', 'test', NULL, 'test_1d5750e946.docx', 1, 1, '2020-05-01 18:51:15', '2020-05-01 18:51:15'),
(34, 480, 19, 'test', 'test', NULL, 'test_46ed523b2e.docx', 1, 1, '2020-05-02 17:23:42', '2020-05-02 17:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `core_section_images`
--

CREATE TABLE `core_section_images` (
  `ID` int(10) NOT NULL,
  `section_rs` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `alt_tag_text` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `mime` varchar(50) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_section_images`
--

INSERT INTO `core_section_images` (`ID`, `section_rs`, `section`, `title`, `description`, `alt_tag_text`, `image`, `mime`, `sort`, `created_at`, `updated_at`) VALUES
(1, 19, 33, 'test', NULL, NULL, 'test_afbd7d81d4.jpeg', 'image/jpeg', NULL, '2020-04-21 12:06:54', '2020-04-21 12:06:54'),
(4, 22, 7, 'test', NULL, NULL, 'adverstisements_e4a175e8ca.jpeg', 'image/jpeg', NULL, '2020-04-21 14:25:23', '2020-04-21 14:25:23'),
(7, 21, 7, 'test', NULL, NULL, 'adverstisements_170cb8d32e.jpeg', 'image/jpeg', NULL, '2020-04-22 15:16:55', '2020-04-22 15:16:55'),
(8, 19, 7, 'test', NULL, NULL, 'adverstisements_a03d4bc7a3.jpeg', 'image/jpeg', NULL, '2020-04-22 15:18:35', '2020-04-22 15:18:35'),
(9, 1, 37, 'test', NULL, NULL, 'test_255e661739.jpeg', 'image/jpeg', NULL, '2020-04-29 16:31:56', '2020-04-29 16:31:56'),
(10, 4, 54, 'test', NULL, NULL, 'test_4e7d60665f.jpeg', 'image/jpeg', NULL, '2020-04-30 18:17:34', '2020-04-30 18:17:34'),
(11, 6, 54, 'test', NULL, NULL, 'test_b63f4123ef.jpeg', 'image/jpeg', NULL, '2020-05-01 03:01:41', '2020-05-01 03:01:41'),
(12, 6, 54, 'tes', NULL, NULL, 'test_050729ccc1.jpg', 'image/jpeg', NULL, '2020-05-01 03:01:41', '2020-05-01 03:01:41'),
(13, 6, 54, 'test', NULL, NULL, 'test_e46f448348.jpeg', 'image/jpeg', NULL, '2020-05-01 03:01:42', '2020-05-01 03:01:42'),
(14, 6, 54, 'test', NULL, NULL, 'test_92f8a018bf.jpeg', 'image/jpeg', NULL, '2020-05-01 03:01:42', '2020-05-01 03:01:42'),
(15, 1, 16, 'test', NULL, NULL, 'test_dbd8658f08.jpeg', 'image/jpeg', NULL, '2020-05-01 16:59:30', '2020-05-01 16:59:30'),
(16, 1, 16, 'test', NULL, NULL, 'test_47b33f2646.jpg', 'image/jpeg', NULL, '2020-05-01 16:59:30', '2020-05-01 16:59:30'),
(17, 1, 16, 'test', NULL, NULL, 'test_cb9b3e7034.jpeg', 'image/jpeg', NULL, '2020-05-01 16:59:30', '2020-05-01 16:59:30'),
(18, 1, 16, 'test', NULL, NULL, 'test_f873f14290.jpeg', 'image/jpeg', NULL, '2020-05-01 16:59:30', '2020-05-01 16:59:30'),
(19, 1, 17, 'test', NULL, NULL, 'test_3d22cf2fb3.jpeg', 'image/jpeg', NULL, '2020-05-01 18:51:14', '2020-05-01 18:51:14'),
(20, 1, 17, 'test', NULL, NULL, 'test_2f049fddd2.jpeg', 'image/jpeg', NULL, '2020-05-01 18:51:14', '2020-05-01 18:51:14'),
(21, 1, 17, 'test', NULL, NULL, 'test_8561cf4701.jpg', 'image/jpeg', NULL, '2020-05-01 18:51:14', '2020-05-01 18:51:14'),
(22, 1, 17, 'test', NULL, NULL, 'test_ae0df4f583.jpeg', 'image/jpeg', NULL, '2020-05-01 18:51:15', '2020-05-01 18:51:15'),
(23, 23, 7, 'test', NULL, NULL, 'advertisements_e12a55e635.jpeg', 'image/jpeg', NULL, '2020-05-02 13:58:56', '2020-05-02 13:58:56'),
(24, 480, 19, 'test', NULL, NULL, 'test_e7c260e4ef.jpeg', 'image/jpeg', NULL, '2020-05-02 17:20:47', '2020-05-02 17:20:47'),
(25, 480, 19, 'test', NULL, NULL, 'test_9b4b800a8b.jpg', 'image/jpeg', NULL, '2020-05-02 17:20:50', '2020-05-02 17:20:50'),
(26, 492, 20, 'test', NULL, NULL, 'test_08be2fa47d.jpeg', 'image/jpeg', NULL, '2020-05-03 02:01:21', '2020-05-03 02:01:21'),
(27, 496, 21, 'test', NULL, NULL, 'test_51ab8cc05b.jpeg', 'image/jpeg', NULL, '2020-05-03 03:16:56', '2020-05-03 03:16:56'),
(28, 1, 22, 'test', NULL, NULL, 'test_119f1aa9a1.jpeg', 'image/jpeg', NULL, '2020-05-03 15:38:13', '2020-05-03 15:38:13'),
(29, 1, 22, 'test', NULL, NULL, 'test_51b83d9a42.jpg', 'image/jpeg', NULL, '2020-05-03 15:38:13', '2020-05-03 15:38:13'),
(30, 1, 22, 'test', NULL, NULL, 'test_f9da79647e.jpeg', 'image/jpeg', NULL, '2020-05-03 15:38:14', '2020-05-03 15:38:14'),
(31, 1, 22, 'test', NULL, NULL, 'test_138726c3f1.jpeg', 'image/jpeg', NULL, '2020-05-03 15:38:14', '2020-05-03 15:38:14'),
(32, 1, 25, 'test', NULL, NULL, 'members_1cd0401fe5.jpg', 'image/jpeg', NULL, '2020-05-07 17:42:33', '2020-05-07 17:42:33'),
(35, 1, 30, 'Tomato Dates Yummy Halwa Recipe in Tamil | Cooking Halwa Simple Recipe', 'Tomato Dates Yummy Halwa Recipe in Tamil | Cooking Halwa Simple Recipe', NULL, 'recipe_8e12686f70.jpg', 'image/jpeg', NULL, '2020-06-16 16:02:29', '2020-06-16 16:02:29'),
(36, 2, 30, 'Coconut Milk DUM Briyani Recipe in Tamil', 'Coconut Milk DUM Briyani Recipe in Tamil', NULL, 'recipe_ae329d6d05.jpg', 'image/jpeg', NULL, '2020-06-16 16:05:43', '2020-06-16 16:05:43'),
(37, 3, 30, 'Spicy Chicken Curry Recipe', 'Spicy Chicken Curry Recipe', NULL, 'recipe_ce579303bc.jpg', 'image/jpeg', NULL, '2020-06-16 16:07:24', '2020-06-16 16:07:24'),
(38, 4, 30, 'Spicy Coconut Milk Rasam |  Thengai Paal Rasam', 'Spicy Coconut Milk Rasam |  Thengai Paal Rasam', NULL, 'recipe_98208f0c66.jpg', 'image/jpeg', NULL, '2020-06-16 16:08:33', '2020-06-16 16:08:33'),
(39, 5, 30, 'Amuku Muttai Masala - Boiled Egg Masala Recipe', 'Amuku Muttai Masala - Boiled Egg Masala Recipe', NULL, 'recipe_3d5401e27c.jpg', 'image/jpeg', NULL, '2020-06-16 16:10:47', '2020-06-16 16:10:47'),
(40, 6, 30, 'Healthy Murungai Keerai Kootu | Healthy Food Cooking Recipe', 'Healthy Murungai Keerai Kootu | Healthy Food Cooking Recipe', NULL, 'recipe_cd7ae5ead2.jpg', 'image/jpeg', NULL, '2020-06-16 16:11:59', '2020-06-16 16:11:59'),
(41, 7, 30, 'How to make Soft Gulap Jamun ?', 'How to make Soft Gulap Jamun ?', NULL, 'recipe_9d14f35fc0.JPG', 'image/jpeg', NULL, '2020-06-16 16:16:51', '2020-06-16 16:16:51'),
(42, 8, 30, 'Mango Chocolate Jelly | Home Made Jelly Recipe', 'Mango Chocolate Jelly | Home Made Jelly Recipe', NULL, 'recipe_e59c58e810.JPG', 'image/jpeg', NULL, '2020-06-16 16:18:39', '2020-06-16 16:18:39'),
(43, 9, 30, 'Crispy Uludha Vadai', 'Crispy Uludha Vadai', NULL, 'recipe_df0d69d945.JPG', 'image/jpeg', NULL, '2020-06-16 16:20:46', '2020-06-16 16:20:46'),
(44, 10, 30, 'Vanjaram fish fry in tamil | Fish Fry Recipe In Tamil', 'Vanjaram fish fry in tamil | Fish Fry Recipe In Tamil', NULL, 'recipe_d58fff82ac.JPG', 'image/jpeg', NULL, '2020-06-16 16:22:10', '2020-06-16 16:22:10'),
(45, 11, 30, 'Traditional Vatlappam Sweet | Festival Sweet Recipe', 'Traditional Vatlappam Sweet | Festival Sweet Recipe', NULL, 'recipe_1cd20964c5.JPG', 'image/jpeg', NULL, '2020-06-16 16:24:28', '2020-06-16 16:24:28'),
(46, 12, 30, 'Quick Chutney Recipe in Tamil | Coconut Chutney in Tamil | Onion Chutney in Tamil', 'Quick Chutney Recipe in Tamil | Coconut Chutney in Tamil | Onion Chutney in Tamil', NULL, 'recipe_c50c5f18bf.png', 'image/png', NULL, '2020-06-16 16:26:42', '2020-06-16 16:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `core_section_meta_detail`
--

CREATE TABLE `core_section_meta_detail` (
  `ID` int(10) NOT NULL,
  `section_rs` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_section_meta_detail`
--

INSERT INTO `core_section_meta_detail` (`ID`, `section_rs`, `section`, `meta_title`, `meta_keywords`, `meta_description`, `active`, `created_at`, `updated_at`) VALUES
(1, 19, 7, 'test 1', 'test 2', 'test4', 1, '2020-04-18 22:13:34', '2020-04-18 22:13:34'),
(2, 21, 7, 'tes', 'test', 'test', 1, '2020-04-19 21:44:31', '2020-04-19 21:44:31'),
(3, 22, 7, '234', '3434', '343', 1, '2020-04-19 22:20:53', '2020-04-19 22:20:53'),
(4, 23, 7, 'tet', 'et', 't', 1, '2020-04-20 19:00:43', '2020-04-20 19:00:43'),
(5, 1, 33, 'test', 'test 3', 'test 4', 1, '2020-04-21 17:36:54', '2020-04-21 17:36:54'),
(6, 1, 37, 'tes', 'test', 'test', 1, '2020-04-29 22:01:56', '2020-04-29 22:01:56'),
(7, 4, 54, 'test', 'test', 'test', 1, '2020-04-30 23:47:34', '2020-04-30 23:47:34'),
(8, 6, 54, 'test1', 'ttest2', 'test3', 1, '2020-05-01 08:31:42', '2020-05-01 08:31:42'),
(9, 1, 16, 'test1', 'test2', 'test4', 1, '2020-05-01 22:29:30', '2020-05-01 22:29:30'),
(10, 1, 17, 'test1', 'test2', 'test4', 1, '2020-05-02 00:21:15', '2020-05-02 00:21:15'),
(11, 480, 19, 'test2', 'test4', 'erst54', 1, '2020-05-02 22:53:55', '2020-05-02 22:53:55'),
(12, 1, 22, 'test1', 'test2', 'test3', 1, '2020-05-03 21:08:14', '2020-05-03 21:08:14'),
(13, 1, 30, 'Tomato Dates Yummy Halwa Recipe in Tamil | Cooking Halwa Simple Recipe', 'cooking,halwa,halwa cooking,tomato,dates,tomato sweet,recipe,tomato date halwa,tomato date sweet,tamil cooking,south indian cooking,village cooking,home cooking,samayal video,alwa samayal,halwa recipe,sweet recipe,samayal videos,cooking videos in tamil,cooking recipes video,best cooking youtube,indian cooking video,samayal kurippu tamil video,cooking videos tasty,home cooking videos,samayal kurippu video,deshi food channel,chicken dum biryani videos', 'cooking,halwa,halwa cooking,tomato,dates,tomato sweet,recipe,tomato date halwa,tomato date sweet,tamil cooking,south indian cooking,village cooking,home cooking,samayal video,alwa samayal,halwa recipe,sweet recipe,samayal videos,cooking videos in tamil,cooking recipes video,best cooking youtube,indian cooking video,samayal kurippu tamil video,cooking videos tasty,home cooking videos,samayal kurippu video,deshi food channel,chicken dum biryani videos', 1, '2020-06-16 21:33:16', '2020-06-16 21:33:16'),
(14, 2, 30, 'Coconut Milk DUM Briyani Recipe in Tamil', 'samayal videos,samayal,cooking,samayal kurippu,deshi food,fish cooking,simple cooking,fast cooking,village cooking,biryani cooking,cooking videos in tamil,cooking recipes video,best cooking youtube,indian cooking video,samayal kurippu tamil video,cooking videos tasty,home cooking,most popular cooking,recipes,cooking food,kitchen tips,chicken cooking,food preparation,cooking recipes,cooking recipes in tamil,amma samayal,chicken biryani', 'samayal videos,samayal,cooking,samayal kurippu,deshi food,fish cooking,simple cooking,fast cooking,village cooking,biryani cooking,cooking videos in tamil,cooking recipes video,best cooking youtube,indian cooking video,samayal kurippu tamil video,cooking videos tasty,home cooking,most popular cooking,recipes,cooking food,kitchen tips,chicken cooking,food preparation,cooking recipes,cooking recipes in tamil,amma samayal,chicken biryani', 1, '2020-06-16 21:35:43', '2020-06-16 21:35:43'),
(15, 3, 30, 'Spicy Chicken Curry Recipe', 'samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,simple cooking,fast cooking,village cooking,biryani cooking,cooking videos in tamil,cooking recipes video,best cooking youtube,indian cooking video,samayal kurippu tamil video,cooking videos tasty,home cooking videos,samayal kurippu video,deshi food channel,simple cooking channel,most popular cooking videos recipes,cake cooking video,village cooking videos,cooking food video,biryani', 'samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,simple cooking,fast cooking,village cooking,biryani cooking,cooking videos in tamil,cooking recipes video,best cooking youtube,indian cooking video,samayal kurippu tamil video,cooking videos tasty,home cooking videos,samayal kurippu video,deshi food channel,simple cooking channel,most popular cooking videos recipes,cake cooking video,village cooking videos,cooking food video,biryani', 1, '2020-06-16 21:37:24', '2020-06-16 21:37:24'),
(16, 4, 30, 'Spicy Coconut Milk Rasam |  Thengai Paal Rasam', 'coconut,milk,rasam,coconut milk rasam,spicy rasam,cooking rasam,rasam samayal,cooking,samayal,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,cooking videos in tamil,cooking recipes video,best cooking youtube,indian cooking video,chicken dum biryani,samayal tips tamil,indian food recipes,amma samayal tamil,chicken biryani,kitchen cooking,new cooking,recipes in tamil', 'coconut,milk,rasam,coconut milk rasam,spicy rasam,cooking rasam,rasam samayal,cooking,samayal,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,cooking videos in tamil,cooking recipes video,best cooking youtube,indian cooking video,chicken dum biryani,samayal tips tamil,indian food recipes,amma samayal tamil,chicken biryani,kitchen cooking,new cooking,recipes in tamil', 1, '2020-06-16 21:38:33', '2020-06-16 21:38:33'),
(17, 5, 30, 'Amuku Muttai Masala - Boiled Egg Masala Recipe', 'amuku muttai,egg masala,muttai masala,samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,cooking videos in tamil,cooking recipes video,best cooking youtube,indian cooking video,cooking videos tasty,samayal kurippu video,chicken dum biryani,small cooking,amma samayal,cooking recipes,best cooking,most popular cooking,home cooking,foodie,indian cooking', 'amuku muttai,egg masala,muttai masala,samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,cooking videos in tamil,cooking recipes video,best cooking youtube,indian cooking video,cooking videos tasty,samayal kurippu video,chicken dum biryani,small cooking,amma samayal,cooking recipes,best cooking,most popular cooking,home cooking,foodie,indian cooking', 1, '2020-06-16 21:40:09', '2020-06-16 21:40:09'),
(18, 6, 30, 'Healthy Murungai Keerai Kootu | Healthy Food Cooking Recipe', 'murungai,keerai,murungai keerai,koottu,drumstick,drumstick spinach,samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos', 'murungai,keerai,murungai keerai,koottu,drumstick,drumstick spinach,samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos', 1, '2020-06-16 21:42:00', '2020-06-16 21:42:00'),
(19, 7, 30, 'How to make Soft Gulap Jamun ?', 'samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos,gulap jamun,sweet,soft gulap jamun,yummy gulap jamun', 'samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos,gulap jamun,sweet,soft gulap jamun,yummy gulap jamun', 1, '2020-06-16 21:44:11', '2020-06-16 21:44:11'),
(20, 8, 30, 'Mango Chocolate Jelly | Home Made Jelly Recipe', 'samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos,sweet,jelly,mango jelly,chocolcate jelly,mango chocolate jelly', 'samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos,sweet,jelly,mango jelly,chocolcate jelly,mango chocolate jelly', 1, '2020-06-16 21:48:39', '2020-06-16 21:48:39'),
(21, 9, 30, 'Crispy Uludha Vadai', 'methu vadai,crispy vadai,ulunthu vadai,vadai,samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos', 'methu vadai,crispy vadai,ulunthu vadai,vadai,samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos', 1, '2020-06-16 21:50:46', '2020-06-16 21:50:46'),
(22, 10, 30, 'Vanjaram fish fry in tamil | Fish Fry Recipe In Tamil', 'fish,fish fry,vanjaram fish,vanjaram fish firy,samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos,masala coat', 'fish,fish fry,vanjaram fish,vanjaram fish firy,samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos,masala coat', 1, '2020-06-16 21:52:10', '2020-06-16 21:52:10'),
(23, 11, 30, 'Traditional Vatlappam Sweet | Festival Sweet Recipe', 'vatlappam,sweet,festival sweet,sweet recipe,traditional sweet,samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos', 'vatlappam,sweet,festival sweet,sweet recipe,traditional sweet,samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos', 1, '2020-06-16 21:54:28', '2020-06-16 21:54:28'),
(24, 12, 30, 'Quick Chutney Recipe in Tamil | Coconut Chutney in Tamil | Onion Chutney in Tamil', 'chutney,quick chutney,coconut chutney,onion chutney,samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos', 'chutney,quick chutney,coconut chutney,onion chutney,samayal,cooking,samayal kurippu,deshi food,fish cooking,cake cooking,samayal videos,simple cooking,fast cooking,village cooking,biryani cooking,chicken dum biryani,samayal tips tamil,small cooking,indian food recipes,amma samayal,chicken biryani,amma samayal videos,biryani,food preparation,kitchen tips,best cooking,most popular cooking,samayal kurippu video,home cooking videos', 1, '2020-06-16 21:56:42', '2020-06-16 21:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `core_section_videos`
--

CREATE TABLE `core_section_videos` (
  `ID` int(10) NOT NULL,
  `section_rs` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `type` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `video_url` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_section_videos`
--

INSERT INTO `core_section_videos` (`ID`, `section_rs`, `section`, `type`, `title`, `description`, `video_url`, `active`, `created_at`, `updated_at`) VALUES
(5, 2, 7, 2, 'veeraa', '5555', '5555', 1, '2020-04-13 17:08:52', '2020-04-13 17:50:26'),
(6, 2, 7, 1, 'ewt', 'w3', '323', 1, '2020-04-13 17:09:58', '2020-04-13 17:09:58'),
(7, 2, 7, 1, '222222222222', '22222222', '2222222222', 1, '2020-04-13 17:10:59', '2020-04-13 17:10:59'),
(8, 2, 7, 1, 'test', 'test', 'test', 1, '2020-04-13 17:12:17', '2020-04-13 17:12:17'),
(9, 1, 7, 1, 'this is the test post', 'this is the test post', 'https://www.youtube.com/watch?v=Z5BJhoQux7g', 1, '2020-04-14 15:06:58', '2020-04-14 15:06:58'),
(10, 2, 7, 1, 'this is the test post', 'this is the test post', 'https://www.youtube.com/watch?v=Z5BJhoQux7g', 1, '2020-04-14 15:07:36', '2020-04-14 15:07:36'),
(11, 3, 7, 1, 'this is the test post', 'this is the test post', 'https://www.youtube.com/watch?v=Z5BJhoQux7g', 1, '2020-04-14 15:08:07', '2020-04-14 15:08:07'),
(12, 19, 7, 1, 'This property video', 'This property video', 'https://www.youtube.com/watch?v=iaJx_pX7Ze8', 1, '2020-04-18 16:43:34', '2020-04-18 16:43:34'),
(13, 19, 7, 2, 'vimeo video', 'test', 'https://vimeo.com/179801258', 1, '2020-04-19 20:10:22', '2020-04-19 20:10:22'),
(14, 19, 7, 2, 'test', 'https://vimeo.com/275924291', 'https://vimeo.com/275924291', 1, '2020-04-19 14:53:25', '2020-04-19 14:53:25'),
(15, 19, 7, 1, 'test', 'test', 'https://www.youtube.com/watch?v=cQWeTnOwlm4', 1, '2020-04-19 14:55:12', '2020-04-19 14:55:12'),
(17, 19, 7, 1, 'tet', NULL, 'https://www.youtube.com/watch?v=KBMOKoVgJJ0', 1, '2020-04-19 14:57:45', '2020-04-19 14:58:04'),
(18, 20, 7, 1, 'https://www.youtube.com/watch?v=sb6WlQiaJeM', NULL, 'https://www.youtube.com/watch?v=7XqEJO-wt7s', 1, '2020-04-19 16:13:08', '2020-04-19 16:13:08'),
(19, 20, 7, 1, 'https://www.youtube.com/watch?v=sjhiaPEjRo0 test', NULL, 'https://www.youtube.com/watch?v=sjhiaPEjRo0', 1, '2020-04-19 16:13:08', '2020-04-19 16:13:08'),
(20, 20, 7, 2, 'https://vimeo.com/256763496', NULL, 'https://vimeo.com/256763496', 1, '2020-04-19 16:13:08', '2020-04-19 16:13:08'),
(21, 21, 7, 1, 'https://www.youtube.com/watch?v=sb6WlQiaJeM', NULL, 'https://www.youtube.com/watch?v=7XqEJO-wt7s', 1, '2020-04-19 16:14:30', '2020-04-19 16:14:30'),
(22, 21, 7, 1, 'https://www.youtube.com/watch?v=sjhiaPEjRo0 test', NULL, 'https://www.youtube.com/watch?v=sjhiaPEjRo0', 1, '2020-04-19 16:14:30', '2020-04-19 16:14:30'),
(23, 21, 7, 2, 'https://vimeo.com/256763496', NULL, 'https://vimeo.com/256763496', 1, '2020-04-19 16:14:30', '2020-04-19 16:14:30'),
(24, 22, 7, 1, 'test', NULL, 'https://www.youtube.com/watch?v=sjhiaPEjRo0', 1, '2020-04-19 16:50:53', '2020-04-19 16:50:53'),
(25, 23, 7, 1, 'test', 'test', 'https://www.youtube.com/watch?v=_9lAj68is8Y', 1, '2020-04-20 13:30:43', '2020-04-20 13:30:43'),
(26, 1, 33, 1, 'https://www.youtube.com/watch?v=hcNp4lLup2M', 'https://www.youtube.com/watch?v=hcNp4lLup2M', 'https://www.youtube.com/watch?v=hcNp4lLup2M', 1, '2020-04-21 12:06:54', '2020-04-21 12:06:54'),
(27, 4, 54, 1, 'test', 'tes', 'https://www.youtube.com/watch?v=LCWQPzGzvjk', 1, '2020-04-30 18:17:34', '2020-04-30 18:17:34'),
(28, 6, 54, 1, 'Test test', 'test', 'https://www.youtube.com/watch?v=VJW2e8_cIfw', 1, '2020-05-01 03:01:42', '2020-05-01 03:01:42'),
(29, 1, 16, 1, 'https://www.youtube.com/watch?v=4Z-QCDyL2q4', 'https://www.youtube.com/watch?v=4Z-QCDyL2q4', 'https://www.youtube.com/watch?v=4Z-QCDyL2q4', 1, '2020-05-01 16:59:30', '2020-05-01 16:59:30'),
(30, 1, 17, 1, 'test', 'test', 'https://www.youtube.com/watch?v=cEz9w4MQlYM', 1, '2020-05-01 18:51:15', '2020-05-01 18:51:15'),
(31, 480, 19, 1, 'test', 'etst', 'https://www.youtube.com/watch?v=QGnaTIMlBH0', 1, '2020-05-02 17:23:17', '2020-05-02 17:23:17'),
(32, 492, 20, 1, 'test', 'test', 'https://www.youtube.com/watch?v=QZ1DaQgg3lE', 1, '2020-05-03 02:05:45', '2020-05-03 02:05:45'),
(33, 1, 22, 1, '300', NULL, 'https://www.youtube.com/watch?v=FeT7KU6ssW0', 1, '2020-05-03 15:38:14', '2020-05-03 15:38:14'),
(35, 1, 30, 1, 'Tomato Dates Yummy Halwa Recipe in Tamil | Cooking Halwa Simple Recipe', 'Tomato Dates Yummy Halwa Recipe in Tamil | Cooking Halwa Simple Recipe', 'https://youtu.be/iKE33dABPv0', 1, '2020-06-16 16:02:55', '2020-06-16 16:02:55'),
(36, 2, 30, 1, 'Coconut Milk DUM Briyani Recipe in Tamil', 'Coconut Milk DUM Briyani Recipe in Tamil', 'https://youtu.be/JjKzU-w_gc0', 1, '2020-06-16 16:05:43', '2020-06-16 16:05:43'),
(37, 3, 30, 1, 'Spicy Chicken Curry Recipe', 'Sameera Maya Kitchen is an infotainment channel which aims to engage an audience of cooking and recipe.  we are making videos for traditional food recipe, village food recipe, south Indian food recipe, north Indian food recipe and also street food recipe. Please watch our videos and share your comments with us. Thank you', 'https://youtu.be/NUAJ2lzv-R4', 1, '2020-06-16 16:07:24', '2020-06-16 16:07:24'),
(38, 4, 30, 1, 'Spicy Coconut Milk Rasam |  Thengai Paal Rasam', 'Spicy Coconut Milk Rasam |  Thengai Paal Rasam', 'https://youtu.be/dTzYRsBU_sk', 1, '2020-06-16 16:08:33', '2020-06-16 16:08:33'),
(39, 5, 30, 1, 'Amuku Muttai Masala - Boiled Egg Masala Recipe', 'Amuku Muttai Masala - Boiled Egg Masala Recipe', 'https://youtu.be/-dzyHBJTp5Q', 1, '2020-06-16 16:10:09', '2020-06-16 16:10:09'),
(40, 6, 30, 1, 'Healthy Murungai Keerai Kootu | Healthy Food Cooking Recipe', 'Healthy Murungai Keerai Kootu | Healthy Food Cooking Recipe', 'https://youtu.be/fh-BYdNHV6g', 1, '2020-06-16 16:12:00', '2020-06-16 16:12:00'),
(41, 7, 30, 1, 'How to make Soft Gulap Jamun ?', 'How to make Soft Gulap Jamun ?', 'https://youtu.be/ykDxoDxksnA', 1, '2020-06-16 16:14:11', '2020-06-16 16:14:11'),
(42, 8, 30, 1, 'Mango Chocolate Jelly | Home Made Jelly Recipe', 'Mango Chocolate Jelly | Home Made Jelly Recipe', 'https://youtu.be/OVj8QoFSUUI', 1, '2020-06-16 16:18:39', '2020-06-16 16:18:39'),
(43, 9, 30, 1, 'Crispy Uludha Vadai', 'Crispy Uludha Vadai', 'https://youtu.be/8lZZYEmZ3Uw', 1, '2020-06-16 16:20:46', '2020-06-16 16:20:46'),
(44, 10, 30, 1, 'Vanjaram fish fry in tamil | Fish Fry Recipe In Tamil', 'Vanjaram fish fry in tamil | Fish Fry Recipe In Tamil', 'https://youtu.be/ykxjsrHR73s', 1, '2020-06-16 16:22:10', '2020-06-16 16:22:10'),
(45, 11, 30, 1, 'Traditional Vatlappam Sweet | Festival Sweet Recipe', 'Traditional Vatlappam Sweet | Festival Sweet Recipe', 'https://youtu.be/92Oh2LYFCus', 1, '2020-06-16 16:24:28', '2020-06-16 16:24:28'),
(46, 12, 30, 1, 'Quick Chutney Recipe in Tamil | Coconut Chutney in Tamil | Onion Chutney in Tamil', 'Quick Chutney Recipe in Tamil | Coconut Chutney in Tamil | Onion Chutney in Tamil', 'https://youtu.be/lCrqPKTGqaE', 1, '2020-06-16 16:26:42', '2020-06-16 16:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `core_video_type`
--

CREATE TABLE `core_video_type` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_video_type`
--

INSERT INTO `core_video_type` (`ID`, `name`, `active`) VALUES
(1, 'YouTube', 1),
(2, 'Vimeo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_components`
--

CREATE TABLE `form_components` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `component_name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_components`
--

INSERT INTO `form_components` (`ID`, `name`, `file_path`, `component_name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Category', 'category.cmp-category-drop-down', 'Category', 1, '2020-04-12 06:19:01', '0000-00-00 00:00:00'),
(2, 'Images', 'images.image-add-edit', 'Image', 1, '2020-04-12 06:19:04', '0000-00-00 00:00:00'),
(3, 'Videos', 'videos.video-add-edit', 'Video', 1, '2020-04-12 06:19:09', '0000-00-00 00:00:00'),
(4, 'Files', 'files.file-add-edit', 'File', 1, '2020-04-12 06:19:13', '0000-00-00 00:00:00'),
(5, 'Meta Details', 'meta-form.meta-details\r\n\r\n', 'Meta', 1, '2020-04-12 06:19:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `form_section_components`
--

CREATE TABLE `form_section_components` (
  `ID` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `form_component` int(10) NOT NULL,
  `position` tinyint(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_section_components`
--

INSERT INTO `form_section_components` (`ID`, `section`, `form_component`, `position`, `created_at`, `updated_at`) VALUES
(1, 7, 1, 1, '2020-04-11 20:47:15', '0000-00-00 00:00:00'),
(2, 7, 2, 2, '2020-04-19 22:13:14', '0000-00-00 00:00:00'),
(3, 7, 3, 2, '2020-04-11 22:49:03', '0000-00-00 00:00:00'),
(4, 7, 4, 2, '2020-04-11 21:37:02', '0000-00-00 00:00:00'),
(5, 7, 5, 2, '2020-04-11 22:46:48', '0000-00-00 00:00:00'),
(256, 22, 1, 1, '2020-05-03 15:26:56', '2020-05-03 15:26:56'),
(257, 22, 2, 2, '2020-05-03 15:26:56', '2020-05-03 15:26:56'),
(258, 22, 3, 2, '2020-05-03 15:26:56', '2020-05-03 15:26:56'),
(259, 22, 4, 2, '2020-05-03 15:26:56', '2020-05-03 15:26:56'),
(260, 22, 5, 2, '2020-05-03 15:26:56', '2020-05-03 15:26:56'),
(296, 30, 1, 1, '2020-05-26 12:48:16', '2020-05-26 12:48:16'),
(297, 30, 2, 2, '2020-05-26 12:48:16', '2020-05-26 12:48:16'),
(298, 30, 3, 2, '2020-05-26 12:48:16', '2020-05-26 12:48:16'),
(299, 30, 4, 2, '2020-05-26 12:48:16', '2020-05-26 12:48:16'),
(300, 30, 5, 2, '2020-05-26 12:48:16', '2020-05-26 12:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `ID` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`ID`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Veerabharathi', 'Vijayarahavan', 'v.veerabharathi@gmail.com', NULL, '$2y$10$I5nhefXq9757rwjElRqBWOEGdZ3wEBr2PuSgmefjQIosFvOkKoGBa', NULL, '1', '2020-05-07 17:30:51', '2020-05-07 17:49:49'),
(2, 'vivek', 'vijay', 'veerabharathi2020@gmail.com', NULL, '$2y$10$q71HtCvjmM5D9lifMnIgKupvgjAVL9lUSr2cCottca2uAxZ3pvN3K', NULL, '0', '2020-05-07 19:51:58', '2020-05-07 19:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_03_29_113909_create_permission_tables', 1),
(5, '2020_03_30_212536_create_administrator_password_resets_table', 2),
(6, '2020_03_31_233227_create_ads_table', 3),
(7, '2020_03_31_233802_create_ads_table', 4),
(8, '2020_03_31_234135_create_ads_table', 5),
(9, '2020_03_31_234824_create_ads_table', 6),
(10, '2020_03_31_235207_create_ads_table', 7),
(11, '2020_03_31_235414_create_ads_table', 8),
(12, '2020_03_31_235754_create_ads_table', 9),
(13, '2020_04_01_000122_create_ads_table', 10),
(14, '2020_04_01_000526_create_ads_table', 11),
(15, '2020_04_01_000749_create_ads_table', 12),
(16, '2020_04_01_003522_create_ads_table', 13),
(17, '2020_04_01_004205_create_ads_table', 14),
(18, '2020_04_02_194449_create_categories_table', 15),
(19, '2020_04_03_025914_create_categories_table', 16),
(20, '2020_04_03_031802_create_customfields_table', 17),
(21, '2020_04_05_130533_create_sectioncustomfields_table', 18),
(22, '2020_04_20_232518_create_tests_table', 19),
(23, '2020_04_20_233544_create_tests_table', 20),
(24, '2020_04_21_001401_create_tests_table', 21),
(25, '2020_04_21_003216_create_tests_table', 22),
(26, '2020_04_21_004809_create_tests_table', 23),
(27, '2020_04_21_005059_create_tests_table', 24),
(28, '2020_04_21_011240_create_tests_table', 25),
(29, '2020_04_21_011943_create_tests_table', 26),
(30, '2020_04_21_012903_create_tests_table', 27),
(31, '2020_04_21_173359_create_tests_table', 28),
(32, '2020_04_29_212235_create_tests_table', 29),
(33, '2020_04_29_215758_create_tests_table', 30),
(34, '2020_04_30_232706_create_tests_table', 31),
(35, '2020_05_01_222507_create_tests_table', 32),
(36, '2020_05_01_234431_create_tests_table', 33),
(37, '2020_05_02_220959_create_tests_table', 34),
(38, '2020_05_02_223409_create_tests_table', 35),
(39, '2020_05_03_071851_create_tests_table', 36),
(40, '2020_05_03_083752_create_tests_table', 37),
(41, '2020_05_03_205657_create_tests_table', 38),
(42, '2020_05_07_225132_create_members_table', 39),
(43, '2020_05_26_181815_create_recipes_table', 40),
(44, '2020_08_07_123242_create_patients_table', 41),
(45, '2020_08_07_124418_create_centers_table', 42);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'Modules\\Administrator\\Entities\\Administrator', 1),
(2, 'Modules\\Administrator\\Entities\\Administrator', 3),
(3, 'Modules\\Administrator\\Entities\\Administrator', 5),
(1, 'Modules\\Administrator\\Entities\\Administrator', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `ID` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identity_type` tinyint(1) NOT NULL,
  `nric_passport` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_address` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` int(10) NOT NULL,
  `symtoms` tinyint(1) NOT NULL,
  `travelled_infected_country` tinyint(1) NOT NULL,
  `active` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `sessionid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`ID`, `name`, `identity_type`, `nric_passport`, `gender`, `dob`, `phone`, `email_address`, `country`, `symtoms`, `travelled_infected_country`, `active`, `sessionid`, `created_at`, `updated_at`) VALUES
(1, 'Vinoth', 0, '1238564522', '1', '2020-08-13', '9944909167', 'v.veerabharathi@gmail.com', 100, 0, 0, '1', 'Ntyy3OUAw45gFMtlc5CwNuzXYbregtKnIqnpe13O', '2020-08-11 02:26:16', '2020-08-11 02:26:16'),
(2, 'Vikramathitan', 0, '56465456465', '1', '2020-07-29', '919944909167', 'v.veerabharathi@gmail.com', 100, 0, 0, '1', 'w3UYTN7sFLuHZv7tSsvdX9qKpoiqXwWKV1gyupQy', '2020-08-11 02:34:15', '2020-08-11 02:34:15'),
(3, 'Vikraman', 0, '56465456465', '1', NULL, '919444100057', 'althaf@belmonttek.com', 14, 0, 0, '1', 'tEPwFw6oVGyPuRwu2RLOFatMlx14S1FP3QrljZYk', '2020-08-11 02:41:46', '2020-08-11 02:41:46'),
(4, 'test', 0, '56465456465', '1', NULL, 'Test', 'test@test.com', 14, 0, 0, '1', 'g1zrGDa1pjDLr6L0opAO4xWF71MCdujjymsgWkuw', '2020-08-11 02:43:15', '2020-08-11 02:43:15'),
(5, 'Viswa', 0, '56465456465', '1', '1996-05-28', '+919444100057', 'bharathi@belmonttek.com', 100, 0, 0, '1', 'RMa7SQAmnESP2pDvE9l5cU7zV4BfYmcYVWTIjdBj', '2020-08-11 02:58:39', '2020-08-11 02:58:39'),
(6, 'Althaf Basha', 0, 'Z3803257', '1', '1986-05-28', '60122033786', 'althaf@belmonttek.com', 132, 0, 0, '1', 'eZpj9j5u8VWmcdCaTtqKVguDP2szpp5T6JSiRcNy', '2020-08-11 03:43:37', '2020-08-11 03:43:37'),
(7, 'Russell', 0, '123585625565', '1', '2001-06-28', '60173048973', 'russell@powpocket.me', 132, 0, 0, '1', 'iySEHRp3wBpXgpRnI32xkO4EuHpgum6w8iFS8xSU', '2020-08-11 04:01:09', '2020-08-11 04:01:09'),
(8, 'Kuhan', 0, '564654585825', '1', '2009-06-22', '60122116007', 'kuhan@arunamari.com', 132, 0, 0, '1', 'H8GXRHXGTbv90ZhIMy0WVGwNixLiE81G2YEfYGkz', '2020-08-11 04:14:45', '2020-08-11 04:14:45'),
(9, 'Selvam', 1, '56465456465', '1', NULL, '123423423423', 'test@test.com', 13, 0, 0, '1', '9230ZNQHUMyezzMJLYrqSEoYbjubnqfm7VwtgBJY', '2020-08-12 05:49:31', '2020-08-12 05:49:31'),
(10, 'test', 1, '56465456465', '1', NULL, '919944909167', 'v.veerabharathi@gmail.com', 100, 0, 0, '1', '2Cn0QDBiJIptDj7drm8AgbETr0d0sKZV9yFgJGW6', '2020-08-12 05:54:28', '2020-08-12 05:54:28'),
(11, 'test', 1, '56465456465', '1', NULL, '919944909167', 'test@test.com', 15, 0, 0, '1', 'oj6tNYFDOFzLVXAyXA5Xg2FQ97GiE4QCdk635IFn', '2020-08-12 05:56:40', '2020-08-12 05:56:40'),
(12, 'test', 1, '545456464566', '1', NULL, '919944909167', 'test@test.com', 13, 0, 0, '1', 'PEXIjWzqPSD2At2XqqdYJgly752n8QLIVJr5qIZM', '2020-08-12 06:04:41', '2020-08-12 06:04:41'),
(13, 'Kuhan', 1, '5646545654654', '1', '2001-07-28', '609632587412', 'kuhan@arunamari.com', 132, 0, 0, '1', '4NZsQTWg2IfIWV98WpBQ1Qweef1aW3HRpOS5pBNF', '2020-08-12 10:22:17', '2020-08-12 10:22:17'),
(14, 'Vinothkumar', 1, '234234-23-4234', '1', '2020-06-30', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'pCiOLyrOwkA1diWeXIBaETPGBphAQLPvYeDdXQAq', '2020-08-13 12:56:45', '2020-08-13 12:56:45'),
(15, 'Raj Kuamr', 1, '234234-23-4234', '1', '2020-07-27', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'pZj7Dcri0Kj6KewiOyxtiU9H1rblIHYlZ8QyzRWu', '2020-08-13 14:38:24', '2020-08-13 14:38:24'),
(16, 'Raj', 2, '23243423423', '1', '2020-07-27', '919944909617', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'wG4s4SV9WWnAnc8IbU2attvK3U3CLDKKYJ6hj861', '2020-08-13 15:29:02', '2020-08-13 15:29:02'),
(17, 'Raj', 1, '234234-23-4234', '1', '2020-07-27', '9123423423423', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', '9YGT8aYnYQ2hNrM897SCVxV0PL5aOibCFgdcJt9r', '2020-08-13 15:41:57', '2020-08-13 15:41:57'),
(18, 'Raj', 1, '323423-42-3423', '1', '2020-07-27', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', '9I3IzjMTOSVP11AtGK703uveYfK8yqlkFIMkNoQN', '2020-08-13 15:45:16', '2020-08-13 15:45:16'),
(19, 'Rahj', 2, '423423423423', '1', '2020-07-27', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'pGm2XhnczGvQfYKiy8zXPEJgJLbkkJIznNgClgFX', '2020-08-13 15:46:55', '2020-08-13 15:46:55'),
(20, 'veera', 1, '234234-23-4323', '1', '2020-07-29', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'VpAU61UZZWk6irfdH9oBNpawj4g0rp5V3PvOfZj8', '2020-08-13 16:25:53', '2020-08-13 16:25:53'),
(21, 'Kuhan', 1, '223423-42-3423', '1', '2020-08-08', '60122116007', 'kuhan@arunamari.com', 132, 0, 0, '1', 'KtQpg9FyWE11eDaPATmDIPVkiK26nb0rgch9tEVN', '2020-08-13 16:44:38', '2020-08-13 16:44:38'),
(22, 'Kuhan', 1, '234234-23-4234', '1', '2020-07-27', '60123456789', 'kuhan@arunamari.com', 132, 0, 0, '1', 'hvw7r8w0o5ANE3eTwpRW8hjldCzOzkbIf2Coc6FV', '2020-08-13 16:47:10', '2020-08-13 16:47:10'),
(23, 'Kuhan', 1, '232434-23-4234', '1', '2020-07-27', '60123456789', 'kuhan@arunamari.com', 100, 0, 0, '1', 'IwZelYsqxw5YRHIzbp4ldvuyrUT3W5LEF4ILgHRr', '2020-08-13 16:49:11', '2020-08-13 16:49:11'),
(24, 'Raj', 1, '234234-23-4234', '1', '2002-07-29', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'dr7alNa2EZtNNGNTIairR9KEfzrMNEAKPoiypNSz', '2020-08-14 09:07:58', '2020-08-14 09:07:58'),
(25, 'Veerabharathi', 1, '234234-23-4234', '1', '2002-07-29', '919944909167', 'veerabharathi2020@gmail.com', 132, 0, 0, '1', 'ogaPNvqhdeTyzUXq4wHp6bsKCCdImXgpmLpRVY9y', '2020-08-14 09:12:31', '2020-08-14 09:12:31'),
(26, 'Raj', 2, '232342323', '1', '2002-07-29', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'ZqMq6MmOXnmQ2gvbr7MmVKBLWD00gi1uN7PwoOF8', '2020-08-14 09:16:26', '2020-08-14 09:16:26'),
(27, 'Veerabharathi', 1, '234234-23-4234', '1', '2002-07-29', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', '2jk1UqZixBQUVLMQrRgwIhcPke2eety3mOcE8lTF', '2020-08-14 09:17:51', '2020-08-14 09:17:51'),
(28, 'Veerabharathi', 2, '56465456465', '1', '2002-08-01', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 's9GTy816qW4cvoLNms5pw8n1tmdfc2qr3LFlyeeO', '2020-08-14 09:18:57', '2020-08-14 09:18:57'),
(29, 'Raj', 1, '234234-23-4234', '1', '2002-07-29', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'DlinLUvQXoLM0YTOBO1kF907TVL9HhKGBxqRLbLx', '2020-08-14 09:21:27', '2020-08-14 09:21:27'),
(30, 'Raj', 1, '234234-23-4234', '1', '2002-07-29', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'ag9y6DmC0IQCxx5EvrGdExmy30amjxdtfbAxilVu', '2020-08-14 09:27:45', '2020-08-14 09:27:45'),
(31, 'Rajkumar', 1, '234234-23-4234', '1', '2002-07-29', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'OznME6Bbo234JvpN8DZr38mGpCcr87Fb8u8zoxFJ', '2020-08-14 09:58:37', '2020-08-14 09:58:37'),
(32, 'Rajkumar', 1, '234234-23-4234', '1', '2002-07-29', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'yIQYX34L7jLi1LAX0imR7gHSnVrRDYLQHHtI314a', '2020-08-14 10:00:02', '2020-08-14 10:00:02'),
(33, 'Selvam', 2, '234234234234324', '1', '2002-07-31', '919944909167', 'veerabharathi2020@gmail.com', 132, 0, 0, '1', 'Si1LmUvE27Hxcjowl8U5YglGYCY04awHyG6Vqu4j', '2020-08-14 10:05:59', '2020-08-14 10:05:59'),
(34, 'vikram', 1, '754684-65-6465', '1', '1999-10-28', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', '5eeDekgsxFwqaxHHoJYN3XCku3rA7Uozpp0Gf158', '2020-08-14 10:32:58', '2020-08-14 10:32:58'),
(35, 'Kumar', 1, '564654-46-4654', '1', '2001-11-30', '919944909167', 'veerabharathi2020@gmail.com', 132, 0, 0, '1', 'eAHaAgSa0FvO5JRrq9RfMTfm6btvhzlC0EXyekFi', '2020-08-14 10:37:54', '2020-08-14 10:37:54'),
(36, 'Selvakani', 1, '546546-46-5464', '1', '2002-07-29', '919944909167', 'veerabharathi2020@gmail.com', 132, 0, 0, '1', 'lcynudNKnfVZHS1KbIgHd9lxaUuenmyou5meJVCf', '2020-08-14 10:40:52', '2020-08-14 10:40:52'),
(37, 'Arun', 1, '546546-46-5564', '1', '2001-11-28', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', '1n087O0A31y4RxnaYgtHLDGLgJMbvbqzIugwywWI', '2020-08-14 10:42:39', '2020-08-14 10:42:39'),
(38, 'Vikramathithan', 2, '897979879789', '1', '2002-07-31', '9115464654656', 'veerabharathi2020@gmail.com', 132, 0, 0, '1', 'NoTBqTE80ZGvdoknEoLBS1ijI2Ur8K23tx1PMhjL', '2020-08-14 10:44:18', '2020-08-14 10:44:18'),
(39, 'vinoth', 2, '546546546546', '1', '2002-08-01', '919944909167', 'veerabharathi2020@gmail.com', 132, 0, 0, '1', 'cN7qKNRydC2xyKcA56QeBo9svftv9lqTl8QrRcw5', '2020-08-14 10:46:11', '2020-08-14 10:46:11'),
(40, 'Vinoth', 1, '234234-23-4234', '1', '2002-07-31', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'zNuUei6qzc5uiQHTlkqKSdIaBxixWGYMHulSPrm8', '2020-08-14 10:49:31', '2020-08-14 10:49:31'),
(41, 'Vikramathithya', 1, '645465-44-6564', '1', '2002-07-30', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'R5QOeoS8ufja2uXMzZkwrDD8l8HQurKa1psaHUzs', '2020-08-14 10:51:34', '2020-08-14 10:51:34'),
(42, 'Vinoth', 1, '546546-46-5546', '1', '2002-07-30', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'tzFsNvZxNkoXifWjpGnSKZDejDJbxQabHClOENk4', '2020-08-14 10:56:50', '2020-08-14 10:56:50'),
(43, 'Vinoth', 1, '234234-23-4234', '1', '2002-07-30', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'OCA6y8jhWBOEykIbp1uwSCReEPZbBbTGF2mifUfH', '2020-08-14 10:58:16', '2020-08-14 10:58:16'),
(44, 'Vinoth', 1, '234234-23-4234', '1', '2002-07-30', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'TdfKF1Op2djl4nYgfNB4z6uGLKXJi8rkMzSFbdGN', '2020-08-14 11:02:53', '2020-08-14 11:02:53'),
(45, 'Althaf', 2, 'ASDF3234343', '1', '2002-07-29', '6581234567', 'althaf@belmonttek.com', 198, 0, 0, '1', '5nUGRFjWF2a7eboL1NVCPxxYP3dxfQ2HnePbzJjp', '2020-08-14 14:41:33', '2020-08-14 14:41:33'),
(46, 'Raj', 1, '654655-45-4654', '1', '2002-07-30', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'MCztMi6lcI7rJXpTbROIs6nu2DD4MdLVOsX2AzS6', '2020-08-15 02:32:39', '2020-08-15 02:32:39'),
(47, 'Jaikumar', 1, '897987-97-9879', '1', '2002-07-29', '919944909167', 'veerabharathi2020@gmail.com', 100, 0, 0, '1', 'I8r3Iqy5BvfGReEgYJyyYQh9Y7rISfTVlEQqrznf', '2020-08-15 02:41:15', '2020-08-15 02:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `patients_booking`
--

CREATE TABLE `patients_booking` (
  `ID` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `center` int(10) NOT NULL,
  `booking_type` tinyint(1) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` varchar(255) NOT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `test_result` tinyint(1) DEFAULT NULL,
  `comments` text,
  `sessionid` varchar(255) NOT NULL,
  `commute_by` tinyint(1) DEFAULT NULL,
  `traveller_type` varchar(255) DEFAULT NULL,
  `lane_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients_booking`
--

INSERT INTO `patients_booking` (`ID`, `patient`, `center`, `booking_type`, `booking_date`, `booking_time`, `payment_mode`, `paid`, `test_result`, `comments`, `sessionid`, `commute_by`, `traveller_type`, `lane_type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2020-08-12', '2020-08-12 09:00', '', 1, 2, NULL, 'Ntyy3OUAw45gFMtlc5CwNuzXYbregtKnIqnpe13O', NULL, '', '', '2020-08-11 02:26:16', '2020-08-11 02:26:16'),
(2, 2, 1, 1, '2020-08-12', '2020-08-12 11:00', '', 1, 2, NULL, 'w3UYTN7sFLuHZv7tSsvdX9qKpoiqXwWKV1gyupQy', NULL, '', '', '2020-08-11 02:34:15', '2020-08-11 02:34:15'),
(3, 3, 1, 1, '2020-08-13', '2020-08-13 08:52', '', 1, 1, NULL, 'tEPwFw6oVGyPuRwu2RLOFatMlx14S1FP3QrljZYk', NULL, '', '', '2020-08-11 02:41:46', '2020-08-11 02:41:46'),
(4, 4, 1, 1, '2020-08-13', '2020-08-13 07:40', '', NULL, NULL, NULL, 'g1zrGDa1pjDLr6L0opAO4xWF71MCdujjymsgWkuw', NULL, '', '', '2020-08-11 02:43:15', '2020-08-11 02:43:15'),
(5, 5, 4, 2, '2020-08-12', '2020-08-12 08:00', '', 1, NULL, NULL, 'RMa7SQAmnESP2pDvE9l5cU7zV4BfYmcYVWTIjdBj', 1, '', '', '2020-08-11 02:58:39', '2020-08-11 02:58:39'),
(6, 6, 2, 1, '2020-08-12', '2020-08-12 08:16', '', 1, 2, NULL, 'eZpj9j5u8VWmcdCaTtqKVguDP2szpp5T6JSiRcNy', NULL, '', '', '2020-08-11 03:43:37', '2020-08-11 03:43:37'),
(7, 7, 1, 1, '2020-08-12', '2020-08-12 09:12', '', 1, 2, NULL, 'iySEHRp3wBpXgpRnI32xkO4EuHpgum6w8iFS8xSU', NULL, '', '', '2020-08-11 04:01:09', '2020-08-11 04:01:09'),
(8, 8, 4, 2, '2020-08-13', '2020-08-13 11:00', '', 1, 1, NULL, 'H8GXRHXGTbv90ZhIMy0WVGwNixLiE81G2YEfYGkz', 1, '', '', '2020-08-11 04:14:45', '2020-08-11 04:14:45'),
(9, 9, 2, 1, '2020-08-13', '2020-08-13 08:16', '', NULL, NULL, NULL, '9230ZNQHUMyezzMJLYrqSEoYbjubnqfm7VwtgBJY', NULL, '', '', '2020-08-12 05:49:31', '2020-08-12 05:49:31'),
(10, 10, 5, 2, '2020-08-13', '2020-08-13 07:30', '', NULL, 1, NULL, '2Cn0QDBiJIptDj7drm8AgbETr0d0sKZV9yFgJGW6', 2, '', '', '2020-08-12 05:54:28', '2020-08-12 05:54:28'),
(11, 11, 2, 1, '2020-08-13', '2020-08-13 08:12', '', NULL, NULL, NULL, 'oj6tNYFDOFzLVXAyXA5Xg2FQ97GiE4QCdk635IFn', NULL, '', '', '2020-08-12 05:56:40', '2020-08-12 05:56:40'),
(12, 12, 2, 1, '2020-08-13', '2020-08-13 08:48', '', NULL, NULL, NULL, 'PEXIjWzqPSD2At2XqqdYJgly752n8QLIVJr5qIZM', NULL, '', '', '2020-08-12 06:04:41', '2020-08-12 06:04:41'),
(13, 13, 1, 1, '2020-08-13', '2020-08-13 08:04', '', 1, 1, NULL, '4NZsQTWg2IfIWV98WpBQ1Qweef1aW3HRpOS5pBNF', NULL, '', '', '2020-08-12 10:22:17', '2020-08-12 10:22:17'),
(14, 14, 6, 1, '2020-08-14', '2020-08-14 09:04', '', 1, 2, NULL, 'pCiOLyrOwkA1diWeXIBaETPGBphAQLPvYeDdXQAq', NULL, '', '', '2020-08-13 12:56:45', '2020-08-13 12:56:45'),
(15, 15, 2, 1, '2020-08-14', '2020-08-14 08:04', '', 1, 3, NULL, 'pZj7Dcri0Kj6KewiOyxtiU9H1rblIHYlZ8QyzRWu', NULL, '', '', '2020-08-13 14:38:24', '2020-08-13 14:38:24'),
(16, 16, 10, 1, '2020-08-14', '2020-08-14 11:16', '', 1, NULL, NULL, 'wG4s4SV9WWnAnc8IbU2attvK3U3CLDKKYJ6hj861', NULL, '', '', '2020-08-13 15:29:02', '2020-08-13 15:29:02'),
(17, 17, 7, 1, '2020-08-14', '2020-08-14 11:40', '', NULL, NULL, NULL, '9YGT8aYnYQ2hNrM897SCVxV0PL5aOibCFgdcJt9r', NULL, '', '', '2020-08-13 15:41:57', '2020-08-13 15:41:57'),
(18, 18, 3, 1, '2020-08-17', '2020-08-17 08:56', '', NULL, NULL, NULL, '9I3IzjMTOSVP11AtGK703uveYfK8yqlkFIMkNoQN', NULL, '', '', '2020-08-13 15:45:16', '2020-08-13 15:45:16'),
(19, 19, 5, 2, '2020-08-14', '2020-08-14 07:30', '', 1, NULL, NULL, 'pGm2XhnczGvQfYKiy8zXPEJgJLbkkJIznNgClgFX', 2, '', '', '2020-08-13 15:46:55', '2020-08-13 15:46:55'),
(20, 20, 10, 1, '2020-08-14', '2020-08-14 10:12', '', 1, 2, NULL, 'VpAU61UZZWk6irfdH9oBNpawj4g0rp5V3PvOfZj8', NULL, '', '', '2020-08-13 16:25:53', '2020-08-13 16:25:53'),
(21, 21, 11, 1, '2020-08-14', '2020-08-14 09:16', '', NULL, NULL, NULL, 'KtQpg9FyWE11eDaPATmDIPVkiK26nb0rgch9tEVN', NULL, '', '', '2020-08-13 16:44:38', '2020-08-13 16:44:38'),
(22, 22, 11, 1, '2020-08-14', '2020-08-14 09:20', '', NULL, NULL, NULL, 'hvw7r8w0o5ANE3eTwpRW8hjldCzOzkbIf2Coc6FV', NULL, '', '', '2020-08-13 16:47:10', '2020-08-13 16:47:10'),
(23, 23, 11, 1, '2020-08-14', '2020-08-14 08:16', '', 1, 2, NULL, 'IwZelYsqxw5YRHIzbp4ldvuyrUT3W5LEF4ILgHRr', NULL, '', '', '2020-08-13 16:49:11', '2020-08-13 16:49:11'),
(24, 24, 4, 2, '1970-01-01', '1970-01-01 00:00', '', 1, 3, NULL, 'dr7alNa2EZtNNGNTIairR9KEfzrMNEAKPoiypNSz', NULL, 'RGL', 'Motorcycle Lane', '2020-08-14 09:07:58', '2020-08-14 09:07:58'),
(25, 25, 5, 2, '1970-01-01', '1970-01-01 00:00', '', NULL, 2, NULL, 'ogaPNvqhdeTyzUXq4wHp6bsKCCdImXgpmLpRVY9y', NULL, 'PCA', 'Motorcycle Lane', '2020-08-14 09:12:31', '2020-08-14 09:12:31'),
(26, 26, 5, 2, '1970-01-01', '1970-01-01 00:00', '', NULL, NULL, NULL, 'ZqMq6MmOXnmQ2gvbr7MmVKBLWD00gi1uN7PwoOF8', NULL, 'RGL', 'Car Lane', '2020-08-14 09:16:26', '2020-08-14 09:16:26'),
(27, 27, 4, 2, '1970-01-01', '1970-01-01 00:00', '', NULL, NULL, NULL, '2jk1UqZixBQUVLMQrRgwIhcPke2eety3mOcE8lTF', NULL, 'RGL', 'Motorcycle Lane', '2020-08-14 09:17:51', '2020-08-14 09:17:51'),
(28, 28, 7, 1, '2020-08-15', '2020-08-15 09:16', '', NULL, NULL, NULL, 's9GTy816qW4cvoLNms5pw8n1tmdfc2qr3LFlyeeO', NULL, NULL, NULL, '2020-08-14 09:18:57', '2020-08-14 09:18:57'),
(29, 29, 4, 2, '1970-01-01', '1970-01-01 00:00', '', NULL, NULL, NULL, 'DlinLUvQXoLM0YTOBO1kF907TVL9HhKGBxqRLbLx', NULL, 'RGL', 'Motorcycle Lane', '2020-08-14 09:21:27', '2020-08-14 09:21:27'),
(30, 30, 4, 2, '1970-01-01', '1970-01-01 00:00', '', NULL, NULL, NULL, 'ag9y6DmC0IQCxx5EvrGdExmy30amjxdtfbAxilVu', NULL, 'RGL', 'Motorcycle Lane', '2020-08-14 09:27:45', '2020-08-14 09:27:45'),
(31, 31, 5, 2, '1970-01-01', '1970-01-01 00:00', '', NULL, NULL, NULL, 'OznME6Bbo234JvpN8DZr38mGpCcr87Fb8u8zoxFJ', NULL, 'RGL', 'Motorcycle Lane', '2020-08-14 09:58:37', '2020-08-14 09:58:37'),
(32, 32, 5, 2, '1970-01-01', '1970-01-01 00:00', '', 1, 1, NULL, 'yIQYX34L7jLi1LAX0imR7gHSnVrRDYLQHHtI314a', NULL, 'RGL', 'Motorcycle Lane', '2020-08-14 10:00:02', '2020-08-14 10:00:02'),
(33, 33, 5, 2, '1970-01-01', '1970-01-01 00:00', '', NULL, 2, NULL, 'Si1LmUvE27Hxcjowl8U5YglGYCY04awHyG6Vqu4j', NULL, 'PCA', 'Motorcycle Lane', '2020-08-14 10:05:59', '2020-08-14 10:05:59'),
(34, 34, 4, 2, '1970-01-01', '1970-01-01 00:00', 'offline', NULL, 1, NULL, '5eeDekgsxFwqaxHHoJYN3XCku3rA7Uozpp0Gf158', NULL, 'RGL', 'Motorcycle Lane', '2020-08-14 10:32:58', '2020-08-14 10:32:58'),
(35, 35, 4, 2, '1970-01-01', '1970-01-01 00:00', NULL, NULL, NULL, NULL, 'eAHaAgSa0FvO5JRrq9RfMTfm6btvhzlC0EXyekFi', NULL, 'PCA', 'Car Lane', '2020-08-14 10:37:54', '2020-08-14 10:37:54'),
(36, 36, 4, 2, '1970-01-01', '1970-01-01 00:00', NULL, NULL, NULL, NULL, 'lcynudNKnfVZHS1KbIgHd9lxaUuenmyou5meJVCf', NULL, 'PCA', 'Motorcycle Lane', '2020-08-14 10:40:53', '2020-08-14 10:40:53'),
(37, 37, 10, 1, '2020-08-15', '2020-08-15 10:16', 'online', 1, NULL, NULL, '1n087O0A31y4RxnaYgtHLDGLgJMbvbqzIugwywWI', NULL, NULL, NULL, '2020-08-14 10:42:39', '2020-08-14 10:42:39'),
(38, 38, 4, 2, '1970-01-01', '1970-01-01 00:00', NULL, NULL, 2, NULL, 'NoTBqTE80ZGvdoknEoLBS1ijI2Ur8K23tx1PMhjL', NULL, 'PCA', 'Motorcycle Lane', '2020-08-14 10:44:18', '2020-08-14 10:44:18'),
(39, 39, 4, 2, '1970-01-01', '1970-01-01 00:00', 'online', 1, 1, NULL, 'cN7qKNRydC2xyKcA56QeBo9svftv9lqTl8QrRcw5', NULL, 'PCA', 'Motorcycle Lane', '2020-08-14 10:46:11', '2020-08-14 10:46:11'),
(40, 40, 10, 1, '2020-08-15', '2020-08-15 09:16', NULL, NULL, NULL, NULL, 'zNuUei6qzc5uiQHTlkqKSdIaBxixWGYMHulSPrm8', NULL, NULL, NULL, '2020-08-14 10:49:31', '2020-08-14 10:49:31'),
(41, 41, 10, 1, '2020-08-15', '2020-08-15 09:52', 'online', 1, 1, NULL, 'R5QOeoS8ufja2uXMzZkwrDD8l8HQurKa1psaHUzs', NULL, NULL, NULL, '2020-08-14 10:51:34', '2020-08-14 10:51:34'),
(42, 42, 11, 1, '2020-08-15', '2020-08-15 09:12', NULL, NULL, NULL, NULL, 'tzFsNvZxNkoXifWjpGnSKZDejDJbxQabHClOENk4', NULL, NULL, NULL, '2020-08-14 10:56:50', '2020-08-14 10:56:50'),
(43, 43, 11, 1, '2020-08-15', '2020-08-15 09:04', NULL, NULL, NULL, NULL, 'OCA6y8jhWBOEykIbp1uwSCReEPZbBbTGF2mifUfH', NULL, NULL, NULL, '2020-08-14 10:58:16', '2020-08-14 10:58:16'),
(44, 44, 11, 1, '2020-08-15', '2020-08-15 09:08', 'online', 1, NULL, NULL, 'TdfKF1Op2djl4nYgfNB4z6uGLKXJi8rkMzSFbdGN', NULL, NULL, NULL, '2020-08-14 11:02:53', '2020-08-14 11:02:53'),
(45, 45, 5, 2, '1970-01-01', '1970-01-01 00:00', 'offline', NULL, 2, NULL, '5nUGRFjWF2a7eboL1NVCPxxYP3dxfQ2HnePbzJjp', NULL, 'RGL', 'Car Lane', '2020-08-14 14:41:33', '2020-08-14 14:41:33'),
(46, 46, 5, 2, '1970-01-01', '1970-01-01 00:00', NULL, NULL, NULL, NULL, 'MCztMi6lcI7rJXpTbROIs6nu2DD4MdLVOsX2AzS6', NULL, 'RGL', 'Car Lane', '2020-08-15 02:32:39', '2020-08-15 02:32:39'),
(47, 47, 5, 2, '1970-01-01', '1970-01-01 00:00', 'online', 1, 1, NULL, 'I8r3Iqy5BvfGReEgYJyyYQh9Y7rISfTVlEQqrznf', NULL, 'RGL', 'Motorcycle Lane', '2020-08-15 02:41:15', '2020-08-15 02:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `ID` int(10) NOT NULL,
  `patient` int(10) NOT NULL,
  `booking` int(10) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `bill_id` int(10) NOT NULL,
  `bill_no` varchar(10) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `ref_id` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`ID`, `patient`, `booking`, `amount`, `bill_id`, `bill_no`, `currency`, `paid`, `payment_method`, `ref_id`, `status`, `signature`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '130.00', 5029, 'UGW6KVHG', 'MYR', 1, 'Credit/Debit Card', 'CD__UGW6KVHG__20200811102924', 4, '7e9b46e966d24bd9375656f497cce9315923cd3f60ba03a02d8d6aa887b5fc9e', '2020-08-11 02:29:36', '2020-08-11 02:29:36'),
(2, 2, 2, '250.00', 5030, 'K77W571H', 'MYR', 1, 'Credit/Debit Card', 'CD__K77W571H__20200811103531', 4, '96512bb7c9fd0df22c7c78738ec1977f35f242c4e3cbd7139e3102c0da5531bc', '2020-08-11 02:35:44', '2020-08-11 02:35:44'),
(3, 3, 3, '250.00', 5031, 'Y0TKVH1Z', 'MYR', 1, 'Credit/Debit Card', 'CD__Y0TKVH1Z__20200811104207', 4, 'be194ccca49c560ecba8cd940798c6de85a0851820f44617d9e01df662928184', '2020-08-11 02:42:21', '2020-08-11 02:42:21'),
(4, 5, 5, '130.00', 5032, '2YI1PA09', 'MYR', 1, 'Credit/Debit Card', 'CD__2YI1PA09__20200811105912', 4, 'fdfbcd85cfc9828bac0e5814135cb8d043f888f23e44234fb7939d919d907713', '2020-08-11 02:59:24', '2020-08-11 02:59:24'),
(5, 6, 6, '200.00', 5033, 'JUUPUWIG', 'MYR', 1, 'Credit/Debit Card', 'CD__JUUPUWIG__20200811114423', 4, 'af4a62d32170c214f157ad73a13e1f7c6be0b63d086235e1ba2af8e414022f35', '2020-08-11 03:44:38', '2020-08-11 03:44:38'),
(6, 7, 7, '200.00', 5034, 'FG8WFP7Y', 'MYR', 1, 'Credit/Debit Card', 'CD__FG8WFP7Y__20200811120206', 4, '155db15249f4cdc58a7d2f4e82662b15361f135c37729af4f7f90bd033aef045', '2020-08-11 04:02:18', '2020-08-11 04:02:18'),
(7, 8, 8, '130.00', 5035, '39EGPCZ6', 'MYR', 1, 'Credit/Debit Card', 'CD__39EGPCZ6__20200811121511', 4, '8d2f79cb0257eeeb58d9f4b0073256fc0e52bdb727a80a18d660c91c13cd581c', '2020-08-11 04:15:25', '2020-08-11 04:15:25'),
(8, 13, 13, '200.00', 5072, 'Q57J3EVJ', 'MYR', 1, 'Credit/Debit Card', 'CD__Q57J3EVJ__20200812182348', 4, 'ca1e036a1a3ecc48ed6f1dc6847579c5333b01ab56749f109c461d570ca6ac95', '2020-08-12 10:24:06', '2020-08-12 10:24:06'),
(9, 14, 14, '250.00', 5086, 'HU2FH5TD', 'MYR', 1, 'Credit/Debit Card', 'CD__HU2FH5TD__20200813205710', 4, '6ec1a96939a465151f3aa27612f770b5096bb51742f21248d4c14e6124990281', '2020-08-13 12:57:24', '2020-08-13 12:57:24'),
(10, 15, 15, '250.00', 5087, 'G3W4GKB1', 'MYR', 1, 'Credit/Debit Card', 'CD__G3W4GKB1__20200813223846', 4, 'e277d4d8d6ee2c8fc7af1788854077ce8f93ac632b68d47f51a6a6b107be7e4f', '2020-08-13 14:39:04', '2020-08-13 14:39:04'),
(11, 16, 16, '250.00', 5088, 'JAD6FZI2', 'MYR', 1, 'Credit/Debit Card', 'CD__JAD6FZI2__20200813232943', 4, 'e5b0f8d35db839ae9db786dde8f1b22c8ab3a174a8feafbef50b35fe184be109', '2020-08-13 15:29:56', '2020-08-13 15:29:56'),
(12, 16, 16, '250.00', 5088, 'JAD6FZI2', 'MYR', 1, 'Credit/Debit Card', 'CD__JAD6FZI2__20200813232943', 4, 'e5b0f8d35db839ae9db786dde8f1b22c8ab3a174a8feafbef50b35fe184be109', '2020-08-13 15:31:02', '2020-08-13 15:31:02'),
(13, 16, 16, '250.00', 5088, 'JAD6FZI2', 'MYR', 1, 'Credit/Debit Card', 'CD__JAD6FZI2__20200813232943', 4, 'e5b0f8d35db839ae9db786dde8f1b22c8ab3a174a8feafbef50b35fe184be109', '2020-08-13 15:32:22', '2020-08-13 15:32:22'),
(14, 16, 16, '250.00', 5088, 'JAD6FZI2', 'MYR', 1, 'Credit/Debit Card', 'CD__JAD6FZI2__20200813232943', 4, 'e5b0f8d35db839ae9db786dde8f1b22c8ab3a174a8feafbef50b35fe184be109', '2020-08-13 15:33:02', '2020-08-13 15:33:02'),
(15, 19, 19, '130.00', 5092, 'LQZI7RBU', 'MYR', 1, 'Credit/Debit Card', 'CD__LQZI7RBU__20200813234720', 4, '55fdab8ac577b2d7bed589a581aaf2e6a627b4777e189257f9e94b3da031ebf5', '2020-08-13 15:47:33', '2020-08-13 15:47:33'),
(16, 19, 19, '130.00', 5092, 'LQZI7RBU', 'MYR', 1, 'Credit/Debit Card', 'CD__LQZI7RBU__20200813234720', 4, '55fdab8ac577b2d7bed589a581aaf2e6a627b4777e189257f9e94b3da031ebf5', '2020-08-13 15:48:36', '2020-08-13 15:48:36'),
(17, 19, 19, '130.00', 5092, 'LQZI7RBU', 'MYR', 1, 'Credit/Debit Card', 'CD__LQZI7RBU__20200813234720', 4, '55fdab8ac577b2d7bed589a581aaf2e6a627b4777e189257f9e94b3da031ebf5', '2020-08-13 15:49:27', '2020-08-13 15:49:27'),
(18, 19, 19, '130.00', 5092, 'LQZI7RBU', 'MYR', 1, 'Credit/Debit Card', 'CD__LQZI7RBU__20200813234720', 4, '55fdab8ac577b2d7bed589a581aaf2e6a627b4777e189257f9e94b3da031ebf5', '2020-08-13 15:52:24', '2020-08-13 15:52:24'),
(19, 19, 19, '130.00', 5092, 'LQZI7RBU', 'MYR', 1, 'Credit/Debit Card', 'CD__LQZI7RBU__20200813234720', 4, '55fdab8ac577b2d7bed589a581aaf2e6a627b4777e189257f9e94b3da031ebf5', '2020-08-13 15:53:55', '2020-08-13 15:53:55'),
(20, 19, 19, '130.00', 5092, 'LQZI7RBU', 'MYR', 1, 'Credit/Debit Card', 'CD__LQZI7RBU__20200813234720', 4, '55fdab8ac577b2d7bed589a581aaf2e6a627b4777e189257f9e94b3da031ebf5', '2020-08-13 15:55:32', '2020-08-13 15:55:32'),
(21, 20, 20, '250.00', 5093, 'I7FE53QJ', 'MYR', 1, 'Credit/Debit Card', 'CD__I7FE53QJ__20200814002629', 4, '9667e96b74e6e842161b165ebd1e137fe666128bf55bac9515c941a5ffd9fcc7', '2020-08-13 16:27:04', '2020-08-13 16:27:04'),
(22, 23, 23, '250.00', 5096, 'ESGATZFH', 'MYR', 1, 'Credit/Debit Card', 'CD__ESGATZFH__20200814004931', 4, '3fb5213f43b2d6d62e6c4c655632f50942525206a98757850f215bf2b3e642a6', '2020-08-13 16:49:44', '2020-08-13 16:49:44'),
(23, 24, 24, '130.00', 5117, 'BAW57IPO', 'MYR', 1, 'Credit/Debit Card', 'CD__BAW57IPO__20200814170834', 4, '983b7bfbabb91bbce59ef0777fcfcf41b0ed29db34238c19641a02c9803e33d9', '2020-08-14 09:08:49', '2020-08-14 09:08:49'),
(24, 32, 32, '130.00', 5121, '6GHXB4T0', 'MYR', 1, 'Credit/Debit Card', 'CD__6GHXB4T0__20200814180023', 4, '802d6e09823c9fc2765e454f50cfc39708d45e0522906b934a555700dc71fea8', '2020-08-14 10:00:37', '2020-08-14 10:00:37'),
(25, 37, 37, '250.00', 5124, 'DP7FJ1L4', 'MYR', 1, 'Credit/Debit Card', 'CD__DP7FJ1L4__20200814184305', 4, '942ab86f5abfe035430e9e3061c1bdfe071e40a0c16a93ac2802e5f28555352a', '2020-08-14 10:43:18', '2020-08-14 10:43:18'),
(26, 39, 39, '200.00', 5126, 'UA4XRH31', 'MYR', 1, 'Credit/Debit Card', 'CD__UA4XRH31__20200814184632', 4, '9c790d0998d265543da964bdf10b7f859427fea7ab4e7944b1d22cedd1521fcf', '2020-08-14 10:46:44', '2020-08-14 10:46:44'),
(27, 41, 41, '250.00', 5128, 'QC17MXZ1', 'MYR', 1, 'Credit/Debit Card', 'CD__QC17MXZ1__20200814185157', 4, '8096d8d94087352fedf7a3d10f97c740600868fe66e51d7188788a5f8f45f486', '2020-08-14 10:52:09', '2020-08-14 10:52:09'),
(28, 44, 44, '2.00', 382641, 'OQQMRFXY', 'MYR', 1, 'Credit/Debit Card', 'CD__OQQMRFXY__20200814190750', 4, 'cb7b6efee74c8ca1bb5263f465c2c9756e9bb236ded11fc9262efeaf38ca8a38', '2020-08-14 11:08:59', '2020-08-14 11:08:59'),
(29, 47, 47, '2.00', 5133, 'BV371JTL', 'MYR', 1, 'Credit/Debit Card', 'CD__BV371JTL__20200815104139', 4, 'f88b8ca1070de965de8398f1c8993cd4cf492c0519d1a9d44f09281446ed213c', '2020-08-15 02:41:54', '2020-08-15 02:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `display` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module`, `section`, `name`, `slug`, `guard_name`, `display`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Create Permission', 'create-permission', 'administrator', 0, 1, '2018-07-17 11:01:15', '2018-07-27 15:22:49'),
(2, 1, 3, 'View Permission', 'view-permission', 'administrator', 1, 1, '2018-07-17 11:02:10', '2018-07-27 15:22:09'),
(3, 1, 3, 'Edit Permission', 'edit-permission', 'administrator', 0, 1, '2018-07-17 11:02:18', '2018-07-27 15:22:58'),
(4, 1, 3, 'Delete Permission', 'delete-permission', 'administrator', 0, 1, '2018-07-17 11:02:24', '2018-07-27 15:23:07'),
(5, 1, 3, 'Detail Permission', 'detail-permission', 'administrator', 0, 1, '2018-07-17 11:03:03', '2018-07-27 15:23:16'),
(6, 1, 2, 'View Role', 'view-role', 'administrator', 1, 1, '2018-07-17 11:03:11', '2018-07-27 15:23:25'),
(7, 1, 2, 'Add Role', 'add-role', 'administrator', 0, 1, '2018-07-17 11:03:20', '2018-07-27 15:23:33'),
(8, 1, 2, 'Edit Role', 'edit-role', 'administrator', 0, 1, '2018-07-17 11:03:24', '2018-07-27 15:23:42'),
(9, 1, 2, 'Delete Role', 'delete-role', 'administrator', 0, 1, '2018-07-17 11:03:30', '2018-07-27 15:23:53'),
(10, 1, 2, 'Detail Role', 'detail-role', 'administrator', 0, 1, '2018-07-17 11:03:37', '2018-07-27 15:24:06'),
(11, 1, 1, 'Add Administrator', 'add-administrator', 'administrator', 0, 1, '2018-07-17 11:03:45', '2018-07-27 15:24:20'),
(12, 1, 1, 'View Administrator', 'view-administrator', 'administrator', 1, 1, '2018-07-17 11:03:54', '2018-07-27 15:24:31'),
(13, 1, 1, 'Edit Administrator', 'edit-administrator', 'administrator', 0, 1, '2018-07-17 11:04:07', '2018-07-27 15:24:41'),
(14, 1, 1, 'Delete Administrator', 'delete-administrator', 'administrator', 0, 1, '2018-07-17 11:04:20', '2018-07-27 15:24:52'),
(15, 1, 1, 'Detail Administrator', 'detail-administrator', 'administrator', 0, 1, '2018-07-17 11:04:32', '2018-07-27 15:25:05'),
(16, 1, 1, 'Super Admin', 'super-admin', 'administrator', 0, 1, '2018-07-17 12:09:08', '2018-07-17 12:09:08'),
(17, 1, 1, 'Administrator Dashboard', 'administrator-dashboard', 'administrator', 0, 1, '2018-07-27 15:26:39', '2018-07-27 15:26:39'),
(20, 1, 2, 'Create Role', 'create-role', 'administrator', 0, 1, '2018-07-28 00:35:23', '2018-07-28 00:35:23'),
(22, 1, 2, 'Update Role', 'update-role', 'administrator', 0, 1, NULL, NULL),
(23, 1, 4, 'View Modules', 'view-modules', 'administrator', 1, 1, '2018-08-07 15:30:39', '2018-08-07 15:30:39'),
(24, 1, 5, 'View Sections', 'view-sections', 'administrator', 1, 1, '2018-08-07 15:31:22', '2018-08-07 15:31:22'),
(298, 3, 6, 'View Category', 'view-category', 'administrator', 0, 1, '2020-04-02 16:18:01', '2020-04-02 16:18:01'),
(299, 3, 6, 'Detail Category', 'detail-category', 'administrator', 0, 1, '2020-04-02 16:18:01', '2020-04-02 16:18:01'),
(300, 3, 6, 'Create Category', 'create-category', 'administrator', 0, 1, '2020-04-02 16:18:01', '2020-04-02 16:18:01'),
(301, 3, 6, 'Store Category', 'store-category', 'administrator', 0, 1, '2020-04-02 16:18:01', '2020-04-02 16:18:01'),
(302, 3, 6, 'Edit Category', 'edit-category', 'administrator', 0, 1, '2020-04-02 16:18:01', '2020-04-02 16:18:01'),
(303, 3, 6, 'Update Category', 'update-category', 'administrator', 0, 1, '2020-04-02 16:18:01', '2020-04-02 16:18:01'),
(304, 3, 6, 'Destroy Category', 'destroy-category', 'administrator', 0, 1, '2020-04-02 16:18:01', '2020-04-02 16:18:01'),
(319, 3, 9, 'View Customfield', 'view-customfield', 'administrator', 1, 1, '2020-04-02 21:48:01', '2020-04-02 21:48:01'),
(320, 3, 9, 'Detail Customfield', 'detail-customfield', 'administrator', 0, 1, '2020-04-02 21:48:01', '2020-04-02 21:48:01'),
(321, 3, 9, 'Create Customfield', 'create-customfield', 'administrator', 0, 1, '2020-04-02 21:48:01', '2020-04-02 21:48:01'),
(322, 3, 9, 'Store Customfield', 'store-customfield', 'administrator', 0, 1, '2020-04-02 21:48:01', '2020-04-02 21:48:01'),
(323, 3, 9, 'Edit Customfield', 'edit-customfield', 'administrator', 0, 1, '2020-04-02 21:48:01', '2020-04-02 21:48:01'),
(324, 3, 9, 'Update Customfield', 'update-customfield', 'administrator', 0, 1, '2020-04-02 21:48:01', '2020-04-02 21:48:01'),
(325, 3, 9, 'Destroy Customfield', 'destroy-customfield', 'administrator', 0, 1, '2020-04-02 21:48:01', '2020-04-02 21:48:01'),
(340, 3, 10, 'View Sectioncustomfield', 'view-sectioncustomfield', 'administrator', 1, 1, '2020-04-05 07:35:32', '2020-04-05 07:35:32'),
(341, 3, 10, 'Detail Sectioncustomfield', 'detail-sectioncustomfield', 'administrator', 0, 1, '2020-04-05 07:35:32', '2020-04-05 07:35:32'),
(342, 3, 10, 'Create Sectioncustomfield', 'create-sectioncustomfield', 'administrator', 0, 1, '2020-04-05 07:35:32', '2020-04-05 07:35:32'),
(343, 3, 10, 'Store Sectioncustomfield', 'store-sectioncustomfield', 'administrator', 0, 1, '2020-04-05 07:35:32', '2020-04-05 07:35:32'),
(344, 3, 10, 'Edit Sectioncustomfield', 'edit-sectioncustomfield', 'administrator', 0, 1, '2020-04-05 07:35:32', '2020-04-05 07:35:32'),
(345, 3, 10, 'Update Sectioncustomfield', 'update-sectioncustomfield', 'administrator', 0, 1, '2020-04-05 07:35:32', '2020-04-05 07:35:32'),
(346, 3, 10, 'Destroy Sectioncustomfield', 'destroy-sectioncustomfield', 'administrator', 0, 1, '2020-04-05 07:35:32', '2020-04-05 07:35:32'),
(487, 12, 54, 'View Patient', 'view-patient', 'administrator', 1, 1, '2020-08-07 07:02:42', '2020-08-07 07:02:42'),
(488, 12, 54, 'Detail Patient', 'detail-patient', 'administrator', 0, 1, '2020-08-07 07:02:42', '2020-08-07 07:02:42'),
(489, 12, 54, 'Create Patient', 'create-patient', 'administrator', 0, 1, '2020-08-07 07:02:42', '2020-08-07 07:02:42'),
(490, 12, 54, 'Store Patient', 'store-patient', 'administrator', 0, 1, '2020-08-07 07:02:42', '2020-08-07 07:02:42'),
(491, 12, 54, 'Edit Patient', 'edit-patient', 'administrator', 0, 1, '2020-08-07 07:02:43', '2020-08-07 07:02:43'),
(492, 12, 54, 'Update Patient', 'update-patient', 'administrator', 0, 1, '2020-08-07 07:02:43', '2020-08-07 07:02:43'),
(493, 12, 54, 'Destroy Patient', 'destroy-patient', 'administrator', 0, 1, '2020-08-07 07:02:43', '2020-08-07 07:02:43'),
(494, 13, 58, 'View Center', 'view-center', 'administrator', 1, 1, '2020-08-07 07:14:19', '2020-08-07 07:14:19'),
(495, 13, 58, 'Detail Center', 'detail-center', 'administrator', 0, 1, '2020-08-07 07:14:19', '2020-08-07 07:14:19'),
(496, 13, 58, 'Create Center', 'create-center', 'administrator', 0, 1, '2020-08-07 07:14:19', '2020-08-07 07:14:19'),
(497, 13, 58, 'Store Center', 'store-center', 'administrator', 0, 1, '2020-08-07 07:14:19', '2020-08-07 07:14:19'),
(498, 13, 58, 'Edit Center', 'edit-center', 'administrator', 0, 1, '2020-08-07 07:14:19', '2020-08-07 07:14:19'),
(499, 13, 58, 'Update Center', 'update-center', 'administrator', 0, 1, '2020-08-07 07:14:19', '2020-08-07 07:14:19'),
(500, 13, 58, 'Destroy Center', 'destroy-center', 'administrator', 0, 1, '2020-08-07 07:14:19', '2020-08-07 07:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'administrator', '2018-07-17 22:19:26', '2018-07-17 22:19:26'),
(2, 'Owner', 'administrator', '2018-07-17 22:20:32', '2018-07-17 22:20:32'),
(3, 'Editor', 'administrator', '2018-07-17 22:20:49', '2018-07-17 22:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(6, 1),
(8, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(16, 1),
(17, 1),
(22, 1),
(23, 1),
(24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `administrators_email_unique` (`email`);

--
-- Indexes for table `administrator_modules`
--
ALTER TABLE `administrator_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `administrator_module_sections`
--
ALTER TABLE `administrator_module_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module` (`module`) USING BTREE;

--
-- Indexes for table `administrator_password_resets`
--
ALTER TABLE `administrator_password_resets`
  ADD KEY `administrator_password_resets_email_index` (`email`),
  ADD KEY `administrator_password_resets_token_index` (`token`);

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `centers_hours_of_operation`
--
ALTER TABLE `centers_hours_of_operation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_category`
--
ALTER TABLE `core_category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_category_custom_fields`
--
ALTER TABLE `core_category_custom_fields`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_category_mapping`
--
ALTER TABLE `core_category_mapping`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `category` (`category`),
  ADD KEY `site_category` (`module`);

--
-- Indexes for table `core_country`
--
ALTER TABLE `core_country`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_custom_fields`
--
ALTER TABLE `core_custom_fields`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `core_custom_field_type`
--
ALTER TABLE `core_custom_field_type`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_custom_field_values`
--
ALTER TABLE `core_custom_field_values`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `field` (`field`);

--
-- Indexes for table `core_days`
--
ALTER TABLE `core_days`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_file_type`
--
ALTER TABLE `core_file_type`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_image_sizes`
--
ALTER TABLE `core_image_sizes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_position`
--
ALTER TABLE `core_position`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_section_category`
--
ALTER TABLE `core_section_category`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `category` (`category`),
  ADD KEY `site_category` (`section`);

--
-- Indexes for table `core_section_custom_field_data`
--
ALTER TABLE `core_section_custom_field_data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_section_files`
--
ALTER TABLE `core_section_files`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_section_images`
--
ALTER TABLE `core_section_images`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_section_meta_detail`
--
ALTER TABLE `core_section_meta_detail`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_section_videos`
--
ALTER TABLE `core_section_videos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core_video_type`
--
ALTER TABLE `core_video_type`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_components`
--
ALTER TABLE `form_components`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `form_section_components`
--
ALTER TABLE `form_section_components`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patients_booking`
--
ALTER TABLE `patients_booking`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `administrator_modules`
--
ALTER TABLE `administrator_modules`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `administrator_module_sections`
--
ALTER TABLE `administrator_module_sections`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `centers_hours_of_operation`
--
ALTER TABLE `centers_hours_of_operation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT for table `core_category`
--
ALTER TABLE `core_category`
  MODIFY `ID` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `core_category_custom_fields`
--
ALTER TABLE `core_category_custom_fields`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `core_category_mapping`
--
ALTER TABLE `core_category_mapping`
  MODIFY `ID` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `core_country`
--
ALTER TABLE `core_country`
  MODIFY `ID` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `core_custom_fields`
--
ALTER TABLE `core_custom_fields`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `core_custom_field_type`
--
ALTER TABLE `core_custom_field_type`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `core_custom_field_values`
--
ALTER TABLE `core_custom_field_values`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `core_days`
--
ALTER TABLE `core_days`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `core_file_type`
--
ALTER TABLE `core_file_type`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `core_image_sizes`
--
ALTER TABLE `core_image_sizes`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `core_position`
--
ALTER TABLE `core_position`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `core_section_category`
--
ALTER TABLE `core_section_category`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `core_section_custom_field_data`
--
ALTER TABLE `core_section_custom_field_data`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `core_section_files`
--
ALTER TABLE `core_section_files`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `core_section_images`
--
ALTER TABLE `core_section_images`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `core_section_meta_detail`
--
ALTER TABLE `core_section_meta_detail`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `core_section_videos`
--
ALTER TABLE `core_section_videos`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `core_video_type`
--
ALTER TABLE `core_video_type`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_components`
--
ALTER TABLE `form_components`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `form_section_components`
--
ALTER TABLE `form_section_components`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `patients_booking`
--
ALTER TABLE `patients_booking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

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
-- Constraints for dumped tables
--

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
