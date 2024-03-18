-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 08:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockmaster`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `reorder_point` int(11) NOT NULL,
  `barcode` int(55) NOT NULL,
  `description` varchar(55) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `image`, `unit_price`, `quantity`, `reorder_point`, `barcode`, `description`, `created_at`, `updated_at`, `supplier_id`) VALUES
(33, 'Lock', '../assets/image/lock.jpg', 150, 290, 15, 776966280, 'test', '2024-03-12 12:31:45', '0000-00-00 00:00:00', 5),
(34, 'Nut', '../assets/image/nut.jpg', 55, 200, 15, 477002539, 'test', '2024-03-12 12:31:54', '0000-00-00 00:00:00', 3),
(35, 'Hammer', '../assets/image/hammer.webp', 289, 290, 15, 544151657, 'test', '2024-03-12 12:32:05', '0000-00-00 00:00:00', 4),
(36, 'Pliers', '../assets/image/pliers.webp', 599, 290, 15, 538349321, 'test', '2024-03-12 12:32:15', '0000-00-00 00:00:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(55) NOT NULL,
  `customer_phone` varchar(25) NOT NULL,
  `payment_type` enum('Cash','Bank','GCash') NOT NULL,
  `ref_num` int(11) NOT NULL,
  `amount_tendered` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `change_amount` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_name`, `customer_phone`, `payment_type`, `ref_num`, `amount_tendered`, `total_amount`, `change_amount`, `vat`, `discount`, `created_at`) VALUES
(195, 'cj', '09208979564', 'Bank', 0, 4000, 3598, 0, 0, 0, '2024-03-15 09:05:42'),
(196, 'cj', '80000', 'Bank', 0, 1000, 23729, 0, 0, 0, '2024-03-15 09:42:07');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_subtotal` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `item_id`, `item_quantity`, `item_price`, `item_subtotal`, `order_id`) VALUES
(564, 35, 2, 599, 1198, 195),
(565, 34, 3, 800, 2400, 195),
(566, 33, 6, 150, 900, 196),
(567, 34, 8, 55, 440, 196),
(568, 35, 7, 289, 2023, 196),
(569, 36, 34, 599, 20366, 196);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(55) NOT NULL,
  `contact_phone` int(11) NOT NULL,
  `address` varchar(55) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `contact_name`, `contact_email`, `contact_phone`, `address`, `created_at`, `updated_at`) VALUES
(3, 'Kretox', 'Jacky', 'kretox12@gmail.com', 2147483647, 'test', '2024-03-04 20:49:39', '0000-00-00 00:00:00'),
(4, 'Zodiac', 'Lowie', 'zodiac@gmail.com', 2147483647, 'Bagacay', '2024-03-10 10:12:00', '0000-00-00 00:00:00'),
(5, 'Carpicorn', 'Sharon', 'Capricorn079@gmail.com', 2147483647, 'new Supplier', '2024-03-10 10:14:10', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=570;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
