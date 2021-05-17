-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2021 at 07:21 AM
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
  `cart_status` varchar(1) NOT NULL DEFAULT 'P'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `item_id`, `user_id`, `item_qty`, `status`, `order_number`, `cart_status`) VALUES
(1, 77, '34870530951555017', 2, 'X', '609ca548222f974593', 'X'),
(2, 75, '34870530951555017', 4, 'X', '609ca548222f974593', 'X');

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
(1, 'Plantmate', 5, 'Fertilizer for plants', 'A', 585, '1', '35.png'),
(2, 'Potatoes', 4, '1kg per Pack', 'A', 180, '2', '23.png'),
(3, 'Tomatoes', 1, '1kg per Pack', 'A', 95, '2', '9.jpg'),
(4, 'Banana', 1, '1kg per Pack', 'A', 55, '4', '10.jpg'),
(5, 'Carrots', 2, '1kg per Pack', 'A', 60, '3', 'carrot.png'),
(6, 'Fruit Bundle', 1, 'Assorted', 'A', 250, '5', '1.jpg'),
(7, 'Lettuce', 2, '1kg per Pack', 'NA', 50, '37', '2.jpg'),
(8, 'Rice', 4, '50kg per Sack', 'A', 1800, '38', '3.jpg'),
(9, 'Sweet Potato', 4, '1kg per Pack', 'A', 50, '2', '4.jpg'),
(10, 'Pineapple', 1, '1kg per Pack', 'A', 50, '39', '5.jpg'),
(11, 'Spinach', 2, '1kg per Pack', 'NA', 50, '40', '6.jpg'),
(12, 'Coffee Beans', 4, '1kg per Pack', 'NA', 30, '41', '7.jpg'),
(13, 'Coconut', 1, '1 whole per Pack', 'A', 35, '42', '8.jpg'),
(14, 'Alugbati', 2, '1 bundle per Pack', 'A', 10, '40', '33.png'),
(15, 'Ampalaya', 2, '1kg per Pack', 'A', 45, '43', '34.png'),
(16, 'Aratiles', 1, '1kg per Pack', 'A', 15, '44', '11.jpg'),
(17, 'Balimbing', 1, '1kg per Pack', 'A', 25, '45', '31.png'),
(18, 'Calamansi', 1, '1kg per Pack', 'A', 40, '46', '12.jpg'),
(19, 'Chico', 1, '1kg per Pack', 'A', 25, '47', '29.png'),
(20, 'Durian', 1, '1kg per Pack', 'NA', 55, '54', '15.jpg'),
(21, 'Gabi', 4, '1kg per Pack', 'A', 20, '48', '28.png'),
(22, 'Guyabano', 1, '1kg per Pack', 'A', 35, '49', '14.jpg'),
(23, 'Singkamas', 4, '1kg per Pack', 'A', 45, '50', '4.png'),
(24, 'Garlic', 4, '1kg per Pack', 'A', 30, '51', '24.png'),
(25, 'Onions', 4, '1kg per Pack', 'A', 35, '51', '25.png'),
(26, 'Cauli Flower', 2, '1kg per Pack', 'A', 25, '56', '22.png'),
(27, 'Sili', 2, '1kg per Pack', 'A', 60, '55', '21.png'),
(28, 'white angel', 3, '1 plant per pot', 'A', 200, '3', '36.png'),
(29, 'daisy', 3, '1 plant per pot', 'A', 200, '3', '37.png'),
(30, 'upo', 2, '1 kg per pack', 'A', 50, '5', '1.png'),
(31, 'sitaw', 2, '1 bundle per pack', 'A', 45, '37', '3.png'),
(32, 'sigarilyas', 2, '1 kg per pack', 'NA', 50, '39', '5.png'),
(33, 'kalabasa', 2, '1 kg per pack', 'A', 50, '40', '20.png'),
(34, 'talong', 2, '1 kg per pack', 'A', 50, '41', '19.png'),
(35, 'repolyo', 2, '1 kg per pack', 'A', 50, '42', '18.png'),
(36, 'lanzones', 1, '1 kg per pack', 'A', 180, '43', '17.png'),
(37, 'kangkong', 2, '1 bundle per pack', 'A', 50, '44', '15.png'),
(38, 'malunggay', 2, '1 bundle per pack', 'A', 50, '45', '14.png'),
(39, 'mango', 1, '1 kg per pack', 'A', 50, '46', '13.png'),
(40, 'munggo', 2, '1 kg per pack', 'A', 50, '47', '12.png'),
(41, 'mustasa', 2, '1 bundle per pack', 'NA', 50, '48', '11.png'),
(42, 'pechay', 2, '1 bundle per pack', 'A', 50, '49', '10.png'),
(43, 'banana blossom', 2, '1 kg per pack', 'NA', 50, '1', '9.png'),
(44, 'rambutan', 1, '1 kg per pack', 'NA', 80, '50', '8.png'),
(45, 'santol', 1, '1 kg per pack', 'A', 50, '51', '7.png'),
(46, 'sayote', 2, '1 kg per pack', 'A', 50, '52', '6.png'),
(47, 'atis', 1, '1 kg per pack', 'NA', 50, '53', '2.png'),
(70, 'Kalachuchi', 3, 'Mabaho', 'A', 200, '90302824675917870', ''),
(71, 'Serpentina', 3, 'Mapait sobra', 'A', 5, '96580086144897462', ''),
(73, 'grapes', 1, '1kg per pack', 'A', 200, '7378077583225425', ''),
(74, 'apples', 1, '1kg per pack', 'A', 100, '7378077583225425', ''),
(75, 'kalamansi', 1, '1kg per pack', 'A', 50, '90302824675917870', ''),
(77, 'onion', 4, '1kg per pack', 'A', 40, '90302824675917870', ''),
(78, 'lemon', 1, 'per piece', 'A', 20, '96580086144897462', ''),
(79, 'gumamela', 3, 'per pot', 'A', 150, '96580086144897462', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(64) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `item_qty` int(255) NOT NULL,
  `net_amt` int(255) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'P',
  `order_status` varchar(1) NOT NULL DEFAULT 'P'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `item_id`, `user_id`, `item_qty`, `net_amt`, `status`, `order_status`) VALUES
