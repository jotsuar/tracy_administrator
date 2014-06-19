-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 24, 2014 at 11:12 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `cliente_reserva`()
begin
select usuario.identificacion,
			usuario.nombres,
			usuario.tipo_documento,
			usuario.apellidos,
			usuario.tipo,
			reserva.id,
			reserva.id_paquete,
			reserva.id_hospedaje,
			reserva.id_evento,
			reserva.id_city_tour,
			hospedaje.nombre as hospedaje,
			evento.nombre as evento,
			citytour.nombre as city
from usuario
inner join reserva on reserva.cod_usuario= usuario.id
cross join hospedaje 
cross join evento 
cross join citytour 
group by usuario.id;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_vehiculo`(in p_placa varchar(45), p_id_transporte INT)
begin

	IF p_id_transporte != 0 THEN
		select vehiculo.id, transporte.nombre as empresa, vehiculo.placa, tipo_vehiculo.nombre as tipo, vehiculo.descripcion,
		vehiculo.cupo_maximo, vehiculo.estado
		from vehiculo 
		inner join transporte on vehiculo.id_transporte = transporte.id
		inner join tipo_vehiculo on  vehiculo.id_tipo_vehiculo = tipo_vehiculo.id
		where transporte.id = p_id_transporte;
	ELSE
		select vehiculo.id, transporte.nombre as empresa, vehiculo.placa, tipo_vehiculo.nombre as tipo, vehiculo.descripcion,
		vehiculo.cupo_maximo, vehiculo.estado
		from vehiculo 
		inner join transporte on vehiculo.id_transporte = transporte.id
		inner join tipo_vehiculo on  vehiculo.id_tipo_vehiculo = tipo_vehiculo.id
		where upper(vehiculo.placa) like concat( '%', p_placa, '%');
	END IF;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_transporte`(
	IN p_nit varchar(45), 
	IN p_nombre varchar(45), 
	IN p_direccion varchar(45),
	IN p_telefono varchar(20), 
	IN p_correo varchar(45), 
	IN p_seguro_transporte BIT
)
BEGIN
 INSERT INTO transporte(nit, nombre, direccion, telefono, correo, seguro_transporte)
 VALUES(UPPER(p_nit), UPPER(p_nombre), UPPER(p_direccion), p_telefono, LOWER(p_correo), p_seguro_transporte);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_vehiculo`(
	p_placa varchar(45), 
	p_id_tipo_vehiculo int, 
	p_descripcion text, 
	p_cupo int, 
	p_id_transporte INT,
	p_estado INT,
	p_id INT
)
begin
	UPDATE vehiculo SET placa = p_placa, id_tipo_vehiculo = p_id_tipo_vehiculo, descripcion = p_descripcion,
	cupo_maximo = p_cupo, id_transporte = p_id_transporte, estado = p_estado
	WHERE id = p_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search_vehicle`(in p_id INT)
begin
	select vehiculo.id, transporte.nombre as empresa, vehiculo.placa, tipo_vehiculo.nombre as tipo, vehiculo.descripcion,
	vehiculo.cupo_maximo, vehiculo.estado
	from vehiculo 
	inner join transporte on vehiculo.id_transporte = transporte.id
	inner join tipo_vehiculo on  vehiculo.id_tipo_vehiculo = tipo_vehiculo.id
	where vehiculo.id = p_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `see_all_vehicles`()
