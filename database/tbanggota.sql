-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2015 at 01:53 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpkn`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbanggota`
--

CREATE TABLE IF NOT EXISTS `tbanggota` (
  `id_anggota` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nama_sekolah` varchar(50) NOT NULL,
  `status` enum('Admin','User') NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbanggota`
--
ALTER TABLE `tbanggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbanggota`
--
ALTER TABLE `tbanggota`
  MODIFY `id_anggota` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
