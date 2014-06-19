<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Model extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
	}

	public function consultar($usuario,$pass,$id)
	{
		$num=0;
		if($id!=0)
		{
			$data = array(
				"lower(usuario)"=>strtolower($usuario),
				"password"=>sha1($pass),
				"estado"=>1
				);
			

			$this->db->select('id_rol');

			foreach ($this->db->get_where('cuenta',$data)->result() as $key ) {

				$num = $key->id_rol;
			 	# code...
			 } 
			 return $num;
		 }
		 else
		 {
		 	
				$data = array(
					"password"=>sha1($pass),
					"estado"=>1
					);		

				$this->db->select('id');

				foreach ($this->db->get_where('cuenta',$data)->result() as $key ) {

					$num = $key->id;
				 	# code...
				 } 
			 	return $num;
		}
	}

	public function actualizar_pass($id,$pass)
	{
		$data=array('password'=>sha1($pass)
			);
		$this->db->where('id',$id);
		return $this->db->update('cuenta',$data); 
	}


}