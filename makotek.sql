-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2023 at 03:15 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `firstName`, `lastName`, `middleInitial`, `age`, `address`, `phoneNum`, `position`, `monthlySalary`, `email`, `password`, `user_type`, `admin_pp`) VALUES
(1, 'dean', 'Angel Deanielle ', 'Dagondon', 'R.', 21, 'Address', '09111111111', 'Developer', '10000', 'dean@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'admin', 'uploads/author-2.jpg'),
(2, 'llane', 'Llane Graceza', 'Benting', 'B.', 22, 'Address', '09111111111', 'Developer', '10000', 'llane@gmail.com', '87221652a79fc3c9b04cde0b335fdd5b', 'admin', 'uploads/pic-2.jpg'),
(4, 'markB', 'Mark', 'Bontia', 'R.', 21, 'Address', '09111111111', 'Manager', '30000', 'markB@gmail.com', 'a38dc7d7a349d2d0d4a8dd0894dea1ee', 'admin', 'uploads/author-5.jpg'),
(3, 'nico1', 'Nico', 'BSD', 'SFDASFAFAS', 23, '23123123213', '1231231312', 'Clerk', '323232', 'nico@gmail.com', '112233', 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `description`, `image`) VALUES
(10, 4, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 1, '', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(2, 3, 'wawa', 'wawa@gmail.com', '111', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `delivery_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `remarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `delivery_status`, `remarks`) VALUES
(14, '3', 'Joshua R. Bracho', '111111111', 'wawa@gmail.com', 'Cash on Delivery', 'Address', ', AMD RYZEN 3 3200G PC PACKAGE (1) , AMD RYZEN 3 3200G WITH VEGA 8 GRAPHICS DESKTOP BUNDLE (PACKAGE) (1) , AMD RYZEN 5 PRO 4650G PC BUNDLE PROMO PACKAGE (1) ', 81158, '25-Jun-2023', 'Cancelled', 'Cancelled', 'hmm'),
(15, '3', 'Joshua R. Bracho', '111111111', 'wawa@gmail.com', 'Cash on Delivery', 'Zone 8', ', AMD RYZEN 3 3200G PC PACKAGE (1) ', 18702, '25-Jun-2023', 'Cancelled', 'Cancelled', 'hmm'),
(16, '3', 'Joshua R. Bracho', '111111111', 'wawa@gmail.com', 'Cash on Delivery', 'Address', ', INTEL CORE i3-10100 PC PACKAGE (1) ', 18700, '25-Jun-2023', 'Cancelled', 'Cancelled', ''),
(18, '3', 'Joshua R. Bracho', '111111111', 'wawa@gmail.com', 'Cash on Delivery', 'Address', ', INTEL CORE i3-10100 PC PACKAGE (1) , AMD A12 PC PACKAGE (1) , AMD RYZEN 5 PRO 5650G CHRISTMAS BUNDLE PROMO (PC PACKAGE) (1) ', 83179, '26-Jun-2023', 'Cancelled', 'Cancelled', ''),
(19, '3', 'Joshua R. Bracho', '111111111', 'wawa@gmail.com', 'Cash on Delivery', 'Address', ', AMD RYZEN 3 3200G PC PACKAGE (1) ', 18702, '26-Jun-2023', 'Cancelled', 'Cancelled', ''),
(20, '3', 'Joshua R. Bracho', '111111111', 'wawa@gmail.com', 'Cash on Delivery', 'Address', ', AMD RYZEN 3 3200G PC PACKAGE (1) ', 18702, '26-Jun-2023', 'Cancelled', 'Cancelled', ''),
(21, '3', 'Joshua R. Bracho', '111111111', 'wawa@gmail.com', 'Cash on Delivery', 'Address', ', INTEL CORE i3-10100 PC PACKAGE (1) ', 18700, '26-Jun-2023', 'Paid', 'Delivered', ''),
(22, '3', 'Joshua R. Bracho', '111111111', 'wawa@gmail.com', 'Cash on Delivery', 'Address', ', AMD RYZEN 3 3200G PC PACKAGE (1) ', 18702, '26-Jun-2023', 'Paid', 'Delivered', ''),
(23, '3', 'Joshua R. Bracho', '111111111', 'wawa@gmail.com', 'Cash on Delivery', 'Address', 'AMD RYZEN 3 3200G PC PACKAGE (1) ', 18702, '26-Jun-2023', 'Cancelled', 'Cancelled', ''),
(24, '3', 'Joshua R. Bracho', '111111111', 'wawa@gmail.com', 'Cash on Delivery', 'Address', 'AMD RYZEN 3 3200G PC PACKAGE (1) ', 18702, '26-Jun-2023', 'Paid', 'Delivered', ''),
(25, '3', 'Joshua R. Bracho', '111111111', 'wawa@gmail.com', 'Cash on Delivery', 'Address', 'INTEL CORE i3-10100 PC PACKAGE (1) AMD RYZEN 3 3200G PC PACKAGE (1) ', 37402, '26-Jun-2023', 'Pending', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `stock_status` varchar(255) NOT NULL,
  `products_category` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `review` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `price`, `description`, `stock_status`, `products_category`, `image`, `review`) VALUES
(5, 0, 'INTEL CORE i3-10100 PC PACKAGE', 18700, 'This SYSTEM UNIT is powered by INTEL CORE i3-10100  with integrated graphics that power you through the day, for work from home, online class and gaming', '', 'computer package', 'INTEL-CORE-i3-10100-PC-PACKAGE_720x.webp', ''),
(6, 0, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 'This SYSTEM UNIT is powered by AMD RYZEN 3 3200G  with integrated graphics that power you through the day, for work from home, online class and gaming', '', 'computer package', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp', 'nicopacs: \nnicopacs: \nnicopacs: Hi\nnicopacs: He\nwawa: hehe\nwawa: hello world\nwawa: hello world\nwawa: hello world\nwawa: hello world\nwawa: eweweew\nwawa: hi\nwawa: heheh\n'),
(7, 0, 'AMD A12 PC PACKAGE', 14700, 'This SYSTEM UNIT is powered by AMD A12 8800E with integrated graphics that power you through the day, for work from home, online class and gaming', '', 'computer package', 'AMD-A12-PC-PACKAGE_720x.webp', ''),
(8, 0, 'AMD RYZEN 3 4350G SYSTEM UNIT PACKAGE', 27578, 'This SYSTEM UNIT is powered by AMD RYZEN 3 4350G  with integrated graphics that power you through the day, for work from home, online class and gaming', '', 'computer package', 'AMD-RYZEN-3-4350G-SYSTEM-UNIT-PACKAGE_720x.webp', ''),
(9, 0, 'AMD ATHLON 200GE SYSTEM UNIT PACKAGE', 15482, 'MD ATHLON 200GE 3.2GHz (5MB CACHE 2-CORES 4-THREADS 35W) WITH VEGA 3 GRAPHICS AM4 PROCESSOR', '', 'computer package', 'AMD-ATHLON-200GE-SYSTEM-UNIT-PACKAGE_720x.webp', ''),
(10, 0, 'RYZEN 3 4350G PC BUNDLE PROMO PACKAGE', 24466, 'This Desktop PC is powered by RYZEN 3 4350G with integrated graphics that power you through the day, for work from home, online class and gaming', '', 'computer package', 'RYZEN-3-4350G-PC-BUNDLE-PROMO-PACKAGE_720x.webp', ''),
(11, 0, 'AMD RYZEN 5 PRO 4650G PC BUNDLE PROMO PACKAGE', 31199, 'This Desktop PC is powered by AMD RYZEN 5 PRO 4650G with integrated graphics that power you through the day, for work from home, online class and gaming', '', 'computer package', 'AMD-RYZEN-5-PRO-4650G-PC-BUNDLE-PROMO-PACKAGE_720x.webp', ''),
(12, 0, 'AMD RYZEN 5 PRO 5650G CHRISTMAS BUNDLE PROMO (PC PACKAGE)', 49779, 'This Desktop PC is powered by AMD RYZEN 5 PRO 5650G SERIES, the latest generation processor by AMD  that can power you through the day, for work from home, online class and gaming', '', 'computer package', 'AMD-RYZEN-5-PRO-5650G-CHRISTMAS-BUNDLE-PROMO-PC-PACKAGE_720x.webp', ''),
(13, 0, 'AMD RYZEN 3 3200G WITH VEGA 8 GRAPHICS DESKTOP BUNDLE (PACKAGE)', 31257, 'This Desktop PC is powered by AMD Ryzen 3 3200G with integrated graphics that power you through the day, for work from home, online class and gaming', '', 'computer package', 'AMD-RYZEN-3-3200G-WITH-VEGA-8-GRAPHICS-DESKTOP-BUNDLE-PACKAGE_720x.webp', ''),
(14, 0, 'GAMDIAS-ATLAS-DHD32C-240HZ-CURVED-GAMING-MONITOR', 23000, '240HZ IPS GAMING MONITOR GOOD FOR GAMING', '', 'monitor', 'GAMDIAS-ATLAS-DHD32C-240HZ-CURVED-GAMING-MONITOR_720x.jpg', ''),
(15, 0, 'GIGABYTE-G27F-2-TW-27-INCH-FHD-IPS-GAMING-MONITOR', 50000, '27 INCH FHD IPS GAMING MONITOR FOR GAMING', '', 'monitor', 'GIGABYTE-G27F-2-TW-27-INCH-FHD-IPS-GAMING-MONITOR_720x.webp', ''),
(16, 0, 'ASUS-TUF-B450M-PRO-II-GAMING-AM4-AMD-B450M-PRO-MICRO-ATX-B450-CHIPSET-MOTHERBOARD', 23000, 'MOTHERBOARD FOR GAMING', '', 'motherboard', 'ASUS-TUF-B450M-PRO-II-GAMING-AM4-AMD-B450M-PRO-MICRO-ATX-B450-CHIPSET-MOTHERBOARD-2_360x.webp', ''),
(17, 0, 'GIGABYTE-GEFORCE-RTX-3060-TI-VISION-OC-8GB-GDDR6-WHITE-GRAPHICS-CARD', 100000, 'FOR HIGH END GAMING GPU', '', 'graphics card', 'GIGABYTE-GEFORCE-RTX-3060-TI-VISION-OC-8GB-GDDR6-WHITE-GRAPHICS-CARD_720x.webp', ''),
(18, 0, 'ELSA-GTX1650-4GB-GRAPHICS-CARD', 15000, 'FOR LOW END GAMING GPU', '', 'graphics card', 'ELSA-GTX1650-4GB-GRAPHICS-CARD_720x.jpg', ''),
(21, 0, 'Cherry Wired PS/2 Compact Trackball Keyboard, AZERTY', 14000, 'HIGH END COMPUTER KEYBOARD FOR GAMING', '', 'keyboard', 'Cherry Wired PS2 Compact Trackball Keyboard, AZERTY.webp', ''),
(22, 0, 'Crucial 32 GB DDR5 Desktop RAM, 4800MHz, UDIMM', 12000, 'HIGH END GAMING RAM', '', 'ram', 'high end ram.jpg', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `middleInitial`, `username`, `email`, `password`, `age`, `phoneNum`, `address`, `user_type`, `pp`) VALUES
(1, 'Mark ', 'Bontia', 'C.', 'mark', 'mark@gmail.com', '25d55ad283aa400af464c76d713c07ad', 21, '12313123', 'A', 'user', 'uploads/University_of_Science_and_Technology_of_Southern_Philippines.png'),
(2, 'Makurui', 'Bontia', 'C.', 'makurui', 'makurui@gmail.com', '719b8cbe31cdb39eea400b2bd543869e', 21, '111111111', 'Address', 'user', 'uploads/author-4.jpg'),
(3, 'Joshua', 'Bracho', 'R.', 'wawa', 'wawa@gmail.com', '892a9944cf14665375630c06a1902152', 21, '111111111', 'Address', 'user', 'uploads/University_of_Science_and_Technology_of_Southern_Philippines.png'),
(4, 'Nico', 'Pacuit', 'B.', 'nicopacs', 'nico1@gmail.com', 'd0970714757783e6cf17b26fb8e2298f', 21, '09551938918', 'Libona ', 'user', 'uploads/author-1.jpg'),
(5, 'Llane', 'Benting', 'D', 'llane', 'llane@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 22, '09551938918', 'osmena', 'user', 'uploads/451675.image0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_reviews`
--

CREATE TABLE `user_reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `product_id` int(100) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` int(255) NOT NULL,
  `product_qty` int(100) NOT NULL,
  `review` varchar(500) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_reviews`
--

INSERT INTO `user_reviews` (`id`, `user_id`, `username`, `email`, `product_id`, `product_name`, `product_price`, `product_qty`, `review`, `image`) VALUES
(1, 4, 'nicopacs', 'nico1@gmail.com', 6, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 0, '', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp'),
(2, 4, 'nicopacs', 'nico1@gmail.com', 6, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 0, '', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp'),
(3, 4, 'nicopacs', 'nico1@gmail.com', 6, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 0, 'Hi', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp'),
(4, 4, 'nicopacs', 'nico1@gmail.com', 6, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 0, 'He', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp'),
(5, 3, 'wawa', 'wawa@gmail.com', 6, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 0, 'hehe', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp'),
(6, 3, 'wawa', 'wawa@gmail.com', 6, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 0, 'hello world', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp'),
(7, 3, 'wawa', 'wawa@gmail.com', 6, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 0, 'hello world', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp'),
(8, 3, 'wawa', 'wawa@gmail.com', 6, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 0, 'hello world', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp'),
(9, 3, 'wawa', 'wawa@gmail.com', 6, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 0, 'hello world', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp'),
(10, 3, 'wawa', 'wawa@gmail.com', 6, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 0, 'eweweew', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp'),
(11, 3, 'wawa', 'wawa@gmail.com', 6, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 0, 'hi', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp'),
(12, 3, 'wawa', 'wawa@gmail.com', 6, 'AMD RYZEN 3 3200G PC PACKAGE', 18702, 0, 'heheh', 'AMD-RYZEN-3-3200G-PC-PACKAGE_720x.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
