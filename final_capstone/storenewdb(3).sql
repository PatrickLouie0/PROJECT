-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2022 at 10:36 AM
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
-- Database: `storenewdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `available_product`
--

CREATE TABLE `available_product` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `barcode_con` varchar(255) NOT NULL,
  `product_picture` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_brand` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_cost` int(11) NOT NULL,
  `product_added_price` int(11) NOT NULL,
  `product_new_price` int(11) NOT NULL,
  `check_stock_status` int(11) NOT NULL,
  `checkby` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `available_product`
--

INSERT INTO `available_product` (`id`, `barcode`, `barcode_con`, `product_picture`, `product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`, `product_cost`, `product_added_price`, `product_new_price`, `check_stock_status`, `checkby`, `date_time`) VALUES
(1, '9077404263.jpg', '9077404263', 'box.png', 'MRC-5038', 'RICE COOKER', 'WHITE', '5CUPS', '', 'APPLIANCES', 0, 640, 360, 1000, 0, '', '2022-09-20 00:20:56'),
(2, '3908476835.jpg', '3908476835', 'box.png', 'MRC-550', 'RICE COOKER', 'WHITE ', '8CUPS', '', 'APPLIANCES', 0, 730, 520, 1250, 0, '', '2022-09-20 09:24:13'),
(3, '8479941635.jpg', '8479941635', 'box.png', '107', 'STORAGE BOX', 'BLACK', '120 LITERS', '', 'PLASTICWARE', 1, 235, 185, 420, 0, '', '2022-09-17 10:52:56'),
(4, '1500992697.jpg', '1500992697', 'box.png', '#8711', 'BASKET', '89', '', 'OROCAN', 'PLASTICWARE', 15, 90, 90, 180, 0, '', '2022-09-22 00:37:13'),
(5, '3317456363.jpg', '3317456363', 'box.png', 'K3', 'MUGS', 'GREEN', '', '', 'GLASSWARE', 60, 18, 17, 35, 0, '', '2022-10-13 08:09:20'),
(6, '3928943445.jpg', '3928943445', 'box.png', '222', 'GALLON', 'BLUE', '20 LITERS', '', 'plasticware', 138, 115, 65, 180, 0, '', '2022-11-13 08:27:22'),
(7, '9920530626.jpg', '9920530626', 'box.png', 'UW-301-I', 'PITCHER', 'BLUE', '', 'OROCAN', 'PLASTICWARE', 48, 75, 75, 150, 0, '', '2022-07-11 16:51:30'),
(8, '7941782139.jpg', '7941782139', 'box.png', '#9012', 'JUG', 'BLUE', '12 LITER', 'OROCAN', 'PLASTICWARE', 0, 315, 135, 450, 0, '', '2022-09-17 11:29:00'),
(9, '4635219645.jpg', '4635219645', 'box.png', '#9008', 'JUG', 'RED', '8 LITER', 'OROCAN', 'PLASTICWARE', 19, 260, 120, 380, 0, '', '2022-09-18 13:06:01'),
(10, '5400884832.jpg', '5400884832', 'box.png', '887', 'JUG', 'GREEN', '8 LITER', 'MONICA', 'PLASTICWARE', 10, 220, 100, 320, 0, '', '2022-09-20 00:13:17'),
(11, '3109485727.jpg', '3109485727', 'box.png', '877', 'JUG', 'PINK', '8 LITER', 'OROCAN', 'PLASTICWARE', 19, 150, 130, 280, 0, '', '2022-10-06 17:11:34'),
(12, '7622262788.jpg', '7622262788', 'box.png', '9606', 'THERMOS', 'GREEN', '1', 'LOTUS', 'PLASTICWARE', 19, 220, 80, 300, 0, '', '2022-10-06 17:11:34'),
(13, '3148149528.jpg', '3148149528', 'box.png', '#9230', 'ICE BOX', 'RED', '30 LITER', 'OROCAN', 'PLASTICWARE', 20, 760, 260, 1020, 0, '', '2022-09-20 00:13:17'),
(14, '5791693368.jpg', '5791693368', 'box.png', '#888', 'KETTLE', '', '18CM', '555', '', 10, 210, 150, 360, 0, '', '2022-09-20 00:13:17'),
(15, '3004837774.jpg', '3004837774', 'box.png', 'S-100', 'STORAGE BOX', 'BLACK', '100 LITERS', 'SAKURA', 'PLASTICWARE', 25, 245, 105, 350, 0, '', '2022-09-20 00:13:17'),
(16, '4891673827.jpg', '4891673827', 'box.png', 'CX-1666', 'STAND FAN', 'BLACK', '', 'STANDARD', 'APPLIANCES', 94, 1000, 500, 1500, 0, '', '2022-10-13 08:26:19'),
(17, '5638736569.jpg', '5638736569', 'box.png', 'CX-1666B', 'DESK FAN', 'BLACK', '', 'STANDARD', 'APPLIANCES', 12, 900, 450, 1350, 0, '', '2022-02-11 16:47:34'),
(18, '5122566486.jpg', '5122566486', 'box.png', '8809-MDC', 'MINI DISH CABINET', 'GREEN', '', '', 'FURNITURE', 20, 680, 400, 1080, 0, '', '2022-09-20 03:58:45'),
(19, '6369181011.jpg', '6369181011', 'box.png', 'UW-8809', 'DISH CABINET', 'GREEN', '', '', 'FURNITURE', 20, 660, 520, 1180, 0, '', '2022-09-20 03:58:47'),
(20, '1235443283.jpg', '1235443283', 'box.png', '8868', 'FOOD COVER', 'GREEN', 'LARGE', '', 'PLASTICWARE', 50, 50, 100, 150, 0, '', '2022-09-20 00:13:17'),
(21, '5438656144.jpg', '5438656144', 'box.png', '#8080', 'THERMOS', 'BLUE', '2.2', 'GOLDEN DEAR', 'PLASTICWARE', 20, 165, 85, 250, 0, '', '2022-09-20 00:13:17'),
(22, '9520405638.jpg', '9520405638', 'box.png', 'N-9606', 'THERMOS', 'RED', '2.2L', 'LOTUS', 'PLASTICWARE', 12, 200, 50, 250, 0, '', '2022-09-20 00:13:17'),
(23, '6899718111.jpg', '6899718111', 'box.png', '221', 'GALLON', 'BLUE', '', 'COL', 'PLASTICWARE', 20, 90, 60, 150, 0, '', '2022-09-20 00:13:17'),
(24, '6864829432.jpg', '6864829432', 'box.png', 'UW-1162-W', 'BASKET', 'RED', '', '', 'PLASTICWARE', 30, 30, 20, 50, 0, '', '2022-09-20 00:13:17'),
(25, '3000572126.jpg', '3000572126', 'box.png', 'C=3', 'BOWL', 'WHITE', '', '', 'GLASSWARE', 50, 20, 15, 35, 0, '', '2022-09-20 00:13:17'),
(26, '2119625380.jpg', '2119625380', 'box.png', 'U33', 'MUGS', 'RED', '', '', 'GLASSWARE', 45, 20, 15, 35, 0, '', '2022-10-11 16:55:00'),
(27, '2055458928.jpg', '2055458928', 'box.png', 'U38', 'MUGS', 'PINK', '', '', 'GLASSWARE', 52, 20, 15, 35, 0, '', '2022-10-13 08:09:20'),
(28, '8396895492.jpg', '8396895492', 'box.png', 'K-9', 'MUGS', 'GREEN', '', '', 'GLASSWARE', 45, 20, 15, 35, 0, '', '2022-10-11 16:55:00'),
(29, '2899595686.jpg', '2899595686', 'box.png', 'NK-818', 'PITCHER', 'WHITE', '', '', 'PLASTICWARE', 40, 40, 30, 70, 0, '', '2022-09-20 00:13:17'),
(30, '3995135138.jpg', '3995135138', 'box.png', '996', 'BASIN', 'BLUE', 'SMALL', '', 'PLASTICWARE', 30, 30, 20, 50, 0, '', '2022-09-20 00:13:17'),
(31, '9230878597.jpg', '9230878597', 'box.png', '345', 'COL BASIN', 'RED', 'MEDIUM', '', 'PLASTICWARE', 30, 30, 20, 50, 0, '', '2022-09-20 00:13:17'),
(32, '7340770728.jpg', '7340770728', 'box.png', 'C/A 1408', 'GALLON', 'BLUE', '2.5', '', 'PLASTICWARE', 29, 50, 30, 80, 0, '', '2022-01-11 16:39:54'),
(33, '2322388890.jpg', '2322388890', 'box.png', 'Z20', 'NOTEBOOK', '', '', 'SPRING', 'SCHOOL SUPPLY', 45, 13, 8, 21, 0, '', '2022-10-11 16:55:00'),
(34, '4371378164.jpg', '4371378164', 'box.png', 'X-111', 'BALLPEN', 'BLACK', '', 'HBW', 'SCHOOL SUPPLY', 50, 5, 5, 10, 0, '', '2022-09-20 00:13:17'),
(35, '2718332359.jpg', '2718332359', 'box.png', '#101', 'LONGPAD', '', '', 'VICTORY', 'SCHOOL SUPPLY', 50, 25, 10, 35, 0, '', '2022-09-20 00:13:17'),
(36, '7365378263.jpg', '7365378263', 'box.png', 'ZBH-14', 'YELLOW PAD', '', '', 'VICTORY', 'SCHOOL SUPPLY', 50, 45, 40, 85, 0, '', '2022-09-20 00:13:17'),
(37, '3993815599.jpg', '3993815599', 'box.png', '#8000', 'NOTEBOOK', 'GREEN', 'BIG', '', 'SCHOOL SUPPLY', 50, 25, 10, 35, 0, '', '2022-09-20 00:13:17'),
(38, '2940763180.jpg', '2940763180', 'box.png', '#5160', 'SHORT', 'BUE', 'SMALL', '', 'UNIFORM', 60, 75, 100, 175, 0, '', '2022-10-13 08:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `barchart`
--

CREATE TABLE `barchart` (
  `id` int(11) NOT NULL,
  `year` varchar(20) NOT NULL,
  `sale` varchar(20) NOT NULL,
  `expenses` varchar(20) NOT NULL,
  `profit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barchart`
--

INSERT INTO `barchart` (`id`, `year`, `sale`, `expenses`, `profit`) VALUES
(1, '2014', '1000', '400', '200'),
(2, '2015', '1170', '460', '250'),
(3, '2016', '660', '100', '300'),
(4, '2017', '1030', '540', '350');

-- --------------------------------------------------------

--
-- Table structure for table `check_stock`
--

CREATE TABLE `check_stock` (
  `id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_brand` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `check_quantity` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `check_stock`
--

INSERT INTO `check_stock` (`id`, `product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`, `check_quantity`, `username`, `date_time`) VALUES
(14, '8868', 'FOOD COVER', 'YELLOW', '', '', 'PLASTICWARE', 20, 20, 'PORTERA, PATRICK LOUIE', '2022-09-13 19:47:56'),
(15, '88809-MDC-DC1', 'MINI DISH CABINET', 'RED', '', '', 'PLASTIC', 10, 10, 'PORTERA, PATRICK LOUIE', '2022-09-13 19:47:58'),
(16, 'C=3', 'MUGS ORD', 'WHITE', '', '', 'GLASSWARE', 50, 50, 'PORTERA, PATRICK LOUIE', '2022-09-13 19:48:01'),
(17, '8809-MDC', 'MINI DISH CABINET', 'GREEN', '', '', 'FURNITURE', 20, 20, 'ZAPATA, KATH', '2022-09-20 00:11:42'),
(18, 'UW-8809', 'DISH CABINET', 'GREEN', '', '', 'FURNITURE', 20, 20, 'ZAPATA, KATH', '2022-09-20 00:11:48'),
(19, '8809-MDC', 'MINI DISH CABINET', 'GREEN', '', '', 'FURNITURE', 20, 10, 'PATRICK LOUIE, MAGPALI', '2022-09-20 03:58:45'),
(20, 'UW-8809', 'DISH CABINET', 'GREEN', '', '', 'FURNITURE', 20, 10, 'PATRICK LOUIE, MAGPALI', '2022-09-20 03:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `reason`, `cost`, `date_time`) VALUES
(1, 'bigas', 1000, '2021-12-31 17:07:42'),
(2, 'bigas', 1000, '2022-02-12 11:29:34'),
(3, 'manok', 200, '2022-03-12 11:29:34'),
(4, 'isda', 120, '2022-04-12 11:30:33'),
(5, 'isda', 120, '2022-05-12 11:30:33'),
(6, 'meryenda', 150, '2022-06-12 11:33:09'),
(7, 'pagkain', 200, '2022-07-12 11:33:09'),
(8, 'tubig', 500, '2022-08-12 11:33:09'),
(9, 'kurynete', 1500, '2022-09-12 11:33:09'),
(10, 'internet', 1000, '2022-10-12 11:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `request_from_store1`
--

CREATE TABLE `request_from_store1` (
  `id` int(11) NOT NULL,
  `product_code` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_from_store1`
