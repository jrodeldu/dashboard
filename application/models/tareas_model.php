<?php
class Tareas_model extends My_Model {

    public function __construct() {
        parent::__construct();

        $this->load->model('log_model');
    }


    /**
     * Recogemos las tareas ordenadas por fecha.
     */
    public function getTareasList() {
        $this->db->select('id, proyecto, entradilla, f_inicio, f_fin, tipo, estado');
        $this->db->order_by('f_inicio', 'asc');
        return $this->db->get('tareas')->result();
    }


    /**
     * Inserción de la nueva tarea.
     */
    public function add($datos) {

        $datos['f_inicio'] = date('Y-m-d H:i:s');

        if($this->input->post('estado') == 'Solucionado'){
            $datos['f_fin'] = date('Y-m-d H:i:s');
        }else{
            $datos['f_fin'] = NULL;
        }

        if($id = $this->insert($datos)){
          // insertamos log
          $this->log_model->insert_log('tareas',$id,'add');
          return $id;
        }else{
            return FALSE;
        }

    }

    /**
     * Envío de email con información de la tarea.
     *
     * @param $datos: array con los datos a insertar en el mail
     * @param $id: id de acceso a la vista show (ficha) de la tarea.
     * @param $destinatarios: receptores del email.
     *
     * @return resultado del envío.
     */
    public function email($datos, $id, $destinatarios){

        /*
        $this->load->library('encrypt');

        $password = $this->login_model->get_emailpass('it7.web@gmail.com');
        $encryptedPass = $password[0]->emailpass;
        $password = $this->encrypt->decode($encryptedPass);

        $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_port' => 465,
                        'smtp_user' => 'it7.web@gmail.com',
                        'smtp_pass' => $password,
                        'mailtype'  => 'html',
                        'charset'   => 'UTF-8'
                        );
        */
        $config = Array(
                        'mailtype'  => 'html',
                        'charset'   => 'UTF-8'
                        );

        $this->load->library('email', $config);

        $this->email->from('it7.web@gmail.com', 'it7 Soporte');

        if($datos['estado'] == 'Solucionado'){
            $this->email->subject('Incidencia [Resulta] en ' . $datos['proyecto']);
        }else{

            $this->email->subject('Incidencia en ' . $datos['proyecto']);

        }

        $msg = '<p><img src="http://www.it7.info/images/logo.png"></p>';
        $msg .= '<p>Incidendia en ' . $datos['proyecto'] . '<p>';
        $msg .= '<p> Descripcion: </p><p>' . $datos['descripcion'] . '</p>';
        $msg .= '<p> Más información <a href="http://www.it7.info/admin/tareas/show/' . $id . '">aquí</a></p>';

        $this->email->message($msg);
        $this->email->set_newline("\r\n");

        $this->email->to($destinatarios);

        if($this->email->send()){
            return TRUE;
        }else{
            return FALSE;
        }

    }

    public function edit($id, $datos){

        if($this->input->post('estado') == 'Solucionado'){
            $datos['f_fin'] = date('Y-m-d H:i:s');
        }else{
            $datos['f_fin'] = NULL;
        }

        // Actualizamos el historial insertando el estado previo del registro que vamos a actualizar.
        if($this->historial($id,'update')){

          // Una vez insertado el historial actualizamos.
          if($this->update($id, $datos)){
              // Insertamos log.
              $this->log_model->insert_log('tareas', $id, 'update');
              return TRUE;
          }else{
              return FALSE;
          }

        }else{
            return FALSE;
        }
    }


    /**
     * Eliminación de la tarea por id.
     * Se comprueba que la tarea no tenga el estado de solucionado.
     */
    public function drop($id){

        $where = array('id' => $id, 'estado' => 'Solucionado');

        // Buscamos que la tarea exista y que su estado no sea 'solucionado'.
        if(count($this->tareas_model->get($where)) == 0){

            if($this->historial($id,'delete') == TRUE){
              // Una vez guardado el registro histórico borramos.
              if($this->db->delete('tareas', array('id' => $id))){
                  // Insertamos en el log.
                  $this->log_model->insert_log('tareas', $id, 'delete');
                  return TRUE;
              }else{
                  return FALSE;
              }//fin del if del copiado

            }

        }else{
            return FALSE;
        }

    }


    /**
     * Recogemos datos originales para guardar en tabla histórica
     */
    public function historial($id, $accion){

        $tarea = $this->get($id);

        $datos = array(
                      'accion' => $accion,
                      'id_tabla' => $tarea->id,
                      'proyecto' => $tarea->proyecto,
                      'entradilla' => $tarea->entradilla,
                      'descripcion' => $tarea->descripcion,
                      'solucion' => $tarea->solucion,
                      'prioridad' => $tarea->prioridad,
                      'tipo' => $tarea->tipo,
                      'estado' => $tarea->estado,
                      'destinatarios' => $tarea->destinatarios,
                      'f_fin' => $tarea->f_fin,
                      'f_inicio' => $tarea->f_inicio,
                      'horas' => $tarea->horas,
                      'id_user' => $tarea->id_user
                   );

        if($this->db->insert('h_tareas', $datos)){
            return TRUE;
        }else{
            return FALSE;
        }
    }


    /**
     * Cargar widget últimas tareas en el main.
     */
    public function tareas_t($where, $limit){

        $this->db->select('id, proyecto, entradilla, f_inicio, f_fin, tipo, estado');

        if(!empty($where)){
          $this->db->where($where);
        }
        if(!empty($limit)){
          $this->db->limit($limit);
        }

        $this->db->order_by('f_inicio', 'DESC');
        return $this->db->get('tareas')->result();

    }

}