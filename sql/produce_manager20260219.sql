-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 19, 2026 at 04:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `produce_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `produce`
--

CREATE TABLE `produce` (
  `produceCode` int(4) NOT NULL,
  `itemName` varchar(50) NOT NULL,
  `variety` varchar(50) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `measure` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `imageName` varchar(50) DEFAULT NULL,
  `typeID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produce`
--

INSERT INTO `produce` (`produceCode`, `itemName`, `variety`, `origin`, `quantity`, `measure`, `price`, `imageName`, `typeID`) VALUES
(17, 'Watermelon', 'Seedless', 'Mexico', 35, 'box', 100, 'watermelon_100.png', 8),
(19, 'Coconuts', 'Green', 'Costa Rica', 10, 'box', 22, 'coconuts_100.png', 4),
(20, 'Sugar Cane', 'gree', 'Mexico', 18, 'lbs', 23, 'sugarcane_100.png', 4),
(21, 'Oranges', 'Seedless', 'USA', 20, 'box of 20 (5lb) bags', 60, 'oranges_100.png', 5),
(23, 'Tomatoes', 'Roma', 'USA', 35, 'lbs', 60, 'tomatoes_100.png', 7);

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `userId` int(4) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `failed_attempts` int(4) DEFAULT NULL,
  `last_failed_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`userId`, `userName`, `password`, `emailAddress`, `failed_attempts`, `last_failed_login`) VALUES
(3, 'Nigel', '$2y$10$z9MaLr./fh7jJ936Uzbbg.XmCJMJFv64ImmNwLnT1VL/POpYFbQVK', 'nigel.kallan@triosstudent.com', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `typeID` int(4) NOT NULL,
  `produceType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`typeID`, `produceType`) VALUES
(4, 'tropical'),
(5, 'citrus'),
(6, 'stone'),
(7, 'berries'),
(8, 'melons'),
(9, 'exotic'),
(10, 'leaf'),
(11, 'root'),
(12, 'stem/stalk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produce`
--
ALTER TABLE `produce`
  ADD PRIMARY KEY (`produceCode`),
  ADD KEY `FK_typeID` (`typeID`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`typeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produce`
--
ALTER TABLE `produce`
  MODIFY `produceCode` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `userId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `typeID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produce`
--
ALTER TABLE `produce`
  ADD CONSTRAINT `FK_typeID` FOREIGN KEY (`typeID`) REFERENCES `types` (`typeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
