-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-08-2013 a las 16:53:30
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tracy`
--
CREATE DATABASE IF NOT EXISTS `tracy` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `tracy`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consultar_banco`(in p_nombre varchar(45))
begin
select * from banco where upper(nombre) like concat( '%',p_nombre,'%') or lower(nombre)
 like concat('%',p_nombre,'%');
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consultar_transporte`(in p_nombre varchar(45))
begin
	select * from transporte where upper(nombre) like concat( '%',p_nombre,'%') or lower(nombre)
	like concat('%',p_nombre,'%');
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_banco`(
	IN p_nit varchar(45),IN p_nombre varchar(45),IN p_direccion varchar(45),IN p_telefono varchar(20),
	IN p_numero_cuenta varchar(45)
)
begin
 insert into banco(nit, nombre, direccion, telefono,numero_cuenta)
 values(upper(p_nit),upper(p_nombre), upper(p_direccion), upper(p_telefono), upper(p_numero_cuenta));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_transporte`(
	IN p_nit varchar(45),IN p_nombre varchar(45),IN p_direccion varchar(45),IN p_telefono varchar(20),
	IN p_correo varchar(45),p_seguro_transporte BIT
)
begin
 insert into transporte(nit, nombre, direccion, telefono,correo,seguro_transporte)
 values(upper(p_nit),upper(p_nombre), upper(p_direccion), upper(p_telefono), 
		lower(p_correo),p_seguro_transporte);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificar_banco`(
	IN p_nit varchar(45),IN p_nombre varchar(45),IN p_direccion varchar(45),IN p_telefono varchar(20),
	IN p_numero_cuenta varchar(45),p_estado BIT,p_id INT
)
begin
	UPDATE banco SET nit = upper(p_nit),nombre = upper(p_nombre),
	direccion = upper(p_direccion),telefono = p_telefono,
	numero_cuenta = upper(p_numero_cuenta), estado = p_estado
	WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificar_transporte`(
	IN p_nit varchar(45),IN p_nombre varchar(45),IN p_direccion varchar(45),IN p_telefono varchar(20),
	IN p_correo varchar(45),p_seguro_transporte BIT,p_estado BIT,p_id INT
)
begin
	UPDATE transporte SET nit = upper(p_nit),nombre = upper(p_nombre),
	direccion = upper(p_direccion),telefono = p_telefono,
	correo = lower(p_correo),seguro_transporte = p_seguro_transporte, estado = p_estado
	WHERE id = p_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE IF NOT EXISTS `banco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nit` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `numero_cuenta` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `banco`
--

INSERT INTO `banco` (`id`, `nit`, `nombre`, `direccion`, `telefono`, `numero_cuenta`, `estado`) VALUES
(1, '267876', 'AV VILLAS', 'CALLE 32 #4534', '37480094', '1111110029283', b'1'),
(2, '12345678', 'BANCO POPULAR', 'PARQUE BERRIO', '7883993', NULL, b'1'),
(3, '8973651627', 'BANCO DE BOGOTÁ', 'CALLE 77 # 31-20', '3456782', NULL, b'1'),
(4, '77353628', 'BBVA', 'POBLADO CENTER', '444556677', NULL, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `city_tour`
--

CREATE TABLE IF NOT EXISTS `city_tour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `direccion_salida` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_convenio_empresa_transporte` int(11) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `id_convenio_idx` (`id_convenio_empresa_transporte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_externo`
--

CREATE TABLE IF NOT EXISTS `cliente_externo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `identificacion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `edad` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_externo_reserva`
--

