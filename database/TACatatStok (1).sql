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
-- Database: `TACatatStok`
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

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('bab7b5a6cabb4f86285797fb14711a3e', 'i:8;', 1778300778),
('bab7b5a6cabb4f86285797fb14711a3e:timer', 'i:1778300778;', 1778300778);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_hak_akses` bigint(20) UNSIGNED NOT NULL,
  `id_toko` int(11) NOT NULL,
  `nama_hak_akses` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id_hak_akses`, `id_toko`, `nama_hak_akses`, `created_at`, `updated_at`) VALUES
(1, 1, 'MANAGER', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses_menu`
--

CREATE TABLE `hak_akses_menu` (
  `id_hak_akses_menu` bigint(20) UNSIGNED NOT NULL,
  `id_toko` int(11) NOT NULL,
  `id_hak_akses` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hak_akses_menu`
--

INSERT INTO `hak_akses_menu` (`id_hak_akses_menu`, `id_toko`, `id_hak_akses`, `id_menu`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2026-05-06 07:49:55', '2026-05-06 07:49:55'),
(2, 1, 1, 2, '2026-05-06 07:49:55', '2026-05-06 07:49:55'),
(3, 1, 1, 3, '2026-05-06 07:49:55', '2026-05-06 07:49:55'),
(4, 1, 1, 4, '2026-05-06 07:49:55', '2026-05-06 07:49:55'),
(5, 1, 1, 5, '2026-05-06 07:49:55', '2026-05-06 07:49:55'),
(11, 1, 1, 6, NULL, NULL),
(12, 1, 1, 8, NULL, NULL);

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
(1, 1, 'update', 'transaksi', 1, '\"{\\\"id_transaksi\\\":1,\\\"id_barang\\\":1,\\\"tipe_transaksi\\\":\\\"keluar\\\",\\\"jumlah_barang\\\":5,\\\"keterangan_transaksi\\\":\\\"a\\\",\\\"diberikan_oleh\\\":\\\"b\\\",\\\"keperluan_transaksi\\\":\\\"c\\\",\\\"tanggal_transaksi\\\":\\\"2026-05-09\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null,\\\"deleted_at\\\":null}\"', '\"{\\\"id_transaksi\\\":1,\\\"id_barang\\\":1,\\\"tipe_transaksi\\\":\\\"keluar\\\",\\\"jumlah_barang\\\":5,\\\"keterangan_transaksi\\\":\\\"a\\\",\\\"diberikan_oleh\\\":\\\"b\\\",\\\"keperluan_transaksi\\\":\\\"c\\\",\\\"tanggal_transaksi\\\":\\\"2026-05-09\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null,\\\"deleted_at\\\":null}\"', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-05-09 03:56:12', '2026-05-09 03:56:12', '2026-05-09 03:56:12'),
(2, 1, 'update', 'transaksi', 1, '\"{\\\"id_transaksi\\\":1,\\\"id_barang\\\":1,\\\"tipe_transaksi\\\":\\\"keluar\\\",\\\"jumlah_barang\\\":5,\\\"keterangan_transaksi\\\":\\\"a\\\",\\\"diberikan_oleh\\\":\\\"b\\\",\\\"keperluan_transaksi\\\":\\\"c\\\",\\\"tanggal_transaksi\\\":\\\"2026-05-09\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null,\\\"deleted_at\\\":null}\"', '\"{\\\"id_transaksi\\\":1,\\\"id_barang\\\":1,\\\"tipe_transaksi\\\":\\\"keluar\\\",\\\"jumlah_barang\\\":4,\\\"keterangan_transaksi\\\":\\\"a\\\",\\\"diberikan_oleh\\\":\\\"b\\\",\\\"keperluan_transaksi\\\":\\\"c\\\",\\\"tanggal_transaksi\\\":\\\"2026-05-09\\\",\\\"created_at\\\":null,\\\"updated_at\\\":null,\\\"deleted_at\\\":null}\"', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-05-09 03:56:32', '2026-05-09 03:56:32', '2026-05-09 03:56:32'),
(3, 1, 'create', 'transaksi', 2, NULL, '{\"id_transaksi\":2,\"id_barang\":1,\"tipe_transaksi\":\"keluar\",\"jumlah_barang\":1,\"keterangan_transaksi\":null,\"diberikan_oleh\":\"3f\",\"keperluan_transaksi\":\"wffw\",\"tanggal_transaksi\":\"2026-05-09\",\"created_at\":null,\"updated_at\":null,\"deleted_at\":null}', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-05-09 03:58:39', '2026-05-09 03:58:39', '2026-05-09 03:58:39'),
(4, 1, 'update', 'transaksi', 2, '{\"id_transaksi\":2,\"id_barang\":1,\"tipe_transaksi\":\"keluar\",\"jumlah_barang\":1,\"keterangan_transaksi\":null,\"diberikan_oleh\":\"3f\",\"keperluan_transaksi\":\"wffw\",\"tanggal_transaksi\":\"2026-05-09\",\"created_at\":null,\"updated_at\":null,\"deleted_at\":null}', '{\"id_transaksi\":2,\"id_barang\":1,\"tipe_transaksi\":\"keluar\",\"jumlah_barang\":1,\"keterangan_transaksi\":\"ff\",\"diberikan_oleh\":\"3f\",\"keperluan_transaksi\":\"wffw\",\"tanggal_transaksi\":\"2026-05-09\",\"created_at\":null,\"updated_at\":null,\"deleted_at\":null}', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-05-09 04:02:10', '2026-05-09 04:02:10', '2026-05-09 04:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
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
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
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
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `nama_menu` varchar(191) NOT NULL,
  `nama_menu_opsional` varchar(191) DEFAULT NULL,
  `url` varchar(191) NOT NULL,
  `icon` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `nama_menu_opsional`, `url`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'home', '/home', 'home', '2026-05-06 07:41:34', '2026-05-06 07:41:34'),
(2, 'User', 'user', '/user', 'group', '2026-05-06 07:41:34', '2026-05-06 07:41:34'),
(3, 'Hak Akses', 'hakAkses', '/hakAkses', 'key', '2026-05-06 07:41:34', '2026-05-06 07:41:34'),
(4, 'Pengaturan', 'pengaturan', '/pengaturan', 'settings', '2026-05-06 07:41:34', '2026-05-06 07:41:34'),
(5, 'Barang', 'barang', '/barang', 'inventory_2', '2026-05-06 07:41:34', '2026-05-06 07:41:34'),
(6, 'Transaksi', 'transaksi', '/transaksi', 'hand_package', '2026-05-07 07:09:20', '2026-05-07 07:09:20'),
(8, 'Buku Stok', 'bukuStok', '/bukuStok', 'warehouse', '2026-05-09 01:37:54', '2026-05-09 01:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_06_142023_addtablemenu', 2),
(5, '2026_05_06_142127_addtablehakakses', 3),
(6, '2026_05_06_142222_addtablehakaksesdetail', 4),
(7, '2026_05_06_142350_addtablepulse', 5),
(8, '2026_05_06_142432_addtabletoko', 6),
(9, '2026_05_06_142655_create_users_table_custom', 7),
(10, '2026_05_06_143105_create_user_has_toko', 8),
(11, '2026_05_06_143823_insert_data_menu', 9),
(12, '2026_05_06_144312_insert_data_hakakses', 10),
(13, '2026_05_06_144917_insert_data_hakaksesmenu', 11),
(15, '2026_05_06_145126_changeenumtoko', 12),
(16, '2026_05_06_145827_seed_toko_default', 13),
(18, '2026_05_06_150518_renamecolumnusr', 14),
(19, '2026_05_06_152059_altertableuser', 14),
(20, '2026_05_07_082800_create_table_barang', 15),
(21, '2026_05_07_092353_altertablebarang', 16),
(22, '2026_05_07_092709_altertablebarang', 17),
(23, '2026_05_07_135857_createteabletransaksi', 18),
(24, '2026_05_07_140649_addmenutransaksi', 19),
(25, '2026_05_07_144053_altertabletransaksi', 20),
(26, '2026_05_07_150404_altertabletransaksi', 21),
(28, '2026_05_09_083608_addmenubukustok', 22),
(29, '2026_05_09_104723_addtablehistory', 23);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pulse_aggregates`
--

CREATE TABLE `pulse_aggregates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bucket` int(10) UNSIGNED NOT NULL,
  `period` mediumint(8) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `key` mediumtext NOT NULL,
  `key_hash` binary(16) GENERATED ALWAYS AS (unhex(md5(`key`))) VIRTUAL,
  `aggregate` varchar(191) NOT NULL,
  `value` decimal(20,2) NOT NULL,
  `count` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pulse_aggregates`
--

INSERT INTO `pulse_aggregates` (`id`, `bucket`, `period`, `type`, `key`, `aggregate`, `value`, `count`) VALUES
(1, 1778052240, 60, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'count', 2.00, NULL),
(2, 1778052240, 360, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'count', 2.00, NULL),
(3, 1778051520, 1440, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'count', 2.00, NULL),
(4, 1778051520, 10080, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'count', 6.00, NULL),
(5, 1778052240, 60, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'max', 1778052268.00, NULL),
(6, 1778052240, 360, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'max', 1778052268.00, NULL),
(7, 1778051520, 1440, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'max', 1778052268.00, NULL),
(8, 1778051520, 10080, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'max', 1778055538.00, NULL),
(9, 1778053560, 60, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:14\"]', 'count', 2.00, NULL),
(10, 1778053320, 360, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:14\"]', 'count', 2.00, NULL),
(11, 1778052960, 1440, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:14\"]', 'count', 2.00, NULL),
(12, 1778051520, 10080, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:14\"]', 'count', 2.00, NULL),
(13, 1778053560, 60, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:14\"]', 'max', 1778053616.00, NULL),
(14, 1778053320, 360, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:14\"]', 'max', 1778053616.00, NULL),
(15, 1778052960, 1440, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:14\"]', 'max', 1778053616.00, NULL),
(16, 1778051520, 10080, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:14\"]', 'max', 1778053616.00, NULL),
(17, 1778053680, 60, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:15\"]', 'count', 2.00, NULL),
(18, 1778053680, 360, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:15\"]', 'count', 2.00, NULL),
(19, 1778052960, 1440, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:15\"]', 'count', 2.00, NULL),
(20, 1778051520, 10080, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:15\"]', 'count', 2.00, NULL),
(21, 1778053680, 60, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:15\"]', 'max', 1778053699.00, NULL),
(22, 1778053680, 360, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:15\"]', 'max', 1778053699.00, NULL),
(23, 1778052960, 1440, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:15\"]', 'max', 1778053699.00, NULL),
(24, 1778051520, 10080, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:15\"]', 'max', 1778053699.00, NULL),
(25, 1778053920, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:15\"]', 'count', 4.00, NULL),
(26, 1778053680, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:15\"]', 'count', 4.00, NULL),
(27, 1778052960, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:15\"]', 'count', 4.00, NULL),
(28, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:15\"]', 'count', 4.00, NULL),
(29, 1778053920, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:15\"]', 'max', 1778053947.00, NULL),
(30, 1778053680, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:15\"]', 'max', 1778053947.00, NULL),
(31, 1778052960, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:15\"]', 'max', 1778053947.00, NULL),
(32, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:15\"]', 'max', 1778053947.00, NULL),
(41, 1778053980, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:18\"]', 'count', 2.00, NULL),
(42, 1778053680, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:18\"]', 'count', 2.00, NULL),
(43, 1778052960, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:18\"]', 'count', 2.00, NULL),
(44, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:18\"]', 'count', 2.00, NULL),
(45, 1778053980, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:18\"]', 'max', 1778054016.00, NULL),
(46, 1778053680, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:18\"]', 'max', 1778054016.00, NULL),
(47, 1778052960, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:18\"]', 'max', 1778054016.00, NULL),
(48, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:18\"]', 'max', 1778054016.00, NULL),
(49, 1778054040, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:14\"]', 'count', 2.00, NULL),
(50, 1778054040, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:14\"]', 'count', 2.00, NULL),
(51, 1778052960, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:14\"]', 'count', 2.00, NULL),
(52, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:14\"]', 'count', 2.00, NULL),
(53, 1778054040, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:14\"]', 'max', 1778054087.00, NULL),
(54, 1778054040, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:14\"]', 'max', 1778054087.00, NULL),
(55, 1778052960, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:14\"]', 'max', 1778054087.00, NULL),
(56, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:14\"]', 'max', 1778054087.00, NULL),
(57, 1778054160, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145627_seed_toko_default.php:9\"]', 'count', 2.00, NULL),
(58, 1778054040, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145627_seed_toko_default.php:9\"]', 'count', 2.00, NULL),
(59, 1778052960, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145627_seed_toko_default.php:9\"]', 'count', 2.00, NULL),
(60, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145627_seed_toko_default.php:9\"]', 'count', 2.00, NULL),
(61, 1778054160, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145627_seed_toko_default.php:9\"]', 'max', 1778054219.00, NULL),
(62, 1778054040, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145627_seed_toko_default.php:9\"]', 'max', 1778054219.00, NULL),
(63, 1778052960, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145627_seed_toko_default.php:9\"]', 'max', 1778054219.00, NULL),
(64, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145627_seed_toko_default.php:9\"]', 'max', 1778054219.00, NULL),
(65, 1778054700, 60, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'count', 2.00, NULL),
(66, 1778054400, 360, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'count', 2.00, NULL),
(67, 1778054400, 1440, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'count', 4.00, NULL),
(69, 1778054700, 60, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'max', 1778054714.00, NULL),
(70, 1778054400, 360, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'max', 1778054714.00, NULL),
(71, 1778054400, 1440, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'max', 1778055538.00, NULL),
(73, 1778054700, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 'count', 2.00, NULL),
(74, 1778054400, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 'count', 2.00, NULL),
(75, 1778054400, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 'count', 6.00, NULL),
(76, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 'count', 6.00, NULL),
(77, 1778054700, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 'max', 1778054746.00, NULL),
(78, 1778054400, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 'max', 1778054746.00, NULL),
(79, 1778054400, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 'max', 1778054784.00, NULL),
(80, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 'max', 1778054784.00, NULL),
(81, 1778054760, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 'count', 4.00, NULL),
(82, 1778054760, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 'count', 4.00, NULL),
(85, 1778054760, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 'max', 1778054784.00, NULL),
(86, 1778054760, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 'max', 1778054784.00, NULL),
(97, 1778054760, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'count', 2.00, NULL),
(98, 1778054760, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'count', 2.00, NULL),
(99, 1778054400, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'count', 10.00, NULL),
(100, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'count', 10.00, NULL),
(101, 1778054760, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'max', 1778054817.00, NULL),
(102, 1778054760, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'max', 1778054817.00, NULL),
(103, 1778054400, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'max', 1778055773.00, NULL),
(104, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'max', 1778055773.00, NULL),
(105, 1778054880, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:12\"]', 'count', 2.00, NULL),
(106, 1778054760, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:12\"]', 'count', 2.00, NULL),
(107, 1778054400, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:12\"]', 'count', 2.00, NULL),
(108, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:12\"]', 'count', 2.00, NULL),
(109, 1778054880, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:12\"]', 'max', 1778054881.00, NULL),
(110, 1778054760, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:12\"]', 'max', 1778054881.00, NULL),
(111, 1778054400, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:12\"]', 'max', 1778054881.00, NULL),
(112, 1778051520, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:12\"]', 'max', 1778054881.00, NULL),
(113, 1778055480, 60, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'count', 2.00, NULL),
(114, 1778055480, 360, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'count', 2.00, NULL),
(117, 1778055480, 60, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'max', 1778055538.00, NULL),
(118, 1778055480, 360, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 'max', 1778055538.00, NULL),
(121, 1778055540, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'count', 2.00, NULL),
(122, 1778055480, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'count', 8.00, NULL),
(125, 1778055540, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'max', 1778055541.00, NULL),
(126, 1778055480, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'max', 1778055773.00, NULL),
(129, 1778055600, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'count', 4.00, NULL),
(133, 1778055600, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'max', 1778055621.00, NULL),
(145, 1778055720, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'count', 2.00, NULL),
(149, 1778055720, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 'max', 1778055773.00, NULL),
(153, 1778055780, 60, 'exception', '[\"BadMethodCallException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:14\"]', 'count', 2.00, NULL),
(154, 1778055480, 360, 'exception', '[\"BadMethodCallException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:14\"]', 'count', 2.00, NULL),
(155, 1778054400, 1440, 'exception', '[\"BadMethodCallException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:14\"]', 'count', 2.00, NULL),
(156, 1778051520, 10080, 'exception', '[\"BadMethodCallException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:14\"]', 'count', 2.00, NULL),
(157, 1778055780, 60, 'exception', '[\"BadMethodCallException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:14\"]', 'max', 1778055812.00, NULL),
(158, 1778055480, 360, 'exception', '[\"BadMethodCallException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:14\"]', 'max', 1778055812.00, NULL),
(159, 1778054400, 1440, 'exception', '[\"BadMethodCallException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:14\"]', 'max', 1778055812.00, NULL),
(160, 1778051520, 10080, 'exception', '[\"BadMethodCallException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:14\"]', 'max', 1778055812.00, NULL),
(161, 1778055840, 60, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(162, 1778055840, 360, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(163, 1778055840, 1440, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(164, 1778051520, 10080, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(165, 1778055840, 60, 'slow_user_request', '1', 'count', 1.00, NULL),
(166, 1778055840, 360, 'slow_user_request', '1', 'count', 1.00, NULL),
(167, 1778055840, 1440, 'slow_user_request', '1', 'count', 1.00, NULL),
(168, 1778051520, 10080, 'slow_user_request', '1', 'count', 1.00, NULL),
(169, 1778055840, 60, 'user_request', '1', 'count', 4.00, NULL),
(170, 1778055840, 360, 'user_request', '1', 'count', 4.00, NULL),
(171, 1778055840, 1440, 'user_request', '1', 'count', 4.00, NULL),
(172, 1778051520, 10080, 'user_request', '1', 'count', 4.00, NULL),
(173, 1778055840, 60, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1001.00, NULL),
(174, 1778055840, 360, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1001.00, NULL),
(175, 1778055840, 1440, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1001.00, NULL),
(176, 1778051520, 10080, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1001.00, NULL),
(189, 1778117580, 60, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(190, 1778117400, 360, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(191, 1778116320, 1440, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(192, 1778112000, 10080, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(193, 1778117580, 60, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1130.00, NULL),
(194, 1778117400, 360, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1130.00, NULL),
(195, 1778116320, 1440, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1130.00, NULL),
(196, 1778112000, 10080, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1130.00, NULL),
(197, 1778117580, 60, 'user_request', '1', 'count', 5.00, NULL),
(198, 1778117400, 360, 'user_request', '1', 'count', 9.00, NULL),
(199, 1778116320, 1440, 'user_request', '1', 'count', 9.00, NULL),
(200, 1778112000, 10080, 'user_request', '1', 'count', 123.00, NULL),
(217, 1778117640, 60, 'user_request', '1', 'count', 2.00, NULL),
(225, 1778117700, 60, 'user_request', '1', 'count', 2.00, NULL),
(233, 1778117760, 60, 'user_request', '1', 'count', 13.00, NULL),
(234, 1778117760, 360, 'user_request', '1', 'count', 17.00, NULL),
(235, 1778117760, 1440, 'user_request', '1', 'count', 25.00, NULL),
(285, 1778117940, 60, 'user_request', '1', 'count', 4.00, NULL),
(301, 1778118060, 60, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'count', 2.00, NULL),
(302, 1778117760, 360, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'count', 2.00, NULL),
(303, 1778117760, 1440, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'count', 6.00, NULL),
(304, 1778112000, 10080, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'count', 6.00, NULL),
(305, 1778118060, 60, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'max', 1778118113.00, NULL),
(306, 1778117760, 360, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'max', 1778118113.00, NULL),
(307, 1778117760, 1440, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'max', 1778118257.00, NULL),
(308, 1778112000, 10080, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'max', 1778118257.00, NULL),
(309, 1778118180, 60, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'count', 2.00, NULL),
(310, 1778118120, 360, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'count', 4.00, NULL),
(313, 1778118180, 60, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'max', 1778118212.00, NULL),
(314, 1778118120, 360, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'max', 1778118257.00, NULL),
(317, 1778118240, 60, 'exception', '[\"ErrorException\",\"routes\\/web.php:34\"]', 'count', 2.00, NULL),
(318, 1778118120, 360, 'exception', '[\"ErrorException\",\"routes\\/web.php:34\"]', 'count', 2.00, NULL),
(319, 1778117760, 1440, 'exception', '[\"ErrorException\",\"routes\\/web.php:34\"]', 'count', 2.00, NULL),
(320, 1778112000, 10080, 'exception', '[\"ErrorException\",\"routes\\/web.php:34\"]', 'count', 2.00, NULL),
(321, 1778118240, 60, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'count', 2.00, NULL),
(325, 1778118240, 60, 'exception', '[\"ErrorException\",\"routes\\/web.php:34\"]', 'max', 1778118257.00, NULL),
(326, 1778118120, 360, 'exception', '[\"ErrorException\",\"routes\\/web.php:34\"]', 'max', 1778118257.00, NULL),
(327, 1778117760, 1440, 'exception', '[\"ErrorException\",\"routes\\/web.php:34\"]', 'max', 1778118257.00, NULL),
(328, 1778112000, 10080, 'exception', '[\"ErrorException\",\"routes\\/web.php:34\"]', 'max', 1778118257.00, NULL),
(329, 1778118240, 60, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 'max', 1778118257.00, NULL),
(349, 1778118300, 60, 'user_request', '1', 'count', 8.00, NULL),
(350, 1778118120, 360, 'user_request', '1', 'count', 8.00, NULL),
(381, 1778120280, 60, 'user_request', '1', 'count', 8.00, NULL),
(382, 1778120280, 360, 'user_request', '1', 'count', 20.00, NULL),
(383, 1778119200, 1440, 'user_request', '1', 'count', 20.00, NULL),
(413, 1778120340, 60, 'user_request', '1', 'count', 8.00, NULL),
(445, 1778120520, 60, 'user_request', '1', 'count', 4.00, NULL),
(461, 1778120640, 60, 'user_request', '1', 'count', 4.00, NULL),
(462, 1778120640, 360, 'user_request', '1', 'count', 19.00, NULL),
(463, 1778120640, 1440, 'user_request', '1', 'count', 69.00, NULL),
(477, 1778120700, 60, 'user_request', '1', 'count', 4.00, NULL),
(493, 1778120760, 60, 'user_request', '1', 'count', 3.00, NULL),
(505, 1778120820, 60, 'user_request', '1', 'count', 2.00, NULL),
(513, 1778120880, 60, 'user_request', '1', 'count', 6.00, NULL),
(537, 1778121000, 60, 'user_request', '1', 'count', 9.00, NULL),
(538, 1778121000, 360, 'user_request', '1', 'count', 30.00, NULL),
(573, 1778121060, 60, 'user_request', '1', 'count', 5.00, NULL),
(593, 1778121120, 60, 'user_request', '1', 'count', 12.00, NULL),
(641, 1778121180, 60, 'user_request', '1', 'count', 4.00, NULL),
(657, 1778121720, 60, 'user_request', '1', 'count', 13.00, NULL),
(658, 1778121720, 360, 'user_request', '1', 'count', 20.00, NULL),
(709, 1778121780, 60, 'user_request', '1', 'count', 7.00, NULL),
(737, 1778134440, 60, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(738, 1778134320, 360, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(739, 1778133600, 1440, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(740, 1778132160, 10080, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(741, 1778134440, 60, 'slow_user_request', '1', 'count', 1.00, NULL),
(742, 1778134320, 360, 'slow_user_request', '1', 'count', 1.00, NULL),
(743, 1778133600, 1440, 'slow_user_request', '1', 'count', 1.00, NULL),
(744, 1778132160, 10080, 'slow_user_request', '1', 'count', 1.00, NULL),
(745, 1778134440, 60, 'user_request', '1', 'count', 11.00, NULL),
(746, 1778134320, 360, 'user_request', '1', 'count', 28.00, NULL),
(747, 1778133600, 1440, 'user_request', '1', 'count', 28.00, NULL),
(748, 1778132160, 10080, 'user_request', '1', 'count', 131.00, NULL),
(749, 1778134440, 60, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1137.00, NULL),
(750, 1778134320, 360, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1137.00, NULL),
(751, 1778133600, 1440, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1137.00, NULL),
(752, 1778132160, 10080, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1137.00, NULL),
(793, 1778134500, 60, 'user_request', '1', 'count', 3.00, NULL),
(805, 1778134560, 60, 'user_request', '1', 'count', 10.00, NULL),
(845, 1778134620, 60, 'user_request', '1', 'count', 4.00, NULL),
(861, 1778135100, 60, 'user_request', '1', 'count', 2.00, NULL),
(862, 1778135040, 360, 'user_request', '1', 'count', 2.00, NULL),
(863, 1778135040, 1440, 'user_request', '1', 'count', 10.00, NULL),
(869, 1778136180, 60, 'user_request', '1', 'count', 1.00, NULL),
(870, 1778136120, 360, 'user_request', '1', 'count', 8.00, NULL),
(873, 1778136240, 60, 'user_request', '1', 'count', 7.00, NULL),
(901, 1778137020, 60, 'user_request', '1', 'count', 5.00, NULL),
(902, 1778136840, 360, 'user_request', '1', 'count', 5.00, NULL),
(903, 1778136480, 1440, 'user_request', '1', 'count', 49.00, NULL),
(921, 1778137560, 60, 'user_request', '1', 'count', 9.00, NULL),
(922, 1778137560, 360, 'user_request', '1', 'count', 44.00, NULL),
(957, 1778137740, 60, 'user_request', '1', 'count', 31.00, NULL),
(1081, 1778137800, 60, 'user_request', '1', 'count', 4.00, NULL),
(1097, 1778138160, 60, 'user_request', '1', 'count', 12.00, NULL),
(1098, 1778137920, 360, 'user_request', '1', 'count', 12.00, NULL),
(1099, 1778137920, 1440, 'user_request', '1', 'count', 27.00, NULL),
(1145, 1778138280, 60, 'user_request', '1', 'count', 4.00, NULL),
(1146, 1778138280, 360, 'user_request', '1', 'count', 7.00, NULL),
(1161, 1778138340, 60, 'user_request', '1', 'count', 3.00, NULL),
(1173, 1778138880, 60, 'user_request', '1', 'count', 1.00, NULL),
(1174, 1778138640, 360, 'user_request', '1', 'count', 2.00, NULL),
(1177, 1778138940, 60, 'user_request', '1', 'count', 1.00, NULL),
(1181, 1778139000, 60, 'user_request', '1', 'count', 1.00, NULL),
(1182, 1778139000, 360, 'user_request', '1', 'count', 6.00, NULL),
(1185, 1778139060, 60, 'user_request', '1', 'count', 5.00, NULL),
(1205, 1778139600, 60, 'user_request', '1', 'count', 4.00, NULL),
(1206, 1778139360, 360, 'user_request', '1', 'count', 4.00, NULL),
(1207, 1778139360, 1440, 'user_request', '1', 'count', 13.00, NULL),
(1221, 1778139660, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_07_144053_altertabletransaksi.php:15\"]', 'count', 2.00, NULL),
(1222, 1778139360, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_07_144053_altertabletransaksi.php:15\"]', 'count', 2.00, NULL),
(1223, 1778139360, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_07_144053_altertabletransaksi.php:15\"]', 'count', 2.00, NULL),
(1224, 1778132160, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_07_144053_altertabletransaksi.php:15\"]', 'count', 2.00, NULL),
(1225, 1778139660, 60, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_07_144053_altertabletransaksi.php:15\"]', 'max', 1778139705.00, NULL),
(1226, 1778139360, 360, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_07_144053_altertabletransaksi.php:15\"]', 'max', 1778139705.00, NULL),
(1227, 1778139360, 1440, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_07_144053_altertabletransaksi.php:15\"]', 'max', 1778139705.00, NULL),
(1228, 1778132160, 10080, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_07_144053_altertabletransaksi.php:15\"]', 'max', 1778139705.00, NULL),
(1229, 1778139720, 60, 'user_request', '1', 'count', 4.00, NULL),
(1230, 1778139720, 360, 'user_request', '1', 'count', 4.00, NULL),
(1245, 1778140080, 60, 'user_request', '1', 'count', 4.00, NULL),
(1246, 1778140080, 360, 'user_request', '1', 'count', 4.00, NULL),
(1261, 1778140500, 60, 'user_request', '1', 'count', 1.00, NULL),
(1262, 1778140440, 360, 'user_request', '1', 'count', 1.00, NULL),
(1265, 1778141340, 60, 'user_request', '1', 'count', 4.00, NULL),
(1266, 1778141160, 360, 'user_request', '1', 'count', 4.00, NULL),
(1267, 1778140800, 1440, 'user_request', '1', 'count', 4.00, NULL),
(1278, 1778290320, 60, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(1279, 1778290200, 360, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(1280, 1778289120, 1440, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(1281, 1778283360, 10080, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'count', 1.00, NULL),
(1282, 1778290320, 60, 'slow_user_request', '1', 'count', 1.00, NULL),
(1283, 1778290200, 360, 'slow_user_request', '1', 'count', 1.00, NULL),
(1284, 1778289120, 1440, 'slow_user_request', '1', 'count', 1.00, NULL),
(1285, 1778283360, 10080, 'slow_user_request', '1', 'count', 1.00, NULL),
(1286, 1778290320, 60, 'user_request', '1', 'count', 4.00, NULL),
(1287, 1778290200, 360, 'user_request', '1', 'count', 15.00, NULL),
(1288, 1778289120, 1440, 'user_request', '1', 'count', 15.00, NULL),
(1289, 1778283360, 10080, 'user_request', '1', 'count', 163.00, NULL),
(1290, 1778290320, 60, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1075.00, NULL),
(1291, 1778290200, 360, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1075.00, NULL),
(1292, 1778289120, 1440, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1075.00, NULL),
(1293, 1778283360, 10080, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 'max', 1075.00, NULL),
(1306, 1778290440, 60, 'user_request', '1', 'count', 3.00, NULL),
(1318, 1778290500, 60, 'user_request', '1', 'count', 8.00, NULL),
(1350, 1778290680, 60, 'user_request', '1', 'count', 7.00, NULL),
(1351, 1778290560, 360, 'user_request', '1', 'count', 45.00, NULL),
(1352, 1778290560, 1440, 'user_request', '1', 'count', 105.00, NULL),
(1378, 1778290800, 60, 'user_request', '1', 'count', 6.00, NULL),
(1402, 1778290860, 60, 'user_request', '1', 'count', 32.00, NULL),
(1530, 1778290920, 60, 'user_request', '1', 'count', 42.00, NULL),
(1531, 1778290920, 360, 'user_request', '1', 'count', 53.00, NULL),
(1698, 1778290980, 60, 'user_request', '1', 'count', 11.00, NULL),
(1742, 1778291460, 60, 'user_request', '1', 'count', 3.00, NULL),
(1743, 1778291280, 360, 'user_request', '1', 'count', 7.00, NULL),
(1754, 1778291580, 60, 'user_request', '1', 'count', 4.00, NULL),
(1770, 1778292720, 60, 'user_request', '1', 'count', 6.00, NULL),
(1771, 1778292720, 360, 'user_request', '1', 'count', 6.00, NULL),
(1772, 1778292000, 1440, 'user_request', '1', 'count', 43.00, NULL),
(1794, 1778293200, 60, 'user_request', '1', 'count', 3.00, NULL),
(1795, 1778293080, 360, 'user_request', '1', 'count', 37.00, NULL),
(1806, 1778293260, 60, 'user_request', '1', 'count', 3.00, NULL),
(1818, 1778293320, 60, 'user_request', '1', 'count', 17.00, NULL),
(1886, 1778293380, 60, 'user_request', '1', 'count', 14.00, NULL),
(1942, 1778293500, 60, 'user_request', '1', 'count', 4.00, NULL),
(1943, 1778293440, 360, 'user_request', '1', 'count', 4.00, NULL),
(1944, 1778293440, 1440, 'user_request', '1', 'count', 64.00, NULL),
(1945, 1778293440, 10080, 'user_request', '1', 'count', 405.00, NULL),
(1958, 1778294160, 60, 'user_request', '1', 'count', 12.00, NULL),
(1959, 1778294160, 360, 'user_request', '1', 'count', 28.00, NULL),
(2006, 1778294280, 60, 'user_request', '1', 'count', 12.00, NULL),
(2054, 1778294460, 60, 'user_request', '1', 'count', 4.00, NULL),
(2070, 1778294520, 60, 'user_request', '1', 'count', 8.00, NULL),
(2071, 1778294520, 360, 'user_request', '1', 'count', 32.00, NULL),
(2102, 1778294640, 60, 'user_request', '1', 'count', 4.00, NULL),
(2118, 1778294700, 60, 'user_request', '1', 'count', 8.00, NULL),
(2150, 1778294760, 60, 'user_request', '1', 'count', 4.00, NULL),
(2166, 1778294820, 60, 'user_request', '1', 'count', 8.00, NULL),
(2198, 1778294880, 60, 'user_request', '1', 'count', 4.00, NULL),
(2199, 1778294880, 360, 'user_request', '1', 'count', 24.00, NULL),
(2200, 1778294880, 1440, 'user_request', '1', 'count', 129.00, NULL),
(2214, 1778295000, 60, 'user_request', '1', 'count', 6.00, NULL),
(2238, 1778295180, 60, 'user_request', '1', 'count', 14.00, NULL),
(2294, 1778295300, 60, 'user_request', '1', 'count', 11.00, NULL),
(2295, 1778295240, 360, 'user_request', '1', 'count', 26.00, NULL),
(2338, 1778295360, 60, 'user_request', '1', 'count', 10.00, NULL),
(2378, 1778295480, 60, 'user_request', '1', 'count', 5.00, NULL),
(2398, 1778295600, 60, 'user_request', '1', 'count', 3.00, NULL),
(2399, 1778295600, 360, 'user_request', '1', 'count', 24.00, NULL),
(2410, 1778295660, 60, 'user_request', '1', 'count', 1.00, NULL),
(2414, 1778295720, 60, 'user_request', '1', 'count', 8.00, NULL),
(2446, 1778295840, 60, 'user_request', '1', 'count', 1.00, NULL),
(2450, 1778295900, 60, 'user_request', '1', 'count', 11.00, NULL),
(2494, 1778295960, 60, 'user_request', '1', 'count', 11.00, NULL),
(2495, 1778295960, 360, 'user_request', '1', 'count', 55.00, NULL),
(2538, 1778296020, 60, 'user_request', '1', 'count', 7.00, NULL),
(2566, 1778296080, 60, 'user_request', '1', 'count', 6.00, NULL),
(2590, 1778296140, 60, 'user_request', '1', 'count', 6.00, NULL),
(2614, 1778296200, 60, 'user_request', '1', 'count', 15.00, NULL),
(2674, 1778296260, 60, 'user_request', '1', 'count', 10.00, NULL),
(2714, 1778296320, 60, 'user_request', '1', 'count', 5.00, NULL),
(2715, 1778296320, 360, 'user_request', '1', 'count', 25.00, NULL),
(2716, 1778296320, 1440, 'user_request', '1', 'count', 52.00, NULL),
(2734, 1778296380, 60, 'user_request', '1', 'count', 11.00, NULL),
(2778, 1778296440, 60, 'user_request', '1', 'count', 4.00, NULL),
(2794, 1778296560, 60, 'user_request', '1', 'count', 2.00, NULL),
(2802, 1778296620, 60, 'user_request', '1', 'count', 3.00, NULL),
(2814, 1778296980, 60, 'user_request', '1', 'count', 1.00, NULL),
(2815, 1778296680, 360, 'user_request', '1', 'count', 1.00, NULL),
(2818, 1778297040, 60, 'user_request', '1', 'count', 2.00, NULL),
(2819, 1778297040, 360, 'user_request', '1', 'count', 14.00, NULL),
(2826, 1778297100, 60, 'user_request', '1', 'count', 2.00, NULL),
(2834, 1778297220, 60, 'user_request', '1', 'count', 10.00, NULL),
(2874, 1778297400, 60, 'user_request', '1', 'count', 3.00, NULL),
(2875, 1778297400, 360, 'user_request', '1', 'count', 12.00, NULL),
(2886, 1778297460, 60, 'user_request', '1', 'count', 6.00, NULL),
(2910, 1778297580, 60, 'user_request', '1', 'count', 3.00, NULL),
(2922, 1778298000, 60, 'user_request', '1', 'count', 6.00, NULL),
(2923, 1778297760, 360, 'user_request', '1', 'count', 9.00, NULL),
(2924, 1778297760, 1440, 'user_request', '1', 'count', 72.00, NULL),
(2946, 1778298060, 60, 'user_request', '1', 'count', 3.00, NULL),
(2958, 1778298180, 60, 'user_request', '1', 'count', 6.00, NULL),
(2959, 1778298120, 360, 'user_request', '1', 'count', 31.00, NULL),
(2982, 1778298240, 60, 'user_request', '1', 'count', 6.00, NULL),
(3006, 1778298360, 60, 'user_request', '1', 'count', 19.00, NULL),
(3082, 1778298960, 60, 'user_request', '1', 'count', 26.00, NULL),
(3083, 1778298840, 360, 'user_request', '1', 'count', 32.00, NULL),
(3186, 1778299080, 60, 'user_request', '1', 'count', 6.00, NULL),
(3210, 1778299320, 60, 'user_request', '1', 'count', 3.00, NULL),
(3211, 1778299200, 360, 'user_request', '1', 'count', 13.00, NULL),
(3212, 1778299200, 1440, 'user_request', '1', 'count', 77.00, NULL),
(3222, 1778299440, 60, 'user_request', '1', 'count', 8.00, NULL),
(3254, 1778299500, 60, 'user_request', '1', 'count', 2.00, NULL),
(3262, 1778299680, 60, 'user_request', '1', 'count', 1.00, NULL),
(3263, 1778299560, 360, 'user_request', '1', 'count', 1.00, NULL),
(3266, 1778300040, 60, 'user_request', '1', 'count', 5.00, NULL),
(3267, 1778299920, 360, 'user_request', '1', 'count', 15.00, NULL),
(3286, 1778300220, 60, 'user_request', '1', 'count', 10.00, NULL),
(3326, 1778300280, 60, 'user_request', '1', 'count', 14.00, NULL),
(3327, 1778300280, 360, 'user_request', '1', 'count', 48.00, NULL),
(3382, 1778300400, 60, 'user_request', '1', 'count', 4.00, NULL),
(3398, 1778300460, 60, 'user_request', '1', 'count', 30.00, NULL),
(3518, 1778300640, 60, 'user_request', '1', 'count', 3.00, NULL),
(3519, 1778300640, 360, 'user_request', '1', 'count', 11.00, NULL),
(3520, 1778300640, 1440, 'user_request', '1', 'count', 11.00, NULL),
(3530, 1778300700, 60, 'user_request', '1', 'count', 8.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pulse_entries`
--

CREATE TABLE `pulse_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `key` mediumtext NOT NULL,
  `key_hash` binary(16) GENERATED ALWAYS AS (unhex(md5(`key`))) VIRTUAL,
  `value` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pulse_entries`
--

INSERT INTO `pulse_entries` (`id`, `timestamp`, `type`, `key`, `value`) VALUES
(1, 1778052268, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 1778052268),
(2, 1778052268, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 1778052268),
(3, 1778053616, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:14\"]', 1778053616),
(4, 1778053616, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:14\"]', 1778053616),
(5, 1778053699, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:15\"]', 1778053699),
(6, 1778053699, 'exception', '[\"ErrorException\",\"database\\/migrations\\/2026_05_06_144442_adddatauser.php:15\"]', 1778053699),
(7, 1778053924, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:15\"]', 1778053924),
(8, 1778053924, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:15\"]', 1778053924),
(9, 1778053947, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:15\"]', 1778053947),
(10, 1778053947, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:15\"]', 1778053947),
(11, 1778054016, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:18\"]', 1778054016),
(12, 1778054016, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:18\"]', 1778054016),
(13, 1778054087, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:14\"]', 1778054087),
(14, 1778054087, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145126_changeenumtoko.php:14\"]', 1778054087),
(15, 1778054219, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145627_seed_toko_default.php:9\"]', 1778054219),
(16, 1778054219, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_145627_seed_toko_default.php:9\"]', 1778054219),
(17, 1778054714, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 1778054714),
(18, 1778054714, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 1778054714),
(19, 1778054746, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 1778054746),
(20, 1778054746, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 1778054746),
(21, 1778054774, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 1778054774),
(22, 1778054774, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 1778054774),
(23, 1778054784, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 1778054784),
(24, 1778054784, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:15\"]', 1778054784),
(25, 1778054817, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 1778054817),
(26, 1778054817, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 1778054817),
(27, 1778054881, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:12\"]', 1778054881),
(28, 1778054881, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:12\"]', 1778054881),
(29, 1778055538, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 1778055538),
(30, 1778055538, 'exception', '[\"Symfony\\\\Component\\\\Console\\\\Exception\\\\CommandNotFoundException\",\"vendor\\/symfony\\/console\\/Application.php:759\"]', 1778055538),
(31, 1778055541, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 1778055541),
(32, 1778055541, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 1778055541),
(33, 1778055610, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 1778055610),
(34, 1778055610, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 1778055610),
(35, 1778055621, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 1778055621),
(36, 1778055621, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 1778055621),
(37, 1778055773, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 1778055773),
(38, 1778055773, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:11\"]', 1778055773),
(39, 1778055812, 'exception', '[\"BadMethodCallException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:14\"]', 1778055812),
(40, 1778055812, 'exception', '[\"BadMethodCallException\",\"database\\/migrations\\/2026_05_06_150518_renamecolumnusr.php:14\"]', 1778055812),
(41, 1778055847, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 1001),
(42, 1778055847, 'slow_user_request', '1', NULL),
(43, 1778055847, 'user_request', '1', NULL),
(44, 1778055848, 'user_request', '1', NULL),
(45, 1778055848, 'user_request', '1', NULL),
(46, 1778055848, 'user_request', '1', NULL),
(47, 1778117630, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 1130),
(48, 1778117636, 'user_request', '1', NULL),
(49, 1778117637, 'user_request', '1', NULL),
(50, 1778117637, 'user_request', '1', NULL),
(51, 1778117637, 'user_request', '1', NULL),
(52, 1778117639, 'user_request', '1', NULL),
(53, 1778117678, 'user_request', '1', NULL),
(54, 1778117690, 'user_request', '1', NULL),
(55, 1778117708, 'user_request', '1', NULL),
(56, 1778117735, 'user_request', '1', NULL),
(57, 1778117803, 'user_request', '1', NULL),
(58, 1778117803, 'user_request', '1', NULL),
(59, 1778117803, 'user_request', '1', NULL),
(60, 1778117806, 'user_request', '1', NULL),
(61, 1778117806, 'user_request', '1', NULL),
(62, 1778117806, 'user_request', '1', NULL),
(63, 1778117806, 'user_request', '1', NULL),
(64, 1778117807, 'user_request', '1', NULL),
(65, 1778117810, 'user_request', '1', NULL),
(66, 1778117810, 'user_request', '1', NULL),
(67, 1778117810, 'user_request', '1', NULL),
(68, 1778117810, 'user_request', '1', NULL),
(69, 1778117812, 'user_request', '1', NULL),
(70, 1778117959, 'user_request', '1', NULL),
(71, 1778117959, 'user_request', '1', NULL),
(72, 1778117959, 'user_request', '1', NULL),
(73, 1778117959, 'user_request', '1', NULL),
(74, 1778118113, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 1778118113),
(75, 1778118113, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 1778118113),
(76, 1778118212, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 1778118212),
(77, 1778118212, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 1778118212),
(78, 1778118257, 'exception', '[\"ErrorException\",\"routes\\/web.php:34\"]', 1778118257),
(79, 1778118257, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 1778118257),
(80, 1778118257, 'exception', '[\"ErrorException\",\"routes\\/web.php:34\"]', 1778118257),
(81, 1778118257, 'exception', '[\"ErrorException\",\"app\\/Http\\/Middleware\\/SetDynamicDatabase.php:94\"]', 1778118257),
(82, 1778118317, 'user_request', '1', NULL),
(83, 1778118317, 'user_request', '1', NULL),
(84, 1778118317, 'user_request', '1', NULL),
(85, 1778118318, 'user_request', '1', NULL),
(86, 1778118320, 'user_request', '1', NULL),
(87, 1778118320, 'user_request', '1', NULL),
(88, 1778118320, 'user_request', '1', NULL),
(89, 1778118320, 'user_request', '1', NULL),
(90, 1778120327, 'user_request', '1', NULL),
(91, 1778120327, 'user_request', '1', NULL),
(92, 1778120327, 'user_request', '1', NULL),
(93, 1778120327, 'user_request', '1', NULL),
(94, 1778120337, 'user_request', '1', NULL),
(95, 1778120337, 'user_request', '1', NULL),
(96, 1778120337, 'user_request', '1', NULL),
(97, 1778120337, 'user_request', '1', NULL),
(98, 1778120346, 'user_request', '1', NULL),
(99, 1778120346, 'user_request', '1', NULL),
(100, 1778120346, 'user_request', '1', NULL),
(101, 1778120346, 'user_request', '1', NULL),
(102, 1778120369, 'user_request', '1', NULL),
(103, 1778120369, 'user_request', '1', NULL),
(104, 1778120370, 'user_request', '1', NULL),
(105, 1778120370, 'user_request', '1', NULL),
(106, 1778120531, 'user_request', '1', NULL),
(107, 1778120532, 'user_request', '1', NULL),
(108, 1778120532, 'user_request', '1', NULL),
(109, 1778120532, 'user_request', '1', NULL),
(110, 1778120696, 'user_request', '1', NULL),
(111, 1778120697, 'user_request', '1', NULL),
(112, 1778120697, 'user_request', '1', NULL),
(113, 1778120697, 'user_request', '1', NULL),
(114, 1778120717, 'user_request', '1', NULL),
(115, 1778120721, 'user_request', '1', NULL),
(116, 1778120738, 'user_request', '1', NULL),
(117, 1778120757, 'user_request', '1', NULL),
(118, 1778120777, 'user_request', '1', NULL),
(119, 1778120797, 'user_request', '1', NULL),
(120, 1778120804, 'user_request', '1', NULL),
(121, 1778120878, 'user_request', '1', NULL),
(122, 1778120878, 'user_request', '1', NULL),
(123, 1778120900, 'user_request', '1', NULL),
(124, 1778120903, 'user_request', '1', NULL),
(125, 1778120903, 'user_request', '1', NULL),
(126, 1778120904, 'user_request', '1', NULL),
(127, 1778120906, 'user_request', '1', NULL),
(128, 1778120907, 'user_request', '1', NULL),
(129, 1778121006, 'user_request', '1', NULL),
(130, 1778121006, 'user_request', '1', NULL),
(131, 1778121006, 'user_request', '1', NULL),
(132, 1778121006, 'user_request', '1', NULL),
(133, 1778121008, 'user_request', '1', NULL),
(134, 1778121059, 'user_request', '1', NULL),
(135, 1778121059, 'user_request', '1', NULL),
(136, 1778121059, 'user_request', '1', NULL),
(137, 1778121059, 'user_request', '1', NULL),
(138, 1778121106, 'user_request', '1', NULL),
(139, 1778121106, 'user_request', '1', NULL),
(140, 1778121106, 'user_request', '1', NULL),
(141, 1778121106, 'user_request', '1', NULL),
(142, 1778121107, 'user_request', '1', NULL),
(143, 1778121135, 'user_request', '1', NULL),
(144, 1778121135, 'user_request', '1', NULL),
(145, 1778121135, 'user_request', '1', NULL),
(146, 1778121135, 'user_request', '1', NULL),
(147, 1778121136, 'user_request', '1', NULL),
(148, 1778121140, 'user_request', '1', NULL),
(149, 1778121140, 'user_request', '1', NULL),
(150, 1778121144, 'user_request', '1', NULL),
(151, 1778121144, 'user_request', '1', NULL),
(152, 1778121146, 'user_request', '1', NULL),
(153, 1778121149, 'user_request', '1', NULL),
(154, 1778121149, 'user_request', '1', NULL),
(155, 1778121185, 'user_request', '1', NULL),
(156, 1778121185, 'user_request', '1', NULL),
(157, 1778121185, 'user_request', '1', NULL),
(158, 1778121185, 'user_request', '1', NULL),
(159, 1778121770, 'user_request', '1', NULL),
(160, 1778121774, 'user_request', '1', NULL),
(161, 1778121774, 'user_request', '1', NULL),
(162, 1778121774, 'user_request', '1', NULL),
(163, 1778121774, 'user_request', '1', NULL),
(164, 1778121776, 'user_request', '1', NULL),
(165, 1778121776, 'user_request', '1', NULL),
(166, 1778121776, 'user_request', '1', NULL),
(167, 1778121776, 'user_request', '1', NULL),
(168, 1778121778, 'user_request', '1', NULL),
(169, 1778121778, 'user_request', '1', NULL),
(170, 1778121778, 'user_request', '1', NULL),
(171, 1778121778, 'user_request', '1', NULL),
(172, 1778121785, 'user_request', '1', NULL),
(173, 1778121785, 'user_request', '1', NULL),
(174, 1778121786, 'user_request', '1', NULL),
(175, 1778121796, 'user_request', '1', NULL),
(176, 1778121796, 'user_request', '1', NULL),
(177, 1778121796, 'user_request', '1', NULL),
(178, 1778121796, 'user_request', '1', NULL),
(179, 1778134455, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 1137),
(180, 1778134455, 'slow_user_request', '1', NULL),
(181, 1778134455, 'user_request', '1', NULL),
(182, 1778134456, 'user_request', '1', NULL),
(183, 1778134456, 'user_request', '1', NULL),
(184, 1778134456, 'user_request', '1', NULL),
(185, 1778134459, 'user_request', '1', NULL),
(186, 1778134459, 'user_request', '1', NULL),
(187, 1778134459, 'user_request', '1', NULL),
(188, 1778134467, 'user_request', '1', NULL),
(189, 1778134467, 'user_request', '1', NULL),
(190, 1778134467, 'user_request', '1', NULL),
(191, 1778134467, 'user_request', '1', NULL),
(192, 1778134557, 'user_request', '1', NULL),
(193, 1778134557, 'user_request', '1', NULL),
(194, 1778134557, 'user_request', '1', NULL),
(195, 1778134566, 'user_request', '1', NULL),
(196, 1778134566, 'user_request', '1', NULL),
(197, 1778134566, 'user_request', '1', NULL),
(198, 1778134566, 'user_request', '1', NULL),
(199, 1778134584, 'user_request', '1', NULL),
(200, 1778134584, 'user_request', '1', NULL),
(201, 1778134584, 'user_request', '1', NULL),
(202, 1778134611, 'user_request', '1', NULL),
(203, 1778134611, 'user_request', '1', NULL),
(204, 1778134611, 'user_request', '1', NULL),
(205, 1778134623, 'user_request', '1', NULL),
(206, 1778134623, 'user_request', '1', NULL),
(207, 1778134623, 'user_request', '1', NULL),
(208, 1778134624, 'user_request', '1', NULL),
(209, 1778135102, 'user_request', '1', NULL),
(210, 1778135109, 'user_request', '1', NULL),
(211, 1778136202, 'user_request', '1', NULL),
(212, 1778136254, 'user_request', '1', NULL),
(213, 1778136254, 'user_request', '1', NULL),
(214, 1778136254, 'user_request', '1', NULL),
(215, 1778136254, 'user_request', '1', NULL),
(216, 1778136257, 'user_request', '1', NULL),
(217, 1778136257, 'user_request', '1', NULL),
(218, 1778136257, 'user_request', '1', NULL),
(219, 1778137056, 'user_request', '1', NULL),
(220, 1778137059, 'user_request', '1', NULL),
(221, 1778137059, 'user_request', '1', NULL),
(222, 1778137059, 'user_request', '1', NULL),
(223, 1778137059, 'user_request', '1', NULL),
(224, 1778137594, 'user_request', '1', NULL),
(225, 1778137594, 'user_request', '1', NULL),
(226, 1778137594, 'user_request', '1', NULL),
(227, 1778137594, 'user_request', '1', NULL),
(228, 1778137597, 'user_request', '1', NULL),
(229, 1778137597, 'user_request', '1', NULL),
(230, 1778137597, 'user_request', '1', NULL),
(231, 1778137597, 'user_request', '1', NULL),
(232, 1778137599, 'user_request', '1', NULL),
(233, 1778137783, 'user_request', '1', NULL),
(234, 1778137783, 'user_request', '1', NULL),
(235, 1778137783, 'user_request', '1', NULL),
(236, 1778137783, 'user_request', '1', NULL),
(237, 1778137784, 'user_request', '1', NULL),
(238, 1778137786, 'user_request', '1', NULL),
(239, 1778137787, 'user_request', '1', NULL),
(240, 1778137787, 'user_request', '1', NULL),
(241, 1778137788, 'user_request', '1', NULL),
(242, 1778137788, 'user_request', '1', NULL),
(243, 1778137788, 'user_request', '1', NULL),
(244, 1778137792, 'user_request', '1', NULL),
(245, 1778137792, 'user_request', '1', NULL),
(246, 1778137792, 'user_request', '1', NULL),
(247, 1778137792, 'user_request', '1', NULL),
(248, 1778137792, 'user_request', '1', NULL),
(249, 1778137792, 'user_request', '1', NULL),
(250, 1778137792, 'user_request', '1', NULL),
(251, 1778137792, 'user_request', '1', NULL),
(252, 1778137792, 'user_request', '1', NULL),
(253, 1778137792, 'user_request', '1', NULL),
(254, 1778137793, 'user_request', '1', NULL),
(255, 1778137793, 'user_request', '1', NULL),
(256, 1778137793, 'user_request', '1', NULL),
(257, 1778137793, 'user_request', '1', NULL),
(258, 1778137793, 'user_request', '1', NULL),
(259, 1778137793, 'user_request', '1', NULL),
(260, 1778137793, 'user_request', '1', NULL),
(261, 1778137793, 'user_request', '1', NULL),
(262, 1778137793, 'user_request', '1', NULL),
(263, 1778137793, 'user_request', '1', NULL),
(264, 1778137802, 'user_request', '1', NULL),
(265, 1778137802, 'user_request', '1', NULL),
(266, 1778137803, 'user_request', '1', NULL),
(267, 1778137803, 'user_request', '1', NULL),
(268, 1778138170, 'user_request', '1', NULL),
(269, 1778138170, 'user_request', '1', NULL),
(270, 1778138170, 'user_request', '1', NULL),
(271, 1778138170, 'user_request', '1', NULL),
(272, 1778138181, 'user_request', '1', NULL),
(273, 1778138181, 'user_request', '1', NULL),
(274, 1778138181, 'user_request', '1', NULL),
(275, 1778138181, 'user_request', '1', NULL),
(276, 1778138187, 'user_request', '1', NULL),
(277, 1778138187, 'user_request', '1', NULL),
(278, 1778138187, 'user_request', '1', NULL),
(279, 1778138187, 'user_request', '1', NULL),
(280, 1778138309, 'user_request', '1', NULL),
(281, 1778138309, 'user_request', '1', NULL),
(282, 1778138309, 'user_request', '1', NULL),
(283, 1778138309, 'user_request', '1', NULL),
(284, 1778138373, 'user_request', '1', NULL),
(285, 1778138374, 'user_request', '1', NULL),
(286, 1778138374, 'user_request', '1', NULL),
(287, 1778138893, 'user_request', '1', NULL),
(288, 1778138972, 'user_request', '1', NULL),
(289, 1778139003, 'user_request', '1', NULL),
(290, 1778139075, 'user_request', '1', NULL),
(291, 1778139091, 'user_request', '1', NULL),
(292, 1778139091, 'user_request', '1', NULL),
(293, 1778139092, 'user_request', '1', NULL),
(294, 1778139092, 'user_request', '1', NULL),
(295, 1778139619, 'user_request', '1', NULL),
(296, 1778139620, 'user_request', '1', NULL),
(297, 1778139620, 'user_request', '1', NULL),
(298, 1778139620, 'user_request', '1', NULL),
(299, 1778139705, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_07_144053_altertabletransaksi.php:15\"]', 1778139705),
(300, 1778139705, 'exception', '[\"Illuminate\\\\Database\\\\QueryException\",\"database\\/migrations\\/2026_05_07_144053_altertabletransaksi.php:15\"]', 1778139705),
(301, 1778139728, 'user_request', '1', NULL),
(302, 1778139729, 'user_request', '1', NULL),
(303, 1778139729, 'user_request', '1', NULL),
(304, 1778139729, 'user_request', '1', NULL),
(305, 1778140126, 'user_request', '1', NULL),
(306, 1778140126, 'user_request', '1', NULL),
(307, 1778140126, 'user_request', '1', NULL),
(308, 1778140126, 'user_request', '1', NULL),
(309, 1778140520, 'user_request', '1', NULL),
(310, 1778141382, 'user_request', '1', NULL),
(311, 1778141382, 'user_request', '1', NULL),
(312, 1778141382, 'user_request', '1', NULL),
(313, 1778141382, 'user_request', '1', NULL),
(347, 1778290361, 'slow_request', '[\"POST\",\"\\/login\",\"App\\\\Http\\\\Controllers\\\\Auth\\\\LoginController@login\"]', 1075),
(348, 1778290361, 'slow_user_request', '1', NULL),
(349, 1778290361, 'user_request', '1', NULL),
(350, 1778290362, 'user_request', '1', NULL),
(351, 1778290362, 'user_request', '1', NULL),
(352, 1778290362, 'user_request', '1', NULL),
(353, 1778290485, 'user_request', '1', NULL),
(354, 1778290485, 'user_request', '1', NULL),
(355, 1778290485, 'user_request', '1', NULL),
(356, 1778290510, 'user_request', '1', NULL),
(357, 1778290510, 'user_request', '1', NULL),
(358, 1778290510, 'user_request', '1', NULL),
(359, 1778290510, 'user_request', '1', NULL),
(360, 1778290511, 'user_request', '1', NULL),
(361, 1778290511, 'user_request', '1', NULL),
(362, 1778290511, 'user_request', '1', NULL),
(363, 1778290511, 'user_request', '1', NULL),
(364, 1778290689, 'user_request', '1', NULL),
(365, 1778290690, 'user_request', '1', NULL),
(366, 1778290690, 'user_request', '1', NULL),
(367, 1778290690, 'user_request', '1', NULL),
(368, 1778290690, 'user_request', '1', NULL),
(369, 1778290693, 'user_request', '1', NULL),
(370, 1778290694, 'user_request', '1', NULL),
(371, 1778290817, 'user_request', '1', NULL),
(372, 1778290818, 'user_request', '1', NULL),
(373, 1778290818, 'user_request', '1', NULL),
(374, 1778290818, 'user_request', '1', NULL),
(375, 1778290857, 'user_request', '1', NULL),
(376, 1778290859, 'user_request', '1', NULL),
(377, 1778290867, 'user_request', '1', NULL),
(378, 1778290867, 'user_request', '1', NULL),
(379, 1778290867, 'user_request', '1', NULL),
(380, 1778290867, 'user_request', '1', NULL),
(381, 1778290867, 'user_request', '1', NULL),
(382, 1778290867, 'user_request', '1', NULL),
(383, 1778290867, 'user_request', '1', NULL),
(384, 1778290869, 'user_request', '1', NULL),
(385, 1778290869, 'user_request', '1', NULL),
(386, 1778290869, 'user_request', '1', NULL),
(387, 1778290869, 'user_request', '1', NULL),
(388, 1778290869, 'user_request', '1', NULL),
(389, 1778290869, 'user_request', '1', NULL),
(390, 1778290869, 'user_request', '1', NULL),
(391, 1778290890, 'user_request', '1', NULL),
(392, 1778290890, 'user_request', '1', NULL),
(393, 1778290890, 'user_request', '1', NULL),
(394, 1778290890, 'user_request', '1', NULL),
(395, 1778290890, 'user_request', '1', NULL),
(396, 1778290890, 'user_request', '1', NULL),
(397, 1778290890, 'user_request', '1', NULL),
(398, 1778290891, 'user_request', '1', NULL),
(399, 1778290891, 'user_request', '1', NULL),
(400, 1778290891, 'user_request', '1', NULL),
(401, 1778290891, 'user_request', '1', NULL),
(402, 1778290891, 'user_request', '1', NULL),
(403, 1778290891, 'user_request', '1', NULL),
(404, 1778290891, 'user_request', '1', NULL),
(405, 1778290894, 'user_request', '1', NULL),
(406, 1778290894, 'user_request', '1', NULL),
(407, 1778290894, 'user_request', '1', NULL),
(408, 1778290894, 'user_request', '1', NULL),
(409, 1778290940, 'user_request', '1', NULL),
(410, 1778290940, 'user_request', '1', NULL),
(411, 1778290940, 'user_request', '1', NULL),
(412, 1778290941, 'user_request', '1', NULL),
(413, 1778290941, 'user_request', '1', NULL),
(414, 1778290941, 'user_request', '1', NULL),
(415, 1778290941, 'user_request', '1', NULL),
(416, 1778290943, 'user_request', '1', NULL),
(417, 1778290943, 'user_request', '1', NULL),
(418, 1778290943, 'user_request', '1', NULL),
(419, 1778290943, 'user_request', '1', NULL),
(420, 1778290944, 'user_request', '1', NULL),
(421, 1778290944, 'user_request', '1', NULL),
(422, 1778290944, 'user_request', '1', NULL),
(423, 1778290944, 'user_request', '1', NULL),
(424, 1778290956, 'user_request', '1', NULL),
(425, 1778290956, 'user_request', '1', NULL),
(426, 1778290956, 'user_request', '1', NULL),
(427, 1778290956, 'user_request', '1', NULL),
(428, 1778290957, 'user_request', '1', NULL),
(429, 1778290960, 'user_request', '1', NULL),
(430, 1778290961, 'user_request', '1', NULL),
(431, 1778290962, 'user_request', '1', NULL),
(432, 1778290963, 'user_request', '1', NULL),
(433, 1778290963, 'user_request', '1', NULL),
(434, 1778290963, 'user_request', '1', NULL),
(435, 1778290963, 'user_request', '1', NULL),
(436, 1778290963, 'user_request', '1', NULL),
(437, 1778290963, 'user_request', '1', NULL),
(438, 1778290963, 'user_request', '1', NULL),
(439, 1778290975, 'user_request', '1', NULL),
(440, 1778290975, 'user_request', '1', NULL),
(441, 1778290975, 'user_request', '1', NULL),
(442, 1778290975, 'user_request', '1', NULL),
(443, 1778290976, 'user_request', '1', NULL),
(444, 1778290976, 'user_request', '1', NULL),
(445, 1778290976, 'user_request', '1', NULL),
(446, 1778290976, 'user_request', '1', NULL),
(447, 1778290977, 'user_request', '1', NULL),
(448, 1778290977, 'user_request', '1', NULL),
(449, 1778290977, 'user_request', '1', NULL),
(450, 1778290977, 'user_request', '1', NULL),
(451, 1778290981, 'user_request', '1', NULL),
(452, 1778290981, 'user_request', '1', NULL),
(453, 1778290981, 'user_request', '1', NULL),
(454, 1778290981, 'user_request', '1', NULL),
(455, 1778290982, 'user_request', '1', NULL),
(456, 1778290982, 'user_request', '1', NULL),
(457, 1778290982, 'user_request', '1', NULL),
(458, 1778290982, 'user_request', '1', NULL),
(459, 1778290983, 'user_request', '1', NULL),
(460, 1778290983, 'user_request', '1', NULL),
(461, 1778290983, 'user_request', '1', NULL),
(462, 1778291468, 'user_request', '1', NULL),
(463, 1778291469, 'user_request', '1', NULL),
(464, 1778291469, 'user_request', '1', NULL),
(465, 1778291599, 'user_request', '1', NULL),
(466, 1778291599, 'user_request', '1', NULL),
(467, 1778291599, 'user_request', '1', NULL),
(468, 1778291599, 'user_request', '1', NULL),
(469, 1778292744, 'user_request', '1', NULL),
(470, 1778292744, 'user_request', '1', NULL),
(471, 1778292744, 'user_request', '1', NULL),
(472, 1778292744, 'user_request', '1', NULL),
(473, 1778292745, 'user_request', '1', NULL),
(474, 1778292761, 'user_request', '1', NULL),
(475, 1778293224, 'user_request', '1', NULL),
(476, 1778293240, 'user_request', '1', NULL),
(477, 1778293251, 'user_request', '1', NULL),
(478, 1778293281, 'user_request', '1', NULL),
(479, 1778293282, 'user_request', '1', NULL),
(480, 1778293305, 'user_request', '1', NULL),
(481, 1778293327, 'user_request', '1', NULL),
(482, 1778293343, 'user_request', '1', NULL),
(483, 1778293344, 'user_request', '1', NULL),
(484, 1778293374, 'user_request', '1', NULL),
(485, 1778293375, 'user_request', '1', NULL),
(486, 1778293375, 'user_request', '1', NULL),
(487, 1778293375, 'user_request', '1', NULL),
(488, 1778293375, 'user_request', '1', NULL),
(489, 1778293375, 'user_request', '1', NULL),
(490, 1778293375, 'user_request', '1', NULL),
(491, 1778293377, 'user_request', '1', NULL),
(492, 1778293377, 'user_request', '1', NULL),
(493, 1778293377, 'user_request', '1', NULL),
(494, 1778293377, 'user_request', '1', NULL),
(495, 1778293377, 'user_request', '1', NULL),
(496, 1778293377, 'user_request', '1', NULL),
(497, 1778293377, 'user_request', '1', NULL),
(498, 1778293399, 'user_request', '1', NULL),
(499, 1778293399, 'user_request', '1', NULL),
(500, 1778293399, 'user_request', '1', NULL),
(501, 1778293403, 'user_request', '1', NULL),
(502, 1778293404, 'user_request', '1', NULL),
(503, 1778293404, 'user_request', '1', NULL),
(504, 1778293404, 'user_request', '1', NULL),
(505, 1778293405, 'user_request', '1', NULL),
(506, 1778293406, 'user_request', '1', NULL),
(507, 1778293406, 'user_request', '1', NULL),
(508, 1778293407, 'user_request', '1', NULL),
(509, 1778293407, 'user_request', '1', NULL),
(510, 1778293407, 'user_request', '1', NULL),
(511, 1778293407, 'user_request', '1', NULL),
(512, 1778293537, 'user_request', '1', NULL),
(513, 1778293537, 'user_request', '1', NULL),
(514, 1778293537, 'user_request', '1', NULL),
(515, 1778293537, 'user_request', '1', NULL),
(516, 1778294168, 'user_request', '1', NULL),
(517, 1778294168, 'user_request', '1', NULL),
(518, 1778294168, 'user_request', '1', NULL),
(519, 1778294168, 'user_request', '1', NULL),
(520, 1778294183, 'user_request', '1', NULL),
(521, 1778294183, 'user_request', '1', NULL),
(522, 1778294183, 'user_request', '1', NULL),
(523, 1778294183, 'user_request', '1', NULL),
(524, 1778294184, 'user_request', '1', NULL),
(525, 1778294184, 'user_request', '1', NULL),
(526, 1778294184, 'user_request', '1', NULL),
(527, 1778294184, 'user_request', '1', NULL),
(528, 1778294298, 'user_request', '1', NULL),
(529, 1778294299, 'user_request', '1', NULL),
(530, 1778294299, 'user_request', '1', NULL),
(531, 1778294299, 'user_request', '1', NULL),
(532, 1778294313, 'user_request', '1', NULL),
(533, 1778294313, 'user_request', '1', NULL),
(534, 1778294313, 'user_request', '1', NULL),
(535, 1778294313, 'user_request', '1', NULL),
(536, 1778294315, 'user_request', '1', NULL),
(537, 1778294315, 'user_request', '1', NULL),
(538, 1778294315, 'user_request', '1', NULL),
(539, 1778294315, 'user_request', '1', NULL),
(540, 1778294460, 'user_request', '1', NULL),
(541, 1778294460, 'user_request', '1', NULL),
(542, 1778294460, 'user_request', '1', NULL),
(543, 1778294460, 'user_request', '1', NULL),
(544, 1778294558, 'user_request', '1', NULL),
(545, 1778294558, 'user_request', '1', NULL),
(546, 1778294558, 'user_request', '1', NULL),
(547, 1778294558, 'user_request', '1', NULL),
(548, 1778294572, 'user_request', '1', NULL),
(549, 1778294573, 'user_request', '1', NULL),
(550, 1778294573, 'user_request', '1', NULL),
(551, 1778294573, 'user_request', '1', NULL),
(552, 1778294685, 'user_request', '1', NULL),
(553, 1778294685, 'user_request', '1', NULL),
(554, 1778294685, 'user_request', '1', NULL),
(555, 1778294685, 'user_request', '1', NULL),
(556, 1778294713, 'user_request', '1', NULL),
(557, 1778294714, 'user_request', '1', NULL),
(558, 1778294714, 'user_request', '1', NULL),
(559, 1778294714, 'user_request', '1', NULL),
(560, 1778294726, 'user_request', '1', NULL),
(561, 1778294726, 'user_request', '1', NULL),
(562, 1778294726, 'user_request', '1', NULL),
(563, 1778294726, 'user_request', '1', NULL),
(564, 1778294816, 'user_request', '1', NULL),
(565, 1778294816, 'user_request', '1', NULL),
(566, 1778294816, 'user_request', '1', NULL),
(567, 1778294816, 'user_request', '1', NULL),
(568, 1778294821, 'user_request', '1', NULL),
(569, 1778294821, 'user_request', '1', NULL),
(570, 1778294821, 'user_request', '1', NULL),
(571, 1778294821, 'user_request', '1', NULL),
(572, 1778294876, 'user_request', '1', NULL),
(573, 1778294876, 'user_request', '1', NULL),
(574, 1778294876, 'user_request', '1', NULL),
(575, 1778294876, 'user_request', '1', NULL),
(576, 1778294888, 'user_request', '1', NULL),
(577, 1778294888, 'user_request', '1', NULL),
(578, 1778294888, 'user_request', '1', NULL),
(579, 1778294888, 'user_request', '1', NULL),
(580, 1778295015, 'user_request', '1', NULL),
(581, 1778295016, 'user_request', '1', NULL),
(582, 1778295016, 'user_request', '1', NULL),
(583, 1778295016, 'user_request', '1', NULL),
(584, 1778295019, 'user_request', '1', NULL),
(585, 1778295021, 'user_request', '1', NULL),
(586, 1778295223, 'user_request', '1', NULL),
(587, 1778295223, 'user_request', '1', NULL),
(588, 1778295224, 'user_request', '1', NULL),
(589, 1778295224, 'user_request', '1', NULL),
(590, 1778295227, 'user_request', '1', NULL),
(591, 1778295228, 'user_request', '1', NULL),
(592, 1778295229, 'user_request', '1', NULL),
(593, 1778295230, 'user_request', '1', NULL),
(594, 1778295232, 'user_request', '1', NULL),
(595, 1778295232, 'user_request', '1', NULL),
(596, 1778295233, 'user_request', '1', NULL),
(597, 1778295234, 'user_request', '1', NULL),
(598, 1778295234, 'user_request', '1', NULL),
(599, 1778295235, 'user_request', '1', NULL),
(600, 1778295334, 'user_request', '1', NULL),
(601, 1778295335, 'user_request', '1', NULL),
(602, 1778295335, 'user_request', '1', NULL),
(603, 1778295344, 'user_request', '1', NULL),
(604, 1778295344, 'user_request', '1', NULL),
(605, 1778295344, 'user_request', '1', NULL),
(606, 1778295344, 'user_request', '1', NULL),
(607, 1778295359, 'user_request', '1', NULL),
(608, 1778295359, 'user_request', '1', NULL),
(609, 1778295359, 'user_request', '1', NULL),
(610, 1778295359, 'user_request', '1', NULL),
(611, 1778295385, 'user_request', '1', NULL),
(612, 1778295385, 'user_request', '1', NULL),
(613, 1778295385, 'user_request', '1', NULL),
(614, 1778295385, 'user_request', '1', NULL),
(615, 1778295387, 'user_request', '1', NULL),
(616, 1778295387, 'user_request', '1', NULL),
(617, 1778295388, 'user_request', '1', NULL),
(618, 1778295388, 'user_request', '1', NULL),
(619, 1778295389, 'user_request', '1', NULL),
(620, 1778295389, 'user_request', '1', NULL),
(621, 1778295483, 'user_request', '1', NULL),
(622, 1778295484, 'user_request', '1', NULL),
(623, 1778295484, 'user_request', '1', NULL),
(624, 1778295528, 'user_request', '1', NULL),
(625, 1778295528, 'user_request', '1', NULL),
(626, 1778295642, 'user_request', '1', NULL),
(627, 1778295656, 'user_request', '1', NULL),
(628, 1778295657, 'user_request', '1', NULL),
(629, 1778295683, 'user_request', '1', NULL),
(630, 1778295740, 'user_request', '1', NULL),
(631, 1778295740, 'user_request', '1', NULL),
(632, 1778295740, 'user_request', '1', NULL),
(633, 1778295741, 'user_request', '1', NULL),
(634, 1778295741, 'user_request', '1', NULL),
(635, 1778295741, 'user_request', '1', NULL),
(636, 1778295742, 'user_request', '1', NULL),
(637, 1778295745, 'user_request', '1', NULL),
(638, 1778295893, 'user_request', '1', NULL),
(639, 1778295912, 'user_request', '1', NULL),
(640, 1778295913, 'user_request', '1', NULL),
(641, 1778295913, 'user_request', '1', NULL),
(642, 1778295913, 'user_request', '1', NULL),
(643, 1778295914, 'user_request', '1', NULL),
(644, 1778295930, 'user_request', '1', NULL),
(645, 1778295930, 'user_request', '1', NULL),
(646, 1778295930, 'user_request', '1', NULL),
(647, 1778295930, 'user_request', '1', NULL),
(648, 1778295932, 'user_request', '1', NULL),
(649, 1778295936, 'user_request', '1', NULL),
(650, 1778295990, 'user_request', '1', NULL),
(651, 1778295990, 'user_request', '1', NULL),
(652, 1778295991, 'user_request', '1', NULL),
(653, 1778295991, 'user_request', '1', NULL),
(654, 1778295992, 'user_request', '1', NULL),
(655, 1778295998, 'user_request', '1', NULL),
(656, 1778295999, 'user_request', '1', NULL),
(657, 1778296001, 'user_request', '1', NULL),
(658, 1778296001, 'user_request', '1', NULL),
(659, 1778296001, 'user_request', '1', NULL),
(660, 1778296001, 'user_request', '1', NULL),
(661, 1778296045, 'user_request', '1', NULL),
(662, 1778296046, 'user_request', '1', NULL),
(663, 1778296046, 'user_request', '1', NULL),
(664, 1778296046, 'user_request', '1', NULL),
(665, 1778296046, 'user_request', '1', NULL),
(666, 1778296052, 'user_request', '1', NULL),
(667, 1778296053, 'user_request', '1', NULL),
(668, 1778296105, 'user_request', '1', NULL),
(669, 1778296105, 'user_request', '1', NULL),
(670, 1778296105, 'user_request', '1', NULL),
(671, 1778296105, 'user_request', '1', NULL),
(672, 1778296106, 'user_request', '1', NULL),
(673, 1778296110, 'user_request', '1', NULL),
(674, 1778296145, 'user_request', '1', NULL),
(675, 1778296146, 'user_request', '1', NULL),
(676, 1778296146, 'user_request', '1', NULL),
(677, 1778296146, 'user_request', '1', NULL),
(678, 1778296146, 'user_request', '1', NULL),
(679, 1778296158, 'user_request', '1', NULL),
(680, 1778296203, 'user_request', '1', NULL),
(681, 1778296203, 'user_request', '1', NULL),
(682, 1778296203, 'user_request', '1', NULL),
(683, 1778296203, 'user_request', '1', NULL),
(684, 1778296204, 'user_request', '1', NULL),
(685, 1778296207, 'user_request', '1', NULL),
(686, 1778296207, 'user_request', '1', NULL),
(687, 1778296207, 'user_request', '1', NULL),
(688, 1778296207, 'user_request', '1', NULL),
(689, 1778296208, 'user_request', '1', NULL),
(690, 1778296238, 'user_request', '1', NULL),
(691, 1778296238, 'user_request', '1', NULL),
(692, 1778296238, 'user_request', '1', NULL),
(693, 1778296238, 'user_request', '1', NULL),
(694, 1778296239, 'user_request', '1', NULL),
(695, 1778296290, 'user_request', '1', NULL),
(696, 1778296290, 'user_request', '1', NULL),
(697, 1778296290, 'user_request', '1', NULL),
(698, 1778296291, 'user_request', '1', NULL),
(699, 1778296291, 'user_request', '1', NULL),
(700, 1778296307, 'user_request', '1', NULL),
(701, 1778296307, 'user_request', '1', NULL),
(702, 1778296307, 'user_request', '1', NULL),
(703, 1778296307, 'user_request', '1', NULL),
(704, 1778296308, 'user_request', '1', NULL),
(705, 1778296367, 'user_request', '1', NULL),
(706, 1778296370, 'user_request', '1', NULL),
(707, 1778296370, 'user_request', '1', NULL),
(708, 1778296370, 'user_request', '1', NULL),
(709, 1778296370, 'user_request', '1', NULL),
(710, 1778296426, 'user_request', '1', NULL),
(711, 1778296426, 'user_request', '1', NULL),
(712, 1778296426, 'user_request', '1', NULL),
(713, 1778296426, 'user_request', '1', NULL),
(714, 1778296429, 'user_request', '1', NULL),
(715, 1778296432, 'user_request', '1', NULL),
(716, 1778296433, 'user_request', '1', NULL),
(717, 1778296433, 'user_request', '1', NULL),
(718, 1778296434, 'user_request', '1', NULL),
(719, 1778296434, 'user_request', '1', NULL),
(720, 1778296434, 'user_request', '1', NULL),
(721, 1778296486, 'user_request', '1', NULL),
(722, 1778296486, 'user_request', '1', NULL),
(723, 1778296486, 'user_request', '1', NULL),
(724, 1778296486, 'user_request', '1', NULL),
(725, 1778296562, 'user_request', '1', NULL),
(726, 1778296589, 'user_request', '1', NULL),
(727, 1778296624, 'user_request', '1', NULL),
(728, 1778296624, 'user_request', '1', NULL),
(729, 1778296624, 'user_request', '1', NULL),
(730, 1778297034, 'user_request', '1', NULL),
(731, 1778297048, 'user_request', '1', NULL),
(732, 1778297049, 'user_request', '1', NULL),
(733, 1778297151, 'user_request', '1', NULL),
(734, 1778297152, 'user_request', '1', NULL),
(735, 1778297243, 'user_request', '1', NULL),
(736, 1778297244, 'user_request', '1', NULL),
(737, 1778297244, 'user_request', '1', NULL),
(738, 1778297249, 'user_request', '1', NULL),
(739, 1778297249, 'user_request', '1', NULL),
(740, 1778297249, 'user_request', '1', NULL),
(741, 1778297249, 'user_request', '1', NULL),
(742, 1778297251, 'user_request', '1', NULL),
(743, 1778297251, 'user_request', '1', NULL),
(744, 1778297251, 'user_request', '1', NULL),
(745, 1778297407, 'user_request', '1', NULL),
(746, 1778297408, 'user_request', '1', NULL),
(747, 1778297408, 'user_request', '1', NULL),
(748, 1778297472, 'user_request', '1', NULL),
(749, 1778297473, 'user_request', '1', NULL),
(750, 1778297473, 'user_request', '1', NULL),
(751, 1778297510, 'user_request', '1', NULL),
(752, 1778297510, 'user_request', '1', NULL),
(753, 1778297511, 'user_request', '1', NULL),
(754, 1778297581, 'user_request', '1', NULL),
(755, 1778297582, 'user_request', '1', NULL),
(756, 1778297582, 'user_request', '1', NULL),
(757, 1778298028, 'user_request', '1', NULL),
(758, 1778298029, 'user_request', '1', NULL),
(759, 1778298029, 'user_request', '1', NULL),
(760, 1778298058, 'user_request', '1', NULL),
(761, 1778298058, 'user_request', '1', NULL),
(762, 1778298058, 'user_request', '1', NULL),
(763, 1778298072, 'user_request', '1', NULL),
(764, 1778298073, 'user_request', '1', NULL),
(765, 1778298073, 'user_request', '1', NULL),
(766, 1778298195, 'user_request', '1', NULL),
(767, 1778298196, 'user_request', '1', NULL),
(768, 1778298196, 'user_request', '1', NULL),
(769, 1778298208, 'user_request', '1', NULL),
(770, 1778298208, 'user_request', '1', NULL),
(771, 1778298208, 'user_request', '1', NULL),
(772, 1778298257, 'user_request', '1', NULL),
(773, 1778298257, 'user_request', '1', NULL),
(774, 1778298257, 'user_request', '1', NULL),
(775, 1778298292, 'user_request', '1', NULL),
(776, 1778298293, 'user_request', '1', NULL),
(777, 1778298293, 'user_request', '1', NULL),
(778, 1778298366, 'user_request', '1', NULL),
(779, 1778298367, 'user_request', '1', NULL),
(780, 1778298367, 'user_request', '1', NULL),
(781, 1778298367, 'user_request', '1', NULL),
(782, 1778298369, 'user_request', '1', NULL),
(783, 1778298369, 'user_request', '1', NULL),
(784, 1778298369, 'user_request', '1', NULL),
(785, 1778298406, 'user_request', '1', NULL),
(786, 1778298406, 'user_request', '1', NULL),
(787, 1778298406, 'user_request', '1', NULL),
(788, 1778298406, 'user_request', '1', NULL),
(789, 1778298411, 'user_request', '1', NULL),
(790, 1778298411, 'user_request', '1', NULL),
(791, 1778298411, 'user_request', '1', NULL),
(792, 1778298411, 'user_request', '1', NULL),
(793, 1778298414, 'user_request', '1', NULL),
(794, 1778298414, 'user_request', '1', NULL),
(795, 1778298414, 'user_request', '1', NULL),
(796, 1778298414, 'user_request', '1', NULL),
(797, 1778298967, 'user_request', '1', NULL),
(798, 1778298967, 'user_request', '1', NULL),
(799, 1778298967, 'user_request', '1', NULL),
(800, 1778298967, 'user_request', '1', NULL),
(801, 1778298967, 'user_request', '1', NULL),
(802, 1778298968, 'user_request', '1', NULL),
(803, 1778298968, 'user_request', '1', NULL),
(804, 1778298968, 'user_request', '1', NULL),
(805, 1778298970, 'user_request', '1', NULL),
(806, 1778298970, 'user_request', '1', NULL),
(807, 1778298970, 'user_request', '1', NULL),
(808, 1778298970, 'user_request', '1', NULL),
(809, 1778298971, 'user_request', '1', NULL),
(810, 1778298972, 'user_request', '1', NULL),
(811, 1778298973, 'user_request', '1', NULL),
(812, 1778298989, 'user_request', '1', NULL),
(813, 1778298992, 'user_request', '1', NULL),
(814, 1778298993, 'user_request', '1', NULL),
(815, 1778298994, 'user_request', '1', NULL),
(816, 1778298994, 'user_request', '1', NULL),
(817, 1778298994, 'user_request', '1', NULL),
(818, 1778298994, 'user_request', '1', NULL),
(819, 1778298996, 'user_request', '1', NULL),
(820, 1778298996, 'user_request', '1', NULL),
(821, 1778298996, 'user_request', '1', NULL),
(822, 1778298996, 'user_request', '1', NULL),
(823, 1778299113, 'user_request', '1', NULL),
(824, 1778299113, 'user_request', '1', NULL),
(825, 1778299113, 'user_request', '1', NULL),
(826, 1778299113, 'user_request', '1', NULL),
(827, 1778299119, 'user_request', '1', NULL),
(828, 1778299121, 'user_request', '1', NULL),
(829, 1778299327, 'user_request', '1', NULL),
(830, 1778299330, 'user_request', '1', NULL),
(831, 1778299331, 'user_request', '1', NULL),
(832, 1778299495, 'user_request', '1', NULL),
(833, 1778299496, 'user_request', '1', NULL),
(834, 1778299496, 'user_request', '1', NULL),
(835, 1778299497, 'user_request', '1', NULL),
(836, 1778299497, 'user_request', '1', NULL),
(837, 1778299497, 'user_request', '1', NULL),
(838, 1778299497, 'user_request', '1', NULL),
(839, 1778299499, 'user_request', '1', NULL),
(840, 1778299500, 'user_request', '1', NULL),
(841, 1778299501, 'user_request', '1', NULL),
(842, 1778299723, 'user_request', '1', NULL),
(843, 1778300050, 'user_request', '1', NULL),
(844, 1778300050, 'user_request', '1', NULL),
(845, 1778300050, 'user_request', '1', NULL),
(846, 1778300050, 'user_request', '1', NULL),
(847, 1778300051, 'user_request', '1', NULL),
(848, 1778300235, 'user_request', '1', NULL),
(849, 1778300235, 'user_request', '1', NULL),
(850, 1778300235, 'user_request', '1', NULL),
(851, 1778300235, 'user_request', '1', NULL),
(852, 1778300236, 'user_request', '1', NULL),
(853, 1778300237, 'user_request', '1', NULL),
(854, 1778300238, 'user_request', '1', NULL),
(855, 1778300239, 'user_request', '1', NULL),
(856, 1778300240, 'user_request', '1', NULL),
(857, 1778300241, 'user_request', '1', NULL),
(858, 1778300327, 'user_request', '1', NULL),
(859, 1778300327, 'user_request', '1', NULL),
(860, 1778300328, 'user_request', '1', NULL),
(861, 1778300328, 'user_request', '1', NULL),
(862, 1778300329, 'user_request', '1', NULL),
(863, 1778300330, 'user_request', '1', NULL),
(864, 1778300331, 'user_request', '1', NULL),
(865, 1778300331, 'user_request', '1', NULL),
(866, 1778300332, 'user_request', '1', NULL),
(867, 1778300333, 'user_request', '1', NULL),
(868, 1778300333, 'user_request', '1', NULL),
(869, 1778300334, 'user_request', '1', NULL),
(870, 1778300335, 'user_request', '1', NULL),
(871, 1778300335, 'user_request', '1', NULL),
(872, 1778300416, 'user_request', '1', NULL),
(873, 1778300416, 'user_request', '1', NULL),
(874, 1778300416, 'user_request', '1', NULL),
(875, 1778300416, 'user_request', '1', NULL),
(876, 1778300468, 'user_request', '1', NULL),
(877, 1778300469, 'user_request', '1', NULL),
(878, 1778300469, 'user_request', '1', NULL),
(879, 1778300469, 'user_request', '1', NULL),
(880, 1778300471, 'user_request', '1', NULL),
(881, 1778300471, 'user_request', '1', NULL),
(882, 1778300472, 'user_request', '1', NULL),
(883, 1778300472, 'user_request', '1', NULL),
(884, 1778300474, 'user_request', '1', NULL),
(885, 1778300474, 'user_request', '1', NULL),
(886, 1778300475, 'user_request', '1', NULL),
(887, 1778300475, 'user_request', '1', NULL),
(888, 1778300477, 'user_request', '1', NULL),
(889, 1778300477, 'user_request', '1', NULL),
(890, 1778300478, 'user_request', '1', NULL),
(891, 1778300480, 'user_request', '1', NULL),
(892, 1778300481, 'user_request', '1', NULL),
(893, 1778300482, 'user_request', '1', NULL),
(894, 1778300482, 'user_request', '1', NULL),
(895, 1778300483, 'user_request', '1', NULL),
(896, 1778300484, 'user_request', '1', NULL),
(897, 1778300484, 'user_request', '1', NULL),
(898, 1778300485, 'user_request', '1', NULL),
(899, 1778300486, 'user_request', '1', NULL),
(900, 1778300508, 'user_request', '1', NULL),
(901, 1778300508, 'user_request', '1', NULL),
(902, 1778300509, 'user_request', '1', NULL),
(903, 1778300509, 'user_request', '1', NULL),
(904, 1778300509, 'user_request', '1', NULL),
(905, 1778300510, 'user_request', '1', NULL),
(906, 1778300658, 'user_request', '1', NULL),
(907, 1778300659, 'user_request', '1', NULL),
(908, 1778300659, 'user_request', '1', NULL),
(909, 1778300718, 'user_request', '1', NULL),
(910, 1778300718, 'user_request', '1', NULL),
(911, 1778300718, 'user_request', '1', NULL),
(912, 1778300718, 'user_request', '1', NULL),
(913, 1778300755, 'user_request', '1', NULL),
(914, 1778300756, 'user_request', '1', NULL),
(915, 1778300756, 'user_request', '1', NULL),
(916, 1778300756, 'user_request', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pulse_values`
--

CREATE TABLE `pulse_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `key` mediumtext NOT NULL,
  `key_hash` binary(16) GENERATED ALWAYS AS (unhex(md5(`key`))) VIRTUAL,
  `value` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
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
('8pRxE8e27YKsRiYa5ItmeUlWeh95TxHBXeMFvDQK', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'ZXlKcGRpSTZJbTF5UW5SUVRtYzFXRGhLTlU5MlZISXdkMFpKU0ZFOVBTSXNJblpoYkhWbElqb2lTM0ZNYjBkWU4ybE9TVWRaTDNweU5FVjJOMVJtVm1SNksxTlZkRTlwYlZsRE1HUllTVFJPUW1oT1NFeDRObk5qVjFCVWVsWlFSUzgwVldOVFdVNDFLMjV5YldvelFuaDVRWEExUzFGRlFYVkhibFJzV2xkU1dWVkVNV3R2U1U0NVEzVnVZVVY1UjFsTFpHbFViREJUY2pBdllpOUhNWFpNTjFjd1ZHWnBNbmgwT1VWVVVFWm9ka3RrVlVSd2JpOW5SVUpXYTFkNk1FZFNWa3BNVms0elJGWmlSRmxVSzBkU01EQnJkMlpTUkUxdFNFNTBiM013TjFvdlRXVlhSbUkxTTFoS2NWQkRWaTlqU2pJNGFHeDBWMVZzY1ZWRU5GTXlNRlpHVGl0SlVIaGtUbU5wUW1KSGNqVlFURU5xVW1FeVVsUXdiakp0TjJOQ1RFbHRZUzh4VjFWaUsybHVVM1UzVG5GT1pYcEtSRmhMTmtWUVVqRkliMUJ5Y1hwbVRWaHRWSHAyTHpnMVIwSlJaMlJsTm5obWNITlNkMjFHVjFkM1QwdGpibk5ZV1ROUk1IZFpRMDB2U2tjeGExSnlVVmNyZVVWbE4zSm5jMXBuTjNOTmIxSTFSMmN3TWk5aVdUVlJkRkpzVGtaMlRqWllXV1l6U0hWYUt6QldXRGgyZGxoWWFtcFJlazVwSzB4cldWTTRLMkZ4YkVSeVJHMVFlUzlZV2pWRVdHVjZNekZGVVhSblZDOW9hbFZRYWxkelNtcHpTbHBtYlVsdmRITldlVmhCUldwemNHeFJhV3QwV0hoR2NXc3lSRzFqZEc5dmJuTkhSbGRwZHpGTE1taFBOamhGYzBKaVRucGxaSEJHYVZWeVN6bExPR2RqYXpkM1ZIQjJhbFZqV0hkUFJVeHBTbWszZG1sVFdtbEtNRVZ4YjBRclQwNWxiREZoU3pkM2FGY3dkVEpsV1hsM2MxZGhZbFJ2WTFaUlJtNDVORFJCSzI5UVNtbDBUbmxWYlZGWk5rcEJJaXdpYldGaklqb2laR014WldSa016STNaVGM0T0RGak1qTmhZekkzTW1GaU5qbGhaRFJoTWpBM1lqY3pOelJsWVRBNU56WmlZemM1TWpaaVltRXpZamN4WldSbU1tVTBNU0lzSW5SaFp5STZJaUo5', 1778300756);

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `nama_toko` varchar(191) NOT NULL,
  `alamat_toko` text NOT NULL,
  `email_toko` varchar(191) NOT NULL,
  `tlp` varchar(191) NOT NULL,
  `nama_pemilik` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ppn` varchar(191) DEFAULT NULL,
  `jam_buka` time DEFAULT NULL,
  `jam_tutup` time DEFAULT NULL,
  `toleransi_terlambat` int(11) DEFAULT NULL,
  `denda_keterlambatan` int(11) NOT NULL,
  `lebar_kertas_struk` varchar(191) DEFAULT NULL,
  `format_struk` enum('1','2','3','4','5') NOT NULL DEFAULT '1',
  `logo_toko` varchar(191) DEFAULT NULL,
  `gunakan_logo_struk` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak',
  `footer_struk` text NOT NULL,
  `min_purchase_poin` int(11) NOT NULL DEFAULT 0,
  `poin_interval` int(11) NOT NULL DEFAULT 0,
  `poin_to_rupiah` int(11) NOT NULL DEFAULT 0,
  `status_pengajuan_toko` enum('proses','diterima','ditolak') NOT NULL DEFAULT 'proses',
  `alasan_ditolak` text DEFAULT NULL,
  `baudRate` varchar(191) DEFAULT NULL,
  `dataBits` varchar(191) DEFAULT NULL,
  `parity` varchar(191) DEFAULT NULL,
  `stopBits` varchar(191) DEFAULT NULL,
  `flowControl` varchar(191) DEFAULT NULL,
  `port` varchar(191) DEFAULT NULL,
  `format_timbangan` enum('ST,GS,+0000000kg') DEFAULT NULL,
  `urutan_timbang` enum('urut','terbalik') NOT NULL DEFAULT 'urut'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`, `email_toko`, `tlp`, `nama_pemilik`, `created_at`, `updated_at`, `ppn`, `jam_buka`, `jam_tutup`, `toleransi_terlambat`, `denda_keterlambatan`, `lebar_kertas_struk`, `format_struk`, `logo_toko`, `gunakan_logo_struk`, `footer_struk`, `min_purchase_poin`, `poin_interval`, `poin_to_rupiah`, `status_pengajuan_toko`, `alasan_ditolak`, `baudRate`, `dataBits`, `parity`, `stopBits`, `flowControl`, `port`, `format_timbangan`, `urutan_timbang`) VALUES
(1, 'Gudang Stok Payapasir', 'Tebing Tinggi', 'tokomaju@gmail.com', '081234567890', 'Yudi', '2026-05-06 07:59:37', '2026-05-09 03:46:46', '11%', '08:00:00', '21:00:00', 10, 5000, '58mm', '1', 'toko/1/logo_69feae26bc7d6.jpg', 'Ya', '*Terima Kasih Atas Kunjungan Anda*', 50000, 10000, 1000, 'diterima', NULL, '9600', '8', 'none', '1', 'none', 'COM3', 'ST,GS,+0000000kg', 'urut');

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

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_user` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `alamat_user` varchar(191) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `gambar` varchar(191) DEFAULT NULL,
  `STATUS_USER` enum('0','1','2') NOT NULL DEFAULT '1',
  `ownership` tinyint(1) NOT NULL DEFAULT 0,
  `id_hak_akses` bigint(20) UNSIGNED NOT NULL,
  `resetPin` varchar(191) DEFAULT NULL,
  `activationPin` varchar(191) DEFAULT NULL,
  `superadmin` tinyint(1) NOT NULL DEFAULT 0,
  `activationPin_expires` timestamp NULL DEFAULT NULL,
  `resetPin_expires` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `alamat_user`, `telepon`, `email`, `gambar`, `STATUS_USER`, `ownership`, `id_hak_akses`, `resetPin`, `activationPin`, `superadmin`, `activationPin_expires`, `resetPin_expires`, `remember_token`, `two_factor_secret`, `two_factor_enabled`, `two_factor_confirmed_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2y$12$yb4/9k2pzlZt/.MWj3NTkekcDsZoUxSViEouPa6p6K0GkhxcBSGJi', 'dsjkfhb', '081998052185', 'secretentrance911@gmail.com', 'default.jpg', '1', 1, 1, NULL, NULL, 0, NULL, NULL, '', 'eyJpdiI6InBiSGRZUHV3a2ZMVThJbjZxOXl1aGc9PSIsInZhbHVlIjoidW9xV2NNVVJ1NnFiR1VqQWJFQmV3eFIzRVpqbVhpZ1hzRFc1WjUvbDJjZz0iLCJtYWMiOiI0YzdkOGMyNmFhNDdlOTZmODM0NzYyZGExMzE3MDM3MjIyZjM3ZmUzYjFjZDUwNGVlYjc2NjY3NTA4ZDQyZDk0IiwidGFnIjoiIn0=', 0, NULL, '2025-11-10 20:49:43', '2026-05-07 01:36:52'),
(2, 'karyawan', 'karyawandeli', '$2y$12$LzJzCAIhkXd/rkBvNC.nveIhX0cAUutXJqsGQ3exxJFL9HskMQ6Yu', 'afea', '09', 'tes123@gmail.com', 'default.jpg', '1', 0, 28, NULL, NULL, 0, NULL, NULL, NULL, '', 0, NULL, '2026-04-12 02:40:27', '2026-04-29 21:55:25'),
(90, 'admin', 'adminn', '$2y$12$yb4/9k2pzlZt/.MWj3NTkekcDsZoUxSViEouPa6p6K0GkhxcBSGJi', 'dsjkfhb', '081998052185', 'secretentraxddvdnce911@gmail.com', 'default.jpg', '1', 0, 0, NULL, '', 1, NULL, NULL, NULL, NULL, 0, NULL, '2025-11-10 20:59:05', '2025-11-10 20:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
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
  `id_user` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_has_toko`
--

INSERT INTO `user_has_toko` (`id`, `id_user`, `id_toko`) VALUES
(1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

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
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_hak_akses`);

--
-- Indexes for table `hak_akses_menu`
--
ALTER TABLE `hak_akses_menu`
  ADD PRIMARY KEY (`id_hak_akses_menu`);

--
-- Indexes for table `history_transaksi`
--
ALTER TABLE `history_transaksi`
  ADD PRIMARY KEY (`id_history_transaksi`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pulse_aggregates`
--
ALTER TABLE `pulse_aggregates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pulse_aggregates_bucket_period_type_aggregate_key_hash_unique` (`bucket`,`period`,`type`,`aggregate`,`key_hash`),
  ADD KEY `pulse_aggregates_period_bucket_index` (`period`,`bucket`),
  ADD KEY `pulse_aggregates_type_index` (`type`),
  ADD KEY `pulse_aggregates_period_type_aggregate_bucket_index` (`period`,`type`,`aggregate`,`bucket`);

--
-- Indexes for table `pulse_entries`
--
ALTER TABLE `pulse_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pulse_entries_timestamp_index` (`timestamp`),
  ADD KEY `pulse_entries_type_index` (`type`),
  ADD KEY `pulse_entries_key_hash_index` (`key_hash`),
  ADD KEY `pulse_entries_timestamp_type_key_hash_value_index` (`timestamp`,`type`,`key_hash`,`value`);

--
-- Indexes for table `pulse_values`
--
ALTER TABLE `pulse_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pulse_values_type_key_hash_unique` (`type`,`key_hash`),
  ADD KEY `pulse_values_timestamp_index` (`timestamp`),
  ADD KEY `pulse_values_type_index` (`type`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_username_unique` (`username`),
  ADD UNIQUE KEY `user_email_unique` (`email`),
  ADD KEY `user_id_hak_akses_index` (`id_hak_akses`);

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
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_hak_akses` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hak_akses_menu`
--
ALTER TABLE `hak_akses_menu`
  MODIFY `id_hak_akses_menu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `history_transaksi`
--
ALTER TABLE `history_transaksi`
  MODIFY `id_history_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pulse_aggregates`
--
ALTER TABLE `pulse_aggregates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3562;

--
-- AUTO_INCREMENT for table `pulse_entries`
--
ALTER TABLE `pulse_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=917;

--
-- AUTO_INCREMENT for table `pulse_values`
--
ALTER TABLE `pulse_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_has_toko`
--
ALTER TABLE `user_has_toko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
