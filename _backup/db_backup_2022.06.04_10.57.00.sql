-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- -------------------------------------------
-- -------------------------------------------
-- START BACKUP
-- -------------------------------------------
-- -------------------------------------------
-- TABLE `account`
-- -------------------------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idUser` int NOT NULL,
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `penalty` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `idUser_UNIQUE` (`idUser`),
  CONSTRAINT `account_idUser` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3;

-- -------------------------------------------
-- TABLE `apartment`
-- -------------------------------------------
DROP TABLE IF EXISTS `apartment`;
CREATE TABLE IF NOT EXISTS `apartment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `adress` varchar(200) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'FREE',
  `description` varchar(10000) NOT NULL,
  `img` varchar(200) NOT NULL,
  `square` int NOT NULL,
  `monthrent` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3;

-- -------------------------------------------
-- TABLE `contact`
-- -------------------------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` varchar(10000) NOT NULL,
  `idUser` int DEFAULT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `idUser_idx` (`idUser`),
  CONSTRAINT `idUser` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3;

-- -------------------------------------------
-- TABLE `deal`
-- -------------------------------------------
DROP TABLE IF EXISTS `deal`;
CREATE TABLE IF NOT EXISTS `deal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idUser` int NOT NULL,
  `idApartment` int NOT NULL,
  `monthCount` int NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'ACTIVE',
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `idUser_idx` (`idUser`),
  KEY `idApartment_idx` (`idApartment`),
  CONSTRAINT `deal_idApartment` FOREIGN KEY (`idApartment`) REFERENCES `apartment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `deal_idUser` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3;

