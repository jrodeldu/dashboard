<?php
class Log_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        //$this->load->model('login_model');
    }


    public function getLogList() {
        $this->db->select('id, id_user, tabla, id_tabla, accion, created_at');
        $this->db->order_by('created_at', 'asc');
        return $this->db->get('log')->result();
    }


    public function insert_log($tabla, $id_tabla, $accion) {

        $id = $this->session->userdata('id');

        $datos = array('id_user' => $id,
                       'tabla' => $tabla,
                       'id_tabla' => $id_tabla,
                       'accion' => $accion
                );

        if($this->insert($datos)){
            return TRUE;
        }else{
            return FALSE;
        }

    }

}