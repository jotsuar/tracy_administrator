<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$route['transporte'] 								= 	'transporte/transporte/index';
$route['transporte/registrar'] 			= 	'transporte/transporte/registrar';
$route['transporte/contacto'] 			= 	'transporte/transporte/contacto';
$route['transporte/consultar'] 			= 	'transporte/transporte/consultar';
$route['transporte/buscar/(:num)'] 	= 	'transporte/transporte/buscar/$1';
$route['transporte/modificar'] 			= 	'transporte/transporte/modificar';

$route['transporte/vehiculo'] 								= 	'transporte/transporte/registrar_vehiculo';
$route['transporte/vehiculo/consultar'] 			= 	'transporte/transporte/consultar_vehiculo';
$route['transporte/vehiculo/modificar'] 			= 	'transporte/transporte/modificar_vehiculo';
$route['transporte/vehiculo/buscar/(:num)'] 	= 	'transporte/transporte/buscar_vehiculo/$1';


$route['transporte/tipo_vehiculo'] 								= 	'transporte/transporte/registrar_tipo_vehiculo';
$route['transporte/consultar_tipo_vehiculo'] 			= 	'transporte/transporte/consultar_tipo_vehiculo';
$route['transporte/modificar_tipo_vehiculo'] 			= 	'transporte/transporte/modificar_tipo_vehiculo';
$route['transporte/see_tipo_vehiculo/(:num)'] 		= 	'transporte/transporte/see_tipo_vehiculo/$1';