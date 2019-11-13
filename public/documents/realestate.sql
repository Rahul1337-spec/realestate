-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2019 at 07:31 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agent_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent_city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approval` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `property_counts` int(11) DEFAULT NULL,
  `for_rent` int(11) DEFAULT NULL,
  `for_buy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `agent_name`, `agent_address`, `locality`, `agent_city`, `approval`, `created_at`, `updated_at`, `property_counts`, `for_rent`, `for_buy`) VALUES
(1, 'Agent 1', 'Locality Some where', 'Vadodara', 'Vadodara', 1, '2019-09-05 05:09:19', '2019-09-05 05:09:19', 4, 1, 3),
(2, 'tester1', 'somewhere', 'Surat', 'Surat', 1, '2019-09-06 02:59:39', '2019-09-06 02:59:39', 2, 2, 4),
(3, 'tester2', 'Somewhere on earth', 'Vadodara', 'Vadodara', 0, '2019-09-06 03:00:32', '2019-09-06 03:00:32', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agent_property`
--

CREATE TABLE `agent_property` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agent_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agent_property`
--

INSERT INTO `agent_property` (`id`, `agent_id`, `property_id`, `created_at`, `updated_at`) VALUES
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(37, 1, 37, NULL, NULL),
(38, 1, 38, NULL, NULL),
(39, 2, 39, NULL, NULL),
(40, 2, 40, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agent_user`
--

CREATE TABLE `agent_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agent_user`
--

INSERT INTO `agent_user` (`id`, `user_id`, `agent_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 5, 2, NULL, NULL),
(3, 6, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Vadodara', '2019-09-05 05:08:08', '2019-09-05 05:08:08'),
(2, 'Surat', '2019-09-05 05:08:08', '2019-09-05 05:08:08');

-- --------------------------------------------------------

--
-- Table structure for table `city_property`
--

CREATE TABLE `city_property` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city_property`
--

INSERT INTO `city_property` (`id`, `city_id`, `property_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, NULL, NULL),
(2, 2, 3, NULL, NULL),
(36, 1, 37, NULL, NULL),
(37, 1, 38, NULL, NULL),
(38, 1, 39, NULL, NULL),
(39, 1, 40, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `email`, `name`, `phone`, `created_at`, `updated_at`) VALUES
(11, 'user1@gmail.com', 'user1', '9638246271', '2019-09-11 01:22:05', '2019-09-11 01:22:05'),
(12, 'user1@gmail.com', 'user1re', '9638246271', '2019-09-11 01:42:58', '2019-09-11 01:42:58'),
(16, 'tester1@gmail.com', 'tester1', '9638246271', '2019-09-11 04:52:52', '2019-09-11 04:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_property`
--

CREATE TABLE `enquiry_property` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enquiry_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiry_property`
--

INSERT INTO `enquiry_property` (`id`, `enquiry_id`, `property_id`, `created_at`, `updated_at`) VALUES
(7, 11, 2, NULL, NULL),
(8, 12, 39, NULL, NULL),
(12, 16, 40, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_user`
--

CREATE TABLE `enquiry_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `enquiry_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiry_user`
--

INSERT INTO `enquiry_user` (`id`, `user_id`, `enquiry_id`, `created_at`, `updated_at`) VALUES
(8, 9, 11, NULL, NULL),
(9, 9, 12, NULL, NULL),
(13, 5, 16, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`, `created_at`, `updated_at`, `path`) VALUES
(1, 'mel4.jpg', '2019-09-05 05:21:22', '2019-09-05 05:21:22', 'C:\\xampp\\htdocs\\Realeastate\\public\\images\\mel4.jpg'),
(2, 'mel5.jpg', '2019-09-05 05:39:31', '2019-09-05 05:39:31', 'C:\\xampp\\htdocs\\Realeastate\\public\\images\\mel5.jpg'),
(13, 'Aus39.jpg', '2019-09-06 00:56:26', '2019-09-06 00:56:26', 'C:\\xampp\\htdocs\\Realeastate\\public\\images\\Aus39.jpg'),
(14, 'mel21.jpg', '2019-09-06 00:57:05', '2019-09-06 00:57:05', 'C:\\xampp\\htdocs\\Realeastate\\public\\images\\mel21.jpg'),
(15, 'Aus41.jpg', '2019-09-06 07:04:19', '2019-09-06 07:04:19', 'C:\\xampp\\htdocs\\Realeastate\\public\\images\\Aus41.jpg'),
(16, 'Aus42.jpg', '2019-09-06 07:07:15', '2019-09-06 07:07:15', 'C:\\xampp\\htdocs\\Realeastate\\public\\images\\Aus42.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `image_property`
--

CREATE TABLE `image_property` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_property`
--

INSERT INTO `image_property` (`id`, `image_id`, `property_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 2, 3, NULL, NULL),
(13, 13, 37, NULL, NULL),
(14, 14, 38, NULL, NULL),
(15, 15, 39, NULL, NULL),
(16, 16, 40, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_05_053845_create_roles_table', 1),
(4, '2019_08_05_060444_create_role_user_table', 1),
(5, '2019_08_12_061818_create_properties_table', 1),
(6, '2019_08_12_073418_create_property_user_table', 1),
(7, '2019_08_12_123217_create_enquiries_table', 1),
(8, '2019_08_12_123424_create_enquiry_user_table', 1),
(9, '2019_08_13_044614_create_agents_table', 1),
(10, '2019_08_13_045734_add_agent_column_to_user_table', 1),
(11, '2019_08_13_051251_create_agent_user_table', 1),
(12, '2019_08_19_045822_add_agent_apply_stat_to_users', 1),
(13, '2019_08_20_070457_create_agent_property_table', 1),
(14, '2019_08_20_070825_create_images_table', 1),
(15, '2019_08_20_071507_create_image_property_table', 1),
(16, '2019_08_20_075627_create_types_table', 1),
(17, '2019_08_20_075855_create_property_type_table', 1),
(18, '2019_08_26_052549_add__path_to__image__table', 1),
(19, '2019_08_26_114545_add__feature_image_to__properties_table', 1),
(20, '2019_09_02_123304_create_cities_table', 1),
(21, '2019_09_03_063007_create_city_property_table', 1),
(22, '2019_09_04_132338_add__property_rate_to_properties_table', 1),
(23, '2019_09_05_083419_add_property_count_to_agents_table', 1),
(24, '2019_09_05_111119_add_for_rent_to_agents_table', 2),
(25, '2019_09_05_111453_add_for__buy_to_agents_table', 2),
(26, '2019_09_10_050930_create_enquiry_property_table', 3),
(27, '2019_09_11_062731_add_phone_to_users_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `featured_img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_rate` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `property_name`, `property_type`, `property_author`, `property_address`, `property_country`, `property_state`, `created_at`, `updated_at`, `featured_img`, `property_rate`) VALUES
(2, 'Iscon 2', 'old', 'Agent 1', 'New iscon location', 'India', 'Surat', '2019-09-05 05:21:22', '2019-09-05 05:21:22', 'Aus8.jpg', 45654),
(3, 'iscon 4', 'old', 'Agent 1', 'iscon 4 new', 'India', 'Surat', '2019-09-05 05:39:31', '2019-09-05 05:39:31', 'Aus9.jpg', 7899),
(37, 'tester', 'old', 'Agent 1', 'tester', 'India', 'Vadodara', '2019-09-06 00:56:26', '2019-09-06 00:56:26', 'mel20.jpg', 555),
(38, 'tester 2', 'old', 'Agent 1', 'tester 2', 'India', 'Vadodara', '2019-09-06 00:57:05', '2019-09-06 00:57:05', 'Aus40.jpg', 6546),
(39, 'New Alka 2', 'old', 'tester1', 'some address here to fill', 'India', 'Vadodara', '2019-09-06 07:04:17', '2019-09-06 07:04:17', 'mel22.jpg', 46000),
(40, 'New Alka 3', 'old', 'tester1', 'New address for filler', 'India', 'Vadodara', '2019-09-06 07:07:15', '2019-09-06 07:07:15', 'mel23.jpg', 48000);

-- --------------------------------------------------------

--
-- Table structure for table `property_type`
--

CREATE TABLE `property_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_type`
--

INSERT INTO `property_type` (`id`, `property_id`, `type_id`, `created_at`, `updated_at`) VALUES
(1, 2, 4, NULL, NULL),
(2, 3, 4, NULL, NULL),
(36, 37, 4, NULL, NULL),
(37, 38, 3, NULL, NULL),
(38, 39, 3, NULL, NULL),
(39, 40, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_user`
--

CREATE TABLE `property_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2019-09-05 05:08:08', '2019-09-05 05:08:08'),
(2, 'user', '2019-09-05 05:08:08', '2019-09-05 05:08:08'),
(3, 'builder', '2019-09-05 05:08:08', '2019-09-05 05:08:08'),
(4, 'agent', '2019-09-05 05:08:08', '2019-09-05 05:08:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 4, 3, NULL, NULL),
(4, 3, 4, NULL, NULL),
(5, 4, 2, NULL, NULL),
(11, 2, 5, NULL, NULL),
(12, 2, 6, NULL, NULL),
(15, 4, 5, NULL, NULL),
(16, 2, 7, NULL, NULL),
(17, 2, 8, NULL, NULL),
(18, 2, 9, NULL, NULL),
(19, 2, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Rent', '2019-09-05 05:20:01', '2019-09-05 05:20:01'),
(4, 'Buy', '2019-09-05 05:20:05', '2019-09-05 05:20:05');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `isAgent` tinyint(1) NOT NULL DEFAULT '0',
  `Applied_agent` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `isAgent`, `Applied_agent`, `phone`) VALUES
(1, 'Admin', 'nmadmin1@gmail.com', NULL, '$2y$10$ttuLog.UAXCWUAq753cOAuUP1zmXUsxgz5fthMkryXmw6w7INB5Hq', NULL, '2019-09-05 05:08:07', '2019-09-05 05:08:07', 0, 0, ''),
(2, 'tester', 'tester3@gmail.com', NULL, '$2y$10$R5svOJ5T4tWP3S6b1TIo7O5JTdGQfERp4k/ENjar2RL4nJXHqLP3.', NULL, '2019-09-05 05:08:07', '2019-09-05 05:08:07', 1, 1, ''),
(3, 'agenttest', 'agenttest@gmail.com', NULL, '$2y$10$KiYATp3rTDVWxkoAKfL.E.sdyWpJDdO6cRi6o3431xTTwHDKsmPUq', NULL, '2019-09-05 05:08:07', '2019-09-05 05:08:07', 0, 0, ''),
(4, 'buildertest', 'buildertest@gmail.com', NULL, '$2y$10$5lQzVU1qIRftS85Hvjdr9.1Mn6x.jb4dry2fT/eDyLlg4fNMkg0AS', NULL, '2019-09-05 05:08:08', '2019-09-05 05:08:08', 0, 0, ''),
(5, 'tester1', 'tester1@gmail.com', '2019-09-10 00:06:49', '$2y$10$yE5gf0NwB0HblPeMjEpYB.qAh2DpD3Dw6YEZWMidJO1z9eVN5K6Ei', NULL, '2019-09-06 02:58:41', '2019-09-10 00:06:49', 1, 1, ''),
(6, 'tester2', 'tester2@gmail.com', NULL, '$2y$10$VDlfncetDCbjSGMmmVdP0.ED/qiTOMGR4T1vOuT9xVhB351asCz7S', NULL, '2019-09-06 03:00:07', '2019-09-06 03:00:07', 0, 1, ''),
(8, 'tester6', 'webdeveloper@digitowebservices.com', '2019-09-09 06:53:18', '$2y$10$fxvNKg/mnXaCbBf3PNyHseG1.KpseDx3f/P6EtIgw/FCv/Y4PWUra', NULL, '2019-09-09 06:44:56', '2019-09-09 06:53:18', 0, 0, ''),
(9, 'finaluser', 'user1@gmail.com', '2019-09-11 01:08:07', '$2y$10$8AikikhK.dqtoTGveZG8/ewwX7r5pZa6C/z8S9S1/kx/91Z8Th.dq', NULL, '2019-09-11 01:07:21', '2019-09-11 01:08:07', 0, 0, '9638246271'),
(10, 'tester8', 'tester8@gmail.com', NULL, '$2y$10$MQhw7OsNBLv5XrAEvuLI5eSk4rKl9FOxx8z.Pi8txKDk/1I9c.rUu', NULL, '2019-09-11 23:57:18', '2019-09-11 23:57:18', 0, 0, '9638246271');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_property`
--
ALTER TABLE `agent_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_user`
--
ALTER TABLE `agent_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_property`
--
ALTER TABLE `city_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_property`
--
ALTER TABLE `enquiry_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_user`
--
ALTER TABLE `enquiry_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_property`
--
ALTER TABLE `image_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_type`
--
ALTER TABLE `property_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_user`
--
ALTER TABLE `property_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `agent_property`
--
ALTER TABLE `agent_property`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `agent_user`
--
ALTER TABLE `agent_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `city_property`
--
ALTER TABLE `city_property`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `enquiry_property`
--
ALTER TABLE `enquiry_property`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `enquiry_user`
--
ALTER TABLE `enquiry_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `image_property`
--
ALTER TABLE `image_property`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `property_user`
--
ALTER TABLE `property_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
