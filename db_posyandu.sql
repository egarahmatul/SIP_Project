-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 08:23 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_posyandu`
--

-- --------------------------------------------------------

--
-- Table structure for table `balita`
--

CREATE TABLE `balita` (
  `id_balita` int(11) NOT NULL,
  `nama_balita` varchar(255) DEFAULT NULL,
  `usia_balita` int(11) DEFAULT NULL,
  `jenis_kelamin_balita` varchar(255) DEFAULT NULL,
  `tanggal_lahir_balita` date DEFAULT NULL,
  `tempat_lahir_balita` varchar(255) DEFAULT NULL,
  `pb_balita` int(11) DEFAULT NULL,
  `bb_balita` int(11) DEFAULT NULL,
  `id_users` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `balita`
--

INSERT INTO `balita` (`id_balita`, `nama_balita`, `usia_balita`, `jenis_kelamin_balita`, `tanggal_lahir_balita`, `tempat_lahir_balita`, `pb_balita`, `bb_balita`, `id_users`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(9, 'sdfds', 3, 'laki-laki', '2024-04-29', 'sadsad', 3, 23, 29, '2024-05-12 07:31:52', 9, '2024-05-12 07:31:52', 9),
(11, 'b df df dffdgdfg', 12, 'perempuan', '2024-05-13', 'dsdf', 2, 4, 31, '2024-05-12 08:44:37', 9, '2024-05-12 08:44:37', 9),
(12, 'fdbfdb', 12, 'laki-laki', '2024-05-21', 'ddfsad', 33, 23, 29, '2024-05-21 07:16:50', 9, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `jam_buka` time DEFAULT NULL,
  `jam_tutup` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `jam_buka`, `jam_tutup`, `tanggal`, `keterangan`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '14:21:00', '18:21:00', '2024-05-13', 'fgdgfdgd', 9, '2024-05-12 07:25:02', 9, '2024-05-12 07:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `id_pemeriksaan` int(11) NOT NULL,
  `tanggal_pemeriksaan` date DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `lingkar_kepala` int(11) DEFAULT NULL,
  `berat_badan` int(11) DEFAULT NULL,
  `tinggi_badan` int(11) DEFAULT NULL,
  `cara_ukur` varchar(255) DEFAULT NULL,
  `imunisasi` varchar(255) DEFAULT NULL,
  `vitamin` varchar(255) DEFAULT NULL,
  `obat_cacing` varchar(255) DEFAULT NULL,
  `status_gizi` varchar(255) DEFAULT NULL,
  `saran` varchar(255) DEFAULT NULL,
  `id_balita` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`id_pemeriksaan`, `tanggal_pemeriksaan`, `umur`, `lingkar_kepala`, `berat_badan`, `tinggi_badan`, `cara_ukur`, `imunisasi`, `vitamin`, `obat_cacing`, `status_gizi`, `saran`, `id_balita`, `created_by`, `created_at`, `updated_at`, `updated_by`) VALUES
(2, '2024-06-01', 1, 12, 32, 32, 'sdfdsf', 'sdfs', 'C', 'sdfsdf', 'Gizi Baik', 'tews', 9, 9, '2024-05-21 14:52:08', '2024-05-21 14:52:08', 9),
(3, '2024-05-14', NULL, 12, 3, 3, 'xvx', 'vxcv', 'D', 'xczxc', 'Gizi Buruk', 'bfdbdfbf', 11, 9, '2024-05-13 20:18:12', NULL, NULL),
(4, '2024-05-14', 2, 23, 12, 34, 'dsfsd', 'sfds', 'D', 'sdfsdf', 'Gizi Baik', 'sdfsdfds', 9, 9, '2024-05-21 14:52:14', '2024-05-21 14:52:14', 9),
(5, '2024-05-21', 3, 23, 32, 23, 'test', 'tes', 'C', 'sdfsd', 'Gizi Baik', 'sdfsd', 9, 9, '2024-05-21 14:52:20', '2024-05-21 14:52:20', 9),
(6, '2024-05-14', 4, 12, 32, 23, 'fsd', 'dfss', 'sdf', 'sdf', 'Gizi Baik', 'sdfsf', 9, 9, '2024-05-21 07:51:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `aktiv` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hak_akses` enum('bidan','petugas','admin','orangtua') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `jenis_kelamin`, `tgl_lahir`, `aktiv`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `alamat`, `hak_akses`) VALUES
(9, 'admin', 'admin@gmail.com', '37492379', 'laki-laki', '2024-05-09', 1, NULL, '$2y$10$8EWuey2fbQryE6HRev96CeauUpIoTqSsjYCc/DrhKkS26v3Fyatm2', NULL, '2022-12-08 16:53:00', '2024-05-02 08:44:43', 'adminasdsadasd', 'admin'),
(27, 'bidan', 'bidan@gmail.com', '329492348', 'laki-laki', '2024-05-02', 1, NULL, '$2y$10$.sHWt4SDUkT4T4AxueYS.e7QKS8pb/jFC3GbqWBoM/DvTa6/XIpSa', NULL, '2024-05-02 08:47:31', NULL, 'bidan', 'bidan'),
(28, 'petugas1', 'petugas@gmail.com', '83274239', 'laki-laki', '2024-05-03', 1, NULL, '$2y$10$TDo84kdhj3z3Qys8ya4LgOIxF91WYlbu7S9UQYfpVmu4jqiphWM6S', NULL, '2024-05-02 08:50:02', '2024-05-14 03:43:14', 'petugas', 'petugas'),
(29, 'orangtua', 'orangtua@gmail.com', '9324243209', 'laki-laki', '2024-05-16', 1, NULL, '$2y$10$jw4Lme7TcKCh/3R2CgUsUuCFAmMiLPxQbh9MR6od3pzqQ9y93y3jO', NULL, '2024-05-02 08:52:52', NULL, 'test', 'orangtua'),
(31, 'dfdsfdsfdsf', 'dsfdsfsd@gmail.com', '85912628', 'laki-laki', '2024-05-10', 1, NULL, '$2y$10$uUrU3RGFGWZhXPJkNqEIuOtcsZAVZ.SaHlj/OhQRBprOpPp08hrHe', NULL, '2024-05-12 08:44:21', NULL, 'fdsfds', 'orangtua');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balita`
--
ALTER TABLE `balita`
  ADD PRIMARY KEY (`id_balita`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`id_pemeriksaan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balita`
--
ALTER TABLE `balita`
  MODIFY `id_balita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `id_pemeriksaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
