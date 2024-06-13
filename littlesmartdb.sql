-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 09:44 AM
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
-- Database: `littlesmartdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(128) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `telno` varchar(16) NOT NULL,
  `school` varchar(255) NOT NULL,
  `standard` int(1) NOT NULL,
  `mandarin` int(3) NOT NULL,
  `english` int(3) NOT NULL,
  `malay` int(3) NOT NULL,
  `math` int(3) NOT NULL,
  `science` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `age`, `telno`, `school`, `standard`, `mandarin`, `english`, `malay`, `math`, `science`) VALUES
(100001, 'John Doe', 10, '012-3456789', 'SJK(C) Bukit Serdang', 4, 80, 78, 95, 83, 88),
(100002, 'Mary Sue', 10, '019-8765432', 'SJK(C) Bukit Serdang', 4, 60, 34, 66, 50, 71),
(100003, 'Tan Yi Xiang', 9, '013-4567892', 'SJK(C) Bukit Serdang', 3, 91, 72, 79, 86, 77),
(100004, 'Lee Zee Kai', 7, '018-9732564', 'SJK(C) Bukit Nanas', 1, 59, 30, 8, 27, 34),
(100005, 'Pua Jing Yi', 11, '017-9263485', 'SJK(C) Bukit Nanas', 5, 90, 99, 94, 99, 99),
(100006, 'Chua Weng Wah', 8, '013-4567892', 'SJK(C) Bukit Nanas', 2, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `admin_id` int(128) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`admin_id`, `username`, `password`, `email`) VALUES
(123456, 'admintest', '$2y$12$M4LuzVvkqu9YpecoQL5MG.31ZqvUObRAVcLhKWxMjZh4iSXveWaGq', 'admin@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
