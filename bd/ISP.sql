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
  PRIMARY KEY (`rutEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla Empresa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Empresa`;

CREATE TABLE `Empresa` (
  `codigoEmpresa` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rutEmpresa` varchar(10) NOT NULL DEFAULT '',
  `nombreEmpresa` varchar(30) NOT NULL DEFAULT '',
  `passwordEmpresa` varchar(10) NOT NULL DEFAULT '',
  `direccionEmpresa` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`codigoEmpresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla Particular
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Particular`;

CREATE TABLE `Particular` (
  `codigoParticular` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rutParticular` varchar(45) NOT NULL DEFAULT '',
  `passwordParticular` varchar(45) NOT NULL DEFAULT '',
  `nombreParticular` varchar(45) NOT NULL DEFAULT '',
  `direccionParticular` varchar(45) NOT NULL DEFAULT '',
  `emailParticular` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`codigoParticular`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


# Volcado de tabla TipoAnalisis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `TipoAnalisis`;

CREATE TABLE `TipoAnalisis` (
  `idTipoAnalisis` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`idTipoAnalisis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


# Volcado de tabla AnalisisMuestras
# ------------------------------------------------------------

DROP TABLE IF EXISTS `AnalisisMuestras`;

CREATE TABLE `AnalisisMuestras` (
  `idAnalisisMuestras` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fechaRecepcion` date NOT NULL,
  `temperaturaMuestra` decimal(3,1) NOT NULL,
  `cantidadMuestra` int(11) NOT NULL,
  `Empresa_codigoEmpresa` int(11) unsigned DEFAULT NULL,
  `Particular_codigoParticular` int(11) unsigned DEFAULT NULL,
  `rutEmpleadoRecibe` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`idAnalisisMuestras`),
  KEY `EmpresaAnalisis` (`Empresa_codigoEmpresa`),
  KEY `ParticularAnalisis` (`Particular_codigoParticular`),
  KEY `EmpleadoAnalisis` (`rutEmpleadoRecibe`),
  CONSTRAINT `EmpleadoAnalisis` FOREIGN KEY (`rutEmpleadoRecibe`) REFERENCES `Empleado` (`rutEmpleado`),
  CONSTRAINT `EmpresaAnalisis` FOREIGN KEY (`Empresa_codigoEmpresa`) REFERENCES `Empresa` (`codigoEmpresa`),
  CONSTRAINT `ParticularAnalisis` FOREIGN KEY (`Particular_codigoParticular`) REFERENCES `Particular` (`codigoParticular`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla Contacto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Contacto`;

CREATE TABLE `Contacto` (
  `rutContacto` varchar(10) NOT NULL DEFAULT '',
  `nombreContacto` varchar(30) NOT NULL DEFAULT '',
  `emailContacto` varchar(45) NOT NULL DEFAULT '',
  `telefonoContacto` varchar(15) NOT NULL DEFAULT '',
  `Empresa_codigoEmpresa` int(11) unsigned NOT NULL,
  PRIMARY KEY (`rutContacto`),
  KEY `ContactoEmpresa` (`Empresa_codigoEmpresa`),
  CONSTRAINT `ContactoEmpresa` FOREIGN KEY (`Empresa_codigoEmpresa`) REFERENCES `Empresa` (`codigoEmpresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla ResultadoAnalisis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ResultadoAnalisis`;

CREATE TABLE `ResultadoAnalisis` (
  `idTipoAnalisis` int(11) unsigned NOT NULL,
  `idAnalisisMuestras` int(10) unsigned NOT NULL,
  `fechaRegistro` date NOT NULL,
  `PPM` int(11) NOT NULL,
  `estado` bit(1) NOT NULL,
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
  `Particular_codigoParticular` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `TelefonoParticular` (`Particular_codigoParticular`),
  CONSTRAINT `TelefonoParticular` FOREIGN KEY (`Particular_codigoParticular`) REFERENCES `Particular` (`codigoParticular`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
