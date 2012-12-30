<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	Private $upload_path_thumbs = './assets/img/avatars/thumbs/';
    Private $upload_path = './assets/img/avatars/';

	// Constructor
	public function __construct()
	{
		parent::__construct();
		// Modelos
		$this->load->model('users_model');
		// ReCaptcha
		$this->load->library('recaptcha');
		$this->lang->load('recaptcha');
	}

	public function index()
	{
	 	if (!$this->users_model->is_logged_in()){
			redirect(site_url('admin', 'refresh'));
		}
		// Cargar tabla con usuarios.
		echo 'En proceso...';
	}


	// Registro de usuarios.
    public function signup(){
     	if (!$this->users_model->is_logged_in() || $this->session->userdata('is_admin') == FALSE){
			redirect(site_url('admin', 'refresh'));
		}

    	$data['view'] = 'admin/users/signup';
    	// La función get_html de la librería devolverá el Formulario Captcha alojado en views/recaptcha.php
    	$data['recaptcha'] = $this->recaptcha->get_html();
    	// Cuando se haga post en el form se irá a la validación
    	if ($this->input->post()){
    		// Reglas de validación.
	    	// Si ya existe el username o el email en la tabla users o temp_users no permite registro.
			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[5]|max_length[50]|xss_clean');
			$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|min_length[2]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[30]|is_unique[users.username]|is_unique[temp_users.username]|xss_clean');
			$this->form_validation->set_rules('userpass', 'Contraseña', 'trim|required||min_length[6]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('passconf', 'Confirmar contraseña', 'trim|required||min_length[6]|max_length[30]|matches[userpass]|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]|is_unique[temp_users.email]|xss_clean');
			// Validación del campo recaptcha.
			$this->form_validation->set_rules('recaptcha_response_field', 'lang:recaptcha_field_name', 'required|callback__check_captcha');
			if ($this->form_validation->run() == FALSE){
				// Si no es validado se carga de nuevo el form con los errores de la validación PHP.
				// Este caso se dará si el user desactiva las validaciones JS.
				$this->load->view('admin/_includes/template', $data);
			}
			else{
				//$data['view'] = 'admin/users/signup_temp_result';
				$input_data = array(
		                'nombre' => $this->input->post('nombre'),
		                'apellidos' => $this->input->post('apellidos') ,
		                'username' => $this->input->post('username'),
		                'userpass' => $this->input->post('userpass'),
		                'email' => $this->input->post('email')
		        );
				if ($this->users_model->signup_temp($input_data)){
					// correcto.
					$data['message'] = $this->users_model->get_message();
				}else{
					// incorrecto.
					$data['error'] = $this->users_model->get_error();
				}
				$this->load->view('admin/_includes/template', $data);
			}
    	}else{
			$this->load->view('admin/_includes/template', $data);
		}
    }

    // Callback comprobación de captcha.
	function _check_captcha($val){
		if ($this->recaptcha->check_answer($this->input->ip_address(),$this->input->post('recaptcha_challenge_field'),$val)) {
			return TRUE;
		}else{
			$this->form_validation->set_message('_check_captcha',$this->lang->line('recaptcha_incorrect_response'));
			return FALSE;
		}
	}


	/**
     *  Función de cambio de contraseña
     *
     *  Dentro de las reglas de validación se llamará a un callback
     *  para comprobar que la contraseña antigua coincide realmente con la del user.
     */
    public function edit_password(){

		if (!$this->users_model->is_logged_in()){
			redirect('admin', 'refresh');
		}

        $data['view'] = 'admin/users/edit_password';
        if ($this->input->post()){
        	// Recogemos el campo identidad para cambiarle a ese registro los datos.
		    $identity = $this->session->userdata($this->config->item('identity', 'users_auth'));
            // Reglas de validación.
            // La validación pasará por 'callback__checkPassword' si la contraseña old no corresponde con la actual fallará y no se podrá actualizar.
            $this->form_validation->set_rules('old', 'Contraseña', 'trim|required|min_length[' . $this->config->item('min_password_length', 'users_auth') . ']|max_length[' . $this->config->item('max_password_length', 'users_auth') . ']|xss_clean|callback__checkPassword['.$identity.']');
            $this->form_validation->set_rules('new', 'Contraseña', 'trim|required|min_length[' . $this->config->item('min_password_length', 'users_auth') . ']|max_length[' . $this->config->item('max_password_length', 'users_auth') . ']|xss_clean');
            $this->form_validation->set_rules('new_confirm', 'Confirmar contraseña', 'trim|required|min_length[' . $this->config->item('min_password_length', 'users_auth') . ']|max_length[' . $this->config->item('max_password_length', 'users_auth') . ']|matches[new]|xss_clean');

            if ($this->form_validation->run() == FALSE){
                // Si no es validado se carga de nuevo el form con los errores de la validación PHP.
                // Este caso se dará si el user desactiva las validaciones JS.
                $this->load->view('admin/_includes/template', $data);
            }else{

            	$new_password = $this->input->post('new');
            	if ($this->users_model->edit_password($identity, $new_password)){
            		// correcto...
            		// Flashdata para comprobar que se llega a la vista de success desde cambio correcto y no directamente poniendo url.
		            $this->session->set_flashdata('cambiado', 'true');
		            $this->session->set_flashdata('message', $this->lang->line('password_change_successful'));
		            redirect('admin/users/edit_password_success');
            	}else{
            		// incorrecto...
            		$this->session->set_flashdata('message', 'password_change_unsuccessful');
            		redirect('admin/users/edit_password', 'refresh');
            	}
            }
        }else{
        	// Este form se carga sin datos.
            $this->load->view('admin/_includes/template', $data);
        }
    }

    // Cargamos vista de exito de cambio de pass y redirigimos
    function edit_password_success(){
    	// Si no existe el flashdata success es que no se accede a través del flujo normal de cambio de pass
    	if (!$this->users_model->is_logged_in() || !$this->session->flashdata('cambiado')){
			redirect('admin', 'refresh');
		}
		// meta para redirigir 2 seg después de mostar el mensaje de password cambiado.
		$data['meta'] = "<meta http-equiv='refresh' content='2; url=" . base_url() . "admin'>";
    	$data['view'] = 'admin/users/edit_password_success';
    	$this->load->view('admin/_includes/template', $data);
    }

    /**
	 * Comprobamos que la contraseña es correcta
	 *
	 * @return boolean
	 */
	function _checkPassword($pass_input, $identity)
	{
		// El parametro $pass_input ha sido pasado antes por el filtro xss.
		// Comprobamos que el password old corresponde con ese usuario.
		if ($this->users_model->check_password($pass_input, $identity)){
			return TRUE;
		}else{
			$this->form_validation->set_message('_checkPassword', $this->users_model->get_error());
			return FALSE;
		}
	}

	/**
     * Pasamos al usuario de temp_users a users.
     * Primero comprobamos que el key es válido en la tabla temp_users.
     */
    public function register_user($key){
    	$data['view'] = 'admin/users/signup_success';
    	$data['meta'] = "<meta http-equiv='refresh' content='5; url=" . base_url() . "admin'>";

    	if($this->users_model->register_user($key)){
    		$data['message'] = $this->users_model->get_message();
    	}else{
    		$data['error'] = $this->users_model->get_error();
    	}
    	// Cargamos la vista con el resultado.
    	$this->load->view('admin/_includes/template', $data);
    }

    public function edit_avatar(){

    	if($datos = $this->input->post()){//mirar lo de si tiene ya una creo que no hace falta y poner las rutas de las img
    		/*Comprobamos por javascript si hay seleccionado un archivo*/
    		if($this->input->post("txtNombre")==""){
                $this->session->set_flashdata('error', 'No ha seleccionado ninguna imagen');
            }else{
				/*En caso de que haya seleccionado un archivo*/
            	$id = $this->session->userdata('id'); //recogemos el id del user
            	$result = $this->users_model->select_img($id);
            	/*
            	print_r($result);
            	echo $result->avatar;
            	die();
            	*/
            	$image = $result->avatar; //guardamos el nombre de la img para borrarla más adelante

	    		$subida = $this->_subir_archivo($this->upload_path, $this->upload_path_thumbs);

		    	if(!empty($subida['error'])){ //si ocurre un error paramos la función y mandamos los errres a la vista
		            $this->session->set_flashdata('error', $subida['error']);
	            }else{
                    $image_data = $subida['nombre_img'];
                    //ahora insertamos los datos en la base de datos una vez se hayan subido los archivos.
                    if($this->users_model->update_img($id,$image_data)){
                    	//cambiamos el avatar de la session para que salga la nueva img
                    	$this->session->set_userdata('avatar', $image_data);
                    	if($result){//comprobamos si la img es el del avatar para no borrarla y procedemos al borrado
	                    	if($this->delete_img($image)){
	                    		$this->session->set_flashdata('success', 'La imagen se ha insertado correctamente');
	                    	}else{
	                    		$this->session->set_flashdata('success', 'La imagen se ha insertado correctamente  pero no se han podifo borrar las anteriores');
	                    	}
                    	}else{
                    		$this->session->set_flashdata('success', 'La imagen se ha insertado correctamente');
                    	}
                    }else{
                    	$this->session->set_flashdata('error', 'Ha ocurrido un error y no se ha podido cambiar el avatar');
                    }
	            }

            }

            redirect(site_url('admin/users/edit_password'));

    	}else{
    		redirect(site_url('admin/users/edit_password'));
    	}

    }

    public function delete_img($image){

		if(unlink($this->upload_path . $image)){
	    	if(unlink($this->upload_path_thumbs . $image)){
	    		return TRUE;
	    	}else{
	    		return FALSE;
	    	}
		}else{
			return FALSE;
		}

    }


}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */
