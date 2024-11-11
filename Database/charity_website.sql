-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 10:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `charity website`
--

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `donor` (
  `DonorID` int(10) UNSIGNED NOT NULL,
  `name` int(32)  NOT NULL,
  `Status` int(16)  NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Phone` int(15) NOT NULL,
  `Address` varchar(64) NOT NULL,  
  `TotalDonations` int(10)  NOT NULL,
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `donation` (
  `DonorID` int(10) UNSIGNED NOT NULL,
  `OrganizationID` int(10) UNSIGNED NOT NULL,
  `DonationAmount` int(32)  NOT NULL,  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `organization` (
  `OrganizationID` int(10) UNSIGNED NOT NULL,
  `OrganizationName` int(64) NOT NULL,  
  `Address` varchar(64) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` int(11) NOT NULL,
  `Bio` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `campaign` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Address` varchar(64) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` int(11) NOT NULL,
  `Bio` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Address` varchar(64) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` int(11) NOT NULL,
  `Bio` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Indexes for dumped tables
--

--
-- Indexes for table `organizations`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`DonorID`), 
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Password` (`Password`),
  ADD UNIQUE KEY `Status` (`Status`),  
  ADD UNIQUE KEY `Phone` (`Phone`),
  ADD UNIQUE KEY `Address` (`Name`),
  ADD UNIQUE KEY `Bio` (`Name`),
  ADD UNIQUE KEY `TotalDonations` (`TotalDonations`),  
  ADD KEY `ID` (`OrganizationID`);

ALTER TABLE `donations`
  ADD PRIMARY KEY (`DonorID`),
  ADD Primary KEY `OrganizationID` (`OrganizationID`),
  ADD UNIQUE KEY `DonationAmount` (`DonationAmount`),  
  ADD KEY `DonorID` (`DonorID`); ,
  ADD KEY `OrganizationID` (`OrganizationID`);

ALTER TABLE `organizations`
  ADD PRIMARY KEY (`OrganizationID`),
  ADD UNIQUE KEY `OrganizationName` (`OrganizationName`),  
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Phone` (`Phone`),
  ADD UNIQUE KEY `Address` (`Name`),
  ADD UNIQUE KEY `Bio` (`Name`),  
  ADD KEY `OrganizationID` (`OrganizationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `donor`
  MODIFY `DonorID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `donations`
  MODIFY `DonorID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
  MODIFY `OrganizationID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `organizations`
  MODIFY `OrganizationID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
