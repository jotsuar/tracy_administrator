<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['guia'] 							= 'guia/guia_controller';
$route['guia/registrar_guia'] 			= 'guia/guia_controller/registrar';
$route['guia/consultar_guia/(:num)'] 	= 'guia/guia_controller/consultar/$1';
$route['guia/get_languages'] 			= 'guia/guia_controller/get_languages';
$route['guia/get_guide_with_languages/(:num)'] 			= 'guia/guia_controller/get_guide_with_languages/$1';