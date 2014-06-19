	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

			class Informe_Controller extends CI_Controller {


				public function __construct(){

					parent::__construct();
					$this->template->write_view('navbar','navbar');
					$this->template->write_view('navbar_header','navbar_header');

					$this->load->model('informe_model');
					$this->load->library('html2pdf');
					$this->template->write_view('content','informe/index_view');
						if(!$this->session->userdata('username')==true && $this->session->userdata('rol')!=1 || $this->session->userdata('rol')!=1 )
			 	header ("Location:". base_url());
					
					
			}
				public function index()
				{
					$this->template->render();
				}

			    private function createFolder()
				    {
				    	try{
				    		if(!is_dir("./files"))
				            mkdir("./files", 0777);
				           // mkdir("./files/pdfs", 0777);
				    	}
				    	catch (Exception $e)
						{
							echo "hola";
						}	
				    }

				public function mostrar($num)
				{
					switch ($num) {
						case 1:		
							$this->template->write_view('content','informe/cliente/index_cliente');
							$this->template->render();
							# code...
							break;
						
						default:
							# code...
							break;
					}


				}

	    
				public function generar($nombre_pdf,$metodo,$vista,$carpeta)
			    {
			    	// $params = count($this->input->post());
			    	// echo $params;
			    	/* exit();
			    	switch ($params) {
			    		case 1:
			    			# code...
			    			break;
			    		
			    		default:
			    			# code...
			    			break;
			    	}*/
			    	try{

				    	 $this->createFolder();
				        //importante el slash del final o no funcionará correctamente
				        $this->html2pdf->folder('./files/pdfs/');        		
						        //establecemos el nombre del archivo
						$this->html2pdf->filename($nombre_pdf.".pdf");

								//datos que queremos enviar a la vista, lo mismo de siempre
				        $data = array(
						            'datos' => $this->informe_model->$metodo()
						        );	
			        
				        //establecemos el tipo de papel
				        $this->html2pdf->paper('a2', 'portrait');
				        //datos que queremos enviar a la vista, lo mismo de siempre
				        
				        //hacemos que coja la vista como datos a imprimir
				        //importante utf8_decode para mostrar bien las tildes, ñ y demás
				        $this->html2pdf->html(utf8_decode($this->load->view('informe/'.$carpeta.'/'.$vista, $data, true)));
				        
				        //si el pdf se guarda correctamente lo mostramos en pantalla
				        if($this->html2pdf->create('save')) 
				        {
				             $this->show($nombre_pdf);
				        }

			    	}catch(Exception $e)
			    	{
			    		$this->index();
			    	}
			    	
			  


			    } 

				public function show($nombre_pdf)
			    {
			    
			   

			        if(is_dir("./files/pdfs"))
			        {
			            $filename = $nombre_pdf.".pdf"; 

			            $route = base_url("files/pdfs/".$filename); 

			            if(file_exists("./files/pdfs/".$filename))
			            {
			                header('Content-type: application/pdf'); 
			                readfile($route);
			            }
			        }
			    }


	}
