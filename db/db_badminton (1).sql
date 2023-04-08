-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 05:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_badminton`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bad`
--

CREATE TABLE `tb_bad` (
  `b_id` int(11) NOT NULL,
  `ma_id` int(11) NOT NULL,
  `b_name` int(11) NOT NULL,
  `b_date` date NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_court`
--

CREATE TABLE `tb_court` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_date` date NOT NULL,
  `c_status` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_court`
--

INSERT INTO `tb_court` (`c_id`, `c_name`, `c_date`, `c_status`, `u_id`) VALUES
(1, 'FBT-7', '2023-04-07', 1, 3),
(2, 'FBT-8', '2023-04-07', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_date`
--

CREATE TABLE `tb_date` (
  `d_id` int(11) NOT NULL,
  `d_date` date NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_date`
--

INSERT INTO `tb_date` (`d_id`, `d_date`, `u_id`) VALUES
(1, '2023-04-09', 2),
(2, '2023-04-08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_match`
--

CREATE TABLE `tb_match` (
  `ma_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `ma_num` int(11) NOT NULL,
  `ma_date` date NOT NULL,
  `ma_status` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_match`
--

INSERT INTO `tb_match` (`ma_id`, `c_id`, `ma_num`, `ma_date`, `ma_status`, `u_id`) VALUES
(17, 1, 1, '2023-04-07', 1, 3),
(18, 1, 2, '2023-04-07', 1, 3),
(19, 1, 3, '2023-04-07', 1, 3),
(20, 1, 4, '2023-04-07', 1, 3),
(21, 1, 5, '2023-04-07', 1, 3),
(22, 2, 1, '2023-04-07', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_match_data`
--

CREATE TABLE `tb_match_data` (
  `md_id` int(11) NOT NULL,
  `ma_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `md_date` date NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_match_data`
--

INSERT INTO `tb_match_data` (`md_id`, `ma_id`, `m_id`, `md_date`, `u_id`) VALUES
(4, 18, 1, '2023-04-07', 3),
(5, 19, 2, '2023-04-07', 3),
(6, 20, 4, '2023-04-07', 3),
(7, 21, 5, '2023-04-07', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `m_date` date NOT NULL,
  `m_status` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`m_id`, `m_name`, `m_date`, `m_status`, `u_id`) VALUES
(1, 'จามร', '2023-04-07', 1, 3),
(2, 'j', '2023-04-07', 1, 3),
(3, 'J', '2023-04-07', 0, 3),
(4, 'พี่หนึ่ง', '2023-04-07', 1, 3),
(5, 'เอก', '2023-04-07', 1, 3),
(6, 'แคท', '2023-04-07', 0, 3),
(7, 'มิ้ม', '2023-04-07', 0, 3),
(8, 'พี่แบงค์', '2023-04-07', 0, 3),
(9, 'อาร์ม', '2023-04-07', 0, 3),
(10, 'ไผ่', '2023-04-07', 0, 3),
(11, 'ไฮ้', '2023-04-07', 0, 3),
(12, 'บุ้ง', '2023-04-07', 0, 3),
(13, 'J', '2023-04-07', 0, 2),
(14, 'j', '2023-04-07', 0, 2),
(15, '1', '2023-04-07', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `u_id` int(11) NOT NULL,
  `u_username` varchar(255) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_team` varchar(255) NOT NULL,
  `u_tel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`u_id`, `u_username`, `u_password`, `u_name`, `u_team`, `u_tel`) VALUES
(2, 'jamorn.pe', '$2y$10$XPV.2peFJUqe2zzBRe7vue2pCHY1dy9UsrkPVxFNXjXe7MbBBgwCy', 'จามร เพ็งสวย', 'JT-Badminton', '0868082435'),
(3, 'aek', '$2y$10$cDMj1fZ5et3t4YWrgXHQj.6H7/0sdZAYqnm/y8bIR0GNZumA12lNK', 'เอกภพ', 'Dukduk', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bad`
--
ALTER TABLE `tb_bad`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `tb_court`
--
ALTER TABLE `tb_court`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tb_date`
--
ALTER TABLE `tb_date`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `tb_match`
--
ALTER TABLE `tb_match`
  ADD PRIMARY KEY (`ma_id`);

--
-- Indexes for table `tb_match_data`
--
ALTER TABLE `tb_match_data`
  ADD PRIMARY KEY (`md_id`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bad`
--
ALTER TABLE `tb_bad`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_court`
--
ALTER TABLE `tb_court`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_date`
--
ALTER TABLE `tb_date`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_match`
--
ALTER TABLE `tb_match`
  MODIFY `ma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_match_data`
--
ALTER TABLE `tb_match_data`
  MODIFY `md_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
