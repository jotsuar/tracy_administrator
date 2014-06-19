<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paquete_Model extends CI_Model 
{

	public function registrar_tipo($nombre,$id)
	{
		$data = array('descripcion'=>$nombre);

		if($id==0)
		{
			return $this->db->insert('tipo_paquete', $data);
		}
		else
		{
				   $this->db->where('id', $id);
			return $this->db->update('tipo_paquete', $data);
		}
	}

	public function listar_consultar($id)
	{
		if ($id==0)
		{
			return $this->db->get('tipo_paquete')->result();
		}
		else
		{
			$this->db->where('id', $id);
			return $this->db->get('tipo_paquete')->result();
		}
	}

		public function validar($id)
	{
	{
		$sql 	=	"SELECT descripcion FROM tipo_paquete u WHERE u.id = " . $id;
		$query 	= 	$this->db->query($sql);
		if($query->num_rows > 0) {
			foreach ($query->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}
	}


	public function habitaciones($fecha_inicio,$fecha_fin)
	{
		$sql = "CALL sp_consultar_habitaciones_paquete(?,?)";
		$sql = $this->db->query($sql, array($fecha_inicio,$fecha_fin));
		return $sql->result();
	}

	public function eventos($fecha_inicio,$fecha_fin)
	{
		$this->db->select('evento.nombre as evento, evento.id as id_evento');
		$this->db->from('evento');
		$this->db->where('evento.fecha_inicio <=', $fecha_inicio);
		$this->db->where('evento.fecha_fin >= ', $fecha_fin);
		return $this->db->get()->result();
	}

	public function citytour($fecha_inicio,$fecha_fin)
	{
		$this->db->select('nombre as city,id as city_id');
		$this->db->from('citytour');
		$this->db->where('citytour.fecha <=', $fecha_inicio);
		return $this->db->get()->result();
	}

	public function crear_paquete($id_tipo,$fecha_inicio,$fecha_fin,$id_usuario,$id_evento,$transporte,$id_city_tour,$cupos)
	{
		$data=array(
			"id_tipo"=>$id_tipo,
			"fecha_inicio"=>$fecha_inicio,
			"fecha_fin"=>$fecha_fin,
			"id_usuario"=>1,
			"estado"=>1,
			"id_evento"=>$id_evento,
			"transporte"=>$transporte,
			"id_city_tour"=>$id_city_tour,
			"cupos"=> $cupos
			);

		return $this->db->insert('paquete', $data);
	}

	public function registrar_habitacion($id_habitacion)
	{

		
			$this->db->select_max('id');
			foreach ($this->db->get('paquete')->result() as $value) 
			{
				$id_paquete = $value->id;
			}	


		$datos = array(
			'Id_paquete'					=>	$id_paquete,
			'id_habitacion_hotel'			=> 	$id_habitacion
		);
		return $this->db->insert('detalle_paquete_hospedaje', $datos);

	}

	public function consultar_p($id_paquete)
	{
		if($id_paquete!=0)
		{
			$sql = "CALL sp_consultar_paquetes_2(?)";
						$sql= "select paquete.id, 
					tipo_paquete.descripcion,paquete.fecha_inicio, paquete.fecha_fin, 
					if (paquete.id_evento is null, 'No contiene' ,evento.nombre) Evento,
					if (paquete.id_city_tour is null, 'No contiene' ,citytour.nombre) Citytour,
					if(paquete.transporte = 1 , 'Contiene', 'No contiene') Transporte,
					 usuario.identificacion 'Creador', paquete.cupos, paquete.estado
					from paquete
					inner join evento on paquete.id_evento=evento.id
					INNER JOIN tipo_paquete
					on paquete.id = tipo_paquete.id
					inner join citytour on paquete.id_city_tour=citytour.id
					inner join usuario on paquete.id_usuario=usuario.id where paquete.id =".$id_paquete;
			$sql = $this->db->query($sql);
			return $sql->result();
		}
		else
		{
			//$sql = "CALL sp_consultar_paquetes";
			$sql= "select paquete.id, 
					tipo_paquete.descripcion,paquete.fecha_inicio, paquete.fecha_fin, 
					if (paquete.id_evento is null, 'No contiene' ,evento.nombre) Evento,
					if (paquete.id_city_tour is null, 'No contiene' ,citytour.nombre) Citytour,
					if(paquete.transporte = 1 , 'Contiene', 'No contiene') Transporte,
					 usuario.identificacion 'Creador', paquete.cupos, paquete.estado
					from paquete
					inner join evento on paquete.id_evento=evento.id
					INNER JOIN tipo_paquete
					on paquete.id_tipo = tipo_paquete.id
					inner join citytour on paquete.id_city_tour=citytour.id
					inner join usuario on paquete.id_usuario=usuario.id;";
			$sql = $this->db->query($sql);
			return $sql->result();
		}

	}

	public function consultar_paquetes($id)
	{
		$this->db->select('tipo_paquete.descripcion,paquete.fecha_inicio, paquete.fecha_fin');
		$this->db->join('tipo_paquete', 'paquete.id = tipo_paquete.id_tipo', 'left');
		$this->db->where('paquete.id', $id);
		return $this->db->get('paquete')->result();
	}

	public function detalle($id)
	{
		$this->db->select('tipo_habitacion.nombre,hospedaje.nombre hospedaje');
		$this->db->from('detalle_paquete_hospedaje');
		$this->db->join('habitacion', 'habitacion.id= detalle_paquete_hospedaje.id_habitacion_hotel');
		$this->db->join('tipo_habitacion', 'tipo_habitacion.id= habitacion.id');
		$this->db->join('hospedaje', 'hospedaje.id= habitacion.id_hospedaje');
		$this->db->where('detalle_paquete_hospedaje.id_paquete', $id);
		return $this->db->get()->result();


	}

		public function cambiar_estado($id)
	{
		$sql="select count(reserva.id_paquete) as id_paq, paquete.estado from paquete
				inner join reserva on paquete.id= reserva.id_paquete
				where reserva.id_paquete=".$id;
		$query= $this->db->query($sql);
		
		$est =0;

		foreach ($query->result() as $value) {
			$id_p = $value->id_paq;
			$est= $value->estado;
		}

		if ($est==null)
		{
			$this->db->select('estado');
			$this->db->where('id', $id);
			foreach ($this->db->get('paquete')->result() as  $value) {
				$est=$value->estado;
			}
		}

		if ($id_p==0)
			{
				if($est==0)
					$data = array('estado'=>1);
				else
					$data = array('estado'=>0);

			// echo $est;
			// echo $id_p;
			// 	exit();

				$this->db->where('id', $id);
				return $this->db->update('paquete', $data); 
			} 
		else
			return FALSE;

	}


}