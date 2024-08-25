-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2023 at 01:26 PM
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
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `contestant_id` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `event_id`, `judge_id`, `contestant_id`, `comment`) VALUES
(0, 907139, 19, 56, 'asdad'),
(0, 907139, 19, 56, 'asdad'),
(0, 907139, 19, 60, 'sdasdsa');

-- --------------------------------------------------------

--
-- Table structure for table `contestant`
--

CREATE TABLE `contestant` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `contestant_name` varchar(255) NOT NULL,
  `contestant_no` int(11) NOT NULL,
  `contestant_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contestant`
--

INSERT INTO `contestant` (`id`, `event_id`, `contestant_name`, `contestant_no`, `contestant_description`) VALUES
(56, 907139, 'kim', 1, 'asd'),
(57, 562545, 'ad', 1, 'asd'),
(58, 668785, 'SFADG', 1, 'DFSFD'),
(59, 252403, 'hotdog kadin', 1, 'hotdog ulit'),
(60, 907139, 'john', 2, 'john');

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `criteria_name` varchar(255) NOT NULL,
  `criteria_percent` varchar(255) NOT NULL,
  `criteria_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`id`, `event_id`, `criteria_name`, `criteria_percent`, `criteria_description`) VALUES
(5, 453213, 'asda', '100', 'asd'),
(6, 453213, 'asd', '50', 'asda'),
(7, 453213, 'asd', '100', 'sdf'),
(10, 907139, 'sad', '50', 'da'),
(11, 907139, 'asd', '50', 'ads'),
(12, 562545, 'sda', '100', 'asd'),
(13, 668785, 'ead', '50', 'sdv'),
(14, 668785, 'gdsdf', '30', 'ghdgh'),
(15, 668785, 'aSDGFGHLJLK', '20', 'cfgxgf'),
(16, 252403, 'hotdog', '100', 'hotdog');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` varchar(255) NOT NULL,
  `event_date_start` varchar(255) NOT NULL,
  `event_time_start` time NOT NULL,
  `event_date_end` varchar(255) NOT NULL,
  `event_time_end` time NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `event_id`, `event_name`, `event_description`, `event_date_start`, `event_time_start`, `event_date_end`, `event_time_end`, `date_time`) VALUES
(6, 453213, 'gg', 'tulog na bata', '1212-12-12', '21:12:00', '1212-12-12', '21:21:00', '2023-02-20 16:23:16'),
(7, 724236, 'asd', 'asd', '1212-12-12', '12:12:00', '1212-12-21', '12:21:00', '2023-02-17 18:45:53'),
(8, 907139, 'asd', 'asd', '2112-12-21', '12:12:00', '1122-02-12', '12:21:00', '2023-02-17 18:47:52'),
(9, 562545, 'das', '12', '1221-12-12', '12:12:00', '1111-12-12', '12:12:00', '2023-02-18 14:11:32'),
(10, 668785, 'asd', 'dz', '1111-11-11', '11:11:00', '2121-11-21', '12:12:00', '2023-02-19 04:19:37'),
(11, 252403, 'hotdog', 'hotdog', '2121-12-11', '21:11:00', '12121-12-12', '12:12:00', '2023-02-20 17:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `judge`
--

CREATE TABLE `judge` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `judge_name` varchar(255) NOT NULL,
  `judge_password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `judge`
--

INSERT INTO `judge` (`id`, `event_id`, `judge_name`, `judge_password`) VALUES
(5, 0, ':judge_name', 0),
(6, 0, ':judge_name', 0),
(7, 0, ':judge_name', 0),
(8, 0, ':judge_name', 0),
(16, 453213, 'sad', 121936),
(18, 907139, 'johnny johhny', 188231),
(19, 907139, 'kings', 122420),
(20, 562545, 'ads', 107968),
(21, 668785, 'asdsadsasd', 119797),
(23, 252403, 'hotdog', 159919);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `contestant_id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `submit` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`id`, `event_id`, `judge_id`, `contestant_id`, `criteria_id`, `score`, `comment`, `submit`) VALUES
(1, 907139, 19, 56, 10, 20, '', ''),
(2, 907139, 19, 56, 11, 20, '', ''),
(3, 907139, 19, 56, 10, 20, '', ''),
(4, 907139, 19, 56, 11, 20, '', ''),
(5, 907139, 19, 60, 10, 20, '', ''),
(6, 907139, 19, 60, 11, 20, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `username`
--

CREATE TABLE `username` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `username`
--

INSERT INTO `username` (`id`, `name`, `username`, `password`) VALUES
(1, 'patrick louie portera', 'username', 'username'),
(2, 'admin', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contestant`
--
ALTER TABLE `contestant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `judge`
--
ALTER TABLE `judge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `username`
--
ALTER TABLE `username`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contestant`
--
ALTER TABLE `contestant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `judge`
--
ALTER TABLE `judge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `username`
--
ALTER TABLE `username`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
