<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['banco'] = 'banco/banco_controller';
$route['banco/registrar'] = 'banco/banco_controller/registrar';
$route['banco/consultar'] = 'banco/banco_controller/consultar';
$route['banco/buscar/(:num)'] = 'banco/banco_controller/buscar/$1';
$route['banco/actualizar'] = 'banco/banco_controller/actualizar';