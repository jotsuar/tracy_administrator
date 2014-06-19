<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guia_model extends CI_Model 
{

	public function listar_idioma($id)
	{

		switch (intval($id)) {

			case 0:	
				return $this->db->get('idioma')->result_array();
				break;

			case 1000:
				$this->db->select('idioma.id,idioma.nombre, detalle_idioma.id_guia_turistico');
				$this->db->from('idioma');
				$this->db->join('detalle_idioma', 'detalle_idioma.id_idioma = idioma.id');
				$this->db->join('guia_turistico', 'detalle_idioma.id_guia_turistico = guia_turistico.id');
				return $this->db->get()->result();
				break;

			case 2000:
				return $this->db->get('idioma')->result();
				break;
			default:
				$this->db->select('idioma.id,idioma.nombre, detalle_idioma.id_guia_turistico ');
				$this->db->from('idioma');
				$this->db->order_by("idioma.id"); 
				$this->db->join('detalle_idioma', 'detalle_idioma.id_idioma = idioma.id');
				$this->db->join('guia_turistico', 'detalle_idioma.id_guia_turistico = guia_turistico.id');
				$this->db->where('guia_turistico.id', intval($id));
				return $this->db->get()->result_array();
				break;
		}
	}

	public function listar_guia($id = 0)
	{
		if ($id != 0) {
			$this->db->where('id', $id);
		}
		
		return $this->db->get('guia_turistico')->result();
	}

	public function registrar_guia($identificacion, $nombre, $apellido, $telefono, $celular, $email, $estado, $id)
	{

		$data = array(
			'identificacion'	=>	$identificacion,
			'nombre'			=>	$nombre,
			'apellido'			=>	$apellido,
			'telefono' 			=> 	$telefono,
			'celular' 			=> 	$celular,
			'email' 			=> 	$email
		);

		if($id == 0) {
			return $this->db->insert('guia_turistico',$data);
		} else {
			$data['estado'] = $estado;
			$this->db->where('id', $id);			
			return $this->db->update('guia_turistico',$data);
		}
	}

	public function registrar_idioma($id_idioma,$id_guia=0)
	{
		if($id_guia == 0) {
			$this->db->select_max('id');
			foreach ($this->db->get('guia_turistico')->result() as $value) {
				$id_guia = $value->id;
			}	
		}

		$datos = array(
			'id_idioma'					=>	$id_idioma,
			'id_guia_turistico'			=> 	$id_guia
		);
		return $this->db->insert('detalle_idioma', $datos);
	}

	public function eliminar_idioma($id_guia)
	{
		return $this->db->delete('detalle_idioma', array('id_guia_turistico'=>$id_guia) );
	}

	public function validar($columna,$codigo)
	{
		$sql = "SELECT ".$columna." FROM guia_turistico WHERE id = ".$codigo;
		$query = $this->db->query($sql);
		if($query->num_rows > 0) {
			foreach ($query->result() as $fila) {
				return $fila;
			}
		}
		return FALSE;
	}

	public function get_languages($guia_id)
	{
		$this->db->select('idioma.nombre');
		$this->db->from('idioma');
		$this->db->join('detalle_idioma', 'detalle_idioma.id_idioma = idioma.id');
		$this->db->join('guia_turistico', 'guia_turistico.id = detalle_idioma.id_guia_turistico');
		$this->db->where('guia_turistico.id', $guia_id);
		return $this->db->get()->result_array();
	}

	public function get_guide_with_languages($citytour_id){
		$this->db->select('guia_turistico.id ,guia_turistico.nombre, guia_turistico.apellido');
		$this->db->from('guia_turistico');
		$this->db->join('detalle_city_tour_guia', 'guia_turistico.id = detalle_city_tour_guia.id_guia');
		$this->db->join('citytour', 'detalle_city_tour_guia.id_city_tour = citytour.id');
		$this->db->where('citytour.id', $citytour_id);
		$this->db->group_by('guia_turistico.id');

		$response = $this->db->get()->result_array();
		foreach ($response as $llave => $valor) {
			$languages = array();
			foreach ($this->get_languages($response[$llave]['id']) as $key => $value) {
				array_push($languages, $value['nombre']);
			}
			$response[$llave]['languages'] = $languages;
		}

		return $response;
	}

}