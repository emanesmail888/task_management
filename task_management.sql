-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22 أكتوبر 2025 الساعة 11:54
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management`
--

-- --------------------------------------------------------

--
-- بنية الجدول `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `entity` varchar(255) NOT NULL,
  `entity_id` bigint(20) UNSIGNED NOT NULL,
  `changes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`changes`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `entity`, `entity_id`, `changes`, `created_at`, `updated_at`) VALUES
(1, 17, 'create', 'task', 36, NULL, '2025-10-22 05:39:56', '2025-10-22 05:39:56'),
(2, 17, 'create', 'task', 37, NULL, '2025-10-22 05:47:50', '2025-10-22 05:47:50'),
(3, 17, 'update', 'task', 37, '\"{\\\"title\\\":\\\"Updated Task\\\",\\\"description\\\":\\\"Updated description\\\",\\\"updated_at\\\":\\\"2025-10-22 08:48:11\\\"}\"', '2025-10-22 05:48:11', '2025-10-22 05:48:11'),
(4, 17, 'create', 'task', 38, NULL, '2025-10-22 05:51:55', '2025-10-22 05:51:55'),
(5, 17, 'update', 'task', 38, '\"{\\\"title\\\":\\\"Updated Task\\\",\\\"description\\\":\\\"Updated description\\\",\\\"status\\\":\\\"done\\\",\\\"priority\\\":\\\"high\\\",\\\"updated_at\\\":\\\"2025-10-22 08:52:30\\\"}\"', '2025-10-22 05:52:30', '2025-10-22 05:52:30'),
(6, 17, 'create', 'task', 39, NULL, '2025-10-22 06:00:05', '2025-10-22 06:00:05'),
(7, 17, 'update', 'task', 39, '\"{\\\"title\\\":\\\"Updated Task\\\",\\\"description\\\":\\\"Updated description\\\",\\\"updated_at\\\":\\\"2025-10-22 09:00:23\\\"}\"', '2025-10-22 06:00:23', '2025-10-22 06:00:23'),
(8, 17, 'update', 'task', 39, '\"{\\\"status\\\":\\\"done\\\",\\\"priority\\\":\\\"high\\\",\\\"updated_at\\\":\\\"2025-10-22 09:00:36\\\"}\"', '2025-10-22 06:00:36', '2025-10-22 06:00:36'),
(9, 17, 'create', 'task', 40, NULL, '2025-10-22 06:08:50', '2025-10-22 06:08:50'),
(10, 17, 'create', 'task', 41, NULL, '2025-10-22 06:10:54', '2025-10-22 06:10:54'),
(11, 17, 'update', 'task', 41, '\"{\\\"title\\\":\\\"Updated Task\\\",\\\"description\\\":\\\"Updated description\\\",\\\"status\\\":\\\"done\\\",\\\"priority\\\":\\\"high\\\",\\\"updated_at\\\":\\\"2025-10-22 09:11:17\\\"}\"', '2025-10-22 06:11:17', '2025-10-22 06:11:17');

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
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
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_10_21_020442_create_tasks_table', 1),
(6, '2025_10_21_183221_create_audit_logs_table', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `personal_access_tokens`
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

--
-- إرجاع أو استيراد بيانات الجدول `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 17, 'api-token', '82f6f091d43bbb5b4e4f0a17ebbb40d3432ce6b89f643d76003a79b624eb5449', '[\"*\"]', NULL, NULL, '2025-10-22 05:32:32', '2025-10-22 05:32:32'),
(2, 'App\\Models\\User', 17, 'api-token', '8e58aa9bce02d296f090cbdf0b6d6d87ea0aa004507c2dd315fed63a8282b281', '[\"*\"]', NULL, NULL, '2025-10-22 05:36:33', '2025-10-22 05:36:33'),
(3, 'App\\Models\\User', 17, 'api-token', '5c40aab082f518c36c771f256fd06c196f82543a1e786130fa01eacde5e92a22', '[\"*\"]', '2025-10-22 05:39:55', NULL, '2025-10-22 05:39:21', '2025-10-22 05:39:55'),
(4, 'App\\Models\\User', 17, 'api-token', 'cf6c135fbbff509f7de071f360b497999269e9c97de25b4d01a6a8351ed32849', '[\"*\"]', '2025-10-22 05:49:18', NULL, '2025-10-22 05:47:20', '2025-10-22 05:49:18'),
(5, 'App\\Models\\User', 17, 'api-token', 'a42e3e421e382f13318afe2eac989809ddb8309b0c1271287f5ce03184142d5a', '[\"*\"]', '2025-10-22 05:54:00', NULL, '2025-10-22 05:51:19', '2025-10-22 05:54:00'),
(6, 'App\\Models\\User', 17, 'api-token', '77fe5202f12ce6af5105727a88c097e3cb7b6d2605bbd44e1a826d26a77c0698', '[\"*\"]', NULL, NULL, '2025-10-22 05:57:44', '2025-10-22 05:57:44'),
(7, 'App\\Models\\User', 17, 'api-token', '20806036ffb4fe491bcd3091e6739951d66dda43fb3a8ed4eb5fa28620c78a6f', '[\"*\"]', '2025-10-22 06:01:23', NULL, '2025-10-22 05:59:40', '2025-10-22 06:01:23'),
(8, 'App\\Models\\User', 17, 'api-token', '0a333ca15432a253001eaf34810b776d4ec6ca6dded8a3548c41ddba0bb5a50f', '[\"*\"]', NULL, NULL, '2025-10-22 06:07:09', '2025-10-22 06:07:09'),
(9, 'App\\Models\\User', 17, 'api-token', 'e9d0af538e28eb92e999731466c3eb57fea2ca3a750d1ca4813322b01b022252', '[\"*\"]', '2025-10-22 06:08:50', NULL, '2025-10-22 06:08:28', '2025-10-22 06:08:50'),
(10, 'App\\Models\\User', 17, 'api-token', 'db5d057a8f2e78dc3aed1fa3bdc9a1321917d1010b3a20c2cd5eadf600609b51', '[\"*\"]', '2025-10-22 06:12:24', NULL, '2025-10-22 06:10:24', '2025-10-22 06:12:24');

