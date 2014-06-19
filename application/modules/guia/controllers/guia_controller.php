<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guia_controller extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('guia_model');
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar', 'navbar');
		$this->template->write_view('content_header', 'citytour/citytour_index_view');
		if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1)
			header ("Location:". base_url());
	}

	public function index($ok = FALSE)
	{
		$resultado['ok']=$ok;
		$resultado['idiomas']=$this->guia_model->listar_idioma(2000);
		$this->template->write_view('content','guia/guia_registrer_view',$resultado);
		$this->template->render();
	}

	public function registrar()
	{

		if($this->input->post('btn_modificar')) {

			$this->form_validation->set_rules(
				'identificacion', 
				'identificacion', 
				'trim|required|min_length[4]|xss_clean|callback_validar_identificacion[identificacion]'
			);

			$this->form_validation->set_rules(
				'correo',
				'correo ',
				'trim|required|min_length[4]|valid_email|xss_clean|callback_validar_email[correo]'
			);
		} else {

			$this->form_validation->set_rules(
				'identificacion', 
				'identificacion', 
				'trim|required|min_length[4]|xss_clean|is_unique[guia_turistico.identificacion]'
			);

			$this->form_validation->set_rules(
				'correo',
				'correo ',
				'trim|required|min_length[4]|valid_email|xss_clean|is_unique[guia_turistico.email]'
			);
		}


		$this->form_validation->set_rules(
			'nombre', 
			'Nombre(s)', 
			'trim|required|min_length[4]|xss_clean'
		);

		$this->form_validation->set_rules(
			'apellidos', 
			'Apellidos',
			'trim|required|min_length[4]|xss_clean'
		);

		$this->form_validation->set_rules(
			'telefono',
			'Teléfono ',
			'trim|required|min_length[4]|xss_clean|numeric'
		);

		$this->form_validation->set_rules(
			'celular',
			'celular',
			'trim|required|min_length[4]|xss_clean|numeric'
		);

		

		$this->form_validation->set_message('required','El dato %s es obligatorio.');

		$this->form_validation->set_message(
			'min_length',
			'la cantidad de caracteres del %s es menor a la esperada.'
		);

		$this->form_validation->set_message('valid_email','El dato %s no es válido.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric','El dato %s debe ser numero.');
		$this->form_validation->set_message('validar_identificacion','La identificacion ya existe.');
		$this->form_validation->set_message('validar_email','El email ya existe.');


		if (!$this->form_validation->run()) {

			if( $this->input->post('btn_modificar') ) {
				$this->consultar( $this->input->post('codigo') );
			} else {
				$ok = FALSE;
			}
		} else {
			if( $this->input->post('btn_modificar') ) {
				$this->modificar();
			} else {
				
				$identificacion 		= 	$this->input->post('identificacion');
				$nombre 				= 	$this->input->post('nombre');
				$apellidos 				= 	$this->input->post('apellidos');
				$telefono 				= 	$this->input->post('telefono');
				$celular 				= 	$this->input->post('celular');
				$correo 				= 	$this->input->post('correo');

				$respuesta 	= $this->guia_model->registrar_guia(
					$identificacion, $nombre, $apellidos, $telefono, $celular, $correo, 0, 0
				);
					
				if($respuesta) {
					foreach ($this->input->post() as $key => $value) {
						if( stristr($key, 'check') ){
							$this->guia_model->registrar_idioma($value);
						}
					}
				}
				$ok = TRUE;
				$this->index($ok);
			}
		}
	}

	public function consultar($id = 0, $ok = "" )
	{
		$resultado['datos'] 	= 	$this->guia_model->listar_guia($id);
		$resultado['ok'] 		= 	$ok;

		if ($id == 0){
			$resultado['idiomas']=$this->guia_model->listar_idioma(1000);
			$this->template->write_view('content','guia/guia_consulta_view',$resultado);
		} else {
			$resultado['idiomas_guia'] 	= 	$this->guia_model->listar_idioma($id);
			$resultado['idiomas'] 		= 	$this->guia_model->listar_idioma(0);
			$this->template->write_view('content','guia/guia_modificar_view', $resultado);
		}
		$this->template->render();
	}

	public function modificar()
	{
		$id 				=	$this->input->post('codigo');
		$estado 			= 	$this->input->post('estado');
		$identificacion 	= 	$this->input->post('identificacion');
		$nombre 			= 	$this->input->post('nombre');
		$apellidos 			= 	$this->input->post('apellidos');
		$telefono 			= 	$this->input->post('telefono');
		$celular 			= 	$this->input->post('celular');
		$correo 			= 	$this->input->post('correo');

		$respuesta = $this->guia_model->registrar_guia(
			$identificacion,
			$nombre,
			$apellidos,
			$telefono,
			$celular,
			$correo,
			$estado,
			$id
		);


		if($respuesta) {
			if( $this->guia_model->eliminar_idioma($id)) {
				foreach ($this->input->post() as $key => $value) {
					if( stristr($key, 'check') ) {
						$this->guia_model->registrar_idioma($value, $id );
					}
				}
			}
			$this->consultar($id,TRUE );
		}
	}

	public function validar_identificacion($identificacion)
	{

	 	$dato = $this->guia_model->validar('identificacion',$this->input->post('codigo',TRUE));

	 	if($dato->identificacion == $identificacion) {
	 		return TRUE;
	 	}

	 	
	 	if(!$this->form_validation->set_rules(
	 		$identificacion, 'identificacion', 'is_unique[contacto.identificacion]')){
	 		return FALSE;
	 	} else {
	 		return TRUE;
	 	}
 	}

 	public function validar_email($email)
 	{
	 	$dato = $this->guia_model->validar('email',$this->input->post('codigo',TRUE));

	 	if($dato->email == $email) {
	 		return TRUE;	 	
	 	}

	 	if(!$this->form_validation->set_rules($email, 'Email', 'is_unique[contacto.email]')) {
	 		return FALSE;
	 	} else {
	 		return TRUE;
	 	}
 	}

 	public function get_languages($guide_id = NULL){
		if(is_null($guide_id)){
			echo json_encode($this->guia_model->get_languages($this->input->post('guide_id')));
		} else {
			echo json_encode($this->guia_model->get_languages($guide_id));
		}
 	}	

 	public function get_guide_with_languages($citytour_id){
 		echo json_encode($this->guia_model->get_guide_with_languages($citytour_id));
 	}
}