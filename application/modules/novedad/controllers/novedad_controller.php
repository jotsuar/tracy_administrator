<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		class Novedad_Controller extends CI_Controller {
			public function __construct(){
				parent::__construct();
				$this->template->write_view('navbar','navbar');
				$this->template->write_view('navbar_header','navbar_header');
				$this->load->model('novedad_model');
					if(!$this->session->userdata('username')==true && ($this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=2) )
			 	header ("Location:". base_url());
			
		}

		public function asignar($id)
		{
			$ok="";
			$this->form_validation->set_rules('descripcion', 'descripción', 'trim|min_length[4]|xss_clean|required');
			$this->form_validation->set_message('required','El dato %s es obligatorio.');
			$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
			if( !$this->form_validation->run() )
				$ok = FALSE;
			else {
				$respuesta = $this->novedad_model->registrar_actualizar(0,$id,$this->input->post('descripcion', TRUE));
				if(!$respuesta)
				{
					$ok = FALSE;
					$data=array();

				}
				else
				{
					$ok = TRUE;
				}

			}
				$data["id"]=$id;
				$data["ok"] = $ok;
				$this->template->write_view('content','novedad_registro_view',$data);
				$this->template->render();


		}

		public function index($ok = FALSE)
		{
			$data['datos']=$this->novedad_model->consultar_novedad(0);

			if(!$data['datos'])
				$data=array();
			$this->template->write_view('content','novedad_consulta_view',$data);
			$this->template->render();
		}


		public function buscar($id,$ok="")
		{
			$data['datos']=$this->novedad_model->consultar_novedad(intval($id));
			$data['ok']=$ok;

			if (!$data['datos'])
			{
				$dato['datos']=$this->novedad_model->consultar_novedad(0);
				$this->template->write_view('content','novedad_consulta_view',$dato);
			}
			else
				$this->template->write_view('content','novedad_modificar_view',$data);
			
			$this->template->render();
		}

			public function modificar_novedad()
	{

		$this->form_validation->set_rules
		(
			'descripcion', 'descripción', 'trim|min_length[4]|xss_clean'
		);

		$this->form_validation->set_message('required','El dato %s es obligatorio.');
		$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
		$id=$this->input->post('novedad', TRUE);
		if( !$this->form_validation->run() )
			$ok = FALSE;
		else {
			$respuesta = $this->novedad_model->registrar_actualizar
			(
				$this->input->post('novedad', TRUE),
				$this->input->post('reservas', TRUE),
				$this->input->post('descripcion', TRUE)
			);

			$ok = $respuesta ? TRUE : FALSE;
		}

		$this->buscar($id, $ok);
	}


}