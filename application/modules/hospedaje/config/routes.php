<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['hospedaj'] 								= 	'hospedaje/hospedaje';
$route['hospedaje/registrar'] 						=	'hospedaje/hospedaje/registrar';
$route['hospedaje/consultar'] 						= 	'hospedaje/hospedaje/consultar';
$route['hospedaje/detalle/(:num)'] 					= 	'hospedaje/hospedaje/detalle/$1';
$route['hospedaje/detalle_servicios_add/(:num)'] 	= 	'hospedaje/hospedaje/detalle_servicios_add/$1';
$route['hospedaje/modificar'] 						= 	'hospedaje/hospedaje/modificar';

/*Definicion de rutas para el controlador hospedaje(categoria)*/
$route['hospedaje/categoria'] 					= 	'hospedaje/hospedaje/registrar_categoria';
$route['hospedaje/consultar_categoria'] 		= 	'hospedaje/hospedaje/consult_all_categories';
$route['hospedaje/buscar_categoria/(:num)'] 	= 	'hospedaje/hospedaje/buscar_categoria/$1';
$route['hospedaje/modificar_categoria'] 		= 	'hospedaje/hospedaje/modificar_categoria';

/*Definicion de rutas para el controlador  hospedaje(tipo_habitacion)*/
$route['hospedaje/tipo_habitacion'] 			= 	'hospedaje/hospedaje/registrar_tipo_habitacion';
$route['hospedaje/tipo_habitacion/consultar']	= 	'hospedaje/hospedaje/consultar_tipo_habitacion';

$route['hospedaje/tipo_habitacion/buscar/(:num)']		= 	'hospedaje/hospedaje/buscar_tipo_habitacion/$1';
$route['hospedaje/tipo_habitacion/modificar'] 			= 	'hospedaje/hospedaje/modificar_tipo_habitacion';

/*Definicion de rutas para el controlador hospedaje(habitacion)*/
$route['hospedaje/habitacion']					= 	'hospedaje/hospedaje/registrar_habitacion';
$route['hospedaje/habitacion/consultar']		= 	'hospedaje/hospedaje/consultar_habitacion';
$route['hospedaje/habitacion/buscar/(:num)']	= 	'hospedaje/hospedaje/buscar_habitacion/$1';
$route['hospedaje/habitacion/modificar']		= 	'hospedaje/hospedaje/modificar_habitacion';
/* End of file routes.php */
/* Location: ./application/config/routes.php */