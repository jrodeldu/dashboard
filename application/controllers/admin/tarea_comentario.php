<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Tarea_comentario extends MY_Controller {


        function __construct(){
            parent::__construct();

            $this->load->model('tareas_model');
            $this->load->model('tarea_comentarios_model');
        }


        function add(){

            $id = $this->uri->segment(4);

            if ($this->input->post()){

                $this->form_validation->set_rules('comentario_tarea', 'comentario_tarea', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE){
                    $this->session->set_flashdata('error', $this->lang->line('input_required'));
                }else{
                    //$datos = $this->input->post();
                    $insertado = $this->tarea_comentarios_model->add($id);
                    if($insertado){
                        // flashdata a mostrar en caso de petición php sin ajax
                        $this->session->set_flashdata('success', $this->lang->line('insert_successful'));
                    }else{
                        $this->session->set_flashdata('error', $this->lang->line('insert_unsuccessful'));
                    }

                    // Refrescamos el div o la web si no hay JS activado.
                    if(IS_AJAX){
                        echo '<div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Bien hecho!</strong> Se ha insertado correctamente
                            </div>';
                    }else{
                        redirect(site_url('admin/tareas/show/' . $id . ''));
                    }
                }// End Validation.

            }
            redirect(site_url('admin/tareas/show/' . $id . ''));

        }


        function edit(){

            if ($this->input->post()){

                $this->form_validation->set_rules('comentario_edit', 'comentario_edit', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE){
                    $this->session->set_flashdata('error', $this->lang->line('input_required'));
                }else{

                    $datos = $this->input->post();

                    // editamos el comentario
                    if($this->tarea_comentarios_model->edit($this->uri->segment(5), $this->uri->segment(4)) == TRUE){
                        $this->session->set_flashdata('success', $this->lang->line('update_successful'));
                    }else{
                        $this->session->set_flashdata('error', $this->lang->line('update_unsuccessful'));
                    }
                }

                // Refrescamos el div o la web si no hay JS activado.
                if(IS_AJAX){
                    echo '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Bien hecho!</strong> Se ha editado correctamente
                        </div>';
                }else{
                        redirect(site_url('admin/tareas/show/'. $this->uri->segment(4) .''));
                }

            }else{
                redirect(site_url('admin/tareas/show/'. $this->uri->segment(4) .''));
            } // end post()
        }


        public function drop()
        {
            // Si no hay un id pasado con drop se redirige.
            if ( !$this->uri->segment(5) ) redirect( site_url('admin/tareas/show/'. $this->uri->segment(4) ) );

            if($this->tarea_comentarios_model->delete_comment($this->uri->segment(5),$this->uri->segment(4))){
                $this->session->set_flashdata('success', $this->lang->line('delete_successful'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('delete_unsuccessful'));
            }

            // Refrescamos el div o la web si no hay JS activado.
            if(IS_AJAX){
                echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Bien hecho!</strong> Se ha borrado correctamente
                    </div>';
            }else{
                redirect(site_url('admin/tareas/show/'. $this->uri->segment(4) .''));
            }
        }


        public function show()
        {
            $id = $this->uri->segment(4);

            if(count($this->tareas_model->get_tarea($id)) == 0){
                $this->session->set_flashdata('error', 'Esta noticia no existe o ha sido borrada');
                redirect(site_url('admin/tareas'));
            }else{
                $data['result'] = $this->tareas_model->get_tarea($id);
                $data['view'] = 'admin/tareas/show';
                $this->load->view('admin/_includes/template', $data);
            }
        }

}