<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluaciones_model extends CI_Model {
	public function get_all_datos_evaluacion( $sort_by, $sort_order )
	{
		$sort_order = ( $sort_order == 'desc') ? 'desc' : 'asc' ;
		$sort_columns = array( 'nombre', 'nombre2', 'apellido1', 'apellido2', 'grado', 'seccion', 'nota', 'presento' );
		$sort_by = ( in_array($sort_by, $sort_columns) ) ? $sort_by : 'grado' ;

		$this->db->select('id,dni,nombre,nombre2,apellido1,apellido2,grado,seccion,nota,presento');
		//$this->db->order_by('id','asc');
		$this->db->order_by( $sort_by, $sort_order );
		$this->db->order_by('id','asc');
		return $this->db->get('usuarios')->result_array();
	}
	public function get_all_alumnas_entregado()
	{
		//para preguntar por la cantidad de alumnas que entregaron el examen de a un grrado y seccion por vez
		$datos = array(
			'presento' => 1, 
			'grado' => '1', 
			'seccion' => '-'
		);
		$this->db->where( $datos );
	    $cantidad = $this->db->get('usuarios')->num_rows();

	    $grados = array( '1','2','3','4','5' );
	    $secciones = array(
	        '1' => '-',
	        '2' => array('A','B'),
	        '3' => array('A','B'),
	        '4' => array('A','B'),
	        '5' => '-'
	     );
	    $retorno = array();
	    
	    foreach ( $secciones as $key => $seccion ) {
	    	foreach ($grados as $grado) {
	    		if ( $key == $grado ) {
			    	if ( !is_array( $seccion ) ) {
			  			$datos = array(
							'presento' => 1, 
							'grado'    => $grado, 
							'seccion'  => $seccion
						);
						$this->db->where( $datos );
			  			$valor = $this->db->get( 'usuarios' )->num_rows();
			  			$linea = array( (string)$grado => $valor );
			  			//array_push( $retorno, $linea );
			  			$retorno[ (string)$grado ] = $valor;
			    	} else {
			    		$paso = array();
			    		foreach ( $seccion as $key => $value ) {
			    			$linea = array();
			    			$datos = array(
								'presento' => 1, 
								'grado'    => $grado, 
								'seccion'  => $value
							);
			    			$this->db->where( $datos );
			  				$valor = $this->db->get('usuarios')->num_rows();
			  				$linea[ $value ] = $valor;
			  				//array_push( $paso, $linea );
			  				$paso[ $value ] = $valor;
			    		}
			  			$retorno[ (string)$grado ] = $paso;
			    	}
	    		}
	    	}
	    }
	    //return $cantidad;
	    return $retorno;
	}
	public function actualizarEstado( $id,$valor )
	{
		$datos['presento'] = (int)$valor;
		$datos['nota']     = (int)'0';
		$this->db->update('usuarios', $datos, array('id' => $id));
	}
	public function consultarEstado($id)
	{
		$this->db->select('presento');
		$this->db->where('id',$id);
		$valor = $this->db->get('usuarios')->result_array();
		return $valor[0];
	}
	public function get_datos_grafico( $grado, $seccion = '' )
	{
		if ( $seccion == '' ) {
			$seccion = '-';
		}
		$notas = array(
			'Cero'        => '0', 
			'Cuatro'      => '4', 
			'Seis'        => '6', 
			'Ocho'        => '8', 
			'Diez'        => '10', 
			'Doce'        => '12', 
			'Catorce'     => '14',
			'Diescieseis' => '16', 
			'Diesisiete'  => '17', 
			'Diesciocho'  => '18', 
			'Veinte'      => '20'
			);
		$retorno = array();
		foreach ($notas as $key => $nota) {
			$datos = array(
				'grado' => $grado,
				'seccion' => $seccion,
				'nota'  => (int)$nota
			);
			$this->db->select( 'nota' );
			$this->db->where( $datos );
			$query = $this->db->get( 'usuarios' );
			$cantidad = $query->num_rows();
			$linea = array( 'label' => $key,'value' => $cantidad );
			array_push( $retorno, $linea );
		}
		return $retorno;
/*
		$dev = array(
			array('nota' => 'Cero','cantidad' => 12),
			array('nota' => 'Cuatro','cantidad' => 18),
			array('nota' => 'Diez','cantidad' => 12)
		);
		return $dev;
*/
	}
}
/* End of file administrador/evaluaciones_model.php */
/* Location: ./application/models/administrador/evaluaciones_model.php */