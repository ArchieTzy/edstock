-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 05:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edstock_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(4, 'Expendable', 'Also known as consumables wherein it costs below 15,000 pesos'),
(5, 'Semi-Expendable', 'The item costs 15,000 to 50,000 pesos');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Accounting Unit'),
(2, 'Administrative Unit'),
(3, 'Supply Unit'),
(4, 'Curriculum Implementation Division'),
(5, 'Schools Governance and Operations Division'),
(6, 'Cashier Unit'),
(7, 'Budget Unit'),
(8, 'Human Resource Management Office'),
(9, 'OSDS'),
(10, 'OASDS');

-- --------------------------------------------------------

--
-- Table structure for table `fclusters`
--

CREATE TABLE `fclusters` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fclusters`
--

INSERT INTO `fclusters` (`id`, `created`, `name`) VALUES
(1, '2023-10-10 19:37:37', 'DepED Region II - 10001-01'),
(2, '2023-10-15 09:35:58', 'MOOE'),
(3, '2023-10-15 09:36:07', 'Central Office');

-- --------------------------------------------------------

--
-- Table structure for table `heads`
--

CREATE TABLE `heads` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `position` varchar(55) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `heads`
--

INSERT INTO `heads` (`id`, `name`, `position`, `created`, `modified`) VALUES
(1, 'JAMES PAUL R. SANTIAGO', 'Administrative Officer III', '2023-11-03 14:50:11', '2023-11-03 14:50:11'),
(2, 'FLORDELIZA R. GECOBE', 'Schools Division Superintendent', '2023-11-03 14:50:49', '2023-11-07 01:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `iars`
--

CREATE TABLE `iars` (
  `id` int(11) NOT NULL,
  `divprofile_id` int(11) NOT NULL,
  `fcluster_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `rcc` varchar(55) NOT NULL,
  `iarno` varchar(255) NOT NULL,
  `invoiceno` varchar(55) NOT NULL,
  `created` date NOT NULL,
  `purchaseorder_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `iar_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `created`, `iar_id`) VALUES
