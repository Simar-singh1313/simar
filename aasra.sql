-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2025 at 06:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aasra`
--

-- --------------------------------------------------------

--
-- Table structure for table `baghat`
--

CREATE TABLE `baghat` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `fname` varchar(1000) NOT NULL,
  `mobile_no` varchar(1000) NOT NULL,
  `date_of_joining` date NOT NULL,
  `photo` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baghat`
--

INSERT INTO `baghat` (`id`, `name`, `fname`, `mobile_no`, `date_of_joining`, `photo`) VALUES
(2, 'Mandeep Singh', 'Shanky Singh', '9812918250', '2025-01-01', NULL),
(3, 'Simarjeet', 'SINGH', '9812918250', '2025-01-01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baghat`
--
ALTER TABLE `baghat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baghat`
--
ALTER TABLE `baghat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
