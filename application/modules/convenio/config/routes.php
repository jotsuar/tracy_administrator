<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['convenio'] = 'convenio/convenio_controller';
$route['convenio/registrar/(:num)'] = 'convenio/convenio_controller/registrar/$1';
$route['convenio/consultar_convenio/(:num)/(:num)'] = 'convenio/convenio_controller/consultar_convenio/$1/$2';
$route['convenio/cambiar_estado/(:num)/(:num)/(:num)'] = 'convenio/convenio_controller/actualizar_estado/$1/$2/$3';
$route['convenio/buscar/(:num)'] = 'convenio/convenio_controller/buscar/$1';



