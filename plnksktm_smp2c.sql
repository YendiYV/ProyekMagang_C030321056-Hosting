-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 11, 2023 at 03:50 PM
-- Server version: 10.3.37-MariaDB-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plnksktm_smp2c`
--

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id_cuti` varchar(30) NOT NULL,
  `id_user` varchar(256) NOT NULL,
  `alasan` text NOT NULL,
  `tgl_diajukan` date NOT NULL,
  `mulai` date NOT NULL,
  `berakhir` date NOT NULL,
  `id_status_cuti1` int(12) NOT NULL,
  `id_status_cuti2` int(12) NOT NULL,
  `id_status_cuti3` int(12) NOT NULL,
  `perihal_cuti` varchar(100) NOT NULL,
  `jumlah_hari` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kelamin`
--

CREATE TABLE `jenis_kelamin` (
  `id_jenis_kelamin` int(11) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_kelamin`
--

INSERT INTO `jenis_kelamin` (`id_jenis_kelamin`, `jenis_kelamin`) VALUES
(1, 'Laki-Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `operator_level`
--

CREATE TABLE `operator_level` (
  `id_level` int(11) NOT NULL,
  `operator_level` varchar(30) NOT NULL,
  `gaji` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `operator_level`
--

INSERT INTO `operator_level` (`id_level`, `operator_level`, `gaji`) VALUES
(1, 'SDM', 1400000);

-- --------------------------------------------------------

--
-- Table structure for table `status_cuti`
--

CREATE TABLE `status_cuti` (
  `id_status_cuti` int(11) NOT NULL,
  `status_cuti` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_cuti`
--

INSERT INTO `status_cuti` (`id_status_cuti`, `status_cuti`) VALUES
(1, 'Menunggu Konfirmasi'),
(2, 'Izin Cuti Diterima'),
(3, 'Izin Cuti Ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `status_penempatan`
--

CREATE TABLE `status_penempatan` (
  `id_penempatan` int(11) NOT NULL,
  `nama_penempatan` varchar(50) NOT NULL,
  `gaji` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_penempatan`
--

INSERT INTO `status_penempatan` (`id_penempatan`, `nama_penempatan`, `gaji`) VALUES
(1, 'Barito Timur', 1200000),
(2, 'Barito Selatan', 1400000);

-- --------------------------------------------------------

--
-- Table structure for table `status_proyek`
--

CREATE TABLE `status_proyek` (
  `id_status_proyek` int(11) NOT NULL,
  `nama_proyek` varchar(100) NOT NULL,
  `gaji` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_proyek`
--

INSERT INTO `status_proyek` (`id_status_proyek`, `nama_proyek`, `gaji`) VALUES
(1, 'TL', 1200000),
(2, 'PP', 1400000),
(3, 'Buntok', 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(256) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_user_detail` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_user_level`, `id_user_detail`) VALUES
('134e349e4f50a051d8ca3687d6a7de1a', '1234567ADM', '202cb962ac59075b964b07152d234b70', 2, '134e349e4f50a051d8ca3687d6a7de1a'),
('c551fc8847d29dc25a23db5d2cdb941b', '2345678PKY', '0545abd0dc44d4531a53331e44febd02', 1, 'c551fc8847d29dc25a23db5d2cdb941b'),
('d41d8cd98f00b204e9800998ecf8427e', '1231232PKY', '3d988dc765ab71877e076a474c6232dd', 1, 'd41d8cd98f00b204e9800998ecf8427e'),
('dce802a5e29e9ccabc144dfb6a37abbb', '1234567PKY', '7363a0d0604902af7b70b271a0b96480', 1, 'dce802a5e29e9ccabc144dfb6a37abbb'),
('eb71208764d1a8a02cdf86a49ccd1489', '1234567MNJ', '202cb962ac59075b964b07152d234b70', 4, 'eb71208764d1a8a02cdf86a49ccd1489'),
('f5972fbf4ef53843c1e12c3ae99e5005', '1234567SPV', '202cb962ac59075b964b07152d234b70', 3, 'f5972fbf4ef53843c1e12c3ae99e5005'),
('f7c7b7e19a4ed7a51db593c8efbee984', '3456789BJM', 'b58c50e209762c24adb9f29daffe249c', 1, 'f7c7b7e19a4ed7a51db593c8efbee984');

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `id_user_detail` varchar(256) NOT NULL,
  `nama_lengkap` varchar(30) DEFAULT NULL,
  `id_jenis_kelamin` int(12) DEFAULT NULL,
  `no_telp` varchar(30) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nip` varchar(10) DEFAULT NULL,
  `proyek` int(12) NOT NULL,
  `jabatan` int(12) DEFAULT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`id_user_detail`, `nama_lengkap`, `id_jenis_kelamin`, `no_telp`, `alamat`, `nip`, `proyek`, `jabatan`, `tanggal_masuk`) VALUES
('134e349e4f50a051d8ca3687d6a7de1a', 'Admin', 1, '08080808', 'Jl. Pangeran H No.22', '1234567ADM', 1, 0, '2023-10-01'),
('c551fc8847d29dc25a23db5d2cdb941b', 'Putri', 2, '+62812781728', 'Jl. Sekip', '2345678PKY', 2, 0, '2023-10-11'),
('d41d8cd98f00b204e9800998ecf8427e', 'Ahmad Nafual', 1, '0987654', 'Jl. Pengayaan', '1231232PKY', 0, 1, '2023-10-11'),
('dce802a5e29e9ccabc144dfb6a37abbb', 'Suci Priani', 2, '+62812781728', 'Jl. Negara', '1234567PKY', 0, 0, '2023-10-11'),
('eb71208764d1a8a02cdf86a49ccd1489', 'Manajer Yendi', 1, '081212121212', 'Jl. Hidayatullah No.22', '1234567MNJ', 0, 0, '0000-00-00'),
('f5972fbf4ef53843c1e12c3ae99e5005', 'Supervisior', 1, NULL, NULL, '1234567SPV', 0, 0, '0000-00-00'),
('f7c7b7e19a4ed7a51db593c8efbee984', 'Operator Aminudin', 1, '+628127817281', 'Jl. Sekip', '3456789BJM', 1, 0, '2023-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id_user_level` int(11) NOT NULL,
  `user_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_user_level`, `user_level`) VALUES
(1, 'Operator'),
(2, 'Admin'),
(3, 'Supervisior'),
(4, 'Manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`);

--
-- Indexes for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  ADD PRIMARY KEY (`id_jenis_kelamin`);

--
-- Indexes for table `operator_level`
--
ALTER TABLE `operator_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `status_cuti`
--
ALTER TABLE `status_cuti`
  ADD PRIMARY KEY (`id_status_cuti`);

--
-- Indexes for table `status_penempatan`
--
ALTER TABLE `status_penempatan`
  ADD PRIMARY KEY (`id_penempatan`);

--
-- Indexes for table `status_proyek`
--
ALTER TABLE `status_proyek`
  ADD PRIMARY KEY (`id_status_proyek`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`id_user_detail`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  MODIFY `id_jenis_kelamin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `operator_level`
--
ALTER TABLE `operator_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_cuti`
--
ALTER TABLE `status_cuti`
  MODIFY `id_status_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_penempatan`
--
ALTER TABLE `status_penempatan`
  MODIFY `id_penempatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_proyek`
--
ALTER TABLE `status_proyek`
  MODIFY `id_status_proyek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
