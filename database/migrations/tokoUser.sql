-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 30, 2026 at 04:55 PM
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
-- Database: `timbangan_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `armada`
--

CREATE TABLE `armada` (
  `id_armada` bigint(20) UNSIGNED NOT NULL,
  `kode_armada` varchar(191) NOT NULL,
  `berat_armada` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(1000) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `STATUS_BARANG` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(10) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `nama_customer` varchar(45) NOT NULL,
  `noHP` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `poin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_customer` enum('customer','member') NOT NULL DEFAULT 'customer',
  `status_customer_keaktifan` enum('baru','aktif','hapus') NOT NULL DEFAULT 'baru',
  `kode_customer` varchar(191) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `kecamatan` varchar(191) DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `pengangkutan`
--

CREATE TABLE `pengangkutan` (
  `id_pengangkutan` bigint(20) UNSIGNED NOT NULL,
  `kode_pengangkutan` varchar(191) NOT NULL,
  `id_perusahaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(191) NOT NULL,
  `alamat_perusahaan` varchar(191) DEFAULT NULL,
  `no_telp_perusahaan` varchar(191) DEFAULT NULL,
  `email_perusahaan` varchar(191) DEFAULT NULL,
  `nama_pemegang_pekerjaan` varchar(191) DEFAULT NULL,
  `no_telp_pemegang_pekerjaan` varchar(191) DEFAULT NULL,
  `nama_pemegang_pekerjaan_2` varchar(191) DEFAULT NULL,
  `no_telp_pemegang_pekerjaan_2` varchar(191) DEFAULT NULL,
  `nama_pemegang_pekerjaan_3` varchar(191) DEFAULT NULL,
  `no_telp_pemegang_pekerjaan_3` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relasi`
--

CREATE TABLE `relasi` (
  `id_relasi` bigint(20) UNSIGNED NOT NULL,
  `kode_relasi` varchar(10) NOT NULL,
  `id_perusahaan` bigint(20) UNSIGNED NOT NULL,
  `nama_relasi` varchar(100) NOT NULL,
  `Pot1Persen` int(11) NOT NULL DEFAULT 0,
  `Pot1Kg` int(11) NOT NULL DEFAULT 0,
  `Pot2Persen` int(11) NOT NULL DEFAULT 0,
  `Pot2Kg` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `table_nota_sales_detail`
--

CREATE TABLE `table_nota_sales_detail` (
  `id_nota_sales_detail` bigint(20) UNSIGNED NOT NULL,
  `id_nota_sales` bigint(20) UNSIGNED NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `subtotal_harga` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timbangan`
--

CREATE TABLE `timbangan` (
  `id_timbangan` bigint(20) UNSIGNED NOT NULL,
  `kode_slip` varchar(191) NOT NULL,
  `slip_indate` datetime DEFAULT NULL,
  `slip_outdate` datetime DEFAULT NULL,
  `slip_intime` datetime DEFAULT NULL,
  `slip_outtime` datetime DEFAULT NULL,
  `id_stok` bigint(20) UNSIGNED DEFAULT NULL,
  `kode_stok` varchar(191) NOT NULL,
  `nama_stok` varchar(191) NOT NULL,
  `kode_supplier` varchar(191) NOT NULL,
  `perusahaan_supplier` varchar(191) NOT NULL,
  `id_pengangkutan` bigint(20) UNSIGNED DEFAULT NULL,
  `kode_truk` varchar(191) NOT NULL,
  `noReferensi` varchar(191) NOT NULL,
  `no_polisi` varchar(191) DEFAULT NULL,
  `berat_tarra` int(11) DEFAULT NULL,
  `berat_bruto` int(11) DEFAULT NULL,
  `berat_netto1` int(11) DEFAULT NULL,
  `berat1_potPersen` int(11) DEFAULT NULL,
  `berat1_potKg` int(11) DEFAULT NULL,
  `berat2_potPersen` int(11) DEFAULT NULL,
  `berat2_potKg` int(11) DEFAULT NULL,
  `berat_netto2` int(11) DEFAULT NULL,
  `inisial_tarra` varchar(191) DEFAULT NULL,
  `inisial_berat_tarra` int(11) DEFAULT NULL,
  `catatan` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `driver` varchar(191) NOT NULL,
  `keterangan` varchar(191) NOT NULL,
  `diketahui` varchar(191) NOT NULL,
  `disetujui` varchar(191) NOT NULL,
  `satpam` varchar(191) NOT NULL,
  `id_nota` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama_operator` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armada`
--
ALTER TABLE `armada`
  ADD PRIMARY KEY (`id_armada`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`,`id_kategori`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pengangkutan`
--
ALTER TABLE `pengangkutan`
  ADD PRIMARY KEY (`id_pengangkutan`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `relasi`
--
ALTER TABLE `relasi`
  ADD PRIMARY KEY (`id_relasi`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `table_nota_sales_detail`
--
ALTER TABLE `table_nota_sales_detail`
  ADD PRIMARY KEY (`id_nota_sales_detail`);

--
-- Indexes for table `timbangan`
--
ALTER TABLE `timbangan`
  ADD PRIMARY KEY (`id_timbangan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armada`
--
ALTER TABLE `armada`
  MODIFY `id_armada` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pengangkutan`
--
ALTER TABLE `pengangkutan`
  MODIFY `id_pengangkutan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `relasi`
--
ALTER TABLE `relasi`
  MODIFY `id_relasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `table_nota_sales_detail`
--
ALTER TABLE `table_nota_sales_detail`
  MODIFY `id_nota_sales_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timbangan`
--
ALTER TABLE `timbangan`
  MODIFY `id_timbangan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
