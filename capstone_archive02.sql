-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 07:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone_archive02`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastName` text NOT NULL,
  `firstName` text NOT NULL,
  `middleName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `password`, `lastName`, `firstName`, `middleName`) VALUES
('admin2023_01', 'admin123', 'Cayaban', 'Cedric Joel', 'Fernandez');

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `blockID` int(11) NOT NULL,
  `blockName` varchar(255) NOT NULL,
  `professorID` varchar(255) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `year` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`blockID`, `blockName`, `professorID`, `semester`, `year`) VALUES
(1, '3A', 'prof2023_01', '1st Semester', '2023'),
(2, '4B', 'prof2023_01', '1st Semester', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `majorID` int(11) NOT NULL,
  `majorName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`majorID`, `majorName`) VALUES
(1001, 'Web and Mobile Development'),
(1002, 'Data Analytics'),
(1003, 'Networking');

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `professorID` varchar(255) NOT NULL,
  `adminID` varchar(255) NOT NULL DEFAULT 'admin2023_01',
  `password` varchar(255) NOT NULL,
  `lastName` text NOT NULL,
  `firstName` text NOT NULL,
  `middleName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`professorID`, `adminID`, `password`, `lastName`, `firstName`, `middleName`) VALUES
('prof2023_01', 'admin2023_01', 'prof123', 'Doe', 'John', 'Alpha');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentID` varchar(255) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `middleName` text NOT NULL,
  `blockID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_capstones`
--

