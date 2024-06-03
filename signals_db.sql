-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 01:34 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `signal_light`
--

-- --------------------------------------------------------

--
-- Table structure for table `signals`
--

CREATE TABLE `signals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sequence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `green_interval` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yellow_interval` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `signals`
--

INSERT INTO `signals` (`id`, `sequence`, `green_interval`, `yellow_interval`, `created_at`, `updated_at`) VALUES
(57, 'A,B,C,D', '10', '5', '2024-06-03 17:44:39', '2024-06-03 17:44:39'),
(58, 'A,B,C,D', '10', '5', '2024-06-03 17:44:45', '2024-06-03 17:44:45'),
(59, 'A,B,C,D', '10', '5', '2024-06-03 17:44:53', '2024-06-03 17:44:53'),
(60, 'A,B,C,D', '10', '5', '2024-06-03 17:49:37', '2024-06-03 17:49:37'),
(61, 'A,B,C,D', '10', '5', '2024-06-03 17:49:43', '2024-06-03 17:49:43'),
(62, 'A,B,C,D', '10', '5', '2024-06-03 17:49:49', '2024-06-03 17:49:49'),
(63, 'A,B,C,D', '10', '5', '2024-06-03 17:50:53', '2024-06-03 17:50:53'),
(64, 'A,B,C,D', '10', '5', '2024-06-03 17:55:19', '2024-06-03 17:55:19'),
(65, 'A,B,C,D', '10', '5', '2024-06-03 17:55:26', '2024-06-03 17:55:26'),
(66, 'A,B,C,D', '10', '5', '2024-06-03 17:56:09', '2024-06-03 17:56:09'),
(67, 'A,B,C,D', '10', '5', '2024-06-03 17:56:16', '2024-06-03 17:56:16'),
(68, 'D,B,C,A', '10', '10', '2024-06-03 18:00:21', '2024-06-03 18:00:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `signals`
--
ALTER TABLE `signals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `signals`
--
ALTER TABLE `signals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
