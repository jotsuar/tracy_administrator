-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2014 at 02:15 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tracy`
--
CREATE DATABASE IF NOT EXISTS `tracy` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `tracy`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_categoria`(in categoria varchar(45))
begin
	select * from categoria where upper(categoria) 
	like concat( '%',categoria,'%') or lower(categoria)
	like concat('%',categoria,'%');
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_categoria`(
    IN p_id INT, 
    IN categoria varchar(45), 
    IN descripcion TEXT
)
BEGIN
	UPDATE categoria SET categoria = upper(categoria), descripcion = descripcion
	WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_hospedaje`(
    IN p_id INT, 
    IN p_nit VARCHAR(45), 
    IN p_nombre VARCHAR(45),
    IN p_direccion VARCHAR(45),
    IN p_telefono VARCHAR(15),
    IN p_descripcion TEXT,
    IN p_id_categoria INT, 
	IN p_estado BIT
)
BEGIN
	UPDATE hospedaje SET 
        nit = p_nit, 
        nombre = p_nombre,
        direccion = p_direccion,
        telefono = p_telefono,
        descripcion = p_descripcion,
        id_categoria = p_id_categoria,
        estado = p_estado

	WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_categoria`(
	IN categoria varchar(45), 
    IN descripcion TEXT
)
begin
 insert into categoria(categoria,descripcion)
 values(upper(categoria),descripcion);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_hospedaje`(
    IN p_nit VARCHAR(45), 
    IN p_nombre VARCHAR(45),
    IN p_direccion VARCHAR(45),
    IN p_telefono VARCHAR(15),
    IN p_descripcion TEXT,
    IN p_id_categoria INT
)
BEGIN
	INSERT INTO hospedaje(nit, nombre, direccion, telefono, descripcion, id_categoria)
	VALUES(p_nit, p_nombre, p_direccion, p_telefono, p_descripcion, p_id_categoria);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `restore_id`(table_name VARCHAR(45))
BEGIN
    SET @query = CONCAT('SELECT * FROM ', table_name);
    PREPARE stmt1 FROM @query;
    EXECUTE stmt1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consultar_habitacion`()
begin
	select habitacion.id, habitacion.comodidades,habitacion.cantidad,
	tipo_habitacion.nombre as "tipo",
	hospedaje.nombre as hospedaje
	from habitacion 
	inner join tipo_habitacion on habitacion.id_tipohabitacion=tipo_habitacion.id
	inner join hospedaje on habitacion.id_hospedaje=hospedaje.id;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `banco`
--

CREATE TABLE IF NOT EXISTS `banco` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nit` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `numero_cuenta` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `buckup`
--

