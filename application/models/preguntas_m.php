<?php

class preguntas_m extends CI_Model {

	var $dir_galeria;
	var $dir_galeria_url;

	public function __construct()
	{
		parent::__construct();
		//Para guardar las imagenes de las preguntas
		$this->dir_galeria = realpath( APPPATH .'../assets/img/santos/' );
		$this->dir_galeria_url = base_url().'assets/img/santos/';
	}
	public function do_upload()
	{
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png', 
			'upload_path'   => $this->dir_galeria, 
			'max_size'      => 2000
			);
		$this->load->library( 'upload',$config );
		$this->upload->do_upload();
		$image_data = $this->upload->data();

		$config = array(
			'source_image'    => $image_data[ 'full_path' ], 
			'new_image'       => $this->dir_galeria . '/thumbs', 
			'maintain_ration' => true,
			'width'           => 150,
			'height'          => 100
			);
		$this->load->library( 'image_lib', $config );
		$this->image_lib->resize();
	}
	//ESCRIBE EL NOMBRE DE LA IMAGEN EN EL REGISTRO DE LA PREGUNTA CORRESPONDIENTE
	public function establecer_imagen( $id, $image_data )
	{
		//$ruta = $image_data['full_path'];		//ruta absoluta del archivo
		$nombre = $image_data['file_name'];		//nombre completo del archivo
		//viene $id, $pregunta
		$datos['imagen']  = $nombre;
		
		$this->db->update('preguntas', $datos, array('id_p' => $id));
	}
	// devuelve las imagenes de la carpeta $dir_galeria
	public function get_images()
	{
		$files = scandir( $this->dir_galeria );
		$files = array_diff( $files, array( '.','..','thumbs' ) );

		$images = array();

		foreach ($files as $file ) {
			$images[] = array(
				'url' => $this->dir_galeria_url . $file, 
				'thumb_url' => $this->dir_galeria_url . 'thumbs/' . $file
				);
		}
		return $images;
	}
	// List all your items
	public function guardar_pregunta( $body, $seccion )
	{
		$data['pregunta'] = $body;
		$data['grado'] = (int) $seccion;

		if ( $this->db->insert('preguntas',$data) ) {
	      return $data;
	    } else {
	      return false;
	    }
	}
	public function cant_preguntas_por_examen( $id_examen = null )
	{
		return $this->db->get('preguntas')->num_rows();
	}
	
	//obtengo las preguntas del examen oredenadas por el numero de interno
	public function get_preguntas_por_interno( $id_examen )
	{
		$this->db->order_by('interno','asc');
		$this->db->where('id_examen',$id_examen);
		return $this->db->get('preguntas')->result_array();
	}
	public function get_pregunta_pagination($per_page)
	{
		$this->db->order_by("interno", "asc"); 
		$datos = $this->db->get('preguntas',$per_page,$this->uri->segment(3));
		return $datos->result_array();
	}
	public function get_preguntas_por_id_examen( $id_examen )
	{
		$this->db->select('id_p,pregunta,interno');
		$this->db->from('preguntas');
		$this->db->where('id_examen', $id_examen);

		$preguntas = $this->db->get()->result_array();

		if ( is_array($preguntas) && count($preguntas) > 0 ) {
			return $preguntas;
		}
		return false;
	}
	public function guardandoPregunta($pregunta,$grado,$interno,$id_examen)
	{
		$datos['id_p']      = null;
		$datos['pregunta']  = $pregunta;
		$datos['grado']     = (int) $grado;
		$datos['interno']	= (int) $interno;
		$datos['id_examen'] = (int) $id_examen;

		if ( $this->db->insert('preguntas', $datos ) ) {
			return $datos;
		}else{
			return FALSE;
		}
	}

	// Add a new item
	public function add()
	{

	}

	//Update one item
	public function update( $id,$pregunta)
	{
		$datos['pregunta']  = $pregunta;

		$this->db->update('preguntas', $datos, array('id_p' => $id));

	}
	public function getGrado_por_id_pregunta($value)
	{
		$this->db->select('grado');
		$this->db->from('preguntas');
		$this->db->where('id_p', $value);

		$grado = $this->db->get()->result();

		return $grado[0]->grado;

	}
	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file preguntas_m.php */
/* Location: ./application/models/preguntas_m.php */
