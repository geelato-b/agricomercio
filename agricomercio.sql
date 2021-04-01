-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2021 at 09:18 AM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `cat_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `item_id`, `item_name`, `cat_desc`) VALUES
(5, 1, 'plantmate', 'fertilizer'),
(4, 2, 'potatoes', 'crop'),
(1, 3, 'tomatoes', 'fruit'),
(1, 4, 'banana', 'fruit'),
(2, 5, 'carrots', 'vegetable'),
(1, 6, 'fruit bundle', 'fruit'),
(2, 7, 'lettuce', 'vegetable'),
(4, 8, 'rice', 'crop'),
(4, 9, 'sweet potato', 'crop'),
(1, 10, 'pineapple', 'fruit'),
(2, 11, 'spinach', 'vegetable'),
(4, 12, 'coffee beans', 'crop'),
(1, 13, 'coconut', 'fruit'),
(2, 14, 'alugbati', 'vegetable'),
(2, 15, 'ampalaya', 'vegetable'),
(1, 16, 'aratiles', 'fruit'),
(1, 17, 'balimbing', 'fruit'),
(1, 18, 'calamansi', 'fruit'),
(1, 19, 'chico', 'fruit'),
(1, 20, 'durian', 'fruit'),
(4, 21, 'gabi', 'crop'),
(1, 22, 'guyabano', 'fruit'),
(4, 23, 'singkamas', 'crop'),
(4, 24, 'garlic', 'crop'),
(4, 25, 'onion', 'crop'),
(2, 26, 'cauli flower', 'vegetable'),
(2, 27, 'sili', 'vegetable'),
(3, 28, 'white angel', 'plant'),
(3, 29, 'daisy', 'plant'),
(2, 30, 'upo', 'vegetable'),
(2, 31, 'sitaw', 'vegetable'),
(2, 32, 'sigarilyas', 'vegetable'),
(2, 33, 'kalabasa', 'vegetable'),
(2, 34, 'talong', 'vegetable'),
(2, 35, 'repolyo', 'vegetable'),
(1, 36, 'lanzones', 'fruit'),
(2, 37, 'kangkong', 'vegetable'),
(2, 38, 'malunggay', 'vegetable'),
(1, 39, 'mango', 'fruit'),
(2, 40, 'munggo', 'vegetable'),
(2, 41, 'mustasa', 'vegetable'),
(2, 42, 'pechay', 'vegetable'),
(2, 43, 'banana blossom', 'vegetable'),
(1, 44, 'rambutan', 'fruit'),
(1, 45, 'santol', 'fruit'),
(2, 46, 'sayote', 'vegetable'),
(1, 47, 'atis', 'fruit');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_1` varchar(128) NOT NULL,
  `address_2` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `province` varchar(128) NOT NULL,
  `postal_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `user_id`, `address_1`, `address_2`, `city`, `province`, `postal_code`) VALUES
(1, 'Jen', 11, 'P-3 Panal, Tabaco City, Albay', '', 'Tabaco', 'Albay', 4511),
(2, 'Brad', 12, 'P-1 Basud, Tabaco City, Albay', '', 'Tabaco', 'Albay', 4511),
(3, 'Lara', 13, 'P-6 Baranghawon, Tabaco City, Albay', '', 'Tabaco', 'Albay', 4511),
(4, 'Sara', 14, 'P-2 Basud, Tabaco City, Albay', '', 'Tabaco', 'Albay', 4511),
(5, 'Jack', 15, 'P-6 Panal, Tabaco City, Albay', '', 'Tabaco', 'Albay', 4511),
(6, 'Olivia', 16, 'P-3 San Isidro, Tabaco City, Albay', '', 'Tabaco', 'Albay', 4511),
(7, 'Oliver', 17, 'P-3 San Isidro, Tabaco City, Albay', '', 'Tabaco', 'Albay', 4511),
(8, 'Amelia', 18, 'P-3 San Roque, Tabaco City, Albay', '', 'Tabaco', 'Albay', 4511),
(9, 'George', 19, 'P-6 Baranghawon, Tabaco City, Albay', '', 'Tabaco', 'Albay', 4511),
(10, 'Isla', 20, 'P-1 Mayao, Oas, Albay', '', 'Oas', 'Albay', 4505),
(11, 'Harry', 21, 'P-2 Ilaor, Norte Oas, Albay', '', 'Oas', 'Albay', 4505),
(12, 'Ava', 22, 'P-3 Mayao, Oas, Albay', '', 'Oas', 'Albay', 4505),
(13, 'Noah', 23, 'P-3, Palapas, Ligao City, Albay', '', 'Ligao', 'Albay', 4504),
(14, 'Emily', 24, 'P-1 Tula-tula, Ligao City, Albay', '', 'Ligao', 'Albay', 4504),
(15, 'Sophia', 25, 'P-4 Malama, Ligao City, Albay', '', 'Ligao', 'Albay', 4504),
(16, 'Charlie', 26, 'P-1 Allang, Ligao City, Albay', '', 'Ligao', 'Albay', 4504),
(17, 'Grace', 27, 'P-5 Tandarura, Ligao City, Albay', '', 'Ligao', 'Albay', 4504),
(18, 'Leo', 28, 'P-6 Lanigay, Polangui, Albay', '', 'Polangui', 'Albay', 4506),
(19, 'Mia', 29, 'P-3 Basud, Polangui, Albay', '', 'Polangui', 'Albay', 4506),
(20, 'Jacob', 30, 'P-1, Sugcad, Polangui, Albay', '', 'Polangui', 'Albay', 4506),
(21, 'Poppy', 31, 'P-2, Centro Occidental (Pob.), Polangui, Albay', '', 'Polangui', 'Albay', 4506),
(22, 'Freddie', 32, 'P-2, Agos, Polangui, Albay', '', 'Polangui', 'Albay', 4506),
(23, 'Ella', 33, 'P-2, Alnay, Polangui, Albay', '', 'Polangui', 'Albay', 4506),
(24, 'Alfie', 34, 'P-1 Apad, Polangui, Albay', '', 'Polangui', 'Albay', 4506),
(25, 'Angelica', 35, 'P-3 Cepres, Polangui, Albay', '', 'Polangui', 'Albay', 4506);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `item_price` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_desc`, `item_price`, `seller_id`) VALUES
(1, 'Plantmate', 'Fertilizer for plants', 585, 1),
(2, 'Potatoes', '1kg per Pack', 180, 2),
(3, 'Tomatoes', '1kg per Pack', 95, 3),
(4, 'Lakatan Banana', '1kg per Pack', 55, 4),
(5, 'Carrots', '1kg per Pack', 60, 5),
(6, 'Fruit Bundle', 'Assorted', 50, 6),
(7, 'Lettuce', '1kg per Pack', 50, 7),
(8, 'Rice', '50kg per Sack', 50, 8),
(9, 'Sweet Potato', '1kg per Pack', 50, 9),
(10, 'Pineapple', '1kg per Pack', 50, 10),
(11, 'Spinach', '1kg per Pack', 50, 11),
(12, 'Coffee Beans', '1kg per Pack', 30, 12),
(13, 'Coconut', '1 whole per Pack', 35, 13),
(14, 'Alugbati', '1 bundle per Pack', 10, 14),
(15, 'Ampalaya', '1kg per Pack', 45, 15),
(16, 'Aratiles', '1kg per Pack', 15, 16),
(17, 'Balimbing', '1kg per Pack', 25, 17),
(18, 'Calamansi', '1kg per Pack', 40, 18),
(19, 'Chico', '1kg per Pack', 25, 19),
(20, 'Durian', '1kg per Pack', 55, 20),
(21, 'Gabi', '1kg per Pack', 20, 21),
(22, 'Guyabano', '1kg per Pack', 35, 22),
(23, 'Singkamas', '1kg per Pack', 45, 23),
(24, 'Garlic', '1kg per Pack', 30, 24),
(25, 'Onions', '1kg per Pack', 35, 25),
(26, 'Cauli Flower', '1kg per Pack', 25, 26),
(27, 'Sili', '1kg per Pack', 60, 27),
(28, 'white angel', '1 plant per pot', 200, 28),
(29, 'daisy', '1 plant per pot', 200, 29),
(30, 'upo', '1 kg per pack', 50, 30),
(31, 'sitaw', '1 bundle per pack', 45, 31),
(32, 'sigarilyas', '1 kg per pack', 50, 32),
(33, 'kalabasa', '1 kg per pack', 50, 33),
(34, 'talong', '1 kg per pack', 50, 34),
(35, 'repolyo', '1 kg per pack', 50, 35),
(36, 'lanzones', '1 kg per pack', 50, 37),
(37, 'kangkong', '1 bundle per pack', 50, 38),
(38, 'malunggay', '1 bundle per pack', 50, 39),
(39, 'mango', '1 kg per pack', 50, 40),
(40, 'munggo', '1 kg per pack', 50, 41),
(41, 'mustasa', '1 bundle per pack', 50, 42),
(42, 'pechay', '1 bundle per pack', 50, 43),
(43, 'banana blossom', '1 kg per pack', 50, 44),
(44, 'rambutan', '1 kg per pack', 50, 45),
(45, 'santol', '1 kg per pack', 50, 46),
(46, 'sayote', '1 kg per pack', 50, 47),
(47, 'atis', '1 kg per pack', 50, 50);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `item_qty` int(255) NOT NULL,
  `net_amt` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cust_id`, `item_id`, `seller_id`, `item_qty`, `net_amt`) VALUES
(1, 1, 2, 1, 2, 1170),
(2, 2, 2, 2, 1, 585),
(3, 3, 3, 3, 1, 95);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `seller_id` int(11) NOT NULL,
  `seller_name` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_1` varchar(128) NOT NULL,
  `address_2` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `province` varchar(128) NOT NULL,
  `postal_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`seller_id`, `seller_name`, `user_id`, `address_1`, `address_2`, `city`, `province`, `postal_code`) VALUES
(1, 'Joy', 1, 'Purok 3, Paulba, Ligao City, Albay', '', 'Ligao', 'Albay', 4504),
(2, 'Ron', 2, 'Purok 1, Allang, Ligao City, Albay', '', 'Ligao', 'Albay', 4504),
(3, 'Lary', 3, 'Purok 2, Culliat, Ligao City, Albay', '', 'Ligao', 'Albay', 4504),
(4, 'May', 4, 'Purok 5, Malama, Ligao City, Albay', '', 'Ligao', 'Albay', 4504),
(5, 'Sam', 5, 'Purok 4, Bacong, Ligao City, Albay', '', 'Ligao', 'Albay', 4504),
(6, 'Liam', 6, 'Cabañgan, Legazpi City, Albay', '', 'Legazpi', 'Albay', 4500),
(7, 'Elijah', 7, 'Oro Site – Magallanes St., Legazpi City, Albay', '', 'Legazpi', 'Albay', 4500),
(8, 'Benjamin', 8, 'Pinaric, Legazpi City, Albay', '', 'Legazpi', 'Albay', 4500),
(9, 'Lucas', 9, 'Binanuahan (East), Legazpi City, Albay', '', 'Legazpi', 'Albay', 4500),
(10, 'Mason', 10, 'Bagumbayan, Legazpi City, Albay', '', 'Legazpi', 'Albay', 4500),
(11, 'Ethan', 11, 'Maoyod, Legazpi City, Albay', '', 'Legazpi', 'Albay', 4500),
(12, 'Alexander', 12, 'Bañag, Daraga, Albay', '', 'Daraga', 'Albay', 4501),
(13, 'Abigail', 13, 'Anislag, Daraga, Albay', '', 'Daraga', 'Albay', 4501),
(14, 'Adia', 14, 'Malabog, Daraga, Albay', '', 'Daraga', 'Albay', 4501),
(15, 'Alyssa', 15, 'Villahermosa, Daraga, Albay', '', 'Daraga', 'Albay', 4501),
(16, 'Dora', 16, 'Barangay 1, Camalig, Albay', '', 'Camalig', 'Albay', 4502),
(17, 'Felicity', 17, 'Anoling, Camalig, Albay', '', 'Camalig', 'Albay', 4502),
(18, 'Ivy', 18, 'Salvacion, Daraga, Albay', '', 'Daraga', 'Albay', 4501),
(19, 'Kylie', 19, 'Em\'s Barrio, Legazpi City, Albay', '', 'Legazpi', 'Albay', 4500),
(20, 'Megan', 20, 'Imperial Court, Legazpi City, Albay', '', 'Legazpi', 'Albay', 4500),
(21, 'Rose', 21, 'Bantonan, Camalig, Albay', '', 'Camalig', 'Albay', 4502),
(22, 'violet', 22, 'Batbat, Guinobatan, Albay', '', 'Guinobatan', 'Albay', 4503),
(23, 'Roxanne', 23, 'Calzada, Guinobatan, Albay', '', 'Guinobatan', 'Albay', 4503),
(24, 'Myla', 24, 'Mahaba, Ligao City, Albay', '', 'Ligao', 'Albay', 4504),
(25, 'Taylor', 25, 'Malobago, Guinobatan, Albay', '', 'Guinobatan', 'Albay', 4503);

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
  `user_type` varchar(11) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `user_name`, `password`, `status`) VALUES
(1, 'Seller', 'Joy', '1234', 'Active'),
(2, 'Seller', 'Ron', '5623', 'Active'),
(3, 'Seller', 'Lary', '9237', 'Active'),
(4, 'Seller', 'May', '4567', 'Blocked'),
(5, 'Seller', 'Sam', '3421', 'Inactive'),
(6, 'Shipper', 'John', '9806', 'Active'),
(7, 'Shipper', 'Wen', '3067', 'Active'),
(8, 'Shipper', 'Dan', '7654', 'Active'),
(9, 'Shipper', 'Pat', '8098', 'Blocked'),
(10, 'Shipper', 'Jed', '9999', 'Blocked'),
(11, 'Customer', 'Jen', '1111', 'Active'),
(12, 'Customer', 'Brad', '2222', 'Active'),
(13, 'Customer', 'Lara', '3333', 'Active'),
(14, 'Customer', 'Sara', '4444', 'Inactive'),
(15, 'Customer', 'Jack', '5555', 'Blocked'),
(16, 'Admin', 'Admin', '', ''),
(17, 'Customer', 'Olivia', '8991', 'Active'),
(18, 'Customer', 'Oliver', '3660', 'Inactive'),
(19, 'Customer', 'Amelia', '5095', 'Active'),
(20, 'Customer', 'George', '1558', 'Blocked'),
(21, 'Customer', 'Isla', '4739', 'Active'),
(22, 'Customer', 'Harry', '0405', 'Inactive'),
(23, 'Customer', 'Ava', '9997', 'Active'),
(24, 'Customer', 'Noah', '8584', 'Active'),
(25, 'Customer', 'Emily', '1785', 'Blocked'),
(26, 'Customer', 'Sophia', '6134', 'Inactive'),
(27, 'Customer', 'Charlie', '3281', 'Active'),
(28, 'Customer', 'Grace', '9232', 'Active'),
(29, 'Customer', 'Leo', '6935', 'Active'),
(30, 'Customer', 'Mia', '9729', 'Blocked'),
(31, 'Customer', 'Jacob', '3279', 'Active'),
(32, 'Customer', 'Poppy', '3522', 'Active'),
(33, 'Customer', 'Freddie', '2931', 'Inactive'),
(34, 'Customer', 'Ella', '1198', 'Active'),
(35, 'Customer', 'Alfie', '2320', 'Inactive'),
(36, 'Customer', 'Angelica', '1029', 'Active'),
(37, 'Seller', 'Liam', '8363', 'Active'),
(38, 'Seller', 'Elijah', '7077', 'Active'),
(39, 'Seller', 'Benjamin', '2786', 'Inactive'),
(40, 'Seller', 'Lucas', '9233', 'Active'),
(41, 'Seller', 'Mason', '8320', 'Blocked'),
(42, 'Seller', 'Ethan', '7447', 'Active'),
(43, 'Seller', 'Alexander', '8052', 'Active'),
(44, 'Seller', 'Abigail', '8283', 'Inactive'),
(45, 'Seller', 'Adia', '2560', 'Inactive'),
(46, 'Seller', 'Alyssa', '6124', 'Active'),
(47, 'Seller', 'Dora', '7011', 'Active'),
(48, 'Seller', 'Felicity', '1266', 'Active'),
(49, 'Seller', 'Ivy', '3018', 'Blocked'),
(50, 'Seller', 'Kylie', '8780', 'Inactive'),
(51, 'Seller', 'Megan', '9750', 'Blocked'),
(52, 'Seller', 'Rose', '1596', 'Active'),
(53, 'Seller', 'Violet', '1612', 'Inactive'),
(54, 'Seller', 'Roxanne', '4668', 'Active'),
(55, 'Seller', 'Myla', '3472', 'Blocked'),
(56, 'Seller', 'Taylor', '9649', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

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
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`seller_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `track_order`
--
ALTER TABLE `track_order`
  MODIFY `track_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
