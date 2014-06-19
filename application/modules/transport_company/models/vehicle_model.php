<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicle_model extends CI_Model {

	private $_placa;
	private $_description;
	private $_cupo;
	private $_state;

	public function set_placa($placa){
		$this->_placa = $placa;
	}

	public function set_description($description){
		$this->_description = $description;
	}

	public function set_cupo($cupo){
		$this->_cupo = $cupo;
	}

	public function set_state($state){
		$this->_state = $state;
	}

	public function insertar_vehiculo($placa, $id_tipo_vehiculo, $descripcion, $cupos, $id_transporte)
	{
		$sql = "CALL sp_insertar_vehiculo(?, ?, ?, ?, ?)";
		$sql = $this->db->query($sql, array($placa, $id_tipo_vehiculo, $descripcion, $cupos, $id_transporte));
		return $sql->result_id;
	}

	public function modificar_vehiculo($placa, $id_tipo_vehiculo, $descripcion, $cupos, $id_transporte, $estado, $id)
	{
		$sql = "CALL modificar_vehiculo(?, ?, ?, ?, ?, ?, ?)";
		$sql = $this->db->query($sql, array($placa, $id_tipo_vehiculo, $descripcion, $cupos, $id_transporte, $estado, $id));
		return $sql->result_id;
	}

	public function consult()
	{
		return $sql = $this->db->query($sql)->result();
	}

	public function consult_with_ajax($transport_company_id = NULL, $vehicle_id = NULL) {
		$this->db->select('vehiculo.id, vehiculo.placa, tipo_vehiculo.nombre as tipo, vehiculo.cupo_maximo');
		$this->db->from('vehiculo');
		$this->db->join('transporte', 'transporte.id = vehiculo.id_transporte');
		$this->db->join('tipo_vehiculo', 'vehiculo.id_tipo_vehiculo = tipo_vehiculo.id');
		if(is_null($vehicle_id)){
			$this->db->where('transporte.id', $transport_company_id);
			return $this->db->get()->result();
		} else {
			$this->db->where('vehiculo.id', $vehicle_id);
			return $this->db->get()->row();
		}
	}

	public function buscar_vehiculo($id)
	{
		$this->db->select(
			'vehiculo.id, transporte.id as id_transporte, transporte.nombre as empresa, 
			vehiculo.placa, tipo_vehiculo.nombre as tipo, tipo_vehiculo.id as id_tipo_vehiculo, vehiculo.descripcion,
			vehiculo.cupo_maximo, vehiculo.estado'
		);
		$this->db->from('vehiculo');
		$this->db->join('transporte', 'vehiculo.id_transporte = transporte.id');
		$this->db->join('tipo_vehiculo', 'vehiculo.id_tipo_vehiculo = tipo_vehiculo.id');
		$this->db->where('vehiculo.id', $id);
		return $this->db->get()->row();
	}

	public function consultar_vehiculo($placa, $id_transporte = 0)
	{
		$sql = "CALL consultar_vehiculo(?, ?)";
		if($id_transporte != 0) {
			return $this->db->query($sql, array(NULL, $id_transporte))->result_array();
		} else {
			return $this->db->query($sql, array($placa, 0))->result();
		}
		
	}

	
	public function insertar_tipo_vehiculo($nombre, $descripcion)
	{
		$sql = "CALL sp_insertar_tipo_vehiculo(?, ?)";
		$sql = $this->db->query($sql, array($nombre, $descripcion));
		return $sql->result_id;
	}

	public function see_all_tipo_vehiculo()
	{
		return $query = $this->db->get('tipo_vehiculo')->result();
	}		

	public function see_tipo_vehiculo($id)
	{
		return $this->db->get_where('tipo_vehiculo', array('id' => $id))->row();
	}

	public function modificar_tipo_vehiculo($id, $nombre, $descripcion) 
	{
		$sql = "CALL sp_modificar_tipo_vehiculo(?, ?, ?);";
		$sql = $this->db->query($sql, array($id, $nombre, $descripcion));
		return $sql->result_id;
	}

	public function validate_tipo_vehiculo($id, $field, $data)
	{
		$query_one = $this->db->get_where('tipo_vehiculo', array($field => $data))->row();
		$query_two = $this->db->get_where('tipo_vehiculo', array('id' 	=> $id))->row();
		if (isset($query_one->nombre) && isset($query_two->nombre)) {
			if ($query_one->nombre != $query_two->nombre) {
				return FALSE;
			}
		}
		return TRUE;
	}

	//obtien el detalle de los vehiculos asociados a un citytour
	public function get_vehicles_citytour($citytour_id){
		$this->db->select('vehiculo.placa, tipo_vehiculo.nombre AS tipo, transporte.nombre AS transporte');
		$this->db->from('vehiculo');
		$this->db->join('tipo_vehiculo', 'vehiculo.id_tipo_vehiculo = tipo_vehiculo.id');
		$this->db->join('transporte', 'transporte.id = vehiculo.id_transporte');
		$this->db->join('vehiculo_citytour', 'vehiculo.id = vehiculo_citytour.vehiculo_id');
		$this->db->join('citytour', 'citytour.id = vehiculo_citytour.citytour_id');
		$this->db->where('citytour.id', (int)$citytour_id);
		return $this->db->get()->result();
	}
}

/* End of file vehicle_model.php */
/* Location: ./application/modules/transporte/models/vehicle_model.php */