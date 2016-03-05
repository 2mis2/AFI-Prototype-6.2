-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2016 at 02:58 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gafa`
--

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `partnerID` int(15) UNSIGNED NOT NULL,
  `partnerName` varchar(32) NOT NULL,
  `partnerContact` varchar(32) NOT NULL,
  `partnerAddress` varchar(255) NOT NULL,
  `partnerArea` varchar(15) NOT NULL,
  `partnerEmail` varchar(32) NOT NULL,
  `partnerMobile` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`partnerID`, `partnerName`, `partnerContact`, `partnerAddress`, `partnerArea`, `partnerEmail`, `partnerMobile`) VALUES
(1, 'HSE', 'HSE Contact', 'HSE Galway', 'Galway', 'hse@hsegalway.ie', '0860000000');


INSERT INTO `partners` (`partnerID`, `partnerName`, `partnerContact`, `partnerAddress`, `partnerArea`, `partnerEmail`, `partnerMobile`) VALUES
(2, 'Gardai', 'Sgt ', 'Mill St, Galway', 'Galway', 'stg@gardaigalway.ie', '0861234567');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `reportID` int(15) UNSIGNED NOT NULL,
  `partnerID` int(15) UNSIGNED NOT NULL,
  `report` varchar(255) NOT NULL,
  `reportDate` date NOT NULL,
  `reportOwner` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`reportID`, `partnerID`, `report`, `reportDate`, `reportOwner`) VALUES
(1, 1, 'Respite Beds', '2016-01-08', 'HSE Administration');

INSERT INTO `reports` (`reportID`, `partnerID`, `report`, `reportDate`, `reportOwner`) VALUES
(2, 1, 'New Footpath', '2016-01-15', 'HSE Administration');

INSERT INTO `reports` (`reportID`, `partnerID`, `report`, `reportDate`, `reportOwner`) VALUES
(3, 1, 'Good Health Plan', '2015-11-17', 'HSE Administration');


INSERT INTO `reports` (`reportID`, `partnerID`, `report`, `reportDate`, `reportOwner`) VALUES
(4, 2, 'More Security', '2015-09-23', 'Sgt. Joe Bloggs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`partnerID`),
  ADD KEY `partnerName` (`partnerName`,`partnerContact`,`partnerAddress`,`partnerArea`,`partnerEmail`,`partnerMobile`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`reportID`),
  ADD KEY `partnerID` (`partnerID`,`report`,`reportDate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `partnerID` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `reportID` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`partnerID`) REFERENCES `partners` (`partnerID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




INSERT INTO `reports` (`partnerID`, `report`, `reportOwner`) VALUES
(2, 'Test Report', 'Test Owner');



CREATE TABLE `workGroup` (
  `workGroupID` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `WGname` int(20) UNSIGNED NOT NULL,
  `WGcontact` varchar(32) NOT NULL,
  `WGcontactMobile` varchar(32),
  `WGcontactEmail` varchar(64),
   `WGlocation` varchar(64) NOT NULL,
  PRIMARY KEY (`workGroupID`)  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `workGroup` (`WGname`, `WGcontact`, `WGcontactMobile`, `WGcontactEmail`, `WGlocation`) VALUES
('Work Group 1', 'John Doe', '987654', 'john@doe.com', 'Ireland');

INSERT INTO `workGroup` (`WGname`, `WGcontact`, `WGcontactMobile`, `WGcontactEmail`, `WGlocation`) VALUES
('Work Group 2', 'Jane Doe', '987654', 'jane@doe.com', 'galway');

