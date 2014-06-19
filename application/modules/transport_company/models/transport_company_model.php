<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transport_company_model extends CI_Model 
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
}
