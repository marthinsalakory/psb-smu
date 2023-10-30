-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 30, 2023 at 03:57 AM
-- Server version: 5.7.33
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psb-smu`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text,
  `nomor_telepon` varchar(15) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `pekerjaan_ayah` enum('PNS','Wirausaha','Karyawan Swasta','Petani','Pensiunan','Polisi','Guru','Dokter','Lainnya') DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `pekerjaan_ibu` enum('PNS','Wirausaha','Karyawan Swasta','Petani','Pensiunan','Polisi','Guru','Dokter','Lainnya') DEFAULT NULL,
  `nama_wali` varchar(255) DEFAULT NULL,
  `pekerjaan_wali` varchar(255) DEFAULT NULL,
  `akta_kelahiran` varchar(255) DEFAULT NULL,
  `kartu_keluarga` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `laporan_pendidikan` varchar(255) DEFAULT NULL,
  `ijasah` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `nomor_telepon`, `latitude`, `longitude`, `nama_ayah`, `pekerjaan_ayah`, `nama_ibu`, `pekerjaan_ibu`, `nama_wali`, `pekerjaan_wali`, `akta_kelahiran`, `kartu_keluarga`, `foto`, `laporan_pendidikan`, `ijasah`) VALUES
(1, 'calonsiswa-653f01b527879', '$2y$10$6b1YAbWjbOYF31CwOdtJUeKLyZZSLET0fNdSifkboaKGwQ6U3THcu', 2, 'Marthin Alfreinsco Salakory', 'L', 'wassu', '2001-12-01', 'Lateri', '081318812027', '-3.695', '128.181', 'JOHAN SALAKORY', 'Petani', 'JOSEVA TIMISELA', 'Lainnya', '', '', 'Marthin Alfreinsco Salakory-akta-kelahiran-653f01b524e77.pdf', 'Marthin Alfreinsco Salakory-kartu-keluarga-653f01b525556.pdf', 'Marthin Alfreinsco Salakory-foto-653f01b525dd2.pdf', 'Marthin Alfreinsco Salakory-laporan-pendidikan-653f01b5267d8.pdf', 'Marthin Alfreinsco Salakory-ijasah-653f01b5270cb.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
