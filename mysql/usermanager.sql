-- MySQL dump 10.13  Distrib 5.5.32, for Linux (x86_64)
--
-- Host: localhost    Database: usermanager
-- ------------------------------------------------------
-- Server version	5.5.32-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `pass` varchar(40) NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `cep_zip` varchar(10) NOT NULL,
  `state` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `active` varchar(1) NOT NULL,
  `city` varchar(200) NOT NULL,
  `account_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` (`student_id`, `pass`, `name`, `surname`, `email`, `address`, `cep_zip`, `state`, `country`, `active`, `city`, `account_creation`) VALUES (1,'admin','Administrator','The','admin@admin.com','Address','99.700-000','Rio Grande do Sul','Brasil','T','','0000-00-00 00:00:00'),(11,'eliana','','','eliana','','','','','F','','0000-00-00 00:00:00'),(13,'pa55word','Ramon','Bez','ramonbez@gmail.com','46-47 Great Sutton Street','EC1V 0DE','Alabama','United Kingdom','F','','0000-00-00 00:00:00'),(55,'lilica','eliana','rosa','elianatrosa@gmail.com','rua 1','99700000','rs','Brasil','T','erechim','0000-00-00 00:00:00'),(57,'876','Jean','Racoski','jean.c.racoski@gmail.com','R','C','R','B','T','C','2014-02-14 12:27:02'),(58,'wefasd','Nicholas','Trieb','n.trieb@gmail.com','Vienna','','Austria','','F','2222','2014-02-14 17:37:27');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'usermanager'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-02-16 14:26:49
