<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Convenio_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar', 'navbar');
		$this->template->write_view('content_header', 'convenio_index_view');
		$this->load->model('convenio_model');	
			if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1 )
			 	header ("Location:". base_url());
		
	}

	public function index($ok = FALSE)
	{
		$this->template->render();
	}

	public function registrar($empresa)
	{

		if($empresa > 4 || $empresa < 1 ) {
			$this->template->render();
		} else {

			$this->form_validation->set_rules(
				'id_empresa', 
				'Empresa ', 
				'trim|required|xss_clean'
			);

			$this->form_validation->set_rules(
				'numero_convenio', 
				'Numero Convenio', 
				'trim|required|min_length[4]|xss_clean'
			);

			$this->form_validation->set_rules(
				'txtCosto', 
				'Costos', 
				'trim|required|min_length[4]|xss_clean'
			);

			if($empresa != 4)
			{
				$this->form_validation->set_rules(
					'txtVenta', 
					'Venta', 
					'trim|required|min_length[4]|xss_clean'
				);
			}

			$this->form_validation->set_rules(
				'txtFecha_inicio', 
				'Venta', 
				'trim|required|min_length[4]|xss_clean'
			);

			$this->form_validation->set_rules(
				'txtFecha_fin', 
				'Venta', 
				'trim|required|min_length[4]|xss_clean|callback_validar_fecha[txtFecha_fin]'
			);


			$this->form_validation->set_message('required','El dato %s es obligatorio.');
			$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
			$this->form_validation->set_message('valid_email','El dato %s no es válido.');
			$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');
			$this->form_validation->set_message('validar_fecha','No puedes Ingresar una fecha menor a la actual en la fecha fin.');
		
			$data['mensaje'] = "";
			if (!$this->form_validation->run()) {
				$ok = FALSE;
			} else {
				$id_empresa 			= $this->input->post('id_empresa');
				$numero_convenio 		= $this->input->post('numero_convenio');
				$costo 					= $this->input->post('txtCosto');
				$venta 					= $this->input->post('txtVenta');
				$fecha_inicio 			= $this->input->post('txtFecha_inicio');
				$fecha_fin 				= $this->input->post('txtFecha_fin');

				if($this->validar($fecha_inicio,$fecha_fin)){
					$respuesta = $this->convenio_model->registrar_convenio(
						$empresa, 0, $id_empresa, $numero_convenio, $costo, $venta, $fecha_inicio, $fecha_fin, 0
					);
					
					if($respuesta) {
						$ok = TRUE;
					} else {
						$ok = FALSE;
					}
				} else {
					$ok 				=	FALSE;
					$data['mensaje'] 	= 	"la fecha inicio no puede ser mayor que la fecha fin";
				}
			}

			switch ($empresa) {
				case 1:
					$data['empresa'] = "Hospedaje";
					break;
				case 2:
					$data['empresa'] = "Transporte";
					break;
				case 3:
					$data['empresa'] = "Sitio Turistico";
					break;
				case 4:
					$data['empresa'] = "Banco";
					break;				
			}



			$data['ok']				=	$ok;
			$data['combo']			=	$this->convenio_model->combo_empresa($empresa);
			$data['tipo_empresa'] 	= 	$empresa;
			$this->template->write_view('content', 'convenio/convenio_register_view', $data);
			$this->template->render();
		}		
	}


	public function validar_fecha($fecha)
	{
		return $this->convenio_model->validar_fecha($fecha);
	}
	
	public function consultar_convenio($id_convenio, $tipo_empresa)
	{
		$resultado['datos'] = $this->convenio_model->consultar(0, $tipo_empresa, 0, 0);
		if(!$resultado['datos']) {
			$resultado = array();
		}
		$resultado['tipo_convenio'] = $tipo_empresa;
		$this->template->write_view('content','convenio/convenio_consultar_view', $resultado);
		$this->template->render();
	} 

	public function validar($fecha_inicio, $fecha_fin)
	{
		return ($fecha_inicio < $fecha_fin) ? TRUE : FALSE; 
	}

	public function actualizar_estado($id_convenio, $estado, $tipo_empresa)
	{
		if($estado == 1) {
			$estado = 0;
		} else {
			$estado = 1;
		}
		$resultado = $this->convenio_model->registrar_convenio(
			0, intval($id_convenio) , 0 , 0, 0 ,0 , 0, 0, intval($estado)
		);
		$this->consultar_convenio(0,$tipo_empresa);
	}

	public function buscar($tipo_convenio)
	{
		
		$this->form_validation->set_rules(
			'fecha_fin', 
			'Fecha fin ', 
			'trim|required|xss_clean'
		);

		$this->form_validation->set_rules(
			'fecha_inicio', 
			'Fecha Inicio ', 
			'trim|required|xss_clean'
		);

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$data['tipo_convenio'] = $tipo_convenio;


		if (!$this->form_validation->run()) {
			$data['datos']=array();
			$ok=FALSE;
			$data['ok']= $ok;
			$this->template->write_view('content','convenio/convenio_consultar_view',$data);
		}		else
		{
			
			$fecha_inicio = $this->input->post('fecha_inicio');
			$fecha_fin 	  = $this->input->post('fecha_fin');
			$data["datos"]=$this->convenio_model->consultar(1,$tipo_convenio,$fecha_inicio,$fecha_fin);

			if(!$data['datos'])
				{
					header ("Location:". base_url() ."convenio/buscar/".$tipo_convenio);
				}
			else
			{
				$this->template->write_view('content','convenio/convenio_consultar_view',$data);

				
			}
		}
		$this->template->render();	


	}






	
}

