<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transporte extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar', 'navbar');
		$this->template->write_view('content_header', 'transporte/transporte_index_view');
		$this->load->model('transporte_model');
			if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=2 )
			 	header ("Location:". base_url());
		
	}

	public function index($ok = FALSE) 
	{
		$data['ok'] = $ok;
		$this->template->write_view('content', 'transporte/transporte_register_view', $data);
		$this->template->render();
	}

	public function registrar()
	{
		$this->form_validation->set_rules(
			'nit', 
			'NIT', 
			'trim|required|min_length[4]|xss_clean|is_unique[transporte.nit]'
		);	

		$this->form_validation->set_rules(
			'nombre', 
			'nombre', 
			'trim|required|min_length[4]|xss_clean|is_unique[transporte.nombre]'
		);

		$this->form_validation->set_rules('direccion', 'dirección', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('telefono', 'teléfono', 'trim|required|min_length[4]|xss_clean');
		
		$this->form_validation->set_rules(
			'correo', 
			'correo', 
			'trim|required|min_length[4]|valid_email|xss_clean|is_unique[transporte.correo]'
		);

		$this->form_validation->set_message('required', 'El dato %s es obligatorio.');

		$this->form_validation
		->set_message('min_length', 'la cantidad de caracteres del %s es menor a la esperada.');

		$this->form_validation->set_message('valid_email', 'El dato %s no es válido.');
		$this->form_validation->set_message('is_unique', 'El dato %s ya está registrado.');

		if (!$this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$ok = $this->transporte_model->insertar(
				$this->input->post('nit', TRUE),
				strtoupper($this->input->post('nombre', TRUE)),
				$this->input->post('direccion', TRUE),
				$this->input->post('telefono', TRUE),
				$this->input->post('correo', TRUE),
				$this->input->post('seguro_transporte', TRUE)
			);
		}
		$this->index($ok);
	}

	public function modificar()
	{
		$this->form_validation
		->set_rules('id', 'ID', 'trim|numeric|required|xss_clean');

		$this->form_validation
		->set_rules('nit', 'NIT', 'trim|required|min_length[4]|xss_clean|callback_validate[nit]');

		$this->form_validation
		->set_rules('nombre', 'nombre', 'trim|required|min_length[4]|xss_clean|callback_validate[nombre]');

		$this->form_validation
		->set_rules('direccion', 'dirección', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation
		->set_rules('telefono', 'teléfono', 'trim|required|min_length[4]|xss_clean');

		$params = array('correo', 'transporte');

		$this->form_validation->set_rules(
			'correo', 
			'correo', 
			"trim|required|min_length[4]|valid_email|xss_clean|callback_validate[correo]"
		);

		$this->form_validation->set_message('required', 'El dato %s es obligatorio.');

		$this->form_validation
		->set_message('min_length', 'la cantidad de caracteres del %s es menor a la esperada.');

		$this->form_validation->set_message('is_unique', 'El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric', 'El dato %s es un número.');		
		$this->form_validation->set_message('valid_email', 'El correo NO es válido.');
		$this->form_validation->set_message('validate', 'El dato %s ya está registrado.');

		$datos = array();

		if (!$this->form_validation->run()) {
			$datos['ok'] = FALSE;
		} else {
			$datos['ok'] = $this->transporte_model->modificar(
				$this->input->post('id', TRUE),
				$this->input->post('nit', TRUE),
				strtoupper($this->input->post('nombre', TRUE)),
				$this->input->post('direccion', TRUE),
				$this->input->post('telefono', TRUE),
				$this->input->post('correo', TRUE),
				$this->input->post('seguro', TRUE),
				$this->input->post('estado', TRUE)
			);
		}
		$this->buscar($this->input->post('id', TRUE), $datos);
	}

	public function consultar()
	{
		$this->form_validation->set_rules('nombre', '', 'trim|required|xss_clean');
		if (!$this->form_validation->run()) {
			$datos['transportes'] = $this->transporte_model->see_all();
		} else {
			$datos['transportes'] = $this->transporte_model->search(
				$this->input->post('nombre', TRUE)
			);			
		}

		$this->template->write_view('content', 'transporte_consulta_view', $datos);
		$this->template->render();
	}

	public function buscar($id, $datos = NULL)
	{

		$datos['transporte'] = $this->transporte_model->buscar($id);
		if(!isset($datos['transporte']) || empty($datos['transporte'])) {
			redirect("/transporte/consultar");
		}
		$this->template->write_view('content', 'transporte/transporte_actualizar_view', $datos);
		$this->template->render();		
	}

	public function validate($data, $field)
	{
		return $this->transporte_model->validate(
			$data, 
			$field, 
			$this->input->post('id', TRUE)
		);
	}	

	public function validate_vehicle($data, $field)
	{
		return $this->transporte_model->validate_vehicle(
			$data, 
			$field, 
			$this->input->post('id', TRUE)
		);
	}

	public function detalle($id_hospedaje)
	{
		$this->db->select(
			'servicio_adicional.id,
			servicio_adicional.nombre'
		);

		$this->db->from('vehiculo');
		$this->db->join(
			'detalle_servicio_adicional',
			'detalle_servicio_adicional.id_servicio_adicional = servicio_adicional.id'
		);

		$this->db->join('hospedaje', 'hospedaje.id = detalle_servicio_adicional.id_hospedaje');
		$this->db->where('hospedaje.id', $id_hospedaje);
		return $this->db->get()->result();
	}

	public function registrar_vehiculo()
	{
		$datos['empresas'] 				= 	$this->transporte_model->see_all();
		$datos['tipo_vehiculos'] 	= 	$this->transporte_model->see_all_tipo_vehiculo();
			
		$this->form_validation->set_rules(
			'placa', 
			'placa', 
			'trim|required|alpha_numeric|exact_length[6]|xss_clean|is_unique[vehiculo.placa]'
		);

		$this->form_validation->set_rules(
			'descripcion', 
			'descripcion', 
			'trim|min_length[4]|xss_clean'
		);

		$this->form_validation->set_rules('cupos', 'cupos', 'required|trim|is_natural_no_zero|xss_clean');
		
		$this->form_validation->set_message('required', 'El dato %s es obligatorio.');

		$this->form_validation
		->set_message('min_length', 'la cantidad de caracteres del %s es menor a la esperada.');

		$this->form_validation->set_message('is_unique', 'El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric', 'los datos %s deben ser numericos.');
		$this->form_validation->set_message('alpha_numeric', 'los datos %s deben contener numeros y letras.');
		$this->form_validation->set_message('exact_length', 'los datos %s deben contener solo 6 digitos.');

		$this->form_validation->set_message(
			'is_natural_no_zero', 
			'El dato %s debe ser un número positivo mayor a cero.'
		);
				
		if (!$this->form_validation->run()) {
			$datos['ok'] = FALSE;
		} else {
			$datos['ok'] = $this->transporte_model->insertar_vehiculo(
				strtoupper($this->input->post('placa', TRUE)),
				(int) $this->input->post('tipo', TRUE),
				$this->input->post('descripcion', TRUE),
				(int) $cupos = $this->input->post('cupos', TRUE),
				$this->input->post('empresa', TRUE)
			);
		}
		$this->template->write_view('content', 'transporte/vehiculo/vehiculo_register_view', $datos);
		$this->template->render();
	}

	public function modificar_vehiculo()
	{			
		$this->form_validation->set_rules(
			'id', 'id', 'required|trim|is_natural_no_zero|xss_clean'
		);

		$this->form_validation->set_rules(
			'placa', 
			'placa', 
			'trim|required|alpha_numeric|exact_length[6]|xss_clean|callback_validate_vehicle[placa]'
		);

		$this->form_validation->set_rules(
			'descripcion', 
			'descripcion', 
			'trim|xss_clean'
		);

		$this->form_validation->set_rules('id', 'id', 'required|trim|is_natural_no_zero|xss_clean');
		$this->form_validation->set_rules('cupos', 'cupos', 'required|trim|is_natural_no_zero|xss_clean');
		
		$this->form_validation->set_message('required', 'El dato %s es obligatorio.');

		$this->form_validation
		->set_message('min_length', 'la cantidad de caracteres del %s es menor a la esperada.');

		$this->form_validation->set_message('is_unique', 'El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric', 'los datos %s deben ser numericos.');

		$this->form_validation->set_message(
			'alpha_numeric', 
			'los datos %s deben contener numeros y letras.'
		);
		
		$this->form_validation->set_message('exact_length', 'los datos %s deben contener solo 6 digitos.');

		$this->form_validation->set_message(
			'is_natural_no_zero', 
			'El dato %s debe ser un número positivo mayor a cero.'
		);
		$this->form_validation->set_message('validate_vehicle', 'La %s ya está registrada.');
				
		if (!$this->form_validation->run()) {
			$datos['ok'] = FALSE;
		} else {
			$datos['ok'] = $this->transporte_model->modificar_vehiculo(
				strtoupper($this->input->post('placa', TRUE)),
				(int) $this->input->post('tipo', TRUE),
				$this->input->post('descripcion', TRUE),
				(int) $cupos = $this->input->post('cupos', TRUE),
				(int) $this->input->post('empresa', TRUE),
				(int) $this->input->post('estado', TRUE),
				(int) $this->input->post('id', TRUE)
			);
		}
		$this->buscar_vehiculo($this->input->post('id', TRUE), $datos);
	}


	public function consultar_vehiculo()
	{
		$this->form_validation->set_rules('placa', 'placa', 'trim|required|xss_clean');

		if(!$this->form_validation->run()) {
			$datos['vehiculos'] = $this->transporte_model->see_all_vehicles();
		} else {
			$datos['vehiculos'] = $this->transporte_model->consultar_vehiculo(
				strtoupper($this->input->post('placa', TRUE))
			);
		}
		$this->template->write_view('content','transporte/vehiculo/vehiculo_consultar_view', $datos);
		$this->template->render();
	}

	public function buscar_vehiculo($id, $datos = NULL)
	{
		$datos['vehiculo'] = $this->transporte_model->buscar_vehiculo($id);
		
		if (!isset($datos['vehiculo']) || empty($datos['vehiculo'])) {
			redirect("/transporte/vehiculo/consultar");
		} else {
			$datos['empresas'] 				= 	$this->transporte_model->see_all();
			$datos['tipo_vehiculos'] 	= 	$this->transporte_model->see_all_tipo_vehiculo();
			$this->template->write_view('content','transporte/vehiculo/vehiculo_actualizar_view', $datos);
		}

		$this->template->render();		
	}

	public function registrar_tipo_vehiculo()
	{
		$this->form_validation->set_rules
		(
			'tipo_vehiculo', 
			'tipo vehículo', 
			'trim|required|min_length[3]|xss_clean|is_unique[tipo_vehiculo.nombre]'
		);

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$data['ok'] = FALSE;
		if (!$this->form_validation->run()) {
			$data['ok'] = FALSE;
		} else {
			$respuesta = $this->transporte_model->insertar_tipo_vehiculo(
				$this->input->post('tipo_vehiculo', TRUE),
				$this->input->post('descripcion', TRUE)
			);

			$data['ok'] = $respuesta;
		}

		$this->template
		->write_view('content','transporte/vehiculo/tipo_vehiculo/tipo_vehiculo_register_view', $data);

		$this->template->render();
	}

	public function modificar_tipo_vehiculo()
	{
		$this->form_validation->set_rules('id', 'ID', 'numeric|trim|required|xss_clean');
		$this->form_validation->set_rules(
			'tipo', 
			'tipo vehículo', 
			'trim|required|min_length[3]|xss_clean|callback_validate_tipo_vehiculo[nombre]'
		);
	
		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('numeric', 'El dato %s debe ser un número');
		$this->form_validation->set_message('validate_tipo_vehiculo', 'El dato %s ya está registrado.');

		$this->form_validation
		->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if (!$this->form_validation->run()) {
			$datos['ok'] = FALSE;
		} else {
			$datos['ok'] = $this->transporte_model->modificar_tipo_vehiculo(
				$this->input->post('id', TRUE),
				$this->input->post('tipo', TRUE),
				$this->input->post('descripcion', TRUE)
			);
		}
		$this->see_tipo_vehiculo($this->input->post('id', TRUE), $datos);
	}

	public function consultar_tipo_vehiculo()
	{
		$datos['tipos'] = $this->transporte_model->see_all_tipo_vehiculo();
		$this->template->write_view(
			'content', 
			'transporte/vehiculo/tipo_vehiculo/tipo_vehiculo_consultar_view', 
			$datos
		);

		$this->template->render();
	}

	public function see_tipo_vehiculo($id, $datos = NULL)
	{
		$datos['tipo'] = $this->transporte_model->see_tipo_vehiculo($id);
		if (!$datos['tipo']) {
			redirect('/transporte/consultar_tipo_vehiculo');
		}
		$this->template->write_view(
			'content', 
			'transporte/vehiculo/tipo_vehiculo/tipo_vehiculo_actualizar',
			$datos
		);

		$this->template->render();
	}

	public function validate_tipo_vehiculo($data, $field)
	{
		return $this->transporte_model->validate_tipo_vehiculo(
			$this->input->post('id', TRUE),
			$field,
			strtoupper($data)
		);
	}
}