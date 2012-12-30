<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('tareas_model');
        }

    	public function index ()
    	{
 			$data['tareas_t'] = count($this->tareas_model->tareas_t('estado != "Solucionado"', NULL));
 			$data['tareas'] =  $this->tareas_model->tareas_t(NULL, 6); 		
            $data['view'] = 'admin/index';
            $this->load->view('admin/_includes/template', $data);
    	}

}