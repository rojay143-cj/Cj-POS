-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 10:36 AM
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
-- Database: `stockmasters`
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
(36, 'Pliers', '../assets/image/pliers.webp', 599, 290, 15, 538349321, 'test', '2024-03-12 12:32:15', '0000-00-00 00:00:00', 5),
(37, 'Cracker', '', 155, 200, 15, 638192447, 'Taga dumaguete rani sya!', '2024-03-23 22:28:31', '0000-00-00 00:00:00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(55) NOT NULL,
  `customer_phone` varchar(25) NOT NULL,
  `payment_type` enum('Cash','Bank','GCash') NOT NULL,
  `ref_num` varchar(55) NOT NULL,
  `amount_tendered` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `change_amount` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `order_stat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_name`, `customer_phone`, `payment_type`, `ref_num`, `amount_tendered`, `total_amount`, `change_amount`, `vat`, `discount`, `notes`, `created_at`, `order_stat`) VALUES
(208, 'cj', '09208979564', 'Bank', 'MSTR-2024-03-243993760', 4000, 2186, 1814, 0, 0, '', '2024-03-18 15:27:23', 'Completed'),
(209, 'cj', '09208979564', 'Bank', 'MSTR-2024-03-2435506246', 3000, 310, 2690, 0, 0, '', '2024-03-20 15:27:53', 'Completed'),
(210, 'cj', '09208979564', 'GCash', 'MSTR-2024-03-2473809825', 2000, 1214, 786, 0, 0, '', '2024-03-23 16:46:02', 'Completed'),
(211, 'ching', '09208979564', 'Bank', 'MSTR-2024-03-246876647', 2000, 644, 1356, 0, 0, '', '2024-03-24 17:36:03', 'In Progress');

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
(597, 33, 2, 150, 300, 208),
(598, 34, 2, 55, 110, 208),
(599, 35, 2, 289, 578, 208),
(600, 36, 2, 599, 1198, 208),
(601, 37, 2, 155, 310, 209),
(602, 33, 3, 150, 450, 210),
(603, 34, 3, 55, 165, 210),
(604, 37, 2, 155, 310, 210),
(605, 35, 1, 289, 289, 210),
(606, 33, 2, 150, 300, 211),
(607, 34, 1, 55, 55, 211),
(608, 35, 1, 289, 289, 211);

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
(5, 'Carpicorn', 'Sharon', 'Capricorn079@gmail.com', 2147483647, 'new Supplier', '2024-03-10 10:14:10', '0000-00-00 00:00:00'),
(6, 'Malcon', 'Jerry Yang', 'malcon23@gmail.com', 2147483647, 'Dumaguete City, Ngro. Oriental', '2024-03-23 22:27:45', '0000-00-00 00:00:00');

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
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=609;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
