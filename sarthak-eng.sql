-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 06:48 AM
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
  `company_name` varchar(100) DEFAULT NULL,
  `owner_name` varchar(100) DEFAULT NULL,
  `office_phone` bigint(20) DEFAULT NULL,
  `owner_phone` bigint(11) DEFAULT NULL,
  `company_email` varchar(70) DEFAULT NULL,
  `owner_email` varchar(70) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gst_no` varchar(20) DEFAULT NULL,
  `pan_no` varchar(20) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_branch` varchar(100) DEFAULT NULL,
  `bank_ifsc` varchar(20) DEFAULT NULL,
  `bank_acc_no` int(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `company_name`, `owner_name`, `office_phone`, `owner_phone`, `company_email`, `owner_email`, `address`, `gst_no`, `pan_no`, `bank_name`, `bank_branch`, `bank_ifsc`, `bank_acc_no`, `description`, `country`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 'desu', 'ytuyufuy', 5445564, 54, '', '', '45', 'fftgf', 'uyf', 'yu', 'y', 'bjhbkj', 241535445, 'gvg', '4545', 17, 17, '2024-05-30 02:29:58', '2024-05-30 02:29:58'),
(4, 'desu', 'ytuyufuy', 5445564, 54, '', '', '45', 'fftgf', 'uyf', 'yu', 'y', 'bjhbkj', 241535445, 'gvg', '4545', 17, 17, '2024-05-30 02:32:20', '2024-05-30 02:32:20'),
(5, 'demo', 'demo', 546, 45546, 'sak@email.com', 'sak@email.co', 'guyyygu', 'yggy', NULL, 'gy', 'ygyu', 'u', 564546, 'guy', 'gyu', 17, 17, '2024-05-30 05:27:45', '2024-05-30 05:27:45'),
(6, 'gi', 'fyf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 17, '2024-05-30 06:04:17', '2024-05-30 06:04:17'),
(7, 'gi', 't', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 17, '2024-05-30 06:04:26', '2024-05-30 06:04:26'),
(8, 'ffFfyyu', 'fyf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 17, '2024-05-30 06:04:33', '2024-05-30 06:04:33'),
(9, 'fsd', 'ytuyufuy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 17, '2024-05-30 06:04:44', '2024-05-30 06:04:44'),
(12, 'dcd', 'dqwdq', 4554, 465564546, 'bjh@we.c', 'faga@e.x', 'bhj', 'ugygyugyu', 'hugui', 'yggy', 'gy', 'g', 67787878, 'cghvgjvgj', 'cew', NULL, NULL, NULL, '2024-05-31 00:30:39'),
(13, 'dcd', 'dqwdq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'dcd', 'dqwdq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'dcd', 'dqwdq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `role_id` int(5) NOT NULL COMMENT '1=>superadmin\r\n2=>admin\r\n3=>employee',
  `mobile` bigint(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `mobile`, `address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(17, 'Saksham', 'sakshamgoyal100@gmail.com', '$2y$10$5WVOUdPjA.whA.P6RHfrse2Flx9QwKer8OoZXDbjU2KMMRXOA4vGm', 1, 9058378584, 'Moh Afganan Nehtaur', NULL, NULL, '2024-05-22 00:36:57', '2024-05-30 03:21:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
