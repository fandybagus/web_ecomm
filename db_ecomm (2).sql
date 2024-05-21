-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 06:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_head`
--

CREATE TABLE `penjualan_head` (
  `no_invoice` varchar(11) NOT NULL,
  `date_trans` datetime NOT NULL,
  `memberid_fk` int(11) NOT NULL,
  `cust_telp` varchar(30) NOT NULL,
  `total_trans` int(11) NOT NULL,
  `payment_file` varchar(50) NOT NULL,
  `payment_status` enum('Lunas','Belum Lunas') NOT NULL,
  `payment_nominal` int(11) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `tracking` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penjualan_head`
--
ALTER TABLE `penjualan_head`
  ADD PRIMARY KEY (`no_invoice`),
  ADD KEY `memberid_fk` (`memberid_fk`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan_head`
--
ALTER TABLE `penjualan_head`
  ADD CONSTRAINT `fk_member` FOREIGN KEY (`memberid_fk`) REFERENCES `mst_member` (`memberid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
