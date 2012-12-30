<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class Gantt extends MY_Controller {
       
   function __construct(){

        parent::__construct();
        
    $this->load->model('graficas_model');

    }


    public function index()
    {

        $data['view'] = 'admin/test/gantt/show';
        $data['gantt'] = $this->graficas_model->getGantt();
        $data['titulo'] = 'Diagrama de Gantt';
        $this->load->view('admin/_includes/template', $data);
    }

        
}        