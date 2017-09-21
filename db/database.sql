-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2017 at 06:32 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `steam_achievers`
--

-- --------------------------------------------------------

--
-- Table structure for table `educational_games`
--

CREATE TABLE `educational_games` (
  `id` int(11) NOT NULL,
  `Author_Name` varchar(255) NOT NULL,
  `Game_Name` varchar(255) NOT NULL,
  `Game_Type` varchar(255) NOT NULL,
  `Game_Description` text NOT NULL,
  `icon` text NOT NULL,
  `game` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `informational_games`
--

CREATE TABLE `informational_games` (
  `id` int(11) NOT NULL,
  `Author_Name` varchar(255) NOT NULL,
  `Game_Name` varchar(255) NOT NULL,
  `Game_Type` varchar(255) NOT NULL,
  `Game_Description` text NOT NULL,
  `icon` text NOT NULL,
  `game` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recreational_games`
--

CREATE TABLE `recreational_games` (
  `id` int(11) NOT NULL,
  `Author_Name` varchar(255) NOT NULL,
  `Game_Name` varchar(255) NOT NULL,
  `Game_Type` varchar(255) NOT NULL,
  `Game_Description` text NOT NULL,
  `icon` text NOT NULL,
  `game` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `educational_games`
--
ALTER TABLE `educational_games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informational_games`
--
ALTER TABLE `informational_games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recreational_games`
--
ALTER TABLE `recreational_games`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `educational_games`
--
ALTER TABLE `educational_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `informational_games`
--
ALTER TABLE `informational_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recreational_games`
--
ALTER TABLE `recreational_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
