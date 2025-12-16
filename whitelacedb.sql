-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2025 at 01:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `whitelacedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'api-token', '2229066f59fa9f9dfc2b6ff64c8eb08784c8f7230099f489ee1a4d031cce414a', '[\"*\"]', '2025-12-14 21:01:33', NULL, '2025-12-14 20:28:11', '2025-12-14 21:01:33'),
(2, 'App\\Models\\User', 3, 'api', '03b0c7b39d62eb39266fea73bc07022bbbb8abb32543f4de1519d8e926f77f3a', '[\"*\"]', NULL, NULL, '2025-12-15 16:56:13', '2025-12-15 16:56:13'),
(3, 'App\\Models\\User', 4, 'api', 'beb754a0456eb3e38c4b56fd89948aa8a29170a75f45899a38aac46d298f7d21', '[\"*\"]', NULL, NULL, '2025-12-15 20:58:44', '2025-12-15 20:58:44'),
(4, 'App\\Models\\User', 4, 'api', 'f4a516a3d4ff2fd697c33b4990dfbf0246410e7d47cdeb8a25de9a189d2888fa', '[\"*\"]', NULL, NULL, '2025-12-15 21:25:34', '2025-12-15 21:25:34'),
(5, 'App\\Models\\User', 4, 'api', 'fee8d13094c62bf0e9c71eb57b999fafe2c34a9e09c5c26193a92ae224a8b834', '[\"*\"]', NULL, NULL, '2025-12-15 22:21:04', '2025-12-15 22:21:04'),
(6, 'App\\Models\\User', 4, 'api', 'f22e98fec3586d7df5d8e63ee726bf5ec5f149133f8d7b19046dd32ee9575915', '[\"*\"]', NULL, NULL, '2025-12-15 22:25:55', '2025-12-15 22:25:55'),
(7, 'App\\Models\\User', 4, 'api', '697d5e11692f68cc19bbdfd597b6a574c7211fb9c0679a01ca3ba0e911665daf', '[\"*\"]', NULL, NULL, '2025-12-15 22:45:01', '2025-12-15 22:45:01'),
(8, 'App\\Models\\User', 4, 'api', 'fe079b42ece5d2a1ba3f859638c5bb5ec6361a0a03ae05155e68f6e6234061f7', '[\"*\"]', NULL, NULL, '2025-12-15 22:59:00', '2025-12-15 22:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `table_assignments`
--

CREATE TABLE `table_assignments` (
  `id` int(11) NOT NULL,
  `wedding_member_id` int(11) NOT NULL,
  `wedding_table_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `wedding_id` int(11) NOT NULL,
  `created_by_user_id` int(11) NOT NULL,
  `assigned_to_user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','in_progress','completed') DEFAULT 'pending',
  `priority` enum('low','medium','high') DEFAULT 'medium',
  `due_date` date DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'User', 'admin@example.com', '$2y$10$EixZaYVK1fsbw1ZfbX3OXePaWxn96p36Zh/J1X1P2E9sRZx2B5vGy', '2025-12-14 20:59:37', '2025-12-14 20:59:37', 'admin'),
(2, 'Juan', 'Pérez', 'juan@example.com', '$2y$12$2LNzLEq1C/baBo3V1d4hmejqFoXVBsnLGtZPdNg/MGjlrg4tmiOJa', '2025-12-14 20:46:23', '2025-12-14 20:46:23', 'user'),
(4, 'Raul', 'Perez', 'raul@email.com', '$2y$12$VuLTk1NM1.eEpwmDExw1/.RVHxa2BnI7bXiQjAjB4kEuKdXX4REm2', '2025-12-15 20:58:43', '2025-12-15 20:58:43', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `weddings`
--

CREATE TABLE `weddings` (
  `id` int(11) NOT NULL,
  `wedding_date` date DEFAULT NULL,
  `venue_name` varchar(255) DEFAULT NULL,
  `venue_address` text DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `dress_code` varchar(100) DEFAULT NULL,
  `dress_code_details` text DEFAULT NULL,
  `are_kids_allowed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wedding_members`
--

CREATE TABLE `wedding_members` (
  `id` int(11) NOT NULL,
  `wedding_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` enum('couple','collaborator','guest') NOT NULL,
  `status` enum('pending','confirmed','declined') DEFAULT 'pending',
  `dietary_restrictions` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wedding_photos`
--

CREATE TABLE `wedding_photos` (
  `id` int(11) NOT NULL,
  `wedding_id` int(11) NOT NULL,
  `uploaded_by_user_id` int(11) NOT NULL,
  `url` varchar(500) NOT NULL,
  `caption` text DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wedding_tables`
--

CREATE TABLE `wedding_tables` (
  `id` int(11) NOT NULL,
  `wedding_id` int(11) NOT NULL,
  `table_number` int(11) NOT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  `max_capacity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `table_assignments`
--
ALTER TABLE `table_assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_member_assignment` (`wedding_member_id`),
  ADD KEY `wedding_table_id` (`wedding_table_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by_user_id` (`created_by_user_id`),
  ADD KEY `assigned_to_user_id` (`assigned_to_user_id`),
  ADD KEY `idx_tasks_wedding` (`wedding_id`),
  ADD KEY `idx_tasks_status` (`status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `weddings`
--
ALTER TABLE `weddings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wedding_members`
--
ALTER TABLE `wedding_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_wedding_user` (`wedding_id`,`user_id`),
  ADD KEY `idx_wedding_members_wedding` (`wedding_id`),
  ADD KEY `idx_wedding_members_user` (`user_id`),
  ADD KEY `idx_wedding_members_role` (`role`);

--
-- Indexes for table `wedding_photos`
--
ALTER TABLE `wedding_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploaded_by_user_id` (`uploaded_by_user_id`),
  ADD KEY `idx_wedding_photos_wedding` (`wedding_id`);

--
-- Indexes for table `wedding_tables`
--
ALTER TABLE `wedding_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_wedding_tables_wedding` (`wedding_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `table_assignments`
--
ALTER TABLE `table_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `weddings`
--
ALTER TABLE `weddings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wedding_members`
--
ALTER TABLE `wedding_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wedding_photos`
--
ALTER TABLE `wedding_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wedding_tables`
--
ALTER TABLE `wedding_tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table_assignments`
--
ALTER TABLE `table_assignments`
  ADD CONSTRAINT `table_assignments_ibfk_1` FOREIGN KEY (`wedding_member_id`) REFERENCES `wedding_members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `table_assignments_ibfk_2` FOREIGN KEY (`wedding_table_id`) REFERENCES `wedding_tables` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`wedding_id`) REFERENCES `weddings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`created_by_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`assigned_to_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `wedding_members`
--
ALTER TABLE `wedding_members`
  ADD CONSTRAINT `wedding_members_ibfk_1` FOREIGN KEY (`wedding_id`) REFERENCES `weddings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wedding_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wedding_photos`
--
ALTER TABLE `wedding_photos`
  ADD CONSTRAINT `wedding_photos_ibfk_1` FOREIGN KEY (`wedding_id`) REFERENCES `weddings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wedding_photos_ibfk_2` FOREIGN KEY (`uploaded_by_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wedding_tables`
--
ALTER TABLE `wedding_tables`
  ADD CONSTRAINT `wedding_tables_ibfk_1` FOREIGN KEY (`wedding_id`) REFERENCES `weddings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
