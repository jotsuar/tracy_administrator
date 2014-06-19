<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Citytour_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->template->write_view('navbar_header', 'navbar_header');
		$this->template->write_view('navbar', 'navbar');
		$this->template->write_view('content_header', 'citytour/citytour_index_view');
		$this->load->model('citytour_model');
		$this->load->model('sitio_turistico/sitio_turistico_model');
		$this->load->helper('date');
					if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1)
			 	header ("Location:". base_url());
	}

	public function index($response = array('success' => FALSE))
	{
		$response['success'] = $response['success'];
		$response['sitios_turisticos'] = $this->sitio_turistico_model->list_with_without_agreement();

		$this->template->write('title', 'Traveling city - citytour', TRUE);
		$this->template->write_view('content', 'citytour/citytour_register_view', $response, TRUE);
		$this->template->render();
	}

	public function register()
	{
		$this->form_validation->set_message('required', 'El dato %s es obligatorio.');
		$this->form_validation->set_message('is_unique', 'El dato %s ya está registrado.');
		$this->form_validation->set_message('regex_match', 'El dato %s no es válido.');
		$this->form_validation->set_message('is_natural_no_zero', 'El dato %s debe ser numérico y mayor a cero.');

		if($this->form_validation->run() == FALSE) {
			$this->response['success'] = FALSE;
		} else {
			$sitios_turisticos = array();
			if($this->input->post('check_sitios_turisticos') != FALSE){
				$sitios_turisticos = $this->input->post('check_sitios_turisticos');
			}

			$this->citytour_model->set_nombre($this->input->post('nombre'));
			$this->citytour_model->set_fecha($this->input->post('fecha'));
			$this->citytour_model->set_hora_inicio($this->input->post('hora_inicio'));
			$this->citytour_model->set_hora_fin($this->input->post('hora_final'));
			$this->citytour_model->set_direccion($this->input->post('direccion'));
			$this->citytour_model->set_cupos($this->input->post('cupos'));
			$this->citytour_model->set_precio($this->input->post('precio'));

			$this->response['success'] = $this->citytour_model->register($sitios_turisticos);
		}
		$this->index($this->response);
	}

	public function consulta()
	{
		$this->form_validation->set_message('regex_match', 'El dato %s no es válido.');

		$nombre 	= 	trim($this->input->post('nombre'));
		$fecha 		= 	trim($this->input->post('fecha'));
		$nombre 	= 	(empty($nombre)) ? NULL : $nombre;
		$fecha 		= 	(empty($fecha)) ? NULL : $fecha;
		
		$this->response['citytours'] = 	$this->citytour_model->consultar(NULL, $nombre, $fecha);

		$this->form_validation->run();
		$this->template->write_view('content', 'citytour/citytour_consulta_view', $this->response);
		$this->template->render();
	}

	public function update($id = NULL)
	{
		$this->load->model('guia/guia_model');
		$this->load->model('transport_company/transport_company_model');
		$this->load->library('session');

		$this->form_validation->set_message('required', 'El dato %s es obligatorio.');
		$this->form_validation->set_message('is_unique', 'El dato %s ya está registrado.');
		$this->form_validation->set_message('is_natural_no_zero', 'El dato %s debe ser numérico y mayor a cero.');

		$id = ($id != NULL) ? $id : $this->input->post('id');

		if($id != NULL || $id !== FALSE) {
			
			$this->response['citytour'] = $this->citytour_model->consultar($id);
			$this->response['sitios_turisticos'] = $this->sitio_turistico_model->list_with_without_agreement('array');
			$sitios_turisticos_detalle = $this->sitio_turistico_model->single_detail($id);
			$this->response['empresas'] = $this->transport_company_model->consultar();
			$this->response['guias_turisticos'] = $this->guia_model->listar_guia();

			$this->response['sitios_turisticos_detalle'] = array();

			foreach ($sitios_turisticos_detalle as $value) {
				array_push($this->response['sitios_turisticos_detalle'], $value->id);
			}	

			$this->response['reservas'] = $this->citytour_model->get_reservas($id);			
		} else {
			redirect("/citytour/consulta");
		}

		if($this->form_validation->run() == FALSE) {
			$this->response['success'] = FALSE;
			$this->template->write_view('content', 'citytour/citytour_update_view', $this->response);
			$this->template->render();
		} else {
			$tourist_places 	= array();
			$vehicles 			= array();
			$guides_tourist 	= array();

			if ($this->input->post('sitios_turisticos') != FALSE) {
				$tourist_places = $this->input->post('sitios_turisticos');
			}

			foreach ($this->input->post('guias_turisticos') as $key => $value) {
				if($value != FALSE){
					array_push($guides_tourist, $value);
				}
			}

			foreach ($this->input->post('vehicles') as $key => $value) {
				if($value != FALSE){
					array_push($vehicles, $value);
				}
			}

			$this->citytour_model->set_id($this->input->post('id'));
			$this->citytour_model->set_nombre($this->input->post('nombre'));
			$this->citytour_model->set_fecha($this->input->post('fecha'));
			$this->citytour_model->set_hora_inicio($this->input->post('hora_inicio'));
			$this->citytour_model->set_hora_fin($this->input->post('hora_final'));
			$this->citytour_model->set_direccion($this->input->post('direccion'));
			$this->citytour_model->set_cupos($this->input->post('cupos'));
			$this->citytour_model->set_precio($this->input->post('precio'));
			$this->citytour_model->set_status($this->input->post('estado'));

			// $this->session->set_flashdata('success', $this->response['success']);
			// redirect('citytour/update/' . $this->input->post('id'));
			$this->response['success'] = $this->citytour_model->modificar($tourist_places, $guides_tourist, $vehicles);

			$this->form_validation->run();

			if($this->response['success']){
				$this->response['citytours'] = 	$this->citytour_model->consultar($this->input->post('id'));
				$this->template->write_view('content', 'citytour/citytour_consulta_view', $this->response);
			} else { 
				$this->template->write_view('content', 'citytour/citytour_update_view', $this->response);
			}
			
			$this->template->render();
		}
	}

	public function _validate_date($start_date, $end_date)
	{
		if(difference_date($start_date, $end_date) == 0){
            $this->form_validation->set_message('_validate_date', 'La fecha no puede ser la de hoy');
            return FALSE;
		} else if(difference_date($start_date, $end_date) < 0) {
            $this->form_validation->set_message('_validate_date', 'La fecha debe ser mayor a la de hoy');
            return FALSE;
		}
		return TRUE;
	}

	public function _validate_hour($start_hour, $end_hour){
		$difference = difference_hour($start_hour, $end_hour);
		if($difference == 0){
            $this->form_validation->set_message('_validate_hour', 'La hora de inicio no puede ser la misma hora final');
            return FALSE;
		} elseif ($difference < 0) {
            $this->form_validation->set_message('_validate_hour', 'La hora de final debe ser mayor a la hora inicial');
            return FALSE;
		}
		return TRUE;
	}

	/**
	 * Valida que no se halla seleccionado el mismo vehiculo
	 * @return boolean
	 */
	public function _validate_vehicles(){

		if($this->input->post('vehicles') != FALSE){

			$vehicles = $this->input->post('vehicles');

			if(count(array_unique($vehicles)) != count($vehicles)) {
	            $this->form_validation->set_message('_validate_vehicles', 'No se puede elegir es mismo vehículo');
				return FALSE;
			}
		}
		return TRUE;
	}

	public function _validate_guide(){

		if($this->input->post('guias_turisticos') != FALSE) {
			$guides = $this->input->post('guias_turisticos');
			if(count(array_unique($guides)) != count($guides)){
	            $this->form_validation->set_message('_validate_guide', 'No se puede elegir es mismo guía turístico');
				return FALSE;				
			}
		}
		return TRUE;
	}

	public function _validate_amount_vehicles(){

		foreach ($this->input->post() as $key => $value) {
			if(stristr($key, 'cupo_')){
				array_push($amount_vehicles, $value);
			}
		}
	}

	public function _validate_reserva(){

		if(array_sum($this->input->post('cupos_vehiculo')) < $this->input->post('reservas')){
			$this->form_validation->set_message('_validate_reserva', 'Se requiere de más vehiculos');
		}
	}
}
/* End of file citytour_controller.php */
/* Location: ./application/modules/citytour/controllers/citytour_controller.php */