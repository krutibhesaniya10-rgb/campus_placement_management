-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2025 at 07:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin@gmail.com', '123456789', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `message`, `created_at`) VALUES
(1, 'Exam Schedule Released', 'The final exam schedule for Semester 4 has been uploaded on the college website.', '2025-09-10 05:00:00'),
(2, 'Holiday Notice', 'College will remain closed on 15th September due to Independence Day celebrations.', '2025-09-12 03:30:00'),
(3, 'Workshop on Web Development', 'A workshop on modern web design trends will be held on 20th September in Lab 3.', '2025-09-13 09:15:00'),
(4, 'Placement Drive', 'Infosys campus placement drive will be conducted on 25th September. Register before 20th September.', '2025-09-13 10:50:00'),
(5, 'Library Timing Update', 'Library will remain open till 8:00 PM during exam week for student convenience.', '2025-09-11 05:45:00'),
(6, 'Guest Lecture on AI', 'A guest lecture on Artificial Intelligence will be conducted by industry experts.', '2025-09-15 05:30:00'),
(7, 'Sports Day Announcement', 'Annual Sports Day will be held on 20th September at the college ground.', '2025-09-15 04:00:00'),
(8, 'Scholarship Deadline', 'Students are reminded that the last date to apply for scholarships is 18th September.', '2025-09-14 07:15:00'),
(9, 'Hackathon Event', 'A 24-hour hackathon will be organized by the CSE department on 22nd September.', '2025-09-16 04:45:00'),
(10, 'Blood Donation Camp', 'A blood donation camp will be held in collaboration with Red Cross on 25th September.', '2025-09-17 08:30:00'),
(11, 'job', 'sdfghg', '2025-09-15 10:19:52'),
(12, 'isha', 'rshgfdkcvbajk,', '2025-09-15 12:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `resume` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `student_id`, `job_title`, `company_name`, `status`, `applied_at`, `resume`) VALUES
(1, 1, 'HR', 'TCL', 'Rejected', '2025-09-19 07:35:21', '1758267321_CV_K.pdf'),
(2, 1, 'HR', 'asd', 'Rejected', '2025-09-24 04:52:54', '1758689574_roll_no-07.pdf'),
(3, 19, 'HR', 'TCL', 'Accepted', '2025-09-24 05:32:49', '1758691969_white simple student cv resume.pdf'),
(5, 3, 'HX', 'TCL', 'Pending', '2025-10-01 05:31:16', NULL),
(15, 3, 'esgs', 'awsrftry', 'Pending', '2025-10-09 05:32:18', NULL),
(23, 3, 'esgs', 'awsrftry', 'Pending', '2025-10-09 05:32:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `company` varchar(150) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `deadline` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `company`, `dept`, `deadline`, `created_at`) VALUES
(3, 'Data Analyst', 'Wipro', 'CSE', '2025-09-28', '2025-09-12 09:00:00'),
(6, 'Software Developer', 'TCS123', 'CSE', '2025-09-30', '2025-09-14 09:32:14'),
(7, 'Web Developer Intern', 'Infosys', 'CSE', '2025-10-05', '2025-09-14 09:32:14'),
(8, 'Data Analyst', 'Wipro', 'CSE', '2025-10-12', '2025-09-14 09:32:14'),
(9, 'AI/ML Engineer', 'Google', 'CSE', '2025-10-20', '2025-09-14 09:32:14'),
(10, 'Cybersecurity Analyst', 'IBM', 'CSE', '2025-10-25', '2025-09-14 09:32:14'),
(11, 'Embedded Systems Engineer', 'Bosch', 'ECE', '2025-09-28', '2025-09-14 09:32:35'),
(12, 'VLSI Design Trainee', 'Intel', 'ECE', '2025-10-10', '2025-09-14 09:32:35'),
(13, 'Telecom Engineer', 'Nokia', 'ECE', '2025-10-15', '2025-09-14 09:32:35'),
(14, 'Chip Design Engineer', 'Qualcomm', 'ECE', '2025-10-22', '2025-09-14 09:32:35'),
(15, 'Automation Engineer', 'Samsung', 'ECE', '2025-10-27', '2025-09-14 09:32:35'),
(16, 'Mechanical Design Engineer', 'Tata Motors', 'ME', '2025-09-25', '2025-09-14 09:32:52'),
(17, 'Production Engineer', 'L&T', 'ME', '2025-10-08', '2025-09-14 09:32:52'),
(18, 'Quality Engineer', 'Mahindra', 'ME', '2025-10-13', '2025-09-14 09:32:52'),
(19, 'Automobile Engineer', 'Ashok Leyland', 'ME', '2025-10-18', '2025-09-14 09:32:52'),
(20, 'Manufacturing Engineer', 'Hero MotoCorp', 'ME', '2025-10-24', '2025-09-14 09:32:52'),
(21, 'Site Engineer', 'Gammon India', 'CE', '2025-09-27', '2025-09-14 09:33:05'),
(22, 'Structural Engineer', 'Shapoorji Pallonji', 'CE', '2025-10-12', '2025-09-14 09:33:05'),
(23, 'Construction Manager', 'L&T Constructions', 'CE', '2025-10-17', '2025-09-14 09:33:05'),
(24, 'Highway Engineer', 'GMR Infra', 'CE', '2025-10-21', '2025-09-14 09:33:05'),
(25, 'Environmental Engineer', 'Jacobs', 'CE', '2025-10-28', '2025-09-14 09:33:05'),
(26, 'Electrical Engineer', 'Siemens', 'EE', '2025-09-29', '2025-09-14 09:33:17'),
(27, 'Power Systems Analyst', 'Adani Power', 'EE', '2025-10-07', '2025-09-14 09:33:17'),
(28, 'Control Engineer', 'ABB', 'EE', '2025-10-14', '2025-09-14 09:33:17'),
(29, 'Energy Consultant', 'NTPC', 'EE', '2025-10-19', '2025-09-14 09:33:17'),
(30, 'Instrumentation Engineer', 'BHEL', 'EE', '2025-10-26', '2025-09-14 09:33:17'),
(31, 'Business Analyst', 'Deloitte', 'MBA', '2025-09-26', '2025-09-14 09:33:30'),
(32, 'Finance Intern', 'KPMG', 'MBA', '2025-10-09', '2025-09-14 09:33:30'),
(33, 'Marketing Executive', 'HDFC Bank', 'MBA', '2025-10-16', '2025-09-14 09:33:30'),
(36, 'Cybersecurity Analyst', 'TCL', 'CSE', '2025-09-16', '2025-09-14 15:52:46'),
(37, 'Highway Engineer', 'Wipro', 'ME', '2025-09-09', '2025-09-14 15:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Riya Sharma', 'riya.sharma@example.com', 'I would like to know more about the internship opportunities.', '2025-09-10 05:00:00'),
(2, 'Amit Patel', 'amit.patel@example.com', 'The placement portal is not loading on my mobile, please check.', '2025-09-11 04:15:00'),
(3, 'Kavya Mehta', 'kavya.mehta@example.com', 'Can you extend the job application deadline for Infosys?', '2025-09-12 08:50:00'),
(4, 'Arjun Singh', 'arjun.singh@example.com', 'I lost my password. How can I reset it?', '2025-09-12 10:40:00'),
(5, 'Sneha Reddy', 'sneha.reddy@example.com', 'Great work on the new placement management system!', '2025-09-13 06:25:00'),
(6, 'Rose patel', 'rosepatel@gmail.com', 'Hello.....', '2025-09-16 09:54:37');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enrollment` varchar(20) NOT NULL,
  `course` varchar(30) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `dept`, `created_at`, `enrollment`, `course`, `semester`) VALUES
(1, 'Aarav Sharma', 'aarav.sharma@example.com', 'pass123', 'CSE', '2025-09-15 10:29:04', '23001', 'B.Tech', 5),
(2, 'Priya Patel', 'priya.patel@example.com', 'pass456', 'ECE', '2025-09-15 10:29:04', '54002', 'B.Tech', 6),
(3, 'Rohan Mehta', 'rohan.mehta@example.com', 'pass789', 'ME', '2025-09-15 10:29:04', '34003', 'B.Tech', 7),
(4, 'Sneha Singh', 'sneha.singh@example.com', 'pass321', 'CE', '2025-09-15 10:29:04', '67004', 'B.Tech', 4),
(5, 'Karan Desai', 'karan.desai@example.com', 'pass654', 'EE', '2025-09-15 10:29:04', '87005', 'B.Tech', 8),
(6, 'Isha Verma', 'isha.verma@example.com', 'pass987', 'MBA', '2025-09-15 10:29:04', '45006', 'MBA', 2),
(7, 'Manav Joshi', 'manav.joshi@example.com', 'pass159', 'CSE', '2025-09-15 10:29:04', '67007', 'B.Tech', 6),
(8, 'Neha Gupta', 'neha.gupta@example.com', 'pass753', 'ECE', '2025-09-15 10:29:04', '09008', 'B.Tech', 3),
(9, 'Raj Malhotra', 'raj.malhotra@example.com', 'pass852', 'ME', '2025-09-15 10:29:04', '53009', 'B.Tech', 7),
(10, 'Diya Nair', 'diya.nair@example.com', 'pass951', 'CSE', '2025-09-15 10:29:04', '80010', 'B.Tech', 5),
(12, 'Ananya Rao', 'ananya.rao@example.com', 'pass852', 'CSE', '2025-09-15 10:29:04', '12012', 'B.Tech', 4),
(13, 'Mohit Jain', 'mohit.jain@example.com', 'pass963', 'EEE', '2025-09-15 10:29:04', '56013', 'B.Tech', 6),
(14, 'Simran Kaur', 'simran.kaur@example.com', 'pass147', 'CSE', '2025-09-15 10:29:04', '78014', 'B.Tech', 2),
(15, 'Aditya Kapoor', 'aditya.kapoor@example.com', 'pass258', 'ME', '2025-09-15 10:29:04', '63015', 'B.Tech', 8),
(18, 'Ramesh', 'ramesh@gmail.com', '12345678', 'CS', '2025-09-16 15:50:33', '782948908', 'BCA', 5),
(19, 'kruti', 'krutibhesaniya10@gmail.com', '123456', 'CS', '2025-09-24 05:31:23', '234', 'BCA', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
