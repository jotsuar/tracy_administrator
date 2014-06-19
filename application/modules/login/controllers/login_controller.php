<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		class Login_Controller extends CI_Controller {
			public function __construct(){
				parent::__construct();

				$this->template->write_view('navbar_header','navbar_header');
				
				
				$this->template->write_view('navbar', 'navbar');

				$this->template->render();
				
					if(!$this->session->userdata('username')==true && ($this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=2) )
			 			header ("Location:". base_url());
	
				
			 	
		}

		public function index($ok = "")
		{
			 
			
		}






}