CREATE TABLE `uploaded_capstones` (
  `capstoneID` int(11) NOT NULL,
  `majorID` int(11) NOT NULL,
  `capstoneTitle` text NOT NULL,
  `capstoneAbstract` mediumtext NOT NULL,
  `dateCreated` varchar(50) NOT NULL,
  `fileContent` text NOT NULL,
  `dateFileUploaded` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploaded_capstones`
--

INSERT INTO `uploaded_capstones` (`capstoneID`, `majorID`, `capstoneTitle`, `capstoneAbstract`, `dateCreated`, `fileContent`, `dateFileUploaded`, `status`) VALUES
(1, 1001, 'Online Information Management System for Internship', 'Dealing with tangible documents or hard copies wastes time and money in a paper- based office. As a result, in a paper-based office, a storage area for many documents is essential. A paper-based office is responsible for budgeting for file-keeping expenses such as envelopes, paper folders, drawers, and so on. These issues are now being addressed by digitization, thanks to technological advancements. The time wasted in carrying hard copies from one department to another is solved via networks within the workplace by turning to digitalization, such as transforming physical documents into a computer file, also known as softcopy.\r\n\r\nSince the documents are now a softcopy, maintaining a storage space is also solved, thus making the office more cost-effective. Most of the offices, like some academic institutes in The Philippines, still runs on paper-based offices. Paper-based offices run most transactions done in PSU-UCC. The hardcopy files submitted by students undergoing internship, or On-the-Job Training are affected.\r\n\r\nThe developers decided to create the \'Online Information Management System for Internship\' application, which aims to create a softcopy counterpart of all forms and reports associated with a student\'s internship, and these softcopies will replace the hardcopies while also assisting in the transition from paper-based documentation to digitalized documentation. The campus can use this program to look up and examine credible records that might help them decide how to handle various scenarios that arise during their students\' internships.\r\n', '2022-02', 'Online Information Management System For Internship.pdf', '2023-12-17', 'approved'),
(2, 1001, 'Attendance Monitoring System for Math Excellence Academy of Binalonan Inc.', 'Math Excellence Academy of Binalonan (MEAB) located at Binalonan Pangasinan is the subject of the study. It is important that MEAB must implement Attendance Monitoring System to handle raised issues on managing and recording of attendance of the students and employees which are done manually. The main objective of this study is to design and develop an Attendance Monitoring System for Math Excellence Academy of Binalonan that would help employees and students in recording of their attendance and generating reports such as employee\'s DTR. Attendance Monitoring System for Math Excellence Academy of Binalonan is a Windows Form Application that is used in checking the students\' and employees\' daily attendance and to update the parents of the students through SMS notification. The Attendance Monitoring System was designed and developed using Rapid Application Development, with the used of various data gathering instruments such as checklist, interview, work observation, documentary analysis as well as usability testing.\r\nThe usability of the developed system was evaluated based on Software Usability Measurement Inventory (SUMI). The system is proven to be usable in terms of efficiency, affect, helpfulness, control and learnability for the system has met the requirements of the end users and conforms to the MEAB. The developed system will provide quality service and eventually provide efficient data management, thus, the system provide faster, organized, accurate and reliable information and records.', '2016-05', 'ATTENDANCE MONITORING SYSTEM FOR MATH EXCELLENCE ACADEMY OF BINALONAN Inc..pdf', '2023-12-17', 'pending'),
(3, 1001, 'Academic Management System For Juan G. Macaraeg National High School', 'With the continuous and dynamic change in almost all aspects of human activities, school personnels cannot afford to remain static on their respective professional concern. Professionals are therefore obliged to continually improvise in order to respond to the changing environment brought about by global competitiveness.\r\nThus, the researchers took the opportunity to propose an automated system for Juan G. Macaraeg National High School. The proposed project is expected to increase work productivity and efficiency of the teachers in the management of student\'s grades, of the registrar in the management of enrollment and of the cashiers in the management of payments. \r\nIn addition the proposed project is capable of producing academic reports such as Form 137A, Form 138, Diploma, Enrollment Notification Assessment Notification and Official Receipts.\r\nThe proposed project was systematically designed to automate the existing manual operation of the said school. \r\nDevelopment with the Rapid Application Methodology, the researchers objectives would be successfully achieved and implemented.\r\nThe proposed Academic Management System was found to be economically feasible and would provide various services faster, more accurate and more systematic.\r\n', '2012-03', '2012 Academic Management System for Juan G. Macaraeg National High School.pdf', '2023-12-17', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` varchar(255) NOT NULL,
  `majorID` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastName` text NOT NULL,
  `firstName` text NOT NULL,
  `middleName` text NOT NULL,
  `adminID` varchar(255) NOT NULL DEFAULT 'admin2023_01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `majorID`, `password`, `lastName`, `firstName`, `middleName`, `adminID`) VALUES
('21-UR-0018', 1001, '123123', 'Biag', 'Joreson Mark', 'Banga', 'admin2023_01'),
('21-UR-0019', 1001, '111', 'Cayaban', 'Cedric Joel', 'Fernandez', 'admin2023_01'),
('21-UR-0216', 1001, '123qwe', 'Galano', 'Dan', 'Macaraeg', 'admin2023_01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`blockID`),
  ADD KEY `prof_FK1` (`professorID`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`majorID`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`professorID`),
  ADD KEY `AdminID_FK2` (`adminID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentID`),
  ADD KEY `block_FK1` (`blockID`);

--
-- Indexes for table `uploaded_capstones`
--
ALTER TABLE `uploaded_capstones`
  ADD PRIMARY KEY (`capstoneID`),
  ADD KEY `majorID_FK2` (`majorID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `majorID_FK1` (`majorID`),
  ADD KEY `adminID_FK1` (`adminID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `blockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `majorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT for table `uploaded_capstones`
--
ALTER TABLE `uploaded_capstones`
  MODIFY `capstoneID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `block`
--
ALTER TABLE `block`
  ADD CONSTRAINT `prof_FK1` FOREIGN KEY (`professorID`) REFERENCES `professor` (`professorID`);

--
-- Constraints for table `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `AdminID_FK2` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `block_FK1` FOREIGN KEY (`blockID`) REFERENCES `block` (`blockID`);

--
-- Constraints for table `uploaded_capstones`
--
ALTER TABLE `uploaded_capstones`
  ADD CONSTRAINT `majorID_FK2` FOREIGN KEY (`majorID`) REFERENCES `major` (`majorID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `adminID_FK1` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`),
  ADD CONSTRAINT `majorID_FK1` FOREIGN KEY (`majorID`) REFERENCES `major` (`majorID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
