<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['novedad/index'] = 'novedad/novedad_controller';
$route['novedad/buscar/(:num)'] = 'novedad/novedad_controller/buscar/$1';
$route['novedad/modificar'] = 'novedad/novedad_controller/modificar_novedad';
$route['novedad/asignar/(:num)'] = 'novedad/novedad_controller/asignar/$1';

