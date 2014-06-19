<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitio_turistico_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar', 'navbar');
		$this->template->write_view('content_header', 'citytour/citytour_index_view');
		$this->load->model('sitio_turistico_model');
		$this->load->model('tipo_turismo_model');
	}

	public function index($response = array('success' => FALSE))
	{
		$response['tipos_turismos'] 		= $this->tipo_turismo_model->listar();
		$response['additional_services'] 	= $this->sitio_turistico_model->additional_services_list();
		$this->template->write_view('content', 'sitio_turistico/sitio_turistico_register', $response);
		$this->template->render();
	}

	public function register()
	{
		$this->form_validation->set_message('required', 'El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length', 'Los caracteres de %s no son suficientes.');
		$this->form_validation->set_message('is_natural_no_zero', 'El dato %s debe ser un número mayor a cero.');
		$this->form_validation->set_message('is_unique', 'El dato %s ya está registrado.');

		if ($this->form_validation->run() == FALSE) {
			$this->response['success'] = FALSE;
		} else {
			$additional_services = array();
			/**
			 * Recorre los valores del POST y busca si hay alguno con la palabra check,
			 * para agregarlo en un array.
			 */
			foreach ($this->input->post() as $key => $value) {
				if (stristr($key, 'check')) {
					array_push($additional_services, $value);
				}
			}
			$this->sitio_turistico_model->set_nombre($this->input->post('nombre'));
			$this->sitio_turistico_model->set_ubicacion($this->input->post('ubicacion'));
			$this->sitio_turistico_model->set_descripcion($this->input->post('descripcion'));
			$this->sitio_turistico_model->set_convenio($this->input->post('convenio'));

			$this->response['success'] = $this->sitio_turistico_model->register(
				$this->input->post('tipo_turismo'), $additional_services
			);
		}

		$this->index($this->response);
	}

	public function listar()
	{
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|xss_clean');
		if(!$this->form_validation->run()) {
			$datos['sitios'] = $this->sitio_turistico_model->listar();
		} else {
			$datos['sitios'] = $this->sitio_turistico_model->listar($this->input->post('nombre', TRUE));
		}
		$this->template->write_view('content', 'sitio_turistico/sitio_turistico_list_vw', $datos);
		$this->template->render();
	}

	public function modificar($id = 0)
	{
		$this->form_validation->set_rules('id', 'ID', 'trim|required|numeric|xss_clean');

		$this->form_validation->set_rules(
			'nombre', 
			'nombre', 
			'trim|required|min_length[5]|xss_clean'
		);

		$this->form_validation->set_rules(
			'ubicacion', 
			'ubicacion', 
			'trim|required|min_length[5]|xss_clean'
		);

		$this->form_validation->set_rules(
			'tipo_turismo', 
			'tipo turismo', 
			'trim|required|xss_clean|numeric'
		);

		$this->form_validation->set_rules(
			'estado', 
			'estado', 
			'trim|required|xss_clean|numeric'
		);

		$this->form_validation->set_message('required', 'El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length', 'Los caracteres de %s no son suficientes.');
		$this->form_validation->set_message('numeric', 'El dato %s debe ser un número.');
		$this->form_validation->set_message('is_unique', 'El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric', 'El dato %s debe ser un número.');

		if (!$this->form_validation->run()) {
			$datos['ok'] = FALSE;
			if($id <= 0) {
				redirect('/sitio_turistico/lista');	
			} else {
				$datos['sitio'] = $this->sitio_turistico_model->modificar($id);
				if(empty($datos['sitio'])) {
					redirect('/sitio_turistico/lista');
				}
				$datos['detalle_sitio'] = $this->sitio_turistico_model->additional_services_sitio($id);
				$datos['additional_services'] = $this->sitio_turistico_model->additional_services_list();
				$datos['turismos'] = $this->sitio_turistico_model->see_all_tipo_turismo();
			}
		} else {
			$datos['ok'] = $this->sitio_turistico_model->modificar(
				$this->input->post('id', TRUE),
				$this->input->post('nombre', TRUE),
				$this->input->post('ubicacion', TRUE),
				$this->input->post('descripcion', TRUE),
				$this->input->post('tipo_turismo', TRUE),
				$this->input->post('convenio', TRUE),
				$this->input->post('estado', TRUE)
			);

			if ($datos['ok']) {
				if ($this->sitio_turistico_model
					->delete_addicional_services($this->input->post('id', TRUE))) {
					foreach ($this->input->post() as $key => $value) {
						if (stristr($key, 'check')) {
							$this->sitio_turistico_model->additional_services_register($value, $this->input->post('id', TRUE));
						}
					}
				}
			}
			$datos['sitio'] 				= $this->sitio_turistico_model->modificar($this->input->post('id', TRUE));
			$datos['detalle_sitio'] 		= $this->sitio_turistico_model->additional_services_sitio($this->input->post('id', TRUE));
			$datos['additional_services'] 	= $this->sitio_turistico_model->additional_services_list();
			$datos['turismos'] 				= $this->sitio_turistico_model->see_all_tipo_turismo();
		} 
		$this->template->write_view('content', 'sitio_turistico/sitio_turistico_modificar_vw', $datos);
		$this->template->render();
	}




	public function buscar($id, $ok = '')
	{
		$resultado['datos'] = $this->sitio_turistico_model->buscar_tipo($id);
		
		if(!$resultado['datos']) {
			$this->template->write_view('content','sitio_turistico/sitio_index');
			header ("Location:". base_url() .'sitio_turistico/tipo_turismo/tipo_turismo_consulta_view');
		} else {
			$resultado['ok'] 	= 	$ok;
			$resultado['tipo'] 	=	$this->sitio_turistico_model->listar_tipo('');

			$this->template->write_view(
				'content', 'sitio_turistico/tipo_turismo/tipo_turismo_modificar_view', $resultado
			);
		}
		$this->template->render();
	}

	public function modificar_tipo()
	{
		$this->form_validation->set_rules('categoria', 'categoría', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('descripcion', 'descripción', 'trim|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');

		$this->form_validation->set_message(
			'min_length',
			'la cantidad de caracteres del %s es menor a la esperada.'
		);

		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$id = 0;

		if(!$this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$id 			= $this->input->post('id', TRUE);
			$categoria 		= $this->input->post('categoria', TRUE);
			$descripcion 	= $this->input->post('descripcion', TRUE);

			$respuesta = $this->sitio_turistico_model->modificar_tipo($id, $categoria, $descripcion);
			($respuesta) ? $ok = TRUE : $ok = FALSE;
		}

		$this->buscar($id, $ok);
	}
}