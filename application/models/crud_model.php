<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
Class crud_model extends CI_Model
{
    public function __construct()
    {
 
        parent::__construct();
 
    }
 
    //obtenemos los usuarios
    public function get_users()
    {
 
        $query = $this->db->get('usuarios');
        if($query->num_rows() > 0)
        {
             return $query->result();
        }
 
    }
    //obtenemos la cantidad de usuarios en la base de datos
    public function cant_usuarios( $grado )
    {
        if($grado == 0){
            $this->db->where('isAdmin',$grado);
        }else{
            $this->db->where('grado',$grado);
        }
        return $this->db->get('usuarios')->num_rows();
    }
    //obtenemos una array con todos los grados
    public function get_all_grados()
    {
        $this->db->select('nombre,id_grado');
        return $this->db->get('grado')->result_array();
    }
    //
    public function get_users_paginacion( $per_page,$grado )
    {   
        if($grado == 0){
            $this->db->where('isAdmin',$grado);
        }else{
            $this->db->where('grado',$grado);
        }
        $datos = $this->db->get('usuarios',$per_page,$this->uri->segment(4));
        return $datos->result_array();
    }
    //eliminamos usuarios
    public function delete_user($id)
    {
 
        $this->db->where('id',$id);
        return $this->db->delete('usuarios');
 
    }
 
    //editamos usuarios
    public function edit_user($id,$dni,$nombre,$apellido1,$apellido2,$sexo,$grado,$seccion)
    {
 
        //$fecha = date('Y-m-d');
 
        $data = array(
            'dni'       => (int)$dni,
            'nombre'    => $nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'sexo'      => $sexo,
            'grado'     => (int)$grado,
            'seccion'   => $seccion 
        );
 
        $this->db->where('id',$id);
        $this->db->update('usuarios',$data);
 
    }
 
    //añadimos usuarios
    public function new_user($dni,$nombre,$apellido1,$apellido2,$sexo,$grado,$seccion)
    {
 
        //$fecha = date('Y-m-d');
 
        $data = array(
            'dni'       => (int)$dni,
            'nombre'    => $nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'sexo'      => $sexo,
            'grado'     => (int)$grado,
            'seccion'   => $seccion
        );
 
        $this->db->insert('usuarios',$data);
 
    }
 
}
/*
*Location: application/models/crud_model.php
*/