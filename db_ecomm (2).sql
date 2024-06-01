-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 05:40 AM
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
-- Table structure for table `mst_member`
--

CREATE TABLE `mst_member` (
  `memberid` int(11) NOT NULL,
  `membercode` varchar(10) NOT NULL,
  `name_mb` varchar(20) NOT NULL,
  `email_mb` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `datebirth_mb` date NOT NULL,
  `address_mb` text NOT NULL,
  `telp_mb` varchar(20) NOT NULL,
  `date_reg` datetime NOT NULL,
  `isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mst_member`
--

INSERT INTO `mst_member` (`memberid`, `membercode`, `name_mb`, `email_mb`, `password`, `datebirth_mb`, `address_mb`, `telp_mb`, `date_reg`, `isactive`) VALUES
(1, 'MB0424002', 'Ani ', 'ani2@gmail.com', '$2y$10$1TNiRHPVurcfGZihNWHruuYwKC7rhiiKSVGkL8A3GFhZ/L5ov1kX2', '2014-04-01', '', '', '2024-04-18 16:36:41', 1),
(2, 'MB0424001', 'Ani ', 'ani@gmail.com', '$2y$10$1TNiRHPVurcfGZihNWHruuYwKC7rhiiKSVGkL8A3GFhZ/L5ov1kX2', '2000-01-02', '', '', '2024-04-18 16:36:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_menus`
--

CREATE TABLE `mst_menus` (
  `menuid` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `menu_link` varchar(30) NOT NULL,
  `isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mst_menus`
--

INSERT INTO `mst_menus` (`menuid`, `menu_name`, `menu_link`, `isactive`) VALUES
(1, 'Kategori Produk', '?modul=kategori', 1),
(2, 'Data Produk', '?modul=DataProduk', 1),
(3, 'Penjualan', '?modul=Penjualan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `isactive` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`userid`, `username`, `password`, `fullname`, `isactive`) VALUES
(1, 'admin', '$2y$10$CW1yo.y2HHNrwrklW2uza.OLLTNgywVF.GJsSU2lO/fhM/L0QjKSK', 'Ani Nur', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `iddetail` int(11) NOT NULL,
  `no_invoice` varchar(11) DEFAULT NULL,
  `idproduct` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL,
  `idcategory_fk` int(11) NOT NULL,
  `name_product` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `description` text NOT NULL,
  `produk_file` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `update_by` varchar(20) NOT NULL,
  `update_date` datetime NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idproduct`, `idcategory_fk`, `name_product`, `price`, `stok`, `description`, `produk_file`, `created_date`, `created_by`, `update_by`, `update_date`, `is_active`) VALUES
(16, 6, 'adidas', 360000, 3, 'tersedia ukuran 43-45', 'WIN_20221102_19_07_50_Pro.jpg', '2024-06-01 05:25:25', 'Ani Nur', '', '2024-06-01 05:25:25', 1),
(17, 6, 'reebok', 400000, 4, 'tersedia ukuran 44-56', 'WIN_20221102_19_08_40_Pro.jpg', '2024-06-01 05:28:17', 'Ani Nur', '', '2024-06-01 05:28:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `categoryid` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL,
  `isactive` tinyint(1) NOT NULL,
  `createdby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`categoryid`, `category_name`, `isactive`, `createdby`) VALUES
(1, 'Testing', 1, '0'),
(3, 'Testing', 1, '0'),
(6, 'Sepatu', 1, '0'),
(7, 'Sepatu', 1, '0'),
(8, 'Rok', 1, '0'),
(9, 'Kelambi', 1, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_member`
--
ALTER TABLE `mst_member`
  ADD PRIMARY KEY (`memberid`) USING BTREE;

--
-- Indexes for table `mst_menus`
--
ALTER TABLE `mst_menus`
  ADD PRIMARY KEY (`menuid`) USING BTREE;

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`userid`) USING BTREE;

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`iddetail`),
  ADD KEY `no_invoice` (`no_invoice`),
  ADD KEY `idproduct` (`idproduct`);

--
-- Indexes for table `penjualan_head`
--
ALTER TABLE `penjualan_head`
  ADD PRIMARY KEY (`no_invoice`),
  ADD KEY `memberid_fk` (`memberid_fk`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idproduct`) USING BTREE,
  ADD KEY `idcategory_fk` (`idcategory_fk`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`categoryid`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_member`
--
ALTER TABLE `mst_member`
  MODIFY `memberid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_menus`
--
ALTER TABLE `mst_menus`
  MODIFY `menuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `idproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`idproduct`) REFERENCES `product` (`idproduct`);

--
-- Constraints for table `penjualan_head`
--
ALTER TABLE `penjualan_head`
  ADD CONSTRAINT `fk_member` FOREIGN KEY (`memberid_fk`) REFERENCES `mst_member` (`memberid`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `idcategory_fk` FOREIGN KEY (`idcategory_fk`) REFERENCES `product_category` (`categoryid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
