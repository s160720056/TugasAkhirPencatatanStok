-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2024 at 02:36 PM
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
-- Database: `TAFernando`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `tgl_masuk` datetime DEFAULT NULL,
  `tgl_keluar` datetime DEFAULT NULL,
  `STATUS_ABSENSI` enum('0','1','2') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_user`, `id_toko`, `tgl_masuk`, `tgl_keluar`, `STATUS_ABSENSI`) VALUES
(20, 1, 0, '2024-09-12 21:40:51', '2024-09-12 21:41:41', '2'),
(21, 1, 0, '2024-09-19 10:53:18', NULL, '1'),
(22, 27, 0, '2024-09-30 14:52:36', '2024-09-30 15:00:07', '2'),
(23, 29, 2, '2024-10-01 08:20:00', '2024-10-01 18:00:00', '2'),
(24, 29, 2, '2024-10-02 08:00:00', '2024-10-02 18:00:00', '2'),
(25, 29, 2, '2024-10-03 08:00:00', '2024-10-03 18:00:00', '2'),
(26, 29, 2, '2024-10-04 08:00:00', '2024-10-04 18:00:00', '2'),
(27, 29, 2, '2024-10-05 08:00:00', '2024-10-05 18:00:00', '2'),
(28, 29, 2, '2024-10-07 08:00:00', '2024-10-07 18:00:00', '2'),
(29, 29, 2, '2024-10-08 08:00:00', '2024-10-08 18:00:00', '2'),
(30, 29, 2, '2024-10-09 08:00:00', '2024-10-09 18:00:00', '2'),
(31, 29, 2, '2024-10-10 08:00:00', '2024-10-10 18:00:00', '2'),
(32, 29, 2, '2024-10-11 08:00:00', '2024-10-11 18:00:00', '2'),
(33, 29, 2, '2024-10-12 08:00:00', '2024-10-12 18:00:00', '2'),
(34, 29, 2, '2024-10-14 08:00:00', '2024-10-14 18:00:00', '2'),
(35, 29, 2, '2024-10-15 08:00:00', '2024-10-15 18:00:00', '2'),
(36, 29, 2, '2024-10-16 08:00:00', '2024-10-16 18:00:00', '2'),
(37, 29, 2, '2024-10-17 08:00:00', '2024-10-17 18:00:00', '2'),
(38, 29, 2, '2024-10-18 08:00:00', '2024-10-18 18:00:00', '2'),
(39, 29, 2, '2024-10-19 08:00:00', '2024-10-19 18:00:00', '2'),
(40, 29, 2, '2024-10-21 08:00:00', '2024-10-21 18:00:00', '2'),
(41, 29, 2, '2024-10-22 08:00:00', '2024-10-22 18:00:00', '2'),
(42, 29, 2, '2024-10-23 08:00:00', '2024-10-23 18:00:00', '2'),
(43, 29, 2, '2024-10-24 08:00:00', '2024-10-24 18:00:00', '2'),
(44, 29, 2, '2024-10-25 08:00:00', '2024-10-25 18:00:00', '2'),
(45, 29, 2, '2024-10-26 08:00:00', '2024-10-26 18:00:00', '2'),
(46, 29, 2, '2024-10-28 08:00:00', '2024-10-28 18:00:00', '2'),
(47, 29, 2, '2024-10-29 08:00:00', '2024-10-29 18:00:00', '2'),
(48, 29, 2, '2024-10-30 08:00:00', '2024-10-30 18:00:00', '2'),
(49, 30, 9, '2024-11-01 08:00:00', '2024-11-01 17:00:00', '1'),
(50, 30, 9, '2024-11-02 08:00:00', '2024-11-02 17:00:00', '1'),
(51, 30, 9, '2024-11-04 08:00:00', '2024-11-04 17:00:00', '1'),
(52, 30, 9, '2024-11-05 08:00:00', '2024-11-05 17:00:00', '1'),
(53, 30, 9, '2024-11-06 08:00:00', '2024-11-06 17:00:00', '1'),
(54, 30, 9, '2024-11-07 08:00:00', '2024-11-07 17:00:00', '1'),
(55, 30, 9, '2024-11-08 08:00:00', '2024-11-08 17:00:00', '1'),
(56, 30, 9, '2024-11-09 08:00:00', '2024-11-09 17:00:00', '1'),
(57, 30, 9, '2024-11-11 08:00:00', '2024-11-11 17:00:00', '1'),
(58, 30, 9, '2024-11-12 08:00:00', '2024-11-12 17:00:00', '1'),
(59, 30, 9, '2024-11-13 08:00:00', '2024-11-13 17:00:00', '1'),
(60, 30, 9, '2024-11-14 08:00:00', '2024-11-14 17:00:00', '1'),
(61, 30, 9, '2024-11-15 08:00:00', '2024-11-15 17:00:00', '1'),
(62, 30, 9, '2024-11-16 08:00:00', '2024-11-16 17:00:00', '1'),
(63, 30, 9, '2024-11-18 08:00:00', '2024-11-18 17:00:00', '1'),
(64, 30, 9, '2024-11-19 08:00:00', '2024-11-19 17:00:00', '1'),
(65, 30, 9, '2024-11-20 08:00:00', '2024-11-20 17:00:00', '1'),
(66, 30, 9, '2024-11-21 08:00:00', '2024-11-21 17:00:00', '1'),
(67, 30, 9, '2024-11-22 08:00:00', '2024-11-22 17:00:00', '1'),
(68, 30, 9, '2024-11-23 08:00:00', '2024-11-23 17:00:00', '1'),
(69, 30, 9, '2024-11-25 08:00:00', '2024-11-25 17:00:00', '1'),
(70, 30, 9, '2024-11-26 08:00:00', '2024-11-26 17:00:00', '1'),
(71, 30, 9, '2024-11-27 08:00:00', '2024-11-27 17:00:00', '1'),
(72, 30, 9, '2024-11-28 08:00:00', '2024-11-28 17:00:00', '1'),
(73, 30, 9, '2024-11-29 08:00:00', '2024-11-29 17:00:00', '1'),
(74, 30, 9, '2024-11-30 08:00:00', '2024-11-30 17:00:00', '1'),
(75, 30, 9, '2024-10-01 08:00:00', '2024-10-01 17:00:00', '1'),
(76, 30, 9, '2024-10-02 08:00:00', '2024-10-02 17:00:00', '1'),
(77, 30, 9, '2024-10-03 08:00:00', '2024-10-03 17:00:00', '1'),
(78, 30, 9, '2024-10-04 08:00:00', '2024-10-04 17:00:00', '1'),
(79, 30, 9, '2024-10-05 08:00:00', '2024-10-05 17:00:00', '1'),
(80, 30, 9, '2024-10-07 08:00:00', '2024-10-07 17:00:00', '1'),
(81, 30, 9, '2024-10-08 08:00:00', '2024-10-08 17:00:00', '1'),
(82, 30, 9, '2024-10-09 08:00:00', '2024-10-09 17:00:00', '1'),
(83, 30, 9, '2024-10-10 08:00:00', '2024-10-10 17:00:00', '1'),
(84, 30, 9, '2024-10-11 08:00:00', '2024-10-11 17:00:00', '1'),
(85, 30, 9, '2024-10-12 08:00:00', '2024-10-12 17:00:00', '1'),
(86, 30, 9, '2024-10-14 08:00:00', '2024-10-14 17:00:00', '1'),
(87, 30, 9, '2024-10-15 08:00:00', '2024-10-15 17:00:00', '1'),
(88, 30, 9, '2024-10-16 08:00:00', '2024-10-16 17:00:00', '1'),
(89, 30, 9, '2024-10-17 08:00:00', '2024-10-17 17:00:00', '1'),
(90, 30, 9, '2024-10-18 08:00:00', '2024-10-18 17:00:00', '1'),
(91, 30, 9, '2024-10-19 08:00:00', '2024-10-19 17:00:00', '1'),
(92, 30, 9, '2024-10-21 08:00:00', '2024-10-21 17:00:00', '1'),
(93, 30, 9, '2024-10-22 08:00:00', '2024-10-22 17:00:00', '1'),
(94, 30, 9, '2024-10-23 08:00:00', '2024-10-23 17:00:00', '1'),
(95, 30, 9, '2024-10-24 08:00:00', '2024-10-24 17:00:00', '1'),
(96, 30, 9, '2024-10-25 08:00:00', '2024-10-25 17:00:00', '1'),
(97, 30, 9, '2024-10-26 08:00:00', '2024-10-26 17:00:00', '1'),
(98, 30, 9, '2024-10-28 08:00:00', '2024-10-28 17:00:00', '1'),
(99, 30, 9, '2024-10-29 08:00:00', '2024-10-29 17:00:00', '1'),
(100, 30, 9, '2024-10-30 08:00:00', '2024-10-30 17:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(45) NOT NULL,
  `merk` varchar(45) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` varchar(45) NOT NULL,
  `stok` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `STATUS_BARANG` enum('0','1','2') NOT NULL,
  `id_satuan` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `merk`, `harga_beli`, `harga_jual`, `stok`, `tgl_input`, `tgl_update`, `id_kategori`, `id_toko`, `STATUS_BARANG`, `id_satuan`) VALUES
(1, 'SV0001', 'Samsung Galaxy S21j', 'Samsung', 6000000, '7000000', 10399, '2024-06-01 10:00:00', '2024-11-11 12:38:18', 27, 2, '1', 6);

-- --------------------------------------------------------

--
-- Table structure for table `barang_has_supplier`
--

CREATE TABLE `barang_has_supplier` (
  `id_barang` int(10) UNSIGNED NOT NULL,
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `harga_barang_supplier` int(11) NOT NULL,
  `idBarangSupplier` bigint(20) UNSIGNED NOT NULL,
  `id_satuan` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah_item_per_satuan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(10) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `nama_customer` varchar(45) NOT NULL,
  `noHP` varchar(12) NOT NULL,
  `alamat` varchar(45) NOT NULL,
  `poin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_customer` enum('customer','member') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `id_toko`, `nama_customer`, `noHP`, `alamat`, `poin`, `created_at`, `updated_at`, `status_customer`) VALUES
