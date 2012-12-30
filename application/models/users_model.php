<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model {

    protected $table = 'users';
    protected $table_temp = 'temp_users';
    /**
    * Esta variable contendrá la versión hash de la contraseña del usuario + el salt generado.
    *
    * @var string
    */
    protected $password = NULL;

    /**
    * Esta variable contendrá el valor de 'salt' utilizado para agregarlo al hash de la contraseña.
    *
    * @var string
    */
    protected $password_salt = NULL;

    /**
    * Esta variable contendrá el username.
    *
    * @var string
    */
    protected $username = NULL;

    /**
    * Esta variable contendrá el id del user.
    *
    * @var string
    */
    protected $id = NULL;

    /**
    * Esta variable dirá si el user es admin o no.
    *
    * @var int
    */
    protected $is_admin = 0;

    /**
    * Esta variable contendrá el mensaje de error.
    *
    * @var string
    */
    protected $error;

    /**
    * Esta variable contendrá el mensaje de error.
    *
    * @var string
    */
    protected $message;


    public function __construct()
    {
        parent::__construct();
        // Configuración
        $this->load->config('users_auth', TRUE);
        // Mensajes
        // Cargamos mensaje del archivo de leguaje users_auth_lang.php
        $this->lang->load('users_auth');
    }

    //

    /**
     * Si el user no está logueado se le avisa de que su sesión no existe.
     */
    function is_logged_in(){
        $is_logged_in = $this->session->userdata('is_logged_in');
        if ( ! isset($is_logged_in) || $is_logged_in != TRUE){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    /**
     * Login de usuario y creación de session
     *
     * Se entrará aquí una vez superado el callback validate_credentials del controlador.
     *
     */
    function login($identity){
        // Una vez esté validado y comprobado el login correcto se crea la sesión del usuario.
        // Recuperamos su id y username que es el que se mostrará de cara al público.
        $result = $this->get_data('id,username,is_admin,avatar', $this->config->item('identity', 'users_auth'), $identity, $this->table);
        if($result){

            $this->username = $result['username'];
            $this->id = $result['id'];
            $this->is_admin = $result['is_admin'];
            $this->avatar = $result['avatar'];

            // Establecemos las variables de session.
            $userdata = array(
                        'id' => $this->id,
                        'username' => $this->username,
                        'email' => $identity,
                        'avatar' => $this->avatar,
                        'is_logged_in' => TRUE,
                        'is_admin' => $this->is_admin
            );

            $this->session->set_userdata( $userdata );
            return TRUE;
        }else{
            return FALSE;
        }

    }

    /**
     * Callback de comprobación de credenciales en el login
     *
     * @param $identity: es el campo identidad.
     * @param $user_pass: la contraseña proporcionada por el user enviada desde el controller
     * @param $only_identity: Si sólo queremos comprobar que el la identidad(email por ej) del user existe será TRUE.
     * Será TRUE en el caso de querer recuperar la contraseña por olvido
     * Será FALSE por defecto y mandada desde el controller.
     * Será así cuando el user se vaya a loguear y recogerá también el password introducido.
     */
    function validate_credentials($identity, $user_pass){
        // Comprobamos que el email de usuario introducido existe en la BBDD
        if ($this->get_data('email', 'email', $identity, $this->table)){
            // Una vez comprobado que existe 1 usuario con ese email comprobamos si el user puede loguearse con su username y userpass.
            if ($this->check_password($user_pass, $identity)){
                return TRUE;
            }else{
                // En caso de no ser correcto se recarga el formulario con el mensaje de datos incorrectos.
                $this->set_error($this->lang->line('login_unsuccessful'));
                return FALSE;
            }

        }else{

            // Comprobamos si existe en temporal.
            $result = $this->get_data('username', $this->config->item('identity', 'users_auth'), $identity, $this->table_temp);

            if($result){
                // El usuario está no activo
                $this->set_error($this->lang->line('login_unsuccessful_not_active'));
            }else{
                // Si no existe un usuario con ese email se muestra mensaje
                $this->set_error($this->lang->line('login_unsuccessful_user'));
            }

            return FALSE;
        }
    }

    /**
     * Comprobamos que la contraseña es correcta
     *
     * Esta función será llamada tanto en el login como en caso de querer cambiar contraseña.
     * En caso de login:
     * @param  string $pass_input: Password proporcionada por el user al loguearse.
     * @param  string $identity_input: Email proporcionado por el user al loguearse
     *
     * @return boolean
     */
    function check_password($pass_input, $identity_input)
    {

        // Recogemos el salt del usuario en la BBDD
        $result = $this->get_data('userpass_salt', 'email', $identity_input, $this->table);
        $this->password_salt = $result['userpass_salt'];
        //echo $this->password_salt.'<br/>';

        // Recogemos el password del usuario en la BBDD, que contiene sha1(password+salt)
        $result = $this->get_data('userpass', 'email', $identity_input, $this->table);
        $this->password = $result['userpass'];
        //echo $this->password.'<br/>';

        // Creamos un hash con el password introducido por el user y el salt que le corresponde en la BBDD
        $hashed = sha1($pass_input . $this->password_salt);
        //echo $hashed.'<br/>';

        // Comparamos el hash hecho con los datos del user con el de la BBDD y devolvemos verdadero/falso
        if($hashed === $this->password){
            return TRUE;
        }else{
            $this->set_error($this->lang->line('check_password_change_unsuccessful'));
            return FALSE;
        }
    }

    /**
     *  Crear el registro temporal del usuario.
     */
    function signup_temp($input_data){
        // Se establece la contraseña del usuario:
        // Se crea un salt aleatorio y se concatena el pass elegido con dicho salt y se pasa por sha1.
        $this->setPassword($input_data['userpass']);
        $input_data['userpass'] = $this->password;
        $input_data['userpass_salt'] = $this->password_salt;

        // Si la validación es correcta se registrará al usuario en la tabla temporal de usuarios.
        // generar random key para confirmación de registro por email.
        $key = sha1(uniqid());
        // Agregamos el key al array de datos a insertar en la BBDD.
        $input_data['key'] = $key;

        // Configuración del email sacada del archivo config de users_auth.php
        $config_email = $this->config->item('config_email', 'users_auth');
        $this->load->library('email', $config_email);

        // Email: desde y titulo email.
        $this->email->from($this->config->item('admin_email', 'users_auth'), $this->config->item('site_title', 'users_auth'));
        $this->email->to($input_data['email']);

        $this->email->subject($this->lang->line('email_activation_subject'));
        // $message debería ser cargado a través de una vista.
        $message = '<p>¡Gracias por registrarte!</p>';
        $message .= "<a href='" . base_url() . "admin/users/register_user/$key'>Haz click aquí</a> para confirmar tu cuenta";
        $this->email->message($message);
        // Fin de la preparación del Email.

        // Añadirlo a la tabla temporal temp_users
        if ($this->add_temp_user($input_data)) {
            // Una vez insertado en temp_users enviar email al user.
            if ($this->email->send()) {
                // Cambiar echo por vista.
                $message = $this->lang->line('activation_email_successful');
                $this->set_message($message);
                //echo $this->email->print_debugger();
                return TRUE;
            }else{
                // Si no se manda el mail...
                // Cambiar echo por vista.
                $error = $this->lang->line('activation_email_unsuccessful');
                $this->set_error($error);
                return FALSE;
            }
        }else{
            // Si no se añade el usuario a la tabla temporal...
            // Cambiar echo por vista.
            $error = $this->lang->line('account_creation_unsuccessful');
            $this->set_error($error);
            return FALSE;
        }
    }

    function register_user($key){
        if ($this->is_key_valid($key)) {
            // Si es válida la key volcamos al usuario a la tabla real.
            if($this->add_user($key)){
                // Cuenta activada
                $message= $this->lang->line('activate_successful');
                $this->set_message($message);
                return TRUE;
                //$this->load->view('_includes/template', $data);
            }else{
                // No se ha podido activar la cuenta...
                $error = $this->lang->line('activate_unsuccessful');
                $this->set_error($error);
                return FALSE;
                //$this->load->view('_includes/template', $data);
            }
        }else{
            // Key incorrecta...
            $error = $this->lang->line('activate_unsuccessful_key');
            //$this->load->view('_includes/template', $data);
            $this->set_error($error);
            return FALSE;
        }
    }

    /**
     *  Función de cambio de contraseña
     *
     *  Dentro de las reglas de validación se llamará a un callback
     *  para comprobar que la contraseña antigua coincide realmente con la del user.
     */
    public function edit_password($identity, $new_password){
        // ACTUALIZACIÓN EN LA BBDD
        // Se establece la contraseña del usuario:
        // Se crea un salt aleatorio y se concatena el pass elegido con dicho salt y se pasa por sha1.
        $this->setPassword($new_password);

        // Realizamos el cambio y guardamos el estado devuelto.
        $change = $this->change_password($identity, $this->password, $this->password_salt);

        if($change){
            // Cambio efectuado correctamente.
            return TRUE;
        }else{
            return FALSE;
        }
    }

    //

    /**
     * Se cuenta para comprobar que existe un registro con los datos buscados.
     *
     * @param $select: campo que necesitamos.
     * @param $field_where: campo del where.
     * @param $where: valor que debe tener el campo $field_where.
     * @param $table: tabla en la que se va a buscar.
     */
    public function count_data($select, $field_where, $where, $table){
        $this->db->where($field_where, $where);
        $this->db->select($select);

        $query = $this->db->get($table);

        if ($query->num_rows() == 1) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * Añade el usuario a la tabla temporal.
     *
     * @param $key: hash que se envía con el email de confirmación.
     * @param $password/$password_salt: las variables de clase user.
     */
    public function add_temp_user($input_data){

        $query = $this->db->insert($this->table_temp, $input_data);
        if ($query) {
            return TRUE;
        }else{
            return FALSE;
        }

    }

    /**
    * Establecemos la contraseña del usuario
    *
    * @param string $password
    */
    function setPassword($password){
        $this->password_salt = $this->generateRandomSalt();
        $this->password = sha1($password . $this->password_salt);
    }

    /**
    * Generate un valor 'salt' aleatorio de 32 bytes de largo
    *
    * @return string
    */
    protected function generateRandomSalt()
    {
        //return openssl_random_pseudo_bytes(32);

        // Alternativa ya que no está operativo openssl en el server...
        return substr(sha1(uniqid(rand(), true)), 0, 32);
    }

    /**
     * Se busca el campo buscado según parámetros de búsqueda y tabala.
     *
     * @param $select: campo que necesitamos.
     * @param $field_where: campo del where.
     * @param $where: valor que debe tener el campo $field_where.
     * @param $table: tabla en la que se va a buscar.
     */
    public function get_data($select, $field_where, $where, $table){

        $this->db->where($field_where, $where);
        $this->db->select($select);

        $query = $this->db->get($table);

        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return FALSE;
        }
    }

    // Comprobamos que la key es válida.
    public function is_key_valid($key){
        $this->db->where('key', $key);
        $query = $this->db->get($this->table_temp);

        if($query->num_rows() == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * Se pasa al usuario de la tabla temporal a la de usuarios activos
     *
     * @param $key: clave pasada en el email con la que se identifica al usuario a confirmar.
     */
    public function add_user($key){
        $this->db->where('key', $key);
        $temp_user = $this->db->get($this->table_temp);

        if($temp_user){
            $row = $temp_user->row();
            // Una vez recogidos los valores del temp_user se vuelcan a la tabla users
            $data = array(
                'nombre' => $row->nombre,
                'apellidos' => $row->apellidos,
                'username' => $row->username,
                'userpass' => $row->userpass,
                'userpass_salt' => $row->userpass_salt,
                'email' => $row->email
            );

            $query_user = $this->db->insert('users', $data);
        }

        if ($query_user) {
            // Al volcarse a la tabla users se borra el registro en la tabla temp_users.
            $this->db->where('key', $key);
            $this->db->delete($this->table_temp);
            return TRUE;
        }else{
            return FALSE;
        }
    }

    // Listado de países para introducir en el perfil.
    public function get_countries(){
        $this->db->order_by('spanish_name', 'asc');
        $query = $this->db->get('country_t');

        return $query->result();
    }

    /**
     * Se busca el miembro buscado según parámetros de búsqueda y tabla.
     *
     * @param $field_where: campo del where.
     * @param $where: valor que debe tener el campo $field_where.
     * @param $table: tabla en la que se va a buscar.
     */
    public function get_member($field_where, $where, $table){
        $this->db->where($field_where, $where);
        $query = $this->db->get($table);

        //return $query->result();
        // Devolvemos el array asociativo.
        return $query->row_array();
    }

    public function change_password($identity, $password, $password_salt){
        $data = array (
            'userpass' => $password,
            'userpass_salt' => $password_salt
        );

        $this->db->where($this->config->item('identity', 'users_auth'), $identity);
        $this->db->update($this->table, $data);

        // Comprobamos si hubo fila afectada por el cambio.
        $return = $this->db->affected_rows() == 1;
        if ($return)
            return TRUE;
        else
            return FALSE;

    }

    /**
     * Actualización de los datos del usuario.
     */
    public function edit_profile($identity, $data){
        // prep_url() Añade "http://" a la dirección web si no se incluyó.
        $web = prep_url($this->input->post('web'));
        $datos = array (
                        'nombre' => $data['nombre'],
                        'apellidos' => $data['apellidos'],
                        'idpais' => $data['idpais'],
                        'ciudad' => $data['ciudad'],
                        'avatar' => $data['avatar'],
                        'web' => $web,
                        'info' => $data['info'],
                        'fnacimiento' => date('Y-m-d', strtotime(preg_replace('#/#', '-', $data['fnacimiento'])))
        );
        /*
        $datos = array (
                        'nombre' => $data['nombre'],
                        'apellidos' => $data['apellidos'],
                        'idpais' => ($data['idpais']) ? $data['idpais'] : -1,
                        'ciudad' => ($data['ciudad']) ? $data['ciudad'] : NULL,
                        'avatar' => ($data['avatar']) ? $data['avatar'] : NULL,
                        //'web' => $web,
                        'web' => ($data['web']) ? prep_url($data['web']) : NULL,
                        'info' => ($data['info']) ? $data['info'] : NULL,
                        'fnacimiento' => date('Y-m-d', strtotime(preg_replace('#/#', '-', $data['fnacimiento'])))
        );
        */
        /*
        print_r($datos);
        echo '<br/><br/>';
        $datos = $this->db->escape($datos);
        print_r($datos);
        die();
        print_r($datos);
        */
        $this->db->where($this->config->item('identity', 'users_auth'), $identity);
        $result = $this->db->update($this->table, $datos);
        //$this->db->affected_rows() == 1
        // Comprobamos si hubo fila afectada por el cambio.
        if ($result){
            $this->set_message($this->lang->line('update_successful'));
            return TRUE;
        }else{
            $this->set_error($this->lang->line('update_unsuccessful'));
            return FALSE;
        }
    }

    function set_error($error){
        $this->error = $error;
    }

    function get_error(){
        return $this->error;
    }

    function set_message($message){
        $this->message = $message;
    }

    function get_message(){
        return $this->message;
    }


    //Select de la imagen para después hacer el borrado
    public function select_img($id){
        
        $data = array('id' => $id,
                      'avatar <>' => 'avatar.png' );

        $return = $this->get($data);

        if($return){
            return $return;
        }else{
            return FALSE;
        }
    }


    //Insertado del nombre de la imagen del avatar
    public function update_img($id,$image_data){    
        $data = array('avatar' => $image_data);

        $return = $this->update($id,$data);

        if($return){
                return TRUE;
        }else{
                return FALSE;
        }
    }


}

/* End of file users_model.php */
/* Location: ./application/models/users_model.php */