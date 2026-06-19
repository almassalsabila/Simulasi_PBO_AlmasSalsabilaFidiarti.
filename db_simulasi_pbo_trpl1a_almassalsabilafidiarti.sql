-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2026 at 02:40 AM
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
-- Database: `db_simulasi_pbo_trpl1a_almassalsabilafidiarti`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftaran`
--

CREATE TABLE `tabel_pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `nama_calon` varchar(255) NOT NULL,
  `asal_sekolah` varchar(255) NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL,
  `biaya_pendaftaran_dasar` decimal(10,2) NOT NULL,
  `jalur_pendaftaran` enum('reguler','prestasi','kedinasan') NOT NULL,
  `pilihan_prodi` varchar(255) DEFAULT NULL,
  `lokasi_kampus` varchar(255) DEFAULT NULL,
  `jenis_prestasi` varchar(255) DEFAULT NULL,
  `tingkat_prestasi` varchar(255) DEFAULT NULL,
  `sk_ikatan_dinas` varchar(255) DEFAULT NULL,
  `instansi_sponsor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_pendaftaran`
--

INSERT INTO `tabel_pendaftaran` (`id_pendaftaran`, `nama_calon`, `asal_sekolah`, `nilai_ujian`, `biaya_pendaftaran_dasar`, `jalur_pendaftaran`, `pilihan_prodi`, `lokasi_kampus`, `jenis_prestasi`, `tingkat_prestasi`, `sk_ikatan_dinas`, `instansi_sponsor`) VALUES
(1, 'Budi Santoso', 'SMA 1 Jakarta', '85.50', '250000.00', 'reguler', 'Teknik Informatika', 'Kampus Pusat', NULL, NULL, NULL, NULL),
(2, 'Siti Aminah', 'SMA 2 Bandung', '78.00', '250000.00', 'reguler', 'Sistem Informasi', 'Kampus Cabang', NULL, NULL, NULL, NULL),
(3, 'Andi Wijaya', 'SMK 1 Surabaya', '80.25', '250000.00', 'reguler', 'Manajemen Informatika', 'Kampus Pusat', NULL, NULL, NULL, NULL),
(4, 'Rina Melati', 'SMA 3 Semarang', '88.00', '250000.00', 'reguler', 'Teknik Komputer', 'Kampus Pusat', NULL, NULL, NULL, NULL),
(5, 'Joko Anwar', 'SMA 1 Yogyakarta', '75.50', '250000.00', 'reguler', 'Teknik Informatika', 'Kampus Cabang', NULL, NULL, NULL, NULL),
(6, 'Maya Sari', 'SMK 2 Malang', '82.00', '250000.00', 'reguler', 'Sistem Informasi', 'Kampus Pusat', NULL, NULL, NULL, NULL),
(7, 'Deni Saputra', 'SMA 4 Medan', '79.50', '250000.00', 'reguler', 'Teknik Komputer', 'Kampus Cabang', NULL, NULL, NULL, NULL),
(8, 'Lestari', 'SMA 1 Bali', '95.00', '150000.00', 'prestasi', 'Teknik Informatika', 'Kampus Pusat', 'Olimpiade Komputer', 'Nasional', NULL, NULL),
(9, 'Bambang Pamungkas', 'SMA 1 Makassar', '92.50', '150000.00', 'prestasi', 'Sistem Informasi', 'Kampus Pusat', 'Lomba Karya Tulis', 'Provinsi', NULL, NULL),
(10, 'Dewi Lestari', 'SMK 1 Padang', '90.00', '150000.00', 'prestasi', 'Manajemen Informatika', 'Kampus Pusat', 'Debat Bahasa Inggris', 'Internasional', NULL, NULL),
(11, 'Rizky Febian', 'SMA 2 Balikpapan', '93.00', '150000.00', 'prestasi', 'Teknik Komputer', 'Kampus Pusat', 'Olimpiade Matematika', 'Nasional', NULL, NULL),
(12, 'Ayu Ting Ting', 'SMA 1 Pontianak', '89.50', '150000.00', 'prestasi', 'Teknik Informatika', 'Kampus Pusat', 'Lomba Web Design', 'Kabupaten', NULL, NULL),
(13, 'Agung Hercules', 'SMK 3 Manado', '94.00', '150000.00', 'prestasi', 'Sistem Informasi', 'Kampus Pusat', 'Pencak Silat', 'Nasional', NULL, NULL),
(14, 'Citra Kirana', 'SMA 1 Palembang', '91.00', '150000.00', 'prestasi', 'Teknik Komputer', 'Kampus Pusat', 'Olimpiade Fisika', 'Provinsi', NULL, NULL),
(15, 'Iqbal Ramadhan', 'SMA Taruna Nusantara', '88.50', '0.00', 'kedinasan', 'Teknik Informatika', 'Kampus Pusat', NULL, NULL, 'SK-KED-001', 'Kementerian Kominfo'),
(16, 'Chelsea Islan', 'SMA 1 Depok', '87.00', '0.00', 'kedinasan', 'Sistem Informasi', 'Kampus Pusat', NULL, NULL, 'SK-KED-002', 'BSSN'),
(17, 'Reza Rahadian', 'SMK 1 Bogor', '86.50', '0.00', 'kedinasan', 'Manajemen Informatika', 'Kampus Pusat', NULL, NULL, 'SK-KED-003', 'Kementerian Keuangan'),
(18, 'Dian Sastro', 'SMA 1 Bekasi', '89.00', '0.00', 'kedinasan', 'Teknik Komputer', 'Kampus Pusat', NULL, NULL, 'SK-KED-004', 'Kementerian Pertahanan'),
(19, 'Nicholas Saputra', 'SMA 2 Tangerang', '85.00', '0.00', 'kedinasan', 'Teknik Informatika', 'Kampus Pusat', NULL, NULL, 'SK-KED-005', 'Pemprov DKI Jakarta'),
(20, 'Tara Basro', 'SMK 1 Cirebon', '88.00', '0.00', 'kedinasan', 'Sistem Informasi', 'Kampus Pusat', NULL, NULL, 'SK-KED-006', 'Kementerian Dalam Negeri');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
