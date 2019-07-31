-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2013 at 12:55 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `homeofre_homeofremembrance_v3`
--

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE IF NOT EXISTS `families` (
  `FamilyID` int(11) NOT NULL AUTO_INCREMENT,
  `HeadID` int(11) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`FamilyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`FamilyID`, `HeadID`, `name`) VALUES
(1, 1, 'Guest');

-- --------------------------------------------------------

--
-- Table structure for table `family_members`
--

CREATE TABLE IF NOT EXISTS `family_members` (
  `MemberID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `FamilyID` int(11) NOT NULL,
  PRIMARY KEY (`MemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE IF NOT EXISTS `lists` (
  `ListID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `ListURL` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ListID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`ListID`, `UserID`, `ListURL`) VALUES
(1, 1, 'c4ca4238a0b923820dcc509a6f75849b');

-- --------------------------------------------------------

--
-- Table structure for table `list_items`
--

CREATE TABLE IF NOT EXISTS `list_items` (
  `ListItemID` int(11) NOT NULL AUTO_INCREMENT,
  `ListID` int(11) NOT NULL,
  `ListText` varchar(150) DEFAULT NULL,
  `ListItemDone` int(11) NOT NULL,
  `ListItemPosition` int(11) NOT NULL,
  `ListItemColor` int(11) NOT NULL,
  PRIMARY KEY (`ListItemID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `list_items`
--

INSERT INTO `list_items` (`ListItemID`, `ListID`, `ListText`, `ListItemDone`, `ListItemPosition`, `ListItemColor`) VALUES
(3, 1, 'Item one', 0, 1, 1),
(6, 1, 'Hello Pete', 0, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `ver_code` varchar(150) NOT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  `Firstname` text NOT NULL,
  `Surname` text NOT NULL,
  `dob_day` int(11) NOT NULL,
  `dob_month` text NOT NULL,
  `dob_year` int(11) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `ver_code`, `verified`, `Firstname`, `Surname`, `dob_day`, `dob_month`, `dob_year`) VALUES
(1, 'guest', '5f4dcc3b5aa765d61d8327deb882cf99', '20cdae6359858b824471837aa0fcecfa62c99ecc', 1, 'Jeff', 'Guest', 6, 'March', 1985);

-- --------------------------------------------------------

--
-- Table structure for table `user_about`
--

CREATE TABLE IF NOT EXISTS `user_about` (
  `AboutID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Born` text NOT NULL,
  `Parents` text NOT NULL,
  `Lived` text NOT NULL,
  `Educated` text NOT NULL,
  `Currently` text NOT NULL,
  `Likes` text NOT NULL,
  `Dislikes` text NOT NULL,
  `About` text NOT NULL,
  `Visibility` varchar(7) NOT NULL,
  PRIMARY KEY (`AboutID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_about`
--

INSERT INTO `user_about` (`AboutID`, `UserID`, `Born`, `Parents`, `Lived`, `Educated`, `Currently`, `Likes`, `Dislikes`, `About`, `Visibility`) VALUES
(1, 1, 'I', 'do', 'hope', 'this', 'works', 'as', 'it', 'should', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_bucketlist`
--

CREATE TABLE IF NOT EXISTS `user_bucketlist` (
  `ListID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `ListURL` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ListID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_bucketlist`
--

INSERT INTO `user_bucketlist` (`ListID`, `UserID`, `ListURL`) VALUES
(1, 1, 'c4ca4238a0b923820dcc509a6f75849b');

-- --------------------------------------------------------

--
-- Table structure for table `user_bucketlist_items`
--

CREATE TABLE IF NOT EXISTS `user_bucketlist_items` (
  `ListItemID` int(11) NOT NULL AUTO_INCREMENT,
  `ListID` int(11) NOT NULL,
  `ListText` varchar(150) DEFAULT NULL,
  `ListItemDone` int(11) NOT NULL,
  `ListItemPosition` int(11) NOT NULL,
  `ListItemColor` int(11) NOT NULL,
  PRIMARY KEY (`ListItemID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `user_bucketlist_items`
--

INSERT INTO `user_bucketlist_items` (`ListItemID`, `ListID`, `ListText`, `ListItemDone`, `ListItemPosition`, `ListItemColor`) VALUES
(3, 1, 'Item one', 0, 1, 2),
(17, 1, 'Testing', 0, 2, 2),
(19, 1, 'showing off', 0, 4, 2),
(20, 1, 'Swim with some sort of dolphin.', 0, 3, 2),
(21, 1, 'Jump high enough to touch the moon', 0, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_timecapsule`
--

CREATE TABLE IF NOT EXISTS `user_timecapsule` (
  `CapsuleID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_directory` text NOT NULL,
  PRIMARY KEY (`CapsuleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_timecapsule`
--

INSERT INTO `user_timecapsule` (`CapsuleID`, `UserID`, `file_name`, `file_size`, `file_directory`) VALUES
(1, 1, 'Key.txt', 29, 'users/a87ff679a2f3e71d9181a67b7542122c/time_capsule/Key.txt'),
(2, 1, 'lloyds credit card info.txt', 202, 'users/a87ff679a2f3e71d9181a67b7542122c/time_capsule/lloyds credit card info.txt');

-- --------------------------------------------------------

--
-- Table structure for table `user_treasuredmemories`
--

CREATE TABLE IF NOT EXISTS `user_treasuredmemories` (
  `MemoryID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `location` text NOT NULL,
  `notes` text NOT NULL,
  `memory_day` int(11) NOT NULL,
  `memory_month` text NOT NULL,
  `memory_year` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_directory` text NOT NULL,
  PRIMARY KEY (`MemoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_treasuredmemories`
--

INSERT INTO `user_treasuredmemories` (`MemoryID`, `UserID`, `location`, `notes`, `memory_day`, `memory_month`, `memory_year`, `file_name`, `file_size`, `file_directory`) VALUES
(1, 1, 'Isle of Wight', 'It was sunny', 0, '', 0, '', 0, ''),
(2, 1, 'here', 'kgkgfghf', 1, 'January', 1990, 'Key.txt', 29, 'users/a87ff679a2f3e71d9181a67b7542122c/treasured_memory/Key.txt'),
(3, 1, 'location', 'notes', 1, 'January', 1990, '', 0, 'users/a87ff679a2f3e71d9181a67b7542122c/treasured_memory/');

-- --------------------------------------------------------

--
-- Table structure for table `user_vault`
--

CREATE TABLE IF NOT EXISTS `user_vault` (
  `VaultID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `doctor_name` text NOT NULL,
  `doctor_contact` text NOT NULL,
  `funeral` text NOT NULL,
  `resting` text NOT NULL,
  `will` text NOT NULL,
  `additional_info` text NOT NULL,
  PRIMARY KEY (`VaultID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_vault`
--

INSERT INTO `user_vault` (`VaultID`, `UserID`, `doctor_name`, `doctor_contact`, `funeral`, `resting`, `will`, `additional_info`) VALUES
(1, 1, 'Dr Jeff', 'Fax ... lol', 'Funeral', 'Resting', 'Will', 'Who uses fax?! I mean, really?!');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
