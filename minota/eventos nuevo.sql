DELIMITER $
DROP PROCEDURE IF EXISTS sp_insertar_evento;
$
DELIMITER $$
CREATE  PROCEDURE sp_insertar_evento(
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


DELIMITER $
DROP PROCEDURE IF EXISTS sp_consultar_evento;
$
DELIMITER $$
CREATE PROCEDURE sp_consultar_evento(in p_nombre varchar(45))
begin
	select * from evento where upper(nombre) like concat( '%',p_nombre,'%') or lower(nombre)
	like concat('%',p_nombre,'%');
end$$


DELIMITER $
DROP PROCEDURE IF EXISTS sp_modificar_evento;
$
DELIMITER $$
CREATE procedure sp_modificar_evento(
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
	IN p_hora_salida time,
	p_id INT
)
begin
	UPDATE evento 
	SET nombre = upper(p_nombre),
	descripcion = upper(p_descripcion), 
	valor_compra = p_valor_compra,
	valor_venta = p_valor_venta,
	direccion = p_direccion,
	cupos = p_cupos,
	lugar = p_lugar, 
	fecha_inicio = p_fecha_inicio,
	fecha_fin = p_fecha_fin, 
	hora_inicio = p_hora_inicio,
	hora_salida = p_hora_salida
	WHERE id = p_id;
END$$


select * from evento