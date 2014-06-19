<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['informe/index'] = 'informe/informe_controller';
$route['informe/generar/(:any)/(:any)/(:any)/(:any)'] = 'informe/informe_controller/generar/$1/$2/$3/$4';



$route['informe/mostrar/(:num)'] = 'informe/informe_controller/mostrar/$1';
$route['novedad/buscar/(:num)'] = 'novedad/novedad_controller/buscar/$1';
$route['novedad/modificar'] = 'novedad/novedad_controller/modificar_novedad';



$route['sitio_turistico/tipo_turismo/buscar/(:num)'] = 'sitio_turistico/sitio_turistico_controller/buscar/$1';
$route['sitio_turistico/tipo_turismo/listar'] = 'sitio_turistico/sitio_turistico_controller/listar';