-- --------------------------------------------------------

--
-- بنية الجدول `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','in_progress','done') NOT NULL DEFAULT 'pending',
  `due_date` date NOT NULL,
  `priority` enum('low','medium','high') NOT NULL DEFAULT 'medium',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `status`, `due_date`, `priority`, `user_id`, `created_at`, `updated_at`) VALUES
(25, 'Distinctio est.', 'Ducimus molestiae corrupti in eaque vero enim neque est. Non est quam rerum eaque minus. Enim iusto praesentium at sunt quod in. Animi quia distinctio quo non ratione. Sequi consectetur at est ratione voluptate est nostrum.', 'pending', '2025-10-24', 'low', 15, '2025-10-22 04:52:58', '2025-10-22 04:52:58'),
(26, 'Autem non quam.', 'Qui recusandae voluptatem dolore praesentium doloribus maxime consequatur. Amet quo exercitationem dolores unde ad. Quasi sed esse exercitationem aspernatur veritatis hic.', 'pending', '2025-11-08', 'medium', 16, '2025-10-22 04:53:15', '2025-10-22 04:53:15'),
(27, 'Consequatur id tempore repudiandae.', 'Amet corporis quo nisi ab quia sapiente et. Eos fugiat at aspernatur similique harum. Quo eaque aut exercitationem. Sit quas fugiat est id blanditiis fugit.', 'pending', '2025-11-04', 'high', 16, '2025-10-22 04:53:15', '2025-10-22 04:53:15'),
(28, 'Harum minima harum explicabo.', 'Aperiam ut ad distinctio officiis ad ea architecto. Qui sunt illo optio suscipit corporis dolores. Magni perferendis pariatur cupiditate sed dolorum sint vel.', 'pending', '2025-11-17', 'low', 16, '2025-10-22 04:53:15', '2025-10-22 04:53:15'),
(29, 'Libero vero voluptas aut.', 'Tempore dicta voluptatem qui dolor eveniet. Est quisquam reprehenderit qui sunt. Fugit consequatur enim quia et sit qui quos. Qui et consequatur reprehenderit quos saepe.', 'pending', '2025-11-01', 'low', 16, '2025-10-22 04:53:15', '2025-10-22 04:53:15'),
(30, 'Facere temporibus sint sit.', 'Aut commodi laborum odit quis. Totam eos sit quibusdam fugit tempora vel quo. Quam atque ut aspernatur nulla. Explicabo illo exercitationem et incidunt rerum.', 'in_progress', '2025-11-01', 'high', 16, '2025-10-22 04:53:16', '2025-10-22 04:53:16'),
(31, 'Reprehenderit tempora ut qui.', 'Dolorem numquam ipsum vel aperiam odit. Aut cum libero ut dolorum temporibus. Magni nam qui quidem minus adipisci.', 'pending', '2025-11-09', 'high', 16, '2025-10-22 04:53:16', '2025-10-22 04:53:16'),
(32, 'Voluptas assumenda iste.', 'Laborum occaecati placeat aspernatur vel molestiae est. Aut sint et dicta. Rem maiores consequatur magnam distinctio repellendus provident magnam. Neque sunt illo error qui.', 'pending', '2025-11-11', 'high', 16, '2025-10-22 04:53:16', '2025-10-22 04:53:16'),
(33, 'Enim officia et.', 'Cum voluptate qui ipsa omnis fugiat dolores quos dignissimos. Qui ducimus magni vel aut omnis laboriosam qui.', 'done', '2025-11-14', 'medium', 16, '2025-10-22 04:53:16', '2025-10-22 04:53:16'),
(34, 'Labore neque dolores sapiente.', 'Corrupti odio tempora hic sapiente ea molestiae. Maxime sit eos voluptates fugiat amet vel. Laudantium odit culpa ratione sed a non. Qui doloremque molestiae tenetur.', 'in_progress', '2025-11-02', 'high', 16, '2025-10-22 04:53:16', '2025-10-22 04:53:16'),
(35, 'Et et sint qui.', 'Perferendis velit dolorem nostrum dolor sit earum sit. Illum qui eveniet unde sit.', 'pending', '2025-10-22', 'high', 16, '2025-10-22 04:53:16', '2025-10-22 04:53:16'),
(37, 'Updated Task', 'Updated description', 'pending', '2025-10-30', 'low', 17, '2025-10-22 05:47:50', '2025-10-22 05:48:11'),
(38, 'Updated Task', 'Updated description', 'done', '2025-10-30', 'high', 17, '2025-10-22 05:51:55', '2025-10-22 05:52:30'),
(39, 'Updated Task', 'Updated description', 'done', '2025-10-30', 'high', 17, '2025-10-22 06:00:05', '2025-10-22 06:00:36'),
(40, 'New Task', 'Task description', 'pending', '2025-10-30', 'low', 17, '2025-10-22 06:08:50', '2025-10-22 06:08:50'),
(41, 'Updated Task', 'Updated description', 'done', '2025-10-30', 'high', 17, '2025-10-22 06:10:54', '2025-10-22 06:11:17');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(13, 'Admin', 'emanzidanelgmal@gmail.com', NULL, '$2y$12$4mmb6WvlMLN5C9myldUjEO1hfQ/LaJ/fS4Gxr8X6bnkiqfgfESuHK', NULL, 'admin', '2025-10-22 04:52:49', '2025-10-22 04:52:49'),
(14, 'User', 'emanesmailzidan@gmail.com', NULL, '$2y$12$avpCtLpo8ETpCcZShOA0s.H6eF20bwzXjDEU35eMIt4pnp5F1yp92', NULL, 'user', '2025-10-22 04:52:49', '2025-10-22 04:52:49'),
(15, 'Leonor Witting MD', 'iabshire@example.net', '2025-10-22 04:52:58', '$2y$12$EIDSZW3dneGx4Io65ty2COn8QHrRBur/D7xKrBRDcJBlJ4.SIeneW', 'dPzJYwW5oH', 'user', '2025-10-22 04:52:58', '2025-10-22 04:52:58'),
(16, 'Wilber Lehner', 'xeichmann@example.net', '2025-10-22 04:53:15', '$2y$12$wBzJUTSe7h4Jd.mho3dl9eRsqOWL9OJzxPvElgNU8SaD1D6gZ764G', 'e3sbqv7xJR', 'user', '2025-10-22 04:53:15', '2025-10-22 04:53:15'),
(17, 'Eman Esmail', 'emanesmail@gmail.com', NULL, '$2y$12$4x9sxqgMNArZ4B44wVGtGeBLyYSwbH6dEcIldWBghqyEWhvTvwqge', NULL, 'admin', '2025-10-22 05:32:32', '2025-10-22 05:32:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_user_id_index` (`user_id`),
  ADD KEY `audit_logs_action_index` (`action`),
  ADD KEY `audit_logs_entity_index` (`entity`),
  ADD KEY `audit_logs_entity_id_index` (`entity_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_index` (`user_id`),
  ADD KEY `tasks_status_index` (`status`),
  ADD KEY `tasks_priority_index` (`priority`),
  ADD KEY `tasks_due_date_index` (`due_date`);
ALTER TABLE `tasks` ADD FULLTEXT KEY `tasks_title_description_fulltext` (`title`,`description`);

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
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- قيود الجداول `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
