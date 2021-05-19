-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 01:21 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agricomercio`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(128) NOT NULL,
  `item_id` int(128) NOT NULL,
  `user_id` varchar(64) NOT NULL COMMENT 'this is the customer user_ref_num',
  `item_qty` int(128) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'P',
  `order_number` varchar(64) NOT NULL,
  `cart_status` varchar(1) NOT NULL DEFAULT 'P',
  `date_ordered` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(50) NOT NULL,
  `cat_desc` varchar(128) NOT NULL,
  `cat_status` varchar(50) NOT NULL COMMENT 'A for Active\r\nNA for Not Available',
  `cat_img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_desc`, `cat_status`, `cat_img`) VALUES
(1, 'fruit', 'A', 'c1.jpg'),
(2, 'vegetable', 'A', 'c2.jpg'),
(3, 'plant', 'A', 'c3.jpg'),
(4, 'crop', 'A', 'c4.jpg'),
(5, 'fertilizer', 'A', 'c5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `item_status` varchar(20) NOT NULL COMMENT 'A for Available, NA for unavailable',
  `item_price` int(11) NOT NULL,
  `user_id` varchar(64) NOT NULL COMMENT 'this is for Sellers user_ref_number',
  `item_img` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `cat_id`, `item_desc`, `item_status`, `item_price`, `user_id`, `item_img`) VALUES
(1, 'Plantmate', 5, 'Fertilizer for plants', 'A', 550, '88861690589673142', '35.png'),
(2, 'Potatoes', 4, '1kg per Pack', 'A', 100, '88861690589673142', '23.png'),
(3, 'Tomatoes', 1, '1kg per Pack', 'A', 95, '88861690589673142', '9.jpg'),
(4, 'Banana', 1, '1kg per Pack', 'A', 55, '88861690589673142', '10.jpg'),
(5, 'Carrots', 2, '1kg per Pack', 'A', 60, '88861690589673142', 'carrot.png'),
(6, 'Fruit Bundle', 1, 'Assorted', 'A', 250, '88861690589673142', '1.jpg'),
(7, 'Lettuce', 2, '1kg per Pack', 'A', 50, '88861690589673142', '2.jpg'),
(8, 'Rice', 4, '50kg per Sack', 'A', 1800, '88861690589673142', '3.jpg'),
(9, 'Sweet Potato', 4, '1kg per Pack', 'A', 50, '88861690589673142', '4.jpg'),
(10, 'Pineapple', 1, '1kg per Pack', 'A', 50, '18465013967499956', '5.jpg'),
(11, 'Spinach', 2, '1kg per Pack', 'A', 50, '18465013967499956', '6.jpg'),
(12, 'Coffee Beans', 4, '1kg per Pack', 'A', 30, '18465013967499956', '7.jpg'),
(13, 'Coconut', 1, '1 whole per Pack', 'A', 35, '18465013967499956', '8.jpg'),
(14, 'Alugbati', 2, '1 bundle per Pack', 'A', 10, '18465013967499956', '33.png'),
(15, 'Ampalaya', 2, '1kg per Pack', 'A', 45, '18465013967499956', '34.png'),
(16, 'Aratiles', 1, '1kg per Pack', 'A', 15, '18465013967499956', '11.jpg'),
(17, 'Balimbing', 1, '1kg per Pack', 'A', 25, '18465013967499956', '31.png'),
(18, 'Calamansi', 1, '1kg per Pack', 'A', 40, '18465013967499956', '12.jpg'),
(19, 'Chico', 1, '1kg per Pack', 'A', 25, '88861690589673142', '29.png'),
(20, 'Durian', 1, '1kg per Pack', 'A', 55, '88861690589673142', '15.jpg'),
(21, 'Gabi', 4, '1kg per Pack', 'A', 20, '88861690589673142', '28.png'),
(22, 'Guyabano', 1, '1kg per Pack', 'A', 35, '88861690589673142', '14.jpg'),
(23, 'Singkamas', 4, '1kg per Pack', 'A', 45, '88861690589673142', '4.png'),
(24, 'Garlic', 4, '1kg per Pack', 'A', 20, '88861690589673142', '24.png'),
(25, 'Onions', 4, '1kg per Pack', 'A', 35, '88861690589673142', '25.png'),
(26, 'Cauli Flower', 2, '1kg per Pack', 'A', 25, '18465013967499956', '22.png'),
(27, 'Sili', 2, '1kg per Pack', 'A', 60, '18465013967499956', '21.png'),
(28, 'white angel', 3, '1 plant per pot', 'A', 200, '18465013967499956', '36.png'),
(29, 'daisy', 3, '1 plant per pot', 'A', 200, '30782437241215726', '37.png'),
(30, 'upo', 2, '1 kg per pack', 'A', 50, '30782437241215726', '1.png'),
(31, 'sitaw', 2, '1 bundle per pack', 'A', 45, '30782437241215726', '3.png'),
(32, 'sigarilyas', 2, '1 kg per pack', 'NA', 50, '30782437241215726', '5.png'),
(33, 'kalabasa', 2, '1 kg per pack', 'A', 50, '30782437241215726', '20.png'),
(34, 'talong', 2, '1 kg per pack', 'A', 50, '30782437241215726', '19.png'),
(35, 'repolyo', 2, '1 kg per pack', 'A', 50, '30782437241215726', '18.png'),
(36, 'lanzones', 1, '1 kg per pack', 'A', 180, '30782437241215726', '17.png'),
(37, 'kangkong', 2, '1 bundle per pack', 'A', 50, '30782437241215726', '15.png'),
(38, 'malunggay', 2, '1 bundle per pack', 'A', 50, '30782437241215726', '14.png'),
(39, 'mango', 1, '1 kg per pack', 'A', 50, '30782437241215726', '13.png'),
(40, 'munggo', 2, '1 kg per pack', 'A', 50, '30782437241215726', '12.png'),
(41, 'mustasa', 2, '1 bundle per pack', 'NA', 50, '30782437241215726', '11.png'),
(42, 'pechay', 2, '1 bundle per pack', 'A', 50, '30782437241215726', '10.png'),
(43, 'banana blossom', 2, '1 kg per pack', 'NA', 50, '30782437241215726', '9.png'),
(44, 'rambutan', 1, '1 kg per pack', 'NA', 80, '30782437241215726', '8.png'),
(45, 'santol', 1, '1 kg per pack', 'A', 50, '30782437241215726', '7.png'),
(46, 'sayote', 2, '1 kg per pack', 'A', 50, '30782437241215726', '6.png'),
(47, 'atis', 1, '1 kg per pack', 'NA', 50, '30782437241215726', '2.png'),
(82, 'apples', 1, '1kg per pack', 'A', 100, '18465013967499956', 'apples.jpg'),
(83, 'lemon', 1, '1kg per pack', 'NA', 90, '88861690589673142', 'lemon.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(64) NOT NULL,
  `user_ref_num` varchar(128) NOT NULL COMMENT 'for customer',
  `item_id` int(11) NOT NULL,
  `user_id` varchar(64) NOT NULL COMMENT 'for seller',
  `item_qty` int(255) NOT NULL,
  `net_amt` int(255) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'P',
  `tracking_order_status` varchar(1) NOT NULL DEFAULT 'P',
  `date_ordered` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_ref_num` varchar(64) NOT NULL,
  `user_type` varchar(11) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_ref_num`, `user_type`, `user_name`, `password`, `status`) VALUES
(91, '62810271613147332', 'Customer', 'Hanabi', '1111', 'Active'),
(92, '88861690589673142', 'Seller', 'Angela', '1122', 'Active'),
(93, '18465013967499956', 'Seller', 'Nana', '1234', 'Active'),
(94, '30782437241215726', 'Seller', 'Zilong', '2345', 'Active'),
(95, '92867449643784798', 'Admin', 'admin', 'admin', 'Active'),
(96, '47022120562236447', 'shipper', 'shipper', 'shipper', 'Active'),
(97, '86963997591915336', 'Customer', 'Moon', 'moon123', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_info_id` int(11) NOT NULL,
  `user_fullname` varchar(128) NOT NULL,
  `user_ref_num` varchar(64) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contact_details` varchar(20) NOT NULL,
  `house_no_street_brgy` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `province` varchar(128) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `user_type` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_info_id`, `user_fullname`, `user_ref_num`, `gender`, `contact_details`, `house_no_street_brgy`, `city`, `province`, `postal_code`, `user_type`) VALUES
(96, 'Christine Joyce Precones', '62810271613147332', 'F', '09262849211', '308, Purok 3', 'Ligao City', 'ALBAY', 4504, 'Customer'),
(97, 'Angelica Mae Bonganay', '88861690589673142', 'F', '09262849222', '308, Purok 3', 'Tabaco City', 'ALBAY', 4511, 'Seller'),
(98, 'Natalie Buenconsejo', '18465013967499956', 'F', '09262849223', '308, Purok 3', 'Tabaco City', 'ALBAY', 4511, 'Seller'),
(99, 'Lu Jing', '30782437241215726', 'M', '09262849224', '308, Purok 3', 'Ligao City', 'ALBAY', 4504, 'Seller'),
(100, 'Admin', '92867449643784798', 'F', '09262849225', 'zone 6, Panal', 'Tabaco City', 'ALBAY', 4511, 'Admin'),
(101, 'shipper', '47022120562236447', 'M', '09262849226', 'zone 6, Panal', 'Tabaco City', 'ALBAY', 4511, 'shipper'),
(102, 'Luna Valeria', '86963997591915336', 'F', '09053369487', 'Zone-6, Panal', 'Tabaco City', 'ALBAY', 4511, 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_info_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
