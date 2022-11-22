-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2022 at 02:56 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE `dates` (
  `sdate` date DEFAULT NULL,
  `edate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`sdate`, `edate`) VALUES
('2022-03-02', '2022-03-12'),
('2022-03-02', '2022-03-12'),
('2022-03-02', '2022-03-02'),
('2022-03-02', '2022-03-02'),
('2022-03-03', '2022-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `table1`
--

CREATE TABLE `table1` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `category` varchar(150) DEFAULT NULL,
  `tm` time NOT NULL,
  `dates` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table1`
--

INSERT INTO `table1` (`id`, `name`, `num`, `category`, `tm`, `dates`) VALUES
(1, 'complete assignment', 12, 'home', '00:00:00', '2022-03-01 10:44:13'),
(2, 'complete exercise', 65, 'school', '00:00:00', '0000-00-00 00:00:00'),
(3, 'Working for plants', 5464, 'sports', '00:00:00', '0000-00-00 00:00:00'),
(5, 'sum of numbers', 12, 'sports', '00:39:07', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `table2`
--

CREATE TABLE `table2` (
  `id` int(11) NOT NULL,
  `category` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table2`
--

INSERT INTO `table2` (`id`, `category`) VALUES
(2, 'home'),
(3, 'school'),
(1, 'sports');

-- --------------------------------------------------------

--
-- Table structure for table `tbl1`
--

CREATE TABLE `tbl1` (
  `id` int(11) NOT NULL,
  `category` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl1`
--

INSERT INTO `tbl1` (`id`, `category`) VALUES
(1, 'Sports'),
(2, 'Home'),
(3, 'School'),
(4, 'Other'),
(5, 'Play'),
(6, 'relax');

-- --------------------------------------------------------

--
-- Table structure for table `tbl2`
--

CREATE TABLE `tbl2` (
  `id` int(11) NOT NULL,
  `checks` tinyint(1) DEFAULT NULL,
  `task` varchar(300) DEFAULT NULL,
  `tm` time DEFAULT NULL,
  `dt` date DEFAULT NULL,
  `category` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl2`
--

INSERT INTO `tbl2` (`id`, `checks`, `task`, `tm`, `dt`, `category`) VALUES
(1, 0, 'Complete maths homework', '10:00:00', '2022-03-02', 'School'),
(2, 0, 'Complete assignments', '12:00:00', '2022-03-11', 'Home'),
(3, 0, 'Swimming classes', '02:00:00', '2022-03-03', 'Sports'),
(4, 0, 'Visit zoo', '11:30:00', '2022-03-02', 'Home'),
(5, 0, 'Learn English and practice maths', '10:00:00', '2022-03-03', 'School'),
(6, 0, 'Visit friend\'s home ', '02:30:00', '2022-03-11', 'Home'),
(7, 0, 'will complete the history chapter 1', '21:12:00', '2022-03-03', 'School'),
(8, 0, 'badminton classes', '19:14:00', '2022-03-02', 'Sports'),
(9, 0, 'Complete all the tasks', '20:46:00', '2022-03-26', 'Other'),
(10, 0, 'Complete all the tasks', '18:47:00', '2022-03-12', 'School');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table1`
--
ALTER TABLE `table1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `table2`
--
ALTER TABLE `table2`
  ADD PRIMARY KEY (`category`);

--
-- Indexes for table `tbl1`
--
ALTER TABLE `tbl1`
  ADD PRIMARY KEY (`category`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tbl2`
--
ALTER TABLE `tbl2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `category` (`category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table1`
--
ALTER TABLE `table1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl1`
--
ALTER TABLE `tbl1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl2`
--
ALTER TABLE `tbl2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table1`
--
ALTER TABLE `table1`
  ADD CONSTRAINT `table1_ibfk_1` FOREIGN KEY (`category`) REFERENCES `table2` (`category`);

--
-- Constraints for table `tbl2`
--
ALTER TABLE `tbl2`
  ADD CONSTRAINT `tbl2_ibfk_1` FOREIGN KEY (`category`) REFERENCES `tbl1` (`category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
