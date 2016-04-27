-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2016 at 10:14 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `legistify`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `lawyerID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `DateOfAppointment` date NOT NULL,
  `status` enum('Fixed','Confirmed','Not accepted','') NOT NULL DEFAULT 'Fixed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lawyer`
--

CREATE TABLE IF NOT EXISTS `lawyer` (
  `lawyerId` int(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `experience` int(11) NOT NULL,
  `category` enum('Corporate','Public Defender','Civil Rights','') NOT NULL DEFAULT 'Corporate',
  `NonAvailablity` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lawyer`
--

INSERT INTO `lawyer` (`lawyerId`, `email`, `password`, `firstName`, `LastName`, `experience`, `category`, `NonAvailablity`) VALUES
(1, 'aakash2121995@yahoo.in', '12345', 'aakash', 'aggarwal', 12, 'Public Defender', '2016-05-27'),
(2, 'abc@ymail.com', '54321', 'akshat', 'mehra', 13, 'Corporate', '2016-05-18'),
(3, 'air@gmail.com', 'abcd', 'mnm', 'nmn', 5, 'Corporate', '2016-05-28'),
(4, 'lawyer@yahoo.in', 'bcd', 'op', 'sharma', 3, 'Public Defender', '2016-05-11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `Name`, `email`, `password`) VALUES
(1, 'Aman Aggarwal', 'aakash.srt@gmail.com', '23456'),
(2, 'xyz', 'xyz@ymail.com', '789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lawyer`
--
ALTER TABLE `lawyer`
  ADD PRIMARY KEY (`lawyerId`),
  ADD KEY `email` (`email`),
  ADD KEY `lawerId` (`lawyerId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
