-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: Twitter
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `tweet_id` int(11) DEFAULT NULL,
  `text` varchar(60) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `tweet_id` (`tweet_id`),
  CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`),
  CONSTRAINT `Comments_ibfk_2` FOREIGN KEY (`tweet_id`) REFERENCES `Tweets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
INSERT INTO `Comments` VALUES (3,23,7,'new','2017-09-17 20:10:23'),(4,17,6,'new\r\n','2017-09-17 20:14:50'),(5,17,6,'new','2017-09-17 20:22:12'),(6,17,6,'new','2017-09-17 20:22:50'),(7,17,6,'new','2017-09-17 20:23:12'),(8,17,6,'new','2017-09-17 20:25:40'),(9,17,6,'new2','2017-09-17 20:27:52'),(10,17,6,'new2','2017-09-17 20:31:00'),(11,17,6,'new2','2017-09-17 20:31:42'),(12,17,6,'comment','2017-09-17 20:31:55'),(13,17,6,'jakiÅ›','2017-09-17 20:32:01'),(20,41,47,'Komentarz do testowego tweeta\r\n','2017-09-17 20:50:12'),(21,41,47,'Komentarz do testowego tweeta\r\n','2017-09-17 20:50:37'),(24,41,47,'Komentarz do testowego tweeta\r\n','2017-09-17 20:51:33'),(25,41,47,'Komentarz do testowego tweeta\r\n','2017-09-17 20:52:11'),(28,41,47,'test formularza','2017-09-17 20:52:50'),(29,41,47,'test formularza','2017-09-17 20:53:37'),(33,41,47,'test','2017-09-17 20:55:11'),(34,41,47,'test','2017-09-17 21:00:33'),(35,41,47,'kolejny','2017-09-17 21:02:14'),(44,67,43,'comment','2017-09-19 21:49:03'),(45,41,47,'another','2017-09-19 21:50:51');
/*!40000 ALTER TABLE `Comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Messages`
--

DROP TABLE IF EXISTS `Messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` varchar(3000) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `indicator` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `Users` (`id`),
  CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `Users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Messages`
--

LOCK TABLES `Messages` WRITE;
/*!40000 ALTER TABLE `Messages` DISABLE KEYS */;
INSERT INTO `Messages` VALUES (1,67,9,'test','2017-09-18 20:53:18',1),(9,76,67,'test user300','2017-09-18 21:23:31',0),(10,76,67,'nowa','2017-09-18 21:24:38',0),(11,76,35,'','2017-09-18 21:25:57',1),(12,76,9,'Obejrzyj koniecznie film \"Gdzie mieszkajÄ… dzikie stwory\". Wymiata klimatem','2017-09-18 21:38:57',1),(13,67,76,'Nowa pogrubiona;)','2017-09-18 22:14:27',0),(14,76,67,'CzeÅ›Ä‡','2017-09-19 18:13:50',0),(15,76,9,'Drugi raz','2017-09-19 18:14:32',1),(16,76,67,'user100','2017-09-19 18:15:18',0),(17,76,67,'test','2017-09-19 18:15:55',0),(18,76,67,'test','2017-09-19 18:26:48',0);
/*!40000 ALTER TABLE `Messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tweets`
--

DROP TABLE IF EXISTS `Tweets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tweets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `text` varchar(140) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `Tweets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tweets`
--

LOCK TABLES `Tweets` WRITE;
/*!40000 ALTER TABLE `Tweets` DISABLE KEYS */;
INSERT INTO `Tweets` VALUES (2,13,'Join test',NULL),(3,13,'Join test',NULL),(4,67,'Join test',NULL),(6,17,'Join test',NULL),(7,23,'Join test',NULL),(8,67,'fwwfew','2017-09-17 18:37:15'),(9,67,'fwwfew','2017-09-17 18:37:20'),(10,67,'fwwfew','2017-09-17 18:37:24'),(11,67,'fwwfew','2017-09-17 18:37:31'),(12,67,'KFEA','2017-09-17 18:52:12'),(13,67,'32','2017-09-17 18:57:14'),(14,67,'tweet','2017-09-17 19:20:24'),(15,67,'tweet','2017-09-17 19:20:30'),(16,67,'tweet','2017-09-17 19:20:36'),(17,67,'twit','2017-09-17 19:21:20'),(18,67,'twit','2017-09-17 19:21:31'),(19,67,'twit2\r\n','2017-09-17 19:21:57'),(20,67,'twit2\r\n','2017-09-17 19:22:02'),(21,67,'twit2\r\n','2017-09-17 19:22:07'),(22,67,'twit3','2017-09-17 19:23:24'),(23,67,'twit3','2017-09-17 19:23:27'),(24,67,'twit3','2017-09-17 19:23:30'),(25,67,'twit4','2017-09-17 19:24:57'),(26,67,'twit4','2017-09-17 19:25:01'),(27,67,'twit4','2017-09-17 19:25:07'),(28,67,'twit5','2017-09-17 19:26:35'),(29,67,'twit5','2017-09-17 19:26:38'),(30,67,'twit5','2017-09-17 19:26:43'),(31,67,'twit7','2017-09-17 19:29:10'),(32,67,'twit7','2017-09-17 19:29:16'),(33,67,'twit7','2017-09-17 19:29:21'),(34,67,'twit8','2017-09-17 19:36:01'),(35,67,'twit8','2017-09-17 19:36:05'),(36,67,'twit8','2017-09-17 19:37:26'),(37,67,'twit8','2017-09-17 19:50:24'),(38,67,'twit8','2017-09-17 19:50:41'),(39,67,'twit8','2017-09-17 19:51:02'),(40,67,'twit8','2017-09-17 19:51:16'),(41,67,'twit8','2017-09-17 19:51:25'),(42,67,'nowytwit','2017-09-17 20:34:20'),(43,67,'nowytwit','2017-09-17 20:34:31'),(44,67,'nowytwit','2017-09-17 20:34:38'),(45,67,'nowytwit','2017-09-17 20:37:04'),(46,67,'nowytwit','2017-09-17 20:37:26'),(47,41,'testowy komentarz do potrzeb Tweetera','2017-09-17 20:43:03'),(48,67,'Tweeeeeeeeeeet','2017-09-19 22:08:42'),(49,67,'Tweeeeeeeeeeet','2017-09-19 22:08:47'),(50,67,'Tweet!','2017-09-19 22:09:44'),(51,67,'Tweet!','2017-09-19 22:09:56'),(52,67,'Tweet!','2017-09-19 22:10:59'),(53,67,'nowy','2017-09-19 22:11:04');
/*!40000 ALTER TABLE `Tweets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hash_pass` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (9,'user1','user1@twitter.com','user1'),(13,'user3','user3@twitter.com',NULL),(17,'user3','user5@twitter.com',NULL),(23,'user3','user10@twitter.com','$2y$10$.Dxdr/eCBnJH.jl9V6QpeOqPLL3Cc7fKkItYn6wnwgucQQaZyKkRi'),(24,'user3','user11@twitter.com','$2y$10$nEtWEWKARK0jKqywLxTZmuWrnw6i8dvTeRjNhG4adGObNs4W3nIii'),(25,'user3','user12@twitter.com','$2y$10$B2bXDvGAPzjRI.amAaNOnOHVnwwaA0J6XGCiJt79wCh9Y8LxOzMeK'),(26,'user3','user13@twitter.com','$2y$10$k0zwyLI6rPpE8AFDuU31n.hlBQJC7sqX11evpGLMhqmIwrvaKgcUG'),(27,'user3','user14@twitter.com','$2y$10$LEGQE89tw5R/PnKRKEDsSutoUcwRL1.mIix.3rKMObqTsBzWQ.jtm'),(28,'user3','user15@twitter.com','$2y$10$gs/s3jLuXaQy.2pR69Xdf.NsvKqIARxV9h3eMJjGMxA7FG6T00r3C'),(29,'user3','user16@twitter.com','$2y$10$VK8Nd7wIrzhz5ooOL71DDuAQM2LvWZkuuYaP..ToBRyjLaNXl8rbS'),(31,'user3','user17@twitter.com','$2y$10$m2PojqeMa6yTiCynfaZX1.MOUBG3XsFMuZDLDmA7MPwbYyYnF194q'),(32,'user3','user21@twitter.com','$2y$10$KBRj9Vh7BrryWjaTj9G.Wu19Ls65Kw29KjuIOX3BZ2nEbSSJdREFu'),(33,'user3','user23@twitter.com','$2y$10$rK1wNdwwAfPJZaPLDWVXtOCkQb/zioAlUe9GSOfIAOv5FkvTaj1Uu'),(35,'user4','','$2y$10$sNMT/sU4Yd50XaTSBVd/JeOmPIzyGtEijaFicR15hp0AM9VKY3CCm'),(41,'user1','user50@twitter.com','$2y$10$GfY/heUtC/dghmpaklbPHunHLfKA93FBvH4MkvpWnHRW1lARLhe/2'),(42,'user3','user44@twitter.com','$2y$10$JLTJfFaa8wfz/7se9lryMO4N6xKbZzGUhYxy4GnHhOhwFxtgDQW3W'),(44,'user3','use45@twitter.com','$2y$10$.SiMGJHQQLNr7s3JUfQVBOOsipT5c5TwGHEEMh6H7JECstAHSTFb.'),(46,'user3','user100@twitter.com','$2y$10$HqSXK/KP2d26sF9Rk.AUe.nZwk/.R.Xgqxb3cTZCrwOANg6.JA/7i'),(48,'user3','user103@twitter.com','$2y$10$KvRq5vA6o.9dJBNIf4Z3AuPd0ePIAQKbcsMhLQZz95je2QJsFzlF2'),(49,'user3','user48@twitter.com','$2y$10$Su2seZUywyiD1FWBmmPw4OX.y72s0oL0/WNlZWwMGlI29qOEfXWRW'),(50,'user1','user47@twitter.com','$2y$10$W5KAYvVY/H0vNrfqi5gSMeu6bdOD0/oN0f1CYBUT4jUqRAujVR6wm'),(52,'user3','user105@twitter.com','$2y$10$oP6rQQMtAfxVKj8U5JzXr.8bopMiw5Rx8YrEzPdmVB99H78CIUsvW'),(54,'ania','ania@twitter.com','$2y$10$JlmlvDBzxTLvyHiNbTGOMuuzjaHp3yi4lqzO14HGZXKrutxBCx6Vu'),(65,'userr','user111@twitter.com','$2y$10$Lu1L6DcmVK.Q5RzDXqLIA.pGo9z8bFEaaCcmzelrW6R5G82P2jt.a'),(66,'user13','user3331','$2y$10$Ucg/YqZPf3mMOeHMs6dZN.75lxWluoJDXo200SWpfjlDOs3fwLNDG'),(67,'user100','user100','$2y$10$dKsLm32NXDbprzYa6b3YyuzmPiOpzI11HEJLZ/.wz25Kq6wNknUBK'),(68,'user1','user1000','$2y$10$aLoUh9rmJ4Lcm.Jg6qNFWOjK5QpdxUmYNcOlLRzG0ejOjLv9DB2tq'),(76,'user300','user300','$2y$10$t2ZSCD9IVV/4wsd96f72ouN4GPPs9qfbMsG..dBHliZ3/BhYgfRr2'),(77,'user2','user2','$2y$10$d5DyobN7d1BTnXD6hJaU3uhASRkppPyjhQ0lZ.p0ehf/QImL5Ikmm');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-20 20:55:15
