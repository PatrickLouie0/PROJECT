-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2023 at 05:48 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `judge`
--

CREATE TABLE `judge` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `judge_name` varchar(255) NOT NULL,
  `judge_password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `judge`
--

INSERT INTO `judge` (`id`, `event_id`, `judge_name`, `judge_password`) VALUES
(1, 420373, 'king', 185581),
(2, 420373, 'ninong', 118564),
(3, 420373, 'ninang', 111718),
(4, 64978, 'sadc', 124938),
(5, 746755, 'john', 131519),
(6, 594506, 'john', 158759),
(7, 594506, 'kevin', 197145),
(9, 594664, 'john', 168006);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `judge`
--
ALTER TABLE `judge`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `judge`
--
ALTER TABLE `judge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