(6, '2023-10-15 10:07:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `cost` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `created`, `category_id`, `description`, `unit_id`, `cost`) VALUES
(19, '2023-10-21 15:15:49', 4, 'EPSON PRinter 1129', 1, 5000),
(20, '2023-10-21 18:28:40', 4, 'EPSON Ink', 2, 1000),
(22, '2023-11-03 13:46:34', 5, 'Wooden Table ', 9, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `methods`
--

CREATE TABLE `methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `methods`
--

INSERT INTO `methods` (`id`, `name`, `created`, `modified`) VALUES
(1, 'CHECK', '2023-11-08 00:04:58', '2023-11-08 00:04:58'),
(2, 'CASH', '2023-11-08 00:05:26', '2023-11-08 00:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `name`) VALUES
(7, 'SDO - Santiago City');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cost` double NOT NULL,
  `qty` int(11) NOT NULL,
  `total` double NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `po_no` varchar(255) DEFAULT NULL,
  `method_id` int(11) NOT NULL,
  `place_of_delivery` varchar(255) DEFAULT NULL,
  `date_of_delivery` datetime NOT NULL,
  `delivery_term` varchar(255) NOT NULL,
  `payment_term` varchar(255) NOT NULL,
  `fund_available` varchar(25) DEFAULT NULL,
  `ors_burs_no` varchar(255) DEFAULT NULL,
  `date_of_burs` datetime NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plandetails`
--

CREATE TABLE `plandetails` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `code` varchar(55) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `jan` int(11) DEFAULT NULL,
  `feb` int(11) DEFAULT NULL,
  `mar` int(11) DEFAULT NULL,
  `apr` int(11) DEFAULT NULL,
  `may` int(11) DEFAULT NULL,
  `jun` int(11) DEFAULT NULL,
  `jul` int(11) DEFAULT NULL,
  `aug` int(11) DEFAULT NULL,
  `sep` int(11) DEFAULT NULL,
  `oct` int(11) DEFAULT NULL,
  `nov` int(11) DEFAULT NULL,
  `decm` int(11) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `prepared_by` varchar(55) NOT NULL,
  `position` varchar(55) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requestdetails`
--

CREATE TABLE `requestdetails` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cost` double NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requestdetails`
--

INSERT INTO `requestdetails` (`id`, `request_id`, `item_id`, `cost`, `qty`, `total`, `created`, `modified`, `deleted`) VALUES
(1, 3, 19, 5000, 1, 5000, '2023-11-03 14:00:38', '2023-11-09 21:22:15', NULL),
(2, 4, 22, 15000, 1, 15000, '2023-11-03 14:23:10', '2023-11-09 21:22:15', NULL),
(3, 5, 22, 15000, 2, 30000, '2023-11-05 22:02:04', '2023-11-09 21:22:15', NULL),
(4, 5, 19, 5000, 1, 5000, '2023-11-05 22:02:04', '2023-11-09 21:22:15', NULL),
(5, 5, 20, 1000, 1, 1000, '2023-11-05 22:02:04', '2023-11-09 21:22:15', NULL),
(6, 6, 22, 15000, 2, 30000, '2023-11-05 22:02:05', '2023-11-09 21:22:15', NULL),
(7, 6, 19, 5000, 1, 5000, '2023-11-05 22:02:05', '2023-11-09 21:22:15', NULL),
(8, 6, 20, 1000, 1, 1000, '2023-11-05 22:02:05', '2023-11-09 21:22:15', NULL),
(9, 7, 20, 1000, 1, 1000, '2023-11-07 01:06:24', '2023-11-09 21:22:15', NULL),
(10, 7, 19, 5000, 1, 5000, '2023-11-07 01:06:24', '2023-11-09 21:22:15', NULL),
(11, 7, 22, 15000, 1, 15000, '2023-11-07 01:06:24', '2023-11-09 21:22:15', NULL),
(12, 8, 19, 5000, 1, 5000, '2023-11-07 01:06:49', '2023-11-09 21:22:15', NULL),
(13, 8, 20, 1000, 1, 1000, '2023-11-07 01:06:49', '2023-11-09 21:22:15', NULL),
(14, 8, 22, 15000, 1, 15000, '2023-11-07 01:06:49', '2023-11-09 21:22:15', NULL),
(15, 9, 20, 1000, 1, 1000, '2023-11-07 01:28:13', '2023-11-09 21:22:15', NULL),
(16, 10, 19, 5000, 1, 5000, '2023-11-07 17:18:46', '2023-11-09 21:22:15', NULL),
(17, 10, 22, 15000, 1, 15000, '2023-11-07 17:18:46', '2023-11-09 21:22:15', NULL),
(18, 10, 20, 1000, 1, 1000, '2023-11-07 17:18:46', '2023-11-09 21:22:15', NULL),
(19, 11, 19, 5000, 2, 10000, '2023-11-07 17:20:44', '2023-11-09 21:22:15', NULL),
(20, 11, 22, 15000, 1, 15000, '2023-11-07 17:20:44', '2023-11-09 21:22:15', NULL),
(21, 11, 20, 1000, 4, 4000, '2023-11-07 17:20:44', '2023-11-09 21:22:15', NULL),
(22, 12, 19, 5000, 1, 5000, '2023-11-09 21:15:15', '2023-11-09 21:22:15', NULL),
(23, 12, 22, 15000, 1, 15000, '2023-11-09 21:15:15', '2023-11-09 21:22:15', NULL),
(24, 12, 20, 1000, 1, 1000, '2023-11-09 21:15:15', '2023-11-09 21:22:15', NULL),
(25, 13, 19, 5000, 1, 5000, '2023-11-09 21:20:09', '2023-11-09 21:22:15', NULL),
(26, 13, 20, 1000, 1, 1000, '2023-11-09 21:20:09', '2023-11-09 21:22:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `fcluster_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `pr_no` varchar(255) NOT NULL,
  `responsibility_center_code` varchar(255) DEFAULT NULL,
  `purpose` text NOT NULL,
  `requester` varchar(55) NOT NULL,
  `approver` varchar(55) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `office_id`, `fcluster_id`, `department_id`, `pr_no`, `responsibility_center_code`, `purpose`, `requester`, `approver`, `status`, `created`, `modified`, `deleted`) VALUES
(11, 7, 0, 0, '', '', 'To payment of Office Supplies for the month of October 2023.', 'James Paul R. Santiago', 'Flordeliza C. Gecobe PhD, CESO V', 0, '2023-11-07 17:20:44', '2023-11-09 20:57:22', NULL),
(13, 7, 1, 1, '10-86', '', 'To payment of Office Supplies for the month of October 2023.', 'James Paul R. Santiago', 'Flordeliza C. Gecobe PhD, CESO V', 0, '2023-11-09 21:19:52', '2023-11-09 21:56:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tin_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `tin_no`) VALUES
(1, 'SISTAN SUPPLIES DEPOT', 'Santiago City', '941-104-334-000');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`) VALUES
(1, 'pc'),
(2, 'bottle'),
(3, 'ream'),
(4, 'box'),
(5, 'liter'),
(6, 'pack'),
(7, 'person'),
(8, 'roll'),
(9, 'set'),
(10, 'tube');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `bdate` date NOT NULL,
  `tin_no` varchar(55) DEFAULT NULL,
  `plantilla_no` varchar(55) DEFAULT NULL,
  `position` varchar(55) NOT NULL,
  `role` varchar(55) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `token` varchar(255) DEFAULT NULL,
  `contact` varchar(55) NOT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `bdate`, `tin_no`, `plantilla_no`, `position`, `role`, `status`, `token`, `contact`, `department_id`) VALUES
(16, 'jepotsantiago', '$2y$10$fE5OmocHLEbiNDFveXf5E.V/5EBlL2zgkzr54p9U/8yitPmkKCiPC', 'James Paul Ronquillo Santiago', '2023-10-08', '010101010101', '0987654321', 'Administrative Officer IV', 'Super Administrator', 1, NULL, '09338146244', 2),
(17, 'archietzy', 'sheesh', 'Archie Raven Molina Raga', '2002-05-26', '100000000000', '2321313', 'Administrative Officer III', 'Super Administrator', 1, NULL, '09452247731', 1),
(18, 'jeffcalaunan', '252829', 'Marc Jefferson Calaunan', '1996-03-21', '346686124', 'ADASII-2023-0014', 'Administrative Aide VI', 'Super Administrator', 1, NULL, '09173191479', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fclusters`
--
ALTER TABLE `fclusters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heads`
--
ALTER TABLE `heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iars`
--
ALTER TABLE `iars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `methods`
--
ALTER TABLE `methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plandetails`
--
ALTER TABLE `plandetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requestdetails`
--
ALTER TABLE `requestdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fclusters`
--
ALTER TABLE `fclusters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `heads`
--
ALTER TABLE `heads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `iars`
--
ALTER TABLE `iars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `methods`
--
ALTER TABLE `methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plandetails`
--
ALTER TABLE `plandetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requestdetails`
--
ALTER TABLE `requestdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
