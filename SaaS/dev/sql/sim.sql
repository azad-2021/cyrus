-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2021 at 07:42 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim`
--

-- --------------------------------------------------------

--
-- Table structure for table `gadget`
--

CREATE TABLE `gadget` (
  `GadgetID` int(11) NOT NULL,
  `Gadget` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gadget`
--

INSERT INTO `gadget` (`GadgetID`, `Gadget`) VALUES
(1, ' Sirius 4Z'),
(2, 'Sirius 8Z'),
(3, 'Sirius 16Z'),
(4, 'Sirius 24Z'),
(5, 'Sirius AD 2Z'),
(6, 'Sirius AD 4Z'),
(7, 'Sirius DC 4Z'),
(8, 'Sirius DC 8Z');

-- --------------------------------------------------------

--
-- Table structure for table `installation`
--

CREATE TABLE `installation` (
  `ID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `InstalledBy` int(11) NOT NULL,
  `InstallationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `OperatorID` int(11) NOT NULL,
  `Operator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operators`
--

INSERT INTO `operators` (`OperatorID`, `Operator`) VALUES
(1, 'Airtel'),
(2, 'VI'),
(3, 'BSNL');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `BranchCode` int(11) NOT NULL,
  `GadgetID` varchar(50) NOT NULL,
  `SimProvider` varchar(50) DEFAULT NULL,
  `SimType` varchar(10) DEFAULT NULL,
  `OperatorID` tinyint(1) DEFAULT NULL,
  `ValidityRecharge` int(11) NOT NULL,
  `Executive` varchar(50) NOT NULL,
  `VoiceMessage` varchar(200) NOT NULL,
  `Remark` varchar(500) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Status` tinyint(1) NOT NULL,
  `Installed` tinyint(4) NOT NULL,
  `RefID` int(11) DEFAULT NULL,
  `BilledToBank` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `ProductionID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `SimID` int(11) DEFAULT NULL,
  `IssueDate` date NOT NULL,
  `Remark` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `simprovider`
--

CREATE TABLE `simprovider` (
  `ID` int(11) NOT NULL,
  `MobileNumber` varchar(10) NOT NULL,
  `SimNo` varchar(20) NOT NULL,
  `SimType` varchar(50) NOT NULL,
  `OperatorID` tinyint(2) NOT NULL,
  `SimProvider` varchar(50) NOT NULL,
  `ReleaseDate` date NOT NULL DEFAULT current_timestamp(),
  `IssueDate` date DEFAULT NULL,
  `ActivationDate` date DEFAULT NULL,
  `RechargeDate` date DEFAULT NULL,
  `ExpDate` date DEFAULT NULL,
  `Remark` varchar(500) NOT NULL,
  `RemarkUpdate` varchar(500) DEFAULT NULL,
  `Status` tinyint(4) DEFAULT NULL,
  `StatusRemark` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `ReleaseID` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `ReleaseDate` date NOT NULL,
  `EmployeeCode` int(11) NOT NULL,
  `Remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Name`, `Type`, `Password`, `Active`) VALUES
(1, 'order', 'Orders', 'order@123', 1),
(2, 'sim', 'Sim Providers', 'sim@123', 1),
(3, 'production', 'Production', 'production@123', 1),
(4, 'store', 'Store', 'store@123', 1),
(5, 'installation', 'Installation', 'installation@123', 1),
(6, 'admin', 'Super User', 'admin@123', 1),
(7, 'abc', 'Sim Providers', 'abc@123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `EmployeeID` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gadget`
--
ALTER TABLE `gadget`
  ADD PRIMARY KEY (`GadgetID`);

--
-- Indexes for table `installation`
--
ALTER TABLE `installation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`OperatorID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`ProductionID`);

--
-- Indexes for table `simprovider`
--
ALTER TABLE `simprovider`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`ReleaseID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gadget`
--
ALTER TABLE `gadget`
  MODIFY `GadgetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `installation`
--
ALTER TABLE `installation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `OperatorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `ProductionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `simprovider`
--
ALTER TABLE `simprovider`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `ReleaseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
