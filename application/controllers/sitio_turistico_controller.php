<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitio_Turistico_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('sitio_model');
	}

	public function index($ok = FALSE){
		$data['ok'] = $ok;
		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','sitio_turistico/sitio_index');
		//$this->template->write_view('content_','empresas/transporte/transporte_register_view',$data,TRUE);
		$this->template->render();
	}

	public function registrar_tipo(){
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|min_length[4]|is_unique[tipo_turismo.nombre]');
		$this->form_validation->set_rules('descripcion', 'descripción', 'trim|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		if (!$this->form_validation->run())
			$ok = FALSE;

		else{
			$categoria = $this->input->post('nombre',TRUE);
			$descripcion = $this->input->post('descripcion',TRUE);
			$respuesta = $this->sitio_model->registrar_tipo($categoria,$descripcion);
			if($respuesta)
				$ok = TRUE;
			else
			$ok = FALSE;
		}
		$data['ok'] = $ok;
		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','sitio_turistico/sitio_index');
		$this->template->write_view('content','sitio_turistico/tipo_turismo/tipo_turismo_registrer_view',$data);
		$this->template->render();
	}
	
		public function listar()
	{
		   $resultado['datos'] = $this->sitio_model->listar_tipo();
			if(!$resultado['datos'])
			{
				$resultado = array();
				$this->template->write_view('sidebar','nav');
				$this->template->write_view('content','sitio_turistico/sitio_index');
				$this->template->write_view('content','sitio_turistico/tipo_turismo/tipo_turismo_consulta_view',$resultado);
			}
			else
			{
				$this->template->write_view('sidebar','nav');
				$this->template->write_view('content','sitio_turistico/sitio_index');
				$this->template->write_view('content','sitio_turistico/tipo_turismo/tipo_turismo_consulta_view',$resultado);
		    }

		$this->template->render();
	}


		public function buscar($id, $ok = ''){
			$this->template->write_view('sidebar','nav');
			$resultado['datos'] = $this->sitio_model->buscar_tipo($id);
			
			if(!$resultado['datos'])
			{
				$this->template->write_view('content','sitio_turistico/sitio_index');
				header ("Location:". base_url() .'sitio_turistico/tipo_turismo/tipo_turismo_consulta_view');
			}
			else{
				$resultado['ok'] = $ok;
				$resultado['tipo']=$this->sitio_model->listar_tipo('');
				$this->template->write_view('content','sitio_turistico/sitio_index');

				$this->template->write_view('content','sitio_turistico/tipo_turismo/tipo_turismo_modificar_view',$resultado);
			}
			$this->template->render();
		}

		public function modificar_tipo(){
		$this->form_validation->set_rules('categoria', 'categoría', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('descripcion', 'descripción', 'trim|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$id = 0;
		if(!$this->form_validation->run())
			$ok = FALSE;
		else{
			$id = $this->input->post('id',TRUE);
			$categoria = $this->input->post('categoria',TRUE);
			$descripcion = $this->input->post('descripcion',TRUE);

			$respuesta = $this->sitio_model->modificar_tipo($id,$categoria,$descripcion);
			($respuesta) ? $ok = TRUE:$ok = FALSE;
		}

		$this->buscar($id,$ok);

	}

	}
