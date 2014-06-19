<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		class Buckup_Controller extends CI_Controller {
			public function __construct(){
				parent::__construct();
				$this->template->write_view('navbar','navbar');
				$this->template->write_view('navbar_header','navbar_header');
				$this->load->helper('file');
				$this->load->model('buckup_model');
					if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1) 
			 	header ("Location:". base_url());
				

		$this->template->render();
		}

		public function index($ok = "")
		{
			$data["ok"]=$ok;
			$data["datos"]=$this->buckup_model->consultar();
			$this->template->write_view('content','buckup_index',$data);
			$this->template->render();
		}

		public function generar()
		{
			// Carga la clase de utilidades de base de datos
			$this->load->dbutil();
			$ruta="./public/buckup/";
			date_default_timezone_set("America/Bogota");
			$fecha = date("d-m-Y-g-i-s-a");
			$nombre = $ruta.'copia-'. $fecha.'.zip';
			
		

			$prefs = array(
                'tables'      => array(),  // Array of tables to backup.
                'ignore'      => array(),           // List of tables to omit from the backup
                'format'      => 'zip',             // gzip, zip, txt
                'filename'    => 'copia.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => FALSE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );

			// $this->dbutil->backup($prefs);
			// Crea una copia de seguridad de toda la base de datos y la asigna a una variable
			$copia_de_seguridad = $this->dbutil->backup($prefs); 
			// Carga el asistente de archivos y escribe el archivo en su servidor
			
			write_file($nombre, $copia_de_seguridad); 
			//$this->load->helper('download');
			//force_download('copia_de_seguridad.zip', $copia_de_seguridad);
			//
			
			$respuesta = $this->buckup_model->registrar($nombre);
			
			if($respuesta)
				$ok=true;
			else
				$ok=FALSE;

			$this->index($ok);
			}




}