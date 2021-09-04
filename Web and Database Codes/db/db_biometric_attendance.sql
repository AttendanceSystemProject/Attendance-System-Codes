-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: remotemysql.com
-- Generation Time: Aug 30, 2021 at 06:27 AM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+06:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vo2WUxxjc7`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_email` varchar(80) NOT NULL,
  `admin_pwd` longtext NOT NULL,
  `department` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_email`, `admin_pwd`, `department`, `designation`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$12$U8pph3z4NPYbR5tvw.eTr.k2kh0V418WE2v/WiBrxWLiCvjHqn2SO', 'Department of Electrical & Electronic Engineering', 'Senior Lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `programName` varchar(64) NOT NULL,
  `courseName` varchar(128) NOT NULL,
  `term` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `courseYear` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `courseDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `programName`, `courseName`, `term`, `courseYear`, `courseDate`) VALUES
(1, 'BSc. in EEE', 'EEE-121 Electrical Circuits I', 'Spring', '2021', '2021-08-22'),
(2, 'BSc. in EEE', 'EEE-123 Electrical Circuits II', 'Spring', '2021', '2021-08-29'),
(3, 'BSc. in EEE', 'EEE-213 Energy Conversion I', 'Spring', '2021', '2021-08-30');

-- --------------------------------------------------------

--
-- Table structure for table `course_students`
--

CREATE TABLE `course_students` (
  `id` int(11) NOT NULL,
  `studentID` varchar(32) NOT NULL,
  `courseID` mediumint(11) NOT NULL,
  `assignStatus` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course_students`
--

INSERT INTO `course_students` (`id`, `studentID`, `courseID`, `assignStatus`) VALUES
(8, '1212', 1, 1),
(9, '445-45', 1, 1),
(11, '545-5454-44', 1, 1),
(12, '445-455', 1, 1),
(13, '171-171-012', 2, 1),
(14, '171-141-020', 2, 1),
(15, '171-141-018', 2, 1),
(16, '171-141-015', 1, 1),
(17, '171-141-003', 1, 1),
(18, '171-141-002', 1, 1),
(20, '171-141-003', 3, 1),
(21, '171-141-002', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `device_name` varchar(50) NOT NULL,
  `device_dep` varchar(20) NOT NULL,
  `device_uid` text NOT NULL,
  `device_date` date NOT NULL,
  `device_mode` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `device_name`, `device_dep`, `device_uid`, `device_date`, `device_mode`) VALUES
(15, 'Test device 2', 'EEE', '555666', '2021-08-13', 0),
(16, 'Test Device 1', 'EEE', '123456', '2021-08-14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pwd_reset`
--

CREATE TABLE `pwd_reset` (
  `pwd_reset_id` int(11) NOT NULL,
  `pwd_reset_email` varchar(50) NOT NULL,
  `pwd_reset_selector` text NOT NULL,
  `pwd_reset_token` longtext NOT NULL,
  `pwd_reset_expires` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `studentID` varchar(32) NOT NULL,
  `studentName` varchar(64) NOT NULL DEFAULT 'None',
  `serialnumber` double NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `department` varchar(32) NOT NULL,
  `batch` varchar(32) NOT NULL,
  `section` varchar(8) DEFAULT NULL,
  `fingerprint_id` int(11) NOT NULL,
  `fingerprint_select` tinyint(1) NOT NULL DEFAULT '0',
  `user_date` date NOT NULL,
  `device_uid` varchar(20) NOT NULL DEFAULT '0',
  `device_dep` varchar(20) NOT NULL DEFAULT '0',
  `del_fingerid` tinyint(1) NOT NULL DEFAULT '0',
  `add_fingerid` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `studentID`, `studentName`, `serialnumber`, `email`, `phone`, `department`, `batch`, `section`, `fingerprint_id`, `fingerprint_select`, `user_date`, `device_uid`, `device_dep`, `del_fingerid`, `add_fingerid`) VALUES
(22, '171-141-015', 'student 1', 0, 'None', 't1@t.com', '01563589654', 'BSc. in EEE', '38', 'A', 5, 0, '2021-08-29', '123456', '0', 0, 1),
(23, '171-141-002', 'student 2', 0, 'None', 't2@t.com', '01259634785', 'BSc. in EEE', '38', 'A', 10, 0, '2021-08-29', '123456', '0', 0, 1),
(24, '171-141-003', 'student 3', 0, 'None', 't3@t.com', '017963348514', 'BSc. in EEE', '38', 'A', 15, 0, '2021-08-29', '123456', '0', 0, 1),
(25, '171-171-012', 'student 4', 0, 'None', 't4@t.com', '01963458753', 'BSc. in EEE', '40', 'B', 20, 0, '2021-08-29', '123456', '0', 0, 1),
(26, '171-141-020', 'student 5', 0, 'None', 't5@t.com', '01967845325', 'BSc. in EEE', '40', 'B', 25, 0, '2021-08-29', '123456', '0', 0, 1),
(27, '171-141-018', 'student 6', 0, 'None', 't6@t.com', '01587693548', 'BSc. in EEE', '40', 'B', 30, 0, '2021-08-29', '123456', '0', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_logs`
--

CREATE TABLE `users_logs` (
  `id` int(11) NOT NULL,
  `student_id` varchar(32) NOT NULL,
  `course_id` int(11) NOT NULL,
  `fingerprint_id` int(5) NOT NULL,
  `device_uid` varchar(20) NOT NULL,
  `checkindate` date NOT NULL,
  `timein` time NOT NULL,
  `fingerout` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_logs`
--

INSERT INTO `users_logs` (`id`, `student_id`, `course_id`, `fingerprint_id`, `device_uid`, `checkindate`, `timein`, `fingerout`) VALUES
(1, '445-45', 0, 1, '12345', '2021-08-29', '08:39:35', 0),
(2, '445-45', 0, 1, '12345', '2021-08-29', '08:42:01', 0),
(3, '445-45', 0, 1, '12345', '2021-08-29', '08:45:16', 0),
(4, '445-45', 1, 1, '12345', '2021-08-29', '17:32:24', 0),
(5, '171-141-002', 3, 10, '123456', '2021-08-30', '09:20:10', 0),
(6, '171-141-002', 3, 10, '123456', '2021-08-30', '09:21:13', 0),
(7, '171-141-002', 3, 10, '123456', '2021-08-30', '09:23:10', 0),
(8, '171-141-002', 3, 10, '123456', '2021-08-30', '09:24:01', 0),
(9, '171-141-002', 3, 10, '123456', '2021-08-30', '09:25:56', 0),
(10, '171-141-002', 3, 10, '123456', '2021-08-30', '09:26:34', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_students`
--
ALTER TABLE `course_students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_index` (`studentID`,`courseID`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `device_uid` (`device_uid`(255));

--
-- Indexes for table `pwd_reset`
--
ALTER TABLE `pwd_reset`
  ADD PRIMARY KEY (`pwd_reset_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`studentID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `users_logs`
--
ALTER TABLE `users_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_students`
--
ALTER TABLE `course_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pwd_reset`
--
ALTER TABLE `pwd_reset`
  MODIFY `pwd_reset_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users_logs`
--
ALTER TABLE `users_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
