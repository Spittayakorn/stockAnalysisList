-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: stock
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `stock`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `stock` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `stock`;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `itemN` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itemName` varchar(100) NOT NULL,
  PRIMARY KEY (`itemN`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockanalysis`
--

DROP TABLE IF EXISTS `stockanalysis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stockanalysis` (
  `stockId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `take` double(40,2) DEFAULT NULL,
  `exist` double(40,2) DEFAULT NULL,
  `used` double(40,2) DEFAULT NULL,
  `lefted` double(40,2) DEFAULT NULL,
  `added` double(40,2) DEFAULT NULL,
  `itemN` int(10) unsigned DEFAULT NULL,
  `stockN` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`stockId`),
  KEY `itemN` (`itemN`),
  KEY `stockN` (`stockN`),
  CONSTRAINT `stockanalysis_ibfk_1` FOREIGN KEY (`itemN`) REFERENCES `items` (`itemN`),
  CONSTRAINT `stockanalysis_ibfk_2` FOREIGN KEY (`stockN`) REFERENCES `stocklist` (`stockN`)
) ENGINE=InnoDB AUTO_INCREMENT=379 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockanalysis`
--

LOCK TABLES `stockanalysis` WRITE;
/*!40000 ALTER TABLE `stockanalysis` DISABLE KEYS */;
/*!40000 ALTER TABLE `stockanalysis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocklist`
--

DROP TABLE IF EXISTS `stocklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocklist` (
  `stockN` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stockDate` datetime DEFAULT NULL,
  PRIMARY KEY (`stockN`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocklist`
--

LOCK TABLES `stocklist` WRITE;
/*!40000 ALTER TABLE `stocklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `stocklist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-30 13:48:29
