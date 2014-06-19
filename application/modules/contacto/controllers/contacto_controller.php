<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto_controller extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('contacto_model');
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar','navbar');
			if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1 )
			 	header ("Location:". base_url());
		
	}

	public function index($empresa, $ok = FALSE, $vista = "contacto/contacto_registro_view")
	{
		switch ($empresa) {
			case 1:
				$data['empresa'] = "hospedaje";
				$this->template->write_view('content_header', 'hospedaje/hospedaje_index');
				break;
			case 2:
				$data['empresa'] = "transporte";
				$this->template->write_view('content_header', 'transporte/transporte_index_view');
				break;
			case 3:
				$data['empresa'] = "evento";
				$this->template->write_view('content_header', 'evento/evento_index_view');
				break;
			case 4:
				$data['empresa'] = "sitio";
				break;
			default:
				redirect("/home/home");	
				break;
		}

		$data['ok'] 			= $ok;
		$data['combo'] 			= $this->contacto_model->combo_contacto($empresa);
		$data['tipo_empresa'] 	= $empresa;
		$this->template->write_view('content', $vista, $data);
		$this->template->render();
	}

	public function registro_contacto($empresa){
		//reglas de validacion para el contacto
	
		$this->form_validation->set_rules(
			'identificacion',
			'identificación contacto', 
			'trim|required|min_length[4]|max_length[15]|xss_clean|is_unique[contacto.identificacion]'
		);

		$this->form_validation->set_rules(
			'nombres',
			'nombre contacto', 
			'trim|required|min_length[4]|xss_clean'
		);

		$this->form_validation->
		set_rules(
			'apellidos', 
			'apellido contacto', 
			'trim|required|min_length[4]|xss_clean'
		);

		$this->form_validation->
		set_rules(
			'celular',
			'celular contacto', 
			'trim|required|min_length[10]|max_length[15]|xss_clean'
		);

		$this->form_validation->set_rules(
			'email', 
			'email contacto',
			'trim|required|min_length[10]|valid_email|xss_cl|is_unique[contacto.email]'
		);

		$this->form_validation->set_rules(
			'id_empresa', 'Nombre Empresa', 'required'
		);

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('valid_email','El dato %s no es una dirección de correo correcta.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
	

		if (!$this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$id_empresa 		= $this->input->post('id_empresa');
			$identificacion 	= $this->input->post('identificacion');
			$nombre 			= $this->input->post('nombres');
			$apellido 			= $this->input->post('apellidos');
			$celular 			= $this->input->post('celular');
			$email 				= $this->input->post('email');
		
			$respuesta = $this->contacto_model->registrar_contacto(
				0, $identificacion, $nombre, $apellido, $celular, $email, 1, $id_empresa, $empresa
			);
			
			if($respuesta) {
				$ok = TRUE;
			} else {
				$ok = FALSE;
			}
		}
		$this->index($empresa,$ok);
	}

	public function consultar_contacto($empresa)
	{

		$this->form_validation->set_rules(
			'txt_Nombre',
			'Nombre o Apellido', 
			'trim|required|min_length[3]|xss_clean'
		);

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message(
			'min_length','la cantidad de caracteres del %s es menor a la esperadas.'
		);

		if(!$this->form_validation->run()) {
			$data['ok'] = 0;
			$data['data']=$this->contacto_model->consultar(0, $empresa);
			//$this->index($empresa);
			//$this->template->write_view('content','contacto/contacto_consulta_view',$data);
		} else {
			$parametro = $this->input->post('txt_Nombre');
			$data['data'] = $this->contacto_model->consultar($parametro,intval($empresa));

			if(!$data['data']) {
				$data = array();
			}
		}
		switch ($empresa) {
			case 1:
				$this->template->write_view('content', 'hospedaje/hospedaje_index');
				$data["palabra"] = "Hospedaje";
				break;
			case 2:
				$this->template->write_view('content', 'transporte/transporte_index_view');
				$data["palabra"] = "Empresa Transporte";
				break;
			case 3:
				$this->template->write_view('content', 'evento/evento_index_view');
				$data["palabra"] = "Evento";
				break;
			case 4:
				$this->template->write_view('content', 'sitio_turistico/evento_index_view');
				$data["palabra"] = "Sitio turístico";
				break;
		}	
		$data['empresa'] 		=	$empresa;
		$data['tipo_empresa'] 	= 	$empresa;
		$this->template->write_view('content', 'contacto/contacto_consulta_view', $data);
		$this->template->render();
	}


	public function buscar($id_contacto,$empresa,$ok='')
	{

		$data["datos"]=$this->contacto_model->consultar(intval($id_contacto),intval($empresa));

		if(!$data['datos'])
		{
			header ("Location:". base_url() ."contacto/consultar_contacto/".$empresa);
		}
		else
		{
			$data['empresa']	=	$empresa;
			$data['ok'] 		=	$ok;
			$data["combo"]		=	$this->contacto_model->combo_contacto($empresa);
			switch ($empresa) {
				case 1:
					$this->template->write_view('content_header', 'hospedaje/hospedaje_index');
					break;
				case 2:
					$this->template->write_view('content_header', 'transporte/transporte_index_view');
					break;
				case 3:
					$this->template->write_view('content_header', 'evento/evento_index_view');
					break;
				case 4:
					break;	
			}
			$this->template->write_view('content','contacto/contacto_actualizar_view',$data);
		}
			$this->template->render();
	}
	public function actualizar_contacto($codigos, $empresa)
	{
		$ok = '';
		
		$this->form_validation->set_rules('codigo', 'codigo', 'trim|required|xss_clean');

		$this->form_validation->set_rules(
			'identificacion',
			'Identificacion', 
			'trim|required|min_length[4]|xss_clean|callback_validar_identificacion[identificacion]'
		);

		$this->form_validation->
		set_rules(
			'nombres',
			'Nombres', 
			'trim|required|min_length[4]|xss_clean'
		);

		$this->form_validation->set_rules(
			'apellidos', 
			'Apellidos',
			'trim|required|min_length[4]|xss_clean'
		);

		$this->form_validation->set_rules(
			'celular',
			'Celular', 	
			'trim|required|min_length[4]|xss_clean'
		);

		$this->form_validation->set_rules(
			'email', 
			'Email', 
			'trim|required|min_length[4]|xss_clean|callback_validar_email[email]'
		);

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('validar_identificacion','La identificacion ya existe.');
		$this->form_validation->set_message('validar_email','El email ya existe.');

		

		if (!$this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$codigo 		= $this->input->post('codigo');
			$empresa 		= $this->input->post('empresa');
			$id_empresa 	= $this->input->post('id_empresa');
			$identificacion = $this->input->post('identificacion');
			$nombres 		= $this->input->post('nombres');
			$apellidos 		= $this->input->post('apellidos');
			$celular 		= $this->input->post('celular');
			$email 			= $this->input->post('email');
			$estado 		= $this->input->post('estado');

			$respuesta = $this->contacto_model->registrar_contacto(
				$codigo, $identificacion, $nombres, $apellidos, 
				$celular, $email,intval($estado), $id_empresa, $empresa
			);
			
			if($respuesta) {
				$ok = TRUE;
			} else {
				$ok = FALSE;	
			}
		}
		$this->buscar($codigos, $empresa, $ok);
	}

	public function validar_identificacion($identificacion)
	{
		$dato = $this->contacto_model->validar('identificacion', $this->input->post('codigo', TRUE));

	 	if($dato->identificacion == $identificacion) {
	 		return TRUE;
	 	}
	 	
	 	if(!$this->form_validation->set_rules(
	 		$identificacion, 'identificacion', 'is_unique[contacto.identificacion]'
	 	)) {
	 		return FALSE;
	 	} else {
	 		return TRUE;
	 	}
 	}	
 	public function validar_email($email) {
	 	$dato = $this->contacto_model->validar('email', $this->input->post('codigo', TRUE));

	 	if($dato->email == $email) {
	 		return TRUE;	 	
	 	}

	 	if(!$this->form_validation->set_rules($email, 'Email', 'is_unique[contacto.email]')) {
	 		return FALSE;
	 	} else {
	 		return TRUE;
	 	}
 	}
}

