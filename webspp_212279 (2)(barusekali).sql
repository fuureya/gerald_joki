-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2024 at 05:50 AM
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
-- Database: `webspp_212279`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_212279`
--

CREATE TABLE `admin_212279` (
  `212279_id_admin` int NOT NULL,
  `212279_nama_admin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `212279_user_admin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `212279_pass_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `212279_status_admin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `212279_email_admin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_212279`
--

INSERT INTO `admin_212279` (`212279_id_admin`, `212279_nama_admin`, `212279_user_admin`, `212279_pass_admin`, `212279_status_admin`, `212279_email_admin`) VALUES
(1, 'Gerald Sharon Ratu', 'Sharon', '20122002', '0', 'geraldshrn@gmail.com'),
(2, 'Fransisco De Matheo', 'Matheo', '21228989', '0', 'maknakata75@gmail.com'),
(7, 'Reynhard', 'Pamumbu', '87654321', '0', 'speedvans123@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `angkatan_212279`
--

CREATE TABLE `angkatan_212279` (
  `212279_id_angkatan` int NOT NULL,
  `212279_nama_angkatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `212279_biaya` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `angkatan_212279`
--

INSERT INTO `angkatan_212279` (`212279_id_angkatan`, `212279_nama_angkatan`, `212279_biaya`) VALUES
(1, '2021/2022', '300000'),
(2, '2022/2023', '350000'),
(3, '2023/2024', '400000'),
(4, '2020/2021', '250000');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan_212279`
--

CREATE TABLE `jurusan_212279` (
  `212279_id_jurusan` int NOT NULL,
  `212279_nama_jurusan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan_212279`
--

INSERT INTO `jurusan_212279` (`212279_id_jurusan`, `212279_nama_jurusan`) VALUES
(1, 'MIPA 1'),
(2, 'MIPA 2'),
(3, 'MIPA 3'),
(4, 'IPS 1'),
(5, 'IPS 2');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_212279`
--

