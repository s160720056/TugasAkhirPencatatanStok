-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2026 at 06:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catatstok_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(191) NOT NULL,
  `STATUS_BARANG` enum('0','1','2') NOT NULL DEFAULT '0',
  `nama_barang` varchar(191) NOT NULL,
  `seri` varchar(191) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `STATUS_BARANG`, `nama_barang`, `seri`, `stok_awal`, `stok_akhir`, `tanggal_input`, `created_at`, `updated_at`) VALUES
(1, 'UM', '1', 'Ubi Merah', 'KK', 7, 8, '2026-05-07 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `history_transaksi`
--

CREATE TABLE `history_transaksi` (
  `id_history_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `aksi` enum('create','update','delete') NOT NULL,
  `nama_tabel` varchar(191) NOT NULL,
  `id_referensi` bigint(20) UNSIGNED NOT NULL,
  `before_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`before_data`)),
  `after_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`after_data`)),
  `ip_address` varchar(191) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `tanggal_history` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_transaksi`
--

INSERT INTO `history_transaksi` (`id_history_transaksi`, `id_user`, `aksi`, `nama_tabel`, `id_referensi`, `before_data`, `after_data`, `ip_address`, `user_agent`, `tanggal_history`, `created_at`, `updated_at`) VALUES
(1, 1, 'update', 'transaksi', 1, '{\"id_transaksi\":1,\"id_barang\":1,\"tipe_transaksi\":\"keluar\",\"jumlah_barang\":4,\"keterangan_transaksi\":\"a\",\"diberikan_oleh\":\"b\",\"keperluan_transaksi\":\"c\",\"tanggal_transaksi\":\"2026-05-09\",\"created_at\":null,\"updated_at\":null,\"deleted_at\":null}', '{\"id_transaksi\":1,\"id_barang\":1,\"tipe_transaksi\":\"keluar\",\"jumlah_barang\":4,\"keterangan_transaksi\":\"a\",\"diberikan_oleh\":\"b\",\"keperluan_transaksi\":\"c\",\"tanggal_transaksi\":\"2026-05-09\",\"created_at\":null,\"updated_at\":null,\"deleted_at\":null}', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-05-09 04:05:00', '2026-05-09 04:05:00', '2026-05-09 04:05:00'),
(2, 1, 'update', 'transaksi', 2, '{\"id_transaksi\":2,\"id_barang\":1,\"tipe_transaksi\":\"keluar\",\"jumlah_barang\":1,\"keterangan_transaksi\":\"ff\",\"diberikan_oleh\":\"3f\",\"keperluan_transaksi\":\"wffw\",\"tanggal_transaksi\":\"2026-05-09\",\"created_at\":null,\"updated_at\":null,\"deleted_at\":null}', '{\"id_transaksi\":2,\"id_barang\":1,\"tipe_transaksi\":\"keluar\",\"jumlah_barang\":1,\"keterangan_transaksi\":\"ff\",\"diberikan_oleh\":\"3f\",\"keperluan_transaksi\":\"wffw\",\"tanggal_transaksi\":\"2026-05-09\",\"created_at\":null,\"updated_at\":null,\"deleted_at\":null}', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-05-09 04:17:17', '2026-05-09 04:17:17', '2026-05-09 04:17:17'),
(3, 1, 'update', 'transaksi', 2, '{\"id_transaksi\":2,\"id_barang\":1,\"tipe_transaksi\":\"keluar\",\"jumlah_barang\":1,\"keterangan_transaksi\":\"ff\",\"diberikan_oleh\":\"3f\",\"keperluan_transaksi\":\"wffw\",\"tanggal_transaksi\":\"2026-05-09\",\"created_at\":null,\"updated_at\":null,\"deleted_at\":null}', '{\"id_transaksi\":2,\"id_barang\":1,\"tipe_transaksi\":\"keluar\",\"jumlah_barang\":1,\"keterangan_transaksi\":\"ff\",\"diberikan_oleh\":\"3f\",\"keperluan_transaksi\":\"wffw\",\"tanggal_transaksi\":\"2026-05-09\",\"created_at\":null,\"updated_at\":null,\"deleted_at\":null}', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-05-09 04:17:20', '2026-05-09 04:17:20', '2026-05-09 04:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `tipe_transaksi` enum('keluar','masuk') NOT NULL DEFAULT 'keluar',
  `jumlah_barang` int(11) NOT NULL,
  `keterangan_transaksi` varchar(191) DEFAULT NULL,
  `diberikan_oleh` varchar(191) DEFAULT NULL,
  `keperluan_transaksi` varchar(191) DEFAULT NULL,
  `tanggal_transaksi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_barang`, `tipe_transaksi`, `jumlah_barang`, `keterangan_transaksi`, `diberikan_oleh`, `keperluan_transaksi`, `tanggal_transaksi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'keluar', 4, 'a', 'b', 'c', '2026-05-09', NULL, NULL, NULL),
(2, 1, 'keluar', 1, 'ff', '3f', 'wffw', '2026-05-09', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `history_transaksi`
--
ALTER TABLE `history_transaksi`
  ADD PRIMARY KEY (`id_history_transaksi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history_transaksi`
--
ALTER TABLE `history_transaksi`
  MODIFY `id_history_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
