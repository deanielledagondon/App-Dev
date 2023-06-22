-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2023 at 04:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `makotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `middleInitial` varchar(100) NOT NULL,
  `age` int(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phoneNum` varchar(50) NOT NULL,
  `position` varchar(100) NOT NULL,
  `monthlySalary` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'admin',
  `admin_pp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `firstName`, `lastName`, `middleInitial`, `age`, `address`, `phoneNum`, `position`, `monthlySalary`, `email`, `password`, `user_type`, `admin_pp`) VALUES
(5, '', 'Angel Deanielle Dagondon', '', '', 0, '', '', '', '', 'dean@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'admin', 'uploads/PM02_20230302212124.png'),
(6, 'username', 'rar', '', '', 0, '', '', '', '', 'rar@gmail.com', '87221652a79fc3c9b04cde0b335fdd5b', 'admin', 'uploads/University_of_Science_and_Technology_of_Southern_Philippines.png'),
(7, 'abc', 'A', 'B', 'C', 12, 'aaa', '11111111', 'aaa', '11111', 'abc@gmail.com', '900150983cd24fb0d6963f7d28e17f72', 'admin', 'uploads/University_of_Science_and_Technology_of_Southern_Philippines.png'),
(8, 'AAA', 'A', 'A', 'A', 20, 'aaaa', '121212121', 'aaa', '121212', 'aaa@gmail.com', '47bce5c74f589f4867dbd57e9ca9f808', 'admin', 'uploads/University_of_Science_and_Technology_of_Southern_Philippines.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
