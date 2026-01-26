-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 26, 2026 at 09:48 AM
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
  `price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produce`
--

INSERT INTO `produce` (`produceCode`, `itemName`, `variety`, `origin`, `quantity`, `measure`, `price`) VALUES
(1, 'Mango', 'Kent', 'Mexico', 9, 'box', 10),
(2, 'Coconuts', 'Green', 'Costa Rica', 10, 'box', 22),
(3, 'Tomatoes', 'Roma', 'USA', 25, 'lbs', 33);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produce`
--
ALTER TABLE `produce`
  ADD PRIMARY KEY (`produceCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produce`
--
ALTER TABLE `produce`
  MODIFY `produceCode` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
