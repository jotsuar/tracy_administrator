<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuentas_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('usuario_model');
	}

	public function index($ok = FALSE){
		$data['ok'] = $ok;
		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','cuenta/cuenta_index_view');
		//$this->template->write_view('content_','empresas/transporte/transporte_register_view',$data,TRUE);
		$this->template->render();
	}
	public function consultar_cliente(){
		$this->form_validation->set_rules('parametro', 'parametro', 'trim|required|min_length[3]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperadas.');
		
		if(!$this->form_validation->run())
		{
			$data['ok'] = 0;
			$data['title'] = "Cuenta cliente";
			$data['action']="cuenta/consultar_cliente";
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','cuenta/cuenta_index_view');
			$this->template->write_view('content','cuenta/consulta_cuenta_view',$data);
		}
		else{
			
			$parametro = $this->input->post('parametro');
			$data['datos'] = $this->usuario_model->consultar_usuario_cliente($parametro);
			if(!$data['datos'])
				$data = array();
			//else 
			$data['title'] = "Cuenta cliente";
			$data['action']="cuenta/consultar_cliente";
			$Data['hola']="hola";
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','cuenta/cuenta_index_view');
			$this->template->write_view('content','cuenta/consulta_cuenta_view',$data);
		}

		$this->template->render();
	}
	public function consultar_empleado(){
		$this->form_validation->set_rules('parametro', 'parametro', 'trim|required|min_length[3]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperadas.');
		
		if(!$this->form_validation->run())
		{
			$data['ok'] = 0;
			$data['title'] = "Cuenta Empleado";
			$data['action']="cuenta/consultar_empleado";
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','cuenta/cuenta_index_view');
			$this->template->write_view('content','cuenta/consulta_cuenta_view',$data);
		}
		else{
			
			$parametro = $this->input->post('parametro');
			$data['datos'] = $this->usuario_model->consultar_usuario_empleado($parametro);
			if(!$data['datos'])
				$data = array();
			//else 
			$data['title'] = "Cuenta Empleado";
			$data['action']="cuenta/consultar_empleado";
			$Data['hola']="hola";
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','cuenta/cuenta_index_view');
			$this->template->write_view('content','cuenta/consulta_cuenta_view',$data);
		}

		$this->template->render();
	}
		public function buscar($id, $ok = ''){
		$this->template->write_view('sidebar','nav');
		$resultado['datos'] = $this->usuario_model->buscar_cuenta($id);
		
		if(!$resultado['datos'])
			header ("Location:". base_url() ."cuenta/consultar");
			

		else{
			$resultado['ok'] = $ok;
			$resultado['title'] = "Modificar cuenta Empleado";
			$resultado['action']="cuenta/actualizar";
			$resultado['fecha']=null;
			$this->template->write_view('content','cuenta/cuenta_actualizar_view',$resultado);
		}

		$this->template->render();
		
	}
	public function actualizar()
	{
		$this->form_validation->set_rules('pass', 'Id', 'trim|required|min_length[4]|xss_clean|alpha_numeric');

		

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('valid_email','El dato %s no es válido.');	
		$this->form_validation->set_message('alpha_numeric','El dato %s debe ser alfanumerico.');

		$resultado['datos'] = array();
		$ok = '';
		$id = $this->input->post('id');
		if (!$this->form_validation->run())
			$ok = FALSE;
			else{
			$estado=$this->input->post('estado');
			$user=$this->input->post('usuario');
			$pass=$this->input->post('pass');

			$respuesta = $this->usuario_model->actualizar_cuenta($id,$estado,$user,$pass);
			
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}
		$this->buscar($id,$ok);
	}





}
?>