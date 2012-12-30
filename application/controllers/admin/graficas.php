<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Graficas extends CI_Controller {

	function __construct(){

            parent::__construct();
    		
        $this->load->model('graficas_model');

    }


	public function index()
	{
        $data['view'] = 'admin/test/graficas/index_view';
        $data['titulo'] = 'Graficas';
        $this->load->view('admin/_includes/template', $data);
	}


	public function tarta(){

        $data['view'] = 'admin/test/graficas/tarta_view';
        $data['titulo'] = 'Gráfica Tarta';
        $this->load->view('admin/_includes/template', $data);

	}


	public function lineas(){

        $data['view'] = 'admin/test/graficas/lineas_view';
        $data['titulo'] = 'Gráfica Lineas';
        $this->load->view('admin/_includes/template', $data);

	}

	public function barra(){

        $data['view'] = 'admin/test/graficas/barra_view';
        $data['titulo'] = 'Gráfica una Barra';
        $this->load->view('admin/_includes/template', $data);
	}

	public function barras(){

        $data['view'] = 'admin/test/graficas/barras_view';
        $data['titulo'] = 'Gráfica varias Barras';
        $this->load->view('admin/_includes/template', $data);

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */