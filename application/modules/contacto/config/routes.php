<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['contacto/index/(:num)'] 						= 'contacto/contacto_controller/index/$1';
$route['contacto/registro_contacto/(:num)'] 			= 'contacto/contacto_controller/registro_contacto/$1';
$route['contacto/consultar_contacto/(:num)'] 			= 'contacto/contacto_controller/consultar_contacto/$1';
$route['contacto/buscar_contacto/(:num)/(:num)'] 		= 'contacto/contacto_controller/buscar/$1/$2';
$route['contacto/actualizar_contacto/(:num)/(:num)'] 	= 'contacto/contacto_controller/actualizar_contacto/$1/$2';