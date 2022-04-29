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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cor`
--

LOCK TABLES `cor` WRITE;
/*!40000 ALTER TABLE `cor` DISABLE KEYS */;
INSERT INTO `cor` VALUES (1,'Laranja','LRJ'),(2,'Vermelho','VRM'),(3,'Branco','BRC'),(4,'Amarelo','AMR');
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_pedido`
--

LOCK TABLES `estado_pedido` WRITE;
/*!40000 ALTER TABLE `estado_pedido` DISABLE KEYS */;
INSERT INTO `estado_pedido` VALUES (1,1,1,'2022-04-22 23:17:13',0),(2,1,2,'2022-04-22 23:17:25',0),(3,1,3,'2022-04-22 23:17:33',0),(4,1,4,'2022-04-22 23:17:43',0),(5,1,5,'2022-04-22 23:17:55',0),(6,1,6,'2022-04-22 23:18:06',1),(7,2,1,'2022-04-22 23:23:13',0),(8,2,2,'2022-04-22 23:23:22',0),(9,2,3,'2022-04-22 23:23:25',0),(10,2,4,'2022-04-22 23:23:31',0),(11,2,5,'2022-04-22 23:23:33',0),(12,3,2,'2022-04-22 23:23:41',0),(13,4,2,'2022-04-22 23:23:47',1),(14,3,5,'2022-04-22 23:23:50',0),(15,3,1,'2022-04-22 23:24:02',0),(16,3,3,'2022-04-22 23:24:04',0),(17,3,4,'2022-04-22 23:24:08',0),(18,4,5,'2022-04-22 23:24:11',0),(19,4,3,'2022-04-22 23:24:14',0),(20,4,1,'2022-04-22 23:24:16',0),(21,4,4,'2022-04-22 23:24:18',0),(22,5,3,'2022-04-22 23:24:20',0),(23,5,5,'2022-04-22 23:24:24',0),(24,6,3,'2022-04-22 23:24:30',0),(25,7,3,'2022-04-22 23:26:36',0),(26,5,4,'2022-04-22 23:26:41',1),(27,5,1,'2022-04-22 23:26:46',0),(28,6,5,'2022-04-22 23:27:13',0),(29,7,5,'2022-04-22 23:27:32',1),(30,6,1,'2022-04-22 23:27:47',0),(31,7,1,'2022-04-22 23:28:16',0),(32,8,3,'2022-04-22 23:31:48',1),(33,8,1,'2022-04-22 23:31:57',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotografia`
--

LOCK TABLES `fotografia` WRITE;
/*!40000 ALTER TABLE `fotografia` DISABLE KEYS */;
INSERT INTO `fotografia` VALUES (1,'profilePictures/genericUserProfilePicture.svg'),(2,'profilePictures/CEO3.jpg'),(3,'profilePictures/CEO2.jpg'),(4,'profilePictures/CEO1.jpg'),(5,'productPictures/granito laranja.jpg'),(6,'productPictures/granito vermelho.jpg'),(7,'productPictures/marmore amarelo.jpg'),(8,'productPictures/pedra branca.jpg'),(9,'lotes/GRN_LRJ_00001/1.jpg'),(10,'lotes/GRN_LRJ_00002/1.jpg'),(11,'lotes/GRN_VRM_00001/1.jpg'),(12,'lotes/GRN_VRM_00002/1.jpg'),(13,'lotes/GRN_VRM_00003/1.jpg'),(14,'lotes/GRN_VRM_00004/1.jpg'),(15,'lotes/MRM_AMR_00001/1.jpg'),(16,'lotes/PDR_BRC_00001/1.jpg'),(17,'lotes/PDR_BRC_00002/1.jpg'),(18,'lotes/PDR_BRC_00003/1.jpg');
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
  PRIMARY KEY (`id`),
  KEY `fk_Fotografia_Lote_Lote1_idx` (`codigoLote`),
  KEY `fk_Fotografia_Lote_Fotografia1_idx` (`idFotografia`),
  CONSTRAINT `fk_Fotografia_Lote_Fotografia1` FOREIGN KEY (`idFotografia`) REFERENCES `fotografia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fotografia_Lote_Lote1` FOREIGN KEY (`codigoLote`) REFERENCES `lote` (`codigo_lote`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotografia_lote`
--

LOCK TABLES `fotografia_lote` WRITE;
/*!40000 ALTER TABLE `fotografia_lote` DISABLE KEYS */;
INSERT INTO `fotografia_lote` VALUES (1,'GRN_LRJ_00001',9),(2,'GRN_LRJ_00002',10),(3,'GRN_VRM_00001',11),(4,'GRN_VRM_00002',12),(5,'GRN_VRM_00003',13),(6,'GRN_VRM_00004',14),(7,'MRM_AMR_00001',15),(8,'PDR_BRC_00001',16),(9,'PDR_BRC_00002',17),(10,'PDR_BRC_00003',18);
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
  PRIMARY KEY (`id`),
  KEY `fk_Fotografia_Produto_Produto1_idx` (`idProduto`),
  KEY `fk_Fotografia_Produto_Fotografia1_idx` (`idFotografia`),
  CONSTRAINT `fk_Fotografia_Produto_Fotografia1` FOREIGN KEY (`idFotografia`) REFERENCES `fotografia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fotografia_Produto_Produto1` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotografia_produto`
--

LOCK TABLES `fotografia_produto` WRITE;
/*!40000 ALTER TABLE `fotografia_produto` DISABLE KEYS */;
INSERT INTO `fotografia_produto` VALUES (1,2,5),(2,1,6),(3,3,7),(4,4,8);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localarmazem`
--

LOCK TABLES `localarmazem` WRITE;
/*!40000 ALTER TABLE `localarmazem` DISABLE KEYS */;
INSERT INTO `localarmazem` VALUES (1,'Areeiro da Serra'),(2,'Cruzeiro'),(3,'Mós');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localextracao`
--

LOCK TABLES `localextracao` WRITE;
/*!40000 ALTER TABLE `localextracao` DISABLE KEYS */;
INSERT INTO `localextracao` VALUES (1,'Moleanos',153,200),(2,'Ataíja',100,102),(3,'Moca',129,129),(4,'Salgueira',80,205);
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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,1,2,'O local de armazém \'Areeiro da Serra\' foi criado.','2022-04-22 22:57:44'),(2,1,2,'O local de armazém \'Cruzeiro\' foi criado.','2022-04-22 22:58:06'),(3,1,2,'O local de armazém \'Mós\' foi criado.','2022-04-22 22:58:23'),(4,1,2,'O local de extração \'Moleanos\' foi criado.','2022-04-22 22:58:37'),(5,1,2,'O local de extração \'Ataíja\' foi criado.','2022-04-22 22:58:47'),(6,1,2,'O local de extração \'Moca\' foi criado.','2022-04-22 22:58:56'),(7,1,2,'O local de extração \'Salgueira\' foi criado.','2022-04-22 22:59:08'),(8,6,3,'A transportadora \'Unipessoal\' foi adicionada.','2022-04-22 23:00:31'),(9,6,3,'A transportadora \'Bragacoop\' foi adicionada.','2022-04-22 23:00:41'),(10,6,3,'A transportadora \'Ctt\' foi adicionada.','2022-04-22 23:00:46'),(11,6,3,'A transportadora \'Targa Transportes\' foi adicionada.','2022-04-22 23:00:58'),(12,6,3,'A transportadora \'Gestra CZ\' foi adicionada.','2022-04-22 23:01:04'),(13,5,2,'O material \'Granito\' foi criado.','2022-04-22 23:05:45'),(14,5,2,'O material \'Pedra\' foi criado.','2022-04-22 23:05:52'),(15,5,2,'A cor \'Laranja\' foi criada.','2022-04-22 23:06:13'),(16,5,2,'A cor \'Vermelho\' foi criada.','2022-04-22 23:06:21'),(17,5,2,'A cor \'Branco\' foi criada.','2022-04-22 23:06:38'),(18,5,2,'A cor \'Amarelo\' foi criada.','2022-04-22 23:06:44'),(19,5,2,'O material \'Marmore\' foi criado.','2022-04-22 23:07:33'),(20,5,2,'O produto de ID #1 foi criado.','2022-04-22 23:08:25'),(21,5,2,'O produto de ID #2 foi criado.','2022-04-22 23:08:36'),(22,5,2,'O produto de ID #3 foi criado.','2022-04-22 23:08:45'),(23,5,2,'O produto de ID #4 foi criado.','2022-04-22 23:08:54'),(24,6,3,'O produto \'Granito Laranja\' foi adicionado à Loja.','2022-04-22 23:11:10'),(25,6,3,'O produto \'Granito Vermelho\' foi adicionado à Loja.','2022-04-22 23:13:48'),(26,6,3,'O produto \'Mármore Amarelo\' foi adicionado à Loja.','2022-04-22 23:14:19'),(27,6,3,'O produto \'Pedra Branca\' foi adicionado à Loja.','2022-04-22 23:15:35'),(28,5,2,'O lote GRN_LRJ_00001 foi adicionado.','2022-04-22 23:19:16'),(29,5,2,'O lote GRN_LRJ_00002 foi adicionado.','2022-04-22 23:19:28'),(30,5,2,'O lote GRN_VRM_00001 foi adicionado.','2022-04-22 23:19:40'),(31,5,2,'O lote GRN_VRM_00002 foi adicionado.','2022-04-22 23:19:52'),(32,5,2,'O lote GRN_VRM_00003 foi adicionado.','2022-04-22 23:20:04'),(33,5,2,'O lote GRN_VRM_00004 foi adicionado.','2022-04-22 23:20:18'),(34,5,2,'O lote MRM_AMR_00001 foi adicionado.','2022-04-22 23:20:35'),(35,5,2,'O lote PDR_BRC_00001 foi adicionado.','2022-04-22 23:20:46'),(36,5,2,'O lote PDR_BRC_00002 foi adicionado.','2022-04-22 23:20:57'),(37,5,2,'O lote PDR_BRC_00003 foi adicionado.','2022-04-22 23:21:18'),(38,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:23:13'),(39,6,3,'O estado da encomenda #2 foi atualizada.','2022-04-22 23:23:22'),(40,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:23:25'),(41,6,3,'O estado da encomenda #4 foi atualizada.','2022-04-22 23:23:31'),(42,6,3,'O estado da encomenda #5 foi atualizada.','2022-04-22 23:23:33'),(43,6,3,'O estado da encomenda #2 foi atualizada.','2022-04-22 23:23:41'),(44,6,3,'O estado da encomenda #2 foi atualizada.','2022-04-22 23:23:47'),(45,6,3,'O estado da encomenda #5 foi atualizada.','2022-04-22 23:23:50'),(46,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:24:02'),(47,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:24:04'),(48,6,3,'O estado da encomenda #4 foi atualizada.','2022-04-22 23:24:08'),(49,6,3,'O estado da encomenda #5 foi atualizada.','2022-04-22 23:24:11'),(50,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:24:14'),(51,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:24:16'),(52,6,3,'O estado da encomenda #4 foi atualizada.','2022-04-22 23:24:18'),(53,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:24:20'),(54,6,3,'O estado da encomenda #5 foi atualizada.','2022-04-22 23:24:24'),(55,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:24:30'),(56,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:26:36'),(57,6,3,'O estado da encomenda #4 foi atualizada.','2022-04-22 23:26:41'),(58,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:26:46'),(59,6,3,'O estado da encomenda #5 foi atualizada.','2022-04-22 23:27:13'),(60,6,3,'O estado da encomenda #5 foi atualizada.','2022-04-22 23:27:32'),(61,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:27:47'),(62,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:28:16'),(63,5,2,'Foi confirmada a recolha de ID #1, do lote MRM_AMR_00001.','2022-04-22 23:30:55'),(64,5,2,'Foi confirmada a recolha de ID #4, do lote PDR_BRC_00002.','2022-04-22 23:31:25'),(65,6,3,'O estado da encomenda #3 foi atualizada.','2022-04-22 23:31:48'),(66,6,3,'O estado da encomenda #1 foi atualizada.','2022-04-22 23:31:57');
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
INSERT INTO `lote` VALUES ('GRN_LRJ_00001',1,475,3,1,'2022-04-22 23:19:01'),('GRN_LRJ_00002',1,475,1,2,'2022-04-22 23:19:17'),('GRN_VRM_00001',2,500,2,1,'2022-04-22 23:19:31'),('GRN_VRM_00002',2,500,1,1,'2022-04-22 23:19:42'),('GRN_VRM_00003',2,500,2,1,'2022-04-22 23:19:54'),('GRN_VRM_00004',2,500,1,1,'2022-04-22 23:20:06'),('MRM_AMR_00001',3,450,4,3,'2022-04-22 23:20:22'),('PDR_BRC_00001',4,500,4,3,'2022-04-22 23:20:37'),('PDR_BRC_00002',4,450,3,3,'2022-04-22 23:20:47'),('PDR_BRC_00003',4,500,4,2,'2022-04-22 23:21:02');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
INSERT INTO `material` VALUES (1,'Granito','GRN'),(2,'Pedra','PDR'),(3,'Marmore','MRM');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (1,7,4,NULL,NULL,50,'João','Rua do Porto',NULL,NULL,'912345678','cliente@gmail.com',NULL,NULL,NULL,'2022-04-22 23:17:13'),(2,7,3,NULL,NULL,50,'João','Rua do Porto',NULL,NULL,'912345678','cliente@gmail.com',NULL,NULL,NULL,'2022-04-22 23:17:25'),(3,7,3,NULL,NULL,25,'João','Rua do Porto',NULL,NULL,'912345678','cliente@gmail.com',NULL,NULL,NULL,'2022-04-22 23:17:33'),(4,7,2,NULL,NULL,50,'João','Rua do Porto',NULL,NULL,'912345678','cliente@gmail.com',NULL,NULL,NULL,'2022-04-22 23:17:43'),(5,7,1,NULL,NULL,50,'João','Rua do Porto',NULL,NULL,'912345678','cliente@gmail.com',NULL,NULL,NULL,'2022-04-22 23:17:55'),(6,7,1,NULL,NULL,50,'João','Rua do Porto',NULL,NULL,'912345678','cliente@gmail.com',NULL,NULL,NULL,'2022-04-22 23:18:06');
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
INSERT INTO `pedido_lote` VALUES (1,3,'MRM_AMR_00001',NULL,25,1,NULL,'ABC-123','2022-04-22 23:30:55'),(2,5,'GRN_LRJ_00001',NULL,25,3,NULL,NULL,NULL),(3,5,'GRN_LRJ_00002',NULL,25,2,NULL,NULL,NULL),(4,1,'PDR_BRC_00002',NULL,50,3,NULL,'ABC-143','2022-04-22 23:31:25');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (1,1,1,5,6,2,6,3,'Granito Laranja','Fino e sofisticado!',5,1),(2,1,2,6,8,3,5,9,'Granito Vermelho','O granito vermelho é muito resistente a riscos, pois foi desenvolvido com o objetivo de ser utilizado em bancadas de cozinhas, portanto fique tranquilo quanto ao seu uso. É Resistente a manchas como vinho, café, açaí, azeite, óleos e produtos que contém corantes em geral.',6,1),(3,3,4,7,3,2,3,2,'Mármore Amarelo','Simples, elegante!',3,1),(4,2,3,8,1,3,2,1,'Pedra Branca','Pode ser utilizado em superfícies de ambientes internos como: cozinhas, banheiros, lavabos, áreas de serviços, pisos, escadas, mesas e muito mais. Para limpeza do material, nós recomendamos que se use um pano com detergente neutro ou esponja scott brite com sapólio em pó.',5,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,1,4,NULL,'Miguel Rocha',0,'1991-01-01',NULL,'Rua de Bragança','Bragança','5300-000',NULL,NULL,'2022-03-31 01:38:51','2022-03-31 01:38:51',NULL),(3,5,2,NULL,'Joaquim',0,'1985-03-05',NULL,'Rua de Lisbo','Lisboa','5400-000',NULL,NULL,'2022-04-22 20:48:10','2022-04-22 20:48:10',NULL),(4,6,3,NULL,'Ribeiro Cruz',0,'1992-09-11',NULL,'Rua de Coimbra','Coimbra','5200-000',NULL,NULL,'2022-04-22 20:48:25','2022-04-22 20:48:25',NULL),(5,7,1,NULL,'João',0,'1990-05-11',NULL,'Rua do Porto','Porto','5000-000',NULL,NULL,'2022-04-22 20:48:38','2022-04-22 20:48:38',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transportadora`
--

LOCK TABLES `transportadora` WRITE;
/*!40000 ALTER TABLE `transportadora` DISABLE KEYS */;
INSERT INTO `transportadora` VALUES (1,'Unipessoal'),(2,'Bragacoop'),(3,'Ctt'),(4,'Targa Transportes'),(5,'Gestra CZ');
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
INSERT INTO `user` VALUES (1,1,1,NULL,'Admin','$2y$13$n7YDsOW1BdPhOvVPYxpj0eqakCjMm3aVEIE1Y2IEGRRKxYU2N13Lq','4I8AtWe0spfF3vSq05930xYJEwwEtZE5','dC9VOjlGLSmsg6ZGkh7E0DJKz8G1K59O','::1','2022-04-22 21:18:16','::1','2022-03-31 01:38:51','2022-03-31 01:38:51',NULL,NULL),(5,3,1,'operario@gmail.com','operario','$2y$13$0LzjsLhzINVYvLODv8Mvw.kMzyc7rksJTay7SzT3Iwsy4F9c6dvee','KVrlIjLkuOZWa84p15thU07RGJuLdKSs','0TOj4arsH5qNHnpTD7QIKHbvFeubmAaE','::1','2022-04-22 21:28:32','::1','2022-04-22 20:48:10','2022-04-22 20:48:10',NULL,NULL),(6,2,1,'gestor@gmail.com','gestor','$2y$13$6G0h6wBIYMsRNGhKtjqoRudUGta9Yqk6GZOCp.yrC9DBsXnPK62y2','li5sXlrc7xAKs_IkN7e6ddo6fAgTBaKc','HQjgSMdHtf4L7-F58qnpdKMsp46x5d72','::1','2022-04-22 21:31:36','::1','2022-04-22 20:48:25','2022-04-22 20:48:25',NULL,NULL),(7,4,1,'cliente@gmail.com','cliente','$2y$13$yxFrT6gMlbWvQ9.Vs6bMhO4foJ06AgBQPrA64fRfi.iR4nDGyz/Ae','Y7Fcqv6qBOYXYOk3JJtFAM1ZpUI5O6lS','IuuoT09TD7qMOR4So7vRc8ubELpYvEwE','::1','2022-04-22 21:16:18','::1','2022-04-22 20:48:38','2022-04-22 20:48:38',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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

-- Dump completed on 2022-04-27  2:07:56