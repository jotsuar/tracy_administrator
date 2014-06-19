<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Novedad_Model extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
	}

	public function consultar_novedad($param_entrada)
	{
		$this->db->select(
			'novedad.fecha, 
			novedad.descripcion,
			novedad.id, novedad.id_reserva,
			usuario.identificacion,
			usuario.nombres, usuario.apellidos,
			reserva.id as reservas'

			);

			$this->db->from('novedad');
			$this->db->join('reserva', 'novedad.id_reserva = reserva.id');
			$this->db->join('usuario', 'reserva.cod_usuario = usuario.id');
		
		if (is_string($param_entrada) == true) {
			$this->db->like('usuario.nombres', $param_entrada); 
			$this->db->or_like('usuario.apellidos', $param_entrada); 
			$this->db->or_like('usuario.identificacion', $param_entrada); 
			return $this->db->get()->result();
		}
		else if ($param_entrada== 0)
		{
			return $this->db->get()->result();
			
		}
		else
		{
			$this->db->where('novedad.id', $param_entrada);
			return $this->db->get()->result();
		}
	}

	public function registrar_actualizar($id,$id_reserva,$descripcion)
	{
		 $fecha = date('Y-m-d');

		 $data = array(
		 	"id_reserva"=>intval($id_reserva),
		 	"descripcion"=>$descripcion,
		 	"fecha"=>$fecha
		 	);


		 if($id==0)
		 	return $this->db->insert('novedad', $data);
		 else
		 {
		 	$this->db->where('id', $id);
		 	return $this->db->update('novedad', $data);
		 }

	}

}