-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 24, 2022 at 08:22 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `userID`, `name`, `surname`, `lastUpdated`) VALUES
(1, 1, 'Tanaka', 'Kadzunge', '2022-09-18 10:57:52'),
(2, 3, 'TANAKA', 'KADZUNGE', '2022-09-23 22:46:38');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `appointmentUID` varchar(225) NOT NULL,
  `patientID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `appDate` varchar(225) NOT NULL,
  `attendance` int(11) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `appointmentUID`, `patientID`, `doctorID`, `appDate`, `attendance`, `dateAdded`, `lastUpdated`) VALUES
(1, '2542672039b7e98cf2d92421a896d3d0', 16, 2, '2022-11-26T12:00', 0, '2022-09-24 12:09:22', '2022-09-24 11:14:23'),
(2, '0f5267d2571e1ee7d2ec5875f8921f25', 15, 9, '2022-09-28T08:30', 0, '2022-09-24 01:09:06', '2022-09-24 11:06:14'),
(3, '61ce402f3acfa4427fabfd072a0bf924', 15, 9, '2022-10-29T01:11', 0, '2022-09-24 01:09:11', '2022-09-24 11:13:24'),
(4, '4f144c60c817feedeefc75eef828e97b', 15, 2, '2024-02-26T13:14', 0, '2022-09-24 01:09:15', '2022-09-24 11:15:11'),
(5, 'cafd47ce1b39170372bc051bac688d2c', 12, 2, '2022-09-25T08:37', 0, '2022-09-24 07:09:38', '2022-09-24 17:38:07'),
(6, '7fe1a2163e0e3275a692643e34ada745', 12, 9, '2022-09-26T12:38', 0, '2022-09-24 07:09:38', '2022-09-24 17:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `doctorID` int(11) NOT NULL,
  `duID` varchar(225) NOT NULL,
  `bloodPressure` int(11) NOT NULL,
  `pulse` int(11) NOT NULL,
  `glucose` int(11) NOT NULL,
  `gcs` int(11) NOT NULL,
  `temp` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `diagnosis` text NOT NULL,
  `additional` text NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dateAdded` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`id`, `userID`, `doctorID`, `duID`, `bloodPressure`, `pulse`, `glucose`, `gcs`, `temp`, `weight`, `height`, `diagnosis`, `additional`, `lastUpdated`, `dateAdded`) VALUES
