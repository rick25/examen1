<?php

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_m','usuarios');
    }
    //pagina por defecto cuando se ingresa a la pagina. Si ya se esta logueado se redirige a el controlador principal
    function index() {
        if( $this->session->userdata( 'isLoggedIn' ) ) {
            redirect( '/principal/index' );
        } else {
            $this->show_login( FALSE );
        }
    }
    //funcion que busca en la BD y valida el ingreso
    function login_user() {
        // Crea una instancia del modelo user_m

        $this->form_validation->set_rules('dni', 'Dni', 'trim|required|min_length[8]|max_length[8]|xss_clean');
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|min_length[4]|max_length[12]|xss_clean');
        $this->form_validation->set_message( 'required', 'El campo %s es necesario' );
        $this->form_validation->set_message( 'min_length', 'El %s debe tener 8 caracteres' );

        if ( $this->form_validation->run() == FALSE) {
            // muestro la vista login con un mensaje de error
            $this->show_login( TRUE );
        } else {
            // Guardo el dni y el password enviado por POST
            $dni  = $this->input->post('dni');
            $pass = $this->input->post('password');

            if( $dni && $pass && $this->usuarios->validate_user( $dni,$pass ) ) {
                // En caso de ser un usuario valido mando la vista principal
                redirect('/principal/index');
            }
        }//fin de correr validacion ci
    }
    //Muestra el loguin para introducir datos de usuario
    function show_login( $show_error = FALSE ) {
        $data['error'] = $show_error;

        $this->load->view('login',$data);
    }

    function logout_user() {
      $this->session->sess_destroy();
      $this->index();
    }
}