<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('MODULE', 'reserva/');
define('CONTROLLER', 'reserva_controller');
define('BASE_URL_MODULE', 'reserva');

$route[BASE_URL_MODULE] = MODULE . CONTROLLER . '/index';
$route[BASE_URL_MODULE . '/validar/(:num)'] = MODULE . CONTROLLER . '/validate/$1';
$route[BASE_URL_MODULE . '/invalidar/(:num)'] = MODULE . CONTROLLER . '/invalidate/$1';
$route[BASE_URL_MODULE . '/borrar'] = MODULE . CONTROLLER . '/delete_from_list';
$route[BASE_URL_MODULE . '/detalle/(:num)/(:num)'] = MODULE . CONTROLLER . '/get_detail_reserva/$1/$2';
$route[BASE_URL_MODULE . '/pagos/(:num)'] = MODULE . CONTROLLER . '/ver_pagos/$1';

/* End of file routes.php */
/* Location: ./application/modules/reserva/config/routes.php */