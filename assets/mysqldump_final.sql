-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: gestorpedreira
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

create database gestorpedreira;
use gestorpedreira;

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
  `isDeleted` smallint(6) DEFAULT NULL,
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
INSERT INTO `codigodesconto` VALUES ('DSC_001','Primeiro Desconto.',NULL,1,NULL,NULL,NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prefixo_UNIQUE` (`prefixo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cor`
--

LOCK TABLES `cor` WRITE;
/*!40000 ALTER TABLE `cor` DISABLE KEYS */;
INSERT INTO `cor` VALUES (1,'Laranja','LRJ',NULL),(2,'Vermelho','VRM',NULL),(3,'Branco','BRC',NULL),(4,'Amarelo','AMR',NULL),(5,'Rosa','RSA',NULL),(6,'Ouro','OUR',NULL),(9,'Preto','PRT',NULL),(10,'Verde','VRD',NULL),(11,'Azul','AZL',NULL),(12,'Bege','BGE',NULL),(13,'Cinza','CNZ',NULL),(14,'Marrom','MRR',NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Pendente',NULL),(2,'Dados Confirmados',NULL),(3,'Stock Confirmado',NULL),(4,'Aguardar Pagamento',NULL),(5,'Pagamento Confirmado',NULL),(6,'Em Espera',NULL),(7,'Recolhas Agendadas',NULL),(8,'Recebido',NULL),(9,'Finalizado',NULL),(10,'Cancelado',NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Estado_Pedido_Pedido1_idx` (`idPedido`),
  KEY `fk_Estado_Pedido_Estado1` (`idEstado`),
  CONSTRAINT `fk_Estado_Pedido_Estado1` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Estado_Pedido_Pedido1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_pedido`
--

LOCK TABLES `estado_pedido` WRITE;
/*!40000 ALTER TABLE `estado_pedido` DISABLE KEYS */;
INSERT INTO `estado_pedido` VALUES (1,1,1,'2022-04-22 23:17:13',0,NULL),(2,1,2,'2022-04-22 23:17:25',0,NULL),(3,1,3,'2022-04-22 23:17:33',0,NULL),(4,1,4,'2022-04-22 23:17:43',0,NULL),(5,1,5,'2022-04-22 23:17:55',0,NULL),(6,1,6,'2022-04-22 23:18:06',1,NULL),(7,2,1,'2022-04-22 23:23:13',0,NULL),(8,2,2,'2022-04-22 23:23:22',0,NULL),(9,2,3,'2022-04-22 23:23:25',0,NULL),(10,2,4,'2022-04-22 23:23:31',0,NULL),(11,2,5,'2022-04-22 23:23:33',0,NULL),(12,3,2,'2022-04-22 23:23:41',0,NULL),(13,4,2,'2022-04-22 23:23:47',1,NULL),(14,3,5,'2022-04-22 23:23:50',0,NULL),(15,3,1,'2022-04-22 23:24:02',0,NULL),(16,3,3,'2022-04-22 23:24:04',0,NULL),(17,3,4,'2022-04-22 23:24:08',0,NULL),(18,4,5,'2022-04-22 23:24:11',0,NULL),(19,4,3,'2022-04-22 23:24:14',0,NULL),(20,4,1,'2022-04-22 23:24:16',0,NULL),(21,4,4,'2022-04-22 23:24:18',0,NULL),(22,5,3,'2022-04-22 23:24:20',0,NULL),(23,5,5,'2022-04-22 23:24:24',0,NULL),(24,6,3,'2022-04-22 23:24:30',0,NULL),(25,7,3,'2022-04-22 23:26:36',0,NULL),(26,5,4,'2022-04-22 23:26:41',1,NULL),(27,5,1,'2022-04-22 23:26:46',0,NULL),(28,6,5,'2022-04-22 23:27:13',0,NULL),(29,7,5,'2022-04-22 23:27:32',1,NULL),(30,6,1,'2022-04-22 23:27:47',0,NULL),(31,7,1,'2022-04-22 23:28:16',0,NULL),(32,8,3,'2022-04-22 23:31:48',1,NULL),(33,8,1,'2022-04-22 23:31:57',1,NULL),(34,1,7,'2022-04-29 18:24:49',1,NULL),(35,1,8,'2022-06-23 21:41:04',1,NULL),(36,1,9,'2022-06-23 21:47:49',1,NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotografia`
--

LOCK TABLES `fotografia` WRITE;
/*!40000 ALTER TABLE `fotografia` DISABLE KEYS */;
INSERT INTO `fotografia` VALUES (1,'profilePictures/genericUserProfilePicture.svg',NULL),(2,'profilePictures/CEO3.jpg',NULL),(3,'profilePictures/CEO2.jpg',NULL),(4,'profilePictures/CEO1.jpg',NULL),(5,'productPictures/granito laranja.jpg',NULL),(6,'productPictures/granito vermelho.jpg',NULL),(7,'productPictures/marmore amarelo.jpg',NULL),(8,'productPictures/pedra branca.jpg',NULL),(9,'lotes/GRN_LRJ_00001/1.jpg',NULL),(10,'lotes/GRN_LRJ_00002/1.jpg',NULL),(11,'lotes/GRN_VRM_00001/1.jpg',NULL),(12,'lotes/GRN_VRM_00002/1.jpg',NULL),(13,'lotes/GRN_VRM_00003/1.jpg',NULL),(14,'lotes/GRN_VRM_00004/1.jpg',NULL),(15,'lotes/MRM_AMR_00001/1.jpg',NULL),(16,'lotes/PDR_BRC_00001/1.jpg',NULL),(17,'lotes/PDR_BRC_00002/1.jpg',NULL),(18,'lotes/PDR_BRC_00003/1.jpg',NULL),(19,'profilePictures/ceo2.jpg',NULL),(20,'productPictures/granito-preto-favaco.jpg',NULL),(21,'productPictures/granito-verde-labrador.jpg',NULL),(22,'productPictures/ourobrasil.jpg',NULL),(23,'productPictures/blue-gold-marble-textured-background.jpg',NULL),(24,'productPictures/golden-white-marble-textured-design-resource.jpg',NULL),(25,'productPictures/golden-white-marble-textured-design-resource.jpg',NULL),(26,'productPictures/grungy-green-marble-textured.jpg',NULL),(27,'productPictures/grungy-green-marble-textured.jpg',NULL),(28,'productPictures/white-gray-marble-texture-background_38607-685.webp',NULL),(29,'productPictures/black-marble-patterned-texture-background-marble-thailand-abstract-natural-marble-black-white-design.jpg',NULL),(30,'productPictures/caja-pavimento-antideslizante-porcelanico-aneto-crema-40x60-4-pzascaja-097-m2caja-azuliber-800x800.jpeg',NULL),(31,'productPictures/caja-pavimento-antideslizante-porcelanico-beyret-antracita-30x60-6-pzascaja-108-m2caja-azuliber-800x800.jpeg',NULL),(32,'productPictures/caja-porcelanico-antideslizante-lahitte-antracita-40x60-4-pzascaja-097-m2caja-azuliber-800x800.jpeg',NULL),(33,'productPictures/caja-pavimento-antideslizante-porcelanico-gela-gris-40x60-4-pzascaja-097-m2caja-azuliber-800x800_xBb3abv.jpg',NULL),(34,'productPictures/caja-porcelanico-caramon-blanco-40x60-4-pzascaja-097-m2-azuliber-800x800.jpg',NULL),(35,'productPictures/Snow-T21-ASR.jpg',NULL),(36,'productPictures/Beige-SL2.jpg',NULL),(37,'productPictures/Via-Farini-EL4.jpg',NULL),(38,'productPictures/Grey-SL5.jpg',NULL);
/*!40000 ALTER TABLE `fotografia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotografia_lote`
--

DROP TABLE IF EXISTS `fotografia_lote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotografia_lote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigoLote` varchar(50) NOT NULL,
  `idFotografia` int(11) NOT NULL,
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Fotografia_Lote_Lote1_idx` (`codigoLote`),
  KEY `fk_Fotografia_Lote_Fotografia1_idx` (`idFotografia`),
  CONSTRAINT `fk_Fotografia_Lote_Fotografia1` FOREIGN KEY (`idFotografia`) REFERENCES `fotografia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fotografia_Lote_Lote1` FOREIGN KEY (`codigoLote`) REFERENCES `lote` (`codigo_lote`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotografia_lote`
--

LOCK TABLES `fotografia_lote` WRITE;
/*!40000 ALTER TABLE `fotografia_lote` DISABLE KEYS */;
INSERT INTO `fotografia_lote` VALUES (1,'GRN_LRJ_00001',9,NULL),(2,'GRN_LRJ_00002',10,NULL),(3,'GRN_VRM_00001',11,NULL),(4,'GRN_VRM_00002',12,NULL),(5,'GRN_VRM_00003',13,NULL),(6,'GRN_VRM_00004',14,NULL),(7,'MRM_AMR_00001',15,NULL),(8,'PDR_BRC_00001',16,NULL),(9,'PDR_BRC_00002',17,NULL),(10,'PDR_BRC_00003',18,NULL),(11,'GRN_LRJ_00001',10,NULL),(12,'GRN_LRJ_00001',11,NULL),(13,'GRN_LRJ_00001',22,NULL),(14,'GRN_LRJ_00001',36,NULL),(15,'GRN_LRJ_00001',22,NULL),(16,'GRN_LRJ_00002',22,NULL),(17,'GRN_LRJ_00002',36,NULL),(18,'GRN_LRJ_00002',11,NULL),(23,'GRN_VRM_00001',11,NULL),(24,'GRN_VRM_00001',36,NULL),(25,'GRN_VRM_00001',10,NULL),(26,'GRN_VRM_00001',30,NULL),(27,'GRN_VRM_00002',36,NULL),(28,'GRN_VRM_00002',11,NULL),(29,'GRN_VRM_00002',36,NULL),(30,'GRN_VRM_00002',10,NULL),(31,'GRN_VRM_00002',22,NULL),(32,'GRN_VRM_00002',30,NULL),(33,'GRN_VRM_00002',11,NULL),(34,'GRN_VRM_00003',10,NULL),(35,'GRN_VRM_00003',30,NULL),(36,'GRN_VRM_00003',22,NULL),(37,'GRN_VRM_00003',11,NULL),(38,'GRN_VRM_00003',10,NULL),(39,'GRN_VRM_00003',22,NULL),(40,'GRN_VRM_00004',9,NULL),(41,'GRN_VRM_00004',10,NULL),(42,'GRN_VRM_00004',11,NULL),(46,'MRM_AMR_00001',30,NULL),(47,'MRM_AMR_00001',31,NULL),(48,'MRM_AMR_00001',24,NULL),(49,'MRM_AMR_00001',26,NULL),(50,'MRM_AMR_00001',30,NULL),(51,'MRM_AMR_00001',31,NULL),(52,'MRM_AMR_00001',28,NULL),(53,'MRM_AMR_00001',29,NULL);
/*!40000 ALTER TABLE `fotografia_lote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotografia_produto`
--

DROP TABLE IF EXISTS `fotografia_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotografia_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProduto` int(11) NOT NULL,
  `idFotografia` int(11) NOT NULL,
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Fotografia_Produto_Produto1_idx` (`idProduto`),
  KEY `fk_Fotografia_Produto_Fotografia1_idx` (`idFotografia`),
  CONSTRAINT `fk_Fotografia_Produto_Fotografia1` FOREIGN KEY (`idFotografia`) REFERENCES `fotografia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fotografia_Produto_Produto1` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotografia_produto`
--

LOCK TABLES `fotografia_produto` WRITE;
/*!40000 ALTER TABLE `fotografia_produto` DISABLE KEYS */;
INSERT INTO `fotografia_produto` VALUES (1,2,5,NULL),(2,1,6,NULL),(3,3,7,NULL),(4,4,8,NULL),(5,5,20,NULL),(6,6,21,NULL),(7,7,22,NULL),(8,8,23,NULL),(9,9,24,NULL),(10,9,25,NULL),(11,10,26,NULL),(12,10,27,NULL),(13,11,28,NULL),(14,12,29,NULL),(15,13,30,NULL),(16,14,31,NULL),(17,16,32,NULL),(18,15,33,NULL),(19,17,34,NULL),(20,18,35,NULL),(21,19,36,NULL),(22,20,37,NULL),(23,21,38,NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localarmazem`
--

LOCK TABLES `localarmazem` WRITE;
/*!40000 ALTER TABLE `localarmazem` DISABLE KEYS */;
INSERT INTO `localarmazem` VALUES (1,'Areeiro da Serra',NULL),(2,'Cruzeiro',NULL),(3,'Mós',NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localextracao`
--

LOCK TABLES `localextracao` WRITE;
/*!40000 ALTER TABLE `localextracao` DISABLE KEYS */;
INSERT INTO `localextracao` VALUES (1,'Moleanos',153,200,NULL),(2,'Ataíja',100,102,NULL),(3,'Moca',129,129,NULL),(4,'Salgueira',80,205,NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Logs_TipoAcao1_idx` (`idTipoAcao`),
  KEY `fk_Logs_user1_idx` (`idUser`),
  CONSTRAINT `fk_Logs_TipoAcao1` FOREIGN KEY (`idTipoAcao`) REFERENCES `tipoacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Logs_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,1,2,'O local de armazém \'Areeiro da Serra\' foi criado.','2022-04-22 22:57:44',NULL),(2,1,2,'O local de armazém \'Cruzeiro\' foi criado.','2022-04-22 22:58:06',NULL),(3,1,2,'O local de armazém \'Mós\' foi criado.','2022-04-22 22:58:23',NULL),(4,1,2,'O local de extração \'Moleanos\' foi criado.','2022-04-22 22:58:37',NULL),(5,1,2,'O local de extração \'Ataíja\' foi criado.','2022-04-22 22:58:47',NULL),(6,1,2,'O local de extração \'Moca\' foi criado.','2022-04-22 22:58:56',NULL),(7,1,2,'O local de extração \'Salgueira\' foi criado.','2022-04-22 22:59:08',NULL),(8,6,3,'A transportadora \'Unipessoal\' foi adicionada.','2022-04-22 23:00:31',NULL),(9,6,3,'A transportadora \'Bragacoop\' foi adicionada.','2022-04-22 23:00:41',NULL),(10,6,3,'A transportadora \'Ctt\' foi adicionada.','2022-04-22 23:00:46',NULL),(11,6,3,'A transportadora \'Targa Transportes\' foi adicionada.','2022-04-22 23:00:58',NULL),(12,6,3,'A transportadora \'Gestra CZ\' foi adicionada.','2022-04-22 23:01:04',NULL),(13,5,2,'O material \'Granito\' foi criado.','2022-04-22 23:05:45',NULL),(14,5,2,'O material \'Pedra\' foi criado.','2022-04-22 23:05:52',NULL),(15,5,2,'A cor \'Laranja\' foi criada.','2022-04-22 23:06:13',NULL),(16,5,2,'A cor \'Vermelho\' foi criada.','2022-04-22 23:06:21',NULL),(17,5,2,'A cor \'Branco\' foi criada.','2022-04-22 23:06:38',NULL),(18,5,2,'A cor \'Amarelo\' foi criada.','2022-04-22 23:06:44',NULL),(19,5,2,'O material \'Marmore\' foi criado.','2022-04-22 23:07:33',NULL),(20,5,2,'O produto de ID #1 foi criado.','2022-04-22 23:08:25',NULL),(21,5,2,'O produto de ID #2 foi criado.','2022-04-22 23:08:36',NULL),(22,5,2,'O produto de ID #3 foi criado.','2022-04-22 23:08:45',NULL),(23,5,2,'O produto de ID #4 foi criado.','2022-04-22 23:08:54',NULL),(24,6,3,'O produto \'Granito Laranja\' foi adicionado à Loja.','2022-04-22 23:11:10',NULL),(25,6,3,'O produto \'Granito Vermelho\' foi adicionado à Loja.','2022-04-22 23:13:48',NULL),(26,6,3,'O produto \'Mármore Amarelo\' foi adicionado à Loja.','2022-04-22 23:14:19',NULL),(27,6,3,'O produto \'Pedra Branca\' foi adicionado à Loja.','2022-04-22 23:15:35',NULL),(28,5,2,'O lote GRN_LRJ_00001 foi adicionado.','2022-04-22 23:19:16',NULL),(29,5,2,'O lote GRN_LRJ_00002 foi adicionado.','2022-04-22 23:19:28',NULL),(30,5,2,'O lote GRN_VRM_00001 foi adicionado.','2022-04-22 23:19:40',NULL),(31,5,2,'O lote GRN_VRM_00002 foi adicionado.','2022-04-22 23:19:52',NULL),(32,5,2,'O lote GRN_VRM_00003 foi adicionado.','2022-04-22 23:20:04',NULL),(33,5,2,'O lote GRN_VRM_00004 foi adicionado.','2022-04-22 23:20:18',NULL),(34,5,2,'O lote MRM_AMR_00001 foi adicionado.','2022-04-22 23:20:35',NULL),(35,5,2,'O lote PDR_BRC_00001 foi adicionado.','2022-04-22 23:20:46',NULL),(36,5,2,'O lote PDR_BRC_00002 foi adicionado.','2022-04-22 23:20:57',NULL),(37,5,2,'O lote PDR_BRC_00003 foi adicionado.','2022-04-22 23:21:18',NULL),(38,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:23:13',NULL),(39,6,3,'O estado da encomenda #2 foi atualizada.','2022-04-22 23:23:22',NULL),(40,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:23:25',NULL),(41,6,3,'O estado da encomenda #4 foi atualizada.','2022-04-22 23:23:31',NULL),(42,6,3,'O estado da encomenda #5 foi atualizada.','2022-04-22 23:23:33',NULL),(43,6,3,'O estado da encomenda #2 foi atualizada.','2022-04-22 23:23:41',NULL),(44,6,3,'O estado da encomenda #2 foi atualizada.','2022-04-22 23:23:47',NULL),(45,6,3,'O estado da encomenda #5 foi atualizada.','2022-04-22 23:23:50',NULL),(46,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:24:02',NULL),(47,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:24:04',NULL),(48,6,3,'O estado da encomenda #4 foi atualizada.','2022-04-22 23:24:08',NULL),(49,6,3,'O estado da encomenda #5 foi atualizada.','2022-04-22 23:24:11',NULL),(50,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:24:14',NULL),(51,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:24:16',NULL),(52,6,3,'O estado da encomenda #4 foi atualizada.','2022-04-22 23:24:18',NULL),(53,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:24:20',NULL),(54,6,3,'O estado da encomenda #5 foi atualizada.','2022-04-22 23:24:24',NULL),(55,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:24:30',NULL),(56,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:26:36',NULL),(57,6,3,'O estado da encomenda #4 foi atualizada.','2022-04-22 23:26:41',NULL),(58,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:26:46',NULL),(59,6,3,'O estado da encomenda #5 foi atualizada.','2022-04-22 23:27:13',NULL),(60,6,3,'O estado da encomenda #5 foi atualizada.','2022-04-22 23:27:32',NULL),(61,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:27:47',NULL),(62,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:28:16',NULL),(63,5,2,'Foi confirmada a recolha de ID #1, do lote MRM_AMR_00001.','2022-04-22 23:30:55',NULL),(64,5,2,'Foi confirmada a recolha de ID #4, do lote PDR_BRC_00002.','2022-04-22 23:31:25',NULL),(65,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:31:48',NULL),(66,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:31:57',NULL),(67,1,2,'A cor \'Rosa\' foi criada.','2023-01-29 20:11:12',NULL),(68,1,2,'A cor \'OURO\' foi criada.','2023-01-29 20:11:28',NULL),(69,1,2,'A cor \'Preto\' foi criada.','2023-01-29 20:15:26',NULL),(70,1,2,'A cor \'Verde\' foi criada.','2023-01-29 20:15:37',NULL),(71,1,2,'A cor \'Azul\' foi criada.','2023-01-29 20:16:14',NULL),(72,1,2,'O material \'Porcelana\' foi criado.','2023-01-29 20:16:42',NULL),(73,1,2,'O material \'Ceramica\' foi criado.','2023-01-29 20:17:00',NULL),(74,1,2,'O produto de ID #5 foi criado.','2023-01-29 20:18:42',NULL),(75,1,2,'O produto de ID #6 foi criado.','2023-01-29 20:19:12',NULL),(76,1,2,'O produto de ID #7 foi criado.','2023-01-29 20:19:42',NULL),(77,1,3,'O produto \'Granito Preto\' foi adicionado à Loja.','2023-01-29 20:20:42',NULL),(78,1,3,'O produto \'Granito Verde\' foi adicionado à Loja.','2023-01-29 20:21:25',NULL),(79,1,3,'O produto \'Granito Ouro\' foi adicionado à Loja.','2023-01-29 20:22:42',NULL),(80,1,2,'O produto de ID #8 foi criado.','2023-01-29 20:23:23',NULL),(81,1,2,'O produto de ID #9 foi criado.','2023-01-29 20:23:47',NULL),(82,1,2,'O produto de ID #10 foi criado.','2023-01-29 20:24:18',NULL),(83,1,2,'O produto de ID #11 foi criado.','2023-01-29 20:24:45',NULL),(84,1,2,'O produto de ID #12 foi criado.','2023-01-29 20:25:04',NULL),(85,1,3,'O produto \'Mármore Azul\' foi adicionado à Loja.','2023-01-29 20:31:55',NULL),(86,1,3,'O produto \'Mármore Rosa\' foi adicionado à Loja.','2023-01-29 20:33:26',NULL),(87,1,3,'O produto \'Mármore Rosa\' foi adicionado à Loja.','2023-01-29 20:33:34',NULL),(88,1,3,'O produto \'Mármore Verde\' foi adicionado à Loja.','2023-01-29 20:34:18',NULL),(89,1,3,'O produto \'Mármore Verde\' foi adicionado à Loja.','2023-01-29 20:34:25',NULL),(90,1,3,'O produto \'Mármore Branco\' foi adicionado à Loja.','2023-01-29 20:36:46',NULL),(91,1,3,'O produto \'Mármore Preto\' foi adicionado à Loja.','2023-01-29 20:37:47',NULL),(92,1,2,'A cor \'Bege\' foi criada.','2023-01-29 20:39:26',NULL),(93,1,2,'O produto de ID #13 foi criado.','2023-01-29 20:39:58',NULL),(94,1,2,'O produto de ID #14 foi criado.','2023-01-29 20:40:35',NULL),(95,1,2,'O produto de ID #15 foi criado.','2023-01-29 20:41:03',NULL),(96,1,2,'A cor \'Cinza\' foi criada.','2023-01-29 20:41:34',NULL),(97,1,2,'O produto de ID #16 foi criado.','2023-01-29 20:42:03',NULL),(98,1,2,'O produto de ID #17 foi criado.','2023-01-29 20:42:25',NULL),(99,1,3,'O produto \'Porcelana Bege\' foi adicionado à Loja.','2023-01-29 20:43:16',NULL),(100,1,3,'O produto \'Porcelana Preta\' foi adicionado à Loja.','2023-01-29 20:43:56',NULL),(101,1,3,'O produto \'Porcelana Cinza\' foi adicionado à Loja.','2023-01-29 20:44:35',NULL),(102,1,3,'O produto \'Porcelana Verde\' foi adicionado à Loja.','2023-01-29 20:45:19',NULL),(103,1,3,'O produto \'Porcelana Branca\' foi adicionado à Loja.','2023-01-29 20:46:04',NULL),(104,1,2,'O produto de ID #18 foi criado.','2023-01-29 20:49:06',NULL),(105,1,2,'O produto de ID #19 foi criado.','2023-01-29 20:49:37',NULL),(106,1,2,'A cor \'Marrom\' foi criada.','2023-01-29 20:50:02',NULL),(107,1,2,'O produto de ID #20 foi criado.','2023-01-29 20:50:25',NULL),(108,1,2,'O produto de ID #21 foi criado.','2023-01-29 20:50:50',NULL),(109,1,3,'O produto \'Cerâmica Branca\' foi adicionado à Loja.','2023-01-29 20:52:22',NULL),(110,1,3,'O produto \'Cerâmica Bege\' foi adicionado à Loja.','2023-01-29 21:01:23',NULL),(111,1,3,'O produto \'Cerâmica Marrom\' foi adicionado à Loja.','2023-01-29 21:03:26',NULL),(112,1,3,'O produto \'Cerâmica Cinza\' foi adicionado à Loja.','2023-01-29 21:04:51',NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
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
INSERT INTO `lote` VALUES ('GRN_LRJ_00001',1,475,3,1,'2022-04-22 23:19:01',NULL),('GRN_LRJ_00002',1,475,1,2,'2022-04-22 23:19:17',NULL),('GRN_VRM_00001',2,500,2,1,'2022-04-22 23:19:31',NULL),('GRN_VRM_00002',2,500,1,1,'2022-04-22 23:19:42',NULL),('GRN_VRM_00003',2,500,2,1,'2022-04-22 23:19:54',NULL),('GRN_VRM_00004',2,500,1,1,'2022-04-22 23:20:06',NULL),('MRM_AMR_00001',3,450,4,3,'2022-04-22 23:20:22',NULL),('PDR_BRC_00001',4,500,4,3,'2022-04-22 23:20:37',NULL),('PDR_BRC_00002',4,450,3,3,'2022-04-22 23:20:47',NULL),('PDR_BRC_00003',4,500,4,2,'2022-04-22 23:21:02',NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prefixo_UNIQUE` (`prefixo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
INSERT INTO `material` VALUES (1,'Granito','GRN',NULL),(2,'Pedra','PDR',NULL),(3,'Marmore','MRM',NULL),(4,'Porcelana','PRC',NULL),(5,'Ceramica','CRM',NULL);
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
INSERT INTO `migration` VALUES ('m221109_191112_add_isDeleted_column_to_codigodesconto_table',1675021402),('m221109_191112_add_isDeleted_column_to_cor_table',1675021402),('m221109_191112_add_isDeleted_column_to_estado_pedido_table',1675021402),('m221109_191112_add_isDeleted_column_to_estado_table',1675021402),('m221109_191112_add_isDeleted_column_to_fotografia_lote_table',1675021402),('m221109_191112_add_isDeleted_column_to_fotografia_produto_table',1675021402),('m221109_191112_add_isDeleted_column_to_fotografia_table',1675021402),('m221109_191113_add_isDeleted_column_to_localarmazem_table',1675021402),('m221109_191113_add_isDeleted_column_to_localextracao_table',1675021402),('m221109_191113_add_isDeleted_column_to_logs_table',1675021402),('m221109_191113_add_isDeleted_column_to_lote_table',1675021402),('m221109_191113_add_isDeleted_column_to_material_table',1675021402),('m221109_191113_add_isDeleted_column_to_pedido_lote_table',1675021402),('m221109_191113_add_isDeleted_column_to_pedido_table',1675021402),('m221109_191113_add_isDeleted_column_to_produto_table',1675021402),('m221109_191113_add_isDeleted_column_to_profile_table',1675021402),('m221109_191113_add_isDeleted_column_to_role_table',1675021402),('m221109_191113_add_isDeleted_column_to_tipoacao_table',1675021402),('m221109_191114_add_isDeleted_column_to_transportadora_table',1675021402),('m221109_191114_add_isDeleted_column_to_user_table',1675021402),('m221109_191730_insert_value_to_codigoDesconto_table',1675021402);
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
  `mensagem` varchar(150) DEFAULT NULL,
  `dataHoraPedido` datetime NOT NULL,
  `precoFinal` varchar(45) DEFAULT NULL,
  `isDeleted` smallint(6) DEFAULT NULL,
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
INSERT INTO `pedido` VALUES (1,7,4,NULL,NULL,50,NULL,'2022-04-22 23:17:13',NULL,NULL),(2,7,3,NULL,NULL,50,NULL,'2022-04-22 23:17:25',NULL,NULL),(3,7,3,NULL,NULL,25,NULL,'2022-04-22 23:17:33',NULL,NULL),(4,7,2,NULL,NULL,50,NULL,'2022-04-22 23:17:43',NULL,NULL),(5,7,1,NULL,NULL,50,NULL,'2022-04-22 23:17:55',NULL,NULL),(6,7,1,NULL,NULL,50,NULL,'2022-04-22 23:18:06',NULL,NULL),(7,1,4,NULL,NULL,NULL,'Teste','2022-04-29 18:24:49',NULL,NULL),(8,8,4,NULL,NULL,15,'Olá!','2022-06-23 21:41:04',NULL,NULL),(9,8,4,NULL,NULL,1,'Olá!','2022-06-23 21:47:49',NULL,NULL);
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
  `dataHoraAgendamento` datetime DEFAULT NULL,
  `matricula_Veiculo_recolha` varchar(30) DEFAULT NULL,
  `dataHoraRecolha` datetime DEFAULT NULL,
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_QuantidadeStockReservado_Lote1_idx` (`codigoLote`),
  KEY `fk_Pedido_Lote_Transportadora1_idx` (`idTransportadora`),
  KEY `fk_QuantidadeStockReservado_Pedido` (`idPedido`),
  CONSTRAINT `fk_Pedido_Lote_Transportadora1` FOREIGN KEY (`idTransportadora`) REFERENCES `transportadora` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_QuantidadeStockReservado_Lote1` FOREIGN KEY (`codigoLote`) REFERENCES `lote` (`codigo_lote`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_QuantidadeStockReservado_Pedido` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_lote`
--

LOCK TABLES `pedido_lote` WRITE;
/*!40000 ALTER TABLE `pedido_lote` DISABLE KEYS */;
INSERT INTO `pedido_lote` VALUES (1,3,'MRM_AMR_00001',NULL,25,1,NULL,'ABC-123','2022-04-22 23:30:55',NULL),(2,5,'GRN_LRJ_00001',NULL,25,3,NULL,NULL,NULL,NULL),(3,5,'GRN_LRJ_00002',NULL,25,2,NULL,NULL,NULL,NULL),(4,1,'PDR_BRC_00002',NULL,50,3,NULL,'ABC-143','2022-04-22 23:31:25',NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Produto_Material1_idx` (`idMaterial`),
  KEY `fk_Produto_Cor1_idx` (`idCor`),
  KEY `fk_Produto_Fotografia_idx` (`idFotografia`),
  CONSTRAINT `fk_Produto_Cor1` FOREIGN KEY (`idCor`) REFERENCES `cor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produto_Fotografia1` FOREIGN KEY (`idFotografia`) REFERENCES `fotografia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produto_Material1` FOREIGN KEY (`idMaterial`) REFERENCES `material` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (1,1,1,5,6,2,6,3,'Granito Laranja','Fino e sofisticado!',5,1,NULL),(2,1,2,6,8,3,5,9,'Granito Vermelho','O granito vermelho é muito resistente a riscos, pois foi desenvolvido com o objetivo de ser utilizado em bancadas de cozinhas, portanto fique tranquilo quanto ao seu uso. É Resistente a manchas como vinho, café, açaí, azeite, óleos e produtos que contém corantes em geral.',6,1,NULL),(3,3,4,7,3,2,3,2,'Mármore Amarelo','Simples, elegante!',3,1,NULL),(4,2,3,8,1,3,2,1,'Pedra Branca','Pode ser utilizado em superfícies de ambientes internos como: cozinhas, banheiros, lavabos, áreas de serviços, pisos, escadas, mesas e muito mais. Para limpeza do material, nós recomendamos que se use um pano com detergente neutro ou esponja scott brite com sapólio em pó.',5,1,NULL),(5,1,9,20,1284,13,2610,1,'Granito Preto','É o granito mais conhecido da Galiza e um dos mais conceituados do mundo proveniente da vila espanhola de “Porrino”, uma pedreira que é explorada numa montanha.',90,1,NULL),(6,1,10,21,934,10,2780,0.3,'Granito Verde','Rocha ígnea de tonalidade verde escura, com granulado fino a médio, horneblêndica e biotítica.',190,1,NULL),(7,1,6,22,1123,14,2678,2,'Granito Ouro','Rocha granítica de cor amarelada, com granulado médio, duas micas e alteração moderada.',70,1,NULL),(8,3,11,23,1023,9,2533,1,'Mármore Azul','A beleza e o requinte da pedra natural são fonte de inspiração de novas tendências de revestimento e pavimentação, com decorações modernas e minimalistas. Mármore Azul é um dos mármores mais conhecidos. Uma superfície natural deslumbrante, adequada para uma variedade de aplicações internas como pavimentos, revestimentos de paredes, casas de banho.',170,1,NULL),(9,3,5,25,1010,11,1456,0.4,'Mármore Rosa','É rosado, de tamanho médio, fratura compacta e irregular. O granito Porrinho é um granito rosa com um grão de médio a grosso de fundo predominantemente uniforme. Apresenta grandes áreas cor-de-rosa com dimensões consideráveis, como também apresenta pequenas áreas de cor acastanhada, porções brancas e também pretas. Admite qualquer tipo de acabamento superficial, sem alterações ou perda de polimento.',210,1,NULL),(10,3,10,27,1284,10,2533,2,'Mármore Verde','Verde Guatemala é um dos mármores verdes mais conhecidos e pode variar de cor azul-esverdeada até verde-escura. Uma superfície natural deslumbrante, adequada para uma variedade de aplicações internas como pavimentos, revestimentos de paredes, casas de banho.',190,1,NULL),(11,3,3,28,1044,11,2678,0.4,'Mármore Branco','Pureza e luminosidade são os dois valores intrínsecos que fazem do Branco Ibiza um mármore a ser seriamente considerado na arquitetura e decoração. Podemos encontrar branco Ibiza em diferentes tonalidades. O aparecimento de riscas cinzentas e, por vezes, castanhas confere à pedra natural a sua singularidade. Branco é sinónimo de modernidade e clareza.  ',130,1,NULL),(12,3,9,29,1023,9,2780,0.4,'Mármore Preto','O Sahara Noir é um Mármore preto escuro com veios brancos de diferentes tamanhos e comprimentos. É um mármore frágil que deve ser reforçado com malha traseira e resina transparente. A superfície pode apresentar alguns pequenos orifícios e fissuras que não são imperfeições ou defeitos de polimento, mas características naturais inerentes ao material.',120,1,NULL),(13,4,12,30,900,8,1567,1,'Porcelana Bege','Nova coleção de porcelanas para terraços. Este pavimento antiderrapante apresenta ligeiros tons de cores e desenhos entre as suas peças que o tornam um pavimento limpo ideal para áreas exteriores. O beta que encontramos em muitas de suas peças o torna uma elegante imitação de pedra.',80,1,NULL),(14,4,9,31,1123,14,1567,0.3,'Porcelana Preta','Elegância e resistência. O modelo Beyret é um dos produtos de maior sucesso desde que a Azuliber o apresentou em seu catálogo de novidades de 2018. É um porcelanato que possui todas as características que se podem exigir de um piso externo. Resistência, estilo, qualidade e design. Este modelo de porcelanato tem um aspecto entre a pedra e a ardósia, o que muitos de nós procuramos para o pavimento do terraço, um pavimento bonito e sofrido.',80,1,NULL),(15,4,10,33,1123,11,1989,3,'Porcelana Verde','Efeito pedra, textura macia e acabamento antiderrapante. A Azuliber possui um dos mais amplos catálogos de pisos de porcelana. É uma fábrica que combina uma qualidade muito boa, um design muito comercial e serviço rápido. Na Azulejos Solá, somos colaboradores diretos da fábrica. Nós armazenamos a maioria das coleções de solo. Temos os melhores preços e atendemos o material no local com a maior agilidade possível. Compre on-line pisos de terraço Azuliber.',20,1,NULL),(16,4,13,32,1178,13,2780,3,'Porcelana Cinza','Você está procurando um piso no terraço? A porcelana com efeito de pedra é um dos estilos de piso mais escolhidos. A verdade é que esses modelos têm um design elegante, mas ao mesmo tempo são muito sofridos. Eles se vestem muito fora de casa, no terraço ou na piscina.',100,1,NULL),(17,4,3,34,1044,9,2610,1,'Porcelana Branca','Ladrilhos de porcelana com efeito de pedra para terraços externos, varandas e piscinas. TEXTURA COM ALÍVIO MACIO E DESIGN CONTEMPORÂNEO',39,1,NULL),(18,5,3,35,1090,13,1456,0.3,'Cerâmica Branca','O uso de cerâmicas está cada vez mais em voga. Por serem extremamente duráveis ao calor e à sua tonalidade, estão rapidamente a tornar-se numa escolha favorável para projetos de design residencial e comercial. Por ser um material muito versátil, permite usar em bancadas de cozinhas, wc ’s, revestimentos, pavimentos, etc.',60,1,NULL),(19,5,12,36,1010,10,1246,4,'Cerâmica Bege','O Piso cerâmico com a cor beige de fundo e os veios mais escuro da Viva Cerâmica é a escolha certa que harmoniza com os mais diversificados ambientes.',40,1,NULL),(20,5,14,37,1324,8,1567,2,'Cerâmica Marrom','Pavimento cerâmico técnico matte.',39,1,NULL),(21,5,13,38,1044,10,1567,0.4,'Cerâmica Cinza','Para um acabamento perfeito, complementar este pavimento com mosaico e azulejos decorativos a condizer.',45,1,NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Utilizador_Fotografia1_idx` (`idFotografia`),
  KEY `fk_dadosPessoais_user1_idx` (`user_id`),
  CONSTRAINT `fk_Utilizador_Fotografia1` FOREIGN KEY (`idFotografia`) REFERENCES `fotografia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_dadosPessoais_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,1,4,'admin@gmail.com','Miguel Rocha',0,'1990-01-01','962075694','Rua de Bragança','Bragança','5300-116',NULL,NULL,'2022-03-31 01:38:51','2022-03-31 01:38:51',NULL,NULL),(3,5,2,'operario@gmail.com','Joaquim',0,'1985-03-05',NULL,'Rua de Lisbo','Lisboa','5400-000',NULL,NULL,'2022-04-22 20:48:10','2022-04-22 20:48:10',NULL,NULL),(4,6,3,'gestor@gmail.com','Ribeiro Cruz',0,'1992-09-11',NULL,'Rua de Coimbra','Coimbra','5200-000',NULL,NULL,'2022-04-22 20:48:25','2022-04-22 20:48:25',NULL,NULL),(5,7,1,'cliente@gmail.com','João',0,'1990-05-11',NULL,'Rua do Porto','Porto','5000-000',NULL,NULL,'2022-04-22 20:48:38','2022-04-22 20:48:38',NULL,NULL),(6,8,19,'eduardo11224b@gmail.com','Eduardo Botelho',0,'2001-01-11','962075694','Bragança',NULL,'5300-116',NULL,NULL,'2022-06-23 20:06:29','2022-06-23 20:06:29',NULL,NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Administrador',NULL,NULL,1,1,1,NULL),(2,'Gestor',NULL,NULL,0,1,1,NULL),(3,'Operário',NULL,NULL,0,0,1,NULL),(4,'Cliente',NULL,NULL,0,0,0,NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoacao`
--

LOCK TABLES `tipoacao` WRITE;
/*!40000 ALTER TABLE `tipoacao` DISABLE KEYS */;
INSERT INTO `tipoacao` VALUES (1,'Administração',NULL),(2,'Stock',NULL),(3,'Loja',NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transportadora`
--

LOCK TABLES `transportadora` WRITE;
/*!40000 ALTER TABLE `transportadora` DISABLE KEYS */;
INSERT INTO `transportadora` VALUES (1,'Unipessoal',NULL),(2,'Bragacoop',NULL),(3,'Ctt',NULL),(4,'Targa Transportes',NULL),(5,'Gestra CZ',NULL);
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
  `isDeleted` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`email`),
  UNIQUE KEY `user_username` (`username`),
  KEY `user_role_id` (`role_id`),
  CONSTRAINT `user_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,1,'admin@gmail.com','Admin','$2y$13$n7YDsOW1BdPhOvVPYxpj0eqakCjMm3aVEIE1Y2IEGRRKxYU2N13Lq','4I8AtWe0spfF3vSq05930xYJEwwEtZE5','dC9VOjlGLSmsg6ZGkh7E0DJKz8G1K59O','192.168.1.64','2023-02-03 03:29:06','::1','2022-03-31 01:38:51','2022-03-31 01:38:51',NULL,NULL,NULL),(5,3,1,'operario@gmail.com','operario','$2y$13$0LzjsLhzINVYvLODv8Mvw.kMzyc7rksJTay7SzT3Iwsy4F9c6dvee','KVrlIjLkuOZWa84p15thU07RGJuLdKSs','0TOj4arsH5qNHnpTD7QIKHbvFeubmAaE','::1','2022-04-22 21:28:32','::1','2022-04-22 20:48:10','2022-04-22 20:48:10',NULL,NULL,NULL),(6,2,1,'gestor@gmail.com','gestor','$2y$13$6G0h6wBIYMsRNGhKtjqoRudUGta9Yqk6GZOCp.yrC9DBsXnPK62y2','li5sXlrc7xAKs_IkN7e6ddo6fAgTBaKc','HQjgSMdHtf4L7-F58qnpdKMsp46x5d72','::1','2022-06-23 19:50:08','::1','2022-04-22 20:48:25','2022-04-22 20:48:25',NULL,NULL,NULL),(7,4,1,'cliente@gmail.com','cliente','$2y$13$yxFrT6gMlbWvQ9.Vs6bMhO4foJ06AgBQPrA64fRfi.iR4nDGyz/Ae','Y7Fcqv6qBOYXYOk3JJtFAM1ZpUI5O6lS','IuuoT09TD7qMOR4So7vRc8ubELpYvEwE','::1','2022-04-22 21:16:18','::1','2022-04-22 20:48:38','2022-04-22 20:48:38',NULL,NULL,NULL),(8,4,1,'eduardo11224b@gmail.com','Eduardo','$2y$13$K.it6PNLMaGMz0MouUUK4u3BNvOe1Zg3hcYpsic9Roeu4wStHD7gm','mj6Z-FfVkndj2eykk6EOQ-zLou1nexHZ','Q18tinY_M1VT-G4Nm58euI7ENUZOON88','::1','2022-06-23 19:47:51','::1','2022-06-23 19:06:25','2022-06-23 19:06:25',NULL,NULL,NULL);
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
INSERT INTO `user_token` VALUES (1,5,1,'a7UME6NHnEoCkGdkMIsMswxoqVkRUInx',NULL,'2022-04-22 20:48:10',NULL),(2,6,1,'fIoHdjDqWeGtdtvXmZiABPDVDGQ_XZyH',NULL,'2022-04-22 20:48:25',NULL),(3,7,1,'mkRAJrhAsAnZzDHnbFhwjxHD0VjIO6Pi',NULL,'2022-04-22 20:48:38',NULL);
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

-- Dump completed on 2023-02-03  3:31:26
