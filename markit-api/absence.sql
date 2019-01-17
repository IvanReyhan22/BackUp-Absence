-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2019 at 09:10 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absence`
--

-- --------------------------------------------------------

--
-- Table structure for table `kantor`
--

CREATE TABLE `kantor` (
  `kantor_id` varchar(100) NOT NULL,
  `nama_kantor` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kantor`
--

INSERT INTO `kantor` (`kantor_id`, `nama_kantor`, `alamat`) VALUES
('Ezy Industries21', 'Ezy', 'Kauman');

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `lokasi` varchar(100) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `admin_id` varchar(100) NOT NULL,
  `kantor_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(100) NOT NULL,
  `profile` varchar(32) NOT NULL,
  `name` varchar(100) NOT NULL,
  `kantor_id` varchar(100) NOT NULL,
  `divisi` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `profile`, `name`, `kantor_id`, `divisi`, `email`, `password`, `status`) VALUES
(1, 'pic00', 'resamic', 'hiphopan', 'rapper mbliyut', 'resamic@gmail.com', '2b6ecdc3f123a384880512100f81910b', 'user'),
(5, 'picpico', 'resamic', 'hiphopan', 'rapper mbliyut', 'oyi', '5d8422ef9f2665fa5f0b7cb6fa944ec5', 'user'),
(7, 'picpico', 'resamic', 'hiphopan', 'rapper mbliyut', 'osiae', '5d8422ef9f2665fa5f0b7cb6fa944ec5', 'user'),
(8, 'darawat', 'anying', 'rumahan', 'tukang', 'aye', 'e5584e7a1cfc071848821aabc2144fc9', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kantor`
--
ALTER TABLE `kantor`
  ADD PRIMARY KEY (`kantor_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
