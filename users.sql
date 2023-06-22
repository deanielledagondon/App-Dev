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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `middleInitial` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `age` int(100) NOT NULL,
  `phoneNum` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `pp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `middleInitial`, `username`, `email`, `password`, `age`, `phoneNum`, `address`, `user_type`, `pp`) VALUES
(1, 'Angel Deanielle Dagondon', '', '', '0', 'dean@gmail.com', '25d55ad283aa400af464c76d713c07ad', 0, '', '', 'user', 'uploads/defaultpp.png'),
(2, 'Mark Bontia', '', '', '0', 'mark@gmail.com', '25d55ad283aa400af464c76d713c07ad', 0, '', '', 'user', 'uploads/Untitled.png'),
(3, 'Devil', 'May', 'C', 'DevilMayCry', 'devil@gmail.com', 'e6c94a28c4e2f8890eedab2669785f73', 21, '', 'DevilMayCry', 'user', 'uploads/University_of_Science_and_Technology_of_Southern_Philippines.png'),
(4, 'Daot', 'Mani', 'O', 'daot', 'daot@gmail.com', '16205c4e1ade5a7a9e360312568aefec', 36, '', 'daot', 'user', 'uploads/University_of_Science_and_Technology_of_Southern_Philippines.png'),
(5, 'H', 'M', 'M', 'hmm', 'hmm@gmail.com', 'a5175faf6dc24adc7eda4f9cfc721b47', 12, '1111111', 'aaa', 'user', 'uploads/author-1.jpg'),
(6, 'a', 'a', 'a', 'aaaaa', 'a1@gmail.com', '8a8bb7cd343aa2ad99b7d762030857a2', 12, '3333', 'aaaa', 'user', 'uploads/logoo.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
