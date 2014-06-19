<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Transporte_Controller extends CI_Controller
 {


	public function __construct()
	{
		
	parent::__construct();

	$this->load->model('transporte_model');
	}


	
	public function index($ok = FALSE){
	

	$data['ok'] = $ok;
	
		
	$this->template->write_view('sidebar','nav');

	$this->template->write_view('content','empresas/transporte/transporte_index_view');

	$this->template->write_view('content_','empresas/transporte/transporte_register_view',$data);
	
	
$this->template->render();
	}



	public function registrar(){

	//reglas de validacion para la empresa transporte

	$this->form_validation->set_rules('nit_empresa', 'Nit', 'trim|required|min_length[4]|xss_clean|is_unique[transporte.nit]');	
	$this->form_validation->set_rules('nombre_empresa', 'nombre empresa', 'trim|required|min_length[4]|xss_clean|is_unique[transporte.nombre]');

	$this->form_validation->set_rules('direccion_empresa', 'dirección empresa', 'trim|required|min_length[4]|xss_clean');
	
	$this->form_validation->set_rules('telefono_empresa', 'teléfono empresa', 'trim|required|min_length[4]|xss_clean');
	
	$this->form_validation->set_rules('correo_empresa', 'correo empresa', 'trim|required|min_length[4]|valid_email|xss_clean|is_unique[transporte.correo]');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('valid_email','El dato %s no es válido.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		if (!$this->form_validation->run())
			$ok = FALSE;
		else{

			$nit = $this->input->post('nit_empresa');
			$nombre = $this->input->post('nombre_empresa');
			$direccion = $this->input->post('direccion_empresa');
			$telefono = $this->input->post('telefono_empresa');
			$correo = $this->input->post('correo_empresa');
			$seguro = $this->input->post('seguro_transporte');

			$respuesta = $this->transporte_model->insertar($nit,$nombre,$direccion,$telefono,$correo,$seguro);
	
	if($respuesta)	$ok = TRUE;

	else	$ok = FALSE;
		}
	
	$this->index($ok);
	}

	public function consultar(){
		$this->form_validation->set_rules('txtNombre', 'Nombre', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if(!$this->form_validation->run()){
			$data['ok'] = 0;
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/transporte/transporte_consulta_view',$data);
		}
		else{
			$nombre = $this->input->post('txtNombre');
			$resultado['datos'] = $this->transporte_model->consultar($nombre);
			if(!$resultado['datos'])
				$resultado = array();
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/transporte/transporte_index_view');
			$this->template->write_view('content','empresas/transporte/transporte_consulta_view',$resultado);
		}

		$this->template->render();
	}

	public function buscar($id, $ok = ''){
		$this->template->write_view('sidebar','nav');
		$resultado['datos'] = $this->transporte_model->buscar($id);
		
		if(!$resultado['datos'])
			header ("Location:". base_url() ."transporte/consultar");
		else{
			$resultado['ok'] = $ok;
			$this->template->write_view('content','empresas/transporte/transporte_index_view');
			$this->template->write_view('content','empresas/transporte/transporte_actualizar_view',$resultado);
		}

		$this->template->render();
		
	}

	public function actualizar(){

		$this->form_validation->set_rules('id', 'ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nit_empresa', 'Nit', 'trim|required|min_length[4]|xss_clean|callback_validar');
		$this->form_validation->set_rules('nombre_empresa', 'nombre empresa', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('direccion_empresa', 'dirección empresa', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('telefono_empresa', 'teléfono empresa', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('correo_empresa', 'correo empresa', 'trim|required|min_length[4]|valid_email|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');		

		$resultado['datos'] = array();
		$ok = '';
		$id = $this->input->post('id');
		if (!$this->form_validation->run())
			$ok = FALSE;
		else{
			$nit = $this->input->post('nit_empresa');
			$nombre = $this->input->post('nombre_empresa');
			$correo_empresa = $this->input->post('correo_empresa');

			if(!$this->form_validation->set_rules($nit,'nit_empresa','xss_clean|is_unique[transporte.nit]'))
				$nit = NULL;
			if(!$this->form_validation->set_rules($nombre, 'nombre_empresa', 'xss_clean|is_unique[transporte.nombre]'))
				$nombre = NULL;
			if(!$this->form_validation->set_rules('correo_empresa', 'correo empresa', 'xss_clean|is_unique[transporte.correo]'))
				$correo_empresa = NULL;

			$direccion = $this->input->post('direccion_empresa');
			$telefono = $this->input->post('telefono_empresa');
			$seguro = $this->input->post('seguro');
			$estado = $this->input->post('estado');

			$respuesta = $this->transporte_model->actualizar($id,$nit,$nombre,$direccion,$telefono,$correo_empresa,$seguro,$estado);
			
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}
		$this->buscar($id,$ok);
	}

	public function contacto(){

		$this->load->model('transporte_model');
		$combo_empresa['datos']=$this->transporte_model->consultar_combo();

		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','empresas/transporte/transporte_index_view');
		$this->template->write_view('content_','empresas/contacto/contacto_registro_view',$combo_empresa);
		$this->template->render();
	}
	public function registro_contacto(){
		//reglas de validacion para el contacto
				

		$this->form_validation->set_rules('identificacion_contacto', 'identificación contacto', 'trim|required|min_length[4]|xss_clean|is_unique[contacto.identificacion]');
		$this->form_validation->set_rules('nombre_contacto', 'nombre contacto', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('apellido_contacto', 'apellido contacto', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('cel_contacto', 'celular contacto', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('email_contacto', 'email contacto', 'trim|required|min_length[4]|valid_email|xss_clean|is_unique[contacto.email]');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('valid_email','El dato %s no es una dirección de correo correcta.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
	

		if (!$this->form_validation->run())
			$ok = FALSE;
		else{
			$id_transporte = $this->input->post('empresa');
			$identificacion = $this->input->post('identificacion_contacto');
			$nombre = $this->input->post('nombre_contacto');
			$apellido = $this->input->post('apellido_contacto');
			$celular = $this->input->post('cel_contacto');
			$email = $this->input->post('email_contacto');
		
			$respuesta = $this->transporte_model->insertar_contacto($id_transporte,$identificacion,$nombre,$apellido,$celular,$email);
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}
		//$this->index($ok);
		$data['ok'] = $ok;
		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','empresas/transporte/transporte_index_view');
		$this->template->write_view('content_','empresas/contacto/contacto_registro_view',$data,TRUE);
		
		$this->template->render();

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
			$nombre = $this->input->post('txt_Nombre',true);
			$resultado['datos'] = $this->transporte_model->consultar_contacto($nombre);
			if(!$resultado['datos'])
				$resultado = array();
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/transporte/transporte_index_view');
			$this->template->write_view('content','empresas/contacto/contacto_consulta_view',$resultado);
		}

		$this->template->render();
	}


	public function buscar_contacto($codigo, $ok = ''){
		$this->template->write_view('sidebar','nav');
		$resultado['datos'] = $this->transporte_model->buscar_contacto($codigo);
		
		if(!$resultado['datos'])
			header ("Location:". base_url() ."contacto/consultar_contacto");
		else{
			$resultado['ok'] = $ok;
			$resultado['empresa'] =$this->transporte_model->consultar_combo();
			$this->template->write_view('content','empresas/transporte/transporte_index_view');
			$this->template->write_view('content','empresas/contacto/contacto_actualizar_view',$resultado);
		}

		$this->template->render();
		
	}


	public function actualizar_contacto(){

		$this->form_validation->set_rules('codigo', 'codigo', 'trim|required|xss_clean');
		$this->form_validation->set_rules('empresa', 'empresa_contacto');
		$this->form_validation->set_rules('identificacion_contacto', 'identificación contacto', 'trim|required|min_length[4]|xss_clean|callback_validar_identificacion[identificacion]');
		$this->form_validation->set_rules('nombre_contacto', 'nombre contacto', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('apellido_contacto', 'apellido contacto', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('cel_contacto', 'celular contacto', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('email_contacto', 'email contacto', 'trim|required|min_length[4]|valid_email|xss_clean|callback_validar_correo[correo]');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('valid_email','El dato %s no es una dirección de correo correcta.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$this->form_validation->set_message('validar_identificacion','El dato %s ya está registrado.');
		$this->form_validation->set_message('validar_correo','El dato %s ya está registrado.');

	

		$resultado['datos'] = array();
		$ok = '';
		$codigo = $this->input->post('codigo');
		if (!$this->form_validation->run())
			$ok = FALSE;

		else{
			$id_transporte = $this->input->post('empresa');
			$identificacion = $this->input->post('identificacion_contacto');
			$nombre = $this->input->post('nombre_contacto');
			$apellido = $this->input->post('apellido_contacto');
			// if(!$this->form_validation->set_rules($nit,'identificacion_contacto','xss_clean|is_unique[transporte.nit]'))
			// 	$nit = NULL;
			// if(!$this->form_validation->set_rules($nombre, 'nombre_empresa', 'xss_clean|is_unique[transporte.nombre]'))
			// 	$nombre = NULL;
			// if(!$this->form_validation->set_rules('apellido_contacto', 'apellido', 'xss_clean|is_unique[transporte.correo]'))
			// 	$correo_empresa = NULL;
      $celular = $this->input->post('cel_contacto');
     	$email = $this ->input->post ('email_contacto');
			$estado = $this->input->post('estado_contacto');

			$respuesta = $this->transporte_model->actualizar_contacto($id_transporte,$identificacion,$nombre,$apellido,$celular,$email,$estado,$codigo);
			
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}
		$this->buscar_contacto($codigo,$ok);
	}
	 public function validar_identificacion($identificacion){

 	$dato = $this->transporte_model->validar_contacto('identificacion',$this->input->post('codigo',TRUE));

 	if($dato->identificacion == $identificacion)
 		return TRUE;
 	
 	if(!$this->form_validation->set_rules($identificacion, 'identificacion', 'is_unique[contacto.identificacion]'))
 	{
 		return FALSE;
 	}
 	else
 		return FALSE;
 }	
 	 public function validar_correo($correo){

 	$dato = $this->transporte_model->validar_contacto('email',$this->input->post('codigo',TRUE));

 	if($dato->email == $correo)
 		return TRUE;
 	
 	if(!$this->form_validation->set_rules($correo, 'Correo E', 'is_unique[contacto.email]'))
 	{
 		return FALSE;
 	}
 	else
 		return true;
 }	

public function detalle($id_hospedaje)
	{
		$this->db->select
		(
			'servicio_adicional.id,
			servicio_adicional.nombre'
		);
		$this->db->from('vehiculo');
		$this->db->join
		(
			'detalle_servicio_adicional',
			'detalle_servicio_adicional.id_servicio_adicional = servicio_adicional.id'
		);

		$this->db->join('hospedaje', 'hospedaje.id = detalle_servicio_adicional.id_hospedaje');
		$this->db->where('hospedaje.id', $id_hospedaje);
		return $this->db->get()->result();
	}

	public function vehiculo($ok=''){
		$data['ok'] = $ok;
		$data['empresa']=$this->transporte_model->consultar_combo();
		$data['tipo_vehiculo']=$this->transporte_model->consultar_combo_tipo_vehiculo();
		
		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','empresas/transporte/transporte_index_view');
		$this->template->write_view('content_','empresas/transporte/vehiculo_register_view',$data);
		$this->template->render();
	}


	public function registrar_vehiculo()
	{
			
		$this->form_validation->set_rules('matricula_vehiculo', 'matricula', 'trim|required|alpha_numeric|exact_length[6]||xss_clean|is_unique[vehiculo.matricula]');
		$this->form_validation->set_rules('descripcion_vehiculo', 'Descripcion', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('cupos','Cupos','trim|required|numeric|xss_clean');		
		//$this->form_validation->set_rules('Estado_vehiculo', 'estado', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric','los datos %s deben ser numericos.');
		$this->form_validation->set_message('alpha_numeric','los datos %s deben contener numeros y letras.');
		$this->form_validation->set_message('exact_length','los datos %s deben contener solo 6 datos.');
				
		if (!$this->form_validation->run())
			$ok = FALSE;
		else{

			$id_transporte =$this->input->post('empresa');
			$matricula = $this->input->post('matricula_vehiculo');
			$tipo = $this->input->post('tipo_vehiculo');
			$Descripcion = $this->input->post('descripcion_vehiculo');
			$cupos = $this->input->post('cupos');

			$respuesta = $this->transporte_model->insertar_vehiculo($id_transporte,$matricula,$tipo,$Descripcion,$cupos);
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}$this->vehiculo($ok);
	}


	public function consultar_vehiculo(){
		$this->form_validation->set_rules('txt_Nombre', 'Nombre', 'trim|required|min_length[1]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if(!$this->form_validation->run()){
			$data['ok'] = 0;
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/transporte/vehiculo_consultar_view',$data);
		}
		else{
			$matricula = $this->input->post('txt_Nombre');
			$resultado['datos'] = $this->transporte_model->consultar_vehiculo($matricula);
			if(!$resultado['datos'])
				$resultado = array();
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/transporte/transporte_index_view');
			$this->template->write_view('content','empresas/transporte/vehiculo_consultar_view',$resultado);
		}
		$this->template->render();
	}

	public function buscar_vehiculo($id, $ok = ''){
		$this->template->write_view('sidebar','nav');
		$resultado['datos'] = $this->transporte_model->buscar_vehiculo($id);
		
		if(!$resultado['datos'])
			header ("Location:". base_url() ."transporte/consultar_vehiculo");
		else{
			$resultado['ok'] = $ok;
			$resultado['empresa'] =$this->transporte_model->consultar_combo();
			$resultado['tipo_vehiculo'] =$this->transporte_model->consultar_combo_tipo_vehiculo();
			$this->template->write_view('content','empresas/transporte/transporte_index_view');
			$this->template->write_view('content','empresas/transporte/vehiculo_actualizar_view',$resultado);
		}

		$this->template->render();		
	}
	public function tipo_vehiculo(){

		$this->load->model('transporte_model');

		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','empresas/transporte/transporte_index_view');
		$this->template->write_view('content_','empresas/transporte/tipo_vehiculo_register_view');
		$this->template->render();
	}
	public function registrar_tipo_vehiculo()
	{
		$this->form_validation->set_rules('nombre_vehiculo', 'nombre', 'trim|required|min_length[3]|xss_clean|is_unique[tipo_vehiculo.nombre]');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
	
		if (!$this->form_validation->run())
			$ok = FALSE;
		else{

			$nombre = $this->input->post('nombre_vehiculo');
			
			$respuesta = $this->transporte_model->insertar_tipo_vehiculo($nombre);
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}
		//$this->index($ok);
		$this->template->write_view('sidebar','nav');
		$this->template->write_view('content','empresas/transporte/transporte_index_view');
		$this->template->write_view('content_','empresas/transporte/tipo_vehiculo_register_view');
		$this->template->render();
	}


	public function consultar_tipo_vehiculo(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if(!$this->form_validation->run()){
			$data['ok'] = 0;
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/transporte/tipo_vehiculo_consultar_view',$data);
		}
		else{
			$nombre = $this->input->post('nombre',TRUE);

			$resultado['datos'] = $this->transporte_model->consultar_tipo_vehiculo($nombre);
			if(!$resultado['datos'])
				$resultado = array();
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/transporte/transporte_index_view');
			$this->template->write_view('content','empresas/transporte/tipo_vehiculo_consultar_view',$resultado);
		}

		$this->template->render();
	}
	public function buscar_tipo_vehiculo($id, $ok = ''){
		$this->template->write_view('sidebar','nav');
		$resultado['datos'] = $this->transporte_model->buscar_tipo_vehiculo($id);
		
		if(!$resultado['datos'])
			header ("Location:". base_url() ."transporte/consultar_tipo_vehiculo");
		else{
			$resultado['ok'] = $ok;
			$this->template->write_view('content','empresas/transporte/transporte_index_view');
			$this->template->write_view('content','empresas/transporte/tipo_vehiculo_actualizar',$resultado);
		}

		$this->template->render();
		
	}

	public function actualizar_tipo_vehiculo(){

		$this->form_validation->set_rules('id', 'ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nombre_vehiculo', 'nombre empresa', 'trim|required|min_length[3]|xss_clean');
	
		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');		

		$resultado['datos'] = array();
		$ok = '';
		$id = $this->input->post('id');
		if (!$this->form_validation->run())
			$ok = FALSE;
		else{

			$nombre = $this->input->post('nombre_vehiculo');
			//if(!$this->form_validation->set_rules($nombre, 'nombre_vehiculo', 'xss_clean|is_unique[tipo_vehiculo.nombre]'))
			//	$nombre = NULL;
		
			$respuesta = $this->transporte_model->actualizar_tipo_vehiculo($id,$nombre);
			
			if($respuesta)
				$ok = TRUE;
			else
				$ok = FALSE;
		}
		$this->buscar_tipo_vehiculo($id,$ok);
	}



/*
	publ
	ic function consultar_contacto(){
		$this->form_validation->set_rules('txt_Nombre', 'Nombre', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if(!$this->form_validation->run()){
			$data['ok'] = 0;
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/contacto/contacto_consulta_view',$data);
		}
		else{
			$nombre = $this->input->post('txt_Nombre');
			$resultado['datos'] = $this->transporte_model->consultar_contacto($nombre);
			if(!$resultado['datos'])
				$resultado = array();
			$this->template->write_view('sidebar','nav');
			$this->template->write_view('content','empresas/transporte/transporte_index_view');
			$this->template->write_view('content','empresas/contacto/contacto_consulta_view',$resultado);
		}

*/
 public function validar($dato){

		$this->form_validation->set_rules('id', 'ID', 'trim|required|xss_clean');


/*
 		$valor = $this->transporte_model->validar($nombre,$id);
 		if($valor == $dato)
 			return TRUE;
 		else if(!$this->form_validation->set_rules($dato, $nombre, 'is_unique[transporte.'+$nombre+']'))
 			return FALSE;
 		return TRUE;*/
 }

}