-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2019 at 03:32 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_carpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `AppID` int(11) NOT NULL,
  `AppDetails` varchar(50) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `BrandID` int(11) NOT NULL,
  `BrandName` varchar(40) NOT NULL,
  `BrandDetails` varchar(100) NOT NULL,
  `BrandDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`BrandID`, `BrandName`, `BrandDetails`, `BrandDate`) VALUES
(2, 'Suzuki', 'X554Y', '2019-09-03'),
(4, 'Audi', 'X0S16', '2019-09-12');

-- --------------------------------------------------------

--
-- Table structure for table `cashdown`
--

CREATE TABLE `cashdown` (
  `CashDownID` int(11) NOT NULL,
  `CashDetails` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `DateCash` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `CompanyID` varchar(30) NOT NULL,
  `CompanyName` varchar(40) NOT NULL,
  `VehicleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`CompanyID`, `CompanyName`, `VehicleID`) VALUES
('C-001', 'Honda', 0),
('C-002', 'Audi', 0),
('C-003', 'Suzuki', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `LastName` varchar(40) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `NRC` varchar(50) NOT NULL,
  `LicenseNo` varchar(30) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `PhoneNo` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `FirstName`, `LastName`, `Address`, `Password`, `Email`, `NRC`, `LicenseNo`, `Gender`, `PhoneNo`) VALUES
(2, 'Berry', 'Ent', '11111', '11111', 's@gmail.com', '222222', '222222', 'Male', 222222),
(3, 'Berry', 'KKK', '1234', 'ssss', 'lazykarma2002@gmail.com', 'sss', 'sss', 'Male', 1111);

-- --------------------------------------------------------

--
-- Table structure for table `import`
--

CREATE TABLE `import` (
  `ImportID` varchar(30) NOT NULL,
  `ImportName` varchar(50) NOT NULL,
  `ImportPrice` varchar(50) NOT NULL,
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

--
-- Dumping data for table `import`
--

INSERT INTO `import` (`ImportID`, `ImportName`, `ImportPrice`, `ImportQuantity`, `ImportImage`, `ImportDate`, `TotalAmount`, `CompanyID`, `Status`, `TaxAmount`, `GrandTotal`, `StaffID`, `TotalQuantity`) VALUES
('PUR-000004', '', '0', 0, '', '2019-09-18', 25, 0, 'Pending', 0, '26.25', 0, 5),
('PUR-000005', '', '0', 0, '', '2019-09-19', 500000, 0, 'Pending', 0, '525000', 0, 5),
('PUR-000006', '', '0', 0, '', '2019-09-23', 500000, 0, 'Pending', 0, '525000', 0, 5),
('PUR-000007', '', '0', 0, '', '2019-09-23', 500000, 0, 'Pending', 0, '525000', 0, 5),
('PUR-000008', '', '0', 0, '', '2019-09-23', 90000, 0, 'Pending', 0, '94500', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `importdetails`
--

CREATE TABLE `importdetails` (
  `ImportDetailsID` varchar(30) NOT NULL,
  `VehicleID` varchar(30) NOT NULL,
  `VehicleName` varchar(30) NOT NULL,
  `ImportPrice` int(11) NOT NULL,
  `ImportQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `importdetails`
--

INSERT INTO `importdetails` (`ImportDetailsID`, `VehicleID`, `VehicleName`, `ImportPrice`, `ImportQuantity`) VALUES
('PUR-000008', '3', '', 30000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
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
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `CashDownID` int(11) NOT NULL,
  `SalesID` varchar(50) NOT NULL,
  `PaymentDetails` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `SalesID` varchar(50) NOT NULL,
  `SalesDetail` varchar(100) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `Customer` int(11) NOT NULL,
  `VehicleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `StaffName` varchar(40) NOT NULL,
  `Phone` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `StaffPassword` varchar(40) NOT NULL,
  `Center` varchar(40) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `StaffImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `StaffName`, `Phone`, `Email`, `StaffPassword`, `Center`, `Position`, `StaffImage`) VALUES
(9, 'May Thu Soe', 2147483647, 'lazykarma2002@gmail.com', 'maythu999', 'Reception', 'Receptionist', '');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `VehicleID` int(11) NOT NULL,
  `VehicleName` varchar(50) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `VehiclePrice` varchar(30) NOT NULL,
  `Model` varchar(40) NOT NULL,
  `Company` varchar(40) NOT NULL,
  `Plate` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`VehicleID`, `VehicleName`, `Quantity`, `VehiclePrice`, `Model`, `Company`, `Plate`) VALUES
(2, 'Honda Airwave', 0, '200,000,000', 'Airwave', 'Honda', '1772'),
(3, 'Audi Silver', 0, '700,000,000', 'Silver XV', 'Audi', '122234');

-- --------------------------------------------------------

--
-- Table structure for table `vehicletype`
--

CREATE TABLE `vehicletype` (
  `VehicleTypeID` int(11) NOT NULL,
  `VehicleType` varchar(50) NOT NULL,
  `VehicleID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`AppID`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `cashdown`
--
ALTER TABLE `cashdown`
  ADD PRIMARY KEY (`CashDownID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `import`
--
ALTER TABLE `import`
  ADD PRIMARY KEY (`ImportID`);

--
-- Indexes for table `importdetails`
--
ALTER TABLE `importdetails`
  ADD PRIMARY KEY (`ImportDetailsID`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`LoanID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`SalesID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`VehicleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `AppID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cashdown`
--
ALTER TABLE `cashdown`
  MODIFY `CashDownID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `LoanID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `VehicleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
