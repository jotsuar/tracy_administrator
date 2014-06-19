<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banco_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('banco_model');
	}

	public function index($ok = FALSE,$view = 'banco_index_view')
	{
		$data['ok'] = $ok;
		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','empresas/banco/'.$view,$data,TRUE);
		$this->template->render();
	}

	public function registrar()
	{
		
		$this->form_validation->set_rules('txtNit', 'Nit', 'trim|required|min_length[4]|xss_clean|is_unique[banco.nit]');
		$this->form_validation->set_rules('txtNombre', 'Nombre', 'trim|required|min_length[4]|xss_clean|is_unique[banco.nombre]');
		$this->form_validation->set_rules('txtDireccion', 'Dirección', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('txtTelefono', 'Teléfono', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('txtCuenta', 'Número de cuenta', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		if (!$this->form_validation->run())
			$ok = FALSE;
		else{

			$nit = $this->input->post('txtNit');
			$nombre = $this->input->post('txtNombre');
			$direccion = $this->input->post('txtDireccion');
			$telefono = $this->input->post('txtTelefono');
			$cuenta = $this->input->post('txtCuenta');

			$respuesta = $this->banco_model->insertar($nit,$nombre,$direccion,$telefono,$cuenta);
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}
		$this->index($ok);
	}

	public function consultar(){
		$this->form_validation->set_rules('txtNombre', 'Nombre', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if(!$this->form_validation->run())
		{
			$data['ok'] = 0;
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/banco/banco_consulta_view',$data);
		}
		else{
			
			$nombre = $this->input->post('txtNombre');
			$resultado['datos'] = $this->banco_model->consultar($nombre);
			if(!$resultado['datos'])
				$resultado = array();
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/banco/banco_consulta_view',$resultado);
		}

		$this->template->render();
	}

	public function buscar($id, $ok = ''){
		$this->template->write_view('sidebar','nav');
		$resultado['datos'] = $this->banco_model->buscar($id);
		
		if(!$resultado['datos'])
			header ("Location:". base_url() ."banco/consultar");
		else{
			$resultado['ok'] = $ok;
			$this->template->write_view('content','empresas/banco/banco_actualizar_view',$resultado);
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

		$this->template->write_view('sidebar','nav');
		$resultado['datos'] = array();
		$ok = '';
		$id = 0;
		if (!$this->form_validation->run())
			$ok = FALSE;
		else{
			$id = $this->input->post('txtId');
			$nit = $this->input->post('txtNit');
			$nombre = $this->input->post('txtNombre');
			$direccion = $this->input->post('txtDireccion');
			$telefono = $this->input->post('txtTelefono');
			$cuenta = $this->input->post('txtCuenta');
			$estado = $this->input->post('estado');

			$respuesta = $this->banco_model->actualizar($id,$nit,$nombre,$direccion,$telefono,$cuenta,$estado);
			
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}
		$this->buscar($id,$ok);
	}

}
