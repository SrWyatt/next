/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sistema_comercial
-- ------------------------------------------------------
-- Server version	11.8.6-MariaDB-0+deb13u1 from Debian

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT 'admin@sistema.com',
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES
(1,'wyatt','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','admin@sistema.com',NULL),
(2,'adm1','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','admin@sistema.com',NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2026_04_22_020843_create_erp_tables',1),
(2,'2026_04_22_023421_create_sessions_table',1),
(3,'2026_04_22_025410_create_cache_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `support`
--

DROP TABLE IF EXISTS `support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `support` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL DEFAULT 'Soporte Técnico',
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `support` WRITE;
/*!40000 ALTER TABLE `support` DISABLE KEYS */;
INSERT INTO `support` VALUES
(1,'sys1',NULL,'$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','Soporte Técnico',NULL),
(2,'sys2','sys2@mail.com','$2y$12$.2rtAP/0Gc.KUacktvACSeoeZi0SKBugEKLKswFBfVxyG0296OlJ.','Soporte Técnico',NULL),
(3,'sys3','sys3@mail.com','$2y$12$muJnTeQdrJz3qqcIsTbDXOf7yEEjVS9MxzOx8aiN6pWqYYblgrqxm','Soporte Técnico',NULL);
/*!40000 ALTER TABLE `support` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `remember_token` varchar(100) DEFAULT NULL,
  `ultima_var` decimal(10,4) DEFAULT 0.0000,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'user1','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user1@mail.com',324.22,NULL,1.9900),
(2,'user2','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user2@mail.com',85.98,NULL,-2.6700),
(3,'user3','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user3@mail.com',798.07,NULL,-128.0000),
(4,'user4','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user4@mail.com',261.80,NULL,2.1900),
(5,'user5','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user5@mail.com',346.16,NULL,-2.4400),
(6,'user6','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user6@mail.com',0.00,NULL,-1.5200),
(7,'user7','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user7@mail.com',144.42,NULL,-0.4700),
(8,'user8','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user8@mail.com',2.50,NULL,2.5000),
(9,'user9','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user9@mail.com',1297.06,NULL,-0.6400),
(10,'user10','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user10@mail.com',63.95,NULL,-0.4500),
(11,'user11','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user11@mail.com',6.78,NULL,1.9500),
(12,'user12','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user12@mail.com',503.62,NULL,-0.7900),
(13,'user13','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user13@mail.com',334.28,NULL,2.6900),
(14,'user14','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user14@mail.com',24.68,NULL,-2.8100),
(15,'user15','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user15@mail.com',561.46,NULL,-0.7000),
(16,'user16','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user16@mail.com',985.34,NULL,0.1300),
(17,'user17','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user17@mail.com',59.88,NULL,0.7600),
(18,'user18','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user18@mail.com',117.95,NULL,2.3200),
(19,'user19','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user19@mail.com',9776.48,NULL,-1.4600),
(20,'user20','$2y$12$GbZ9Gv4/SmFJnRr/FVoOpuinO.rHdGYPhn.64BxeyIDH3UrlToO7a','user20@mail.com',190.06,NULL,-0.0400);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-05-17 20:59:05
