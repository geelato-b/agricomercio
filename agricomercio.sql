-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2021 at 08:50 AM
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
(47, 'atis', '1 kg per pack', 50, 50),
(60, 'test', 'test', 0, 1),
(61, 'test2', 'test2', 123123, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_info_id` int(11) NOT NULL,
  `user_fullname` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_details` varchar(128) NOT NULL,
  `house_no_street_brgy` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `province` varchar(128) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `user_type` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_info_id`, `user_fullname`, `user_id`, `contact_details`, `house_no_street_brgy`, `city`, `province`, `postal_code`, `user_type`) VALUES
(1, 'Jen', 11, '92947640774', 'P-3 P-1 Basud', 'Tabaco', 'Albay', 4511, 'Customer'),
(2, 'Brad', 12, '22112405995', 'P-1 Basud', 'Tabaco', 'Albay', 4511, 'Customer'),
(3, 'Lara', 13, '56353995419', 'P-6 Baranghawon', 'Tabaco', 'Albay', 4511, 'Customer'),
(4, 'Sara', 14, '27371977632', 'P-2 Basud', 'Tabaco', 'Albay', 4511, 'Customer'),
(5, 'Jack', 15, '36290109489', 'P-6 Panal', 'Tabaco', 'Albay', 4511, 'Customer'),
(6, 'Olivia', 17, '60951700020', 'P-3 San Isidro', 'Tabaco', 'Albay', 4511, 'Customer'),
(7, 'Oliver', 18, '42111229987', 'P-3 San Isidro', 'Tabaco', 'Albay', 4511, 'Customer'),
(8, 'Amelia', 19, '74046972428', 'P-3 San Roque', 'Tabaco', 'Albay', 4511, 'Customer'),
(9, 'George', 20, '42479281399', 'P-6 Baranghawon', 'Tabaco', 'Albay', 4511, 'Customer'),
(10, 'Isla', 21, '56103485572', 'P-1 Mayao', 'Oas', 'Albay', 4505, 'Customer'),
(11, 'Harry', 22, '33747066742', 'P-2 Ilaor', 'Oas', 'Albay', 4505, 'Customer'),
(12, 'Ava', 23, '40450184925', 'P-3 Mayao', 'Oas', 'Albay', 4505, 'Customer'),
(13, 'Noah', 24, '41411667623', 'P-3, Palapas', 'Ligao', 'Albay', 4504, 'Customer'),
(14, 'Emily', 25, '76693447324', 'P-1 Tula-tula', 'Ligao', 'Albay', 4504, 'Customer'),
(15, 'Sophia', 26, '48056217781', 'P-4 Malama', 'Ligao', 'Albay', 4504, 'Customer'),
(16, 'Charlie', 27, '25579167774', 'P-1 Allang', 'Ligao', 'Albay', 4504, 'Customer'),
(17, 'Grace', 28, '62720281345', 'P-5 Tandarura', 'Ligao', 'Albay', 4504, 'Customer'),
(18, 'Leo', 29, '43321973579', 'P-6 Lanigay', 'Polangui', 'Albay', 4506, 'Customer'),
(19, 'Mia', 30, '99361440898', 'P-3 Basud', 'Polangui', 'Albay', 4506, 'Customer'),
(20, 'Jacob', 31, '86451775620', 'P-1, Sugcad', 'Polangui', 'Albay', 4506, 'Customer'),
(21, 'Poppy', 32, '68880323799', 'P-2, Centro Occidental (Pob.)', 'Polangui', 'Albay', 4506, 'Customer'),
(22, 'Freddie', 33, '89622543094', 'P-2, Agos', 'Polangui', 'Albay', 4506, 'Customer'),
(23, 'Ella', 34, '42735703377', 'P-2, Alnay', 'Polangui', 'Albay', 4506, 'Customer'),
(24, 'Alfie', 35, '72144041066', 'P-1 Apad', 'Polangui', 'Albay', 4506, 'Customer'),
(25, 'Angelica', 36, '92030971107', 'P-3 Cepres', 'Polangui', 'Albay', 4506, 'Customer'),
(32, 'Joy', 1, '2147483647', 'Purok 3, Paulba', 'Ligao', 'Albay', 4504, 'Seller'),
(33, 'Ron', 2, '95183532372', 'Purok 1, Allang', 'Ligao', 'Albay', 4504, 'Seller'),
(34, 'Lary', 3, '59314199248', 'Purok 2, Culliat', 'Ligao', 'Albay', 4504, 'Seller'),
(35, 'May', 4, '31045747086', 'Purok 5', 'Ligao', 'Albay', 4504, 'Seller'),
(36, 'Sam', 5, '42752644109', 'Purok 4, Bacong', 'Ligao', 'Albay', 4504, 'Seller'),
(37, 'Liam', 37, '80835557199', 'Cabañgan', 'Legazpi', 'Albay', 4500, 'Seller'),
(38, 'Elijah', 38, '72026844907', 'Oro Site – Magallanes St.', 'Legazpi', 'Albay', 4500, 'Seller'),
(39, 'Benjamin', 39, '57943054014', 'Pinaric', 'Legazpi', 'Albay', 4500, 'Seller'),
(40, 'Lucas', 40, '91165709158', 'Binanuahan (East)', 'Legazpi', 'Albay', 4500, 'Seller'),
(41, 'Mason', 41, '84506974749', 'Bagumbayan', 'Legazpi', 'Albay', 4500, 'Seller'),
(42, 'Ethan', 42, '86777715729', 'Maoyod', 'Legazpi', 'Albay', 4500, 'Seller'),
(43, 'Alexander', 43, '74903417301', 'Bañag', 'Daraga', 'Albay', 4501, 'Seller'),
(44, 'Abigail', 44, '81588153513', 'Anislag', 'Daraga', 'Albay', 4501, 'Seller'),
(45, 'Adia', 45, '90650238810', 'Malabog', 'Daraga', 'Albay', 4501, 'Seller'),
(46, 'Alyssa', 46, '65795371151', 'Villahermosa', 'Daraga', 'Albay', 4501, 'Seller'),
(47, 'Dora', 47, '84865417413', 'Barangay 1', 'Camalig', 'Albay', 4502, 'Seller'),
(48, 'Felicity', 48, '42270029191', 'Anoling', 'Camalig', 'Albay', 4502, 'Seller'),
(49, 'Ivy', 49, '28529581719', 'Salvacion', 'Daraga', 'Albay', 4501, 'Seller'),
(50, 'Kylie', 50, '25659903988', 'Em\'s Barrio', 'Legazpi', 'Albay', 4500, 'Seller'),
(51, 'Megan', 51, '48307337874', 'Imperial Court', 'Legazpi', 'Albay', 4500, 'Seller'),
(52, 'Rose', 52, '58276815255', 'Bantonan', 'Camalig', 'Albay', 4502, 'Seller'),
(53, 'violet', 53, '36518651207', 'Batbat', 'Guinobatan', 'Albay', 4503, 'Seller'),
(54, 'Roxanne', 54, '28317768292', 'Calzada', 'Guinobatan', 'Albay', 4503, 'Seller'),
(55, 'Myla', 55, '21920456599', 'Mahaba', 'Ligao', 'Albay', 4504, 'Seller'),
(56, 'Taylor', 56, '34849747794', 'Malobago', 'Guinobatan', 'Albay', 4503, 'Seller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`item_id`);

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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
