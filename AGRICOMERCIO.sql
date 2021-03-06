-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2021 at 11:22 AM
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
(4, 70, '48674467830811573', 1, 'C', '60925b9100a8a55529', 'C'),
(5, 2, '48674467830811573', 5, 'C', '60925b9100a8a55529', 'C'),
(7, 2, '48674467830811573', 1, 'C', '60925e000454231605', 'C'),
(8, 3, '48674467830811573', 3, 'C', '60925e000454231605', 'C'),
(9, 1, '82031234655775365', 7, 'C', '60925f8738c9314056', 'C'),
(10, 3, '82031234655775365', 5, 'C', '60925f9e59f7a61968', 'C'),
(11, 4, '82031234655775365', 7, 'C', '60925f9e59f7a61968', 'C'),
(12, 7, '82031234655775365', 6, 'C', '60926334045b244849', 'C');

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
(72, 'Kalachuchi', 3, 'Mabaho', 'A', 123, '96580086144897462', '');

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
  `user_ref_num` varchar(64) NOT NULL,
  `user_type` varchar(11) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_ref_num`, `user_type`, `user_name`, `password`, `status`) VALUES
(1, '', 'Seller', 'Joy', '1234', 'Active'),
(2, '', 'Seller', 'Ron', '5623', 'Active'),
(3, '', 'Seller', 'Lary', '9237', 'Active'),
(4, '', 'Seller', 'May', '4567', 'Blocked'),
(5, '', 'Seller', 'Sam', '3421', 'Active'),
(6, '', 'Shipper', 'John', '9806', 'Active'),
(7, '', 'Shipper', 'Wen', '3067', 'Active'),
(8, '', 'Shipper', 'Dan', '7654', 'Active'),
(9, '', 'Shipper', 'Pat', '8098', 'Blocked'),
(10, '', 'Shipper', 'Jed', '9999', 'Blocked'),
(11, '', 'Customer', 'Jen', '1111', 'Active'),
(12, '', 'Customer', 'Brad', '2222', 'Active'),
(13, '', 'Customer', 'Lara', '3333', 'Active'),
(14, '', 'Customer', 'Sara', '4444', 'Active'),
(15, '', 'Customer', 'Jack', '5555', 'Blocked'),
(16, '', 'Admin', 'Admin', 'admin', ''),
(17, '', 'Customer', 'Olivia', '8991', 'Active'),
(18, '', 'Customer', 'Oliver', '3660', 'Active'),
(19, '', 'Customer', 'Amelia', '5095', 'Active'),
(20, '', 'Customer', 'George', '1558', 'Blocked'),
(21, '', 'Customer', 'Isla', '4739', 'Active'),
(22, '', 'Customer', 'Harry', '0405', 'Active'),
(23, '', 'Customer', 'Ava', '9997', 'Active'),
(24, '', 'Customer', 'Noah', '8584', 'Active'),
(25, '', 'Customer', 'Emily', '1785', 'Blocked'),
(26, '', 'Customer', 'Sophia', '6134', 'Active'),
(27, '', 'Customer', 'Charlie', '3281', 'Active'),
(28, '', 'Customer', 'Grace', '9232', 'Active'),
(29, '', 'Customer', 'Leo', '6935', 'Active'),
(30, '', 'Customer', 'Mia', '9729', 'Blocked'),
(31, '', 'Customer', 'Jacob', '3279', 'Active'),
(32, '', 'Customer', 'Poppy', '3522', 'Active'),
(33, '', 'Customer', 'Freddie', '2931', 'Active'),
(34, '', 'Customer', 'Ella', '1198', 'Active'),
(35, '', 'Customer', 'Alfie', '2320', 'Active'),
(36, '', 'Customer', 'Angelica', '1029', 'Active'),
(37, '', 'Seller', 'Liam', '8363', 'Active'),
(38, '', 'Seller', 'Elijah', '7077', 'Active'),
(39, '', 'Seller', 'Benjamin', '2786', 'Active'),
(40, '', 'Seller', 'Lucas', '9233', 'Active'),
(41, '', 'Seller', 'Mason', '8320', 'Blocked'),
(42, '', 'Seller', 'Ethan', '7447', 'Active'),
(43, '', 'Seller', 'Alexander', '8052', 'Active'),
(44, '', 'Seller', 'Abigail', '8283', 'Active'),
(45, '', 'Seller', 'Adia', '2560', 'Active'),
(46, '', 'Seller', 'Alyssa', '6124', 'Active'),
(47, '', 'Seller', 'Dora', '7011', 'Active'),
(48, '', 'Seller', 'Felicity', '1266', 'Active'),
(49, '', 'Seller', 'Ivy', '3018', 'Blocked'),
(50, '', 'Seller', 'Kylie', '8780', 'Active'),
(51, '', 'Seller', 'Megan', '9750', 'Blocked'),
(52, '', 'Seller', 'Rose', '1596', 'Active'),
(53, '', 'Seller', 'Violet', '1612', 'Active'),
(54, '', 'Seller', 'Roxanne', '4668', 'Active'),
(55, '', 'Seller', 'Myla', '3472', 'Blocked'),
(56, '', 'Seller', 'Taylor', '9649', 'Active'),
(62, '', 'Seller', 'sellerpogi', '123123', 'Active'),
(63, '55857563041157511', 'Seller', 'test123', '123123', 'Active'),
(64, '24877743968937062', 'Customer', 'pogi', '123123', 'Active'),
(65, '90302824675917870', 'Seller', 'pogi2', '123123', 'Active'),
(66, '48674467830811573', 'Customer', 'pogi3', '123123', 'Active'),
(67, '82031234655775365', 'Customer', 'pogi4', '123123', 'Active'),
(68, '96580086144897462', 'Seller', 'seller1', '123123', 'Active');

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
(1, 'Jen', 11, '', 'F', 2147483647, 'P-3 P-1 Basud', 'Tabaco', 'Albay', 4511, 'Customer'),
(2, 'Brad', 12, '', 'M', 2147483647, 'P-1 Basud', 'Tabaco', 'Albay', 4511, 'Customer'),
(3, 'Lara', 13, '', 'F', 2147483647, 'P-6 Baranghawon', 'Tabaco', 'Albay', 4511, 'Customer'),
(4, 'Sara', 14, '', 'F', 2147483647, 'P-2 Basud', 'Tabaco', 'Albay', 4511, 'Customer'),
(5, 'Jack', 15, '', 'M', 2147483647, 'P-6 Panal', 'Tabaco', 'Albay', 4511, 'Customer'),
(6, 'Olivia', 17, '', 'F', 2147483647, 'P-3 San Isidro', 'Tabaco', 'Albay', 4511, 'Customer'),
(7, 'Oliver', 18, '', 'M', 2147483647, 'P-3 San Isidro', 'Tabaco', 'Albay', 4511, 'Customer'),
(8, 'Amelia', 19, '', 'F', 2147483647, 'P-3 San Roque', 'Tabaco', 'Albay', 4511, 'Customer'),
(9, 'George', 20, '', 'M', 2147483647, 'P-6 Baranghawon', 'Tabaco', 'Albay', 4511, 'Customer'),
(10, 'Isla', 21, '', 'F', 2147483647, 'P-1 Mayao', 'Oas', 'Albay', 4505, 'Customer'),
(11, 'Harry', 22, '', 'M', 2147483647, 'P-2 Ilaor', 'Oas', 'Albay', 4505, 'Customer'),
(12, 'Ava', 23, '', 'F', 2147483647, 'P-3 Mayao', 'Oas', 'Albay', 4505, 'Customer'),
(13, 'Noah', 24, '', 'M', 2147483647, 'P-3, Palapas', 'Ligao', 'Albay', 4504, 'Customer'),
(14, 'Emily', 25, '', 'F', 2147483647, 'P-1 Tula-tula', 'Ligao', 'Albay', 4504, 'Customer'),
(15, 'Sophia', 26, '', 'F', 2147483647, 'P-4 Malama', 'Ligao', 'Albay', 4504, 'Customer'),
(16, 'Charlie', 27, '', 'M', 2147483647, 'P-1 Allang', 'Ligao', 'Albay', 4504, 'Customer'),
(17, 'Grace', 28, '', 'F', 2147483647, 'P-5 Tandarura', 'Ligao', 'Albay', 4504, 'Customer'),
(18, 'Leo', 29, '', 'M', 2147483647, 'P-6 Lanigay', 'Polangui', 'Albay', 4506, 'Customer'),
(19, 'Mia', 30, '', 'F', 2147483647, 'P-3 Basud', 'Polangui', 'Albay', 4506, 'Customer'),
(20, 'Jacob', 31, '', 'M', 2147483647, 'P-1, Sugcad', 'Polangui', 'Albay', 4506, 'Customer'),
(21, 'Poppy', 32, '', 'F', 2147483647, 'P-2, Centro Occidental (Pob.)', 'Polangui', 'Albay', 4506, 'Customer'),
(22, 'Freddie', 33, '', 'M', 2147483647, 'P-2, Agos', 'Polangui', 'Albay', 4506, 'Customer'),
(23, 'Ella', 34, '', 'F', 2147483647, 'P-2, Alnay', 'Polangui', 'Albay', 4506, 'Customer'),
(24, 'Alfie', 35, '', 'M', 2147483647, 'P-1 Apad', 'Polangui', 'Albay', 4506, 'Customer'),
(25, 'Angelica', 36, '', 'F', 2147483647, 'P-3 Cepres', 'Polangui', 'Albay', 4506, 'Customer'),
(32, 'Joy', 1, '', 'F', 2147483647, 'Purok 3, Paulba', 'Ligao', 'Albay', 4504, 'Seller'),
(33, 'Ron', 2, '', 'M', 2147483647, 'Purok 1, Allang', 'Ligao', 'Albay', 4504, 'Seller'),
(34, 'Lary', 3, '', 'M', 2147483647, 'Purok 2, Culliat', 'Ligao', 'Albay', 4504, 'Seller'),
(35, 'May', 4, '', 'F', 2147483647, 'Purok 5', 'Ligao', 'Albay', 4504, 'Seller'),
(36, 'Sam', 5, '', 'F', 2147483647, 'Purok 4, Bacong', 'Ligao', 'Albay', 4504, 'Seller'),
(37, 'Liam', 37, '', 'M', 2147483647, 'Caba??gan', 'Legazpi', 'Albay', 4500, 'Seller'),
(38, 'Elijah', 38, '', 'M', 2147483647, 'Oro Site ??? Magallanes St.', 'Legazpi', 'Albay', 4500, 'Seller'),
(39, 'Benjamin', 39, '', 'M', 2147483647, 'Pinaric', 'Legazpi', 'Albay', 4500, 'Seller'),
(40, 'Lucas', 40, '', 'M', 2147483647, 'Binanuahan (East)', 'Legazpi', 'Albay', 4500, 'Seller'),
(41, 'Mason', 41, '', 'M', 2147483647, 'Bagumbayan', 'Legazpi', 'Albay', 4500, 'Seller'),
(42, 'Ethan', 42, '', 'M', 2147483647, 'Maoyod', 'Legazpi', 'Albay', 4500, 'Seller'),
(43, 'Alexander', 43, '', 'M', 2147483647, 'Ba??ag', 'Daraga', 'Albay', 4501, 'Seller'),
(44, 'Abigail', 44, '', 'F', 2147483647, 'Anislag', 'Daraga', 'Albay', 4501, 'Seller'),
(45, 'Adia', 45, '', 'F', 2147483647, 'Malabog', 'Daraga', 'Albay', 4501, 'Seller'),
(46, 'Alyssa', 46, '', 'F', 2147483647, 'Villahermosa', 'Daraga', 'Albay', 4501, 'Seller'),
(47, 'Dora', 47, '', 'F', 2147483647, 'Barangay 1', 'Camalig', 'Albay', 4502, 'Seller'),
(48, 'Felicity', 48, '', 'F', 2147483647, 'Anoling', 'Camalig', 'Albay', 4502, 'Seller'),
(49, 'Ivy', 49, '', 'F', 2147483647, 'Salvacion', 'Daraga', 'Albay', 4501, 'Seller'),
(50, 'Kylie', 50, '', 'F', 2147483647, 'Em\'s Barrio', 'Legazpi', 'Albay', 4500, 'Seller'),
(51, 'Megan', 51, '', 'F', 2147483647, 'Imperial Court', 'Legazpi', 'Albay', 4500, 'Seller'),
(52, 'Rose', 52, '', 'F', 2147483647, 'Bantonan', 'Camalig', 'Albay', 4502, 'Seller'),
(53, 'violet', 53, '', 'F', 2147483647, 'Batbat', 'Guinobatan', 'Albay', 4503, 'Seller'),
(54, 'Roxanne', 54, '', 'F', 2147483647, 'Calzada', 'Guinobatan', 'Albay', 4503, 'Seller'),
(55, 'Myla', 55, '', 'F', 2147483647, 'Mahaba', 'Ligao', 'Albay', 4504, 'Seller'),
(56, 'Taylor', 56, '', 'F', 2147483647, 'Malobago', 'Guinobatan', 'Albay', 4503, 'Seller'),
(69, 'testing', 0, '55857563041157511', 'M', 2147483647, 'Napo', 'Polangui', 'Albay', 4506, 'Seller'),
(70, 'testing123', 0, '90302824675917870', 'M', 2147483647, 'Napo', 'Polangui', 'Albay', 4506, 'Seller'),
(71, 'Reymar', 0, '48674467830811573', 'M', 2147483647, 'Napo', 'Polangui', 'Albay', 4506, 'Customer'),
(72, 'test', 0, '82031234655775365', 'M', 2147483647, 'Napo', 'Polangui', 'Albay', 4506, 'Customer'),
(73, 'seller1', 0, '96580086144897462', 'M', 2147483647, 'Napo', 'Polangui', 'Albay', 4506, 'Seller');

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
  MODIFY `cart_id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
