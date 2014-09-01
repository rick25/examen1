<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class am_alumnos_controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('administrador/usuarios_crud_m','modelo');
    }
    
    public function index($accion='',$id=0){
        if ( $accion == 'ins' ) {
            $datos['titulo'] = 'Agregar Usuario';
            $datos['accion'] = 'Agregar nuevo registro..';
            $this->load->view('/administrador/a_alumnos_v', $datos);
        }else{
            $datos['titulo'] = 'Editar Usuario';
            $datos['accion']  = 'Editar registro existente..';
            $datos['usuario'] = $this->modelo->get_datos_usuario($id);
            $datos['secciones'] = $this->modelo->get_secciones();
            $this->load->view('/administrador/m_alumnos_v', $datos);
        }

        // cargamos  la interfaz
    }
    public function multi()
    {
        //comprobamos si es una petición ajax
        if( $this->input->is_ajax_request() )
        {
            $this->form_validation->set_rules('dni', 'DNI', 'trim|min_length[8]|required|max_length[8]|xss_clean');
            $this->form_validation->set_rules('nombre', 'Nombre', 'trim|min_length[4]|required|max_length[20]|xss_clean');
            $this->form_validation->set_rules('password', 'Contraseña', 'trim|min_length[4]|required|max_length[80]|xss_clean');
            $this->form_validation->set_rules('apellido1', 'Apellido paterno', 'trim|min_length[4]|required|max_length[20]|xss_clean');
            $this->form_validation->set_rules('apellido2', 'Apellido materno', 'trim|min_length[4]|required|max_length[20]|xss_clean');
            $this->form_validation->set_rules('sexo', 'Sexo', 'trim|min_length[1]|required|max_length[1]|xss_clean');       //SEXO
            $this->form_validation->set_rules('grado', 'Grado', 'trim|min_length[1]|required|max_length[1]|xss_clean');     //GRADO
            $this->form_validation->set_rules('seccion', 'Seccion', 'trim|min_length[1]|required|max_length[1]|xss_clean'); //SECCION

            $this->form_validation->set_message('required','El campo %s es obligatorio');
            $this->form_validation->set_message('max_length', 'El %s no puede tener más de %s carácteres');
            $this->form_validation->set_message('min_length', 'El %s no puede tener menos de %s carácteres');
 
            if($this->form_validation->run() == FALSE)      //SI NO PASA LA VALIDACION DE CODEIGNITER
            {
 
                //de esta forma devolvemos los errores de formularios
                //con ajax desde codeigniter, aunque con php es lo mismo
                $errors = array(
                    'dni'       => form_error('dni'),
                    'nombre'    => form_error('nombre'),
                    'password'  => form_error('password'),
                    'apellido1' => form_error('apellido1'),
                    'apellido2' => form_error('apellido2'),
                    'sexo'      => form_error('sexo'),
                    'grado'     => form_error('grado'),
                    'seccion'   => form_error('seccion'),
                    'respuesta' => 'error'
                );
                //y lo devolvemos así para parsearlo con JSON.parse
                echo json_encode($errors);
 
                return FALSE;
 
            }else{                                          //SI PASA LA VALIDACION DE CODEIGNITER
                $dni       = $this->input->post('dni');
                $nombre    = $this->input->post('nombre');
                $password  = $this->input->post('password');
                $apellido1 = $this->input->post('apellido1');
                $apellido2 = $this->input->post('apellido2');
                $sexo      = $this->input->post('sexo');
                $grado     = $this->input->post('grado');
                $seccion   = $this->input->post('seccion');
                //si estamos editando
                if( $this->input->post('id') )
                {
 
                    $id = $this->input->post('id');
                    //$this->crud_model->edit_user($id,$nombre,$apellido1,$apellido2);
                    $this->modelo->edit_user($id,$dni,$nombre,$password,$apellido1,$apellido2,$sexo,$grado,$seccion);
 
                //si estamos agregando un usuario
                }elseif( $this->input->post('dni') ){
                    $valor = $this->modelo->new_user($dni,$nombre,$password,$apellido1,$apellido2,$sexo,$grado,$seccion);
                }
                
                //en cualquier caso damos ok porque todo ha salido bien
                //habría que hacer la comprobación de la respuesta del modelo
 
                $response = array(
                    'respuesta'    =>    'ok'
                );
                
                echo json_encode($response);
 
            }
 
        }
    }
}