-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2016 at 02:30 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `studID` int(11) NOT NULL,
  `subjectCode` varchar(10) NOT NULL,
  `att` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`studID`, `subjectCode`, `att`) VALUES
(2, 'DA603', 60),
(2, 'DADA123', 13),
(2, 'DU212', 34),
(5, 'TR123', 56),
(5, 'TR212', 45),
(5, 'TR603', 21),
(6, 'PO123', 72),
(6, 'PO212', 11),
(6, 'PO603', 89);

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `studID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dept` varchar(30) NOT NULL,
  `section` varchar(2) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`studID`, `name`, `dept`, `section`, `semester`, `ID`) VALUES
(2, 'Princess Consuella Bananahammock', 'Defense', 'B', 'Third', 1),
(5, 'Harry Potter', 'Transfiguration', 'B', 'Second', 3),
(6, 'Draco Malfoy', 'Potions', 'B', 'Second', 4);

-- --------------------------------------------------------

--
-- Table structure for table `studroutine`
--

CREATE TABLE `studroutine` (
  `dept` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `section` varchar(10) NOT NULL,
  `day` varchar(20) NOT NULL,
  `p1` varchar(10) DEFAULT NULL,
  `p2` varchar(10) DEFAULT NULL,
  `p3` varchar(10) DEFAULT NULL,
  `p4` varchar(10) DEFAULT NULL,
  `p5` varchar(10) DEFAULT NULL,
  `p6` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studroutine`
--

INSERT INTO `studroutine` (`dept`, `semester`, `section`, `day`, `p1`, `p2`, `p3`, `p4`, `p5`, `p6`) VALUES
('Defense', 'Third', 'B', 'Friday', 'DA603', 'DU212', 'DADA123', 'DADA123', 'DA603', 'DU212'),
('Defense', 'Third', 'B', 'Monday', 'DADA123', 'DA603', 'DU212', 'DADA123', 'DA603', 'DU212'),
('Defense', 'Third', 'B', 'Thursday', 'DADA123', 'DA603', 'DADA123', 'DU212', 'DA603', 'DU212'),
('Defense', 'Third', 'B', 'Tuesday', 'DA603', 'DADA123', 'DU212', 'DADA123', 'DA603', 'DU212'),
('Defense', 'Third', 'B', 'Wednesday', 'DADA123', 'DU212', 'DADA123', 'DA603', 'DA603', 'DU212'),
('Potions', 'Second', 'B', 'Friday', 'PO603', 'PO212', 'PO123', 'PO123', 'PO603', 'PO212'),
('Potions', 'Second', 'B', 'Monday', 'PO123', 'PO603', 'PO212', 'PO123', 'PO603', 'PO212'),
('Potions', 'Second', 'B', 'Thursday', 'PO123', 'PO603', 'PO123', 'PO212', 'PO603', 'PO212'),
('Potions', 'Second', 'B', 'Tuesday', 'PO603', 'PO123', 'PO212', 'PO123', 'PO603', 'PO212'),
('Potions', 'Second', 'B', 'Wednesday', 'PO123', 'PO212', 'PO123', 'PO603', 'PO603', 'PO212'),
('Transfiguration', 'Second', 'B', 'Friday', 'TR603', 'TR212', 'TR123', 'TR123', 'TR603', 'TR212'),
('Transfiguration', 'Second', 'B', 'Monday', 'TR123', 'TR603', 'TR212', 'TR123', 'TR603', 'TR212'),
('Transfiguration', 'Second', 'B', 'Thursday', 'TR123', 'TR603', 'TR123', 'TR212', 'TR603', 'TR212'),
('Transfiguration', 'Second', 'B', 'Tuesday', 'TR603', 'TR123', 'TR212', 'TR123', 'TR603', 'TR212'),
('Transfiguration', 'Second', 'B', 'Wednesday', 'TR123', 'TR212', 'TR123', 'TR603', 'TR603', 'TR212');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subCode` varchar(10) NOT NULL,
  `subName` varchar(10) NOT NULL,
  `dept` varchar(20) NOT NULL,
  `semester` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subCode`, `subName`, `dept`, `semester`) VALUES
('DA603', 'Familiaris', 'Defense', 'Third'),
('DADA123', 'Defence Ag', 'Defense', 'Third'),
('DU212', 'The Unforg', 'Defence', 'Third'),
('PO123', 'Basics of ', 'Potions', 'Second'),
('PO212', 'Potions of', 'Potions', 'Second'),
('PO603', 'Advanced P', 'Potions', 'Second'),
('TR123', 'Basics of ', 'Transfiguration', 'Second'),
('TR212', 'Limitation', 'Transfiguration', 'Second'),
('TR603', 'Metamorphm', 'Transfiguration', 'Second');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `pass`, `role`) VALUES
(1, 'Gilderoy', 'iamawesome', 'faculty'),
(2, 'PrincessConsuella', 'bananahammock', 'student'),
(5, 'harry', 'abc', 'student'),
(6, 'draco', 'def', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`studID`,`subjectCode`),
  ADD KEY `subjectCode` (`subjectCode`);

--
-- Indexes for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id` (`studID`);

--
-- Indexes for table `studroutine`
--
ALTER TABLE `studroutine`
  ADD PRIMARY KEY (`dept`,`semester`,`section`,`day`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subCode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `studentdetails`
--
ALTER TABLE `studentdetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`studID`) REFERENCES `studentdetails` (`studID`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`subCode`);

--
-- Constraints for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD CONSTRAINT `studentdetails_ibfk_1` FOREIGN KEY (`studID`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
