<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipo_turismo_model extends CI_Model {

	private $_id;
	private $_nombre;
	private $_descripcion;

	public function set_nombre($nombre){
		$this->_nombre = $nombre;
	}

	public function set_descripcion($descripcion){
		$this->_descripcion = $descripcion;
	}

	public function registro()
	{
		$this->db->set('nombre', strtoupper($this->_nombre));
		$this->db->set('descripcion', strtoupper($this->_descripcion));	
		return $this->db->insert('tipo_turismo');
	}

	public function listar()
	{
		return $this->db->get('tipo_turismo')->result();										
	}

	// public function buscar_tipo($id)
	// {
	// 	$consulta = $this->db->get_where('tipo_turismo',array('id'=>$id));
	// 		if($consulta->num_rows > 0){
	// 		foreach ($consulta->result() as $fila) {
	// 			$data[] = $fila;
	// 		}
	// 		return $data;
	// 	}
	// 	return FALSE;											
	// }

	public function modificar($id)
	{
		$this->db->set('nombre', strtoupper($this->_nombre));
		$this->db->set('descripcion', strtoupper($this->_descripcion));	
		$this->db->where('id',(int)$id);
		return $this->db->update('tipo_turismo'); 
	}

	public function consultar($id) {
		$this->db->where('id', $id);
		return $this->db->get('tipo_turismo')->row();
	}

}

/* End of file tipo_turismo_model.php */
/* Location: ./application/modules/sitio_turistico/models/tipo_turismo_model.php */