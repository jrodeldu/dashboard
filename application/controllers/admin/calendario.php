<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendario extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('calendario_model');
	}

	public function index()
	{
		//$this->load->view('dashboard/calendar_widget');
		$data['view'] = 'admin/test/calendar/calendar_widget';
		$this->load->view('admin/_includes/template', $data);
	}

	public function get_events(){
		/******* get_all ******/
		//$results = $this->calendario_model->get_all(array('finicio' => '2012-12-17'), 'kaka'); // FUNCIONA
		//$results = $this->calendario_model->get_all(array('finicio' => '2012-12-17')); // FUNCIONA
		//$results = $this->calendario_model->get_all(1); // FUNCIONA
		$results = $this->calendario_model->get_all(); // FUNCIONA
		/******* get ******/
		//$results = $this->calendario_model->get(1); // FUNCIONA
		//$results = $this->calendario_model->get(array('id' => 5, 'finicio' => '2012-12-17')); // FUNCIONA
		//$result = json_encode($results);
		//echo $result;
		/*
		echo 'resultado: <br/>';
		print_r($results);
		*/

		// Una vez recogidos los eventos debemos asignar los valores devueltos con el
		// nombre correspondiente para que el fullcalendar los reconozca.
		if($results){
            foreach ($results as $row){
                // Se rellena el array con todos los resultados
                $arrayEvents[] = array(
                    'id'    =>  $row->id,
                    'title'   =>  $row->nombre,
                    'start' =>  $row->finicio,
                    'end' =>  $row->ffin,
                    //'allDay' => false,
                    'url'   =>  $row->url
                );
            }
        // se muestran en formato json, lo recoge la función ajax
        echo json_encode($arrayEvents);
        }

	}

	public function update_event($id_event = null, $start = null, $end = null){

		if($end == 'null' || empty($end)){
			$end = $start;
		}

		$result = $this->calendario_model->update_event($id_event, $start, $end);
		if($result){
			return TRUE;
		}
	}

	public function add_event(){

		$data['view'] = 'admin/test/calendar/calendar_widget';

            if ($datos = $this->input->post()){

            $this->form_validation->set_rules('nombre', 'nombre', 'required|xss_clean');
            $this->form_validation->set_rules('finicio', 'finicio', 'required|xss_clean');
            $this->form_validation->set_rules('ffin', 'ffin', 'required|xss_clean');
            $this->form_validation->set_rules('url', 'url', 'xss_clean');

                if ($this->form_validation->run() == FALSE){

                    $data['view'] = 'admin/test/calendar/calendar_widget';

                }else{

                    $result = $this->calendario_model->insert_event($datos);

                    if($result){
                    	$this->session->set_flashdata('success', 'Se ha insertado correctamente');
                    }else{
                    	$this->session->set_flashdata('error', 'No se ha podido insertar');
                    }

                    redirect(site_url('admin/calendario'));
            	}


		}

		$this->load->view('admin/_includes/template', $data);		

	}

}

/* End of file calendario.php */
/* Location: ./application/controllers/dashboard/calendario.php */
