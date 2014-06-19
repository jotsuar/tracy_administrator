<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transporte_Model extends CI_Model 
{

	public function __construct(){
		parent::__construct();
	}

	public function insertar($nit, $nombre, $direccion,$telefono,$correo,$seguro){
		$sql="call sp_insertar_transporte('".$nit."','".$nombre."','".$direccion."','".$telefono."','".$correo."',".$seguro.");";
		if($query = $this->db->query($sql))
			return true;
		return false;
	}

	public function consultar($nombre)
	{
		$sql="CALL sp_consultar_transporte('".$nombre."')";
		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return false;
	}

	public function buscar($id){
		$sql = "SELECT * FROM transporte WHERE id = " . $id;

		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return false;
	}

	public function actualizar($id,$nit,$nombre,$direccion,$telefono,$correo,$seguro,$estado){
		$sql="call sp_modificar_transporte('".$nit."','".$nombre."','".$direccion."',
			'".$telefono."','". $correo ."',".$seguro.",". $estado.",".$id.");";
		if($query = $this->db->query($sql))
			return TRUE;
		return false;
	}

	public function validar($nombre,$id){
		$sql = "SELECT ".$nombre." FROM transporte WHERE id = ".$id;
		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				return $fila;
			}
		}
		return FALSE;
	}

	public function insertar_contacto($id_transporte,$identificacion,$nombre,$apellido,$celular,$email)
	{
		$sql="CALL sp_insertar_contacto_transporte(".$id_transporte.",'".$identificacion."','".$nombre."'
			,'".$apellido."','".$celular."','".$email."');";
		if($query = $this->db->query($sql))
			return true;
		return false;
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
		return false;
	}


	public function buscar_contacto($identi){
		$this->db->select('transporte.id,transporte.nombre,contacto.codigo,contacto.identificacion,contacto.nombres,
											contacto.apellidos,contacto.email,contacto.id_transporte,contacto.celular,contacto.estado');
		$this->db->from('contacto');
		$this->db->join('transporte','transporte.id=contacto.id_transporte');
		$this->db->where('contacto.codigo',$identi);
		return $this->db->get()->result();
	}

public function actualizar_contacto($id_transporte,$identificacion,$nombre,$apellido,$celular,$email,$estado,$id){
		$sql="call sp_modificar_contacto(".$id_transporte.",'".$identificacion."','". $nombre ."','". $apellido ."','".$celular."','". $email ."',". $estado.",".$id.");";
		if($query = $this->db->query($sql))
			return TRUE;
		return false;
	}

		public function validar_contacto($columna,$codigo){
		$sql = "SELECT ".$columna." FROM contacto WHERE codigo = ".$codigo;
		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				return $fila;
			}
		}
		return FALSE;
	}
		public function consultar_combo()
	{
		$this->db->select('id,nombre');
		$this->db->from('transporte');
		$query = $this->db->get();
		return $query->result();
	}

	public function consultar_combo_tipo_vehiculo()
	{
		$this->db->select('id,nombre');
		$this->db->from('tipo_vehiculo');
		$query = $this->db->get();
		return $query->result();
	}		

		public function insertar_vehiculo($id_transporte,$matricula,$tipo,$descripcion,$cupo)
	{
	//	$this->db->select_max('id');
		//$this->db->get('transporte')->result() as  $id 
		//	$id_hospedaje = $value->id;
		 
		 $datos = array(
			'matricula'	=>	$matricula,
			'id_tipo_vehiculo'	=> $tipo,
			'descripcion' => $descripcion,
			'cupo_maximo' => $cupo
		);
		$this->db->insert('vehiculo',$datos);	
		$this->db->select_max('id');
		foreach ($this->db->get('vehiculo')->result() as $value) {
			$id_vehiculo=$value->id;
		}
			$sql="CALL sp_insertar_detalle_vehiculo(".$id_vehiculo.",".$id_transporte.")";
			if($query = $this->db->query($sql))
			return true;
		return false;
		
	}

	public function consultar_vehiculo($matricula)
	{
		$sql="CALL sp_consultar_vehiculo('".$matricula."')";
		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return false;
	}


	public function buscar_vehiculo($id){
		$this->db->select('vehiculo.id,transporte.nombre,vehiculo.matricula,tipo_vehiculo.nombre as "nombres",vehiculo.descripcion,vehiculo.cupo_maximo');
		$this->db->from('vehiculo');
		$this->db->join('tipo_vehiculo','vehiculo.id_tipo_vehiculo=tipo_vehiculo.id','inner');
		$this->db->join('detalle_vehiculo','vehiculo.id=detalle_vehiculo.id_vehiculo','inner');
		$this->db->join('transporte','detalle_vehiculo.id_transporte=transporte.id','inner');
		$this->db->where('vehiculo.id',$id);
		return $this->db->get()->result();
	
}
	public function id_transporte($nombre)
	{
			$id="select id from transporte where nombre='".$nombre."';";
			$query=$this->db->query($id);
			if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return false;
	}
	
	public function insertar_tipo_vehiculo($nombre)
	{
		$sql="CALL sp_insertar_tipo_vehiculo ('".$nombre."');";
		if($query = $this->db->query($sql))
			return true;
		return false;
	}
	
	public function consultar_tipo_vehiculo($nombre)
	{
		$this->db->select('id,nombre');
		$this->db->from('tipo_vehiculo');
		$query = $this->db->get();
		return $query->result();
	
	}

	public function buscar_tipo_vehiculo($p_id){
		$sql = "SELECT id,nombre FROM tipo_vehiculo WHERE id = " . $p_id;

		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return false;
	}

	public function actualizar_tipo_vehiculo($id,$nombre){
		$sql="call sp_modificar_tipo_vehiculo('".$nombre."',".$id.");";
		if($query = $this->db->query($sql))
			return TRUE;
		return false;
	}
	
}
