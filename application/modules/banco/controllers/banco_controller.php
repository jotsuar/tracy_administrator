<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Banco_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar','navbar');
		$this->load->model('banco_model');

			if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1  )

			 	header ("Location:". base_url());
		
	}

	public function index($ok = FALSE, $view = 'banco_index_view')
	{
		$data['ok'] = $ok;
		$this->template->write_view('content','banco/' . $view , $data,TRUE);
		$this->template->render();
	}

	public function registrar()
	{		
		$this->form_validation->set_rules('txtNit', 'Nit', 'trim|required|min_length[4]|xss_clean|is_unique[banco.nit]');
		$this->form_validation->set_rules(
			'txtNombre', 'Nombre', 'trim|required|min_length[4]|xss_clean|is_unique[banco.nombre]'
		);
		$this->form_validation->set_rules('txtDireccion', 'Dirección', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('txtTelefono', 'Teléfono', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('txtCuenta', 'Número de cuenta', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		if (!$this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$respuesta = $this->banco_model->insertar(
				$this->input->post('txtNit', TRUE),
				$this->input->post('txtNombre', TRUE),
				$this->input->post('txtDireccion', TRUE),
				$telefono = $this->input->post('txtTelefono', TRUE),
				$this->input->post('txtCuenta', TRUE)
			);
			if($respuesta) {
				$ok = TRUE;
			} else {
				$ok = FALSE;
			}
		}
		$this->index($ok);
	}

	public function consultar()
	{
		$resultado['datos'] = $this->banco_model->consultar();
		$this->template->write_view('content','banco/banco_consulta_view', $resultado);
		$this->template->render();
	}

	public function buscar($id, $ok = ''){
		$resultado['datos'] = $this->banco_model->buscar($id);
		
		if(!$resultado['datos'])
			header ("Location:". base_url() ."banco/consultar");
		else{
			$resultado['ok'] = $ok;
			$this->template->write_view('content','banco/banco_actualizar_view',$resultado);
		}

		$this->template->render();
		
	}

	public function actualizar(){
		$this->form_validation->set_rules('txtId', 'ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtNit', 'Nit', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('txtNombre', 'Nombre', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('txtDireccion', 'Dirección', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('txtTelefono', 'Teléfono', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('txtCuenta', 'Número de cuenta', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$resultado['datos'] = array();
		$ok = '';
		$id = 0;
		if (!$this->form_validation->run()) {
			$ok = FALSE;
		} else {

			$respuesta = $this->banco_model->actualizar(
				$this->input->post('txtId'),
				$this->input->post('txtNit'),
				$this->input->post('txtNombre'),
				$this->input->post('txtDireccion'),
				$this->input->post('txtTelefono'),
				$this->input->post('txtCuenta'),
				$estado = $this->input->post('estado')
			);

			if($respuesta) {
				$ok = TRUE;
			} else {
				$ok = FALSE;
			}
		}
		$this->buscar($this->input->post('txtId'), $ok);
	}

}
