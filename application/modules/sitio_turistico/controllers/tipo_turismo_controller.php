<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipo_turismo_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar', 'navbar');
		$this->template->write_view('content_header', 'citytour/citytour_index_view');
		$this->load->model('tipo_turismo_model');
	}

	public function index($response = array('success' => FALSE, 'view' => 'tipo_turismo_registrer_view'))
	{
		$this->template->write_view('content', 'sitio_turistico/tipo_turismo/' . $response['view'] , $response);
		$this->template->render();
	}

	public function registrar()
	{
		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','Se esperan más caracteres en el dato %s');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		if ($this->form_validation->run() == FALSE) {
			$response['success'] = FALSE;
		} else {
			$this->tipo_turismo_model->set_nombre($this->input->post('nombre'));
			$this->tipo_turismo_model->set_descripcion($this->input->post('descripcion'));
			$response['success'] = $this->tipo_turismo_model->registro();
		}

		$response['view'] = 'tipo_turismo_registrer_view';
		$this->index($response);
	}

	public function listar()
	{
	   	$response['data'] = $this->tipo_turismo_model->listar();
	   	$response['view'] = 'tipo_turismo_consulta_view';
	   	$this->index($response);
	}

	public function modificar($id = 0)
	{
		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','Se esperan más caracteres en el dato %s');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$this->form_validation->set_message('is_unique_update','El dato %s ya está registrado.');
		

		$id = $this->input->post('id') ? $this->input->post('id') : $id;
		$response['data'] = $this->tipo_turismo_model->consultar($id);

		if($this->form_validation->run() == FALSE) {
			if(isset($response['data']->id) == FALSE) {
				redirect('/sitio_turistico/tipo_turismo/listar');
			}
			$response['success'] 	= 	FALSE;
			$response['view'] 		= 	'tipo_turismo_modificar_view';
			$this->index($response);
		} else {
			$this->tipo_turismo_model->set_nombre($this->input->post('nombre'));
			$this->tipo_turismo_model->set_descripcion($this->input->post('descripcion'));
			$response['success'] = $this->tipo_turismo_model->modificar($id);
			$this->listar();
		}
	}
}

/* End of file tipo_turismo_controller.php */
/* Location: ./application/modules/sitio_turistico/controllers/tipo_turismo_controller.php */