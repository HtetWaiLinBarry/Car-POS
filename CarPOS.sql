-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2020 at 11:51 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CarPOS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Brand`
--

CREATE TABLE `Brand` (
  `BrandID` int(11) NOT NULL,
  `BrandName` varchar(40) NOT NULL,
  `BrandDetails` varchar(100) NOT NULL,
  `BrandDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `BrandType`
--

CREATE TABLE `BrandType` (
  `BrandTypeID` int(11) NOT NULL,
  `BrandType` varchar(50) NOT NULL,
  `VehicleID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CashDown`
--

CREATE TABLE `CashDown` (
  `CashDownID` int(11) NOT NULL,
  `CashDetails` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `DateCash` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Company`
--

CREATE TABLE `Company` (
  `CompanyID` varchar(30) NOT NULL,
  `CompanyName` varchar(40) NOT NULL,
  `VehicleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `CustomerID` int(11) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `LastName` varchar(40) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `NRC` varchar(40) NOT NULL,
  `LicenseNo` varchar(30) NOT NULL,
  `Gender` varchar(30) NOT NULL,
  `PhoneNo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`CustomerID`, `FirstName`, `LastName`, `Address`, `Password`, `Email`, `NRC`, `LicenseNo`, `Gender`, `PhoneNo`) VALUES
(1, 'Clara', 'Hamsworth', 'No.2 8B Room 402', '123qwe', 'clara2000@gmail.com', '12/NC(220)', '123123123', 'Female', '092312312323');

-- --------------------------------------------------------

--
-- Table structure for table `Import`
--

CREATE TABLE `Import` (
  `ImportID` varchar(30) NOT NULL,
  `ImportName` varchar(40) NOT NULL,
  `ImportPrice` varchar(40) NOT NULL,
  `ImportQuantity` int(11) NOT NULL,
  `ImportImage` varchar(255) NOT NULL,
  `ImportDate` varchar(30) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `Status` varchar(30) NOT NULL,
  `TaxAmount` int(11) NOT NULL,
  `GrandTotal` varchar(30) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `TotalQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ImportDetails`
--

CREATE TABLE `ImportDetails` (
  `ImportDetailsID` varchar(30) NOT NULL,
  `VehicleID` varchar(30) NOT NULL,
  `VehicleName` varchar(30) NOT NULL,
  `ImportPrice` int(11) NOT NULL,
  `ImportQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Loan`
--

CREATE TABLE `Loan` (
  `LoanID` int(11) NOT NULL,
  `LoanDetails` varchar(100) NOT NULL,
  `StartLoan` date NOT NULL,
  `EndLoan` date NOT NULL,
  `MinLoan` int(11) NOT NULL,
  `MaxLoan` int(11) NOT NULL,
  `DueDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Payment`
--

CREATE TABLE `Payment` (
  `PaymentID` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `CashdownID` int(11) NOT NULL,
  `SalesID` varchar(50) NOT NULL,
  `PaymentDetails` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Sales`
--

CREATE TABLE `Sales` (
  `SalesID` varchar(50) NOT NULL,
  `SalesDate` date NOT NULL,
  `StaffID` int(11) NOT NULL,
  `VehicleID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `PurchaseAmount` int(11) NOT NULL,
  `TaxAmount` int(11) NOT NULL,
  `NetAmount` int(11) NOT NULL,
  `PaymentType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SalesDetail`
--

CREATE TABLE `SalesDetail` (
  `SalesDetailID` int(11) NOT NULL,
  `VehicleID` int(11) NOT NULL,
  `Price` varchar(30) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Staff`
--

CREATE TABLE `Staff` (
  `StaffID` int(11) NOT NULL,
  `StaffName` varchar(40) NOT NULL,
  `Phone` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `StaffPassword` varchar(50) NOT NULL,
  `Center` varchar(40) NOT NULL,
  `Position` varchar(40) NOT NULL,
  `StaffImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Vehicle`
--

CREATE TABLE `Vehicle` (
  `VehicleID` int(11) NOT NULL,
  `VehicleName` varchar(50) NOT NULL,
  `VehicleImage` varchar(225) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `VehiclePrice` varchar(30) NOT NULL,
  `Model` varchar(40) NOT NULL,
  `Company` varchar(40) NOT NULL,
  `Plate` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Vehicle`
--

INSERT INTO `Vehicle` (`VehicleID`, `VehicleName`, `VehicleImage`, `Quantity`, `VehiclePrice`, `Model`, `Company`, `Plate`) VALUES
(1, 'Honda Airwave', '', 1, '30,000,000', 'Airwave', 'Honda', '1992'),
(2, 'Toyota Sonic', '', 1, '60,000,000', 'Sonic X', 'Toyota', '4221');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Brand`
--
ALTER TABLE `Brand`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `Loan`
--
ALTER TABLE `Loan`
  ADD PRIMARY KEY (`LoanID`);

--
-- Indexes for table `Payment`
--
ALTER TABLE `Payment`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `SalesDetail`
--
ALTER TABLE `SalesDetail`
  ADD PRIMARY KEY (`SalesDetailID`);

--
-- Indexes for table `Vehicle`
--
ALTER TABLE `Vehicle`
  ADD PRIMARY KEY (`VehicleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Brand`
--
ALTER TABLE `Brand`
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Loan`
--
ALTER TABLE `Loan`
  MODIFY `LoanID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Payment`
--
ALTER TABLE `Payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SalesDetail`
--
ALTER TABLE `SalesDetail`
  MODIFY `SalesDetailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Vehicle`
--
ALTER TABLE `Vehicle`
  MODIFY `VehicleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
