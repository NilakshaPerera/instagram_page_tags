-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2020 at 05:55 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instagram_page_tags`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_accounts`
--

CREATE TABLE `business_accounts` (
  `id` int(11) NOT NULL,
  `facebook_auths_id` int(11) DEFAULT 0,
  `instagram_business_id` varchar(5000) NOT NULL,
  `facebook_page_id` varchar(200) DEFAULT NULL,
  `query_id` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facebook_auths`
--

CREATE TABLE `facebook_auths` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `access_token` text NOT NULL,
  `long_lived_access_token` text NOT NULL,
  `meta_data` text NOT NULL,
  `accounts` text DEFAULT NULL,
  `account_id` varchar(200) DEFAULT NULL,
  `account_name` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '2017_04_10_000000_create_users_table', 1),
(2, '2017_04_10_000001_create_password_resets_table', 1),
(3, '2017_04_10_000002_create_social_accounts_table', 1),
(4, '2017_04_10_000003_create_roles_table', 1),
(5, '2017_04_10_000004_create_users_roles_table', 1),
(6, '2017_06_16_000005_create_protection_validations_table', 1),
(7, '2017_06_16_000006_create_protection_shop_tokens_table', 1);

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `business_accounts_id` int(11) NOT NULL,
  `postid` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_url` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `like_count` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments_count` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permalink` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timestamp` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `tasks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `weight`, `tasks`) VALUES
(1, 'Administrator', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting` varchar(500) NOT NULL,
  `display_name` varchar(200) NOT NULL,
  `data` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting`, `display_name`, `data`, `created_at`, `updated_at`) VALUES
(10, 'app_id', 'Application ID', 'YourApplicationID', '2020-01-01 04:54:05', '2020-01-01 04:54:05'),
(11, 'app_secret', 'Application Secret', 'YourApplicationSecret', '2020-01-01 04:54:05', '2020-01-01 04:54:05'),
(12, 'default_graph_version', 'Default Graph Version', 'v3.2', '2020-01-01 04:54:05', '2020-01-01 04:54:05'),
(13, 'redirect_url', 'Redirect URL', 'https://yourwebsite/account/callback', '2020-01-01 04:54:05', '2020-01-01 04:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `temp_posts`
--

CREATE TABLE `temp_posts` (
  `id` int(11) NOT NULL,
  `business_accounts_id` int(11) NOT NULL,
  `postid` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_url` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `like_count` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments_count` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permalink` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timestamp` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `confirmation_code` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `branch_id`, `name`, `email`, `contact`, `empid`, `password`, `image`, `active`, `confirmation_code`, `confirmed`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Nilaksha Perera', 'info@nilaksha.com', '0000000000', '0000000000', '$2y$10$iaazEIgPRnEBn6dlhVfmTueTVv1UCW3kRN2Vl1C7KmKf1PJ1LEBHi', '', 1, '2e538283-3298-4d5b-aaf9-2986c7799b4a', 1, '031NXESM1YH8AyhDUuwLm9vkg0PKuVrZm5QIIFbfDvvndq7lIK7Agf3cSleP', '2018-01-10 03:44:35', '2019-11-26 05:27:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_accounts`
--
ALTER TABLE `business_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facebook_auths`
--
ALTER TABLE `facebook_auths`
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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_posts`
--
ALTER TABLE `temp_posts`
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
-- AUTO_INCREMENT for table `business_accounts`
--
ALTER TABLE `business_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facebook_auths`
--
ALTER TABLE `facebook_auths`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `temp_posts`
--
ALTER TABLE `temp_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
