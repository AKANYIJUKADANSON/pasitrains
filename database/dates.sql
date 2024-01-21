-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 06:35 PM
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
-- Table structure for table `dates`
--

CREATE TABLE `dates` (
  `id` int(7) NOT NULL,
  `initial` varchar(20) NOT NULL,
  `date` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `fees` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`id`, `initial`, `date`, `location`, `fees`) VALUES
(1, 'RMC', '19th - 23rd February', 'Nairobi', 1500),
(2, 'RMC', '15th-19th July', 'Mombasa', 1500),
(3, 'RMC', '25th-29th November', 'Dubai', 3500),
(4, 'IMRMSO', '27th-31st May', 'Nairobi', 1500),
(5, 'IMRMSO', '11th-15th November', 'Nairobi', 1500),
(6, 'ABCM', '25th -29th March', 'Ghana', 2500),
(7, 'ABCM', '06th -10th May', 'Uganda', 2500),
(8, 'ABCM', '26th -30th August', 'Nairobi', 2500),
(9, 'ABCM', '09-13th December', 'Uganda', 2500),
(10, 'TRM', '08th -12th April', 'Mombasa', 2500),
(11, 'TRM', '29th July-2nd August', 'Uganda', 2500),
(12, 'TRM', '28th Oct-01st November', 'Nairobi', 2500),
(13, 'ACG', '15th -19th July', 'Mombasa', 2500),
(14, 'ACG', '07th -11th October', 'Uganda', 2500),
(15, 'ACG', '11th -15th November', 'Nairobi', 2500),
(16, 'AOMEAS', '29th April-3rd May', 'Dubai', 3500),
(17, 'AOMEAS', '15th -19th July', 'Mombasa', 2500),
(18, 'AOMEAS', '09th-13th September', 'Mombasa', 2500),
(19, 'AOMEAS', '04th-08th November', 'Uganda', 2500),
(20, 'AOMEAS', '16th -20th December', 'Dubai', 3500),
(21, 'STM', '19th -23rd February', 'Nairobi', 1500),
(22, 'STM', '08th -12th April', 'Mombasa', 1500),
(23, 'STM', '24th-28th June', 'Nairobi', 1500),
(24, 'STM', '23rd -27th September', 'Dubai', 3500),
(25, 'STM', '25th -29th November', 'Dubai', 3500),
(26, 'AEDMS', '25th-29th March', 'Ghana', 3500),
(29, 'AEDMS', '27th -31st May', 'Nairobi', 2500),
(30, 'AEDMS', '12th -16th August', 'Uganda', 2500),
(31, 'AEDMS', '23rd -27th September', 'Dubai', 3500),
(32, 'AEDMS', '23rd-27th September', 'Uganda', 2500),
(33, 'AEDMS', '11th -15th November', 'Nairobi', 2500),
(34, 'AEDMS', '16th -20th December', 'Dubai', 3500),
(35, 'AEDMS', '16th-20th December', 'Uganda', 2500),
(36, 'ERAM', '24th-28th June', 'Nairobi', 1500),
(37, 'ERAM', '26th -30th August', 'Nairobi', 2000),
(38, 'ERAM', '07th -11th October', 'Uganda', 2000),
(39, 'ERAM', '16th -20th December', 'Dubai', 3500),
(40, 'EDMS', '25th-29th March ', 'Ghana', 3500),
(41, 'EDMS', '27th -31st May', 'Nairobi', 1500),
(42, 'EDMS', '29th July-2nd August', 'Uganda', 1500),
(43, 'EDMS', '09th -13th September', 'Mombasa', 2000),
(44, 'IFRS', '25th-29th March', 'Ghana', 3500),
(45, 'IFRS', '29th July-02nd August', 'Mombasa', 2000),
(46, 'IFRS', '09th -13th September', 'Zanzibar', 2000),
(47, 'IFRS', '04th -08th November', 'Uganda', 2000),
(48, 'IFRS', '09th - 13th December', 'Uganda', 2000),
(49, 'PSAS', '25th - 29th March ', 'Nigeria', 2500),
(50, 'PSAS', '24th - 28th June', 'Nairobi', 1500),
(51, 'PSAS', '25th - 19th November', 'Dubai', 3500),
(52, 'PSAS', '09th -13th December', 'Uganda', 1500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dates`
--
ALTER TABLE `dates`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
