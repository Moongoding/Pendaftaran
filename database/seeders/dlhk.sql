-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2023 at 07:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dlhk`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `title2` varchar(255) DEFAULT NULL,
  `body` varchar(255) NOT NULL,
  `body2` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `user_id`, `title`, `title2`, `body`, `body2`, `created_at`, `updated_at`) VALUES
(1, 1, 'TENTANG', 'KAMI', 'Why This Brand ?', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit saepe quibusdam accusantium accusamus reiciendis esse!', '2023-09-30 22:55:37', '2023-09-30 22:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `analisas`
--

CREATE TABLE `analisas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `harga` decimal(11,0) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analisas`
--

INSERT INTO `analisas` (`id`, `name`, `harga`, `image`, `created_at`, `updated_at`) VALUES
(11, 'SNI', 20000, 'post-images/DW5verc2ORVfpBLYEcrNPHdxZZCRDRxVfw6pLAYu.jpg', '2023-10-01 01:58:04', '2023-10-01 01:58:04'),
(12, 'AIR', 13750, 'post-images/EJyPP74hrAf6TCUitlqP5R11BAagtYolBIsRhOyt.jpg', '2023-10-01 02:54:43', '2023-10-01 02:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `analisa_parameter`
--

CREATE TABLE `analisa_parameter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `analisa_id` bigint(20) UNSIGNED NOT NULL,
  `parameter_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analisa_parameter`
--

