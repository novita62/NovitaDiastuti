-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2020 at 12:12 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `otopres`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(16) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `role` int(1) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
('admin', '$2y$10$uSA0R7GdWFy1.jMDSrXJXOUcY8dDQy7n49gW8nYffy5kfMTGVae/C', 'Admin', 1, 'mYpKSJKf7z', '2020-07-01 01:21:30', '2020-07-01 01:21:30'),
('ngademin', '$2y$10$ozTleqJVaUpRIgQu7pMfqO0xk.gT9dTl2teKOjlIFoDIKSXjM1oBO', 'Ngademin Harjo', 2, 'sx1YSWiqzI', '2020-07-01 05:10:51', '2020-07-01 05:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`) VALUES
(3, 'Ketua'),
(4, 'Wakil Ketua'),
(5, 'Hakim Utama Muda'),
(6, 'Hakim Madya Utama'),
(7, 'Hakim Madya Muda'),
(8, 'Hakim Madya Pratama'),
(9, 'Panitera'),
(10, 'Panitera Muda Perdata'),
(11, 'Panitera Muda Pidana'),
(12, 'Panitera Muda Tipikor'),
(13, 'Panitera Muda PHI'),
(14, 'Panitera Pengganti'),
(15, 'Juru Sita'),
(16, 'Jurusita Pengganti / Staf');

-- --------------------------------------------------------

--
-- Table structure for table `komdanas`
--

CREATE TABLE `komdanas` (
  `kode` varchar(16) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `deskripsi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komdanas`
--

INSERT INTO `komdanas` (`kode`, `keterangan`, `deskripsi`) VALUES
('bw', 'Absen sebelum waktu', 'Melakukan absen masuk sebelum masa absen masuk.'),
('ik', 'Izin Keluar Kantor (pulang)', 'Izin keluar kantor dengan alasan dinas sehingga tidak bisa absen pulang.'),
('lw', 'Absen Lewat Waktu', 'Melakukan absen pulang setelah lewat masa absen pulang'),
('pa', 'Pulang Awal', 'Izin pulang lebih awal'),
('t', 'Terlambat', 'Terlambat masuk kantor'),
('tam', 'Tidak Absen Masuk', 'Tidak melakukan absen masuk'),
('tap', 'Tidak Absen Pulang', 'Tidak melakukan absen pulang'),
('tkd', 'Terlambat karena dinas', 'Terlambat datang ke kantor dengan alasan kedinasan'),
('v', 'Datang dan pulang tepat waktu', '-');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

CREATE TABLE `pangkat` (
  `id` int(11) NOT NULL,
  `nama_pangkat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`id`, `nama_pangkat`) VALUES
(1, 'Pembina Utama Muda (IV/c)'),
(3, 'Pembina Utama Madya (IV/d)'),
(4, 'Pembina Tk.I (IV/b)'),
(5, 'Pembina (IV/a)'),
(6, 'Penata Tk.I (III/d)'),
(7, 'Penata (III/c)'),
(8, 'Penata Muda Tk.I (III/b)'),
(9, 'Penata Muda (III/a)');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(50) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_pangkat` int(11) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `nama_file` varchar(50) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `id_jabatan`, `id_pangkat`, `nama`, `nama_file`, `jam_masuk`, `jam_pulang`) VALUES
('19591010 198612 1 001', 5, 3, 'SURYANTO, SH', 'SURYANTO', '08:00:00', '16:30:00'),
('19601003 199212 1 001', 3, 1, 'BUDI PRASETYO, SH.,MH', 'BUDI PRAS', '08:00:00', '16:30:00'),
('19610312 198803 1 002', 5, 3, 'BANDUNG SUHERMOYO, SH.,M.Hum', 'BANDUNG S', '08:00:00', '16:30:00'),
('19620218 198512 2 001', 5, 3, 'LILIK NURAINI, SH', 'LILIK', '08:00:00', '16:30:00'),
('19680203 199212 2 001', 4, 1, 'FRIDA ARIYANI, SH., M.Hum', 'FRIDA', '08:00:00', '16:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `jenis` int(1) NOT NULL,
  `id_finger` float DEFAULT NULL,
  `nip_pegawai` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `terlambat` time DEFAULT NULL,
  `pulang_cepat` time DEFAULT NULL,
  `jumlah_jam` time DEFAULT NULL,
  `status_komdanas` varchar(32) DEFAULT NULL,
  `file` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id`, `jenis`, `id_finger`, `nip_pegawai`, `tanggal`, `jam_masuk`, `jam_pulang`, `terlambat`, `pulang_cepat`, `jumlah_jam`, `status_komdanas`, `file`) VALUES
(1, 1, 10001, '19680203 199212 2 001', '2020-07-07', NULL, NULL, NULL, NULL, NULL, 'tam, tap', NULL),
(2, 1, 10002, '19601003 199212 1 001', '2020-07-07', NULL, NULL, NULL, NULL, NULL, 'tam, tap', NULL),
(3, 1, 10004, '19620218 198512 2 001', '2020-07-07', '07:55:00', NULL, NULL, NULL, NULL, 'tap', NULL),
(4, 1, 10006, '19610312 198803 1 002', '2020-07-07', '07:28:00', NULL, NULL, NULL, NULL, 'tap', NULL),
(5, 1, 10112, '19591010 198612 1 001', '2020-07-07', NULL, NULL, NULL, NULL, NULL, 'tam, tap', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komdanas`
--
ALTER TABLE `komdanas`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_pangkat` (`id_pangkat`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip_pegawai` (`nip_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pangkat`
--
ALTER TABLE `pangkat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_pangkat`) REFERENCES `pangkat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_ibfk_2` FOREIGN KEY (`nip_pegawai`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
