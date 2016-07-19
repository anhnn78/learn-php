-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2016 at 08:43 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sinhvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MaSV` varchar(6) NOT NULL,
  `TenSV` varchar(30) NOT NULL,
  `DiaChi` varchar(50) NOT NULL,
  `Tuoi` int(3) NOT NULL,
  `GioiTinh` int(1) NOT NULL,
  `QuocGia` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`MaSV`, `TenSV`, `DiaChi`, `Tuoi`, `GioiTinh`, `QuocGia`) VALUES
('A', 'abc', 'A', 21, 1, 'abc'),
('AB0001', 'Trần Văn Chính', '14B Bình Thạnh', 21, 0, 'VN'),
('AB0002', 'Lê Thị Hiền', '63 Trường Chinh , Hà Nội', 20, 0, 'US'),
('AB0003', 'Lê Quỳnh Như', '103 Trường Trinh', 21, 0, 'VN'),
('b', 'c', 'c', 21, 1, 'c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MaSV`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
