-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2020 at 06:23 PM
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
(13, 2, 1, 1, 1, 1),
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
(48, 4, 1, 1, 0, 12),
(114, 5, 1, 0, 0, 1),
(115, 6, 1, 0, 0, 1),
(116, 5, 1, 0, 0, 2),
(117, 6, 1, 0, 0, 2),
(118, 5, 1, 0, 0, 3),
(119, 6, 1, 0, 0, 3),
(120, 5, 1, 0, 0, 4),
(121, 6, 1, 0, 0, 4),
(122, 5, 1, 0, 0, 5),
(123, 6, 1, 0, 0, 5),
(124, 5, 1, 0, 0, 6),
(125, 6, 1, 0, 0, 6),
(126, 5, 1, 0, 0, 7),
(127, 6, 1, 0, 0, 7),
(128, 5, 1, 0, 0, 8),
(129, 6, 1, 0, 0, 8),
(130, 5, 1, 0, 0, 9),
(131, 6, 1, 0, 0, 9),
(132, 5, 1, 0, 0, 10),
(133, 6, 1, 0, 0, 10),
(134, 5, 1, 0, 0, 11),
(135, 6, 1, 0, 0, 11),
(136, 5, 1, 0, 0, 12),
(137, 6, 1, 0, 0, 12),
(138, 7, 1, 0, 0, 1),
(139, 8, 1, 0, 0, 1),
(140, 7, 1, 0, 0, 2),
(141, 8, 1, 0, 0, 2),
(142, 7, 1, 1, 0, 3),
(143, 8, 1, 1, 0, 3),
(144, 7, 1, 0, 0, 4),
(145, 8, 1, 0, 0, 4),
(146, 7, 1, 0, 0, 5),
(147, 8, 1, 0, 0, 5),
(148, 7, 1, 0, 0, 6),
(149, 8, 1, 0, 0, 6),
(150, 7, 1, 0, 0, 7),
(151, 8, 1, 0, 0, 7),
(152, 7, 1, 0, 0, 8),
(153, 8, 1, 0, 0, 8),
(154, 7, 1, 0, 0, 9),
(155, 8, 1, 0, 0, 9),
(156, 7, 1, 0, 0, 10),
(157, 8, 1, 0, 0, 10),
(158, 7, 1, 0, 0, 11),
(159, 8, 1, 0, 0, 11),
(160, 7, 1, 0, 0, 12),
(161, 8, 1, 0, 0, 12),
(162, 9, 1, 0, 0, 1),
(163, 9, 1, 0, 0, 2),
(164, 9, 1, 0, 0, 3),
(165, 9, 1, 0, 0, 4),
(166, 9, 1, 0, 0, 5),
(167, 9, 1, 0, 0, 6),
(168, 9, 1, 0, 0, 7),
(169, 9, 1, 0, 0, 8),
(170, 9, 1, 0, 0, 9),
(171, 9, 1, 0, 0, 10),
(172, 9, 1, 0, 0, 11),
(173, 9, 1, 0, 0, 12),
(174, 1, 2, 1, 0, 1),
(175, 2, 2, 1, 0, 1),
(176, 1, 2, 1, 0, 2),
(177, 2, 2, 1, 0, 2),
(178, 1, 2, 1, 0, 3),
(179, 2, 2, 0, 0, 3),
(180, 1, 2, 0, 0, 4),
(181, 2, 2, 0, 0, 4),
(182, 1, 2, 0, 0, 5),
(183, 2, 2, 0, 0, 5),
(184, 1, 2, 0, 0, 6),
(185, 2, 2, 0, 0, 6),
(186, 1, 2, 0, 0, 7),
(187, 2, 2, 0, 0, 7),
(188, 1, 2, 0, 0, 8),
(189, 2, 2, 0, 0, 8),
(190, 1, 2, 0, 0, 9),
(191, 2, 2, 0, 0, 9),
(192, 1, 2, 0, 0, 10),
(193, 2, 2, 0, 0, 10),
(194, 1, 2, 0, 0, 11),
(195, 2, 2, 0, 0, 11),
(196, 1, 2, 0, 0, 12),
(197, 2, 2, 0, 0, 12),
(198, 3, 2, 0, 0, 1),
(199, 4, 2, 0, 0, 1),
(200, 3, 2, 0, 0, 2),
(201, 4, 2, 0, 0, 2),
(202, 3, 2, 0, 0, 3),
(203, 4, 2, 0, 0, 3),
(204, 3, 2, 0, 0, 4),
(205, 4, 2, 0, 0, 4),
(206, 3, 2, 0, 0, 5),
(207, 4, 2, 0, 0, 5),
(208, 3, 2, 0, 0, 6),
(209, 4, 2, 0, 0, 6),
(210, 3, 2, 0, 0, 7),
(211, 4, 2, 0, 0, 7),
(212, 3, 2, 0, 0, 8),
(213, 4, 2, 0, 0, 8),
(214, 3, 2, 0, 0, 9),
(215, 4, 2, 0, 0, 9),
(216, 3, 2, 0, 0, 10),
(217, 4, 2, 0, 0, 10),
(218, 3, 2, 0, 0, 11),
(219, 4, 2, 0, 0, 11),
(220, 3, 2, 0, 0, 12),
(221, 4, 2, 0, 0, 12),
(222, 5, 2, 0, 0, 1),
(223, 6, 2, 0, 0, 1),
(224, 5, 2, 0, 0, 2),
(225, 6, 2, 0, 0, 2),
(226, 5, 2, 0, 0, 3),
(227, 6, 2, 0, 0, 3),
(228, 5, 2, 0, 0, 4),
(229, 6, 2, 0, 0, 4),
(230, 5, 2, 0, 0, 5),
(231, 6, 2, 0, 0, 5),
(232, 5, 2, 0, 0, 6),
(233, 6, 2, 0, 0, 6),
(234, 5, 2, 0, 0, 7),
(235, 6, 2, 0, 0, 7),
(236, 5, 2, 0, 0, 8),
(237, 6, 2, 0, 0, 8),
(238, 5, 2, 0, 0, 9),
(239, 6, 2, 0, 0, 9),
(240, 5, 2, 0, 0, 10),
(241, 6, 2, 0, 0, 10),
(242, 5, 2, 0, 0, 11),
(243, 6, 2, 0, 0, 11),
(244, 5, 2, 0, 0, 12),
(245, 6, 2, 0, 0, 12),
(246, 7, 2, 0, 0, 1),
(247, 8, 2, 0, 0, 1),
(248, 7, 2, 0, 0, 2),
(249, 8, 2, 0, 0, 2),
(250, 7, 2, 0, 0, 3),
(251, 8, 2, 0, 0, 3),
(252, 7, 2, 0, 0, 4),
(253, 8, 2, 0, 0, 4),
(254, 7, 2, 0, 0, 5),
(255, 8, 2, 0, 0, 5),
(256, 7, 2, 0, 0, 6),
(257, 8, 2, 0, 0, 6),
(258, 7, 2, 0, 0, 7),
(259, 8, 2, 0, 0, 7),
(260, 7, 2, 0, 0, 8),
(261, 8, 2, 0, 0, 8),
(262, 7, 2, 0, 0, 9),
(263, 8, 2, 0, 0, 9),
(264, 7, 2, 0, 0, 10),
(265, 8, 2, 0, 0, 10),
(266, 7, 2, 0, 0, 11),
(267, 8, 2, 0, 0, 11),
(268, 7, 2, 0, 0, 12),
(269, 8, 2, 0, 0, 12),
(270, 9, 2, 0, 0, 1),
(271, 9, 2, 0, 0, 2),
(272, 9, 2, 0, 0, 3),
(273, 9, 2, 0, 0, 4),
(274, 9, 2, 0, 0, 5),
(275, 9, 2, 0, 0, 6),
(276, 9, 2, 0, 0, 7),
(277, 9, 2, 0, 0, 8),
(278, 9, 2, 0, 0, 9),
(279, 9, 2, 0, 0, 10),
(280, 9, 2, 0, 0, 11),
(281, 9, 2, 0, 0, 12);

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
  `EnrolmentID` int(11) NOT NULL,
  `ModuleID` int(11) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules.students`
--

INSERT INTO `modules.students` (`EnrolmentID`, `ModuleID`, `StudentID`, `StartDate`, `EndDate`) VALUES
(1, 1, 1, '2019-09-16', '2019-12-12'),
(2, 2, 1, '2019-09-16', '2019-12-12'),
(3, 3, 1, '2020-01-20', '2020-04-24'),
(4, 4, 1, '2020-01-20', '2020-04-24'),
(5, 5, 1, '2020-01-20', '2020-04-24'),
(6, 1, 2, '2019-09-16', '2019-12-12'),
(7, 2, 2, '2019-09-16', '2019-12-12'),
(8, 3, 2, '2020-01-20', '2020-04-24'),
(9, 4, 2, '2020-01-20', '2020-04-24'),
(10, 5, 2, '2020-01-20', '2020-04-24');

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
(2, 'josh.dowding', '$2y$10$WWG78UvVyIO0No4B2Xiv6eru7rciIt49EHxGlLWuMN6cDgavOq3eO', '2020-03-02', NULL),
(3, 'adrian.winckles', '$2y$10$voTpgPcKoUgx/4r9K9f6YeOYcuc.Em5RcjQnq.Li1fMLRRKCN4BLG', '2020-03-10', NULL),
(4, 'arooj.fatima', '$2y$10$bnCON/cPpcH6zL14QznyiOc9WIK7ive6RLTy/edaUey.C5KPLz9SO', '2020-03-10', NULL),
(5, 'cristina.luca', '$2y$10$JDwed0rtQM0B5mnI0swYKeh5AlOHPQb0zutG6Cjv26oTELhsjeGjq', '2020-03-10', NULL),
(6, 'andrew.moore', '$2y$10$T6jvisdRPhKkb9hXHrA5kufAfK5gf9BshZ4bqCsDGcQ7UUtCwFZ1i', '2020-03-10', NULL),
(7, 'jin.zhang', '$2y$10$xNOl/QB0/b8Q618gHX.JIejFXi9StUwCYCY3RwB2Srnr11bloETZ.', '2020-03-10', NULL),
(8, 'marcian.cirstea', '$2y$10$VurbvuxNL4Tg9EbS.11plejJjinehKW6GXFfyXjsb.evR46xu1dci', '2020-03-10', NULL);

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
  ADD PRIMARY KEY (`EnrolmentID`);

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
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `ModuleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `modules.classes`
--
ALTER TABLE `modules.classes`
  MODIFY `ClassID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `modules.students`
--
ALTER TABLE `modules.students`
  MODIFY `EnrolmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
