-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 14, 2022 at 06:54 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `compawnion_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `community_posts_tb`
--

CREATE TABLE `community_posts_tb` (
  `id` int(11) NOT NULL,
  `eventName` varchar(1000) DEFAULT NULL,
  `eventDate` varchar(100) DEFAULT NULL,
  `eventLocation` varchar(1000) DEFAULT NULL,
  `eventDesc` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_posts_tb`
--

INSERT INTO `community_posts_tb` (`id`, `eventName`, `eventDate`, `eventLocation`, `eventDesc`) VALUES
(3, 'Christmas Party', 'Dec 25, 2022; 10:00 AM', 'Pampanga', 'asdfa fsadf sdf sdfg sdg dgs df');

-- --------------------------------------------------------

--
-- Table structure for table `posts_tb`
--

CREATE TABLE `posts_tb` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `imageLink` varchar(1000) DEFAULT NULL,
  `petName` varchar(70) DEFAULT NULL,
  `petClass` varchar(70) DEFAULT NULL,
  `petBreed` varchar(70) DEFAULT NULL,
  `petSex` varchar(70) DEFAULT NULL,
  `petAge` varchar(70) DEFAULT NULL,
  `petDesc` varchar(70) DEFAULT NULL,
  `reason` varchar(70) DEFAULT NULL,
  `reports` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts_tb`
--

INSERT INTO `posts_tb` (`id`, `username`, `imageLink`, `petName`, `petClass`, `petBreed`, `petSex`, `petAge`, `petDesc`, `reason`, `reports`) VALUES
(4, 'rZulan', 'database/post_images/rZulan_6397ba286cd807.34612338.png', 'Lambing', 'Toyota', '4 Door', 'Virgin', '2', 'Black konting gasgas', 'walang garahe', 0),
(5, 'rZulan', 'database/post_images/rZulan_6397bbd991d2b8.28355276.jpeg', 'Hayxszt', 'Toyota', 'Vios', '5', '1', 'Gasgas sa harap', 'wala ding garahe', 0),
(6, 'rZulan', 'database/post_images/rZulan_6397bcb6852752.13476430.jpeg', 'Zabrina', 'Zebra', 'Bulldug', 'Male', '21', 'Masungit', 'Masungit', 0),
(7, 'rZulan', 'database/post_images/rZulan_6397bd1ce2afd9.64983152.jpeg', 'Shaq', 'F*kboi', 'Askal', 'Marami', '31', 'Pogi', 'Libot ng libot', 1),
(11, 'gab', 'database/post_images/gab_6399d1ddd82024.63020245.jpg', 'Randy', 'Pusa', 'yes', 'Female', '12', 'wdfsdg dfg sd', 'sg fg dsfg dsf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reported_posts_tb`
--

CREATE TABLE `reported_posts_tb` (
  `id` int(11) NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `reportedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reported_posts_tb`
--

INSERT INTO `reported_posts_tb` (`id`, `postId`, `reportedBy`) VALUES
(7, 7, 'gab');

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE `users_tb` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `contact` varchar(16) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telegram` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `accountType` varchar(10) DEFAULT NULL,
  `verificationCode` varchar(7) DEFAULT NULL,
  `isVerified` varchar(7) DEFAULT NULL,
  `verifiedAt` varchar(100) DEFAULT NULL,
  `hasPfp` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_tb`
--

INSERT INTO `users_tb` (`id`, `username`, `password`, `fullname`, `contact`, `email`, `telegram`, `twitter`, `facebook`, `accountType`, `verificationCode`, `isVerified`, `verifiedAt`, `hasPfp`) VALUES
(1, 'admin', 'admin', 'Admin', '0', 'no@email.com', 'na', 'na', 'na', 'admin', NULL, 'true', '2022-12-12 11:09:34', NULL),
(3, 'kerby', 'kerby', 'kerby', '12432', 'kerby@gmail.com', '', '', '', 'user', NULL, 'false', '', 'false'),
(4, 'kk', 'kk', 'kk', '234', 'kk@kk.k', '', '', '', 'user', NULL, 'false', '', 'false'),
(5, 'rZulan', 'nafzen-mykqob-3Zyfja', 'Zulan', '9', 'roi.zulan@gmail.com', 'wala', 'wala', 'wala', 'user', NULL, 'false', '', 'false'),
(6, 'kerbs', 'kerbs', 'Kerby', 'y8282', 'kerby@hshs.aj', 'jesj', '', '', 'user', NULL, 'false', '', 'true'),
(7, 'gg', 'gg', 'Gg', '7272', 'gg@gg.g', '', '', '', 'user', NULL, 'false', '', 'true'),
(8, 'gaba', 'asd', 'sad', '1248973289', 'gabrielcastillo8722564@gmail.coma', '', '', '', 'user', NULL, 'false', '', 'false'),
(9, 'xamp', '1234', 'xamp', 'sad', 'as@as', '', '', '', 'user', NULL, 'false', '', 'true'),
(10, 'qq', '123', 'qq', '213', 'qq@qq.q', '', '', '', 'user', NULL, 'false', '', 'false'),
(13, 'gab', 'ken', 'Gabriel', '8292', 'gabrielcastillo8722564@gmail.com', 'hsjs', 'jsjs', '', 'user', '160945', 'true', '2022-12-14 13:39:54', 'true'),
(14, 'something', 'qwe', 'Something', '123', 'bonav95489@areosur.com', '', '', '', 'user', '413566', 'true', '2022-12-14 16:38:59', 'false');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `community_posts_tb`
--
ALTER TABLE `community_posts_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts_tb`
--
ALTER TABLE `posts_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reported_posts_tb`
--
ALTER TABLE `reported_posts_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `community_posts_tb`
--
ALTER TABLE `community_posts_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts_tb`
--
ALTER TABLE `posts_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reported_posts_tb`
--
ALTER TABLE `reported_posts_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
