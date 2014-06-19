<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buckup_Model extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
	}

	

	public function registrar($ruta)
	{
		 $fecha = date('Y-m-d');

		 $data = array(
		 	"ruta"=>$ruta,
		 	"fecha"=>$fecha
		 	);

		 	return $this->db->insert('buckup', $data);

	}
	public function consultar()
	{
		return $this->db->get('buckup')->result();
	}

}