<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reserva_model extends CI_Model {

	public function get_reservas() {
		$this->db->select('reserva.id,fecha_reserva,fecha_inicio,fecha_fin,valor_total,forma_de_pago,usuario.nombres,usuario.apellidos,estado,reserva.cod_usuario');
		$this->db->join('usuario', 'usuario.id = reserva.cod_usuario', 'inner');
		$this->db->where('fecha_fin >=', date('Y-m-d'));
		$this->db->where('estado !=', 3);
		$this->db->order_by('fecha_fin', 'asc');
		return $this->db->get('reserva')->result();
	}

	public function validate($id) {
		$this->db->set('estado', 1);
		$this->db->where('id', $id);
		$this->db->update('reserva');
	}

	public function invalidate($id){
		$this->db->set('estado', 0);
		$this->db->where('id', $id);
		$this->db->update('reserva');
	}

	public function delete_from_list() {
		$this->db->set('estado', 2);
		$this->db->where('fecha_fin <', date('Y-m-d'));
		$this->db->update('reserva');
	}

	public function get_detail_reserva($id,$id_reserva) {
		
		$this->db->where('cod_usuario', $id);
		$this->db->where('reserva.id', $id_reserva);
		return $informacion =$this->db->get('reserva')->result();
	}

	public function ver_pagos($id_reserva)
	{
		$this->db->select('reserva_id,pago.id,fecha,hora,banco.nombre,forma_pago,valor,valor_restante');
		$this->db->join('banco', 'banco.id=pago.id_banco', 'inner');
		$this->db->where('reserva_id', $id_reserva);
		return $this->db->get('pago')->result();
	}
}
/*
 * public function get_detail_reserva($id) {
		$this->load->model('usuario/usuario_model');
		$detail = array();
		$this->db->where('id', $id);
		$result = $this->db->get('reserva')->row();

		$detail['user'] = $this->usuario_model->get_user_by_id($result->cod_usuario);

		if(isset($result->id)) {
			if($result->id_paquete != NULL) {

			} elseif($result->id_hospedaje != NULL) {
				$this->load->model('hospedaje_model');
				//$detail['hospedaje'] = 
			} elseif($result->id_evento != NULL){

			} elseif($result->id_city_tour != NULL) {
				$this->load->model('citytour/citytour_model');
				$detail['citytour'] = $this->citytour_model->consultar($result->id_city_tour);
			}
		}

		return $detail;
	}
 * */

//0 0 * * * wget http://midominio.com/index.php/micontrolador/mifunción
//se ejecuta cada día
//* * * * * wget http://midominio.com/index.php/micontrolador/mifunción
//se ejecuta cada minuto
//*/5 * * * * wget http://midominio.com/index.php/micontrolador/mifunción
//se ejecuta cada cinco minutos
//0 0 * * 0 wget http://midominio.com/index.php/micontrolador/mifunción
//se ejecuta una vez cada semana
//0 0 1,15 * * wget http://midominio.com/index.php/micontrolador/mifunción
//se ejecuta el día 1 y el 15 de cada mes
//0 0 1 * * wget http://midominio.com/index.php/micontrolador/mifunción
//se ejecuta una vez al mes
//0 0 1 1 * wget http://midominio.com/index.php/micontrolador/mifunción
//se ejecuta una vez al año


/* End of file reserva_model.php */
/* Location: ./application/modules/reserva/models/reserva_model.php */