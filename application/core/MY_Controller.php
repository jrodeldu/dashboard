<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

    public function __construct ()
    {
        parent::__construct();

        // Modelos necesarios

        // Cargamos mensaje del archivo de leguaje users_auth_lang.php
        $this->lang->load('users_auth');

        // Comprobamos que estámos en un controlador de la parte admin
        // y verificamos que estamos logueados
        if($this->uri->segment(1) == 'admin'){
            $this->_is_logged_in();
        }
    }

    // Funcion ADMIN
    // Función que comprueba que el user está logueado
    private function _is_logged_in ()
    {
        if ( !$this->session->userdata('is_logged_in') )
        {
            //redirect('admin/access');
            redirect('admin');
        }
    }

    // Función para quitar acentos y caracteres extraños
    protected function _remove_accent ($str)
    {
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
        $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');

        return str_replace($a, $b, $str);
    }

    // _create_url y _check_url son funciones que no crear urls amigables.
    // Posiblemente puedan ser sustituidas por la funcion CI built-in url_title()
    protected function _create_url ($string, $type)
    {
        $string = strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
        array('', '-', ''), $this->_remove_accent($string)));

        if ( !$this->_check_url($string, $type) ){
            return $string;
        }

        return $string.'-'.date('d-m-y');
    }

    protected function _check_url ($url, $db)
    {
        return $this->db->where('url', $url)
                        ->get($db)
                        ->num_rows();
    }

    // Función de subida de archivos.
    // Devolverá $image_data['file_name'] si se ha hecho la subida normal de la imagen y su thumb. False en caso de error
    protected function _subir_archivo($upload_path, $upload_path_thumbs, $marca = FALSE){

        //cargamos la libreria para el resize
        $this->load->library('image_lib');

        //empieza la subida del archivo
        $config = array(
                'upload_path' => 'assets/img/saneamiento/temporal',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size' => 2048*2,
                'max_width' => 1000,
                'max_height' => 1000,
                'remove_spaces' => true,
                'encrypt_name' => true
             );

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {

            $datos = array('error' => $this->upload->display_errors());
            return $datos;

        }else{

            $image_data = $this->upload->data();

            chmod('assets/img/saneamiento/temporal/' . $image_data['file_name'], 0777);

            if($marca == TRUE){
                //marca de agua de la imagen principal
                $config['source_image'] = 'assets/img/saneamiento/temporal/' . $image_data['file_name'];
                $config['wm_text'] = 'UGT Canarias';
                $config['wm_type'] = 'text';
                //$config['wm_font_path'] = './system/fonts/texb.ttf';
                $config['wm_font_size'] = '16';
                $config['wm_font_color'] = 'ffffff';
                $config['wm_vrt_alignment'] = 'bottom';
                $config['wm_hor_alignment'] = 'center';
                $config['wm_padding'] = '-15';

                $this->image_lib->initialize($config);

                $this->image_lib->watermark();
            }

            $config = array (
                 'source_image' => $image_data['full_path'],
                 'allowed_types' => 'gif|jpg|png|jpeg',
                 'new_image' => $upload_path_thumbs,
                 'maintain_ration' =>  false,
                 'width' => 40,
                 'height' => 40
                 );

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            $config = array (
                 'source_image' => $image_data['full_path'],
                 'allowed_types' => 'gif|jpg|png|jpeg',
                 'new_image' => $upload_path,
                 'maintain_ration' =>  true,
                 'width' => '100',
                 'height' => '100'
                 );

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            unlink('assets/img/saneamiento/temporal/' . $image_data['file_name']);

            $datos = array('nombre_img' => $image_data['file_name']);
            return $datos;

        }

    }

    // Función para borrar una imágen de la galería
    protected function _borrar_imagen($path, $path_thumbs){
        $result = unlink($path);
        if($result){
            $result = unlink($path_thumbs);
            if($result){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // Función de borrado en cascada de imágenes al seleccionar una galería para ser eliminada.
    /**
     * Parámetros:
     * - $campo_id: Campo de la condición WHERE
     * - $valor_campo_id: valor del $campo_id
     * - $tabla
     * - $images_path e $images_path_thumb (rutas de guardado para imagenes)
     */
    protected function _drop_all_images($campo_id, $valor_campo_id, $tabla, $images_path, $images_path_thumb){
        // Buscaremos en la tabla galería si hay una asignada a la noticia y se borrarán todas las imágenes
        $count = $this->galeria_model->count_files($campo_id, $valor_campo_id, $tabla);
        if($count > 0){
            $results = $this->galeria_model->get_files($campo_id, $valor_campo_id, $tabla);
            foreach($results as $row){
                $path = $images_path . $row->img;
                $pathThumbs = $images_path_thumb . $row->img;
                $result = unlink($path);
                if($result){
                    $result = unlink($pathThumbs);
                    if(!$result){
                        return false;
                    }
                }
            } // End Foreach
            return true;
        }else{
            return true;
        }
    }

    // Función universal para la paginación
    /**
     * Parámetros:
     * 1.- $base_url: Página base para el paginado Pej: base_url() . 'cursos/busqueda-completa';
     * 2.- $total_rows: Número de resultados total a mostar paginados.
     * 3.- $per_page: Resultados mostrados por página.
     * 4.- $uri_segment: parte de la url de donde saca el inicio de paginado.Pej: numero 20 -> 'cursos/busqueda-completa/(20)'
     */
    protected function _paginacion($base_url, $total_rows, $per_page, $uri_segment){
    // No implementada por complegidad.
    /*
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total_rows;

        $config['per_page'] = $per_page;
        $config['uri_segment'] = $uri_segment;
        $config['first_link'] = 'Primero';
        $config['last_link'] = 'Último';
        $config['num_links'] = 3;
        $config['next_link'] = '&gt; Siguiente';
        $config['prev_link'] = '&lt; Anterior';

        $this->pagination->initialize($config);

        return $config;
    */
    }

}

?>