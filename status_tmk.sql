-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 12, 2023 at 12:57 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `status_tmk`
--
ALTER TABLE `status_tmk`
  ADD PRIMARY KEY (`id_status_tmk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
