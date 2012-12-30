<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_model extends CI_Model {

	function save($data){
		$this->db->insert('images', $data);
	}

	// Habría que hacerlo con el ID, pero para las pruebas nos vale por ahora...
	function delete($file){
		$this->db->where('image', $file)
				->delete('images');
	}

	function count_file($file_name)
    {
        return $this->db->where('image', $file_name)
						->get('images')
						->num_rows();
    }

	public function get_filesnames()
	{
		$query = $this->db->select('image')
							->get('images');
		return $query->result();
	}

}

/* End of file upload_model.php */
/* Location: ./application/models/upload_model.php */
