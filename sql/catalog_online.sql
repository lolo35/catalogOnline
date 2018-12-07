-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2018 at 02:51 PM
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
(3, 'Sirbu Ramona', 3, '2-B', 'Str. Mocionilor', '[privat]'),
(4, 'Sirbu Ramona', 4, '2-B', 'Str. Mocionilor', '[privat]'),
(5, 'Ion Bumbu', 5, '2-B', 'Str. Mocionilor', '[privat]'),
(6, 'Gheorghe Ventil', 6, '2-B', 'Str. Mocionilor', '[privat]'),
(7, 'Super Man', 7, '2-B', 'Str. Mocionilor', '[privat]'),
(8, 'Chris P. Bacon', 8, '2-B', 'Str. Mocionilor', '[privat]'),
(9, 'Mike Litoris', 9, '2-B', 'Str. Mocionilor', '[privat]'),
(10, 'Paul Twocock', 10, '2-B', 'Str. Mocionilor', '[privat]'),
(11, 'Dick Long', 11, '2-B', 'Str. Mocionilor', '[privat]'),
(12, 'Saad Maan', 12, '2-B', 'Str. Mocionilor', '[privat]'),
(13, 'Strut Modest', 13, '2-B', 'Str. Mocionilor', '[privat]'),
(14, 'Randunel Pisica\r\n', 14, '2-B', 'Str. Mocionilor', '[privat]'),
(15, 'Cojocaru Tom-Mac-Bil-Bob-Constantin', 15, '2-A', 'Str. Mocionilor', '[privat]');

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
(1, 1, '2018-11-06', 'Istorie', 9, '2', ''),
(2, 1, '2018-11-07', 'Istorie', 6, '1', 'pentru ca e bun de dracu asta...'),
(4, 1, '2018-11-07', 'Istorie', 9, '1', 'regtfds'),
(6, 3, '2018-11-07', 'Istorie', 11, '1', ''),
(7, 1, '2018-11-13', 'Istorie', 7, '1', 'bun de dracu asta...'),
(8, 1, '2018-11-26', 'Istorie', 10, '1', ''),
(9, 1, '2018-11-26', 'Istorie', 9, '1', ''),
(12, 4, '2018-11-28', 'Istorie', 7, '1', ''),
(13, 5, '2018-12-01', 'Istorie', 9, '1', ''),
(14, 5, '2018-12-01', 'Istorie', 2, '1', ''),
(16, 3, '2018-12-06', 'Istorie', 5, '1', ''),
(17, 3, '2018-12-06', 'Istorie', 6, '1', ''),
(18, 3, '2018-12-06', 'Istorie', 3, '1', ''),
(19, 4, '2018-12-06', 'Istorie', 7, '1', ''),
(20, 6, '2018-12-06', 'Istorie', 6, '1', ''),
(21, 6, '2018-12-06', 'Istorie', 2, '1', '');

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
(16, 'Sirbu Ramona', 3, 'Istorie', '2018-11-06', 0),
(17, 'Filimon Raul', 1, 'Istorie', '2018-11-06', 1),
(18, 'Filimon Raul', 1, 'Istorie', '2018-11-07', 1),
(19, 'Sirbu Ramona', 3, 'Istorie', '2018-11-07', 0),
(20, 'Filimon Andreea', 2, 'Istorie', '2018-11-07', 1),
(21, 'Filimon Raul', 1, 'Istorie', '2018-11-09', 1),
(22, 'Sirbu Ramona', 3, 'Istorie', '2018-11-09', 0),
(23, 'Filimon Raul', 1, 'Istorie', '2018-11-10', 1),
(24, 'Filimon Raul', 1, 'Istorie', '2018-11-13', 1),
(25, 'Filimon Raul', 1, 'Istorie', '2018-11-15', 1),
(26, 'Filimon Raul', 1, 'Istorie', '2018-11-26', 1),
(27, 'Sirbu Ramona', 3, 'Istorie', '2018-11-26', 0),
(38, 'Filimon Raul', 1, 'Istorie', '2018-11-28', 1),
(39, 'Sirbu Ramona', 3, 'Istorie', '2018-11-28', 1),
(40, 'Sirbu Ramona', 4, 'Istorie', '2018-11-28', 1),
(41, 'Sirbu Ramona', 3, 'Istorie', '2018-11-29', 1),
(42, 'Sirbu Ramona', 4, 'Istorie', '2018-11-29', 1),
(43, 'Filimon Raul', 1, 'Istorie', '2018-11-29', 1),
(44, 'Filimon Raul', 1, 'Istorie', '2018-11-30', 1),
(45, 'Sirbu Ramona', 4, 'Istorie', '2018-11-30', 1),
(46, 'Sirbu Ramona', 3, 'Istorie', '2018-11-30', 1),
(47, 'Filimon Raul', 1, 'Istorie', '2018-12-01', 1),
(48, 'Sirbu Ramona', 3, 'Istorie', '2018-12-01', 1),
(49, 'Sirbu Ramona', 4, 'Istorie', '2018-12-01', 1),
(50, 'Ion Bumbu', 5, 'Istorie', '2018-12-01', 1),
(51, 'Gheorghe Ventil', 6, 'Istorie', '2018-12-01', 1),
(52, 'Super Man', 7, 'Istorie', '2018-12-01', 1),
(53, 'Chris P. Bacon', 8, 'Istorie', '2018-12-01', 1),
(54, 'Mike Litoris', 9, 'Istorie', '2018-12-01', 1),
(55, 'Paul Twocock', 10, 'Istorie', '2018-12-01', 1),
(56, 'Dick Long', 11, 'Istorie', '2018-12-01', 1),
(57, 'Saad Maan', 12, 'Istorie', '2018-12-01', 1),
(58, 'Strut Modest', 13, 'Istorie', '2018-12-01', 1),
(59, 'Randunel Pisica\r\n\r\n', 14, 'Istorie', '2018-12-01', 1),
(60, 'Filimon Raul', 1, 'Istorie', '2018-12-02', 1),
(61, 'Ion Bumbu', 5, 'Istorie', '2018-12-02', 1),
(62, 'Sirbu Ramona', 4, 'Istorie', '2018-12-02', 1),
(63, 'Chris P. Bacon', 8, 'Istorie', '2018-12-02', 1),
(64, 'Sirbu Ramona', 3, 'Istorie', '2018-12-02', 1),
(65, 'Super Man', 7, 'Istorie', '2018-12-02', 1),
(66, 'Mike Litoris', 9, 'Istorie', '2018-12-02', 1),
(67, 'Gheorghe Ventil', 6, 'Istorie', '2018-12-02', 1),
(68, 'Paul Twocock', 10, 'Istorie', '2018-12-02', 1),
(69, 'Dick Long', 11, 'Istorie', '2018-12-02', 1),
(70, 'Saad Maan', 12, 'Istorie', '2018-12-02', 1),
(71, 'Strut Modest', 13, 'Istorie', '2018-12-02', 1),
(72, 'Randunel Pisica\r\n\r\n', 14, 'Istorie', '2018-12-02', 1),
(73, 'Super Man', 7, 'Istorie', '2018-12-03', 1),
(74, 'Ion Bumbu', 5, 'Istorie', '2018-12-03', 1),
(75, 'Filimon Raul', 1, 'Istorie', '2018-12-03', 1),
(76, 'Gheorghe Ventil', 6, 'Istorie', '2018-12-03', 1),
(77, 'Sirbu Ramona', 4, 'Istorie', '2018-12-03', 1),
(78, 'Sirbu Ramona', 3, 'Istorie', '2018-12-03', 1),
(79, 'Chris P. Bacon', 8, 'Istorie', '2018-12-03', 1),
(80, 'Mike Litoris', 9, 'Istorie', '2018-12-03', 1),
(81, 'Paul Twocock', 10, 'Istorie', '2018-12-03', 1),
(82, 'Dick Long', 11, 'Istorie', '2018-12-03', 1),
(83, 'Saad Maan', 12, 'Istorie', '2018-12-03', 1),
(84, 'Strut Modest', 13, 'Istorie', '2018-12-03', 1),
(85, 'Randunel Pisica\r\n\r\n', 14, 'Istorie', '2018-12-03', 1),
(86, 'Filimon Andreea', 2, 'Istorie', '2018-12-03', 0),
(87, 'Cojocaru Tom-Mac-Bil-Bob-Constantin', 15, 'Istorie', '2018-12-03', 0),
(88, 'Filimon Raul', 1, 'Istorie', '2018-12-04', 1),
(89, 'Sirbu Ramona', 3, 'Istorie', '2018-12-04', 0),
(90, 'Ion Bumbu', 5, 'Istorie', '2018-12-04', 1),
(91, 'Super Man', 7, 'Istorie', '2018-12-04', 0),
(92, 'Sirbu Ramona', 4, 'Istorie', '2018-12-04', 1),
(93, 'Gheorghe Ventil', 6, 'Istorie', '2018-12-04', 1),
(94, 'Chris P. Bacon', 8, 'Istorie', '2018-12-04', 1),
(95, 'Mike Litoris', 9, 'Istorie', '2018-12-04', 1),
(96, 'Paul Twocock', 10, 'Istorie', '2018-12-04', 1),
(97, 'Dick Long', 11, 'Istorie', '2018-12-04', 1),
(98, 'Saad Maan', 12, 'Istorie', '2018-12-04', 1),
(99, 'Strut Modest', 13, 'Istorie', '2018-12-04', 1),
(100, 'Randunel Pisica\r\n', 14, 'Istorie', '2018-12-04', 1),
(101, 'Filimon Raul', 1, 'Istorie', '2018-12-05', 1),
(102, 'Ion Bumbu', 5, 'Istorie', '2018-12-05', 1),
(103, 'Gheorghe Ventil', 6, 'Istorie', '2018-12-05', 1),
(104, 'Sirbu Ramona', 4, 'Istorie', '2018-12-05', 1),
(105, 'Super Man', 7, 'Istorie', '2018-12-05', 1),
(106, 'Sirbu Ramona', 3, 'Istorie', '2018-12-05', 1),
(107, 'Chris P. Bacon', 8, 'Istorie', '2018-12-05', 1),
(108, 'Mike Litoris', 9, 'Istorie', '2018-12-05', 1),
(109, 'Paul Twocock', 10, 'Istorie', '2018-12-05', 1),
(110, 'Dick Long', 11, 'Istorie', '2018-12-05', 1),
(111, 'Saad Maan', 12, 'Istorie', '2018-12-05', 1),
(112, 'Strut Modest', 13, 'Istorie', '2018-12-05', 1),
(113, 'Randunel Pisica\r\n', 14, 'Istorie', '2018-12-05', 1),
(114, 'Gheorghe Ventil', 6, 'Istorie', '2018-12-06', 1),
(115, 'Super Man', 7, 'Istorie', '2018-12-06', 1),
(116, 'Sirbu Ramona', 3, 'Istorie', '2018-12-06', 1),
(117, 'Ion Bumbu', 5, 'Istorie', '2018-12-06', 0),
(118, 'Filimon Raul', 1, 'Istorie', '2018-12-06', 1),
(119, 'Sirbu Ramona', 4, 'Istorie', '2018-12-06', 1),
(120, 'Chris P. Bacon', 8, 'Istorie', '2018-12-06', 1),
(121, 'Mike Litoris', 9, 'Istorie', '2018-12-06', 1),
(122, 'Paul Twocock', 10, 'Istorie', '2018-12-06', 1),
(123, 'Dick Long', 11, 'Istorie', '2018-12-06', 1),
(124, 'Saad Maan', 12, 'Istorie', '2018-12-06', 1),
(125, 'Strut Modest', 13, 'Istorie', '2018-12-06', 1),
(126, 'Randunel Pisica\r\n', 14, 'Istorie', '2018-12-06', 1),
(127, 'Filimon Raul', 1, 'Istorie', '2018-12-07', 1),
(128, 'Sirbu Ramona', 3, 'Istorie', '2018-12-07', 1),
(129, 'Super Man', 7, 'Istorie', '2018-12-07', 1),
(130, 'Ion Bumbu', 5, 'Istorie', '2018-12-07', 1),
(131, 'Gheorghe Ventil', 6, 'Istorie', '2018-12-07', 1),
(132, 'Sirbu Ramona', 4, 'Istorie', '2018-12-07', 1),
(133, 'Chris P. Bacon', 8, 'Istorie', '2018-12-07', 1),
(134, 'Mike Litoris', 9, 'Istorie', '2018-12-07', 1),
(135, 'Paul Twocock', 10, 'Istorie', '2018-12-07', 1),
(136, 'Dick Long', 11, 'Istorie', '2018-12-07', 1),
(137, 'Saad Maan', 12, 'Istorie', '2018-12-07', 1),
(138, 'Strut Modest', 13, 'Istorie', '2018-12-07', 1),
(139, 'Randunel Pisica\r\n', 14, 'Istorie', '2018-12-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `type` varchar(4) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `pass`, `salt`, `type`, `email`) VALUES
(1, 1, 'raul filimon', '62432d49db8de46b9a4d367c28a14856c25723132f646ee3221f525b1389a75ff6e3783ef97a32c40fc0e9742515d6e490592c68c71b7064c776d8d9abae8d19', 'Y93f2173739d5a6260343c2e4d386c02', '', ''),
(2, 16, 'valentin.nila', 'c2e6b00f75cec26a22272fde49a3b56d24911469fb33161fac47d59b7ce791bea6edd7bc3f27fedc3b6b73e90ba4c632e8c47d64427e8c00b0d1217f9fba775c', 'S0037f3b21bd40dedb674d05438e5982', '', '');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `elevi`
--
ALTER TABLE `elevi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ore`
--
ALTER TABLE `ore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `prezenta`
--
ALTER TABLE `prezenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
