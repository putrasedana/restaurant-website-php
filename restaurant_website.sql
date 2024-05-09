-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 09:44 AM
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
-- Database: `restaurant_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(6, 'Anton', '1', 'c4ca4238a0b923820dcc509a6f75849b'),
(19, 'Ayam Goreng', 'a', '0cc175b9c0f1b6a831c399e269772661'),
(22, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(24, 'json editted', 'andri123', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(21, 'Pizza', 'food_category_943.jpg', 'Yes', 'Yes'),
(22, 'Burger', 'food_category_657.jpg', 'Yes', 'Yes'),
(23, 'Dimsum', 'food_category_826.jpg', 'Yes', 'Yes'),
(42, 'Original Pizza', 'food_category_274.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(8, 'Pizza', 'Good pizza.', 16.00, 'Food-name-428.jpg', 21, 'Yes', 'Yes'),
(10, 'Momo', 'This dish is delicious.', 5.00, 'Food-name-231.jpg', 23, 'Yes', 'Yes'),
(11, 'Burger', 'This burger is wonderful.', 8.00, 'Food-name-654.jpg', 22, 'Yes', 'Yes'),
(20, 'Big Burger', 'Nice burger!!!', 10.00, 'Food-name-669.jpg', 22, 'Yes', 'Yes'),
(21, 'Mix Pizza', 'This pizza is so delicious!!!', 14.00, 'Food-name-481.jpg', 21, 'Yes', 'Yes'),
(22, 'Momo Mini', 'This dimsum is oishii', 8.00, 'Food-name-731.jpg', 23, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Burger', 8.00, 10, 80.00, '2024-03-24 01:20:34', 'Delivered', 'Anto', '09899868876', 'a@njing.com', 'Denpasar, Bali'),
(2, 'Burger', 8.00, 2, 16.00, '2024-03-25 04:31:44', 'Cancelled', 'Ayam Bakar', '09899868876', 'a@jing.com', 'Denpasar, Bali'),
(3, 'Momo', 5.00, 1, 5.00, '2024-03-25 04:32:50', 'On Delivery', 'I Made', '09899766887', 'putras@gmail.com', 'Denpasar, Bali'),
(4, 'Pizza', 16.00, 2, 32.00, '2024-03-25 04:35:10', 'Cancelled', 'Ayam Goreng', '09899868876', 'a@njing.com', 'Denpasar'),
(5, 'Pizza', 16.00, 1, 16.00, '2024-04-06 11:40:34', 'Ordered', 'I Made', '+6285704128095', 'putras@gmail.com', 'Denpasar, Bali'),
(6, 'Pizza', 16.00, 1, 16.00, '2024-04-06 11:40:49', 'Ordered', 'I Made', '+6285704128095', 'putras@gmail.com', 'Denpasar, Bali'),
(7, 'Pizza', 16.00, 1, 16.00, '2024-04-06 11:41:01', 'Ordered', 'I Made', '+6285704128095', 'putras@gmail.com', 'Denpasar, Bali'),
(8, 'Pizza', 16.00, 3, 48.00, '2024-04-06 11:41:41', 'Ordered', 'I Made', '+6285704128095', 'putras@gmail.com', 'Denpasar, Bali'),
(9, 'Pizza', 16.00, 4, 64.00, '2024-04-06 11:43:17', 'Ordered', 'I Made', '+6285704128095', 'putras@gmail.com', 'Indonesia, Southeast Asia'),
(10, 'Pizza', 16.00, 1, 16.00, '2024-04-06 11:43:36', 'Ordered', 'I Made', '+6285704128095', 'putras@gmail.com', 'Denpasar, Bali'),
(11, 'Mix Pizza', 14.00, 1, 14.00, '2024-04-06 11:45:28', 'Ordered', 'I Made', '+6285704128095', 'putras@gmail.com', 'Denpasar, Bali'),
(12, 'Pizza', 16.00, 1, 16.00, '2024-04-06 11:52:47', 'Ordered', 'I Made', '+6285704128095', 'putras@gmail.com', 'Denpasar, Bali'),
(13, 'Pizza', 16.00, 1, 16.00, '2024-05-09 09:24:35', 'Ordered', 'json editted', '1111111', 'json@gmail.com', 'Bali');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