(1, 12, 9, '2e820e253b38af49e7d2cbd9b000b54c', 2, 2, 3, 12, 2, 3, 1, '2', '', '2022-09-21 09:38:46', '2022-09-21 11:09:38'),
(2, 12, 9, '39da359fca56ccc4e8aeca83875946e6', 5, 5, 65, 3, 34, 78, 100, 'qnwkjwqwqwqwqwqwewq', 'qwnmwqn,mnwqe,mwq', '2022-09-21 14:52:40', '2022-09-21 04:09:52'),
(3, 12, 9, 'a9634bcb8c86658b0012e4b41c8d631f', 67, 99, 90, 13, 40, 100, 170, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2022-09-22 15:16:41', '2022-09-22 05:09:16'),
(4, 16, 9, 'fe7704343cc0d69a030dc29540ed1e20', 84, 75, 190, 15, 32, 79, 40, 'eyes are alegic to pollens.\r\nGood metabolism', 'should exercise more', '2022-09-23 14:16:41', '2022-09-23 04:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--

CREATE TABLE `docs` (
  `id` int(11) NOT NULL,
  `duID` varchar(225) NOT NULL,
  `title` varchar(225) NOT NULL,
  `description` varchar(13000) NOT NULL,
  `source` varchar(225) NOT NULL,
  `ext` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `docs`
--

INSERT INTO `docs` (`id`, `duID`, `title`, `description`, `source`, `ext`, `lastUpdated`) VALUES
(14, '39da359fca56ccc4e8aeca83875946e6', 'nnss', 'sansa', '../documents/632b2654d7bac6.61707935.docx', 'docx', '2022-09-21 14:57:24'),
(15, 'a9634bcb8c86658b0012e4b41c8d631f', 'Heart Scan file', 'the scan of the user heart in pdf format', '../documents/632c7c8726d9d8.07527502.pdf', 'pdf', '2022-09-22 15:17:27'),
(17, 'a9634bcb8c86658b0012e4b41c8d631f', 'xray Scan', 'broken ribs xray scan check', '../documents/632c7e7d9c8773.13918428.jpg', 'jpg', '2022-09-22 15:25:49'),
(18, 'fe7704343cc0d69a030dc29540ed1e20', 'Ribs Xray Scan', 'suspected broken ribs', '../documents/632dbffbc3db23.50916662.pdf', 'pdf', '2022-09-23 14:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `hospital` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `category` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `userID`, `name`, `surname`, `hospital`, `email`, `phone`, `category`, `lastUpdated`) VALUES
(1, 2, 'Mandala', 'Kuluni', 'Parirenyatwa', '', '', 'dentist', '2022-09-18 11:29:33'),
(2, 9, 'KASARURU', 'MAGOO', 'WILKINS HOSPITAL', 'KASARURU@WILKINS.CO.ZW', '0782227773', 'DEMATOLOGIEST', '2022-09-23 23:09:17');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `nationalID` varchar(225) NOT NULL,
  `sex` varchar(225) NOT NULL,
  `dob` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `nextOfKinName` varchar(225) NOT NULL,
  `nextOfKinSurname` varchar(225) NOT NULL,
  `nextOfKinPhone` varchar(225) NOT NULL,
  `medicalAid` varchar(225) NOT NULL,
  `medicalAidPlan` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `userID`, `name`, `surname`, `nationalID`, `sex`, `dob`, `address`, `phone`, `nextOfKinName`, `nextOfKinSurname`, `nextOfKinPhone`, `medicalAid`, `medicalAidPlan`, `lastUpdated`) VALUES
(1, 6, 'PANASHE', 'NDANGA', '', 'f', '2022-09-14', '3777 waterfalls prospect', '7838737733', 'RODRECK', 'NDANGA', '99333002', 'N/A', 'N/A', '2022-09-20 11:20:07'),
(2, 11, 'KUDZAI', 'KURIMA', '', '', '', '', '', '', '', '', '', '', '2022-09-20 09:17:27'),
(3, 12, 'MEME', 'MADZIVA', '99-121222C74', 'f', '2001-01-02', 'N/A', '0873337773', 'OLIVIA', 'CHIKUMBIRO', '899333111', 'Cimas', 'cimals silver', '2022-09-24 18:13:02'),
(4, 13, 'MEME', 'MULEYA', '', '', '', '', '', '', '', '', '', '', '2022-09-22 15:59:35'),
(5, 14, 'MEME', 'KEMUNDA', '', '', '', '', '', '', '', '', '', '', '2022-09-22 16:01:13'),
(6, 15, 'JKSAKJSA', 'NMSASA', '', '', '', '', '', '', '', '', '', '', '2022-09-22 16:04:06'),
(7, 16, 'TERRANCE', 'KADZUNGE', '59-180971R42', 'm', '1996-05-09', '31193 Unit-M Chitungwiza', '0782956402', 'CHRISTINE', 'MUGOMBI', '0775572205', 'Pismas', 'Gold', '2022-09-22 16:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `joint` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`id`, `userID`, `name`, `surname`, `joint`, `address`, `phone`, `email`, `lastUpdated`) VALUES
(1, 8, 'PHARMASIST1', 'PHARMASISTI', '', '', '', '', '2022-09-23 14:49:41'),
(2, 17, 'PHILIP', 'CHIPARIRE', '', '', '8833', '', '2022-09-23 23:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `duID` varchar(225) NOT NULL,
  `pharmacistID` varchar(225) NOT NULL,
  `prescription` varchar(225) NOT NULL,
  `isOffered` int(11) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `dateCollected` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `duID`, `pharmacistID`, `prescription`, `isOffered`, `dateAdded`, `dateCollected`, `lastUpdated`) VALUES
(2, '39da359fca56ccc4e8aeca83875946e6', '0', 'love aint a prescription', 0, '2022-09-22 04:09:16', '', '2022-09-22 14:16:34'),
(3, '39da359fca56ccc4e8aeca83875946e6', '8', 'love is also a prescription', 1, '2022-09-22 04:09:17', '2022-09-24 01:09:41', '2022-09-23 23:41:33'),
(4, 'a9634bcb8c86658b0012e4b41c8d631f', '0', 'Atrovinence x2', 0, '2022-09-22 05:09:21', '', '2022-09-22 15:21:41'),
(5, 'a9634bcb8c86658b0012e4b41c8d631f', '8', 'detonascorcity X1', 1, '2022-09-22 05:09:22', '2022-09-24 02:09:57', '2022-09-24 00:57:55'),
(7, 'a9634bcb8c86658b0012e4b41c8d631f', '0', 'pain killers(prefably paracetamol)', 0, '2022-09-22 05:09:25', '', '2022-09-22 15:25:07'),
(8, 'fe7704343cc0d69a030dc29540ed1e20', '8', 'pain killer(panados)', 1, '2022-09-23 04:09:17', '2022-09-23 07:09:09', '2022-09-23 17:09:31'),
(9, 'fe7704343cc0d69a030dc29540ed1e20', '17', 'precideiis', 1, '2022-09-23 04:09:18', '2022-09-23 07:09:08', '2022-09-23 17:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE `receptionist` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `hospital` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receptionist`
--

INSERT INTO `receptionist` (`id`, `userID`, `name`, `surname`, `hospital`, `lastUpdated`) VALUES
(1, 7, 'RECEPTIONIST1', 'RUSEPT', 'DOCAS MISSIONARY HOSPITAL', '2022-09-23 23:16:15'),
(2, 10, 'RICEPTIONIST2', 'RECEPT2', '', '2022-09-19 11:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `loginID` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` varchar(225) NOT NULL,
  `joined` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `loginID`, `password`, `role`, `joined`, `status`, `lastUpdated`) VALUES
(1, 'tkadz', '$2y$10$z6nVn2tA7Q4EUAjkL7U5PuwdoQFWbHy82zK/QfjGDMm09YIGqugdS', 'admin', '2022-09-18 12:56:26', 1, '2022-09-18 10:57:27'),
(2, 'mandala', '$2y$10$z6nVn2tA7Q4EUAjkL7U5PuwdoQFWbHy82zK/QfjGDMm09YIGqugdS', 'doctor', '2022-09-18 12:56:26', 0, '2022-09-18 12:05:40'),
(3, 'TKADZZZ', '$2y$10$k7VwHu66jRu4NALKKOXo7efDer/Ll0Q1lVKH69EFh6WdOTRoVhaSa', 'admin', '2022-09-18 06:09:15', 1, '2022-09-23 22:46:22'),
(6, 'PATIENT1', '$2y$10$R6N3baTwzuDL0GIOwd0K3.7Wn.J4fL1yNhYDzW8YnoQ1VEnXAeN7.', 'patient', '2022-09-18 06:09:20', 1, '2022-09-18 17:52:56'),
(7, 'RECEPTIONIST', '$2y$10$Oz8TxmULQnhCg0zQoQiSDu4kUsiyAt6CP1Dh/z8TpIyTpozcSRaTa', 'receptionist', '2022-09-18 06:09:21', 1, '2022-09-20 09:01:01'),
(8, 'PHARMASIST1', '$2y$10$PmNc7okL93rDp5pXQkB7euHvcwz3tkHeIc9Hddxrbw0mxVSxxeXq6', 'pharmacist', '2022-09-18 06:09:22', 1, '2022-09-23 14:54:02'),
(9, 'MAGOO', '$2y$10$YzJtVZAI7zz0/IHaTHR9F.XoCB6AXND43JceYJcp8os8LFofw87gW', 'doctor', '2022-09-18 11:09:22', 1, '2022-09-20 13:40:43'),
(10, 'RECIPTI', '', 'receptionist', '2022-09-19 01:09:41', 1, '2022-09-19 11:41:38'),
(11, 'KKURIMA', '$2y$10$jk4oNVpRBWn8DNC3QBBd7.6Z1EC9b9VvXiajsftFdauY2tSUP2/WO', 'patient', '2022-09-20 11:09:17', 1, '2022-09-24 17:36:20'),
(12, 'PETIBYD', '$2y$10$O9pZngaBHd7dVGlyXkL3builmOqh.UYu7DYqp9pFDDc.8oPsnQfV.', 'patient', '2022-09-20 03:09:45', 1, '2022-09-24 17:36:58'),
(13, 'MEMEMULEYA', '', 'patient', '2022-09-22 05:09:59', 1, '2022-09-22 15:59:35'),
(14, 'MEMEKUMUNDA', '', 'patient', '2022-09-22 06:09:01', 1, '2022-09-22 16:01:13'),
(15, 'YHHADD', '', 'patient', '2022-09-22 06:09:04', 1, '2022-09-22 16:04:06'),
(16, 'TKADX', '$2y$10$LYfntdsFTG/PT5kW/wt/gODGqM6KiwjLawTIsLEjVVJrXFINpMRiS', 'patient', '2022-09-22 06:09:11', 1, '2022-09-24 17:18:00'),
(17, 'PARIREPH', '$2y$10$TbRPqrSdmYGBf1vqj45VYeMUEWuVtvHoRMSjyfjz/zvzhrA.wOAUO', 'pharmacist', '2022-09-23 07:09:07', 1, '2022-09-23 23:00:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appointmentUID` (`appointmentUID`);

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `duID` (`duID`);

--
-- Indexes for table `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loginID` (`loginID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `docs`
--
ALTER TABLE `docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pharmacist`
--
ALTER TABLE `pharmacist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `receptionist`
--
ALTER TABLE `receptionist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
