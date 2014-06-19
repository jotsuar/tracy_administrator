<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitio_turistico_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function register($nombre, $ubicacion, $descripcion, $id_tipo_turismo)
	{
		$sql = "CALL sitio_turistico_register(?, ?, ?, ?)";
		return $this->db->query($sql, array($nombre, $ubicacion, $descripcion, $id_tipo_turismo))->result_id;
	}

	public function additional_services_register($service_add_id)
	{
		$this->db->select_max('id');
		$sitio_turistico = $this->db->get('sitio_turistico')->row();

		$datos = array(
			'id_hospedaje'				=>	NULL,
			'id_servicio_adicional'		=> 	$service_add_id,
			'id_sitio_turistico' 		=>	$sitio_turistico->id
		);
		
		return $this->db->insert('detalle_servicio_adicional', $datos);
	}

	public function see_all_tipo_turismo()
	{
		$this->db->order_by("nombre", "asc");
		return $this->db->get('tipo_turismo')->result();
	}

	public function additional_services_list()
	{
		return $this->db->get_where('servicio_adicional', array('id_tipo_servicio' => 2))->result_array();
	}

	public function listar($nombre = "")
	{

		$this->db->select(
			'sitio_turistico.id,
			sitio_turistico.nombre, 
			sitio_turistico.ubicacion, 
			sitio_turistico.descripcion,
			tipo_turismo.nombre as tipo,
			sitio_turistico.estado'
		);

		$this->db->from('sitio_turistico');
		$this->db->join('tipo_turismo', 'sitio_turistico.id_tipo_turismo = tipo_turismo.id');
		if($nombre == "") {
			return $this->db->get()->result();
		} else {
			$this->db->like('sitio_turistico.nombre', $nombre);
			return $this->db->get()->result();
		}
	}

	public function modificar(
		$id = 0, $nombre = NULL, $ubicacion = NULL, 
		$descripcion = NULL, $id_tipo_turismo = NULL
	){
		if($id != 0 && $nombre == NULL) {
			return $this->db->get_where('sitio_turistico', array('id' => $id))->row();
		} else {
			$sql = "CALL sitio_turistico_update(?, ?, ?, ?, ?)";
			$sql = $this->db->query($sql, array($id, $nombre, $ubicacion, $descripcion, $id_tipo_turismo));
			return $sql->result_id;
		}
	}

	public function additional_services_sitio($id_sitio)
	{
		$this->db->select('
			detalle_servicio_adicional.id_servicio_adicional, 
			detalle_servicio_adicional.id_sitio_turistico'
		);
		$this->db->from('detalle_servicio_adicional');
		$this->db->join(
			'servicio_adicional', 
			'detalle_servicio_adicional.id_servicio_adicional = servicio_adicional.id'
		);
		$this->db->where('detalle_servicio_adicional.id_sitio_turistico', $id_sitio);
		return $this->db->get()->result_array();
	}

	public function delete_addicional_services($id_sitio_turistico)
	{
		return $this->db->delete('detalle_servicio_adicional', array('id_sitio_turistico'=>$id_sitio_turistico));
	}
}