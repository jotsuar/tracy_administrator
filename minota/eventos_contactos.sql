DELIMITER $
DROP PROCEDURE IF EXISTS sp_insertar_contacto_evento;
$
DELIMITER $
CREATE PROCEDURE sp_insertar_contacto_evento (
in p_id_evento int,
IN p_identificacion varchar(15),
IN p_nombre varchar(45),
IN p_apellido varchar(45),
IN p_celular varchar(45),
IN p_email varchar(45))
begin
 insert into contacto(id_evento,identificacion, nombres, apellidos, celular,email)
 values(p_id_evento,p_identificacion,upper(p_nombre), upper(p_apellido),p_celular, 
lower(p_email));
END $
SELECT * FROM EVENTO
select * from contacto

/*============consulta evento==============*/
DELIMITER $
DROP PROCEDURE IF EXISTS sp_consultar_contacto_evento;
$
DELIMITER $
delimiter $
create procedure sp_consultar_contacto_evento()
begin
select id,nombre from evento ;
end $
call sp_consultar_contacto_evento
/*============FIN consulta evento==============*/
/*============consulta evento==============*/
DELIMITER $
DROP PROCEDURE IF EXISTS sp_consultar_contacto;
$
DELIMITER $
delimiter $$
create procedure sp_consultar_contacto(in p_nombre varchar(45))
begin
	select * from contacto where upper(nombres) like concat( '%',p_nombre,'%') or lower(nombres)
	like concat('%',p_nombre,'%');
end $$
/*============FIN consulta evento==============*/
select nombres from contacto
call sp_consultar_contacto('nombres')
select * from contacto


DELIMITER $
DROP PROCEDURE IF EXISTS sp_modificar_contacto;
$
DELIMITER $
CREATE PROCEDURE sp_modificar_contacto(
	 p_codigo int,
	IN p_identificacion varchar(45),
	IN p_nombres varchar(45),
	IN p_apellidos varchar(20),
	IN p_celular varchar(45),
	IN p_email varchar(45),
	IN p_estado bit,
	IN p_id_evento int
)
begin
	UPDATE contacto SET identificacion = upper(p_identificacion),
	nombres = upper(p_nombres),
	apellidos = upper(p_apellidos),
	celular = p_celular,
	email = upper(p_email),
	estado = p_estado,
	id_evento = p_id_evento
	WHERE codigo = p_codigo;
END $
select * from contacto
 








DELIMITER $
DROP PROCEDURE IF EXISTS sp_consultar_contacto;
$
DELIMITER $
DELIMITER $$
CREATE PROCEDURE sp_consultar_contacto(in p_parametro varchar(45))
begin
	select evento.id,evento.nombre,contacto.codigo,contacto.identificacion,contacto.nombres,contacto.apellidos,contacto.email,
	contacto.celular,contacto.estado
	from contacto 
	inner join evento on  contacto.id_evento=evento.id
	where upper(nombres) like concat( '%',p_parametro,'%') or lower(nombres) like concat('%',p_parametro,'%')or codigo=p_parametro;
end$$

select * from evento