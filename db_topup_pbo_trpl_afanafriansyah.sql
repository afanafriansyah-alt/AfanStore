-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2026 at 02:57 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_topup_pbo_trpl_afanafriansyah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_transaksi`
--

CREATE TABLE `tabel_transaksi` (
  `id_transaksi` int NOT NULL,
  `nama_pembeli` varchar(100) NOT NULL,
  `id_akun_game` varchar(50) NOT NULL,
  `jumlah_item` int NOT NULL,
  `harga_dasar_paket` decimal(12,2) NOT NULL,
  `kategori_topup` enum('Reguler','Langganan','Premium') NOT NULL,
  `bonus_diamond` int DEFAULT NULL,
  `voucher_diskon` decimal(12,2) DEFAULT NULL,
  `cashback_koin` int DEFAULT NULL,
  `akses_border_eksklusif` tinyint(1) DEFAULT NULL,
  `pajak_layanan` decimal(5,2) DEFAULT NULL,
  `biaya_admin` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_transaksi`
--

INSERT INTO `tabel_transaksi` (`id_transaksi`, `nama_pembeli`, `id_akun_game`, `jumlah_item`, `harga_dasar_paket`, `kategori_topup`, `bonus_diamond`, `voucher_diskon`, `cashback_koin`, `akses_border_eksklusif`, `pajak_layanan`, `biaya_admin`) VALUES
(1, 'Andi Wijaya', 'ID-88371', 1, '50000.00', 'Reguler', 15, NULL, NULL, NULL, NULL, '1500.00'),
(2, 'Budi Santoso', 'ID-12948', 1, '100000.00', 'Reguler', 35, NULL, NULL, NULL, NULL, '1500.00'),
(3, 'Cici Amalia', 'ID-99481', 1, '20000.00', 'Reguler', 5, NULL, NULL, NULL, NULL, '1500.00'),
(4, 'Dedi Kurniawan', 'ID-77482', 1, '250000.00', 'Reguler', 90, NULL, NULL, NULL, NULL, '1500.00'),
(5, 'Eka Putri', 'ID-33948', 1, '15000.00', 'Reguler', 3, NULL, NULL, NULL, NULL, '1500.00'),
(6, 'Fahmi Idris', 'ID-22849', 1, '75000.00', 'Reguler', 22, NULL, NULL, NULL, NULL, '1500.00'),
(7, 'Gita Permata', 'ID-44928', 1, '500000.00', 'Reguler', 200, NULL, NULL, NULL, NULL, '1500.00'),
(8, 'Hendra Wijaya', 'ID-10293', 1, '49000.00', 'Langganan', NULL, '5000.00', NULL, NULL, NULL, NULL),
(9, 'Indah Lestari', 'ID-88492', 3, '49000.00', 'Langganan', NULL, '12000.00', NULL, NULL, NULL, NULL),
(10, 'Joko Susilo', 'ID-33951', 1, '149000.00', 'Langganan', NULL, '15000.00', NULL, NULL, NULL, NULL),
(11, 'Kiki Amelia', 'ID-55392', 2, '49000.00', 'Langganan', NULL, '7000.00', NULL, NULL, NULL, NULL),
(12, 'Luki Fernando', 'ID-22941', 6, '49000.00', 'Langganan', NULL, '25000.00', NULL, NULL, NULL, NULL),
(13, 'Mega Utami', 'ID-44912', 1, '149000.00', 'Langganan', NULL, '10000.00', NULL, NULL, NULL, NULL),
(14, 'Naufal Abdi', 'ID-77382', 1, '49000.00', 'Langganan', NULL, '0.00', NULL, NULL, NULL, NULL),
(15, 'Oki Setiawan', 'ID-99384', 1, '1200000.00', 'Premium', NULL, NULL, 500, 1, '11.00', NULL),
(16, 'Putri Rahma', 'ID-55294', 1, '800000.00', 'Premium', NULL, NULL, 300, 1, '11.00', NULL),
(17, 'Rian Hidayat', 'ID-11294', 1, '1500000.00', 'Premium', NULL, NULL, 750, 1, '11.00', NULL),
(18, 'Siti Aminah', 'ID-44291', 1, '600000.00', 'Premium', NULL, NULL, 200, 0, '11.00', NULL),
(19, 'Taufik Ismail', 'ID-66392', 1, '2000000.00', 'Premium', NULL, NULL, 1000, 1, '11.00', NULL),
(20, 'Utari Dewi', 'ID-88391', 1, '950000.00', 'Premium', NULL, NULL, 400, 1, '11.00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_transaksi`
--
ALTER TABLE `tabel_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_transaksi`
--
ALTER TABLE `tabel_transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
