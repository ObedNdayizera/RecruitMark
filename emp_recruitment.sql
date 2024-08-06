-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 05:16 PM
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
-- Database: `emp_recruitment`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `C_ID` int(11) NOT NULL,
  `C_FirstName` varchar(50) NOT NULL,
  `C_LastName` varchar(50) NOT NULL,
  `C_Gender` varchar(10) NOT NULL,
  `C_DateOfBirth` date NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `PostId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`C_ID`, `C_FirstName`, `C_LastName`, `C_Gender`, `C_DateOfBirth`, `PhoneNumber`, `PostId`) VALUES
(6, 'obed', 'ndayizera', 'Female', '2024-06-22', '0784658753', NULL),
(9, 'Habimana', 'Eric', 'Male', '2003-01-19', '78355555', 7);

-- --------------------------------------------------------

--
-- Table structure for table `candidateresult`
--

CREATE TABLE `candidateresult` (
  `CR_Id` int(11) NOT NULL,
  `C_ID` int(11) DEFAULT NULL,
  `ExamDate` date NOT NULL,
  `CR_Marks` int(11) NOT NULL,
  `CR_Decision` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidateresult`
--

INSERT INTO `candidateresult` (`CR_Id`, `C_ID`, `ExamDate`, `CR_Marks`, `CR_Decision`) VALUES
(11, 6, '2024-06-01', 80, 'ACCEPTED'),
(12, 9, '2024-06-04', 40, 'REJECTED');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `PostId` int(11) NOT NULL,
  `PostName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`PostId`, `PostName`) VALUES
(7, 'manager'),
(8, 'cleaner');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `UserName`, `Password`) VALUES
(4, 'obed', '$2y$10$BcMRKSECAUv7EFx0EnGOke2HYDXzpbcGqoLAdqnBFzjDstme/yY/.'),
(5, 'user1', '$2y$10$3o.CvJlg3Vxf.m/v0dYbheITue0fPEqBgxeYeTLgV/7yQNTe9dZzK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`C_ID`),
  ADD KEY `PostId` (`PostId`);

--
-- Indexes for table `candidateresult`
--
ALTER TABLE `candidateresult`
  ADD PRIMARY KEY (`CR_Id`),
  ADD KEY `C_ID` (`C_ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`PostId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `candidateresult`
--
ALTER TABLE `candidateresult`
  MODIFY `CR_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `PostId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`PostId`) REFERENCES `post` (`PostId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `candidateresult`
--
ALTER TABLE `candidateresult`
  ADD CONSTRAINT `candidateresult_ibfk_1` FOREIGN KEY (`C_ID`) REFERENCES `candidate` (`C_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
