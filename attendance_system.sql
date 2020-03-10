-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2020 at 05:19 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

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
  `Late` tinyint(1) DEFAULT NULL,
  `Week` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`AttendanceID`, `ClassID`, `StudentID`, `Attended`, `Late`, `Week`) VALUES
(1, 1, 1, 1, 0, 1),
(2, 1, 1, 1, 0, 2),
(3, 1, 1, 1, 0, 3),
(4, 1, 1, 1, 0, 4),
(5, 1, 1, 1, 0, 5),
(6, 1, 1, 1, 0, 6),
(7, 1, 1, 1, 0, 7),
(8, 1, 1, 1, 0, 8),
(9, 1, 1, 1, 0, 9),
(10, 1, 1, 1, 0, 10),
(11, 1, 1, 1, 0, 11),
(12, 1, 1, 1, 0, 12),
(13, 2, 1, 1, 0, 1),
(14, 2, 1, 1, 0, 2),
(15, 2, 1, 1, 0, 3),
(16, 2, 1, 1, 0, 4),
(17, 2, 1, 1, 0, 5),
(18, 2, 1, 1, 0, 6),
(19, 2, 1, 1, 0, 7),
(20, 2, 1, 1, 0, 8),
(21, 2, 1, 1, 0, 9),
(22, 2, 1, 1, 0, 10),
(23, 2, 1, 1, 0, 11),
(24, 2, 1, 1, 0, 12),
(25, 3, 1, 1, 0, 1),
(26, 3, 1, 1, 0, 2),
(27, 3, 1, 1, 0, 3),
(28, 3, 1, 1, 0, 4),
(29, 3, 1, 1, 0, 5),
(30, 3, 1, 1, 0, 6),
(31, 3, 1, 1, 0, 7),
(32, 3, 1, 1, 0, 8),
(33, 3, 1, 1, 0, 9),
(34, 3, 1, 1, 0, 10),
(35, 3, 1, 1, 0, 11),
(36, 3, 1, 1, 0, 12),
(37, 4, 1, 1, 0, 1),
(38, 4, 1, 1, 0, 2),
(39, 4, 1, 1, 0, 3),
(40, 4, 1, 1, 0, 4),
(41, 4, 1, 1, 0, 5),
(42, 4, 1, 1, 0, 6),
(43, 4, 1, 1, 0, 7),
(44, 4, 1, 1, 0, 8),
(45, 4, 1, 1, 0, 9),
(46, 4, 1, 1, 0, 10),
(47, 4, 1, 1, 0, 11),
(48, 4, 1, 1, 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `ModuleID` int(11) NOT NULL,
  `Title` varchar(250) DEFAULT NULL,
  `StaffID` int(11) DEFAULT NULL COMMENT 'Course Leader',
  `DateCreated` date DEFAULT current_timestamp(),
  `LastEdited` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`ModuleID`, `Title`, `StaffID`, `DateCreated`, `LastEdited`) VALUES
(1, 'Data Centre & Cloud Infrastructures', 1, '2020-02-04', '2020-03-08'),
(2, 'Semantic Data Technologies', 2, '2020-02-04', '2020-03-09'),
(3, 'Advanced Web Solutions', 3, '2020-02-04', '2020-02-03'),
(4, 'Web Application Security', 4, '2020-02-04', '2020-03-02'),
(5, 'Research Methods', 5, '2020-02-04', '2020-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `modules.classes`
--

CREATE TABLE `modules.classes` (
  `ClassID` int(11) NOT NULL,
  `ModuleID` int(11) DEFAULT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Day` enum('Monday','Tuesday','Wednesday','Thursday','Friday') DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `ClassType` enum('Lecture','Practical','Laboratory','Seminar') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules.classes`
--

INSERT INTO `modules.classes` (`ClassID`, `ModuleID`, `StaffID`, `StartDate`, `EndDate`, `Day`, `StartTime`, `EndTime`, `ClassType`) VALUES
(1, 1, 1, '2019-09-16', '2019-12-12', 'Friday', '10:00:00', '12:00:00', 'Lecture'),
(2, 1, 1, '2019-09-16', '2019-12-12', 'Friday', '13:00:00', '16:00:00', 'Practical'),
(3, 2, 2, '2019-09-16', '2019-12-12', 'Tuesday', '11:00:00', '12:00:00', 'Lecture'),
(4, 2, 2, '2019-09-16', '2019-12-12', 'Tuesday', '13:00:00', '15:00:00', 'Practical'),
(5, 3, 3, '2020-01-20', '2020-04-24', 'Monday', '11:00:00', '13:00:00', 'Lecture'),
(6, 3, 3, '2020-01-20', '2020-04-24', 'Monday', '14:00:00', '16:00:00', 'Practical'),
(7, 4, 4, '2020-01-20', '2020-04-24', 'Thursday', '13:00:00', '14:00:00', 'Lecture'),
(8, 4, 4, '2020-01-20', '2020-04-24', 'Thursday', '14:00:00', '16:00:00', 'Practical'),
(9, 5, 5, '2020-01-20', '2020-04-24', 'Thursday', '10:00:00', '12:00:00', 'Seminar');

-- --------------------------------------------------------

--
-- Table structure for table `modules.students`
--

CREATE TABLE `modules.students` (
  `ModuleID` int(11) NOT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules.students`
--

INSERT INTO `modules.students` (`ModuleID`, `StudentID`, `StartDate`, `EndDate`) VALUES
(1, 1, '2019-09-16', '2019-12-12'),
(2, 1, '2019-09-16', '2019-12-12'),
(3, 1, '2020-01-20', '2020-04-24'),
(4, 1, '2020-01-20', '2020-04-24'),
(5, 1, '2020-01-20', '2020-04-24');

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
(1, 'Adrian', 'Winckles', 'adrian.winckles@anglia.ac.uk', 'Manager', 3),
(2, 'Arooj', 'Fatima', 'arooj.fatima@anglia.ac.uk', 'Lecturer', 4),
(3, 'Cristina', 'Luca', 'cristina.luca@anglia.ac.uk', 'Manager', 5),
(4, 'Andrew', 'Moore', 'andrew.moore@anglia.ac.uk', 'Lecturer', 6),
(5, 'Jin', 'Zhang', 'jin.zhang@anglia.ac.uk', 'Lecturer', 7),
(6, 'Marcian', 'Cirstea', 'marcian.cirstea@anglia.ac.uk', 'Administrator', 8);

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
  `Type` enum('Student') DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Email`, `Concern`, `Type`, `UserID`) VALUES
(1, 'Joshua', 'Dowding', 'josh.dowding@student.anglia.ac.uk', 0, 'Student', 2),
(2, 'Janvi', 'Patel', 'janvi.patel@student.anglia.ac.uk', 0, 'Student', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `DateCreated` date DEFAULT current_timestamp(),
  `LastEdited` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `DateCreated`, `LastEdited`) VALUES
(1, 'janvi.patel', '$2y$10$DL5rz.8JtJTxGMaBgs6KieSO6S5SeB6VKcUvCKsfn4Jhx1TgchuAS', '2020-03-02', NULL),
(2, 'josh.dowding', '$2y$10$WWG78UvVyIO0No4B2Xiv6eru7rciIt49EHxGlLWuMN6cDgavOq3eO', '2020-03-02', NULL);

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
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `ModuleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8656;

--
-- AUTO_INCREMENT for table `modules.classes`
--
ALTER TABLE `modules.classes`
  MODIFY `ClassID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
