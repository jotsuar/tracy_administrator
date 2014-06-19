<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Additional_service_model extends CI_Model 
{
	public function listar_tipo($tabla)
	{
		$sql = "SELECT * FROM " . $tabla;
		$query = $this->db->query($sql);
		if($query->num_rows > 0) {
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}

	public function listar_tipo_2($id)
	{
		$sql = 'select servicio_adicional.id, servicio_adicional.nombre, servicio_adicional.descripcion,
		tipo_servicio.nombre as "nombres", tipo_servicio.id as "id_2" from servicio_adicional
		inner join tipo_servicio on servicio_adicional.id_tipo_servicio = tipo_servicio.id 
		where servicio_adicional.id = ' . $id;

		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}

	public function registrar_servicio_add($nombre, $descripcion, $tipo_servicio)
	{
		$datos = array(
			'nombre'			=>	$nombre,
			'descripcion'		=>	$descripcion,
			'tipo_servicio_id'	=>	$tipo_servicio
		);
		return $this->db->insert('servicio_adicional', $datos);
	}

	public function consultar_service()
	{
		return $this->db->query("call sp_servicio_adicional()")->result();
	}

	public function validar_service($nombre, $id)
	{
		$sql="select fc_validar_servicio('".$nombre."',".$id.")";
		$query = $this->db->query($sql);
				if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}

	public function modificar_servicio_add($id, $nombre, $descripcion, $tipo_servicio)
	{

		$sql = "call sp_modificar_servicio('".$nombre."','".$descripcion."',".$tipo_servicio.",".$id.")";
		if($query = $this->db->query($sql))	{
			return TRUE;
		} else {
			return FALSE;
		}
	}
}