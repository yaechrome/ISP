# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.20)
# Base de datos: ISP
# Tiempo de Generación: 2018-06-26 11:08:14 p. m. +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

SET NAMES utf8;

SET SQL_MODE='';

create database if not exists `isp`;

USE `isp`;


# Volcado de tabla Empleado
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Empleado`;

CREATE TABLE `Empleado` (
  `rutEmpleado` varchar(10) NOT NULL DEFAULT '',
  `nombreEmpleado` varchar(50) NOT NULL DEFAULT '',
  `passwordEmpleado` varchar(10) NOT NULL DEFAULT '',
  `categoria` varchar(1) NOT NULL DEFAULT '',
  `Estado` varchar(10) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`rutEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Empleado` WRITE;
/*!40000 ALTER TABLE `Empleado` DISABLE KEYS */;

INSERT INTO `Empleado` (`rutEmpleado`, `nombreEmpleado`, `passwordEmpleado`, `categoria`, `Estado`)
VALUES
	('123','Arturo Vargas','123','A','Activo'),
	('2-3','Matias Tapia','123','R','Activo'),
	('4-5','Carla Martinez','123','T','Activo');

/*!40000 ALTER TABLE `Empleado` ENABLE KEYS */;
UNLOCK TABLES;

# Volcado de tabla Usuario
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Usuario`;

CREATE TABLE `Usuario` (
  `codigo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rut` varchar(45) NOT NULL DEFAULT '',
  `nombre` varchar(45) NOT NULL DEFAULT '',
  `password` varchar(45) NOT NULL DEFAULT '',
  `direccion` varchar(45) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT '',
  `perfil` varchar(20) NOT NULL DEFAULT '',
  `estado` varchar(10) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `rut` (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;

INSERT INTO `Usuario` (`codigo`, `rut`, `nombre`, `password`, `direccion`, `email`, `perfil`, `estado`)
VALUES
	(1,'1-1','Juan Perez','1','Matucana 100','j.perez@gmail.com','Particular','Activo'),
	(2,'3-3','3it','3','Ahumada 123','3it@3it.cl','Empresa','Activo');

/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;

# Volcado de tabla TipoAnalisis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `TipoAnalisis`;

CREATE TABLE `TipoAnalisis` (
  `idTipoAnalisis` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`idTipoAnalisis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `TipoAnalisis` WRITE;
/*!40000 ALTER TABLE `TipoAnalisis` DISABLE KEYS */;

INSERT INTO `TipoAnalisis` (`idTipoAnalisis`, `nombre`)
VALUES
	(1,'micotoxinas'),
	(2,'metales pesados'),
	(3,'plaguicidas prohibidos'),
	(4,'marea roja'),
	(5,'bacterias nocivas');

/*!40000 ALTER TABLE `TipoAnalisis` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla AnalisisMuestras
# ------------------------------------------------------------

DROP TABLE IF EXISTS `AnalisisMuestras`;

CREATE TABLE `AnalisisMuestras` (
  `idAnalisisMuestras` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fechaRecepcion` date NOT NULL,
  `temperaturaMuestra` decimal(3,1) NOT NULL,
  `cantidadMuestra` int(11) NOT NULL,
  `codigoCliente` int(11) unsigned NOT NULL,
  `rutEmpleadoRecibe` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`idAnalisisMuestras`),
  KEY `EmpleadoAnalisis` (`rutEmpleadoRecibe`),
  KEY `AnalisisCliente` (`codigoCliente`),
  CONSTRAINT `AnalisisCliente` FOREIGN KEY (`codigoCliente`) REFERENCES `Usuario` (`codigo`),
  CONSTRAINT `EmpleadoAnalisis` FOREIGN KEY (`rutEmpleadoRecibe`) REFERENCES `Empleado` (`rutEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla Contacto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Contacto`;

CREATE TABLE `Contacto` (
  `rutContacto` varchar(10) NOT NULL DEFAULT '',
  `nombreContacto` varchar(30) NOT NULL DEFAULT '',
  `emailContacto` varchar(45) NOT NULL DEFAULT '',
  `telefonoContacto` varchar(15) NOT NULL DEFAULT '',
  `codigoEmpresa` int(11) unsigned NOT NULL,
  PRIMARY KEY (`rutContacto`),
  KEY `ContactoEmpresa` (`codigoEmpresa`),
  CONSTRAINT `ContactoEmpresa` FOREIGN KEY (`codigoEmpresa`) REFERENCES `Usuario` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Contacto` WRITE;
/*!40000 ALTER TABLE `Contacto` DISABLE KEYS */;

INSERT INTO `Contacto` (`rutContacto`, `nombreContacto`, `emailContacto`, `telefonoContacto`, `codigoEmpresa`)
VALUES
	('1-2','Mario Gonzales','m.gonzales@3it.cl','876123435',2);

/*!40000 ALTER TABLE `Contacto` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla ResultadoAnalisis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ResultadoAnalisis`;

CREATE TABLE `ResultadoAnalisis` (
  `idTipoAnalisis` int(11) unsigned NOT NULL,
  `idAnalisisMuestras` int(10) unsigned NOT NULL,
  `fechaRegistro` date DEFAULT NULL,
  `PPM` int(11) DEFAULT NULL,
  `estado` varchar(15) NOT NULL DEFAULT 'En Proceso',
  `rutEmpleadoAnalista` varchar(10) NOT NULL DEFAULT '',
  KEY `TipoResultado` (`idTipoAnalisis`),
  KEY `MuestraResultado` (`idAnalisisMuestras`),
  KEY `EmpleadoResultado` (`rutEmpleadoAnalista`),
  CONSTRAINT `EmpleadoResultado` FOREIGN KEY (`rutEmpleadoAnalista`) REFERENCES `Empleado` (`rutEmpleado`),
  CONSTRAINT `MuestraResultado` FOREIGN KEY (`idAnalisisMuestras`) REFERENCES `AnalisisMuestras` (`idAnalisisMuestras`),
  CONSTRAINT `TipoResultado` FOREIGN KEY (`idTipoAnalisis`) REFERENCES `TipoAnalisis` (`idTipoAnalisis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla Telefono
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Telefono`;

CREATE TABLE `Telefono` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `numeroTelefono` varchar(15) NOT NULL DEFAULT '',
  `codigoParticular` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigoParticular` (`codigoParticular`),
  CONSTRAINT `telefono_ibfk_1` FOREIGN KEY (`codigoParticular`) REFERENCES `Usuario` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Telefono` WRITE;
/*!40000 ALTER TABLE `Telefono` DISABLE KEYS */;

INSERT INTO `Telefono` (`id`, `numeroTelefono`, `codigoParticular`)
VALUES
	(1,'123456789',1);

/*!40000 ALTER TABLE `Telefono` ENABLE KEYS */;
UNLOCK TABLES;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
