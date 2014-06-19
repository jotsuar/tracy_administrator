<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    'citytour_controller/register' => array(
        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'trim|required|xss_clean|is_unique[citytour.nombre]'
        ),
        array(
            'field' => 'fecha',
            'label' => 'fecha',
            'rules' => 'trim|required|xss_clean|regex_match[/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/]|callback__validate_date['.date('Y-m-d').']'
        ),
        array(
            'field' => 'hora_inicio',
            'label' => 'hora de inicio',
            'rules' => 'trim|required|xss_clean|regex_match[/([0-9]{1,2})\:([0-9]{1,2})/]'
        ),
        array(
            'field' => 'hora_final',
            'label' => 'hora de fin',
            'rules' => 'trim|required|xss_clean|regex_match[/([0-9]{1,2})\:([0-9]{1,2})/]'
        ),
        array(
            'field' => 'direccion',
            'label' => 'dirección de salida',
            'rules' => 'trim|required|min_length[5]|xss_clean'
        ),
        array(
            'field' => 'cupos',
            'label' => 'cupos',
            'rules' => 'trim|required|is_natural_no_zero'
        ),
        array(
            'field' => 'precio',
            'label' => 'precio',
            'rules' => 'trim|required|is_natural_no_zero'
        ),
    ),
    'citytour_controller/consulta' => array(
        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'fecha',
            'label' => 'fecha',
            'rules' => 'trim|required|xss_clean|regex_match[/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/]'
        )
    ),
    'citytour_controller/update' => array(
        array(
            'field' => 'id',
            'label' => 'ID',
            'rules' => 'trim|required|is_natural_no_zero|xss_clean'
        ),
        array(
            'field' => 'nombre',
            'label' => 'nombre',
            'rules' => 'trim|required|xss_clean|is_unique_update[citytour.nombre]'
        ),
        array(
            'field' => 'fecha',
            'label' => 'fecha',
            'rules' => 'trim|required|xss_clean|regex_match[/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/]|callback__validate_date['.date('Y-m-d').']'
        ),
        array(
            'field' => 'hora_inicio',
            'label' => 'hora de inicio',
            'rules' => 'trim|required|xss_clean|regex_match[/([0-9]{1,2})\:([0-9]{1,2})/]|callback__validate_hour['.get_instance()->input->post('hora_final').']'
        ),
        array(
            'field' => 'hora_final',
            'label' => 'hora de fin',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'direccion',
            'label' => 'dirección de salida',
            'rules' => 'trim|required|min_length[5]|xss_clean'
        ),
        array(
            'field' => 'cupos',
            'label' => 'cupos',
            'rules' => 'trim|required|is_natural_no_zero'
        ),
        array(
            'field' => 'precio',
            'label' => 'precio',
            'rules' => 'trim|required|is_natural_no_zero'
        ),
        array(
            'field' => 'vehicles[]',
            'label' => 'vehículos',
            'rules' => 'callback__validate_vehicles'
        ),
        array(
            'field' => 'cupos_vehiculo[]',
            'label' => 'Cupo vehículos',
            'rules' => 'callback__validate_reserva'
        ),
        array(
            'field' => 'reservas',
            'label' => 'reservas',
            'rules' => 'trim|required|is_natural'
        ),
    ),
);