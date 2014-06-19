<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		class Paquete_Controller extends CI_Controller {
			public function __construct(){
				parent::__construct();
				$this->template->write_view('navbar_header', 'navbar_header');
				$this->template->write_view('navbar', 'navbar');
				$this->template->write_view('content_header','paquete/paquete_index');
				$this->load->model('paquete_model');
					if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1 )
			 	header ("Location:". base_url());
				
		}

		public function index($ok = FALSE)
		{

			$this->template->render();
		}

		public function registrar_tipo()
		{
				$this->form_validation->set_rules(
				'nombre', 
				'Nombre ', 
				'trim|required|xss_clean|min_length[5]|is_unique[tipo_paquete.descripcion]'
			);


			$this->form_validation->set_message('required','El dato %s es obligatorio.');
			$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
			$this->form_validation->set_message('valid_email','El dato %s no es válido.');
			$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');

			if (!$this->form_validation->run()) {
				$ok = FALSE;
			}
			else{

					$respuesta=$this->paquete_model->registrar_tipo($this->input->post('nombre'),intval(0));
					



				if ($respuesta) {
					$ok = TRUE;
				} else {
					$ok = FALSE;
				}
			}

		$data['ok'] = 	$ok;
		$this->template->write_view('content', 'paquete/tipo_servicio_r', $data);
		$this->template->render();
		}

		public function consultar_listar($id,$ok="")
		{
			$data['ok']=$ok;
			if($id==0)
			{
				$data['datos']=$this->paquete_model->listar_consultar(intval($id));
				$this->template->write_view('content', 'paquete/tipo_paquete_consulta', $data);
			}
			else
			{							
				$data['datos']=$this->paquete_model->listar_consultar(intval($id));

				$this->template->write_view('content', 'paquete/tipo_paquete_modificar', $data);
			
			}
			$this->template->render();
		}

		 public function validar_nombres($nombre)
 		{
			$dato = $this->paquete_model->validar($this->input->post('id',TRUE));

			foreach ($dato as $value) {
				$valor=$value;
			}


			if($valor->descripcion == $nombre) {
				return TRUE;
			}
			if($this->form_validation->set_rules('nombre', 'Nombre', 'is_unique[tipo_paquete.descripcion]')) {
				return FALSE;
			} else {
				return TRUE;
			}
  	    }

  	    public function modificar_tipo()
  	    {
  	    	$this->form_validation->set_rules(
				'nombre', 
				'Nombre ', 
				'trim|required|xss_clean|min_length[5]|callback_validar_nombres[nombre]'
			);

			$this->form_validation->set_message('required','El dato %s es obligatorio.');
			$this->form_validation->set_message('min_length','la cantidad de caracteres del %s es menor a la esperada.');
			$this->form_validation->set_message('validar_nombres','El nombre ya existe.');
			$this->form_validation->set_message('is_unique','El dato %s ya está registrado.');


			if (!$this->form_validation->run()) {
				$ok = FALSE;
			}
			else
			{
				$respuesta=$this->paquete_model->registrar_tipo($this->input->post('nombre'),intval($this->input->post('id')));
	  	    	if ($respuesta)
	  	    		$ok=true;
	  	    	
	  	    	else
	  	    		$ok = false;

			}
  	    	$this->consultar_listar(intval($this->input->post('id')),$ok);

  	    }

  	    public function consultar_paquete()
  	    {

  	    		$this->form_validation->set_rules(
				'fecha_inicio', 
				'Fecha Inicio ', 
				'trim|required|xss_clean|callback_validar_fecha[fecha_inicio]'
			);
  	    	  	$this->form_validation->set_rules(
				'fecha_fin', 
				'Fecha Fin', 
				'trim|required|xss_clean|callback_validar_fecha[fecha_fin]'
			);

  	    	  	$data["mensaje"]="";

  	    	 $this->form_validation->set_message('required','El dato %s es obligatorio.');
  	    	 $this->form_validation->set_message('validar_fecha','La %s no puede ser menor de la actual.');
  	    	 if (!$this->form_validation->run()) {
				$data["habitaciones"]="";
				$data["citytour"]="";
				$data["evento"]="";
				$data["sitios_turisticos"]="";
				$data["ok"]=false;
				$data["action"]="principal";
			}
			else
			{
				$fecha_inicio=$this->input->post('fecha_inicio');
				$fecha_fin=$this->input->post('fecha_fin');

				if($fecha_fin<$fecha_inicio)
					{
						$data["mensaje"]="La fecha fin no puede ser menor de la inicial";
						$data['ok']=false;
						$data["action"]="principal";
					}
					else
					{
						
						$data["citytour"]=$this->paquete_model->citytour($fecha_inicio,$fecha_fin);
						$data["evento"]=$this->paquete_model->eventos($fecha_inicio,$fecha_fin);
						$data["tipo"]=$this->paquete_model->listar_consultar(intval(0));
						$data["habitaciones"]=$this->paquete_model->habitaciones($fecha_inicio,$fecha_fin);
						$data["fecha_inicio"]=$this->input->post("fecha_inicio");
						$data["fecha_fin"]=$this->input->post("fecha_fin");
						$data['ok']=false;
						$data["action"]="crear";
						
					}

			}

			$this->template->write_view('content', 'paquete/paquete_principal', $data);
			
			$this->template->render();
  	    }


  	    public function crear()
  	    {
  	    	$this->form_validation->set_rules(
				'cupo', 
				'Cupos', 
				'trim|required|xss_clean|numeric'
			);
  	    	$tipo_paquete=$this->input->post("tipo");
  	    	$fecha_inicio=$this->input->post("fecha_inicio");
  	    	$fecha_fin=$this->input->post("fecha_fin");

  	    	if($this->input->post("evento"))
  	    		$evento=$this->input->post("evento");
  	    	else
  	    		$evento=null;

  	    	if($this->input->post("city"))
  	    		$city=$this->input->post("city");
  	    	else
  	    		$city=null;

  	    	$transporte=$this->input->post("transporte");
  	    	$cupos= $this->input->post("cupo");

  	    	if($evento==null && $city==null)
  	    	{
  	    		$data["ok"]=true;
  	    		$data["mensaje"]="Se deben escojer como minimo dos servicios para armar un paquete";
  	    	}
  	    	else
  	    	{
  	    			$respuesta = $this->paquete_model->crear_paquete($tipo_paquete,$fecha_inicio,$fecha_fin,0,$evento,$transporte,$city,$cupos);

  	

  	    			if($respuesta)
					{
						foreach ($this->input->post() as $key => $value) 
						{
							if( stristr($key, 'check') )
								$this->paquete_model->registrar_habitacion($value);
						}
					}

				$data["habitaciones"]="";
				$data["citytour"]="";
				$data["evento"]="";
				$data["sitios_turisticos"]="";
				$data["ok"]=true;
				$data["action"]="principal";
  	    	}
  	    		$data["habitaciones"]="";
				$data["citytour"]="";
				$data["evento"]="";
				$data["sitios_turisticos"]="";
				$data["action"]="principal";
  	    
			$this->template->write_view('content', 'paquete/paquete_principal', $data);
			
			$this->template->render();

  	    }

  	    public function consultar_paquetes($id,$ok=true)
		{

				$data['ok']=$ok;
				$data['paquete']=$this->paquete_model->consultar_p(intval($id));

				if($id!=0)
					$data['detalle']=$this->paquete_model->detalle(intval($id));

				$this->template->write_view('content', 'paquete/paquete_consulta', $data);
				$this->template->render();
		}

		public function modificar_estado($id)
		{
			$ok=$this->paquete_model->cambiar_estado($id);
			
			if ($ok)
				{
				echo "<script  type='text/javascript' charset='utf-8' >
					 alert('Estado Cambiado exitosamente');
					 </script>";
				}
				
			else
			{
				echo "<script  type='text/javascript' charset='utf-8' >
					 alert('No se puede cambiar');
			 		</script>";
			}
			header ("Location:". base_url()."paquete/consultar/0");

			
		}



  	    public function validar_fecha($fecha)
  	    {
  	    	$date = date('Y-m-d');
  	    	if($fecha<$date)

  	    		return false;
  	    	else
  	    		return true;

  	    }
}