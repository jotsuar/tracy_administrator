<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hospedaje extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar', 'navbar');
		$this->template->write_view('content_header', 'hospedaje_index');
		$this->load->model('hospedaje_model');
			if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1 )
			 	header ("Location:". base_url());
		
	}

	public function index(
		$ok 		= 	FALSE, 
		$view		=	'hospedaje_registro', 
		$datos 		= 	NULL
	){

		$data['ok'] 			= 	$ok;
		$data['hospedaje'] 		= 	$datos['hospedaje'];
		$data['detalle'] 		= 	isset($datos['detalle']) ? $datos['detalle'] : NULL;

		if ($view == 'hospedaje_registro')
		{
			$data['categorias'] 	= 	$this->hospedaje_model->mostrar_categoria();		
			$data['comodidades'] 	= 	$this->hospedaje_model->listar_comodidades();
		}
		
		$this->template->write_view('content', $view, $data);
		$this->template->render();
	}

	public function registrar()
	{
		if ($this->input->post('btn_modificar')) {

			$this->form_validation->set_rules(
				'nit', 
				'nit', 
				'trim|numeric|required|min_length[4]|xss_clean|callback_validate['."nit".']'
			);

			$this->form_validation->set_rules(
				'nombre', 
				'nombre', 
				'trim|required|min_length[4]|xss_clean|callback_validate['."nombre".']'
			);
		} else {
			$this->form_validation->set_rules(
				'nit', 
				'nit', 
				'trim|numeric|required|min_length[4]|xss_clean|is_unique[hospedaje.nit]'
			);

			$this->form_validation->set_rules(
				'nombre', 
				'nombre', 
				'trim|required|min_length[4]|xss_clean|is_unique[hospedaje.nombre]' 
			);
		}

		$this->form_validation
		->set_rules	('direccion', 'dirección', 'trim|required|min_length[4]|xss_clean]');

		$this->form_validation
		->set_rules	('telefono', 'teléfono', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation
		->set_rules	('descripcion', 'descripcion', 'trim|xss_clean');

		$this->form_validation
		->set_rules	('categoria', 'categoria', 'trim|required|xss_clean');


		$this->form_validation->set_message('required','El dato %s es obligatorio.');

		$this->form_validation
		->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		$this->form_validation->set_message('is_unique', 'El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric', 'El dato %s debe ser numerico.');
		$this->form_validation->set_message('validate', 'El %s ya está registrado.');
		
		if (!$this->form_validation->run()) {
			if ($this->input->post('btn_modificar')) {
				$this->detalle($this->input->post('id_hospedaje'));
			} else {
				$this->index(FALSE);
			}
		} else {
			if ($this->input->post('btn_modificar')) {
				$this->modificar();
			} else {
				$respuesta = $this->hospedaje_model->registrar(
					$this->input->post('nit', TRUE),
					strtoupper( $this->input->post('nombre', TRUE)),
					$this->input->post('direccion', TRUE),
					$this->input->post('telefono', TRUE),
					$this->input->post('descripcion', TRUE),
					$this->input->post('categoria', TRUE)
				);

				if ($respuesta) {
					foreach ($this->input->post() as $key => $value) {
						if (stristr($key, 'check')) {
							$this->hospedaje_model->register_service_add($value);
						}
					}
				}

				$this->index(TRUE);
			}
		}
	}

	public function validate($data, $field)
	{
		return $this->hospedaje_model->validate( 
			$data, 
			$field, 
			$this->input->post("id_hospedaje") 
		);
	}

	public function modificar()
	{

		$respuesta = $this->hospedaje_model->modificar (
			$this->input->post('id_hospedaje', TRUE),
			$this->input->post('nit',TRUE),
			strtoupper( $this->input->post('nombre',TRUE)),
			$this->input->post('direccion',TRUE),
			$this->input->post('telefono',TRUE),
			$this->input->post('descripcion',TRUE),
			$this->input->post('categoria',TRUE),
			$this->input->post('estado', TRUE)
		);

		if ($respuesta) {
			if ($this->hospedaje_model
				->del_service_add($this->input->post('id_hospedaje', TRUE))) {
				foreach ($this->input->post() as $key => $value) {
					if (stristr($key, 'check')) {
						$this->hospedaje_model
						->register_service_add($value, $this->input->post('id_hospedaje', TRUE));
					}
				}
			}
		}

		$this->detalle($this->input->post('id_hospedaje', TRUE), TRUE);
	}

	public function consultar(){

		$this->form_validation
		->set_rules ('nombre', 'nombre', 'trim|required|xss_clean');

		$this->form_validation->set_message('required','El %s del hospedaje es obligatorio.');

		$this->form_validation
		->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$this->form_validation->set_message('numeric','El dato %s debe ser numerico.');
		$this->form_validation->set_message('validate','El %s ya está registrado.');

		if (!$this->form_validation->run()) {
			$ok = FALSE;
			$resultado['hospedaje'] = $this->hospedaje_model->consult_all();
		}	else {
			$ok = TRUE;
			$resultado['hospedaje'] = $this->hospedaje_model->consultar(
				0, 
				$this->input->post('nombre', TRUE)
			);
		}

		$this->index($ok,'hospedaje_consulta', $resultado);
	}

	public function detalle($id_hospedaje, $ok = FALSE)
	{
		$data['ok'] 					= 	$ok;
		$data['hospedaje'] 				= 	$this->hospedaje_model->consultar($id_hospedaje, NULL);
		$data['comodidades']			= 	$this->hospedaje_model->listar_comodidades();
		$data['comodidades_hospedaje'] 	= 	$this->hospedaje_model->listar_comodidades_hospedaje($id_hospedaje);
		$data['categorias'] 			= 	$this->hospedaje_model->mostrar_categoria();

		if ($data['hospedaje'] == NULL) {
			redirect('/hospedaje');
		}

		$this->template->write_view('content', 'hospedaje_modicar', $data);
		$this->template->render();
	}

	public function detalle_servicios_add($id_hospedaje)
	{
		$datos['hospedaje']	=	$this->hospedaje_model->consultar($id_hospedaje, NULL);
		$datos['detalle'] 	=	$this->hospedaje_model->detalle($id_hospedaje);

		$this->index(FALSE, 'hospedaje_consulta', $datos);		
	}

	public function registrar_categoria()
	{
		$this->form_validation
		->set_rules('categoria', 'categoría', 'trim|required|min_length[4]|is_unique[categoria.categoria]');

		$this->form_validation
		->set_rules('descripcion', 'descripción', 'trim|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');

		$this->form_validation
		->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		if (!$this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$categoria 		= $this->input->post('categoria', TRUE);
			$descripcion 	= $this->input->post('descripcion', TRUE);
			$respuesta 		= $this->hospedaje_model->registrar_categoria($categoria, $descripcion);
			if ($respuesta) {
				$ok = TRUE;
			} else {
				$ok = FALSE;
			}
		}
		$this->index($ok, 'categoria/categoria_registro');
	}

	public function consult_all_categories()
	{
		$resultado['categories'] = $this->hospedaje_model->consult_all_categories();
		$this->template->write_view('content', 'categoria/categoria_consulta', $resultado);
		$this->template->render();
	}

	public function modificar_categoria()
	{
		$this->form_validation
		->set_rules('categoria', 'categoría', 'trim|required|min_length[4]|xss_clean');
		
		$this->form_validation
		->set_rules('descripcion', 'descripción', 'trim|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');

		$this->form_validation
		->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		if (!$this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$respuesta = $this->hospedaje_model->modificar_categoria(
				$this->input->post('id', TRUE),
				$this->input->post('categoria', TRUE),
				$this->input->post('descripcion', TRUE)
			);

			$ok = $respuesta ? TRUE : FALSE;
		}

		$this->buscar_categoria(
			$this->input->post('id', TRUE), 
			$ok
		);
	}

	public function mostrar_categoria()
	{
		$resultado['categorias'] = $this->hospedaje_model->mostrar_categoria();
		$this->template->write_view('content', 'hospedaje/hospedaje_registro', $resultado);
		$this->template->render();
	}

	public function buscar_categoria($id, $ok = FALSE)
	{
		$resultado['datos'] = $this->hospedaje_model->buscar_categoria($id);
		
		if (!$resultado['datos']) {
			redirect("/hospedaje/mostrar_categoria");
		} else {
			$resultado['ok'] = $ok;
			$this->template->write_view('content', 'categoria/categoria_actualizar', $resultado);
		}

		$this->template->render();
	}

	public function registrar_tipo_habitacion()
	{
		$this->form_validation->set_rules(
			'nombre', 
			'nombre', 
			'trim|required|min_length[4]|is_unique[tipo_habitacion.nombre]'
		);
		$this->form_validation->set_rules(
			'cupo_maximo', 
			'Cupo Maximo', 
			'trim|required|'
		);

		$this->form_validation->set_rules(
			'descripcion', 
			'descripción', 
			'trim|min_length[4]|xss_clean' 
		);

		$this->form_validation->set_message('required','El dato %s es obligatorio.');

		$this->form_validation->set_message(
			'min_length',
			'la cantidad de caracteres del %s es menor a la esperada.'
		);
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

		if (!$this->form_validation->run()){
			$ok = FALSE;
		} else {
			$categoria = $this->input->post('nombre',TRUE);
			$descripcion = $this->input->post('descripcion',TRUE);
			$numero  = $this->input->post('cupo_maximo');

			$respuesta = $this->hospedaje_model->registrar_tipo_habitacion(
				strtoupper($categoria), 
				$descripcion,
				$numero
			);

			if ($respuesta) {
				$ok = TRUE;
			} else {
				$ok = FALSE;
			}
		}

		$data['ok'] = $ok;
		$this->template->write_view(
			'content', 
			'habitacion/tipo_habitacion/tipo_habitacion_registrer_view', 
			$data
		);
		$this->template->render();
	}

	public function consultar_tipo_habitacion()
	{
		$resultado['datos'] = $this->hospedaje_model->mostrar_tipo_habitacion();
		$this->template->write_view(
			'content', 
			'habitacion/tipo_habitacion/tipo_habitacion_consulta_view', $resultado
		);
		$this->template->render();
	}

	public function buscar_tipo_habitacion($id, $ok = '')
	{

		$resultado['datos'] = $this->hospedaje_model->buscar_tipo_habitacion_2($id);
		if (!$resultado['datos']) {
			echo "hola";
		/*	$this->template->write_view('content', 'hospedaje/hospedaje_index_view');
			header ("Location:". base_url() .'tipo_habitacion/consultar');*/
		}	else {
			$resultado['ok'] = $ok;
			$this->template->write_view(
				'content', 
				'habitacion/tipo_habitacion/tipo_habitacion_modificar_view', 
				$resultado
			);
		}

		$this->template->render();
	}


  public function modificar_tipo_habitacion() 
  {
   
		$this->form_validation
		->set_rules('nombre','nombre', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_rules(
			'cupo_maximo', 
			'Cupo Maximo', 
			'trim|required|'
		);

		$this->form_validation
		->set_rules('descripcion', 'descripción', 'trim|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');

		$this->form_validation->set_message(
			'min_length',
			'la cantidad de caracteres del %s es menor a la esperada.'
		);

		$this->form_validation->set_message('validar_nombre','El dato %s ya está registrado.');
		$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
		$id = 0;

		if (!$this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$respuesta = $this->hospedaje_model->modificar_tipo_habitacion(
				$this->input->post( 'id', TRUE ),
				$this->input->post( 'nombre', TRUE ),
				$this->input->post( 'descripcion', TRUE ),
				$this->input->post('cupo_maximo',TRUE)
			);

			$respuesta ? $ok = TRUE : $ok = FALSE;
		}
	
		$this->buscar_tipo_habitacion($this->input->post('id', TRUE), $ok);
	}

  public function validar_nombre($nombre)
  {
	 	$dato = $this->hospedaje_model->validar('nombre', $this->input->post('id', TRUE));

	 	if ($dato->nombre == $nombre) {
	 		return TRUE;
	 	}

	 	if (!$this->form_validation->set_rules( $nombre, 'nombre', 'is_unique[tipo_habitacion.nombre]')) {
	 		return FALSE;
	 	} else {
	 		return FALSE;
	 	}
	}	
	


 	public function registrar_habitacion()
	{
		$this->form_validation->set_rules('comodidades', 'Comodidades', 'trim|min_length[4]|xss_clean');
		$this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required|min_length[1]|xss_clean');
		$this->form_validation->set_rules('valor', 'Valor $', 'trim|required|min_length[1]|xss_clean|numeric');


		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		
		$this->form_validation
		->set_message('min_length','la cantidad de caracteres del %s es menor a la esperado.');

		if (!$this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$respuesta = $this->hospedaje_model->registrar_habitacion(
				$this->input->post('hospedaje', TRUE),
				$this->input->post('tipo', TRUE),
				$this->input->post('comodidades', TRUE),
				$this->input->post('cantidad', TRUE),
				$this->input->post('valor', TRUE)
			);

			if ($respuesta) {
				$ok = TRUE;
			} else {
				$ok = FALSE;
			}
		}

		$data['ok'] 		= 	$ok;
		$data['hospedaje']	= 	$this->hospedaje_model->hospedajes(0);
		$data['tipo']=$this->hospedaje_model->habitaciones(0);
		$this->template->write_view('content', 'habitacion/habitacion_registrer_view', $data);
		$this->template->render();
	}

	public function consultar_habitacion()
	{
		$resultado['datos'] = $this->hospedaje_model->consultar_habitacion();
		$this->template->write_view('content', 'habitacion/habitacion_consulta_view', $resultado);
		$this->template->render();
	}

	public function buscar_habitacion($id, $ok = '')
	{
		$resultado['datos'] = $this->hospedaje_model->buscar_habitacion($id);

		if (!$resultado['datos']) {
			echo "hola";
		/*	$this->template->write_view('content', 'hospedaje/hospedaje_index_view');
			header ("Location:". base_url() .'tipo_habitacion/consultar');*/
		} else {
			$resultado['ok'] = $ok;
			//	$resultado['hospedaje_pr']= $this->hospedaje_model->hospedajes($id);
			//	$resultado['tipo_pr']=$this->hospedaje_model->habitaciones($id);
			$resultado['hospedaje'] = $this->hospedaje_model->hospedajes(0);
			$resultado['tipo'] = $this->hospedaje_model->habitaciones(0);
			$this->template->write_view('content', 'habitacion/habitacion_modificar_view', $resultado);
		}
		$this->template->render();
	}

	public function modificar_habitacion()
	{
   
		$this->form_validation->set_rules('comodidad', 'Conmodidades', 'trim|min_length[4]|xss_clean');
		$this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required|min_length[1]|xss_clean');
		$this->form_validation->set_rules('valor', 'Valor $', 'trim|required|min_length[1]|xss_clean|numeric');


		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message(
			'min_length',
			'la cantidad de caracteres del %s es menor a la esperada.'
		);

		if (!$this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$id 				=	$this->input->post('id');
			$hospedaje 			= 	$this->input->post('hospedaje', TRUE);
			$tipo 				= 	$this->input->post('tipo', TRUE);
		    $comodidades 	= 	$this->input->post('comodidad', TRUE);
			$cantidad 			= 	$this->input->post('cantidad', TRUE);
			$valor 			= 	$this->input->post('valor', TRUE);

			$respuesta = $this->hospedaje_model->modificar_habitacion(
				$id, $hospedaje, $tipo, $comodidades, $cantidad,$valor
			);

			$respuesta ? $ok = TRUE : $ok = FALSE;
		}
	
		$this->buscar_habitacion($id, $ok);
	}
}