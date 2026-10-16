-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2026 at 11:47 AM
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
-- Database: `marketplace_katering`
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
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(150) NOT NULL,
  `alamat` text DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `kontak` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `nama_perusahaan`, `alamat`, `kota`, `kontak`, `created_at`, `updated_at`) VALUES
(1, 2, 'PT Berkah Abadi', 'Limau Manis, Padang', 'Padang', '+6282283797046', '2026-10-15 07:53:38', '2026-10-15 18:53:33');

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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_invoice` varchar(40) NOT NULL,
  `tanggal_terbit` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_jatuh_tempo` date DEFAULT NULL,
  `status_pembayaran` enum('menunggu_pembayaran','berhasil','gagal','kedaluwarsa') NOT NULL DEFAULT 'menunggu_pembayaran',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `order_id`, `nomor_invoice`, `tanggal_terbit`, `tanggal_jatuh_tempo`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 2, 'INV-20261015205732-5MBZK', '2026-10-15 13:57:32', '2026-10-16', 'berhasil', '2026-10-15 13:57:32', '2026-10-15 14:49:59'),
(2, 3, 'INV-20261016034456-9UZB7', '2026-10-15 20:44:56', '2026-10-17', 'berhasil', '2026-10-15 20:44:56', '2026-10-15 21:04:11'),
(3, 4, 'INV-20261016085713-0ASBE', '2026-10-16 01:57:13', '2026-10-17', 'berhasil', '2026-10-16 01:57:13', '2026-10-16 01:58:59'),
(4, 5, 'INV-20261016090125-JEWXM', '2026-10-16 02:01:25', '2026-10-17', 'berhasil', '2026-10-16 02:01:25', '2026-10-16 02:04:00'),
(5, 6, 'INV-20261016090606-936NB', '2026-10-16 02:06:06', '2026-10-17', 'berhasil', '2026-10-16 02:06:06', '2026-10-16 02:11:06');

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
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merchant_id` bigint(20) UNSIGNED NOT NULL,
  `menu_category_id` bigint(20) UNSIGNED NOT NULL,
  `nama_menu` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tersedia` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `merchant_id`, `menu_category_id`, `nama_menu`, `deskripsi`, `harga`, `foto`, `tersedia`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Nasi Rendang', 'Nasi putih hangat disajikan dengan rendang sapi khas Minangkabau yang dimasak dengan bumbu rempah pilihan hingga meresap dan kaya rasa.', 20000.00, 'menus/eaogqJsW2XrZKgNA9K5Aitc2rXEtzR3bNHQ2ByOf.jpg', 1, '2026-10-15 11:00:44', '2026-10-15 22:45:27', NULL),
