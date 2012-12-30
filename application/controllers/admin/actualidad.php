<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
    class Actualidad extends MY_Controller {
       
       Private $upload_path='./assets/images/'; 
       Private $upload_path_thumbs='./assets/images/thumbs/';
               
        function __construct(){
            parent::__construct();
    		
    		$this->load->model('actualidad_model');
            $this->load->model('galeria_model');
        }
        
        function index(){
            $data['view'] = 'admin/actualidad/index';
            
            /**
             * Array asociativo del uri. Pej: /controller/function/sort/title/order/asc es un array as�:
             * sort => title
             * order => asc
             * ver m�s abajo...
            */
            $assoc = $this->uri->uri_to_assoc(4);
                   	  
            $sort  = isset( $assoc['sort']  ) ? $assoc['sort']  : 'fecha';
            $order = isset( $assoc['order'] ) ? $assoc['order'] : 'desc';
            
            // Variable extra para saber si hay que salir del foreach que cambia la url y la amplia con los parametros de orden
            $extra = ( $this->uri->segment(5)) ? TRUE : FALSE;
            
            /**
             * mensajes depuraci�n
             * if ($extra) echo 'hay datos extra <br/>'; else echo 'carga index normal <br/>';
             * echo '$sort->' . $sort . ' ';
             * echo '$order->' . $order . ' ';
             * echo '<br/>';
             */ 
            
            // FIX PARA PAGINAR CON FILTROS
            $i   = 0;
            $uri = 'admin/actualidad/index';
            //echo $i . '<br/>';
            foreach ( $assoc as $index => $value )
            {
                if ( ! $extra ) break;
                
                if ($value){
                    $uri .= '/'.$index.'/'.$value;
                    $i = $i+4;    
                }
            }
            
            //echo 'uri->' . $uri . '<br/>';
            //echo '$i-> ' . $i . '<br/>';
            $segment = $i > 4 ? $i : 4;
            //echo '$segment->' . $segment . '<br/>';
            
            // FIN FIX
   
            $config = array();
            $config['base_url'] = base_url().$uri;
            $config['total_rows'] = $this->db->get('actualidad')->num_rows();
            $config['per_page'] = 20;
            $config['num_links'] = 3;
            //Segmento de la cadena que contiene el n�mero de la p�gina
            $config['uri_segment'] = $segment ? $segment : 4;
            $config['first_link'] = 'Primero';
            $config['last_link'] = '�ltimo';
            // inicializaci�n y llamada a vista.
            $this->pagination->initialize($config);
            
            //variable total para mostrar con la paginaci�n
            $data['total'] = $config['total_rows'];
            $data['filas'] = $this->db->get('actualidad')->num_rows();
            //$data['results'] = $this->actualidad_model->noticiasPaginadas($config['per_page'],$this->uri->segment(4));			   
            $data['results'] = $this->db->select('id,titulo,fecha')
                        ->order_by($sort, $order)
	  				   ->get('actualidad', $config['per_page'], $this->uri->segment( $config['uri_segment'] ))
					   ->result();
            
            //$this->load->view('admin/_includes/template', $template); 
            $this->load->view('admin/_includes/template', $data);
        }
        
        function add(){
                    
            $data['view'] = 'admin/actualidad/add';
            //$data['error'] = NULL;
            //$data['correcto'] = NULL;
            
            // Si se ha guardado...
            if ( $input = $this->input->post() ){
                // Variables por si no se insert� imagen. 
                if($this->input->post("txtNombre")==""){
                    $image_data = NULL;
                    $error = FALSE;
                }else{
                    // Empieza la subida del archivo si se adjunt�.  
                    $subida = $this->_subir_archivo($this->upload_path, $this->upload_path_thumbs);
                    // Variables retornadas.
                    $image_data = $subida['file_name'];
                    $error = $subida['error'];
                }// End subida
                    
                // Si da error la subida se guarda el mensaje para mostrarlo en la vista.
                if($error){
                    //$data['error'] = $subida['data_error'];
                    $this->session->set_flashdata('error', $subida['data_error']);
                    //redirect( site_url('admin/actualidad/add') );
                }else{
                    // Si la subida NO da error se insertan los datos.
                    $url = $this->_create_url($this->input->post('title', TRUE),'actualidad');                
                    $datos = array (
                                'titulo' => $this->input->post('title', TRUE),
                                'entradilla' => $this->input->post('intro', TRUE),
                                'url' => $url,
                                'descripcion' => $this->input->post('content', TRUE),
                                'imgNoticia' => $image_data,
                                'keywords' => $this->input->post('metakey', TRUE) . ', ',
                                'fecha' => date('Y-m-d', strtotime(preg_replace('#/#', '-', $this->input->post('date', TRUE))))
                                );
                
                    $this->db->insert('actualidad', $datos);
                    $this->session->set_flashdata('correcto', 'La noticia se ha insertado correctamente!');
                	
                }  //fin del if del insertado, hacer lo mismo con el edit.
                // Redireccionamos y se imprimen los flashdata correspondientes.
                redirect( site_url('admin/actualidad') );                    
            }// End Post
            
            $this->load->view('admin/_includes/template', $data);
        }
        
        function edit(){
            $data['view'] = 'admin/actualidad/edit';
            $error = FALSE;
            if ( $input = $this->input->post() ){
                
                // Si por ej el actualidad/centro tiene imagen y al editar no se cambia dicha imagen, 
                // en campo del form quedar�a NULL por lo que evitamos cambiar la imagen por NULL y perderla por descuido.
                if($this->input->post('txtNombre') != ""){
                   
                    //empieza la subida del archivo y recogemos los valores de retorno.   
                    $subida = $this->_subir_archivo($this->upload_path, $this->upload_path_thumbs);    
                    $image_data = $subida['file_name'];
                    
                    // Si da error guardamos flashdata con el mensaje.
                    if($subida['error'] == TRUE){
                        $this->session->set_flashdata('error', $subida['data_error']);
                        $error = TRUE;
                    }
                    
                }else{
                    
                    //si est� vac�o el campo del txtNombre utilizaremos el valor de nombreImagen para que no se pierda el
                    //nombre de la imagen.
                    
                    $image_data = $this->input->post('nombreImagen');
                    
                }
                
                // Si no ha habido errores se actualiza!
                if ( !$error){                    
                    // Si la subida NO da error se insertan los datos.
                        
                        if($this->input->post('title') == $this->input->post('title_hidden')){
                            $url = $this->input->post('url_hidden');
                        }else{
                            $url = $this->_create_url($this->input->post('title', TRUE),'actualidad'); 
                        }
                        
                        $datos = array (
                                    'titulo' => $this->input->post('title', TRUE),
                                    'entradilla' => $this->input->post('intro', TRUE),
                                    'url' => $url,
                                    'descripcion' => $this->input->post('content', TRUE),
                                    'imgNoticia' => $image_data,
                                    'keywords' => $this->input->post('metakey', TRUE) . ', ',
                                    'fecha' => date('Y-m-d', strtotime(preg_replace('#/#', '-', $this->input->post('date', TRUE))))
                                    );
                                    
                        $this->db->where('actualidad.id', $this->uri->segment(4));
                        $this->db->update('actualidad', $datos);
                        // Guardamos flashdata con mensaje edición correcta.
                        $this->session->set_flashdata('correcto', 'La noticia se ha actualizado correctamente!');
                }
                redirect('admin/actualidad/edit/'.$this->uri->segment(4));
                
            }    
            // Buscamos los datos a editar y su respectiva galer�a.
            $data['results'] = $this->actualidad_model->buscarNoticiaID($this->uri->segment(4));                                   
                          
            $this->load->view('admin/_includes/template', $data);
        
        }
        
        public function drop ()
        {   
            // Redirigimos si no hay 3er segmento en la url
            if ( !$this->uri->segment(3) ) redirect( site_url('admin/actualidad') );

            //Borramos todas las im�genes de la galer�a
            $result = TRUE;
            $hayImg = FALSE;
            $id = $this->uri->segment(4);
            
            $img = $this->actualidad_model->getImgNoticia($id);

            if(!$img[0]->imgNoticia == NULL || !$img[0]->imgNoticia == ""){
                $hayImg = TRUE;
            }
            
            // Eliminamos la imagen de portada de la noticia primero si existe.
            if($hayImg){
                $result = $this->_delete_img($id);
            }
            if($result){
                // Llamada a la funcion de MY_Controller de borrado en cascada de im�genes.
                $result = $this->_drop_all_images('idNoticia', $id, 'galeria_actualidad', $this->upload_path, $this->upload_path_thumbs);
                if($result){
                    $this->db->where('id', $id)
                            ->delete('actualidad');
                }else{
                    //echo "Hubo un error en el borrado de la Galer�a!";
                    $this->session->set_flashdata('error', 'Hubo un error en el borrado de la Galería!');
                }                
            }else{
                //echo "Hubo un error al borrar la im�gen de portada!";
                $this->session->set_flashdata('error', 'Hubo un error al borrar la imagen de portada!');
            }
            
            if ($result){
                $this->session->set_flashdata('correcto', 'Elemento borrado satisfactoriamente!');
            }
            // Recargamos
            redirect( site_url('admin/actualidad') );
        }
        
        public function dropImage ($id)
        {   
            $result = $this->_delete_img($id);
            if($result){
                $this->db->where('id', $id)
                        ->update('actualidad', array('imgNoticia' => NULL));
                redirect('admin/actualidad/edit/'.$id);
            }
            
        }
        
        public function _delete_img ($id)
        {   
            $image = $this->db->select('imgNoticia')
	  					->where('id', $id)
						->get('actualidad')
						->result();              
            
            if ($image != NULL){
                //define the root directory of CodeIgniter
                $image_path = $this->upload_path . $image[0]->imgNoticia;
                $image_path_thumbs = $this->upload_path_thumbs . $image[0]->imgNoticia;
                
                $result = $this->_borrar_imagen($image_path, $image_path_thumbs);
                
                return $result;
            }else{
                return FALSE;
            }
            
        }
        
}        