-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2009 at 07:46 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `events`
--

-- --------------------------------------------------------

--
-- Table structure for table `events_events`
--

CREATE TABLE IF NOT EXISTS `events_events` (
  `event_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `source_id` int(10) unsigned NOT NULL,
  `event_time_added_at` datetime NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `event_datetime` datetime NOT NULL,
  `event_location` varchar(255) NOT NULL,
  `event_link` text NOT NULL,
  `event_tags` varchar(255) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `events_events`
--

INSERT INTO `events_events` (`event_id`, `source_id`, `event_time_added_at`, `event_title`, `event_description`, `event_datetime`, `event_location`, `event_link`, `event_tags`) VALUES
(3, 1, '2009-10-08 19:14:14', 'Test Event', 'Do stuff', '2009-10-30 19:12:23', 'UIUC Someplace', 'http://www.google.com', 'stuff, otherstuff'),
(4, 0, '2009-10-28 18:41:43', 'Test 2', 'Blah', '2009-10-28 18:41:43', 'Place', 'asdf ds', 'stuff, stuff2');
