-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 30, 2023 at 04:03 PM
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
  `id_cuti_detail` int(11) NOT NULL,
  `id_cuti` varchar(50) NOT NULL,
  `id_user` varchar(256) NOT NULL,
  `alasan` text NOT NULL,
  `tgl_diajukan` date NOT NULL,
  `mulai` date NOT NULL,
  `berakhir` date NOT NULL,
  `id_status_cuti1` int(12) NOT NULL,
  `id_status_cuti2` int(12) NOT NULL,
  `id_status_cuti3` int(12) NOT NULL,
  `perihal_cuti` varchar(100) NOT NULL,
  `tipe_cuti` int(11) NOT NULL,
  `jumlah_hari` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id_cuti_detail`, `id_cuti`, `id_user`, `alasan`, `tgl_diajukan`, `mulai`, `berakhir`, `id_status_cuti1`, `id_status_cuti2`, `id_status_cuti3`, `perihal_cuti`, `tipe_cuti`, `jumlah_hari`) VALUES
(13, 'PLN.6892.SP.CK.2023', '1231232PKY\n', 'Melakukan Kunjungan keluarga keluar kota\r\n', '2023-11-28', '2023-11-29', '2023-11-30', 2, 2, 1, 'Kunjungan Keluarga', 5, 2),
(18, 'PLN.3518.SP.CK.2023', '1231231BJM', '-\r\n', '2023-11-30', '2023-12-04', '2023-12-08', 2, 2, 1, 'Pengambilan Cuti TAhunan', 4, 6);

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
(1, 'Koordinator', 2000000),
(5, 'Operasional', 1500000),
(13, 'Lapangan', 1200000),
(14, 'SDM', 1500000),
(15, 'Billman', 1200000);

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
(46, '1231231PKY', '2023-11-14', '2'),
(67, '1231232PKY', '2023-11-20', '1'),
(95, '1231231BJM', '2023-11-30', '5'),
(96, '1231231BJM', '2023-11-15', '3');

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
(1, 'BPK1', 150000),
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
(3, 'Delta1', 200000);

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
(165, '1231232PKY', '2023-10-01', 500000, '2023-11-30'),
(166, '1231231BJM', '2023-10-01', 8354268, '2023-11-30'),
(167, '1231232BJM', '2023-10-01', 1520000, '2023-11-30'),
(168, '1231233PKY', '2023-10-01', 600000, '2023-11-30'),
(175, '1231231BJM', '2023-11-01', 13182956, '2023-11-30'),
(176, '1231232BJM', '2023-11-01', 3040000, '2023-11-30'),
(177, '1231232PKY', '2023-10-01', 500000, '2023-11-30'),
(178, '1231233PKY', '2023-11-01', 1200000, '2023-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `status_insentif`
--

CREATE TABLE `status_insentif` (
  `id_insentif` int(11) NOT NULL,
  `nama_insentif` varchar(255) NOT NULL,
  `tunjangan_insentif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_insentif`
--

INSERT INTO `status_insentif` (`id_insentif`, `nama_insentif`, `tunjangan_insentif`) VALUES
(5, 'Insentif A', 12000),
(6, 'Insentif B', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `status_insfeksi`
--

CREATE TABLE `status_insfeksi` (
  `id_user_detail` varchar(255) NOT NULL,
  `gaji_insfeksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_insfeksi`
--

INSERT INTO `status_insfeksi` (`id_user_detail`, `gaji_insfeksi`) VALUES
('1231231BJM', 60000),
('1231231PKY', 50000),
('1231232BJM', 20000),
('1231232PKY', 10),
('1231233BJM', 20),
('1231233PKY', 600000),
('1231234BJM', NULL),
('1231234PKY', NULL),
('1231235BJM', NULL),
('1231236PKY', 0),
('1231237PKY', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status_kategori`
--

CREATE TABLE `status_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_kategori`
--