(1, 0, 'Fernando Wilim', '081998052185', 'JL. Wisma Tirta', 0, NULL, NULL, 'customer'),
(3, 0, 'titi', '33333333', 'dhdhfhdhd', 430, NULL, NULL, 'customer'),
(4, 0, 'Andreas', '08563437100', 'JL rumah', 0, NULL, NULL, 'customer'),
(5, 0, 'a', '081998052185', 'a', 0, NULL, NULL, 'customer'),
(6, 0, 'e', 'e', 'e', 20, NULL, NULL, 'customer'),
(7, 0, 'f', 'f', 'f', 20, NULL, NULL, 'customer'),
(8, 0, 'abcdef', '0928039', 'afnjan', 0, '2024-09-18 21:15:35', '2024-09-18 21:15:35', 'customer'),
(9, 2, 'sdgags', '11111111', 'sefgsrf', 1118482, '2024-10-29 10:29:21', '2024-11-05 10:11:56', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id_diskon` bigint(20) UNSIGNED NOT NULL,
  `id_toko` int(11) NOT NULL,
  `nama_diskon` varchar(191) NOT NULL,
  `jenis_diskon` enum('persentase','nominal') NOT NULL,
  `nilai_diskon` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_diskon` enum('aktif','tidak aktif') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jumlah_item_minimum` int(11) DEFAULT NULL,
  `minimum_pembelian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`id_diskon`, `id_toko`, `nama_diskon`, `jenis_diskon`, `nilai_diskon`, `tanggal_mulai`, `tanggal_selesai`, `status_diskon`, `created_at`, `updated_at`, `jumlah_item_minimum`, `minimum_pembelian`) VALUES
