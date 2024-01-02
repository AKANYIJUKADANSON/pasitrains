-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 05:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `reg_no` varchar(100) NOT NULL,
  `course` varchar(200) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `employer` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `postalAddress` varchar(50) NOT NULL,
  `profilePicture` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `reg_date` varchar(50) NOT NULL,
  `verify_token` int(50) NOT NULL,
  `applicationStatus` int(10) NOT NULL DEFAULT 0,
  `emailVerifStatus` int(10) NOT NULL DEFAULT 0,
  `approvedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `firstName`, `middleName`, `lastName`, `reg_no`, `course`, `duration`, `start_date`, `dob`, `gender`, `employer`, `country`, `city`, `postalAddress`, `profilePicture`, `email`, `phone`, `reg_date`, `verify_token`, `applicationStatus`, `emailVerifStatus`, `approvedBy`) VALUES
(31, 'Kiconco', 'John', 'Doe', '23/TR/RAMT/1213141231', 'Records & Archives Management Training', '4 Months', '2023-11-27', '2023-12-04', 'MALE', 'TotalEnergies', 'Uganda', 'KAMPALA', 'P.O. Box 1, Kyambogo', 'messages-3.jpg', 'akanyijuka1danson@gmail.com', '25677926446', '2023-12-13', 3866, 1, 1, 'JOHN PAUL PANDIYA'),
(32, 'AKANYIJUKA', '', 'DANSON', '23/TR/BPMD/1215195140', 'Business Process Management Training: Digitize Core Business Processes', '3 Months', '2024-02-05', '2023-12-04', 'MALE', 'TotalEnergies', 'Uganda', 'KAMPALA', 'P.O. Box 1, Kyambogo', 'cranimer.JPG', 'dantechx02@gmail.com', '0757542857', '2023-12-15', 3065, 1, 1, 'JOHN PAUL PANDIYA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
