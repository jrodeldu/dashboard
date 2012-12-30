<?php
class Tarea_comentarios_model extends MY_Model {

    public function __construct() {
        parent::__construct();

        $this->load->model('log_model');
    }


    public function getComentariosList($id) {

        $this->db->select('tarea_comentarios.id, users.username, tarea_comentarios.created_at, tarea_comentarios.updated_at, tarea_comentarios.comentario, avatar');
        $this->db->join('users', 'users.id = tarea_comentarios.id_user');
        $this->db->where('id_tarea', $id);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('tarea_comentarios')->result();
    }


    public function add($id_tabla) {

        $id_user = $this->session->userdata('id');
        $datos = array('comentario' => $this->input->post('comentario_tarea', TRUE),
                       'id_user' => $id_user,
                       'id_tarea' => $id_tabla,
                        );

        if($id = $this->insert($datos)){
            // insertamos log.
            $this->log_model->insert_log('tareas',$id_tabla,'Comentario añadido');
            return TRUE;
        }else{
            return FALSE;
        }

    }


    public function edit($id, $id_tabla){

        $datos = array('comentario' => $this->input->post('comentario_edit', TRUE));

        if($this->update($id, $datos)){
            // insertamos log.
            $this->log_model->insert_log('tareas', $id_tabla, 'Comentario editado');
            return TRUE;
        }else{
            return FALSE;
        }

    }


    public function delete_comment($id, $id_tabla){

        $result = $this->db->where('id', $id)
                           ->count_all_results('tarea_comentarios');

        if($result != 0){
            if($this->delete($id)){
                // insertamos
                $this->log_model->insert_log('tareas', $id_tabla, 'Comentario borrado');
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }


}