(4, 2, 'diskon1', 'persentase', 10, '2024-11-10', '2024-11-13', 'aktif', NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diskon_has_barang`
--

CREATE TABLE `diskon_has_barang` (
  `id_diskon_has_barang` bigint(20) UNSIGNED NOT NULL,
  `id_diskon` bigint(20) UNSIGNED NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diskon_has_barang`
--

INSERT INTO `diskon_has_barang` (`id_diskon_has_barang`, `id_diskon`, `id_barang`, `created_at`, `updated_at`) VALUES
(31, 4, 1, NULL, NULL);

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
-- Table structure for table `gaji_pegawai`
--

CREATE TABLE `gaji_pegawai` (
  `id_gaji_pegawai` int(10) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `nama_gaji_pegawai` varchar(45) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `file_excel` varchar(191) DEFAULT NULL,
  `status_gaji_pegawai` enum('0','1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaji_pegawai`
--

INSERT INTO `gaji_pegawai` (`id_gaji_pegawai`, `id_toko`, `nama_gaji_pegawai`, `periode_awal`, `periode_akhir`, `file_excel`, `status_gaji_pegawai`, `created_at`, `updated_at`) VALUES
(19, 9, 'Nama Gaji Pegawai November 2024', '2024-10-01', '2024-11-30', NULL, '0', NULL, NULL),
(21, 9, 'Nama Gaji Pegawai November 2024', '2024-11-01', '2024-11-30', NULL, '0', NULL, NULL),
(23, 2, 'Nama Gaji Pegawai November 2024', '2024-10-01', '2024-11-30', NULL, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gaji_pegawai_detail`
--

CREATE TABLE `gaji_pegawai_detail` (
  `id_gaji_pegawai_detail` int(10) UNSIGNED NOT NULL,
  `id_gaji_pegawai` int(10) UNSIGNED NOT NULL,
  `jumlah_hari` int(11) NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `total_gaji_harian` int(11) NOT NULL,
  `total_uang_makan` int(11) NOT NULL,
  `potongan_terlambat` int(11) NOT NULL,
  `total_uang_lembur` int(11) NOT NULL DEFAULT 0,
  `total_semua_gaji` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bonus` int(11) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaji_pegawai_detail`
--

INSERT INTO `gaji_pegawai_detail` (`id_gaji_pegawai_detail`, `id_gaji_pegawai`, `jumlah_hari`, `id_toko`, `total_gaji_harian`, `total_uang_makan`, `potongan_terlambat`, `total_uang_lembur`, `total_semua_gaji`, `created_at`, `updated_at`, `bonus`, `id_user`) VALUES
(19, 19, 51, 9, 5610000, 765000, 1020000, 612000, 5967000, NULL, NULL, 0, 30),
(20, 21, 25, 9, 2750000, 375000, 500000, 300000, 2925000, NULL, NULL, 0, 30),
(21, 23, 26, 2, 320955544, 26, 200009, 0, 320755561, NULL, NULL, 0, 29);

-- --------------------------------------------------------

--
-- Table structure for table `gambar_retur`
--

CREATE TABLE `gambar_retur` (
  `id_gambar_retur` bigint(20) UNSIGNED NOT NULL,
  `id_retur` bigint(20) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `gambar` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gambar_retur`
--

INSERT INTO `gambar_retur` (`id_gambar_retur`, `id_retur`, `id_toko`, `gambar`, `created_at`, `updated_at`) VALUES
(7, 33, 2, 'storage/gambar_retur/33/67344ce2acb1b.jpg', NULL, NULL),
(8, 35, 2, 'storage/gambar_retur/35/67344e4a25e43.jpg', NULL, NULL),
(9, 36, 2, 'storage/gambar_retur/36/67344eea8aa35.jpg', NULL, NULL),
(10, 37, 2, 'storage/gambar_retur/37/67344f29b8bfa.jpg', NULL, NULL),
(11, 38, 2, 'storage/gambar_retur/38/673cd0836268c.jpg', NULL, NULL),
(12, 38, 2, 'storage/gambar_retur/38/673cd08369da8.jpg', NULL, NULL),
(13, 38, 2, 'storage/gambar_retur/38/673cd0836a480.jpg', NULL, NULL),
(14, 38, 2, 'storage/gambar_retur/38/673cd0836a911.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_hak_akses` bigint(20) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `nama_hak_akses` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id_hak_akses`, `id_toko`, `nama_hak_akses`, `created_at`, `updated_at`) VALUES
(1, 0, 'superadmin', NULL, NULL),
(2, 0, 'admin', NULL, NULL),
(3, 0, 'kasir', NULL, NULL),
(4, 0, 'tidak ada', NULL, NULL),
(5, 2, 'Super Admin', NULL, NULL),
(6, 2, 'jsdjvsjvj\'', NULL, NULL),
(7, 3, 'Super Admin', NULL, NULL),
(8, 4, 'Super Admin', NULL, NULL),
(9, 5, 'Super Admin', NULL, NULL),
(10, 6, 'Super Admin', NULL, NULL),
(11, 7, 'Super Admin', NULL, NULL),
(12, 8, 'Super Admin', NULL, NULL),
(13, 9, 'Super Admin', NULL, NULL),
(14, 10, 'Super Admin', NULL, NULL),
(15, 10, 'starfff', NULL, NULL),
(16, 11, 'Super Admin', NULL, NULL),
(17, 13, 'Super Admin', NULL, NULL),
(18, 14, 'Super Admin', NULL, NULL),
(19, 15, 'Super Admin', NULL, NULL),
(20, 16, 'Super Admin', NULL, NULL),
(21, 17, 'Super Admin', NULL, NULL),
(22, 18, 'Super Admin', NULL, NULL),
(23, 19, 'Super Admin', NULL, NULL),
(24, 20, 'Super Admin', NULL, NULL),
(25, 21, 'Super Admin', NULL, NULL),
(26, 22, 'Super Admin', NULL, NULL),
(27, 23, 'Super Admin', NULL, NULL),
(28, 24, 'Super Admin', NULL, NULL),
(29, 25, 'Super Admin', NULL, NULL),
(30, 26, 'Super Admin', NULL, NULL),
(31, 27, 'Super Admin', NULL, NULL),
(32, 28, 'Super Admin', NULL, NULL),
(33, 29, 'Manager', NULL, NULL),
(34, 30, 'Manager', NULL, NULL),
(35, 31, 'Manager', NULL, NULL),
(36, 32, 'Manager', NULL, NULL),
(37, 33, 'Manager', NULL, NULL),
(38, 34, 'Manager', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses_menu`
--

CREATE TABLE `hak_akses_menu` (
  `id_hak_akses_menu` bigint(20) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `id_hak_akses` bigint(20) UNSIGNED NOT NULL,
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hak_akses_menu`
--

INSERT INTO `hak_akses_menu` (`id_hak_akses_menu`, `id_toko`, `id_hak_akses`, `id_menu`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 1, NULL, NULL),
(2, 2, 5, 2, NULL, NULL),
(3, 2, 5, 3, NULL, NULL),
(5, 2, 5, 5, NULL, NULL),
(6, 2, 5, 6, NULL, NULL),
(7, 2, 5, 7, NULL, NULL),
(8, 2, 5, 8, NULL, NULL),
(9, 2, 5, 9, NULL, NULL),
(10, 2, 5, 10, NULL, NULL),
(11, 2, 5, 11, NULL, NULL),
(12, 2, 5, 12, NULL, NULL),
(13, 2, 5, 13, NULL, NULL),
(14, 2, 5, 14, NULL, NULL),
(15, 2, 5, 15, NULL, NULL),
(16, 2, 5, 16, NULL, NULL),
(17, 2, 5, 17, NULL, NULL),
(18, 2, 5, 18, NULL, NULL),
(19, 2, 5, 19, NULL, NULL),
(20, 2, 5, 20, NULL, NULL),
(21, 2, 5, 21, NULL, NULL),
(22, 2, 5, 22, NULL, NULL),
(23, 2, 5, 23, NULL, NULL),
(25, 2, 6, 16, NULL, NULL),
(26, 9, 13, 1, NULL, NULL),
(28, 9, 13, 3, NULL, NULL),
(31, 9, 13, 6, NULL, NULL),
(32, 9, 13, 7, NULL, NULL),
(33, 9, 13, 8, NULL, NULL),
(34, 9, 13, 9, NULL, NULL),
(35, 9, 13, 10, NULL, NULL),
(36, 9, 13, 11, NULL, NULL),
(37, 9, 13, 12, NULL, NULL),
(38, 9, 13, 13, NULL, NULL),
(39, 9, 13, 14, NULL, NULL),
(40, 9, 13, 15, NULL, NULL),
(41, 9, 13, 16, NULL, NULL),
(42, 9, 13, 17, NULL, NULL),
(43, 9, 13, 18, NULL, NULL),
(44, 9, 13, 19, NULL, NULL),
(45, 9, 13, 20, NULL, NULL),
(46, 9, 13, 21, NULL, NULL),
(47, 9, 13, 22, NULL, NULL),
(48, 9, 13, 23, NULL, NULL),
(50, 10, 14, 2, NULL, NULL),
(53, 10, 14, 5, NULL, NULL),
(54, 10, 14, 6, NULL, NULL),
(55, 10, 14, 7, NULL, NULL),
(56, 10, 14, 8, NULL, NULL),
(57, 10, 14, 9, NULL, NULL),
(58, 10, 14, 10, NULL, NULL),
(59, 10, 14, 11, NULL, NULL),
(60, 10, 14, 12, NULL, NULL),
(61, 10, 14, 13, NULL, NULL),
(62, 10, 14, 14, NULL, NULL),
(63, 10, 14, 15, NULL, NULL),
(64, 10, 14, 16, NULL, NULL),
(65, 10, 14, 17, NULL, NULL),
(66, 10, 14, 18, NULL, NULL),
(67, 10, 14, 19, NULL, NULL),
(68, 10, 14, 20, NULL, NULL),
(69, 10, 14, 21, NULL, NULL),
(70, 10, 14, 22, NULL, NULL),
(71, 10, 14, 23, NULL, NULL),
(73, 10, 15, 10, NULL, NULL),
(74, 9, 13, 4, NULL, NULL),
(75, 2, 5, 4, NULL, NULL),
(76, 11, 16, 1, NULL, NULL),
(77, 11, 16, 2, NULL, NULL),
(78, 11, 16, 3, NULL, NULL),
(79, 11, 16, 4, NULL, NULL),
(80, 11, 16, 5, NULL, NULL),
(81, 11, 16, 6, NULL, NULL),
(82, 11, 16, 7, NULL, NULL),
(83, 11, 16, 8, NULL, NULL),
(84, 11, 16, 9, NULL, NULL),
(85, 11, 16, 10, NULL, NULL),
(86, 11, 16, 11, NULL, NULL),
(87, 11, 16, 12, NULL, NULL),
(88, 11, 16, 13, NULL, NULL),
(89, 11, 16, 14, NULL, NULL),
(90, 11, 16, 15, NULL, NULL),
(91, 11, 16, 16, NULL, NULL),
(92, 11, 16, 17, NULL, NULL),
(93, 11, 16, 18, NULL, NULL),
(94, 11, 16, 19, NULL, NULL),
(95, 11, 16, 20, NULL, NULL),
(96, 11, 16, 21, NULL, NULL),
(97, 11, 16, 22, NULL, NULL),
(98, 11, 16, 23, NULL, NULL),
(99, 13, 17, 1, NULL, NULL),
(100, 13, 17, 2, NULL, NULL),
(101, 13, 17, 3, NULL, NULL),
(102, 13, 17, 4, NULL, NULL),
(103, 13, 17, 5, NULL, NULL),
(104, 13, 17, 6, NULL, NULL),
(105, 13, 17, 7, NULL, NULL),
(106, 13, 17, 8, NULL, NULL),
(107, 13, 17, 9, NULL, NULL),
(108, 13, 17, 10, NULL, NULL),
(109, 13, 17, 11, NULL, NULL),
(110, 13, 17, 12, NULL, NULL),
(111, 13, 17, 13, NULL, NULL),
(112, 13, 17, 14, NULL, NULL),
(113, 13, 17, 15, NULL, NULL),
(114, 13, 17, 16, NULL, NULL),
(115, 13, 17, 17, NULL, NULL),
(116, 13, 17, 18, NULL, NULL),
(117, 13, 17, 19, NULL, NULL),
(118, 13, 17, 20, NULL, NULL),
(119, 13, 17, 21, NULL, NULL),
(120, 13, 17, 22, NULL, NULL),
(121, 13, 17, 23, NULL, NULL),
(122, 14, 18, 1, NULL, NULL),
(123, 14, 18, 2, NULL, NULL),
(124, 14, 18, 3, NULL, NULL),
(125, 14, 18, 4, NULL, NULL),
(126, 14, 18, 5, NULL, NULL),
(127, 14, 18, 6, NULL, NULL),
(128, 14, 18, 7, NULL, NULL),
(129, 14, 18, 8, NULL, NULL),
(130, 14, 18, 9, NULL, NULL),
(131, 14, 18, 10, NULL, NULL),
(132, 14, 18, 11, NULL, NULL),
(133, 14, 18, 12, NULL, NULL),
(134, 14, 18, 13, NULL, NULL),
(135, 14, 18, 14, NULL, NULL),
(136, 14, 18, 15, NULL, NULL),
(137, 14, 18, 16, NULL, NULL),
(138, 14, 18, 17, NULL, NULL),
(139, 14, 18, 18, NULL, NULL),
(140, 14, 18, 19, NULL, NULL),
(141, 14, 18, 20, NULL, NULL),
(142, 14, 18, 21, NULL, NULL),
(143, 14, 18, 22, NULL, NULL),
(144, 14, 18, 23, NULL, NULL),
(145, 17, 21, 1, NULL, NULL),
(146, 17, 21, 2, NULL, NULL),
(147, 17, 21, 3, NULL, NULL),
(148, 17, 21, 4, NULL, NULL),
(149, 17, 21, 5, NULL, NULL),
(150, 17, 21, 6, NULL, NULL),
(151, 17, 21, 7, NULL, NULL),
(152, 17, 21, 8, NULL, NULL),
(153, 17, 21, 9, NULL, NULL),
(154, 17, 21, 10, NULL, NULL),
(155, 17, 21, 11, NULL, NULL),
(156, 17, 21, 12, NULL, NULL),
(157, 17, 21, 13, NULL, NULL),
(158, 17, 21, 14, NULL, NULL),
(159, 17, 21, 15, NULL, NULL),
(160, 17, 21, 16, NULL, NULL),
(161, 17, 21, 17, NULL, NULL),
(162, 17, 21, 18, NULL, NULL),
(163, 17, 21, 19, NULL, NULL),
(164, 17, 21, 20, NULL, NULL),
(165, 17, 21, 21, NULL, NULL),
(166, 17, 21, 22, NULL, NULL),
(167, 17, 21, 23, NULL, NULL),
(168, 18, 22, 1, NULL, NULL),
(169, 18, 22, 2, NULL, NULL),
(170, 18, 22, 3, NULL, NULL),
(171, 18, 22, 4, NULL, NULL),
(172, 18, 22, 5, NULL, NULL),
(173, 18, 22, 6, NULL, NULL),
(174, 18, 22, 7, NULL, NULL),
(175, 18, 22, 8, NULL, NULL),
(176, 18, 22, 9, NULL, NULL),
(177, 18, 22, 10, NULL, NULL),
(178, 18, 22, 11, NULL, NULL),
(179, 18, 22, 12, NULL, NULL),
(180, 18, 22, 13, NULL, NULL),
(181, 18, 22, 14, NULL, NULL),
(182, 18, 22, 15, NULL, NULL),
(183, 18, 22, 16, NULL, NULL),
(184, 18, 22, 17, NULL, NULL),
(185, 18, 22, 18, NULL, NULL),
(186, 18, 22, 19, NULL, NULL),
(187, 18, 22, 20, NULL, NULL),
(188, 18, 22, 21, NULL, NULL),
(189, 18, 22, 22, NULL, NULL),
(190, 18, 22, 23, NULL, NULL),
(191, 19, 23, 1, NULL, NULL),
(192, 19, 23, 2, NULL, NULL),
(193, 19, 23, 3, NULL, NULL),
(194, 19, 23, 4, NULL, NULL),
(195, 19, 23, 5, NULL, NULL),
(196, 19, 23, 6, NULL, NULL),
(197, 19, 23, 7, NULL, NULL),
(198, 19, 23, 8, NULL, NULL),
(199, 19, 23, 9, NULL, NULL),
(200, 19, 23, 10, NULL, NULL),
(201, 19, 23, 11, NULL, NULL),
(202, 19, 23, 12, NULL, NULL),
(203, 19, 23, 13, NULL, NULL),
(204, 19, 23, 14, NULL, NULL),
(205, 19, 23, 15, NULL, NULL),
(206, 19, 23, 16, NULL, NULL),
(207, 19, 23, 17, NULL, NULL),
(208, 19, 23, 18, NULL, NULL),
(209, 19, 23, 19, NULL, NULL),
(210, 19, 23, 20, NULL, NULL),
(211, 19, 23, 21, NULL, NULL),
(212, 19, 23, 22, NULL, NULL),
(213, 19, 23, 23, NULL, NULL),
(214, 20, 24, 1, NULL, NULL),
(215, 20, 24, 2, NULL, NULL),
(216, 20, 24, 3, NULL, NULL),
(217, 20, 24, 4, NULL, NULL),
(218, 20, 24, 5, NULL, NULL),
(219, 20, 24, 6, NULL, NULL),
(220, 20, 24, 7, NULL, NULL),
(221, 20, 24, 8, NULL, NULL),
(222, 20, 24, 9, NULL, NULL),
(223, 20, 24, 10, NULL, NULL),
(224, 20, 24, 11, NULL, NULL),
(225, 20, 24, 12, NULL, NULL),
(226, 20, 24, 13, NULL, NULL),
(227, 20, 24, 14, NULL, NULL),
(228, 20, 24, 15, NULL, NULL),
(229, 20, 24, 16, NULL, NULL),
(230, 20, 24, 17, NULL, NULL),
(231, 20, 24, 18, NULL, NULL),
(232, 20, 24, 19, NULL, NULL),
(233, 20, 24, 20, NULL, NULL),
(234, 20, 24, 21, NULL, NULL),
(235, 20, 24, 22, NULL, NULL),
(236, 20, 24, 23, NULL, NULL),
(237, 21, 25, 1, NULL, NULL),
(238, 21, 25, 2, NULL, NULL),
(239, 21, 25, 3, NULL, NULL),
(240, 21, 25, 4, NULL, NULL),
(241, 21, 25, 5, NULL, NULL),
(242, 21, 25, 6, NULL, NULL),
(243, 21, 25, 7, NULL, NULL),
(244, 21, 25, 8, NULL, NULL),
(245, 21, 25, 9, NULL, NULL),
(246, 21, 25, 10, NULL, NULL),
(247, 21, 25, 11, NULL, NULL),
(248, 21, 25, 12, NULL, NULL),
(249, 21, 25, 13, NULL, NULL),
(250, 21, 25, 14, NULL, NULL),
(251, 21, 25, 15, NULL, NULL),
(252, 21, 25, 16, NULL, NULL),
(253, 21, 25, 17, NULL, NULL),
(254, 21, 25, 18, NULL, NULL),
(255, 21, 25, 19, NULL, NULL),
(256, 21, 25, 20, NULL, NULL),
(257, 21, 25, 21, NULL, NULL),
(258, 21, 25, 22, NULL, NULL),
(259, 21, 25, 23, NULL, NULL),
(260, 22, 26, 1, NULL, NULL),
(261, 22, 26, 2, NULL, NULL),
(262, 22, 26, 3, NULL, NULL),
(263, 22, 26, 4, NULL, NULL),
(264, 22, 26, 5, NULL, NULL),
(265, 22, 26, 6, NULL, NULL),
(266, 22, 26, 7, NULL, NULL),
(267, 22, 26, 8, NULL, NULL),
(268, 22, 26, 9, NULL, NULL),
(269, 22, 26, 10, NULL, NULL),
(270, 22, 26, 11, NULL, NULL),
(271, 22, 26, 12, NULL, NULL),
(272, 22, 26, 13, NULL, NULL),
(273, 22, 26, 14, NULL, NULL),
(274, 22, 26, 15, NULL, NULL),
(275, 22, 26, 16, NULL, NULL),
(276, 22, 26, 17, NULL, NULL),
(277, 22, 26, 18, NULL, NULL),
(278, 22, 26, 19, NULL, NULL),
(279, 22, 26, 20, NULL, NULL),
(280, 22, 26, 21, NULL, NULL),
(281, 22, 26, 22, NULL, NULL),
(282, 22, 26, 23, NULL, NULL),
(283, 23, 27, 1, NULL, NULL),
(284, 23, 27, 2, NULL, NULL),
(285, 23, 27, 3, NULL, NULL),
(286, 23, 27, 4, NULL, NULL),
(287, 23, 27, 5, NULL, NULL),
(288, 23, 27, 6, NULL, NULL),
(289, 23, 27, 7, NULL, NULL),
(290, 23, 27, 8, NULL, NULL),
(291, 23, 27, 9, NULL, NULL),
(292, 23, 27, 10, NULL, NULL),
(293, 23, 27, 11, NULL, NULL),
(294, 23, 27, 12, NULL, NULL),
(295, 23, 27, 13, NULL, NULL),
(296, 23, 27, 14, NULL, NULL),
(297, 23, 27, 15, NULL, NULL),
(298, 23, 27, 16, NULL, NULL),
(299, 23, 27, 17, NULL, NULL),
(300, 23, 27, 18, NULL, NULL),
(301, 23, 27, 19, NULL, NULL),
(302, 23, 27, 20, NULL, NULL),
(303, 23, 27, 21, NULL, NULL),
(304, 23, 27, 22, NULL, NULL),
(305, 23, 27, 23, NULL, NULL),
(306, 24, 28, 1, NULL, NULL),
(307, 24, 28, 2, NULL, NULL),
(308, 24, 28, 3, NULL, NULL),
(309, 24, 28, 4, NULL, NULL),
(310, 24, 28, 5, NULL, NULL),
(311, 24, 28, 6, NULL, NULL),
(312, 24, 28, 7, NULL, NULL),
(313, 24, 28, 8, NULL, NULL),
(314, 24, 28, 9, NULL, NULL),
(315, 24, 28, 10, NULL, NULL),
(316, 24, 28, 11, NULL, NULL),
(317, 24, 28, 12, NULL, NULL),
(318, 24, 28, 13, NULL, NULL),
(319, 24, 28, 14, NULL, NULL),
(320, 24, 28, 15, NULL, NULL),
(321, 24, 28, 16, NULL, NULL),
(322, 24, 28, 17, NULL, NULL),
(323, 24, 28, 18, NULL, NULL),
(324, 24, 28, 19, NULL, NULL),
(325, 24, 28, 20, NULL, NULL),
(326, 24, 28, 21, NULL, NULL),
(327, 24, 28, 22, NULL, NULL),
(328, 24, 28, 23, NULL, NULL),
(329, 25, 29, 1, NULL, NULL),
(330, 25, 29, 2, NULL, NULL),
(331, 25, 29, 3, NULL, NULL),
(332, 25, 29, 4, NULL, NULL),
(333, 25, 29, 5, NULL, NULL),
(334, 25, 29, 6, NULL, NULL),
(335, 25, 29, 7, NULL, NULL),
(336, 25, 29, 8, NULL, NULL),
(337, 25, 29, 9, NULL, NULL),
(338, 25, 29, 10, NULL, NULL),
(339, 25, 29, 11, NULL, NULL),
(340, 25, 29, 12, NULL, NULL),
(341, 25, 29, 13, NULL, NULL),
(342, 25, 29, 14, NULL, NULL),
(343, 25, 29, 15, NULL, NULL),
(344, 25, 29, 16, NULL, NULL),
(345, 25, 29, 17, NULL, NULL),
(346, 25, 29, 18, NULL, NULL),
(347, 25, 29, 19, NULL, NULL),
(348, 25, 29, 20, NULL, NULL),
(349, 25, 29, 21, NULL, NULL),
(350, 25, 29, 22, NULL, NULL),
(351, 25, 29, 23, NULL, NULL),
(352, 26, 30, 1, NULL, NULL),
(353, 26, 30, 2, NULL, NULL),
(354, 26, 30, 3, NULL, NULL),
(355, 26, 30, 4, NULL, NULL),
(356, 26, 30, 5, NULL, NULL),
(357, 26, 30, 6, NULL, NULL),
(358, 26, 30, 7, NULL, NULL),
(359, 26, 30, 8, NULL, NULL),
(360, 26, 30, 9, NULL, NULL),
(361, 26, 30, 10, NULL, NULL),
(362, 26, 30, 11, NULL, NULL),
(363, 26, 30, 12, NULL, NULL),
(364, 26, 30, 13, NULL, NULL),
(365, 26, 30, 14, NULL, NULL),
(366, 26, 30, 15, NULL, NULL),
(367, 26, 30, 16, NULL, NULL),
(368, 26, 30, 17, NULL, NULL),
(369, 26, 30, 18, NULL, NULL),
(370, 26, 30, 19, NULL, NULL),
(371, 26, 30, 20, NULL, NULL),
(372, 26, 30, 21, NULL, NULL),
(373, 26, 30, 22, NULL, NULL),
(374, 26, 30, 23, NULL, NULL),
(375, 27, 31, 1, NULL, NULL),
(376, 27, 31, 2, NULL, NULL),
(377, 27, 31, 3, NULL, NULL),
(378, 27, 31, 4, NULL, NULL),
(379, 27, 31, 5, NULL, NULL),
(380, 27, 31, 6, NULL, NULL),
(381, 27, 31, 7, NULL, NULL),
(382, 27, 31, 8, NULL, NULL),
(383, 27, 31, 9, NULL, NULL),
(384, 27, 31, 10, NULL, NULL),
(385, 27, 31, 11, NULL, NULL),
(386, 27, 31, 12, NULL, NULL),
(387, 27, 31, 13, NULL, NULL),
(388, 27, 31, 14, NULL, NULL),
(389, 27, 31, 15, NULL, NULL),
(390, 27, 31, 16, NULL, NULL),
(391, 27, 31, 17, NULL, NULL),
(392, 27, 31, 18, NULL, NULL),
(393, 27, 31, 19, NULL, NULL),
(394, 27, 31, 20, NULL, NULL),
(395, 27, 31, 21, NULL, NULL),
(396, 27, 31, 22, NULL, NULL),
(397, 27, 31, 23, NULL, NULL),
(398, 28, 32, 1, NULL, NULL),
(399, 28, 32, 2, NULL, NULL),
(400, 28, 32, 3, NULL, NULL),
(401, 28, 32, 4, NULL, NULL),
(402, 28, 32, 5, NULL, NULL),
(403, 28, 32, 6, NULL, NULL),
(404, 28, 32, 7, NULL, NULL),
(405, 28, 32, 8, NULL, NULL),
(406, 28, 32, 9, NULL, NULL),
(407, 28, 32, 10, NULL, NULL),
(408, 28, 32, 11, NULL, NULL),
(409, 28, 32, 12, NULL, NULL),
(410, 28, 32, 13, NULL, NULL),
(411, 28, 32, 14, NULL, NULL),
(412, 28, 32, 15, NULL, NULL),
(413, 28, 32, 16, NULL, NULL),
(414, 28, 32, 17, NULL, NULL),
(415, 28, 32, 18, NULL, NULL),
(416, 28, 32, 19, NULL, NULL),
(417, 28, 32, 20, NULL, NULL),
(418, 28, 32, 21, NULL, NULL),
(419, 28, 32, 22, NULL, NULL),
(420, 28, 32, 23, NULL, NULL),
(421, 29, 33, 1, NULL, NULL),
(422, 29, 33, 2, NULL, NULL),
(423, 29, 33, 3, NULL, NULL),
(424, 29, 33, 4, NULL, NULL),
(425, 29, 33, 5, NULL, NULL),
(426, 29, 33, 6, NULL, NULL),
(427, 29, 33, 7, NULL, NULL),
(428, 29, 33, 8, NULL, NULL),
(429, 29, 33, 9, NULL, NULL),
(430, 29, 33, 10, NULL, NULL),
(431, 29, 33, 11, NULL, NULL),
(432, 29, 33, 12, NULL, NULL),
(433, 29, 33, 13, NULL, NULL),
(434, 29, 33, 14, NULL, NULL),
(435, 29, 33, 15, NULL, NULL),
(436, 29, 33, 16, NULL, NULL),
(437, 29, 33, 17, NULL, NULL),
(438, 29, 33, 18, NULL, NULL),
(439, 29, 33, 19, NULL, NULL),
(440, 29, 33, 20, NULL, NULL),
(441, 29, 33, 21, NULL, NULL),
(442, 29, 33, 22, NULL, NULL),
(443, 29, 33, 23, NULL, NULL),
(444, 30, 34, 1, NULL, NULL),
(445, 30, 34, 2, NULL, NULL),
(446, 30, 34, 3, NULL, NULL),
(447, 30, 34, 4, NULL, NULL),
(448, 30, 34, 5, NULL, NULL),
(449, 30, 34, 6, NULL, NULL),
(450, 30, 34, 7, NULL, NULL),
(451, 30, 34, 8, NULL, NULL),
(452, 30, 34, 9, NULL, NULL),
(453, 30, 34, 10, NULL, NULL),
(454, 30, 34, 11, NULL, NULL),
(455, 30, 34, 12, NULL, NULL),
(456, 30, 34, 13, NULL, NULL),
(457, 30, 34, 14, NULL, NULL),
(458, 30, 34, 15, NULL, NULL),
(459, 30, 34, 16, NULL, NULL),
(460, 30, 34, 17, NULL, NULL),
(461, 30, 34, 18, NULL, NULL),
(462, 30, 34, 19, NULL, NULL),
(463, 30, 34, 20, NULL, NULL),
(464, 30, 34, 21, NULL, NULL),
(465, 30, 34, 22, NULL, NULL),
(466, 30, 34, 23, NULL, NULL),
(467, 32, 36, 1, NULL, NULL),
(468, 32, 36, 2, NULL, NULL),
(469, 32, 36, 3, NULL, NULL),
(470, 32, 36, 4, NULL, NULL),
(471, 32, 36, 5, NULL, NULL),
(472, 32, 36, 6, NULL, NULL),
(473, 32, 36, 7, NULL, NULL),
(474, 32, 36, 8, NULL, NULL),
(475, 32, 36, 9, NULL, NULL),
(476, 32, 36, 10, NULL, NULL),
(477, 32, 36, 11, NULL, NULL),
(478, 32, 36, 12, NULL, NULL),
(479, 32, 36, 13, NULL, NULL),
(480, 32, 36, 14, NULL, NULL),
(481, 32, 36, 15, NULL, NULL),
(482, 32, 36, 16, NULL, NULL),
(483, 32, 36, 17, NULL, NULL),
(484, 32, 36, 18, NULL, NULL),
(485, 32, 36, 19, NULL, NULL),
(486, 32, 36, 20, NULL, NULL),
(487, 32, 36, 21, NULL, NULL),
(488, 32, 36, 22, NULL, NULL),
(489, 32, 36, 23, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `history_penjualan`
--

CREATE TABLE `history_penjualan` (
  `id_penjualan` int(10) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `jumlah` varchar(45) NOT NULL,
  `total` varchar(45) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `Referensi` varchar(45) NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ppn` varchar(191) DEFAULT NULL,
  `total_harga_kena_ppn` varchar(191) DEFAULT NULL,
  `checkPpn` tinyint(1) NOT NULL DEFAULT 1,
  `id_diskon` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_penjualan`
--

INSERT INTO `history_penjualan` (`id_penjualan`, `id_toko`, `jumlah`, `total`, `tanggal_input`, `Referensi`, `id_user`, `id_barang`, `created_at`, `updated_at`, `ppn`, `total_harga_kena_ppn`, `checkPpn`, `id_diskon`) VALUES
(79, 2, '10', '70000000', '2024-11-11 19:41:55', 'MLG20241105064409', 29, 1, NULL, NULL, '0', '77700000', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `history_poin`
--

CREATE TABLE `history_poin` (
  `id_history_poin` bigint(20) UNSIGNED NOT NULL,
  `id_nota` bigint(20) UNSIGNED NOT NULL,
  `jumlah_transaksi` int(11) NOT NULL,
  `id_toko` bigint(20) UNSIGNED DEFAULT NULL,
  `poin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_poin`
--

INSERT INTO `history_poin` (`id_history_poin`, `id_nota`, `jumlah_transaksi`, `id_toko`, `poin`, `created_at`, `updated_at`, `id_customer`) VALUES
(1, 59, 530000, 2, 530000, '2024-10-29 17:29:38', '2024-10-29 17:29:38', 9),
(2, 60, 530000, 2, 588300, '2024-10-29 17:32:15', '2024-10-29 17:32:15', 9),
(3, 61, 530000, 2, 58, '2024-10-29 17:33:43', '2024-10-29 17:33:43', 9),
(4, 62, 530000, 2, 58, '2024-10-29 17:35:12', '2024-10-29 17:35:12', 9),
(5, 63, 530000, 2, 58, '2024-10-29 17:38:59', '2024-10-29 17:38:59', 9),
(6, 75, 42000, 2, 4, '2024-11-05 16:51:34', '2024-11-05 16:51:34', 9),
(7, 81, 42000, 2, 4, '2024-11-05 17:11:56', '2024-11-05 17:11:56', 9);

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
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `id_toko`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 0, 'Electronicsskd', '2024-06-01 03:00:00', '2024-06-01 03:00:00'),
(2, 0, 'Books', '2024-06-01 03:05:00', '2024-06-01 03:05:00'),
(3, 0, 'Clothing', '2024-06-01 03:10:00', '2024-06-01 03:10:00'),
(4, 0, 'Home Appliances', '2024-06-01 03:15:00', '2024-06-01 03:15:00'),
(6, 0, 'Toys', '2024-06-01 03:25:00', '2024-06-01 03:25:00'),
(7, 0, 'Groceries', '2024-06-01 03:30:00', '2024-06-01 03:30:00'),
(8, 0, 'Furniture', '2024-06-01 03:35:00', '2024-06-01 03:35:00'),
(9, 0, 'Beauty Products', '2024-06-01 03:40:00', '2024-06-01 03:40:00'),
(10, 0, 'Automotive', '2024-06-01 03:45:00', '2024-06-01 03:45:00'),
(12, 0, 'ab', NULL, NULL),
(13, 0, 'tes', NULL, NULL),
(14, 0, 'tes', NULL, NULL),
(15, 0, 'tes', NULL, NULL),
(16, 0, 'tes', NULL, NULL),
(20, 0, 'eee', NULL, NULL),
(21, 0, 'skdkfwsvc', NULL, NULL),
(22, 0, 'qwd', NULL, NULL),
(25, 0, 'asad', NULL, NULL),
(26, 0, 'tes', NULL, NULL),
(27, 2, 'bearing', NULL, NULL),
(28, 2, 'bearing1', NULL, NULL),
(29, 9, 'kkgkgk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `nama_menu` varchar(191) NOT NULL,
  `nama_menu_opsional` varchar(191) DEFAULT NULL,
  `url` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `nama_menu_opsional`, `url`, `created_at`, `updated_at`, `icon`) VALUES
(1, 'Kategori', 'kategori', '/kategori', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'category'),
(2, 'Satuan', 'satuan', '/satuan', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'scale'),
(3, 'Barang', 'barang', '/barang', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'inventory_2'),
(4, 'Home', 'home', '/home', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'home'),
(5, 'Transaksi', 'transaksi', '/transaksi', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'point_of_sale'),
(6, 'Customer', 'customer', '/customer', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'person'),
(7, 'Nota', 'nota', '/nota', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'receipt'),
(8, 'User', 'user', '/user', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'group'),
(9, 'Perjanjian', 'perjanjian', '/perjanjian', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'handshake'),
(10, 'Hak Akses', 'hakAkses', '/hakAkses', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'key'),
(11, 'Absen QR', 'absenQr', '/absenQr', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'qr_code_2'),
(12, 'Absen', 'absen', '/absen', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'qr_code_scanner'),
(13, 'Absensi', 'absensi', '/absensi', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'punch_clock'),
(14, 'Pengaturan', 'pengaturan', '/pengaturan', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'settings'),
(15, 'Retur', 'retur', '/retur', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'keyboard_return'),
(16, 'Laporan', 'laporan', '/laporan', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'summarize'),
(17, 'Supplier', 'supplier', '/supplier', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'front_loader'),
(18, 'Purchase Order', 'purchaseOrder', '/purchaseOrder', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'shop_two'),
(19, 'Receive Order', 'receiveOrder', '/receiveOrder', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'inventory'),
(20, 'In Out', 'inOut', '/inOut', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'sync_alt'),
(21, 'Gaji Pegawai', 'gajiPegawai', '/gajiPegawai', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'payments'),
(22, 'History Poin', 'historyPoin', '/historyPoin', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'history'),
(23, 'Diskon', 'diskon', '/diskon', '2024-10-27 19:08:54', '2024-10-27 19:08:54', 'percent');

--
-- Triggers `menu`
--
DELIMITER $$
CREATE TRIGGER `menu_delete` BEFORE DELETE ON `menu` FOR EACH ROW BEGIN
                SIGNAL SQLSTATE "45000"
                SET MESSAGE_TEXT = "Cannot delete menu";
            END
$$
DELIMITER ;

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
(51, '0001_01_01_000000_create_users_table', 1),
(52, '0001_01_01_000001_create_cache_table', 1),
(53, '0001_01_01_000002_create_jobs_table', 1),
(54, '2024_06_03_204250_create_kategori_table', 1),
(55, '2024_06_03_204324_create_barang_table', 1),
(56, '2024_06_03_204354_create_user_table', 1),
(57, '2024_06_03_204426_create_customer_table', 1),
(58, '2024_06_03_204449_create_nota_table', 1),
(59, '2024_06_03_204519_create_history_pejualan_table', 1),
(60, '2024_06_03_204550_create_toko_table', 1),
(61, '2024_06_03_204809_create_absensi_table', 1),
(62, '2024_06_03_204851_create_gaji_pegawai_table', 1),
(63, '2024_06_03_204919_create_gaji_pegawai_detail_table', 1),
(64, '2024_06_03_204953_create_nota_detail_table', 1),
(65, '2024_06_03_205023_create_supplier_table', 1),
(66, '2024_06_03_205149_create_baranghas_supplier_table', 1),
(67, '2024_06_03_205239_create_purchase_order_table', 1),
(68, '2024_06_03_205330_create_receive_order_table', 1),
(69, '2024_06_03_205400_create_perjanjian_table', 1),
(70, '2024_06_03_205431_create_retur_table', 1),
(71, '2024_06_03_205454_create_retur_detail_table', 1),
(72, '2024_06_04_065334_change_attribute_user', 2),
(73, '2024_06_05_061400_change_datatype_barang', 3),
(74, '2024_07_09_061236_alter_batang_table', 4),
(78, '2024_07_16_081208_auco_increment_customer_table', 5),
(80, '2024_07_16_081830_change_int_no_h_p_customer', 6),
(81, '2024_08_06_081300_update_perjanjian_table', 7),
(88, '2024_08_07_060513_create_table_hak_akses', 8),
(91, '2024_08_07_091314_create_table_absensi', 9),
(92, '2024_08_08_031536_update_table_toko', 10),
(94, '2024_08_08_034036_add_column_ppn', 11),
(95, '2024_08_08_034249_add_column_totalkena_ppn', 12),
(98, '2024_08_08_074035_alter_table_perjanjian', 13),
(99, '2024_08_14_083308_alter_null_absensi', 14),
(100, '2024_08_17_092708_alter_column_table_toko_jam_buka_jam_tutup', 15),
(101, '2024_08_17_093342_add_column_toleransi_terlambat_toko', 16),
(102, '2024_08_18_083103_delete_column_retur', 17),
(104, '2024_08_25_064241_create_purchase_order_table', 18),
(105, '2024_08_25_071503_create_purchase_order_detail_table', 19),
(106, '2024_08_25_072025_create_receive_order_table', 20),
(107, '2024_08_25_072142_create_receive_order_detail_table', 21),
(108, '2024_08_27_034139_alter_column_retur_detail', 22),
(109, '2024_08_27_071855_alter_column_retur_detail', 23),
(110, '2024_08_29_063747_alter_table_supplier', 24),
(111, '2024_08_29_084426_alter_table_barang_has_supplier', 25),
(112, '2024_09_02_043519_alter_table_user', 26),
(113, '2024_09_02_044133_alter_table_kategori', 26),
(114, '2024_09_02_044326_alter_table_customer', 26),
(115, '2024_09_02_080252_alter_table_barang_has_supplier', 26),
(116, '2024_09_02_081427_alter_table_barang_has_supplier_name', 26),
(117, '2024_09_08_171101_alter_table_purchase_order', 27),
(118, '2024_09_11_082011_alter_table_purchase_order_detail', 28),
(119, '2024_09_11_082212_alter_table_purchase_order_detail', 28),
(120, '2024_09_12_083738_alter_table_purchase_order', 29),
(123, '2024_09_12_085324_alter_table_purchase_order', 30),
(124, '2024_09_14_075108_alter_table_purchase_order', 31),
(125, '2024_09_14_075701_alter_table_purchase_order', 32),
(126, '2024_09_20_104155_alter_table_retur_add_alasan_retur', 33),
(127, '2024_09_20_105748_alter_table_retur_add_url_gambar', 34),
(128, '2024_09_20_110322_add_table_satuan', 35),
(135, '2024_09_20_110626_rename_table_satuan', 36),
(136, '2024_09_24_053030_create_table_gambar_retur', 36),
(137, '2024_09_24_072300_change_table_column_barang', 37),
(138, '2024_09_24_080737_alter_table_brrang_has_supplier', 38),
(139, '2024_09_26_063846_alter_table_barang_supplierr', 39),
(140, '2024_09_30_071722_alter_table_purchase_order_detail', 40),
(141, '2024_10_02_073027_alter_table_purchase_order', 41),
(142, '2024_10_08_071433_alter_table_supplier', 42),
(143, '2024_10_08_080422_alter_table_pengaturan', 42),
(144, '2024_10_09_055211_alter_table_gaji_pegawai', 42),
(145, '2024_10_09_065508_alter_table_gaji_pegawai', 42),
(146, '2024_10_09_082504_alter_table_toko', 42),
(147, '2024_10_09_082949_alter_table_user', 42),
(148, '2024_10_11_080218_alter_table_toko', 42),
(149, '2024_10_11_111131_alter_table_retur_detail', 43),
(150, '2024_10_15_085743_add_columnid_toko', 43),
(151, '2024_10_16_074122_alter_table_toko', 43),
(152, '2024_10_19_015547_add_table_menu', 43),
(153, '2024_10_19_020435_insertdata_menu', 43),
(154, '2024_10_21_095048_alter_table_menu', 43),
(155, '2024_10_21_095134_alter_table_menu', 43),
(156, '2024_10_22_050107_alter_table_menu', 43),
(157, '2024_10_22_085653_add_column_table_menu', 43),
(158, '2024_10_22_085803_insert_icon_table_menu', 43),
(159, '2024_10_23_061619_add_trigger_menu', 43),
(160, '2024_10_24_042034_add_column_history_penjuala', 43),
(161, '2024_10_24_051139_alter_table_nota', 43),
(162, '2024_10_24_061910_add_data_menu', 43),
(163, '2024_10_24_112435_alter_table_customer', 43),
(164, '2024_10_24_115012_create_table_poin', 43),
(165, '2024_10_24_115148_alter_table_nota', 43),
(166, '2024_10_24_115300_add_data_hak_akses', 43),
(167, '2024_10_24_115822_alter_table_poin', 43),
(168, '2024_10_26_044133_alter_table_toko', 43),
(169, '2024_10_26_074045_alter_table_menu', 43),
(170, '2024_10_26_074655_alter_table_menu', 43),
(171, '2024_10_26_124211_alter_table_history_poin', 43),
(172, '2024_10_26_124429_alter_table_history_poin', 43),
(173, '2024_10_26_125014_alter_table_history_poin', 43),
(174, '2024_10_26_132331_add_table_diskon', 43),
(175, '2024_10_26_132826_alter_table_menu', 43),
(176, '2024_10_27_134927_alter_table_diskon', 43),
(177, '2024_10_27_135352_add_table_diskon_has_barang', 43),
(178, '2024_10_27_142448_alter_table_diskon', 43),
(179, '2024_10_27_142517_alter_table_diskon', 43),
(180, '2024_10_27_145426_alter_table_diskon', 43),
(181, '2024_10_28_160728_alter_table_customer', 44),
(182, '2024_10_29_050327_alter_table_history_penjualan', 45),
(183, '2024_10_29_090728_alter_table_nota_detail', 45),
(185, '2024_10_29_163738_alter_table_nota_detail', 46),
(186, '2024_10_31_182923_alter_table_user', 47),
(187, '2024_11_01_080930_alter_table_gaji_detail', 47),
(189, '2024_11_05_090231_alter_table_user', 48),
(190, '2024_11_06_115736_alter_table_pengaturan', 49),
(192, '2024_11_06_175848_alter_table_user', 50),
(193, '2024_11_07_071537_alter_table_gaji_pegawai_detail', 51),
(195, '2024_11_07_111844_alter_table_toko', 52),
(196, '2024_11_07_112001_alter_table_toko', 53),
(197, '2024_11_08_094227_alter_table_gaji_pegawai_detail', 53),
(198, '2024_11_08_094313_alter_table_gaji_pegawai_detail', 54),
(199, '2024_11_08_161955_alter_table_gaji_detail', 55),
(201, '2024_11_08_163621_add_column_gaji_detail', 56),
(202, '2024_11_12_183641_alter_table_user', 57),
(203, '2024_11_13_063626_alter_table_retur_detail', 58),
(204, '2024_11_19_173150_alter_table_user', 59),
(205, '2024_11_19_175447_alter_table_retur', 60),
(207, '2024_11_21_172251_alter_table_toko', 61),
(208, '2024_11_21_172519_alter_table_user', 62),
(209, '2024_11_27_143109_alter_table_toko', 63),
(210, '2024_11_30_051430_delete_column_user', 64),
(211, '2024_11_30_051529_creaate_table_user_has_toko', 65);

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(10) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `bayarUang` int(11) DEFAULT NULL,
  `tanggal_input` datetime NOT NULL,
  `Referensi` varchar(45) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ppn` varchar(191) DEFAULT NULL,
  `total_harga_kena_ppn` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id_nota`, `id_toko`, `total`, `bayarUang`, `tanggal_input`, `Referensi`, `id_user`, `id_customer`, `created_at`, `updated_at`, `ppn`, `total_harga_kena_ppn`) VALUES
(83, 2, 7000000, 8000000, '2024-11-11 19:43:56', 'MLG20241105064409', 29, 0, NULL, NULL, '11', '7770000'),
(84, 2, 0, 7000000, '2024-11-11 19:45:02', 'MLG20241111124502', 29, 0, NULL, NULL, '11', '0'),
(87, 2, 35000000, 70000000, '2024-11-13 13:50:56', 'MLG20241113065056', 29, 0, NULL, NULL, '0', '35000000');

-- --------------------------------------------------------

--
-- Table structure for table `nota_detail`
--

CREATE TABLE `nota_detail` (
  `id_nota_detail` int(10) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `id_nota` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `diskon` int(11) DEFAULT 0,
  `total_setelah_diskon` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenis_diskon` enum('persentase','nominal') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nota_detail`
--

INSERT INTO `nota_detail` (`id_nota_detail`, `id_toko`, `id_nota`, `id_barang`, `jumlah`, `harga`, `diskon`, `total_setelah_diskon`, `created_at`, `updated_at`, `jenis_diskon`) VALUES
(134, 2, 83, 1, 1, 7000000, 0, 7000000, NULL, NULL, NULL),
(135, 2, 84, 1, 0, 0, 10, 0, NULL, NULL, 'persentase'),
(138, 2, 87, 1, 5, 35000000, 0, 35000000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('xtrac8996@gmail.com', '$2y$12$7nezzUwgD1xGFq8mWKYDre8q6p0Sog7GgzCnccDZmnVCmZqqpfPAe', '2024-06-04 00:39:32');

-- --------------------------------------------------------

--
-- Table structure for table `perjanjian`
--

CREATE TABLE `perjanjian` (
  `idperjanjian` bigint(20) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `catatanPerjanjian` varchar(255) DEFAULT NULL,
  `durasiPerjanjian` datetime DEFAULT NULL,
  `STATUS_PERJANJIAN` enum('0','1','2','3') NOT NULL COMMENT '0= belum aktif\r\n1= akktif\r\n2= sudah rretur\r\n3= expired',
  `id_nota` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_customer` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perjanjian`
--

INSERT INTO `perjanjian` (`idperjanjian`, `id_toko`, `catatanPerjanjian`, `durasiPerjanjian`, `STATUS_PERJANJIAN`, `id_nota`, `id_user`, `id_customer`, `created_at`, `updated_at`) VALUES
(27, 2, 'hkhkhk', '2024-11-15 13:52:00', '2', 87, 29, 0, NULL, NULL),
(28, 2, 'dfhd', '2024-11-23 00:52:00', '2', 84, 29, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id_purchase_order` int(10) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `tanggal_order` datetime NOT NULL,
  `tanggal_batas_order` datetime NOT NULL,
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `catatan_purchase_order` varchar(191) DEFAULT NULL,
  `syarat_ketentuan_purchase_order` varchar(191) DEFAULT NULL,
  `total_purchase_order` varchar(255) DEFAULT NULL,
  `diskon_purchase_order` decimal(15,2) DEFAULT NULL,
  `STATUS_PURCHASE_ORDER` enum('1','2','3','4') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id_purchase_order`, `id_toko`, `tanggal_order`, `tanggal_batas_order`, `id_supplier`, `created_at`, `updated_at`, `catatan_purchase_order`, `syarat_ketentuan_purchase_order`, `total_purchase_order`, `diskon_purchase_order`, `STATUS_PURCHASE_ORDER`) VALUES
(47, 0, '2024-10-02 00:00:00', '2024-10-02 00:00:00', 40, NULL, NULL, 'b', 'a', '17513544', 3.00, '3'),
(48, 0, '2024-10-02 00:00:00', '2024-10-02 00:00:00', 40, NULL, NULL, NULL, NULL, '6000000', 0.00, '3'),
(49, 0, '2024-10-02 00:00:00', '2024-10-02 00:00:00', 40, NULL, NULL, NULL, NULL, '6000000', 0.00, '3'),
(50, 0, '2024-10-02 00:00:00', '2024-10-02 00:00:00', 40, NULL, NULL, 'Tidak Ada', 'Tidak Ada', '6000000', 0.00, '2'),
(51, 0, '2024-10-02 00:00:00', '2024-10-02 00:00:00', 40, NULL, NULL, NULL, NULL, '6080000', 0.00, '2'),
(52, 0, '2024-10-03 00:00:00', '2024-10-03 00:00:00', 40, NULL, NULL, 'Tidak Ada', 'Tidak Ada', '1234', 0.00, '2');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_detail`
--

CREATE TABLE `purchase_order_detail` (
  `id_purchase_order_detail` int(10) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_per_unit` int(11) NOT NULL,
  `diskon_purchase_order_detail` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` int(11) NOT NULL,
  `id_purchase_order` int(10) UNSIGNED NOT NULL,
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jumlah_item_per_satuan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_detail`
--

INSERT INTO `purchase_order_detail` (`id_purchase_order_detail`, `id_toko`, `qty`, `harga_per_unit`, `diskon_purchase_order_detail`, `total`, `id_purchase_order`, `id_supplier`, `id_barang`, `created_at`, `updated_at`, `jumlah_item_per_satuan`) VALUES
(45, 0, 3, 6000000, 1.00, 17820000, 47, 40, 1, NULL, NULL, 10),
(46, 0, 3, 80000, 2.00, 235200, 47, 40, 2, NULL, NULL, 2),
(47, 0, 1, 6000000, 0.00, 6000000, 48, 40, 1, NULL, NULL, 10),
(48, 0, 1, 6000000, 0.00, 6000000, 49, 40, 1, NULL, NULL, 10),
(49, 0, 1, 6000000, 0.00, 6000000, 50, 40, 1, NULL, NULL, 10),
(50, 0, 1, 6000000, 0.00, 6000000, 51, 40, 1, NULL, NULL, 10),
(51, 0, 1, 80000, 0.00, 80000, 51, 40, 2, NULL, NULL, 2),
(52, 0, 1, 1234, 0.00, 1234, 52, 40, 2, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `receive_order`
--

CREATE TABLE `receive_order` (
  `id_receive_order` int(10) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `tanggal_terima` datetime NOT NULL,
  `id_purchase_order` int(10) UNSIGNED NOT NULL,
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receive_order`
--

INSERT INTO `receive_order` (`id_receive_order`, `id_toko`, `tanggal_terima`, `id_purchase_order`, `id_supplier`, `created_at`, `updated_at`) VALUES
(39, 0, '2024-10-02 14:33:28', 47, 40, NULL, NULL),
(40, 0, '2024-10-02 14:45:18', 48, 40, NULL, NULL),
(41, 0, '2024-10-02 14:50:56', 49, 40, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receive_order_detail`
--

CREATE TABLE `receive_order_detail` (
  `id_receive_order_detail` int(10) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `jumlah_barang_diterima` int(11) NOT NULL,
  `jumlah_barang_approve` int(11) NOT NULL,
  `id_receive_order` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receive_order_detail`
--

INSERT INTO `receive_order_detail` (`id_receive_order_detail`, `id_toko`, `jumlah_barang_diterima`, `jumlah_barang_approve`, `id_receive_order`, `id_user`, `id_barang`, `created_at`, `updated_at`) VALUES
(24, 0, 3, 3, 39, 1, 1, NULL, NULL),
(25, 0, 3, 3, 39, 1, 2, NULL, NULL),
(26, 0, 1, 1, 40, 1, 1, NULL, NULL),
(27, 0, 1, 1, 41, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE `retur` (
  `idretur` bigint(20) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `idperjanjian` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alasan_retur` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `retur`
--

INSERT INTO `retur` (`idretur`, `id_toko`, `idperjanjian`, `created_at`, `updated_at`, `alasan_retur`) VALUES
(37, 2, 27, NULL, NULL, NULL),
(38, 2, 28, NULL, NULL, 'akmsgegmksmkermtk');

-- --------------------------------------------------------

--
-- Table structure for table `retur_detail`
--

CREATE TABLE `retur_detail` (
  `idretur_detail` bigint(20) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `idretur` bigint(20) UNSIGNED NOT NULL,
  `jumlah_retur` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `total_retur_dengan_ppn` int(11) NOT NULL,
  `harga_barang` decimal(15,2) DEFAULT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `retur_detail`
--

INSERT INTO `retur_detail` (`idretur_detail`, `id_toko`, `idretur`, `jumlah_retur`, `ppn`, `total`, `total_retur_dengan_ppn`, `harga_barang`, `id_barang`, `id_kategori`, `created_at`, `updated_at`) VALUES
(27, 2, 37, 1, 0, 7000000, 7000000, 7000000.00, 1, 27, NULL, NULL),
(28, 2, 38, 1, 11, 7000000, 7770000, 7000000.00, 1, 27, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` bigint(20) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `nama_satuan` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `id_toko`, `nama_satuan`, `created_at`, `updated_at`) VALUES
(6, 2, 'Pcs', NULL, NULL);

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
('gxOYLr7gH24xtZVvAaXEQJInfEMj9T7G1LSQv9r8', 56, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiUjk4Vkx6Z3hhTGREZjluVkJidUE1cmowZ0x0WHBkRTh4ajgzdWxLTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MToibG9naW5fdXNlcl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU2O3M6ODoidXNlcm5hbWUiO3M6MToiYSI7czo5OiJoYWtfYWtzZXMiO2k6MzY7czoxNDoibmFtYV9oYWtfYWtzZXMiO3M6NzoiTWFuYWdlciI7czo3OiJpZF90b2tvIjtzOjI6IjMxIjtzOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGVuZ2FqdWFuVG9rbyI7fX0=', 1733059467),
('rYtitUE9RFRuFq6KoXxaMGj06UPdaOoZ29fsAfzY', 56, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiQmxEVmx2WnFDOW5YeUxrMjRLQlEzRFl3RmFicnAxWEdqV1F1RXRwRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MToibG9naW5fdXNlcl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU2O3M6ODoidXNlcm5hbWUiO3M6MToiYSI7czo5OiJoYWtfYWtzZXMiO2k6MzY7czoxNDoibmFtYV9oYWtfYWtzZXMiO3M6NzoiTWFuYWdlciI7czo3OiJpZF90b2tvIjtzOjI6IjMxIjt9', 1733055960);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` bigint(20) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `kode_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `noHP_supplier` varchar(255) NOT NULL,
  `alamat_supplier` varchar(255) NOT NULL,
  `email_supplier` varchar(191) NOT NULL,
  `STATUS_SUPPLIER` enum('0','1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `alamat_toko` text NOT NULL,
  `email_toko` varchar(191) NOT NULL,
  `tlp` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ppn` varchar(191) DEFAULT NULL,
  `jam_buka` time DEFAULT NULL,
  `jam_tutup` time DEFAULT NULL,
  `toleransi_terlambat` int(11) DEFAULT NULL,
  `denda_keterlambatan` int(11) NOT NULL,
  `lebar_kertas_struk` varchar(191) DEFAULT NULL,
  `format_struk` enum('1','2','3') NOT NULL DEFAULT '1',
  `logo_toko` varchar(191) DEFAULT NULL,
  `gunakan_logo_struk` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak',
  `footer_struk` text NOT NULL DEFAULT '*Terima Kasih Atas Kunjungan Anda*',
  `min_purchase_poin` int(11) NOT NULL DEFAULT 0,
  `poin_interval` int(11) NOT NULL DEFAULT 0,
  `poin_to_rupiah` int(11) NOT NULL DEFAULT 0,
  `status_pengajuan_toko` enum('proses','diterima','ditolak') NOT NULL DEFAULT 'proses',
  `alasan_ditolak` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`, `email_toko`, `tlp`, `nama_pemilik`, `created_at`, `updated_at`, `ppn`, `jam_buka`, `jam_tutup`, `toleransi_terlambat`, `denda_keterlambatan`, `lebar_kertas_struk`, `format_struk`, `logo_toko`, `gunakan_logo_struk`, `footer_struk`, `min_purchase_poin`, `poin_interval`, `poin_to_rupiah`, `status_pengajuan_toko`, `alasan_ditolak`) VALUES
(31, 'asdkfbsnfgbkvjd', 'a', 'a@gmail.com', 'a', 'a', '2024-11-29 22:25:53', '2024-11-30 09:59:19', '11', '09:00:00', '21:00:00', 0, 0, '0', '1', 'toko/31/674b44678a09d.png', 'Tidak', '*Terima Kasih Atas Kunjungan Anda*', 0, 0, 0, 'diterima', NULL),
(32, 'rweqrwre', 'a', 'a@gmail.com', 'a', 'a', '2024-11-29 22:26:29', '2024-11-29 22:26:29', '11', '00:00:00', '00:00:00', 0, 0, '0', '1', '', 'Tidak', '*Terima Kasih Atas Kunjungan Anda*', 0, 0, 0, 'diterima', NULL),
(34, 'a', 'a', 'a@gmail.com', 'a', 'a', '2024-11-30 10:20:35', '2024-11-30 10:30:49', '11', '00:00:00', '00:00:00', 0, 0, '0', '1', 'toko/34/674b4bc9e4ad7.png', 'Tidak', '*Terima Kasih Atas Kunjungan Anda*', 0, 0, 0, 'ditolak', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat_user` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `STATUS_USER` enum('0','1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_hak_akses` bigint(20) UNSIGNED NOT NULL,
  `gaji_harian` int(11) NOT NULL DEFAULT 0,
  `uang_makan` int(11) NOT NULL DEFAULT 0,
  `lembur` int(11) NOT NULL DEFAULT 0,
  `potongan_terlambat` int(11) NOT NULL,
  `check_mengikuti_pengaturan_toko` tinyint(1) NOT NULL,
  `resetPin` varchar(191) DEFAULT NULL,
  `activationPin` varchar(191) DEFAULT NULL,
  `superadmin` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `alamat_user`, `telepon`, `email`, `gambar`, `STATUS_USER`, `created_at`, `updated_at`, `id_hak_akses`, `gaji_harian`, `uang_makan`, `lembur`, `potongan_terlambat`, `check_mengikuti_pengaturan_toko`, `resetPin`, `activationPin`, `superadmin`) VALUES
(56, 'a', 'a', '$2y$12$RRaNAhCLvJtcq8pYMzHEu.kTp1snF1NJuVRKcC8rO0uvoIWUW8g5O', 'a', '1111111', 'a@gmail.com', 'default.jpg', '1', '2024-11-29 22:26:29', '2024-11-29 22:30:30', 36, 0, 0, 0, 0, 0, NULL, NULL, '0'),
(57, 'sdhweiufdbsdh', 'jk', '$2y$12$NWTXKqsrgImoV2bGKiiU2.GToyOLjpkYz7L7mr56i.BJEkJR9J5XS', 'ksjhvd', '809970970', 'aa@gmail.com', 'default.jpg', '0', '2024-11-30 09:41:43', '2024-11-30 09:41:43', 36, 2412, 2343, 234423, 0, 1, NULL, '723931', '0');

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

-- --------------------------------------------------------

--
-- Table structure for table `user_has_toko`
--

CREATE TABLE `user_has_toko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_has_toko`
--

INSERT INTO `user_has_toko` (`id`, `id_user`, `id_toko`) VALUES
(2, 56, 32),
(3, 56, 31),
(4, 57, 32),
(5, 56, 33),
(6, 56, 34);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`,`id_kategori`);

--
-- Indexes for table `barang_has_supplier`
--
ALTER TABLE `barang_has_supplier`
  ADD PRIMARY KEY (`idBarangSupplier`),
  ADD KEY `barang_has_supplier_supplier_idsupplier_index` (`id_supplier`);

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
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indexes for table `diskon_has_barang`
--
ALTER TABLE `diskon_has_barang`
  ADD PRIMARY KEY (`id_diskon_has_barang`),
  ADD KEY `diskon_has_barang_id_diskon_index` (`id_diskon`),
  ADD KEY `diskon_has_barang_id_barang_index` (`id_barang`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gaji_pegawai`
--
ALTER TABLE `gaji_pegawai`
  ADD PRIMARY KEY (`id_gaji_pegawai`);

--
-- Indexes for table `gaji_pegawai_detail`
--
ALTER TABLE `gaji_pegawai_detail`
  ADD PRIMARY KEY (`id_gaji_pegawai_detail`),
  ADD KEY `gaji_pegawai_detail_id_gaji_pegawai_foreign` (`id_gaji_pegawai`);

--
-- Indexes for table `gambar_retur`
--
ALTER TABLE `gambar_retur`
  ADD PRIMARY KEY (`id_gambar_retur`);

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_hak_akses`);

--
-- Indexes for table `hak_akses_menu`
--
ALTER TABLE `hak_akses_menu`
  ADD PRIMARY KEY (`id_hak_akses_menu`),
  ADD KEY `hak_akses_menu_id_hak_akses_foreign` (`id_hak_akses`),
  ADD KEY `hak_akses_menu_id_menu_foreign` (`id_menu`);

--
-- Indexes for table `history_penjualan`
--
ALTER TABLE `history_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `history_poin`
--
ALTER TABLE `history_poin`
  ADD PRIMARY KEY (`id_history_poin`),
  ADD KEY `poin_id_toko_foreign` (`id_toko`);

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
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `nota_id_user_index` (`id_user`),
  ADD KEY `nota_id_customer_index` (`id_customer`);

--
-- Indexes for table `nota_detail`
--
ALTER TABLE `nota_detail`
  ADD PRIMARY KEY (`id_nota_detail`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `perjanjian`
--
ALTER TABLE `perjanjian`
  ADD PRIMARY KEY (`idperjanjian`),
  ADD KEY `perjanjian_id_nota_id_user_id_customer_index` (`id_nota`,`id_user`,`id_customer`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id_purchase_order`);

--
-- Indexes for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  ADD PRIMARY KEY (`id_purchase_order_detail`);

--
-- Indexes for table `receive_order`
--
ALTER TABLE `receive_order`
  ADD PRIMARY KEY (`id_receive_order`);

--
-- Indexes for table `receive_order_detail`
--
ALTER TABLE `receive_order_detail`
  ADD PRIMARY KEY (`id_receive_order_detail`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`idretur`),
  ADD KEY `retur_idperjanjian_foreign` (`idperjanjian`);

--
-- Indexes for table `retur_detail`
--
ALTER TABLE `retur_detail`
  ADD PRIMARY KEY (`idretur_detail`),
  ADD KEY `retur_detail_idretur_id_barang_id_kategori_index` (`idretur`,`id_barang`,`id_kategori`),
  ADD KEY `retur_detail_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_has_toko`
--
ALTER TABLE `user_has_toko`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `barang_has_supplier`
--
ALTER TABLE `barang_has_supplier`
  MODIFY `idBarangSupplier` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id_diskon` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `diskon_has_barang`
--
ALTER TABLE `diskon_has_barang`
  MODIFY `id_diskon_has_barang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gaji_pegawai`
--
ALTER TABLE `gaji_pegawai`
  MODIFY `id_gaji_pegawai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `gaji_pegawai_detail`
--
ALTER TABLE `gaji_pegawai_detail`
  MODIFY `id_gaji_pegawai_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `gambar_retur`
--
ALTER TABLE `gambar_retur`
  MODIFY `id_gambar_retur` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_hak_akses` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `hak_akses_menu`
--
ALTER TABLE `hak_akses_menu`
  MODIFY `id_hak_akses_menu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=490;

--
-- AUTO_INCREMENT for table `history_penjualan`
--
ALTER TABLE `history_penjualan`
  MODIFY `id_penjualan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `history_poin`
--
ALTER TABLE `history_poin`
  MODIFY `id_history_poin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `nota_detail`
--
ALTER TABLE `nota_detail`
  MODIFY `id_nota_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `perjanjian`
--
ALTER TABLE `perjanjian`
  MODIFY `idperjanjian` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id_purchase_order` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  MODIFY `id_purchase_order_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `receive_order`
--
ALTER TABLE `receive_order`
  MODIFY `id_receive_order` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `receive_order_detail`
--
ALTER TABLE `receive_order_detail`
  MODIFY `id_receive_order_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `retur`
--
ALTER TABLE `retur`
  MODIFY `idretur` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `retur_detail`
--
ALTER TABLE `retur_detail`
  MODIFY `idretur_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_has_toko`
--
ALTER TABLE `user_has_toko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diskon_has_barang`
--
ALTER TABLE `diskon_has_barang`
  ADD CONSTRAINT `diskon_has_barang_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `diskon_has_barang_id_diskon_foreign` FOREIGN KEY (`id_diskon`) REFERENCES `diskon` (`id_diskon`) ON DELETE CASCADE;

--
-- Constraints for table `gaji_pegawai_detail`
--
ALTER TABLE `gaji_pegawai_detail`
  ADD CONSTRAINT `gaji_pegawai_detail_id_gaji_pegawai_foreign` FOREIGN KEY (`id_gaji_pegawai`) REFERENCES `gaji_pegawai` (`id_gaji_pegawai`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hak_akses_menu`
--
ALTER TABLE `hak_akses_menu`
  ADD CONSTRAINT `hak_akses_menu_id_hak_akses_foreign` FOREIGN KEY (`id_hak_akses`) REFERENCES `hak_akses` (`id_hak_akses`),
  ADD CONSTRAINT `hak_akses_menu_id_menu_foreign` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Constraints for table `history_poin`
--
ALTER TABLE `history_poin`
  ADD CONSTRAINT `poin_id_toko_foreign` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);

--
-- Constraints for table `retur`
--
ALTER TABLE `retur`
  ADD CONSTRAINT `retur_idperjanjian_foreign` FOREIGN KEY (`idperjanjian`) REFERENCES `perjanjian` (`idperjanjian`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `retur_detail`
--
ALTER TABLE `retur_detail`
  ADD CONSTRAINT `retur_detail_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `retur_detail_idretur_foreign` FOREIGN KEY (`idretur`) REFERENCES `retur` (`idretur`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
