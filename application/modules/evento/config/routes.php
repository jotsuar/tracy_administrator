<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['evento'] = 'evento/evento_controller';
$route['evento/registrar'] = 'evento/evento_controller/registrar';
$route['evento/consultar'] = 'evento/evento_controller/consultar';
$route['evento/buscar/(:num)'] = 'evento/evento_controller/buscar/$1';
$route['evento/actualizar'] = 'evento/evento_controller/actualizar';


