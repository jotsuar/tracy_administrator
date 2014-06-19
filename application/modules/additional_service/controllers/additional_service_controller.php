<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Additional_service_controller extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar', 'navbar');
		$this->load->model('additional_service_model');
			if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1)
			 	header ("Location:". base_url());
	
	}

	public function index($ok = FALSE, $view = 'additional_service/servicio_registro_view')
	{
		$data['ok'] 	= 	$ok;
		$data['tipo']	=	$this->additional_service_model->listar_tipo('tipo_servicio');
		$this->template->write_view('content', $view, $data);
		$this->template->render();
	}

	public function registrar_servicio_add()
	{
		$this->form_validation->set_rules(
			'nombre', 'nombre', 'trim|required|min_length[4]|is_unique[servicio_adicional.nombre]'
		);

		$this->form_validation->set_rules('descripcion', 'descripción', 'trim|min_length[4]|xss_clean');
		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		if (! $this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$tipo 			=	$this->input->post('tipo');
			$categoria 		= 	$this->input->post('nombre',TRUE);
			$descripcion 	= 	$this->input->post('descripcion',TRUE);
			$respuesta 		= 	$this->additional_service_model->registrar_servicio_add($categoria, $descripcion, $tipo);
			if($respuesta) {
				$ok = TRUE;
			} else {
				$ok = FALSE;
			}
		}

		$this->index($ok,'additional_service/servicio_registro_view');
	}

	public function consultar_servicio()
	{
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|min_length[3]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if(!$this->form_validation->run()) {
			$data['ok'] = FALSE;
			$resultado['datos'] 	= $this->additional_service_model->consultar_service();
		} else {
			//$categoria 				= $this->input->post('nombre',TRUE);
			$resultado['datos'] 	= $this->additional_service_model->consultar_service();
			if(!$resultado['datos']) {
				$resultado = array();
			}
		}
		$this->template->write_view('content','additional_service/consultar_servicio_view', $resultado);
		$this->template->render();
	}

	public function listar($num)
	{
	   $resultado['datos'] = $this->additional_service_model->consultar_service($num);
		if(! $resultado['datos']) {
			$resultado = array();
			$this->template->write_view('content', 'additional_service/consultar_servicio_view', $resultado);
		} else {
			$this->template->write_view('content', 'additional_service/consultar_servicio_view', $resultado);
	    }
		$this->template->render();
	}

	public function buscar($id, $ok = '')
	{
		$resultado['datos'] = $this->additional_service_model->listar_tipo_2($id);
		
		if(!$resultado['datos']) {
			header ("Location:". base_url() ."additional_service/consultar_servicio_view'");
		} else {
			$resultado['ok'] 	= 	$ok;
			$resultado['tipo']	= 	$this->additional_service_model->listar_tipo('tipo_servicio');
			$this->template->write_view('content','additional_service/modificar_service_view',$resultado);
		}

		$this->template->render();	
	}

	public function validar($nombre, $id)
	{
		if($this->additional_service_model->validar_service($nombre,$id) == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function modificar_servicio_add()
	{
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('descripcion', 'descripción', 'trim|xss_clean');

		$this->form_validation->set_message('required', 'El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length', 'la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('is_unique', 'El dato %s ya está registrado.');
		$id = $this->input->post("id");
		if (! $this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$tipo 			= 	$this->input->post('tipo');
			$categoria 		= 	$this->input->post('nombre', TRUE);
			$descripcion 	= 	$this->input->post('descripcion', TRUE);

			if($this->validar($categoria,$tipo)) {
				$ok = FALSE;
			} else {
				$respuesta = $this->additional_service_model->modificar_servicio_add(
					$id, $categoria, trim($descripcion), $tipo
				);

				if($respuesta) {
					$ok = TRUE;
				} else {
					$ok = FALSE;
				}
			}
		}
		$this->buscar($id, $ok);
	}
}