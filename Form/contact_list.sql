-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2022 at 05:34 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `addContact`
--

CREATE TABLE `addContact` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `addContact`
--

INSERT INTO `addContact` (`id`, `name`, `gender`, `email`, `phone`, `address`, `city`, `state`, `created_on`) VALUES
(24, 'Safwan', 'male', 'safwan@gmail.com', '7897789456', 'Amber Tower, Sarkhej', 'Ahmedabad', 'Gujarat', '2022-11-07 06:48:16'),
(27, 'Aman', 'male', 'aman@gmail.com', '9898987823', 'Brainvire Company, Near Ellibridge', 'Ahmedabad', 'Gujarat', '2022-11-08 05:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `SignUp`
--

CREATE TABLE `SignUp` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `SignUp`
--

INSERT INTO `SignUp` (`id`, `name`, `gender`, `phone`, `email`, `password`) VALUES
(1, 'Sahil', 'male', '7845123219', 'sahil@gmail.com', '123456'),
(2, 'Aman', 'male', '8977785201', 'aman@gmail.com', '000000'),
(3, 'Safwan', 'male', '7897789456', 's@gmail.com', '123456'),
(4, 'Ranjan', 'male', '8977785204', 'rn@gmail.com', '12345678'),
(5, 'Ronit', 'male', '7897789419', 'ro@gmail.com', '123456'),
(6, 'Aman', 'male', '7845123245', 'aman@gmial.com', '258147');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addContact`
--
ALTER TABLE `addContact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SignUp`
--
ALTER TABLE `SignUp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addContact`
--
ALTER TABLE `addContact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `SignUp`
--
ALTER TABLE `SignUp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
