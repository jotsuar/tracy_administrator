<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('MODULE', 'citytour/');
define('CONTROLLER', 'citytour_controller');
define('BASE_URL_MODULE', 'citytour');

$route[BASE_URL_MODULE] 						= 	MODULE . CONTROLLER . '/index';
$route[BASE_URL_MODULE . '/registro'] 			= 	MODULE . CONTROLLER . '/register';
$route[BASE_URL_MODULE . '/list_vehicles'] 		= 	MODULE . CONTROLLER . '/list_vehicles_transporte';
$route[BASE_URL_MODULE . '/consulta'] 			=	MODULE . CONTROLLER . '/consulta';
$route[BASE_URL_MODULE . '/update/(:num)'] 		=   MODULE . CONTROLLER . '/update/$1';
$route[BASE_URL_MODULE . '/update'] 			=   MODULE . CONTROLLER . '/update';
