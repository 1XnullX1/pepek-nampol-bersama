-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 03:31 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `nik` int(200) NOT NULL,
  `no_id` varchar(25) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telphone` varbinary(12) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`nik`, `no_id`, `nama`, `alamat`, `no_telphone`, `username`, `password`, `role`) VALUES
(1, '0', 'Super Admin', '0', 0x30, 'xnullx', '202cb962ac59075b964b07152d234b70', 1),
(6, '1231', 'Leon S Kennedyss', 'Leon S Kennedyss', 0x313233313233, 'admin', '21232f297a57a5a743894a0e4a801fc3', 2),
(10, '414141', 'John', 'Bekasi, cikunir', 0x313233313233, 'dart', '202cb962ac59075b964b07152d234b70', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nik` int(200) NOT NULL,
  `jenis_id` varchar(11) NOT NULL,
  `no_id` int(25) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_berlaku` date DEFAULT NULL,
  `status_user` varchar(12) DEFAULT NULL,
  `validation` varchar(100) NOT NULL,
  `lokasi_gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nik`, `jenis_id`, `no_id`, `nama`, `alamat`, `tanggal_mulai`, `tanggal_berlaku`, `status_user`, `validation`, `lokasi_gambar`) VALUES
(96, 'ID_TERSEDIA', 207049, 'Fajar Gunawan', 'DUFAN', '0000-00-00', '2023-08-31', 'Karyawan', 'Aktif', 'download.png'),
(99, 'ID_TERSEDIA', 206517, 'Ana Trikani Muliar', 'DUFAN', '0000-00-00', '2023-08-31', 'Karyawan', 'Aktif', ''),
(100, 'ID_TERSEDIA', 205553, 'Nur Atiis Salim', 'DUFAN', '0000-00-00', '2023-08-31', 'Karyawan', 'Aktif', 'download.png'),
(102, 'ID_TERSEDIA', 2016230122, 'Denis Ahmad Prastio', 'Jl.H.Ibrahim. no 22', '0000-00-00', '2023-08-31', 'Outsourcing', 'Aktif', 'DSC0613.jpg'),
(103, 'ID_TERSEDIA', 206327, 'Awang Ardianto Saputro', 'DUFAN', '0000-00-00', '2023-08-02', 'Karyawan', 'Aktif', 'download.png'),
(105, 'ID_TERSEDIA', 264, 'ADE SAPUTRA', 'DUFAN', '2023-08-07', '2023-08-30', 'Outsourcing', 'Aktif', '264.png'),
(206, 'KTP', 14045, 'John Peter', 'Moskow, No22. Russia', '2023-08-07', '2023-08-17', 'Karyawan', 'Aktif', '14045.png'),
(238, 'KTP', 2147483647, 'wtsgdfgd', 'dhdfhdf', '2023-08-06', '2023-08-24', 'Karyawan', 'Aktif', '.png'),
(239, 'KTP', 423425, 'gsdgsdg', 'gszga', '2023-08-06', '2023-08-31', 'Outsourcing', 'Aktif', '423425.png'),
(240, 'KTP', 214354365, 'ewtsegsdg', 'dgsdgsd', '2023-08-06', '2023-08-31', 'Karyawan', 'Aktif', '214354365.png'),
(241, 'SIM', 2147483647, 'gfjfgjfurtur', 'feyreye', '2023-08-06', '2023-08-17', 'Karyawan', 'Aktif', '13243423534.png'),
(242, 'KTP', 223235, 'dgdfh', 'dfhdh', '2023-08-07', '2023-08-24', 'Karyawan', 'Aktif', '223235.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `no_log` int(255) NOT NULL,
  `nik` int(25) NOT NULL,
  `date` date DEFAULT NULL,
  `time_stamp_in` time DEFAULT NULL,
  `time_stamp_out` time DEFAULT NULL,
  `calculation_time` time DEFAULT NULL,
  `condition` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`no_log`, `nik`, `date`, `time_stamp_in`, `time_stamp_out`, `calculation_time`, `condition`) VALUES
(9, 2222, '2023-07-13', '12:16:49', '20:11:22', '14:54:00', 2),
(10, 2222, '2023-07-13', '12:49:20', '20:51:13', '16:34:00', 2),
(11, 2222, '2023-07-13', '18:49:54', '21:25:17', '18:08:00', 2),
(13, 2222, '2023-07-13', '18:49:56', '21:27:14', '04:27:00', 1),
(14, 1515, '2023-07-13', '13:50:00', '00:00:00', '00:00:00', 4),
(15, 1515, '2023-07-13', '14:06:33', '00:00:00', '00:00:00', 5),
(16, 1515, '2023-07-13', '14:06:42', '00:00:00', '00:00:00', 5),
(17, 2222, '2023-07-13', '14:06:55', '21:52:27', '04:52:00', 1),
(100, 1515, '2023-07-13', NULL, '20:59:04', NULL, 5),
(101, 1515, '2023-07-13', NULL, '20:59:39', NULL, 5),
(102, 1515, '2023-07-13', NULL, '21:43:28', NULL, 5),
(105, 2222, '2023-07-13', '17:57:29', '23:05:28', '05:07:59', 1),
(108, 1515, '2023-07-13', NULL, '23:08:59', NULL, 5),
(109, 1515, '2023-07-13', '23:12:25', '00:00:00', '00:00:00', 5),
(110, 2222, '2023-07-13', '22:12:28', '23:12:53', '01:00:25', 1),
(122, 2016230122, '2023-07-13', '23:41:58', '23:42:22', '00:00:24', 1),
(123, 2016230122, '2023-07-13', '23:42:03', '00:00:00', '00:00:00', 4),
(124, 2222, '2023-07-14', '01:10:29', '00:00:00', '00:00:00', 3),
(125, 2016230122, '2023-07-14', '01:13:46', '00:00:00', '00:00:00', 3),
(161, 2016230122, '2023-07-18', '21:37:00', '00:00:00', '00:00:00', 1),
(162, 2016230122, '2023-07-18', '21:37:11', '00:00:00', '00:00:00', 4),
(163, 2016230122, '2023-07-18', '21:37:22', '00:00:00', '00:00:00', 4),
(164, 2016230122, '2023-07-18', '21:37:37', '00:00:00', '00:00:00', 1),
(167, 2016230122, '2023-07-18', '21:39:12', '00:00:00', '00:00:00', 3),
(168, 206590, '2023-07-19', '03:46:33', '00:00:00', '00:00:00', 3),
(169, 207049, '2023-07-19', '03:46:41', '12:36:09', '08:49:28', 1),
(170, 206354, '2023-07-19', '03:46:47', '00:00:00', '00:00:00', 3),
(171, 206517, '2023-07-19', '03:46:55', '00:00:00', '00:00:00', 3),
(172, 205553, '2023-07-19', '03:47:03', '00:00:00', '00:00:00', 3),
(173, 264, '2023-07-19', '03:47:10', '00:00:00', '00:00:00', 3),
(174, 206590, '2023-07-19', NULL, '12:36:00', NULL, 5),
(199, 2016230122, '2023-07-31', '21:39:33', '00:00:00', '00:00:00', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`no_log`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `nik` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `nik` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `no_log` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
