--
-- Table structure for table `cmg_score`
--

CREATE TABLE IF NOT EXISTS `cmg_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL,
  `score` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
