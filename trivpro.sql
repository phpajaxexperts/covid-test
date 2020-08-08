-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2020 at 07:40 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trivpro`
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
(2, 'Classifieds', 'classifieds', NULL, 1, 1, '2020-03-31 22:45:30', '2020-03-31 22:45:30'),
(3, 'Common', 'common', NULL, 0, 1, '2020-04-03 02:43:59', '2020-04-03 02:43:59'),
(15, 'Testing', 'testing', NULL, 1, 1, '2020-04-21 17:33:13', '2020-04-21 17:33:13');

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
(7, 2, 'Adverstisements', 'advertisements', NULL, 1, '2020-04-01 00:42:04', '2020-04-01 00:42:04'),
(9, 3, 'Customfields', '', NULL, 1, '2020-04-03 03:18:01', '2020-04-03 03:18:01'),
(10, 3, 'Sectioncustomfield', '', NULL, 1, '2020-04-05 12:51:40', '2020-04-05 12:51:40'),
(33, 15, 'Test', 'test', NULL, 1, '2020-04-21 17:33:58', '2020-04-21 17:33:58');

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
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `ID` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- Error reading data for table trivpro.ads: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`ads`' at line 1

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
-- Error reading data for table trivpro.core_category: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`core_category`' at line 1

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

--
-- Dumping data for table `core_category_custom_fields`
--

INSERT INTO `core_category_custom_fields` (`ID`, `module`, `category`, `custom_field`, `created_at`, `updated_at`) VALUES
(1, 2, 19, 2, '2020-04-08 12:53:58', '2020-04-08 12:53:58'),
(3, 2, 19, 6, '2020-04-08 12:57:27', '2020-04-08 12:57:27'),
(4, 2, 20, 2, '2020-04-08 13:08:20', '2020-04-08 13:08:20'),
(6, 2, 21, 3, '2020-04-08 13:09:34', '2020-04-08 13:09:34'),
(7, 2, 21, 7, '2020-04-08 13:09:34', '2020-04-08 13:09:34'),
(8, 2, 20, 6, '2020-04-08 20:16:28', '2020-04-08 20:16:28'),
(9, 2, 4, 7, '2020-04-19 16:48:17', '2020-04-19 16:48:17'),
(10, 2, 4, 4, '2020-04-19 16:48:26', '2020-04-19 16:48:26'),
(11, 8, 23, 4, '2020-04-20 17:56:04', '2020-04-20 17:56:04'),
(12, 11, 24, 2, '2020-04-20 19:33:24', '2020-04-20 19:33:24'),
(13, 11, 24, 4, '2020-04-20 19:33:24', '2020-04-20 19:33:24'),
(14, 11, 24, 6, '2020-04-20 19:33:24', '2020-04-20 19:33:24'),
(15, 11, 24, 5, '2020-04-20 19:33:24', '2020-04-20 19:33:24'),
(16, 12, 25, 1, '2020-04-20 19:50:45', '2020-04-20 19:50:45'),
(17, 12, 25, 2, '2020-04-20 19:50:45', '2020-04-20 19:50:45'),
(18, 12, 25, 6, '2020-04-20 19:50:45', '2020-04-20 19:50:45'),
(19, 14, 26, 1, '2020-04-20 19:59:56', '2020-04-20 19:59:56'),
(20, 14, 26, 3, '2020-04-20 19:59:56', '2020-04-20 19:59:56'),
(21, 14, 26, 4, '2020-04-20 19:59:56', '2020-04-20 19:59:56'),
(22, 14, 26, 2, '2020-04-20 19:59:56', '2020-04-20 19:59:56'),
(23, 15, 27, 1, '2020-04-21 12:04:56', '2020-04-21 12:04:56'),
(24, 15, 27, 3, '2020-04-21 12:04:56', '2020-04-21 12:04:56'),
(25, 15, 27, 4, '2020-04-21 12:04:56', '2020-04-21 12:04:56');

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
(1, 1, 0, 2, '2020-04-04 23:17:17', '0000-00-00 00:00:00'),
(3, 3, 1, 2, '2020-04-04 23:17:17', '2020-04-04 04:18:48'),
(4, 4, 1, 2, '2020-04-04 23:17:17', '2020-04-04 04:19:03'),
(5, 5, 1, 2, '2020-04-04 23:17:17', '2020-04-04 04:19:18'),
(6, 6, 1, 2, '2020-04-04 23:17:17', '2020-04-04 04:19:30'),
(7, 7, 1, 2, '2020-04-04 23:17:17', '2020-04-04 04:19:42'),
(8, 8, 0, 2, '2020-04-04 23:17:17', '2020-04-04 04:20:02'),
(9, 9, 8, 2, '2020-04-04 23:17:17', '2020-04-04 04:20:16'),
(10, 10, 8, 2, '2020-04-04 23:17:17', '2020-04-04 04:20:29'),
(11, 11, 8, 2, '2020-04-04 23:17:17', '2020-04-04 04:20:41'),
(12, 12, 8, 2, '2020-04-04 23:17:17', '2020-04-04 04:20:52'),
(13, 13, 0, 2, '2020-04-04 23:17:17', '2020-04-04 04:21:09'),
(14, 14, 13, 2, '2020-04-04 23:17:17', '2020-04-04 04:21:20'),
(15, 15, 13, 2, '2020-04-04 23:17:17', '2020-04-04 04:21:41'),
(16, 16, 13, 2, '2020-04-04 23:17:17', '2020-04-04 04:21:54'),
(17, 17, 13, 2, '2020-04-04 23:17:17', '2020-04-04 04:22:06'),
(18, 18, 13, 2, '2020-04-04 23:17:17', '2020-04-04 04:22:21'),
(19, 48, 0, 2, '2020-04-05 00:37:58', '2020-04-05 00:37:58'),
(20, 50, 0, 2, '2020-04-05 00:50:23', '2020-04-05 00:50:23'),
(21, 51, 0, 2, '2020-04-05 00:53:44', '2020-04-05 00:53:44'),
(22, 52, 51, 2, '2020-04-05 00:53:52', '2020-04-05 00:53:52'),
(23, 53, 52, 2, '2020-04-05 00:54:03', '2020-04-05 00:54:03'),
(24, 54, 53, 2, '2020-04-05 00:54:14', '2020-04-05 00:54:14'),
(25, 19, 0, 2, '2020-04-07 07:11:00', '2020-04-07 07:11:00'),
(26, 20, 0, 2, '2020-04-08 13:05:21', '2020-04-08 13:05:21'),
(27, 21, 20, 2, '2020-04-08 13:09:34', '2020-04-08 13:09:34'),
(28, 22, 21, 2, '2020-04-09 12:58:45', '2020-04-09 12:58:45'),
(29, 23, 0, 8, '2020-04-20 17:56:04', '2020-04-20 17:56:04'),
(30, 24, 0, 11, '2020-04-20 19:33:24', '2020-04-20 19:33:24'),
(31, 25, 0, 12, '2020-04-20 19:50:45', '2020-04-20 19:50:45'),
(32, 26, 0, 14, '2020-04-20 19:59:56', '2020-04-20 19:59:56'),
(33, 27, 0, 15, '2020-04-21 12:04:56', '2020-04-21 12:04:56');

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
-- Error reading data for table trivpro.core_custom_field_values: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`core_custom_field_values`' at line 1

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
-- Error reading data for table trivpro.core_image_sizes: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`core_image_sizes`' at line 1

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
-- Error reading data for table trivpro.core_position: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`core_position`' at line 1

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
(28, 19, 7, 1),
(30, 21, 7, 3),
(31, 22, 7, 4),
(32, 23, 7, 4),
(33, 1, 33, 27);

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
(6, 1, 33, 4, '3');

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
(29, 1, 33, 'tes', 'test', NULL, 'test_2a71ad197c.pdf', 2, 1, '2020-04-21 12:06:54', '2020-04-21 12:06:54');

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
-- Error reading data for table trivpro.core_section_images: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`core_section_images`' at line 1

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
-- Error reading data for table trivpro.core_section_meta_detail: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`core_section_meta_detail`' at line 1

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
-- Error reading data for table trivpro.core_section_videos: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`core_section_videos`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `core_video_type`
--

CREATE TABLE `core_video_type` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Error reading data for table trivpro.core_video_type: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`core_video_type`' at line 1

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
-- Error reading data for table trivpro.failed_jobs: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`failed_jobs`' at line 1

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
-- Error reading data for table trivpro.form_components: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`form_components`' at line 1

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
-- Error reading data for table trivpro.form_section_components: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`form_section_components`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- Error reading data for table trivpro.migrations: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`migrations`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- Error reading data for table trivpro.model_has_permissions: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`model_has_permissions`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- Error reading data for table trivpro.model_has_roles: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`model_has_roles`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- Error reading data for table trivpro.password_resets: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`password_resets`' at line 1

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
-- Error reading data for table trivpro.permissions: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`permissions`' at line 1

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
-- Error reading data for table trivpro.roles: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`roles`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- Error reading data for table trivpro.role_has_permissions: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `trivpro`.`role_has_permissions`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `ID` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`ID`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'test 232343', '1', '2020-04-21 12:06:54', '2020-04-21 12:14:54');

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
-- Indexes for table `ads`
--
ALTER TABLE `ads`
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
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`ID`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `administrator_module_sections`
--
ALTER TABLE `administrator_module_sections`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `core_category`
--
ALTER TABLE `core_category`
  MODIFY `ID` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `core_category_custom_fields`
--
ALTER TABLE `core_category_custom_fields`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `core_category_mapping`
--
ALTER TABLE `core_category_mapping`
  MODIFY `ID` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
-- AUTO_INCREMENT for table `core_file_type`
--
ALTER TABLE `core_file_type`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `core_image_sizes`
--
ALTER TABLE `core_image_sizes`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `core_position`
--
ALTER TABLE `core_position`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `core_section_category`
--
ALTER TABLE `core_section_category`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `core_section_custom_field_data`
--
ALTER TABLE `core_section_custom_field_data`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `core_section_files`
--
ALTER TABLE `core_section_files`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `core_section_images`
--
ALTER TABLE `core_section_images`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `core_section_meta_detail`
--
ALTER TABLE `core_section_meta_detail`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `core_section_videos`
--
ALTER TABLE `core_section_videos`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=494;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
