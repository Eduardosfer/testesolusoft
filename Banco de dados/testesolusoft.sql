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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos_pedido`
--

LOCK TABLES `produtos_pedido` WRITE;
/*!40000 ALTER TABLE `produtos_pedido` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
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

-- Dump completed on 2019-02-07 23:09:46
