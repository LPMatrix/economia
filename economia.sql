-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2017 at 09:06 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `economia`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles_likes`
--

CREATE TABLE IF NOT EXISTS `articles_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `articles_likes`
--

INSERT INTO `articles_likes` (`id`, `article`, `user`) VALUES
(1, 5, 1),
(2, 5, 1),
(3, 5, 1),
(4, 5, 1),
(5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `cat_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `cat_date`) VALUES
(1, 'Entertainment', '2017-12-13'),
(2, 'Arts', '2017-12-13'),
(4, 'Governance', '2017-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(300) NOT NULL,
  `topic` varchar(200) NOT NULL,
  `date` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `message`, `topic`, `date`, `user_id`) VALUES
(1, 'This is an example of a review of a product or service posted by a registered user', '1', 'Jan 2017', 1),
(2, 'Blackbird why you wanna <i><b>fly<br>\n <br></b></i>', '2', 'Mar 2006', 2),
(3, 'amber, microbrewery abbey hydrometer, brewpub ale lauter tun saccharification oxidized barrel.&nbsp;', '1', 'Feb 2017', 2),
(4, 'berliner weisse wort chiller adjunct hydrometer alcohol aau! sour/acidic sour/acidic chocolate malt ipa ipa hydrometer.', '2', 'Nov 2017', 1),
(5, 'he''s stupid', '1', 'Nov 2017', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_date` date NOT NULL,
  `user_level` int(8) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name_unique` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `password`, `email`, `user_date`, `user_level`) VALUES
(1, 'Sanusi Mubaraq', 'Matrix', '91bcb5a9bbf8b08a282168e1e14bb74eec3a618d67f2ca15130554645f9b6c71', 'mubaraqsanusi908@gmail.com', '2017-12-11', 1),
(2, 'Azeez Ojeyinka', 'KhodeSmith', 'cb95acd0fc583698bdf5112e433a0ad8941b68262fc3ff9c13c549a5953f68a6', 'azeezojeyinka@yahoo.com', '2017-12-12', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
