-- phpMyAdmin SQL Dump
-- version 5.1.4-dev+20220510.a3bad740fb
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 05:44 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hgiog`
--
CREATE DATABASE IF NOT EXISTS `hgiog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hgiog`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `aid` varchar(256) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `gender` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`aid`, `firstname`, `lastname`, `gender`, `password`) VALUES
('admin', 'Admin', 'Sample', 'M', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `assesser`
--

CREATE TABLE `assesser` (
  `student` text NOT NULL,
  `topic` int(11) NOT NULL,
  `quiz` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assesser`
--

INSERT INTO `assesser` (`student`, `topic`, `quiz`, `date`, `marks`) VALUES
('daniel', 1, 1, '2022-09-23', 33),
('daniel', 1, 1, '2022-09-23', 33),
('daniel', 1, 1, '2022-09-23', 33),
('daniel', 1, 1, '2022-09-23', 33),
('daniel', 1, 1, '2022-09-23', 33),
('daniel', 1, 1, '2022-09-23', 33),
('daniel', 1, 1, '2022-09-23', 100),
('daniel', 1, 1, '2022-09-23', 100),
('daniel', 1, 1, '2022-09-23', 66),
('daniel', 1, 1, '2022-09-23', 0),
('daniel', 1, 1, '2022-09-25', 66),
('daniel', 1, 1, '2022-09-25', 100),
('daniel', 2, 2, '2022-09-29', 100),
('daniel', 4, 6, '2022-09-29', 100),
('daniel', 4, 6, '2022-09-29', 100),
('daniel', 4, 6, '2022-09-29', 0),
('daniel', 5, 8, '2022-10-03', 100),
('daniel', 3, 4, '2022-10-03', 50),
('daniel', 3, 4, '2022-10-03', 100),
('daniel', 1, 12, '2022-10-20', 66),
('daniel', 3, 4, '2022-10-22', 100);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `coid` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `cu` int(11) NOT NULL,
  `topic` int(11) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_units`
--

CREATE TABLE `course_units` (
  `cid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `teacher` text NOT NULL,
  `topics` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_units`
--

INSERT INTO `course_units` (`cid`, `name`, `teacher`, `topics`) VALUES
(1, 'Piano Arts 2', 'Tamale James', '2,3,4,1'),
(2, 'Basic of Guiter', 'Steven John', '1,5,6'),
(3, 'Piano Legends', '', ''),
(4, 'Team Dynamics Edit', '', '6,9');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `queid` int(11) NOT NULL,
  `question` text NOT NULL,
  `p_ans` text NOT NULL,
  `ans` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`queid`, `question`, `p_ans`, `ans`) VALUES
(1, 'How many notes are in solfa notation?', '8 notes|&;7 notes|&;3 notes|&;1 note', 1),
(2, 'Sample question 2?', 'Ans1|&;Ans2|&;Ans3|&;Ans4', 2),
(3, 'Sample question 3?', 'Ans1|&;Ans2|&;Ans3|&;Ans4', 3),
(4, 'Sample question 4?', 'Ans1|&;Ans2|&;Ans3|&;Ans4', 4),
(5, 'Which of the following is a time signature?', '', 0),
(6, 'Which of the following is a time signature?', '', 0),
(7, 'Which of the following is a time signature?', '', 0),
(8, 'What is a key?', 'Answer 1|&;Answer 2', 1),
(9, 'What is a key?', 'RIGHT ANSWER|&;Another answer', 1),
(10, 'What is a key?', '', 0),
(11, 'What is a key?', '', 0),
(12, 'How many notes exist?', 'None|&;7 notes|&;INFINITY|&;3 notes', 2),
(13, 'How many notes exist?', '', 0),
(14, 'How many notes exist?', '', 0),
(15, 'What is a key?', '', 0),
(16, 'Sample qest', 'A1|&;A2|&;A3', 1),
(17, 'q?', 'a1|&;a2', 1),
(18, 'Power?', '', 0),
(19, 'The other question?', '', 0),
(20, 'That is the team?', 'Answer 1|&;Answer 2', 1),
(21, '3rd Question', 'Pulley|&;Sizer|&;Lever|&;', 1),
(22, 'What is the epic?', 'The call of the ages|&;The end of times.|&;The wrong answer|&;Wrong decision.', 1),
(23, 'Are you okay?', 'Any answer|&;Another Answer', 1),
(24, 'The epic?', 'The pic|&;The epi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `qid` int(11) NOT NULL,
  `q_no` int(11) NOT NULL,
  `q1` int(11) NOT NULL,
  `q2` int(11) NOT NULL,
  `q3` int(11) NOT NULL,
  `q4` int(11) NOT NULL,
  `q5` int(11) NOT NULL,
  `q6` int(11) NOT NULL,
  `q7` int(11) NOT NULL,
  `q8` int(11) NOT NULL,
  `q9` int(11) NOT NULL,
  `q10` int(11) NOT NULL,
  `q11` int(11) NOT NULL,
  `q12` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`qid`, `q_no`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`) VALUES
