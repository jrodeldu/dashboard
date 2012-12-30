<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyectos_model extends MY_Model {

    //Variables
    protected $table = 'proyectos';

    /**
    * Esta variable contendrá el id user del propietario
    *
    * @var string
    */
    protected $id_user = NULL;

    /**
    * Esta variable contendrá el id del proyecto
    *
    * @var string
    */
    protected $id = NULL;


    public function __construct() {
        parent::__construct();

        //$this->load->model('login_model');
        $this->load->model('log_model');
    }

    //Obtener proyecto
    public function get_proyecto($id){

    $query = $this->db->select('proyectos.id, username, id_user, proyectos.nombre, descripcion, destinatarios')
                      ->from('proyectos')
                      ->join('users', 'users.id = proyectos.id_user')
                      ->where('proyectos.id', $id)
                      ->get();

    return $query->result();

    }

    //Crear proyecto
    function create($destinatarios){

        $datos = array('id_user' => $this->session->userdata('id'),
                       'nombre' => $this->input->post('proyecto', TRUE),
                       'descripcion' => $this->input->post('descripcion', TRUE),
                       'destinatarios' => $destinatarios);

        if($this->db->insert($this->table, $datos)){

        $id = $this->db->insert_id();

        $this->log_model->insert_log($this->table,$id,'add');

            return $id;

        }else{

            return FALSE;

        }

    }

    //Update proyecto
    function update($id, $destinatarios){

        $datos = array('id_user' => $this->session->userdata('id'),
                       'nombre' => $this->input->post('proyecto', TRUE),
                       'descripcion' => $this->input->post('descripcion', TRUE),
                       'destinatarios' => $destinatarios,
                       'updated_at' => date("Y-m-d H:i:s"));

        $this->db->where('id', $id);

        if($this->db->update($this->table, $datos)){

             $this->log_model->insert_log($this->table, $id, 'update');

            return TRUE;

        }else{

            return FALSE;

        }

    }


    //correo
    function email($datos,$destinatarios, $tipo){

        $config = Array(
                        'mailtype'  => 'html',
                        'charset'   => 'UTF-8'
                );

        $this->load->library('email', $config);

        $this->email->from('it7.web@gmail.com', 'it7 Soporte');
        $this->email->subject('Nuevo ' . $tipo .  '(' . $datos['proyecto'] . ')' );


        $msg = '<p><img src="http://www.it7.info/images/logo.png"></p>';
        $msg .= '<p>Nombre: ' . $datos['proyecto'] . '<p>';
        $msg .= '<p> Descripcion: </p><p>' . $datos['descripcion'] . '</p>';
        $msg .= '<p> Más información <a href="http://www.it7.info/admin">aquí</a></p>';

        $this->email->message($msg);
        $this->email->set_newline("\r\n");
        $this->email->to($destinatarios);

        if($this->email->send()){
            return TRUE;
        }else{
            return FALSE;
        }

    }

}

/* End of file proyectos_model.php */
/* Location: ./application/models/proyectos_model.php */
