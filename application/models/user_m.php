<?php

class user_m extends CI_Model {

    var $details;

    function validate_user( $dni, $password ) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('usuarios');
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

    function  crear_nuevo_usuario( $userData ) {
      $data['dni']       = $userData['dni'];
      $data['password']  = sha1($userData['password1']);
      $data['nombre']    = $userData['nombre'];
      $data['apellido1'] = $userData['apellido1'];
      $data['apellido2'] = $userData['apellido2'];
      $data['avatar']    = $this->obtenerAvatar($userData['sexo']);
      $data['sexo']      = (int) $userData['sexo'];
      $data['grado']     = (int) $userData['grado'];
      $data['seccion']   = $userData['seccion'];

      return $this->db->insert('usuarios',$data);
    }
/*
    public function update_tagline( $user_id, $tagline ) {
      $data = array('tagline'=>$tagline);
      $result = $this->db->update('user', $data, array('id'=>$user_id));
      return $result;
    }
*/
    private function obtenerAvatar($sexo)
    {
      $avatar_names = array();
      foreach(glob('assets/img/avatars/*.png') as $avatar_filename){
        $avatar_filename =   str_replace("assets/img/avatars/","",$avatar_filename);
        array_push($avatar_names, str_replace(".png","",$avatar_filename));
      }
      if ( ((int) $sexo) == 1) {
        return $avatar_names[9];
      } else {
        return $avatar_names[8];
      }
      
    }

    public function poner_nota($dni,$nota)
    {
      $datos['nota']     = (int)$nota;
      $datos['presento'] = (int)'1';

      $this->db->update('usuarios', $datos, array('dni' => $dni));
    }
    public function presento_examen($dni='')
    {
      $this->db->select('presento');
      $this->db->where('dni',$dni);
      $valor = $this->db->get('usuarios')->result_array();
      $resultado = $valor[0]['presento'];
      if ( $resultado == '1' ) {
        return FALSE;
      } else {
        return TRUE;
      }
      
    }
    /*
    private function getAvatar() {
      $avatar_names = array();

      foreach(glob('assets/img/avatars/*.png') as $avatar_filename){
        $avatar_filename =   str_replace("assets/img/avatars/","",$avatar_filename);
        array_push($avatar_names, str_replace(".png","",$avatar_filename));
      }

      return $avatar_names[array_rand($avatar_names)];
    }
    */
}
