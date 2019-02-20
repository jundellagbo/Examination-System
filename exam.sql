-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2017 at 10:03 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `auth` text NOT NULL,
  `firstname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `userid`, `password`, `auth`, `firstname`) VALUES
(15, 'admin', '21232f297a57a5a743894a0e4a801fc3', '91fa4a0858a7611c33f8830cd288d83a', 'CPC EE'),
(16, 'mikamo', '9e852e2e6200c90b876f6e69853effb8', '7c4282ff68ffc4f11570f3c245b015ec', 'Mikamo');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `type` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `selection_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `type`, `questionid`, `selection_type`) VALUES
(372, '2', 1, 106, 'select'),
(373, '5', 0, 106, 'select'),
(374, '7', 0, 106, 'select'),
(375, 'Test', 1, 107, 'select'),
(376, 'Aa', 0, 107, 'select'),
(377, 'bb', 0, 107, 'select'),
(378, 'asdasdasd', 1, 108, 'select'),
(379, 'asdasd', 0, 108, 'select'),
(380, 'dada', 0, 108, 'select'),
(381, '2', 0, 109, 'select'),
(382, '5', 1, 109, 'select'),
(383, '10', 0, 109, 'select'),
(384, '4', 0, 109, 'select'),
(385, '50', 1, 110, 'select'),
(386, '20', 0, 110, 'select'),
(387, '30', 0, 110, 'select'),
(388, '53', 0, 110, 'select'),
(389, '50', 0, 111, 'select'),
(390, '20', 0, 111, 'select'),
(391, '30', 1, 111, 'select'),
(392, '40', 0, 111, 'select'),
(393, 'REGION X', 1, 112, 'select'),
(394, 'REGION XI', 0, 112, 'select'),
(395, 'REGION IX', 0, 112, 'select'),
(396, 'REGION XII', 0, 112, 'select'),
(397, 'Malaybalay City', 0, 113, 'select'),
(398, 'Mambahaw City', 0, 113, 'select'),
(399, 'Tubod', 0, 113, 'select'),
(400, 'Cagayan De Oro City', 1, 113, 'select'),
(401, 'Kapuso, Kapatid, Kapamilya', 0, 114, 'select'),
(402, 'Katipunan, Kalayaan Anak ng Bayan', 0, 114, 'select'),
(403, 'Kataas-taas Kagalang-galangan Katipunan anak ng bayan', 1, 114, 'select'),
(404, 'Kausaban, Kauswagan, Kalibogan', 0, 114, 'select'),
(405, 'Happy', 1, 115, 'select'),
(406, 'Sad', 0, 115, 'select'),
(407, 'Worried', 0, 115, 'select'),
(408, 'Scared', 0, 115, 'select'),
(409, 'Cebu', 0, 116, 'select'),
(410, 'Bohol', 0, 116, 'select'),
(411, 'Mactan', 1, 116, 'select'),
(412, 'Siquijor', 0, 116, 'select'),
(413, 'Larger Desktop', 1, 117, 'select'),
(414, 'Larger Disk', 0, 117, 'select'),
(415, 'Larger Development', 0, 117, 'select'),
(416, 'Larger Device', 0, 117, 'select'),
(417, 'Aristotle', 0, 118, 'select'),
(418, 'Rene Descartes', 0, 118, 'select'),
(419, 'Albert Einstein', 0, 118, 'select'),
(420, 'Robert Hooke', 1, 118, 'select'),
(421, 'Love is unconditional feelings', 1, 119, 'multiple'),
(422, 'Love is complicated', 1, 119, 'multiple'),
(423, 'Love is strange', 1, 119, 'multiple'),
(424, 'Love is happiness', 1, 119, 'multiple'),
(425, 'a process of equating', 1, 120, 'select'),
(426, 'an element affecting', 0, 120, 'select'),
(427, 'a formal statement', 0, 120, 'select'),
(428, 'a branch of math', 0, 120, 'select'),
(429, 'To put a test', 0, 121, 'select'),
(430, 'To make an often tentative or experimental effort to perform', 1, 121, 'select'),
(431, 'To make a paragraph', 0, 121, 'select'),
(432, 'To do an extra effort', 0, 121, 'select'),
(433, 'Paranthesis, Equation, Multiplication, Division, Addition, Subtraction', 1, 122, 'select'),
(434, 'Photograph, Equate, Multiply, Divide, Add, Subtract', 0, 122, 'select'),
(435, 'Positive, Equivalent, Meeting, Deducting, Adding, Sub', 0, 122, 'select'),
(436, 'Parent, Elder, Mom, Dad, Ancestor, Sister', 0, 122, 'select'),
(437, 'A positive number', 0, 123, 'select'),
(438, 'A negative number', 0, 123, 'select'),
(439, 'A both positive and negative number', 1, 123, 'select'),
(440, 'A decimal number', 0, 123, 'select'),
(441, '122', 1, 124, 'select'),
(442, '112', 0, 124, 'select'),
(443, '132', 0, 124, 'select'),
(444, '142', 0, 124, 'select'),
(445, '1', 0, 125, 'select'),
(446, '2', 0, 125, 'select'),
(447, '3', 1, 125, 'select'),
(448, '4', 0, 125, 'select'),
(449, '10000', 1, 126, 'select'),
(450, '1000', 0, 126, 'select'),
(451, '100', 0, 126, 'select'),
(452, '100000', 0, 126, 'select'),
(453, '25', 1, 127, 'select'),
(454, '24', 0, 127, 'select'),
(455, '23', 0, 127, 'select'),
(456, '22', 0, 127, 'select'),
(457, 'independent', 0, 128, 'select'),
(458, 'noticeable', 0, 128, 'select'),
(459, 'clear', 1, 128, 'select'),
(460, 'sabutable', 0, 128, 'select');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department` varchar(50) NOT NULL,
  `userauth` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`, `userauth`) VALUES
