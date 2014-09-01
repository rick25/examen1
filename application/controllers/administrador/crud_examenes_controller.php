<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_examenes_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('administrador/examenes_crud_m','modelo');
	}

	// Muestra todos los examenes
	public function index( $offset = 0 )
	{	
		$data['datos_examenes'] = $this->modelo->getTodosExamenes();
		$this->load->view('administrador/crud_examenes_v',$data);
	}
	// Cambia el estado de un examen
	public function cambiarEstado($value='')
	{
		$id_examen = $this->input->post('id');
		$valor     = $this->input->post('valor');
		$this->modelo->update($id_examen, $valor);
	}
	// Add a new item
	public function add()
	{

	}

	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file crud_examenes_controller.php */
/* Location: ./application/controllers/crud_examenes_controller.php */