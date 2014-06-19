<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleado_controller extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario_model');
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar', 'navbar');
			if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1 )
			 	header ("Location:". base_url());
		
	}

	public function index($ok = FALSE)
	{
		$data['ok'] 		= 	$ok;
		$data['title'] 		= 	"Registro Empleado";
		$data['action'] 	= 	"usuario/empleado/registrar";
		$data['fecha'] 		=	NULL;
		$data['action2'] 	=	"usuario/empleado/consultar";
		$this->template->write_view('content','usuario/usuario_view',$data,TRUE);
		$this->template->render();
	}

	public function registrar()
	{



		$this->form_validation->set_rules(
			'identificacion', 
			'Nit', 
			'trim|required|min_length[4]|xss_clean|is_unique[usuario.identificacion]'
		);

		$this->form_validation->set_rules('nombre', 'Nombre(s)', 'trim|required|min_length[4]|max_length[30]|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|min_length[4]|xss_clean|max_length[30]');
		$this->form_validation->set_rules('telefono', 'Teléfono ', 'trim|required|min_length[4]|xss_clean|numeric');
		$this->form_validation->set_rules('celular', 'celular', 'trim|required|min_length[4]|xss_clean|numeric');

		$this->form_validation->set_rules(
			'correo', 
			'correo ', 
			'trim|required|min_length[4]|valid_email|xss_clean|is_unique[usuario.email]'
		);

		$this->form_validation->set_message('required','El dato %s es obligatorio.');

		$this->form_validation->set_message(
			'min_length',
			'la cantidad de caracteres del %s es menor a la esperada.'
		);

		$this->form_validation->set_message('valid_email','El dato %s no es válido.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric','El dato %s debe ser numero.');

		if (! $this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$tipo 				= 	$this->input->post('tipo');
			$identificacion 	= 	$this->input->post('identificacion');
			$nombre 			= 	$this->input->post('nombre');
			$apellidos 			= 	$this->input->post('apellidos');
			$telefono 			= 	$this->input->post('telefono');
			$celular 			= 	$this->input->post('celular');
			$correo 			= 	$this->input->post('correo');
			$rol 				= 	2;

			$respuesta = $this->usuario_model->insertar_empleado(
				$tipo, $identificacion, $nombre, $apellidos, $telefono, $celular, $correo, $rol
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
		$this->form_validation->set_rules('parametro', 'parametro', 'trim|required|min_length[3]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		
		if(!$this->form_validation->run()) {
			$data['ok'] = 0;
			$data['title'] = "Consulta de Empleado";
			$data['action']="usuario/empleado/consultar";
			$data['fecha']=NULL;
			$this->template->write_view('content','usuario/usuario_consulta_view',$data);
		} else {
			$resultado['datos'] = 	$this->usuario_model->consultar_usuario_empleado($this->input->post('parametro'));

			if(!$resultado['datos']) {
				$resultado = array();
			}
			$resultado['title'] 	= 	"Consulta de Empleado";
			$resultado['action'] 	= 	"usuario/empleado/consultar";
			$resultado['fecha'] 	= 	NULL;
			$this->template->write_view('content','usuario/usuario_consulta_view',$resultado);
		}

		$this->template->render();
	}

	public function buscar($id, $ok = '')
	{
		$resultado['datos'] = $this->usuario_model->buscar($id);
		
		if(!$resultado['datos']) {
			header ("Location:". base_url() ."empleado/consultar");
		} else {
			$resultado['ok'] 		= 	$ok;
			$resultado['title'] 	= 	"Modificar Empleado";
			$resultado['action'] 	= 	"usuario/empleado/actualizar";
			$resultado['fecha'] 	= 	NULL;
			$this->template->write_view('content','usuario/usuario_actualizar_view',$resultado);
		}

		$this->template->render();
	}

	public function actualizar()
	{
		$this->form_validation->set_rules(
			'identificacion', 
			'Identificación', 
			'trim|required|min_length[4]|xss_clean|callback_validar_identificacion[identificacion]'
		);

		$this->form_validation->set_rules('nombres', 'Nombre(s)', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('telefono', 'Teléfono ', 'trim|required|min_length[4]|xss_clean|numeric');
		$this->form_validation->set_rules('celular', 'celular', 'trim|required|min_length[4]|xss_clean|numeric');

		$this->form_validation->set_rules(
			'correo', 
			'correo ', 
			'trim|required|min_length[4]|valid_email|xss_clean|callback_validar_correo[correo]'
		);

		$this->form_validation->set_message('required','El dato %s es obligatorio.');

		$this->form_validation->set_message(
			'min_length',
			'la cantidad de caracteres del %s es menor a la esperada.'
		);

		$this->form_validation->set_message('valid_email','El dato %s no es válido.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric','El dato %s debe ser numero.');
		$this->form_validation->set_message('validar_identificacion','El dato %s ya está registrado.');
		$this->form_validation->set_message('validar_correo','El dato %s ya está registrado.');

		$resultado['datos'] = 	array();
		$ok 				= 	'';
		$id 				= 	$this->input->post('id');
		if (!$this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$tipo 				= 	$this->input->post('tipo');
			$identificacion 	= 	$this->input->post('identificacion');
			$nombre 			= 	$this->input->post('nombres');
			$apellidos 			=	$this->input->post('apellidos');
			$telefono 			= 	$this->input->post('telefono');
			$celular 			= 	$this->input->post('celular');
			$correo 			= 	$this->input->post('correo');

			$respuesta = $this->usuario_model->actualizar_empleado(
				$id, $tipo, $identificacion, $nombre, $apellidos, $telefono, $celular, $correo
			);
			
			if($respuesta) {
				$ok = TRUE;
			} else {
				$ok = FALSE;
			}
		}
		$this->buscar($id,$ok);
	}

	public function validar_identificacion($identificacion)
	{

 		$dato = $this->usuario_model->validar('identificacion',$this->input->post('id',TRUE));

	 	if($dato->identificacion == $identificacion) {
	 		return TRUE;
	 	}
	 	
	 	if( !$this->form_validation->set_rules(
	 		$identificacion, 'identificacion', 'is_unique[usuario.identificacion]')) {
	 		return FALSE;
	 	} else {
	 		return FALSE;
	 	}
 	}	

 	public function validar_correo($correo)
 	{

 		$dato = $this->usuario_model->validar('email', $this->input->post('id', TRUE));

	 	if($dato->email == $correo) {
	 		return TRUE;
	 	}

	 	if(!$this->form_validation->set_rules($correo, 'Correo E', 'is_unique[usuario.email]')) {
	 		return FALSE;
	 	} else {
	 		return TRUE;
	 	}
 	}	
}