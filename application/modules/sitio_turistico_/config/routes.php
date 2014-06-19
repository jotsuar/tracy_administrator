<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$route['sitio_turistico'] 					= 'sitio_turistico/sitio_turistico_controller';
$route['sitio_turistico/register'] 			= 'sitio_turistico/sitio_turistico_controller/register';
$route['sitio_turistico/lista'] 			= 'sitio_turistico/sitio_turistico_controller/listar';
$route['sitio_turistico/modificar']			= 'sitio_turistico/sitio_turistico_controller/modificar';
$route['sitio_turistico/modificar/(:num)']	= 'sitio_turistico/sitio_turistico_controller/modificar/$1';