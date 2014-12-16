-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 13, 2014 at 03:26 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `itsraghz`
--

-- --------------------------------------------------------

--
-- Table structure for table `TblUser`
--

DROP TABLE IF EXISTS `TblUser`;
CREATE TABLE IF NOT EXISTS "TblUser" (
  "Id" int(10) NOT NULL AUTO_INCREMENT,
  "UserName" varchar(20) NOT NULL,
  "FirstName" varchar(30) NOT NULL,
  "LastName" varchar(20) NOT NULL,
  "EmailId" varchar(50) NOT NULL,
  "City" varchar(20) DEFAULT NULL,
  "Country" varchar(20) DEFAULT NULL,
  "DateRegistered" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  "Remarks" varchar(100) DEFAULT NULL,
  PRIMARY KEY ("Id"),
  UNIQUE KEY "EmailId" ("EmailId"),
  UNIQUE KEY "UserName" ("UserName")
) AUTO_INCREMENT=3 ;

--
-- Dumping data for table `TblUser`
--

INSERT INTO `TblUser` (`Id`, `UserName`, `FirstName`, `LastName`, `EmailId`, `City`, `Country`, `DateRegistered`, `Remarks`) VALUES
(1, 'itsraghz', 'Raghavan alias Saravanan', 'Muthu', 'Raghavan.30May1981@gmail.com', 'Bangalore', 'India', '2011-09-25 15:38:45', NULL),
(2, 'meenakshi', 'Meenakshi', 'Raghavan', 'ramyamuru.meenakshi@gmail.com', 'Bangalore', 'India', '2011-09-25 15:38:45', NULL);
