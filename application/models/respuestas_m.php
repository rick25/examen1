<?php
class respuestas_m extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	//GUARDA LAS RESPUESTAS EN LA BASE DE DATOS
	public function guardandoRespuesta( $id_p,$respuesta,$interno,$correcto = NULL )
	{
		
		$datos['id_p']      = $id_p;
		$datos['respuesta'] = $respuesta;
		$datos['interno'] = $interno;
		$datos['correcto']  = $correcto;

		try {
			$this->db->insert('respuestas', $datos );
		} catch (Exception $e) {
			
		}
	}

	//obtengo las respuestas con el id_examen oredenadas  por interno
	public function get_respuestas_correspondientes( $id_examen )
	{
		$this->db->select('respuestas.id_r,respuestas.id_p,respuestas.respuesta,respuestas.interno,respuestas.correcto');
		$this->db->from('preguntas');
		$this->db->join('respuestas', 'preguntas.id_p = respuestas.id_p');
		$this->db->where('id_examen', $id_examen);
		$this->db->order_by('respuestas.id_r','asc');

		return $this->db->get()->result_array();
	}
	//obtengo las respuestas CORRECTAS con el id_examen ordenadas por interno
	public function get_respuestas_correctas( $id_examen  )
	{
		$arreglo = array('id_examen' => $id_examen,'respuestas.correcto' => 1 );
		
		$this->db->select('respuestas.interno,respuestas.id_r');
		$this->db->from('preguntas');
		$this->db->join('respuestas', 'preguntas.id_p = respuestas.id_p');
		$this->db->where($arreglo);
		$this->db->order_by("respuestas.interno", "asc");

		$valores = $this->db->get()->result_array();
		$arrayName = array();
		foreach ($valores as $key => $value) {
			$id = $value['interno'];
			$arrayName[$id] = (int)$value['id_r'];
		}
		return $arrayName;
		
	}
	public function get_respuestas_pagination($id_examen='')
	{
		$this->db->select('respuestas.id_r,respuestas.id_p,respuestas.respuesta,respuestas.interno,respuestas.correcto');
		$this->db->from('preguntas');
		$this->db->join('respuestas', 'preguntas.id_p = respuestas.id_p');
		$this->db->where('id_examen', $id_examen);

		return $this->db->get()->result_array();
	}
	public function get_respuestas_por_id_examen( $id_examen )
	{
		$this->db->select('respuestas.id_r,respuestas.id_p,respuestas.respuesta,respuestas.interno,respuestas.correcto');
		$this->db->from('preguntas');
		$this->db->join('respuestas', 'preguntas.id_p = respuestas.id_p');
		$this->db->where('id_examen', $id_examen);

		$respuestas = $this->db->get()->result_array();

		if ( is_array($respuestas) && count($respuestas) > 0 ) {
			return $respuestas;
		}
		return false;
	}

}

/* End of file respuestas_m.php */
/* Location: ./application/models/respuestas_m.php */
