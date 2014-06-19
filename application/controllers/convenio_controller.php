<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		class Convenio_Controller extends CI_Controller {
			public function __construct(){
				parent::__construct();
				$this->load->model('convenio_model');
		}

		public function index($ok = FALSE){
		$data['ok'] = $ok;
		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','convenio/convenio_index_view');
		$this->template->render();
	}

	public function registrar_conv_hospedaje(){

		$this->form_validation->set_rules('txtFecha_convenio', 
			'Fecha del convenio', 
			'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtCosto', 
			'Costos', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtVenta', 
			'Venta', 
			'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('valid_email','El dato %s no es válido.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','convenio/convenio_index_view');
		$this->template->write_view('content_','convenio/convenio_register_view');
		$this->template->render();
	}

	public function registrar_conv_transporte(){

		$this->form_validation->set_rules('txtFecha_convenio', 
			'Fecha del convenio', 
			'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtCosto', 
			'Costos', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtVenta', 
			'Venta', 
			'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtCupos', 
			'Venta', 
			'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtFecha_inicio', 
			'Venta', 
			'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtFecha_fin', 
			'Venta', 
			'trim|required|min_length[4]|xss_clean');


		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('valid_email','El dato %s no es válido.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','convenio/convenio_index_view');
		$this->template->write_view('content_','convenio/convenio_register_conv_transporte');
		$this->template->render();
	}

	public function registrar_conv_sitio(){

		$this->form_validation->set_rules('txtFecha_convenio', 
			'Fecha del convenio', 
			'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtCosto', 
			'Costos', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtVenta', 
			'Venta', 
			'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtCupos', 
			'Venta', 
			'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtFecha_inicio', 
			'Venta', 
			'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtFecha_fin', 
			'Venta', 
			'trim|required|min_length[4]|xss_clean');


		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('valid_email','El dato %s no es válido.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','convenio/convenio_index_view');
		$this->template->write_view('content_','convenio/convenio_register_conv_sitio');
		$this->template->render();
	}

	public function consultar_convenio_hospedaje(){

		$this->form_validation->set_rules('txtNombre_convenio', 'Nombre', 'trim|required|min_length[3]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if(!$this->form_validation->run()){
			$data['ok'] = 0;
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','convenio/convenio_consultar_hospedaje_view',$data);
		}
		else{
			$nombre = $this->input->post('txtNombre_convenio');
			$resultado['date'] = $this->evento_model->consultar_contacto($nombre);
			if(!$resultado['date'])
				$resultado = array();
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','convenio/convenio_index_view');
			$this->template->write_view('content','convenio/convenio_consultar_hospedaje_view',$resultado);
		}

		$this->template->render();

	}

	public function consultar_convenio_transporte(){

		$this->form_validation->set_rules('txtNombre_convenio', 'Nombre', 'trim|required|min_length[3]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if(!$this->form_validation->run()){
			$data['ok'] = 0;
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','convenio/convenio_consultar_transporte',$data);
		}
		else{
			$nombre = $this->input->post('txtNombre_convenio');
			$resultado['date'] = $this->evento_model->consultar_contacto($nombre);
			if(!$resultado['date'])
				$resultado = array();
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','convenio/convenio_index_view');
			$this->template->write_view('content','convenio/convenio_consultar_transporte',$resultado);
		}

		$this->template->render();

	}

	public function consultar_convenio_sitio(){

		$this->form_validation->set_rules('txtNombre_convenio', 'Nombre', 'trim|required|min_length[3]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if(!$this->form_validation->run()){
			$data['ok'] = 0;
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','convenio/convenio_consultar_sitio',$data);
		}
		else{
			$nombre = $this->input->post('txtNombre_convenio');
			$resultado['date'] = $this->evento_model->consultar_contacto($nombre);
			if(!$resultado['date'])
				$resultado = array();
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','convenio/convenio_index_view');
			$this->template->write_view('content','convenio/convenio_consultar_sitio',$resultado);
		}

		$this->template->render();

	}

	
}