(6, 'BSIT ', '91fa4a0858a7611c33f8830cd288d83a'),
(9, 'BSHRM', '91fa4a0858a7611c33f8830cd288d83a'),
(10, 'BSE', '91fa4a0858a7611c33f8830cd288d83a'),
(11, 'BEED', '91fa4a0858a7611c33f8830cd288d83a');

-- --------------------------------------------------------

--
-- Table structure for table `examinee`
--

CREATE TABLE `examinee` (
  `id` int(11) NOT NULL,
  `examurl` text NOT NULL,
  `userid` int(11) NOT NULL,
  `teacher` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examinee`
--

INSERT INTO `examinee` (`id`, `examurl`, `userid`, `teacher`) VALUES
(88, 'c43c3c62ddc1841638584ed25d0c2a96', 15, '91fa4a0858a7611c33f8830cd288d83a'),
(89, 'c43c3c62ddc1841638584ed25d0c2a96', 16, '91fa4a0858a7611c33f8830cd288d83a'),
(90, 'c43c3c62ddc1841638584ed25d0c2a96', 17, '91fa4a0858a7611c33f8830cd288d83a'),
(91, 'c43c3c62ddc1841638584ed25d0c2a96', 19, '91fa4a0858a7611c33f8830cd288d83a'),
(92, '6d8d6e75e00e3b4fabf9ea881ed3d2a1', 16, '91fa4a0858a7611c33f8830cd288d83a'),
(93, '6d8d6e75e00e3b4fabf9ea881ed3d2a1', 17, '91fa4a0858a7611c33f8830cd288d83a'),
(94, '6d8d6e75e00e3b4fabf9ea881ed3d2a1', 18, '91fa4a0858a7611c33f8830cd288d83a'),
(95, '6d8d6e75e00e3b4fabf9ea881ed3d2a1', 19, '91fa4a0858a7611c33f8830cd288d83a'),
(96, '6d8d6e75e00e3b4fabf9ea881ed3d2a1', 20, '91fa4a0858a7611c33f8830cd288d83a');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `auth` text NOT NULL,
  `userauth` text NOT NULL,
  `passing` int(11) DEFAULT NULL,
  `semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `auth`, `userauth`, `passing`, `semester`) VALUES
