-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 06:17 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manga-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(13, 'Administator', 'admin', 'e00cf25ad42683b3df678c61f42c6bda'),
(14, 'Benedict Middleton', 'novicilut', 'f3ed11bbdb94fd9ebdefbaf646ab94d3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manga`
--

CREATE TABLE `tbl_manga` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `stock` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_manga`
--

INSERT INTO `tbl_manga` (`id`, `title`, `img_name`, `featured`, `stock`) VALUES
(24, 'Berserk', 'Manga_407.jpg', 'Yes', 'Yes'),
(25, 'Hells Paradise', 'Manga_492.jpg', 'Yes', 'Yes'),
(27, 'Solo Leveling', 'Manga_838.jpg', 'No', 'Yes'),
(28, 'Class Room Of The Elite', 'Manga_10.jpg', 'No', 'Yes'),
(29, 'One Piece', 'Manga_835.jpg', 'No', 'Yes'),
(30, 'Demon Slayer', 'Manga_734.jpg', 'No', 'Yes'),
(31, 'Jujitsu Kaisen', 'Manga_667.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manga_volumes`
--

CREATE TABLE `tbl_manga_volumes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `stock` varchar(10) NOT NULL,
  `manga_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_manga_volumes`
--

INSERT INTO `tbl_manga_volumes` (`id`, `title`, `img_name`, `featured`, `stock`, `manga_id`, `price`, `description`) VALUES
(10, 'Berserk 1-10', 'volume_175.jpg', 'Yes', 'Yes', 24, '1000.00', 'Berserk Volumes 1-10 // Guts Griffith Casca'),
(11, 'Berserk 11-20', 'volume_213.jpg', 'Yes', 'Yes', 24, '1200.00', 'Berserk Volumes 11-20 // Guts Griffith Casca'),
(12, 'Class Room Of The Elite 1-10', 'volume_900.jpg', 'Yes', 'Yes', 28, '2000.00', 'Class Room Of The Elite Volumes 1-10 // Highschool Elite Smart'),
(13, 'Class Room Of The Elite 11-18', 'volume_117.jpg', 'Yes', 'Yes', 28, '1450.00', 'Class Room Of The Elite Volumes 11-18 // Highschool Elite Smart'),
(14, 'Demon Slayer 1-20', 'volume_95.jpg', 'Yes', 'Yes', 30, '5000.00', 'Demon Slayer Volumes 1-20 // Demon Tanjiro Nezuko'),
(15, 'Demon Slayer 21-25', 'volume_645.jpg', 'Yes', 'Yes', 30, '800.00', 'Demon Slayer Volume 21-25 // Tanjio Demon Nezuko'),
(16, 'Hells Paradise 1-5', 'volume_32.jpg', 'Yes', 'Yes', 25, '900.00', 'Hells Paradise 1-5'),
(17, 'Hells Paradise 6-12', 'volume_317.jpg', 'Yes', 'Yes', 25, '1350.00', 'Hells Paradise Volumes 6-12 // Ninja Not-Gojo'),
(18, 'One Piece 1-100', 'volume_878.jpg', 'Yes', 'Yes', 29, '10000.00', 'One Piece Volumes 1-100 // Luffy Fruit Strawhat Powerful'),
(19, 'One Piece 101-150', 'volume_554.jpg', 'Yes', 'Yes', 29, '5051.00', 'One Piece Volumes 101-150 // Strawhat Pirate Gum'),
(20, 'One Piece 1000-1087', 'volume_772.jpg', 'Yes', 'Yes', 29, '999.00', 'One Piece Volumes 1000-1087 // God-power Op Luffy'),
(22, 'One Piece 1088-2000', 'volume_1376.jpg', 'Yes', 'Yes', 29, '870.00', 'One Piece Volumes 1088-2000 // Found The One Piece Strawhat Pirate King'),
(23, 'Solo Leveling 1-7', 'volume_647.jpg', 'Yes', 'Yes', 27, '1000.00', 'Solo Leveling Volumes 1-7 // Op Level XP'),
(24, 'Solo Leveling 8-11', 'volume_675.jpg', 'Yes', 'Yes', 27, '1700.00', 'Solo Leveling Volumes 8 - 11 // XP OP Solo Dungeons'),
(25, 'Jujitsu Kaisen 1-11', 'volume_942.jpg', 'Yes', 'Yes', 31, '2000.00', 'Jujitsu Kaisen Volumes 1-11 // jjk gojo my king'),
(26, 'Jujitsu Kaisen 12-26', 'volume_266.jpg', 'Yes', 'Yes', 31, '2500.00', 'Jujitsu Kaisen Volumes 12-26 // jjk gojo curse domain');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `manga` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `cust_name` varchar(150) NOT NULL,
  `cust_contact` varchar(20) NOT NULL,
  `cust_email` varchar(150) NOT NULL,
  `cust_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `manga`, `price`, `quantity`, `total`, `order_date`, `status`, `cust_name`, `cust_contact`, `cust_email`, `cust_address`) VALUES
(7, 'Jujitsu Kaisen 1-11', '2000.00', 1, '2000.00', '2024-04-05 04:52:50', 'Delivered', 'Carter Dale', '1234567891', 'caroqaj@mailinator.com', 'Ullamco pariatur Co'),
(8, 'Hells Paradise 6-12', '1350.00', 1, '1350.00', '2024-04-05 17:31:36', 'Ordered', 'Peter Bird', '0987654321', 'kigosipil@mailinator.com', 'Consequat Quis accu'),
(9, 'Class Room Of The Elite 11-18', '1450.00', 3, '4350.00', '2024-04-05 17:39:46', 'Out For Delivery', 'Dai Russo', '2134567890', 'riwugirara@mailinator.com', 'Sit est laudantium'),
(10, 'Jujitsu Kaisen 12-26', '2500.00', 4, '10000.00', '2024-04-05 17:40:19', 'Delivered', 'Wilma Carver', '7890654321', 'sobenop@mailinator.com', 'Non est dicta commo'),
(11, 'One Piece 1000-1087', '999.00', 1, '999.00', '2024-04-05 17:40:59', 'Cancelled', 'Jessamine Strickland', '5432167890', 'rota@mailinator.com', 'Odit eius cupiditate'),
(12, 'Berserk 1-10', '1000.00', 1, '1000.00', '2024-04-05 18:00:33', 'Out For Delivery', 'Winter Mann', '3214678509', 'jisokedagi@mailinator.com', 'Rem delectus earum ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_manga`
--
ALTER TABLE `tbl_manga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_manga_volumes`
--
ALTER TABLE `tbl_manga_volumes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_manga`
--
ALTER TABLE `tbl_manga`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_manga_volumes`
--
ALTER TABLE `tbl_manga_volumes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
