<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['additional_service'] 						= 'additional_service/additional_service_controller';
$route['additional_service/registrar'] 				= 'additional_service/additional_service_controller/registrar_servicio_add';
$route['additional_service/consultar'] 				= 'additional_service/additional_service_controller/consultar_servicio';
$route['additional_service/buscar/(:num)'] 			= 'additional_service/additional_service_controller/buscar/$1';
$route['additional_service/actualizar_servicio'] 	= 'additional_service/additional_service_controller/modificar_servicio_add';

// $route['servicio/servicio_add/registrar_servicio'] = 'servicio/servicio_add_controller/registrar_servicio_add';
// $route['servicio/servicio_add/actualizar_servicio'] = 'servicio/servicio_add_controller/modificar_servicio_add';
// $route['servicio/servicio_add/consultar'] = 'servicio/servicio_add_controller/consultar_servicio';
// $route['servicio/servicio_add/listar/(:num)'] = 'servicio/servicio_add_controller/listar/$1';
