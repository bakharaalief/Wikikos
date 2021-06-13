-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2021 at 05:42 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wikikosm_satu`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota_kos`
--

CREATE TABLE `anggota_kos` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `id_kosan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota_kos`
--

INSERT INTO `anggota_kos` (`id_anggota`, `nama_anggota`, `id_kosan`) VALUES
(34, 'Budi', 49),
(37, 'Budi 2', 49),
(38, 'budi 3', 49),
(39, 'Anto 2', 49),
(40, 'Anto', 49),
(41, 'Budi', 49);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `nama_fasilitas`) VALUES
(11, 'AC'),
(15, 'Kipas Angin'),
(16, 'Lemari'),
(19, 'Kamar Mandi');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kos`
--

CREATE TABLE `fasilitas_kos` (
  `id_fasilitas_kosan` int(11) NOT NULL,
  `id_fasilitas` int(11) NOT NULL,
  `id_kosan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitas_kos`
--

INSERT INTO `fasilitas_kos` (`id_fasilitas_kosan`, `id_fasilitas`, `id_kosan`) VALUES
(4, 11, 53),
(9, 11, 50),
(12, 11, 49),
(13, 11, 51),
(15, 15, 49),
(16, 16, 49),
(17, 19, 49);

-- --------------------------------------------------------

--
-- Table structure for table `foto_kos`
--

CREATE TABLE `foto_kos` (
  `id_foto` int(11) NOT NULL,
  `lokasi_foto` varchar(100) NOT NULL,
  `id_kosan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foto_kos`
--

INSERT INTO `foto_kos` (`id_foto`, `lokasi_foto`, `id_kosan`) VALUES
(55, './upload/16227672332028682860b97681d98a6.png', 49),
(56, './upload/1622767307166493326260b976cb2e360.png', 51),
(62, './upload/162281391652667121060ba2cdc48dfa.png', 53),
(64, './upload/162281393557761707460ba2cef2ff48.png', 53),
(65, './upload/1622821053170137119260ba48bd617ab.png', 53);

-- --------------------------------------------------------

--
-- Table structure for table `kosan`
--

CREATE TABLE `kosan` (
  `id_kosan` int(11) NOT NULL,
  `nama_kosan` varchar(100) NOT NULL,
  `tipe_kos` varchar(10) NOT NULL,
  `ukuran` varchar(10) NOT NULL,
  `harga` int(100) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `nama_jalan` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kota` int(11) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kosan`
--

INSERT INTO `kosan` (`id_kosan`, `nama_kosan`, `tipe_kos`, `ukuran`, `harga`, `kapasitas`, `nama_jalan`, `kecamatan`, `kota`, `deskripsi`, `status`, `id_user`) VALUES
(49, 'kosan bu haji', 'campur', '2x4', 1000000, 10, 'Jalan mawar', 'Jaha', 1, 'Kosan terkeren di semarang', 1, 28),
(50, 'kosan bu haji 2', 'campur', '2x4', 100000, 10, 'Jalan mawar', 'Jaha', 1, 'kosan keren sekali', 1, 30),
(51, 'kosan bu haji 3', 'laki', '2x4', 10, 10, 'Jalan mawar', 'Jaha', 4, 'kosan terkeren di depok', 1, 28),
(53, 'Kos Mawar', 'laki', '2x4', 100000, 2, 'Jalan mawar', 'Jaha', 1, 'Kosan Terkeren di Jakarta dan sekitarnya 3', 1, 33);

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`) VALUES
(1, 'Depok'),
(3, 'Semarang'),
(4, 'Bogor');

-- --------------------------------------------------------

--
-- Table structure for table `telpon`
--

CREATE TABLE `telpon` (
  `id_telpon` int(11) NOT NULL,
  `nomor_telpon` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `telpon`
--

INSERT INTO `telpon` (`id_telpon`, `nomor_telpon`, `id_user`) VALUES
(24, '12345678', 28),
(27, '12345678', 28);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `fullname`, `level`) VALUES
(27, 'admin', '$2y$10$5ANklkYh4iWZWw.dzPcH5ek2JfpncGcnWhzSzXv/A60wAPbtXTCV.', 'meong1@gmail.com', 'admin 1', 0),
(28, 'buhaji', '$2y$10$3g7stI2P9Z/Nc3KB2ulk7.KD3Cxyx6Dv2CM4BPuF7ghzUsAUKsGTa', 'meong@gmail.com', 'Bu Haji', 1),
(29, 'admin2', '$2y$10$dK.Kc1KxJf5E6V2L0eurWO53btXM/Q7YJcUB6iS.UhoZf3nahYZa2', 'meong2@gmail.com', 'admin 2', 0),
(30, 'buhaji2', '$2y$10$5wOyF6oHFP.0Ifn3TBklUuFSSfegjoqdxKYYf2Qgd9NRjDToEwPgW', 'meong3@gmail.com', 'Bu Haji 2', 1),
(33, 'bakhara', '$2y$10$m6ZhjN6F1LgTClvPgePgru9zieGPuOfxjBbOMUSz27BKyrzZJ.iOi', 'm.bakhara.a.r@students.esqbs.ac.id', 'Bakhara Alief', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota_kos`
--
ALTER TABLE `anggota_kos`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `fk_anggota_kos` (`id_kosan`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `fasilitas_kos`
--
ALTER TABLE `fasilitas_kos`
  ADD PRIMARY KEY (`id_fasilitas_kosan`),
  ADD KEY `fk_fasilitas_kos` (`id_fasilitas`),
  ADD KEY `fk_fasilitas_kos_2` (`id_kosan`);

--
-- Indexes for table `foto_kos`
--
ALTER TABLE `foto_kos`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `fk_foto_kos` (`id_kosan`);

--
-- Indexes for table `kosan`
--
ALTER TABLE `kosan`
  ADD PRIMARY KEY (`id_kosan`),
  ADD KEY `fk_kosan` (`id_user`),
  ADD KEY `fk_kota` (`kota`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `telpon`
--
ALTER TABLE `telpon`
  ADD PRIMARY KEY (`id_telpon`),
  ADD KEY `fk_notelp` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota_kos`
--
ALTER TABLE `anggota_kos`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `fasilitas_kos`
--
ALTER TABLE `fasilitas_kos`
  MODIFY `id_fasilitas_kosan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `foto_kos`
--
ALTER TABLE `foto_kos`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `kosan`
--
ALTER TABLE `kosan`
  MODIFY `id_kosan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `telpon`
--
ALTER TABLE `telpon`
  MODIFY `id_telpon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota_kos`
--
ALTER TABLE `anggota_kos`
  ADD CONSTRAINT `fk_anggota_kos` FOREIGN KEY (`id_kosan`) REFERENCES `kosan` (`id_kosan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fasilitas_kos`
--
ALTER TABLE `fasilitas_kos`
  ADD CONSTRAINT `fk_fasilitas_kos` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id_fasilitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_fasilitas_kos_2` FOREIGN KEY (`id_kosan`) REFERENCES `kosan` (`id_kosan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foto_kos`
--
ALTER TABLE `foto_kos`
  ADD CONSTRAINT `fk_foto_kos` FOREIGN KEY (`id_kosan`) REFERENCES `kosan` (`id_kosan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kosan`
--
ALTER TABLE `kosan`
  ADD CONSTRAINT `fk_kosan` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kota` FOREIGN KEY (`kota`) REFERENCES `kota` (`id_kota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `telpon`
--
ALTER TABLE `telpon`
  ADD CONSTRAINT `fk_notelp` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
