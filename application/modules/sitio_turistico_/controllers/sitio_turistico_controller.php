<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitio_turistico_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar', 'navbar');
		$this->template->write_view('content_header', 'citytour/citytour_index');
		$this->load->model('sitio_turistico_model');
		$this->load->helper('array');
			if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1 )
			 	header ("Location:". base_url());
		
	}

	public function index($ok = FALSE)
	{
		$data['ok'] = $ok;
		$data['tipos_turismos'] 		= $this->sitio_turistico_model->see_all_tipo_turismo();
		$data['additional_services'] 	= $this->sitio_turistico_model->additional_services_list();
		$this->template->write_view('content', 'sitio_turistico/sitio_turistico_register', $data);
		$this->template->render();
	}

	public function register()
	{
		$this->form_validation->set_rules(
			'nombre', 
			'nombre', 
			'trim|required|min_length[5]|xss_clean|is_unique[sitio_turistico.nombre]'
		);

		$this->form_validation->set_rules(
			'ubicacion', 
			'ubicacion', 
			'trim|required|min_length[5]|xss_clean|is_unique[sitio_turistico.ubicacion]'
		);

		$this->form_validation->set_rules(
			'tipo_turismo', 
			'tipo turismo', 
			'trim|required|xss_clean|numeric'
		);

		$this->form_validation->set_message('required', 'El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length', 'Los caracteres de %s no son suficientes.');
		$this->form_validation->set_message('numeric', 'El dato %s debe ser un número.');
		$this->form_validation->set_message('is_unique', 'El dato %s ya está registrado.');

		if (!$this->form_validation->run()) {
			$ok = FALSE;
		}
		else {
			$ok = $this->sitio_turistico_model->register(
				$this->input->post('nombre', TRUE),
				$this->input->post('ubicacion', TRUE),
				$this->input->post('descripcion', TRUE),
				$this->input->post('tipo_turismo', TRUE)
			);

			if($ok) {
				foreach ($this->input->post() as $key => $value) {
					if (stristr($key, 'check')) {
						$this->sitio_turistico_model->additional_services_register($value);
					}
				}
			}
		}
		$this->index($ok);
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

		$this->form_validation->set_message('required', 'El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length', 'Los caracteres de %s no son suficientes.');
		$this->form_validation->set_message('numeric', 'El dato %s debe ser un número.');
		$this->form_validation->set_message('is_unique', 'El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric', 'El dato %s debe ser un número.');

		if (!$this->form_validation->run()) {
			$datos['ok'] = FALSE;
			if($id == 0) {
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
				$this->input->post('tipo_turismo', TRUE)
			);

			if ($datos['ok']) {
				if ($this->sitio_turistico_model
					->delete_addicional_services($this->input->post('id', TRUE))) {
					foreach ($this->input->post() as $key => $value) {
						if (stristr($key, 'check')) {
							$this->sitio_turistico_model->additional_services_register($value);
						}
					}
				}
			}
			$datos['sitio'] = $this->sitio_turistico_model->modificar($this->input->post('id', TRUE));
			$datos['detalle_sitio'] = $this->sitio_turistico_model->additional_services_sitio($this->input->post('id', TRUE));
			$datos['additional_services'] = $this->sitio_turistico_model->additional_services_list();
			$datos['turismos'] = $this->sitio_turistico_model->see_all_tipo_turismo();
			// echo "hola";
			// echo "<pre>";
			// print_r($datos['detalle_sitio']);
			// exit();
		} 
		$this->template->write_view('content', 'sitio_turistico/sitio_turistico_modificar_vw', $datos);
		$this->template->render();
	}
}