<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*Rutas para el empleado*/
$route['usuario/empleado'] 					= 'usuario/empleado_controller';
$route['usuario/empleado/registrar'] 		= 'usuario/empleado_controller/registrar';
$route['usuario/empleado/consultar'] 		= 'usuario/empleado_controller/consultar';
$route['usuario/empleado/buscar/(:num)'] 	= 'usuario/empleado_controller/buscar/$1';
$route['usuario/empleado/actualizar'] 		= 'usuario/empleado_controller/actualizar';

/* rutas para el cliente */

$route['usuario/cliente'] 				= 'usuario/cliente_controller';
$route['usuario/cliente/registrar'] 	= 'usuario/cliente_controller/registrar';
$route['usuario/cliente/consultar'] 	= 'usuario/cliente_controller/consultar';
$route['usuario/cliente/buscar/(:num)'] = 'usuario/cliente_controller/buscar/$1';
$route['usuario/cliente/actualizar'] 	= 'usuario/cliente_controller/actualizar';

/* End of file routes.php */
/* Location: ./application/config/routes.php */