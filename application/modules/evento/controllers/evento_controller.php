<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evento_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('evento_model');
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar', 'navbar');
		$this->template->write_view('content_header', 'evento_index_view');
			if(!$this->session->userdata('username')==true && ($this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=2) )
			 	header ("Location:". base_url());
		
	}

	public function index($ok = FALSE, $view = 'evento/evento_register_view'){
		$data['ok'] = $ok;
		if ($view == 'contacto/contacto_registro_view')	{
			$data['combo']=$this->evento_model->consultar_combo();
		}
		$this->template->write_view('content', $view ,$data,TRUE);

		$this->template->render();
	}

	public function registrar()
	{	
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


		if (!$this->form_validation->run()) {
			$ok = FALSE;
		} else {						
			$respuesta = $this->evento_model->insertar(
				$this->input->post('txtNombre_evento'),
				$this->input->post('txtDescripcion_evento'),
				$this->input->post('txtValor_compra'),
				$this->input->post('txtValor_venta'),
				$this->input->post('txtDireccion_evento'),
				$this->input->post('txtCupos'),
				$this->input->post('txtLugar'),
				$this->input->post('txtFecha_inicio'),
				$this->input->post('txtFecha_fin'),
				$this->input->post('txtHora_ingreso'),
				$this->input->post('txtHora_salida')
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
		$this->form_validation->set_rules('txtNombre_evento', 'nombre', 'trim|required|min_length[4]|xss_clean');

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');

		if(!$this->form_validation->run()){
			$data['ok'] = 0;
			$this->template->write_view('content','evento/evento_consultar_view', $data);
		} else {
			$nombre = $this->input->post('txtNombre_evento');
			$resultado['datos'] = $this->evento_model->consultar($nombre);
			if(! $resultado['datos']) {
				$resultado = array();
			}
			$this->template->write_view('content','evento/evento_consultar_view', $resultado);
		}

		$this->template->render();
	}

	public function buscar($id, $ok = ''){
		$this->template->write_view('navbar','nav');
		$resultado['datos'] = $this->evento_model->buscar($id);
		//$resultado['datos'] = $this->evento_model->buscar($codigo);

		if(!$resultado['datos'])
			header ("Location:". base_url() ."evento/consultar");
		else{
			$resultado['ok'] = $ok;
			$this->template->write_view('content','evento/evento_index_view');
			$this->template->write_view('content','evento/evento_actualizar_view',$resultado);
		}

		$this->template->render();
		
	}

	public function buscar_contacto($codigo, $ok = ''){

		$resultado['combo']=$this->evento_model->consultar_combo();

		$this->template->write_view('navbar','nav');
		$resultado['datos'] = $this->evento_model->buscar_contacto($codigo);
		
		if(!$resultado['datos'])
			header ("Location:". base_url() ."contacto/consultar_contacto");
		else{
			$resultado['ok'] = $ok;
			$this->template->write_view('content','evento/evento_index_view');
			$this->template->write_view('content','contacto/contacto_actualizar_view',$resultado);
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

		$this->template->write_view('navbar','nav');
		$resultado['datos'] = array();
		$ok = '';
		
		if (!$this->form_validation->run()) {
			$ok = FALSE;
		} else {
			$respuesta = $this->evento_model->actualizar(
				$this->input->post('id'),
				$this->input->post('nombre_evento'),
				$this->input->post('descripcion_evento'),
				$this->input->post('valor_compra_evento'),
				$valor_venta = $this->input->post('valor_venta_evento'),
				$this->input->post('direccion'),
				$this->input->post('cupos_evento'),
				$this->input->post('lugar_evento'),
				$this->input->post('fecha_inicio_evento'),
				$this->input->post('fecha_fin_evento'),
				$this->input->post('hora_inicio_evento'),
				$this->input->post('hora_fin_evento')
			);
			
			if($respuesta) {
				$ok = TRUE;
			} else {
				$ok = FALSE;
			}
		}
		$this->buscar($this->input->post('id'), $ok);
	}
}