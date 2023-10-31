-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 31, 2023 at 04:31 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinevotingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate_details`
--

DROP TABLE IF EXISTS `candidate_details`;
CREATE TABLE IF NOT EXISTS `candidate_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `election_id` int DEFAULT NULL,
  `candidate_name` varchar(255) DEFAULT NULL,
  `candidate_details` text,
  `candidate_photo` text,
  `inserted_by` varchar(255) DEFAULT NULL,
  `inserted_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `candidate_details`
--

INSERT INTO `candidate_details` (`id`, `election_id`, `candidate_name`, `candidate_details`, `candidate_photo`, `inserted_by`, `inserted_on`) VALUES
(2, 10, 'mandeep singh', '28 year old', '../assets/images/add-candidates/72607401122mandeep singh.jpg', 'admin@gmail.com', '2023-10-19'),
(4, 10, 'subham pawar', '29 year old', '../assets/images/add-candidates/47704221983shubham-pawar-SanJsOPdLtU-unsplash.jpg', 'admin@gmail.com', '2023-10-19');

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

DROP TABLE IF EXISTS `elections`;
CREATE TABLE IF NOT EXISTS `elections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `election_topic` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `starting_date` date DEFAULT NULL,
  `ending_date` date DEFAULT NULL,
  `status` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_of_candidates` int DEFAULT NULL,
  `inserted_by` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `election_topic`, `starting_date`, `ending_date`, `status`, `no_of_candidates`, `inserted_by`, `inserted_on`) VALUES
(10, 'class leader', '2023-10-14', '2023-10-14', 'Expired', 2, 'admin@gmail.com', '2023-10-13'),
(18, 'tommorow', '2023-11-02', '2023-11-04', 'Active', 2, 'admin@gmail.com', '2023-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_no` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_general_ci,
  `user_role` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email_id`, `phone_no`, `password`, `user_role`) VALUES
(4, 'krish@gmail.com', '32323', '34c5495e71431f37620acacfd1cae0b39d88f778', 'voter'),
(5, 'admin@gmail.com', '2123', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin'),
(6, 'user1@gmail.com', '32344', 'b3daa77b4c04a9551b8781d03191fe098f325e67', 'voter');

-- --------------------------------------------------------

--
-- Table structure for table `votings`
--

DROP TABLE IF EXISTS `votings`;
CREATE TABLE IF NOT EXISTS `votings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `election_id` int DEFAULT NULL,
  `voters_id` int DEFAULT NULL,
  `candidate_id` int DEFAULT NULL,
  `vote_date` date DEFAULT NULL,
  `vote_time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `votings`
--

INSERT INTO `votings` (`id`, `election_id`, `voters_id`, `candidate_id`, `vote_date`, `vote_time`) VALUES
(9, 10, 6, 4, '2023-10-29', '06:07:23'),
(8, 10, 4, 2, '2023-10-29', '06:05:23');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
