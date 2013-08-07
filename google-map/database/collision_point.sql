CREATE TABLE IF NOT EXISTS `collision_point` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `latitude` varchar(15) NOT NULL,
  `longitude` varchar(15) NOT NULL,
  `MatchType` varchar(15) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `City` varchar(30) NOT NULL,
  `State` varchar(30) NOT NULL,
  `Field1` varchar(8) NOT NULL,
  `Field2` varchar(4) NOT NULL,
  `Road1` varchar(50) NOT NULL,
  `Road2` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
