<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examen_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//cargo dependencias
		//$this->load->model('examen_m');
		$this->load->model('administrador/examenes_crud_m','examen');
		$this->load->model('preguntas_m');
		$this->load->model('respuestas_m');
		$this->load->model('user_m');
	}

	// List all your items
	public function index( $offset = 0 )
	{
		//guardo el grado y la seccion del alumno que esta logueado
		$grado   = $this->session->userdata('grado');	
		$seccion = $this->session->userdata('seccion');
		$nombre  = $this->session->userdata('nombre');

		//si hay un examen habilitado para el grado del alumno logueado
		if ( $examen = $this->examen->get_por_grado( $grado ) )	
		{
			//SI EL ALUMNO AUN NO HIZO EL EXAMEN
			if ( $valor = $this->user_m->presento_examen( $this->session->userdata('dni') ) ) {
				$id_examen = $examen[0]['id_examen'];

				$data = array(
						'titulo'     => 'Examen '.$grado.'º '.$seccion,
						'mensaje'    =>'Examen para ',
						'grado'      => $grado,
						'seccion'    => $seccion,
						'nombre'     => $nombre,
						'preguntas'  => $this->preguntas_m->get_preguntas_por_interno( $id_examen ),	//preguntas del examen mostradas de a una
						'respuestas' => $this->respuestas_m->get_respuestas_correspondientes( $id_examen )
						);
/*				
					$this->load->view( 'usuario/examen',$data );
*/					
					$this->load->view( 'usuario/prueba_examen',$data );
			} else {
				//CUANDO EL ALUMNO YA HIZO EL EXAMEN
				$this->load->view('usuario/pags_errores/examen_realizado');
			}
			

		}else{		//si no hay examen habilitado para el alumno logueado
			$data['mensaje'] = 'No tiene examen habilitado o bien ya realizo su examen.';
			$this->load->view('usuario/pags_errores/examen_deshabilitado',$data );
		}
	}
	//recibe el resultado de los r
	public function recibe()
	{
		if ( $this->input->is_ajax_request() ) {
			$array = $this->input->post('a');
			$preguntas_recibidas = array(
				'1'  => (int)$this->input->post('1'),
				'2'  => (int)$this->input->post('2'),
				'3'  => (int)$this->input->post('3'),
				'4'  => (int)$this->input->post('4'),
				'5'  => (int)$this->input->post('5'),
				'6'  => (int)$this->input->post('6'),
				'7'  => (int)$this->input->post('7'),
				'8'  => (int)$this->input->post('8'),
				'9'  => (int)$this->input->post('9'),
				'10' => (int)$this->input->post('10')
			);
			//PARA OBTENER EL ARRAY CON LAS RESPUESTAS CORRECTAS
			$grado   = $this->session->userdata('grado');
			$examen = $this->examen->get_por_grado( $grado );
			$id_examen = $examen[0]['id_examen'];
			$preguntas_correctas = $this->respuestas_m->get_respuestas_correctas( $id_examen );			

			$dni   = $this->session->userdata('dni');

			$nota = 0;
			foreach ($preguntas_recibidas as $key => $value) {
				foreach ($preguntas_correctas as $llave => $valor) {
					if ( $key == $llave && $value == $valor ) {
						$nota = $nota + 2;
					}
				}
			}

			$resultado = $this->user_m->poner_nota($dni,$nota);

			$devuelto = array(
				'nota' => $nota,
				'corregido' => 'si'
				);
			echo json_encode($devuelto);

			return FALSE;
		}

	}
	public function finalizado($value='')
	{
		$this->load->view('usuario/examen_finalizado');
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

/* End of file examen_controller.php */
/* Location: ./application/controllers/examen_controller.php */