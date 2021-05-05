-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2021 at 06:26 PM
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
-- Database: `wikikos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota_kos`
--

CREATE TABLE `anggota_kos` (
  `id_anggota` int(11) NOT NULL,
  `NIK` varchar(20) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `id_kosan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota_kos`
--

INSERT INTO `anggota_kos` (`id_anggota`, `NIK`, `nama_anggota`, `id_kosan`) VALUES
(25, '1910130012', 'Budi', 35),
(26, '1910130012', 'Anto', 35);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kos`
--

CREATE TABLE `fasilitas_kos` (
  `id_fasilitas` varchar(11) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL,
  `id_kosan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitas_kos`
--

INSERT INTO `fasilitas_kos` (`id_fasilitas`, `nama_fasilitas`, `id_kosan`) VALUES
('K35F1', 'AC', 35),
('K35F2', 'Kulkas', 35),
('K35F3', 'Meja Belajar', 35),
('K35F4', 'Lemari', 35);

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
(30, './upload/P35.png', 35);

-- --------------------------------------------------------

--
-- Table structure for table `kosan`
--

CREATE TABLE `kosan` (
  `id_kosan` int(11) NOT NULL,
  `nama_kosan` varchar(100) NOT NULL,
  `tipe_kos` varchar(10) NOT NULL,
  `ukuran` varchar(10) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `nama_jalan` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kosan`
--

INSERT INTO `kosan` (`id_kosan`, `nama_kosan`, `tipe_kos`, `ukuran`, `harga`, `kapasitas`, `nama_jalan`, `kecamatan`, `kota`, `deskripsi`, `id_user`) VALUES
(35, 'kosan bu haji', 'campur', '2x4', '100000', 2, 'Jalan mawar', 'Jaha', 'Depok', 'kosan terkece di kota depok', 21);

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
(21, '12345678', 21),
(22, '12345679', 21);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `NIK` varchar(20) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `fullname`, `NIK`, `level`) VALUES
(1, 'admin', '12345', 'john@example.com', 'admin', '1910130012', 0),
(21, 'wadaw', '12345', 'meong@gmail.com', 'wadaw', '1910130012', 1);

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
-- Indexes for table `fasilitas_kos`
--
ALTER TABLE `fasilitas_kos`
  ADD PRIMARY KEY (`id_fasilitas`),
  ADD KEY `fk_fasilitas_kos` (`id_kosan`);

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
  ADD KEY `fk_kosan` (`id_user`);

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
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `foto_kos`
--
ALTER TABLE `foto_kos`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `kosan`
--
ALTER TABLE `kosan`
  MODIFY `id_kosan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `telpon`
--
ALTER TABLE `telpon`
  MODIFY `id_telpon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  ADD CONSTRAINT `fk_fasilitas_kos` FOREIGN KEY (`id_kosan`) REFERENCES `kosan` (`id_kosan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foto_kos`
--
ALTER TABLE `foto_kos`
  ADD CONSTRAINT `fk_foto_kos` FOREIGN KEY (`id_kosan`) REFERENCES `kosan` (`id_kosan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kosan`
--
ALTER TABLE `kosan`
  ADD CONSTRAINT `fk_kosan` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `telpon`
--
ALTER TABLE `telpon`
  ADD CONSTRAINT `fk_notelp` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
