$(function () {

	var Aplicacion ={
		baseUrl : '/Examen1/index.php/',

		iniciar : function(){
			this.definirElementos();
			this.definirEventos();
			this.setearComponentes();
		},
		definirElementos:function(){
			this.$pregunta            = $('#pregunta');	//pregunta a guardar
			this.$grado               = $('#grado');			//grado de la pregunta a guardar
			this.$id_examen           = $('#id_examen');			//id_examen de la pregunta a guardar
			this.$btnGuardarpregunta  = $('#btnPreguntaModalSubmit');	//boton para guardar la pregunta
			//this.$mensaje           = $('#mensaje');	//div que muestra un mensaje cuando se guarda pregunta
			this.$botonCerrar         = $('#cerrar_modal');
			
			this.$btnModificar        = $('.btn btn-warning');	//boton para modificar pregunta
			this.$txtModificaPregunta = $('#preg_a_modi');	//input en la ventana modal q muestra la pregunta a modificar
		},
		definirEventos :function(){
			this.$btnGuardarpregunta.on('click',this.enviarPregunta);
			this.$btnModificar.on('click',this.modificarPregunta);
		},
		setearComponentes : function(){

		},
		enviarPregunta : function () {
			var pregunta = Aplicacion.$pregunta.val();
			var grado = Aplicacion.$grado.val();
			var id_examen = Aplicacion.$id_examen.val();

			var urlguarda = Aplicacion.baseUrl + 'examenes/guardaPregunta';

			if (pregunta.length) {
				$.ajax({
					type : "POST",
					url : urlguarda,
					data : {pregunta : pregunta, grado : grado, id_examen : id_examen},
					success : Aplicacion.guardoCorrectamente,
					error : Aplicacion.alertaErrorGuardandoPregunta,
//					datatype : 'html'
				});
			}
		},

		modificarPregunta : function( evento ){
			var pregunta_id = $(this).data('id');
			Aplicacion.$txtModificaPregunta.html(pregunta_id);
			//evento.preventDefault();
		},


		guardoCorrectamente : function( mnsje ){
			Aplicacion.$pregunta.val('');			//borro la pregunta
			Aplicacion.$botonCerrar.click();		//cierro la ventana modal
			Aplicacion.$mensaje.html(mnsje);	//paso el mensaje al div mensaje
			//location.reload();
			/*
			var grado = Aplicacion.$grado.val();
			var urlguarda = Aplicacion.baseUrl + 'examenes/administrar_examen';

			$.ajax({
				type : "POST",
				url : urlguarda,
				data : {grado : grado}
			});
			*/
		},

	};	
	Aplicacion.iniciar();
});