begin
	select vehiculo.id, transporte.nombre as empresa, 
	vehiculo.placa, tipo_vehiculo.nombre as tipo, vehiculo.descripcion,
	vehiculo.cupo_maximo, vehiculo.estado
	from vehiculo 
	inner join transporte on vehiculo.id_transporte = transporte.id
	inner join tipo_vehiculo on  vehiculo.id_tipo_vehiculo = tipo_vehiculo.id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sitio_turistico_register`(
	p_nombre VARCHAR(45), 
	p_ubicacion VARCHAR(45), 
	p_descripcion TEXT, 
	p_id_tipo_turismo INT,
	p_convenio BIT
)
BEGIN
	INSERT INTO sitio_turistico(nombre, ubicacion, descripcion, id_tipo_turismo, convenio)
	VALUES(upper(p_nombre), upper(p_ubicacion), p_descripcion, p_id_tipo_turismo, p_convenio);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sitio_turistico_update`(
	p_id INT,
	p_nombre VARCHAR(45), 
	p_ubicacion VARCHAR(45), 
	p_descripcion TEXT, 
	p_id_tipo_turismo INT,
	p_convenio BIT,
	p_estado BIT
)
BEGIN
	UPDATE sitio_turistico 
	SET nombre = p_nombre, ubicacion = p_ubicacion, descripcion = p_descripcion, 
	id_tipo_turismo = p_id_tipo_turismo, convenio = p_convenio, estado = p_estado
	WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_cliente`(
p_id int,p_identificacion varchar(15),
	p_tipo varchar(15), p_nombre varchar(45), p_apellido varchar (45),
	p_telefono varchar (15), p_celular varchar (15),p_fecha date, p_correo varchar(45)
)
begin
	update usuario
	set identificacion	=	p_identificacion,
	tipo_documento		=	p_tipo,
	nombres				=	p_nombre,
	apellidos			=	p_apellido,
	telefono			=	p_telefono,
	celular				=	p_celular,
	fecha_nacimiento	=	p_fecha,
	email				=	p_correo
	where id			=	p_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_cuenta_usuario`(
	p_usuario varchar(30),
	p_password varchar(30),
	p_id_user int,
	p_estado bit
)
begin 

update cuenta
	set usuario			=	p_usuario,
	password			=	p_password,
	estado				=	p_estado
	where id_usuario	=	p_id_user;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_empleado`(
	p_id int,p_identificacion varchar(15),
	p_tipo varchar(15), p_nombre varchar(45), p_apellido varchar (45),
	p_telefono varchar (15), p_celular varchar(20) , p_correo varchar(45)
)
begin
	update usuario
	set identificacion	=	p_identificacion,
	tipo_documento		=	p_tipo,
	nombres				=	p_nombre,
	apellidos			=	p_apellido,
	telefono			=	p_telefono,
	celular				=	p_celular,
	email				=	p_correo
	where id=p_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_buscar_servicio`(p_id int)
begin
	select servicio_adicional.id, servicio_adicional.nombre, servicio_adicional.descripcion,
	tipo_servicio.nombre as "nombres" from servicio_adicional
	inner join tipo_servicio on servicio_adicional.tipo_servicio_id = tipo_servicio.id 
	where servicio_adicional.id = p_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consultar_evento`(in p_nombre varchar(45))
begin
	select * from evento where upper(nombre) like concat( '%',p_nombre,'%') or lower(nombre)
	like concat('%',p_nombre,'%');
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consultar_habitacion`()
begin
select habitacion.id, habitacion.comodidades,habitacion.cantidad,habitacion.valor,
tipo_habitacion.nombre as "tipo",
hospedaje.nombre as hospedaje
from habitacion 
inner join tipo_habitacion on habitacion.id_tipohabitacion=tipo_habitacion.id
inner join hospedaje on habitacion.id_hospedaje=hospedaje.id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consultar_habitaciones_paquete`(p_fecha_inicio date , p_fecha_fin date)
begin
	SELECT habitacion.id, habitacion.comodidades, detalle_paquete_hospedaje.id_habitacion_hotel,
	hospedaje.nombre as hospedaje,
	tipo_habitacion.nombre as tipo
	FROM habitacion 
	LEFT JOIN detalle_paquete_hospedaje  ON habitacion.id = detalle_paquete_hospedaje.id_habitacion_hotel
	inner join tipo_habitacion on tipo_habitacion.id=habitacion.id_tipohabitacion
	inner join hospedaje on habitacion.id_hospedaje = hospedaje.id
	inner join convenio on convenio.id_hospedaje= hospedaje.id
	WHERE detalle_paquete_hospedaje.id_habitacion_hotel IS NULL
	and convenio.fecha_inicio <= p_fecha_inicio and convenio.fecha_fin >= p_fecha_fin
	UNION
	SELECT habitacion.id, habitacion.comodidades, detalle_paquete_hospedaje.id_habitacion_hotel,hospedaje.nombre as hospedaje
	,tipo_habitacion.nombre as tipo FROM habitacion 
	inner join hospedaje on habitacion.id_hospedaje = hospedaje.id
	inner join tipo_habitacion on tipo_habitacion.id=habitacion.id_tipohabitacion
	inner join convenio on convenio.id_hospedaje= hospedaje.id
	INNER JOIN detalle_paquete_hospedaje  ON habitacion.id = detalle_paquete_hospedaje.id_habitacion_hotel
	INNER JOIN paquete ON detalle_paquete_hospedaje.id_paquete = paquete.id
	and convenio.fecha_inicio <= p_fecha_inicio and convenio.fecha_fin >= p_fecha_fin
	AND paquete.fecha_fin < p_fecha_inicio;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consultar_paquetes`()
