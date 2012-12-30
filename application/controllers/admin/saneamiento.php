<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Saneamiento extends MY_Controller {

    private $upload_path='./assets/img/saneamiento/';
    private $upload_path_thumbs='./assets/img/saneamiento/thumbs/';

   function __construct(){

        parent::__construct();
        $this->load->model('saneamiento_model');
    }


    public function index()
    {
        $data['view'] = 'admin/test/saneamiento/show';
        $data['titulo'] = 'Saneamiento y Marca de Agua';
        $this->load->view('admin/_includes/template', $data);
    }

    public function upload()
    {

        if ($this->input->post()){

            if($this->input->post("txtNombre")==""){
                $image_data = NULL;
                $this->session->set_flashdata('error', $this->lang->line('upload_no_image'));
                //$this->session->set_flashdata('error', 'No ha seleccionado ninguna imagen XDDDD');
            }else{
                // Empieza la subida del archivo si se adjuntó.
                $subida = $this->_subir_archivo($this->upload_path, $this->upload_path_thumbs);
                // Variables retornadas.
                if(!empty($subida['error'])){
                    $this->session->set_flashdata('error', $subida['error']);
                    $image_data = NULL;

                }else{

                    $image_data = $subida['nombre_img'];
                }


            }// End del control de la imagen

            if($image_data != NULL){
                // Inserción de la imágen.
                if($this->saneamiento_model->add($image_data) == TRUE){
                    // Mensaje flashdata.
                    $this->session->set_flashdata('success', $this->lang->line('upload_image_successful'));
                }else{
                    // Mensaje flashdata.
                    $this->session->set_flashdata('error', $this->lang->line('upload_image_unsuccessful'));
                }
            }

        }
        redirect(site_url('admin/saneamiento'));
    }


}
