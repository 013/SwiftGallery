--
-- Host: localhost
-- Generation Time: Sep 15, 2013 at 10:39 AM
-- Server version: 5.5.31
-- PHP Version: 5.4.4-14+deb7u4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user` varchar(35) NOT NULL,
`uploadDate` int(32) NOT NULL,
`title` varchar(50) NOT NULL,
`imageHash` varchar(64) NOT NULL,
`mimeType` varchar(32) NOT NULL,
`album` int(11) NOT NULL DEFAULT '0',
`tags` varchar(120) NOT NULL,
`votes` int(11) NOT NULL,
`views` int(11) NOT NULL,
`published` int(1) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`),
UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

