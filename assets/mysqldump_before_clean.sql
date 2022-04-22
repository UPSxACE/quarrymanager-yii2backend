-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: gestorpedreira
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

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
-- Table structure for table `codigodesconto`
--

DROP TABLE IF EXISTS `codigodesconto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codigodesconto` (
  `codigo` varchar(40) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `descontoGeral` float DEFAULT NULL,
  `idProduto` int(11) DEFAULT NULL,
  `descontoProduto` float DEFAULT NULL,
  `dataExpiracao` date DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_CodigoDesconto_Produto1_idx` (`idProduto`),
  CONSTRAINT `fk_CodigoDesconto_Produto1` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codigodesconto`
--

LOCK TABLES `codigodesconto` WRITE;
/*!40000 ALTER TABLE `codigodesconto` DISABLE KEYS */;
/*!40000 ALTER TABLE `codigodesconto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cor`
--

DROP TABLE IF EXISTS `cor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `prefixo` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prefixo_UNIQUE` (`prefixo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cor`
--

LOCK TABLES `cor` WRITE;
/*!40000 ALTER TABLE `cor` DISABLE KEYS */;
INSERT INTO `cor` VALUES (1,'amarelo','AMR'),(2,'branco','BRC'),(3,'azul','AZL'),(4,'preto','PRT'),(5,'laranja','LRJ'),(6,'AAA','AAA'),(7,'AAAA','AAC');
/*!40000 ALTER TABLE `cor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Pendente'),(2,'Dados Confirmados'),(3,'Stock Confirmado'),(4,'Aguardar Pagamento'),(5,'Pagamento Confirmado'),(6,'Em Espera'),(7,'Recolhas Agendadas'),(8,'Recebido'),(9,'Finalizado'),(10,'Cancelado');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_pedido`
--

DROP TABLE IF EXISTS `estado_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idEstado` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `dataEstado` datetime DEFAULT NULL,
  `last` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_Estado_Pedido_Pedido1_idx` (`idPedido`),
  KEY `fk_Estado_Pedido_Estado1` (`idEstado`),
  CONSTRAINT `fk_Estado_Pedido_Estado1` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Estado_Pedido_Pedido1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_pedido`
--

LOCK TABLES `estado_pedido` WRITE;
/*!40000 ALTER TABLE `estado_pedido` DISABLE KEYS */;
INSERT INTO `estado_pedido` VALUES (1,2,1,'0000-00-00 00:00:00',0),(2,1,2,'0000-00-00 00:00:00',0),(3,2,7,'2022-04-14 01:57:37',0),(4,2,8,'2022-04-14 01:59:19',0),(5,2,9,'2022-04-14 18:56:02',0),(6,3,8,'2022-04-22 11:28:44',0),(7,4,8,'2022-04-22 11:28:44',0),(8,5,8,'2022-04-22 11:28:44',0),(9,6,8,'2022-04-22 11:28:44',0),(10,7,8,'2022-04-22 11:28:45',0),(11,8,8,'2022-04-22 11:28:45',0),(12,9,8,'2022-04-22 11:28:45',0),(13,2,8,'2022-04-22 11:28:45',0),(14,3,9,'2022-04-22 11:29:49',0),(15,4,9,'2022-04-22 11:29:49',0),(16,5,9,'2022-04-22 11:29:49',0),(17,6,9,'2022-04-22 11:29:49',0),(18,7,9,'2022-04-22 11:29:49',0),(19,8,9,'2022-04-22 11:29:49',0),(20,9,9,'2022-04-22 11:29:49',0),(21,2,9,'2022-04-22 11:29:49',0),(22,3,8,'2022-04-22 11:31:23',0),(23,4,8,'2022-04-22 11:31:23',0),(24,5,8,'2022-04-22 11:31:23',0),(25,6,8,'2022-04-22 11:31:23',0),(26,7,8,'2022-04-22 11:31:23',0),(27,8,8,'2022-04-22 11:31:23',0),(28,9,8,'2022-04-22 11:31:24',0),(29,4,8,'2022-04-22 11:31:24',0),(30,3,9,'2022-04-22 11:32:06',0),(31,4,9,'2022-04-22 11:32:07',0),(32,5,9,'2022-04-22 11:32:07',0),(33,6,9,'2022-04-22 11:32:07',0),(34,7,9,'2022-04-22 11:32:07',0),(35,8,9,'2022-04-22 11:32:07',0),(36,9,9,'2022-04-22 11:32:07',0),(37,5,9,'2022-04-22 11:32:07',0),(38,5,8,'2022-04-22 11:35:48',0),(39,6,8,'2022-04-22 11:36:20',0),(40,7,8,'2022-04-22 11:36:20',0),(41,8,8,'2022-04-22 11:36:21',0),(42,9,8,'2022-04-22 11:36:21',0),(43,5,8,'2022-04-22 11:36:21',0),(44,6,9,'2022-04-22 11:39:01',0),(45,7,9,'2022-04-22 11:39:01',0),(46,8,9,'2022-04-22 11:39:01',0),(47,9,9,'2022-04-22 11:39:02',0),(48,2,1,'2022-04-22 11:39:02',0),(49,1,8,'2022-04-22 13:16:53',0),(50,1,8,'2022-04-22 13:16:53',0),(51,1,8,'2022-04-22 13:16:54',0),(52,1,8,'2022-04-22 13:16:54',0),(53,1,8,'2022-04-22 13:16:54',0),(54,1,8,'2022-04-22 13:16:54',0),(55,1,8,'2022-04-22 13:16:54',0),(56,1,8,'2022-04-22 13:16:54',0),(57,1,8,'2022-04-22 13:16:54',0),(58,1,8,'2022-04-22 13:16:54',0),(59,1,8,'2022-04-22 13:16:54',0),(60,1,8,'2022-04-22 13:16:54',0),(61,1,8,'2022-04-22 13:16:54',0),(62,1,8,'2022-04-22 13:16:55',0),(63,1,8,'2022-04-22 13:16:55',0),(64,1,8,'2022-04-22 13:16:55',0),(65,1,8,'2022-04-22 13:16:55',0),(66,1,8,'2022-04-22 13:16:55',0),(67,1,8,'2022-04-22 13:16:55',0),(68,1,8,'2022-04-22 13:16:55',0),(69,1,8,'2022-04-22 13:16:56',0),(70,1,8,'2022-04-22 13:16:57',0),(71,1,8,'2022-04-22 13:16:57',0),(72,1,8,'2022-04-22 13:16:57',0),(73,1,8,'2022-04-22 13:16:57',0),(74,1,8,'2022-04-22 13:16:57',0),(75,1,8,'2022-04-22 13:16:57',0),(76,1,8,'2022-04-22 13:16:57',0),(77,1,8,'2022-04-22 13:16:57',0),(78,1,8,'2022-04-22 13:16:57',0),(79,1,8,'2022-04-22 13:16:57',0),(80,1,8,'2022-04-22 13:16:58',0),(81,1,8,'2022-04-22 13:16:58',0),(82,1,8,'2022-04-22 13:16:58',0),(83,1,8,'2022-04-22 13:16:58',0),(84,1,8,'2022-04-22 13:16:58',0),(85,1,8,'2022-04-22 13:16:58',0),(86,1,8,'2022-04-22 13:16:58',0),(87,1,8,'2022-04-22 13:16:58',0),(88,1,8,'2022-04-22 13:16:58',0),(89,2,8,'2022-04-22 13:18:21',0),(90,3,8,'2022-04-22 13:18:21',0),(91,4,8,'2022-04-22 13:18:21',0),(92,5,8,'2022-04-22 13:18:21',0),(93,6,8,'2022-04-22 13:18:22',0),(94,7,8,'2022-04-22 13:18:22',0),(95,8,8,'2022-04-22 13:18:22',0),(96,9,8,'2022-04-22 13:18:22',0),(97,5,8,'2022-04-22 13:18:22',0),(98,6,8,'2022-04-22 13:19:18',0),(99,7,8,'2022-04-22 13:19:18',0),(100,8,8,'2022-04-22 13:19:18',0),(101,9,8,'2022-04-22 13:19:18',0),(102,3,8,'2022-04-22 13:19:18',0),(103,4,8,'2022-04-22 13:20:21',0),(104,5,8,'2022-04-22 13:20:21',0),(105,6,8,'2022-04-22 13:20:21',0),(106,7,8,'2022-04-22 13:20:21',0),(107,8,8,'2022-04-22 13:20:21',0),(108,9,8,'2022-04-22 13:20:21',0),(109,3,8,'2022-04-22 13:20:21',0),(110,3,8,'2022-04-22 13:21:43',0),(111,3,8,'2022-04-22 13:21:43',0),(112,3,8,'2022-04-22 13:21:43',0),(113,3,8,'2022-04-22 13:21:43',0),(114,3,8,'2022-04-22 13:21:43',0),(115,3,8,'2022-04-22 13:21:43',0),(116,3,8,'2022-04-22 13:21:43',0),(117,3,8,'2022-04-22 13:21:43',0),(118,3,8,'2022-04-22 13:21:43',0),(119,3,8,'2022-04-22 13:21:44',0),(120,3,8,'2022-04-22 13:21:44',0),(121,3,8,'2022-04-22 13:21:44',0),(122,3,8,'2022-04-22 13:21:44',0),(123,3,8,'2022-04-22 13:21:44',0),(124,3,8,'2022-04-22 13:21:44',0),(125,3,8,'2022-04-22 13:21:44',0),(126,3,8,'2022-04-22 13:21:44',0),(127,3,8,'2022-04-22 13:21:44',0),(128,3,8,'2022-04-22 13:21:44',0),(129,3,8,'2022-04-22 13:21:45',0),(130,3,8,'2022-04-22 13:23:40',0),(131,3,8,'2022-04-22 13:23:41',0),(132,3,8,'2022-04-22 13:23:41',0),(133,3,8,'2022-04-22 13:23:41',0),(134,3,8,'2022-04-22 13:23:41',0),(135,3,8,'2022-04-22 13:23:41',0),(136,3,8,'2022-04-22 13:23:41',0),(137,3,8,'2022-04-22 13:23:41',0),(138,3,8,'2022-04-22 13:23:41',0),(139,3,8,'2022-04-22 13:23:41',0),(140,3,8,'2022-04-22 13:23:41',0),(141,3,8,'2022-04-22 13:23:42',0),(142,3,8,'2022-04-22 13:23:42',0),(143,3,8,'2022-04-22 13:23:42',0),(144,3,8,'2022-04-22 13:23:42',0),(145,3,8,'2022-04-22 13:23:42',0),(146,3,8,'2022-04-22 13:23:42',0),(147,3,8,'2022-04-22 13:23:42',0),(148,3,8,'2022-04-22 13:23:42',0),(149,3,8,'2022-04-22 13:23:42',0),(150,3,8,'2022-04-22 13:23:44',0),(151,3,8,'2022-04-22 13:23:44',0),(152,6,8,'2022-04-22 13:24:59',0),(153,4,9,'2022-04-22 13:30:03',0),(154,1,9,'2022-04-22 13:30:17',0),(155,2,9,'2022-04-22 13:31:33',0),(156,4,9,'2022-04-22 13:32:39',0),(157,2,9,'2022-04-22 13:33:51',0),(158,4,9,'2022-04-22 13:35:21',0),(159,1,9,'2022-04-22 13:36:00',0),(160,2,9,'2022-04-22 13:36:30',0),(161,4,9,'2022-04-22 13:36:39',0),(162,1,9,'2022-04-22 13:37:52',0),(163,6,9,'2022-04-22 13:38:32',0),(164,7,9,'2022-04-22 13:42:17',0),(165,1,9,'2022-04-22 13:42:59',0),(166,2,9,'2022-04-22 13:43:39',0),(167,3,9,'2022-04-22 13:43:42',0),(168,4,9,'2022-04-22 13:43:45',0),(169,3,9,'2022-04-22 21:21:52',0),(170,5,9,'2022-04-22 21:22:15',0),(171,3,9,'2022-04-22 21:22:35',0),(172,4,9,'2022-04-22 22:18:34',1);
/*!40000 ALTER TABLE `estado_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotografia`
--

DROP TABLE IF EXISTS `fotografia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotografia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotografia`
--

LOCK TABLES `fotografia` WRITE;
/*!40000 ALTER TABLE `fotografia` DISABLE KEYS */;
INSERT INTO `fotografia` VALUES (1,'profilePictures/genericUserProfilePicture.svg'),(2,'profilePictures/7 BASE SKILLS FOR ART.png'),(3,'profilePictures/7 BASE SKILLS FOR ART.png'),(4,'profilePictures/css layers.png'),(5,'profilePictures/BOTOES.png'),(6,'profilePictures/levelssoftwareengineer.png'),(7,'profilePictures/levelssoftwareengineer.png'),(8,'profilePictures/levelssoftwareengineer.png'),(9,'profilePictures/levelssoftwareengineer.png'),(10,'profilePictures/levelssoftwareengineer.png'),(11,'productPictures/7 BASE SKILLS FOR ART.png'),(12,'productPictures/marmore.png'),(13,'productPictures/pedreiraMoleanos.png'),(14,'profilePictures/wR.png'),(15,'profilePictures/CEO2.jpg'),(16,'productPictures/indexPic1.png'),(17,'productPictures/centro.png'),(18,'productPictures/centro.png'),(19,'productPictures/centro.png'),(20,'productPictures/centro.png'),(21,'productPictures/faqPicture.jpg'),(22,'productPictures/centro.png'),(23,'productPictures/indexPic1.png'),(24,'productPictures/marmore.png'),(25,'productPictures/centro.png'),(26,'productPictures/indexPic1.png'),(27,'productPictures/centro.png'),(28,'productPictures/pedreiraMoleanos.png');
/*!40000 ALTER TABLE `fotografia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotografia_lote`
--

DROP TABLE IF EXISTS `fotografia_lote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotografia_lote` (
  `id` int(11) NOT NULL,
  `codigoLote` varchar(50) NOT NULL,
  `idFotografia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Fotografia_Lote_Lote1_idx` (`codigoLote`),
  KEY `fk_Fotografia_Lote_Fotografia1_idx` (`idFotografia`),
  CONSTRAINT `fk_Fotografia_Lote_Fotografia1` FOREIGN KEY (`idFotografia`) REFERENCES `fotografia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fotografia_Lote_Lote1` FOREIGN KEY (`codigoLote`) REFERENCES `lote` (`codigo_lote`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotografia_lote`
--

LOCK TABLES `fotografia_lote` WRITE;
/*!40000 ALTER TABLE `fotografia_lote` DISABLE KEYS */;
/*!40000 ALTER TABLE `fotografia_lote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotografia_produto`
--

DROP TABLE IF EXISTS `fotografia_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotografia_produto` (
  `id` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `idFotografia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Fotografia_Produto_Produto1_idx` (`idProduto`),
  KEY `fk_Fotografia_Produto_Fotografia1_idx` (`idFotografia`),
  CONSTRAINT `fk_Fotografia_Produto_Fotografia1` FOREIGN KEY (`idFotografia`) REFERENCES `fotografia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fotografia_Produto_Produto1` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotografia_produto`
--

LOCK TABLES `fotografia_produto` WRITE;
/*!40000 ALTER TABLE `fotografia_produto` DISABLE KEYS */;
/*!40000 ALTER TABLE `fotografia_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localarmazem`
--

DROP TABLE IF EXISTS `localarmazem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `localarmazem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localarmazem`
--

LOCK TABLES `localarmazem` WRITE;
/*!40000 ALTER TABLE `localarmazem` DISABLE KEYS */;
INSERT INTO `localarmazem` VALUES (1,'br'),(2,'AAAAAAAA');
/*!40000 ALTER TABLE `localarmazem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localextracao`
--

DROP TABLE IF EXISTS `localextracao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `localextracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `coordenadasGPS_X` float DEFAULT NULL,
  `coordenadasGPS_Y` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localextracao`
--

LOCK TABLES `localextracao` WRITE;
/*!40000 ALTER TABLE `localextracao` DISABLE KEYS */;
INSERT INTO `localextracao` VALUES (1,'br',1,1),(2,'brrrr',535,353),(3,'brrrrRRRRRR',3,3);
/*!40000 ALTER TABLE `localextracao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `idTipoAcao` int(11) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `dataHora` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Logs_TipoAcao1_idx` (`idTipoAcao`),
  KEY `fk_Logs_user1_idx` (`idUser`),
  CONSTRAINT `fk_Logs_TipoAcao1` FOREIGN KEY (`idTipoAcao`) REFERENCES `tipoacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Logs_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,1,2,'O lote GRN_AZL_00005 foi adicionado.','2022-04-22 22:01:03'),(2,1,2,'O produto de ID 26 foi criado.','2022-04-22 22:05:06'),(3,1,2,'O material \'FAASDF\' foi criado.','2022-04-22 22:07:03'),(4,1,2,'A cor \'AAAA\' foi criada.','2022-04-22 22:08:26'),(5,1,2,'O local de armazém \'AAAAAAAA\' foi criado.','2022-04-22 22:10:26'),(6,1,2,'O local de extração \'brrrrRRRRRR\' foi criado.','2022-04-22 22:11:02'),(7,1,2,'Foi confirmada a recolha de ID #5','2022-04-22 22:14:36'),(8,1,2,'Foi confirmada a recolha de ID #6do lote aaa','2022-04-22 22:16:10'),(9,1,2,'O estado da encomenda #9 foi atualizada.','2022-04-22 22:18:34'),(10,1,3,'O produto de ID # foi adicionado à Loja.','2022-04-22 22:23:30'),(11,1,3,'O produto de ID # foi adicionado à Loja.','2022-04-22 22:25:37'),(12,1,3,'O produto de ID # foi adicionado à Loja.','2022-04-22 22:29:02'),(13,1,3,'O produto \'MARMORE_BRANCO\' foi adicionado à Loja.','2022-04-22 22:31:03'),(14,1,3,'A transportadora \'CTTTT\' foi adicionada.','2022-04-22 22:33:20');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lote`
--

DROP TABLE IF EXISTS `lote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lote` (
  `codigo_lote` varchar(50) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `quantidade` float NOT NULL,
  `idLocalExtracao` int(11) NOT NULL,
  `idLocalArmazem` int(11) DEFAULT NULL,
  `dataHora` datetime DEFAULT NULL,
  PRIMARY KEY (`codigo_lote`),
  KEY `fk_Lote_Produto1_idx` (`idProduto`),
  KEY `fk_Lote_Local1_idx` (`idLocalExtracao`),
  KEY `fk_Lote_LocalArmazem1_idx` (`idLocalArmazem`),
  CONSTRAINT `fk_Lote_Local1` FOREIGN KEY (`idLocalExtracao`) REFERENCES `localextracao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lote_LocalArmazem1` FOREIGN KEY (`idLocalArmazem`) REFERENCES `localarmazem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lote_Produto1` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lote`
--

LOCK TABLES `lote` WRITE;
/*!40000 ALTER TABLE `lote` DISABLE KEYS */;
INSERT INTO `lote` VALUES ('aaa',3,230,1,1,'2022-04-22 16:13:30'),('GRN_AZL_00000',3,505,1,1,'2022-04-22 16:21:48'),('GRN_AZL_00004',3,55,1,1,'2022-04-22 16:28:36'),('GRN_AZL_00005',3,505,1,1,'2022-04-22 22:00:53'),('MRM_AZL_001',1,125,1,1,NULL),('MRM_BRC_00001',4,155,1,1,'2022-04-22 21:59:19'),('MRM_BRC_00002',4,155,1,1,'2022-04-22 21:59:19'),('qwerqwe',3,505,1,1,'2022-04-22 16:05:04'),('TJL_BRC_00000',2,505,1,1,'2022-04-22 16:17:57');
/*!40000 ALTER TABLE `lote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `prefixo` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prefixo_UNIQUE` (`prefixo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
INSERT INTO `material` VALUES (1,'granito','GRN'),(2,'mármore','MRM'),(3,'tijolo','TJL'),(4,'FAASDF','VCS');
/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacao`
--

DROP TABLE IF EXISTS `notificacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `notificao_lida` tinyint(4) NOT NULL DEFAULT 0,
  `origem` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notificacoes_user1_idx` (`idUser`),
  CONSTRAINT `fk_notificacoes_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacao`
--

LOCK TABLES `notificacao` WRITE;
/*!40000 ALTER TABLE `notificacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idProduto` int(11) DEFAULT NULL,
  `desconto` float DEFAULT NULL,
  `codigo_desconto` varchar(50) DEFAULT NULL,
  `quantidade` float DEFAULT NULL,
  `nome` varchar(150) NOT NULL,
  `morada` varchar(150) DEFAULT NULL,
  `localidade` varchar(50) DEFAULT NULL,
  `codPostal` varchar(15) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `mensagem` varchar(150) DEFAULT NULL,
  `nif` int(11) DEFAULT NULL,
  `nib` int(11) DEFAULT NULL,
  `dataHoraPedido` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Pedido_Produto1_idx` (`idProduto`),
  KEY `fk_Pedido_user1_idx` (`idUser`),
  CONSTRAINT `fk_Pedido_Produto1` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pedido_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (1,1,1,NULL,NULL,50,'Eduardo','Bragança',NULL,NULL,'962075694','eduardo11224b@gmail.com','olá mundo',1235132515,NULL,'0000-00-00 00:00:00'),(2,1,1,NULL,NULL,1,'Eduardo Pinto','Largo Coronel Albino Lopo',NULL,NULL,'962075694','eduardo11224b@gmail.com',NULL,NULL,NULL,'2022-04-14 01:02:22'),(3,1,14,NULL,NULL,100,'Monique','Felgueiras',NULL,NULL,'+351962075694','segseg@gmail.com',NULL,NULL,NULL,'2022-04-14 01:48:11'),(4,1,14,NULL,NULL,100,'Monique','Largo Coronel Albino Lopo',NULL,NULL,'+351962075694','segseg@gmail.com',NULL,NULL,NULL,'2022-04-14 01:50:07'),(5,1,14,NULL,NULL,100,'Eduardo Pinto','Largo Coronel Albino Lopo',NULL,NULL,'+351962075694','segseg@gmail.com',NULL,NULL,NULL,'2022-04-14 01:53:45'),(6,1,14,NULL,NULL,100,'Eduardo Pinto','Largo Coronel Albino Lopo',NULL,NULL,'+351962075694','segseg@gmail.com',NULL,NULL,NULL,'2022-04-14 01:54:10'),(7,1,14,NULL,NULL,100,'Eduardo Pinto','Largo Coronel Albino Lopo',NULL,NULL,'+351962075694','segseg@gmail.com',NULL,NULL,NULL,'2022-04-14 01:57:37'),(8,1,15,NULL,NULL,5,'Eduardo Pinto','Largo Coronel Albino Lopo',NULL,NULL,'+351962075694','eduardo11224b@gmail.com',NULL,NULL,NULL,'2022-04-14 01:59:19'),(9,1,3,NULL,NULL,5,'Eduardo Pinto','Largo Coronel Albino Lopo',NULL,NULL,'+351962075694','eduardo11224b@gmail.com',NULL,NULL,NULL,'2022-04-14 18:56:02');
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_lote`
--

DROP TABLE IF EXISTS `pedido_lote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido_lote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPedido` int(11) NOT NULL,
  `codigoLote` varchar(50) NOT NULL,
  `trackingID` varchar(60) DEFAULT NULL,
  `quantidade` float NOT NULL,
  `idTransportadora` int(11) DEFAULT NULL,
  `matricula_Veiculo_recolha` varchar(30) DEFAULT NULL,
  `dataHoraRecolha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_QuantidadeStockReservado_Lote1_idx` (`codigoLote`),
  KEY `fk_Pedido_Lote_Transportadora1_idx` (`idTransportadora`),
  KEY `fk_QuantidadeStockReservado_Pedido` (`idPedido`),
  CONSTRAINT `fk_Pedido_Lote_Transportadora1` FOREIGN KEY (`idTransportadora`) REFERENCES `transportadora` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_QuantidadeStockReservado_Lote1` FOREIGN KEY (`codigoLote`) REFERENCES `lote` (`codigo_lote`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_QuantidadeStockReservado_Pedido` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_lote`
--

LOCK TABLES `pedido_lote` WRITE;
/*!40000 ALTER TABLE `pedido_lote` DISABLE KEYS */;
INSERT INTO `pedido_lote` VALUES (2,1,'MRM_AZL_001','sdst123',1,1,'1',NULL),(3,1,'MRM_AZL_001','aaaa',4,1,'1','2022-04-14 01:02:22'),(4,9,'aaa',NULL,90,1,'ABC-DUC','2022-04-22 20:44:41'),(5,9,'aaa',NULL,100,1,'ABC-DUCAAA','2022-04-22 22:14:36'),(6,9,'aaa',NULL,100,1,'asgasgas','2022-04-22 22:16:10'),(7,9,'aaa',NULL,70,1,'asfasf','2022-04-22 22:15:32');
/*!40000 ALTER TABLE `pedido_lote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idMaterial` int(11) NOT NULL,
  `idCor` int(11) DEFAULT NULL,
  `idFotografia` int(11) DEFAULT NULL,
  `Res_Compressao` float DEFAULT NULL,
  `Res_Flexao` float DEFAULT NULL,
  `Massa_Vol_Aparente` float DEFAULT NULL,
  `Absorcao_Agua` float DEFAULT NULL,
  `tituloArtigo` varchar(255) DEFAULT NULL,
  `descricaoProduto` varchar(2550) DEFAULT NULL,
  `preco` float DEFAULT NULL,
  `na_loja` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_Produto_Material1_idx` (`idMaterial`),
  KEY `fk_Produto_Cor1_idx` (`idCor`),
  KEY `fk_Produto_Fotografia_idx` (`idFotografia`),
  CONSTRAINT `fk_Produto_Cor1` FOREIGN KEY (`idCor`) REFERENCES `cor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produto_Fotografia1` FOREIGN KEY (`idFotografia`) REFERENCES `fotografia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produto_Material1` FOREIGN KEY (`idMaterial`) REFERENCES `material` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (1,1,5,20,NULL,NULL,NULL,NULL,'111','111',1,0),(2,3,2,26,NULL,NULL,NULL,NULL,'Tijolo Branco','bla bla blablabalala bla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalala',5,1),(3,1,3,21,NULL,NULL,NULL,NULL,'Mármore Branco','1',1,1),(4,2,2,25,NULL,NULL,NULL,NULL,'Mármore Branco','bla bla blablabalala bla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalalabla bla blablabalala',5,1),(5,3,1,1,NULL,NULL,NULL,NULL,'asddasd','ewqtwqet weqt wet weasdf  sdgsdgsg we4 wetr sfd sdgw sdg sdgwe4 weg ww sd sgwe wge',5,0),(6,2,4,27,NULL,NULL,NULL,NULL,'MARMORE PRETO','AAA',5,1),(7,2,2,28,NULL,NULL,NULL,NULL,'MARMORE_BRANCO','2323',5,1),(8,2,1,1,NULL,NULL,NULL,NULL,'asdasd','ewqtwqet weqt wet weasdf  sdgsdgsg we4 wetr sfd sdgw sdg sdgwe4 weg ww sd sgwe wge',5,0),(9,3,5,1,NULL,NULL,NULL,NULL,'asdsa','ewqtwqet weqt wet weasdf  sdgsdgsg we4 wetr sfd sdgw sdg sdgwe4 weg ww sd sgwe wge',2,0),(10,3,4,1,NULL,NULL,NULL,NULL,'asdsaas','ewqtwqet weqt wet weasdf  sdgsdgsg we4 wetr sfd sdgw sdg sdgwe4 weg ww sd sgwe wge',5,0),(11,1,5,1,NULL,NULL,NULL,NULL,'as','ewqtwqet weqt wet weasdf  sdgsdgsg we4 wetr sfd sdgw sdg sdgwe4 weg ww sd sgwe wge',6.5,0),(12,1,2,24,NULL,NULL,NULL,NULL,'4','4',4,1),(14,2,2,23,5,2,5,7,'4','4',4,1),(15,2,5,13,1,1,1,1,'Mármore Laranja','Sim',NULL,0),(16,2,3,16,4,5,6,8,'Marmore Azul','DESCRIPTION DESCRIPTION BLABLABLA',NULL,0),(18,2,1,22,1,2,3,4,'325235','3',3,1),(19,1,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(20,1,5,NULL,1,2,3,4,NULL,NULL,NULL,0),(21,2,4,NULL,4,4,3,2,NULL,NULL,NULL,0),(23,3,3,NULL,34,4,4,4,NULL,NULL,NULL,0),(24,2,3,NULL,4,4,4,4,NULL,NULL,NULL,0),(25,1,1,NULL,7,7,7,7,NULL,NULL,NULL,0),(26,2,2,NULL,1,5,6,7,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `idFotografia` int(11) NOT NULL DEFAULT 1,
  `email` varchar(70) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `genero` tinyint(4) DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `morada` varchar(150) DEFAULT NULL,
  `localidade` varchar(50) DEFAULT NULL,
  `codPostal` varchar(15) DEFAULT NULL,
  `nif` int(11) DEFAULT NULL,
  `nib` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Utilizador_Fotografia1_idx` (`idFotografia`),
  KEY `fk_dadosPessoais_user1_idx` (`user_id`),
  CONSTRAINT `fk_Utilizador_Fotografia1` FOREIGN KEY (`idFotografia`) REFERENCES `fotografia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_dadosPessoais_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,1,15,NULL,'Eduardo Pinto',0,'2001-01-12',NULL,'Largo Coronel Albino Lopo','Bragança','5300-116',NULL,NULL,'2022-03-31 01:38:51','2022-03-31 01:38:51',NULL),(3,5,1,'eduardo11224b@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-03-31 10:38:40','2022-03-31 10:38:40',NULL),(4,6,1,'guxmusic1029@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-03-31 11:08:13','2022-03-31 11:08:13',NULL),(23,NULL,1,NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,NULL,1,NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,NULL,1,NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,NULL,1,NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,NULL,1,NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,NULL,1,NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,NULL,1,NULL,'Eduardo botelho',0,'2001-01-11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,NULL,1,NULL,'Eduardo Botelho',0,'2001-01-11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,NULL,1,NULL,'Eduardo botelhoB',0,'2001-01-11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,NULL,1,NULL,'Eduardo botelhoBB',0,'2001-01-11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,7,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 16:40:13','2022-04-22 16:40:13',NULL);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `can_admin` smallint(6) NOT NULL DEFAULT 0,
  `can_gestor` smallint(6) NOT NULL DEFAULT 0,
  `can_operario` smallint(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Administrador',NULL,NULL,1,1,1),(2,'Gestor',NULL,NULL,0,1,1),(3,'Operário',NULL,NULL,0,0,1),(4,'Cliente',NULL,NULL,0,0,0);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoacao`
--

DROP TABLE IF EXISTS `tipoacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoacao`
--

LOCK TABLES `tipoacao` WRITE;
/*!40000 ALTER TABLE `tipoacao` DISABLE KEYS */;
INSERT INTO `tipoacao` VALUES (1,'Administração'),(2,'Stock'),(3,'Loja');
/*!40000 ALTER TABLE `tipoacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transportadora`
--

DROP TABLE IF EXISTS `transportadora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transportadora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transportadora`
--

LOCK TABLES `transportadora` WRITE;
/*!40000 ALTER TABLE `transportadora` DISABLE KEYS */;
INSERT INTO `transportadora` VALUES (1,'ctt'),(2,'CTTTT');
/*!40000 ALTER TABLE `transportadora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logged_in_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logged_in_at` timestamp NULL DEFAULT NULL,
  `created_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  `banned_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`email`),
  UNIQUE KEY `user_username` (`username`),
  KEY `user_role_id` (`role_id`),
  CONSTRAINT `user_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,1,'eduardo11224b@gmail.com','Admin','$2y$13$jcdy7ZW2SuaNvyt0kmDtYeeKj8JIiTTRquR0C02hbvXn7IDTIFnG6','4I8AtWe0spfF3vSq05930xYJEwwEtZE5','dC9VOjlGLSmsg6ZGkh7E0DJKz8G1K59O','::1','2022-04-22 19:31:39','::1','2022-03-31 01:38:51','2022-04-12 17:48:36',NULL,NULL),(5,4,1,'asgfas@gmail.com','Ace','$2y$13$Px6QzCU8MdjnIGur2T/1KebDH3zaIosioRQzJulTvXespxiOCdcMi','LlqvzkRQYFCYFWvY4htwtHAGMMxtl46P','vwMlJEPwShfD6V4bYUatGMrNaW5di03i',NULL,NULL,'::1','2022-03-31 10:38:40','2022-03-31 10:38:40',NULL,NULL),(6,4,1,'guxmusic1029@gmail.com','Ace2','$2y$13$fGHy0wkRaSM5QgAMYVc/Re5kLiBT6i6STwW1HNRmLH3DL.9gOy1rS','L4SCGrUls4UDuOWNSJNYvcIJkF7xjB_O','pVcFdj4JehPTss6kr_o9C1BdK2KU_90M','::1','2022-04-22 19:31:32','::1','2022-03-31 11:08:13','2022-03-31 11:08:13',NULL,NULL),(7,4,0,'guxace1029@gmail.com','ace222','$2y$13$u0o3WO9pOU5HS0y5XLNhR.DKKFbj2iAv.8YIRfyyLFOnjr/UkRURG','OHZcMLRE4LLX05s-i_zvlXcXCkFijUQY','Y4FmZeSy2oxog2MUKWVF57bHvVcfA15q',NULL,NULL,'::1','2022-04-22 16:40:13','2022-04-22 16:40:13',NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_auth`
--

DROP TABLE IF EXISTS `user_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_attributes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_auth_provider_id` (`provider_id`),
  KEY `user_auth_user_id` (`user_id`),
  CONSTRAINT `user_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_auth`
--

LOCK TABLES `user_auth` WRITE;
/*!40000 ALTER TABLE `user_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_token`
--

DROP TABLE IF EXISTS `user_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` smallint(6) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_token_token` (`token`),
  KEY `user_token_user_id` (`user_id`),
  CONSTRAINT `user_token_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_token`
--

LOCK TABLES `user_token` WRITE;
/*!40000 ALTER TABLE `user_token` DISABLE KEYS */;
INSERT INTO `user_token` VALUES (2,6,1,'h4Lk21njDr-2LatdW26pxEf0FzQag4fq',NULL,'2022-04-22 19:30:45',NULL),(4,7,1,'f4MWsfZJPTsXH3EcM_F_S6DDwwZbNatb',NULL,'2022-04-22 16:40:13',NULL);
/*!40000 ALTER TABLE `user_token` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-22 22:44:03
