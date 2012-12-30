<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
    class Log extends MY_Controller {
       
               
        function __construct(){

            parent::__construct();
    		
        $this->load->model('log_model');

        }
        
        function index(){

            $data['view'] = 'admin/log/index';
            $data['logList'] = $this->log_model->getLogList();

            $this->load->view('admin/_includes/template', $data);
        }
        
}        