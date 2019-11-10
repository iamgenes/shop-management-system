-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2019 at 10:27 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_accountant`
--

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE `management` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userStatus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_quantity` int(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `prd_date_entered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `shop_id`, `product_name`, `product_quantity`, `product_price`, `prd_date_entered`) VALUES
(6, 1, 'bagga', 6, '8000', '2019-05-13'),
(10, 1, 'cooper', 6, '8000000', '2019-05-14'),
(11, 1, 'cooper', 6, '8,000,000', '2019-05-14'),
(12, 1, 'Agricultural Products', 2, '2000', '2019-05-14'),
(13, 1, 'fruits', 6, '1000', '2019-05-14'),
(14, 1, 'sausage', 20, '6000', '2019-05-16'),
(15, 1, 'fgsgs', 4, '23423', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `shop_details`
--

CREATE TABLE `shop_details` (
  `shop_id` int(11) NOT NULL,
  `shopName` varchar(255) NOT NULL,
  `shopOwner` varchar(255) NOT NULL,
  `shopPhone` varchar(15) NOT NULL,
  `shopEmail` varchar(255) NOT NULL,
  `shopPassword` varchar(255) NOT NULL,
  `shop_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_details`
--

INSERT INTO `shop_details` (`shop_id`, `shopName`, `shopOwner`, `shopPhone`, `shopEmail`, `shopPassword`, `shop_status`) VALUES
(1, 'Wakora', 'Genes', '+255623458919', 'genes0022@gmail.com', 'bc42a7aa75ddb8fe21a72c47e247f2b2', 1),
(2, 'mabasi', 'mshindi', '+255785234589', 'mshindi@gmail.com', '3e57a7bcdd2f9ecc87fb0f9d0fefbea2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_expenses`
--

CREATE TABLE `shop_expenses` (
  `expense_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `expense_name` varchar(255) NOT NULL,
  `expense_details` text NOT NULL,
  `expense_amount` varchar(255) NOT NULL,
  `expense_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_expenses`
--

INSERT INTO `shop_expenses` (`expense_id`, `shop_id`, `expense_name`, `expense_details`, `expense_amount`, `expense_date`) VALUES
(1, 1, 'dsdf', 'sdfaf', '233', '2019-05-13'),
(2, 1, 'test expense', 'any other reason for using money', '10,000', '2019-05-14'),
(3, 1, 'test expense', 'many more expenses used by the shop', '10,000', '2019-05-14'),
(4, 1, 'bought bars', 'any other bars on the market can fit here', '10,000,000', '2019-05-14'),
(5, 1, 'test for date', 'Testing if the date entered will be today', '0', '0000-00-00'),
(6, 1, 'fsf', 'sfddsfs', '34234', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `shop_sales`
--

CREATE TABLE `shop_sales` (
  `sale_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `prd_quantity_sold` int(255) NOT NULL,
  `sale_discount` int(255) NOT NULL,
  `sale_final_price` int(255) NOT NULL,
  `sale_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_sales`
--

INSERT INTO `shop_sales` (`sale_id`, `shop_id`, `product_id`, `prd_quantity_sold`, `sale_discount`, `sale_final_price`, `sale_date`) VALUES
(1, 1, 14, 3, 500, 1500, '2019-05-20'),
(2, 1, 10, 3, 500, 1500, '2019-05-20'),
(3, 1, 12, 2, 0, 4000, '2019-07-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `shop_details`
--
ALTER TABLE `shop_details`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `shop_expenses`
--
ALTER TABLE `shop_expenses`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `shop_sales`
--
ALTER TABLE `shop_sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `management`
--
ALTER TABLE `management`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `shop_details`
--
ALTER TABLE `shop_details`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `shop_expenses`
--
ALTER TABLE `shop_expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shop_sales`
--
ALTER TABLE `shop_sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop_details` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop_expenses`
--
ALTER TABLE `shop_expenses`
  ADD CONSTRAINT `shop_expenses_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop_details` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop_sales`
--
ALTER TABLE `shop_sales`
  ADD CONSTRAINT `shop_sales_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop_details` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shop_sales_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
