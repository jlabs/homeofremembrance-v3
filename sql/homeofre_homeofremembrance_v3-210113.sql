-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 21, 2013 at 11:23 PM
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
-- Table structure for table `about_user`
--

CREATE TABLE IF NOT EXISTS `about_user` (
  `AboutID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Born` text NOT NULL,
  `Parents` text NOT NULL,
  `Lived` text NOT NULL,
  `Educated` text NOT NULL,
  `Currently` text NOT NULL,
  `Like` text NOT NULL,
  `Dislike` text NOT NULL,
  `About` text NOT NULL,
  `Visibility` varchar(7) NOT NULL,
  PRIMARY KEY (`AboutID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `about_user`
--

INSERT INTO `about_user` (`AboutID`, `UserID`, `Born`, `Parents`, `Lived`, `Educated`, `Currently`, `Like`, `Dislike`, `About`, `Visibility`) VALUES
(1, 1, 'Harrow', 'Sue and Terry', 'Harrow and Sandown, Isle of Wight', 'Roxeth Mannor', 'Typing this message', 'Typing messages', 'Not typing messages', 'Shtuff', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `list_items`
--

INSERT INTO `list_items` (`ListItemID`, `ListID`, `ListText`, `ListItemDone`, `ListItemPosition`, `ListItemColor`) VALUES
(3, 1, 'Item one', 0, 1, 1),
(6, 1, 'Hello Pete', 0, 3, 3),
(7, 1, '5', 0, 2, 2);

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
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `ver_code`, `verified`) VALUES
(1, 'guest', '5f4dcc3b5aa765d61d8327deb882cf99', '20cdae6359858b824471837aa0fcecfa62c99ecc', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
