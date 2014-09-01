<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar_evaluaciones extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('administrador/prueba2_model','grados');
		$this->load->model('administrador/evaluaciones_model','modelo');
	}

	// List all your items
	public function index( $sort_by = 'grado', $sort_order = 'asc', $offset = 0 )
	{
		$data = array(
			'titulo' => 'Evaluaciones de Alumnos', 
			'grados' => $this->grados->getAll_grados(), 
			'datos_alumnos' => $this->modelo->get_all_datos_evaluacion( $sort_by, $sort_order ), 
			'sort_order' => $sort_order, 
			'sort_by' => $sort_by
			);
		$data['secciones'] = array(
			'1' => ' ',
			'2' => array('A','B'),
			'3' => array('A','B'),
			'4' => array('A','B'),
			'5' => ' '
			);
		$data['campos'] = array(
			'dni'       => 'Dni', 
			'nombre'    => 'Nombre',
			'apellido1' => 'Apellido Paterno',
			//'grado'     => 'Grado',
			//'seccion'   => 'Seccion',
			'nota'      => 'Nota',
			'presento'  => 'Presento'
		);
		$this->load->view('administrador/evaluaciones_view', $data);
	}

	// Cambia el estado de la presentacion del examen de un alumno
	public function cambiarEstado()
	{
		$id_alumno = $this->input->post('id');
		$valor     = $this->input->post('valor');
		$this->modelo->actualizarEstado( $id_alumno,$valor );
		$respuesta = $this->modelo->consultarEstado($id_alumno);
		$response = array(
			'presento' => $respuesta['presento']
		);
		echo json_encode($response);
		return FALSE;
	}
}

/* End of file administrar_evaluaciones.php */
/* Location: ./application/controllers/administrador/administrar_evaluaciones.php */