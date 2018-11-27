-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2018 at 09:52 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catalog_online`
--
CREATE DATABASE IF NOT EXISTS `catalog_online` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `catalog_online`;

-- --------------------------------------------------------

--
-- Table structure for table `elevi`
--

CREATE TABLE `elevi` (
  `id` int(11) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `clasa` varchar(10) NOT NULL,
  `adresa` text NOT NULL,
  `nr_tel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `elevi`
--

INSERT INTO `elevi` (`id`, `nume`, `user_id`, `clasa`, `adresa`, `nr_tel`) VALUES
(1, 'Filimon Raul', 1, '2-B', 'Str. fdt. Crisan nr 1', '0735123456'),
(2, 'Filimon Andreea', 2, '5-A', 'the nut house', 'don\'t call me'),
(3, 'Sirbu Ramona', 3, '2-B', 'Str. Mocionilor', '[privat]');

-- --------------------------------------------------------

--
-- Table structure for table `istorie`
--

CREATE TABLE `istorie` (
  `id` int(11) NOT NULL,
  `clasa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `istorie`
--

INSERT INTO `istorie` (`id`, `clasa`) VALUES
(1, '2-B'),
(2, '5-A'),
(3, '2-A'),
(4, '3-A'),
(5, '3-C'),
(6, '6-C');

-- --------------------------------------------------------

--
-- Table structure for table `left_menu`
--

CREATE TABLE `left_menu` (
  `id` int(11) NOT NULL,
  `menuItem` text NOT NULL,
  `favicon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `left_menu`
--

INSERT INTO `left_menu` (`id`, `menuItem`, `favicon`) VALUES
(1, 'Pagina Principala', '<i class=\"fas fa-home\" style=\"color: white;\"></i>'),
(2, 'Situatie corigente', '<i class=\"fas fa-user-times\" style=\"color: white;\"></i>'),
(3, 'Situatie absente', '<i class=\"fas fa-user-slash\" style=\"color: white;\"></i>'),
(4, 'Grafic prezenta', '<i class=\"fas fa-chart-bar\" style=\"color: white;\"></i>');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `ora` varchar(255) NOT NULL,
  `nota` int(11) NOT NULL,
  `tip_nota` varchar(100) NOT NULL,
  `comentarii` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `user_id`, `date`, `ora`, `nota`, `tip_nota`, `comentarii`) VALUES
(1, 1, '2018-11-06', 'Istorie', 9, 'normala', ''),
(2, 1, '2018-11-07', 'Istorie', 8, 'normala', ''),
(4, 1, '2018-11-07', 'Istorie', 10, '', ''),
(6, 3, '2018-11-07', 'Istorie', 11, '', ''),
(7, 1, '2018-11-13', 'Istorie', 7, '', 'bun de dracu asta...'),
(8, 1, '2018-11-26', 'Istorie', 10, '', ''),
(9, 1, '2018-11-26', 'Istorie', 9, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ore`
--

CREATE TABLE `ore` (
  `id` int(11) NOT NULL,
  `materie` varchar(255) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ore`
--

INSERT INTO `ore` (`id`, `materie`, `comments`) VALUES
(6, 'Istorie', 'test'),
(7, 'Matematica', 'test 2'),
(8, 'Fizica', 'test 2'),
(9, 'Chimie', 'test 2'),
(10, 'Biologie', 'test 2'),
(11, 'Desen', 'test 2'),
(12, 'Engleza', 'test 2'),
(13, 'Franceza', 'test 2'),
(14, 'Geografie', 'test 2'),
(15, 'Germana', 'test 2'),
(16, 'Informatica', 'test 2'),
(17, 'Latina', 'test 2'),
(18, 'Microbiologie', 'test 2'),
(19, 'Muzica', 'test 2'),
(20, 'Religie', 'test 2'),
(21, 'Romana', 'test 2'),
(22, 'Sport', 'test 2'),
(23, 'Ed.Tehnologica', 'test 2'),
(24, 'Cultura civica', 'test 2'),
(25, 'Dirigentie', 'test 2');

-- --------------------------------------------------------

--
-- Table structure for table `prezenta`
--

CREATE TABLE `prezenta` (
  `id` int(11) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ora` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `prezenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prezenta`
--

INSERT INTO `prezenta` (`id`, `nume`, `user_id`, `ora`, `date`, `prezenta`) VALUES
(1, 'Filimon Raul', 0, 'Istorie', '2018-11-01', 1),
(11, 'Filimon Raul', 0, 'Istorie', '2018-11-05', 1),
(12, 'Sirbu Ramona', 0, 'Istorie', '2018-11-05', 1),
(13, 'Filimon Raul', 0, 'Istorie', '2018-11-06', 1),
(14, 'Sirbu Ramona', 0, 'Istorie', '2018-11-06', 1),
(16, 'Sirbu Ramona', 3, 'Istorie', '2018-11-06', 1),
(17, 'Filimon Raul', 1, 'Istorie', '2018-11-06', 1),
(18, 'Filimon Raul', 1, 'Istorie', '2018-11-07', 1),
(19, 'Sirbu Ramona', 3, 'Istorie', '2018-11-07', 1),
(20, 'Filimon Andreea', 2, 'Istorie', '2018-11-07', 1),
(21, 'Filimon Raul', 1, 'Istorie', '2018-11-09', 1),
(22, 'Sirbu Ramona', 3, 'Istorie', '2018-11-09', 1),
(23, 'Filimon Raul', 1, 'Istorie', '2018-11-10', 1),
(24, 'Filimon Raul', 1, 'Istorie', '2018-11-13', 1),
(25, 'Filimon Raul', 1, 'Istorie', '2018-11-15', 1),
(26, 'Filimon Raul', 1, 'Istorie', '2018-11-26', 1),
(27, 'Sirbu Ramona', 3, 'Istorie', '2018-11-26', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `elevi`
--
ALTER TABLE `elevi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `istorie`
--
ALTER TABLE `istorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `left_menu`
--
ALTER TABLE `left_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ore`
--
ALTER TABLE `ore`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prezenta`
--
ALTER TABLE `prezenta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `elevi`
--
ALTER TABLE `elevi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `istorie`
--
ALTER TABLE `istorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `left_menu`
--
ALTER TABLE `left_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ore`
--
ALTER TABLE `ore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `prezenta`
--
ALTER TABLE `prezenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
