<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Convenio_Model extends CI_Model 
{

	public function __construct(){
		parent::__construct();
	}

	public function registrar_convenio
	(
		$tipo_convenio,
		$convenio,
		$id_empresa,
		$numero_convenio,
		$costo,
		$venta,
		$fecha_inicio,
		$fecha_fin,
		$estado
	)
	{
		if ($convenio == 0)
		{
			$fecha = date('Y-m-d');
			if ($tipo_convenio == 4)
			{
				$data = array(
					'numero_convenio'=>$numero_convenio,
					'fecha'=>$fecha,
					'costo'=>$costo,
					'fecha_inicio'=>$fecha_inicio,
					'fecha_fin'=>$fecha_fin,
					'id_banco'=> $id_empresa,
					'tipo_convenio'=>$tipo_convenio
					);
			}else
			{
					$data = array(
					'numero_convenio'=>$numero_convenio,
					'fecha'=>$fecha,
					'costo'=>$costo,
					'fecha_inicio'=>$fecha_inicio,
					'fecha_fin'=>$fecha_fin,
					'tipo_convenio'=>$tipo_convenio,
					'venta'=>$venta,
					);

				switch ($tipo_convenio) {
				case 1:
					$data['id_hospedaje']=$id_empresa;
					
					break;
				case 2:
					$data['id_transporte']=$id_empresa;

					break;
				case 3:
					$data['id_sitio_turistico']=$id_empresa;
					break;
				}
		}

		
			return $this->db->insert('convenio',$data);
		}
		else
		{
			$data=array('estado'=>$estado);
			$this->db->where('id',$convenio);
			return $this->db->update('convenio',$data);
		}

	}
		public function combo_empresa($empresa)
	{
		$this->db->select('id,nombre');
		switch ($empresa) {
			case 1:
				return $this->db->get('hospedaje')->result();
				break;
			case 2:
				return $this->db->get('transporte')->result();
				break;
			case 3:
				$this->db->where('sitio_turistico.convenio', 1);
				return $this->db->get('sitio_turistico')->result();
				break;
			case 4:
				return $this->db->get('banco')->result();
				break;
		}
	}

		public function validar_fecha($fecha)
	{
		$sql='select curdate() as "actual" ';
		$query= $this->db->query($sql);
		$years = 0;

		foreach ($query->result() as $value) {
			$years = $value->actual;
		}

		return ($years <= $fecha) ? TRUE:FALSE; 

	}

	public function consultar($id_convenio,$tipo_convenio,$fecha_inicio,$fecha_fin)
	{
		switch ($tipo_convenio) {
			case 1:
				$this->db->select('		convenio.id, 
										convenio.numero_convenio,
										convenio.tipo_convenio,
										convenio.fecha,
										convenio.fecha_fin,
										convenio.fecha_inicio,
										convenio.costo,
										convenio.venta,
										convenio.id_hospedaje as "id_",
										convenio.estado,
										hospedaje.nombre');
				$this->db->from('convenio');
				$this->db->join('hospedaje', 'convenio.id_hospedaje = hospedaje.id');
				break;
			case 2:
							$this->db->select('convenio.id, 
										convenio.numero_convenio,
										convenio.tipo_convenio,
										convenio.fecha,
										convenio.fecha_fin,
										convenio.fecha_inicio,
										convenio.costo,
										convenio.venta,
										convenio.estado,
										convenio.id_transporte as "id_",
										transporte.nombre');
				$this->db->from('convenio');
				$this->db->join('transporte', 'convenio.id_transporte = transporte.id');
				break;
			case 3:
							$this->db->select('convenio.id,
										convenio.numero_convenio,
										convenio.tipo_convenio,
										convenio.fecha,
										convenio.fecha_fin,
										convenio.fecha_inicio,
										convenio.costo,
										convenio.venta,
										convenio.estado,
										convenio.id_sitio_turistico as "id_",
										sitio_turistico.nombre');
				$this->db->from('convenio');
				$this->db->join('sitio_turistico', 'convenio.id_sitio_turistico = sitio_turistico.id');
				break;
			case 4:
							$this->db->select('convenio.id, 
										convenio.numero_convenio,
										convenio.tipo_convenio,
										convenio.fecha,
										convenio.fecha_fin,
										convenio.fecha_inicio,
										convenio.costo,
										convenio.venta,
										convenio.estado,
										convenio.id_banco as "id_",
										banco.nombre');
				$this->db->from('convenio');
				$this->db->join('banco', 'convenio.id_banco = banco.id');
				break;	

		}

		if($id_convenio===0)
		{
			$this->db->order_by('convenio.estado desc');
			return $this->db->get()->result();
		}
		else 
		{
			$this->db->where('convenio.fecha_inicio >= ',$fecha_inicio);
			$this->db->where('convenio.fecha_fin <= ',$fecha_fin);
			return $this->db->get()->result();

		}
			
	}


}