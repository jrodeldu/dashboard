<?php
class Graficas_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }


    public function getTarta(){

      $mujeres = $this->db->where('sexo', 'Mujer')
                          ->count_all_results('alumnos');

      $hombres = $this->db->where('sexo', 'Hombre')
                          ->count_all_results('alumnos');

      $datos = array(
                      'type' => 'pie',
                      'name' => 'Sexo',
                      'data' => array(
                                      array('Hombre', $hombres),
                                      array('Mujer', $mujeres),
                                      )
                    );

      return $datos;

    }

    public function getBarra(){

      $alumnos = $this->db->select('COUNT(alumnos.id) as id, denominacion')
              ->join('alumno_matricula', 'alumno_matricula.idalumno = alumnos.id')
              ->join('matriculas', 'matriculas.codigomatricula = alumno_matricula.codigomatricula')
              ->join('materias', 'materias.id = matriculas.idmateria')
              ->distinct()
              ->where('materias.edicion = 21')
              ->group_by('materias.id')
              //->group_by('materias.edicion')
              ->get('alumnos');

      return $alumnos->result();

      //hay que darse cuenta que para saber el total de alumnos de una edicion hay que poner el distint pero si
      //quieres saber la particicpacion total en cuanto a cursos, no.

    }

    public function getGantt(){

      /*$gantt = $this->db->select('proyecto as name, tipo as descs, f_inicio as froms, entradilla as label, f_fin as tos')
                        ->order_by('f_inicio', 'desc')
                        ->get('tareas');*/
      $gantt = $this->db->select('proyecto, tipo, f_inicio, entradilla, f_fin, id')
                        ->where('estado', 'Solucionado')
                        ->order_by('f_inicio', 'desc')
                        ->get('tareas');
      $gantt = $gantt->result();

      return $gantt;
      //echo json_encode(array_values($gantt));

      //print_r($gantt);

    }

}