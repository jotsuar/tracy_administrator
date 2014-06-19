<?php
class Test_transporte extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('unit_test');
		$this->load->model('transporte_model');
	}

	public function validate_tipo_vehiculo()
	{
		$test_name = "Validacion del tipo de vehiculo";
		$id = 1;
		$field = 'nombre';
		$data = 'BUS';
		$esperado = TRUE;
		$resultado = $this->transporte_model->validate_tipo_vehiculo($id, $field , $data);
		echo $this->unit->run($resultado, $esperado, $test_name);
	}
} 