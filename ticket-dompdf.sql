-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2020 at 09:30 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `booking` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `room_count` int(10) NOT NULL,
  `guest_per_room_count` int(10) NOT NULL,
  `breakfast` enum('Termasuk','Tidak Termasuk','','') NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `promo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `customer_id`, `hotel_id`, `room_type`, `room_count`, `guest_per_room_count`, `breakfast`, `check_in`, `check_out`, `promo`) VALUES
(10101010, 1, 1, 'Deluxe Park Double or Twin (Bed and Breakfast)', 1, 2, 'Termasuk', '2019-08-02', '2019-08-06', '-');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('Laki - Laki','Perempuan','','') DEFAULT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `emoney_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `gender`, `birthdate`, `email`, `emoney_id`) VALUES
(1, 'Nova Andre Saputra', 'Laki - Laki', '1999-11-08', 'novaandre.saputraadit@gmail.com', 18111999);

-- --------------------------------------------------------

--
-- Table structure for table `emoney`
--

CREATE TABLE `emoney` (
  `id` int(10) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `topup_id` int(10) NOT NULL,
  `balance` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emoney`
--

INSERT INTO `emoney` (`id`, `client_name`, `topup_id`, `balance`) VALUES
(1, 'Nova Andre Saputra', 8111999, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `telp` bigint(20) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `location`, `telp`, `image`) VALUES
(1, 'Sunway Pyramid Hotel', 'Persiaran Lagoon, Bandar Sunway, 47500.\r\nPetaling Jaya, Selangor, Malaysia, Kuala', 60374928000, 'foto.jpg'),
(2, 'Bumi Surabaya', 'Jalan Basuki Rahmat 106-128\r\nSurabaya 60271', 62315311234, ''),
(3, 'Majapahit', 'Jalan Tunjungan 65-71 Surabaya 60275', 62315454333, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emoney`
--
ALTER TABLE `emoney`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10101011;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emoney`
--
ALTER TABLE `emoney`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
