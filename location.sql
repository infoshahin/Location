
--
-- Database: `location`
--

CREATE TABLE IF NOT EXISTS `tbl_location` (
  `LOCATION_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LOCATION_NAME` varchar(30) NOT NULL,
  `LOCATION_TYPE` enum('0','1','2','3','4') NOT NULL COMMENT '0 for Division, 1 for district, 2 thana, 3 suboffice,4 postoffice',
  `PARENT_ID` int(11) NOT NULL DEFAULT '0',
  `STATUS` tinyint(2) NOT NULL DEFAULT '1' COMMENT 'active status',
  PRIMARY KEY (`LOCATION_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=911 ;
