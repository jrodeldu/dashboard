<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class Barcode extends MY_Controller {
       
   function __construct(){

        parent::__construct();

    }


    public function index()
    {
        $data['view'] = 'admin/test/barcode/show';
        $data['titulo'] = 'Barcode';
        $this->load->view('admin/_includes/template', $data);
    }

    public function codigo(){

        //Cargamos la librería del Zend, y cargamos el Barcode
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        /*
        El primer parámetro es el tipo de barcode, el segundo es el tipo y el tercero
        son los datos del barcode, en text va el código que según el tipo de barcode,
        puede ser números o números o letras.
        */
        Zend_Barcode::render('code128', 'image', array('text' =>  '000122333313323389', 'barHeight' => 80), array());

    } 
        
}        
