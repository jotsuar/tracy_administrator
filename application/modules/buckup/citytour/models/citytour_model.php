<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Citytour_model extends CI_Model 
{
	/**
	 * El tiempo para la creacion del citytour es a partir de siguiente dia 
	 * de la fecha de creacion aproximandamente a las 6:00AM
	 */

	private $_id;
	private $_nombre;
	private $_fecha;
	private $_hora_inicio;
	private $_hora_fin;
	private $_direccion;
	private $_cupos;
	private $_precio;
	private $_status;

	public function set_id($id){
		$this->_id = $id;
	}

	public function set_nombre($nombre)	{
		$this->_nombre = strtoupper(trim($nombre));
	}

	public function set_fecha($fecha) {
		$this->_fecha = $fecha;
	}

	public function set_hora_inicio($hora_inicio) {
		$this->_hora_inicio = $hora_inicio;
	}

	public function set_hora_fin($hora_fin)	{
		$this->_hora_fin = $hora_fin;
	}

	public function set_direccion($direccion) {
		$this->_direccion = strtoupper(trim($direccion));
	}

	public function set_cupos($cupos) {
		$this->_cupos = (int)$cupos;
	}

	public function set_precio($precio)	{
		$this->_precio = (float)trim($precio);
	}

	public function set_status($status)	{
		$this->_status = (int)trim($status);
	}

	public function register($sitios_turisticos)
	{
		$this->db->set('cupos', $this->_cupos);
		$this->db->set('nombre', $this->_nombre);
		$this->db->set('precio', $this->_precio);
		$this->db->set('direccion_salida', $this->_direccion);
		$this->db->set('fecha', $this->_fecha);
		$this->db->set('hora_inicio', $this->_hora_inicio);
		$this->db->set('hora_inicio', $this->_hora_fin);
		$this->db->insert('citytour');

		$citytour_id = $this->db->insert_id();
		$details = array();

		if(array_key_exists(0, $sitios_turisticos)){
			foreach ($sitios_turisticos as $key => $value) {
				array_push($details, array('id_city_tour' => $citytour_id, 'id_sitio_turistico' => $value));
			}
			return $this->db->insert_batch('detalle_city_tour', $details);
		}
		return TRUE;
	}

	public function consultar($id = NULL, $nombre = NULL, $fecha = NULL) 
	{

		if($fecha != NULL){
			$this->db->where('fecha', $fecha);
		}

		if($nombre != NULL){
			$this->db->like('nombre', strtoupper($nombre));
		}
		
		if($id != NULL){
			$this->db->where('id', $id);
		}
		return $this->db->get('citytour')->result();
	}

	public function modificar($sitios_turisticos, $guias_turisticos, $vehicles)
	{
		$this->db->set('cupos', $this->_cupos);
		$this->db->set('nombre', $this->_nombre);
		$this->db->set('precio', $this->_precio);
		$this->db->set('direccion_salida', $this->_direccion);
		$this->db->set('fecha', $this->_fecha);
		$this->db->set('hora_inicio', $this->_hora_inicio);
		$this->db->set('hora_fin', $this->_hora_fin);
		$this->db->set('estado', $this->_status);
		$this->db->where('id', $this->_id);
		$this->db->update('citytour');

		$details = array();
		$this->db->delete('detalle_city_tour', array('id_city_tour' => $this->_id));

		if(array_key_exists(0, $sitios_turisticos)) {
			foreach ($sitios_turisticos as $key => $value) {
				array_push($details, array('id_city_tour' => $this->_id, 'id_sitio_turistico' => $value));
			}
			$this->db->insert_batch('detalle_city_tour', $details);
		}

		$details = array();

		if(array_key_exists(0, $guias_turisticos)) {
			$this->db->delete('detalle_city_tour_guia', array('id_city_tour' => $this->_id));

			foreach ($guias_turisticos as $key => $value) {
				array_push($details, array('id_city_tour' => $this->_id, 'id_guia' => $value));
			}
			$this->db->insert_batch('detalle_city_tour_guia', $details);
		}

		$details = array();

		if(array_key_exists(0, $vehicles)) {
			$this->db->delete('vehiculo_citytour', array('citytour_id' => $this->_id));
			foreach ($vehicles as $key => $value) {
				array_push($details, array('citytour_id' => $this->_id, 'vehiculo_id' => $value));
			}
			$this->db->insert_batch('vehiculo_citytour', $details);
		}

		return TRUE;
	}

	public function get_reservas($citytour_id)
	{
		$this->db->select('citytour.id');
		$this->db->from('citytour');
		$this->db->join('reserva', 'citytour.id = reserva.id_city_tour');
		$this->db->where('reserva.fecha_fin >=', date('Y-m-d'));
		$this->db->where('citytour.fecha >= reserva.fecha_inicio');
		$this->db->where('citytour.fecha <= reserva.fecha_fin');
		$this->db->where('citytour.id', $citytour_id);
		return $this->db->count_all_results();		
	}
}
