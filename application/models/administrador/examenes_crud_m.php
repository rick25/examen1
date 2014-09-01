<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Examenes_crud_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}

	// Obtiene todos los examenes de la base de datos
	public function getAll()
	{
		$this->db->select('cantidad_preguntas,id_grado');
		$this->db->from('examen');

	    return $this->db->get()->result_array();
	}
	public function habilitado($id_examen='')
	{
		$valores = array('habilitado' => 1, 'id_examen' => $id_examen);
		$this->db->where($valores);
		$valor = $this->db->get('examen')->num_rows();
		if ($valor == 1) {
			return TRUE;
		}
		return FALSE;	
	}
	//Obtiene todos los examenes del grado ingresado que estan habilitados
	public function get_por_grado( $grado )
	{
		$this->db->from('examen');
		$this->db->where( array('id_grado'=>$grado, 'habilitado'=>1 ) );

		$examenes = $this->db->get()->result_array();

		if ( is_array($examenes) && count($examenes) > 0 ) {
			return $examenes;
		}
		return false;
	}

	public function getTodosExamenes($value='')
	{
		$this->db->select('examen.id_examen, grado.nombre,examen.cantidad_preguntas,examen.habilitado');
		$this->db->from('examen');
		$this->db->join('grado','examen.id_grado = grado.id_grado');

		return $this->db->get()->result_array();
	}
	// Add a new item
	public function add()
	{

	}

	//Update one item
	public function update( $id,$value='')
	{
		$datos['habilitado']  = $value;

		$this->db->update('examen', $datos, array('id_examen' => $id));

	}
	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file examen_m.php */
/* Location: ./application/models/examen_m.php */