CREATE TABLE IF NOT EXISTS `buckup` (
  `id` int(10) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `ruta` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id`, `categoria`, `descripcion`) VALUES
(1, '5 ESTRELLAS', ''),
(2, '4 ESTRELLAS', ''),
(3, '3 ESTRELLAS', ''),
(4, '2 ESTRELLAS', ''),
(5, '1 ESTRELLAS', '');

-- --------------------------------------------------------

--
-- Table structure for table `citytour`
--

CREATE TABLE IF NOT EXISTS `citytour` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cupos` smallint(5) unsigned NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `precio` float unsigned NOT NULL DEFAULT '0',
  `direccion_salida` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `citytour`
--

INSERT INTO `citytour` (`id`, `cupos`, `nombre`, `precio`, `direccion_salida`, `estado`, `fecha`, `hora_inicio`, `hora_fin`) VALUES
(1, 30, 'VUELTA ORIENTE OTRA', 100000, 'CALLE 45 # 48AA - 45', b'1', '2014-03-28', '04:00:00', '10:00:00'),
(2, 33, 'RUTA EL NARCO', 50000, 'CALLE 34 # 34-56', b'1', '2014-03-20', '10:00:00', '13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cliente_externo`
--

CREATE TABLE IF NOT EXISTS `cliente_externo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `identificacion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `edad` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cliente_externo_reserva`
--

CREATE TABLE IF NOT EXISTS `cliente_externo_reserva` (
  `id_reserva` int(10) unsigned NOT NULL,
  `id_cliente_externo` int(10) unsigned NOT NULL,
  KEY `cliente_externo_reserva_id_reserva_idx` (`id_reserva`),
  KEY `cliente_externo_reserva_id_cliente_externo_idx` (`id_cliente_externo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  `id_hospedaje` int(10) unsigned DEFAULT NULL,
  `id_transporte` int(10) unsigned DEFAULT NULL,
  `id_evento` int(10) unsigned DEFAULT NULL,
  `sitio_turistico` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `contacto_id_hospedaje` (`id_hospedaje`),
  KEY `contacto_id_transporte_idx` (`id_transporte`),
  KEY `contacto_id_evento_idx` (`id_evento`),
  KEY `fk_contacto_sitio_turistico1_idx` (`sitio_turistico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `convenio`
--

CREATE TABLE IF NOT EXISTS `convenio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero_convenio` int(10) unsigned DEFAULT NULL,
  `fecha` date NOT NULL,
  `id_hospedaje` int(10) unsigned DEFAULT NULL,
  `tipo_convenio` int(10) unsigned DEFAULT NULL,
  `id_transporte` int(10) unsigned DEFAULT NULL,
  `id_sitio_turistico` int(10) unsigned DEFAULT NULL,
  `costo` float unsigned DEFAULT NULL,
  `venta` float unsigned DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` bit(1) DEFAULT b'1',
  `id_banco` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_hotel_idx` (`id_hospedaje`),
  KEY `Nit_empresa_idx` (`id_transporte`),
  KEY `id_sitio_turistico_idx` (`id_sitio_turistico`),
  KEY `convenio_banco_id_idx` (`id_banco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cuenta`
--

CREATE TABLE IF NOT EXISTS `cuenta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estado` bit(1) NOT NULL DEFAULT b'0',
  `usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `id_rol` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cuenta_id_rol_idx` (`id_rol`),
  KEY `fk_cuenta_usuario1_idx` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cuenta`
--

INSERT INTO `cuenta` (`id`, `estado`, `usuario`, `password`, `email`, `id_rol`, `id_usuario`) VALUES
(4, b'1', 'enomao', 'WVt1M04ii+boZH95WxDyKZb9jWfbnymP4fLn0lVUMF5QaS0q2XJz7eJAOl7mZI+0OazELe77ODB2Aw8J+vXFzA==', 'enomao@gmail.com', 1, 5),
(5, b'1', 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'hola', 1, 1),
(6, b'0', 'rolando', 'yOYZOocEdWF9vBJ21H323p5lMJ5prg2n2eRhbxfV1sdS+S/z0kF9yt7Dk1KrRmVqrZlllwVIeU9ObO6jkCvDqw==', 'rolando@hotmail.com', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_city_tour`
--

CREATE TABLE IF NOT EXISTS `detalle_city_tour` (
  `id_city_tour` int(10) unsigned NOT NULL,
  `id_sitio_turistico` int(10) unsigned NOT NULL,
  KEY `id_citytour_idx` (`id_city_tour`),
  KEY `id_sitio_turistico_idx` (`id_sitio_turistico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `detalle_city_tour`
--

INSERT INTO `detalle_city_tour` (`id_city_tour`, `id_sitio_turistico`) VALUES
(2, 3),
(2, 2),
(2, 1),
(1, 3),
(1, 2),
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_city_tour_guia`
--

CREATE TABLE IF NOT EXISTS `detalle_city_tour_guia` (
  `id_guia` int(10) unsigned NOT NULL,
  `id_city_tour` int(10) unsigned NOT NULL,
  KEY `detalle_city_tour_guia_id_guia_idx` (`id_guia`),
  KEY `detalle_city_tour_guia_id_city_tour_idx` (`id_city_tour`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `detalle_city_tour_guia`
--

INSERT INTO `detalle_city_tour_guia` (`id_guia`, `id_city_tour`) VALUES
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_hospedaje`
--

CREATE TABLE IF NOT EXISTS `detalle_hospedaje` (
  `id_convenio` int(10) unsigned DEFAULT NULL,
  `id_hospedaje` int(10) unsigned DEFAULT NULL,
  `costo` float unsigned DEFAULT NULL,
  `venta` float unsigned DEFAULT NULL,
  KEY `hospedaje_convenio_idx` (`id_hospedaje`),
  KEY `convenio_idx` (`id_convenio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detalle_idioma`
--

CREATE TABLE IF NOT EXISTS `detalle_idioma` (
  `id_idioma` int(10) unsigned NOT NULL,
  `id_guia_turistico` int(10) unsigned NOT NULL,
  KEY `detalle_idioma_id_idioma_idx` (`id_idioma`),
  KEY `detalle_idioma_id_guia_idx` (`id_guia_turistico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `detalle_idioma`
--

INSERT INTO `detalle_idioma` (`id_idioma`, `id_guia_turistico`) VALUES
(1, 2),
(2, 2),
(3, 2),
(1, 3),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_paquete_hospedaje`
--

CREATE TABLE IF NOT EXISTS `detalle_paquete_hospedaje` (
  `Id_paquete` int(10) unsigned NOT NULL,
  `id_habitacion_hotel` int(10) unsigned NOT NULL,
  KEY `for_dtlle_paquete_hospedaje_id_paquete` (`Id_paquete`),
  KEY `id_habitacion_hotel_idx` (`id_habitacion_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `detalle_paquete_hospedaje`
--

INSERT INTO `detalle_paquete_hospedaje` (`Id_paquete`, `id_habitacion_hotel`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_servicio_adicional`
--

CREATE TABLE IF NOT EXISTS `detalle_servicio_adicional` (
  `id_hospedaje` int(10) unsigned DEFAULT NULL,
  `id_servicio_adicional` int(10) unsigned DEFAULT NULL,
  `id_sitio_turistico` int(10) unsigned DEFAULT NULL,
  KEY `hospedaje_servicio_adicional_id_hospedaje_idx` (`id_hospedaje`),
  KEY `sitio_turistico_servicio_adicional_id_sitio_idx` (`id_sitio_turistico`),
  KEY `id_servicio_adicional_idx` (`id_servicio_adicional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `valor_compra` float unsigned NOT NULL,
  `valor_venta` float unsigned NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `cupos` smallint(5) unsigned NOT NULL,
  `lugar` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_salida` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `guia_turistico`
--

CREATE TABLE IF NOT EXISTS `guia_turistico` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `guia_turistico`
--

INSERT INTO `guia_turistico` (`id`, `identificacion`, `nombre`, `apellido`, `telefono`, `celular`, `email`, `estado`) VALUES
(2, '388393993', 'Pedro', 'Fernandez', '8883773', '7738838', 'ped@gmail.com', b'1'),
(3, '77474748', 'Felipe', 'Acevedo', '883776', '88388376', 'aced@yahoo.com', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `habitacion`
--

CREATE TABLE IF NOT EXISTS `habitacion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_hospedaje` int(10) unsigned NOT NULL,
  `id_tipohabitacion` int(10) unsigned NOT NULL,
  `comodidades` text COLLATE utf8_spanish_ci,
  `cantidad` tinyint(3) unsigned NOT NULL,
  `valor` float unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_hotel_idx` (`id_hospedaje`),
  KEY `id_tipo_habitacion_idx` (`id_tipohabitacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='	' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `habitacion`
--

INSERT INTO `habitacion` (`id`, `id_hospedaje`, `id_tipohabitacion`, `comodidades`, `cantidad`, `valor`) VALUES
(1, 1, 1, 'sillas de agua', 4, 50000),
(4, 1, 2, '', 3, 49599),
(5, 1, 7, '', 5, 23999),
(6, 1, 5, '', 56, 24799),
(7, 2, 1, 'silla del amor', 4, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `hospedaje`
--

CREATE TABLE IF NOT EXISTS `hospedaje` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nit` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `id_categoria` int(10) unsigned NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `id_categrio_idx` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hospedaje`
--

INSERT INTO `hospedaje` (`id`, `nit`, `nombre`, `direccion`, `telefono`, `descripcion`, `id_categoria`, `estado`) VALUES
(1, '453213', 'HOTEL DAN CARLTON', 'Calle 34 # 34-56', '345 45 67', ' ', 1, b'1'),
(2, '2873847832', 'Hotel Plaza', 'la calle', '29083983', '', 1, b'1'),
(3, '7687686', 'Hotel Plaza san C', 'calle la 80', '198928938', '', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `idioma`
--

CREATE TABLE IF NOT EXISTS `idioma` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `idioma`
--

INSERT INTO `idioma` (`id`, `nombre`) VALUES
(1, 'Inglés'),
(2, 'Francés'),
(3, 'Italiano'),
(4, 'Mandarín');

-- --------------------------------------------------------

--
-- Table structure for table `imagen`
--

CREATE TABLE IF NOT EXISTS `imagen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ruta` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_hospedaje` int(10) unsigned NOT NULL,
  `id_habitacion` int(10) unsigned DEFAULT NULL,
  `id_sitio_turistico` int(10) unsigned DEFAULT NULL,
  `id_pago` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foto_hopedaje_id_hospedaje_idx` (`id_hospedaje`),
  KEY `foto_habitacion_id_habitacion_idx` (`id_habitacion`),
  KEY `foto_sitio_turistico_idx` (`id_sitio_turistico`),
  KEY `imagen_pago_idx` (`id_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `novedad`
--

CREATE TABLE IF NOT EXISTS `novedad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_reserva` int(10) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reserva_idx` (`id_reserva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `id_banco` int(10) unsigned NOT NULL,
  `reserva_id` int(10) unsigned NOT NULL,
  `forma_pago` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `valor` float unsigned DEFAULT NULL COMMENT 'Es el valor que paga el cliente por la reserva o sel servicio',
  `valor_restante` float unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_banco_idx` (`id_banco`),
  KEY `fk_pago_reserva1_idx` (`reserva_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paquete`
--

CREATE TABLE IF NOT EXISTS `paquete` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_tipo` int(10) unsigned NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `id_usuario` int(10) unsigned DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  `transporte` bit(1) NOT NULL,
  `id_city_tour` int(10) unsigned DEFAULT NULL,
  `cupos` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_idx` (`id_tipo`),
  KEY `id_usuario_idx` (`id_usuario`),
  KEY `id_city_tour_idx` (`id_city_tour`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `paquete`
--

INSERT INTO `paquete` (`id`, `id_tipo`, `fecha_inicio`, `fecha_fin`, `id_usuario`, `estado`, `transporte`, `id_city_tour`, `cupos`) VALUES
(1, 2, '2014-03-02', '2014-02-03', 3, b'1', b'1', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `reserva`
--

CREATE TABLE IF NOT EXISTS `reserva` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_reserva` date NOT NULL,
  `cod_usuario` int(10) unsigned NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `modo_de_pago` bit(1) NOT NULL,
  `cantidad_adultos` smallint(5) unsigned NOT NULL,
  `cantidad_ninios` smallint(5) unsigned NOT NULL,
  `id_paquete` int(10) unsigned DEFAULT NULL,
  `estado` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'La reserva debe estar inicialmente desactivada, ya que es el administrador el que la activa una vez compruebe la valides de la misma',
  `id_hospedaje` int(10) unsigned DEFAULT NULL,
  `forma_de_pago` bit(1) NOT NULL,
  `id_evento` int(10) unsigned DEFAULT NULL,
  `id_city_tour` int(10) unsigned DEFAULT NULL,
  `valor_total` float unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_paquete_UNIQUE` (`id_paquete`),
  UNIQUE KEY `id_hospedaje_UNIQUE` (`id_hospedaje`),
  KEY `cliente_idx` (`cod_usuario`),
  KEY `id_paquete_idx` (`id_paquete`),
  KEY `id_hospedaje_idx` (`id_hospedaje`),
  KEY `id_evento_idx` (`id_evento`),
  KEY `id_city_tour_idx` (`id_city_tour`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reserva`
--

INSERT INTO `reserva` (`id`, `fecha_reserva`, `cod_usuario`, `fecha_inicio`, `fecha_fin`, `modo_de_pago`, `cantidad_adultos`, `cantidad_ninios`, `id_paquete`, `estado`, `id_hospedaje`, `forma_de_pago`, `id_evento`, `id_city_tour`, `valor_total`) VALUES
(1, '2014-02-24', 2, '2014-03-01', '2014-01-03', b'1', 1, 0, NULL, 2, NULL, b'1', NULL, 1, 250000),
(2, '2014-02-25', 1, '2014-03-02', '2014-01-07', b'1', 1, 0, NULL, 2, NULL, b'1', NULL, 1, 100000),
(3, '2014-02-28', 3, '2014-03-04', '2014-03-06', b'1', 1, 0, NULL, 1, NULL, b'1', NULL, 2, 90000),
(4, '2014-02-25', 4, '2014-03-01', '2014-03-04', b'1', 1, 0, 1, 0, NULL, b'0', NULL, NULL, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` tinyint(3) unsigned NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `nivel`, `descripcion`) VALUES
(1, 'Administrador', 5, NULL),
(2, 'Empleado', 3, NULL),
(3, 'Cliente', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `servicio_adicional`
--

CREATE TABLE IF NOT EXISTS `servicio_adicional` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `id_tipo_servicio` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_tipo_servicio_idx` (`id_tipo_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sitio_turistico`
--

CREATE TABLE IF NOT EXISTS `sitio_turistico` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `id_tipo_turismo` int(10) unsigned NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  `convenio` bit(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_turismo_idx` (`id_tipo_turismo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sitio_turistico`
--

INSERT INTO `sitio_turistico` (`id`, `nombre`, `ubicacion`, `descripcion`, `id_tipo_turismo`, `estado`, `convenio`) VALUES
(1, 'PUEBLITO PAISA', 'CALLE 34 #45-54', '', 1, b'1', b'1'),
(2, 'PARQUE EXPLORA', 'CALLE 43 # 45-34', '', 1, b'1', b'0'),
(3, 'PARQUE DE LOS DESEOS', 'CALLE 55 43 A 28', '', 1, b'1', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_habitacion`
--

CREATE TABLE IF NOT EXISTS `tipo_habitacion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Individual', ''),
(2, 'Doble', 'Este tipo de habitaciones suelen ofrecerse cuando el hotel, a falta de poder ofertar una habitación con una cama pequeña, dispone al huésped una habitación diseñada para dos personas; obviamente, al ser de mayor tamaño, su precio se eleva.'),
(3, 'Habitación doble', 'Como su nombre lo indica, esta clase de habitaciones son para dos personas. Las camas varían, pueden ser matrimoniales o dos camas individuales independientes.'),
(4, 'Con cama supletoria', 'Estas habitaciones son ideales para quienes viajan con algún menor de edad. Si bien existe un costo por la cama adicional, usualmente suele ser más barato que contratar una habitación triple. Dependiendo de la edad del niño se coloca la cama que mejor le acomode. Algunos hoteles incluso cuentan con cunas para bebés.'),
(5, 'Habitación triple', 'Simple: estas habitaciones cuentan con 3 camas, o 2 más una supletoria. Es perfecta para los viajes con tus amigos.'),
(6, 'Junior Suites', 'cuentan con habitación doble, baño y salón.'),
(7, 'Suites', 'Conocidas por ser las mejores y más lujosas habitaciones en cualquier hotel, cuentan con dos habitaciones dobles, 2 baños, salón y estancia. Por supuesto, su precio es el más elevado. Las suitse más completas y lujosas suelen recibir el nombre de Suite presidencial, y generalmente son reservadas para personajes distinguidos.'),
(8, 'Suite nupcial', 'Pensada para aquellas parejas recién casadas y que quieren disfrutar de una luna de miel con privacidad e intimidad, estas habitaciones en los lugares más exclusivos de los hoteles (generalmente acompañadas sólo por las suite presidencial). Además de una cama matrimonial amplia, generalmente cuentan con jacuzzi y una vista única.');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_paquete`
--

CREATE TABLE IF NOT EXISTS `tipo_paquete` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tipo_paquete`
--

INSERT INTO `tipo_paquete` (`id`, `descripcion`) VALUES
(1, 'Religioso'),
(2, 'Cultural'),
(3, 'Deportivo'),
(4, 'Histórico'),
(5, 'Rural');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_servicio`
--

CREATE TABLE IF NOT EXISTS `tipo_servicio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_turismo`
--

CREATE TABLE IF NOT EXISTS `tipo_turismo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tipo_turismo`
--

INSERT INTO `tipo_turismo` (`id`, `nombre`, `descripcion`) VALUES
(1, 'TURISMO RECREATIVO', 'TURISMO DE DIVERSIóN O EXPARCIMIENTO'),
(2, 'TURISMO RELIGIOSO', NULL),
(3, 'TURISMO CULTURAL', NULL),
(4, 'TURISMO DEPORTIVO', NULL),
(5, 'TURISMO DE NATURALEZA', NULL),
(6, 'TURISMO DE DIVERSIÓN', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_vehiculo`
--

CREATE TABLE IF NOT EXISTS `tipo_vehiculo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tipo_vehiculo`
--

INSERT INTO `tipo_vehiculo` (`id`, `nombre`, `descripcion`) VALUES
(1, 'BUS', NULL),
(2, 'CHIVA', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transporte`
--

CREATE TABLE IF NOT EXISTS `transporte` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nit` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `seguro_transporte` bit(1) NOT NULL,
  `estado` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `transporte`
--

INSERT INTO `transporte` (`id`, `nit`, `nombre`, `direccion`, `telefono`, `correo`, `seguro_transporte`, `estado`) VALUES
(1, '453213', 'BELLANITA', 'CALLE 34 # 34-56', '345 45 60', 'bellanita@gmail.com', b'1', b'0'),
(2, '49948338', 'COONATRA', 'CARRERA 12 #90-00', '9874538', 'coonatra@yahoo.com', b'1', b'1'),
(3, '0987352', 'COOPETRANSA', 'CALLE 23 # 45-54', '5870092', 'copetransa@gmial.com', b'1', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Se refiere a si es una persona juridica(empresa) o una persona natural',
  `identificacion` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_documento` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombres` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `tipo`, `identificacion`, `tipo_documento`, `nombres`, `apellidos`, `telefono`, `celular`, `fecha_nacimiento`) VALUES
(1, 'Natural', '10876514', 'Cédula', 'Juan Sebastian', 'Villeros', '4563214', '32010658976', '1991-03-05'),
(2, 'Natural', '87654800', 'Cédula', 'Felipe', 'Lopez', '8908765', '765432100', '1989-03-15'),
(3, 'Natural', '773883672', 'Cédula', 'Carlos', 'Andrade', '7658945', '3216789900', '1990-12-23'),
(4, '0', '1098765', 'CEDULA', 'BATIATO', 'ZATA', '234567', '34567', '1976-02-11'),
(5, '0', '3993888888', 'CEDULA', 'EMILIO', 'MENDEZ', '48859959', '4455656756', '1982-02-25'),
(6, '0', '564564564564', 'CEDULA', 'ROLANDO', 'MESA', '5678909', '2345679743', '1990-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `vehiculo`
--

CREATE TABLE IF NOT EXISTS `vehiculo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `placa` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `id_tipo_vehiculo` int(10) unsigned NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `cupo_maximo` smallint(5) unsigned NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  `id_transporte` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `matricula_UNIQUE` (`placa`),
  KEY `id_tipo_vehiculo_idx` (`id_tipo_vehiculo`),
  KEY `vehiculo_id_transporte_idx` (`id_transporte`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `vehiculo`
--

INSERT INTO `vehiculo` (`id`, `placa`, `id_tipo_vehiculo`, `descripcion`, `cupo_maximo`, `estado`, `id_transporte`) VALUES
(1, 'AB7654', 2, NULL, 7, b'1', 2),
(2, '8765GA', 2, NULL, 33, b'1', 3),
(3, '98766Z', 2, 'Es una chiva Navideña', 10, b'1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `vehiculo_citytour`
--

CREATE TABLE IF NOT EXISTS `vehiculo_citytour` (
  `vehiculo_id` int(10) unsigned NOT NULL,
  `citytour_id` int(10) unsigned NOT NULL,
  KEY `fk_vehiculo_citytour_vehiculo1_idx` (`vehiculo_id`),
  KEY `fk_vehiculo_citytour_citytour1_idx` (`citytour_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `vehiculo_citytour`
--

INSERT INTO `vehiculo_citytour` (`vehiculo_id`, `citytour_id`) VALUES
(3, 1),
(2, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cliente_externo_reserva`
--
ALTER TABLE `cliente_externo_reserva`
  ADD CONSTRAINT `cliente_externo_reserva_id_cliente_externo` FOREIGN KEY (`id_cliente_externo`) REFERENCES `cliente_externo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cliente_externo_reserva_id_reserva` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `contacto_id_evento` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `contacto_id_hospedaje` FOREIGN KEY (`id_hospedaje`) REFERENCES `hospedaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `contacto_id_transporte` FOREIGN KEY (`id_transporte`) REFERENCES `transporte` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_contacto_sitio_turistico1` FOREIGN KEY (`sitio_turistico`) REFERENCES `sitio_turistico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `convenio`
--
ALTER TABLE `convenio`
  ADD CONSTRAINT `convenio_banco_id` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_hospedaje` FOREIGN KEY (`id_hospedaje`) REFERENCES `hospedaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_sitio_turistico` FOREIGN KEY (`id_sitio_turistico`) REFERENCES `sitio_turistico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Nit_empresa` FOREIGN KEY (`id_transporte`) REFERENCES `transporte` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_id_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cuenta_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalle_city_tour`
--
ALTER TABLE `detalle_city_tour`
  ADD CONSTRAINT `detalle_city_tour_id_citytour` FOREIGN KEY (`id_city_tour`) REFERENCES `citytour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detalle_city_tour_id_sitio_turistico` FOREIGN KEY (`id_sitio_turistico`) REFERENCES `sitio_turistico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalle_city_tour_guia`
--
ALTER TABLE `detalle_city_tour_guia`
  ADD CONSTRAINT `detalle_city_tour_guia_id_city_tour` FOREIGN KEY (`id_city_tour`) REFERENCES `citytour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detalle_city_tour_guia_id_guia` FOREIGN KEY (`id_guia`) REFERENCES `guia_turistico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalle_hospedaje`
--
ALTER TABLE `detalle_hospedaje`
  ADD CONSTRAINT `convenio` FOREIGN KEY (`id_convenio`) REFERENCES `convenio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `hospedaje_convenio` FOREIGN KEY (`id_hospedaje`) REFERENCES `hospedaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalle_idioma`
--
ALTER TABLE `detalle_idioma`
  ADD CONSTRAINT `detalle_idioma_id_guia` FOREIGN KEY (`id_guia_turistico`) REFERENCES `guia_turistico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detalle_idioma_id_idioma` FOREIGN KEY (`id_idioma`) REFERENCES `idioma` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalle_paquete_hospedaje`
--
ALTER TABLE `detalle_paquete_hospedaje`
  ADD CONSTRAINT `dtlle_paquete_hospedaje_id_habitacion` FOREIGN KEY (`id_habitacion_hotel`) REFERENCES `habitacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `for_dtlle_paquete_hospedaje_id_paquete` FOREIGN KEY (`Id_paquete`) REFERENCES `paquete` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalle_servicio_adicional`
--
ALTER TABLE `detalle_servicio_adicional`
  ADD CONSTRAINT `hospedaje_servicio_adicional_id_hospedaje` FOREIGN KEY (`id_hospedaje`) REFERENCES `hospedaje` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_servicio_adicional` FOREIGN KEY (`id_servicio_adicional`) REFERENCES `servicio_adicional` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sitio_turistico_servicio_adicional_id_sitio` FOREIGN KEY (`id_sitio_turistico`) REFERENCES `sitio_turistico` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `id_hotel1` FOREIGN KEY (`id_hospedaje`) REFERENCES `hospedaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_tipo_habitacion1` FOREIGN KEY (`id_tipohabitacion`) REFERENCES `tipo_habitacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hospedaje`
--
ALTER TABLE `hospedaje`
  ADD CONSTRAINT `hospedaje_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_habitacion_id_habitacion` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `imagen_hopedaje_id_hospedaje` FOREIGN KEY (`id_hospedaje`) REFERENCES `hospedaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `imagen_pago` FOREIGN KEY (`id_pago`) REFERENCES `pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `image_sitio_turistico` FOREIGN KEY (`id_sitio_turistico`) REFERENCES `sitio_turistico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `novedad`
--
ALTER TABLE `novedad`
  ADD CONSTRAINT `reserva` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `fk_pago_reserva1` FOREIGN KEY (`reserva_id`) REFERENCES `reserva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_banco3` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paquete`
--
ALTER TABLE `paquete`
  ADD CONSTRAINT `paquete_id_city_tour` FOREIGN KEY (`id_city_tour`) REFERENCES `citytour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `paquete_id_tipo_paquete` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_paquete` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `paquete_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_cliente` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserva_id_city_tour` FOREIGN KEY (`id_city_tour`) REFERENCES `citytour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserva_id_evento` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserva_id_hospedaje` FOREIGN KEY (`id_hospedaje`) REFERENCES `habitacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserva_id_paquete` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `servicio_adicional`
--
ALTER TABLE `servicio_adicional`
  ADD CONSTRAINT `fk_id_tipo_servicio` FOREIGN KEY (`id_tipo_servicio`) REFERENCES `tipo_servicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sitio_turistico`
--
ALTER TABLE `sitio_turistico`
  ADD CONSTRAINT `sitio_turistico_id_tipo_turismo` FOREIGN KEY (`id_tipo_turismo`) REFERENCES `tipo_turismo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `id_tipo_vehiculo` FOREIGN KEY (`id_tipo_vehiculo`) REFERENCES `tipo_vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `vehiculo_id_transporte` FOREIGN KEY (`id_transporte`) REFERENCES `transporte` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vehiculo_citytour`
--
ALTER TABLE `vehiculo_citytour`
  ADD CONSTRAINT `fk_vehiculo_citytour_citytour1` FOREIGN KEY (`citytour_id`) REFERENCES `citytour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vehiculo_citytour_vehiculo1` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
