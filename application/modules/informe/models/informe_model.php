<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informe_Model extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
	}


	public function listado_clientes()
	{
		$this->db->select(
			'usuario.identificacion,
			 usuario.nombres,
			 usuario.tipo_documento,
			 usuario.apellidos,
			 usuario.telefono,
			 usuario.celular,
			 usuario.fecha_nacimiento,
			 usuario.email,
			 usuario.tipo,
			 cuenta.usuario,
			 cuenta.password,
			 cuenta.estado');

		$this->db->from('usuario');
		$this->db->join('cuenta', 'cuenta.id_usuario= usuario.id');
		$this->db->where('usuario.tipo <>', 'Empleado');
		$this->db->order_by('cuenta.estado', 'desc');
		return $this->db->get()->result();
	}

	public function clientes_externos()
	{
		$this->db->select(
			'cliente_externo.identificacion,
			cliente_externo.nombre,
			cliente_externo.edad,
			usuario.identificacion as ident,
			usuario.nombres,
			usuario.apellidos,
			reserva.id as "Numero Reserva"');
		$this->db->from('cliente_externo');
		$this->db->join('cliente_externo_reserva',
						 'cliente_externo_reserva.id_cliente_externo = cliente_externo.id');
		$this->db->join('reserva', 'reserva.id = cliente_externo_reserva.id_reserva');
		$this->db->join('usuario', 'reserva.cod_usuario = usuario.id');
		return $this->db->get()->result();
	}
	public function cliente_reserva()
	{
		$sql 	= 	"CALL cliente_reserva()";
		$query 	= 	$this->db->query($sql);

		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return "hola";
	}


	public function validar_ids($id)
	{

			$this->db->select('id_hospedaje');
			foreach ($this->db->get('guia_turistico')->result() as $value) 
			{
				$ids = $value->id;
			}	
	}







}