-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2020 at 08:40 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aId` int(30) NOT NULL,
  `aName` varchar(200) NOT NULL,
  `aDate` datetime NOT NULL,
  `aEmail` varchar(200) NOT NULL,
  `aPassword` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aId`, `aName`, `aDate`, `aEmail`, `aPassword`) VALUES
(1, 'shinoy', '2020-10-14 00:00:00', 'pbshinoy@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cId` int(11) NOT NULL,
  `cName` varchar(200) NOT NULL,
  `cStatus` int(11) NOT NULL DEFAULT 1,
  `cDate` datetime NOT NULL,
  `cDp` varchar(200) NOT NULL,
  `adminId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cId`, `cName`, `cStatus`, `cDate`, `cDp`, `adminId`) VALUES
(5, 'phone', 1, '2020-10-14 08:33:49', 'phone.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `mId` int(11) NOT NULL,
  `mName` varchar(200) NOT NULL,
  `mDate` datetime NOT NULL,
  `mStatus` int(11) NOT NULL DEFAULT 1,
  `productId` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `mDp` varchar(200) NOT NULL,
  `mDescription` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`mId`, `mName`, `mDate`, `mStatus`, `productId`, `adminId`, `mDp`, `mDescription`) VALUES
(2, 'galaxy s8 ', '2020-10-14 08:36:41', 1, 4, 1, 'galaxy_s8.jpeg', 'galaxy younggalaxy younggalaxy younggalaxy younggalaxy younggalaxy younggalaxy younggalaxy younggalaxy younggalaxy younggalaxy younggalaxy young');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pId` int(11) NOT NULL,
  `pName` varchar(200) NOT NULL,
  `pStatus` int(11) NOT NULL DEFAULT 1,
  `pDate` datetime NOT NULL,
  `categoryId` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `pDp` varchar(200) NOT NULL,
  `pCompany` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pId`, `pName`, `pStatus`, `pDate`, `categoryId`, `adminId`, `pDp`, `pCompany`) VALUES
(4, 'galaxy ', 1, '2020-10-14 08:35:37', 5, 1, 'samsung_galacy.jpg', 'samsung');

-- --------------------------------------------------------

--
-- Table structure for table `specs`
--

CREATE TABLE `specs` (
  `spId` int(11) NOT NULL,
  `spName` varchar(200) NOT NULL,
  `spDate` datetime NOT NULL,
  `spStatus` int(11) NOT NULL DEFAULT 1,
  `adminId` int(11) NOT NULL,
  `modelId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specs`
--

INSERT INTO `specs` (`spId`, `spName`, `spDate`, `spStatus`, `adminId`, `modelId`) VALUES
(3, 'color', '2020-10-14 08:37:09', 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `spec_values`
--

CREATE TABLE `spec_values` (
  `spvId` int(11) NOT NULL,
  `spvName` varchar(200) NOT NULL,
  `specId` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `spvStatus` int(11) NOT NULL DEFAULT 1,
  `spvDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spec_values`
--

INSERT INTO `spec_values` (`spvId`, `spvName`, `specId`, `adminId`, `spvStatus`, `spvDate`) VALUES
(3, 'black', 3, 1, 1, '2020-10-14 08:37:09'),
(4, 'red', 3, 1, 1, '2020-10-14 08:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uId` int(11) NOT NULL,
  `uFirstName` varchar(200) NOT NULL,
  `uLastName` varchar(200) NOT NULL,
  `uEmail` varchar(200) NOT NULL,
  `uPassword` varchar(200) NOT NULL,
  `uLink` varchar(200) NOT NULL,
  `uDate` datetime NOT NULL,
  `uStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cId`),
  ADD KEY `adminId` (`adminId`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`mId`),
  ADD KEY `adminId` (`adminId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pId`),
  ADD KEY `adminId` (`adminId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `specs`
--
ALTER TABLE `specs`
  ADD PRIMARY KEY (`spId`),
  ADD KEY `adminId` (`adminId`),
  ADD KEY `modelId` (`modelId`);

--
-- Indexes for table `spec_values`
--
ALTER TABLE `spec_values`
  ADD PRIMARY KEY (`spvId`),
  ADD KEY `specId` (`specId`),
  ADD KEY `adminId` (`adminId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `mId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `specs`
--
ALTER TABLE `specs`
  MODIFY `spId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `spec_values`
--
ALTER TABLE `spec_values`
  MODIFY `spvId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`aId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`aId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `models_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`pId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`aId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`cId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specs`
--
ALTER TABLE `specs`
  ADD CONSTRAINT `specs_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`aId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `specs_ibfk_2` FOREIGN KEY (`modelId`) REFERENCES `models` (`mId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spec_values`
--
ALTER TABLE `spec_values`
  ADD CONSTRAINT `spec_values_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`aId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spec_values_ibfk_2` FOREIGN KEY (`specId`) REFERENCES `specs` (`spId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