-- -------------------------------------------
-- TABLE `user`
-- -------------------------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userName` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(45) NOT NULL DEFAULT 'USER',
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idUser_UNIQUE` (`id`),
  UNIQUE KEY `userName_UNIQUE` (`userName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3;

-- -------------------------------------------
-- TABLE DATA account
-- -------------------------------------------
INSERT INTO `account` (`id`,`idUser`,`money`,`penalty`) VALUES
('1','29','-1000.00','10.00');;;
INSERT INTO `account` (`id`,`idUser`,`money`,`penalty`) VALUES
('2','24','18.00','0.00');;;



-- -------------------------------------------
-- TABLE DATA apartment
-- -------------------------------------------
INSERT INTO `apartment` (`id`,`name`,`adress`,`status`,`description`,`img`,`square`,`monthrent`) VALUES
('2','Appartment - Ground Foor','Fleet Street 34','BOOKED','This apartment features a electric kettle,sofa and private entrance','/images/australian-modern-bedroom-interior-nature-window_31965-3690.jpg','44','1000.00');;;
INSERT INTO `apartment` (`id`,`name`,`adress`,`status`,`description`,`img`,`square`,`monthrent`) VALUES
('3','Double Deluxe apartment','Pushkin Street 34','FREE','In the room, designed by Space Copenhagen, every detail is','/images/modern-studio-apartment-design-with-bedroom-living-space_1262-12375.jpg','52','2500.00');;;
INSERT INTO `apartment` (`id`,`name`,`adress`,`status`,`description`,`img`,`square`,`monthrent`) VALUES
('4','Apartment with Park View','Elevan Street','FREE','Just chill','/images/luxury-bedroom-hotel_1150-10836.jpg','33','600.00');;;
INSERT INTO `apartment` (`id`,`name`,`adress`,`status`,`description`,`img`,`square`,`monthrent`) VALUES
('5','Comfy Apartment','Esenina Street','FREE','Best place for you','/images/1.jpg','19','200.00');;;
INSERT INTO `apartment` (`id`,`name`,`adress`,`status`,`description`,`img`,`square`,`monthrent`) VALUES
('6','Hotel Room','Geras Street','FREE','Take plesuare','/images/2.jfif','22','300.00');;;
INSERT INTO `apartment` (`id`,`name`,`adress`,`status`,`description`,`img`,`square`,`monthrent`) VALUES
('7','Wonderful Place','Ivanova Street 84','FREE','Three star hotel','/images/89825024750854badcfced22e0157de3.jpg','33','800.00');;;
INSERT INTO `apartment` (`id`,`name`,`adress`,`status`,`description`,`img`,`square`,`monthrent`) VALUES
('8','Hotel','Ivanova Street 84','FREE','Four star hotel','/images/hotel_room.jpg','12','200.00');;;
INSERT INTO `apartment` (`id`,`name`,`adress`,`status`,`description`,`img`,`square`,`monthrent`) VALUES
('9','Hotel room','Ivanova Street 84','FREE','Four star hotel','/images/hotel_room.jpg','23','1200.00');;;
INSERT INTO `apartment` (`id`,`name`,`adress`,`status`,`description`,`img`,`square`,`monthrent`) VALUES
('10','Wonderful Place','Ivanova Street 85','FREE','Three star hotel','/images/hotel_room.jpg','12','300.00');;;
INSERT INTO `apartment` (`id`,`name`,`adress`,`status`,`description`,`img`,`square`,`monthrent`) VALUES
('11','Hotel','Ivanova Street 84','FREE','Three star hotel','/images/hotel_room.jpg','24','400.00');;;
INSERT INTO `apartment` (`id`,`name`,`adress`,`status`,`description`,`img`,`square`,`monthrent`) VALUES
('12','Wonderful Place','Ivanova Street 84','BOOKED','Four star hotel +','/images/hotel_room.jpg','10','200.00');;;



-- -------------------------------------------
-- TABLE DATA contact
-- -------------------------------------------
INSERT INTO `contact` (`id`,`name`,`email`,`subject`,`body`,`idUser`,`status`) VALUES
('1','admin','tt1934840@gmail.com','1223','1223','24','ACTIVE');;;
INSERT INTO `contact` (`id`,`name`,`email`,`subject`,`body`,`idUser`,`status`) VALUES
('2','admin','tt1934840@gmail.com','Test','Test','24','ACTIVE');;;
INSERT INTO `contact` (`id`,`name`,`email`,`subject`,`body`,`idUser`,`status`) VALUES
('3','admin','tt1934840@gmail.com','13у23','АААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААа','24','CLOSE');;;
INSERT INTO `contact` (`id`,`name`,`email`,`subject`,`body`,`idUser`,`status`) VALUES
('4','user','ilya-ponomarev-2001@mail.ru','Test','Test Test Test','25','CLOSE');;;
INSERT INTO `contact` (`id`,`name`,`email`,`subject`,`body`,`idUser`,`status`) VALUES
('5','admin','tt1934840@gmail.com','23','23232','24','ACTIVE');;;
INSERT INTO `contact` (`id`,`name`,`email`,`subject`,`body`,`idUser`,`status`) VALUES
('6','admin','tt1934840@gmail.com','32','32','24','ACTIVE');;;



-- -------------------------------------------
-- TABLE DATA deal
-- -------------------------------------------
INSERT INTO `deal` (`id`,`idUser`,`idApartment`,`monthCount`,`status`,`date`) VALUES
('3','24','4','12','CLOSE','2022-06-01');;;
INSERT INTO `deal` (`id`,`idUser`,`idApartment`,`monthCount`,`status`,`date`) VALUES
('4','24','12','3','ACTIVE','2022-06-01');;;
INSERT INTO `deal` (`id`,`idUser`,`idApartment`,`monthCount`,`status`,`date`) VALUES
('7','29','2','12','ACTIVE','2022-06-02');;;



-- -------------------------------------------
-- TABLE DATA user
-- -------------------------------------------
INSERT INTO `user` (`id`,`userName`,`password`,`role`,`email`) VALUES
('24','admin','$2y$13$NQvJjttLh.7DHFV1X6WIEuXswaiosqlo0zrlB0zQEP8v0Zgf4vCgu','ADMIN','tt1934840@gmail.com');;;
INSERT INTO `user` (`id`,`userName`,`password`,`role`,`email`) VALUES
('25','user','$2y$13$o52CmCONNFfRm9BcV/7eYeio7/w21VwM/HHJbftJRsM9MUUthTGYe','USER','ilya-ponomarev-2001@mail.ru');;;
INSERT INTO `user` (`id`,`userName`,`password`,`role`,`email`) VALUES
('26','cejurs','$2y$13$3KRnO1GrrhJO4z6dhEg6xeDKSvXT36UKIPcnQQXGlJbm1095FoshW','USER','cccejurs@gmail.com');;;
INSERT INTO `user` (`id`,`userName`,`password`,`role`,`email`) VALUES
('29','123','$2y$13$F3.Xgr0ql9/.fqWtIvT94.RZ.8iaj9ShBmccTE5Q7uNU7pTr1XidW','USER','ilya-ponomarev-2001@mail.ru');;;



-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------
