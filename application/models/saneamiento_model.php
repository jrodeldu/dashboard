<?php
class Saneamiento_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    function add($image_data){

    	$data = array('nombre' => $image_data, );
    	if($this->insert($data)){
    		return TRUE;
    	}else{
    		return FALSE;
    	}
    }

}