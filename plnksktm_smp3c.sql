-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2023 at 04:35 PM
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
-- Database: `plnksktm_smp3c`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi_level`
--

CREATE TABLE `absensi_level` (
  `id_absen_level` int(11) NOT NULL,
  `nama_status` varchar(50) NOT NULL,
  `singkatan_status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `absensi_level`
--

INSERT INTO `absensi_level` (`id_absen_level`, `nama_status`, `singkatan_status`) VALUES
(1, 'Hadir', 'H'),
(2, 'Cuti', 'C'),
(3, 'Sakit', 'S'),
(4, 'Izin', 'I'),
(5, 'Alfa', 'A'),
(6, 'Hadir Masuk-Pulang', 'HS');

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

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id_cuti`, `id_user`, `alasan`, `tgl_diajukan`, `mulai`, `berakhir`, `id_status_cuti1`, `id_status_cuti2`, `id_status_cuti3`, `perihal_cuti`, `jumlah_hari`) VALUES
('0001-SP-Cuti-2023', '23bdd1cd96888f836956a97a0fdc6bd5', 'TES', '2023-10-30', '2023-11-01', '2023-11-06', 2, 3, 2, 'TES', 4),
('7456-SP-Cuti-2023', '23bdd1cd96888f836956a97a0fdc6bd5', 'Pemeriksaan Kesehatan', '2023-11-10', '2023-11-13', '2023-11-17', 2, 2, 1, 'Sakit', 6);

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
  `gaji_level` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `operator_level`
--

INSERT INTO `operator_level` (`id_level`, `operator_level`, `gaji_level`) VALUES
(1, 'Koordinator', 1900000),
(5, 'Operasional', 1500000),
(13, 'Lapangan', 1200000),
(14, 'SDM', 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `status_absensi`
--

CREATE TABLE `status_absensi` (
  `id_absen` int(11) NOT NULL,
  `id_user_detail` varchar(256) DEFAULT NULL,
  `tanggal_absen` date DEFAULT NULL,
  `status_absen` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_absensi`
--

INSERT INTO `status_absensi` (`id_absen`, `id_user_detail`, `tanggal_absen`, `status_absen`) VALUES
(4, '23bdd1cd96888f836956a97a0fdc6bd5', '2023-11-08', '1'),
(5, 'd41d8cd98f00b204e9800998ecf8427e', '2023-11-08', '1'),
(6, 'c551fc8847d29dc25a23db5d2cdb941b', '2023-11-08', '3'),
(7, 'f7c7b7e19a4ed7a51db593c8efbee984', '2023-11-08', '4'),
(8, 'dce802a5e29e9ccabc144dfb6a37abbb', '2023-11-08', '5'),
(11, 'd41d8cd98f00b204e9800998ecf8427e', '2023-11-01', '2'),
(12, 'd41d8cd98f00b204e9800998ecf8427e', '2023-11-02', '1'),
(13, 'dce802a5e29e9ccabc144dfb6a37abbb', '2023-11-01', '4'),
(14, 'f7c7b7e19a4ed7a51db593c8efbee984', '2023-11-01', '1'),
(15, 'f7c7b7e19a4ed7a51db593c8efbee984', '2023-11-02', '2'),
(16, 'c551fc8847d29dc25a23db5d2cdb941b', '2023-11-01', '5'),
(20, '23bdd1cd96888f836956a97a0fdc6bd5', '2023-11-09', '1'),
(21, 'd41d8cd98f00b204e9800998ecf8427e', '2023-11-09', '3'),
(22, 'c551fc8847d29dc25a23db5d2cdb941b', '2023-11-09', '4'),
(23, 'f7c7b7e19a4ed7a51db593c8efbee984', '2023-11-09', '4'),
(24, 'd41d8cd98f00b204e9800998ecf8427e', '2023-11-03', '1'),
(25, 'd41d8cd98f00b204e9800998ecf8427e', '2023-11-06', '1'),
(26, '23bdd1cd96888f836956a97a0fdc6bd5', '2023-11-10', '6'),
(27, 'd41d8cd98f00b204e9800998ecf8427e', '2023-10-10', '5');

-- --------------------------------------------------------

--
-- Table structure for table `status_bpk`
--

