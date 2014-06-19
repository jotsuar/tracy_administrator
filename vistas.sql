select * from contacto;
select
c.identificacion,c.nombres,c.apellidos,c.telefono,c.email
from contacto c 
where c.id_evento = (select e.id from evento e);

select 
u.id,u.identificacion,u.nombres,u.apellidos,u.telefono
from usuario u
where u.id in (select id_usuario from cuenta where id_rol =2)










