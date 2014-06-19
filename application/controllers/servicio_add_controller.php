<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Servicio_add_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_service');
	}

	public function index($ok = FALSE,$view='empresas/servicio/servicio_registro_view'){
		$data['ok'] = $ok;
		$data['tipo']=$this->model_service->listar_tipo('tipo_servicio');
		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content',$view,$data);
		//$this->template->write_view('content_','empresas/transporte/transporte_register_view',$data,TRUE);
		$this->template->render();
	}
		public function registrar_servicio_add(){
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|min_length[4]|is_unique[servicio_adicional.nombre]');
		$this->form_validation->set_rules('descripcion', 'descripción', 'trim|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		if (!$this->form_validation->run())
			$ok = FALSE;
		else{
			$tipo=$this->input->post('tipo');
			$categoria = $this->input->post('nombre',TRUE);
			$descripcion = $this->input->post('descripcion',TRUE);
			$respuesta = $this->model_service->registrar_servicio_add($categoria,$descripcion,$tipo);
			if($respuesta)
				$ok = TRUE;
			else
			$ok = FALSE;
		}
		$this->index($ok,'empresas/servicio/servicio_registro_view');

	}

		public function consultar_servicio(){
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|min_length[3]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if(!$this->form_validation->run()){

			$data['ok'] = FALSE;
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/servicio/consultar_servicio_view',$data);

		}
		else{
			
			$categoria = $this->input->post('nombre',TRUE);
			$resultado['datos'] = $this->model_service->consultar_service($categoria);
			if(!$resultado['datos'])
				$resultado = array();
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/servicio/consultar_servicio_view',$resultado);
		}

		$this->template->render();

	}

	public function listar($num)
	{
		   $resultado['datos'] = $this->model_service->consultar_service($num);
			if(!$resultado['datos'])
			{
				$resultado = array();
				$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/servicio/consultar_servicio_view',$resultado);
			}
			else
			{
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/servicio/consultar_servicio_view',$resultado);
		    }

		$this->template->render();
	}
	public function buscar($id, $ok = ''){
		$this->template->write_view('sidebar','nav');
		$resultado['datos'] = $this->model_service->listar_tipo_2($id);
		
		if(!$resultado['datos'])
			header ("Location:". base_url() ."empresas/servicio/consultar_servicio_view'");
		else{
			$resultado['ok'] = $ok;
			$resultado['tipo']=$this->model_service->listar_tipo('tipo_servicio');
			$this->template->write_view('content','empresas/servicio/modificar_service_view',$resultado);
		}

		$this->template->render();
		
	}

	public function validar($nombre, $id)
	{
		if($this->model_service->validar_service($nombre,$id) == 1)
		{
			return true;
		}
		else 
		{
			return false;
		}
			
	}

		public function modificar_servicio_add()
		{
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('descripcion', 'descripción', 'trim|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		if (!$this->form_validation->run())
			$ok = FALSE;
		else{

			$id=$this->input->post("id");
			$tipo=$this->input->post('tipo');
			$categoria = $this->input->post('nombre',TRUE);
			$descripcion = $this->input->post('descripcion',TRUE);

			if($this->validar($categoria,$tipo))
			{
				$ok = false;
			}
			else
			{
				$respuesta = $this->model_service->modificar_servicio_add($id,$categoria,$descripcion,$tipo);
				if($respuesta)
					$ok = TRUE;
				else
				$ok = FALSE;
			}
		}
		$this->buscar($id,$ok);

	}

}