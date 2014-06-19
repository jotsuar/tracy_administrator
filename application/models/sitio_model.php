<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitio_Model extends CI_Model 
{

	function __construct(){
		parent::__construct();
	}
	/**
	 * [registrar_tipo description]
	 * @param  [type] $nombre
	 * @param  [type] $descripcion
	 * @return [type] true or false
	 */
	public function registrar_tipo($nombre,$descripcion)
	{
		$datos = array('nombre'=>$nombre,
		               'descripcion'=>$descripcion);
		return $this->db->insert('tipo_turismo',$datos);
	}
	/**
	 * [listar_tipo description]
	 * search all registres on the table tipo_turismo
	 * @return [array]
	 */
	public function listar_tipo()
	{
		$consulta = $this->db->get('tipo_turismo');
			if($consulta->num_rows > 0){
			foreach ($consulta->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;											
	}
		public function buscar_tipo($id)
	{
		$consulta = $this->db->get_where('tipo_turismo',array('id'=>$id));
			if($consulta->num_rows > 0){
			foreach ($consulta->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;											
	}
	public function modificar_tipo($id,$nombre,$descripcion)
	{
		$data = array(
			'nombre'=>$nombre,
			'descripcion'=>$descripcion
			);
		$this->db->where('id', $id);
		return $this->db->update('tipo_turismo', $data); 

	}

}