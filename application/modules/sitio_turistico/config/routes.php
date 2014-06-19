<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
define('MODULE', 'sitio_turistico/');
define('CONTROLLER', 'sitio_turistico_controller');
define('CONTROLLER_', 'tipo_turismo_controller');
define('BASE_URL_MODULE', 'sitio_turistico');
define('BASE_URL_MODULE_', '/tipo_turismo');

$route[BASE_URL_MODULE] 											= 	MODULE . CONTROLLER . '/index';
$route[BASE_URL_MODULE . '/register'] 								= 	MODULE . CONTROLLER . '/register';
$route[BASE_URL_MODULE . '/lista'] 									= 	MODULE . CONTROLLER . '/listar';
$route[BASE_URL_MODULE . '/modificar'] 								= 	MODULE . CONTROLLER . '/modificar';
$route[BASE_URL_MODULE . '/modificar/(:num)']						= 	MODULE . CONTROLLER . '/modificar/$1';

$route[BASE_URL_MODULE . BASE_URL_MODULE_] 							= 	MODULE . CONTROLLER_ . '/index';
$route[BASE_URL_MODULE . BASE_URL_MODULE_ . '/registro']			= 	MODULE . CONTROLLER_ . '/registrar';
$route[BASE_URL_MODULE . BASE_URL_MODULE_ . '/listar'] 				= 	MODULE . CONTROLLER_ . '/listar';
$route[BASE_URL_MODULE . BASE_URL_MODULE_ . '/modificar'] 			= 	MODULE . CONTROLLER_ . '/modificar';
$route[BASE_URL_MODULE . BASE_URL_MODULE_ . '/modificar/(:num)'] 	= 	MODULE . CONTROLLER_ . '/modificar/$1';