-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: free_dando
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.13.10.1

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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `categoriaID` int(11) NOT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  PRIMARY KEY (`categoriaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Accesorios','accesorios-carro.jpg'),(2,'Animales','completado_19rp8k9syq.jpg'),(3,'C&aacute;maras','camaras.jpg'),(4,'Tel&eacute;fonos y Celulares','completado_3890kc78f5.jpg'),(5,'Computaci&oacute;n','computadoras.jpg'),(6,'Consolas y Videojuegos','consolas.jpg'),(7,'Deportes y Fitness','deportes.jpg'),(8,'Electrodom&eacute;sticos','completado_dzmgq021tm.jpg'),(9,'Electr&oacute;nica, Audio y Video','completado_dzmgq021tm.jpg'),(10,'Accesorios para carros','accesorios-carro.jpg'),(11,'C&aacute;maras y Accesorios','camaras.jpg'),(12,'Celulares y Tel&eacute;fonos','completado_8r2p84pcm6.jpg'),(16,'Otros','completado_4fzpjgmt8w.jpg');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicaciones`
--

DROP TABLE IF EXISTS `publicaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicaciones` (
  `publicacionID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoriaID` int(11) DEFAULT NULL,
  `publicadopor` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `compradopor` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `compradofecha` varchar(10) DEFAULT NULL,
  `vendidopor` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estadopublicacion` varchar(15) DEFAULT NULL,
  `productonuevousado` int(1) NOT NULL DEFAULT '1' COMMENT '1 = nuevo; 0=usado',
  `titulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `video` varchar(999) DEFAULT NULL,
  `productoestado` varchar(10) DEFAULT NULL COMMENT 'estado = disponible, comprado',
  `precio` varchar(20) DEFAULT NULL,
  `pais` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `detalles` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `ip` varchar(25) DEFAULT NULL,
  `fecha` varchar(10) DEFAULT NULL,
  `hora` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`publicacionID`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicaciones`
--

LOCK TABLES `publicaciones` WRITE;
/*!40000 ALTER TABLE `publicaciones` DISABLE KEYS */;
INSERT INTO `publicaciones` VALUES (6,5,'milindex@gmail.com','','','milindex@gmail.com','1',1,'Microfono profesional para estudio de grabaci&oacute;n',NULL,'disponible','1500','Venezuela','Barcelona','                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ','::1','21/08/2013','02:08:50'),(7,1,'milindex@gmail.com','','','milindex@gmail.com','1',1,'Reloj de titanio de pulso, NUEVO!',NULL,'disponible','2500','Venezuela','Caracas','                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ','::1','21/08/2013','02:08:52'),(8,5,'milindex@gmail.com','','','milindex@gmail.com','1',1,'Pendrive Kingstong de 5GB',NULL,'disponible','950','Rep&uacute;blica Dominica','Caracas','                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ','::1','21/08/2013','02:08:52'),(9,4,'milindex@gmail.com',NULL,NULL,'milindex@gmail.com','1',1,'Telefono Iphone 4G color Blanco',NULL,'disponible','11500','Venezuela','Caracas','                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ','::1','21/08/2013','02:08:53'),(10,4,'milindex@gmail.com',NULL,NULL,'milindex@gmail.com','1',1,'Telefono Blackberry Bold 990 ',NULL,'disponible','7500','Venezuela','Barcelona','                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ','::1','21/08/2013','02:08:54'),(11,3,'milindex@gmail.com',NULL,NULL,'milindex@gmail.com','1',1,'Camara Sony con memoria de 2GB',NULL,'disponible','4500','Venezuela','Caracas','                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ','::1','21/08/2013','02:08:55'),(12,5,'milindex@gmail.com','milindex@gmail.com','12/03/2014','milindex@gmail.com','1',1,'Laptop intel pantalla 16&ldquo; Ram 2GB',NULL,'disponible','13000','Venezuela','Caracas','                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ','::1','21/08/2013','02:08:56'),(13,8,'milindex@gmail.com','milindex@gmail.com','12/03/2014','milindex@gmail.com','1',1,'Nevera de 3 Puertas Gris',NULL,'disponible','14000','Venezuela','Caracas','                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ','::1','21/08/2013','02:08:57'),(14,4,'milindex@gmail.com','milindex@gmail.com','12/03/2014','milindex@gmail.com','1',1,'Samsung Galaxy S4 con memoria de 16GB',NULL,'disponible','22500','Venezuela','Barcelona','                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ','::1','21/08/2013','02:08:58'),(15,3,'milindex@gmail.com','darwinarroyo@yahoo.com','28/08/2013','milindex@gmail.com','1',1,'Camara HD Sony 50 Lente Optico 250x',NULL,'disponible','19000','Venezuela','Barcelona','                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ','::1','21/08/2013','02:08:59'),(16,8,'milindex@gmail.com','milindex@gmail.com','12/03/2014','milindex@gmail.com','1',1,'Televisor de 45&ldquo; Sony LED',NULL,'comprado','45000','Venezuela','Barcelona','                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ','::1','21/08/2013','03:08:00'),(17,9,'milindex@gmail.com','milindex@gmail.com','12/03/2014','milindex@gmail.com','1',1,'Audifonos profesional Song Bass 2.0',NULL,'comprado','1700','Venezuela','Barcelona','                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ','::1','21/08/2013','03:08:01'),(18,0,'darwinarroyo@yahoo.com','milindex@gmail.com','12/03/2014','darwinarroyo@yahoo.com','1',1,'',NULL,'comprado','','','','','190.206.23.18','21/08/2013','08:08:29'),(19,4,'darwinarroyo@yahoo.com','milindex@gmail.com','12/03/2014','darwinarroyo@yahoo.com','1',1,'samsun galaxy s3 mini chino android',NULL,'comprado','6000','Venezuela','valencia','totalmente nuevo en su caja','200.84.144.140','13/09/2013','12:09:22'),(20,4,'darwinarroyo@yahoo.com','milindex@gmail.com','12/03/2014','darwinarroyo@yahoo.com','1',1,'iphone 5',NULL,'comprado','35000','35000','35000','iphone 5 nuevo en su caja y accesorios.','200.84.159.123','16/09/2013','07:09:51'),(21,1,'milindex@gmail.com','milindex@gmail.com','12/03/2014','milindex@gmail.com','1',1,'Banner 1','http://www.youtube.com/watch?v=2Y7NYT5OHkU','comprado','456','El Salvador','Barcelona','wr werw erw er','127.0.0.1','12/03/2014','07:03:51'),(24,1,'anibal@gmail.com',NULL,NULL,'anibal@gmail.com','1',1,'HOLAAAAAAAAAAAAA','SSSSSSSSSSSSS','disponible','600','Venezuela','SA','SADASD','127.0.0.1','20/05/2014','08:05:27'),(26,10,'anibal@gmail.com',NULL,NULL,'anibal@gmail.com','1',0,'HOLAAAAAAAAAAAAA','SSSSSSSSSSSSS','disponible','600','Venezuela','SA','SADASD','127.0.0.1','20/05/2014','08:05:29'),(27,1,'anibal@gmail.com','milindex@gmail.com','21/05/2014','anibal@gmail.com','1',1,'HOLAAAAAAAAAAAAA','SSSSSSSSSSSSS','comprado','600','Venezuela','SA','SADASD','127.0.0.1','20/05/2014','08:05:30'),(28,1,'anibal@gmail.com','anibal@gmail.com','21/05/2014','anibal@gmail.com','1',1,'HOLAAAAAAAAAAAAA','SSSSSSSSSSSSS','comprado','600','Venezuela','SA','SADASD','127.0.0.1','20/05/2014','08:05:31'),(29,1,'anibal@gmail.com',NULL,NULL,'anibal@gmail.com','1',1,'HOLAAAAAAAAAAAAA','SSSSSSSSSSSSS','disponible','600','Venezuela','SA','SADASD','127.0.0.1','20/05/2014','08:05:32'),(32,1,'anibal@gmail.com',NULL,NULL,'anibal@gmail.com','1',1,'HOLAAAAAAAAAAAAA','SSSSSSSSSSSSS','disponible','600','Venezuela','SA','SADASD','127.0.0.1','20/05/2014','08:05:36'),(33,1,'anibal@gmail.com',NULL,NULL,'anibal@gmail.com','1',1,'producto 4 fotos','producto 4 fotos','disponible','4000','Per&uacute;','lima','producto 4 fotos','127.0.0.1','20/05/2014','08:05:49'),(34,1,'anibal@gmail.com','','','anibal@gmail.com','1',1,'producto THUB','producto THUB','disponible','200','Per&uacute;','12','producto THUB','127.0.0.1','21/05/2014','01:05:05'),(35,1,'anibal@gmail.com','anibal@gmail.com','21/05/2014','anibal@gmail.com','1',0,'35 OK','OTROOOAAAAA','comprado','255','Argentina','SSS','OK 35','127.0.0.1','21/05/2014','01:05:10'),(36,1,'anibal@gmail.com',NULL,NULL,'anibal@gmail.com','1',1,'6666666666','6666666666','disponible','6000','Per','lima','66666666666666666','127.0.0.1','21/05/2014','03:05:27'),(48,1,'anibal@gmail.com',NULL,NULL,'anibal@gmail.com','1',1,'unoaaaaaaaaaadddd','asdasd','disponible','700','Perú','asdsad','asdasdad','127.0.0.1','21/05/2014','03:05:49'),(49,1,'anibal@gmail.com',NULL,NULL,'anibal@gmail.com','1',1,'unoaaaaaaaaaadddd','asdasd','disponible','700','Perú','asdsad','asdasdad','127.0.0.1','21/05/2014','03:05:49'),(50,1,'anibal@gmail.com',NULL,NULL,'anibal@gmail.com','1',1,'PRODUCTO 100001','asdasd','disponible','700','Perú','asdsad','asdasdad','127.0.0.1','21/05/2014','03:05:50'),(51,10,'anibal@gmail.com',NULL,NULL,'anibal@gmail.com','1',1,'procuto animales procuto animales 111','procuto animales 111','disponible','800111','Perú','lima111','lima111','127.0.0.1','21/05/2014','03:05:51'),(52,1,'anibal@gmail.com',NULL,NULL,'anibal@gmail.com','1',1,'otro 000 otro 000 otro 000','otro 000','disponible','500','Perú','lima','zd otro 000','127.0.0.1','21/05/2014','07:05:16'),(53,1,'anibal@gmail.com',NULL,NULL,'anibal@gmail.com','1',1,'00000000000000','00000000000','disponible','50000','Perú','lo','as','127.0.0.1','22/05/2014','04:05:28');
/*!40000 ALTER TABLE `publicaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicaciones_images`
--

DROP TABLE IF EXISTS `publicaciones_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicaciones_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publicacionID` int(10) unsigned NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1' COMMENT '1=on  0=off ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1 COMMENT='ok';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicaciones_images`
--

LOCK TABLES `publicaciones_images` WRITE;
/*!40000 ALTER TABLE `publicaciones_images` DISABLE KEYS */;
INSERT INTO `publicaciones_images` VALUES (2,20,'completado_hk81wngpss.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(3,20,'completado_hk81wngpss.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(4,30,'completado_hk81wngpss.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(5,30,'completado_9h3srt201s.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(6,30,'completado_2n8wh531s4.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(7,21,'completado_gxyyjk1yd0.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(8,21,'1400633751.jpg','2014-05-20 08:36:03','0000-00-00 00:00:00',1),(9,21,'1400633790.jpg','2014-05-20 08:36:03','0000-00-00 00:00:00',1),(10,22,'1400635114.jpg','2014-05-20 08:49:18','0000-00-00 00:00:00',1),(11,22,'1400635122.jpg','2014-05-20 08:49:18','0000-00-00 00:00:00',1),(12,25,'1400635124.jpg','2014-05-20 08:49:18','0000-00-00 00:00:00',1),(13,25,'1400635130.jpg','2014-05-20 08:49:18','0000-00-00 00:00:00',1),(14,30,'1400650512.jpg','2014-05-21 01:05:53','0000-00-00 00:00:00',1),(15,30,'1400650514.jpg','2014-05-21 01:05:53','0000-00-00 00:00:00',1),(16,27,'1400650520.jpg','2014-05-21 01:05:53','0000-00-00 00:00:00',1),(17,27,'1400650799.png','2014-05-21 01:10:36','0000-00-00 00:00:00',1),(18,27,'1400650805.png','2014-05-21 01:10:36','0000-00-00 00:00:00',1),(19,27,'1400650811.jpg','2014-05-21 01:10:36','0000-00-00 00:00:00',1),(20,27,'1400702186.png','2014-05-21 03:27:46','0000-00-00 00:00:00',1),(21,28,'1400702424.png','2014-05-21 03:35:46','0000-00-00 00:00:00',1),(22,29,'1400703669.png','2014-05-21 03:51:29','0000-00-00 00:00:00',1),(25,29,'1400708778.jpg','2014-05-21 05:16:22','0000-00-00 00:00:00',1),(27,29,'1400708825.jpg','2014-05-21 05:17:07','0000-00-00 00:00:00',1),(29,27,'1400710152.jpg','2014-05-21 05:39:14','0000-00-00 00:00:00',1),(30,35,'1400715648.png','2014-05-21 07:11:08','0000-00-00 00:00:00',1),(31,24,'1400715901.jpg','2014-05-21 07:15:03','0000-00-00 00:00:00',1),(32,52,'1400715967.jpg','2014-05-21 07:16:32','0000-00-00 00:00:00',1),(33,26,'1400716365.png','2014-05-21 07:23:09','0000-00-00 00:00:00',1),(34,26,'1400716374.png','2014-05-21 07:23:09','0000-00-00 00:00:00',1),(35,26,'1400716377.png','2014-05-21 07:23:09','0000-00-00 00:00:00',1),(36,53,'1400792268.png','2014-05-22 04:28:03','0000-00-00 00:00:00',1);
/*!40000 ALTER TABLE `publicaciones_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuarioID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `privilegio` varchar(255) DEFAULT NULL,
  `nombres` varchar(75) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `username` varchar(75) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tlfcelular` varchar(20) DEFAULT NULL,
  `tlfcasa` varchar(20) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `empresa` varchar(75) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `pais` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecharegistro` varchar(20) DEFAULT NULL,
  `horaregistro` varchar(20) DEFAULT NULL,
  `clavealeatoria` varchar(255) DEFAULT NULL,
  `estadousuario` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usuarioID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,NULL,NULL,NULL,'luis@tb.com.ve',NULL,NULL,'efe6398127928f1b2e9ef3207fb82663',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'registrado','Luis','','1@1.com','','','4297f44b13955235245b2497399d7a93','','','','','21/08/2013','05:08:42','4457','1','181.208.70.9'),(4,'registrado','Luis','','2@2.com','789789789','','4297f44b13955235245b2497399d7a93','','Barcelona','','Venezuela','21/08/2013','05:08:46','9371','1','181.208.70.9'),(5,'registrado','sin nombre','','','','','d41d8cd98f00b204e9800998ecf8427e','','','','','21/08/2013','08:08:16','8992','1','190.206.23.18'),(10,'registrado','Luis Figuera','username','milindex@gmail.com','789987987','123123123','c4ca4238a0b923820dcc509a6f75849b','Personal','La Florida','Barcelona','Venezuela','12/03/2014','03:03:22','username485','1','181.208.68.173'),(11,'registrado','anibal norabuena','username','anibal@gmail.com','123456789','123456','25f9e794323b453885f5181f1b624d0b','anb','direccion','ciudad','PerÃº','20/05/2014','01:05:08','username8206','1','127.0.0.1'),(12,'registrado','pepe','username','pepe@gmail.com','123456789','123456789','25f9e794323b453885f5181f1b624d0b','pepe','direccion peep','ciudad pepe','Per&uacute;','20/05/2014','01:05:23','username3320','1','127.0.0.1'),(13,'registrado','pepe2','username','pepe2@gmail.com','123456789','123456789','25f9e794323b453885f5181f1b624d0b','sa','asd','123456','PerÃº','20/05/2014','01:05:24','username6273','1','127.0.0.1'),(14,'registrado','pepe3','username','pepe3@gmail.com','44545454545','454545454545','25f9e794323b453885f5181f1b624d0b','asd','asdasd','asdsad','Perú','20/05/2014','03:05:06','username9933','1','127.0.0.1'),(15,'registrado','aaaa','username','aaa@af.com','448484848','48484848','e10adc3949ba59abbe56e057f20f883e','sad','sadasd','asdasd','Perú','20/05/2014','03:05:16','username4252','1','127.0.0.1'),(16,'registrado','pepe4','username','pepe4@gmail.com','45454545454','45645454545','25f9e794323b453885f5181f1b624d0b','sadsad','sadasdas','asdasdas','Perú','20/05/2014','03:05:18','username1749','1','127.0.0.1'),(17,'registrado','&ntilde;a&ntilde;o','username','pepe5@gmail.com','12354545454','45454545','25f9e794323b453885f5181f1b624d0b','cdsadf','asdasdasd','asdasdas','España','20/05/2014','03:05:53','username1131','1','127.0.0.1'),(18,'registrado','asdasdasd','username','pepe6@gmail.com','123456787','2145454545','25f9e794323b453885f5181f1b624d0b','dfssad','asdasd','asdasd','PerÃº','20/05/2014','04:05:19','username9952','1','127.0.0.1'),(19,'registrado','pepe777','username','pepe7@gmail.com','11111111111111','11111111','25f9e794323b453885f5181f1b624d0b','11111111111','11111111111','11111111111','Venezuela','20/05/2014','04:05:21','username9634','1','127.0.0.1');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-26 15:15:50
