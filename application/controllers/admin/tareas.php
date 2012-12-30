<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Tareas extends MY_Controller {


        function __construct(){
            parent::__construct();

            $this->load->model('tareas_model');
            $this->load->model('tarea_comentarios_model');
        }

        function index(){

            $data['view'] = 'admin/tareas/index';
            $data['tareasList'] = $this->tareas_model->getTareasList();

            $this->load->view('admin/_includes/template', $data);
        }


        function add(){

            $data['view'] = 'admin/tareas/add';

            if ($this->input->post()){

            $this->form_validation->set_rules('proyecto', 'proyecto', 'required|xss_clean');
            $this->form_validation->set_rules('entradilla', 'entradilla', 'required|xss_clean');
            $this->form_validation->set_rules('prioridad', 'prioridad', 'required|xss_clean');
            $this->form_validation->set_rules('descripcion', 'descripcion', 'required|xss_clean');
            $this->form_validation->set_rules('solucion', 'solucion', 'xss_clean');
            $this->form_validation->set_rules('tipo', 'tipo', 'required|xss_clean');
            $this->form_validation->set_rules('estado', 'estado', 'required|xss_clean');
            $this->form_validation->set_rules('destinatarios', 'destinatarios', 'xss_clean');
            $this->form_validation->set_rules('horas', 'horas', 'xss_clean');

                if ($this->form_validation->run() == FALSE){
                    $data['view']   = 'admin/tareas/add';
                }else{

                    $datos = $this->input->post(null, TRUE);

                    if(!empty($datos['destinatarios'])){
                        $destinatarios = '';
                        foreach($datos['destinatarios'] as $row){
                            $destinatarios .= $row . ', ';
                        }
                    }else{
                        $destinatarios = '';
                    }

                    // incluimos los dentinatarios en el array de inserción.
                    $datos['destinatarios'] = $destinatarios;

                    //if($id != FALSE){
                    if ($id = $this->tareas_model->add($datos)){

                        if($this->input->post('destinatarios') != ''){

                            if($this->tareas_model->email($datos, $id, $datos['destinatarios']) == TRUE){
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

                    redirect(site_url('admin/tareas'));
                }

                $this->load->view('admin/_includes/template', $data);

            }else{

            $this->load->view('admin/_includes/template', $data);

            }
        }


        function edit(){

            $data['view'] = 'admin/tareas/edit';
            $data['results'] = $this->tareas_model->get($this->uri->segment(4));

            if ($this->input->post()){

                $this->form_validation->set_rules('proyecto', 'proyecto', 'required|xss_clean');
                $this->form_validation->set_rules('entradilla', 'entradilla', 'required|xss_clean');
                $this->form_validation->set_rules('prioridad', 'prioridad', 'required|xss_clean');
                $this->form_validation->set_rules('descripcion', 'descripcion', 'required|xss_clean');
                $this->form_validation->set_rules('solucion', 'solucion', 'xss_clean');
                $this->form_validation->set_rules('tipo', 'tipo', 'required|xss_clean');
                $this->form_validation->set_rules('estado', 'estado', 'required|xss_clean');
                $this->form_validation->set_rules('destinatarios', 'destinatarios', 'xss_clean');
                $this->form_validation->set_rules('horas', 'horas', 'xss_clean');

                if ($this->form_validation->run() == FALSE){
                    $data['view']   = 'admin/tareas/edit';
                }else{

                    $datos = $this->input->post(NULL, TRUE);

                    if(!empty($datos['destinatarios'])){
                        $destinatarios = '';
                        foreach($datos['destinatarios'] as $row){
                            $destinatarios .= $row . ', ';
                        }
                    }else{
                        $destinatarios = '';
                    }

                    // incluimos los dentinatarios en el array de inserción.
                    $datos['destinatarios'] = $destinatarios;

                    // Editamos la tarea.
                    if($this->tareas_model->edit($this->uri->segment(4), $datos)){

                        if($this->input->post('destinatarios') != ''){

                            // Envío de Email en caso de haber destinatarios asignados.
                            if($this->tareas_model->email($datos, $this->uri->segment(4), $datos['destinatarios'])){
                                // Mensaje flashdata.
                                $this->session->set_flashdata('success', 'Se ha editado correctamente y se ha enviado el correo');
                            }else{
                                // Mensaje flashdata.
                                $this->session->set_flashdata('success', 'Se ha editado correctamente pero no se ha podido mandar el correo');
                            }

                        }else{
                                // Mensaje flashdata.
                                $this->session->set_flashdata('success', 'Se ha edidato correctamente');
                        }

                    }else{
                        // Mensaje flashdata.
                        $this->session->set_flashdata('error', 'No se ha podido editar los datos');
                    }

                redirect(site_url('admin/tareas/edit/' . $this->uri->segment(4)));

                }

            //$this->load->view('admin/_includes/template', $data);

            }else{
                $this->load->view('admin/_includes/template', $data);
            }

        }


        public function drop()
        {

            if ( !$this->uri->segment(4) ) redirect( site_url('admin/tareas') );

            // Borramos la tarea
            if($this->tareas_model->drop($this->uri->segment(4))){
                // Mensaje flashdata.
                $this->session->set_flashdata('success', 'Tarea borrada satisfactoriamente!');
            }else{
                // Mensaje flashdata.
                $this->session->set_flashdata('error', 'No se puede borrar la tarea o no existe');
            }

            redirect(site_url('admin/tareas'));

        }

        /**
         * Muestra ficha de la tarea y comentarios
         *
         * Se buscan los datos de la ficha, se carga su vista (admin/tareas/show)
         * y dentro del div id='comments' sus comentarios mediante llamada AJAX a la funcion get_comments()
         *
         * De esta manera con AJAX podemos actualizar los comentarios y recargar el div id="comments"
         * con la actualización de la lista.
         *
         */
        public function show()
        {

            $id = $this->uri->segment(4);

            if(count($this->tareas_model->get($id)) == 0){

                $this->session->set_flashdata('error', 'Esta tarea no existe o ha sido borrada');
                redirect(site_url('admin/tareas'));

            }else{
                $data['result'] = $this->tareas_model->get($id);
                $data['comentarios'] = $this->tarea_comentarios_model->getComentariosList($id);
                $data['view'] = 'admin/tareas/show';
                $this->load->view('admin/_includes/template', $data);

            }


        }

        /**
         * Función llamada desde AJAX para recargar el div id="comments"
         * y actualizar.
         */
        public function get_comments(){
            $id = $this->uri->segment(4);

            $data['comentarios'] = $this->tarea_comentarios_model->getComentariosList($id);
            $this->load->view('admin/tareas/comments', $data);
        }


        /*
        function barcode()
        {

        //Cargamos la librería del Zend, y cargamos el Barcode
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');

        //El primer parámetro es el tipo de barcode, el segundo es el tipo y el tercero
        //son los datos del barcode, en text va el código que según el tipo de barcode,
        //puede ser números o números o letras.

        Zend_Barcode::render('code128', 'image', array('text' => '00000000000000009870', 'barHeight' => 80), array());

        }
        */

}