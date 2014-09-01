<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prueba2_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('administrador/prueba2_model','modelo');
		$this->load->model('preguntas_m');
	}

	// List all your items
	public function index( $offset = 0 )
	{
		$grado = $this->session->userdata('grado');
			
		$datos_examen = $this->modelo->get_id_examen( $grado );
		if ( $datos_examen == FALSE ) {
			$estado = FALSE;
		} else {
			$estado = TRUE;
		}
		$data = array(
			'titulo'         => 'Este es el titulo',
			'mensaje'        => 'Esta es una prueba',	//OK
			'grado'          => $grado,	//OK
			'habilitado'     => $estado,	//SI ESTA HABILITADO O NO EL EXAMEN
			'id_examen'      => $datos_examen[0]['id_examen'],
			'cant_preguntas' => $datos_examen[0]['cantidad_preguntas'],	//OK
			'preguntas'      => $preg = $this->prepararPreguntas($this->modelo->get_preguntas( $datos_examen[0]['id_examen'] ), $datos_examen[0]['cantidad_preguntas'] ),	//OK
			'respuestas'     => $res = $this->prepararRespuestas( $this->modelo->get_respuestas( $datos_examen[0]['id_examen'] ) , $datos_examen[0]['cantidad_preguntas'] )	//OK
			);
		$this->load->view('administrador/prueba2_vista2',$data);
	}
	//ordena las respuestas para mostrarlas
	public function prepararRespuestas( $respuestas, $cant_preguntas )
	{
		if ( isset($respuestas) && $respuestas ) {
			for ($i=1; $i <= $cant_preguntas ; $i++) {		//del 1 al ultimo
				foreach ($respuestas as $value) {		//recorro las respuestas
					$id = $value['interno'];
					if ( $i == (int)$id ) {
						$res[$i][] = array(
						'id_r'		=>$value['id_r'],
						'id_p'		=> $value['id_p'],
						'respuesta' => $value['respuesta'],
						'interno'	=> $value['interno'],
						'correcto' => $value['correcto']
						);
					}
				}
			}
			return $res;
		}
	}
	//ordena las preguntas para mostrarlas
	public function prepararPreguntas( $preguntas, $cant_preguntas )
	{
		if ( isset($preguntas) && $preguntas ) {
			for ($i=1; $i <= $cant_preguntas ; $i++) {
				foreach ( $preguntas as $key => $value ) {
					$id = $value['interno'];
					if ( $i == $id ) {
						$preg[$i] = array(
							'id_p' => $value['id_p'],
							'pregunta'=> $value['pregunta'],
							'interno' => $value['interno'],
							'imagen'  => $value['imagen']	//nombre del archivo en la base de datos
						);
					}
				}
			}
			return $preg;
		}
	}
	// Muestra la vista para elegir el grado del examen
	public function elige($value='')
	{
		//$data['grados'] = $this->grados->getAll();
		$data['grados'] = $this->modelo->getAll_grados();
		$data['titulo'] = "Elegir Grado";
		$this->load->view('administrador/elegir_prueba2',$data);
	}
	// Valida la entrada del grado y redirecciona a la vista del examen
	public function direccionar($value='')
	{
		$this->form_validation->set_rules('grado', 'Grado', 'trim|required|min_length[1]|max_length[1]|xss_clean');
		$this->form_validation->set_message('required','Debe elegir un %s de la lista');
		//SI NO PASA LA VALIDACION DEL FORMULARIO
		if ( $this->form_validation->run() == FALSE ) {
			// Mando la funcion elige()
			$this->elige();
		//SI PASA LA VALIDACION
		} else {
			//AQUI CARGO LA VISTA PARA PREPARAR EXAMEN CON LOS DATOS QUE NECESITO
			$grado = $this->input->post('grado');

			//SIMPLIFICADO

			//DEFINO UNA VARIABLE DE SESSION PARA GUARDAR EL GRADO
			$this->session->set_userdata('grado', $grado);			
			$datos_examen = $this->modelo->get_id_examen( $grado );
			if ( $datos_examen == FALSE ) {
				$estado = FALSE;
			} else {
				$estado = TRUE;
			}

			$data = array(
				'titulo'         => 'Este es el titulo',
				'mensaje'        => 'Esta es una prueba',	//OK
				'grado'          => $grado,	//OK
				'habilitado'     => $estado,	//SI ESTA HABILITADO O NO EL EXAMEN
				'id_examen'      => $datos_examen[0]['id_examen'],
				'cant_preguntas' => $datos_examen[0]['cantidad_preguntas'],	//OK
				'preguntas'      => $preg = $this->prepararPreguntas($this->modelo->get_preguntas( $datos_examen[0]['id_examen'] ), $datos_examen[0]['cantidad_preguntas'] ),	//OK
				'respuestas'     => $res = $this->prepararRespuestas( $this->modelo->get_respuestas( $datos_examen[0]['id_examen'] ) , $datos_examen[0]['cantidad_preguntas'] )//OK
				);
			$this->load->view('administrador/prueba2_vista2',$data);
		}
		
	}
	public function multi($value='')
	{
		if ( $this->input->is_ajax_request() ) {
			//SI VIENE id_p QUIERE DECIR QUE LA PREGUNTA YA EXISTE Y HAY QUE ACTUALIZARLA
			if ( $id_p = $this->input->post('id_p') ) {
				$pregunta_cambio = $this->input->post('pregunta');
				$resultado = $this->modelo->update_Pregunta( $id_p, $pregunta_cambio );
				if ( $resultado ) {
					$devuelto = array(
					'guardado' => 'Si' 
					);
				} else {
					$devuelto = array(
					'guardado' => 'No' 
					);
				}

				echo json_encode($devuelto);

				return FALSE;
			//SI NO VIENE EL id_p QUIERE DECIR QUE LA PREGUNTA AUN NO EXISTE Y HAY QUE CREARLA
			}else{
				$pregunta  = $this->input->post('pregunta');
				$grado     = $this->input->post('grado');
				$interno   = $this->input->post('interno');
				$id_examen = $this->input->post('id_examen');

				$hecho = $this->modelo->guardaPregunta( $pregunta, $grado, $interno, $id_examen );

				if ( $hecho ) {
					$devuelto = array(
					'guardado' => 'Si' 
					);

				}
				
				echo json_encode($devuelto);

				return FALSE;
			}
		}
	}

	public function guardaRespuestas($value='')
	{
		if ( $this->input->is_ajax_request() ) {
			$interno  = $this->input->post("inte");
			$id_p     = $this->input->post("id_p");

			$respuestas = array(
				'1' => $this->input->post("resp1"),
				'2' => $this->input->post("resp2"),
				'3' => $this->input->post("resp3"),
				'4' => $this->input->post("resp4")
			);
			//ME DICEN CUAL DE LAS RESPUESTAS ES LA CORRECTA
			$correcta = $this->input->post("correcta");
			for ($i=1; $i <= 4 ; $i++) { 
				if ( $i == (int)$correcta ) {
					$this->modelo->guardar_respuestas( $id_p, $respuestas[$i], 1, $interno );
				}else{
					$this->modelo->guardar_respuestas( $id_p, $respuestas[$i], 0, $interno );
				}
			}
	
			$devuelto = array(
				'guardado' => 'Si' 
				);
			echo json_encode($devuelto);

			return FALSE;
		}
	}
	//MODIFICA UNA RESPUESTA
	public function modificaRespuesta($value='')
	{
		if ( $this->input->is_ajax_request() ) {

			$id_r      = $this->input->post('id_r');
			$respuesta = $this->input->post('resp');
			$id_p      = $this->input->post('id_p');

			$respuestas = $this->modelo->get_respuestas_by_id_p( $id_p );

			//SI LA RESPUESTA A MODIFICAR ES LA NUEVA RESPUESTA CORRECTA
			if ( $this->input->post('correcta')=='true' ) {
				foreach ($respuestas as $key => $value) {
					if ( $value['id_r'] == $id_r ) {
						$this->modelo->updateRespuestaM( $id_r,$respuesta, 1 );
					} else {
						$this->modelo->updateRespuestaM( $value['id_r'],$value['respuesta'], 0 );
					}
				}
			} else {
				$this->modelo->updateRespuesta( $id_r, $respuesta );
			}
			


			$devuelto = array(
				'guardado' => 'Si' 
				);
			echo json_encode($devuelto);

			return FALSE;
		}
	}
	// AGREGAR IMAGEN A UNA PREGUNTA
	public function do_upload()
	{
		if ( $this->input->post( 'upload' ) ) {
			$this->preguntas_m->do_upload();
			$this->preguntas_m->establecer_imagen( $this->input->post('id_p'), $this->upload->data() );
		}
		$this->index();
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

/* End of file prueba2_controller.php */
/* Location: ./application/controllers/administrador/prueba2_controller.php */