CREATE TABLE IF NOT EXISTS `cliente_externo_reserva` (
  `id_reserva` int(11) NOT NULL,
  `id_cliente_externo` int(11) NOT NULL,
  KEY `cliente_externo_reserva_id_reserva_idx` (`id_reserva`),
  KEY `cliente_externo_reserva_id_cliente_externo_idx` (`id_cliente_externo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  `id_empresa_hospedaje` int(11) DEFAULT NULL,
  `id_transporte` int(11) DEFAULT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `id_city_tour` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `contacto_id_hospedaje` (`id_empresa_hospedaje`),
  KEY `contacto_id_city_tour_idx` (`id_city_tour`),
  KEY `contacto_id_transporte_idx` (`id_transporte`),
  KEY `contacto_id_evento_idx` (`id_evento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenio`
--

CREATE TABLE IF NOT EXISTS `convenio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_hospedaje` int(11) DEFAULT NULL,
  `tipo_convenio` int(11) DEFAULT NULL,
  `id_empresa_transporte` int(11) DEFAULT NULL,
  `id_sitio_turistico` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_hotel_idx` (`id_hospedaje`),
  KEY `Nit_empresa_idx` (`id_empresa_transporte`),
  KEY `id_sitio_turistico_idx` (`id_sitio_turistico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenio_banco`
--

CREATE TABLE IF NOT EXISTS `convenio_banco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor_convenio` float DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_banco` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_banco_idx` (`id_banco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE IF NOT EXISTS `cuenta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` bit(1) NOT NULL DEFAULT b'0',
  `usuario` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cuenta_id_rol_idx` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_city_tour`
--

CREATE TABLE IF NOT EXISTS `detalle_city_tour` (
  `id_city_tour` int(11) NOT NULL,
  `id_sitio_turistico` int(11) DEFAULT NULL,
  KEY `id_citytour_idx` (`id_city_tour`),
  KEY `id_sitio_turistico_idx` (`id_sitio_turistico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_city_tour_guia`
--

CREATE TABLE IF NOT EXISTS `detalle_city_tour_guia` (
  `id_guia` int(11) NOT NULL,
  `id_city_tour` int(11) NOT NULL,
  KEY `detalle_city_tour_guia_id_guia_idx` (`id_guia`),
  KEY `detalle_city_tour_guia_id_city_tour_idx` (`id_city_tour`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_convenio_hospedaje`
--

CREATE TABLE IF NOT EXISTS `detalle_convenio_hospedaje` (
  `id_convenio` int(11) NOT NULL,
  `costo` float DEFAULT NULL,
  `venta` float DEFAULT NULL,
  `cupos` int(11) DEFAULT NULL,
  `id_habitacion` int(11) NOT NULL,
  KEY `detalle_convenio_hospedaje_id_convenio` (`id_convenio`),
  KEY `detalle_convenio_id_habitacion_idx` (`id_habitacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_convenio_sitio`
--

CREATE TABLE IF NOT EXISTS `detalle_convenio_sitio` (
  `id_convenio` int(11) NOT NULL,
  `costo` float DEFAULT NULL,
  `venta` float DEFAULT NULL,
  `cupos` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` bit(1) DEFAULT NULL,
  KEY `id_convenio_idx` (`id_convenio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_convenio_trasportadora`
--

CREATE TABLE IF NOT EXISTS `detalle_convenio_trasportadora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_convenio` int(11) NOT NULL,
  `costo` float DEFAULT NULL,
  `venta` float DEFAULT NULL,
  `cupos` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_convenio` (`id_convenio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_horario`
--

CREATE TABLE IF NOT EXISTS `detalle_horario` (
  `id_sitio_turistico` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  KEY `detalle_id_sitio_turistico_idx` (`id_sitio_turistico`),
  KEY `detalle_id_horario_idx` (`id_horario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_hospedaje`
--

CREATE TABLE IF NOT EXISTS `detalle_hospedaje` (
  `id_convenio` int(11) DEFAULT NULL,
  `id_hospedaje` int(11) DEFAULT NULL,
  `costo` float DEFAULT NULL,
  `venta` float DEFAULT NULL,
  KEY `hospedaje_convenio_idx` (`id_hospedaje`),
  KEY `convenio_idx` (`id_convenio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_idioma`
--

CREATE TABLE IF NOT EXISTS `detalle_idioma` (
  `id_idioma` int(11) NOT NULL,
  `id_guia_turistico` int(11) NOT NULL,
  KEY `detalle_idioma_id_idioma_idx` (`id_idioma`),
  KEY `detalle_idioma_id_guia_idx` (`id_guia_turistico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_paquete_hospedaje`
--

CREATE TABLE IF NOT EXISTS `detalle_paquete_hospedaje` (
  `Id_paquete` int(11) NOT NULL,
  `id_habitacion_hotel` int(11) NOT NULL,
  `cupos_disponibles` smallint(6) NOT NULL,
  `venta` float NOT NULL,
  KEY `for_dtlle_paquete_hospedaje_id_paquete` (`Id_paquete`),
  KEY `id_habitacion_hotel_idx` (`id_habitacion_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_servicio_adicional`
--

CREATE TABLE IF NOT EXISTS `detalle_servicio_adicional` (
  `id_hospedaje` int(11) DEFAULT NULL,
  `id_servicio_adicional` int(11) NOT NULL,
  `id_sitio_turistico` int(11) DEFAULT NULL,
  KEY `hospedaje_servicio_adicional_id_hospedaje_idx` (`id_hospedaje`),
  KEY `sitio_turistico_servicio_adicional_id_sitio_idx` (`id_sitio_turistico`),
  KEY `id_servicio_adicional_idx` (`id_servicio_adicional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_vehiculo`
--

CREATE TABLE IF NOT EXISTS `detalle_vehiculo` (
  `id_empresa_transporte` int(11) NOT NULL,
  `id_vehiculo` int(11) DEFAULT NULL,
  KEY `id_empresa_idx` (`id_empresa_transporte`),
  KEY `id_vehiculo_idx` (`id_vehiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `valor_compra` float DEFAULT NULL,
  `valor_venta` float DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cupos` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_turistico`
--

CREATE TABLE IF NOT EXISTS `guia_turistico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE IF NOT EXISTS `habitacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_hospedaje` int(11) NOT NULL,
  `id_tipohabitacion` int(11) NOT NULL,
  `comodidades` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`),
  KEY `id_hotel_idx` (`id_hospedaje`),
  KEY `id_tipo_habitacion_idx` (`id_tipohabitacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='	' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_sitio`
--

CREATE TABLE IF NOT EXISTS `horario_sitio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `dia` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospedaje`
--

CREATE TABLE IF NOT EXISTS `hospedaje` (
  `id` int(11) NOT NULL DEFAULT '950',
  `nit` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `id_categoria` int(11) NOT NULL,
  `id_tipo_servicio` int(11) NOT NULL,
  `estado` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `id_categrio_idx` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospedaje_categoria`
--

CREATE TABLE IF NOT EXISTS `hospedaje_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idioma`
--

CREATE TABLE IF NOT EXISTS `idioma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE IF NOT EXISTS `imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_hospedaje` int(11) DEFAULT NULL,
  `id_habitacion` int(11) DEFAULT NULL,
  `id_sitio_turistico` int(11) DEFAULT NULL,
  `id_pago` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foto_hopedaje_id_hospedaje_idx` (`id_hospedaje`),
  KEY `foto_habitacion_id_habitacion_idx` (`id_habitacion`),
  KEY `foto_sitio_turistico_idx` (`id_sitio_turistico`),
  KEY `imagen_pago_idx` (`id_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedad`
--

CREATE TABLE IF NOT EXISTS `novedad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_reserva` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reserva_idx` (`id_reserva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `id_banco` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `forma_pago` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reserva_idx` (`id_reserva`),
  KEY `id_banco_idx` (`id_banco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE IF NOT EXISTS `paquete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  `id_sitio` int(11) DEFAULT NULL,
  `transporte` bit(1) NOT NULL,
  `id_city_tour` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_idx` (`id_tipo`),
  KEY `id_usuario_idx` (`id_usuario`),
  KEY `id_sitio_idx` (`id_sitio`),
  KEY `id_city_tour_idx` (`id_city_tour`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE IF NOT EXISTS `reserva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_reserva` date NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `modo_de_pago` bit(1) NOT NULL,
  `cantidad_adultos` smallint(6) NOT NULL,
  `cantidad_ninios` smallint(6) NOT NULL,
  `id_paquete` int(11) DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'0' COMMENT 'La reserva debe estar inicialmente desactivada, ya que es el administrador el que la activa una vez compruebe la valides de la misma',
  `id_hospedaje` int(11) DEFAULT NULL,
  `forma_de_pago` bit(1) NOT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `id_city_tour` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_idx` (`cod_usuario`),
  KEY `id_paquete_idx` (`id_paquete`),
  KEY `id_hospedaje_idx` (`id_hospedaje`),
  KEY `id_evento_idx` (`id_evento`),
  KEY `id_city_tour_idx` (`id_city_tour`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nivel` tinyint(4) DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_adicional`
--

CREATE TABLE IF NOT EXISTS `servicio_adicional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitio_turitico`
--

CREATE TABLE IF NOT EXISTS `sitio_turitico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `id_tipo_servicio` int(11) NOT NULL,
  `id_tipo_turismo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_turismo_idx` (`id_tipo_turismo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

CREATE TABLE IF NOT EXISTS `tipo_habitacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE utf8_spanish_ci,
  `cantidad` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_paquete`
--

CREATE TABLE IF NOT EXISTS `tipo_paquete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_turismo`
--

CREATE TABLE IF NOT EXISTS `tipo_turismo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vehiculo`
--

CREATE TABLE IF NOT EXISTS `tipo_vehiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE IF NOT EXISTS `transporte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nit` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `seguro_transporte` bit(1) DEFAULT NULL,
  `estado` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `transporte`
--

INSERT INTO `transporte` (`id`, `nit`, `nombre`, `direccion`, `telefono`, `correo`, `seguro_transporte`, `estado`) VALUES
(1, '100000', 'TRANS BELE', 'CALLE 32 SUR #43-23', '2132490', 'admin@transbeles.com', b'1', b'1'),
(2, '84763774', 'BELLANITA', 'CARRERA 102 SUR #45-566', '95839337', 'admin@bello.com', b'1', b'1'),
(3, '123456', 'COONATRA', 'AV 32 #23-354', '32456', 'coonatra@conatra.com', b'1', b'1'),
(4, '6668765', 'BOLIVARIANO', 'AV 45 #45-32', '4015490', 'bolivariano@gmail.com', b'1', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuenta` int(11) NOT NULL,
  `identificacion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_documento` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Se refiere a si es una persona juridica(empresa) o una persona natural',
  PRIMARY KEY (`id`),
  KEY `persona_id_cuenta_idx` (`id_cuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE IF NOT EXISTS `vehiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `id_tipo_vehiculo` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `cupo_maximo` smallint(6) NOT NULL,
  `estado` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `id_tipo_vehiculo_idx` (`id_tipo_vehiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `city_tour`
--
ALTER TABLE `city_tour`
  ADD CONSTRAINT `city_tour_id_convenio_transportadora` FOREIGN KEY (`id_convenio_empresa_transporte`) REFERENCES `detalle_convenio_trasportadora` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cliente_externo_reserva`
--
ALTER TABLE `cliente_externo_reserva`
  ADD CONSTRAINT `cliente_externo_reserva_id_cliente_externo` FOREIGN KEY (`id_cliente_externo`) REFERENCES `cliente_externo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cliente_externo_reserva_id_reserva` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `contacto_id_city_tour` FOREIGN KEY (`id_city_tour`) REFERENCES `city_tour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `contacto_id_evento` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `contacto_id_hospedaje` FOREIGN KEY (`id_empresa_hospedaje`) REFERENCES `hospedaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `contacto_id_transporte` FOREIGN KEY (`id_transporte`) REFERENCES `transporte` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `convenio`
--
ALTER TABLE `convenio`
  ADD CONSTRAINT `id_hospedaje` FOREIGN KEY (`id_hospedaje`) REFERENCES `hospedaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_sitio_turistico` FOREIGN KEY (`id_sitio_turistico`) REFERENCES `sitio_turitico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Nit_empresa` FOREIGN KEY (`id_empresa_transporte`) REFERENCES `transporte` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `convenio_banco`
--
ALTER TABLE `convenio_banco`
  ADD CONSTRAINT `id_banco` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_id_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_city_tour`
--
ALTER TABLE `detalle_city_tour`
  ADD CONSTRAINT `detalle_city_tour_id_citytour` FOREIGN KEY (`id_city_tour`) REFERENCES `city_tour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detalle_city_tour_id_sitio_turistico` FOREIGN KEY (`id_sitio_turistico`) REFERENCES `sitio_turitico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_city_tour_guia`
--
ALTER TABLE `detalle_city_tour_guia`
  ADD CONSTRAINT `detalle_city_tour_guia_id_city_tour` FOREIGN KEY (`id_city_tour`) REFERENCES `city_tour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detalle_city_tour_guia_id_guia` FOREIGN KEY (`id_guia`) REFERENCES `guia_turistico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_convenio_hospedaje`
--
ALTER TABLE `detalle_convenio_hospedaje`
  ADD CONSTRAINT `detalle_convenio_hospedaje_id_convenio` FOREIGN KEY (`id_convenio`) REFERENCES `convenio` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_convenio_id_habitacion` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_convenio_sitio`
--
ALTER TABLE `detalle_convenio_sitio`
  ADD CONSTRAINT `detalle_convenio_sitio_id_convenio` FOREIGN KEY (`id_convenio`) REFERENCES `convenio` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_convenio_trasportadora`
--
ALTER TABLE `detalle_convenio_trasportadora`
  ADD CONSTRAINT `id_convenio` FOREIGN KEY (`id_convenio`) REFERENCES `convenio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_horario`
--
ALTER TABLE `detalle_horario`
  ADD CONSTRAINT `detalle_id_horario` FOREIGN KEY (`id_horario`) REFERENCES `horario_sitio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detalle_id_sitio_turistico` FOREIGN KEY (`id_sitio_turistico`) REFERENCES `sitio_turitico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_hospedaje`
--
ALTER TABLE `detalle_hospedaje`
  ADD CONSTRAINT `convenio` FOREIGN KEY (`id_convenio`) REFERENCES `convenio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `hospedaje_convenio` FOREIGN KEY (`id_hospedaje`) REFERENCES `hospedaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_idioma`
--
ALTER TABLE `detalle_idioma`
  ADD CONSTRAINT `detalle_idioma_id_guia` FOREIGN KEY (`id_guia_turistico`) REFERENCES `guia_turistico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detalle_idioma_id_idioma` FOREIGN KEY (`id_idioma`) REFERENCES `idioma` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_paquete_hospedaje`
--
ALTER TABLE `detalle_paquete_hospedaje`
  ADD CONSTRAINT `dtlle_paquete_hospedaje_id_habitacion` FOREIGN KEY (`id_habitacion_hotel`) REFERENCES `habitacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `for_dtlle_paquete_hospedaje_id_paquete` FOREIGN KEY (`Id_paquete`) REFERENCES `paquete` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_servicio_adicional`
--
ALTER TABLE `detalle_servicio_adicional`
  ADD CONSTRAINT `hospedaje_servicio_adicional_id_hospedaje` FOREIGN KEY (`id_hospedaje`) REFERENCES `hospedaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_servicio_adicional` FOREIGN KEY (`id_servicio_adicional`) REFERENCES `servicio_adicional` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sitio_turistico_servicio_adicional_id_sitio` FOREIGN KEY (`id_sitio_turistico`) REFERENCES `sitio_turitico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_vehiculo`
--
ALTER TABLE `detalle_vehiculo`
  ADD CONSTRAINT `detalle_vehiculo_id_empresa` FOREIGN KEY (`id_empresa_transporte`) REFERENCES `transporte` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detalle_vehiculo_id_vehiculo` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `id_hotel1` FOREIGN KEY (`id_hospedaje`) REFERENCES `hospedaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_tipo_habitacion1` FOREIGN KEY (`id_tipohabitacion`) REFERENCES `tipo_habitacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hospedaje`
--
ALTER TABLE `hospedaje`
  ADD CONSTRAINT `hospedaje_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `hospedaje_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_habitacion_id_habitacion` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `imagen_hopedaje_id_hospedaje` FOREIGN KEY (`id_hospedaje`) REFERENCES `hospedaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `imagen_pago` FOREIGN KEY (`id_pago`) REFERENCES `pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `image_sitio_turistico` FOREIGN KEY (`id_sitio_turistico`) REFERENCES `sitio_turitico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `novedad`
--
ALTER TABLE `novedad`
  ADD CONSTRAINT `reserva` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `id_banco3` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reserva3` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD CONSTRAINT `paquete_id_city_tour` FOREIGN KEY (`id_city_tour`) REFERENCES `city_tour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `paquete_id_sitio_turistico` FOREIGN KEY (`id_sitio`) REFERENCES `sitio_turitico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `paquete_id_tipo_paquete` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_paquete` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `paquete_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_cliente` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserva_id_city_tour` FOREIGN KEY (`id_city_tour`) REFERENCES `city_tour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserva_id_evento` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserva_id_hospedaje` FOREIGN KEY (`id_hospedaje`) REFERENCES `habitacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserva_id_paquete` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sitio_turitico`
--
ALTER TABLE `sitio_turitico`
  ADD CONSTRAINT `sitio_turistico_id_tipo_turismo` FOREIGN KEY (`id_tipo_turismo`) REFERENCES `tipo_turismo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_id_cuenta` FOREIGN KEY (`id_cuenta`) REFERENCES `cuenta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `id_tipo_vehiculo` FOREIGN KEY (`id_tipo_vehiculo`) REFERENCES `tipo_vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
