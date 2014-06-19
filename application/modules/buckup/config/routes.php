<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['buckup/index'] = 'buckup/buckup_controller';
$route['buckup/generar'] = 'buckup/buckup_controller/generar';
$route['novedad/modificar'] = 'novedad/novedad_controller/modificar_novedad';



$route['sitio_turistico/tipo_turismo/buscar/(:num)'] = 'sitio_turistico/sitio_turistico_controller/buscar/$1';
$route['sitio_turistico/tipo_turismo/listar'] = 'sitio_turistico/sitio_turistico_controller/listar';
