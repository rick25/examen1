<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('administrador/admin_model','modelo');
	}

	// List all your items
	public function index( $offset = 0 )
	{
		//echo "administrador";
		$this->load->view( 'administrador/login_view' );
	}

	// loguea al administrador
	public function login()
	{
		$this->form_validation->set_rules('dni', 'Dni', 'trim|required|min_length[8]|max_length[8]|xss_clean');
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|min_length[4]|max_length[12]|xss_clean');
        $this->form_validation->set_message( 'required', 'El campo %s es necesario' );
        $this->form_validation->set_message( 'min_length', 'El %s debe tener 8 caracteres' );

        if ( $this->form_validation->run() == FALSE ) {
        	//$this->load->view( 'administrador/login_view' );
        	$this->index();
        } else {
        	// Guardo el dni y el password enviado por POST
            $dni  = $this->input->post('dni');
            $pass = $this->input->post('password');

            if( $dni && $pass && $this->modelo->validate_admin( $dni,$pass ) ) {
                // En caso de ser un usuario valido mando la vista principal
                redirect('/principal/index');
                //redirect('panel');	//esto es cambiando la ruta pero no sale la imagen del administrador
            }
        }
        

	}
}

/* End of file login_admin.php */
/* Location: ./application/controllers/administrador/login_admin.php */