(2, 1, 1, 'Nasi Ayam Pop', 'Nasi putih dengan ayam pop khas Padang yang lembut, dilengkapi daun singkong dan sambal.', 25000.00, 'menus/ooGJMhIMQMgSKoOFg1G5uXEbVZyji5BvS7pRJIDB.jpg', 1, '2026-10-15 11:04:36', '2026-10-15 22:46:06', NULL),
(3, 1, 1, 'Nasi Dendeng Balado', 'Nasi putih dengan dendeng sapi dan sambal balado bercita rasa pedas.', 25000.00, 'menus/SfR1xlsNPppJSCyGcMtkAEAcH2SzUojh1c67XJrU.jpg', 1, '2026-10-15 11:09:08', '2026-10-15 22:46:40', NULL),
(4, 1, 1, 'Nasi Telur Balado', 'Nasi putih dengan telur rebus berselimut sambal balado khas Minangkabau Rancak.', 15000.00, 'menus/SIKeE3fcSOeoud7b38qpGdFivBViGhY4jxM07bAN.jpg', 1, '2026-10-15 11:10:47', '2026-10-15 17:07:28', NULL),
(5, 1, 1, 'teeelurr', 'sdajfsjg', 120000.00, 'menus/7anV5iTGnzhSh2I5IkBIP7o1SNHQ0OUrMNku8MIK.jpg', 1, '2026-10-15 17:09:49', '2026-10-15 17:10:05', '2026-10-15 17:10:05'),
(6, 1, 1, 'Nasi Ayam Gulai', 'Nasi putih dengan ayam bersaus gulai kaya rempah dan pelengkap khas masakan Minang.', 25000.00, 'menus/PGbnB3RdDkNgYY3o3JakZnZcuoVdvFsMNwVxOKbF.jpg', 1, '2026-10-15 22:48:11', '2026-10-15 22:48:11', NULL),
(7, 1, 1, 'Nasi Ikan Bakar', 'Ikan bakar berbumbu dengan nasi putih dan sambal sebagai pilihan menu makan siang.', 30000.00, 'menus/c6NEZXCqsBqJvUYOF1zrwQJ8SRUkL9Fodb1IIzby.jpg', 1, '2026-10-15 22:49:18', '2026-10-15 22:49:18', NULL),
(8, 2, 17, 'Nasi Ayam Bakar', 'Nasi putih dengan ayam bakar berbumbu rempah, dilengkapi sambal dan lalapan segar untuk menu makan siang.', 28000.00, 'menus/wh9e5tCQWaYdLPCwAEcKZgfEWpuziqqFewcirxTK.jpg', 1, '2026-10-16 00:15:01', '2026-10-16 00:15:01', NULL),
(9, 2, 17, 'Nasi Ayam Geprek', 'Ayam goreng renyah yang digeprek bersama sambal, disajikan dengan nasi putih dan lalapan.', 23000.00, 'menus/an0HJVCCcNVFnK8lEYRKroyDTth5kf0wFtYL9FBG.jpg', 1, '2026-10-16 00:16:01', '2026-10-16 00:16:01', NULL),
(10, 2, 17, 'Nasi Ayam Penyet', 'Ayam goreng yang dipenyet bersama sambal, ditemani nasi putih dan sayuran segar.', 25000.00, 'menus/O0wnk56y1jiUbcUqA1pUplJ8Bp4HynKvZsXpI35n.jpg', 1, '2026-10-16 00:16:50', '2026-10-16 00:16:50', NULL),
(11, 2, 17, 'Nasi Ayam Goreng Kremes', 'Ayam goreng gurih dengan taburan kremesan renyah, nasi putih, sambal, dan lalapan.', 26000.00, 'menus/7wEMsqV8JQWECFx50ZkGPUUCyniAO7REAfZ92Lbw.jpg', 1, '2026-10-16 00:17:33', '2026-10-16 00:17:33', NULL),
(12, 2, 17, 'Nasi Ayam Teriyaki', 'Potongan ayam dengan saus teriyaki bercita rasa gurih manis, disajikan bersama nasi dan sayuran.', 27000.00, 'menus/euAQpUVDSF98Kivnk85Jvu9ew4IMaHlLblrcOUz0.jpg', 1, '2026-10-16 00:18:22', '2026-10-16 00:18:22', NULL),
(13, 2, 17, 'Nasi Ayam Sambal Matah', 'Nasi putih dengan ayam berbumbu dan sambal matah segar yang memberikan rasa pedas serta aroma khas.', 28000.00, 'menus/aubOkEDH1CcZeDmMzUjsziXJeORkfWeEOVIrZmej.jpg', 1, '2026-10-16 00:19:24', '2026-10-16 01:11:49', NULL),
(14, 2, 18, 'Soto Ayam Lamongan', 'Soto ayam dengan kuah kuning berbumbu rempah, suwiran ayam, soun, irisan kol, telur rebus, dan taburan koya gurih khas Lamongan. Disajikan hangat dengan sambal dan jeruk nipis.', 20000.00, 'menus/qOhomqxWD2c07ytQc5aPvmWwcUuXagHBTEXEgZRV.jpg', 1, '2026-10-16 01:00:29', '2026-10-16 01:01:01', NULL),
(15, 2, 18, 'Pecel Lele Lamongan', 'Lele goreng dengan tekstur renyah di luar dan lembut di dalam, disajikan bersama nasi putih, sambal khas Lamongan, lalapan segar, dan kemangi. Cocok untuk menu makan siang.', 18000.00, 'menus/lav5Ee07u7GLsoZDcsKDun229qFPtuU30VPoMhj8.jpg', 1, '2026-10-16 01:04:19', '2026-10-16 01:04:19', NULL),
(16, 2, 18, 'Ayam Penyet Sambal Lamongan', 'Ayam goreng berbumbu yang disajikan dengan sambal merah bercita rasa pedas dan gurih, nasi putih hangat, serta lalapan segar. Tingkat kepedasan dapat disesuaikan dengan selera.', 22000.00, 'menus/Wifp7442p0Zc89icYpRoFoq4Np3QWAFUuA0E0SgN.jpg', 1, '2026-10-16 01:05:28', '2026-10-16 01:05:28', NULL),
(17, 2, 18, 'Bebek Goreng Lamongan', 'Bebek berbumbu rempah yang digoreng hingga kecokelatan, disajikan bersama nasi putih, sambal khas Lamongan, dan lalapan segar untuk menghasilkan perpaduan rasa gurih dan pedas.', 30000.00, 'menus/kFmCXp9oEdcI0EIHwl4J8Ak6dFYe0WLfXObFy1QA.jpg', 1, '2026-10-16 01:06:33', '2026-10-16 01:06:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_categories`
--

CREATE TABLE `menu_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merchant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_categories`
--

INSERT INTO `menu_categories` (`id`, `merchant_id`, `nama_kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nasi Padang', 'Beragam pilihan hidangan khas Nagari Minangkabau dengan cita rasa rempah yang kaya, mulai dari rendang, ayam pop, gulai, hingga aneka lauk pendamping nasi.', '2026-10-15 10:53:08', '2026-10-15 23:01:44'),
(17, 2, 'Paket Nasi Ayam', 'Beragam pilihan paket nasi dengan aneka olahan ayam. Cocok untuk menu makan siang kantor maupun santapan sehari-hari.', '2026-10-16 00:10:58', '2026-10-16 00:10:58'),
(18, 2, 'Masakan Khas Lamongan', 'Pilihan menu khas Jawa Timur yang cocok untuk makan siang.', '2026-10-16 00:53:14', '2026-10-16 00:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(150) NOT NULL,
  `alamat` text DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `kontak` varchar(20) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `user_id`, `nama_perusahaan`, `alamat`, `kota`, `kontak`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dapur Bunda', 'Jl. Raya Andalas Padang, Sumatera Barat', 'Padang', '0823476375722', 'Dapur Bunda menyediakan berbagai pilihan hidangan rumahan yang lezat, higienis, dan dibuat menggunakan bahan-bahan berkualitas. Kami melayani kebutuhan katering untuk acara keluarga, rapat, dan berbagai kegiatan lainnya dengan cita rasa rumahan serta pelayanan yang ramah.', '2026-10-15 07:49:02', '2026-10-15 17:08:53'),
(2, 3, 'Dapur Ayam Nusantara', 'Jalan Bantul No 12', 'Yogyakarta', '0827453858485', 'Dapur Ayam Nusantara menyediakan beragam pilihan hidangan ayam dan paket nasi dengan cita rasa lezat untuk kebutuhan makan siang kantor.', '2026-10-15 23:10:04', '2026-10-15 23:12:32');

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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_15_065551_create_merchants_table', 1),
(5, '2026_10_15_083826_create_customers_table', 1),
(6, '2026_10_15_090743_create_menu_categories_table', 1),
(7, '2026_10_15_091143_create_menus_table', 1),
(8, '2026_10_15_091747_create_orders_table', 1),
(9, '2026_10_15_092716_create_order_items_table', 1),
(10, '2026_10_15_094225_create_invoices_table', 1),
(11, '2026_10_15_094625_create_payments_table', 1),
(12, '2026_10_15_194603_create_invoices_table', 2),
(13, '2026_10_15_201735_add_snap_token_to_payments_table', 3),
(14, '2026_10_16_063637_add_merchant_id_to_menu_categories_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_pesanan` varchar(40) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `merchant_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pengiriman` date NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `catatan` text DEFAULT NULL,
  `total_harga` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status_pesanan` enum('menunggu_konfirmasi','dikonfirmasi','diproses','selesai','dibatalkan') NOT NULL DEFAULT 'menunggu_konfirmasi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `nomor_pesanan`, `customer_id`, `merchant_id`, `tanggal_pengiriman`, `alamat_pengiriman`, `catatan`, `total_harga`, `status_pesanan`, `created_at`, `updated_at`) VALUES
(2, 'ORD-20261015205732-X8C7L', 1, 1, '2026-10-18', 'Pesisir Selatan', 'Cabenya tolong dibanyakin', 300000.00, 'dikonfirmasi', '2026-10-15 13:57:32', '2026-10-15 17:12:40'),
(3, 'ORD-20261016034456-EEKT7', 1, 1, '2026-10-19', 'Jalan Limau Manis, Padang', 'Porsi nasinya tolong dibanyakin', 1250000.00, 'dikonfirmasi', '2026-10-15 20:44:56', '2026-10-15 23:02:05'),
(4, 'ORD-20261016085713-PSVRG', 1, 1, '2026-10-20', 'Limau Manis, Padang', 'makanan dikurangi pedasnya', 200000.00, 'dikonfirmasi', '2026-10-16 01:57:13', '2026-10-16 02:15:53'),
(5, 'ORD-20261016090125-QSZXL', 1, 2, '2026-10-22', 'Limau Manis, Padang', 'tolong banyakin sambalnya ya mbak', 660000.00, 'dikonfirmasi', '2026-10-16 02:01:25', '2026-10-16 02:19:07'),
(6, 'ORD-20261016090606-9GYLO', 1, 2, '2026-10-24', 'Limau Manis, Padang', NULL, 200000.00, 'dikonfirmasi', '2026-10-16 02:06:06', '2026-10-16 02:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `nama_menu` varchar(150) NOT NULL,
  `jumlah_porsi` int(10) UNSIGNED NOT NULL,
  `harga_satuan` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `nama_menu`, `jumlah_porsi`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
(2, 2, 4, 'Nasi Telur Balado', 20, 15000.00, 300000.00, '2026-10-15 13:57:32', '2026-10-15 13:57:32'),
(3, 3, 3, 'Nasi Dendeng Balado', 50, 25000.00, 1250000.00, '2026-10-15 20:44:56', '2026-10-15 20:44:56'),
(4, 4, 1, 'Nasi Rendang', 10, 20000.00, 200000.00, '2026-10-16 01:57:13', '2026-10-16 01:57:13'),
(5, 5, 16, 'Ayam Penyet Sambal Lamongan', 30, 22000.00, 660000.00, '2026-10-16 02:01:25', '2026-10-16 02:01:25'),
(6, 6, 14, 'Soto Ayam Lamongan', 10, 20000.00, 200000.00, '2026-10-16 02:06:06', '2026-10-16 02:06:06');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_transaksi` varchar(100) DEFAULT NULL,
  `nomor_pesanan_midtrans` varchar(100) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `status_pembayaran` enum('menunggu_pembayaran','berhasil','gagal','kedaluwarsa') NOT NULL DEFAULT 'menunggu_pembayaran',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `snap_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `nomor_transaksi`, `nomor_pesanan_midtrans`, `metode_pembayaran`, `status_pembayaran`, `created_at`, `updated_at`, `snap_token`) VALUES
(1, 2, '964de316-eae8-4cc2-9d14-f85a8521c4b6', 'ORD-20261015205732-X8C7L-PAY-YRUZXZGE', 'bank_transfer', 'berhasil', '2026-10-15 13:57:32', '2026-10-15 14:49:59', '0be63004-0a2d-4697-91d1-c3d43b8520f1'),
(2, 3, '1c2cc899-c992-4f64-8502-df8983568419', 'ORD-20261016034456-EEKT7-PAY-MLPGOVAO', 'bank_transfer', 'berhasil', '2026-10-15 20:44:56', '2026-10-15 21:04:11', '27ac5ac8-b71e-4f0f-b694-558d4b178ca0'),
(3, 4, '5fc774e2-92ca-4713-a1fd-15cf2c9ceb32', 'ORD-20261016085713-PSVRG-PAY-B6Q9STBY', 'bank_transfer', 'berhasil', '2026-10-16 01:57:13', '2026-10-16 01:58:59', 'e2d25e87-639b-4969-91f9-3d78cfd11d1c'),
(4, 5, 'b40054f0-f1a5-4acc-b5d7-8fa7340e1d59', 'ORD-20261016090125-QSZXL-PAY-Y2PQJHQY', 'bank_transfer', 'berhasil', '2026-10-16 02:01:25', '2026-10-16 02:04:00', 'cce6d214-23ee-4e53-9a23-70531849bd8e'),
(5, 6, '68deaba0-438c-4636-b936-37549480b8a1', 'ORD-20261016090606-9GYLO-PAY-FRCCTMNQ', 'bank_transfer', 'berhasil', '2026-10-16 02:06:06', '2026-10-16 02:11:06', '5ec67343-10e6-452e-a17c-1dcc8f33b67f');

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
('2vEp6LQlLskoUqscSTFr3FKHBp7d1g6S3CKRIoZo', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoickhndTJ0a09pQUljRlphV2dBSDkyMUIzcFF0V0EwVTRncENYcDBZViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792141139),
('a247a8VMe8Y4ZQknOfQLGVOzygo2HufaL7IbbZCj', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicTRPRHZ4S1JCU292bURXc2x5SDhITWk3Q1ZaVGpRNVh0NWZoc0xyYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792141494),
('DHx4EDZzIANm4PrujOUY6By0NbOpJ430wfhTucp5', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidG1KVWNacmluY2J3TXNTekJTWnl4dmE0aTNiTUhJd2VhanJnTlF2ZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792141924),
('FluZul8EwydGEK7HSHa9kXR18c7FsnZ7hUsUP437', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiV2xPcWk2cm5icU80SjNrZnNzWG9tbnRrVXltcVNkMUZnSkswbG1weCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792141123),
('IbBDhmr5vH4ULi9p9xS5wD3APjmzc8KQgRdSp6Nn', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMnhaZUI2VmRMbGg0NXRkbXhKbHMySmZyMTBMUWowMGFlSWo2ZW1UViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792141440),
('iieIL8fLqCbOnpCSrpcIulMc0wdEufwW5o45gFSC', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaHJLbU1NVENZSmZRMTllSUhSOHNHV2MxazYxRVBiQUpsTWN0MEZCdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTg6ImN1c3RvbWVyLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjhiMDM1ZjFmZTQ2OGE0NTk5NGNmMzcyNGNiZWY5MDNlOWM4NWYwNmNjNmEyODhhNzkyOWQ0NmJmNTY5NWRhMDIiO30=', 1792143009),
('OZLQdIx1H4fPqcw4dGJbcjeJbsud5MyL2bWTM6cV', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicnFDSVFVOXBodkk3TkNzU1VueElNTW1JbTkwaTAxOVFteFdxRW1sdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792141866),
('R4Mdm6ZZ2Rlzyew8gb10gHEFJdTFms4i4P2fwPde', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiSTQ5TEZmMTRyMlNLdEV4SDVOWlU0T1JMWnJVVHRBVDYxaHd4ajFwVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792141855),
('SltjM6iXobrccHF8RpcHgu8GtMNjfTFBtCdApaiu', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiTmNyckx1WXBzbEU5MnJzcWUxRkZsQ2ZWMU53dkM2emhxa1owV0RvViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792141431),
('uX2CWqHVB0XQ4RshQ8OeWcjcLh3UWS1fPVPZoOrM', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoielNPZDJRTnZ3RjNKeldOMHhyc1l1WmwzZE41VVphMUk1cXcwWTVSZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792141182);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('merchant','customer') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dapur Bunda', 'dapurbunda@gmail.com', NULL, '$2y$12$Pynei7b81w3AB4WWVkW9.etGxJDDM9fA7IFmroNEkLF/lLlrVYGeW', 'merchant', NULL, '2026-10-15 07:49:02', '2026-10-15 07:49:02'),
(2, 'PT Berkah Abadi', 'berkahabadi@gmail.com', NULL, '$2y$12$Z38zItjiB3Z6.A7AkhJuIOqxUNhynZLY8bAuKmm7c5Lx5f1OZg6mO', 'customer', NULL, '2026-10-15 07:53:38', '2026-10-15 07:53:38'),
(3, 'Dapur Ayam Nusantara', 'dapurayamnusantara@gmail.com', NULL, '$2y$12$nEW3ZMDjiUQ0feo2g3RB7OAalVfo5laUDQTIetEl0kwni6z1IyAim', 'merchant', NULL, '2026-10-15 23:10:04', '2026-10-15 23:10:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_user_id_unique` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_order_id_unique` (`order_id`),
  ADD UNIQUE KEY `invoices_nomor_invoice_unique` (`nomor_invoice`);

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
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_merchant_id_foreign` (`merchant_id`),
  ADD KEY `menus_menu_category_id_foreign` (`menu_category_id`);

--
-- Indexes for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_categories_merchant_nama_unique` (`merchant_id`,`nama_kategori`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchants_user_id_unique` (`user_id`),
  ADD KEY `merchants_kota_index` (`kota`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_nomor_pesanan_unique` (`nomor_pesanan`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_merchant_id_foreign` (`merchant_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_order_id_unique` (`order_id`),
  ADD UNIQUE KEY `payments_nomor_transaksi_unique` (`nomor_transaksi`),
  ADD UNIQUE KEY `payments_nomor_pesanan_midtrans_unique` (`nomor_pesanan_midtrans`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_index` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_menu_category_id_foreign` FOREIGN KEY (`menu_category_id`) REFERENCES `menu_categories` (`id`),
  ADD CONSTRAINT `menus_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD CONSTRAINT `menu_categories_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`);

--
-- Constraints for table `merchants`
--
ALTER TABLE `merchants`
  ADD CONSTRAINT `merchants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