(29, 'Entrance Examination-2017', 'c43c3c62ddc1841638584ed25d0c2a96', '91fa4a0858a7611c33f8830cd288d83a', 6, '1st Semester'),
(30, 'Entrance Examination-2017', '6d8d6e75e00e3b4fabf9ea881ed3d2a1', '91fa4a0858a7611c33f8830cd288d83a', 6, '2nd Semester');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `examination_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `examination_url`) VALUES
(106, 'Math: What is the of 7 - 5', '65fc4fc47cc747703533db79165cb248'),
(107, 'Science: What is Physics?', '65fc4fc47cc747703533db79165cb248'),
(108, 'aaosdklaskdasd', '6784e72673c646bfedf5b5db441fc4be'),
(109, 'eng', 'c43c3c62ddc1841638584ed25d0c2a96'),
(110, '100-50', 'c43c3c62ddc1841638584ed25d0c2a96'),
(111, '20+10', 'c43c3c62ddc1841638584ed25d0c2a96'),
(112, 'In what region where Bukidnon found?', 'c43c3c62ddc1841638584ed25d0c2a96'),
(113, 'What is the capital city of misamis oriental?', 'c43c3c62ddc1841638584ed25d0c2a96'),
(114, 'What is KKK?', 'c43c3c62ddc1841638584ed25d0c2a96'),
(115, 'How was your day?', 'c43c3c62ddc1841638584ed25d0c2a96'),
(116, 'Where did Magellan and Lapu-lapu fight?', 'c43c3c62ddc1841638584ed25d0c2a96'),
(117, 'What is the meaning of LG?', 'c43c3c62ddc1841638584ed25d0c2a96'),
(118, 'Who discover the cells in cork?', 'c43c3c62ddc1841638584ed25d0c2a96'),
(119, 'What is love?', '6d8d6e75e00e3b4fabf9ea881ed3d2a1'),
(120, 'What is equation?', '6d8d6e75e00e3b4fabf9ea881ed3d2a1'),
(121, 'What is an essay?', '6d8d6e75e00e3b4fabf9ea881ed3d2a1'),
(122, 'What is the meaning of PEMDAS?', '6d8d6e75e00e3b4fabf9ea881ed3d2a1'),
(123, 'What is a rational numbers?', '6d8d6e75e00e3b4fabf9ea881ed3d2a1'),
(124, '200-78', '6d8d6e75e00e3b4fabf9ea881ed3d2a1'),
(125, 'What is the modulo of 9?', '6d8d6e75e00e3b4fabf9ea881ed3d2a1'),
(126, '100 x 100?', '6d8d6e75e00e3b4fabf9ea881ed3d2a1'),
(127, '50 / 2 ?', '6d8d6e75e00e3b4fabf9ea881ed3d2a1'),
(128, 'What is vivid?', '6d8d6e75e00e3b4fabf9ea881ed3d2a1');

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `id` int(11) NOT NULL,
  `exam_url` text NOT NULL,
  `userid` text NOT NULL,
  `score` int(11) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `date_taken` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `remarks`
--

INSERT INTO `remarks` (`id`, `exam_url`, `userid`, `score`, `remarks`, `date_taken`) VALUES
(31, '65fc4fc47cc747703533db79165cb248', '15', 2, 'Passed', '13/10/2017 06:29:59am'),
(34, '6784e72673c646bfedf5b5db441fc4be', '15', 0, 'Failed', '13/10/2017 06:57:23am'),
(35, 'c43c3c62ddc1841638584ed25d0c2a96', '15', 1, 'Failed', '13/10/2017 07:23:44am'),
(38, 'c43c3c62ddc1841638584ed25d0c2a96', '19', 1, 'Failed', '13/10/2017 09:12:32am'),
(39, 'c43c3c62ddc1841638584ed25d0c2a96', '16', 2, 'Passed', '13/10/2017 09:13:45am'),
(40, 'c43c3c62ddc1841638584ed25d0c2a96', '17', 6, 'Passed', '13/10/2017 09:59:12am');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `accessid` varchar(50) NOT NULL,
  `auth` text NOT NULL,
  `admin` text NOT NULL,
  `departmentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `password`, `accessid`, `auth`, `admin`, `departmentid`) VALUES
(16, 'Kimberly', 'menguito', '78a6d0196786eab5feea8b32094cce6e', 'kimmy', 'eca1bfdecee6e9fb16f3d0df77de3f6f', '91fa4a0858a7611c33f8830cd288d83a', 6),
(17, 'gee marie', 'Berdon', '47de9de97f04843d5dad246beb6f8a83', 'gee', '20fc76f324f9f6da5af930ece4977f08', '91fa4a0858a7611c33f8830cd288d83a', 9),
(18, 'Jonah', 'apatan', '3e59f9a3710d62d1d50fbf0770886bdd', 'jonah', 'ba69da12afed3c0f22e90241813fe024', '91fa4a0858a7611c33f8830cd288d83a', 10),
(19, 'juan', 'pedro', 'a94652aa97c7211ba8954dd15a3cf838', 'juan12', '6718dbdc702ae52c4d43803b0a914d9e', '91fa4a0858a7611c33f8830cd288d83a', 9),
(20, 'Maria', 'Jesusa', '263bce650e68ab4e23f28263760b9fa5', 'Maria1', '079ac43b23a3e1ecddf3e1c7dc766155', '91fa4a0858a7611c33f8830cd288d83a', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examinee`
--
ALTER TABLE `examinee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remarks`
--
ALTER TABLE `remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `examinee`
--
ALTER TABLE `examinee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `remarks`
--
ALTER TABLE `remarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
