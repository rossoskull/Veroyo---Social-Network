-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2017 at 05:46 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infinity_veroyo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fname` varchar(256) NOT NULL,
  `lname` varchar(256) NOT NULL,
  `eid` varchar(256) NOT NULL,
  `password` varchar(128) NOT NULL,
  `pno` varchar(10) NOT NULL,
  `dateob` varchar(2) NOT NULL,
  `monthob` text NOT NULL,
  `yearob` varchar(4) NOT NULL,
  `gender` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `users_search`
--

CREATE TABLE `users_search` (
  `eid` varchar(256) NOT NULL,
  `m_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `eid` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `type` text NOT NULL,
  `descr` varchar(1024) NOT NULL,
  `filePath` varchar(1024) NOT NULL,
  `postid` varchar(760) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `user_profile_data`
--

CREATE TABLE `user_profile_data` (
  `eid` varchar(256) NOT NULL,
  `descript` varchar(256) NOT NULL,
  `propicpath` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `user_relations`
--

CREATE TABLE `user_relations` (
  `follower` varchar(256) NOT NULL,
  `followed` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `eid` (`eid`);

--
-- Indexes for table `user_profile_data`
--
ALTER TABLE `user_profile_data`
  ADD UNIQUE KEY `eid` (`eid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
