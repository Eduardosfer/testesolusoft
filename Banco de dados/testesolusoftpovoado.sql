-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: testesolusoft
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.18.04.1

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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `cli_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cli_nome` varchar(100) DEFAULT NULL,
  `cli_cpf` varchar(14) DEFAULT NULL,
  `cli_sexo` varchar(10) DEFAULT NULL,
  `cli_email` varchar(100) DEFAULT NULL,
  `cli_status` varchar(10) DEFAULT 'ativo',
  PRIMARY KEY (`cli_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (23,'Eduardo Soares','555.666.666-66','Masculino','eduardosferr@gmail.com','ativo'),(24,'João da Silva','555.222.222-22','Masculino','eduardosferr@gmail.com','ativo'),(25,'Fernanda da Silva','222.226.262-26','Feminino','eduardosferr@gmail.com','ativo'),(26,'Monica dos Santos','555.888.999-99','Feminino','eduardosferr@gmail.com','ativo'),(27,'Fernando Santos','773.222.111-22','Masculino','eduardosferr@gmail.com','ativo');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `ped_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `ped_codigo_cliente` int(11) DEFAULT NULL,
  `ped_codigo_vendedor` int(11) DEFAULT NULL,
  `ped_data` date DEFAULT NULL,
  `ped_observacao` varchar(200) DEFAULT NULL,
  `ped_forma_pagamento` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ped_codigo`),
  KEY `ped_codigo_cliente` (`ped_codigo_cliente`),
  KEY `ped_codigo_vendedor` (`ped_codigo_vendedor`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`ped_codigo_cliente`) REFERENCES `clientes` (`cli_codigo`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`ped_codigo_vendedor`) REFERENCES `vendedores` (`ven_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (19,23,30,'2019-02-10','Produtos devem ser enviados para o endereço do cliente.','Dinheiro'),(20,23,30,'2019-02-10','Produtos devem ser enviados para o endereço do cliente.','Cartão'),(21,24,31,'2019-02-10','Produtos devem ser enviados para o endereço do cliente.','Cheque'),(22,24,31,'2019-02-10','Produtos devem ser enviados para o endereço do cliente.','Cheque'),(23,25,32,'2019-02-10','Produtos devem ser enviados para o endereço do cliente.','Cartão'),(24,26,33,'2019-02-10','Produtos devem ser enviados para o endereço do cliente.','Cartão'),(25,27,31,'2019-02-10','Produtos devem ser enviados para o endereço do cliente.','Cheque'),(26,25,33,'2018-09-14','Produtos devem ser enviados para o endereço do cliente.','Dinheiro'),(27,26,31,'2018-11-15','Produtos devem ser enviados para o endereço do cliente.','Cartão'),(28,24,33,'2019-01-10','Produtos devem ser enviados para o endereço do cliente.','Dinheiro'),(29,25,34,'2018-10-18','O pedido deve ser enviado para o endereço do cliente','Dinheiro');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `pro_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `pro_nome` varchar(200) DEFAULT NULL,
  `pro_cor` varchar(50) DEFAULT NULL,
  `pro_tamanho` varchar(10) DEFAULT NULL,
  `pro_valor` float DEFAULT NULL,
  `pro_status` varchar(10) DEFAULT 'ativo',
  PRIMARY KEY (`pro_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (5,'Teclado','Preto','Pequeno',200.99,'ativo'),(6,'Mouse','Preto','Pequeno',150.5,'ativo'),(7,'Monitor Full HD','Preto','Médio',635.99,'ativo'),(8,'Mesa para computador','Marrom','Grande',230.33,'ativo'),(9,'Estabilizador 500','Azul','Pequeno',160.67,'ativo');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos_pedido`
--

DROP TABLE IF EXISTS `produtos_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos_pedido` (
  `pro_ped_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `pro_ped_codigo_pedido` int(11) DEFAULT NULL,
  `pro_ped_codigo_produto` int(11) DEFAULT NULL,
  PRIMARY KEY (`pro_ped_codigo`),
  KEY `pro_ped_codigo_pedido` (`pro_ped_codigo_pedido`),
  KEY `pro_ped_codigo_produto` (`pro_ped_codigo_produto`),
  CONSTRAINT `produtos_pedido_ibfk_1` FOREIGN KEY (`pro_ped_codigo_pedido`) REFERENCES `pedidos` (`ped_codigo`),
  CONSTRAINT `produtos_pedido_ibfk_2` FOREIGN KEY (`pro_ped_codigo_produto`) REFERENCES `produtos` (`pro_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos_pedido`
--

LOCK TABLES `produtos_pedido` WRITE;
/*!40000 ALTER TABLE `produtos_pedido` DISABLE KEYS */;
INSERT INTO `produtos_pedido` VALUES (151,19,5),(152,19,6),(153,19,8),(154,20,8),(155,20,7),(156,20,9),(157,21,8),(158,21,6),(159,22,5),(160,22,9),(161,22,9),(162,23,5),(163,23,8),(164,24,5),(165,24,9),(166,24,5),(167,25,5),(168,25,8),(169,26,6),(170,26,8),(171,27,5),(172,27,8),(173,28,7),(174,28,6),(175,28,6),(176,29,5),(177,29,5),(178,29,8);
/*!40000 ALTER TABLE `produtos_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendedores` (
  `ven_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `ven_nome` varchar(100) DEFAULT NULL,
  `ven_nascimento` date DEFAULT NULL,
  `ven_comissao` float DEFAULT NULL,
  `ven_status` varchar(10) DEFAULT 'ativo',
  PRIMARY KEY (`ven_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (30,'Pedro Santos','2000-10-10',20,'ativo'),(31,'Felipe Laçerda','2000-05-05',25,'ativo'),(32,'Lucas Silva','2000-03-03',50,'ativo'),(33,'Fernanda Silva','2000-02-02',25,'ativo'),(34,'Sandra Santana','2000-08-08',35,'ativo');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-10 13:57:47
