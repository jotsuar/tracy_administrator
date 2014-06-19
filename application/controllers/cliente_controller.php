	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('usuario_model');
	}

	public function index($ok = FALSE)
	{
		$data['ok'] = $ok;
		$data['title'] = "Registro Cliente";
		$data['action']="cliente/registrar";
		$data['fecha']=true;
	    $data['action2']="cliente/consultar";
		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','usuario/usuario_view',$data,TRUE);
		$this->template->render();
	}

	public function registrar()
	{


		$this->form_validation->set_rules('identificacion', 'identificacion', 'trim|required|min_length[4]|xss_clean|is_unique[usuario.identificacion]');
		$this->form_validation->set_rules('nombre', 'Nombre(s)', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('telefono', 'Teléfono ', 'trim|required|min_length[4]|xss_clean|numeric');
		$this->form_validation->set_rules('celular', 'celular', 'trim|required|min_length[4]|xss_clean|numeric');
		$this->form_validation->set_rules('correo', 'correo ', 'trim|required|min_length[4]|valid_email|xss_clean|is_unique[usuario.email]');
		$this->form_validation->set_rules('fecha', 'fecha', 'trim|required|callback_validar_fecha[fecha]');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('valid_email','El dato %s no es válido.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric','El dato %s debe ser numero.');
		$this->form_validation->set_message('validar_fecha','No puede ingresar un cliente menor de 18 años.');

		if (!$this->form_validation->run())
			$ok = FALSE;
		else{
			$tipo=$this->input->post('tipo');
			$identificacion=$this->input->post('identificacion');
			$nombre=$this->input->post('nombre');
			$apellidos=$this->input->post('apellidos');
			$telefono=$this->input->post('telefono');
			$celular=$this->input->post('celular');
			$fecha= $this->input->post('fecha');
			$correo=$this->input->post('correo');
			$rol=3;

			$respuesta = $this->usuario_model->insertar_cliente($tipo,$identificacion, $nombre, $apellidos,$telefono,$celular,$fecha,$correo,$rol);
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;


		}
		$this->index($ok);

	}
		public function consultar(){
		$this->form_validation->set_rules('parametro', 'parametro', 'trim|required|min_length[3]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		
		if(!$this->form_validation->run())
		{
			$data['ok'] = 0;
			$data['title'] = "Consulta de cliente";
			$data['action']="cliente/consultar";
			$data['fecha']=true;
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','usuario/usuario_consulta_view',$data);
		}
		else{
			
			$parametro = $this->input->post('parametro');
			$resultado['datos'] = $this->usuario_model->consultar_usuario_cliente($parametro);
			if(!$resultado['datos'])
				$resultado = array();
			//else 
			$resultado['title'] = "Consulta de cliente";
			$resultado['action']="cliente/consultar";
			$resultado['fecha']=true;
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','usuario/usuario_consulta_view',$resultado);
		}

		$this->template->render();
	}



	
	public function buscar($id, $ok = ''){
		$this->template->write_view('sidebar','nav');
		$resultado['datos'] = $this->usuario_model->buscar($id);
		
		if(!$resultado['datos'])
			header ("Location:". base_url() ."cliente/consultar");
			

			else{
			$resultado['ok'] = $ok;
			$resultado['title'] = "Modificar cliente";
			$resultado['action']="cliente/actualizar";
			$resultado['fecha']=true;
			$this->template->write_view('content','usuario/usuario_actualizar_view',$resultado);
		}

		$this->template->render();
		
	}

	public function actualizar()
	{
		$this->form_validation->set_rules('identificacion', 'Identificación', 'trim|required|min_length[4]|xss_clean|callback_validar_identificacion[identificacion]');
		$this->form_validation->set_rules('nombres', 'Nombre(s)', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('telefono', 'Teléfono ', 'trim|required|min_length[4]|xss_clean|numeric');
		$this->form_validation->set_rules('celular', 'celular', 'trim|required|min_length[4]|xss_clean|numeric');
		$this->form_validation->set_rules('correo', 'correo ', 'trim|required|min_length[4]|valid_email|xss_clean|callback_validar_correo[correo]');
		$this->form_validation->set_rules('fecha', 'fecha', 'trim|required|callback_validar_fecha[fecha]');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('valid_email','El dato %s no es válido.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric','El dato %s debe ser numero.');
		$this->form_validation->set_message('validar_identificacion','El dato %s ya está registrado.');
		$this->form_validation->set_message('validar_correo','El dato %s ya está registrado.');
		$this->form_validation->set_message('validar_fecha','No puede ingresar un cliente menor de 18 años.');
		$resultado['datos'] = array();
		$ok = '';
		$id = $this->input->post('id');
		if (!$this->form_validation->run())
			$ok = FALSE;
			else{
			$tipo=$this->input->post('tipo');
			$identificacion=$this->input->post('identificacion');
			$nombre=$this->input->post('nombres');
			$apellidos=$this->input->post('apellidos');
			$telefono=$this->input->post('telefono');
			$celular=$this->input->post('celular');
			$fecha= $this->input->post('fecha');
			$correo=$this->input->post('correo');

			$respuesta = $this->usuario_model->actualizar_cliente($id,$tipo,$identificacion, $nombre, $apellidos,$telefono,$celular,$fecha,$correo);
			
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}
		$this->buscar($id,$ok);
	}

	 public function validar_identificacion($identificacion){

	 	$dato = $this->usuario_model->validar('identificacion',$this->input->post('id',TRUE));

	 	if($dato->identificacion == $identificacion)
	 		return TRUE;

	 	
	 	if(!$this->form_validation->set_rules($identificacion, 'identificacion', 'is_unique[usuario.identificacion]'))
	 	{
	 		return FALSE;
	 	}
	 	else
	 		return FALSE;
 	}	
 	 public function validar_correo($correo){

	 	$dato = $this->usuario_model->validar('email',$this->input->post('id',TRUE));

	 	if($dato->email == $correo)
	 		return TRUE;

	 	
	 	if(!$this->form_validation->set_rules($correo, 'Correo E', 'is_unique[usuario.email]'))
	 	{
	 		return FALSE;
	 	}
	 	else
	 		return true;
    }	

    public function validar_fecha($fecha)
    {
    	$res_fecha= $this->usuario_model->validar_fecha($fecha);
    	if($res_fecha==true)
    		return true;
    	else
    		return false;
    }

}