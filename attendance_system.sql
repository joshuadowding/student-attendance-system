-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 30, 2020 at 05:14 PM
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
  `Late` tinyint(1) DEFAULT NULL,
  `Week` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`AttendanceID`, `ClassID`, `StudentID`, `Attended`, `Late`, `Week`) VALUES
(1, 1, 2, 1, 0, 1),
(2, 1, 2, 1, 0, 2),
(3, 1, 2, 1, 0, 3),
(4, 1, 2, 1, 0, 4),
(5, 1, 2, 1, 0, 5),
(6, 1, 2, 1, 0, 6),
(7, 1, 2, 1, 0, 7),
(8, 1, 2, 1, 0, 8),
(9, 1, 2, 1, 0, 9),
(10, 1, 2, 1, 0, 10),
(11, 1, 2, 1, 0, 11),
(12, 1, 2, 1, 0, 12),
(13, 2, 2, 1, 1, 1),
(14, 2, 2, 1, 0, 2),
(15, 2, 2, 1, 1, 3),
(16, 2, 2, 1, 0, 4),
(17, 2, 2, 1, 0, 5),
(18, 2, 2, 1, 0, 6),
(19, 2, 2, 1, 0, 7),
(20, 2, 2, 1, 0, 8),
(21, 2, 2, 1, 0, 9),
(22, 2, 2, 1, 0, 10),
(23, 2, 2, 1, 0, 11),
(24, 2, 2, 1, 0, 12),
(25, 3, 1, 1, 1, 1),
(26, 3, 1, 1, 0, 2),
(27, 3, 1, 1, 1, 3),
(28, 3, 1, 1, 1, 4),
(29, 3, 1, 1, 1, 5),
(30, 3, 1, 1, 1, 6),
(31, 4, 1, 1, 0, 1),
(32, 4, 1, 1, 1, 2),
(33, 4, 1, 1, 0, 3),
(34, 4, 1, 1, 0, 4),
(35, 5, 3, 1, 0, 1),
(36, 5, 3, 1, 0, 2),
(37, 5, 3, 1, 0, 3),
(38, 5, 3, 1, 0, 4),
(39, 5, 3, 1, 0, 5),
(40, 5, 3, 1, 1, 6),
(41, 5, 3, 1, 1, 7),
(42, 5, 3, 1, 1, 8),
(43, 5, 3, 1, 0, 9),
(44, 5, 3, 1, 1, 10),
(45, 6, 3, 1, 1, 1),
(46, 6, 3, 1, 1, 2),
(47, 6, 3, 1, 0, 3),
(48, 6, 3, 1, 0, 4),
(49, 6, 3, 1, 0, 5),
(50, 6, 3, 1, 0, 6),
(51, 6, 3, 1, 0, 7),
(52, 9, 4, 1, 0, 1),
(53, 9, 4, 1, 0, 2),
(54, 9, 4, 1, 0, 3),
(55, 9, 4, 1, 0, 4),
(56, 9, 4, 1, 0, 5),
(57, 9, 4, 1, 0, 6),
(58, 9, 4, 1, 1, 7),
(59, 9, 4, 1, 0, 8),
(60, 9, 4, 1, 0, 9),
(61, 9, 4, 1, 0, 10),
(62, 9, 4, 1, 0, 11),
(63, 9, 4, 1, 0, 12),
(64, 7, 5, 1, 0, 1),
(65, 7, 5, 1, 0, 2),
(66, 7, 5, 1, 0, 3),
(67, 7, 5, 1, 1, 4),
(68, 7, 5, 1, 0, 5),
(69, 8, 5, 1, 1, 1),
(70, 8, 5, 1, 0, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `class_total_attendance`
-- (See below for the actual view)
--
CREATE TABLE `class_total_attendance` (
`ClassID` int(11)
,`TotalAttendance` bigint(21)
);

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
(1, 2, '2019-09-16', '2019-12-12'),
(2, 1, '2019-09-16', '2019-12-12'),
(3, 3, '2020-01-20', '2020-04-24'),
(4, 5, '2020-01-20', '2020-04-24'),
(5, 4, '2020-01-20', '2020-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL,
  `Name` varchar(150) DEFAULT NULL,
  `Location` varchar(150) DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `PCs` int(12) NOT NULL,
  `Printer` int(12) NOT NULL,
  `Type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RoomID`, `Name`, `Location`, `Capacity`, `PCs`, `Printer`, `Type`) VALUES
(1, 'lab001', 'ashcroft building, cambridge campus', 125, 0, 0, 'Lecture'),
(2, 'cos002', 'coslett building, cambridge campus', 70, 0, 0, 'Lecture'),
(3, 'sci003', 'science and web building,cambridge campus', 40, 40, 2, 'Practical'),
(6, 'LAB006', 'Ashcroft Building,\r\nCambridge', 50, 0, 0, 'Lecture'),
(7, 'compass house', 'compass house, cambridge campus', 65, 65, 3, 'Practical'),
(9, 'COM009', 'Compass Building \r\nCambridge', 22, 22, 1, 'Practical'),
(101, 'lab101', 'ashcroft building,cambridge campus', 60, 0, 0, 'Lecture'),
(103, 'sci103', 'science and web building, cambridge campus', 30, 30, 2, 'Practical'),
(124, 'cos124', 'coslett building, cambridge campus', 70, 0, 0, 'Lecture'),
(202, 'com202', 'compass house, cambridge campus', 40, 40, 0, 'Practical'),
(205, 'sci205', 'science and web building, cambridge campus', 40, 41, 0, 'Practical'),
(404, 'lab404', 'ashcroft builidng,cambridge campus', 70, 0, 0, 'Lecture'),
(501, 'COS 501', 'Coslete Building\r\nCambridge', 20, 20, 1, 'Practical');

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
(2, 'Janvi', 'Patel', 'janvi.patel@student.anglia.ac.uk', 0, 'Student', 1),
(3, 'Chaitanya ', 'Patel', 'chaitanya.patel@student.anglia.ac.uk', 0, 'Student', 3),
(4, 'Dev', 'Patel', 'dev.patel@student.anglia.ac.uk', 0, 'Student', 4),
(5, 'Havya ', 'Reddy', 'havya.reddy@student.anglia.ac.uk', 0, 'Student', 5);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_class_total_attendance`
-- (See below for the actual view)
--
CREATE TABLE `student_class_total_attendance` (
`StudentID` int(11)
,`StudentName` varchar(511)
,`ClassID` int(11)
,`TotalAttendance` decimal(25,0)
,`TotalInLate` decimal(25,0)
,`ExpectedAttendance` decimal(64,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_total_expected_attendance_by_class`
-- (See below for the actual view)
--
CREATE TABLE `student_total_expected_attendance_by_class` (
`StudentID` int(11)
,`ClassID` int(11)
,`TotalAttendance` decimal(42,0)
);

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

-- --------------------------------------------------------

--
-- Structure for view `class_total_attendance`
--
DROP TABLE IF EXISTS `class_total_attendance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `class_total_attendance`  AS  select `c`.`ClassID` AS `ClassID`,timestampdiff(WEEK,`c`.`StartDate`,if(`c`.`EndDate` < current_timestamp(),`c`.`EndDate`,current_timestamp())) AS `TotalAttendance` from `modules.classes` `c` ;

-- --------------------------------------------------------

--
-- Structure for view `student_class_total_attendance`
--
DROP TABLE IF EXISTS `student_class_total_attendance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_class_total_attendance`  AS  select `a`.`StudentID` AS `StudentID`,concat(`s`.`FirstName`,' ',`s`.`LastName`) AS `StudentName`,`a`.`ClassID` AS `ClassID`,sum(`a`.`Attended`) AS `TotalAttendance`,sum(`a`.`Late`) AS `TotalInLate`,(select sum(`ea`.`TotalAttendance`) from `student_total_expected_attendance_by_class` `ea` where `ea`.`StudentID` = `a`.`StudentID`) AS `ExpectedAttendance` from (`attendance` `a` left join `students` `s` on(`a`.`StudentID` = `s`.`StudentID`)) group by `a`.`StudentID`,`a`.`ClassID` order by `a`.`StudentID` ;

-- --------------------------------------------------------

--
-- Structure for view `student_total_expected_attendance_by_class`
--
DROP TABLE IF EXISTS `student_total_expected_attendance_by_class`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_total_expected_attendance_by_class`  AS  select `modules.students`.`StudentID` AS `StudentID`,`class_total_attendance`.`ClassID` AS `ClassID`,sum(`class_total_attendance`.`TotalAttendance`) AS `TotalAttendance` from ((`class_total_attendance` left join `modules.classes` on(`class_total_attendance`.`ClassID` = `modules.classes`.`ClassID`)) left join `modules.students` on(`modules.classes`.`ModuleID` = `modules.students`.`ModuleID`)) group by `modules.students`.`StudentID`,`class_total_attendance`.`ClassID` ;

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
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

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
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
