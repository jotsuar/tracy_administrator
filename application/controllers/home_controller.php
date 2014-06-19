<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{	
		$this->template->write_view('sidebar','nav');
		$this->template->render();		
	}
}
