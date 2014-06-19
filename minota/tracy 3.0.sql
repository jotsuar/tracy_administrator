SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `tracy` ;
CREATE SCHEMA IF NOT EXISTS `tracy` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
USE `tracy` ;

-- -----------------------------------------------------
-- Table `tracy`.`categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`categoria` ;

CREATE TABLE IF NOT EXISTS `tracy`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(30) NOT NULL,
  `descripcion` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  PRIMARY KEY (`id`))
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE UNIQUE INDEX `categoria_UNIQUE` ON `tracy`.`categoria` (`categoria` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`hospedaje`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`hospedaje` ;

CREATE TABLE IF NOT EXISTS `tracy`.`hospedaje` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nit` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL,
  `direccion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL,
  `telefono` VARCHAR(15) NOT NULL,
  `descripcion` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL,
  `id_categoria` INT NOT NULL,
  `estado` BIT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `hospedaje_id_categoria`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `tracy`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `id_categrio_idx` ON `tracy`.`hospedaje` (`id_categoria` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`transporte`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`transporte` ;

CREATE TABLE IF NOT EXISTS `tracy`.`transporte` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nit` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `direccion` VARCHAR(45) NULL,
  `telefono` VARCHAR(20) NULL,
  `correo` VARCHAR(45) NULL,
  `seguro_transporte` BIT NULL,
  `estado` BIT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tracy`.`evento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`evento` ;

CREATE TABLE IF NOT EXISTS `tracy`.`evento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `descripcion` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL,
  `valor_compra` FLOAT NOT NULL,
  `valor_venta` FLOAT NOT NULL,
  `direccion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `cupos` SMALLINT NOT NULL,
  `lugar` VARCHAR(45) NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NOT NULL,
  `hora_inicio` TIME NOT NULL,
  `hora_salida` TIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tracy`.`tipo_turismo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`tipo_turismo` ;

CREATE TABLE IF NOT EXISTS `tracy`.`tipo_turismo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL,
  `descripcion` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL,
  PRIMARY KEY (`id`))
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tracy`.`sitio_turistico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`sitio_turistico` ;

CREATE TABLE IF NOT EXISTS `tracy`.`sitio_turistico` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `ubicacion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `descripcion` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `id_tipo_servicio` INT NOT NULL,
  `id_tipo_turismo` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `sitio_turistico_id_tipo_turismo`
    FOREIGN KEY (`id_tipo_turismo`)
    REFERENCES `tracy`.`tipo_turismo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `id_tipo_turismo_idx` ON `tracy`.`sitio_turistico` (`id_tipo_turismo` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`convenio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`convenio` ;

CREATE TABLE IF NOT EXISTS `tracy`.`convenio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `id_hospedaje` INT NULL,
  `tipo_convenio` INT NULL,
  `id_transporte` INT NULL,
  `id_sitio_turistico` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `id_hospedaje`
    FOREIGN KEY (`id_hospedaje`)
    REFERENCES `tracy`.`hospedaje` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Nit_empresa`
    FOREIGN KEY (`id_transporte`)
    REFERENCES `tracy`.`transporte` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_sitio_turistico`
    FOREIGN KEY (`id_sitio_turistico`)
    REFERENCES `tracy`.`sitio_turistico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `id_hotel_idx` ON `tracy`.`convenio` (`id_hospedaje` ASC);

CREATE INDEX `Nit_empresa_idx` ON `tracy`.`convenio` (`id_transporte` ASC);