(1, '609ca548222f974593', 77, '90302824675917870', 2, 80, 'C', 'P'),
(2, '609ca548222f974593', 75, '90302824675917870', 4, 200, 'C', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `track_order`
--

CREATE TABLE `track_order` (
  `track_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `picked_up_by_shipper` varchar(128) NOT NULL,
  `delivered` varchar(128) NOT NULL,
  `paid` varchar(128) NOT NULL,
  `user_ID_shipper` int(11) NOT NULL,
  `user_id_courier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `track_order`
--

INSERT INTO `track_order` (`track_id`, `order_id`, `picked_up_by_shipper`, `delivered`, `paid`, `user_ID_shipper`, `user_id_courier`) VALUES
(1, 1, 'Yes', 'No', 'No', 6, 6),
(2, 2, 'Yes', 'No', 'No', 7, 7),
(3, 3, 'Yes', 'Yes', 'Yes', 8, 8);

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
(63, '55857563041157511', 'Admin', 'Admin', 'Admin', 'Active'),
(64, '24877743968937062', 'Customer', 'pogi', '123123', 'Active'),
(65, '90302824675917870', 'Seller', 'pogi2', '123123', 'Active'),
(66, '48674467830811573', 'Customer', 'pogi3', '123123', 'Active'),
(67, '82031234655775365', 'Customer', 'pogi4', '123123', 'Active'),
(68, '96580086144897462', 'Seller', 'seller1', '123123', 'Active'),
(69, '34870530951555017', 'Customer', 'iana', '12345', 'Active'),
(86, '59897125964777576', 'Customer', 'kj12', 'kalixjace', 'Active'),
(87, '8279429251800958', 'Customer', 'Elyse', 'elyse', 'Active'),
(88, '57776226517833831', 'Customer', 'Elyse', 'elyse', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_info_id` int(11) NOT NULL,
  `user_fullname` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_ref_num` varchar(64) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contact_details` int(20) NOT NULL,
  `house_no_street_brgy` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `province` varchar(128) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `user_type` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_info_id`, `user_fullname`, `user_id`, `user_ref_num`, `gender`, `contact_details`, `house_no_street_brgy`, `city`, `province`, `postal_code`, `user_type`) VALUES
(69, 'testing', 0, '55857563041157511', 'M', 2147483647, 'Napo', 'Polangui', 'Albay', 4506, 'Seller'),
(70, 'testing123', 0, '90302824675917870', 'M', 2147483647, 'Napo', 'Polangui', 'Albay', 4506, 'Seller'),
(71, 'Reymar', 0, '48674467830811573', 'M', 2147483647, 'Napo', 'Polangui', 'Albay', 4506, 'Customer'),
(72, 'test', 0, '82031234655775365', 'M', 2147483647, 'Napo', 'Polangui', 'Albay', 4506, 'Customer'),
(73, 'seller1', 0, '96580086144897462', 'M', 2147483647, 'Napo', 'Polangui', 'Albay', 4506, 'Seller'),
(74, 'alliana', 0, '34870530951555017', 'F', 2147483647, 'zone 6, Panal', 'tabaco', 'albay', 4511, 'Customer'),
(91, 'kalix jayce ramirez', 0, '59897125964777576', 'M', 2147483647, 'zone 6, Panal', 'tabaco', 'albay', 4511, 'Customer'),
(92, 'Elyse Amora ', 0, '8279429251800958', 'F', 2147483647, 'zone 6, Panal', 'tabaco', 'albay', 4511, 'Customer'),
(93, 'Elyse Amora ', 0, '57776226517833831', 'F', 2147483647, 'zone 6, Panal', 'tabaco', 'albay', 4511, 'Customer');

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
-- Indexes for table `track_order`
--
ALTER TABLE `track_order`
  ADD PRIMARY KEY (`track_id`);

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
  MODIFY `cart_id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `track_order`
--
ALTER TABLE `track_order`
  MODIFY `track_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
