-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2024 at 10:42 PM
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
-- Database: `lesafre`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_name` varchar(100) NOT NULL,
  `users_login` varchar(100) NOT NULL,
  `users_password` varchar(30) NOT NULL,
  `users_email` varchar(100) NOT NULL,
  `users_acces` tinyint(4) NOT NULL,
  `users_admin` tinyint(1) NOT NULL DEFAULT 0,
  `users_provider` tinyint(1) NOT NULL DEFAULT 0,
  `users_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_name`, `users_login`, `users_password`, `users_email`, `users_acces`, `users_admin`, `users_provider`, `users_create`) VALUES
(1, 'wael', '324234', '', 'wael@gmail.com', 2, 1, 0, '2024-07-26 22:58:02'),
(3, 'nadia', 'nadia13', '8cb2237d0679ca88db6464eac60da9', 'nadia@gmail.com', 2, 1, 1, '2024-07-27 16:20:54'),
(4, 'nadia', 'nadia13', 'f0ea7b0a45adea0c4b3ce8d148ac7f', 'nadia1@gmail.com', 2, 1, 1, '2024-07-27 16:27:39'),
(5, 'nadia', 'nadia13', '8cb2237d0679ca88db6464eac60da9', 'nadia22@gmail.com', 2, 1, 1, '2024-07-30 22:12:52'),
(6, 'nadia', 'nadia13', '8cb2237d0679ca88db6464eac60da9', 'nadia33@gmail.com', 2, 1, 1, '2024-07-30 22:37:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `users_email` (`users_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