CREATE INDEX `id_sitio_turistico_idx` ON `tracy`.`convenio` (`id_sitio_turistico` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`detalle_convenio_trasportadora`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`detalle_convenio_trasportadora` ;

CREATE TABLE IF NOT EXISTS `tracy`.`detalle_convenio_trasportadora` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_convenio` INT NOT NULL,
  `costo` FLOAT NULL,
  `venta` FLOAT NULL,
  `cupos` INT NULL,
  `fecha_inicio` DATE NULL,
  `fecha_fin` DATE NULL,
  `estado` BIT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `id_convenio`
    FOREIGN KEY (`id_convenio`)
    REFERENCES `tracy`.`convenio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tracy`.`city_tour`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`city_tour` ;

CREATE TABLE IF NOT EXISTS `tracy`.`city_tour` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `hora_inicio` TIME NOT NULL,
  `hora_fin` TIME NOT NULL,
  `direccion_salida` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL,
  `id_convenio_empresa_transporte` INT NOT NULL,
  `estado` BIT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `city_tour_id_convenio_transportadora`
    FOREIGN KEY (`id_convenio_empresa_transporte`)
    REFERENCES `tracy`.`detalle_convenio_trasportadora` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `id_convenio_idx` ON `tracy`.`city_tour` (`id_convenio_empresa_transporte` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`contacto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`contacto` ;

CREATE TABLE IF NOT EXISTS `tracy`.`contacto` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `identificacion` VARCHAR(15) NOT NULL,
  `nombres` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `apellidos` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `celular` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `estado` BIT NOT NULL DEFAULT 1,
  `id_hospedaje` INT NULL,
  `id_transporte` INT NULL,
  `id_evento` INT NULL,
  `id_city_tour` INT NULL,
  PRIMARY KEY (`codigo`),
  CONSTRAINT `contacto_id_hospedaje`
    FOREIGN KEY (`id_hospedaje`)
    REFERENCES `tracy`.`hospedaje` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `contacto_id_transporte`
    FOREIGN KEY (`id_transporte`)
    REFERENCES `tracy`.`transporte` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT,
  CONSTRAINT `contacto_id_evento`
    FOREIGN KEY (`id_evento`)
    REFERENCES `tracy`.`evento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `contacto_id_city_tour`
    FOREIGN KEY (`id_city_tour`)
    REFERENCES `tracy`.`city_tour` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `contacto_id_city_tour_idx` ON `tracy`.`contacto` (`id_city_tour` ASC);

CREATE INDEX `contacto_id_transporte_idx` ON `tracy`.`contacto` (`id_transporte` ASC);

CREATE INDEX `contacto_id_evento_idx` ON `tracy`.`contacto` (`id_evento` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`tipo_paquete`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`tipo_paquete` ;

CREATE TABLE IF NOT EXISTS `tracy`.`tipo_paquete` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tracy`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`usuario` ;

CREATE TABLE IF NOT EXISTS `tracy`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `identificacion` VARCHAR(20) NOT NULL,
  `tipo_documento` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `nombres` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `apellidos` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `telefono` VARCHAR(15) NULL,
  `celular` VARCHAR(15) NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `email` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `tipo` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Se refiere a si es una persona juridica(empresa) o una persona natural',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tracy`.`paquete`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`paquete` ;

CREATE TABLE IF NOT EXISTS `tracy`.`paquete` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_tipo` INT NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NOT NULL,
  `id_usuario` INT NULL,
  `estado` BIT NOT NULL DEFAULT 1,
  `id_sitio` INT NULL,
  `transporte` BIT NOT NULL,
  `id_city_tour` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `paquete_id_tipo_paquete`
    FOREIGN KEY (`id_tipo`)
    REFERENCES `tracy`.`tipo_paquete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `paquete_id_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `tracy`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `paquete_id_sitio_turistico`
    FOREIGN KEY (`id_sitio`)
    REFERENCES `tracy`.`sitio_turistico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `paquete_id_city_tour`
    FOREIGN KEY (`id_city_tour`)
    REFERENCES `tracy`.`city_tour` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `id_tipo_idx` ON `tracy`.`paquete` (`id_tipo` ASC);

CREATE INDEX `id_usuario_idx` ON `tracy`.`paquete` (`id_usuario` ASC);

CREATE INDEX `id_sitio_idx` ON `tracy`.`paquete` (`id_sitio` ASC);

CREATE INDEX `id_city_tour_idx` ON `tracy`.`paquete` (`id_city_tour` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`tipo_habitacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`tipo_habitacion` ;

CREATE TABLE IF NOT EXISTS `tracy`.`tipo_habitacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tracy`.`habitacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`habitacion` ;

CREATE TABLE IF NOT EXISTS `tracy`.`habitacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_hospedaje` INT NOT NULL,
  `id_tipohabitacion` INT NOT NULL,
  `comodidades` TEXT NULL,
  `cantidad` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `id_hotel1`
    FOREIGN KEY (`id_hospedaje`)
    REFERENCES `tracy`.`hospedaje` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_tipo_habitacion1`
    FOREIGN KEY (`id_tipohabitacion`)
    REFERENCES `tracy`.`tipo_habitacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
COMMENT = '	';

CREATE INDEX `id_hotel_idx` ON `tracy`.`habitacion` (`id_hospedaje` ASC);

CREATE INDEX `id_tipo_habitacion_idx` ON `tracy`.`habitacion` (`id_tipohabitacion` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`detalle_paquete_hospedaje`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`detalle_paquete_hospedaje` ;

CREATE TABLE IF NOT EXISTS `tracy`.`detalle_paquete_hospedaje` (
  `Id_paquete` INT NOT NULL,
  `id_habitacion_hotel` INT NOT NULL,
  `cupos_disponibles` SMALLINT NOT NULL,
  `venta` FLOAT NOT NULL,
  CONSTRAINT `for_dtlle_paquete_hospedaje_id_paquete`
    FOREIGN KEY (`Id_paquete`)
    REFERENCES `tracy`.`paquete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `dtlle_paquete_hospedaje_id_habitacion`
    FOREIGN KEY (`id_habitacion_hotel`)
    REFERENCES `tracy`.`habitacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `id_habitacion_hotel_idx` ON `tracy`.`detalle_paquete_hospedaje` (`id_habitacion_hotel` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`reserva`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`reserva` ;

CREATE TABLE IF NOT EXISTS `tracy`.`reserva` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha_reserva` DATE NOT NULL,
  `cod_usuario` INT NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NOT NULL,
  `modo_de_pago` BIT NOT NULL,
  `cantidad_adultos` SMALLINT NOT NULL,
  `cantidad_ninios` SMALLINT NOT NULL,
  `id_paquete` INT NULL,
  `estado` BIT NOT NULL DEFAULT 0 COMMENT 'La reserva debe estar inicialmente desactivada, ya que es el administrador el que la activa una vez compruebe la valides de la misma',
  `id_hospedaje` INT NULL,
  `forma_de_pago` BIT NOT NULL,
  `id_evento` INT NULL,
  `id_city_tour` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `reserva_cliente`
    FOREIGN KEY (`cod_usuario`)
    REFERENCES `tracy`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `reserva_id_paquete`
    FOREIGN KEY (`id_paquete`)
    REFERENCES `tracy`.`paquete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `reserva_id_hospedaje`
    FOREIGN KEY (`id_hospedaje`)
    REFERENCES `tracy`.`habitacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `reserva_id_evento`
    FOREIGN KEY (`id_evento`)
    REFERENCES `tracy`.`evento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `reserva_id_city_tour`
    FOREIGN KEY (`id_city_tour`)
    REFERENCES `tracy`.`city_tour` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `cliente_idx` ON `tracy`.`reserva` (`cod_usuario` ASC);

CREATE INDEX `id_paquete_idx` ON `tracy`.`reserva` (`id_paquete` ASC);

CREATE INDEX `id_hospedaje_idx` ON `tracy`.`reserva` (`id_hospedaje` ASC);

CREATE INDEX `id_evento_idx` ON `tracy`.`reserva` (`id_evento` ASC);

CREATE INDEX `id_city_tour_idx` ON `tracy`.`reserva` (`id_city_tour` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`rol` ;

CREATE TABLE IF NOT EXISTS `tracy`.`rol` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `nivel` TINYINT NULL,
  `descripcion` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tracy`.`cuenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`cuenta` ;

CREATE TABLE IF NOT EXISTS `tracy`.`cuenta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `estado` BIT NOT NULL DEFAULT 0,
  `usuario` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `id_rol` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `cuenta_id_rol`
    FOREIGN KEY (`id_rol`)
    REFERENCES `tracy`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuenta_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `tracy`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `cuenta_id_rol_idx` ON `tracy`.`cuenta` (`id_rol` ASC);

CREATE INDEX `fk_cuenta_usuario1_idx` ON `tracy`.`cuenta` (`id_usuario` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`novedad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`novedad` ;

CREATE TABLE IF NOT EXISTS `tracy`.`novedad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_reserva` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `descripcion` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `reserva`
    FOREIGN KEY (`id_reserva`)
    REFERENCES `tracy`.`reserva` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `reserva_idx` ON `tracy`.`novedad` (`id_reserva` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`banco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`banco` ;

CREATE TABLE IF NOT EXISTS `tracy`.`banco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nit` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `direccion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `telefono` VARCHAR(20) NOT NULL,
  `numero_cuenta` VARCHAR(45) NULL,
  `estado` BIT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tracy`.`pago`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`pago` ;

CREATE TABLE IF NOT EXISTS `tracy`.`pago` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `id_banco` INT NOT NULL,
  `id_reserva` INT NOT NULL,
  `forma_pago` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `reserva3`
    FOREIGN KEY (`id_reserva`)
    REFERENCES `tracy`.`reserva` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT,
  CONSTRAINT `id_banco3`
    FOREIGN KEY (`id_banco`)
    REFERENCES `tracy`.`banco` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `reserva_idx` ON `tracy`.`pago` (`id_reserva` ASC);

CREATE INDEX `id_banco_idx` ON `tracy`.`pago` (`id_banco` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`cliente_externo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`cliente_externo` ;

CREATE TABLE IF NOT EXISTS `tracy`.`cliente_externo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `identificacion` VARCHAR(45) NOT NULL,
  `edad` TINYINT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tracy`.`tipo_servicio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`tipo_servicio` ;

CREATE TABLE IF NOT EXISTS `tracy`.`tipo_servicio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish2_ci' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tracy`.`servicio_adicional`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`servicio_adicional` ;

CREATE TABLE IF NOT EXISTS `tracy`.`servicio_adicional` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL,
  `descripcion` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL,
  `tipo_servicio_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_servicio_adicional_tipo_servicio1`
    FOREIGN KEY (`tipo_servicio_id`)
    REFERENCES `tracy`.`tipo_servicio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `fk_servicio_adicional_tipo_servicio1_idx` ON `tracy`.`servicio_adicional` (`tipo_servicio_id` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`detalle_convenio_hospedaje`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`detalle_convenio_hospedaje` ;

CREATE TABLE IF NOT EXISTS `tracy`.`detalle_convenio_hospedaje` (
  `id_convenio` INT NOT NULL,
  `costo` FLOAT NULL,
  `venta` FLOAT NULL,
  `cupos` INT NULL,
  `id_habitacion` INT NOT NULL,
  CONSTRAINT `detalle_convenio_hospedaje_id_convenio`
    FOREIGN KEY (`id_convenio`)
    REFERENCES `tracy`.`convenio` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT,
  CONSTRAINT `detalle_convenio_id_habitacion`
    FOREIGN KEY (`id_habitacion`)
    REFERENCES `tracy`.`habitacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `detalle_convenio_id_habitacion_idx` ON `tracy`.`detalle_convenio_hospedaje` (`id_habitacion` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`tipo_vehiculo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`tipo_vehiculo` ;

CREATE TABLE IF NOT EXISTS `tracy`.`tipo_vehiculo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tracy`.`vehiculo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`vehiculo` ;

CREATE TABLE IF NOT EXISTS `tracy`.`vehiculo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `matricula` VARCHAR(45) NOT NULL,
  `id_tipo_vehiculo` INT NOT NULL,
  `descripcion` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL,
  `cupo_maximo` SMALLINT NOT NULL,
  `estado` BIT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `id_tipo_vehiculo`
    FOREIGN KEY (`id_tipo_vehiculo`)
    REFERENCES `tracy`.`tipo_vehiculo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `id_tipo_vehiculo_idx` ON `tracy`.`vehiculo` (`id_tipo_vehiculo` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`detalle_vehiculo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`detalle_vehiculo` ;

CREATE TABLE IF NOT EXISTS `tracy`.`detalle_vehiculo` (
  `id_transporte` INT NOT NULL,
  `id_vehiculo` INT NULL,
  CONSTRAINT `detalle_vehiculo_id_vehiculo`
    FOREIGN KEY (`id_vehiculo`)
    REFERENCES `tracy`.`vehiculo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `detalle_vehiculo_id_empresa`
    FOREIGN KEY (`id_transporte`)
    REFERENCES `tracy`.`transporte` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `id_empresa_idx` ON `tracy`.`detalle_vehiculo` (`id_transporte` ASC);

CREATE INDEX `id_vehiculo_idx` ON `tracy`.`detalle_vehiculo` (`id_vehiculo` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`detalle_convenio_sitio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`detalle_convenio_sitio` ;

CREATE TABLE IF NOT EXISTS `tracy`.`detalle_convenio_sitio` (
  `id_convenio` INT NOT NULL,
  `costo` FLOAT NULL,
  `venta` FLOAT NULL,
  `cupos` INT NULL,
  `fecha_inicio` DATE NULL,
  `fecha_fin` DATE NULL,
  `estado` BIT NULL,
  CONSTRAINT `detalle_convenio_sitio_id_convenio`
    FOREIGN KEY (`id_convenio`)
    REFERENCES `tracy`.`convenio` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `id_convenio_idx` ON `tracy`.`detalle_convenio_sitio` (`id_convenio` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`convenio_banco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`convenio_banco` ;

CREATE TABLE IF NOT EXISTS `tracy`.`convenio_banco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `valor_convenio` FLOAT NULL,
  `fecha_inicio` DATE NULL,
  `fecha_fin` DATE NULL,
  `id_banco` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `id_banco`
    FOREIGN KEY (`id_banco`)
    REFERENCES `tracy`.`banco` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT)
ENGINE = InnoDB;

CREATE INDEX `id_banco_idx` ON `tracy`.`convenio_banco` (`id_banco` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`detalle_city_tour`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`detalle_city_tour` ;

CREATE TABLE IF NOT EXISTS `tracy`.`detalle_city_tour` (
  `id_city_tour` INT NOT NULL,
  `id_sitio_turistico` INT NULL,
  CONSTRAINT `detalle_city_tour_id_citytour`
    FOREIGN KEY (`id_city_tour`)
    REFERENCES `tracy`.`city_tour` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `detalle_city_tour_id_sitio_turistico`
    FOREIGN KEY (`id_sitio_turistico`)
    REFERENCES `tracy`.`sitio_turistico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `id_citytour_idx` ON `tracy`.`detalle_city_tour` (`id_city_tour` ASC);

CREATE INDEX `id_sitio_turistico_idx` ON `tracy`.`detalle_city_tour` (`id_sitio_turistico` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`detalle_hospedaje`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`detalle_hospedaje` ;

CREATE TABLE IF NOT EXISTS `tracy`.`detalle_hospedaje` (
  `id_convenio` INT NULL,
  `id_hospedaje` INT NULL,
  `costo` FLOAT NULL,
  `venta` FLOAT NULL,
  CONSTRAINT `hospedaje_convenio`
    FOREIGN KEY (`id_hospedaje`)
    REFERENCES `tracy`.`hospedaje` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `convenio`
    FOREIGN KEY (`id_convenio`)
    REFERENCES `tracy`.`convenio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `hospedaje_convenio_idx` ON `tracy`.`detalle_hospedaje` (`id_hospedaje` ASC);

CREATE INDEX `convenio_idx` ON `tracy`.`detalle_hospedaje` (`id_convenio` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`imagen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`imagen` ;

CREATE TABLE IF NOT EXISTS `tracy`.`imagen` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ruta` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL,
  `id_hospedaje` INT NULL,
  `id_habitacion` INT NULL,
  `id_sitio_turistico` INT NULL,
  `id_pago` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `imagen_hopedaje_id_hospedaje`
    FOREIGN KEY (`id_hospedaje`)
    REFERENCES `tracy`.`hospedaje` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `imagen_habitacion_id_habitacion`
    FOREIGN KEY (`id_habitacion`)
    REFERENCES `tracy`.`habitacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `image_sitio_turistico`
    FOREIGN KEY (`id_sitio_turistico`)
    REFERENCES `tracy`.`sitio_turistico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `imagen_pago`
    FOREIGN KEY (`id_pago`)
    REFERENCES `tracy`.`pago` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `foto_hopedaje_id_hospedaje_idx` ON `tracy`.`imagen` (`id_hospedaje` ASC);

CREATE INDEX `foto_habitacion_id_habitacion_idx` ON `tracy`.`imagen` (`id_habitacion` ASC);

CREATE INDEX `foto_sitio_turistico_idx` ON `tracy`.`imagen` (`id_sitio_turistico` ASC);

CREATE INDEX `imagen_pago_idx` ON `tracy`.`imagen` (`id_pago` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`detalle_servicio_adicional`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`detalle_servicio_adicional` ;

CREATE TABLE IF NOT EXISTS `tracy`.`detalle_servicio_adicional` (
  `id_hospedaje` INT NULL,
  `id_servicio_adicional` INT NOT NULL,
  `id_sitio_turistico` INT NULL,
  CONSTRAINT `hospedaje_servicio_adicional_id_hospedaje`
    FOREIGN KEY (`id_hospedaje`)
    REFERENCES `tracy`.`hospedaje` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT,
  CONSTRAINT `sitio_turistico_servicio_adicional_id_sitio`
    FOREIGN KEY (`id_sitio_turistico`)
    REFERENCES `tracy`.`sitio_turistico` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT,
  CONSTRAINT `id_servicio_adicional`
    FOREIGN KEY (`id_servicio_adicional`)
    REFERENCES `tracy`.`servicio_adicional` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT)
ENGINE = InnoDB;

CREATE INDEX `hospedaje_servicio_adicional_id_hospedaje_idx` ON `tracy`.`detalle_servicio_adicional` (`id_hospedaje` ASC);

CREATE INDEX `sitio_turistico_servicio_adicional_id_sitio_idx` ON `tracy`.`detalle_servicio_adicional` (`id_sitio_turistico` ASC);

CREATE INDEX `id_servicio_adicional_idx` ON `tracy`.`detalle_servicio_adicional` (`id_servicio_adicional` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`horario_sitio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`horario_sitio` ;

CREATE TABLE IF NOT EXISTS `tracy`.`horario_sitio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `hora_inicio` TIME NOT NULL,
  `hora_fin` TIME NOT NULL,
  `dia` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tracy`.`detalle_horario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`detalle_horario` ;

CREATE TABLE IF NOT EXISTS `tracy`.`detalle_horario` (
  `id_sitio_turistico` INT NOT NULL,
  `id_horario` INT NOT NULL,
  CONSTRAINT `detalle_id_horario`
    FOREIGN KEY (`id_horario`)
    REFERENCES `tracy`.`horario_sitio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `detalle_id_sitio_turistico`
    FOREIGN KEY (`id_sitio_turistico`)
    REFERENCES `tracy`.`sitio_turistico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `detalle_id_sitio_turistico_idx` ON `tracy`.`detalle_horario` (`id_sitio_turistico` ASC);

CREATE INDEX `detalle_id_horario_idx` ON `tracy`.`detalle_horario` (`id_horario` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`idioma`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`idioma` ;

CREATE TABLE IF NOT EXISTS `tracy`.`idioma` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tracy`.`guia_turistico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`guia_turistico` ;

CREATE TABLE IF NOT EXISTS `tracy`.`guia_turistico` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `identificacion` VARCHAR(20) NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `celular` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `estado` BIT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tracy`.`detalle_idioma`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`detalle_idioma` ;

CREATE TABLE IF NOT EXISTS `tracy`.`detalle_idioma` (
  `id_idioma` INT NOT NULL,
  `id_guia_turistico` INT NOT NULL,
  CONSTRAINT `detalle_idioma_id_idioma`
    FOREIGN KEY (`id_idioma`)
    REFERENCES `tracy`.`idioma` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `detalle_idioma_id_guia`
    FOREIGN KEY (`id_guia_turistico`)
    REFERENCES `tracy`.`guia_turistico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `detalle_idioma_id_idioma_idx` ON `tracy`.`detalle_idioma` (`id_idioma` ASC);

CREATE INDEX `detalle_idioma_id_guia_idx` ON `tracy`.`detalle_idioma` (`id_guia_turistico` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`detalle_city_tour_guia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`detalle_city_tour_guia` ;

CREATE TABLE IF NOT EXISTS `tracy`.`detalle_city_tour_guia` (
  `id_guia` INT NOT NULL,
  `id_city_tour` INT NOT NULL,
  CONSTRAINT `detalle_city_tour_guia_id_guia`
    FOREIGN KEY (`id_guia`)
    REFERENCES `tracy`.`guia_turistico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `detalle_city_tour_guia_id_city_tour`
    FOREIGN KEY (`id_city_tour`)
    REFERENCES `tracy`.`city_tour` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `detalle_city_tour_guia_id_guia_idx` ON `tracy`.`detalle_city_tour_guia` (`id_guia` ASC);

CREATE INDEX `detalle_city_tour_guia_id_city_tour_idx` ON `tracy`.`detalle_city_tour_guia` (`id_city_tour` ASC);


-- -----------------------------------------------------
-- Table `tracy`.`cliente_externo_reserva`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tracy`.`cliente_externo_reserva` ;

CREATE TABLE IF NOT EXISTS `tracy`.`cliente_externo_reserva` (
  `id_reserva` INT NOT NULL,
  `id_cliente_externo` INT NOT NULL,
  CONSTRAINT `cliente_externo_reserva_id_reserva`
    FOREIGN KEY (`id_reserva`)
    REFERENCES `tracy`.`reserva` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `cliente_externo_reserva_id_cliente_externo`
    FOREIGN KEY (`id_cliente_externo`)
    REFERENCES `tracy`.`cliente_externo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `cliente_externo_reserva_id_reserva_idx` ON `tracy`.`cliente_externo_reserva` (`id_reserva` ASC);

CREATE INDEX `cliente_externo_reserva_id_cliente_externo_idx` ON `tracy`.`cliente_externo_reserva` (`id_cliente_externo` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
