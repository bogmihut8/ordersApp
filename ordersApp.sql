-- MySQL dump 10.13  Distrib 5.5.57, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: ordersApp
-- ------------------------------------------------------
-- Server version	5.5.57-0ubuntu0.14.04.1

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
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `adresa` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `cod_fiscal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Test Company No. 12','2018-09-01 14:30:49','2018-11-23 16:59:05','ytdhth trh','trhfdrwesre','+40741234567'),(3,'Company London SRL','2018-09-01 14:36:04','2018-11-23 16:59:10','yhtrhtr','hygtdhydr','+40741234567'),(4,'Emiliano','2018-10-06 08:45:43','2018-11-23 16:59:14','rstygrd','htrdyhgtr','+40741234567'),(6,'gregtrh','2018-10-19 07:53:12','2018-11-23 16:59:18','jtydfhyxtfy###','tcfufyufgutycjugvmh','+40741234567'),(9,'Quadrifoglio','2018-10-25 10:25:49','2018-11-23 16:59:22','Italia, Roma , via Dolorosa nr.10','2345432','+40741234567');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2018_09_01_141312_create_clients_table',2),('2018_09_01_170221_create_orders_table',3),('2018_09_08_114132_add_delivered_column',4),('2018_09_24_062212_add_invoiced_products_column',5),('2018_10_19_072901_client_fields',6),('2018_10_19_111545_add_partial_delivered_date',7),('2018_10_21_144550_add_parcels_and_weight',8),('2018_11_16_101705_add_price_to_orders',9),('2018_11_23_165519_add_telephone_to_client',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `article` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `entry_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `delivered` int(11) NOT NULL,
  `invoiced_products` int(11) NOT NULL,
  `partial_date` datetime NOT NULL,
  `parcels` int(11) NOT NULL,
  `weight` double(8,2) NOT NULL,
  `price_article` double(8,2) NOT NULL,
  `price_total` double(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_client_id_foreign` (`client_id`),
  CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'test','test',1,2,1,'2018-09-01 17:49:33','2018-09-27 01:01:00','2018-09-01 17:49:33','2018-10-23 18:42:36',10,0,'2018-10-23 18:41:34',15,19.63,0.00,0.00),(3,'test2','test2',2,1,1,'2018-09-01 18:11:38','2018-09-26 13:00:00','2018-09-01 18:11:38','2018-10-19 11:22:13',2,2,'2018-10-19 11:22:13',0,0.00,0.00,0.00),(4,'test3','test3',3,0,3,'2018-09-01 18:24:50','2018-09-01 18:05:00','2018-09-01 18:24:50','2018-11-06 09:38:09',3,4,'0000-00-00 00:00:00',5,6.00,0.00,0.00),(5,'creatednow','FR-334',4,1,3,'2018-09-02 06:19:58','2018-09-19 09:33:00','2018-09-02 06:19:59','2018-11-14 10:06:51',2,6,'0000-00-00 00:00:00',0,0.00,0.00,0.00),(6,'Pantof','12345-dama',100,0,3,'2018-09-02 10:09:02','2025-09-20 18:00:00','2018-09-02 10:09:02','2018-09-02 10:09:02',0,0,'0000-00-00 00:00:00',0,0.00,0.00,0.00),(7,'Comanda 25 sep','x-22',100,1,1,'2018-09-25 18:24:14','2030-10-20 18:00:00','2018-09-25 18:24:14','2018-09-25 18:24:58',10,0,'0000-00-00 00:00:00',0,0.00,0.00,0.00),(9,'Nume comanda','Derp22',44,2,4,'2018-11-04 10:05:52','2018-11-23 17:01:00','2018-11-04 10:05:52','2018-11-04 10:07:52',0,0,'0000-00-00 00:00:00',22,50.00,0.00,0.00),(11,'Comanda noua 33','xx-22',6,0,1,'2018-11-16 10:29:16','2018-11-24 00:00:00','2018-11-16 10:29:16','2018-11-16 10:29:16',0,0,'0000-00-00 00:00:00',0,0.00,4.00,24.00),(12,'Noua comanda','Articol nr 3',3,0,1,'2018-11-23 16:16:25','2018-01-01 01:00:00','2018-11-23 16:16:25','2018-11-23 16:16:25',0,0,'0000-00-00 00:00:00',0,0.00,10.00,30.00);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('mail23451@yopmail.com','ed92ae4a863fbc270892c1be861686be0840a9ec6b9528701328956ba7f44752','2018-09-01 15:14:46'),('bogdan.mihut8@gmail.com','71f8bc32e0810064ceb44b2ebc05555d4a73f2edc14834a0df9dc4a815042bd5','2018-09-01 15:19:40');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'testuser1','mail23451@yopmail.com','$2y$10$nVWmvkztbDVrpvUTdopATejAa8gwpBYmhChUTo8VgwNhDeX8b1CXC','vGetL3p7eFo4ZxqyEF9tdiuHgqO6ADK0HFkxwAD8mAwhUr23biqUWKQJuIc2','2018-09-01 10:24:38','2018-11-23 19:09:15'),(2,'mihxx','testyyy@yopmail.comp','$2y$10$VCdVdQ0Z1RzVhG1eM9sNc.uAitIJDylWZrmjDO3bB6xyaQeoQygmu','zUBqznaIMGanUwI5E5YXu0uSiH2I0djBJeaA8Vb91t2b71hAcdkzYU4pzJnp','2018-09-01 11:33:41','2018-09-01 14:23:35'),(3,'liviu','testyyyyy@yopmai.com','$2y$10$wrH2EU5hNEAApYB5ogmG/.ydV.RpQ.YBnIEpvhimXdBiOO0ddf.TO',NULL,'2018-09-01 11:34:43','2018-09-01 11:34:43'),(10,'Bogdan','bogdan.mihut8@gmail.com','$2y$10$q8YLIkJp3BZtVxP2m1TkpeAYjYOv.pPl2GczBcLibIlkEcqtXOcN6',NULL,'2018-09-01 15:18:28','2018-09-01 15:18:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-23 19:32:34
