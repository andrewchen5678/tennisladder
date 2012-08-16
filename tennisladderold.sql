-- phpMyAdmin SQL Dump
-- version 2.11.9.3
-- http://www.phpmyadmin.net
--
-- Host: mysql.epandits.com
-- Generation Time: May 15, 2009 at 04:13 PM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tennisladder`
--

-- --------------------------------------------------------

--
-- Table structure for table `ladders`
--

CREATE TABLE IF NOT EXISTS `ladders` (
  `ladderID` int(11) NOT NULL auto_increment,
  `gender` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `time` time NOT NULL,
  `managerID` int(11) NOT NULL,
  PRIMARY KEY  (`ladderID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ladders`
--

INSERT INTO `ladders` (`ladderID`, `gender`, `type`, `day`, `time`, `managerID`) VALUES
(1, 1, 0, 22, '03:00:00', 3),
(2, 2, 2, 3, '03:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ladderusers`
--

CREATE TABLE IF NOT EXISTS `ladderusers` (
  `ulid` int(11) NOT NULL auto_increment,
  `firstuserid` int(11) NOT NULL,
  `partnerid` int(11) default NULL,
  `ladderID` int(11) NOT NULL,
  `afterwhich` int(11) NOT NULL,
  PRIMARY KEY  (`ulid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ladderusers`
--

INSERT INTO `ladderusers` (`ulid`, `firstuserid`, `partnerid`, `ladderID`, `afterwhich`) VALUES
(1, 4, 0, 1, 2),
(2, 6, 0, 1, 4),
(3, 8, 0, 1, 1),
(4, 10, 0, 1, 0),
(5, 4, 8, 2, 8),
(6, 6, 6, 2, 5),
(7, 8, 7, 2, 0),
(8, 10, 9, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `matchdbwopartner`
--

CREATE TABLE IF NOT EXISTS `matchdbwopartner` (
  `matchID` int(11) NOT NULL auto_increment,
  `matchdate` date NOT NULL,
  `withpartner` tinyint(1) NOT NULL,
  `ladderID` int(11) NOT NULL,
  `firstUserID` int(11) NOT NULL,
  `secondUserID` int(11) NOT NULL,
  `thirdUserID` int(11) NOT NULL,
  `fourthUserID` int(11) NOT NULL,
  `firstnumwon` int(11) NOT NULL,
  `secondnumwon` int(11) NOT NULL,
  `thirdnumwon` int(11) NOT NULL,
  `fourthnumwon` int(11) NOT NULL,
  PRIMARY KEY  (`matchID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `matchdbwopartner`
--


-- --------------------------------------------------------

--
-- Table structure for table `matchdouble`
--

CREATE TABLE IF NOT EXISTS `matchdouble` (
  `matchID` int(11) NOT NULL auto_increment,
  `matchdate` date NOT NULL,
  `withpartner` tinyint(1) NOT NULL,
  `ladderID` int(11) NOT NULL,
  `firstUserID` int(11) NOT NULL,
  `secondUserID` int(11) NOT NULL,
  `thirdUserID` int(11) NOT NULL,
  `fourthUserID` int(11) NOT NULL,
  `team1score` int(11) NOT NULL,
  `team2score` int(11) NOT NULL,
  PRIMARY KEY  (`matchID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `matchdouble`
--


-- --------------------------------------------------------

--
-- Table structure for table `matchsingle`
--

CREATE TABLE IF NOT EXISTS `matchsingle` (
  `matchID` int(11) NOT NULL auto_increment,
  `matchdate` date NOT NULL,
  `ladderID` int(11) NOT NULL,
  `firstUserID` int(11) NOT NULL,
  `secondUserID` int(11) NOT NULL,
  `firstscore` int(11) NOT NULL,
  `secondscore` int(11) NOT NULL,
  PRIMARY KEY  (`matchID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `matchsingle`
--

INSERT INTO `matchsingle` (`matchID`, `matchdate`, `ladderID`, `firstUserID`, `secondUserID`, `firstscore`, `secondscore`) VALUES
(1, '2000-09-04', 1, 4, 6, 12, 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `member_ID` int(11) NOT NULL,
  `first_Name` varchar(32) NOT NULL,
  `last_Name` varchar(32) NOT NULL,
  `phone` char(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `usrStatus` tinyint(4) NOT NULL,
  `pwd` char(40) NOT NULL,
  `email` varchar(32) NOT NULL,
  PRIMARY KEY  (`member_ID`,`first_Name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`member_ID`, `first_Name`, `last_Name`, `phone`, `address`, `usrStatus`, `pwd`, `email`) VALUES
(1, 'Salil', 'Pandit', '2147483647', '140 This Street\r\nCoolville CA', 1, '7c222fb2927d828af22f592134e8932480637c0d', ''),
(2, 'Amar', 'Raheja', '2147483647', 'fgfgfgfdgdf', 3, '7c222fb2927d828af22f592134e8932480637c0d', 'fgdgfdgdf@gfdgfd.com'),
(3, 'Simple', 'Man', '2147483647', 'Elsewhere', 2, '7c222fb2927d828af22f592134e8932480637c0d', ''),
(4, 'Simplest', 'Manner', '2147483647', 'In No where land\r\nFar away', 3, '7c222fb2927d828af22f592134e8932480637c0d', ''),
(6, 'haha6first', 'haha6last', '6574837364', 'gdrgdrg', 3, '7c222fb2927d828af22f592134e8932480637c0d', ''),
(7, 'haha7first', 'haha7last', '9098694412', '1234 fin st.', 3, '7c222fb2927d828af22f592134e8932480637c0d', 'abc@anything.com'),
(8, 'haha8first', 'haha8last', '4637264738', 'ghfdhgkdfngklsdf', 3, 'da39a3ee5e6b4b0d3255bfef95601890afd80709', ''),
(9, 'haha9first', 'haha9last', '6546546546', '5646 hgfhgfhgf', 2, '7c222fb2927d828af22f592134e8932480637c0d', ''),
(10, 'haha10first', 'haha10last', '5734957437', 'jdkfjgfdjglkdfk', 3, '51f661d286a3d35e2efb603d88d2f43feb4f5fcc', ''),
(11, 'haha11first', 'haha11last', '4637264738', '3456 grekngkergnerk', 3, '7c222fb2927d828af22f592134e8932480637c0d', 'angelchen1111@gmail.com'),
(1111, 'Cool', 'Pandit', '9991199191', 'ksdfj', 3, 'f36b78c60992eb430ccce06df2b339a1e7af84c3', 'laskjfd@anything.com'),
(67, 'haha10first', 'haha10last', '5738475983', 'bgfdgdfgdf', 3, '7c222fb2927d828af22f592134e8932480637c0d', 'angelchen9999@hotmail.com'),
(77, 'haha8first', 'haha9last', '5465465465', '3456 grekngkergnerk', 3, '356a192b7913b04c54574d18c28d46e6395428ab', 'fgdgdfgdf@fsfdfds.com'),
(12345, 'amar', 'raheja', '555555555', '230', 3, '54cf1edf1143872699c8b24cfc4bf05ead9e0365', 'abc@gmail.com');
