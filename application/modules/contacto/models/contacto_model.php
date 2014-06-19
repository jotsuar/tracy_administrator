<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto_model extends CI_Model 
{
	/*
		* $empresa(int) and can be:
		1 hospedaje
		2 transporte 
		3 evento 
		4 citytour
	*/
	public function registrar_contacto(
		$codigo,
		$identificacion, 
		$nombres, 
		$apellidos, 
		$celular, 
		$email,
		$estado, 
		$id_empresa, 
		$empresa
	){

		$data = array(
			'identificacion' 	=> $identificacion,
			'nombres'			=> $nombres,
			'apellidos' 		=> $apellidos,
			'celular' 			=> $celular,
			'email' 			=> $email
		);
		switch ($empresa) {
			case 1:
				$data['id_hospedaje'] = $id_empresa;
				break;
			case 2:
				$data['id_transporte'] = $id_empresa;
				break;
			case 3:
				$data['id_evento'] = $id_empresa;
				break;
			case 4:
				$data['id_sitio'] = $id_empresa;
				break;
		}
		if ($codigo != 0) {
			$data['estado'] = $estado;
			$this->db->where('codigo',$codigo);
			return $this->db->update('contacto',$data); 
		} else {
			return $this->db->insert('contacto',$data);	
		}
	}

	public function combo_contacto($empresa)
	{
		$this->db->select('id, nombre');
		switch ($empresa) {
			case 1:
				return $this->db->get('hospedaje')->result();
				break;
			case 2:
				return $this->db->get('transporte')->result();
				break;
			case 3:
				return $this->db->get('evento')->result();
				break;
			case 4:
				return $this->db->get('sitio_turistico')->result();
				break;
		}
	}

	public function consultar($id_contacto, $empresa)
	{
		$sql = "contacto.codigo,
				contacto.identificacion,
				contacto.nombres,
				contacto.apellidos,
				contacto.celular,
				contacto.email,
				contacto.estado,";

		switch ($empresa) {
			case 1:
				$this->db->select($sql . "contacto.id_hospedaje as 'id_',
					hospedaje.nombre as 'nombre_empresa'"
				);
				$this->db->from('contacto');
				$this->db->join('hospedaje', 'contacto.id_hospedaje = hospedaje.id');
				break;
			case 2:
				$this->db->select($sql . 'contacto.id_transporte as "id_",
					transporte.nombre as "nombre_empresa"'
				);
				$this->db->from('contacto');
				$this->db->join('transporte', 'transporte.id = contacto.id_transporte');	
				break;
			case 3:
				$this->db->select(
					$sql . "contacto.id_evento as 'id_',
					evento.nombre as 'nombre_empresa'"
				);
				$this->db->from('contacto');
				$this->db->join('evento', 'contacto.id_evento = evento.id');			
				break;
			case 4:
				$this->db->select(
					$sql . "contacto.id_sitio as 'id_',
					sitio_turistico.nombre as 'nombre_empresa'"
				);
				$this->db->from('contacto');
				$this->db->join('sitio_turistico', 'contacto.id_sitio = sitio_turistico.id');
				break;
		}

		if (is_string($id_contacto)) {
			$this->db->like('contacto.nombres', $id_contacto); 
			$this->db->or_like('contacto.apellidos',$id_contacto);
			return $this->db->get()->result();
		}
		
		if ($id_contacto === 0) {
			return $this->db->get()->result();
		} else { 
			$this->db->where('contacto.codigo', $id_contacto); 
			return $this->db->get()->result();	
		}
	}

	public function validar($columna,$codigo){
		$sql = "SELECT ".$columna." FROM contacto WHERE codigo = ".$codigo;
		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				return $fila;
			}
		}
		return FALSE;
	}
}
