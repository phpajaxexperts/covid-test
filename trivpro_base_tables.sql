-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2020 at 11:44 PM
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
-- Database: `trivpro2`
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
  `sort` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator_modules`
--

INSERT INTO `administrator_modules` (`id`, `name`, `sort`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `administrator_module_sections`
--

CREATE TABLE `administrator_module_sections` (
  `id` int(10) NOT NULL,
  `module` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator_module_sections`
--

INSERT INTO `administrator_module_sections` (`id`, `module`, `name`, `sort`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Adminstrators', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 'Roles', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 'Permissions', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 'Category', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 1, 'Modules', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, 'Sections', 5, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 12, 'Category', 6, 1, '2019-03-19 22:16:26', '2019-03-19 22:16:26'),
(176, 12, 'Cast and Crew', NULL, 1, '2019-03-19 23:34:07', '2019-03-19 23:34:07'),
(186, 14, 'Videos', NULL, 1, '2019-03-24 06:17:39', '2019-03-24 06:17:39'),
(188, 15, 'News', NULL, 1, '2019-03-24 08:30:48', '2019-03-24 08:30:48'),
(189, 16, 'Casting Call', NULL, 1, '2019-03-24 08:42:36', '2019-03-24 08:42:36'),
(259, 20, 'test', NULL, 1, '2019-04-20 20:57:13', '2019-04-20 20:57:13'),
(260, 20, 'testf', NULL, 1, '2019-04-20 20:57:43', '2019-04-20 20:57:43');

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
(5, '2020_03_30_212536_create_administrator_password_resets_table', 2);

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
(1, 'Modules\\Administrator\\Entities\\Administrator', 6),
(2, 'Modules\\Administrator\\Entities\\Administrator', 3),
(3, 'Modules\\Administrator\\Entities\\Administrator', 5);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `display` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module`, `section`, `name`, `guard_name`, `display`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 'Create Permission', 'administrator', 0, 1, '2018-07-17 11:01:15', '2018-07-27 15:22:49'),
(2, 1, 8, 'View Permission', 'administrator', 1, 1, '2018-07-17 11:02:10', '2018-07-27 15:22:09'),
(3, 1, 8, 'Edit Permission', 'administrator', 0, 1, '2018-07-17 11:02:18', '2018-07-27 15:22:58'),
(4, 1, 8, 'Delete Permission', 'administrator', 0, 1, '2018-07-17 11:02:24', '2018-07-27 15:23:07'),
(5, 1, 8, 'Detail Permission', 'administrator', 0, 1, '2018-07-17 11:03:03', '2018-07-27 15:23:16'),
(6, 1, 7, 'View Role', 'administrator', 1, 1, '2018-07-17 11:03:11', '2018-07-27 15:23:25'),
(7, 1, 7, 'Add Role', 'administrator', 0, 1, '2018-07-17 11:03:20', '2018-07-27 15:23:33'),
(8, 1, 7, 'Edit Role', 'administrator', 0, 1, '2018-07-17 11:03:24', '2018-07-27 15:23:42'),
(9, 1, 7, 'Delete Role', 'administrator', 0, 1, '2018-07-17 11:03:30', '2018-07-27 15:23:53'),
(10, 1, 7, 'Detail Role', 'administrator', 0, 1, '2018-07-17 11:03:37', '2018-07-27 15:24:06'),
(11, 1, 1, 'Add Administrator', 'administrator', 0, 1, '2018-07-17 11:03:45', '2018-07-27 15:24:20'),
(12, 1, 1, 'View Administrator', 'administrator', 1, 1, '2018-07-17 11:03:54', '2018-07-27 15:24:31'),
(13, 1, 1, 'Edit Administrator', 'administrator', 0, 1, '2018-07-17 11:04:07', '2018-07-27 15:24:41'),
(14, 1, 1, 'Delete Administrator', 'administrator', 0, 1, '2018-07-17 11:04:20', '2018-07-27 15:24:52'),
(15, 1, 1, 'Detail Administrator', 'administrator', 0, 1, '2018-07-17 11:04:32', '2018-07-27 15:25:05'),
(16, 1, 1, 'Super Admin', 'administrator', 0, 1, '2018-07-17 12:09:08', '2018-07-17 12:09:08'),
(17, 1, 1, 'Administrator Dashboard', 'administrator', 0, 1, '2018-07-27 15:26:39', '2018-07-27 15:26:39'),
(20, 1, 7, 'Create Role', 'administrator', 0, 1, '2018-07-28 00:35:23', '2018-07-28 00:35:23'),
(22, 1, 7, 'Update Role', 'administrator', 0, 1, NULL, NULL),
(23, 1, 14, 'View Modules', 'administrator', 1, 1, '2018-08-07 15:30:39', '2018-08-07 15:30:39'),
(24, 1, 15, 'View Sections', 'administrator', 1, 1, '2018-08-07 15:31:22', '2018-08-07 15:31:22');

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `administrator_module_sections`
--
ALTER TABLE `administrator_module_sections`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
