-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2024 at 07:32 PM
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
-- Database: `presensi_gpss`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` char(5) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `kode_kelas` varchar(4) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nik`, `nama_lengkap`, `jabatan`, `no_hp`, `foto`, `kode_kelas`, `password`, `remember_token`) VALUES
('12345', 'Firma Zulfia Zulfia', '10I', '12345678901', '', '10I', '$2y$12$acvKGck2UoX0tbabFoG.8O7nRUkVGluywmhCutTxPqoiuHhX2J/sa', NULL),
('12346', 'Shinta Putri Ra', '10B', '089712341234', '', '10B', '$2y$12$H0bepqiLl/83YNr9YrTrJOStWQZdqk.rL2zkWEH2MjxdHkbWKIF6a', NULL),
('12347', 'Jihan Cindaga', '10A', '088888888888', '', '10A', '$2y$12$H0bepqiLl/83YNr9YrTrJOStWQZdqk.rL2zkWEH2MjxdHkbWKIF6a', NULL),
('12348', 'Descha Livia', '10B', '089712341235', '', '10B', '$2y$12$H0bepqiLl/83YNr9YrTrJOStWQZdqk.rL2zkWEH2MjxdHkbWKIF6a', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kode_kelas` varchar(10) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `nama_kelas`) VALUES
('10A', 'Kelas 10 A'),
('10B', 'Kelas 10 B'),
('10C', 'Kelas 10 C'),
('10D', 'Kelas 10 D'),
('10E', 'Kelas 10 E'),
('10F', 'Kelas 10 F'),
('10G', 'Kelas 10G'),
('10H', 'Kelas 10H'),
('10I', 'Kelas 10I'),
('11A', 'Kelas 11A'),
('11B', 'Kelas 11B'),
('11C', 'Kelas 11C'),
('11D', 'Kelas 11D'),
('11E', 'Kelas 11E'),
('11F', 'Kelas 11F'),
('11G', 'Kelas 11G'),
('11H', 'Kelas 11H'),
('11I', 'Kelas 11I'),
('12A', 'Kelas 12A'),
('12B', 'Kelas 12B'),
('12C', 'Kelas 12C'),
('12D', 'Kelas 12D'),
('12E', 'Kelas 12E'),
('12F', 'Kelas 12F'),
('12G', 'Kelas 12G'),
('12H', 'Kelas 12H'),
('12I', 'Kelas 12I');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

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
-- Table structure for table `pengajuan_izin`
--

CREATE TABLE `pengajuan_izin` (
  `id` int(11) NOT NULL,
  `nik` char(5) DEFAULT NULL,
  `tgl_izin` date DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status_approved` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_izin`
--

INSERT INTO `pengajuan_izin` (`id`, `nik`, `tgl_izin`, `status`, `keterangan`, `status_approved`) VALUES
(1, '12345', '2024-10-04', 'i', 'kenguk', '0'),
(2, '12345', '2024-10-04', 'i', 'kenguk', '0'),
(3, '12345', '2024-10-04', 'i', 'jenguk', '0'),
(4, '12345', '2024-10-06', 's', 'batuk', '0'),
(5, '12346', '2024-10-06', 'i', 'hkj', '1'),
(6, '12346', '2024-10-06', 'i', 'ghj', '0'),
(7, '12346', '2024-10-07', 's', 'hati', '2'),
(8, '12346', '2024-10-12', 'i', 'acara keluarga', '0'),
(9, '12346', '2024-10-21', 'i', 'sakitt', '1');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `nik` char(5) NOT NULL,
  `tgl_presensi` date NOT NULL,
  `jam_in` time NOT NULL,
  `jam_out` time DEFAULT NULL,
  `foto_in` varchar(255) NOT NULL,
  `foto_out` varchar(255) DEFAULT NULL,
  `lokasi_in` text NOT NULL,
  `lokasi_out` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id`, `nik`, `tgl_presensi`, `jam_in`, `jam_out`, `foto_in`, `foto_out`, `lokasi_in`, `lokasi_out`) VALUES
(24, '12345', '2024-09-25', '15:34:25', '22:00:20', '12345-2024-09-25-in.png', '12345-2024-09-25-out.png', '-7.5754887,110.8243272', '-7.5754887,110.8243272'),
(25, '12345', '2024-10-01', '06:40:51', '13:57:03', '12345-2024-10-01-in.png', '12345-2024-10-01-out.png', '-7.8944852,110.337975', '-7.8944109,110.3379368'),
(26, '12346', '2024-10-01', '10:54:14', '12:12:08', '12346-2024-10-01-in.png', '12346-2024-10-01-out.png', '-7.8965615,110.3398296', '-7.8965615,110.3398296'),
(27, '12345', '2024-10-04', '09:52:37', NULL, '12345-2024-10-04-in.png', NULL, '-7.894403,110.3379336', NULL),
(29, '12346', '2024-10-11', '10:00:18', '10:00:35', '12346-2024-10-11-in.png', '12346-2024-10-11-out.png', '-7.894412,110.3379308', '-7.8944178,110.337927'),
(30, '12346', '2024-10-17', '17:29:38', '17:29:51', '12346-2024-10-17-in.png', '12346-2024-10-17-out.png', '-7.8944067,110.3379461', '-7.8944067,110.3379461');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Lhhbi3DcADsmlECbDHFkhf0ofCE72O5gIWgFsuIM', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTEtpQTR4bWFTenIxMEFyQWQxdkduWUdIckZpWGxiOURtMGRTb3l5YyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaXN3YT9rZWxhcz0mbmFtYV9zaXN3YT1wdXRyaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTE6ImxvZ2luX3VzZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO319', 1729618139);

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
(1, 'Shinta Putri R', 'shintapr131103@gmail.com', NULL, '$2y$12$acvKGck2UoX0tbabFoG.8O7nRUkVGluywmhCutTxPqoiuHhX2J/sa', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`);

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
-- Indexes for table `pengajuan_izin`
--
ALTER TABLE `pengajuan_izin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengajuan_izin`
--
ALTER TABLE `pengajuan_izin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
