<?php

class Principal extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('administrador/prueba2_model','grados');
    $this->load->model('administrador/evaluaciones_model','evaluaciones');
  }
  /**
   * Este es el controlador que maneja el inicio de la aplicacion
   * Despues de loguearse muestra la pagina de usuario o la de administrador
   * dependiendo de las credenciales
   */
  function index() {
    $data['mensaje']  = " vera algo mas escrito";
    // Obtengo algunos datos de la sesion del usuario
    $is_admin         = $this->session->userdata('isAdmin');
    $data['is_admin'] = $is_admin;
    $data['dni']      = $this->session->userdata('dni');
    $data['nombre']   = $this->session->userdata('nombre');
    $data['grado']    = $this->session->userdata('grado');
    $data['seccion']  = $this->session->userdata('seccion');
    $data['avatar']   = $this->session->userdata('avatar');
    $data['sexo']     = $this->session->userdata('sexo');

    if ( $is_admin ) {    //SI EL QUE SE LOGUEA ES EL ADMINISTRADOR
      $datos = array(
        'titulo' => 'ADMIN-PANEL', 
        'nombre' => $this->session->userdata('nombre'), 
        'avatar' => $this->session->userdata('avatar'), 
        'grados' => $this->grados->getAll_grados(), 
        'secciones' => array('1' => '','2' => array('A','B'), '3' => array('A','B'), '4' => array('A','B'), '5' => '')
        );
      $datos['secciones'] = array(
        '1' => ' ',
        '2' => array('A','B'),
        '3' => array('A','B'),
        '4' => array('A','B'),
        '5' => ' '
      );
      $datos['total_alumnas']  = array(
                '1' => 39, 
                '2' => array('A' => 25, 'B' => 31), 
                '3' => array('A' => 22, 'B' => 20), 
                '4' => array('A' => 23, 'B' => 23), 
                '5' => 41, 
      );
      /*
      $datos['total_alumnas_entregado'] = array(
        '1' => 15,
        '2' => array( 'A' => 10, 'B' => 17 ),
        '3' => array( 'A' => 17, 'B' => 10 ),
        '4' => array( 'A' => 10, 'B' => 17 ),
        '5' => 19
      );
      */
      $datos['total_alumnas_entregado'] = $this->evaluaciones->get_all_alumnas_entregado();


      //CARGO LA INTERFAZ
      $this->load->view( '/administrador/main',$datos );      

    } else {            //SI EL QUE SE LOGUEA ES UN USUARIO
      $data['mensaje'] = $data['grado'].'º '.$data['seccion'];
      //CARGO LA INTERFAZ
      $this->load->view('/usuario/main',$data);
    }
  }
  public function obtenerDatos($value='')
  {
    $grado   = $this->input->post('grado');
    $seccion = $this->input->post('seccion');

    $respuesta = $this->evaluaciones->get_datos_grafico( $grado, $seccion );

    $resultado = '{
      "cols" : [
        {"id":"","label":"Nota","pattern":"","type":"string"},
        {"id":"","label":"Cantidad Alumnos","pattern":"","type":"number"}
      ],
      "rows" : [
        {"c":[{"v":"'.$respuesta[0]['label'].'","f":null},{"v":'.$respuesta[0]['value'].',"f":null}]},
        {"c":[{"v":"'.$respuesta[1]['label'].'","f":null},{"v":'.$respuesta[1]['value'].',"f":null}]},
        {"c":[{"v":"'.$respuesta[2]['label'].'","f":null},{"v":'.$respuesta[2]['value'].',"f":null}]},
        {"c":[{"v":"'.$respuesta[3]['label'].'","f":null},{"v":'.$respuesta[3]['value'].',"f":null}]},
        {"c":[{"v":"'.$respuesta[4]['label'].'","f":null},{"v":'.$respuesta[4]['value'].',"f":null}]},
        {"c":[{"v":"'.$respuesta[5]['label'].'","f":null},{"v":'.$respuesta[5]['value'].',"f":null}]},
        {"c":[{"v":"'.$respuesta[6]['label'].'","f":null},{"v":'.$respuesta[6]['value'].',"f":null}]},
        {"c":[{"v":"'.$respuesta[7]['label'].'","f":null},{"v":'.$respuesta[7]['value'].',"f":null}]},
        {"c":[{"v":"'.$respuesta[8]['label'].'","f":null},{"v":'.$respuesta[8]['value'].',"f":null}]},
        {"c":[{"v":"'.$respuesta[9]['label'].'","f":null},{"v":'.$respuesta[9]['value'].',"f":null}]},
        {"c":[{"v":"'.$respuesta[10]['label'].'","f":null},{"v":'.$respuesta[10]['value'].',"f":null}]}
      ]
    }';
    //echo $resultado;
    echo json_encode($respuesta);

  }
}