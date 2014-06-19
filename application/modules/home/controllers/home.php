<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

        public function __construct()
        {
	        parent:: __construct();
	        $this->load->model('login/login_model');      
	       
        }


			public function index()
		{
		//	$data["ok"]=$ok;
			$this->template->write_view('content','login_index');
			$this->template->render();
		}

		public function reestablecer()
		{
			$data=array();
			$this->form_validation->set_rules('pass_viejo','Contraseña Atual','trim|required|xss_clean|min_length[1]|max_length[30]');
			$this->form_validation->set_rules('pass_nuevo','Contraseña Nueva','trim|required|xss_clean|min_length[1]|max_length[30]');
			$this->form_validation->set_rules('pass_nuevo2','Confirmar Contraseña','trim|required|xss_clean|min_length[1]|max_length[30]');

			$this->form_validation->set_message('required','El campo %s es obligatorio.');

			if (!$this->form_validation->run()) {
				$data["ok"] = FALSE;				
				
				
			}
			else{
				$aux=$this->login_model->consultar("",$this->input->post("pass_viejo"),intval(0));
				if($aux==0)
					$data["mensaje"]="La Contraseña Actual no coincide";
				else
				{
					if($this->input->post("pass_nuevo")!=$this->input->post("pass_nuevo2"))
						$data["mensaje"]="Las Contraseñas nuevas no coinciden";
					else 
						{
						if($this->login_model->actualizar_pass(intval($aux),$this->input->post("pass_nuevo")))
							$data["mensaje"]="Contraseña Reestablecida Con exito";
						else
							$data["mensaje"]="La Contraseña no fue Reestablecida Con exito";
						}
				}



			}
			$this->template->write_view('content','reestablecer',$data);
			$this->template->render();


		
		}

		public function crear()
		{
			$this->form_validation->set_rules('usuario','Usuario','trim|required|xss_clean|min_length[1]|max_length[30]');
			$this->form_validation->set_rules('pass','Contraseña','trim|required|xss_clean|min_length[1]|max_length[30]');
			$this->form_validation->set_message('required','El campo %s es obligatorio.');
			$this->form_validation->set_message('min_length','la cantidad de caracteres del campo %s es menor a la esperada.');
			$this->form_validation->set_message('max_length','la cantidad de caracteres del campo %s es mayor a la esperada.');

			if (!$this->form_validation->run()) {
				$ok = FALSE;
				
				$this->template->write_view('content','login_index');
				$this->template->render();
			}
			else
			{
				 $isValidLogin = $this->login_model->consultar($_POST['usuario'],$_POST['pass'],intval(2)); //pasamos los valores al modelo para que compruebe si existe el usuario con ese password
				 
				 if($isValidLogin==0)
				 {
				 	$data["mensaje"]="Usuario y/o Contraseña Incorrrectos";
				 	$this->template->write_view('content','login_index',$data);
					$this->template->render();
				 	/*
				 	$this->template->write_view('content','login_index');
					$this->template->render();*/
				 }else if($isValidLogin==2)
				  {
				  	 $data["mensaje"]="No puedes ingresar a esta aplicacion";
				  	 $this->template->write_view('content','login_index',$data);
					$this->template->render();
				  }
				 else if($isValidLogin==3)
				 {
				 	$data["mensaje"]="No tienes permiso para acceder";
				 	$this->template->write_view('content','login_index',$data);
					$this->template->render();
				 }else
				 {
				 	$sesion_data = array(
	                                        'username' => $_POST['usuario'],
	                                        'password' => $_POST['pass'],
	                                        'rol'=>$isValidLogin
	                                            );
                  $hola=$this->session->set_userdata($sesion_data);
                  echo $hola;


                  header ("Location:". base_url() ."reserva");
				 }
				 
               
			}
			
		}

		public function logout_ci()
    {
        $this->session->sess_destroy();
        $this->index();
    }

	

}

/* End of file index.php */
/* Location: ./application/modules/home/controllers/index.php */