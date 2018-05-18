--
-- Create database `attractions`
--

CREATE DATABASE IF NOT EXISTS `attractions` DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_general_ci;

--
-- Table structure for table `attraction_data`
--

CREATE TABLE `attraction_data` (
 `attr_id` int(10) NOT NULL AUTO_INCREMENT,
 `name` varchar(50) NOT NULL,
 `description` varchar(200) NOT NULL,
 `rating` int(10) NOT NULL DEFAULT 0,
 `attr_type` varchar(10) NOT NULL DEFAULT '110',
 `no_of_reviews` int(10) DEFAULT 0,
 PRIMARY KEY (`attr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=501 DEFAULT CHARSET=utf8 COMMENT='Stores data about places and attractions';


--
-- Table structure for table `users`
--

CREATE TABLE `users` ( 
 `user_id` int(10) NOT NULL AUTO_INCREMENT,
 `username` varchar(30) NOT NULL,
 `password` varchar(255) NOT NULL,
 `user_type` varchar(10) NOT NULL,
 `review_status` int(5) NOT NULL,
 PRIMARY KEY (`user_id`),
 UNIQUE KEY `username` (`username`) 
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='Hold username and password';


--
-- Feed data for table `attraction_data`
--

INSERT INTO `attraction_data` (`name`, `description`, `rating`, `attr_type`, `no_of_reviews`) VALUES
("Cadbury World", "Cadbury World is a visitor attraction, featuring a self-guided exhibition tour, created and run by the Cadbury chocolate company.", 3, "110", 50),
("Bull Ring", "The Bullring is a major commercial area of central Birmingham.", 4, "110", 70),
("Birmingham Wildlife Conservation Park", "Birmingham Wildlife Conservation Park is a small zoo on the edge of Cannon Hill Park in Birmingham, England.", 4, "110", 100),
("Sutton Park", "Sutton Park is a large urban park located in Sutton Coldfield, Birmingham, West Midlands, England.", 4, "110", 45),
("Kingsbury Water Park", "Kingsbury Water Park is a country park in north Warwickshire, England, not far from Birmingham and lying on the River Tame.", 5, "110", 60),
("Dudley Castle", "Dudley Castle is a ruined fortification in the town of Dudley, West Midlands, England.", 5, "110", 130),
("The Ikon Gallery", "The Ikon Gallery is an English gallery of contemporary art, located in Brindleyplace, Birmingham.", 3, "110", 140),
("The Museum of the Jewellery Quarter", "The Museum of the Jewellery Quarter is a museum at 75-79 Vyse Street in Hockley, Birmingham, England.", 4, "110", 150),
("Birmingham Museum and Art Gallery", "Birmingham Museum and Art Gallery is a museum and art gallery in Birmingham, England.", 5, "110", 200),
("The National Sea Life Centre", "The National Sea Life Centre is an aquarium with over 60 displays of freshwater and marine life in Brindleyplace, Birmingham, England.", 4, "110", 230),
("Test Hide Attraction", "This is hidden attraction and will not be included in the page.", 2, "120", 160);

--
-- Feed data for table `users`
--

INSERT INTO `users` (`username`, `password`, `user_type`, `review_status`) VALUES
("fred", "$2y$10$ZXnVXTZ11rqkWVcEzhidduPUEDMKWHEqVkmmkafZza43MdyNopJ3m", "20", 0),
("administrator", "$2y$10$sRoS3X.QCRPaB3.fi84G5.x4myQagXIdRDPYGy7kq8u.UeZ4vDd8W", "30", 0);