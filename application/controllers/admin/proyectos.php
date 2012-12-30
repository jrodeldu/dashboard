<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyectos extends MY_Controller {

	function __construct(){
            parent::__construct();

            $this->load->model('proyectos_model');
    }

	public function index()
	{
		#code..
		// Cargar log última actividad del proyecto.
	}

	public function add(){
		
		$data['view'] = 'admin/proyectos/add';

		if ($datos = $this->input->post()){

			$this->form_validation->set_rules('proyecto', 'proyecto', 'required|xss_clean');
            $this->form_validation->set_rules('descripcion', 'descripcion', 'required|xss_clean');
            $this->form_validation->set_rules('destinatarios', 'destinatarios', 'xss_clean');

            if(!empty($datos['destinatarios'])){
                $destinatarios = '';                    
                foreach($datos['destinatarios'] as $row){
                $destinatarios .= $row . ', ';}
		    }else{
                $destinatarios = '';
            }

            if ($this->form_validation->run() == FALSE){

                $data['view']   = 'admin/proyectos/add';

            }else{

				if($this->proyectos_model->create($destinatarios)){

					if($this->input->post('destinatarios') != ''){

                        if($this->proyectos_model->email($datos, $destinatarios, 'Proyecto') == TRUE){

                            $this->session->set_flashdata('success', 'Se ha insertado correctamente y se ha enviado el correo');

                        }else{

                            $this->session->set_flashdata('success', 'Se ha insertado correctamente pero no se ha podido enviar el correo');

                        }

                    }else{

                        $this->session->set_flashdata('success', 'Se ha insertado correctamente');

                    }

				}else{
					
					$this->session->set_flashdata('error', 'No se ha podido insertar los datos');	
				
				}

				redirect(site_url('admin/proyectos'));
			}

		}

		$this->load->view('admin/_includes/template', $data);
	}


	public function edit(){

    $data['view'] = 'admin/proyectos/edit';
    $data['results'] = $this->proyectos_model->get_proyecto($this->uri->segment(4));

	   
	    if ($this->input->post()){

				$this->form_validation->set_rules('proyecto', 'proyecto', 'required|xss_clean');
	            $this->form_validation->set_rules('descripcion', 'descripcion', 'required|xss_clean');
	            $this->form_validation->set_rules('destinatarios', 'destinatarios', 'xss_clean');

	        if ($this->form_validation->run() == FALSE){

	            $data['view']   = 'admin/proyectos/edit';

	        }else{

	            $datos = $this->input->post();

	            if(!empty($datos['destinatarios'])){
	                
	                $destinatarios = '';                    
	                foreach($datos['destinatarios'] as $row){
	                $destinatarios .= $row . ', ';}


	            }else{

	                $destinatarios = '';

	            }

	            if($this->proyectos_model->update($this->uri->segment(4), $destinatarios) == TRUE){

	                if($this->input->post('destinatarios') != ''){

	                    if($this->proyectos_model->email($datos, $destinatarios, 'Proyecto') == TRUE){

	                        $this->session->set_flashdata('success', 'Se ha editado correctamente y se ha enviado el correo');

	                    }else{

	                        $this->session->set_flashdata('success', 'Se ha editado correctamente pero no se ha podido mandar el correo');

	                    }

	                }else{

	                        $this->session->set_flashdata('success', 'Se ha edidato correctamente');

	                }
	            }else{

	                $this->session->set_flashdata('error', 'No se ha podido editar los datos');

	            }

	        redirect(site_url('admin/proyectos/edit/' . $this->uri->segment(4)));

	        }

	    $this->load->view('admin/_includes/template', $data);

	    }else{

	    $this->load->view('admin/_includes/template', $data);

	    }

	}




}

/* End of file proyectos.php */
/* Location: ./application/controllers/admin/proyectos.php */