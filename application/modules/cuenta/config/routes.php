<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['cuenta'] 				=  	'cuenta/cuentas_controller';
$route['cuenta/cuenta_cliente'] 	=  	'cuenta/cuentas_controller/consultar_cliente';
$route['cuenta/consultar_cliente'] 	=  	'cuenta/cuentas_controller/consultar_cliente';
$route['cuenta/buscar/(:num)'] 		= 	'cuenta/cuentas_controller/buscar/$1';
$route['cuenta/actualizar'] 		=  	'cuenta/cuentas_controller/actualizar';

$route['cuenta/cuenta_empleado'] 	= 	'cuenta/cuentas_controller/consultar_empleado';
$route['cuenta/consultar_empleado'] = 	'cuenta/cuentas_controller/consultar_empleado';
$route['cuenta/reestablecer'] = 	'cuenta/cuentas_controller/reestablecer';