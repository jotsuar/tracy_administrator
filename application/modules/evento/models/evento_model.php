<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evento_Model extends CI_Model 
{
	public function __construct(){
		parent::__construct();
	}

	public function insertar($nombre,$descripcion,$valor_compra,$valor_venta,$direccion,$cupos,$lugar,$fecha_inicio,$fecha_fin,$hora_inicio,$hora_salida){
		$sql="call sp_insertar_evento('".$nombre."','".$descripcion."',".$valor_compra.",".$valor_venta.",'".$direccion."',".$cupos.",'".$lugar."','".$fecha_inicio."','".$fecha_fin."','".$hora_inicio."','".$hora_salida."');";
		if($query = $this->db->query($sql))
			return TRUE;
		return FALSE;
	}

	public function consultar($nombre)
	{
		$sql = "CALL sp_consultar_evento('".$nombre."')";
		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}

	public function buscar($id){
		$sql = "SELECT * FROM evento WHERE id = " . $id;

		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}

	public function actualizar($id,$nombre,$descripcion,$valor_compra,$valor_venta,$direccion,$cupos,$lugar,$fecha_inicio,$fecha_fin,$hora_inicio,$hora_salida){
		$sql="call sp_modificar_evento('".$nombre."','".$descripcion."','".$valor_compra."','".$valor_venta."','".$direccion."',".$cupos.",'".$lugar."','".$fecha_inicio."','".$fecha_fin."','".$hora_inicio."','".$hora_salida."',".$id.");";
		if($query = $this->db->query($sql))
			return TRUE;
		return FALSE;
	}

	
	public function insertar_contacto($id_evento,$identificacion,$nombre,$apellido,$celular,$email){
		$sql="call sp_insertar_contacto_evento(".$id_evento.",'".$identificacion."','".$nombre."','".$apellido."','".$celular."','".$email."');";
		if($query = $this->db->query($sql))
			return TRUE;
		return FALSE;
	}

	public function consultar_contacto($nombre)
	{
		$sql="CALL sp_consultar_contacto('".$nombre."')";
		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}

	public function consultar_combo()
	{
		$this->db->select('id, nombre');
		return $this->db->get('evento')->result();
	}

	public function actualizar_contacto($codigo,$id_evento,$identificacion,$nombres,$apellidos,$celular,$email,$estado){
		$sql="call sp_modificar_contacto(".$id_evento.",'".$identificacion."','".$nombres."','".$apellidos."','".$celular."','".$email."', ".$estado.",".$codigo.");";
		if($query = $this->db->query($sql))
			return TRUE;
		return FALSE;
	}

	public function buscar_contacto($identi){
				$sql="CALL sp_consultar_contacto('".$identi."')";
				$query = $this->db->query($sql);
			if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}
}
