-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 15 avr. 2026 à 09:23
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cave_boisson`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `drinks`
--

DROP TABLE IF EXISTS `drinks`;
CREATE TABLE IF NOT EXISTS `drinks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite_stock` int NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `drinks`
--

INSERT INTO `drinks` (`id`, `nom`, `categorie`, `quantite_stock`, `prix_unitaire`, `image`, `created_at`, `updated_at`) VALUES
(14, 'biere', 'Jus', 19, 600.00, 'drinks/dRCJyVoqynqsvl8XBTAccpXscwqHvYs558OQaHS2.jpg', '2026-04-02 23:50:40', '2026-04-10 10:19:42'),
(13, 'FANTA', 'Jus', 0, 500.00, 'drinks/HnH2cHPVI4tTIbAyqTp9Mv2K8GIOQX3QGG2w9CAl.jpg', '2026-04-02 22:45:51', '2026-04-15 08:13:06'),
(7, 'Red Bull ENERGY', 'Jus', 11, 500.00, 'drinks/wk8hZS0L560xLbyCKaDwHyUFFjMhIzFlYf2giSmb.jpg', '2026-03-23 16:39:04', '2026-04-10 10:19:42'),
(8, 'POWER ADE', 'Eau', 18, 400.00, 'drinks/pOb31UQmjbHt4FadMwMyCYfFpuxMYh06NNTE8xw0.jpg', '2026-03-24 16:56:20', '2026-04-10 06:55:32'),
(15, 'PRIME ENERGY', 'Jus', 288, 1000.00, 'drinks/xyuyHxMOLmRew0n25bhVh6l0nsWl5lMaRSK44dVS.jpg', '2026-04-03 06:48:28', '2026-04-10 10:19:42'),
(16, 'COCA-COLA', 'Jus', 99, 500.00, 'drinks/PbhQV9AoTJHwGui0qNwoupXzIPrIIXgT5MXxO0v7.jpg', '2026-04-03 06:53:30', '2026-04-10 10:19:42'),
(17, 'BIERRE LEFFE', 'Bière', 9, 500.00, 'drinks/rwyp2yGxb3qGXqlgfrSdEFUJQ3NcM3buHsAigDyb.jpg', '2026-04-03 07:05:34', '2026-04-10 10:19:42'),
(18, 'BIERRE BLANC', 'Bière', 19, 600.00, 'drinks/Rx7V8QSaqqLbReFpebEqVosFyhTsrztg2rGZRFVf.jpg', '2026-04-03 07:06:15', '2026-04-10 10:19:42'),
(19, 'VIN JEAN BOUCHARD', 'Vin', 30, 10000.00, 'drinks/8Oh7TzzHqI4RLF3vWvwEU0da5qCoeF6lNNwiRCWp.jpg', '2026-04-03 07:09:08', '2026-04-03 07:09:08'),
(20, 'LIQUID DEATH', 'Eau', 20, 500.00, 'drinks/dFgmap7bfK0AANHuLJ6BIpeO92UdbDLvGF84T342.webp', '2026-04-03 07:14:46', '2026-04-03 07:14:46'),
(21, 'JUS LIPTON', 'Jus', 91, 500.00, 'drinks/fJRrwHetPEPwD4c6bJsUL0YVEftDfqoYt16FGfBu.jpg', '2026-04-04 12:08:25', '2026-04-04 12:09:03'),
(22, 'COCA-COLA BOUTEILLE', 'Jus', 100, 600.00, 'drinks/OMizrxK7s6RCXF7ESLCFmMbBcT2DJ1fZSw1CgfPU.webp', '2026-04-10 10:48:44', '2026-04-10 10:48:44'),
(23, 'SODA', 'Jus', 100, 3000.00, 'drinks/re6HMxN3nxfhhDA8E825yf1Iq2fdmarnfk0nfS09.jpg', '2026-04-10 10:49:47', '2026-04-10 10:49:47'),
(24, 'PEPSICO', 'Jus', 200, 1001.00, 'drinks/aWjy3gq4EBKTNpHW2KTb5JeZ7d2L7pzEVC9TeBqh.webp', '2026-04-14 07:51:59', '2026-04-14 07:51:59'),
(25, 'PURE LIFE', 'Eau', 200, 500.00, 'drinks/MzHQVqELT9dqtNR1FFmV58kWUjGOwDaKuLnDpxnf.webp', '2026-04-14 08:01:01', '2026-04-14 08:01:01'),
(26, 'SPARK ICE', 'Jus', 200, 800.00, 'drinks/gzuwO9FnPD1WeUM47PVRjCtEwqm20iq6lDSNl4Ww.jpg', '2026-04-14 08:02:08', '2026-04-14 08:02:08'),
(27, 'LOWER SUGAR', 'Jus', 30, 1000.00, 'drinks/3olJqxaI9cSd1xMBTqqsc9cS4p2rfh4Az33EJlIc.webp', '2026-04-14 08:06:23', '2026-04-14 08:06:23'),
(28, 'PROTEIN', 'Jus', 50, 2000.00, 'drinks/Rvxj14wOx7aHD9kYz62aN858OoLAxitkzn6YISqA.webp', '2026-04-14 08:07:27', '2026-04-14 08:07:27'),
(29, 'VIN MONDEUSE PRIME', 'Vin', 5, 1000000.00, 'drinks/QMSK9sl1RJdOuf42jQYLdkHpO6B7vnC4Vgsxn3sV.png', '2026-04-14 09:21:55', '2026-04-15 08:13:59'),
(30, 'VIN RICHBOURG', 'Vin', 10, 10000000.00, 'drinks/ArWbkq8dBNv2MGrrZJ7edzSIcz78u8Lm1I7xo6h0.jpg', '2026-04-14 09:23:33', '2026-04-14 09:23:33'),
(31, 'VIN GOOD HEALTH', 'Vin', 20, 300000.00, 'drinks/57oMzjNOjGKArl25E9wNfLjAkyC03hEi5DDYG4Es.webp', '2026-04-14 09:24:44', '2026-04-14 09:24:44'),
(32, 'VIN WHITE VINEGAR', 'Vin', 20, 20000.00, 'drinks/mGLabwllXDyLtXqNZWunM1C1WcoYWYNRV5B0sup8.webp', '2026-04-14 09:27:52', '2026-04-14 09:27:52'),
(33, 'ENERGY BANANA', 'Jus', 300, 4000.00, 'drinks/2FUqPWBgfkS3SBbXkwmKaB8C9eHUAeqSTErI93Pb.webp', '2026-04-14 09:29:02', '2026-04-14 09:29:02'),
(34, 'PRIME BANANA', 'Jus', 100, 800.00, 'drinks/ric4wUixXzPvNAuG8nNZ5fSsqUs1k5CgSMHGe5K1.webp', '2026-04-14 09:29:52', '2026-04-14 09:29:52');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_17_225941_create_drinks_table', 2),
(5, '2026_03_17_234300_create_sales_table', 3),
(6, '2026_03_24_161654_add_client_name_to_sales_table', 4),
(7, '2026_04_03_000001_add_image_to_drinks_table', 5),
(8, '2026_04_09_000001_add_role_to_users_table', 6);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `drink_id` bigint UNSIGNED NOT NULL,
  `client_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantite_vendue` int NOT NULL,
  `prix_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_drink_id_foreign` (`drink_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sales`
--

INSERT INTO `sales` (`id`, `drink_id`, `client_name`, `quantite_vendue`, `prix_total`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 2, 2000.00, '2026-03-18 00:23:06', '2026-03-18 00:23:06'),
(2, 3, NULL, 2, 9132.00, '2026-03-18 00:31:59', '2026-03-18 00:31:59'),
(3, 4, NULL, 10, 5000.00, '2026-03-20 17:05:42', '2026-03-20 17:05:42'),
(4, 3, NULL, 2, 9132.00, '2026-03-20 17:06:18', '2026-03-20 17:06:18'),
(5, 5, NULL, 2, 690.00, '2026-03-22 15:38:25', '2026-03-22 15:38:25'),
(6, 7, NULL, 23, 13800.00, '2026-03-23 16:39:26', '2026-03-23 16:39:26'),
(7, 8, NULL, 4, 1600.00, '2026-03-24 16:57:05', '2026-03-24 16:57:05'),
(8, 8, NULL, 6, 2400.00, '2026-03-24 17:05:43', '2026-03-24 17:05:43'),
(9, 8, NULL, 13, 5200.00, '2026-03-24 17:25:05', '2026-03-24 17:25:05'),
(10, 5, NULL, 1, 345.00, '2026-03-24 17:34:35', '2026-03-24 17:34:35'),
(11, 7, NULL, 27, 16200.00, '2026-03-24 17:34:58', '2026-03-24 17:34:58'),
(12, 9, NULL, 1, 100.00, '2026-03-24 18:16:13', '2026-03-24 18:16:13'),
(13, 9, NULL, 1, 100.00, '2026-03-24 18:16:32', '2026-03-24 18:16:32'),
(14, 6, 'ossam', 74, 41958.00, '2026-03-24 23:32:15', '2026-03-24 23:32:15'),
(15, 7, 'li', 430, 258000.00, '2026-03-24 23:32:46', '2026-03-24 23:32:46'),
(16, 6, 'yaro', 715, 405405.00, '2026-03-24 23:51:38', '2026-03-24 23:51:38'),
(17, 10, 'poli', 17, 8500.00, '2026-03-24 23:53:49', '2026-03-24 23:53:49'),
(18, 10, NULL, 17, 8500.00, '2026-03-25 00:56:31', '2026-03-25 00:56:31'),
(19, 10, 'rachid', 966, 483000.00, '2026-03-25 01:45:36', '2026-03-25 01:45:36'),
(20, 12, 'cissé', 8, 3200.00, '2026-03-25 14:32:10', '2026-03-25 14:32:10'),
(21, 13, 'rahim', 1, 500.00, '2026-04-02 22:46:02', '2026-04-02 22:46:02'),
(22, 13, NULL, 9, 4500.00, '2026-04-02 22:46:18', '2026-04-02 22:46:18'),
(23, 13, NULL, 1, 500.00, '2026-04-02 22:46:35', '2026-04-02 22:46:35'),
(24, 13, NULL, 4, 2000.00, '2026-04-02 22:46:47', '2026-04-02 22:46:47'),
(25, 13, NULL, 5, 2500.00, '2026-04-02 22:47:04', '2026-04-02 22:47:04'),
(26, 14, NULL, 6, 3600.00, '2026-04-02 23:51:02', '2026-04-02 23:51:02'),
(27, 14, NULL, 3, 1800.00, '2026-04-03 06:17:00', '2026-04-03 06:17:00'),
(28, 14, NULL, 1, 600.00, '2026-04-03 06:17:05', '2026-04-03 06:17:05'),
(29, 15, 'babstore', 11, 11000.00, '2026-04-03 06:50:15', '2026-04-03 06:50:15'),
(30, 21, 'MATHIAS', 9, 4500.00, '2026-04-04 12:09:03', '2026-04-04 12:09:03'),
(31, 13, 'DABIRE FREDERIC', 5, 2500.00, '2026-04-09 10:40:04', '2026-04-09 10:40:04'),
(32, 7, 'CISSE DRISSA', 7, 3500.00, '2026-04-09 10:40:59', '2026-04-09 10:40:59'),
(33, 7, 'aziz', 1, 500.00, '2026-04-10 06:55:32', '2026-04-10 06:55:32'),
(34, 8, 'aziz', 2, 800.00, '2026-04-10 06:55:32', '2026-04-10 06:55:32'),
(35, 13, 'aziz', 1, 500.00, '2026-04-10 06:55:32', '2026-04-10 06:55:32'),
(36, 7, 'Anonyme', 1, 500.00, '2026-04-10 10:19:42', '2026-04-10 10:19:42'),
(37, 14, 'Anonyme', 1, 600.00, '2026-04-10 10:19:42', '2026-04-10 10:19:42'),
(38, 15, 'Anonyme', 1, 1000.00, '2026-04-10 10:19:42', '2026-04-10 10:19:42'),
(39, 16, 'Anonyme', 1, 500.00, '2026-04-10 10:19:42', '2026-04-10 10:19:42'),
(40, 17, 'Anonyme', 1, 500.00, '2026-04-10 10:19:42', '2026-04-10 10:19:42'),
(41, 18, 'Anonyme', 1, 600.00, '2026-04-10 10:19:42', '2026-04-10 10:19:42'),
(42, 13, 'Anonyme', 34, 17000.00, '2026-04-15 08:13:06', '2026-04-15 08:13:06'),
(43, 29, 'PAUL DAMIBA', 5, 5000000.00, '2026-04-15 08:13:59', '2026-04-15 08:13:59');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('oBM5XJPM2BcDPsraaljBraNUp4Sd5QzgKugVAqiO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVzBzTk9lY2dVeThZUUpKSXg4V09UR1JqMWRON25MWXpvbnpjRHJUTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1776159814),
('13h7QJO3bAU5iHoGA5EsDDJIamrXqTYixmSBzeL9', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidThydXdBeG1mcGdMbzllOVltT3ZzMmVlekhhS2t2a21nYUdob0NIUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kcmlua3MvMTMvZWRpdCI7czo1OiJyb3V0ZSI7czoxMToiZHJpbmtzLmVkaXQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1776241070);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','client') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `telephone`, `adresse`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'OSSAM', 'bangreossam492@gmail.com', 'client', NULL, NULL, NULL, '$2y$12$9NA5teNK1G1NIJPDz4k2teYDyRiE0JEwMGxMKoLQwUSYFLxqbJB.O', NULL, '2026-03-17 23:27:35', '2026-03-17 23:27:35'),
(2, 'aziz', 'scrafit018@gmail.com', 'client', NULL, NULL, NULL, '$2y$12$TsajqeR0wWTuNEKe6Fu26O.69lnzaXhMqnA3B/lsE0JwALzUAVuHu', NULL, '2026-04-02 23:48:30', '2026-04-02 23:48:30'),
(3, 'Admin', 'admin@gmail.com', 'admin', NULL, NULL, NULL, '$2y$12$CAyz.UOXBE96H4XPfqE8T.HHNRe9lLmsLl/lXCvpkrVJ762Fvl2iy', 'RdBnJvGAgWalnT3I0GyWbHh22IRNcZYzdSlAIDB4JaXzMrkUFDgw6rGEJzCA', '2026-04-10 10:44:54', '2026-04-10 10:44:54'),
(4, 'CISSE DRISSA', 'cissedriss25@gmail.com', 'client', NULL, NULL, NULL, '$2y$12$8uffX5gRXyi915Cns/.2Lumkg33uQvFYRRJJwSPd7w4pe6tz9r78a', NULL, '2026-04-11 10:43:07', '2026-04-11 10:43:07'),
(5, 'rahim', 'rahimbamba23@gmail.com', 'client', NULL, NULL, NULL, '$2y$12$1XKuOaR9hU150F8hMGR7CeJXRbXMQwGlZ.QPT9b0VywJajaVPSqia', NULL, '2026-04-14 07:50:47', '2026-04-14 07:50:47'),
(7, 'frederic', 'everesty28@gmail.com', 'client', NULL, NULL, NULL, '$2y$12$9RGrHmgttkr51KybIhKhvu6yNUirofK/ToyhHSYjhymmWKLPXWYBq', NULL, '2026-04-15 08:11:42', '2026-04-15 08:11:42');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
