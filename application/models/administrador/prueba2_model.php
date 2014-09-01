<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prueba2_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
	}
	// Entrega todas las secciones de la base d datos
	public function getAll_grados()
	{
		//$this->db->select('titulo, contenido, fecha');
		//$consulta = $this->db->get('mitabla');
		$this->db->from('grado');

	    return $this->db->get()->result_array();
	}
	//DEVUELVE EL ID_EXAMEN DEL GRADO QUE SE PASA POR PARAMETRO QUE ESTE HABILITADO
	public function get_id_examen( $grado )
	{
		$datos = array( 'id_grado' => $grado, 'habilitado' => 1 );
		$this->db->select('id_examen,cantidad_preguntas');
		$this->db->where($datos);
		$query = $this->db->get('examen')->result_array();

		if ( is_array( $query ) && count( $query ) > 0 ) {
			return $query;
		} else {
			return FALSE;
		}
	}
	//OBTENGO LAS PREGUNTAS DEL EXAMEN 
	public function get_preguntas( $id_examen )
	{
		$this->db->select( 'id_p,pregunta,interno,imagen' );
		$this->db->where( 'id_examen',$id_examen );
		$this->db->order_by('interno','asc');

		return $this->db->get('preguntas')->result_array();
	}
	//OBTENGO LAS RESPUESTAS DEL EXAMEN
	public function get_respuestas( $id_examen )
	{
		$this->db->select('respuestas.id_r,respuestas.id_p,respuestas.respuesta,respuestas.interno,respuestas.correcto');
		$this->db->from('preguntas');
		$this->db->join('respuestas', 'preguntas.id_p = respuestas.id_p');
		$this->db->where('id_examen', $id_examen);
		$this->db->order_by('respuestas.id_r','asc');

		$respuestas = $this->db->get()->result_array();

		if ( is_array($respuestas) && count($respuestas) > 0 ) {
			return $respuestas;
		}
		return FALSE;
	}
	//OBTIENE LAS RESPUESTAS POR id_p
	public function get_respuestas_by_id_p( $id_p )
	{
		$this->db->where( 'id_p', $id_p );
		$this->db->order_by( 'id_r','asc' );
		return $this->db->get('respuestas')->result_array();
	}
	//GUARDA LA PREGUNTA
	public function guardaPregunta( $pregunta, $grado, $interno, $id_examen )
	{
		$datos = array(
			'pregunta' => $pregunta,
			'grado'    => (int)$grado,
			'interno'  => (int)$interno,
			'id_examen'=> (int)$id_examen
			);
		$resultado = $this->db->insert( 'preguntas', $datos );
		if ( $resultado ) {
			return $datos;
		} else {
			return FALSE;
		}
		
	}
	//ACTUALIZA LA PREGUNTA
	public function update_Pregunta( $id_p, $valor='' )
	{
		$datos = array( 'pregunta' => $valor );
		$this->db->where( 'id_p', $id_p );
		if($this->db->update( 'preguntas', $datos )){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//GUARDA LAS RESPUESTAS
	public function guardar_respuestas( $id_p, $resp, $correcta, $interno )
	{
		$datos = array(
			'id_p' => (int)$id_p,
			'respuesta' => $resp,
			'interno' => (int)$interno,
			'correcto'=> $correcta
			);
		$this->db->insert( 'respuestas',$datos );
	}
	//MODIFICA UNA RESPUESTA
	public function updateRespuesta( $id, $valor )
	{
		$this->db->where('id_r',$id);
		if( $this->db->update( 'respuestas', array('respuesta' => $valor ) ) ){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//MODIFICA RESPUESTA YA CARGADA
	public function updateRespuestaM( $id, $respuesta, $correcto )
	{
		$datos = array(
			'respuesta' => $respuesta,
			'correcto' => $correcto
			);
		$this->db->where( 'id_r',$id );
		$this->db->update( 'respuestas',$datos );
	}
}

/* End of file prueba2_model.php */
/* Location: ./application/models/administrador/prueba2_model.php */ ?>