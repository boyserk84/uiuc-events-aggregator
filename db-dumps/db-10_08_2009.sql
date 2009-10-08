-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 08, 2009 at 10:52 PM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `events`
--

-- --------------------------------------------------------

--
-- Table structure for table `events_events`
--

CREATE TABLE IF NOT EXISTS `events_events` (
  `event_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test` varchar(255) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `events_events`
--

INSERT INTO `events_events` (`event_id`, `test`) VALUES
(1, 'EVENT 1'),
(2, 'EVENT DUOS');

