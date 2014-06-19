<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['guia/index'] = 'guia/guia_controller';
$route['guia/registrar_guia'] = 'guia/guia_controller/registrar';
$route['guia/consultar_guia/(:num)'] = 'guia/guia_controller/consultar/$1';


$route['sitio_turistico/tipo_turismo/buscar/(:num)'] = 'sitio_turistico/sitio_turistico_controller/buscar/$1';
$route['sitio_turistico/tipo_turismo/listar'] = 'sitio_turistico/sitio_turistico_controller/listar';
$route['sitio_turistico/tipo_turismo/modificar_tipo'] = 'sitio_turistico/sitio_turistico_controller/modificar_tipo';