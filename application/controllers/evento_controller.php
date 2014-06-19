<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Evento_Controller extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('evento_model');

	}

	public function index($ok = FALSE, $view = 'empresas/evento/evento_register_view'){
		$data['ok'] = $ok;
		if ($view == 'empresas/contacto/contacto_registro_view')
		{
			$data['combo']=$this->evento_model->consultar_combo();
		}
		
		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','empresas/evento/evento_index_view');
		$this->template->write_view('content_', $view ,$data,TRUE);

		$this->template->render();
	}

	public function registrar(){
		
		$this->form_validation->set_rules('txtNombre_evento', 'Nombre', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtDescripcion_evento', 'descripcion', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtValor_compra', 'Valor compra', 'trim|required|min_length[4]|xss_clean|numeric');

		$this->form_validation->set_rules('txtValor_venta', 'Valor venta', 'trim|required|min_length[4]|xss_clean|numeric');

		$this->form_validation->set_rules('txtDireccion_evento', 'Direccion', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtCupos', 'Cupos', 'trim|required|min_length[1]|xss_clean|numeric');

		$this->form_validation->set_rules('txtLugar', 'Lugar', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtFecha_inicio', 'Fecha inicio', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtFecha_fin', 'Fecha fin', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtHora_ingreso', 'Hora ingreso', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('txtHora_salida', 'Hora salida', 'trim|required|min_length[4]|xss_clean');



		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('valid_email','El dato %s no es válido.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric', 'El campo %s debe poseer solo numeros');


		if (!$this->form_validation->run())
			$ok = FALSE;
		else{

			
			$nombre = $this->input->post('txtNombre_evento');
			$descripcion = $this->input->post('txtDescripcion_evento');
			$valor_compra = $this->input->post('txtValor_compra');
			$valor_venta = $this->input->post('txtValor_venta');
			$direccion = $this->input->post('txtDireccion_evento');
			$cupos = $this->input->post('txtCupos');
			$lugar = $this->input->post('txtLugar');
			$fecha_inicio = $this->input->post('txtFecha_inicio');
			$fecha_fin = $this->input->post('txtFecha_fin');
			$hora_inicio = $this->input->post('txtHora_ingreso');
			$hora_salida = $this->input->post('txtHora_salida');


			$respuesta = $this->evento_model->insertar($nombre,$descripcion,$valor_compra,$valor_venta,$direccion,$cupos,$lugar,$fecha_inicio,$fecha_fin,$hora_inicio,$hora_salida);
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}
		$this->index($ok);
	}

	public function consultar(){
		$this->form_validation->set_rules('txtNombre_evento', 'Nombre', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if(!$this->form_validation->run()){
			$data['ok'] = 0;
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/evento/convenio_consultar_hospedaje_view',$data);
		}
		else{
			$nombre = $this->input->post('txtNombre_evento');
			$resultado['datos'] = $this->evento_model->consultar($nombre);
			if(!$resultado['datos'])
				$resultado = array();
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/evento/evento_index_view');
			$this->template->write_view('content','empresas/evento/convenio_consultar_hospedaje_view',$resultado);
		}

		$this->template->render();
	}

	public function buscar($id, $ok = ''){
		$this->template->write_view('sidebar','nav');
		$resultado['datos'] = $this->evento_model->buscar($id);
		//$resultado['datos'] = $this->evento_model->buscar($codigo);

		if(!$resultado['datos'])
			header ("Location:". base_url() ."evento/consultar");
		else{
			$resultado['ok'] = $ok;
			$this->template->write_view('content','empresas/evento/evento_index_view');
			$this->template->write_view('content','empresas/evento/evento_actualizar_view',$resultado);
		}

		$this->template->render();
		
	}

	public function buscar_contacto($codigo, $ok = ''){

		$resultado['combo']=$this->evento_model->consultar_combo();

		$this->template->write_view('sidebar','nav');
		$resultado['datos'] = $this->evento_model->buscar_contacto($codigo);
		
		if(!$resultado['datos'])
			header ("Location:". base_url() ."contacto/consultar_contacto");
		else{
			$resultado['ok'] = $ok;
			$this->template->write_view('content','empresas/evento/evento_index_view');
			$this->template->write_view('content','empresas/contacto/contacto_actualizar_view',$resultado);
		}

		$this->template->render();
		
	}

	public function actualizar(){
		$this->form_validation->set_rules('id', 'ID', 'trim|required|xss_clean');

		$this->form_validation->set_rules('nombre_evento', 'Nombre', 'trim|required|xss_clean');

		$this->form_validation->set_rules('descripcion_evento', 'Descripción', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('valor_compra_evento', 'Valor compra', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('valor_venta_evento', 'Valor venta', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('direccion', 'Direccion', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('cupos_evento', 'Cupos', 'trim|required|numeric');

		$this->form_validation->set_rules('lugar_evento', 'Lugar del evento', 'trim|required|xss_clean');

		$this->form_validation->set_rules('fecha_inicio_evento', 'Fecha inicio del evento', 'trim|required|xss_clean');

		$this->form_validation->set_rules('fecha_fin_evento', 'Fecha fin del evento', 'trim|required|xss_clean');

		$this->form_validation->set_rules('hora_inicio_evento', 'Hora de inicio', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('hora_fin_evento', 'Hora de terminacion del evento', 'trim|required|min_length[1]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('numeric', 'El campo %s debe poseer solo numeros');

		$this->template->write_view('sidebar','nav');
		$resultado['datos'] = array();
		$ok = '';
		$id = $this->input->post('id');
		if (!$this->form_validation->run())
			$ok = FALSE;
		else{
			$nombre = $this->input->post('nombre_evento');
			$descripcion = $this->input->post('descripcion_evento');
			$valor_compra = $this->input->post('valor_compra_evento');
			$valor_venta = $this->input->post('valor_venta_evento');
			$direccion = $this->input->post('direccion');
			$cupos = $this->input->post('cupos_evento');
			$lugar = $this->input->post('lugar_evento');
			$fecha_inicio = $this->input->post('fecha_inicio_evento');
			$fecha_fin = $this->input->post('fecha_fin_evento');
			$hora_inicio = $this->input->post('hora_inicio_evento');
			$hora_salida = $this->input->post('hora_fin_evento');

			$respuesta = $this->evento_model->actualizar($id,$nombre,$descripcion,$valor_compra,$valor_venta,$direccion,$cupos,$lugar,$fecha_inicio,$fecha_fin,$hora_inicio,$hora_salida);
			
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}
		$this->buscar($id,$ok);
	}

	public function contacto(){
	
		$data['combo']=$this->evento_model->consultar_combo();

		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','empresas/evento/evento_index_view');
		$this->template->write_view('content_','empresas/contacto/contacto_registro_view', $data);
		$this->template->render();
	}

	public function registro_contacto_evento(){
		//reglas de validacion para el contacto
				
		$this->form_validation->set_rules('identificacion_contacto', 'identificación contacto', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('nombre_contacto', 'nombre contacto', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('apellido_contacto', 'apellido contacto', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('cel_contacto', 'celular contacto', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('email_contacto', 'email contacto', 'trim|required|min_length[4]|valid_email|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('valid_email','El dato %s no es una dirección de correo correcta.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
	

		if (!$this->form_validation->run())
			$ok = FALSE;
		else{
			$id_evento = $this->input->post('evento');
			$identificacion = $this->input->post('identificacion_contacto');
			$nombre = $this->input->post('nombre_contacto');
			$apellido = $this->input->post('apellido_contacto');
			$celular = $this->input->post('cel_contacto');
			$email = $this->input->post('email_contacto');
		
			$respuesta = $this->evento_model->insertar_contacto($id_evento,$identificacion,$nombre,$apellido,$celular,$email);
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}
		$this->index($ok,'empresas/contacto/contacto_registro_view');
	}

	public function consultar_contacto(){
		$this->form_validation->set_rules('txt_Nombre', 'Nombre', 'trim|required|min_length[3]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if(!$this->form_validation->run()){
			$data['ok'] = 0;
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/contacto/contacto_consulta_view',$data);
		}
		else{
			$nombre = $this->input->post('txt_Nombre');
			$resultado['date'] = $this->evento_model->consultar_contacto($nombre);
			if(!$resultado['date'])
				$resultado = array();
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/evento/evento_index_view');
			$this->template->write_view('content','empresas/contacto/contacto_consulta_view',$resultado);
		}

		$this->template->render();
	}

	public function actualizar_contacto()
	{
		//$this->form_validation->set_rules('codigo', 'codigo', 'trim|required|xss_clean');

		$this->form_validation->set_rules('identificacion', 'Identificacion', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('celular', 'Celular', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		$this->template->write_view('sidebar','nav');
		$resultado['datos'] = array();
		$ok = '';
		$codigo = $this->input->post('codigo');
		if (!$this->form_validation->run())
			$ok = FALSE;
		else{
			$id_evento = $this->input->post('nombre_evento');
			$identificacion = $this->input->post('identificacion');
			$nombres = $this->input->post('nombres');
			$apellidos = $this->input->post('apellidos');
			$celular = $this->input->post('celular');
			$email = $this->input->post('email');
			$estado = $this->input->post('estado_contacto');

			$respuesta = $this->evento_model->actualizar_contacto($codigo,$id_evento,$identificacion,$nombres,$apellidos,$celular,$email,$estado);
			
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}
		$this->buscar_contacto($codigo,$ok);
	}
}