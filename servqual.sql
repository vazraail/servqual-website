-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2026 at 02:16 PM
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
-- Database: `servqual`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminkuesioner`
--

CREATE TABLE `adminkuesioner` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminkuesioner`
--

INSERT INTO `adminkuesioner` (`id_admin`, `username`, `password`) VALUES
(2147483647, 'admin', '$2y$10$jXbbh6j5u7jA33e3tkXjCuUu97gew.DWX4.lWMIv5B8LKzczhLbEu');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_servqual`
--

CREATE TABLE `hasil_servqual` (
  `id_hasil` int(11) NOT NULL,
  `id_jawaban` int(11) NOT NULL,
  `dimensi` varchar(50) DEFAULT NULL,
  `rata_persepsi` decimal(5,2) NOT NULL,
  `rata_harapan` decimal(5,2) NOT NULL,
  `gap` decimal(5,2) NOT NULL,
  `prioritas` varchar(50) NOT NULL,
  `rekomendasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_servqual`
--

INSERT INTO `hasil_servqual` (`id_hasil`, `id_jawaban`, `dimensi`, `rata_persepsi`, `rata_harapan`, `gap`, `prioritas`, `rekomendasi`) VALUES
(1, 0, 'Tangibles', 4.20, 5.00, -0.80, 'Tinggi', 'Perlu peningkatan tampilan dan kenyamanan website layanan pengaduan, termasuk tata letak, desain visual, serta kelengkapan fitur pendukung.'),
(2, 0, 'Reliability', 5.00, 5.00, 0.00, 'Rendah', 'Perlu peningkatan keandalan sistem dalam memproses pengaduan, memastikan informasi yang diberikan akurat, serta meminimalkan kesalahan sistem.'),
(3, 0, 'Responsiveness', 5.00, 5.00, 0.00, 'Rendah', 'Perlu peningkatan kecepatan respon sistem dan petugas dalam menanggapi pengaduan agar pelayanan lebih cepat.'),
(4, 0, 'Assurance', 5.00, 5.00, 0.00, 'Rendah', 'Perlu peningkatan jaminan keamanan data, profesionalitas pelayanan, serta kejelasan informasi.'),
(5, 0, 'Empathy', 5.00, 5.00, 0.00, 'Rendah', 'Perlu peningkatan kepedulian terhadap kebutuhan masyarakat melalui kemudahan komunikasi dan perhatian terhadap setiap pengaduan.');

-- --------------------------------------------------------

--
-- Table structure for table `jawabankuesioner`
--

CREATE TABLE `jawabankuesioner` (
  `id_jawaban` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `usia` varchar(20) NOT NULL,
  `pendidikan` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `domisili` varchar(100) NOT NULL,
  `p1` int(11) NOT NULL,
  `p2` int(11) NOT NULL,
  `p3` int(11) NOT NULL,
  `p4` int(11) NOT NULL,
  `p5` int(11) NOT NULL,
  `p6` int(11) NOT NULL,
  `p7` int(11) NOT NULL,
  `p8` int(11) NOT NULL,
  `p9` int(11) NOT NULL,
  `p10` int(11) NOT NULL,
  `p11` int(11) NOT NULL,
  `p12` int(11) NOT NULL,
  `p13` int(11) NOT NULL,
  `p14` int(11) NOT NULL,
  `p15` int(11) NOT NULL,
  `p16` int(11) NOT NULL,
  `p17` int(11) NOT NULL,
  `p18` int(11) NOT NULL,
  `p19` int(11) NOT NULL,
  `p20` int(11) NOT NULL,
  `p21` int(11) NOT NULL,
  `p22` int(11) NOT NULL,
  `p23` int(11) NOT NULL,
  `p24` int(11) NOT NULL,
  `e1` int(11) NOT NULL,
  `e2` int(11) NOT NULL,
  `e3` int(11) NOT NULL,
  `e4` int(11) NOT NULL,
  `e5` int(11) NOT NULL,
  `e6` int(11) NOT NULL,
  `e7` int(11) NOT NULL,
  `e8` int(11) NOT NULL,
  `e9` int(11) NOT NULL,
  `e10` int(11) NOT NULL,
  `e11` int(11) NOT NULL,
  `e12` int(11) NOT NULL,
  `e13` int(11) NOT NULL,
  `e14` int(11) NOT NULL,
  `e15` int(11) NOT NULL,
  `e16` int(11) NOT NULL,
  `e17` int(11) NOT NULL,
  `e18` int(11) NOT NULL,
  `e19` int(11) NOT NULL,
  `e20` int(11) NOT NULL,
  `e21` int(11) NOT NULL,
  `e22` int(11) NOT NULL,
  `e23` int(11) NOT NULL,
  `e24` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='No';

--
-- Dumping data for table `jawabankuesioner`
--

INSERT INTO `jawabankuesioner` (`id_jawaban`, `nama`, `gender`, `usia`, `pendidikan`, `pekerjaan`, `domisili`, `p1`, `p2`, `p3`, `p4`, `p5`, `p6`, `p7`, `p8`, `p9`, `p10`, `p11`, `p12`, `p13`, `p14`, `p15`, `p16`, `p17`, `p18`, `p19`, `p20`, `p21`, `p22`, `p23`, `p24`, `e1`, `e2`, `e3`, `e4`, `e5`, `e6`, `e7`, `e8`, `e9`, `e10`, `e11`, `e12`, `e13`, `e14`, `e15`, `e16`, `e17`, `e18`, `e19`, `e20`, `e21`, `e22`, `e23`, `e24`, `waktu`) VALUES
(1, 'sdad', 'Perempuan', '', 'SMP', 'PNS', 'wd', 1, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, '2026-01-31 15:44:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminkuesioner`
--
ALTER TABLE `adminkuesioner`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `hasil_servqual`
--
ALTER TABLE `hasil_servqual`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `jawabankuesioner`
--
ALTER TABLE `jawabankuesioner`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil_servqual`
--
ALTER TABLE `hasil_servqual`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jawabankuesioner`
--
ALTER TABLE `jawabankuesioner`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