begin

select paquete.id, 
		tipo_paquete.descripcion,paquete.fecha_inicio, paquete.fecha_fin, 
		if (paquete.id_evento is null, "No contiene" ,evento.nombre) Evento,
		if (paquete.id_city_tour is null, "No contiene" ,citytour.nombre) Citytour,
		if(paquete.transporte = 1 , "Contiene", "No contiene") Transporte,
		 usuario.identificacion "Creador", paquete.cupos, paquete.estado
from paquete
inner join evento on paquete.id_evento=evento.id
INNER JOIN tipo_paquete
on paquete.id = tipo_paquete.id
inner join citytour on paquete.id_city_tour=citytour.id
inner join usuario on paquete.id_usuario=usuario.id;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consultar_paquetes_2`(p_id int)
begin

select paquete.id, 
		tipo_paquete.descripcion,paquete.fecha_inicio, paquete.fecha_fin, 
		if (paquete.id_evento is null, "No contiene" ,evento.nombre) Evento,
		if (paquete.id_city_tour is null, "No contiene" ,citytour.nombre) Citytour,
		if(paquete.transporte = 1 , "Contiene", "No contiene") Transporte,
		 usuario.identificacion "Creador", paquete.cupos, paquete.estado
from paquete
inner join evento on paquete.id_evento=evento.id
INNER JOIN tipo_paquete
on paquete.id = tipo_paquete.id
inner join citytour on paquete.id_city_tour=citytour.id
inner join usuario on paquete.id_usuario=usuario.id
where paquete.id= p_id;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consultar_transporte`(in p_nombre varchar(45))
begin
	select * from transporte where upper(nombre) like concat( '%',p_nombre,'%') or lower(nombre)
	like concat('%',p_nombre,'%');
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consultar_usuario_cliente`(p_parametro varchar(45))
begin
	select * from usuario where
	(upper(nombres) like concat('%',p_parametro,'%') or
	lower(nombres) like concat('%',p_parametro,'%') or
	upper(apellidos) like concat('%',p_parametro,'%') or
	lower(apellidos) like concat('%',p_parametro,'%') or
	identificacion like concat('%',p_parametro,'%')) and tipo = 'Persona Natural';
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consultas_tipo_vehiculo`()
begin
select *from tipo_vehiculo ;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_banco`(
	IN p_nit varchar(45),IN p_nombre varchar(45),IN p_direccion varchar(45),IN p_telefono varchar(20),
	IN p_numero_cuenta varchar(45)
)
begin
 insert into banco(nit, nombre, direccion, telefono,numero_cuenta)
 values(upper(p_nit),upper(p_nombre), upper(p_direccion), upper(p_telefono), upper(p_numero_cuenta));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_cliente`(
	p_identificacion varchar(15), p_tipo varchar(15), p_nombre varchar(45), 
	p_apellido varchar (45), p_telefono varchar (15), p_celular varchar (15),
	p_fecha date, p_correo varchar(45)
)
BEGIN
	insert into usuario(
		identificacion, tipo_documento,	nombres, apellidos, 
		telefono,celular,fecha_nacimiento,email,tipo
	) 
	values (p_identificacion,p_tipo,p_nombre,p_apellido,
	p_telefono,p_celular,p_fecha,p_correo,'Persona Natural');
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_cuenta_usuario`(
	p_usuario varchar(30),
	p_password varchar(30),
	id_rol int,
	p_id_user int
)
begin
	insert into cuenta (usuario, password, id_rol, id_usuario)
	values (p_usuario,sha1(p_password),id_rol,p_id_user);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_empleado`(
	p_identificacion varchar(15),
	p_tipo varchar(15), p_nombre varchar(45), p_apellido varchar (45),
	p_telefono varchar (15), p_celular varchar (15), p_correo varchar(45)
)
begin
	insert into usuario(
		identificacion,
		tipo_documento,
		nombres,apellidos,
		telefono,celular,email,tipo
	) 
	values (p_identificacion,p_tipo,p_nombre,p_apellido,
	p_telefono,p_celular,p_correo,'empleado');
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_empresa_transporte`(p_id int,p_nombre varchar(45))
begin
	insert into trasnporte (id,nombre)
	values (p_id,p_nombre);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_evento`(
	IN p_nombre varchar(45),
	IN p_descripcion text,
	IN p_valor_compra float,
	IN p_valor_venta float,
	IN p_direccion varchar(45),
	iN p_cupos smallint(6),
	IN p_lugar varchar(45),
	IN p_fecha_inicio date,
	In p_fecha_fin date,
	IN p_hora_inicio time,
	IN p_hora_salida time
)
begin
 insert into evento(nombre, descripcion, valor_compra, valor_venta, direccion, cupos, lugar, fecha_inicio, fecha_fin, hora_inicio, hora_salida)
 values(upper(p_nombre), p_descripcion, p_valor_compra, p_valor_venta,  p_direccion, p_cupos, upper(p_lugar), p_fecha_inicio, p_fecha_fin, p_hora_inicio, p_hora_salida);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_tipo_vehiculo`(IN p_nombre varchar(45), IN p_descripcion TEXT)
BEGIN
	INSERT INTO tipo_vehiculo(nombre, descripcion)
	VALUES(UPPER(p_nombre), p_descripcion);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_vehiculo`(
	p_placa varchar(45), 
	p_id_tipo_vehiculo int, 
	p_descripcion text, 
	p_cupo int, 
	p_id_transporte INT
)
begin
	insert into vehiculo(placa, id_tipo_vehiculo, descripcion, cupo_maximo, id_transporte) 
	values (p_placa, p_id_tipo_vehiculo, p_descripcion, p_cupo, p_id_transporte);
