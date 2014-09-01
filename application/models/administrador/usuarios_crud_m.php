<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_crud_m extends CI_Model {
    public function __construct(){
        parent::__construct();
        //$this->load->database('SGA');    
    }
    public function get_secciones()
    {
        return $this->db->get('secciones')->result_array();
    }
    //añadimos usuarios
    public function new_user($dni,$nombre,$password,$apellido1,$apellido2,$sexo,$grado,$seccion)
    {
 
        //$fecha = date('Y-m-d');
 
        $data = array(
            'dni'       => (int)$dni,
            'nombre'    => $nombre,
            'password'  => sha1($password),
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'sexo'      => $sexo,
            'avatar'    => $this->obtener_avatar($sexo),
            'grado'     => (int)$grado,
            'seccion'   => $seccion
        );
 
        $this->db->insert('usuarios',$data);
 
    }
    private function obtener_avatar($sexo)
    {
      $avatar_names = array();
      foreach(glob('assets/img/avatars/*.png') as $avatar_filename){
        $avatar_filename =   str_replace("assets/img/avatars/","",$avatar_filename);
        array_push($avatar_names, str_replace(".png","",$avatar_filename));
      }
      if ( $sexo == "M") {
        return $avatar_names[9];
      } else {
        return $avatar_names[8];
      }
      
    }
    //editamos usuarios
    public function edit_user($id,$dni,$nombre,$password,$apellido1,$apellido2,$sexo,$grado,$seccion)
    {
         $data = array(
            'dni'       => (int)$dni,
            'nombre'    => $nombre,
            'password'  => sha1($password),
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'sexo'      => $sexo,
            'avatar'    => $this->obtener_avatar($sexo),
            'grado'     => (int)$grado,
            'seccion'   => $seccion 
        );
 
        $this->db->where('id',$id);
        $this->db->update('usuarios',$data);
 
    }
    //obtenemos los datos de un usuario
    public function get_datos_usuario($id='')
    {
        $this->db->where('id',$id);
        return $this->db->get('usuarios')->result_array();
    }
    function eliminar_registros($items){
        
        if(empty($items)) return false;
        
        // eliminamos espacios en blancos y comas al final de la cadena
        $items    = rtrim($items,",");
        $arrItems = explode(',',$items);
        
        $this->db->where_in('id',$arrItems);// WHERE id IN ($items)
        $this->db->delete('usuarios');

        return json_encode(array('total'=>$this->db->affected_rows()));
    }
    
    function eliminar_todo(){
        
        //$this->db->empty_table('usuarios'); // elimina los registros uno por uno ..
        $this->db->truncate('usuarios');  // borra la tabla y la recrea de nuevo 
        return true;
    }
    
    function _get_total($query='',$qtype='',$letter_pressed='Mostrar todo'){
     
        # ----------------------------------------------------------------------
        # si se usan las opciones de filtro
        if(!empty($qtype) and $letter_pressed<>'Mostrar todo'){
            
            // caso: se esta usando el buscador
            if($query!='')
                $this->db->like($qtype,$query);// WHERE campo LIKE %valor%  

            // caso: se filtra por letra
            elseif($letter_pressed!='')// WHERE campo LIKE valor%  
                $this->db->like($qtype,$letter_pressed, 'after');

            // caso: se filtra por titulo
            elseif($letter_pressed=='#')// WHERE campo REGEXP '[[:digit:]]' 
                $this->db->where($qtype, " REGEXP '[[:digit:]]' ");
        }#----------------------------------------------------------------------
        # la opcion (Mostrar todo) por defecto no aplicara filtro    
        
        $this->db->from('usuarios');
        return $this->db->count_all_results();
    }

    // devuelve en formato JSON los datos ..
    function get_json($query,$qtype,$letter_pressed,$page,$rp,$sortname,$sortorder)
    {

        // obtenemos el total de registros solicitados..
        $total = $this->_get_total($query,$qtype,$letter_pressed);
        
        // numero de pagina por defecto 1
        $page = (int)(empty($page) ? 1 : $page);

        // numero de registros a mostrar, por defecto 10
        $rp = (int)(empty($rp) ? 10 : $rp);

        // desde donde comenzar
        $start = (($page-1) * $rp);

        // ordenar por X campo
        $sortname = empty($sortname) ? 'name' : $sortname;

        // orden ascendente o descendente
        $sortorder = empty($sortorder) ? 'desc' : $sortorder;
        
        // armamos la consulta
        $this->db->select('id, dni, nombre, apellido1, apellido2, sexo, grado, seccion,password, nota,presento');
        $this->db->from('usuarios');
        
        # ----------------------------------------------------------------------
        # si se usan las opciones de filtro
        if(!empty($qtype) and $letter_pressed<>'Mostrar todo'){
            
            // caso: se esta usando el buscador
            if($query!='')
                $this->db->like($qtype,$query);// WHERE campo LIKE %valor%  

            // caso: se filtra por letra
            elseif($letter_pressed!='')// WHERE campo LIKE valor%  
                $this->db->like($qtype,$letter_pressed, 'after');

            // caso: se filtra por titulo
            elseif($letter_pressed=='#')// WHERE campo REGEXP '[[:digit:]]' 
                $this->db->where($qtype, " REGEXP '[[:digit:]]' ");
        }#----------------------------------------------------------------------

        $this->db->limit($rp, $start);
        $this->db->order_by($sortname, $sortorder);
        $query = $this->db->get();

       // echo $this->db->last_query();exit;
        
        // si hay resultados
        if ($query->num_rows()>0){

            // arrmamos un array con los datos a codificar
            $arrDatos = array(
                'page'  => $page,
                'total' => $total
            );
        
            foreach($query->result() as $row){

                $arrDatos['rows'][] = array(
                    'id'   => htmlspecialchars($row->id,ENT_QUOTES),
                    'cell' => array(
                            htmlspecialchars($row->id,ENT_QUOTES),
                            htmlspecialchars($row->dni,ENT_QUOTES),
                            htmlspecialchars($row->nombre,ENT_QUOTES),
                            htmlspecialchars($row->apellido1,ENT_QUOTES),
                            htmlspecialchars($row->apellido2,ENT_QUOTES),
                            htmlspecialchars($row->sexo,ENT_QUOTES),
                            htmlspecialchars($row->grado,ENT_QUOTES),
                            htmlspecialchars($row->seccion,ENT_QUOTES),
                            htmlspecialchars($row->password,ENT_QUOTES),
                            htmlspecialchars($row->nota,ENT_QUOTES),
                            htmlspecialchars($row->presento,ENT_QUOTES)
                    )
                );
            }#end foreach
            
            $query->free_result();
            return json_encode($arrDatos);
        }
    }
}