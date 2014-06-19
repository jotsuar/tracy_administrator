<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reserva_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//$this->template->write_view('content_header', 'citytour/citytour_index_view');
		$this->load->model('reserva_model');
		$this->load->model('hospedaje/hospedaje_model');
		$this->load->model('evento/evento_model');
		$this->load->model('citytour/citytour_model');
		$this->load->model('paquete/paquete_model');
		$this->load->helper('date');
		if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1  )

			 	header ("Location:". base_url());
	}

	public function index($response = array('success' => FALSE))
	{
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar', 'navbar');
		$response['success'] = $response['success'];
		$this->response['reservas'] = $this->reserva_model->get_reservas();

		$this->template->write('title', 'Traveling city - citytour', TRUE);
		$this->template->write_view('content', 'reserva/list_reservas_view', $this->response, TRUE);
		$this->template->render();
	}

	public function validate($id){
		$this->reserva_model->validate($id);
		redirect('/reserva');
	}

	public function invalidate($id){
		$this->reserva_model->invalidate($id);
		redirect('/reserva');
	}

	public function delete_from_list(){
		$this->reserva_model->delete_from_list();
	}

	public function get_detail_reserva($id,$id_reserva) {
		$reserva = $this->reserva_model->get_detail_reserva($id,$id_reserva);
		$eventos=array();
		$citytours=array();
		$paquetes=array();
		$habitaciones = array();
		foreach ($reserva as $value) {
			if($value->id_evento)
				$eventos= $this->evento_model->buscar($value->id_evento);
			if($value->id_paquete)
				$paquetes = $this->paquete_model->consultar_paquetes($value->id_paquete);
			if($value->id_city_tour)
				$citytours = $this->citytour_model->consultar($value->id_city_tour);
			$habitaciones = $this->hospedaje_model->habitaciones_reserva($value->id);
		}
		$data["habitaciones"] = $habitaciones;
		$data["paquetes"] = $paquetes;
		$data["citytours"] = $citytours;
		$data["reserva"] = $reserva;
		$data["eventos"] = $eventos;

		$this->template->write_view('content', 'reserva/details',$data);
		$this->template->render();
	}


	public function ver_pagos($id_reserva)
	{
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar', 'navbar');
		$datos = array();
			if($this->reserva_model->ver_pagos($id_reserva))
				$datos = $this->reserva_model->ver_pagos($id_reserva);

		$data["pagos"] = $datos;
		$this->template->write_view('content', 'reserva/pagos',$data);
		$this->template->render();
	}
}

/* End of file reserva_controller.php */
/* Location: ./application/modules/reserva/controller/reserva_controller.php */