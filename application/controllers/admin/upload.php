<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

    protected $path_img_upload_folder;
    protected $path_img_thumb_upload_folder;
    protected $path_url_img_upload_folder;
    protected $path_url_img_thumb_upload_folder;

    protected $delete_img_url;

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        //Set relative Path with CI Constant
        $this->setPath_img_upload_folder("assets/img/demo/");
        $this->setPath_img_thumb_upload_folder("assets/img/demo/thumbnails/");

        //Delete img url
        $this->setDelete_img_url(base_url() . 'admin/upload/deleteImage/');

        //Set url img with Base_url()
        $this->setPath_url_img_upload_folder(base_url() . "assets/img/demo/");
        $this->setPath_url_img_thumb_upload_folder(base_url() . "assets/img/demo/thumbnails/");
    }

    public function index() {
        $data['view'] = 'admin/test/upload/upload_widget';
        $this->load->view('admin/_includes/template', $data);
    }

    public function upload_img() {
        $name = $_FILES['userfile']['name'];
        $name = strtr($name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

        // remplacer les caracteres autres que lettres, chiffres et point par _

        $name = preg_replace('/([^.a-z0-9]+)/i', '_', $name);

        //Your upload directory, see CI user guide
        $config['upload_path'] = $this->getPath_img_upload_folder();

        $config['allowed_types'] = 'gif|jpg|png|JPG|GIF|PNG';
        $config['max_size'] = '1000';
        // Si queremos mantener el nombre original.
        //$config['file_name'] = $name;
        // Si no queremos mantenerlo lo encriptamos.
        $config['encrypt_name'] = TRUE;

        //Load the upload library
        $this->load->library('upload', $config);

        // Subida del archivo
        if ($this->do_upload()) {

            // Debemos recuperar los datos del archivo para asignar a $name el nombre encriptado.
            // Estas 2 líneas se comentarán si no se desea encriptar los nombres de los archivos.
            $image_data= $this->upload->data();
            $name = $image_data['file_name'];

            // If you want to resize
            $config['new_image'] = $this->getPath_img_thumb_upload_folder();
            $config['image_library'] = 'gd2';
            // Si hemos ecnriptado el nombre usaremos esta línea, si no la siguiente que está comentada.
            $config['source_image'] = $image_data['full_path'];
            //$config['source_image'] = $this->getPath_img_upload_folder() . $name;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 193;
            $config['height'] = 94;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $data = $this->upload->data();

            // Añadir a la BBDD
            $this->load->model('upload_model');
            $datos = array (
                        'image' => $name
                    );
            $this->upload_model->save($datos);
            // Fin añadir a la BBDD

            // Get info
            /**
             * stdClass is instead just a generic 'empty' class that's used when casting other types to objects.
             * I don't believe there's a concept of a base object in PHP (StackOverflow)
             * stdClass es una clase genérica vacía usada en PHP para convertir tipos en objetos
            */
            $info = new stdClass();

            $info->name = $name;
            $info->size = $data['file_size'];
            $info->type = $data['file_type'];
            $info->url = $this->getPath_url_img_upload_folder() . $name;
            $info->thumbnail_url = $this->getPath_url_img_thumb_upload_folder() . $name; //I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$name
            $info->delete_url = $this->getDelete_img_url() . $name;
            $info->delete_type = 'DELETE';

           //Return JSON data
           if (IS_AJAX) {   //this is why we put this in the constants to pass only json data
                echo json_encode(array($info));
                //this has to be the only the only data returned or you will get an error.
                //if you don't give this a json array it will give you a Empty file upload result error
                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
            } else {   // so that this will still work if javascript is not enabled
                $file_data['upload_data'] = $this->upload->data();
                echo json_encode(array($info));
            }
        }else {
            // the display_errors() function wraps error messages in <p> by default and these html chars don't parse in
            // default view on the forum so either set them to blank, or decide how you want them to display.  null is passed.
            $error = array('error' => $this->upload->display_errors('',''));

            echo json_encode(array($error));
        }

  }

    //Function for the upload : return true/false
    public function do_upload() {

        if (!$this->upload->do_upload()) {

            return false;
        } else {
            //$data = array('upload_data' => $this->upload->data());

            return true;
        }
     }

    public function deleteImage() {

        //Get the name in the url
        $file = $this->uri->segment(4);

        $success = unlink($this->getPath_img_upload_folder() . $file);
        $success_th = unlink($this->getPath_img_thumb_upload_folder() . $file);

        // Borrar de la BBDD
        $this->load->model('upload_model');
        $this->upload_model->delete($file);
        // Fin borrar de la BBDD

        //info to see if it is doing what it is supposed to
        $info = new stdClass();
        $info->sucess = $success;
        $info->path = $this->getPath_url_img_upload_folder() . $file;
        $info->file = is_file($this->getPath_img_upload_folder() . $file);
        if (IS_AJAX) {//I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else {     //here you will need to decide what you want to show for a successful delete
            var_dump($file);
        }
    }

    public function get_files() {

        $this->get_scan_files();
    }

    public function get_scan_files() {
        $file_name = isset($_REQUEST['file']) ? basename(stripslashes($_REQUEST['file'])) : null;
        if ($file_name) {
            $info = $this->get_file_object($file_name);
        } else {
            $info = $this->get_file_objects();
        }
        header('Content-type: application/json');
        echo json_encode($info);
    }

    protected function get_file_object($file_name) {
        $file_path = $this->getPath_img_upload_folder() . $file_name;

        // Desde la BBDD
        $this->load->model('upload_model');
        if ($this->upload_model->count_file($file_name) > 0) {
        //if (is_file($file_path) && $file_name[0] !== '.') {
            $file = new stdClass();
            $file->name = $file_name;
            $file->size = filesize($file_path);
            $file->url = $this->getPath_url_img_upload_folder() . rawurlencode($file->name);
            $file->thumbnail_url = $this->getPath_url_img_thumb_upload_folder() . rawurlencode($file->name);
            //File name in the url to delete
            $file->delete_url = $this->getDelete_img_url() . rawurlencode($file->name);
            $file->delete_type = 'DELETE';

            return $file;
        }
        return null;
    }

    protected function get_file_objects() {
        /*
        return array_values(array_filter(array_map(
             array($this, 'get_file_object'), scandir($this->getPath_img_upload_folder())
                   )));
        */

        $this->load->model('upload_model');
        $files = $this->upload_model->get_filesnames();
        $array_files = array();
        foreach($files as $file){
            $array_files[] = $file->image;
        }
        // arrayfilter: iteramos con cada elemento pasado en el array array_files y lo mandamos a get_file_object
        return array_values(array_filter(array_map(array($this, 'get_file_object'), $array_files)));
    }

    public function getPath_img_upload_folder() {
        return $this->path_img_upload_folder;
    }

    public function setPath_img_upload_folder($path_img_upload_folder) {
        $this->path_img_upload_folder = $path_img_upload_folder;
    }

    public function getPath_img_thumb_upload_folder() {
        return $this->path_img_thumb_upload_folder;
    }

    public function setPath_img_thumb_upload_folder($path_img_thumb_upload_folder) {
        $this->path_img_thumb_upload_folder = $path_img_thumb_upload_folder;
    }

    public function getPath_url_img_upload_folder() {
        return $this->path_url_img_upload_folder;
    }

    public function setPath_url_img_upload_folder($path_url_img_upload_folder) {
        $this->path_url_img_upload_folder = $path_url_img_upload_folder;
    }

    public function getPath_url_img_thumb_upload_folder() {
        return $this->path_url_img_thumb_upload_folder;
    }

    public function setPath_url_img_thumb_upload_folder($path_url_img_thumb_upload_folder) {
        $this->path_url_img_thumb_upload_folder = $path_url_img_thumb_upload_folder;
    }

    public function getDelete_img_url() {
        return $this->delete_img_url;
    }

    public function setDelete_img_url($delete_img_url) {
        $this->delete_img_url = $delete_img_url;
    }

}

/* End of file imagenes.php */
/* Location: ./application/controllers/dashboard/imagenes.php */
