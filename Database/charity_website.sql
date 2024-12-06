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
-- Database: `charity_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `DonorID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `Status` int(1) NOT NULL,
  `Email` varchar(100) NOT NULL UNIQUE,
  `Password` varchar(100) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Address` varchar(64) NOT NULL,
  `TotalDonations` int(10) NOT NULL,
  PRIMARY KEY (`DonorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `DonationID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `DonorID` int(10) UNSIGNED NOT NULL,
  `OrganizationID` int(10) UNSIGNED NOT NULL,
  `DonationAmount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`DonationID`),
  KEY `DonorID` (`DonorID`),
  KEY `OrganizationID` (`OrganizationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `OrganizationID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `OrganizationName` varchar(64) NOT NULL UNIQUE,
  `Address` varchar(64) NOT NULL,
  `Email` varchar(100) NOT NULL UNIQUE,
  `Phone` varchar(15) NOT NULL,
  `Bio` varchar(200) NOT NULL,
  PRIMARY KEY (`OrganizationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `CampaignID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Description` varchar(100) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Goal` decimal(15,2) NOT NULL,
  `TotalRaised` decimal(15,2) NOT NULL,
  PRIMARY KEY (`CampaignID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL UNIQUE,
  `Password` varchar(64) NOT NULL,
  `Email` varchar(100) NOT NULL UNIQUE,
  `Status` varchar(16) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Insert data into `donor`
--

INSERT INTO `donor` (`name`, `Status`, `Email`, `Password`, `Phone`, `Address`, `TotalDonations`) VALUES
('Alice Johnson', 1, 'alice@example.com', 'password123', '1234567890', '123 Elm St.', 250),
('Bob Smith', 1, 'bob@example.com', 'securepass', '2345678901', '456 Oak Ave.', 150),
('Charlie Brown', 0, 'charlie@example.com', 'charliepass', '3456789012', '789 Pine Blvd.', 300);

--
-- Insert data into `donation`
--

INSERT INTO `donation` (`DonorID`, `OrganizationID`, `DonationAmount`) VALUES
(1, 1, 100.00),
(2, 2, 50.00),
(3, 3, 150.00),
(1, 2, 75.00),
(2, 3, 125.00);

--
-- Insert data into `organization`
--

INSERT INTO `organization` (`OrganizationName`, `Address`, `Email`, `Phone`, `Bio`) VALUES
('Helping Hands', '123 Charity St.', 'info@helpinghands.org', '1234567890', 'Provides food and shelter'),
('Green Earth', '456 Green Way', 'contact@greenearth.org', '2345678901', 'Environmental conservation efforts'),
('Future Scholars', '789 Learning Ave.', 'support@futurescholars.org', '3456789012', 'Scholarship programs for students');

--
-- Insert data into `campaign`
--

INSERT INTO `campaign` (`Description`, `StartDate`, `EndDate`, `Goal`, `TotalRaised`) VALUES
('Back to School Supplies Drive', '2024-01-10', '2024-03-10', 5000.00, 1200.00),
('Holiday Food Drive', '2024-11-01', '2024-12-31', 10000.00, 7500.00),
('Emergency Relief Fund', '2024-04-01', '2024-06-30', 20000.00, 18000.00),
('Health and Wellness Awareness', '2024-07-01', '2024-09-30', 8000.00, 4000.00),
('Literacy for All', '2024-05-15', '2024-08-15', 15000.00, 13000.00);

--
-- Insert data into `user`
--

INSERT INTO `user` (`UserName`, `Password`, `Email`, `Status`) VALUES
('john_doe', 'pass1234', 'john.doe@example.com', 'active'),
('jane_smith', 'securepassword', 'jane.smith@example.com', 'active'),
('alex_jones', 'mypass2024', 'alex.jones@example.com', 'inactive'),
('lisa_wang', 'qwerty123', 'lisa.wang@example.com', 'active'),
('michael_lee', 'letmein456', 'michael.lee@example.com', 'active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
