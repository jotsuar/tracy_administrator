/*---------------------------------------------------------*/
Delimiter $$

CREATE procedure sp_insertar_cliente(p_identificacion varchar(15),
p_tipo varchar(15), p_nombre varchar(45), p_apellido varchar (45),
p_telefono varchar (15), p_celular varchar (15),p_fecha date, p_correo varchar(45)
)
	begin
	insert into usuario(identificacion,
						tipo_documento,
						nombres,apellidos,
						telefono,celular,fecha_nacimiento,email,tipo) 
	values (p_identificacion,p_tipo,p_nombre,p_apellido,
	p_telefono,p_celular,p_fecha,p_correo,'cliente');

end $$
delimiter $$
CREATE  procedure sp_insertar_empleado(p_identificacion varchar(15),
p_tipo varchar(15), p_nombre varchar(45), p_apellido varchar (45),
p_telefono varchar (15), p_celular varchar (15), p_correo varchar(45)
)
	begin
	insert into usuario(identificacion,
						tipo_documento,
						nombres,apellidos,
						telefono,celular,email,tipo) 
	values (p_identificacion,p_tipo,p_nombre,p_apellido,
	p_telefono,p_celular,p_correo,'empleado');

end $$
delimiter $
create procedure actualizar
end $

select * from usuario
/*---------------------------------------------------------*/
DELIMITER $$
CREATE PROCEDURE sp_consultar_usuario_cliente(p_parametro varchar(45))
begin
	select * from usuario where
	(upper(nombres) like concat('%',p_parametro,'%') or
	lower(nombres) like concat('%',p_parametro,'%') or
	upper(apellidos) like concat('%',p_parametro,'%') or
	lower(apellidos) like concat('%',p_parametro,'%') or
	identificacion like concat('%',p_parametro,'%')) and tipo = 'empleado';
	

end $$

	
/*---------------------------------------------------------*/
delimiter $
create procedure sp_actualizar_cliente(p_id int,p_identificacion varchar(15),
p_tipo varchar(15), p_nombre varchar(45), p_apellido varchar (45),
p_telefono varchar (15), p_celular varchar (15),p_fecha date, p_correo varchar(45)
)
begin

update usuario
set identificacion=p_identificacion,
tipo_documento=p_tipo,
nombres=p_nombre,
apellidos=p_apellido,
telefono=p_telefono,
celular=p_celular,
fecha_nacimiento=p_fecha,
email=p_correo
where id=p_id;

end $

select * from rol
/*---------------------------------------------------------*/

delimiter $
create procedure sp_insertar_cuenta_usuario(p_usuario varchar(30),
							p_password varchar(30),
							id_rol int,
							p_id_user int)
begin
	insert into cuenta (usuario, password, id_rol, id_usuario)
	values (p_usuario,p_password,id_rol,p_id_user);
end $ 
/*---------------------------------------------------------*/



delimiter $
create  procedure sp_actualizar_cuenta_usuario(p_usuario varchar(30),
							p_password varchar(30),
							p_id_user int
							,p_estado bit)
begin 

update cuenta
set usuario=p_usuario,
	password=p_password,
	estado=p_estado
where id_usuario=p_id_user;
end $
select * from cuenta

select (date_format(utc_date(),'%d,%m,%Y'));

select date_format('08,14,1994','%d,%m,%Y');
select truncate((datediff(curdate(),'1994,08,14')/356),0)

select * from rol

insert into rol values (1,'administrador',5,'Dueño del software')

insert into rol values (2,'empleado',3,'Empleado con restricciones')

insert into rol values (3,'cliente',1,'Cliente de la empresa')

delimiter $
create procedure sp_actualizar_empleado(p_id int,p_identificacion varchar(15),
p_tipo varchar(15), p_nombre varchar(45), p_apellido varchar (45),
p_telefono varchar (15), p_celular varchar(20) , p_correo varchar(45)
)
begin

update usuario
set identificacion=p_identificacion,
tipo_documento=p_tipo,
nombres=p_nombre,
apellidos=p_apellido,
telefono=p_telefono,
celular=p_celular,
email=p_correo
where id=p_id;

end $

Delimiter $$
create procedure sp_servicio_adicional(p_nombre varchar(30))
begin 
select servicio_adicional.id,servicio_adicional.nombre,servicio_adicional.descripcion,
tipo_servicio.nombre as "nombres" from servicio_adicional
inner join tipo_servicio on servicio_adicional.tipo_servicio_id=tipo_servicio.id
where upper(servicio_adicional.nombre) like concat('%',p_nombre,'%') or
	lower(servicio_adicional.nombre) like concat('%',p_nombre,'%') 
    or servicio_adicional.tipo_servicio_id=p_nombre;
end $$

delimiter $
create procedure sp_buscar_servicio(p_id int)
begin
select servicio_adicional.id,servicio_adicional.nombre,servicio_adicional.descripcion,
tipo_servicio.nombre as "nombres" from servicio_adicional
inner join tipo_servicio on servicio_adicional.tipo_servicio_id=tipo_servicio.id 
where servicio_adicional.id=p_id;

end $

delimiter $
create function fc_validar_servicio(p_nombre varchar(45), p_tipo int)
returns int
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
end $

select	fc_validar_servicio ('gim',1)

Delimiter $ 
create procedure sp_modificar_servicio(p_nombre varchar(45),p_desc text, p_tipo int
, p_id int)
begin
	update servicio_adicional
	set nombre=p_nombre,
		descripcion=p_desc,
		tipo_servicio_id=p_tipo
	where id=p_id;
end $
	




