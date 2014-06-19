<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['paquete/index'] = 'paquete/paquete_controller';
$route['paquete/registrar_tipo'] = 'paquete/paquete_controller/registrar_tipo';
$route['paquete/consultar_tipo/(:num)'] = 'paquete/paquete_controller/consultar_listar/$1';
$route['paquete/modificar_tipo'] = 'paquete/paquete_controller/modificar_tipo';
$route['paquete/principal'] = 'paquete/paquete_controller/consultar_paquete';
$route['paquete/consultar/(:num)'] = 'paquete/paquete_controller/consultar_paquetes/$1';
$route['paquete/crear'] = 'paquete/paquete_controller/crear';
$route['paquete/modificar/(:num)'] = 'paquete/paquete_controller/modificar_estado/$1';


$route['guia/registrar_guia'] = 'guia/guia_controller/registrar';
$route['guia/consultar_guia/(:num)'] = 'guia/guia_controller/consultar/$1';


$route['sitio_turistico/tipo_turismo/buscar/(:num)'] = 'sitio_turistico/sitio_turistico_controller/buscar/$1';
$route['sitio_turistico/tipo_turismo/listar'] = 'sitio_turistico/sitio_turistico_controller/listar';
$route['sitio_turistico/tipo_turismo/modificar_tipo'] = 'sitio_turistico/sitio_turistico_controller/modificar_tipo';