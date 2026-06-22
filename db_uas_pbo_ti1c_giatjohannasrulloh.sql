-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2026 at 07:37 AM
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
-- Database: `db_uas_pbo_ti1c_giatjohannasrulloh`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_karyawan`
--

CREATE TABLE `tabel_karyawan` (
  `id_karyawan` int NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `hari_kerja_masuk` int NOT NULL,
  `gaji_dasar_per_hari` decimal(12,2) NOT NULL,
  `jenis_karyawan` enum('kontrak','tetap','magang') NOT NULL,
  `durasi_kontrak_bulan` int DEFAULT NULL,
  `uang_saku_bulanan` decimal(12,2) DEFAULT NULL,
  `sertifikat_kampus_merdeka` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_karyawan`
--

INSERT INTO `tabel_karyawan` (`id_karyawan`, `nama_karyawan`, `departemen`, `hari_kerja_masuk`, `gaji_dasar_per_hari`, `jenis_karyawan`, `durasi_kontrak_bulan`, `uang_saku_bulanan`, `sertifikat_kampus_merdeka`) VALUES
(1, 'Giat Johannas', 'IT Support', 22, '150000.00', 'tetap', NULL, NULL, NULL),
(2, 'Rania Asyila', 'Human Resources', 20, '140000.00', 'tetap', NULL, NULL, NULL),
(3, 'Budi Santoso', 'Finance', 21, '160000.00', 'tetap', NULL, NULL, NULL),
(4, 'Siti Aminah', 'Marketing', 22, '145000.00', 'tetap', NULL, NULL, NULL),
(5, 'Ahmad Fauzi', 'Operations', 23, '135000.00', 'tetap', NULL, NULL, NULL),
(6, 'Dewi Lestari', 'Legal', 19, '170000.00', 'tetap', NULL, NULL, NULL),
(7, 'Eko Prasetyo', 'Quality Assurance', 22, '150000.00', 'tetap', NULL, NULL, NULL),
(8, 'Andi Wijaya', 'IT Support', 20, '120000.00', 'kontrak', 12, NULL, NULL),
(9, 'Citra Kirana', 'Marketing', 18, '110000.00', 'kontrak', 6, NULL, NULL),
(10, 'Dimas Anggara', 'Operations', 22, '115000.00', 'kontrak', 24, NULL, NULL),
(11, 'Farah Dibha', 'Human Resources', 21, '120000.00', 'kontrak', 12, NULL, NULL),
(12, 'Gilang Dirga', 'Finance', 15, '125000.00', 'kontrak', 6, NULL, NULL),
(13, 'Hendra Setiawan', 'Quality Assurance', 22, '115000.00', 'kontrak', 12, NULL, NULL),
(14, 'Indah Permata', 'Legal', 20, '130000.00', 'kontrak', 6, NULL, NULL),
(15, 'Kevin Sanjaya', 'IT Support', 20, '0.00', 'magang', NULL, '2500000.00', 'Sertifikat MSIB - Backend Developer'),
(16, 'Lesti Kejora', 'Marketing', 19, '0.00', 'magang', NULL, '2200000.00', 'Sertifikat MSIB - Digital Marketing'),
(17, 'Muhammad Rizky', 'Operations', 21, '0.00', 'magang', NULL, '2000000.00', 'Sertifikat MSIB - UI/UX Designer'),
(18, 'Nadia Vega', 'Human Resources', 18, '0.00', 'magang', NULL, '2200000.00', 'Sertifikat MSIB - HR Generalist'),
(19, 'Oki Setiana', 'Finance', 22, '0.00', 'magang', NULL, '2500000.00', NULL),
(20, 'Putri Marino', 'Legal', 17, '0.00', 'magang', NULL, '2000000.00', 'Sertifikat MSIB - Legal Analyst'),
(21, 'Riza Syah', 'Quality Assurance', 20, '0.00', 'magang', NULL, '2100000.00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  MODIFY `id_karyawan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
