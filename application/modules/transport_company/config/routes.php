<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('MODULE', 'transport_company/');
define('CONTROLLER', 'transport_company_controller');
define('CONTROLLER_', 'vehicle_controller');
define('BASE_URL_MODULE', 'transport_company');
define('BASE_URL_MODULE_', '/vehicle');

// $route[BASE_URL_MODULE . '/list_vehicles'] 		= 	MODULE . CONTROLLER . '/list_vehicles_transporte';
// $route[BASE_URL_MODULE . '/consulta'] 			=	MODULE . CONTROLLER . '/consulta';
// $route[BASE_URL_MODULE . '/update'] 			=   MODULE . CONTROLLER . '/update';
// $route[BASE_URL_MODULE . '/update/(:num)'] 		=   MODULE . CONTROLLER . '/update/$1';

$route[BASE_URL_MODULE] 								= 	MODULE . CONTROLLER . '/index';
$route[BASE_URL_MODULE . '/registrar'] 			= 	MODULE . CONTROLLER . '/registrar';
$route[BASE_URL_MODULE . '/contacto'] 			= 	MODULE . CONTROLLER . '/contacto';
$route[BASE_URL_MODULE . '/consultar'] 			= 	MODULE . CONTROLLER . '/consultar';
$route[BASE_URL_MODULE . '/buscar/(:num)'] 	= 	MODULE . CONTROLLER . '/buscar/$1';
$route[BASE_URL_MODULE . '/modificar'] 			= 	MODULE . CONTROLLER . '/modificar';

$route[BASE_URL_MODULE . '/vehiculo'] 								= 	MODULE . CONTROLLER . '/registrar_vehiculo';
$route[BASE_URL_MODULE . '/vehiculo/consultar'] 			= 	MODULE . CONTROLLER . '/consultar_vehiculo';
$route[BASE_URL_MODULE . '/vehiculo/modificar'] 			= 	MODULE . CONTROLLER . '/modificar_vehiculo';
$route[BASE_URL_MODULE . '/vehiculo/buscar/(:num)'] 	= 	MODULE . CONTROLLER . '/buscar_vehiculo/$1';


$route[BASE_URL_MODULE . '/tipo_vehiculo'] 								= 	MODULE . CONTROLLER . '/registrar_tipo_vehiculo';
$route[BASE_URL_MODULE . '/consultar_tipo_vehiculo'] 			= 	MODULE . CONTROLLER . '/consultar_tipo_vehiculo';
$route[BASE_URL_MODULE . '/modificar_tipo_vehiculo'] 			= 	MODULE . CONTROLLER . '/modificar_tipo_vehiculo';
$route[BASE_URL_MODULE . '/see_tipo_vehiculo/(:num)'] 		= 	MODULE . CONTROLLER . '/see_tipo_vehiculo/$1';

$route[BASE_URL_MODULE . BASE_URL_MODULE_] 		= 	MODULE . CONTROLLER_ . '/index';
$route[BASE_URL_MODULE . BASE_URL_MODULE_ . '/consult_with_ajax'] = MODULE . CONTROLLER_ . '/consult_with_ajax';
$route[BASE_URL_MODULE . BASE_URL_MODULE_ . '/get_vehicles_citytour/(:num)'] = MODULE . CONTROLLER_ . '/get_vehicles_citytour/$1';