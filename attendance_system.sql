-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 09, 2020 at 04:00 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `AttendanceID` int(11) NOT NULL,
  `ClassID` int(11) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `Attended` tinyint(1) DEFAULT NULL,
  `Late` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `ModuleID` int(11) NOT NULL,
  `Title` varchar(250) DEFAULT NULL,
  `Leader` varchar(150) DEFAULT NULL,
  `Last_Edited` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`ModuleID`, `Title`, `Leader`, `Last_Edited`) VALUES
(6356, 'data center', 'adrian winckles', '2020-03-08'),
(6363, 'Semantic data technology', 'arooj fatima', '2020-03-09'),
(7464, 'web solutions', 'cristina luca', '2020-02-03'),
(8654, 'web security', 'andrew moore', '2020-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `modules.classes`
--

CREATE TABLE `modules.classes` (
  `ClassID` int(11) NOT NULL,
  `ModuleID` int(11) DEFAULT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `Start_Date` date DEFAULT NULL,
  `End_Date` date DEFAULT NULL,
  `Week_Day` varchar(20) DEFAULT NULL,
  `Start_Time` time DEFAULT NULL,
  `End_Time` time DEFAULT NULL,
  `Class_Type` enum('Lecture','Practical','Laboratory','Seminar') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules.classes`
--

INSERT INTO `modules.classes` (`ClassID`, `ModuleID`, `StaffID`, `Start_Date`, `End_Date`, `Week_Day`, `Start_Time`, `End_Time`, `Class_Type`) VALUES
(2, 6356, 121, '2020-03-03', '2020-04-03', 'monday friday', '14:00:32', '16:00:32', 'Practical'),
(7, 6356, 121, '2020-03-02', '2020-04-03', 'monday friday', '11:00:04', '13:00:19', 'Lecture'),
(202, 8654, 223, '2020-01-20', '2020-04-21', 'thursday', '10:00:16', '12:00:16', 'Lecture');

-- --------------------------------------------------------

--
-- Table structure for table `modules.students`
--

CREATE TABLE `modules.students` (
  `ModuleID` int(11) NOT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `Start_Date` date DEFAULT NULL,
  `End_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL,
  `Name` varchar(150) DEFAULT NULL,
  `Location` varchar(150) DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RoomID`, `Name`, `Location`, `Capacity`) VALUES
(1, 'lab001', 'ashcroft building, cambridge campus', 125),
(2, 'cos002', 'coslett building, cambridge campus', 70),
(3, 'sci003', 'science and web building,cambridge campus', 40),
(7, 'compass house', 'compass house, cambridge campus', 65),
(101, 'lab101', 'ashcroft building,cambridge campus', 60),
(103, 'sci103', 'science and web building, cambridge campus', 30),
(124, 'cos124', 'coslett building, cambridge campus', 70),
(202, 'com202', 'compass house, cambridge campus', 40),
(205, 'sci205', 'science and web building, cambridge campus', 40),
(404, 'lab404', 'ashcroft builidng,cambridge campus', 70);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Type` enum('Lecturer','Manager','Administrator') DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `FirstName`, `LastName`, `Email`, `Type`, `UserID`) VALUES
(1, 'Janvi', 'Patel', 'janvi.patel@student.anglia.ac.uk', 'Administrator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Concern` tinyint(1) DEFAULT NULL,
  `Type` varchar(255) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Email`, `Concern`, `Type`, `UserID`) VALUES
(1, 'Joshua', 'Dowding', 'josh.dowding@student.anglia.ac.uk', 0, 'Student', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `DateCreated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `DateCreated`) VALUES
(1, 'janvi.patel', 'test2', '2020-03-02 14:30:03'),
(2, 'josh.dowding', 'test1', '2020-03-02 14:30:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`AttendanceID`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`ModuleID`);

--
-- Indexes for table `modules.classes`
--
ALTER TABLE `modules.classes`
  ADD PRIMARY KEY (`ClassID`);

--
-- Indexes for table `modules.students`
--
ALTER TABLE `modules.students`
  ADD PRIMARY KEY (`ModuleID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RoomID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `ModuleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8655;

--
-- AUTO_INCREMENT for table `modules.classes`
--
ALTER TABLE `modules.classes`
  MODIFY `ClassID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