INSERT INTO `analisa_parameter` (`id`, `analisa_id`, `parameter_id`, `created_at`, `updated_at`) VALUES
(11, 11, 1, NULL, NULL),
(12, 12, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_parameters`
--

CREATE TABLE `category_parameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_parameters`
--

INSERT INTO `category_parameters` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'FISIKA', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(2, 'KIMIA', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(3, 'MIKROBIOLOGI', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(4, 'KHUSUS', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(5, 'LOGAM', '2023-09-30 22:55:37', '2023-09-30 22:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

CREATE TABLE `homes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `title2` varchar(255) DEFAULT NULL,
  `body` varchar(255) NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homes`
--

INSERT INTO `homes` (`id`, `user_id`, `title`, `title2`, `body`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Came And Enjoy', 'Your Time', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate,\n            exercitationem', NULL, '2023-09-30 22:55:37', '2023-09-30 22:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `metodes`
--

CREATE TABLE `metodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metodes`
--

INSERT INTO `metodes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Konduktometri', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(2, 'Turbidimetri', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(3, 'SNI', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(4, 'IK', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(5, 'Direct Reading Instrument', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(6, 'Standard Methods', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(7, 'Spektrofotometri', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(8, 'Respirometric', '2023-09-30 22:55:37', '2023-09-30 22:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_28_063852_create_metodes_table', 1),
(6, '2023_08_28_063942_create_parameters_table', 1),
(7, '2023_09_04_110558_create_roles_table', 1),
(8, '2023_09_05_022355_create_role_user_table', 1),
(9, '2023_09_17_072752_create_category_parameters_table', 1),
(10, '2023_09_18_131121_create_pendaftarans_table', 1),
(11, '2023_09_23_044019_create_analisas_table', 1),
(12, '2023_09_23_045432_create_analisa_parameter_table', 1),
(13, '2023_09_28_030535_create_home_table', 1),
(14, '2023_09_28_030548_create_about_table', 1),
(15, '2023_10_09_051423_create_reservations_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `parameters`
--

CREATE TABLE `parameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_parameter_id` bigint(20) UNSIGNED NOT NULL,
  `metode_id` bigint(20) UNSIGNED NOT NULL,
  `harga` decimal(11,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parameters`
--

INSERT INTO `parameters` (`id`, `name`, `category_parameter_id`, `metode_id`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Suhu', 1, 3, 20000, '2023-09-30 23:09:03', '2023-09-30 23:09:03'),
(2, 'Zat Padat Terlarut / TDS', 1, 3, 32500, '2023-10-01 02:09:14', '2023-10-01 02:09:14'),
(3, 'Amonia-Nitrogen', 2, 3, 27500, '2023-10-01 02:17:42', '2023-10-01 02:17:42'),
(4, 'BOD', 2, 3, 38750, '2023-10-01 02:18:10', '2023-10-01 02:18:10'),
(5, 'COD', 2, 3, 32500, '2023-10-01 02:18:49', '2023-10-01 02:18:49'),
(6, 'pH', 2, 3, 15000, '2023-10-01 02:19:14', '2023-10-01 02:19:14'),
(7, 'Minyak Lemak', 2, 4, 35000, '2023-10-01 02:19:46', '2023-10-01 02:19:46'),
(8, 'Total Coliform', 3, 6, 45000, '2023-10-01 02:20:29', '2023-10-01 02:20:29'),
(9, 'Daya Hantar Listrik (DLH)', 1, 1, 13750, '2023-10-01 02:25:53', '2023-10-01 02:25:53'),
(10, 'Kekeruhan / Turbidimetri', 1, 2, 13750, '2023-10-01 02:26:38', '2023-10-01 02:26:38'),
(11, 'Zat Padat Tersuspensi / TSS', 1, 3, 32500, '2023-10-01 02:27:49', '2023-10-01 02:27:49'),
(12, 'Oksigen Terlarut (DO)', 1, 3, 35000, '2023-10-01 02:28:33', '2023-10-01 02:28:33'),
(13, 'Kesadahan', 1, 3, 15000, '2023-10-01 02:29:01', '2023-10-01 02:29:01'),
(14, 'Warna', 1, 3, 17500, '2023-10-01 02:29:30', '2023-10-01 02:29:30'),
(15, 'Potensial  Hidrogen (pH)', 2, 3, 15000, '2023-10-01 02:31:23', '2023-10-01 02:31:23'),
(16, 'Sulfat (SO4)', 2, 3, 22500, '2023-10-01 02:31:51', '2023-10-01 02:35:13'),
(17, 'Nitrat (NO3-N)', 2, 3, 21250, '2023-10-01 02:34:32', '2023-10-01 02:34:32'),
(18, 'Nitrit (NO2-N)', 2, 3, 18750, '2023-10-01 02:35:51', '2023-10-01 02:35:51'),
(19, 'Amonia Bebas (NH3-N)', 2, 3, 27500, '2023-10-01 02:36:23', '2023-10-01 02:36:23'),
(20, 'Sulfida', 2, 4, 21250, '2023-10-01 02:36:55', '2023-10-01 02:36:55'),
(21, 'Phospat (PO4)', 2, 3, 28750, '2023-10-01 02:37:23', '2023-10-01 02:37:23'),
(22, 'Chlorine Bebas (Cl2 Free)', 2, 4, 22500, '2023-10-01 02:37:48', '2023-10-01 02:37:48'),
(23, 'H2S', 2, 4, 21250, '2023-10-01 02:38:15', '2023-10-01 02:38:15'),
(24, 'Amoniak Total', 2, 3, 27500, '2023-10-01 02:38:47', '2023-10-01 02:38:47'),
(25, 'Amoniak sebagai N', 2, 3, 27500, '2023-10-01 02:39:22', '2023-10-01 02:39:22'),
(26, 'Surfaktan (MBAS)', 2, 3, 17500, '2023-10-01 02:39:48', '2023-10-01 02:39:48'),
(27, 'Khlorida (Cl)', 2, 3, 23750, '2023-10-01 02:40:27', '2023-10-01 02:40:27'),
(28, 'Sianida (CN)', 2, 4, 32500, '2023-10-01 02:40:57', '2023-10-01 02:40:57'),
(29, 'Fluorida (F-)', 2, 3, 27500, '2023-10-01 02:41:26', '2023-10-01 02:41:26'),
(30, 'Krom Total (Cr Total)', 2, 4, 40625, '2023-10-01 02:42:06', '2023-10-01 02:42:06'),
(31, 'Krom Hexavalen (Cr 6+)', 2, 3, 32500, '2023-10-01 02:42:37', '2023-10-01 02:42:37'),
(32, 'Fenol', 4, 4, 27500, '2023-10-01 02:43:38', '2023-10-01 02:43:38'),
(33, 'BOD5', 4, 3, 38750, '2023-10-01 02:44:32', '2023-10-01 02:44:32'),
(34, 'E. Colli', 3, 3, 45000, '2023-10-01 02:45:58', '2023-10-01 02:45:58'),
(35, 'Total Colliform', 3, 3, 45000, '2023-10-01 02:47:17', '2023-10-01 02:47:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `analisas_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Super_Admin', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(2, 'Admin', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(3, 'User', '2023-09-30 22:55:37', '2023-09-30 22:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Annette Purdy', 'bahringer.maddison@example.net', '2023-09-30 22:55:36', '$2y$10$tLnLGpyVi0gTONkPvq299udy.0Zi0LRMvwCIVwRlFZd12/0F3BGhO', 'qxcW5GfzDB', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(2, 'Edna Streich', 'wyman.shanel@example.net', '2023-09-30 22:55:36', '$2y$10$RjiPdXjbMjDRapcNC3FqD.BywjSSbQJNoC4jus5C6m4q7ptbgTele', 'fJvRbpkeMZ', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(3, 'Dr. Maxime Terry I', 'parker.dangelo@example.com', '2023-09-30 22:55:36', '$2y$10$94.W.ZWEQdm.6KPExUUcOOn6SD3C3SIce8LnFgCU8MpGuUrE80I16', 'UbtgpfnTbv', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(4, 'Dr. Terrill Hintz I', 'mcglynn.creola@example.org', '2023-09-30 22:55:36', '$2y$10$OeUAvMMPBFFS/k7j0vNuieyqmtn3u19y9eEvVel06IPeCG73EYZcC', 'n6IBvduocx', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(5, 'Isom Parisian', 'esawayn@example.org', '2023-09-30 22:55:36', '$2y$10$wKgUaG8IlSjIOdF478QLIu5RNQ3OAzPGpGdeUk5Szq8rc830b/Taa', 'CTHkmVXJcw', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(6, 'Oswaldo Blanda', 'willms.buck@example.net', '2023-09-30 22:55:36', '$2y$10$dQciKyCkLE1WDmPN8fONA.vVAtM7VgdT3VuLg9RshQuLinvpdCobe', 'yCbGjdQoMs', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(7, 'Mr. Hudson Corwin I', 'kling.amina@example.net', '2023-09-30 22:55:36', '$2y$10$Bi5YwZTkaQ5gNY/lJrLMfObw2ePQrfigLPZqjZdKQ2w.poaH1WVcO', 'bO6X8iKhRU', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(8, 'Carroll Turner', 'pmurazik@example.org', '2023-09-30 22:55:36', '$2y$10$LuLM1curfN3pSQUvGjb8j.NvdcPGAHhBIEs.vcPuWSTSUkIaRe9ua', 'UIz7bMs1a0', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(9, 'Prof. Matilda Jaskolski DDS', 'maggio.margaret@example.com', '2023-09-30 22:55:37', '$2y$10$Co3fnxEAdtpHM9R6lLzDuuIWNc0JmGmW7iRVguTQrZho6uqJyAIvu', '3ehBphiHkQ', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(10, 'Kaela Emmerich', 'theresia93@example.com', '2023-09-30 22:55:37', '$2y$10$KJJi2CK30A5yPl10RLbdYuYQ1dHZZxBSEXKcK.sjCM4I78qcUWUV6', 'WYRX3dkvq7', '2023-09-30 22:55:37', '2023-09-30 22:55:37'),
(11, 'Krisma Mochamad Muldan', 'krismamuldan@gmail.com', NULL, '$2y$10$UjN/VxWI9eF0E4Y9QBljKOX6xvbuBIC7U0LpTba0sBzhAiO4TCpHO', NULL, '2023-09-30 23:07:52', '2023-09-30 23:07:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `analisas`
--
ALTER TABLE `analisas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `analisa_parameter`
--
ALTER TABLE `analisa_parameter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `analisa_parameter_analisa_id_foreign` (`analisa_id`),
  ADD KEY `analisa_parameter_parameter_id_foreign` (`parameter_id`);

--
-- Indexes for table `category_parameters`
--
ALTER TABLE `category_parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metodes`
--
ALTER TABLE `metodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parameters_category_parameter_id_index` (`category_parameter_id`),
  ADD KEY `parameters_metode_id_index` (`metode_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_analisas_id_foreign` (`analisas_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `analisas`
--
ALTER TABLE `analisas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `analisa_parameter`
--
ALTER TABLE `analisa_parameter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_analisas_id_foreign` FOREIGN KEY (`analisas_id`) REFERENCES `analisas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