end$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificar_servicio`(
	p_nombre varchar(45), p_desc text, p_tipo int, p_id int
)
begin
	update servicio_adicional
	set nombre			=	p_nombre,
	descripcion			=	p_desc,
	tipo_servicio_id	=	p_tipo
	where id			=	p_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificar_tipo_vehiculo`(
p_id INT, IN p_nombre varchar(45), p_descripcion TEXT)
BEGIN	
	UPDATE tipo_vehiculo SET nombre = upper(p_nombre), descripcion = p_descripcion WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificar_transporte`(
	IN p_id INT, IN p_nit varchar(45), IN p_nombre varchar(45), IN p_direccion varchar(45), IN p_telefono varchar(20),
	IN p_correo varchar(45), IN p_seguro_transporte BIT, IN p_estado BIT
)
begin
	UPDATE transporte SET nit = upper(p_nit), nombre = upper(p_nombre),	direccion = upper(p_direccion),
	telefono = p_telefono, correo = lower(p_correo), seguro_transporte = p_seguro_transporte, estado = p_estado
	WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_servicio_adicional`(
	p_nombre varchar(30)
)
begin 
	select servicio_adicional.id, servicio_adicional.nombre, servicio_adicional.descripcion,
	tipo_servicio.nombre as "nombres" from servicio_adicional
	inner join tipo_servicio 
	on servicio_adicional.tipo_servicio_id = tipo_servicio.id
	where upper(servicio_adicional.nombre) like concat('%',p_nombre,'%') or
	lower(servicio_adicional.nombre) like concat('%',p_nombre,'%') 
	or servicio_adicional.tipo_servicio_id = 5p_nombre;
