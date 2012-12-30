<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tareas_proyecto extends CI_Controller {

	public function index()
	{
		#log tareas del proyecto con sus subtareas.
	}

	public function add(){
		$data['view'] = 'admin/proyectos/tareas/add';
		#if posts....
		$this->load->view('admin/_includes/template', $data);
	}

}

/* End of file tareas_proyecto.php */
/* Location: ./application/controllers/admin/tareas_proyecto.php */
