<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hospedaje_Model extends CI_Model 
{

	function __construct(){
		parent::__construct();
	}

	public function registrar($nit,$nombre,$direccion,$telefono,$descripcion,$id_categoria){
		$sql = "CALL sp_registrar_hospedaje('".$nit."','".$nombre."','".$direccion."','".$telefono."','".$descripcion."',".$id_categoria.");";
		if($query = $this->db->query($sql))
			return TRUE;
		return FALSE;
	}

	public function consultar($nombre){
		$sql = "CALL sp_consultar_hospedaje('".$nombre."')";
		$consulta = $this->db->query($sql);
		if($consulta->num_rows > 0){
			foreach ($consulta->result() as $fila) {
				$datos[] = $fila;
			}
			return $datos;
		}
		return FALSE;
	}

	public function registrar_servicio_adicional($id_servicio_adicional){
		$this->db->select_max('id');
		foreach ($this->db->get('hospedaje')->result() as  $value) {
			$id_hospedaje = $value->id;
		}
		$datos = array(
			'id_hospedaje'	=>	$id_hospedaje,
			'id_servicio_adicional'	=> $id_servicio_adicional,
			'id_sitio_turistico' => NULL
		);
		return $this->db->insert('detalle_servicio_adicional',$datos);
	}

	public function registrar_categoria($categoria,$descripcion){
		$sql = "CALL sp_registrar_categoria('".$categoria."','".$descripcion."');";
		if($query = $this->db->query($sql))
			return true;
		return FALSE;
	}

	public function consultar_categoria($categoria){
		$sql="CALL sp_consultar_categoria('".$categoria."')";
		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}	

	public function mostrar_categoria(){
		$sql = "SELECT id,categoria FROM categoria";

		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}

	public function listar_comodidades(){
		$this->db->select('id,nombre');
		$consulta = $this->db->get_where('servicio_adicional',array('tipo_servicio_id'=>1));

		if($consulta->num_rows > 0){
			foreach ($consulta->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}

	public function modificar_categoria($id,$categoria,$descripcion){
		$sql = "CALL sp_modificar_categoria(".$id.",'".$categoria."','".$descripcion."');";

		if($query = $this->db->query($sql))
			return TRUE;
		return FALSE;
	}

	public function buscar_categoria($id){
		$consulta = $this->get_where('categoria',array('id'=>$id));
		if($consulta->num_rows > 0){
			foreach ($consulta->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}
}