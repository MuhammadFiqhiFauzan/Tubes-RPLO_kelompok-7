-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 10:02 AM
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
-- Database: `bank_sampah`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_harga`
--

CREATE TABLE `daftar_harga` (
  `id` int(11) NOT NULL,
  `jenis_sampah` varchar(50) NOT NULL,
  `harga_per_kg` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_harga`
--

INSERT INTO `daftar_harga` (`id`, `jenis_sampah`, `harga_per_kg`) VALUES
(1, 'Plastik', 5000),
(2, 'Kertas', 3000),
(3, 'Kaleng', 7000),
(4, 'Botol Kaca', 4000);

-- --------------------------------------------------------

--
-- Table structure for table `setor_sampah`
--

CREATE TABLE `setor_sampah` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jenis_sampah` varchar(50) NOT NULL,
  `berat` double NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setor_sampah`
--

INSERT INTO `setor_sampah` (`id`, `user_id`, `jenis_sampah`, `berat`, `tanggal`, `total_harga`) VALUES
(1, 1, 'Kaleng', 2, '2024-12-17', 14000),
(2, 1, 'Plastik', 1, '2024-12-17', 5000),
(3, 1, 'Plastik', 0.03, '2024-12-17', 150),
(4, 2, 'Plastik', 2, '2024-12-21', 10000),
(5, 2, 'Botol Kaca', 3, '2024-12-21', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `saldo` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `password`, `role`, `saldo`) VALUES
(1, 'hadid', '$2y$10$i7Q0SBfr3v2AuIFanA7wUeVUtoW0u6gUZP10T.jwflbrD05c5Mnyy', 'user', 19150),
(2, 'andika', '$2y$10$Imq8R/XNrofarHz3pwt5O.UMXM8xYmHRqsBJcFUrXPH/gDTJutoUG', 'user', 22000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_harga`
--
ALTER TABLE `daftar_harga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setor_sampah`
--
ALTER TABLE `setor_sampah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_harga`
--
ALTER TABLE `daftar_harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `setor_sampah`
--
ALTER TABLE `setor_sampah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `setor_sampah`
--
ALTER TABLE `setor_sampah`
  ADD CONSTRAINT `setor_sampah_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