end$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `fc_validar_servicio`(p_nombre varchar(45), p_tipo int) RETURNS int(11)
begin 
	declare res int;
	if (exists (select * from servicio_adicional 
		where upper(nombre) like concat('%',p_nombre,'%') or
	    lower(nombre) like concat('%',p_nombre,'%'))) then
		set res = 1;
	else 
		 set res = 0;
	end if;
return res;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `banco`
--

INSERT INTO `banco` (`id`, `nit`, `nombre`, `direccion`, `telefono`, `numero_cuenta`, `estado`) VALUES
(1, '267876', 'AV VILLAS', 'CALLE 32 #4534', '37480094', '45884774', b'1'),
(2, '12345678', 'BANCO POPULAR', 'PARQUE BERRIO', '7883993', '86254168', b'1'),
(3, '8973651627', 'BANCO DE BOGOTÁ', 'CALLE 77 # 31-20', '3456782', '985004978', b'1'),
(4, '77353628', 'BBVA', 'POBLADO CENTER', '444556677', '2039039030', b'1'),
(5, '267876', 'AV VILLAS', 'CALLE 32 #4534', '37480094', '88837654', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `buckup`
--

CREATE TABLE IF NOT EXISTS `buckup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `ruta` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `buckup`
--

INSERT INTO `buckup` (`id`, `fecha`, `ruta`) VALUES
(3, '2014-02-01', './public/buckup/copia-01-02-2014-3-17-51-pm.zip'),
(4, '2014-02-01', './public/buckup/copia-01-02-2014-3-22-05-pm.zip'),
(5, '2014-02-24', './public/buckup/copia-24-02-2014-9-44-01-am.zip');

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
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `direccion_salida` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  `nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `cupos` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `citytour`
--

INSERT INTO `citytour` (`id`, `fecha`, `hora_inicio`, `hora_fin`, `direccion_salida`, `estado`, `nombre`, `precio`, `cupos`) VALUES
(1, '2014-03-06', '14:00:00', '20:00:00', 'CARRERA 50 #58-67', b'1', 'LA CALLE DEL TERROR', 250000, 30),
(2, '2014-03-07', '17:03:00', '07:00:00', 'Calle 33 #567-576', b'1', 'El amor fluye', 100000, 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contacto`
--

INSERT INTO `contacto` (`codigo`, `identificacion`, `nombres`, `apellidos`, `celular`, `email`, `estado`, `id_hospedaje`, `id_transporte`, `id_evento`, `sitio_turistico`) VALUES
(1, '10351234552', 'jhonatan', 'suarez', '30018338389', 'jotver_01@hotmail.ar', b'1', NULL, NULL, 1, NULL),
(2, '98989898', 'Camilo Andres', 'Morientes', '30018338389', 'jotver_01@hotmail.com', b'1', NULL, 1, NULL, NULL),
(3, '111111', 'Diego Leon', 'Carmona', '30309309', 'diego@tupapito.com', b'1', 1, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `convenio`
--

INSERT INTO `convenio` (`id`, `numero_convenio`, `fecha`, `id_hospedaje`, `tipo_convenio`, `id_transporte`, `id_sitio_turistico`, `costo`, `venta`, `fecha_inicio`, `fecha_fin`, `estado`, `id_banco`) VALUES
(1, 4294967295, '2013-11-25', NULL, 3, NULL, 3, 55555, 99999, '2013-11-25', '2014-07-17', b'1', NULL),
(2, 454545, '2013-11-25', NULL, 3, NULL, 1, 3333, 3333, '2014-03-07', '2014-09-25', b'1', NULL),
(3, 454545, '2013-11-25', NULL, 3, NULL, 1, 3333, 3333, '2013-11-07', '2013-11-25', b'1', NULL),
(4, 4294967295, '2013-11-28', 1, 1, NULL, NULL, 2222, 3939390, '2014-03-07', '2014-09-30', b'1', NULL),
(5, 272989289, '2013-12-03', 2, 1, NULL, NULL, 130303, 300001, '2014-03-07', '2014-09-22', b'1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cuenta`
--

CREATE TABLE IF NOT EXISTS `cuenta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estado` bit(1) NOT NULL DEFAULT b'0',
  `usuario` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_rol` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cuenta_id_rol_idx` (`id_rol`),
  KEY `fk_cuenta_usuario1_idx` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cuenta`
--

INSERT INTO `cuenta` (`id`, `estado`, `usuario`, `password`, `id_rol`, `id_usuario`) VALUES
(1, b'1', 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, 1),
(2, b'0', 'jotver_01@hotmail.com', '1020462279', 3, 2);

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
(1, 2),
(1, 3);

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
(2, 1);

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
(1, 1),
(1, 4);

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

--
-- Dumping data for table `detalle_servicio_adicional`
--

INSERT INTO `detalle_servicio_adicional` (`id_hospedaje`, `id_servicio_adicional`, `id_sitio_turistico`) VALUES
(1, 1, NULL),
(NULL, 9, 3),
(NULL, 7, 3),
(NULL, 8, 3),
(NULL, 9, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `evento`
--

INSERT INTO `evento` (`id`, `nombre`, `descripcion`, `valor_compra`, `valor_venta`, `direccion`, `cupos`, `lugar`, `fecha_inicio`, `fecha_fin`, `hora_inicio`, `hora_salida`) VALUES
(1, 'Concierto Don omar', 'Gran concierto de regueton', 20000, 30000, 'Calle 200 carrera 20000', 35, 'Plaza de toros la macarena', '2014-03-07', '2014-09-23', '10:32:48', '10:32:48');

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
  `valor` float DEFAULT NULL,
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
  `id_reserva` int(10) unsigned NOT NULL,
  `forma_pago` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `valor` float unsigned DEFAULT NULL,
  `valor_restante` float unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reserva_idx` (`id_reserva`),
  KEY `id_banco_idx` (`id_banco`)
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
  `id_sitio` int(10) unsigned DEFAULT NULL,
  `transporte` bit(1) NOT NULL,
  `id_city_tour` int(10) unsigned DEFAULT NULL,
  `id_evento` int(10) unsigned DEFAULT NULL,
  `cupos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_idx` (`id_tipo`),
  KEY `id_usuario_idx` (`id_usuario`),
  KEY `id_sitio_idx` (`id_sitio`),
  KEY `id_city_tour_idx` (`id_city_tour`),
  KEY `evento_paquete` (`id_evento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `paquete`
--

INSERT INTO `paquete` (`id`, `id_tipo`, `fecha_inicio`, `fecha_fin`, `id_usuario`, `estado`, `id_sitio`, `transporte`, `id_city_tour`, `id_evento`, `cupos`) VALUES
(1, 1, '2014-03-08', '2014-05-09', 1, b'1', NULL, b'1', 1, 1, 20);

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
  `estado` bit(1) NOT NULL DEFAULT b'0' COMMENT 'La reserva debe estar inicialmente desactivada, ya que es el administrador el que la activa una vez compruebe la valides de la misma',
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `reserva`
--

INSERT INTO `reserva` (`id`, `fecha_reserva`, `cod_usuario`, `fecha_inicio`, `fecha_fin`, `modo_de_pago`, `cantidad_adultos`, `cantidad_ninios`, `id_paquete`, `estado`, `id_hospedaje`, `forma_de_pago`, `id_evento`, `id_city_tour`, `valor_total`) VALUES
(1, '2013-11-26', 2, '2013-11-27', '2013-11-27', b'1', 1, 0, NULL, b'0', 1, b'1', NULL, NULL, 2020200),
(6, '2014-02-24', 2, '2014-03-01', '2014-01-03', b'1', 1, 0, NULL, b'1', NULL, b'1', NULL, 1, 250000),
(7, '2014-02-25', 1, '2014-03-02', '2014-01-07', b'1', 1, 0, NULL, b'1', NULL, b'1', NULL, 1, 100000),
(8, '2014-02-28', 2, '2014-03-04', '2014-03-06', b'1', 1, 0, NULL, b'1', NULL, b'1', NULL, 2, 90000),
(9, '2014-02-25', 2, '2014-03-01', '2014-03-04', b'1', 1, 0, 1, b'0', NULL, b'0', NULL, NULL, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` tinyint(3) unsigned NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `nivel`, `descripcion`) VALUES
(1, 'administrador', 5, 'Dueño del software'),
(2, 'empleado', 3, 'Empleado con restricciones'),
(3, 'cliente', 1, 'Cliente de la empresa');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `servicio_adicional`
--

INSERT INTO `servicio_adicional` (`id`, `nombre`, `descripcion`, `id_tipo_servicio`) VALUES
(1, 'RESTAURANTE', NULL, 1),
(2, 'RESTAURANTE', '', 1),
(3, 'INTERNET GRATIS', NULL, 1),
(4, 'SALA DE REUNIONES', NULL, 1),
(5, 'GIMNASIO', '', 1),
(6, 'PISCINA', NULL, 1),
(7, 'VISTA A LA CIUDAD', NULL, 2),
(8, 'ASCENSOR', '', 2),
(9, 'OTRO', NULL, 2);

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
(1, 'PUEBLITO PAISA', 'CERRO NUTIBARA', '                                                            ', 2, b'0', b'1'),
(2, 'IGLESIA CANDELARIA', 'MEDELLÍN', '            ', 4, b'1', b'1'),
(3, 'PARQUE LAS CHIMENEAS', 'ITAGÜÍ', '   ', 3, b'1', b'1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tipo_paquete`
--

INSERT INTO `tipo_paquete` (`id`, `descripcion`) VALUES
(1, 'Vacacional'),
(8, 'Gimnacio');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_servicio`
--

CREATE TABLE IF NOT EXISTS `tipo_servicio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tipo_servicio`
--

INSERT INTO `tipo_servicio` (`id`, `nombre`) VALUES
(1, 'Hospedaje'),
(2, 'Sitio turístico');

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
(1, 'TURISMO CULTURAL', ''),
(2, 'TURISMO DEPORTIVO', NULL),
(3, 'TURISMO DE DIVERSIÓN', NULL),
(4, 'TURISMO RELIGIOSO', NULL),
(5, 'TURISMO DE SALUD', NULL),
(6, 'TURISMO DE NATURALEZA', NULL);

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
(1, 'BUS', ''),
(2, 'CHIVA', '');

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
  `identificacion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_documento` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Se refiere a si es una persona juridica(empresa) o una persona natural',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `identificacion`, `tipo_documento`, `nombres`, `apellidos`, `telefono`, `celular`, `fecha_nacimiento`, `email`, `tipo`) VALUES
(1, '927829892', 'CC', 'Luis', 'Vargas', '198928938', '3982982982', '1993-06-12', 'luis_vargas@gmail.co', 'Empleado'),
(2, '1020462279', 'CC', 'jhonatan', 'suarez', '3333333333', '30018338389', '1994-08-14', 'jotver_01@hotmail.com', 'Persona Natural');

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
(1, 'AB7654', 2, '', 7, b'1', 2),
(2, '8765GA', 2, '', 33, b'1', 3),
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
(1, 1);

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
  ADD CONSTRAINT `id_banco3` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reserva3` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paquete`
--
ALTER TABLE `paquete`
  ADD CONSTRAINT `evento_paquete` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`),
  ADD CONSTRAINT `paquete_id_city_tour` FOREIGN KEY (`id_city_tour`) REFERENCES `citytour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `paquete_id_sitio_turistico` FOREIGN KEY (`id_sitio`) REFERENCES `sitio_turistico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
