/*
Navicat MySQL Data Transfer

Source Server         : Connect
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : dando-dando

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-05-16 16:09:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `categoriaID` int(11) NOT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`categoriaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES ('1', 'Accesorios');
INSERT INTO `categorias` VALUES ('2', 'Animales');
INSERT INTO `categorias` VALUES ('3', 'C&aacute;maras');
INSERT INTO `categorias` VALUES ('4', 'Tel&eacute;fonos y Celulares');
INSERT INTO `categorias` VALUES ('5', 'Computaci&oacute;n');
INSERT INTO `categorias` VALUES ('6', 'Consolas y Videojuegos');
INSERT INTO `categorias` VALUES ('7', 'Deportes y Fitness');
INSERT INTO `categorias` VALUES ('8', 'Electrodom&eacute;sticos');
INSERT INTO `categorias` VALUES ('9', 'Electr&oacute;nica, Audio y Video');
INSERT INTO `categorias` VALUES ('10', 'Accesorios para carros');
INSERT INTO `categorias` VALUES ('11', 'C&aacute;maras y Accesorios');
INSERT INTO `categorias` VALUES ('12', 'Celulares y Tel&eacute;fonos');
INSERT INTO `categorias` VALUES ('13', 'Computaci&oacute;n');
INSERT INTO `categorias` VALUES ('14', 'Consola y Videojuegos');
INSERT INTO `categorias` VALUES ('15', 'Deportes y Fitnes');
INSERT INTO `categorias` VALUES ('16', 'Otros');

-- ----------------------------
-- Table structure for publicaciones
-- ----------------------------
DROP TABLE IF EXISTS `publicaciones`;
CREATE TABLE `publicaciones` (
  `publicacionID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoriaID` int(11) DEFAULT NULL,
  `publicadopor` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `compradopor` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `compradofecha` varchar(10) DEFAULT NULL,
  `vendidopor` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estadopublicacion` varchar(15) DEFAULT NULL,
  `titulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `video` varchar(999) DEFAULT NULL,
  `productoestado` varchar(10) DEFAULT NULL,
  `precio` varchar(20) DEFAULT NULL,
  `pais` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `detalles` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `ip` varchar(25) DEFAULT NULL,
  `fecha` varchar(10) DEFAULT NULL,
  `hora` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`publicacionID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of publicaciones
-- ----------------------------
INSERT INTO `publicaciones` VALUES ('6', '5', 'milindex@gmail.com', '', '', 'milindex@gmail.com', '1', 'Microfono profesional para estudio de grabaci&oacute;n', 'completado_hk81wngpss.jpg', null, 'disponible', '1500', 'Venezuela', 'Barcelona', '                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ', '::1', '21/08/2013', '02:08:50');
INSERT INTO `publicaciones` VALUES ('7', '1', 'milindex@gmail.com', '', '', 'milindex@gmail.com', '1', 'Reloj de titanio de pulso, NUEVO!', 'completado_9h3srt201s.jpg', null, 'disponible', '2500', 'Venezuela', 'Caracas', '                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ', '::1', '21/08/2013', '02:08:52');
INSERT INTO `publicaciones` VALUES ('8', '5', 'milindex@gmail.com', '', '', 'milindex@gmail.com', '1', 'Pendrive Kingstong de 5GB', 'completado_2n8wh531s4.jpg', null, 'disponible', '950', 'Rep&uacute;blica Dominica', 'Caracas', '                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ', '::1', '21/08/2013', '02:08:52');
INSERT INTO `publicaciones` VALUES ('9', '4', 'milindex@gmail.com', null, null, 'milindex@gmail.com', '1', 'Telefono Iphone 4G color Blanco', 'completado_gxyyjk1yd0.jpg', null, 'disponible', '11500', 'Venezuela', 'Caracas', '                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ', '::1', '21/08/2013', '02:08:53');
INSERT INTO `publicaciones` VALUES ('10', '4', 'milindex@gmail.com', null, null, 'milindex@gmail.com', '1', 'Telefono Blackberry Bold 990 ', 'completado_8r2p84pcm6.jpg', null, 'disponible', '7500', 'Venezuela', 'Barcelona', '                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ', '::1', '21/08/2013', '02:08:54');
INSERT INTO `publicaciones` VALUES ('11', '3', 'milindex@gmail.com', null, null, 'milindex@gmail.com', '1', 'Camara Sony con memoria de 2GB', 'completado_9wrk678ntx.jpg', null, 'disponible', '4500', 'Venezuela', 'Caracas', '                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ', '::1', '21/08/2013', '02:08:55');
INSERT INTO `publicaciones` VALUES ('12', '5', 'milindex@gmail.com', 'milindex@gmail.com', '12/03/2014', 'milindex@gmail.com', '1', 'Laptop intel pantalla 16&ldquo; Ram 2GB', 'completado_r8zkwdxkpx.jpg', null, 'disponible', '13000', 'Venezuela', 'Caracas', '                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ', '::1', '21/08/2013', '02:08:56');
INSERT INTO `publicaciones` VALUES ('13', '8', 'milindex@gmail.com', 'milindex@gmail.com', '12/03/2014', 'milindex@gmail.com', '1', 'Nevera de 3 Puertas Gris', 'completado_dzmgq021tm.jpg', null, 'disponible', '14000', 'Venezuela', 'Caracas', '                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ', '::1', '21/08/2013', '02:08:57');
INSERT INTO `publicaciones` VALUES ('14', '4', 'milindex@gmail.com', 'milindex@gmail.com', '12/03/2014', 'milindex@gmail.com', '1', 'Samsung Galaxy S4 con memoria de 16GB', 'completado_3890kc78f5.jpg', null, 'disponible', '22500', 'Venezuela', 'Barcelona', '                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ', '::1', '21/08/2013', '02:08:58');
INSERT INTO `publicaciones` VALUES ('15', '3', 'milindex@gmail.com', 'darwinarroyo@yahoo.com', '28/08/2013', 'milindex@gmail.com', '1', 'Camara HD Sony 50 Lente Optico 250x', 'completado_8jtbcn3y3k.jpg', null, 'disponible', '19000', 'Venezuela', 'Barcelona', '                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ', '::1', '21/08/2013', '02:08:59');
INSERT INTO `publicaciones` VALUES ('16', '8', 'milindex@gmail.com', 'milindex@gmail.com', '12/03/2014', 'milindex@gmail.com', '1', 'Televisor de 45&ldquo; Sony LED', 'completado_0mqj9xx8b7.jpg', null, 'comprado', '45000', 'Venezuela', 'Barcelona', '                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ', '::1', '21/08/2013', '03:08:00');
INSERT INTO `publicaciones` VALUES ('17', '9', 'milindex@gmail.com', 'milindex@gmail.com', '12/03/2014', 'milindex@gmail.com', '1', 'Audifonos profesional Song Bass 2.0', 'completado_1kd3q94567.jpg', null, 'comprado', '1700', 'Venezuela', 'Barcelona', '                    <p>Lorem ipsum es el texto que se usa habitualmente en dise&ntilde;o gr&aacute;fico en demostraciones de tipograf&iacute;as o de borradores de dise&ntilde;o para probar el dise&ntilde;o visual antes de insertar el texto final.</p>\r\n\r\n<p>Aunque no posee actualmente fuentes para justificar sus hip&oacute;tesis, el profesor de filolog&iacute;a cl&aacute;sica Richard McClintock asegura que su uso se remonta a los impresores de comienzos del siglo XVI.1 Su uso en algunos editores de texto muy conocidos en la actualidad ha dado al texto lorem ipsum nueva popularidad.</p>\r\n                    ', '::1', '21/08/2013', '03:08:01');
INSERT INTO `publicaciones` VALUES ('18', '0', 'darwinarroyo@yahoo.com', 'milindex@gmail.com', '12/03/2014', 'darwinarroyo@yahoo.com', '1', '', '', null, 'comprado', '', '', '', '', '190.206.23.18', '21/08/2013', '08:08:29');
INSERT INTO `publicaciones` VALUES ('19', '4', 'darwinarroyo@yahoo.com', 'milindex@gmail.com', '12/03/2014', 'darwinarroyo@yahoo.com', '1', 'samsun galaxy s3 mini chino android', 'completado_vxvfr0nff0.jpg', null, 'comprado', '6000', 'Venezuela', 'valencia', 'totalmente nuevo en su caja', '200.84.144.140', '13/09/2013', '12:09:22');
INSERT INTO `publicaciones` VALUES ('20', '4', 'darwinarroyo@yahoo.com', 'milindex@gmail.com', '12/03/2014', 'darwinarroyo@yahoo.com', '1', 'iphone 5', 'completado_1kn6gxpf3w.jpg', null, 'comprado', '35000', '35000', '35000', 'iphone 5 nuevo en su caja y accesorios.', '200.84.159.123', '16/09/2013', '07:09:51');
INSERT INTO `publicaciones` VALUES ('21', '1', 'milindex@gmail.com', 'milindex@gmail.com', '12/03/2014', 'milindex@gmail.com', '1', 'Banner 1', 'completado_qfkvptjfsw.gif', 'http://www.youtube.com/watch?v=2Y7NYT5OHkU', 'comprado', '456', 'El Salvador', 'Barcelona', 'wr werw erw er', '127.0.0.1', '12/03/2014', '07:03:51');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
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
  `pais` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecharegistro` varchar(20) DEFAULT NULL,
  `horaregistro` varchar(20) DEFAULT NULL,
  `clavealeatoria` varchar(255) DEFAULT NULL,
  `estadousuario` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usuarioID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('2', null, null, null, 'luis@tb.com.ve', null, null, 'efe6398127928f1b2e9ef3207fb82663', null, null, null, null, null, null, null, null, null);
INSERT INTO `usuarios` VALUES ('3', 'registrado', 'Luis', '', '1@1.com', '', '', '4297f44b13955235245b2497399d7a93', '', '', '', '', '21/08/2013', '05:08:42', '4457', '1', '181.208.70.9');
INSERT INTO `usuarios` VALUES ('4', 'registrado', 'Luis', '', '2@2.com', '789789789', '', '4297f44b13955235245b2497399d7a93', '', 'Barcelona', '', 'Venezuela', '21/08/2013', '05:08:46', '9371', '1', '181.208.70.9');
INSERT INTO `usuarios` VALUES ('5', 'registrado', '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '21/08/2013', '08:08:16', '8992', '1', '190.206.23.18');
INSERT INTO `usuarios` VALUES ('10', 'registrado', 'Luis Figuera', 'username', 'milindex@gmail.com', '789987987', '123123123', '9603cd11a1233c5b17f6c6f7b4c12124', 'Personal', 'La Florida', 'Barcelona', 'Venezuela', '12/03/2014', '03:03:22', 'username485', '1', '181.208.68.173');
