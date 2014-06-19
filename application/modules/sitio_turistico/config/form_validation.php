<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    'sitio_turistico_controller/register' => array(
        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'trim|required|min_length[5]|xss_clean|is_unique[sitio_turistico.nombre]'
        ),
        array(
            'field' => 'ubicacion',
            'label' => 'ubicacion',
            'rules' => 'trim|required|min_length[5]|xss_clean|is_unique[sitio_turistico.ubicacion]'
        ),
        array(
            'tipo_turismo', 
            'tipo turismo', 
            'trim|required|xss_clean|is_natural_no_zero'
        ),
        array(
            'convenio', 
            'convenio', 
            'trim|required|xss_clean|is_natural_no_zero'
        ),        
    ),
    'tipo_turismo_controller/registrar' => array(
        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'trim|required|min_length[4]|is_unique[tipo_turismo.nombre]'
        ),
        array(
            'field' => 'descripcion',
            'label' => 'nombre',
            'rules' => 'trim|min_length[4]|xss_clean'
        ),
    ),
    'tipo_turismo_controller/modificar' => array(
        array(
            'field' => 'id',
            'label' => 'id',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'trim|required|min_length[4]|is_unique_update[tipo_turismo.nombre]'
        ),
        array(
            'field' => 'descripcion',
            'label' => 'nombre',
            'rules' => 'trim|min_length[4]|xss_clean'
        ),
    )
);