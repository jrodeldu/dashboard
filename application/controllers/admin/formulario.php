<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formulario extends CI_Controller {

	public function index()
	{
		$data['view'] = 'admin/test/forms/form_widget';
		$this->load->view('admin/_includes/template', $data);
	}

	public function tiny_mce()
	{
		$data['view'] = 'admin/test/forms/form_tinymce_widget';
		$this->load->view('admin/_includes/template', $data);
	}

}

/* End of file formulario.php */
/* Location: ./application/controllers/dashboard/formulario.php */