INSERT INTO `status_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Teknik'),
(2, 'Non Teknik');

-- --------------------------------------------------------

--
-- Table structure for table `status_komunikasi`
--

CREATE TABLE `status_komunikasi` (
  `id_komunikasi` int(11) NOT NULL,
  `nama_komunikasi` varchar(255) NOT NULL,
  `tunjangan_komunikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_komunikasi`
--

INSERT INTO `status_komunikasi` (`id_komunikasi`, `nama_komunikasi`, `tunjangan_komunikasi`) VALUES
(2, 'Tunjangan Telepon', 10000),
(3, 'Tunjangan Data', 996688);

-- --------------------------------------------------------

--
-- Table structure for table `status_kontribusi`
--

CREATE TABLE `status_kontribusi` (
  `id_kontribusi` int(11) NOT NULL,
  `nama_kontribusi` varchar(255) NOT NULL,
  `tunjangan_kontribusi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_kontribusi`
--

INSERT INTO `status_kontribusi` (`id_kontribusi`, `nama_kontribusi`, `tunjangan_kontribusi`) VALUES
(3, 'Kontribusi Pengawasan', 190000);

-- --------------------------------------------------------

--
-- Table structure for table `status_manager_u`
--

CREATE TABLE `status_manager_u` (
  `nip_manager_u` varchar(15) NOT NULL,
  `nama_manager_u` varchar(255) NOT NULL,
  `jk` int(11) NOT NULL,
  `nomor_telp` varchar(16) NOT NULL,
  `alamat_manager_u` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_manager_u`
--

