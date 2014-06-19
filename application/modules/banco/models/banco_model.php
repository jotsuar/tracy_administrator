	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banco_Model extends CI_Model 
{

	function __construct(){
		parent::__construct();
	}

	public function insertar($nit, $nombre, $direccion,$telefono,$cuenta)
	{
		
		$sql="call sp_insertar_banco('".$nit."','".$nombre."','".$direccion."','".$telefono."','". $cuenta ."');";
		if($query = $this->db->query($sql))
			return true;
		return false;
	}

	public function buscar($id){
		$sql = "SELECT * FROM banco b WHERE b.id = " . $id;

		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return false;
	}

	public function actualizar($id, $nit, $nombre, $direccion, $telefono, $cuenta, $estado){
		$sql="call sp_modificar_banco('".$nit."','".$nombre."','".$direccion."','".$telefono."','". $cuenta ."',". $estado.",".$id.");";
		if($query = $this->db->query($sql)) {
			return TRUE;
		}
		return false;
	}

	public function consultar()
	{
		return $this->db->get('banco')->result();
	}
}
?>

