<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
    var $details;

    function validate_admin( $dni, $password ) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('administradores');
        $this->db->where('dni',$dni );
        $this->db->where( 'password', sha1($password) );
        $login = $this->db->get()->result();

        // Los resultados de la consulta se guardan en  $login.
        // Si existe un valor, entonces la cuenta del usuario existe y es valida
        if ( is_array( $login ) && count( $login ) == 1 ) {
            // Se guardan los datos del usuario en la variable de clase $details
            $this->details = $login[0];
            // Call set_session to set the user's session vars via CodeIgniter
            $this->set_session();
            return true;
        }
        return false;
    }

    function set_session() {
        // session->set_userdata es una funcion de Codeigniter que almacena la informacion de la sesion
        // stores data in CodeIgniter's session storage.  Some of the values are built in
        // to CodeIgniter, others are added.  See CodeIgniter's documentation for details.
        $this->session->set_userdata( array(
                'dni'        =>$this->details->dni,
                'nombre'     => $this->details->nombre . ' ' . $this->details->apellido1 . ' ' . $this->details->apellido2,
                'grado'      =>$this->details->grado,
                'seccion'    =>$this->details->seccion,
                'avatar'     =>$this->details->avatar,
                'sexo'       =>$this->details->sexo,
                'isAdmin'    =>$this->details->isAdmin,
                'isLoggedIn' =>true
            )
        );
    }

    
    
}