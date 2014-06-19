<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitio_turistico_model extends CI_Model
{
	private $_nombre;
	private $_ubicacion;
	private $_descripcion;
	private $_convenio;

	public function set_nombre($nombre){
		$this->_nombre = strtoupper($nombre);
	}

	public function set_ubicacion($ubicacion){
		$this->_ubicacion = strtoupper($ubicacion);
	}

	public function set_descripcion($descripcion){
		$this->_descripcion = strtoupper($descripcion);
	}

	public function set_convenio($convenio){
		$this->_convenio = (int)$convenio;
	}

	public function register($id_tipo_turismo, $additional_services)
	{
		$this->db->set('nombre', $this->_nombre);
		$this->db->set('ubicacion', $this->_ubicacion);
		$this->db->set('descripcion', $this->_descripcion);
		$this->db->set('id_tipo_turismo', $id_tipo_turismo);
		$this->db->set('convenio', $this->_convenio);

		if($this->db->insert('sitio_turistico')) {
			$this->db->select_max('id');
			$id = $this->db->get('sitio_turistico')->row()->id;
			$detalle = array();

			foreach ($additional_services as $key => $value) {
				array_push($detalle, array('id_hospedaje' => NULL, 'id_servicio_adicional' =>$value, 'id_sitio_turistico' => $id));
			}
			return $this->db->insert_batch('detalle_servicio_adicional', $detalle);
		}

		return FALSE;
/*		$sql = "CALL sitio_turistico_register(?, ?, ?, ?, ?)";
		return $this->db->query($sql, array($nombre, $ubicacion, $descripcion, $id_tipo_turismo, (int)$convenio))->result_id;*/
	}

	// public function additional_services_register($service_add_id, $id_sitio_turistico = 0)
	// {
	// 	if($id_sitio_turistico == 0) {
	// 		$this->db->select_max('id');
	// 		$id_sitio_turistico = $this->db->get('sitio_turistico')->row()->id;
	// 	}
		
	// 	$datos = array(
	// 		'id_hospedaje'				=>	NULL,
	// 		'id_servicio_adicional'		=> 	$service_add_id,
	// 		'id_sitio_turistico' 		=>	$id_sitio_turistico
	// 	);
		
	// 	return $this->db->insert('detalle_servicio_adicional', $datos);
	// }

	// public function delete_addicional_services($id_sitio_turistico)
	// {
	// 	return $this->db->delete('detalle_servicio_adicional', array('id_sitio_turistico' => $id_sitio_turistico));
	// }



	public function additional_services_list()
	{
		return $this->db->get_where('servicio_adicional', array('id_tipo_servicio' => 2))->result_array();
	}

	public function listar($nombre = NULL)
	{

		$this->db->select('
			sitio_turistico.id, sitio_turistico.nombre, sitio_turistico.ubicacion, 
			sitio_turistico.descripcion, tipo_turismo.nombre as tipo, sitio_turistico.convenio,
			sitio_turistico.estado'
		);

		$this->db->from('sitio_turistico');
		$this->db->join('tipo_turismo', 'sitio_turistico.id_tipo_turismo = tipo_turismo.id');
		if(is_null($nombre)) {
			return $this->db->get()->result();
		} else {
			$this->db->like('sitio_turistico.nombre', $nombre);
			return $this->db->get()->result();
		}
	}

	public function list_with_without_agreement(){
		$this->db->select('sitio_turistico.id, sitio_turistico.nombre');
		$this->db->from('sitio_turistico');
		$this->db->join('convenio', 'sitio_turistico.id = convenio.id_sitio_turistico', 'left');
		$this->db->where('sitio_turistico.estado', 1);
		$this->db->order_by('sitio_turistico.nombre', 'asc');
		return $this->db->get()->result();

		/*
		SELECT s.id, s.nombre, s.convenio, c.fecha
		FROM sitio_turistico AS s 
		LEFT JOIN convenio AS c ON s.id = c.id_sitio_turistico
		WHERE s.estado = 1
		ORDER BY s.nombre;
		 */
	}

	/**
	 * Devuelve los sitios turistico relacionados a un cititour por medio de la tabla detalle 
	 * entre sitio turisticos y citytour
	 * @param  int $id_citytour
	 * @return stdClass
	 */
	public function single_detail($id_citytour){
		
		$this->db->select('sitio_turistico.id');
		$this->db->from('sitio_turistico');
		$this->db->join('detalle_city_tour', 'sitio_turistico.id = detalle_city_tour.id_sitio_turistico');
		$this->db->join('citytour', 'detalle_city_tour.id_city_tour = citytour.id');
		return $this->db->where('citytour.id', $id_citytour)->get()->result();

		/*
		SELECT sitio_turistico.id, sitio_turistico.nombre  FROM sitio_turistico
		INNER JOIN detalle_city_tour ON sitio_turistico.id = detalle_city_tour.id_sitio_turistico
		INNER JOIN citytour ON detalle_city_tour.id_city_tour = citytour.Id
		WHERE citytour.Id = 7;
		 */
	}

	public function modificar(
		$id = 0, $nombre = NULL, $ubicacion = NULL, 
		$descripcion = NULL, $id_tipo_turismo = NULL, $convenio = 0, $estado = 0
	){
		if($id != 0 && $nombre == NULL) {
			return $this->db->get_where('sitio_turistico', array('id' => $id))->row();
		} else {
			$sql = "CALL sitio_turistico_update(?, ?, ?, ?, ?, ?, ?)";
			$sql = $this->db->query($sql, array($id, $nombre, $ubicacion, $descripcion, $id_tipo_turismo, (int) $convenio, (int)$estado));
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
}