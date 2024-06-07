-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 07:05 AM
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
-- Database: `sarthak-eng`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) NOT NULL,
  `owner_name` varchar(100) DEFAULT NULL,
  `owner_email` varchar(70) DEFAULT NULL,
  `owner_phone_no` bigint(12) DEFAULT NULL,
  `owner_aadhar_no` varchar(20) DEFAULT NULL,
  `company_name` varchar(20) DEFAULT NULL,
  `company_email` varchar(20) DEFAULT NULL,
  `company_phone_no` bigint(12) DEFAULT NULL,
  `company_pan_no` varchar(20) DEFAULT NULL,
  `company_gst_no` varchar(20) DEFAULT NULL,
  `company_cin_no` varchar(20) DEFAULT NULL,
  `country` varchar(60) DEFAULT NULL,
  `company_address` varchar(60) DEFAULT NULL,
  `bank_branch_name` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_no` int(50) DEFAULT NULL,
  `ifsc_no` varchar(50) DEFAULT NULL,
  `bank_address` varchar(1500) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `owner_name`, `owner_email`, `owner_phone_no`, `owner_aadhar_no`, `company_name`, `company_email`, `company_phone_no`, `company_pan_no`, `company_gst_no`, `company_cin_no`, `country`, `company_address`, `bank_branch_name`, `bank_name`, `account_no`, `ifsc_no`, `bank_address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(20, 'rohan', 'rohan200@gmail.com', 443444434344, '434545', 'ytewytreytre7687487', 'ro@gmail.com', 476487, '56465465', '443434', '98439898', NULL, 'iuoii', 'rrrrrttt', 'yuewyuewyu', 4444, '4444', NULL, 17, 17, '2024-06-06 23:30:07', '2024-06-06 23:30:07'),
(21, 'rohan', 'rohan200@gmail.com', 443444434344, '434545', 'hjfhjfd', 'ro@gmail.com', 87438743, '56465465', '443434', '98439898', NULL, 'rrrrrrrrrr', 'rrrrrttt', 'yuewyuewyu', 4444, '3344566', NULL, 17, 17, '2024-06-06 23:33:33', '2024-06-06 23:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `id` int(11) NOT NULL,
  `machine_name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `model_no` varchar(50) NOT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`id`, `machine_name`, `description`, `model_no`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'solenoid', 'solenoid water assembly', 'MSD-90-01-076', 17, 17, '2024-06-04 13:10:56', '2024-06-04 13:10:56'),
(4, 'tyyrtyreyr', 'trtrttt', '4555555', 17, 17, '2024-06-06 10:03:46', '2024-06-06 10:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `spares`
--

CREATE TABLE `spares` (
  `id` int(11) NOT NULL,
  `machine_id` varchar(50) DEFAULT NULL,
  `part_no` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `purchase_from` varchar(50) DEFAULT NULL,
  `buying_price` varchar(50) DEFAULT NULL,
  `selling_price` varchar(50) DEFAULT NULL,
  `drawing_upload` varchar(250) DEFAULT NULL,
  `gea_selling_price` varchar(50) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `hsn_code` varchar(100) DEFAULT NULL,
  `currency` varchar(225) DEFAULT NULL,
  `dimension` text DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spares`
--

INSERT INTO `spares` (`id`, `machine_id`, `part_no`, `description`, `purchase_from`, `buying_price`, `selling_price`, `drawing_upload`, `gea_selling_price`, `unit`, `hsn_code`, `currency`, `dimension`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '1', '867-76-76', 'solenoid water assembly', 'Yes', '99', '110', 'SarthakW5hWZFafrpFXqOBqtp41dNPNRa1qMv.png', '120', 'SET', 'MSD-90-19', '10', 'role', NULL, NULL, '2024-06-04 13:26:21', '2024-06-04 14:07:50'),
(2, '1', '867-76-76', 'hhdhd', NULL, NULL, NULL, 'Sarthaku0aAk3PC2S1yBaZAS5hMpVQ3r4bLwP.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-04 14:03:40', '2024-06-04 14:03:40'),
(5, '6', '65576576', 'rtttttt', 'yes', '7766', '6565', NULL, '765765', '65', '65765', 'gfgfdgf', '66666', NULL, NULL, '2024-06-06 09:53:49', '2024-06-06 09:53:49'),
(6, '7', '65576576', 'hghghg', 'no', '7766', '6565', NULL, '6576', '6', '65765', 'gfgfdgf', '66666', NULL, NULL, '2024-06-06 09:57:04', '2024-06-06 09:57:04'),
(7, NULL, '65576576', 'rrrrrrrrrrr', NULL, '7766', '6565', NULL, '6576', '65', '65765', 'gfgfdgf', '66666', NULL, NULL, '2024-06-06 10:04:28', '2024-06-06 10:04:28'),
(8, NULL, '65576576', 'rrtrttrtrtrtrt', NULL, '7766', '6565', NULL, '6576', '7676', '65765', 'gfgfdgf', '66666', NULL, NULL, '2024-06-06 23:08:47', '2024-06-06 23:08:47'),
(9, NULL, '65576576', 'yyyyyyyyyyyy', NULL, '656576', '6565', NULL, '6576', '65', '65765', 'gfgfdgf', '66666', NULL, NULL, '2024-06-06 23:09:29', '2024-06-06 23:09:29'),
(10, NULL, '65576576', 'yyyyyyyyyyyy', NULL, '656576', '6565', NULL, '6576', '65', '65765', 'gfgfdgf', '66666', NULL, NULL, '2024-06-06 23:09:29', '2024-06-06 23:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(60) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(70) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `role_id` int(5) NOT NULL COMMENT '1=>superadmin\r\n2=>admin\r\n3=>employee',
  `username` varchar(60) DEFAULT NULL,
  `mobile` bigint(10) DEFAULT NULL,
  `gender_id` int(5) DEFAULT NULL COMMENT '1=>male 2=>female 3=>other ',
  `address` varchar(255) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `username`, `mobile`, `gender_id`, `address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(17, 'Saksham', 'rr', 'sakshamgoyal100@gmail.com', '$2y$10$5WVOUdPjA.whA.P6RHfrse2Flx9QwKer8OoZXDbjU2KMMRXOA4vGm', 1, 'rttrtr', 9058378584, 1, 'gffffffffff', NULL, NULL, '2024-05-22 00:36:57', '2024-06-06 02:17:35'),
(27, 'rrrr', 'trtr', 'rakshamgoyal100@gmail.com', '$2y$10$etWP7yqCbWf3V/QwQFgX7.UtffSZ0Lmo.vB5GzY/wtTCqLS9QPV3C', 2, 'rerrere', 44444444444, 2, 'reeeeeeeeeee', NULL, NULL, '2024-06-06 10:03:20', '2024-06-06 10:03:20'),
(28, 'trtr', 'trtr', 'rohan@gmail.com', '$2y$10$lGE5YufXiZC2FkBC8eyQ9.QR/tu8lbYVDg4ICvu8HcAwid0ImqFVq', 2, 'km', 44444444444, 1, 'rrrrrrrrrrrrrrrrrrrrr', NULL, NULL, '2024-06-06 23:14:04', '2024-06-06 23:14:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spares`
--
ALTER TABLE `spares`
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
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `machines`
--
ALTER TABLE `machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `spares`
--
ALTER TABLE `spares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
