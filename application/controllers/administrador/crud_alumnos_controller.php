<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class crud_alumnos_controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
      
        $this->load->model('administrador/usuarios_crud_m','modelo');
    }

    public function index(){
        
        // indicamos que usaremos el flexgrid
        // esto indicara q se incluya la libreria 
        // y el css del flexgrid solo cuando se necesite
        $datos['ShowFlexgrid'] = true;
        
        // cargamos  la interfaz
        $this->load->view('/administrador/crud_alumnos_v', $datos);
    }

    public function get_json(){

        // armamos las condiciones segun sea el caso .. ------------------------
        $query          = $this->input->post('query');
        $qtype          = $this->input->post('qtype');
        $letter_pressed = $this->input->post('letter_pressed');
        $page           = $this->input->post('page');
        $rp             = $this->input->post('rp');
        $sortname       = $this->input->post('sortname');
        $sortorder      = $this->input->post('sortorder');

        // imprimimos los datos en formato json
        echo $this->modelo->get_json( $query,$qtype,$letter_pressed,$page,$rp,$sortname,$sortorder );
    }   

     public function eliminar_registros(){
        
         //echo $this->modelo->eliminar_registros($items);
         echo $this->modelo->eliminar_registros($this->input->post('items'));
     }
     
     public function eliminar_todo(){
        
        echo $this->modelo->eliminar_todo();
     } 
}