INSERT INTO `status_manager_u` (`nip_manager_u`, `nama_manager_u`, `jk`, `nomor_telp`, `alamat_manager_u`) VALUES
('1231231BJM', 'Akbar Kurnia Octavianto', 1, '08123123123', 'Jl. Ramayana');

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
(1, 'Kalimantan Selatan', '1', 3149978),
(2, 'Banjarmasin', '2', 3236246),
(3, 'Tanah Bumbu', '2', 3151029),
(4, 'Tabalong', '2', 3238556),
(5, 'Kalimantan Tengah', '1', 3181013),
(6, 'Palangkaraya', '2', 3226753),
(7, 'Kotawaringin Barat ', '2', 3352983),
(8, 'Kotawaringin Timur', '2', 3265860),
(9, 'Kapuas', '2', 3194237),
(10, 'Barito Selatan', '2', 3528912),
(11, 'Barito Utara', '2', 3595014),
(12, 'Barito Timur', '2', 3236139),
(13, 'Sukamara', '2', 3389398),
(14, 'Lamandau', '2', 3443107),
(15, 'Seruyan', '1', 3594096),
(16, 'Katingan', '2', 3230701),
(17, 'Pulang Pisau', '2', 3223403),
(18, 'Gunung Mas', '2', 3227352),
(19, 'Murung Raya', '2', 3448798);

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
(1, 'Proyek Nusa Daya', 1500000),
(2, 'Proyek Cabut Tiang', 1400000),
(3, 'Proyek Gardu', 1600000),
(11, 'Proyek Pembuatan Gardu', 3000000),
(13, 'Mobil Listrik', 1200000);

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
(8, 7, 30774),
(9, 8, 35774),
(10, 9, 40000),
(11, 10, 45000),
(12, 11, 50000);

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
(4, 'Fuso', 500000),
(5, 'Motor Listrik', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `status_uang_hadir`
--

CREATE TABLE `status_uang_hadir` (
  `id_uang_hadir` int(11) NOT NULL,
  `nama_uang_hadir` varchar(255) NOT NULL,
  `tunjangan_uang_hadir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_uang_hadir`
--

INSERT INTO `status_uang_hadir` (`id_uang_hadir`, `nama_uang_hadir`, `tunjangan_uang_hadir`) VALUES
(2, 'Absen Full', 20000);

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
(2, 'UMK');

-- --------------------------------------------------------

--
-- Table structure for table `status_wajib`
--

CREATE TABLE `status_wajib` (
  `id_wajib` int(11) NOT NULL,
  `jenis_wajib` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_wajib`
--

INSERT INTO `status_wajib` (`id_wajib`, `jenis_wajib`) VALUES
(1, 'Wajib'),
(2, 'Tidak');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_cuti`
--

CREATE TABLE `tipe_cuti` (
  `id_tipe_cuti` int(11) NOT NULL,
  `jenis_cuti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tipe_cuti`
--

INSERT INTO `tipe_cuti` (`id_tipe_cuti`, `jenis_cuti`) VALUES
(1, 'Sakit'),
(2, 'Izin'),
(3, 'Tahunan\n'),
(4, 'Melahirkan\r\n'),
(5, 'Alasan Penting'),
(6, 'Besar'),
(7, 'Bersama');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_user_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `id_user_level`) VALUES
('1231231BJM', '202cb962ac59075b964b07152d234b70', 1),
('1231231PKY', '202cb962ac59075b964b07152d234b70', 1),
('1231232BJM', '202cb962ac59075b964b07152d234b70', 1),
('1231232PKY', '202cb962ac59075b964b07152d234b70', 1),
('1231233BJM', '202cb962ac59075b964b07152d234b70', 1),
('1231233PKY', '202cb962ac59075b964b07152d234b70', 1),
('1231234BJM', '202cb962ac59075b964b07152d234b70', 1),
('1231234PKY', '202cb962ac59075b964b07152d234b70', 1),
('1231235BJM', '202cb962ac59075b964b07152d234b70', 1),
('1231236PKY', '202cb962ac59075b964b07152d234b70', 1),
('1231237PKY', '202cb962ac59075b964b07152d234b70', 1),
('1234567ADM', '202cb962ac59075b964b07152d234b70', 2),
('1234567MNJ', '202cb962ac59075b964b07152d234b70', 4),
('1234567PLT', '202cb962ac59075b964b07152d234b70', 5),
('1234567SPV', '202cb962ac59075b964b07152d234b70', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `nama_lengkap` varchar(30) DEFAULT NULL,
  `nik` varchar(20) NOT NULL,
  `id_jenis_kelamin` int(12) DEFAULT NULL,
  `no_telp` varchar(30) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nip` varchar(10) NOT NULL,
  `proyek` int(12) DEFAULT NULL,
  `jabatan` int(12) DEFAULT NULL,
  `penempatan` int(11) DEFAULT NULL,
  `bpk` int(11) DEFAULT NULL,
  `delta` int(11) DEFAULT NULL,
  `transport` int(11) DEFAULT NULL,
  `komunikasi` int(11) DEFAULT NULL,
  `uang_hadir` int(11) DEFAULT NULL,
  `kontribusi` int(11) DEFAULT NULL,
  `insentif` int(11) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `jumlah_cuti` int(2) DEFAULT NULL,
  `no_spk` varchar(50) NOT NULL,
  `spk` varchar(50) NOT NULL,
  `no_serti` varchar(50) NOT NULL,
  `tgl_berlaku` date NOT NULL,
  `tgl_berakhir` date NOT NULL,
  `kategori` int(11) NOT NULL,
  `kode_wajib` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`nama_lengkap`, `nik`, `id_jenis_kelamin`, `no_telp`, `alamat`, `nip`, `proyek`, `jabatan`, `penempatan`, `bpk`, `delta`, `transport`, `komunikasi`, `uang_hadir`, `kontribusi`, `insentif`, `tanggal_masuk`, `jumlah_cuti`, `no_spk`, `spk`, `no_serti`, `tgl_berlaku`, `tgl_berakhir`, `kategori`, `kode_wajib`) VALUES
('Udin', '62130302010002', 1, '0812', 'Jl. Karamunting', '1231231BJM', 1, 1, 13, 1, 2, 3, 3, 2, 3, 5, '2012-11-27', 6, '0029.PJ/DAN.01.03/C49000000/2023', '0026.PJ/KIT.02.03/DIR-TRK/2019', '1771.0.28.P042.09.2020', '2023-11-01', '2023-11-30', 1, 1),
('Yendi', '', 1, '0812345678', 'Jl. Listrik 2', '1231231PKY', 2, 15, NULL, 3, 1, 3, 2, 2, 3, 5, '2023-11-23', 6, '', '', '', '2023-11-01', '2023-12-02', 1, 1),
('RENDI', '62130', 1, '08123', 'Jl. Hasan Basri', '1231232BJM', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-11-22', 0, '', '', '', '0000-00-00', '0000-00-00', 0, 0),
('Rahmat', '', 1, '0812345678', 'Jl. Pengayaan', '1231232PKY', 1, 1, NULL, 1, 1, 1, 2, 2, 2, 3, '2023-11-20', 0, '', '', '', '0000-00-00', '0000-00-00', 0, 0),
('Rendi', '', 1, '90987654', 'Jl. Hasan Basri', '1231233BJM', 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, '2023-11-22', 0, '', '', '', '0000-00-00', '0000-00-00', 0, 0),
('Fitri', '', 2, '0876543', 'Jl. Negara', '1231233PKY', 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, '2023-11-20', 0, '', '', '', '0000-00-00', '0000-00-00', 0, 0),
('Jamal', '', 1, '09876543', 'Jl. Hasan Basri', '1231234BJM', 1, 15, NULL, 1, 1, 3, 3, 2, 3, 4, '2023-06-01', 0, '', '', '', '0000-00-00', '0000-00-00', 0, 0),
('Budi', '', 1, '09876543', 'Jl. Karamunting', '1231234PKY', 2, 13, NULL, 3, 1, 1, 2, 2, 2, 3, '2023-11-20', 0, '', '', '', '0000-00-00', '0000-00-00', 0, 0),
('Amat', '', 1, '098765', 'Jl. Hasan Basri', '1231235BJM', 1, 1, NULL, 1, 1, 5, 0, 0, 0, 0, '2023-10-02', 0, '', '', '', '0000-00-00', '0000-00-00', 0, 0),
('Asep', '', 1, '0812345678', 'Jl. Karamunting', '1231236PKY', 0, 1, NULL, 3, 2, 1, 2, 2, 0, 3, '2023-11-20', 0, '', '', '', '0000-00-00', '0000-00-00', 0, 0),
('Tet', '', 2, '0987654', 'Jl. LN 2', '1231237PKY', 0, 1, NULL, 1, 3, 3, 2, 2, 2, 3, '2023-11-20', 0, '', '', '', '0000-00-00', '0000-00-00', 1, 0),
('Admin', '', 1, NULL, NULL, '1234567ADM', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, '', '', '', '0000-00-00', '0000-00-00', 0, 0),
('Maulana Rizman Muttaqin', '', 1, NULL, NULL, '1234567MNJ', 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, 0, '', '', '', '0000-00-00', '0000-00-00', 0, 0),
('Admin PLNT', '', 2, NULL, NULL, '1234567PLT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '0000-00-00', '0000-00-00', 0, 0),
('Nama Supervisior', '', 1, NULL, NULL, '1234567SPV', 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, 0, '', '', '', '0000-00-00', '0000-00-00', 0, 0);

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
(2, 'Admin PCN'),
(3, 'Supervisior'),
(4, 'Manager'),
(5, 'Admin PLN-T\n ');

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
  ADD PRIMARY KEY (`id_cuti_detail`);

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
-- Indexes for table `status_insentif`
--
ALTER TABLE `status_insentif`
  ADD PRIMARY KEY (`id_insentif`);

--
-- Indexes for table `status_insfeksi`
--
ALTER TABLE `status_insfeksi`
  ADD UNIQUE KEY `id_user_detail` (`id_user_detail`);

--
-- Indexes for table `status_kategori`
--
ALTER TABLE `status_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `status_komunikasi`
--
ALTER TABLE `status_komunikasi`
  ADD PRIMARY KEY (`id_komunikasi`);

--
-- Indexes for table `status_kontribusi`
--
ALTER TABLE `status_kontribusi`
  ADD PRIMARY KEY (`id_kontribusi`);

--
-- Indexes for table `status_manager_u`
--
ALTER TABLE `status_manager_u`
  ADD PRIMARY KEY (`nip_manager_u`);

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
-- Indexes for table `status_uang_hadir`
--
ALTER TABLE `status_uang_hadir`
  ADD PRIMARY KEY (`id_uang_hadir`);

--
-- Indexes for table `status_um`
--
ALTER TABLE `status_um`
  ADD PRIMARY KEY (`id_status_um`);

--
-- Indexes for table `status_wajib`
--
ALTER TABLE `status_wajib`
  ADD PRIMARY KEY (`id_wajib`);

--
-- Indexes for table `tipe_cuti`
--
ALTER TABLE `tipe_cuti`
  ADD PRIMARY KEY (`id_tipe_cuti`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`nip`);

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
  MODIFY `id_absen_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id_cuti_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  MODIFY `id_jenis_kelamin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `operator_level`
--
ALTER TABLE `operator_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `status_absensi`
--
ALTER TABLE `status_absensi`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `status_bpk`
--
ALTER TABLE `status_bpk`
  MODIFY `id_level_bpk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `status_cuti`
--
ALTER TABLE `status_cuti`
  MODIFY `id_status_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_delta`
--
ALTER TABLE `status_delta`
  MODIFY `id_level_delta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `status_gaji_bulanan`
--
ALTER TABLE `status_gaji_bulanan`
  MODIFY `no_sgb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `status_insentif`
--
ALTER TABLE `status_insentif`
  MODIFY `id_insentif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `status_kategori`
--
ALTER TABLE `status_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_komunikasi`
--
ALTER TABLE `status_komunikasi`
  MODIFY `id_komunikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status_kontribusi`
--
ALTER TABLE `status_kontribusi`
  MODIFY `id_kontribusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_penempatan`
--
ALTER TABLE `status_penempatan`
  MODIFY `id_penempatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `status_proyek`
--
ALTER TABLE `status_proyek`
  MODIFY `id_status_proyek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `status_transport`
--
ALTER TABLE `status_transport`
  MODIFY `id_transport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `status_uang_hadir`
--
ALTER TABLE `status_uang_hadir`
  MODIFY `id_uang_hadir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_wajib`
--
ALTER TABLE `status_wajib`
  MODIFY `id_wajib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipe_cuti`
--
ALTER TABLE `tipe_cuti`
  MODIFY `id_tipe_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
