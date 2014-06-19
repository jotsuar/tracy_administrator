<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_Model extends CI_Model 
{

	function __construct(){
		parent::__construct();
	}

	public function insertar_empleado($tipo,$identificacion, $nombre, $apellidos,$telefono,$celular,$correo,$rol)
	{
		
		$sql="call sp_insertar_empleado('".$identificacion."','".$tipo."','".$nombre."','".$apellidos."','". $telefono .
			"','".$celular."','".$correo."');";
		if($query = $this->db->query($sql))
		{
		
				$id=$this->id_user($identificacion);

				foreach ($id as $value) {
					 $id2= $value->id;
				}
				if($id==false)
				{
					return false;
				}

				$sql2="call sp_insertar_cuenta_usuario('".$correo."','".$identificacion."',".$rol.",".$id2.")";

				if($query= $this->db->query($sql2))
				{
					return true;
				}
				else 
				{
					return false;
				}
		}else{
			
				return false;
			}
	}

	public function insertar_cliente($tipo,$identificacion, $nombre, $apellidos,$telefono,$celular,$fecha,$correo,$rol)
	{
		
		$sql="call sp_insertar_cliente('".$identificacion."','".$tipo."','".$nombre."','".$apellidos."','". $telefono .
			"','".$celular."','".$fecha."','".$correo."');";
		if($query = $this->db->query($sql))
		{
		
				$id=$this->id_user($identificacion);

				foreach ($id as $value) {
					 $id2= $value->id;
				}
				if($id==false)
				{
					return false;
				}

				$sql2="call sp_insertar_cuenta_usuario('".$correo."','".$identificacion."',".$rol.",".$id2.")";

				if($query= $this->db->query($sql2))
				{
					return true;
				}
				else 
				{
					return false;
				}
		}else{
			
				return false;
			}
	}

	public function id_user($identificacion)
	{
			$id="select id from usuario where identificacion='".$identificacion."';";
			$query=$this->db->query($id);
			if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return false;
	}

		public function consultar_usuario_cliente($parametro)
	{
		$sql="CALL sp_consultar_usuario_cliente('".$parametro."')";
		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return false;
	}

			public function consultar_usuario_empleado($parametro)
	{
		$sql="CALL sp_consultar_usuario_empleado('".$parametro."')";
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
		$sql = "SELECT * FROM usuario u WHERE u.id = " . $id;

		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return false;
	}

	public function buscar_cuenta($id,$tipo){

		$sql = "SELECT * FROM cuenta u WHERE u.id_usuario = " . $id . " and u.id_rol='".$tipo."'" ;

		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return false;
	}

		public function validar($columna,$id){
		$sql = "SELECT ".$columna." FROM usuario WHERE id = ".$id;
		$query = $this->db->query($sql);
		if($query->num_rows > 0){
			foreach ($query->result() as $fila) {
				return $fila;
			}
		}
		return FALSE;
	}

	public function validar_fecha($fecha)
	{
		$sql="select truncate((datediff(curdate(),'".$fecha."')/365),0) AS 'years' from dual";
		$query= $this->db->query($sql);
		$years = 0;

		foreach ($query->result() as $value) {
			$years = $value->years;
		}

		return ($years >=18) ? TRUE:FALSE; 

	}

	public function actualizar_cuenta($id,$estado,$usuario,$pass)
	{
		$sql = "call sp_actualizar_cuenta_usuario('".$usuario."','".$pass."',".$id.",".$estado.")";
		if($query = $this->db->query($sql))
		{
			return true;
		}
		else 
		{
			return false;
		}
	}

		public function actualizar_empleado($id,$tipo,$identificacion, $nombre, $apellidos,$telefono,$celular,$correo)
	{
		$estado=1;
		$sql="call sp_actualizar_empleado(".$id.",'".$identificacion."','".$tipo."','".$nombre."','".$apellidos."','". $telefono ."','".$celular."','".$correo."');";
		if($query = $this->db->query($sql))
		{
			
		
				$id=$this->id_user($identificacion);

				foreach ($id as $value) {
					 $id2= $value->id;
				}
				if($id==false)
				{
					return false;
				}

				$sql2="call sp_actualizar_cuenta_usuario('".$correo."','".$identificacion."',".$id2.",".$estado.")";

				if($query= $this->db->query($sql2))
				{
					return true;
				}
				else 
				{
					return false;
				}
		}else{
			
				return false;
			}
	}

			public function actualizar_cliente($id,$tipo,$identificacion, $nombre, $apellidos,$telefono,$celular,$fecha,$correo)
	{
		
		$sql="call sp_actualizar_cliente(".$id.",'".$identificacion."','".$tipo."','".$nombre."','".$apellidos."','". $telefono ."','".$celular."','".$fecha."','".$correo."');";
		if($query = $this->db->query($sql))
		{
		
				$id=$this->id_user($identificacion);

				foreach ($id as $value) {
					 $id2= $value->id;
				}
				if($id==false)
				{
					return false;
				}

				$sql2="call sp_actualizar_cuenta_usuario('".$correo."','".$identificacion."',".$id2.",0)";

				if($query= $this->db->query($sql2))
				{
					return true;
				}
				else 
				{
					return false;
				}
		}else{
			
				return false;
			}
	}


}