--

INSERT INTO `request_from_store1` (`id`, `product_code`, `product_name`, `product_color`, `product_size`, `product_quantity`, `product_price`, `status`, `date_time`) VALUES
(1, 1020, 'cheese dog', 'brown', '10', 10, 25, 0, '2022-07-04 12:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `request_of_other_store`
--

CREATE TABLE `request_of_other_store` (
  `id` int(11) NOT NULL,
  `product_code` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `request_product`
--

CREATE TABLE `request_product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_product`
--

INSERT INTO `request_product` (`id`, `product_name`, `details`, `date_time`) VALUES
(2, 'bag', 'black      		\r\n      	', '2022-06-19 07:56:35'),
(3, 'bag', 'black      		\r\n      	', '2022-06-19 07:56:57'),
(4, 'asd', '      		\r\n      	', '2022-08-21 13:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `return_product`
--

CREATE TABLE `return_product` (
  `id` int(11) NOT NULL,
  `product_code` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_brand` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_product`
--

INSERT INTO `return_product` (`id`, `product_code`, `product_name`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`, `product_price`, `total`, `date_time`) VALUES
(1, 0, 'DESK FAN', 'productcolor', '', 'productclass', 'APPLIANCES', 1, 1350, 1350, '2022-10-06 17:08:13'),
(2, 0, 'DESK FAN', 'productcolor', '', 'productclass', 'APPLIANCES', 1, 1350, 1350, '2022-02-11 16:42:48'),
(3, 222, 'GALLON', 'productcolor', '20 LITERS', 'productclass', 'plasticware', 1, 180, 180, '2022-03-11 16:43:09'),
(4, 222, 'GALLON', 'productcolor', '20 LITERS', 'productclass', 'plasticware', 1, 180, 180, '2022-04-11 16:43:26'),
(5, 222, 'GALLON', 'productcolor', '20 LITERS', 'productclass', 'plasticware', 1, 180, 180, '2022-05-11 16:43:38'),
(6, 0, 'MUGS', 'productcolor', '', 'productclass', 'GLASSWARE', 1, 35, 35, '2022-06-11 16:43:48'),
(7, 0, 'MUGS', 'productcolor', '', 'productclass', 'GLASSWARE', 1, 35, 35, '2022-06-11 16:43:54'),
(8, 0, 'LONGPAD', 'productcolor', '', 'productclass', 'SCHOOL SUPPLY', 1, 35, 35, '2022-08-11 16:44:25'),
(9, 222, 'GALLON', 'productcolor', '20 LITERS', 'productclass', 'plasticware', 1, 180, 180, '2022-09-11 16:44:39'),
(10, 222, 'GALLON', 'productcolor', '20 LITERS', 'productclass', 'plasticware', 1, 180, 180, '2022-10-11 16:44:44'),
(11, 0, 'DESK FAN', 'productcolor', '', 'productclass', 'APPLIANCES', 1, 1350, 1350, '2022-01-11 16:44:51'),
(12, 222, 'GALLON', 'productcolor', '20 LITERS', 'productclass', 'plasticware', 1, 180, 180, '2022-01-11 16:44:57'),
(13, 0, 'DESK FAN', 'productcolor', '', 'productclass', 'APPLIANCES', 1, 1350, 1350, '2022-07-12 11:46:00'),
(14, 222, 'GALLON', 'productcolor', '20 LITERS', 'productclass', 'plasticware', 1, 180, 180, '2022-07-12 11:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `store_details`
--

CREATE TABLE `store_details` (
  `id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `store_street` varchar(255) NOT NULL,
  `store_brgy` varchar(255) NOT NULL,
  `store_municipality` varchar(255) NOT NULL,
  `store_province` varchar(255) NOT NULL,
  `near_to` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_details`
--

INSERT INTO `store_details` (`id`, `store_name`, `store_street`, `store_brgy`, `store_municipality`, `store_province`, `near_to`) VALUES
(1, 'MYMY STORE', 'Innocillas street', 'Zone II', 'Dinalungan', 'Aurora', 'Dinalunga');

-- --------------------------------------------------------

--
-- Table structure for table `successfully_transfer_to_other_store`
--

CREATE TABLE `successfully_transfer_to_other_store` (
  `id` int(11) NOT NULL,
  `product_code` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `successfully_transfer_to_other_store`
--

INSERT INTO `successfully_transfer_to_other_store` (`id`, `product_code`, `product_name`, `product_color`, `product_size`, `product_quantity`, `date_time`) VALUES
(1, 1020, 'cheese dog', 'brown', '10', 10, '2022-07-06 09:54:39'),
(2, 1020, 'cheese dog', 'brown', '10', 10, '2022-07-06 09:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `success_transaction`
--

CREATE TABLE `success_transaction` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_brand` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `success_transaction`
--

INSERT INTO `success_transaction` (`id`, `transaction_id`, `product_name`, `product_code`, `product_color`, `product_size`, `product_brand`, `product_category`, `product_quantity`, `product_price`, `sub_total`, `discount`, `total`, `date_time`) VALUES
(1, 'Transaction-000000001', 'GALLON', 'C/A 1408', 'BLUE', '2.5', '', 'PLASTICWARE', 1, 80, 80, 0, 80, '2022-01-11 16:39:54'),
(2, 'Transaction-000000001', 'SHORT', '#5160', 'BUE', 'SMALL', '', 'UNIFORM', 1, 175, 175, 0, 175, '2022-01-11 16:39:54'),
(4, 'Transaction-000000002', 'SHORT', '#5160', 'BUE', 'SMALL', '', 'UNIFORM', 1, 175, 175, 0, 175, '2022-01-11 16:40:49'),
(5, 'Transaction-000000002', 'MUGS', 'K3', 'GREEN', '', '', 'GLASSWARE', 1, 35, 35, 0, 35, '2022-01-11 16:40:49'),
(7, 'Transaction-000000003', 'GALLON', '222', 'BLUE', '20 LITERS', '', 'plasticware', 1, 180, 180, 0, 180, '2022-01-27 16:41:09'),
(8, 'Transaction-000000004', 'GALLON', '222', 'BLUE', '20 LITERS', '', 'plasticware', 1, 180, 180, 0, 180, '2022-01-11 16:41:33'),
(9, 'Transaction-000000004', 'SHORT', '#5160', 'BUE', 'SMALL', '', 'UNIFORM', 1, 175, 175, 0, 175, '2022-01-11 16:41:33'),
(11, 'Transaction-000000005', 'GALLON', '222', 'BLUE', '20 LITERS', '', 'PLASTICWARE', 1, 180, 180, 0, 180, '2022-02-11 16:45:41'),
(12, 'Transaction-000000006', 'GALLON', '222', 'BLUE', '20 LITERS', '', 'PLASTICWARE', 1, 180, 180, 0, 180, '2022-02-11 16:46:11'),
(13, 'Transaction-000000007', 'DESK FAN', 'CX-1666B', 'BLACK', '', 'STANDARD', 'APPLIANCES', 1, 1350, 1350, 0, 1350, '2022-02-11 16:46:34'),
(14, 'Transaction-000000008', 'DESK FAN', 'CX-1666B', 'BLACK', '', 'STANDARD', 'APPLIANCES', 1, 1350, 1350, 0, 1350, '2022-02-11 16:47:34'),
(15, 'Transaction-000000009', 'GALLON', '222', 'BLUE', '20 LITERS', '', 'plasticware', 1, 180, 180, 0, 180, '2022-03-11 16:48:13'),
(16, 'Transaction-000000009', 'GALLON', '222', 'BLUE', '20 LITERS', '', 'plasticware', 1, 180, 180, 0, 180, '2022-03-11 16:48:13'),
(18, 'Transaction-000000010', 'SHORT', '#5160', 'BUE', 'SMALL', '', 'UNIFORM', 1, 175, 175, 0, 175, '2022-04-11 16:48:46'),
(19, 'Transaction-000000010', 'SHORT', '#5160', 'BUE', 'SMALL', '', 'UNIFORM', 1, 175, 175, 0, 175, '2022-04-11 16:48:46'),
(21, 'Transaction-000000011', 'MUGS', 'K3', 'GREEN', '', '', 'GLASSWARE', 1, 35, 35, 0, 35, '2022-05-11 16:49:17'),
(22, 'Transaction-000000011', 'MUGS', 'K3', 'GREEN', '', '', 'GLASSWARE', 1, 35, 35, 0, 35, '2022-05-11 16:49:17'),
(24, 'Transaction-000000012', 'GALLON', '222', 'BLUE', '20 LITERS', '', 'plasticware', 1, 180, 180, 0, 180, '2022-06-11 16:49:59'),
(25, 'Transaction-000000012', 'SHORT', '#5160', 'BUE', 'SMALL', '', 'UNIFORM', 1, 175, 175, 0, 175, '2022-06-11 16:49:59'),
(26, 'Transaction-000000012', 'MUGS', 'K3', 'GREEN', '', '', 'GLASSWARE', 1, 35, 35, 0, 35, '2022-06-11 16:49:59'),
(27, 'Transaction-000000013', 'MUGS', 'U33', 'RED', '', '', 'GLASSWARE', 1, 35, 35, 0, 35, '2022-07-11 16:50:55'),
(28, 'Transaction-000000013', 'MUGS', 'U38', 'PINK', '', '', 'GLASSWARE', 1, 35, 35, 0, 35, '2022-07-11 16:50:55'),
(29, 'Transaction-000000013', 'MUGS', 'K-9', 'GREEN', '', '', 'GLASSWARE', 1, 35, 35, 0, 35, '2022-07-11 16:50:55'),
(30, 'Transaction-000000014', 'PITCHER', 'UW-301-I', 'BLUE', '', 'OROCAN', 'PLASTICWARE', 2, 150, 300, 0, 300, '2022-07-11 16:51:30'),
(31, 'Transaction-000000014', 'MUGS', 'U38', 'PINK', '', '', 'GLASSWARE', 2, 35, 70, 0, 70, '2022-07-11 16:51:30'),
(32, 'Transaction-000000014', 'MUGS', 'K-9', 'GREEN', '', '', 'GLASSWARE', 2, 35, 70, 0, 70, '2022-07-11 16:51:30'),
(33, 'Transaction-000000015', 'MUGS', 'U33', 'RED', '', '', 'GLASSWARE', 3, 35, 105, 0, 105, '2022-08-11 16:52:34'),
(34, 'Transaction-000000015', 'MUGS', 'U38', 'PINK', '', '', 'GLASSWARE', 2, 35, 70, 0, 70, '2022-08-11 16:52:34'),
(36, 'Transaction-000000016', 'MUGS', 'U33', 'RED', '', '', 'GLASSWARE', 6, 35, 210, 0, 210, '2022-09-11 16:53:59'),
(37, 'Transaction-000000016', 'MUGS', 'K-9', 'GREEN', '', '', 'GLASSWARE', 7, 35, 245, 0, 245, '2022-09-11 16:53:59'),
(39, 'Transaction-000000017', 'NOTEBOOK', 'Z20', '', '', 'SPRING', 'SCHOOL SUPPLY', 5, 21, 105, 0, 105, '2022-10-11 16:55:00'),
(40, 'Transaction-000000017', 'MUGS', 'K-9', 'GREEN', '', '', 'GLASSWARE', 5, 35, 175, 0, 175, '2022-10-11 16:55:00'),
(41, 'Transaction-000000017', 'MUGS', 'U33', 'RED', '', '', 'GLASSWARE', 5, 35, 175, 0, 175, '2022-10-11 16:55:00'),
(42, 'Transaction-000000018', 'GALLON', '222', 'BLUE', '20 LITERS', '', 'plasticware', 5, 180, 900, 0, 900, '2022-10-13 08:09:20'),
(43, 'Transaction-000000018', 'SHORT', '#5160', 'BUE', 'SMALL', '', 'UNIFORM', 4, 175, 700, 0, 700, '2022-10-13 08:09:20'),
(44, 'Transaction-000000018', 'MUGS', 'K3', 'GREEN', '', '', 'GLASSWARE', 1, 35, 35, 0, 35, '2022-10-13 08:09:20'),
(45, 'Transaction-000000018', 'MUGS', 'U38', 'PINK', '', '', 'GLASSWARE', 3, 35, 105, 0, 105, '2022-10-13 08:09:20'),
(49, 'Transaction-000000019', 'STAND FAN', 'CX-1666', 'BLACK', '', 'STANDARD', 'APPLIANCES', 5, 1500, 7500, 0, 7500, '2022-10-13 08:20:09'),
(50, 'Transaction-000000020', 'STAND FAN', 'CX-1666', 'BLACK', '', 'STANDARD', 'APPLIANCES', 1, 1500, 1500, 0, 1500, '2022-10-13 08:26:19'),
(51, 'Transaction-000000020', 'GALLON', '222', 'BLUE', '20 LITERS', '', 'PLASTICWARE', 1, 180, 180, 0, 180, '2022-10-13 08:26:19'),
(53, 'Transaction-000000021', 'GALLON', '222', 'BLUE', '20 LITERS', '', 'PLASTICWARE', 1, 180, 180, 0, 180, '2022-11-13 08:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `product_brand` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_total`
--

CREATE TABLE `transaction_total` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `casher` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `changes` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_total`
--

INSERT INTO `transaction_total` (`id`, `transaction_id`, `casher`, `customer_name`, `sub_total`, `discount`, `total`, `payment`, `changes`, `date_time`) VALUES
(1, 'Transaction-000000001', 'PATRICK LOUIEPORTERA', '', 255, 0, 255, 255, 0, '2022-01-11 16:39:54'),
(2, 'Transaction-000000002', 'PATRICK LOUIEPORTERA', '', 210, 0, 210, 210, 0, '2022-01-11 16:40:49'),
(3, 'Transaction-000000003', 'PATRICK LOUIEPORTERA', '', 180, 0, 180, 180, 0, '2022-01-27 16:41:09'),
(4, 'Transaction-000000004', 'PATRICK LOUIEPORTERA', '', 355, 0, 355, 355, 0, '2022-01-11 16:41:33'),
(5, 'Transaction-000000005', 'PATRICK LOUIEPORTERA', '', 180, 0, 180, 180, 0, '2022-02-11 16:45:41'),
(6, 'Transaction-000000006', 'PATRICK LOUIEPORTERA', '', 180, 0, 180, 180, 0, '2022-02-11 16:46:11'),
(7, 'Transaction-000000007', 'PATRICK LOUIEPORTERA', '', 1350, 0, 1350, 1350, 0, '2022-02-11 16:46:34'),
(8, 'Transaction-000000008', 'PATRICK LOUIEPORTERA', '', 1350, 0, 1350, 1350, 0, '2022-02-11 16:47:34'),
(9, 'Transaction-000000009', 'PATRICK LOUIEPORTERA', '', 360, 0, 360, 360, 0, '2022-03-11 16:48:13'),
(10, 'Transaction-000000010', 'PATRICK LOUIEPORTERA', '', 350, 0, 350, 350, 0, '2022-04-11 16:48:46'),
(11, 'Transaction-000000011', 'PATRICK LOUIEPORTERA', '', 70, 0, 70, 70, 0, '2022-05-11 16:49:17'),
(12, 'Transaction-000000012', 'PATRICK LOUIEPORTERA', '', 390, 0, 390, 390, 0, '2022-06-11 16:49:59'),
(13, 'Transaction-000000013', 'PATRICK LOUIEPORTERA', '', 105, 0, 105, 105, 0, '2022-07-11 16:50:55'),
(14, 'Transaction-000000014', 'PATRICK LOUIEPORTERA', '', 440, 0, 440, 440, 0, '2022-07-11 16:51:30'),
(15, 'Transaction-000000015', 'PATRICK LOUIEPORTERA', '', 175, 0, 175, 175, 0, '2022-08-11 16:52:34'),
(16, 'Transaction-000000016', 'PATRICK LOUIEPORTERA', '', 455, 0, 455, 455, 0, '2022-09-11 16:53:59'),
(17, 'Transaction-000000017', 'PATRICK LOUIEPORTERA', '', 455, 0, 455, 455, 0, '2022-10-11 16:55:00'),
(18, 'Transaction-000000018', 'PATRICK LOUIEPORTERA', '', 1740, 0, 1740, 1740, 0, '2022-10-13 08:09:20'),
(19, 'Transaction-000000019', 'PATRICK LOUIEPORTERA', 'PATRICK', 7500, 0, 7500, 7500, 0, '2022-10-13 08:20:09'),
(20, 'Transaction-000000020', 'PATRICK LOUIEPORTERA', '', 1680, 0, 1680, 1680, 0, '2022-10-13 08:26:19'),
(21, 'Transaction-000000021', 'PATRICK LOUIEPORTERA', '', 180, 0, 180, 180, 0, '2022-11-13 08:27:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available_product`
--
ALTER TABLE `available_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barchart`
--
ALTER TABLE `barchart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_stock`
--
ALTER TABLE `check_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_from_store1`
--
ALTER TABLE `request_from_store1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_of_other_store`
--
ALTER TABLE `request_of_other_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_product`
--
ALTER TABLE `request_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_product`
--
ALTER TABLE `return_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `successfully_transfer_to_other_store`
--
ALTER TABLE `successfully_transfer_to_other_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `success_transaction`
--
ALTER TABLE `success_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_total`
--
ALTER TABLE `transaction_total`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available_product`
--
ALTER TABLE `available_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `barchart`
--
ALTER TABLE `barchart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `check_stock`
--
ALTER TABLE `check_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `request_from_store1`
--
ALTER TABLE `request_from_store1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request_of_other_store`
--
ALTER TABLE `request_of_other_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_product`
--
ALTER TABLE `request_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `return_product`
--
ALTER TABLE `return_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `successfully_transfer_to_other_store`
--
ALTER TABLE `successfully_transfer_to_other_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `success_transaction`
--
ALTER TABLE `success_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_total`
--
ALTER TABLE `transaction_total`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