(1, 3, 1, 3, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 2, 12, 23, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 2, 9, 24, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 1, 16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 1, 17, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 1, 18, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 1, 19, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 3, 20, 21, 22, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `sid` varchar(80) NOT NULL,
  `name` text NOT NULL,
  `gender` text NOT NULL,
  `dob` date NOT NULL,
  `cu1` int(11) NOT NULL,
  `cu2` int(11) NOT NULL,
  `password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sid`, `name`, `gender`, `dob`, `cu1`, `cu2`, `password`) VALUES
('brian', 'Buule Brian', 'M', '2000-04-14', 2, 3, 'brian'),
('daniel', 'Tugume Daniel', 'M', '2001-11-05', 1, 2, 'daniel');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `tid` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `gender` text NOT NULL,
  `topics` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`tid`, `name`, `gender`, `topics`, `password`) VALUES
('tr1', 'Tom Duncan', 'F', '3,1,5,2', 'tr1'),
('tr2', 'Mugamba Christopher', 'M', '', 'tr2'),
('tr4', 'Muwonge Ezra', 'M', '1,4,7', 'tr4');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `toid` int(11) NOT NULL,
  `name` text NOT NULL,
  `notes` text NOT NULL,
  `quiz` int(11) NOT NULL,
  `teacher` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`toid`, `name`, `notes`, `quiz`, `teacher`) VALUES
(1, 'Theory of Music', 'files/My Resume.pdf', 12, 'tr41'),
(2, 'Notes', 'files/networking.pdf', 2, 'tr1'),
(3, 'Keys', 'files/MUWONGE EZRA.pdf', 4, 'tr1'),
(4, 'History of Music', 'files/sample.pdf', 6, 'tr4'),
(5, 'Trends of Music', 'files/sample.pdf', 8, 'tr1'),
(6, 'Strings', 'files/sample.pdf', 0, ''),
(7, 'Poetry Mimes', 'files/sample.pdf', 0, 'tr4'),
(8, 'Billiard Experenza', '', 0, ''),
(9, 'Scales and Modes', '', 0, 'tr41');

-- --------------------------------------------------------

--
-- Table structure for table `topics_rating`
--

CREATE TABLE `topics_rating` (
  `student` text NOT NULL,
  `topic` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics_rating`
--

INSERT INTO `topics_rating` (`student`, `topic`, `rating`) VALUES
('daniel', 1, 3),
('daniel', 2, 4),
('daniel', 3, 3),
('daniel', 5, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`coid`),
  ADD KEY `cu` (`cu`),
  ADD KEY `topic` (`topic`);

--
-- Indexes for table `course_units`
--
ALTER TABLE `course_units`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `name` (`name`),
  ADD KEY `topics` (`topics`(768)),
  ADD KEY `topics_2` (`topics`(768));

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`queid`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `cu1` (`cu1`),
  ADD KEY `cu2` (`cu2`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`toid`),
  ADD KEY `notes` (`notes`(768)),
  ADD KEY `quiz` (`quiz`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `coid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_units`
--
ALTER TABLE `course_units`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `queid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `toid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`cu`) REFERENCES `course_units` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
