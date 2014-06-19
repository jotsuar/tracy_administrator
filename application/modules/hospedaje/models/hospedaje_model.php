<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hospedaje_model extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
	}

	public function registrar($nit, $nombre, $direccion, $telefono,	$descripcion, $id_categoria) 
	{
		$sql = "CALL registrar_hospedaje(?, ?, ?, ?, ?, ?)";
		$sql = $this->db->query(
			$sql, 
			array($nit, $nombre, $direccion, $telefono, $descripcion, $id_categoria)
		);
		return $sql->result_id;
	}

	public function modificar($id, $nit, $nombre, $direccion, $telefono, $descripcion, $id_categoria, $estado) 
	{
		$sql = "CALL modificar_hospedaje(?, ?, ?, ?, ?, ?, ?, ?)";
		$sql = $this->db->query(
			$sql, 
			array($id, $nit, $direccion, $telefono, $descripcion, $id_categoria, $estado)
		);
		return $sql->result_id;
	}

	/*Consulta todos los hospedajes disponibles*/
	public function consult_all()
	{
		$this->db->select(
			'hospedaje.id,
			hospedaje.nit,
			hospedaje.nombre,
			hospedaje.direccion,
			hospedaje.telefono,
			categoria.id as id_categoria,
			categoria.categoria,
			hospedaje.estado'
		);

		$this->db->from('hospedaje');
		$this->db->join('categoria', 'hospedaje.id_categoria = categoria.id');
		return $this->db->get()->result();
	}

	public function consultar($id, $nombre)
	{

		$this->db->select(
			'hospedaje.id,
			hospedaje.nit,
			hospedaje.nombre,
			hospedaje.direccion,
			hospedaje.telefono,
			categoria.id as id_categoria,
			categoria.categoria,
			hospedaje.estado'
		);

		$this->db->from('hospedaje');
		$this->db->join('categoria', 'hospedaje.id_categoria = categoria.id');

		if ($id == 0) {
			$this->db->like('hospedaje.nombre', $nombre);
		} else {
			$this->db->where('hospedaje.id', $id); 
		}

		return $this->db->get()->result();
	}

	public function validate($data, $field, $id_hospedaje)
	{
		$this->db->select('hospedaje.' . $field);
		$this->db->from('hospedaje');
		$this->db->where('hospedaje.' . $field, $data);
		$consult 	= $this->db->get();

		$this->db->select('hospedaje.' . $field);
		$this->db->from('hospedaje');
		$this->db->where('hospedaje.' . $field, $data);
		$this->db->where('hospedaje.id', $id_hospedaje);
		$consult_ = $this->db->get();

		if ($consult->num_rows > 0) {
			if ($consult_->num_rows > 0) {
				if ( $consult->result()[0] == $consult_->result()[0] ) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
			return FALSE;
		}
		return TRUE;
	}

	/*Recupera los servicios adicionales asociados a un hospedaje*/
	public function detalle($id_hospedaje)
	{
		$this->db->select(
			'servicio_adicional.id,
			servicio_adicional.nombre'
		);

		$this->db->from('servicio_adicional');
		$this->db->join(
			'detalle_servicio_adicional',
			'detalle_servicio_adicional.id_servicio_adicional = servicio_adicional.id'
		);

		$this->db->join('hospedaje', 'hospedaje.id = detalle_servicio_adicional.id_hospedaje');
		$this->db->where('hospedaje.id', $id_hospedaje);
		return $this->db->get()->result();
	}

	public function register_service_add($id_service_add, $id_hospedaje = 0)
	{
		if ($id_hospedaje == 0) {
			$this->db->select_max('id');
			foreach ($this->db->get('hospedaje')->result() as $value) {
				$id_hospedaje = $value->id;
			}	
		}

		$datos = array(
			'id_hospedaje'				=>	$id_hospedaje,
			'id_servicio_adicional'		=> 	$id_service_add,
			'id_sitio_turistico' 		=>	NULL
		);
		return $this->db->insert('detalle_servicio_adicional', $datos);
	}

	public function registrar_categoria($categoria, $descripcion)
	{
		$sql = "CALL registrar_categoria(
			'".$categoria."',
			'".$descripcion."'
		);";

		if ($this->db->query($sql)) {
			return TRUE;
		}
		return FALSE;
	}

	public function consult_all_categories()
	{
		return $this->db->get('categoria')->result();
	}	

	public function mostrar_categoria()
	{
		return $this->db->get('categoria')->result();
	}

	public function listar_comodidades()
	{
		$this->db->select('id,nombre');
		$this->db->from('servicio_adicional');
		$this->db->where('id_tipo_servicio', 1);
		return $this->db->get()->result();	
	}

	/*Obtiene los servicios adicionales propios de un hospedaje*/
	public function listar_comodidades_hospedaje($id_hospedaje)
	{
		$this->db->select('servicio_adicional.id,servicio_adicional.nombre');
		$this->db->from('servicio_adicional');
		$this->db->join(
			'detalle_servicio_adicional',
			'detalle_servicio_adicional.id_servicio_adicional = servicio_adicional.id'
		);
		$this->db->join('hospedaje', 'detalle_servicio_adicional.id_hospedaje = hospedaje.id');
		$this->db->where('hospedaje.id', $id_hospedaje);
		$this->db->where('detalle_servicio_adicional.id_servicio_adicional !=', 'NULL');
		return $this->db->get()->result();	
	}

	public function modificar_categoria($id,$categoria, $descripcion)
	{
		$sql = "CALL modificar_categoria(
			".$id.",
			'".$categoria."',
			'".$descripcion."'
		);";

		if ($query = $this->db->query($sql)) {
			return TRUE;
		}
		return FALSE;
	}

	public function buscar_categoria($id)
	{
		return $this->db->get_where('categoria', array('id'=>$id))->result();
	}

	public function del_service_add($id_hospedaje)
	{
		return $this->db->delete('detalle_servicio_adicional', array('id_hospedaje'=>$id_hospedaje) );
	}
	
	public function registrar_tipo_habitacion($nombre, $descripcion,$numero)
	{
		$data = array(
			'nombre'			=>	$nombre,
			'descripcion'	=>	$descripcion,
			'cupo_maximo'	=>  $numero
		);
		return $this->db->insert('tipo_habitacion', $data);
	}

	public function mostrar_tipo_habitacion()
	{
		$consulta=$this->db->get('tipo_habitacion');

   if ($consulta->num_rows > 0) {
			foreach ($consulta->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;	
	}

	public function buscar_tipo_habitacion_2($id)
	{
   	$consulta = $this->db->get_where('tipo_habitacion', array('id' => $id));

   if ($consulta->num_rows > 0) {
			foreach ($consulta->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;	
	}
	
	public function validar($columna, $id)
	{
		$sql = "SELECT " . $columna . " FROM tipo_habitacion WHERE id = " . $id;
		$query = $this->db->query($sql);

		if($query->num_rows > 0) {
			foreach ($query->result() as $fila) {
				return $fila;
			}
		}
		return FALSE;
	}

	public function modificar_tipo_habitacion($id, $nombre, $descripcion,$numero)
	{
		$data = array(
			'nombre'			=>	$nombre,
			'descripcion'	=>	$descripcion,
			'cupo_maximo'	=> $numero
		);

		$this->db->where('id', $id);
		return $this->db->update('tipo_habitacion', $data); 
	}

	public function hospedajes($id = 0)
	{
		$this->db->select('id, nombre');
		if ($id == 0) {
			$consulta = $this->db->get('hospedaje');
		} else {
			$this->db->join('habitacion','hospedaje.id = habitacion.id_hospedaje');
			$consulta = $this->db->get_where('hospedaje', array('habitacion.id' => $id));
		}
		
	  if($consulta->num_rows > 0) {
			foreach ($consulta->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}

	public function habitaciones($id = 0)
	{
		$this->db->select('id, nombre');
		if($id == 0){
			$consulta = $this->db->get('tipo_habitacion');
		} else {
			$this->db->join('habitacion','tipo_habitacion.id = habitacion.id_tipohabitacion');
			$consulta = $this->db->get_where('tipo_habitacion', array('habitacion.id'=>$id));
		}
	
	  if($consulta->num_rows > 0) {
			foreach ($consulta->result() as $fila) {
				$data[] = $fila;
			}
			return $data;
		}
		return FALSE;
	}

	public function registrar_habitacion($hospedaje, $tipo_habitacion, $comodidades, $cantidad,$valor)
	{
		$data=array(
			'id_hospedaje'				=>	$hospedaje,
			'id_tipohabitacion'			=>	$tipo_habitacion,
			'comodidades'				=>	$comodidades,
			'cantidad'					=>	$cantidad,
			'valor'						=>  $valor
		);

		return	$this->db->insert('habitacion', $data);
	}

	public function consultar_habitacion()
	{
		$sql = "CALL sp_consultar_habitacion()";
		return $this->db->query($sql)->result();
	}

	public function habitaciones_reserva($id_reserva)
	{
		$this->db->select('tipo_habitacion.nombre,habitacion.valor,hospedaje.nombre as hotel,detalle_habitacion_reserva.cupos');
		$this->db->join('habitacion', 'habitacion.id = detalle_habitacion_reserva.id_habitacion', 'inner');
		$this->db->join('tipo_habitacion', 'tipo_habitacion.id=habitacion.id_tipohabitacion', 'inner');
		$this->db->join('hospedaje', 'hospedaje.id=habitacion.id_hospedaje', 'inner');
		$this->db->where('id_reserva', $id_reserva);
		return $this->db->get('detalle_habitacion_reserva')->result();
		
	}


	public function buscar_habitacion($id)
	{

		$this->db->select(
			'habitacion.id,tipo_habitacion.id as "id_t",
			tipo_habitacion.nombre,hospedaje.nombre as "Hotel" ,
			habitacion.comodidades,habitacion.cantidad,hospedaje.id as "id_h",habitacion.valor '
		);

		$this->db->join('tipo_habitacion', 'habitacion.id_tipohabitacion = tipo_habitacion.id');
		$this->db->join('hospedaje', 'hospedaje.id = habitacion.id_hospedaje');
		return $this->db->get_where('habitacion', array('habitacion.id'=>$id))->result();
	}

	public function modificar_habitacion($id, $hospedaje, $tipo_habitacion, $comodidades, $cantidad,$valor)
	{
		$data = array(
			'id_hospedaje'				=>	$hospedaje,
			'id_tipohabitacion'			=>	$tipo_habitacion,
			'comodidades'				=>	$comodidades,
			'cantidad'					=>	$cantidad,
			'valor'						=>  $valor
		);

		$this->db->where('id', $id);
		return $this->db->update('habitacion', $data);
	}
}