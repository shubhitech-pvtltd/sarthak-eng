-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 09:38 AM
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
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` int(11) NOT NULL,
  `buyer_name` varchar(250) DEFAULT NULL,
  `buyer_email` varchar(200) DEFAULT NULL,
  `buyer_phone_no` varchar(100) DEFAULT NULL,
  `buyer_aadhar_no` varchar(200) DEFAULT NULL,
  `buyer_address` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `pincode` varchar(200) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `buyer_name`, `buyer_email`, `buyer_phone_no`, `buyer_aadhar_no`, `buyer_address`, `city`, `state`, `country`, `pincode`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'ShubhiTech', 'Sarthak123@gmail.com', '0000000000', '000000000', 'Gurugram HR', 'gurugram', 'HR', 'IN', '000000', 33, 33, '2024-07-01 01:53:46', '2024-07-01 01:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) NOT NULL,
  `owner_name` varchar(100) DEFAULT NULL,
  `owner_email` varchar(70) DEFAULT NULL,
  `owner_phone_no` bigint(12) DEFAULT NULL,
  `owner_aadhar_no` varchar(100) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `company_email` varchar(100) DEFAULT NULL,
  `company_phone_no` bigint(12) DEFAULT NULL,
  `company_pan_no` varchar(100) DEFAULT NULL,
  `company_gst_no` varchar(100) DEFAULT NULL,
  `company_cin_no` varchar(100) DEFAULT NULL,
  `country` varchar(60) DEFAULT NULL,
  `company_address_1` varchar(60) DEFAULT NULL,
  `company_address_2` varchar(60) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `pincode` varchar(100) DEFAULT NULL,
  `currency` varchar(150) DEFAULT NULL,
  `bank_branch_name` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_no` varchar(100) DEFAULT NULL,
  `ifsc_no` varchar(100) DEFAULT NULL,
  `bank_address` varchar(100) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `owner_name`, `owner_email`, `owner_phone_no`, `owner_aadhar_no`, `company_name`, `company_email`, `company_phone_no`, `company_pan_no`, `company_gst_no`, `company_cin_no`, `country`, `company_address_1`, `company_address_2`, `state`, `city`, `pincode`, `currency`, `bank_branch_name`, `bank_name`, `account_no`, `ifsc_no`, `bank_address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'SHUBHITECH', 'rohan@shubhitech.com', 0, '0000000000', 'FIDELITY AGRO PRIVATE LIMITED', 'FIDELITY@gmail.com', 0, '000000', '0000000', '000000', 'IN', 'Jhundpur', 'sonipat', 'HR', 'gurugram', '000000', 'INR', 'VISHWAS NAGAR-00000000000000', 'YES BANK', '105884600000222', 'YESB0001058', NULL, 33, 33, '2024-07-01 01:51:06', '2024-07-01 01:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `customerprices`
--

CREATE TABLE `customerprices` (
  `id` int(20) NOT NULL,
  `machine_id` varchar(250) DEFAULT NULL,
  `part_id` varchar(500) DEFAULT NULL,
  `customer_id` varchar(100) DEFAULT NULL,
  `price` int(200) DEFAULT NULL,
  `discount` varchar(100) DEFAULT NULL,
  `discount_percent` varchar(100) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerprices`
--

INSERT INTO `customerprices` (`id`, `machine_id`, `part_id`, `customer_id`, `price`, `discount`, `discount_percent`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '1', 1000, '10', '5', 33, 33, '2024-07-01 02:02:08', '2024-07-01 02:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `id` int(11) NOT NULL,
  `machine_name` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `model_no` varchar(100) NOT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`id`, `machine_name`, `description`, `model_no`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'solenoidtt', 'water assembly', 'MDS-90-01-076', 33, 33, '2024-07-01 01:52:03', '2024-07-01 01:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotationlists`
--

CREATE TABLE `quotationlists` (
  `id` int(11) NOT NULL,
  `quotation_id` varchar(200) DEFAULT NULL,
  `part_id` varchar(200) DEFAULT NULL,
  `price` varchar(200) DEFAULT NULL,
  `quantity` varchar(200) DEFAULT NULL,
  `discount` varchar(100) DEFAULT NULL,
  `discount_percent` varchar(100) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotationlists`
--

INSERT INTO `quotationlists` (`id`, `quotation_id`, `part_id`, `price`, `quantity`, `discount`, `discount_percent`, `total`, `unit`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '1000', '1', '20', '2.00', '980.00', 'SET', 33, 33, '2024-07-01 02:04:03', '2024-07-01 02:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `customer_id` int(50) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `machine_id` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `grand_total` varchar(200) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `date`, `customer_id`, `title`, `machine_id`, `description`, `grand_total`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2024-07-01', 1, 'solenoidt', '1', 'Solenoid Water Assembly', '980', 33, 33, '2024-07-01 02:04:03', '2024-07-01 02:04:03');

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
  `comment` varchar(500) DEFAULT NULL,
  `dimension` text DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spares`
--

INSERT INTO `spares` (`id`, `machine_id`, `part_no`, `description`, `purchase_from`, `buying_price`, `selling_price`, `drawing_upload`, `gea_selling_price`, `unit`, `hsn_code`, `comment`, `dimension`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '1', '8134-2100-270', 'Solenoid Water Assembly', 'ShubhiTech', '0000', '0000', 'Spare_stfSbtqYI9CNiRaOLEJRSBHr4Ycdt0.jpeg', '000', 'SET', '00000', 'solenoidtt', '000', 33, 33, '2024-07-01 02:01:24', '2024-07-01 02:01:24');

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
  `user_address_1` varchar(255) DEFAULT NULL,
  `user_address_2` varchar(60) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `pincode` varchar(50) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `username`, `mobile`, `gender_id`, `user_address_1`, `user_address_2`, `country`, `state`, `city`, `pincode`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(17, 'Saksham', 'goyal', 'sakshamgoyal100@gmail.com', '$2y$10$5WVOUdPjA.whA.P6RHfrse2Flx9QwKer8OoZXDbjU2KMMRXOA4vGm', 1, 'rttrtr', 9058378584, 1, 'ytytytyt', 'tttttttttt', 'AD', 'tt', 'tttttttttttt', 't', 16, 16, '2024-05-22 00:36:57', '2024-06-13 04:23:02'),
(33, 'rohan', 'vish', 'rohan@shubhitech.com', '$2y$10$x8hjobOTnO1KTdlGckkV8.jvgQeGTwo38sTcp8c/78OHfhlOV12zK', 1, 'rohan', 6392881825, 1, 'gurugram', 'gurugram', 'IN', 'HR', 'gurugram', 'XYZ', 17, 17, '2024-06-13 05:53:10', '2024-06-13 05:53:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerprices`
--
ALTER TABLE `customerprices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotationlists`
--
ALTER TABLE `quotationlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
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
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customerprices`
--
ALTER TABLE `customerprices`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `machines`
--
ALTER TABLE `machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotationlists`
--
ALTER TABLE `quotationlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spares`
--
ALTER TABLE `spares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
