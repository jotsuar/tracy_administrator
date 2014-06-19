<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transporte_model extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
	}

	public function insertar($nit, $nombre, $direccion, $telefono, $correo, $seguro)
	{
		$sql = "CALL insertar_transporte(?, ?, ?, ?, ?, ?)";
		$sql = $this->db->query($sql, array($nit, $nombre, $direccion, $telefono, $correo, $seguro));
		return $sql->result_id;
	}

	public function consultar()
	{
		return $this->db->get('transporte')->result();
	}

	public function see_all()
	{
		$this->db->order_by("nombre", "asc");
		return $this->db->get('transporte')->result();
	}

	public function search($name)
	{
		$this->db->like('nombre', $name);
		return $this->db->get('transporte')->result();
	}

	public function buscar($id)
	{
		return $this->db->get_where('transporte', array('id' => $id))->row();
	}

	public function modificar($id, $nit, $nombre, $direccion, $telefono, $correo, $seguro, $estado)
	{
		$sql = "CALL sp_modificar_transporte(?, ?, ?, ?, ?, ?, ?, ?)";
		$sql = $this->db
		->query($sql, array($id, $nit, $nombre, $direccion, $telefono, $correo, (int) $seguro, (int) $estado));
		return $sql->result_id;
	}

	public function validate($data, $field, $id)
	{
		$query_one = $this->db->get_where('transporte', array($field => $data))->row();
		$query_two = $this->db->get_where('transporte', array('id' => $id))->row();

		if ($query_one->$field != $query_two->$field) {
			return FALSE;
		}
		return TRUE;
	}

	public function validate_vehicle($data, $field, $id)
	{
		$query_one = $this->db->get_where('vehiculo', array($field => $data))->row();
		$query_two = $this->db->get_where('vehiculo', array('id' => $id))->row();

		if ($query_one->$field != $query_two->$field) {
			return FALSE;
		}
		return TRUE;
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

	public function see_all_vehicles()
	{
		$sql = "CALL see_all_vehicles()";
		return $sql = $this->db->query($sql)->result();
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
}
