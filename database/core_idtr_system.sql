-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2024 at 12:36 PM
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
-- Database: `core_idtr_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_time_records`
--

CREATE TABLE `daily_time_records` (
  `id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL,
  `arrival_am` time DEFAULT NULL,
  `departure_am` time DEFAULT NULL,
  `late_am` time DEFAULT NULL,
  `worked_hours_am` time DEFAULT NULL,
  `arrival_pm` time DEFAULT NULL,
  `departure_pm` time DEFAULT NULL,
  `late_pm` time DEFAULT NULL,
  `worked_hours_pm` time DEFAULT NULL,
  `overtime_start` time DEFAULT NULL,
  `overtime_end` time DEFAULT NULL,
  `overtime_duration` time DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_time_records`
--

INSERT INTO `daily_time_records` (`id`, `intern_id`, `arrival_am`, `departure_am`, `late_am`, `worked_hours_am`, `arrival_pm`, `departure_pm`, `late_pm`, `worked_hours_pm`, `overtime_start`, `overtime_end`, `overtime_duration`, `date`) VALUES
(39, 1, '08:14:40', '09:41:28', '00:14:40', '01:26:48', NULL, NULL, NULL, '03:38:58', NULL, NULL, NULL, '2024-01-19'),
(43, 1, '11:25:13', '11:50:12', '03:25:12', '00:24:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-20'),
(44, 1, '11:51:15', '12:00:12', '03:51:15', '00:08:57', '12:33:15', '13:38:46', NULL, '01:05:31', NULL, NULL, NULL, '2024-01-21'),
(55, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23:45:13', NULL, NULL, '2024-01-22');

-- --------------------------------------------------------

--
-- Table structure for table `interns`
--

CREATE TABLE `interns` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(199) NOT NULL,
  `middlename` varchar(199) NOT NULL,
  `lastname` varchar(199) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(199) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0 = Out\r\n1 = In',
  `overtime_status` int(1) NOT NULL COMMENT '0=Off\r\n1=On',
  `avatar` varchar(199) DEFAULT NULL,
  `target_hours` time NOT NULL,
  `completed_hours` time NOT NULL,
  `remaining_hours` time NOT NULL,
  `total_hours_worked_am` time NOT NULL,
  `total_hours_worked_pm` time NOT NULL,
  `total_overtime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interns`
--

INSERT INTO `interns` (`id`, `user_id`, `firstname`, `middlename`, `lastname`, `gender`, `birthdate`, `email`, `status`, `overtime_status`, `avatar`, `target_hours`, `completed_hours`, `remaining_hours`, `total_hours_worked_am`, `total_hours_worked_pm`, `total_overtime`) VALUES
(1, 1, 'Gio', 'Oledan', 'Dela Pena', 'Male', '2024-01-20', 'gio@gmail.com', 0, 0, NULL, '406:00:00', '06:46:08', '399:13:52', '02:00:44', '04:44:29', '00:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL,
  `report_title` varchar(199) NOT NULL,
  `report_content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `intern_id`, `report_title`, `report_content`, `date`) VALUES
(2, 1, 'HAHAHA', 'lvkugqawiusdhces', '2024-01-22 16:38:33'),
(3, 1, 'fcds', 'cqasxz', '2024-01-22 16:39:04'),
(4, 1, 'vwsdcx', 'wdcsx', '2024-01-22 16:43:12'),
(5, 1, 'vwsdcx', 'vfwesdcx', '2024-01-22 16:43:21'),
(6, 1, 'fcveds', 'feqwsd', '2024-01-22 16:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(199) NOT NULL,
  `password` varchar(199) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'gio', '009317b8359105aff470031af4b4564c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_time_records`
--
ALTER TABLE `daily_time_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interns` (`intern_id`);

--
-- Indexes for table `interns`
--
ALTER TABLE `interns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
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
-- AUTO_INCREMENT for table `daily_time_records`
--
ALTER TABLE `daily_time_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `interns`
--
ALTER TABLE `interns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_time_records`
--
ALTER TABLE `daily_time_records`
  ADD CONSTRAINT `interns` FOREIGN KEY (`intern_id`) REFERENCES `interns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interns`
--
ALTER TABLE `interns`
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
