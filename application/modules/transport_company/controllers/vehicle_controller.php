<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicle_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('vehicle_model');
		if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1) 
			 	header ("Location:". base_url());
	}

	public function consult_with_ajax() {
		if($this->input->is_ajax_request()){
			if($this->input->post('transport_company_id') === FALSE){
				echo json_encode($this->vehicle_model->consult_with_ajax(NULL, $this->input->post('vehicle_id')));	
			} else {
				echo json_encode($this->vehicle_model->consult_with_ajax($this->input->post('transport_company_id')));
			}
		} else {
			show_404();
		}
	}

	public function get_vehicles_citytour($citytour_id){
		if($this->input->is_ajax_request()){
			echo json_encode($this->vehicle_model->get_vehicles_citytour($citytour_id));
		} else {
			show_404();
		}
	}
}

/* End of file vehicle_controller.php */
/* Location: ./application/modules/transporte/controllers/vehicle_controller.php */