CREATE TABLE `status_bpk` (
  `id_level_bpk` int(11) NOT NULL,
  `nama_bpk` varchar(100) NOT NULL,
  `gaji_bpk` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_bpk`
--

INSERT INTO `status_bpk` (`id_level_bpk`, `nama_bpk`, `gaji_bpk`) VALUES
(1, 'BPK1', 50000),
(3, 'BPK2', 100000);

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
-- Table structure for table `status_delta`
--

CREATE TABLE `status_delta` (
  `id_level_delta` int(11) NOT NULL,
  `nama_delta` varchar(100) NOT NULL,
  `gaji_delta` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_delta`
--

INSERT INTO `status_delta` (`id_level_delta`, `nama_delta`, `gaji_delta`) VALUES
(1, 'Delta Absolut', 150000),
(2, 'Delta Tidak Tetap', 100000),
(3, 'Delta Tetap', 300000);

-- --------------------------------------------------------

--
-- Table structure for table `status_gaji_bulanan`
--

CREATE TABLE `status_gaji_bulanan` (
  `no_sgb` int(11) NOT NULL,
  `id_user_detail` varchar(255) NOT NULL,
  `gaji_bulan` date NOT NULL,
  `total_gaji` int(11) NOT NULL,
  `tgl_simpan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_gaji_bulanan`
--

INSERT INTO `status_gaji_bulanan` (`no_sgb`, `id_user_detail`, `gaji_bulan`, `total_gaji`, `tgl_simpan`) VALUES
(1, '1231231PKY', '2023-10-01', 2000000, '2023-10-30'),
(2, '1231232PKY', '2023-10-01', 6000000, '2023-10-30'),
(3, '1231233PKY', '2023-10-01', 3000000, '2023-10-30'),
(4, '1231234PKY', '2023-10-01', 6000000, '2023-10-30'),
(5, '1231239PKY', '2023-10-01', 7000000, '2023-10-30'),
(40, '1231231PKY', '2023-11-01', 5046896, '0000-00-00'),
(41, '1231232PKY', '2023-11-01', 5900000, '0000-00-00'),
(42, '1231233PKY', '2023-11-01', 6000000, '0000-00-00'),
(43, '1231234PKY', '2023-11-01', 9200000, '0000-00-00'),
(45, '1231235PKY', '2023-11-01', 4670000, '2023-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `status_penempatan`
--

CREATE TABLE `status_penempatan` (
  `id_penempatan` int(11) NOT NULL,
  `nama_penempatan` varchar(50) NOT NULL,
  `um` varchar(7) NOT NULL,
  `gaji_penempatan` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_penempatan`
--

INSERT INTO `status_penempatan` (`id_penempatan`, `nama_penempatan`, `um`, `gaji_penempatan`) VALUES
(1, 'Barito Timur', '2', 1400000),
(2, 'Barito Selatan', '1', 2000000),
(3, 'Barito Utara', '3', 1200000),
(6, 'Pasar Panas', '1', 1500000),
(7, 'Tanjung', '2', 6000000),
(8, 'Kalua', '1', 1200000);

-- --------------------------------------------------------

--
-- Table structure for table `status_proyek`
--

CREATE TABLE `status_proyek` (
  `id_status_proyek` int(11) NOT NULL,
  `nama_proyek` varchar(100) NOT NULL,
  `gaji_proyek` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_proyek`
--

INSERT INTO `status_proyek` (`id_status_proyek`, `nama_proyek`, `gaji_proyek`) VALUES
(1, 'Proyek TL', 1500000),
(2, 'Proyek Cabut Tiang', 1400000),
(3, 'Proyek Pemasangan Tiang', 1500000),
(11, 'Proyek Pembuatan Gardu', 3000000);

-- --------------------------------------------------------

--
-- Table structure for table `status_tmk`
--

CREATE TABLE `status_tmk` (
  `id_status_tmk` int(11) NOT NULL,
  `tahun_tmk` int(2) NOT NULL,
  `rupiah_tmk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_tmk`
--

INSERT INTO `status_tmk` (`id_status_tmk`, `tahun_tmk`, `rupiah_tmk`) VALUES
(1, 0, 0),
(2, 1, 22665),
(3, 2, 23850),
(4, 3, 25097),
(5, 4, 26410),
(6, 5, 27791),
(7, 6, 29245),
(8, 7, 30774);

-- --------------------------------------------------------

--
-- Table structure for table `status_transport`
--

CREATE TABLE `status_transport` (
  `id_transport` int(11) NOT NULL,
  `nama_transport` varchar(50) NOT NULL,
  `tunjangan_transport` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_transport`
--

INSERT INTO `status_transport` (`id_transport`, `nama_transport`, `tunjangan_transport`) VALUES
(1, 'Mobil', 200000),
(3, 'Sepeda Motor', 50000),
(4, 'Trak', 250000);

-- --------------------------------------------------------

--
-- Table structure for table `status_um`
--

CREATE TABLE `status_um` (
  `id_status_um` int(11) NOT NULL,
  `tipe_um` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_um`
--

INSERT INTO `status_um` (`id_status_um`, `tipe_um`) VALUES
(1, 'UMP'),
(2, 'UMK'),
(3, 'UMP/UMK');

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
('23bdd1cd96888f836956a97a0fdc6bd5', '1231231PKY', '202cb962ac59075b964b07152d234b70', 1, '23bdd1cd96888f836956a97a0fdc6bd5'),
('9593c4a570870ad08d5ed2b21f19df2c', '1231235PKY', '123', 1, '9593c4a570870ad08d5ed2b21f19df2c'),
('c551fc8847d29dc25a23db5d2cdb941b', '1231233PKY', '202cb962ac59075b964b07152d234b70', 1, 'c551fc8847d29dc25a23db5d2cdb941b'),
('d41d8cd98f00b204e9800998ecf8427e', '1231232PKY', '202cb962ac59075b964b07152d234b70', 1, 'd41d8cd98f00b204e9800998ecf8427e'),
('eb71208764d1a8a02cdf86a49ccd1489', '1234567MNJ', '202cb962ac59075b964b07152d234b70', 4, 'eb71208764d1a8a02cdf86a49ccd1489'),
('f5972fbf4ef53843c1e12c3ae99e5005', '1234567SPV', '202cb962ac59075b964b07152d234b70', 3, 'f5972fbf4ef53843c1e12c3ae99e5005'),
('f7c7b7e19a4ed7a51db593c8efbee984', '1231234PKY', '202cb962ac59075b964b07152d234b70', 1, 'f7c7b7e19a4ed7a51db593c8efbee984');

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
  `proyek` int(12) DEFAULT NULL,
  `jabatan` int(12) DEFAULT NULL,
  `penempatan` int(11) DEFAULT NULL,
  `bpk` int(11) DEFAULT NULL,
  `delta` int(11) DEFAULT NULL,
  `transport` int(11) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `jumlah_cuti` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`id_user_detail`, `nama_lengkap`, `id_jenis_kelamin`, `no_telp`, `alamat`, `nip`, `proyek`, `jabatan`, `penempatan`, `bpk`, `delta`, `transport`, `tanggal_masuk`, `jumlah_cuti`) VALUES
('134e349e4f50a051d8ca3687d6a7de1a', 'Admin', 1, '08080808', 'Jl. Pangeran H No.22', '1234567ADM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
('23bdd1cd96888f836956a97a0fdc6bd5', 'Yendi', 1, '081256769', 'Jl. Pengayaan', '1231231PKY', 0, 0, 1, 1, 0, 0, '2023-11-10', 6),
('9593c4a570870ad08d5ed2b21f19df2c', 'Rahmat', 1, '08123123213', 'Jl. Karamunting', '1231235PKY', 1, 14, 6, 1, 1, 3, '2023-11-10', 0),
('c551fc8847d29dc25a23db5d2cdb941b', 'Putri', 2, '+62812781728', 'Jl. Sekip', '1231233PKY', 1, 5, 1, 1, 1, 0, '2023-11-09', 0),
('d41d8cd98f00b204e9800998ecf8427e', 'Ahmad', 1, '08121212112', '0987654', '1231232PKY', 0, 0, 2, 1, 0, 0, '2023-11-10', 2),
('eb71208764d1a8a02cdf86a49ccd1489', 'Manajer Yendi', 1, '081212121212', 'Jl. Hidayatullah No.22', '1234567MNJ', 0, 0, 0, 0, 0, 0, NULL, 0),
('f5972fbf4ef53843c1e12c3ae99e5005', 'Supervisior', 1, NULL, NULL, '1234567SPV', 0, 0, 0, 0, 0, 0, NULL, 0),
('f7c7b7e19a4ed7a51db593c8efbee984', 'Operator Aminudin', 1, '+628127817281', 'Jl. Sekip', '1231234PKY', 3, 5, 2, 1, 2, 1, '2023-10-17', 0);

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
-- Indexes for table `absensi_level`
--
ALTER TABLE `absensi_level`
  ADD PRIMARY KEY (`id_absen_level`);

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
-- Indexes for table `status_absensi`
--
ALTER TABLE `status_absensi`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `status_bpk`
--
ALTER TABLE `status_bpk`
  ADD PRIMARY KEY (`id_level_bpk`);

--
-- Indexes for table `status_cuti`
--
ALTER TABLE `status_cuti`
  ADD PRIMARY KEY (`id_status_cuti`);

--
-- Indexes for table `status_delta`
--
ALTER TABLE `status_delta`
  ADD PRIMARY KEY (`id_level_delta`);

--
-- Indexes for table `status_gaji_bulanan`
--
ALTER TABLE `status_gaji_bulanan`
  ADD PRIMARY KEY (`no_sgb`);

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
-- Indexes for table `status_tmk`
--
ALTER TABLE `status_tmk`
  ADD PRIMARY KEY (`id_status_tmk`);

--
-- Indexes for table `status_transport`
--
ALTER TABLE `status_transport`
  ADD PRIMARY KEY (`id_transport`);

--
-- Indexes for table `status_um`
--
ALTER TABLE `status_um`
  ADD PRIMARY KEY (`id_status_um`);

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
-- AUTO_INCREMENT for table `absensi_level`
--
ALTER TABLE `absensi_level`
  MODIFY `id_absen_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  MODIFY `id_jenis_kelamin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `operator_level`
--
ALTER TABLE `operator_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `status_absensi`
--
ALTER TABLE `status_absensi`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `status_bpk`
--
ALTER TABLE `status_bpk`
  MODIFY `id_level_bpk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_cuti`
--
ALTER TABLE `status_cuti`
  MODIFY `id_status_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_delta`
--
ALTER TABLE `status_delta`
  MODIFY `id_level_delta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_gaji_bulanan`
--
ALTER TABLE `status_gaji_bulanan`
  MODIFY `no_sgb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `status_penempatan`
--
ALTER TABLE `status_penempatan`
  MODIFY `id_penempatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `status_proyek`
--
ALTER TABLE `status_proyek`
  MODIFY `id_status_proyek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `status_transport`
--
ALTER TABLE `status_transport`
  MODIFY `id_transport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
