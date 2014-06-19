<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$template['active_group'] = 'default'; 
$template['active_template'] = 'default';
$template['default']['template'] = 'template';
$template['default']['regions'] = array(
 'header' => array('content' => array('<h1>Templates en codeigniter</h1>')),
 'title' => array('content' => array('Traveling city')),
 'navbar_header',
 'navbar',
 'content_header',
 'content',
 'footer'
);
$template['default']['parser'] = 'parser';
$template['default']['parser_method'] = 'parse';
$template['default']['parse_template'] = FALSE;