CREATE TABLE `kelas_212279` (
  `212279_id_kelas` int NOT NULL,
  `212279_nama_kelas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas_212279`
--

INSERT INTO `kelas_212279` (`212279_id_kelas`, `212279_nama_kelas`) VALUES
(1, 'X'),
(2, 'XI'),
(3, 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_212279`
--

CREATE TABLE `pembayaran_212279` (
  `212279_idspp` int NOT NULL,
  `212279_id_siswa` int NOT NULL,
  `212279_jatuhtempo` date NOT NULL,
  `212279_bulan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `212279_nobayar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `212279_tglbayar` date DEFAULT NULL,
  `212279_jumlah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `212279_denda` int DEFAULT NULL,
  `212279_ket` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `212279_id_admin` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran_212279`
--

INSERT INTO `pembayaran_212279` (`212279_idspp`, `212279_id_siswa`, `212279_jatuhtempo`, `212279_bulan`, `212279_nobayar`, `212279_tglbayar`, `212279_jumlah`, `212279_denda`, `212279_ket`, `212279_id_admin`) VALUES
(1, 1, '2024-06-11', 'Juni 2024', '110620241622332233', '2024-06-11', '300000', 0, 'LUNAS', 1),
(2, 1, '2024-07-11', 'Juli 2024', '120620240212351235', '2024-06-12', '300000', 0, 'LUNAS', 1),
(3, 1, '2024-08-11', 'Agustus 2024', NULL, NULL, '300000', NULL, NULL, NULL),
(4, 1, '2024-09-11', 'September 2024', NULL, NULL, '300000', NULL, NULL, NULL),
(5, 1, '2024-10-11', 'Oktober 2024', NULL, NULL, '300000', NULL, NULL, NULL),
(6, 1, '2024-11-11', 'November 2024', NULL, NULL, '300000', NULL, NULL, NULL),
(7, 1, '2024-12-11', 'Desember 2024', NULL, NULL, '300000', NULL, NULL, NULL),
(8, 1, '2025-01-11', 'Januari 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(9, 1, '2025-02-11', 'Februari 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(10, 1, '2025-03-11', 'Maret 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(11, 1, '2025-04-11', 'April 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(12, 1, '2025-05-11', 'Mei 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(13, 1, '2025-06-11', 'Juni 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(14, 1, '2025-07-11', 'Juli 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(15, 1, '2025-08-11', 'Agustus 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(16, 1, '2025-09-11', 'September 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(17, 1, '2025-10-11', 'Oktober 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(18, 1, '2025-11-11', 'November 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(19, 1, '2025-12-11', 'Desember 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(20, 1, '2026-01-11', 'Januari 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(21, 1, '2026-02-11', 'Februari 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(22, 1, '2026-03-11', 'Maret 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(23, 1, '2026-04-11', 'April 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(24, 1, '2026-05-11', 'Mei 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(25, 1, '2026-06-11', 'Juni 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(26, 1, '2026-07-11', 'Juli 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(27, 1, '2026-08-11', 'Agustus 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(28, 1, '2026-09-11', 'September 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(29, 1, '2026-10-11', 'Oktober 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(30, 1, '2026-11-11', 'November 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(31, 1, '2026-12-11', 'Desember 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(32, 1, '2027-01-11', 'Januari 2027', NULL, NULL, '300000', NULL, NULL, NULL),
(33, 1, '2027-02-11', 'Februari 2027', NULL, NULL, '300000', NULL, NULL, NULL),
(34, 1, '2027-03-11', 'Maret 2027', NULL, NULL, '300000', NULL, NULL, NULL),
(35, 1, '2027-04-11', 'April 2027', NULL, NULL, '300000', NULL, NULL, NULL),
(36, 1, '2027-05-11', 'Mei 2027', NULL, NULL, '300000', NULL, NULL, NULL),
(37, 2, '2024-06-11', 'Juni 2024', NULL, NULL, '350000', NULL, NULL, NULL),
(38, 2, '2024-07-11', 'Juli 2024', NULL, NULL, '350000', NULL, NULL, NULL),
(39, 2, '2024-08-11', 'Agustus 2024', NULL, NULL, '350000', NULL, NULL, NULL),
(40, 2, '2024-09-11', 'September 2024', NULL, NULL, '350000', NULL, NULL, NULL),
(41, 2, '2024-10-11', 'Oktober 2024', NULL, NULL, '350000', NULL, NULL, NULL),
(42, 2, '2024-11-11', 'November 2024', NULL, NULL, '350000', NULL, NULL, NULL),
(43, 2, '2024-12-11', 'Desember 2024', NULL, NULL, '350000', NULL, NULL, NULL),
(44, 2, '2025-01-11', 'Januari 2025', NULL, NULL, '350000', NULL, NULL, NULL),
(45, 2, '2025-02-11', 'Februari 2025', NULL, NULL, '350000', NULL, NULL, NULL),
(46, 2, '2025-03-11', 'Maret 2025', NULL, NULL, '350000', NULL, NULL, NULL),
(47, 2, '2025-04-11', 'April 2025', NULL, NULL, '350000', NULL, NULL, NULL),
(48, 2, '2025-05-11', 'Mei 2025', NULL, NULL, '350000', NULL, NULL, NULL),
(49, 2, '2025-06-11', 'Juni 2025', NULL, NULL, '350000', NULL, NULL, NULL),
(50, 2, '2025-07-11', 'Juli 2025', NULL, NULL, '350000', NULL, NULL, NULL),
(51, 2, '2025-08-11', 'Agustus 2025', NULL, NULL, '350000', NULL, NULL, NULL),
(52, 2, '2025-09-11', 'September 2025', NULL, NULL, '350000', NULL, NULL, NULL),
(53, 2, '2025-10-11', 'Oktober 2025', NULL, NULL, '350000', NULL, NULL, NULL),
(54, 2, '2025-11-11', 'November 2025', NULL, NULL, '350000', NULL, NULL, NULL),
(55, 2, '2025-12-11', 'Desember 2025', NULL, NULL, '350000', NULL, NULL, NULL),
(56, 2, '2026-01-11', 'Januari 2026', NULL, NULL, '350000', NULL, NULL, NULL),
(57, 2, '2026-02-11', 'Februari 2026', NULL, NULL, '350000', NULL, NULL, NULL),
(58, 2, '2026-03-11', 'Maret 2026', NULL, NULL, '350000', NULL, NULL, NULL),
(59, 2, '2026-04-11', 'April 2026', NULL, NULL, '350000', NULL, NULL, NULL),
(60, 2, '2026-05-11', 'Mei 2026', NULL, NULL, '350000', NULL, NULL, NULL),
(61, 2, '2026-06-11', 'Juni 2026', NULL, NULL, '350000', NULL, NULL, NULL),
(62, 2, '2026-07-11', 'Juli 2026', NULL, NULL, '350000', NULL, NULL, NULL),
(63, 2, '2026-08-11', 'Agustus 2026', NULL, NULL, '350000', NULL, NULL, NULL),
(64, 2, '2026-09-11', 'September 2026', NULL, NULL, '350000', NULL, NULL, NULL),
(65, 2, '2026-10-11', 'Oktober 2026', NULL, NULL, '350000', NULL, NULL, NULL),
(66, 2, '2026-11-11', 'November 2026', NULL, NULL, '350000', NULL, NULL, NULL),
(67, 2, '2026-12-11', 'Desember 2026', NULL, NULL, '350000', NULL, NULL, NULL),
(68, 2, '2027-01-11', 'Januari 2027', NULL, NULL, '350000', NULL, NULL, NULL),
(69, 2, '2027-02-11', 'Februari 2027', NULL, NULL, '350000', NULL, NULL, NULL),
(70, 2, '2027-03-11', 'Maret 2027', NULL, NULL, '350000', NULL, NULL, NULL),
(71, 2, '2027-04-11', 'April 2027', NULL, NULL, '350000', NULL, NULL, NULL),
(72, 2, '2027-05-11', 'Mei 2027', NULL, NULL, '350000', NULL, NULL, NULL),
(73, 3, '2024-06-11', 'Juni 2024', NULL, NULL, '400000', NULL, NULL, NULL),
(74, 3, '2024-07-11', 'Juli 2024', NULL, NULL, '400000', NULL, NULL, NULL),
(75, 3, '2024-08-11', 'Agustus 2024', NULL, NULL, '400000', NULL, NULL, NULL),
(76, 3, '2024-09-11', 'September 2024', NULL, NULL, '400000', NULL, NULL, NULL),
(77, 3, '2024-10-11', 'Oktober 2024', NULL, NULL, '400000', NULL, NULL, NULL),
(78, 3, '2024-11-11', 'November 2024', NULL, NULL, '400000', NULL, NULL, NULL),
(79, 3, '2024-12-11', 'Desember 2024', NULL, NULL, '400000', NULL, NULL, NULL),
(80, 3, '2025-01-11', 'Januari 2025', NULL, NULL, '400000', NULL, NULL, NULL),
(81, 3, '2025-02-11', 'Februari 2025', NULL, NULL, '400000', NULL, NULL, NULL),
(82, 3, '2025-03-11', 'Maret 2025', NULL, NULL, '400000', NULL, NULL, NULL),
(83, 3, '2025-04-11', 'April 2025', NULL, NULL, '400000', NULL, NULL, NULL),
(84, 3, '2025-05-11', 'Mei 2025', NULL, NULL, '400000', NULL, NULL, NULL),
(85, 3, '2025-06-11', 'Juni 2025', NULL, NULL, '400000', NULL, NULL, NULL),
(86, 3, '2025-07-11', 'Juli 2025', NULL, NULL, '400000', NULL, NULL, NULL),
(87, 3, '2025-08-11', 'Agustus 2025', NULL, NULL, '400000', NULL, NULL, NULL),
(88, 3, '2025-09-11', 'September 2025', NULL, NULL, '400000', NULL, NULL, NULL),
(89, 3, '2025-10-11', 'Oktober 2025', NULL, NULL, '400000', NULL, NULL, NULL),
(90, 3, '2025-11-11', 'November 2025', NULL, NULL, '400000', NULL, NULL, NULL),
(91, 3, '2025-12-11', 'Desember 2025', NULL, NULL, '400000', NULL, NULL, NULL),
(92, 3, '2026-01-11', 'Januari 2026', NULL, NULL, '400000', NULL, NULL, NULL),
(93, 3, '2026-02-11', 'Februari 2026', NULL, NULL, '400000', NULL, NULL, NULL),
(94, 3, '2026-03-11', 'Maret 2026', NULL, NULL, '400000', NULL, NULL, NULL),
(95, 3, '2026-04-11', 'April 2026', NULL, NULL, '400000', NULL, NULL, NULL),
(96, 3, '2026-05-11', 'Mei 2026', NULL, NULL, '400000', NULL, NULL, NULL),
(97, 3, '2026-06-11', 'Juni 2026', NULL, NULL, '400000', NULL, NULL, NULL),
(98, 3, '2026-07-11', 'Juli 2026', NULL, NULL, '400000', NULL, NULL, NULL),
(99, 3, '2026-08-11', 'Agustus 2026', NULL, NULL, '400000', NULL, NULL, NULL),
(100, 3, '2026-09-11', 'September 2026', NULL, NULL, '400000', NULL, NULL, NULL),
(101, 3, '2026-10-11', 'Oktober 2026', NULL, NULL, '400000', NULL, NULL, NULL),
(102, 3, '2026-11-11', 'November 2026', NULL, NULL, '400000', NULL, NULL, NULL),
(103, 3, '2026-12-11', 'Desember 2026', NULL, NULL, '400000', NULL, NULL, NULL),
(104, 3, '2027-01-11', 'Januari 2027', NULL, NULL, '400000', NULL, NULL, NULL),
(105, 3, '2027-02-11', 'Februari 2027', NULL, NULL, '400000', NULL, NULL, NULL),
(106, 3, '2027-03-11', 'Maret 2027', NULL, NULL, '400000', NULL, NULL, NULL),
(107, 3, '2027-04-11', 'April 2027', NULL, NULL, '400000', NULL, NULL, NULL),
(108, 3, '2027-05-11', 'Mei 2027', NULL, NULL, '400000', NULL, NULL, NULL),
(109, 12, '2024-06-11', 'Juni 2024', NULL, NULL, '300000', NULL, NULL, NULL),
(110, 12, '2024-07-11', 'Juli 2024', NULL, NULL, '300000', NULL, NULL, NULL),
(111, 12, '2024-08-11', 'Agustus 2024', NULL, NULL, '300000', NULL, NULL, NULL),
(112, 12, '2024-09-11', 'September 2024', NULL, NULL, '300000', NULL, NULL, NULL),
(113, 12, '2024-10-11', 'Oktober 2024', NULL, NULL, '300000', NULL, NULL, NULL),
(114, 12, '2024-11-11', 'November 2024', NULL, NULL, '300000', NULL, NULL, NULL),
(115, 12, '2024-12-11', 'Desember 2024', NULL, NULL, '300000', NULL, NULL, NULL),
(116, 12, '2025-01-11', 'Januari 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(117, 12, '2025-02-11', 'Februari 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(118, 12, '2025-03-11', 'Maret 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(119, 12, '2025-04-11', 'April 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(120, 12, '2025-05-11', 'Mei 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(121, 12, '2025-06-11', 'Juni 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(122, 12, '2025-07-11', 'Juli 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(123, 12, '2025-08-11', 'Agustus 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(124, 12, '2025-09-11', 'September 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(125, 12, '2025-10-11', 'Oktober 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(126, 12, '2025-11-11', 'November 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(127, 12, '2025-12-11', 'Desember 2025', NULL, NULL, '300000', NULL, NULL, NULL),
(128, 12, '2026-01-11', 'Januari 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(129, 12, '2026-02-11', 'Februari 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(130, 12, '2026-03-11', 'Maret 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(131, 12, '2026-04-11', 'April 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(132, 12, '2026-05-11', 'Mei 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(133, 12, '2026-06-11', 'Juni 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(134, 12, '2026-07-11', 'Juli 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(135, 12, '2026-08-11', 'Agustus 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(136, 12, '2026-09-11', 'September 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(137, 12, '2026-10-11', 'Oktober 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(138, 12, '2026-11-11', 'November 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(139, 12, '2026-12-11', 'Desember 2026', NULL, NULL, '300000', NULL, NULL, NULL),
(140, 12, '2027-01-11', 'Januari 2027', NULL, NULL, '300000', NULL, NULL, NULL),
(141, 12, '2027-02-11', 'Februari 2027', NULL, NULL, '300000', NULL, NULL, NULL),
(142, 12, '2027-03-11', 'Maret 2027', NULL, NULL, '300000', NULL, NULL, NULL),
(143, 12, '2027-04-11', 'April 2027', NULL, NULL, '300000', NULL, NULL, NULL),
(144, 12, '2027-05-11', 'Mei 2027', NULL, NULL, '300000', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa_212279`
--

CREATE TABLE `siswa_212279` (
  `212279_id_siswa` int NOT NULL,
  `212279_nisn` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `212279_nama_siswa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `212279_id_angkatan` int NOT NULL,
  `212279_id_jurusan` int DEFAULT NULL,
  `212279_id_kelas` int NOT NULL,
  `212279_alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `212279_jk` enum('Pria','Wanita') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `212279_foto` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `212279_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa_212279`
--

INSERT INTO `siswa_212279` (`212279_id_siswa`, `212279_nisn`, `212279_nama_siswa`, `212279_id_angkatan`, `212279_id_jurusan`, `212279_id_kelas`, `212279_alamat`, `212279_jk`, `212279_foto`, `212279_status`) VALUES
(1, '11062024160447', 'Pajri Hasim', 1, 1, 1, 'Makassar', 'Pria', '2843.jpg', 'Aktif'),
(2, '11062024160517', 'Baiq Anda Riska Dwi Aprianti', 2, 2, 2, 'Makassar', 'Wanita', '6384.jpg', 'Aktif'),
(3, '11062024162106', 'Mawardi', 3, 5, 3, 'Makassar', 'Pria', '5326.jpg', 'Aktif'),
(12, '11062024164708', 'Tiffany', 4, 4, 1, 'Makassar', 'Wanita', '1235.jpg', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_212279`
--
ALTER TABLE `admin_212279`
  ADD PRIMARY KEY (`212279_id_admin`);

--
-- Indexes for table `angkatan_212279`
--
ALTER TABLE `angkatan_212279`
  ADD PRIMARY KEY (`212279_id_angkatan`);

--
-- Indexes for table `jurusan_212279`
--
ALTER TABLE `jurusan_212279`
  ADD PRIMARY KEY (`212279_id_jurusan`);

--
-- Indexes for table `kelas_212279`
--
ALTER TABLE `kelas_212279`
  ADD PRIMARY KEY (`212279_id_kelas`);

--
-- Indexes for table `pembayaran_212279`
--
ALTER TABLE `pembayaran_212279`
  ADD PRIMARY KEY (`212279_idspp`),
  ADD KEY `212289_id_siswa` (`212279_id_siswa`,`212279_id_admin`),
  ADD KEY `212289_id_admin` (`212279_id_admin`);

--
-- Indexes for table `siswa_212279`
--
ALTER TABLE `siswa_212279`
  ADD PRIMARY KEY (`212279_id_siswa`),
  ADD KEY `212279_id_angkatan` (`212279_id_angkatan`),
  ADD KEY `212279_id_jurusan` (`212279_id_jurusan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_212279`
--
ALTER TABLE `admin_212279`
  MODIFY `212279_id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `angkatan_212279`
--
ALTER TABLE `angkatan_212279`
  MODIFY `212279_id_angkatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jurusan_212279`
--
ALTER TABLE `jurusan_212279`
  MODIFY `212279_id_jurusan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas_212279`
--
ALTER TABLE `kelas_212279`
  MODIFY `212279_id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran_212279`
--
ALTER TABLE `pembayaran_212279`
  MODIFY `212279_idspp` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `siswa_212279`
--
ALTER TABLE `siswa_212279`
  MODIFY `212279_id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
