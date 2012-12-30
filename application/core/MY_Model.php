<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Model extends CI_Model {

	/**
	 * Nombre de la tabala. Detectado automáticamente
	 * en el constructor quitadon el sufijo '_model'
	 */
	protected $_table;

    /**
	* Columna primaria de las tablas.
	* Usado en las funciones get(), update() y delete().
	*/
    protected $primary_key = 'id';


    /**
     * Constructor.
     *
     * Se establece el valor de la variable $_table.
     *
     * Ej: si se llama a una función de MY_Model desde Tareas_model el valor de la tabla será 'tareas'.
     *
     */
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		if ( ! $this->_table ){
			// El controlador llama a su modelo particular que a su vez hereda de My_Model. Éste recibe el
			// nombre del modelo que le llama, por ejemplo actualidad_model y el resultado será
			// que la tabla a tratar es actualidad.
			$this->_table = strtolower(str_replace('_model', '', get_class($this)));
		}

	}


	/**
	 * Buscamos un único registro. Requiere siempre parámetro!!
	 *
	 * @param $args contiene los parámetros pasados a la función desde la llamada.
	 * - Si desde la llamada se pasa un número busca por id.
	 * - Si se pasa array busca en where pasando los valores de dicho Array.
	 *
	 * @return registro encontrado.
	 */
	public function get(){

		$args = func_get_args();

		if (count($args) > 1 || is_array($args[0])){
			$this->db->where($args[0]);
		}else{
			$this->db->where($this->primary_key, $args[0]);
		}

		return $this->db->get($this->_table)->row();
	}


	/**
	 * Buscamos varios registros que cumplan con la condición.
	 *
	 * @param $args contiene un array creado con los parámetros pasados a la función desde la llamada.
	 * - Si desde la llamada se pasa un número busca por id.
	 * - Si se pasa array busca en where pasando los valores de dicho Array.
	 * - Si no se pasa nada, se buscan todos los registros.
	 *
	 * @return registros encontrados.
	 */
	public function get_all(){

		$args = func_get_args();

		if($args){
			if (count($args) > 1 || is_array($args[0])){
				$this->db->where($args[0]);
			}else{
				$this->db->where($this->primary_key, $args[0]);
			}
		}

		return $this->db->get($this->_table)->result();
	}


	/**
	 * Insertamos un nuevo registro en la BBDD
	 *
	 * @param $data: array con valores a insertar en la tabla.
	 *
	 * @return En caso de inserción correcta devolvemos el nuevo id. En caso de fallo se devuelve FALSE.
	 */
	public function insert($data){

		$data['created_at'] = $data['updated_at'] = date('Y-m-d H:i:s');

		$succes = $this->db->insert($this->_table, $data);

		if ($succes) {
			return $this->db->insert_id();
		}else{
			return FALSE;
		}
	}


	/**
	 * Actualización de datos en la tabla.
	 *
	 * @param $args contiene los parámetros pasados a la función desde la llamada.
	 * Si es un array se hace el where pasando el array. Si no es un array, se busca por id.
	 *
	 * - Si se pasa un entero y un array el valor entero será el id a actualizar del 'else' y el array los datos nuevos.
	 * - Si se pasan 2 arrays, el primero se usará en el where del 'if' y el segundo serán los datos a actualizar.
	 *
	 * @return actualización.
	 */
	public function update(){

		$args = func_get_args();
		$args[1]['updated_at'] = date('Y-m-d H:i:s');

		//print_r($args);

		if (is_array($args[0])) {
			$this->db->where($args[0]);
		}else{
			$this->db->where($this->primary_key, $args[0]);
		}

		return $this->db->update($this->_table, $args[1]);
	}


	/**
	 * Eliminación del registro.
	 *
	 * @param $args contiene el id a borrar o en caso de ser un array contendrá los campos
	 * de los que el where debe fijarse.
	 *
	 * @return resultado del delete.
	 */
	public function delete(){

		$args = func_get_args();

		if (count($args) > 1 || is_array($args[0])) {
			$this->db->where($args[0]);
		}else{
			$this->db->where($this->primary_key, $args[0]);
		}

		return $this->db->delete($this->_table);
	}


	/**
	 * Establece SELECT para la consulta
	 *
	 * @param $select: string con los campos separados por ','
	 *
	 * @return objeto $this para anidar la consulta
	 */
	public function select($select){

		$this->db->select($select);

		return $this;
	}


	/**
	 * Establece WHERE para la consulta
	 *
	 * @param $args contiene los parámetros pasados a la función desde la llamada.
	 * Si es un array se hace el where pasando el array. Si no es un array, se busca por id.
	 *
	 * - Si se pasa un entero será el id a buscar del 'else'.
	 * - Si se pasan 1 array, se usará en el where del 'if'.
	 *
	 * @return objeto $this para anidar la consulta
	 */
	public function where(){

		$args = func_get_args();

		if (is_array($args[0])) {
			$this->db->where($args[0]);
		}else{
			$this->db->where($this->primary_key, $args[0]);
		}

		return $this;

	}


	/**
	 * Establece JOIN para la consulta
	 *
	 * @param $table: tabla a la que hacer join.
	 * @param $join: string de la unión.
	 *
	 * Ej: $this->db->join('comentarios', 'comentarios.id = blogs.id');
	 *
	 * @return objeto $this para anidar la consulta
	 */
	public function join(){

		$this->db->join($table, $join);

		return $this;
	}


	/**
	 * Establece ORDER_BY para la consulta
	 *
	 * @param $key: campo a ordenar.
	 * @param $order: sentido (asc/desc/random).
	 *
	 * @return objeto $this para anidar la consulta
	 */
	public function order_by($key, $order){

		$this->db->order_by($key, $order);

		return $this;
	}

}

/* End of file My_Model.php */
/* Location: ./application/core/My_Model.php */
