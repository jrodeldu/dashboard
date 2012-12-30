<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendario_model extends MY_Model {

	protected $finicio;

	public function update_event($id, $date_start, $date_end){

		$data = array(
			'finicio' => $date_start,
			'ffin' => $date_end
		);

		// Función update MY_Model.
		$this->update($id, $data);

		// Comprobamos si hubo fila afectada por el cambio.
        $return = $this->db->affected_rows() == 1;

        if ($return)
            return TRUE;
        else
            return FALSE;

	}

	public function insert_event($datos){

		$data = array('nombre' => $datos['nombre'],
					  'finicio' => $this->convert_date($datos['finicio']),
					  'ffin' => $this->convert_date($datos['ffin']),
					  'url' => prep_url($datos['url']));

		$return = $this->insert($data);

		if($return){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function convert_date($date){

		$parts = explode('/',$date);
		$fecha = $parts[2] . '-' . $parts[1] . '-' . $parts[0];

		return $fecha;

	}

}

/* End of file calendario_model.php */
/* Location: ./application/models/calendario_model.php */
